@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Criar Nova Promoção</h1>

        <form action="{{ route('promotions.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nome:</label>
                <input type="text" name="name" id="name" class="form-input rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="product_code" class="block text-gray-700 font-bold mb-2">Código do Produto:</label>
                <select name="product_code" id="product_code" class="form-select rounded-md w-full">
                    @foreach($products as $product)
                        <option value="{{ $product->product_code }}">{{ $product->product_code }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="rule_id" class="block text-gray-700 font-bold mb-2">Regra:</label>
                <select name="rule_id" id="rule_id" class="form-select rounded-md w-full">
                    @foreach($rules as $rule)
                        <option value="{{ $rule->id }}">{{ $rule->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Criar Promoção</button>
            </div>
        </form>
    </div>
@endsection
