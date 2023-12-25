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

        .text-center{
            text-align: center;
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
    </style>



</head>

<body>

     

<table class="mb-5">
    <tr>
        <td colspan="2" class="text-center"> 
            @include('datauri.al-noor-traders')
            <p class="title text-center mb-0">Stock List</p>
        </td>
    </tr> 
    
    <tr>
        <td colspan="2" class="text-center"> 
            <p class="mb-0 text-darknd">Date: {{ \Carbon\Carbon::parse(\Carbon\Carbon::today())->format('d/m/Y g:i:s A')}}</p>
        </td>
    </tr>
</table>

 

<table class="table text-nowrap">
    <thead>
        <tr> 
            <th class="border-top-0  text-dark text-left">#</th>
            <th class="border-top-0  text-dark text-left">SKU Code</th>
            <th class="border-top-0  text-dark text-left">Product Name</th>
            <th class="border-top-0  text-dark text-end">No. of Cottons</th>
            <th class="border-top-0  text-dark text-end">No. of Pieces</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
            <tr wire:key = "{{ $item['name'] }}">
                <td class="text-left">{{ $loop->iteration }}</td>
                <td class="text-left">{{ $item['sku_code'] }}</td>
                <td class="text-left">{{ $item['name'] }}</td>
                <td class="text-end">{{ $item['no_of_cottons'] }}</td>
                <td class="text-end">{{ $item['no_of_pieces'] }}</td> 
            </tr>
        @endforeach
        <tr>
            <td colspan="3" class="fw-bold">Total</td>
            <td  class="text-end fw-bold">{{ $products->sum('no_of_cottons'); }}</td>
            <td class="text-end fw-bold">{{ $products->sum('no_of_pieces'); }}</td>
        </tr> 
    </tbody>
</table>


 





</body>

</html>


