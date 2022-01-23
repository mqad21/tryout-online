@include('homepage.layout.head')
@include('homepage.layout.header')

{{-- Konten Daftar Event. --}}
<section class="news-single program section pt-0 mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="single-main">
                            <div class="title">
                                <h3>Program Kerja</h3>
                                <h5 class="mt-3 text-primary">{{$program->division->name}}</h5>
                            </div>
                            <div class="single-widget recent-post p-4 my-4">
                                <div class="single-post">
                                   {!! $program->program !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                @include('homepage.program.widget')
            </div>
        </div>
    </div>
</section>

@section('script')

@endsection

@include('homepage.layout.footer')
@include('homepage.layout.foot')