<div class="main-sidebar">

    <!-- Single Widget -->
    <div class="single-widget recent-post">
        <h3 class="title">Program Bidang Lain</h3>
        <table>
            @foreach($programs as $program)
                <tr style="vertical-align: top">
                    <td><i class="fa fa-caret-right mr-3"></i></td>
                    <td><a href="{{ url('program/' . $program->id) }}">{{$program->division->name}}</a></td>
                </tr>
            @endforeach
        </table>
    </div>

    <!--/ End Single Widget -->
</div>