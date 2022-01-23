@extends('layout.auth')

@section('content')
<div class="container login vw-100">
    <div class="row vh-100">
        <div class="col m-auto">
            <div class="row">
                <div class="col-12">
                    <img class="logo" src="{{asset('assets/img/logo.png')}}" alt="logo-ikaman" />
                </div>
                <h1 class="w-100"><strong>Lupa Password Portal</strong><br />Ikaman 1 Medan</h1>
            </div>
            <div class="row text-left">
                <div class="col-md-4 m-auto">
                    @if ($token)
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form action="{{url('/reset-password')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <input type="hidden" name="token" value="{{$token}}">
                                        <div class="col-12 mb-3">
                                            <label for="password">Password Baru</label>
                                            <input name="password" type="password" class="form-control" id="password" required minlength="8" maxlength="16"/>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="confirm-password">Konfirmasi Password Baru</label>
                                            <input name="confirm_password" type="password" class="form-control" id="confirm-password" required minlength="8" maxlength="16"/>
                                            <div class="feedback"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="text-danger pl-4">
                                            @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
                                </form>
                            </div>
                        </div>
                    @else
                        @if (!Session::has('forgot_password'))
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form action="{{url('/lupa-password')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-12 mb-3">
                                            <label for="email">Email</label>
                                            <input name="email" type="text" class="form-control" id="email" required
                                                maxlength="64" placeholder="Masukkan email akun Anda" />
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="text-danger pl-4">
                                            @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Lupa Password</button>
                                    <p class="text-center mt-2 w-100">Kembali ke <a
                                            href="{{url('/login')}}">login</a></p>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="main-card mb-3 card">
                            <div class="card-body text-center">
                                <p>Link untuk reset password Anda telah dikirim melalui email.</p>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
            $("input#confirm-password").on('input',function(){
                const val = $(this).val();
                if (val != $("input#password").val()) {
                    $(this).addClass('is-invalid')
                    .next('.feedback')
                    .addClass('invalid-feedback')
                    .text('Konfirmasi password tidak cocok');
                } else {
                    $(this).removeClass('is-invalid')
                    .next('.feedback')
                    .removeClass('invalid-feedback')
                    .text('');
                }
            });
        });
</script>
@endsection

@include('layout.foot')

