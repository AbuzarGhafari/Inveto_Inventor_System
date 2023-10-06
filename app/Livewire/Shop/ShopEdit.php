<?php

namespace App\Livewire\Shop;

use App\Models\Area;
use App\Models\Shop; 
use Livewire\Component;
use App\Livewire\Forms\ShopForm;

class ShopEdit extends Component
{
    public Shop $shop;

    public ShopForm $form; 

    public Area $area;

    public $areas = []; 
    
    public $subAreas = [];


    public function mount(Shop $shop)
    {
        $this->shop = $shop;
        $this->form->shop_name = $shop->shop_name;
        $this->form->shopkeeper_name = $shop->shopkeeper_name;
        $this->form->shopkeeper_mobile = $shop->shopkeeper_mobile;
        $this->form->city = $shop->city;
        $this->form->address = $shop->address;
        $this->form->channel = $shop->channel;
        $this->form->shop_type = $shop->shop_type;
        $this->form->shop_sub_type = $shop->shop_sub_type;
        if(isset($shop->area))
            $this->form->main_area = $shop->area->id;
        if(isset($shop->subarea))
            $this->form->sub_area = $shop->subarea->id;
        $this->loadSubAreas();
    }

    public function save()
    {
        $validated = $this->validate();

        $this->shop->update($this->form->all());

        return redirect()->route('shops.index');
    }

    public function updated($field, $value)
    { 
        if ($field == 'form.main_area') { 
            $this->loadSubAreas();
        }
    }

    public function loadSubAreas()
    {
        $area = Area::with('subAreas')->find($this->form->main_area);
        $this->subAreas = [];
        if(isset($area->subAreas))
            foreach ($area->subAreas as $sa) {
                $this->subAreas[] = $sa;
            } 
    }
    
    public function render()
    {
        $this->areas = Area::all();
        return view('livewire.shop.shop-edit');
    }
}
