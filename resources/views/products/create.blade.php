@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Create Product</h1>

        <div class="w-auto max-w-md mx-auto mb-8">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-800">Name:</label>
                    <input type="text" name="name" id="name" class="form-input" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-800">Description:</label>
                    <textarea name="description" id="description" class="form-textarea" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-800">Price:</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-input" required>
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
