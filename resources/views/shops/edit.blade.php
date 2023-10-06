@extends('layouts.app')

@section('title', 'Edit Shop')

@section('heading', 'Edit Shop')

@section('content')

@livewire('shop.shop-edit', ['shop' => $shop])

@endsection
