<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends Component
{

    public $url;
    public $icon;
    public $title;
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $icon, $title, $route)
    {
        $this->url = $url;
        $this->icon = $icon;
        $this->title = $title;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-menu');
    }
}
