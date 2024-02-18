@extends('layouts.app')

@section('content')
    <h1>Product Details</h1>
    <p>ID: {{ $product->id }}</p>
    <p>Código: {{ $product->product_code }}</p>
    <p>Name: {{ $product->name }}</p>
    <p>Description: {{ $product->description }}</p>
    <p>Price: {{ $product->price }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
