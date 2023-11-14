<?php

namespace App\Http\Controllers;

use PDF;
// use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\OrderBooker;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bills.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bills.create');
    }

    public function createBillWithPreviousBill(Bill $bill)
    {
        return view('bills.createBillWithPreviousBill', compact('bill'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        
        $response = $bill->getProfit();        

        $bill->totalBuyAmount = $response['totalBuyAmount'];
        $bill->totalSellAmount = $response['totalSellAmount'];
        $bill->totalProfitLoss = $response['totalProfitLoss'];
 

        return view('bills.show', compact(
            'bill'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function print(Bill $bill)
    {
        $no_of_cottons = 0;
        $no_of_pieces = 0;
        $total_price = 0;
        $discount = 0;
        $final_price = 0;
        foreach ($bill->billEntries as $be){
            $no_of_cottons += $be->no_of_cottons;
            $no_of_pieces += $be->no_of_pieces;
            $total_price += $be->total_price;
            $discount += $be->discount;
            $final_price += $be->final_price;
        }

        
        $data = [
            'bill'    => $bill,
            'no_of_cottons' => $no_of_cottons,
            'no_of_pieces' => $no_of_pieces,
            'total_price' => $total_price,
            'discount' => $discount,
            'final_price' => $final_price,
       ];

        $pdf = PDF::loadView('bills.print', $data);

        return $pdf->stream('invoice_'.$bill->bill_number.'.pdf');
          
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        return view('bills.edit', compact(
            'bill'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
