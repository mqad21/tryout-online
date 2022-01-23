@extends('layout.app')

@section('title', 'Statistik Alumni')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-card card">
            <div class="card-body">
                <div class="col-md-6 mb-4">
                    <label for="type">Jenis Statistik:</label>
                    <select name="type" id="type" class="form-control">
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="result-container" class="col">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
{{-- <script type="text/javascript" src="https:////cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}
<script>
    $(document).ready(function() {

        getGrafik($("#type").val());

        function getGrafik(type) {
            $.ajax({
                url: "{{ url('/grafik') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type
                },
                success: (result) => {
                    $("#result-container").html(result);
                    $("#table").DataTable({
                        dom: 'frBtip',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'
                        ]
                    });
                },
                error: e => console.error(e)
            })
        }

        $("#type").change(function() {
            const type = $(this).val();
            getGrafik(type);
        });

    });
</script>
@endsection