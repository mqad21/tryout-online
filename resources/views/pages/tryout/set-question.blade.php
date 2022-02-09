@extends('layout.app')

@section('title', 'Atur Soal Try Out')

@section('link')
@endsection

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
        <a href="{{ route('tryout.index') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar Try Out</a>
    </div>
</div>

<form method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="main-card card mb-4">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama Try Out</th>
                            <td>{{$tryout->name}}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>{{$tryout->duration}} Menit</td>
                        </tr>
                        <tr>
                            <th>Rentang Waktu</th>
                            <td>{{$tryout->range}}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp. {{$tryout->price}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="main-card card">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="mb-4">
                            <label for="questions">Cari Soal</label>
                            <input id="questions" class="form-control autocomplete" type="text" data-url="{{ route('question.search') }}" autocomplete="off">
                        </div>

                        <hr class="pt-4 mb-0">

                        <ol id="selected-question" class="mb-4">

                        </ol>

                        <div class="col-12 px-0 text-right">
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
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@master/dist/latest/bootstrap-autocomplete.min.js"></script>
<script>
    var questions = [];
    @isset($tryout)
    questions = @json($tryout->questions);
    @endisset

    $(document).ready(function() {
        questions.forEach(question => setQuestion(question))

        $('.autocomplete').autoComplete({
            bootstrapVersion: '4',
            minLength: 3
        })

        $('#selected-question').sortable()

        $('.autocomplete').on('autocomplete.select', function(e, item) {
            setQuestion(item.value)
            $(".autocomplete").val("")
        })

    })

    function setQuestion(question) {
        $("#selected-question").append(`
            <li class="mb-3">
                <div class="row pr-4">
                    <div class="border border-rounded p-3 col px-0">${question.question}</div>
                    <div class="col-auto px-0"><button class="btn btn-light btn-delete"><i class="fa fa-trash text-danger"></i></button></div>
                </div>
                <input name="questions[]" type="hidden" value="${question.id}"/>
            </li>
        `)
        $(".btn-delete").click(function(){
            $(this).parents("li").remove();
        });
    }
</script>
@endsection