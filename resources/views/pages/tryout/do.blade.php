@extends('layout.app')

@section('title', $test->tryout->name)

@section('content')

@php
    $questions = $test->tryout->questions;
    $answersList = $test->answersList;
@endphp

@if ($test->done_at)
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('tryout.explanation') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar Hasil dan Pembahasan</a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="main-card card mb-4">
            <div class="card-body">
                <table class="table mb-0">
                    <tr>
                        <th>Durasi</th>
                        <td>{{ $test->tryout->duration }} Menit</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $questions->pluck('category.name')->unique()->join(", ") }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Soal</th>
                        <td>{{ $questions->count() }} Soal</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 id="question-number" class="card-title">Soal Nomor <strong>1</strong>
                            @if (!$test->done_at)
                            <span id="timer" class="float-right text-danger"></span>
                            @endif
                        </h1>
                        <div id="question-container" class="mb-4"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if ($test->done_at)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h1 class="card-title">Skor</h1>
                            <table class="table table-bordered">
                                @foreach ($test->score as $category => $score)
                                <tr>
                                    <th>{{ $category }}</th>
                                    <td>{{ $score }}</td>
                                </tr>    
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('test.submit', $test->id) }}">
                            @csrf
                            <h1 class="card-title">Navigasi Soal</h1>
                            <div class="row px-2 mb-3">
                                @foreach($questions as $index => $question)
                                    <div class="col-md-3 col-4 p-1">
                                        <div data-question-number="{{ $index + 1 }}" data-question-id="{{ $question->id }}" class="btn btn-sm w-100 number {{ isset($answersList) ? ($answersList[$question->id] == $question->correct_answer->id ? 'btn-success' : 'btn-danger') : 'btn-light' }}">{{
                                        $index + 1 }}</div>
                                        <input type="hidden" name="answers[{{ $question->id }}]">
                                    </div>
                                @endforeach
                            </div>
                            @if (!$test->done_at)
                            <button type="submit" data-alert="Anda yakin ingin mengakhiri try out ini?" id="end" class="btn btn-block btn-danger">Akhiri Try Out</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $(document).ready(function() {
        cleanup();
        const testId = @json($test->id);
        let questions = parseLocalStorage("questions") || {}
        let answers = @json($answersList) || parseLocalStorage("answers") || {}
        let remainingTime = @json($test->done_at ? 0 : $test->remainingTime);

        @if(!$test->done_at)
        syncNavigationIndicator()
        @endif

        initTimer(remainingTime)
        var timer = setInterval(() => {
            remainingTime -= 1000
            initTimer(remainingTime)
            if (remainingTime <= 0) {
                $("#end").click();
            }
        }, 1000);

        $(".number").click(function() {
            loadQuestion($(this).data("question-id"))
        })

        let currentQuestion = localStorage.getItem("currentQuestion") || @json($questions[0]->id);
        $(".number[data-question-id=" + currentQuestion + "]").click()

        function cleanup() {
            if (localStorage.getItem("currentTest") != @json($test->id) || @json($test->done_at)) {
                localStorage.removeItem("questions")
                localStorage.removeItem("answers")
                localStorage.removeItem("currentQuestion")
            }
            localStorage.setItem("currentTest", @json($test->id));
        }

        function initTimer(remainingTime) {
            if (remainingTime > 0) {
                const time = msToTime(remainingTime)
                $("#timer").text(time)
            } else {
                disableAnswer()
                $("#timer").text("Waktu Habis")
                clearInterval(timer)
            }
        }

        function loadQuestion(questionId) {
            const questionContainer = $("#question-container")
            const numberElement = $(`.number[data-question-id=${questionId}]`)
            questionContainer.html('<p class="font-italic text-center">Memuat..</p>')
            const number = parseInt(numberElement.data("question-number"));
            const nextNumber = number == @json(sizeof($questions)) ? 0 : $(`[data-question-number=${number+1}]`).data("question-id")
            const prevNumber = number == 1 ? 0 : $(`[data-question-number=${number-1}]`).data("question-id")
            const url = @json(url('tryout/question')) + `/${questionId}?next=${nextNumber}&prev=${prevNumber}&testId=${testId}`

            $(".number").removeClass("active")
            numberElement.addClass("active")

            if (questions[questionId]) {
                questionContainer.html(questions[questionId])
                initEvents(questionId);
            } else {
                questionContainer.load(url, (html) => {
                    questions[questionId] = html
                    saveLocalStorage(questions, 'questions')
                    initEvents(questionId);
                })
            }

            $("#question-number strong").html(number)
            saveLocalStorage(questionId, 'currentQuestion')
            currentQuestion = questionId

            $([document.documentElement, document.body]).animate({
                scrollTop: $("#question-container").offset().top - 120
            }, 500);

        }

        function initEvents(questionId) {
            if (remainingTime <= 0) {
                disableAnswer()
            }

            $("input[name=answer][value=" + answers[questionId] + "]").prop("checked", true)

            $("#next").click(function() {
                loadQuestion($(this).data('question-id'))
            })

            $("#prev").click(function() {
                loadQuestion($(this).data('question-id'))
            })

            $("#finish").click(function() {
                $("#end").click()
            })

            $("input[name=answer]").change(function() {
                const value = $(this).val()
                console.log(value)
                answers[currentQuestion] = value
                saveLocalStorage(answers, 'answers')
                syncNavigationIndicator();
            })
        }

        function parseLocalStorage(key) {
            if (!localStorage.getItem(key)) return null
            return JSON.parse(localStorage.getItem(key))
        }

        function saveLocalStorage(value, key) {
            localStorage.setItem(key, JSON.stringify(value))
        }

        function syncNavigationIndicator() {
            $(".number").removeClass("btn-success").addClass("btn-light")
            Object.keys(answers).forEach(questionId => {
                $(".number[data-question-id=" + questionId + "]").removeClass("btn-light").addClass("btn-success")
                $("[name='answers[" + questionId + "]']").val(answers[questionId])
            })
        }

        function disableAnswer() {
            $("[name=answer]").prop("disabled", true)
        }
    })
</script>

@endsection