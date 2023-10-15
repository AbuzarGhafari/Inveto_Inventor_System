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
        .row {
            padding: 0px !important;
            display: flex; 
            justify-content: space-around; 
        }
        
        .col{ 
            width: 100%; 
        }

        .table th,
        .table td {
            padding: 5px  !important;
        }

        /* table{
            width: 100%
        } */

        table th,
        table td{
            font-size: 0.75rem;
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

        .table,
        .table th,
        .table td{
            border: 1px solid #aaa;
            border-collapse: collapse;
        }


        img {
            width: 120px;
        }

        .title {
            font-weight: bold;
            font-size: 0.9rem;
            margin: 0px;
        }

        .text-center{
            text-align: center
        }

        .fw-bold{
            font-weight: bold;
        }

        .mb-5{
            margin-bottom: 0.5rem;
        }
    </style>



</head>

<body>

    
<div class="header">
</div>


<table class="mb-5">
    <tr>
        <td colspan="2" class="text-center">
            
            @include('datauri.al-noor-traders')
            <p class="title text-center">Summary</p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="mb-0 text-dark">Order Booker: {{ $booker }}</p>
        </td>
    </tr>
    
    <tr>
        <td>
            <p class="mb-0 text-dark text-end">Date: {{ \Carbon\Carbon::parse(\Carbon\Carbon::today())->format('d/m/Y g:i:s A')}}</p>
        </td>
    </tr>
</table>


    
<table class="table text-nowrap">
    <thead>
        <tr> 
            <th class="border-top-0  text-dark text-left">#</th>
            <th class="border-top-0  text-dark text-left">Product Name</th>
            <th class="border-top-0  text-dark text-end">No. of Cottons</th>
            <th class="border-top-0  text-dark text-end">No. of Pieces</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($summary as $item)
            <tr wire:key = "{{ $item['name'] }}">
                <td class="text-left">{{ $loop->iteration }}</td>
                <td class="text-left">{{ $item['name'] }}</td>
                <td class="text-end">{{ $item['total_no_of_cottons'] }}</td>
                <td class="text-end">{{ $item['total_no_of_pieces'] }}</td> 
            </tr>
        @endforeach
        <tr>
            <td colspan="3" class="text-end fw-bold">{{ $overallTotalCottons }}</td>
            <td class="text-end fw-bold">{{ $overallTotalPieces }}</td>
        </tr> 
    </tbody>
</table>


 





</body>

</html>


