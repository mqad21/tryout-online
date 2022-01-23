@extends('layout.auth')

@section('content')
<div class="container login vw-100">
    <div class="row vh-100">
        <div class="col m-auto">
            <div class="row">
                <div class="col-12">
                    <img class="logo" src="{{asset('assets/img/logo.png')}}" alt="logo-ikaman" />
                </div>
                <h1 class="w-100"><strong>Daftar Portal</strong><br />Ikaman 1 Medan</h1>
            </div>
            <div class="row text-left">
                <div class="col-md-7 m-auto">
                    <div class="main-card mb-3 card">
                        <div class="card-body text-center">
                           <p>Selamat, Anda telah terdaftar di Portal Ikaman 1 Medan! Silakan cek email Anda untuk melakukan verifikasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection