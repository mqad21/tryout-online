<div id="chart_div" class="mb-4"></div>
<table class="table mt-4" id="table">
    @foreach($data as $row)
        @if($loop->first)
            <thead>
                <tr>
                    @foreach($row as $cell)
                        <th>{{ $cell }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
    @endforeach
    <tbody>
        @foreach($data as $row)
            @if(!$loop->first)
                <tr>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

<script>
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(draw);

    function draw() {
        const data = google.visualization.arrayToDataTable(@json($data));
        const options = @json($options);
        const chart = new google.visualization[@json($type)](document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>