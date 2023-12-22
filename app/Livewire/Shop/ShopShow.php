<?php

namespace App\Livewire\Shop;

use Livewire\Component;

class ShopShow extends Component
{
    public $shop;

    public $detailsShown;

    public function mount()
    {
        $this->detailsShown = false;
    }

    public function toggleDetails()
    {
        $this->detailsShown = !$this->detailsShown;
    }

    public function render()
    {
        return view('livewire.shop.shop-show');
    }
}
