<?php

namespace App\Livewire\Shop;

use App\Models\Area;
use App\Models\Shop;
use Livewire\Component;
use App\Models\ShopType;
use App\Livewire\Forms\ShopForm;

class ShopCreate extends Component
{    
    public ShopForm $form; 

    public Area $area;

    public ShopType $shopType;

    public $areas = []; 

    public $subAreas = [];
    
    public $shopTypes = []; 
    
    public $subTypes = []; 

    public function save()
    {
        $validated = $this->validate(); 

        Shop::create($this->form->all());

        return redirect()->route('shops.index');
    }
 

    public function updated($field, $value)
    { 
        if ($field == 'form.main_area') { 
            $area = Area::with('subAreas')->find($this->form->main_area);
            $this->subAreas = [];
            foreach ($area->subAreas as $sa) {
                $this->subAreas[] = $sa;
            } 
        } else if($field == 'form.shop_type'){
            $sto = ShopType::with('subShopTypes')->find($this->form->shop_type);
            $this->subTypes = [];
            foreach ($sto->subShopTypes as $sa) {
                $this->subTypes[] = $sa;
            } 
        }
    }
    

    public function render()
    {
        $this->areas = Area::all();
        
        $this->shopTypes = ShopType::all();

        
        return view('livewire.shop.shop-create');
    }
}
