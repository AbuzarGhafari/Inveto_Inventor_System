@extends('layouts.app')

@section('heading', 'Add Product')

@section('content')


<div class="row mb-3">
    <div class="col-sm-12">
        
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal form-material" method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">SKU Code</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="sku_code" class="form-control p-0 border-0" value="{{ old('sku_code') }}"> 
                        </div>
                        @error('sku_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Product Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" name="name" value="{{ old('name') }}"> 
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Product Description</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" name="desc" value="{{ old('desc') }}"> 
                        </div>
                        @error('desc')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Pack Size</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="number" class="form-control p-0 border-0" name="pack_size" value="{{ old('pack_size') }}"> 
                        </div>
                        @error('pack_size')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Distributor Price</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" name="distributor_prices" value="{{ old('distributor_prices') }}"> 
                        </div>
                        @error('distributor_prices')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                                        
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
