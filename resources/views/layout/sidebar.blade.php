<div class="app-main">
    <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
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
        <div class="scrollbar-sidebar">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu pt-4">
                    <x-sidebar-menu title="Dasbor" url="{{url('')}}" icon="fa fa-home" route="/"/>
                    @php
                        $menus = collect(Config::get('menu'))->map(function($menu){
                            $menu['menu'] = collect($menu['menu'])->filter(function($item){
                                return in_array(Auth::user()->role_id, $item['role']);
                            })->all();
                            return $menu;
                        })->all();
                    @endphp
                    @foreach ($menus as $menu)
                        @if (count($menu['menu']) > 0)
                            <x-sidebar-menu-title title="{{$menu['title']}}"/>
                            @foreach ($menu['menu'] as $item)
                            <x-sidebar-menu title="{{$item['title']}}" route="{{ $item['route'] }}" url="{{url('/' . $item['url'])}}" icon="{{$item['icon']}}" />
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>