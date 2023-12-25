<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectDynamic extends Component
{
    public $id;
    public $label;
    public $name;
    public $items;
    public $value;
    public $attrs;
    public $class;
    public $isCanEmptyVal;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $id = null, string $label = "", $items = [], $value=null, array $attrs = [], string $class = "", bool $isCanEmptyVal = false)
    {
        $this->id = $id ?? $name;
        $this->label = $label;
        $this->name = $name;
        $this->items = $items;
        $this->value = $value;
        $this->attrs = $attrs;
        $this->class = $class;
        $this->isCanEmptyVal = $isCanEmptyVal;
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
        $isCanEmptyVal = $this->isCanEmptyVal;
        return view('components.forms.select-dynamic', compact('id', 'name', 'label', 'items', 'value', 'attrs', 'class', 'isCanEmptyVal'));
    }
}
