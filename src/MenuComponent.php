<?php

namespace CisFoundation\MenuManager;

use Illuminate\View\Component;

class MenuComponent extends Component
{
    protected $slug;


    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $menu = MenuManager::get($this->slug)->finalize();
        return view($menu->getTemplate(),[
            'menu' => $menu,
        ]);
    }
}
