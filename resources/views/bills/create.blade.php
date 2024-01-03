@extends('layouts.app')
 

@section('title', 'Generate Bill')

@section('heading', 'Generate Bill')

@section('content')
 

@livewire('bills.bill-create', ['add_previous_bill' => false]) 



@endsection
