@extends('layout.app')

@section('title', 'Kerjakan Try Out')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="main-card card">
            <div class="card-body">
                <div class="row">
                    @foreach($tryouts as $tryout)
                        <div class="col-md-4">
                            <div class="card border shadow-none mb-2">
                                <div class="card-body">
                                    <h1 class="h5 mb-4">{{ $tryout->name }}</h1>
                                    <table class="table">
                                        <tr>
                                            <th>Durasi</th>
                                            <td>{{ $tryout->duration }} Menit</td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td>{{ $tryout->questions->pluck('category.name')->unique()->join(", ") }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Soal</th>
                                            <td>{{ $tryout->questions()->count() }} Soal</td>
                                        </tr>
                                    </table>

                                    <a href="{{ route('tryout.do', encrypt($tryout->id)) }}" class="btn btn-primary float-right">
                                        Kerjakan <i class="fa fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
