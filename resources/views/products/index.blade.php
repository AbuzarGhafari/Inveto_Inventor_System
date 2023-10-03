@extends('layouts.app')

@section('heading', 'Products List')

@section('content')


<div class="row mb-3">
    <div class="col-sm-6">
        <input type="text" name="" id="" placeholder="Search Product" class="form-control">
    </div>
    <div class="col-sm-6 text-end">
        <a href="{{ route('products.create') }}" class="btn btn-danger text-white">
            <i class="fas fa-plus me-2"></i>
            Add Product
        </a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0 text-dark">SKU Code</th>
                            <th class="border-top-0  text-dark">Name</th>
                            <th class="border-top-0  text-dark">Pack Size</th>
                            <th class="border-top-0  text-dark">Distributor Price</th>
                            <th class="border-top-0  text-dark">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)                            
                        <tr>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}">{{ $product->sku_code }}</a>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pack_size }}</td>
                            <td>{{ $product->distributor_prices }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                    <i class=" fas fa-pencil-alt me-2"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
