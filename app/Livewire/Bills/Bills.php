<?php

namespace App\Livewire\Bills;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class Bills extends Component
{
    use WithPagination;
    
    public $search = '';
    
    public function render()
    {
        $bills = Bill::with(['orderBooker'])->where('bill_number','LIKE', "%".$this->search."%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('livewire.bills.bills',[
            'bills' => $bills
        ]);
    }
}
