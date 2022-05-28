<?php
namespace CisFoundation\MenuManager;

use CisFoundation\MenuManager\Exception\MenuViewNotFoundException;
use Illuminate\Support\Facades\View;

class Menu {

    public $slug;
    public $template;
    protected $entryCollection;

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

    public function setTemplatePath($templatePath) {
        if(!View::exists($templatePath.".menu")) {
            throw new MenuViewNotFoundException('Menu view "'.$templatePath.'menu'.'" not found.');
        }

        $this->template = $templatePath;
        return $this;
    }

    public function getTemplate() {
        return $this->template.".menu";
    }

    public function finalize() {
        return $this;
    }

    public function getParentEntries()
    {
        return $this->entryCollection->where('parent_slug',null);
    }

    public function getChildEntries($parentSlug) {
        return $this->entryCollection->where('parent_slug',$parentSlug);
    }

}
