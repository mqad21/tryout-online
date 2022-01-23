@include('homepage.layout.head')
@include('homepage.layout.header')

<!-- Single News -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v10.0&appId=929118790756815&autoLogAppEvents=1" nonce="FWkNaQOW"></script>
<section class="news-single section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="single-main">
                            <!-- News Head -->
                            <div class="news-head">
                                <img src="{{ $news->featured_image }}" alt="#">
                            </div>
                            <!-- News Title -->
                            <h1 class="news-title"><a href="news-single.html">{{ $news->title }}</a></h1>
                            <!-- Meta -->
                            <div class="meta">
                                <div class="meta-left">
                                    <span class="date"><i class="fa fa-clock-o"></i>{{ $news->formatted_date }}</span>
                                </div>
                                <div class="meta-right">
                                    <span class="views"><i class="fa fa-eye"></i>{{ $news->view_count }} Tayangan</span>
                                </div>
                            </div>
                            <!-- News Text -->
                            <div class="news-text">
                                {!!$news->body!!}
                            </div>
                            <div class="blog-bottom">
                                <!-- Social Share -->
                                <ul class="social-share">
                                    @foreach($share_links as $key => $link)
                                        <li class="share-link {{ $key }}"><a href="{{ $link }}"><i class="fa fa-{{ $key }}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="single-main">
                            <div class="fb-comments" data-href="{{ request()->url() }}" data-width="100%" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                @include('homepage.berita.widget')
            </div>
        </div>
    </div>
</section>
<!--/ End Single News -->

@section('script')
<script>
    $(document).ready(function() {
        $(".share-link a").click(function(e) {
            e.preventDefault();
            const target = e.currentTarget.getAttribute('href');
            createPopupWin(target, 'share', 600, 600);
        })
    });
</script>
@endsection

@include('homepage.layout.footer')
@include('homepage.layout.foot')