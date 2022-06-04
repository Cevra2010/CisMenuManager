<?php
namespace CisFoundation\CisMenuManager;

use CisFoundation\CisMenuManager\Exception\MenuViewNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

/**
 * Menu object
 */
class Menu {

    /**
     * Slug of the Menu
     *
     * @var string
     */
    public $slug;

    /**
     * Base Template view of the menu
     *
     * @var string
     */
     public $template;

    /**
     * Menu Entry collection
     *
     * @var Collection|null
     */
    protected $entryCollection;

    /**
     * Register a new menu instrance with his slug
     *
     * @param string $slug
     */
    public function __construct($slug)
    {
        $this->slug = $slug;
        $this->entryCollection = collect();
    }

    /**
     * register a new menu entry
     *
     * @param string $entrySlug
     * @return MenuEntry
     */
    public function registerEntry($entrySlug) {
        $entry = new MenuEntry($entrySlug,$this);
        $this->entryCollection->add($entry);
        return $entry;
    }

    /**
     * Set the path of the base menu view
     *
     * @param string $templatePath
     * @return void
     */
    public function setTemplatePath($templatePath) {
        if(!View::exists($templatePath.".menu")) {
            throw new MenuViewNotFoundException('Menu view "'.$templatePath.'menu'.'" not found.');
        }

        $this->template = $templatePath;
        return $this;
    }

    /**
     * Get the base template view
     *
     * @return string
     */
    public function getTemplate() {
        return $this->template.".menu";
    }

    /**
     * Makes final adjustments before returning the final instance.
     *
     * @return void
     */
    public function finalize() {
        return $this;
    }

    /**
     * Returns all parent elements
     *
     * @return Collection
     */
    public function getParentEntries()
    {
        return $this->entryCollection->where('parent_slug',null);
    }

    /**
     * Returns all child elements that match the given parent slug
     *
     * @param string $parentSlug
     * @return Collection
     */
    public function getChildEntries($parentSlug) {
        return $this->entryCollection->where('parent_slug',$parentSlug);
    }

}
