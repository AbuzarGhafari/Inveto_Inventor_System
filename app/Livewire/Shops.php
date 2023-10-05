<?php

namespace App\Livewire;

use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class Shops extends Component
{
    use WithPagination;
    
    public $search = '';

    public function render()
    {        
        $shops = Shop::where('shop_name','LIKE', "%".$this->search."%")
                    ->orWhere('address','LIKE', "%".$this->search."%")
                    ->orWhere('shopkeeper_name','LIKE', "%".$this->search."%")
                    ->orWhere('shopkeeper_mobile','LIKE', "%".$this->search."%")
                    ->paginate(10);

        return view('livewire.shop.shops',[
            'shops' => $shops
        ]);
    }
}
