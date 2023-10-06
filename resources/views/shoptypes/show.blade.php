@extends('layouts.app')

@section('heading', 'Main Shop Type Details')

@section('title', 'Main Shop Type Details')

@section('content') 
 

@livewire('shoptypes.shop-sub-types', ['shopType' => $shopType]) 


@endsection
