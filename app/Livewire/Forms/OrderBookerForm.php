<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\OrderBooker;
use Livewire\Attributes\Rule;

class OrderBookerForm extends Form
{
    #[Rule('required', as: 'Name')]
    #[Rule('min:3', message: 'This title is too short')]
    public $name = '';

    #[Rule('required', as: 'Mobile')]
    #[Rule('size:11', message: 'Mobile number is incorrect. Its should be 11.')]
    public $mobile = '';

    // #[Rule('required', as: 'Area')]
    // public $area_id = '';
 

    public function setOrderBooker(OrderBooker $orderBooker)
    {
        $this->name = $orderBooker->name;
        $this->mobile = $orderBooker->mobile;
        // $this->area_id = $orderBooker->area;
    }

}
