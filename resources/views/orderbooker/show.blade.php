@extends('layouts.app')

@section('heading', 'Order Booker Details')

@section('title', 'Order Booker Details')

@section('content') 
  
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0 text-dark fw-bold">Name</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $orderBooker->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0  text-dark fw-bold">Mobile</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $orderBooker->mobile }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p class="border-top-0  text-dark fw-bold">Area</p>
                </div>
                <div class="col-sm-9">
                    <p>{{ $orderBooker->area }}</p>
                </div>
            </div>   
 

            <div class="row">
                <div class="col-sm-12">

                    <a href="{{ route('order-booker.edit', $orderBooker->id) }}" class="btn btn-primary">
                        <i class=" fas fa-pencil-alt me-2"></i>
                        Edit
                    </a>
                    
                </div>
            </div>
            
             
        </div>
    </div>
</div>

@endsection
