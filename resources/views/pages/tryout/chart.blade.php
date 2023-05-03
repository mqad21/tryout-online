@extends('layout.app')

@section('title', 'Grafik Hasil TryOut')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-card card">
                <div class="card-body">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var ctx = document.getElementById("chart").getContext("2d");

            var data = {
                labels: @json($labels),
                datasets: @json($datasets)
                // datasets: [{
                //         label: "Blue",
                //         backgroundColor: "blue",
                //         data: [3, 7, 4]
                //     },
                //     {
                //         label: "Red",
                //         backgroundColor: "red",
                //         data: [4, 3, 5]
                //     },
                //     {
                //         label: "Green",
                //         backgroundColor: "green",
                //         data: [7, 2, 6]
                //     }
                // ]
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        })
    </script>
@endsection
