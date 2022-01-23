<div class="app-header header-shadow">
    <div class="app-header__logo">
        <h1 class="h5">{{ config('app.name') }}</h1>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <div class="d-flex justify-content-end mr-2">
                                        <div class="widget-content-left text-right ml-3 header-user-info">
                                            <div class="widget-heading">
                                                {{ Auth::user()->name }}
                                            </div>
                                            <div class="widget-subheading">
                                                {{ Auth::user()->role->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="0" role="menu" class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ url('/profil') }}" class="dropdown-item">Profil</a>
                                    <button onclick="$('form#logout').submit()" type="button" tabindex="0" class="dropdown-item">Logout</button>
                                    <form id="logout" class="d-none" action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>