<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;

    public $message;

    public $position;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $message, $position)
    {
        $this->type = $type;
        $this->message = $message;
        $this->position = $position;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
