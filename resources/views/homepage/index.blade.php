@include('homepage.layout.head')

@include('homepage.layout.header')

<!-- Slider Area -->
<section class="slider">
    <div class="hero-slider">
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('{{ asset('assets/img/slider-1.jpg') }}')">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-7 my-auto">
                        <div class="text">
                            <h1><span>IKAMAN 1 Medan,</span> Wadah Silaturahmi Seluruh <span>Alumni!</span></h1>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
                            <div class="button">
                                <a href="#statistics" class="btn">Lihat Selengkapnya</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('{{ ('assets/img/slider-2.jpg') }}')">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-7 my-auto">
                        <div class="text">
                            <h1><span>IKAMAN 1 Medan,</span> Tempat Berkumpul Seluruh <span>Alumni!</span></h1>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
                            <div class="button">
                                <a href="#statistics" class="btn">Lihat Selengkapnya</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start End Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('{{ asset('assets/img/slider-3.jpg') }}')">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-lg-7 my-auto">
                        <div class="text">
                            <h1><span>IKAMAN 1 Medan,</span> Media Penghubung Seluruh <span>Alumni!</span></h1>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl pellentesque, faucibus libero eu, gravida quam. </p>
                            <div class="button">
                                <a href="#statistics" class="btn">Lihat Selengkapnya</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
    </div>
</section>
<!--/ End Slider Area -->

<!-- Start Fun-facts -->
<div id="statistics" class="fun-facts section overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont-graduate-alt"></i>
                    <div class="content">
                        <span class="counter">{{ $alumni }}</span>
                        <p>Alumni Terdaftar </p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont-business-man"></i>
                    <div class="content">
                        <span class="counter">99</span>
                        <p>Pengurus Besar</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont-users-social"></i>
                    <div class="content">
                        <span class="counter">8</span>
                        <p>Bidang Pengurus</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont-institution"></i>
                    <div class="content">
                        <span class="counter">1</span>
                        <p>Almamater - MAN 1 MEDAN</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
        </div>
    </div>
</div>
<!--/ End Fun-facts -->

<!-- Start Blog Area -->
<section class="blog section" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Ikuti Berita Kegiatan Terbaru Kami.</h2>
                    <p>Lihat berita kegiatan terupdate kami disini</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($news as $news)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Blog -->
                    <div class="single-news">
                        <div class="news-head">
                            <img src="{{ $news->featured_image }}" alt="#">
                        </div>
                        <div class="news-body">
                            <div class="news-content">
                                <div class="date">{{ $news->formatted_date }}</div>
                                <h2><a href="{{ $news->url }}">{{ $news->title }}</a></h2>
                                <p class="text">{{ $news->truncated_body }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <a href="{{ url('berita') }}" class="btn primary mt-4 text-white">Lihat Berita Selengkapnya</a>
        </div>
    </div>
</section>
<!-- End Blog Area -->

<!-- Start portfolio -->
<section class="portfolio section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Delapan Bidang IKAMAN 1 Medan.</h2>
                    <p>Kunjungi lebih lanjut untuk melihat kegiatan dan program kerja bidang tertentu</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="owl-carousel portfolio-slider">
                    @foreach($programs as $program)
                        <div class="single-pf">
                            <img src="{{ asset('assets/img/bidang-' . $program->id . '.jpg') }}" alt="#">
                            <a href="{{ url('/program/'.$program->id)}}" class="btn">Program Kerja</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End portfolio -->

<!-- Start Call to action -->
<section class="call-action overlay" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="content">
                    <h2>Ada kendala dalam login Portal?</h2>
                    <p>Hubungi kami atau bisa lihat Frequently Asked Question</p>
                    <div class="button">
                        <a target="__blank" href="https://wa.me/6281260743660" class="btn"><i class="fa fa-whatsapp mr-2"></i> Hubungi Sekarang</a>
                        <a href="{{ url('faq') }}" class="btn second"><i class="fa fa-question-circle mr-2"></i>FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Call to action -->

<!-- Start Appointment -->
<section class="appointment">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Saran, Masukan, Pertanyaan Untuk IKAMAN 1 Medan.</h2>
                    <p>Silakan isi form di bawah ini untuk memberikan saran, masukan, pertanyaan pada IKAMAN 1 Medan.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12 col-12">
                @if (Session::has('alert'))
                    <div class="alert alert-success text-center alert-saran">
                        Terima kasih atas saran, masukan, dan pertanyaan untuk IKAMAN 1 Medan.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close ml-2"></i></span>
                          </button>
                    </div>
                @else
                <form class="form" action="{{url('/saran')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input name="name" type="text" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input name="email" type="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input name="phone" type="text" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <select class="nice-select form-control wide mb-0" name="type">
                                    <option value="Alumni">Alumni</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Umum">Umum</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <textarea name="message" placeholder="Tulis Pesan Anda Disini....."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="form-group">
                                <div class="button">
                                    <button type="submit" class="btn">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End Appointment -->

@include('homepage.layout.footer')

@include('homepage.layout.foot')