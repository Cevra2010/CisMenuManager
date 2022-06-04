<?php
namespace CisFoundation\CisMenuManager;

use CisFoundation\MenuManager\Exception\MenuNotFoundException;
use Illuminate\Support\Collection;

/**
 * CisMenuManager is the base entrypoint for managing CisFoundation backend menus and menu entries
 */
class MenuManager {

    /**
     * Collection of menu object instances
     *
     * @var Collection
     */
    protected static $menuColleciton;

    /**
     * Initialisation of menu
     *
     * @return void
     */
    public static function boot() {
        self::$menuColleciton = collect();
    }

    /**
     * Registration of an new menu
     *
     * @param [string] $menuSlug
     * @return Menu
     */
    public static function registerMenu($menuSlug) {
        $menu = new Menu($menuSlug);
        self::$menuColleciton->add($menu);
        return $menu;
    }

    /**
     * Return a menu object
     *
     * @param string $menuSlug
     * @return Menu
     */
    public static function get($menuSlug) {
        if(!$menu = self::$menuColleciton->where('slug',$menuSlug)->first()) {
            throw new MenuNotFoundException('Menu "'.$menuSlug.'" not found.');
        }
        return $menu;
    }
}
