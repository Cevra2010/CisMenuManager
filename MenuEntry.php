<?php
namespace CisExt\MenuManager;

use Illuminate\Routing\Route;

class MenuEntry {

    public $slug;
    public $text;
    public $route;
    public $url;
    public $openInNewWindow = false;
    public $type;
    public $parent_slug;
    public $menu;

    /**
     * Initialize a new menu entry
     *
     * @param string $slug
     */
    public function __construct($slug,$menu)
    {
        $this->slug = $slug;
        $this->menu = $menu;
        return $this;
    }

    /**
     * Set text of menu entry
     *
     * @param string $text
     * @return MenuEntry
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * Set menu entry parent entry by slug
     *
     * @param string $parent_slug
     * @return MenuEntry
     */
    public function setParent($parent_slug)
    {
        $this->parent_slug = $parent_slug;
        return $this;
    }

    /**
     * Set the route of the menu entry
     *
     * @param string $route
     * @return MenuEntry
     */
    public function setRoute($route) {
        $this->route = $route;
        return $this;
    }

    /**
     * Set the url of the menu entry
     *
     * @param string $url
     * @return MenuEntry
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    /**
     * Set the option to open the link as _blank
     *
     * @param boolean $newWindow
     * @return MenuEntry
     */
    public function setNewWindow($newWindow)
    {
        $this->openInNewWindow = $newWindow;
        return $this;
    }
}
