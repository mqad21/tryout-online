		<!-- Header Area -->
		<header class="header">
		    <!-- Topbar -->
		    {{-- <div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="#">About</a></li>
								<li><a href="#">Alumni</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">FAQ</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+628 000 000</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:itsikaman@gmail.com">itsikaman@gmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div> --}}
		    <!-- End Topbar -->
		    <!-- Header Inner -->
		    <div class="header-inner">
		        <div class="container">
		            <div class="inner">
		                <div class="row">
		                    <div class="col-lg-3 col-md-3 col-12">
		                        <!-- Start Logo -->
		                        <div class="logo p-2">
		                            <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="logo-ikaman"></a>
		                        </div>
		                        <!-- End Logo -->
		                        <!-- Mobile Nav -->
		                        <div class="mobile-nav"></div>
		                        <!-- End Mobile Nav -->
		                    </div>
		                    <div class="col-lg-9 col-md-9 col-12">
		                        <!-- Main Menu -->
		                        <div class="main-menu">
		                            <nav class="navigation">
		                                <ul class="nav menu">
		                                    <li class="{{ request()->is('tentang') ? 'active' : '' }}"><a href="{{url('tentang')}}">Tentang </a></li>
		                                    <li class="{{ request()->is('berita') ? 'active' : '' }}"><a href="{{url('berita')}}">Berita </a></li>
		                                    <li class="{{ request()->is('event') ? 'active' : '' }}"><a href="{{url('event')}}">Event </a></li>
		                                    <li class="{{ request()->is('galeri') ? 'active' : '' }}"><a href="{{url('galeri')}}">Galeri </a></li>
		                                    <li class="{{ request()->is('scanner') ? 'active' : '' }}"><a href="{{url('scanner')}}">Scan Kartu Alumni </a></li>
		                                    <li>
		                                        @if(Auth::check())
		                                            <a href="{{ url('') }}" class="btn">
		                                                <img src="{{ Auth::user()->photo_url }}" class="rounded mr-2" width="30" alt="0">
		                                                {{ Auth::user()->short_name }}
		                                            </a>
		                                        @else
		                                            <a href="{{ url('') }}" class="btn">Daftar / Masuk</a>
		                                        @endif
		                                    </li>
		                                </ul>
		                            </nav>
		                        </div>
		                        <!--/ End Main Menu -->
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->