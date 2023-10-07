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


    public $status = '';

    public $actual_price = 0;

    public $discount = 0;

    public $final_price = 0;

    public $recovered_amount = '';

    public $is_recovered = '';


    // public Collection $inputs;

    // protected $rules = [
    //     'inputs.*.sku_code' => 'required',
    //     'inputs.*.no_of_cottons' => 'required',
    //     'inputs.*.no_of_pieces' => 'required',
    // ];
    
    // protected $messages = [
    //     'inputs.*.sku_code.required' => 'This SKU Code field is required.',
    //     'inputs.*.no_of_cottons.required' => 'This No. of Cottons field is required.',
    //     'inputs.*.no_of_pieces.required' => 'This No. of Pieces field is required.',
    // ];

}
