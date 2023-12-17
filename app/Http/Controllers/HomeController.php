<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Product;
use App\Models\BillEntry;
use Illuminate\Http\Request; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
        // Set the timezone to Pakistan's timezone
        Carbon::setLocale('Asia/Karachi');
  

        if ($request->isMethod('post')) {

            $period = $request->input('period'); // 'last-week', 'last-month', 'all-time', or 'custom'
            $fromDate = $request->input('from_date'); // required if period is 'custom'
            $toDate = $request->input('to_date'); // required if period is 'custom'
            
            $bills = Bill::timePeriod($period, $fromDate, $toDate)->get();

            
            $period = Bill::getPeriod($period, $fromDate, $toDate);
        }else{

            $startOfCurrentMonth = Carbon::now('Asia/Karachi')->startOfMonth();

            $bills = Bill::where('created_at', '>=', $startOfCurrentMonth)->get();

            $period = 'This Month.';
        }
 
 
 
        $ordersCount = $bills->count(); 

        // Count recovered bills
        $recoveredOrdersCount = $bills->filter(function ($bill) {
            return $bill->is_recovered;
        })->count();

        // Count pending bills
        $pendingOrdersCount = $bills->filter(function ($bill) {
            return !$bill->is_recovered;
        })->count();
 
        $totalOrderedAmount = $bills->sum('final_price');

        $totalOrderedAmount = number_format($totalOrderedAmount, 0, '');

        $totalRecoveredAmount = $bills->sum('recovered_amount');

        $totalRecoveredAmount = number_format($totalRecoveredAmount, 0, '');
 
        $bills->load('billEntries');

        $data = [];

        foreach ($bills as $bill) {
             
            $data[] = $bill->getProfit();
         
        }
          
        $collection = collect($data);

        $totalBuyAmount = $collection->sum('totalBuyAmount');
        $totalSellAmount = $collection->sum('totalSellAmount');
        $totalProfit = $collection->sum('totalProfitLoss');

        $totalBuyAmount = number_format($totalBuyAmount, 0, '');
        $totalSellAmount = number_format($totalSellAmount, 0, '');
        $totalProfit = number_format($totalProfit, 0, '');

        
        return view('welcome', compact(
            'ordersCount', 
            'pendingOrdersCount', 
            'recoveredOrdersCount', 
            'totalOrderedAmount',
            'totalRecoveredAmount',
            'totalBuyAmount',
            'totalSellAmount',
            'totalProfit',
            'period'
        ));
    }

    public function test()
    {
        return view('test');
    }
}
