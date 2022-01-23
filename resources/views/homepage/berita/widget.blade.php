<div class="main-sidebar">
    <!-- Single Widget -->
    <div class="single-widget search">
        <div class="form">
            <form action="{{ url('berita') }}">
                <input value="{{ request()->get('q') }}" name="q" type="text" placeholder="Cari di sini...">
                <button type="submit" class="button" href="#"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <!--/ End Single Widget -->

    <!-- Single Widget -->
    <div class="single-widget recent-post">
        <h3 class="title">Berita Populer</h3>
        @foreach($popular_news as $news)
            <!-- Single Post -->
            <div class="single-post">
                <div class="image">
                    <img class="thumbnail" src="{{$news->featured_image}}" alt="#">
                </div>
                <div class="content">
                    <h5><a href="{{$news->url}}">{{$news->title}}</a></h5>
                    <ul class="comment">
                        <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$news->formatted_date}}</li>
                        <li><i class="fa fa-eye" aria-hidden="true"></i>{{$news->view_count}}</li>
                    </ul>
                </div>
            </div>
            <!-- End Single Post -->
        @endforeach
    </div>

    <!--/ End Single Widget -->
</div>