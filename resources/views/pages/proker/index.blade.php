@extends('layout.app')

@section('title', 'Halaman Program Kerja')

@php
    $length = $programs->count();
@endphp

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-card card">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    {{-- <div class="accordion" id="accordionPage"> --}}
                    <div id="accordion" class="accordion-wrapper mb-3">
                        @foreach($programs as $program)
                            <div class="card">
                                <div id="judul{{ $program->id }}" class="card-header">
                                    <button type="button" data-toggle="collapse" data-target="#collapse{{ $program->id }}" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                        <h5 class="m-0 p-0">{{ $program->division->name }}</h5>
                                    </button>
                                </div>
                                <div data-parent="#accordion" id="collapse{{ $program->id }}" aria-labelledby="judul{{ $program->id }}" class="collapse" style="">
                                    <textarea class="content" name="program[{{$program->id}}]" id="program" cols="30" rows="10">{{$program->program}}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- </div> --}}
                    <div class="row my-4 justify-content-center">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    let index = @json($length);
    $(document).ready(function() {
        $('textarea.content').summernote({
            lang: 'id-ID',
            height: 500
        });
    });
</script>
@endsection