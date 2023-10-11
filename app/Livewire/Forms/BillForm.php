<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Area;
use App\Models\OrderBooker;
use Livewire\Attributes\Rule;
use Illuminate\Support\Collection;

class BillForm extends Form
{
    public $bill_number = '';

    #[Rule('required', as: 'Order Booker')]
    public $order_booker_id = '';

    #[Rule('required', as: 'Main Area')]
    public $main_area_id = '';

    #[Rule('required', as: 'Sub Area')]
    public $sub_area_id = '';

    #[Rule('required', as: 'Shop')]
    public $shop_id = '';

    public $status = '0';

    public $actual_price = 0;

    public $discount = 0;

    public $final_price = 0;

    public $recovered_amount = 0;

    public $is_recovered = false;
     

}
