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
                        @foreach($faqs as $faq)
                            <div class="row" id="row{{ $faq->id }}">
                                <div class="col">
                                    <div class="px-4 py-2" id="heading{{ $faq->id }}">
                                        <h2 class="mb-0">
                                            <div class="w-100" data-toggle="collapse" data-target="#faq{{ $faq->id }}" aria-controls="faq{{ $faq->id }}">
                                                <input placeholder="Pertanyaan" required name="faq[{{$faq->id}}][question]" type="text" class="form-control" data-toggle="collapse" data-target="#faq{{ $faq->id }}" aria-expanded="true" aria-controls="faq{{ $faq->id }}" value="{{ $faq->question }}">
                                            </div>
                                        </h2>
                                    </div>
                                    <div id="faq{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionPage">
                                        <div class="card-body">
                                            <textarea required class="answer" name="faq[{{$faq->id}}][answer]" cols="30" rows="10">
                                            {{ $faq->answer }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto my-auto pl-0">
                                    <div class="btn pa-0" onclick="deletePage('#row' + {{ $faq->id }})">
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
    let index = @json($faqs->count());
    $(document).ready(function() {
        $('textarea.answer').summernote({
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
                    <div class="w-100"  data-toggle="collapse" data-target="#faq${index}" aria-controls="faq${index}">
                        <input required placeholder="Pertanyaan" name="faq[${index}][question]" type="text" class="form-control" data-toggle="collapse" data-target="#faq${index}" aria-expanded="true" aria-controls="faq${index}" value="">
                    </div>
                </h2>
            </div>
            <div id="faq${index}" class="collapse" aria-labelledby="heading${index}" data-parent="#accordionPage">
                <div class="card-body">
                    <textarea required class="answer" name="faq[${index}][answer]" cols="30" rows="10">
                    </textarea>
                </div>
            </div>
        </div>
        `
        $("#accordionPage").append(accordion);
        $('textarea.answer').summernote({
            lang: 'id-ID',
            height: 300
        });
    }

    function deletePage(selector) {
        $(selector).remove();
    }
</script>
@endsection