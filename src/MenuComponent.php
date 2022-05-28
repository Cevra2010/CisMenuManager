<?php

namespace CisFoundation\MenuManager;

use Illuminate\View\Component;

/**
 * The view Component for accessing the Menu in Blade View
 */
class MenuComponent extends Component
{
    /**
     * Slug of the Menu
     *
     * @var string
     */
    protected $slug;


    /**
     * Register menu Slug
     *
     * @param string $slug
     */
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
