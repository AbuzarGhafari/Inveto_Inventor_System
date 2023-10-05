<?php

namespace App\Livewire\Orderbooker;

use Livewire\Component;
use App\Models\OrderBooker;
use Livewire\WithPagination;

class OrderBookers extends Component
{
    use WithPagination;
    
    public $search = '';
    
    public function render()
    {
        $orderBookers = OrderBooker::where('name','LIKE', "%".$this->search."%")
                    ->orWhere('mobile','LIKE', "%".$this->search."%")
                    ->orWhere('area','LIKE', "%".$this->search."%")
                    ->paginate(10);
        return view('livewire.orderbooker.order-bookers',[
            'orderBookers' => $orderBookers
        ]);
    }
}
