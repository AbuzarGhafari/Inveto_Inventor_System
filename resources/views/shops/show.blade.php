@extends('layouts.app')

@section('heading', 'Shop Details')

@section('title', 'Shop Details')

@section('content')


        
    @livewire('shop.shop-show', ['shop' => $shop]) 
 

    
    @livewire('bills.bills', ['shop_bills'=>true, 'shop_id' => $shop->id]) 




@endsection
