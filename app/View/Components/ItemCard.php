<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemCard extends Component
{
    public $item;
    public $basketItems;

    public function __construct($item, $basketItems = [])
    {
        $this->item = $item;
        $this->basketItems = $basketItems;
    }

    public function render()
    {
        return view('components.dk.item-card');
    }
}
