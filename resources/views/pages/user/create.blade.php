@extends('layout.app')

@section('title', 'Tambah Pengguna')

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

<form method="post" action="{{ isset($user) ? route('user.update', $user) : route('user.store') }}">
    @csrf
    @isset($user)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-body">

                    <div class="mb-3">

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="name">Nama</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name" name="name" required max="255" value="{{ old('name') ?? $user->name ?? "" }}">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="email">Email</label>
                            <div class="input-group col-md-10">
                                <input type="text" class="form-control" id="email" name="email" required max="255" value="{{ old('email') ?? $user->email ?? "" }}">
                            </div>
                        </div>

                        @if(!isset($user))
                            <div class="form-group row mb-3">
                                <label class="col-md-2" for="password">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="password" name="password" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-2" for="password_confirmation">Konfirmasi Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="password" name="password_confirmation" />
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="region_id">Asal Wilayah</label>
                            <div class="col-md-10">
                                <select required class="form-control" name="region_id" id="region_id">
                                    <option selected disabled>Pilih Wilayah</option>
                                    @foreach($regions as $region)
                                        <option {{ (old('region_id') ?? $user->region_id ?? '') == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-2" for="role_id">Role</label>
                            <div class="col-md-10">
                                <select required class="form-control" name="role_id" id="role_id">
                                    <option selected disabled>Pilih Role</option>
                                    @foreach($roles as $role)
                                        <option {{ (old('role_id') ?? $user->role_id ?? '') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
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