<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $id;
    public $type;
    public $class;
    public $text;
    public $name;
    public $attrs;
    public $dataTitle;
    public $dataMessage;
    public $dataAction;
    public $value;


    /**
     * Create a new component instance.
     */
    public function __construct(string $id="", string $type="submit", string $class = "", string $text = "", string $name = "", string $attrs="", string $dataTitle="", $dataAction, string $dataMessage="", string $value="")
    {
        $this->id = $id;
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
        $this->name = $name;
        $this->attrs = $attrs;
        $this->dataTitle = $dataTitle;
        $this->dataMessage = $dataMessage;
        $this->dataAction = $dataAction;
        $this->value = $value;
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
        $text = $this->text;
        $class = $this->class;
        $name = $this->name;
        $attrs = $this->attrs;
        $dataTitle = $this->dataTitle;
        $dataMessage = $this->dataMessage;
        $dataAction = $this->dataAction;
        $value = $this->value;
        return view('components.forms.button', compact('id', 'type', 'name', 'class', 'text', 'attrs', 'dataTitle', 'dataMessage','dataAction', 'value'));
    }
}
