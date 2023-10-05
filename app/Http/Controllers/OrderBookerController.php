<?php

namespace App\Http\Controllers;

use App\Models\OrderBooker;
use Illuminate\Http\Request;

class OrderBookerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orderbooker.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orderbooker.create');
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
    public function show(OrderBooker $orderBooker)
    {
        return view('orderbooker.show', compact('orderBooker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderBooker $orderBooker)
    {
        return view('orderbooker.edit', compact('orderBooker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderBooker $orderBooker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderBooker $orderBooker)
    {
        //
    }
}
