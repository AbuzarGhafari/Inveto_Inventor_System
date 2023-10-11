<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $products = Product::all();
        $productsCount = $products->count();
        $totalStock = $products->sum('stock_quantity');

        $ordersCount = Bill::all()->count();
        $recoveredOrdersCount = Bill::recovered()->count();
        $pendingOrdersCount = Bill::pending()->count();

        $totalOrderedAmount = Bill::all()->sum('final_price');

        $totalOrderedAmount = number_format($totalOrderedAmount, 0, '');

        $totalRecoveredAmount = Bill::all()->sum('recovered_amount');

        $totalRecoveredAmount = number_format($totalRecoveredAmount, 0, '');

        $billEntries = BillEntry::all();

        // dd($billEntries);

        $totalBuyAmount = 0;
        $totalSellAmount = 0;

        $data = $billEntries->map(function($item, $key) use($totalBuyAmount, $totalSellAmount){
            $totalBuyAmount = ($item->product->distributor_prices * $item->no_of_cottons) + ($item->product->pack_size / $item->product->distributor_prices * $item->no_of_pieces);
             
            
            return [
                'totalBuyAmount' => $totalBuyAmount,
                'totalSellAmount' => $item->final_price
            ];
        });

        $totalBuyAmount = $data->sum('totalBuyAmount');
        $totalSellAmount = $data->sum('totalSellAmount');
        $totalProfit = $totalSellAmount - $totalBuyAmount;

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
            'totalProfit'
        ));
    }

    public function test()
    {
        return view('test');
    }
}
