@include('layout.head')
@include('layout.header')

@include('layout.sidebar')

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        @yield('title')
                        <div class="page-title-subheading">
                            @yield('subtitle')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    @include('layout.footer')
    @include('layout.foot')