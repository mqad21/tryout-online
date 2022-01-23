@extends('layout.app')

@section('title', 'Manajemen Pengguna')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-card card">
            <div class="card-body">
                <div class="table-responsive">
                <a href="{{url('/pengguna/kartu')}}" class="btn btn-primary mb-4"><i class="fa fa-download mr-2"></i>Unduh Kartu Alumni</a>
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{{ $dataTable->scripts() }}
@endsection