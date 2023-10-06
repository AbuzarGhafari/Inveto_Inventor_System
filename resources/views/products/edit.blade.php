@extends('layouts.app')

@section('heading', 'Edit Product')

@section('title', 'Edit Product')

@section('content')


@livewire('product.product-edit', ['product'=>$product])


@endsection
