<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class Shops extends Component
{
    use WithPagination;
    
    public $search = '';

    public Shop $shopObj;

    public function selectShop(Shop $shop)
    {
        $this->shopObj = $shop;
    }

    public function deleteShop()
    { 
        $this->shopObj->delete(); 

        $this->dispatch('closeModal'); 
    }

    public function render()
    {        
        // $shops = Shop::where('shop_name','LIKE', "%".$this->search."%")
        //             ->orWhere('address','LIKE', "%".$this->search."%")
        //             ->orWhere('shopkeeper_name','LIKE', "%".$this->search."%")
        //             ->orWhere('shopkeeper_mobile','LIKE', "%".$this->search."%")
        //             ->paginate(20);

        // $shopsCount = Shop::where('shop_name','LIKE', "%".$this->search."%")
        //             ->orWhere('address','LIKE', "%".$this->search."%")
        //             ->orWhere('shopkeeper_name','LIKE', "%".$this->search."%")
        //             ->orWhere('shopkeeper_mobile','LIKE', "%".$this->search."%")
        //             ->count();

        // Base query with shared conditions
        $baseQuery = Shop::where('shop_name', 'LIKE', "%" . $this->search . "%")
                    ->orWhere('address', 'LIKE', "%" . $this->search . "%")
                    ->orWhere('shopkeeper_name', 'LIKE', "%" . $this->search . "%")
                    ->orWhere('shopkeeper_mobile', 'LIKE', "%" . $this->search . "%");

        // Get paginated results
        $shops = (clone $baseQuery)->paginate(20);

        // Get count
        $shopsCount = $baseQuery->count();


        return view('livewire.shop.shops',[
            'shops' => $shops,
            'shopsCount' => $shopsCount,
        ]);
    }
}
