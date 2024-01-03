@extends('layouts.app')
 

@section('title', 'Generate Bill With Previous Bill')

@section('heading', 'Generate Bill With Previous Bill')

@section('content')
 

@livewire('bills.bill-create', ['add_previous_bill' => true, 'previousBill' => $bill]) 



@endsection
