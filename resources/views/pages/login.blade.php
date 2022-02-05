@extends('layout.auth')

@section('title', 'Login')

@include('layout.head')
<div class="container login vw-100">
    <div class="row vh-100 mt-4">
        <div class="col m-auto">
            <div class="row text-left">
                <div class="col-md-4 m-auto">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row text-center">
                                {{-- <div class="col-12">
                                    <img class="logo" src="{{ asset('assets/img/logo.png') }}" alt="logo-ikaman" />
                            </div> --}}
                            <h1 class="w-100 h5">Login ke <strong>{{ config('app.name') }}</strong></h1>
                        </div>
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <label for="email">Email</label>
                                    <input name="email" type="text" class="form-control" id="email" required maxlength="64" />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password">Password</label>
                                    <input name="password" type="password" class="form-control" id="password" required/>
                                    <p class="w-100 text-right mb-0 mt-2">
                                        <a class="mt-2" href="{{ url('/lupa-password') }}">Lupa Password?</a>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <ul class="text-danger pl-4">
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                            {{-- <a class="btn btn-login btn-lg btn-light btn-block" href="{{ url('/auth/google/redirect') }}">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2048px-Google_%22G%22_Logo.svg.png" style="max-width:18px" class="mr-2" alt="google">
                                Lanjutkan dengan Google</a>
                            <a class="btn btn-login btn-lg btn-light btn-block" href="{{ url('/auth/facebook/redirect') }}">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/1365px-Facebook_f_logo_%282019%29.svg.png" style="max-width:18px" class="mr-2" alt="facebook">
                                Lanjutkan dengan Facebook</a> --}}
                            <p class="text-center mt-2 w-100">Belum punya akun? <a href="{{ url('/daftar') }}">Daftar di sini</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@include('layout.foot')