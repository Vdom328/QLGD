<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $id;
    public $label;
    public $name;
    public $items;
    public $value;
    public $attrs;
    public $class;
    public $labelClass;
    public $placeholder;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $id = null, string $label = "", $items = [], $value=null, array $attrs = [], string $class = "", string $labelClass="", string $placeholder=null)
    {
        $this->id = $id ?? $name;
        $this->label = $label;
        $this->name = $name;
        $this->items = $items;
        $this->value = $value;
        $this->attrs = $attrs;
        $this->class = $class;
        $this->labelClass = $labelClass;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        $id = $this->id;
        $label = $this->label;
        $name = $this->name;
        $items = $this->items;
        $value = $this->value;
        $attrs = $this->attrs;
        $class = $this->class;
        $labelClass = $this->labelClass;
        $placeholder = $this->placeholder;
        return view('components.forms.select', compact('id', 'name', 'label', 'items', 'value', 'attrs', 'class', 'labelClass', 'placeholder'));
    }
}
