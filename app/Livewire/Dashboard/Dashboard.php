<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Product;
use App\Models\BillEntry;
use Livewire\Attributes\On; 

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
        
        $this->processData();
    }
 
     

    public function filter()
    {
        $this->bills = Bill::timePeriod($this->search_period, $this->from_date, $this->to_date)->get();
        
        $this->processData();

        $this->dispatch('ordersChartupdate',[
            'statistics' => $this->statistics
        ]);

        $this->dispatch('paymentsChartupdate',[
            'statistics' => $this->statistics
        ]);
    }

    private function processData()
    {
        $this->statistics['ordersCount'] = $this->bills->count(); 

        $this->statistics['recoveredOrdersCount'] = $this->bills->filter(function ($bill) {
            return $bill->is_recovered;
        })->count();

        $this->statistics['pendingOrdersCount'] = $this->bills->filter(function ($bill) {
            return !$bill->is_recovered;
        })->count();

        $this->statistics['totalPendingAmount'] = $this->bills->sum('final_price') - $this->bills->sum('recovered_amount');
        $this->statistics['totalOrderedAmount'] = $this->bills->sum('final_price');
        $this->statistics['totalRecoveredAmount'] = $this->bills->sum('recovered_amount');
        
        $this->bills->load('billEntries');

        $data = [];

        foreach ($this->bills as $bill) $data[] = $bill->getProfit();
          
        $collection = collect($data);
        $this->statistics['totalBuyAmount'] = $collection->sum('totalBuyAmount');
        $this->statistics['totalSellAmount'] = $collection->sum('totalSellAmount');
        $this->statistics['totalProfit'] = $collection->sum('totalProfitLoss');
        
        $this->statistics['totalPendingAmount_format'] = number_format($this->statistics['totalPendingAmount'], 0, '');
        $this->statistics['totalOrderedAmount_format'] = number_format($this->bills->sum('final_price'), 0, '');
        $this->statistics['totalRecoveredAmount_format'] = number_format($this->bills->sum('recovered_amount'), 0, '');
        $this->statistics['totalBuyAmount_format'] = number_format($collection->sum('totalBuyAmount'), 0, '');
        $this->statistics['totalSellAmount_format'] = number_format($collection->sum('totalSellAmount'), 0, '');
        $this->statistics['totalProfit_format'] = number_format($collection->sum('totalProfitLoss'), 0, '');

    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }


}
