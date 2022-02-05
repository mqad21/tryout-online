@extends('layout.auth')

@section('title', 'Daftar')

@section('content')
<div class="container login vw-100">
    <div class="row vh-100 mt-4">
        <div class="col m-auto">
            <div class="row">
                {{-- <div class="col-12">
                    <img class="logo" src="{{ asset('assets/img/logo.png') }}" alt="logo-ikaman" />
            </div> --}}
            <h1 class="w-100">Daftar ke <strong>{{ config('app.name') }}</strong></h1>
        </div>
        <div class="row text-left">
            <div class="col-md-7 m-auto">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form action="{{ url('/daftar') }}" method="POST">
                            @csrf
                            <div class="form-row mb-3">
                                <div class="col-12 mb-3">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" id="name" required maxlength="255" minlength="3" />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required maxlength="64" />
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="region">Asal Daerah</label>
                                    <select class="form-control" name="region_id" id="region">
                                        <option selected disabled>Pilih Asal Daerah</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required minlength="6" maxlength="16" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirm-password">Konfirmasi Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm-password" required minlength="6" maxlength="16" />
                                    <div class="feedback"></div>
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
                            <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit">Daftar</button>
                            {{-- <a class="btn btn-lg btn-light btn-block" onclick="loginOAuth(event)" target="{{ url('/auth/google/redirect') }}">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2048px-Google_%22G%22_Logo.svg.png" style="max-width:18px" class="mr-2" alt="google">
                            Daftar dengan Google</a>
                            <a class="btn btn-lg btn-light btn-block" onclick="loginOAuth(event)" target="{{ url('/auth/facebook/redirect') }}">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/1365px-Facebook_f_logo_%282019%29.svg.png" style="max-width:18px" class="mr-2" alt="facebook">
                                Daftar dengan Facebook</a> --}}
                            <p class="text-center mt-2 w-100">Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("input#confirm-password").on('input', function() {
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