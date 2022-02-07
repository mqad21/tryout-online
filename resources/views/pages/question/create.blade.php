@extends('layout.app')

@section('title', 'Tambah Soal')


@section('content')

@if($errors->any())
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul class="text-danger pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('question.index') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar Soal</a>
    </div>
</div>

<form method="post" action="{{ isset($question) ? route('question.update', $question) : route('question.store') }}">
    @csrf
    @isset($question)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-body">
                    <div class="form-row mb-4">

                        <div class="col-12 mb-3">
                            <label for="question_category">Kategori Soal</label>
                            <select required class="form-control" name="question_category_id" id="question_category">
                                <option selected disabled>Pilih Kategori Soal</option>
                                @foreach($questionCategories as $category)
                                    <option {{ (old('question_category_id') ?? $question->question_category_id ?? '') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="question">Pertanyaan</label>
                            <textarea class="form-control" id="question" name="question" required value="{{ old('question') ?? $question->question ?? "" }}">{{ old('question') ?? $question->question ?? "" }}</textarea>
                        </div>

                        <div id="options-container" class="col-12"></div>

                        <div class="col-12 mb-3">
                            <div class="btn btn-sm btn-outline-primary px-4 mr-2" onclick="addOption()">Tambah Opsi <i class="fa fa-plus ml-2"></i></div>
                            <div class="btn btn-sm btn-outline-secondary px-4" onclick="addOption(-1)">Hapus Opsi <i class="fa fa-minus ml-2"></i></div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="explanation">Pembahasan</label>
                            <textarea name="explanation" id="explanation">{{ old('explanation') ?? $question->explanation ?? "" }}</textarea>
                        </div>

                        <div class="col-auto ml-auto">
                            <input type="submit" value="Simpan" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script src="{{ asset('assets_/assets/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace('question');
    CKEDITOR.inline('explanation');

    @if(isset($questionOptions))
    var options = @json($questionOptions)
    @else
    var options = [{
            value: '',
            score: ''
        },
        {
            value: '',
            score: ''
        },
        {
            value: '',
            score: ''
        },
        {
            value: '',
            score: ''
        },
    ];
    @endif

    const htmlOption = (index, optionValue = '', optionScore = '') => {
        const option = String.fromCharCode(97 + index).toUpperCase()
        return `
    <div class="row mb-4">
        <div class="col-auto">
            Opsi ${option}
        </div>
        <div class="col">
            <textarea name="options[${index}][option]" rows="1" class="form-control" id="option${index}">${optionValue}</textarea>
        </div>
        <div class="col-auto">
            <input name="options[${index}][score]" type="number" required placeholder="Skor Opsi ${option}" class="form-control" value="${optionScore}">
        </div>
    </div>
    `
    }

    function loadOptions() {
        options.forEach((option, index) => {
            $("#options-container").append(htmlOption(index, option.value, option.score))
            CKEDITOR.inline('option' + index)
        })
    }

    function addOption(val) {
        if (val === -1) {
            $("#options-container").children().last().remove()
        } else {
            const index = $("#options-container").children().length()
            $("#options-container").append(htmlOption(index))
            CKEDITOR.inline('option' + index)
        }
    }

    loadOptions();
</script>
@endsection