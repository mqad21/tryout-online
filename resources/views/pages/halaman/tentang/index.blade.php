@extends('layout.app')

@section('title', 'Halaman Tentang')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-card card">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="accordion" id="accordionPage">
                        @foreach($pages as $page)
                            <div class="row" id="row{{ $page->id }}">
                                <div class="col">
                                    <div class="px-4 py-2" id="heading{{ $page->id }}">
                                        <h2 class="mb-0">
                                            <div class="w-100" data-toggle="collapse" data-target="#page{{ $page->id }}" aria-controls="page{{ $page->id }}">
                                                <input required name="page[{{$page->id}}][title]" type="text" class="form-control" data-toggle="collapse" data-target="#page{{ $page->id }}" aria-expanded="true" aria-controls="page{{ $page->id }}" value="{{ $page->title }}">
                                            </div>
                                        </h2>
                                    </div>
                                    <div id="page{{ $page->id }}" class="collapse" aria-labelledby="heading{{ $page->id }}" data-parent="#accordionPage">
                                        <div class="card-body">
                                            <textarea required class="content" name="page[{{$page->id}}][content]" cols="30" rows="10">
                                            {{ $page->content }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto my-auto pl-0">
                                    <div class="btn pa-0" onclick="deletePage('#row' + {{ $page->id }})">
                                        <i class="text-danger fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row my-4 justify-content-center">
                        <div class="col col-auto mb-2">
                            <div onclick="addPage()" class="btn btn-circle btn-lg"><i class="fa fa-2x fa-plus"></i></div>
                        </div>
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
    let index = @json($pages->count());
    $(document).ready(function() {
        $('textarea.content').summernote({
            lang: 'id-ID',
            height: 300
        });
    });


    function addPage() {
        index++;
        const accordion = `
        <div>
            <div class="px-4 py-2" id="heading">
                <h2 class="mb-0">
                    <div class="w-100" data-toggle="collapse" data-target="#page${index}" aria-controls="page${index}">
                        <input required name="page[${index}][title]" type="text" class="form-control" data-toggle="collapse" data-target="#page${index}" aria-expanded="true" aria-controls="page${index}" value="">
                    </div>
                </h2>
            </div>
            <div id="page${index}" class="collapse" aria-labelledby="heading${index}" data-parent="#accordionPage">
                <div class="card-body">
                    <textarea required class="content" name="page[${index}][content]" cols="30" rows="10">
                    </textarea>
                </div>
            </div>
        </div>
        `
        $("#accordionPage").append(accordion);
        $('textarea.content').summernote({
            lang: 'id-ID',
            height: 300
        });
    }

    function deletePage(selector) {
        $(selector).remove();
    }
</script>
@endsection