<?php

namespace App\Livewire\Shoptypes;

use App\Models\Area;
use App\Models\SubArea;
use Livewire\Component;
use App\Models\ShopType;
use Livewire\Attributes\Rule;

class ShopTypes extends Component
{
    #[Rule('required', as: 'Main Shop Type Name')]
    #[Rule('unique:shop_types')]
    public $name = '';
  
    public $search = '';

    public ShopType $shopType;

    public function render()
    {
        $shopTypes = ShopType::with('subShopTypes')->where('name','LIKE', "%".$this->search."%") 
                    ->paginate(50);
        return view('livewire.shoptypes.shoptypes',[
            'shopTypes' => $shopTypes
        ]);
    }

    public function addNewShopType()
    {
        $validated = $this->validate();

        ShopType::create($validated);

        $this->name = '';

        $this->dispatch('closeModal'); 
 
    }

    public function selectShopType(ShopType $shopType)
    {          
        $this->shopType = $shopType;
        $this->name = $shopType->name;    
    }
 

    public function updateShopType()
    { 
        $validated = $this->validate();

        $this->shopType->update($validated);

        $this->name = ''; 

        $this->dispatch('closeModal'); 
    }

    public function deleteShopType()
    {
        $this->shopType->delete();
        
        $this->name = ''; 

        $this->dispatch('closeModal'); 
    }

}
