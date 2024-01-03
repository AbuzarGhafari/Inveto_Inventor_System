@extends('layouts.app')
 

@section('title', 'Bill Details')

@section('heading', 'Bill Details')

@section('content')
 
  
    
<div class="row">
    <div class="col-sm-6">

        <div class="white-box">

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Bill Number</p>
                <p>{{ $bill->bill_number }}</p>
            </div> 

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Bill Date</p>
                <p>{{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y g:i:s A')}}</p>
            </div> 

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Order Booker</p>
                <p>{{ $bill->orderBooker->name }}</p>
            </div> 

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Main Area</p>
                <p>{{ $bill->mainArea->name }}</p>
            </div> 

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Sub Area</p>
                <p>{{ $bill->subArea->name }}</p>
            </div> 
            
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Shop Name</p>
                <p>{{ $bill->shop->shop_name }}</p>
            </div> 
            
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Shopkeepr Name</p>
                <p>{{ $bill->shop->shopkeeper_name }}</p>
            </div> 
            
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Shopkeepr Mobile</p>
                <p>{{ $bill->shop->shopkeeper_mobile }}</p>
            </div> 
            
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Address</p>
                <p>{{ $bill->shop->address }}, {{ $bill->shop->city }}</p>
            </div> 

        </div>

    </div>
    <div class="col-sm-6">

        <div class="white-box">
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Bill Amount</p>
                <p>{{ number_format($bill->actual_price, '2', '.', ',') }}</p>
            </div> 

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Discount</p>
                <p>{{ number_format($bill->discount, '2', '.', ',') }}</p>
            </div>
            
            @if($bill->previous_bill_id)
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Previous Bill Amount</p>
                <p  class="text-danger-dark">{{ number_format($bill->previous_bill_amount, '2', '.', ',') }}</p>
            </div>   
            @endif
            
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Bill Final Price</p>
                <p  class="text-info-dark">{{ number_format($bill->final_price, '2', '.', ',') }}</p>
            </div> 

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Recovered Amount</p>
                <p  class="text-success-dark">{{ number_format($bill->recovered_amount, '2', '.', ',')  }}</p>
            </div>  
                
            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Remaining Amount</p>
                <p  class="text-danger-dark">{{ number_format($bill->previous_bill_amount + $bill->final_price - $bill->recovered_amount, '2', '.', ',')  }} </p>
            </div>  

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Buying Amount</p>
                <p  class="text-danger-dark">{{ number_format($bill->totalBuyAmount, '2', '.', ',')  }}</p>
            </div>  

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Selling Amount</p>
                <p  class="text-success-dark">{{ number_format($bill->totalSellAmount, '2', '.', ',') }}</p>
            </div>  

            <div class="d-flex justify-content-between">
                <p class="border-top-0 text-dark fw-bold">Profit/Loss Amount</p>
                <p  class="text-success-dark">{{ number_format($bill->totalProfitLoss, '2', '.', ',') }}</p>
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
                            <th class="border-top-0  text-dark ">Dis. Price</th>
                            <th class="border-top-0  text-dark ">Ass. Price</th>
                            <th class="border-top-0  text-dark text-end"># Cottons</th>
                            <th class="border-top-0  text-dark text-end"># Pieces</th>
                            <th class="border-top-0  text-dark text-end">Cottons Price</th>
                            <th class="border-top-0  text-dark text-end">Pieces Price</th> 
                            <th class="border-top-0  text-dark text-end">Amount</th> 
                            <th class="border-top-0  text-dark text-end">Dis.</th>
                            <th class="border-top-0  text-dark text-end">Final Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bill->billEntries as $be)                            
                        <tr wire:key = "{{ $be->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $be->sku_code }}</td>
                            <td>
                                @isset($be->product)
                                    {{ $be->product->name }}
                                @endisset
                            </td>
                            <td class="text-end">{{ $be->distributor_prices }}</td>
                            <td class="text-end">{{ $be->assigned_price }}</td>
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
