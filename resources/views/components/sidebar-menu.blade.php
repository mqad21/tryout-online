<li>
    <a href="{{$url}}" class="{{ request()->is($route) || request()->is($route . '/*') ? 'mm-active' : ''}}">
        <i class="metismenu-icon {{$icon}}"></i>
        {{$title}}
    </a>
</li>