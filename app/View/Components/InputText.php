<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputText extends Component
{
    public $type;

    public $name;

    public $value;

    public $label;

    public $classes;

    public $form;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $value, $label, $classes, $form)
    {
        $this->label = $label ?? '';
        $this->name = $name ?? '';
        $this->form = $form ?? '';
        $this->value = $value ?? '';
        $this->type = $type ?? 'text';
        $this->classes = $classes ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-text');
    }
}
