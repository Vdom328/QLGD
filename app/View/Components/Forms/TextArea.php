<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    public $id;
    public $label;
    public $name;
    public $placeholder;
    public $value;
    public $class;
    public $attrs;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $id = "", string $label = "", string $placeholder = "", string $value = "", string $class = "",  array $attrs = [])
    {
        $this->id = $id ?? $name;
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->class = $class;
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
        $label = $this->label;
        $name = $this->name;
        $placeholder = $this->placeholder;
        $value = $this->value;
        $class = $this->class;
        $attrs = $this->attrs;
        return view('components.forms.text-area', compact('id', 'name', 'label', 'placeholder', 'value', 'class', 'attrs'));
    }
}
