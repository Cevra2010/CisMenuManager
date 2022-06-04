<?php
namespace CisFoundation\CisMenuManager;

use CisFoundation\MenuManager\Exception\MenuRouteNotExistsException;
use CisFoundation\MenuManager\MenuEntry as MenuManagerMenuEntry;
use Illuminate\Support\Facades\Route;

class MenuEntry {

    /**
     * Slug of entry
     *
     * @var string
     */
    public $slug;

    /**
     * Text if entry
     *
     * @var string
     */
    public $text;

    /**
     * Laravel route of entry
     *
     * @var string
     */
    public $route;

    /**
     * Route parameters for laravel route
     *
     * @var array
     */
    public $routeParameters;

    /**
     * Url of entry
     *
     * @var string
     */
    public $url;

    /**
     * Toggle the _blank parameter true or false for html link
     *
     * @var boolean
     */
    public $openInNewWindow = false;

    /**
     * Type of link
     *
     * @var string
     */
    public $type;

    /**
     * Slug of parent entry
     *
     * @var string
     */
    public $parent_slug;

    /**
     * Name of the menu slug
     *
     * @var string
     */
    public $menu;

    /**
     * Name of fontawesome icon
     *
     * @var string
     */
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

    /**
     * Set the menu entry icon
     *
     * @param string $icon
     * @return MenuEntry
     */
    public function setIcon($icon) {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Returns whether the current entry is the active entry
     *
     * @return boolean
     */
    public function isCurrent() : bool {
        if(Route::current()->getName() == $this->route) {
            return true;
        }
        return false;
    }

    /**
     * Get the URI of the entry
     *
     * @return string
     */
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
