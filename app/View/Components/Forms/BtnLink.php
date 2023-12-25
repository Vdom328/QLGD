<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnLink extends Component
{
    public $id;
    public $type;
    public $class;
    public $text;
    public $name;
    public $attrs;
    public $href;
    public $isPopup;

    /**
     * Create a new component instance.
     */
    public function __construct(string $id="", string $type="submit", string $class = "", string $text = "", string $name = "", string $attrs="", string $href="", ?string $isPopup = null)
    {
        $this->id = $id;
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
        $this->name = $name;
        $this->attrs = $attrs;
        $this->href = $href;
        $this->isPopup = $isPopup;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $id = $this->id;
        $type = $this->type;
        $text = $this->text;
        $class = $this->class;
        $name = $this->name;
        $attrs = $this->attrs;
        $href = $this->href;
        $isPopup = $this->isPopup;
        return view('components.forms.btn-link', compact('id', 'type', 'name', 'class', 'text', 'attrs', 'href', 'isPopup'));
    }
}
