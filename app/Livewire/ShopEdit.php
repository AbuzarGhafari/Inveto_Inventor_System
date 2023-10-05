<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shop; 

class ShopEdit extends Component
{
    public Shop $shop;

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

    public function mount(Shop $shop)
    {
        $this->shop = $shop;
        $this->shop_name = $shop->shop_name;
        $this->shopkeeper_name = $shop->shopkeeper_name;
        $this->shopkeeper_mobile = $shop->shopkeeper_mobile;
        $this->city = $shop->city;
        $this->address = $shop->address;
        $this->route_main_area = $shop->route_main_area;
        $this->location_sub_area = $shop->location_sub_area;
        $this->channel = $shop->channel;
        $this->shop_type = $shop->shop_type;
        $this->shop_sub_type = $shop->shop_sub_type;
    }

    public function save()
    {
        $validated = $this->validate();

        $this->shop->update($validated);

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
        return view('livewire.shop.shop-edit');
    }
}
