@include('homepage.layout.head')
@include('homepage.layout.header')

{{-- Konten Daftar Berita. --}}
<!-- Single News -->
<section class="news-single section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 order-last order-lg-first">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="single-main">
                            <h3 class="title">Daftar Berita</h3>
                            @if (request()->get('q'))
                                <p class="mt-1 font-italic">Menampilkan berita dengan kata kunci "{{request()->get('q')}}"</p>
                            @endif
                        </div>
                        <div class="single-main">
                            @if (!sizeof($news))
                               <p class="font-italic">Berita tidak ditemukan</p> 
                            @endif
                            @foreach($news as $_news)
                                <div class="single-widget recent-post p-4 my-4">
                                    <!-- Single Post -->
                                    <div class="single-post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="image">
                                                    <img class="thumbnail" src="{{ $_news->featured_image }}" alt="0">
                                                </div>
                                            </div>
                                            <div class="col-md-8 mt-4 mt-md-0">
                                                <div class="content">
                                                    <h5><a href="{{ $_news->url }}">{{ $_news->title }}</a></h5>
                                                    <ul class="comment list-inline mt-2">
                                                        <li class="list-inline-item"><i class="fa fa-calendar mr-2" aria-hidden="true"></i>{{ $_news->formatted_date }}</li>
                                                        <li class="list-inline-item"><i class="fa fa-eye mr-2" aria-hidden="true"></i>{{$_news->view_count}}</li>
                                                    </ul>
                                                    <p>
                                                        {{$_news->truncated_body}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Post -->
                                </div>
                                @if (!$loop->last)
                                <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-auto">
                        {{ $news->links('pagination.news') }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 order-first order-lg-last">
                @include('homepage.berita.widget', ['hide_recent' => true])
            </div>
        </div>
    </div>
</section>
<!--/ End Single News -->


@include('homepage.layout.footer')
@include('homepage.layout.foot')