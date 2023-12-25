<?php

namespace App\Livewire\Bills;

use PDF;
use Carbon\Carbon;
use App\Models\Bill;
// use Barryvdh\DomPDF\PDF;
use App\Models\Product;
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

    public $order_booker_bills = false;

    public $shop_bills = false;

    public $order_booker_id;

    public $shop_id;

    public $selected_bills = [0];

    public $booker;

    public $activeTab = 'all';

    private $billsList;

    public $billsCount = 0;

    
    public $search_period;
    
    public $from_date;

    public $to_date;

    protected function getBillsQuery()
    {
        $query = Bill::query()->with(['orderBooker', 'shop'])->orderBy('created_at', 'desc')
                    ->timePeriod($this->search_period, $this->from_date, $this->to_date);

        if ($this->order_booker_bills) {
            $query->where('order_booker_id', $this->order_booker_id);
        } elseif ($this->shop_bills) {
            $query->where('shop_id', $this->shop_id);
        }

        return $query;
    }

    public function mount()
    {
        $this->billsList = $this->getBillsQuery()->paginate(50);
    }

    public function render()
    {
        $this->refreshBills();

        $bills = $this->billsList;

        foreach ($bills as $bill) {

            $response = $bill->getProfit();
            $bill->profitLoss = $response['totalProfitLoss'];

            $to = Carbon::createFromFormat('Y-m-d H:i:s', $bill->created_at);
            $from = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
            $diff_in_days = $to->diffInDays($from);
            if ($diff_in_days >= 14 & !$bill->is_recovered) {
                $bill->recover_bill = true;
            } else {
                $bill->recover_bill = false;
            }
            $bill->diff_in_days = $diff_in_days;
        }

        return view('livewire.bills.bills', [
            'bills' => $bills,
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

        if ($bill->previous_bill_id) {
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
        $billEntries = $this->bill->billEntries;

        foreach ($billEntries as $entry) {
            
            Product::returnStock($entry->toArray());
            
        }

        $this->bill->delete();

        $this->bill = new Bill();

        $this->dispatch('closeModal');
    }

    public function dailySalesReport()
    {
        $bills = Bill::find($this->selected_bills);
        $billEntries = [];
        foreach ($bills as $bill) {
            foreach ($bill->billEntries as $be) {
                $billEntry = [];
                $billEntry['name'] = '';
                if($be->product != null)
                    $billEntry['name'] = $be->product->name;
                
                $billEntry['no_of_cottons'] = $be->no_of_cottons;
                $billEntry['no_of_pieces'] = $be->no_of_pieces;
                $billEntries[] = $billEntry;
            }
        }

        $collection = collect($billEntries);

        $summary = $collection->groupBy('name')
            ->map(function ($items, $name) {
                return [
                    'name' => $name,
                    'total_no_of_cottons' => $items->sum('no_of_cottons'),
                    'total_no_of_pieces' => $items->sum('no_of_pieces'),
                ];
            });

        $overallTotalCottons = $summary->sum('total_no_of_cottons');
        $overallTotalPieces = $summary->sum('total_no_of_pieces');

        $date = Carbon::today()->format('Y-m-d');

        $data = [
            'summary' => $summary,
            'overallTotalCottons' => $overallTotalCottons,
            'overallTotalPieces' => $overallTotalPieces,
            'booker' => $this->booker->name,
        ];

        $pdf = PDF::loadView('bills.dialy-sales-report', $data);

        $filename = 'summary_' . $this->booker->name . '_' . $date . '.pdf';
        $path = storage_path('app/public/' . $filename);
        $pdf->save($path);

        $link = asset('storage/' . $filename);

        return redirect()->to($link);

        return $pdf->stream('summary_' . $this->booker->name . '_' . $date . '.pdf');
    }

    public function refreshBills()
    {
        if($this->activeTab == 'all') $this->allBills();
        else if($this->activeTab == 'pending') $this->pendingBills();
        else if($this->activeTab == 'delayed') $this->delayedBills();
        else if($this->activeTab == 'completed') $this->completedBills();
    }

    public function allBills()
    {
        $this->activeTab = 'all';
            
        $this->billsList = $this->getBillsQuery()->paginate(50);
            
        $this->billsCount = $this->getBillsQuery()->count();
    }

    public function pendingBills()
    {
        $this->activeTab = 'pending';

        $this->billsList = $this->getBillsQuery()->where('is_recovered', 0)->paginate(50);

        $this->billsCount = $this->getBillsQuery()->where('is_recovered', 0)->count();
    }

    public function delayedBills()
    {
        $this->activeTab = 'delayed';

        $twoWeeksAgo = Carbon::now()->subWeeks(2);

        $this->billsList = $this->getBillsQuery()->where('is_recovered', 0)->where('created_at', '<', $twoWeeksAgo)->paginate(50);

        $this->billsCount = $this->getBillsQuery()->where('is_recovered', 0)->where('created_at', '<', $twoWeeksAgo)->count();
    }

    public function completedBills()
    {
        $this->activeTab = 'completed';

        $this->billsList = $this->getBillsQuery()->where('is_recovered', 1)->paginate(50);

        $this->billsCount = $this->getBillsQuery()->where('is_recovered', 1)->count();
    }

    

    public function filter()
    {
        
    }
}
