@extends('layout.app')

@section('title', 'Dasbor')

@section('content')

    <div class="alert alert-success fade show" role="alert">
        <h6>{{ $greet }}, <strong>{{ Auth::user()->short_name }}!</strong></h6>
    </div>

@endsection