@extends('layout.app')

@section('title', 'Buat Event')


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
        <a href="{{ url('/event') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar Event</a>
    </div>
</div>

<form method="post" enctype="multipart/form-data">
    @csrf
    <div class="row" id="create-event">
        <div class="col-md-8">
            <div class="main-card card">
                <div class="card-body">
                    <div class="form-row mb-4">
                        <div class="col-12">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required max="255" value="{{ old('title') ?? $event->title ?? "" }}">
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-md-6">
                            <label for="start_date">Tanggal Mulai</label>
                            <input required class="form-control" name="start_date" id="start_date" type="datetime-local" value="{{old('start_date') ?? $event->readable_start_date ?? ''}}"/>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">Tanggal Selesai</label>
                            <input class="form-control" name="end_date" id="end_date" type="datetime-local" value="{{old('end_date') ?? $event->readable_end_date ?? ''}}"/>
                            <small>Opsional</small>
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col-md-12">
                            <label for="place">Tempat</label>
                            <input class="form-control" name="place" id="place" type="text" value="{{ old('place') ?? $event->place ?? ""}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12 mb-4">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description">{{ old('description') ?? $event->description ?? '' }}</textarea>
                            <small>Opsional</small>
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
                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="main-card card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-12 mb-4">
                                    <label for="poster_file">Poster</label>
                                    <img id="poster" class="w-100 mb-2" src="{{ $event->poster_url ?? asset('assets_/assets/images/no-image.png') }}" alt="gambar-depan" />
                                    <input type="file" name="poster_file" id="poster_file" {{ $event->poster_url ?? 'required' }} />
                                    <small>Opsional</small>
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
        $('#description').summernote({
            lang: 'id-ID',
            height: 100
        });

        $('[data-toggle=dropdown]').dropdown();

        // Gambar.
        $('#poster_file').change(function() {
            const input = this;
            const url = $(this).val();
            const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('#poster').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

    });
</script>
@endsection