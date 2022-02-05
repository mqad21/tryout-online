@extends('layout.app')

@section('title', 'Ganti Sandi Pengguna')

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
        <a href="{{ route('user.index') }}" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i>Daftar Pengguna</a>
    </div>
</div>

<form method="post" action="{{ route('user.change-password', $user) }}">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-body">

                    <div class="mb-3">

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="name">Nama</label>
                            <div class="col-md-10">
                                <input disabled type="text" class="form-control" id="name" name="name" required max="255" value="{{ old('name') ?? $user->name ?? "" }}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="password">Password Baru</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" name="password" />
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="password_confirmation">Konfirmasi Password Baru</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" name="password_confirmation" />
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