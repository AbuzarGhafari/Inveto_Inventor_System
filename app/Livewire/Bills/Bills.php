<?php

namespace App\Livewire\Bills;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class Bills extends Component
{
    use WithPagination;
    
    public $search = '';

    public Bill $bill;

    public $recovery_amount;

    public $bill_number;

    public $order_booker;

    public $bill_amount;

    public $recovered_amount;

    public $remaining_amount;
    
    public function render()
    {
        $bills = Bill::with(['orderBooker'])->where('bill_number','LIKE', "%".$this->search."%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('livewire.bills.bills',[
            'bills' => $bills
        ]);
    }

    public function selectBill(Bill $bill)
    {
        $this->bill = $bill;
        $this->bill_number = $bill->bill_number;
        $this->order_booker = $bill->orderBooker->name;
        $this->bill_amount = $bill->final_price;
        $this->recovered_amount = $bill->recovered_amount;
        $this->remaining_amount = $bill->final_price - $bill->recovered_amount;
    }

    public function addRecovery()
    {
        $this->bill->recovered_amount = $this->bill->recovered_amount + $this->recovery_amount;

        $this->bill->save(); 

        $this->recovery_amount = '';

        $this->dispatch('closeModal'); 
    }

    public function fullyRecovered()
    {
        $this->bill->recovered_amount = $this->bill->final_price;

        $this->bill->is_recovered = true;

        $this->bill->save();

        $this->bill = new Bill();

        $this->recovery_amount = '';

        $this->dispatch('closeModal'); 

    }
}
