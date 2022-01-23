@include('homepage.layout.head')
@include('homepage.layout.header')

{{-- Konten Daftar Berita. --}}
<!-- Single News -->
<section class="news-single section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="single-main">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($about_pages as $page)
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $page->title }}" data-toggle="pill" href="#pane-{{ $page->id }}" role="tab" aria-controls="{{ $page->title }}" aria-selected="true">{{ $page->title }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="single-main about">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="tab-content" id="v-pills-tabContent">
                                @foreach($about_pages as $page)
                                    <div class="tab-pane fade show {{$loop->first ? 'active' : ''}}" id="pane-{{$page->id}}" role="tabpanel" aria-labelledby="{{$page->title}}">
                                        <h1 class="font-weight-bold mb-4">{{$page->title}}<span class="text-primary">.</span></h1>
                                        {!!$page->content!!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Single News -->

@include('homepage.layout.footer')
@include('homepage.layout.foot')