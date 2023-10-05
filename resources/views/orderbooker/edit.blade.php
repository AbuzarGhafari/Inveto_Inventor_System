@extends('layouts.app')

@section('heading', 'Edit Order Booker')

@section('title', 'Edit Order Booker')

@section('content') 
 
 
@livewire('orderbooker.order-booker-edit', ['orderBooker' => $orderBooker]) ;


@endsection
