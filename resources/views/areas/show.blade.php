@extends('layouts.app')

@section('heading', 'Main Area Details')

@section('title', 'Main Area Details')

@section('content') 

 

@livewire('areas.sub-areas', ['area' => $area]) 


@endsection
