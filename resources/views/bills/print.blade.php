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

        .products p{
            font-size: 0.7rem;
        }

        .footer p{
            font-size: 0.7rem;
        }

        .header p{
            font-size: 0.85rem;
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
 

<table class="mb-5 header">
    <tr>
        <td >
            <div>

                @include('datauri.al-noor-traders')
                <p class="mb-0 title text-center">Bill Invoice</p> 
                
                <p class="mb-0 text-dark"><span class="fw-bold">Bill Number:</span> {{ $bill->bill_number }}</p>
                <p class="mb-0 text-dark"><span class="fw-bold">Date:</span> {{ \Carbon\Carbon::parse($bill->created_at)->format('d/m/Y g:i:s A')}}</p>
                
                <p class="mb-0 text-dark"><span class="fw-bold">Order Booker:</span> {{ $bill->orderBooker->name }}
                <p class="mb-0 text-dark"><span class="fw-bold">Area:</span> {{ $bill->mainArea->name }},  {{ $bill->subArea->name }}</p> 
        
            </div>
        </td>
        <td>
            <div>

                <p class="mb-0 text-end"><span class="fw-bold">Distributor:</span> Bilal Mazhar</p>
                <p class="mb-0 text-end"><span class="fw-bold">Disribution:</span> Innovative biscuits, Rice and Sugar</p>
                <p class="mb-0 text-end"><span class="fw-bold">Mobile:</span> +92 322 1784066, +92 310 0087693, 0476334066</p>
                <p class="mb-0 text-end"><span class="fw-bold">Address:</span> Mohallah Hussain Abad Near Motti Masjid Chiniot</p>

                <p class="mb-0 text-dark text-end"><span class="fw-bold">Shop Name:</span> {{ $bill->shop->shop_name }}</p>
                <p class="mb-0 text-dark text-end"><span class="fw-bold">Shopkeepr Name:</span> {{ $bill->shop->shopkeeper_name }}</p>
                <p class="mb-0 text-dark text-end"><span class="fw-bold">Shopkeepr Mobile:</span> {{ $bill->shop->shopkeeper_mobile }}</p>
                <p class="mb-0 text-dark text-end"><span class="fw-bold">Address:</span> {{ $bill->shop->address }}, {{ $bill->shop->city }}</p>
                     
            </div>
        </td>
    </tr>

</table>


    
<table class="table text-nowrap products">
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
            <td class="text-left">
                @isset($be->product)
                {{ $be->product->name }}
                @endisset
            </td>
            <td class="text-left">{{ $be->assigned_price }}</td>
            <td class="text-left">
                @isset($be->product)
                {{  number_format($be->assigned_price / $be->product->pack_size, 2) }}
                @endisset
            </td>
            <td class="text-end">{{ $be->no_of_cottons }}</td>
            <td class="text-end">{{ $be->no_of_pieces }}</td>
            <td class="text-end">{{ $be->total_price }}</td>
            <td class="text-end">{{ $be->discount }}</td>
            <td class="text-end">{{ $be->final_price }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-end fw-bold">Total</td>
            <td colspan="1" class="text-end fw-bold">{{ $no_of_cottons }}</td>
            <td  colspan="1"  class="text-end fw-bold">{{ $no_of_pieces }}</td>
            <td colspan="1" class="text-end fw-bold">{{ $total_price }}</td>
            <td  colspan="1"  class="text-end fw-bold">{{ $discount }}</td>
            <td colspan="1" class="text-end fw-bold">{{ $final_price }}</td> 
        </tr> 
        @if($bill->previous_bill_id)
        <tr>
            <td colspan="4" class="text-end fw-bold">Previous Bill Amount</td>
            <td  colspan="5"  class="text-end fw-bold">{{ $bill->previous_bill_amount }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="4" class="text-end fw-bold">Total Amount</td>
            <td  colspan="5"  class="text-end fw-bold">{{ $bill->previous_bill_amount + $bill->final_price }}</td>
        </tr>
    </tbody>
</table>


<table class="footer">
    <tr>
        <td style="width: 60%;">
            <p class="fw-bold">Distributor Sign: </p>
        </td> 
        <td><p class="fw-bold">Shoopkeeper Sign:</p>        </td>
    </tr>
</table>

 





</body>

</html>


