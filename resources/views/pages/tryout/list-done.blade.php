@extends('layout.app')

@section('title', 'Hasil & Pembahasan')

@section('content')

<div class="row">
    <div class="col-md-12">

        @if ($testIsEmpty)
            <div class="alert alert-info">
                <p class="text-muted font-italic">Kamu belum mengerjakan Try Out. <a href="{{ route('tryout.do') }}" class="ml-2 btn btn-sm btn-primary">Kerjakan Try Out</a></p>
            </div>
        @else
        <div class="main-card card">
            <div class="card-body">
                {{$dataTable->table()}}
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

@section('script')
    {{$dataTable->scripts()}}
@endsection