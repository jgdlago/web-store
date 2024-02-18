@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1>Edit Product</h1>

        <div class="w-auto max-w-md mx-auto mb-8">
            <form method="POST" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-gray-800" for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-800" for="product_code">Código:</label>
                    <input type="text" name="product_code" id="product_code" class="form-input" value="{{ $product->product_code }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-800" for="description">Descrição:</label>
                    <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-800" for="price">Preço:</label>
                    <input type="text" step="0.01" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar produto</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
