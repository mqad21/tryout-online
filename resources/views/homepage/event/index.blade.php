@include('homepage.layout.head')
@include('homepage.layout.header')

{{-- Konten Daftar Event. --}}
<section class="event section pt-0">
    <div class="container mt-4">
        <div class="row title">
            <div class="col-12">
                <h3 class="text-center font-weight-bold">Daftar Event<span class="text-primary">.</span></h3>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (!$events->count())
                <p class="text-center font-italic">Belum ada event</p>     
            @endif
            @foreach($events as $event)
                <div class="col-lg-4 col-12 mb-4 mb-md-0">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$event->title}}</h5>
                        </div>
                        <div class="card-body p-0">
                            <img data-enlargeable style="cursor: zoom-in" src="{{$event->poster_url}}" />
                        </div>
                        <div class="card-footer">
                            <table>
                                <tr>
                                    <td class="text-center"><i class="fa fa-calendar"></i></td>
                                    <td>{{$event->full_date}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-clock-o"></i></td>
                                    <td>{{$event->full_time}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa fa-map-marker"></i></td>
                                    <td>{{$event->place}}</td>
                                </tr>
                            </table>
                            <div class="description">
                                <div class="mt-4 short_description">
                                    {!! $event->description_sort !!}
                                    <span class="text-primary cursor-pointer toggle">Lihat selengkapnya</span>
                                </div>
                                <div class="mt-4 long_description d-none">
                                    {!! $event->description !!}
                                    <span class="text-primary cursor-pointer toggle">Lihat lebih sedikit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                {{ $events->links('pagination.news') }}
            </div>
        </div>
    </div>
</section>

@section('script')
    <script>
        $(".description span.toggle").click(function(){
            $(this).parents('.description').children('.long_description').toggleClass('d-none');
            $(this).parents('.description').children('.short_description').toggleClass('d-none');
        });
    </script>
@endsection

@include('homepage.layout.footer')
@include('homepage.layout.foot')