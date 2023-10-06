<?php

namespace App\Livewire\Shoptypes;

use App\Models\Area;
use App\Models\ShopType;
use Livewire\Component; 
use App\Models\ShopSubType;
use Livewire\Attributes\Rule;

class ShopSubTypes extends Component
{
    #[Rule('required', as: 'Sub Area Name')]
    #[Rule('unique:shop_sub_types')]
    public $name = ''; 
  
    public ShopType $shopType;
  
    public $shop_id = 0;

    public $sub_shop_id = 0;
  

    public function mount(ShopType $shopType)
    {
        $this->shopType = $shopType;
        $this->shop_id = $shopType->id;
    }

    public function refresh()
    { 
        $this->shopType = ShopType::find($this->shop_id);
    }
 
    public function addNewSubShopType()
    { 
        $validated = $this->validate();

        ShopSubType::create($validated + ['shop_type_id' => $this->shopType->id]);

        $this->refresh();

        $this->name = '';

        $this->dispatch('closeModal'); 
    }

    
    public function selectSubShopType(ShopSubType $shopType)
    {          
        $this->sub_shop_id = $shopType->id;

        $this->name = $shopType->name;    
    }

    
    public function updateSubShopType()
    { 
        $validated = $this->validate();

        $sa = ShopSubType::find($this->sub_shop_id);

        $sa->update($validated);

        $this->name = ''; 
        
        $this->refresh();

        $this->dispatch('closeModal'); 
    }
    
    public function deleteSubShopType()
    {   
        ShopSubType::find($this->sub_shop_id)->delete();

        $this->refresh(); 

        $this->dispatch('closeModal'); 
    }

    public function render()
    {
        return view('livewire.shoptypes.subshoptype');
    }
}
