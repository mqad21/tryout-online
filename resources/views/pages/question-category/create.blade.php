@extends('layout.app')

@section('title', 'Tambah Kategori Soal')


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
        <a href="{{ route('question-category.index') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar Kategori Soal</a>
    </div>
</div>

<form method="post" action="{{ isset($questionCategory) ? route('question-category.update', $questionCategory) : route('question-category.store') }}">
    @csrf
    @isset($questionCategory)
    @method('PUT')
    @endisset
    <div class="row" id="create-event">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-body">
                    <div class="form-row mb-4">
                        <div class="col-12 mb-3">
                            <label for="title">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" required max="255" value="{{ old('name') ?? $questionCategory->name ?? "" }}">
                        </div>
                        <div class="col-12">
                            <input type="submit" value="Simpan" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection