@extends('layouts.app')

@section('title', 'Product Details - EcomStore')

@section('content')
    <livewire:frontend.product-detail :slug="$slug" />
@endsection
