<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toolbar extends Component
{
    public $items;
    public $btnClass = ['new' => 'btn-success', 'delete' => 'btn-danger'];


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toolbar');
    }
}
