<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="{{asset('assets_/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head> --}}
<link href="{{ asset('assets_/assets/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets_/assets/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets_/assets/summernote/summernote.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets_/assets/datatables/datatables.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets_/main.css') }}" rel="stylesheet" />

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">