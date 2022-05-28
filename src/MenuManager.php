<?php
namespace CisFoundation\MenuManager;

use CisFoundation\MenuManager\Exception\MenuNotFoundException;

class MenuManager {

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
