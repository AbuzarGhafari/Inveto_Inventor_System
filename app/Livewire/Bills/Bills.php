<?php

namespace App\Livewire\Bills;

use Carbon\Carbon;
use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class Bills extends Component
{
    use WithPagination;
    
    public $search = '';

    public Bill $bill;

    public $recovery_amount = 0;

    public $bill_number;

    public $order_booker;

    public $bill_amount;

    public $recovered_amount;

    public $is_previous_bill;

    public $previous_bill_amount = 0;

    public $remaining_amount;
    
    public function render()
    {
        $bills = Bill::with(['orderBooker'])->where('bill_number','LIKE', "%".$this->search."%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);

        foreach ($bills as $bill) {

            $response = $bill->getProfit();
            $bill->profitLoss = $response['totalProfitLoss'];
            

            $to = Carbon::createFromFormat('Y-m-d H:i:s', $bill->created_at);
            $from = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
            $diff_in_days = $to->diffInDays($from);
            if($diff_in_days >= 14 & !$bill->is_recovered){
                $bill->recover_bill = true;
            }else{
                $bill->recover_bill = false;
            }
            $bill->diff_in_days = $diff_in_days;
        }

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

        if($bill->previous_bill_id){
            $this->is_previous_bill = true;
            $this->previous_bill_amount = $bill->previous_bill_amount;
        }
    }

    public function addRecovery()
    {
        $this->bill->recovered_amount = $this->bill->recovered_amount + $this->recovery_amount;

        $this->bill->save(); 

        $this->recovery_amount = 0;

        $this->dispatch('closeModal'); 
    }

    public function fullyRecovered()
    {
        $this->bill->recovered_amount = $this->bill->final_price + $this->bill->previous_bill_amount;

        $this->bill->is_recovered = true;

        $this->bill->save();

        $this->bill = new Bill();

        $this->recovery_amount = 0;

        $this->dispatch('closeModal'); 

    }

    public function deleteBill()
    {
        $this->bill->delete(); 
        $this->bill = new Bill();

        $this->dispatch('closeModal'); 
    }
}
