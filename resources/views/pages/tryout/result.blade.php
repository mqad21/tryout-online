@extends('layout.app')

@section('title', 'Hasil ' . $tryout->name)

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-card card">
            <div class="card-body">
                <table class="table" id="result-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Nama</th>
                            @foreach($tryout->categories as $category)
                                <th>{{ $category->name }}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        const categories = @json($tryout->categories);

        $('#result-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: @json(route('tryout.result.json', encrypt($tryout->id))),
            columns: [{
                    data: 'rank',
                    name: 'rank',
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                ...categories.map(category => ({
                    data: 'score.' + category.name,
                    name: 'score.' + category.name,
                    className: 'text-right'
                })),
                {
                    data: 'score_sum',
                    name: 'score_sum',
                    className: 'text-right'
                },
            ]
        });
    })
</script>
@endsection