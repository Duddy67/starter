<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemList extends Component
{
    public $columns;
    public $items;
    public $rows;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($columns, $rows, $items)
    {
        $this->columns = $columns;
        $this->items = $items;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-list');
    }
}
