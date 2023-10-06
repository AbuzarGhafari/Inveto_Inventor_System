<?php

namespace App\Http\Controllers;

use App\Models\ShopType;
use Illuminate\Http\Request;

class ShopTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shoptypes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(ShopType $shopType)
    {
        return view('shoptypes.show', compact('shopType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopType $shopType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShopType $shopType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopType $shopType)
    {
        //
    }
}
