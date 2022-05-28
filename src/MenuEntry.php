<?php
namespace CisFoundation\MenuManager;

use CisFoundation\MenuManager\Exception\MenuRouteNotExistsException;
use Illuminate\Support\Facades\Route;

class MenuEntry {

    public $slug;
    public $text;
    public $route;
    public $routeParameters;
    public $url;
    public $openInNewWindow = false;
    public $type;
    public $parent_slug;
    public $menu;
    public $icon;

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
    public function setRoute($route, $routeParameters = []) {
        $this->route = $route;
        $this->routeParameters = $routeParameters;
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

    public function setIcon($icon) {
        $this->icon = $icon;
        return $this;
    }

    public function isCurrent() : bool {
        if(Route::current()->getName() == $this->route) {
            return true;
        }
        return false;
    }

    public function getUrl() {
        if(isset($this->url)) {
            return $this->url;
        }
        elseif(isset($this->route)) {


            if(!Route::has($this->route)) {
                throw new MenuRouteNotExistsException("The route '".$this->route."' did not exist.");
            }

            if(count($this->routeParameters)) {
                return route($this->route,$this->routeParameters);
            }
            else {
                return route($this->route);
            }
        }
        else {
            return "#";
        }
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
