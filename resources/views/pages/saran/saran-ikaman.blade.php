@extends('layout.app')

@section('title', 'Saran Ikaman')

@section('content')
    
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