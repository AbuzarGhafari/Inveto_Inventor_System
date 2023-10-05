<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        // return view('products.index', compact('products'));
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $validated = $request->validate([
            'sku_code' => 'required|unique:products|regex:/^([0-9]*)$/|min:0',
            'name' => 'required',
            'desc' => 'sometimes:required',
            'pack_size' => 'required|integer|min:0',
            'distributor_prices' => ['required','regex:/^\d*\.?\d+$/','min:0'],
        ]);

        Product::create($validated);
        
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku_code' => 'required|regex:/^([0-9]*)$/|min:0',
            'name' => 'required',
            'desc' => 'sometimes:required',
            'pack_size' => 'required|integer|min:0',
            'distributor_prices' => ['required','regex:/^\d*\.?\d+$/','min:0'],
        ]);

        $product->update($validated);
        
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
