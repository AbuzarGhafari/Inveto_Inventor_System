<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    
    <style>
        *{
            font-family: sans-serif;
        } 


        .table,
        .table th,
        .table td{
            border: 1px solid #aaa;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1px  !important;
            font-size: 0.6rem;
        }

        p{
            font-size: 0.6rem;
        }

        table{
            width: 100%
        }

        .mb-0{
            margin: 0px !important;
        }

        .text-end{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }

        img {
            width: 120px;
        }

        .title {
            font-weight: bold;
            font-size: 0.9rem;
        }

        .fw-bold{
            font-weight: bold;
        }
 
    </style>



</head>

<body>

    
<div class="header">
</div>


<table class="mb-5">
    <tr>
        <td >
            <div>

                @include('datauri.al-noor-traders')
                <p class="mb-0 title text-center">Bill Invoice</p>

                
                <p class="mb-0 text-dark">Bill Number/Date: {{ $bill->bill_number }} , {{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y g:i:s A')}}</p>
                
                <p class="mb-0 text-dark">Order Booker: {{ $bill->orderBooker->name }},
                Area: {{ $bill->mainArea->name }},  {{ $bill->subArea->name }}</p> 
        
            </div>
        </td>
        <td>
            <div>

                <p class="mb-0 text-end">Distributor: Bilal Mazhar</p>
                <p class="mb-0 text-end">Disribution: Innovative biscuits, Rice and Sugar</p>
                <p class="mb-0 text-end">Mobile: +92 322 1784066, +92 310 0087693, 0476334066</p>
                <p class="mb-0 text-end">Address: Mohallah Hussain Abad Near Motti Masjid Chiniot</p>

                <p class="mb-0 text-dark text-end">Shop Name: {{ $bill->shop->shop_name }}</p>
                <p class="mb-0 text-dark text-end">Shopkeepr Name: {{ $bill->shop->shopkeeper_name }}</p>
                <p class="mb-0 text-dark text-end">Shopkeepr Mobile: {{ $bill->shop->shopkeeper_mobile }}</p>
                <p class="mb-0 text-dark text-end">Address: {{ $bill->shop->address }}, {{ $bill->shop->city }}</p>
                     
            </div>
        </td>
    </tr>

</table>


    
<table class="table text-nowrap">
    <thead>
        <tr> 
            <th class="border-top-0  text-dark text-left">#</th>
            <th class="border-top-0  text-dark text-left ">Product Name</th>
            <th class="border-top-0  text-dark text-left ">Cotton Price</th>
            <th class="border-top-0  text-dark text-left ">Piece Price</th>
            <th class="border-top-0  text-dark text-end">No. of Cottons</th>
            <th class="border-top-0  text-dark text-end">No. of Pieces</th>
            <th class="border-top-0  text-dark text-end">Amount</th> 
            <th class="border-top-0  text-dark text-end">Discount</th>
            <th class="border-top-0  text-dark text-end">Final Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bill->billEntries as $be)                            
        <tr wire:key = "{{ $be->id }}">
            <td class="text-left">{{ $loop->iteration }}</td>
            <td class="text-left">{{ $be->product->name }}</td>
            <td class="text-left">{{ $be->assigned_price }}</td>
            <td class="text-left">{{  number_format($be->assigned_price / $be->product->pack_size, 2) }}</td>
            <td class="text-end">{{ $be->no_of_cottons }}</td>
            <td class="text-end">{{ $be->no_of_pieces }}</td>
            <td class="text-end">{{ $be->total_price }}</td>
            <td class="text-end">{{ $be->discount }}</td>
            <td class="text-end">{{ $be->final_price }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" class="text-end fw-bold">Bill Amount</td>
            <td  colspan="3"  class="text-end fw-bold">{{ $bill->actual_price }}</td>
        </tr>
        <tr>
            <td colspan="6" class="text-end fw-bold">Discount</td>
            <td  colspan="3"  class="text-end fw-bold">{{ $bill->discount }}</td>
        </tr>
        @if($bill->previous_bill_id)
        <tr>
            <td colspan="6" class="text-end fw-bold">Previous Bill Amount</td>
            <td  colspan="3"  class="text-end fw-bold">{{ $bill->previous_bill_amount }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="6" class="text-end fw-bold">Total Amount</td>
            <td  colspan="3"  class="text-end fw-bold">{{ $bill->previous_bill_amount + $bill->final_price }}</td>
        </tr>
    </tbody>
</table>


 





</body>

</html>


