@extends('layouts.app')

@section('heading', 'Product Details')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0 text-dark fw-bold">SKU Code</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $product->sku_code }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0  text-dark fw-bold">Name</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $product->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0  text-dark fw-bold">Description</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $product->desc }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0  text-dark fw-bold">Pack Size</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $product->pack_size }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0  text-dark fw-bold">Distributor Price</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $product->distributor_prices }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                        <i class=" fas fa-pencil-alt me-2"></i>
                        Edit
                    </a>
                    
                </div>
            </div>
            
             
        </div>
    </div>
</div>

@endsection
