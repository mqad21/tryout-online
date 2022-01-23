@extends('layout.app')

@section('title', 'Buat Berita')


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
        <a href="{{ url('/berita') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar Berita</a>
    </div>
</div>

<form method="post" enctype="multipart/form-data">
    @csrf
    <div class="row" id="create-news">
        <div class="col-md-8">
            <div class="main-card card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-12 mb-4">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required max="255" value="{{ old('title') ?? $news->title ?? "" }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-4">
                            <label for="slug">Alamat</label>
                            <div class="input-group mb-3">
                                @if(!isset($news))
                                    <span class="input-group-text" id="slug_">{{ url('berita') }}/</span>
                                    <input type="text" class="form-control" id="slug" aria-describedby="slug_" name="slug" required value="{{ old('slug') ?? $news->slug ?? "" }}">
                                @else
                                    <input type="text" class="form-control" id="slug" aria-describedby="slug_" name="slug" required value="{{ url('berita') . '/' . $news->slug }}" disabled>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-4">
                            <label for="body">Konten</label>
                            <textarea name="body" id="body">{{ old('body') ?? $news->body ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="main-card card">
                        <div class="card-body">
                            <button class="btn btn-primary btn-block" type="submit" name="submit" value="publish">Terbitkan</button>
                            <div class="row mt-3">
                                @isset($news)
                                    @if(!$news->is_draft)
                                        <div class="col">
                                            <a href="{{ $news->url }}" class="btn btn-outline-light w-100">Pratayang</a>
                                        </div>
                                    @endif
                                @endisset
                                <div class="col">
                                    <button class="btn btn-light w-100" type="submit" name="submit" value="draft">Draf</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="main-card card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-12 mb-4">
                                    <label for="date">Tanggal Berita</label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" required value="{{ old('date') ?? $news->date ?? "" }}" />
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="featured_image_file">Gambar Depan</label>
                                    <img id="featured_image" class="w-100 mb-2" src="{{ $news->featured_image ?? asset('assets_/assets/images/no-image.png') }}" alt="gambar-depan" />
                                    <input type="file" name="featured_image_file" id="featured_image_file" {{ $news->featured_image ?? 'required' }} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#body').summernote({
            lang: 'id-ID',
            height: 300
        });

        $('.dropdown-toggle').dropdown();

        @if(!isset($news))
        // Auto slug.
        $("#title").on('input', function() {
            const slug = $(this).val()
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');

            $("#slug").val(slug);
        });
        @endif

        // Gambar.
        $('#featured_image_file').change(function() {
            const input = this;
            const url = $(this).val();
            const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('#featured_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

    });
</script>
@endsection