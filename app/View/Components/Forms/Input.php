<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $id;
    public $type;
    public $label;
    public $name;
    public $class;
    public $value;
    public $placeholder;
    public $items;
    public $attrs;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $id = null, string $label = "", string $type="text", string $class = "", ?string $value = null, string $placeholder = "", $items = [], array $attrs = [])
    {
        $this->id = $id ?? $name;
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->items = $items;
        $this->attrs = $attrs;
    }

    /**
     * Get the view / contents that represent the component.
     * 
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        $id = $this->id;
        $type = $this->type;
        $label = $this->label;
        $name = $this->name;
        $class = $this->class;
        $value = $this->value;
        $placeholder = $this->placeholder;
        $items = $this->items;
        $attrs = $this->attrs;
        return view('components.forms.input', compact('id', 'type', 'name', 'label', 'class', 'value', 'placeholder', 'items', 'attrs'));
    }
}
