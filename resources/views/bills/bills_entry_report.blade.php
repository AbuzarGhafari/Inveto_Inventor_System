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

        .w-50{
            width: 45%;  
        } 

        .empty-cell{
            width: 60px;
        }

        .group-header{
            text-align: center;
            padding: 0.5rem;
            background: rgba(0,0,0,0.25);
        }

        .shop-name{
            width: 140px;
        }
        .text-center{
            text-align: center;
        }
    </style>



</head>

<body>

     

<table class="mb-5">
    <tr>
        <td  class="text-center"> 
            <div>
                @include('datauri.al-noor-traders')
            </div>
            <p class="title text-center mb-0">Bills Entry</p>
            <p class="mb-0 text-darknd text-center">Date: {{ \Carbon\Carbon::parse(\Carbon\Carbon::today())->format('d/m/Y g:i:s A')}}</p>
        </td>
    </tr>
    
</table>


<div class="w-50">
    <table class="table text-nowrap">
        <thead>
            <tr> 
                <th class="border-top-0  text-dark text-left">#</th>
                <th class="border-top-0  text-dark shop-name text-left">Code</th>
                {{-- <th class="border-top-0  text-dark text-left">Area</th> --}}
                {{-- <th class="border-top-0  text-dark text-left">Shop</th> --}}
                <th class="border-top-0  text-dark text-left">Amount</th>
                <th class="border-top-0  text-dark text-left">Recovered</th>
                <th class="border-top-0  empty-cell"> </th>
                <th class="border-top-0  empty-cell"> </th>
                <th class="border-top-0  empty-cell"> </th>
                <th class="border-top-0  empty-cell"> </th>
                <th class="border-top-0  empty-cell"> </th>
                <th class="border-top-0  empty-cell"> </th>
                <th class="border-top-0  empty-cell"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupedBills as $mainAreaName => $bills)
                <tr>
                    <td colspan="11" class="text-center group-header">{{ $mainAreaName }}</td>
                </tr>
                @foreach ($bills as $bill)
                    <tr wire:key = "{{ $bill['name'] }}">
                        <td class="text-left">{{ $loop->iteration }}</td>
                        <td class="text-left shop-name">{{ $bill->bill_number }} <br> {{ $bill->shop->shop_name }}</td>
                        {{-- <td class="text-left">{{ $bill->mainArea->name }}</td> --}}
                        {{-- <td class="text-left">{{ $bill->shop->shop_name }}</td> --}}
                        <td class="text-left">{{ $bill->final_price }}</td>
                        <td class="text-left">{{ $bill->recovered_amount }}</td>
                        <td class="empty-cell"> </td>
                        <td class="empty-cell"> </td>
                        <td class="empty-cell"> </td>
                        <td class="empty-cell"> </td>
                        <td class="empty-cell"> </td>
                        <td class="empty-cell"> </td>
                        <td class="empty-cell"> </td>
                    </tr>
                    @endforeach
            @endforeach
        </tbody>
    </table>
</div> 

 





</body>

</html>


