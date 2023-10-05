<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Area;
use Livewire\Attributes\Rule;

class ShopForm extends Form
{
    #[Rule('required', as: 'Shop Name')]
    public $shop_name = '';

    #[Rule('required', as: 'Shopkeeper Name')]
    public $shopkeeper_name = '';

    #[Rule('required', as: 'Shopkeeper Mobile')]
    #[Rule('size:11', message: 'Mobile number is incorrect. Its should be 11.')]
    public $shopkeeper_mobile = '';

    #[Rule('required', as: 'City')]
    public $city = '';

    #[Rule('required', as: 'Address')]
    public $address = '';

    #[Rule('required', as: 'Main Area')]
    public $main_area = '';

    #[Rule('required', as: 'Sub Area')]
    public $sub_area = '';

    #[Rule('required', as: 'Channel')]
    public $channel = '';

    #[Rule('required', as: 'Shop Type')]
    public $shop_type = '';

    #[Rule('required', as: 'Shop Sub Type')]
    public $shop_sub_type = '';

 
}
