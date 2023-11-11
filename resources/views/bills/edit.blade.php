@extends('layouts.app')
 

@section('title', 'Edit Bill')

@section('heading', 'Edit Bill')

@section('content')
 

@livewire('bills.bill-edit', ['bill' => $bill]) 

  
@endsection
