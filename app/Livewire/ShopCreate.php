<?php

namespace App\Livewire;

use App\Models\Shop;
use Livewire\Component;

class ShopCreate extends Component
{    
    public $shop_name = '';

    public $shopkeeper_name = '';

    public $shopkeeper_mobile = '';

    public $city = '';

    public $address = '';

    public $route_main_area = '';

    public $location_sub_area = '';

    public $channel = '';

    public $shop_type = '';

    public $shop_sub_type = '';

    public function save()
    {
        $validated = $this->validate();

        Shop::create($validated);

        return redirect()->route('shops.index');
    }
   
    public function rules(): array
    {
        return [
            'shop_name' => 'required',
            'shopkeeper_name' => 'required',
            'shopkeeper_mobile' => 'required',
            'city' => 'required',
            'address' => 'required',
            'route_main_area' => 'required',
            'location_sub_area' => 'required',
            'channel' => 'required',
            'shop_type' => 'required',
            'shop_sub_type' => 'required',
        ];
    }


    public function render()
    {
        return view('livewire.shop.shop-create');
    }
}
