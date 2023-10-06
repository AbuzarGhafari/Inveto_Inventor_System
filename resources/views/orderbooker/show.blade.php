@extends('layouts.app')

@section('heading', 'Order Booker Details')

@section('title', 'Order Booker Details')

@section('content') 

@livewire('orderbooker.order-booker-show', ['orderBooker' => $orderBooker])
  


@endsection
