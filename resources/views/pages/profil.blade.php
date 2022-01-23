@extends('layout.app')

@section('title', 'Profil Pribadi')

@section('content')


<div class="main-card mb-3 card" id="profile-card">
    <div class="card-body">
        <form method="POST" action="">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Alamat Email</label>
                                <input type="email" class="form-control disabled" id="email" disabled value="{{ old('email') ?? $user->email }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="region">Asal Daerah</label>
                                <select class="form-control" name="region_id" id="region">
                                    <option selected disabled>Pilih Asal Daerah</option>
                                    @foreach($regions as $region)
                                        <option {{ $user->region_id == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-auto">
                    <button class="btn btn-lg btn-secondary" type="submit" name="submit" value="cancel">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection