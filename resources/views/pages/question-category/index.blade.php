@extends('layout.app')

@section('title', 'Daftar Kategori Soal')

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('question-category.create') }}" class="btn btn-primary mb-4"><i class="fa fa-plus mr-2"></i>Tambah Kategori Soal</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="main-card card">
                <div class="card-body">
                    {{$dataTable->table()}}
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    {{$dataTable->scripts()}}
@endsection