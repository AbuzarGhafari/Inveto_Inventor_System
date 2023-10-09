@extends('layouts.app')
 

@section('title', 'Bill Details')

@section('heading', 'Bill Details')

@section('content')
 
 
<div class="white-box">
    
<div class="row">
    <div class="col-sm-6">

        <div class="white-box">

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Bill Number</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->bill_number }}</p>
                </div>
            </div> 

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Bill Date</p>
                </div>
                <div class="col-sm-8"> 
                    <p>{{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y g:i:s A')}}</p>
                </div>
            </div> 

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Order Booker</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->orderBooker->name }}</p>
                </div>
            </div> 

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Main Area</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->mainArea->name }}</p>
                </div>
            </div> 

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Sub Area</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->subArea->name }}</p>
                </div>
            </div> 

        </div>

    </div>
    <div class="col-sm-6">

        <div class="white-box">

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Shop Name</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->shop->shop_name }}</p>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Shopkeepr Name</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->shop->shopkeeper_name }}</p>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Shopkeepr Mobile</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->shop->shopkeeper_mobile }}</p>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Address</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->shop->address }}, {{ $bill->shop->city }}</p>
                </div>
            </div> 

        </div>
        

    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Bill Amount</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->actual_price }}</p>
                </div>
            </div> 

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Discount</p>
                </div>
                <div class="col-sm-8">
                    <p>{{ $bill->discount }}</p>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-sm-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Bill Final Price</p>
                </div>
                <div class="col-sm-8">
                    <p  class="text-info-dark">{{ $bill->final_price }}</p>
                </div>
            </div> 

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Recovered Amount</p>
                </div>
                <div class="col-sm-8">
                    <p  class="text-success-dark">{{ $bill->recovered_amount }}</p>
                </div>
            </div>  

            <div class="row">
                <div class="col-sm-4">
                    <p class="border-top-0 text-dark fw-bold">Remaining Amount</p>
                </div>
                <div class="col-sm-8">
                    <p  class="text-danger-dark">{{ $bill->final_price - $bill->recovered_amount }}</p>
                </div>
            </div>  

        </div>
    </div>
</div>

</div>

    
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <p class="fw-bold">Bill Entries</p>
            
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr> 
                            <th class="border-top-0  text-dark">#</th>
                            <th class="border-top-0  text-dark ">SKU Code</th>
                            <th class="border-top-0  text-dark ">Product</th>
                            <th class="border-top-0  text-dark text-end">No. of Cottons</th>
                            <th class="border-top-0  text-dark text-end">No. of Pieces</th>
                            <th class="border-top-0  text-dark text-end">Cottons Price</th>
                            <th class="border-top-0  text-dark text-end">Pieces Price</th> 
                            <th class="border-top-0  text-dark text-end">Amount</th> 
                            <th class="border-top-0  text-dark text-end">Discount</th>
                            <th class="border-top-0  text-dark text-end">Final Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bill->billEntries as $be)                            
                        <tr wire:key = "{{ $be->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $be->sku_code }}</td>
                            <td>{{ $be->product->name }}</td>
                            <td class="text-end">{{ $be->no_of_cottons }}</td>
                            <td class="text-end">{{ $be->no_of_pieces }}</td>
                            <td class="text-end">{{ $be->cottons_price }}</td>
                            <td class="text-end">{{ $be->peices_price }}</td>
                            <td class="text-end">{{ $be->total_price }}</td>
                            <td class="text-end">{{ $be->discount }}</td>
                            <td class="text-end">{{ $be->final_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
 
        </div>
    </div>
</div>


@endsection
