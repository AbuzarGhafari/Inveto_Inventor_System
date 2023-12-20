<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Product;
use App\Models\BillEntry;

class Dashboard extends Component
{
    public $statistics;

    public $search_period;
    
    public $from_date;

    public $to_date;

    public $bills;


    public function mount()
    {
        $this->statistics = [];
        
        $this->bills = Bill::currentMonth()->get();
    }

    public function filter()
    {
        $this->bills = Bill::timePeriod($this->search_period, $this->from_date, $this->to_date)->get();
    }

    public function render()
    {
        
        $this->statistics['ordersCount'] = $this->bills->count(); 

        $this->statistics['recoveredOrdersCount'] = $this->bills->filter(function ($bill) {
            return $bill->is_recovered;
        })->count();

        $this->statistics['pendingOrdersCount'] = $this->bills->filter(function ($bill) {
            return !$bill->is_recovered;
        })->count();

        $this->statistics['totalOrderedAmount'] = number_format($this->bills->sum('final_price'), 0, '');

        $this->statistics['totalRecoveredAmount'] = number_format($this->bills->sum('recovered_amount'), 0, '');

        
        $this->bills->load('billEntries');

        $data = [];

        foreach ($this->bills as $bill) {
             
            $data[] = $bill->getProfit();
         
        }
          
        $collection = collect($data);

        $this->statistics['totalBuyAmount'] = number_format($collection->sum('totalBuyAmount'), 0, '');
        $this->statistics['totalSellAmount'] = number_format($collection->sum('totalSellAmount'), 0, '');
        $this->statistics['totalProfit'] = number_format($collection->sum('totalProfitLoss'), 0, '');
        
 
        return view('livewire.dashboard.dashboard');
    }


}
