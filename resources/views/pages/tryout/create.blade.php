@extends('layout.app')

@section('title', 'Tambah Try Out')

@section('link')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
        <a href="{{ route('tryout.index') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar
            Try Out</a>
    </div>
</div>

<form method="post" action="{{ isset($tryout) ? route('tryout.update', $tryout) : route('tryout.store') }}">
    @csrf
    @isset($tryout)
    @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-body">

                    <div class="mb-3">

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="name">Nama Try Out</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name" name="name" required max="255"
                                    value="{{ old('name') ?? $tryout->name ?? "" }}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="duration">Durasi</label>
                            <div class="input-group col-md-10">
                                <input type="number" class="form-control" id="duration" name="duration" min="1" required
                                    value="{{ old('duration') ?? $tryout->duration ?? "" }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Menit</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="range">Rentang Waktu</label>
                            <div class="col-md-10">
                                <input class="input-range form-control" type="text" name="range"
                                    value="{{ old('duration') ?? $tryout->range ?? "" }}" />
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="price">Harga</label>
                            <div class="input-group col-md-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="price" name="price" required
                                    value="{{ old('price') ?? $tryout->price ?? "" }}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="show_try_out">Tampilkan Try Out</label>
                            <div class="input-group col-md-10">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="show_try_out"
                                        name="show_try_out" value="1" {{ (old('show_try_out') ?? $tryout->show_try_out ?? "0" ==
                                    "1") ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="show_try_out"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="show_explanation">Tampilkan Pembahasan</label>
                            <div class="input-group col-md-10">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="show_explanation"
                                        name="show_explanation" value="1" {{ (old('show_explanation') ?? $tryout->show_explanation ?? "0" ==
                                    "1") ? 'checked' : '' }}>
                                    <label class=" custom-control-label" for="show_explanation"></label>
                                </div>
                            </div>
                        </div>

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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(".input-range").daterangepicker({
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
</script>
@endsection