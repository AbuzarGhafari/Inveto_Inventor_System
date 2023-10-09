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
        return view('bills.show', compact('bill'));
    }

    /**
     * Display the specified resource.
     */
    public function print(Bill $bill)
    {
        $data = [
            'bill'    => $bill,
       ];

        $pdf = PDF::loadView('bills.print', $data);

        return $pdf->stream('invoice_'.$bill->bill_number.'.pdf');
          
    }

    public function dailySalesReport(OrderBooker $booker)
    { 
        $bills = Bill::whereDate('created_at', Carbon::today())->where('order_booker_id', $booker->id)->get();

        $date = Carbon::today()->format('Y-m-d');

        $data = [
            'bills'    => $bills,
            'booker'    => $booker,
        ];

        $pdf = PDF::loadView('bills.dialy-sales-report', $data);

        return $pdf->stream('summary_'.$booker->name.'_'.$date.'.pdf');

        // return view('bills.diapy-sales-report', compact('bills', 'booker'));
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
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
