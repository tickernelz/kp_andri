<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;

    public $label;

    public $classes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $classes)
    {
        $this->label = $label ?? '';
        $this->name = $name ?? '';
        $this->classes = $classes ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
