@extends('layouts.app')

@section('heading', 'Shop Details')

@section('title', 'Shop Details')

@section('content')


    <div class="row">
        <div class="col-sm-6">

            <div class="white-box">
                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0 text-dark fw-bold">Shop Name</p>
                    </div>
                    <div class="col-sm-8">
                        <p>{{ $shop->shop_name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Shopkeeper Name</p>
                    </div>
                    <div class="col-sm-8">
                        <p>{{ $shop->shopkeeper_name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Shopkeeper Mobile</p>
                    </div>
                    <div class="col-sm-8">
                        <p>{{ $shop->shopkeeper_mobile }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">City</p>
                    </div>
                    <div class="col-sm-8">
                        <p>{{ $shop->city }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Address</p>
                    </div>
                    <div class="col-sm-8">
                        <p>{{ $shop->address }}</p>
                    </div>
                </div>
  

            </div>

        </div>
        <div class="col-sm-6">

            <div class="white-box">
                  

                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Channel</p>
                    </div>
                    <div class="col-sm-8">
                        <p>{{ $shop->channel }}</p>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Main Area</p>
                    </div>
                    <div class="col-sm-8">
                        @isset($shop->area)
                            <span class="badge bg-info">{{ $shop->area->name }}</span>                             
                        @else 
                            <span class="badge text-light bg-secondary">--</span>
                        @endisset
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Sub Area</p>
                    </div>
                    <div class="col-sm-8">
                        @isset($shop->subarea)                    
                            <span class="badge bg-info">{{ $shop->subarea->name }}</span>                             
                        @else
                            <span class="badge text-light bg-secondary">--</span>
                        @endisset
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Main type</p>
                    </div>
                    <div class="col-sm-8"> 
                        @isset($shop->shopMainType)
                            <span class="badge bg-info">{{ $shop->shopMainType->name }}</span>                             
                        @else 
                            <span class="badge text-light bg-secondary">--</span>
                        @endisset
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <p class="border-top-0  text-dark fw-bold">Sub Type</p>
                    </div>
                    <div class="col-sm-8"> 
                        @isset($shop->shopSubType)
                            <span class="badge bg-info">{{ $shop->shopSubType->name }}</span>                             
                        @else 
                            <span class="badge text-light bg-secondary">--</span>
                        @endisset
                    </div>
                </div>



            </div>

        </div>
    </div>
 

    
    @livewire('bills.bills', ['shop_bills'=>true, 'shop_id' => $shop->id]) 




@endsection
