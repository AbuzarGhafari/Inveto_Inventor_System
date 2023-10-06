<?php

namespace App\Livewire\Shop;

use App\Models\Area;
use App\Models\Shop;
use Livewire\Component;
use App\Livewire\Forms\ShopForm;

class ShopCreate extends Component
{    
    public ShopForm $form; 

    public Area $area;

    public $areas = []; 
    
    public $subAreas = [];

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
        }
    }
    

    public function render()
    {
        $this->areas = Area::all();
        
        return view('livewire.shop.shop-create');
    }
}
