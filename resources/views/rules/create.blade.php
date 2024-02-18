@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Nova Regra</h1>

        <form action="{{ route('rules.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nome:</label>
                <input type="text" name="name" id="name" class="form-input rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="buy_quantity" class="block text-gray-700 font-bold mb-2">Compre:</label>
                <input type="number" name="buy_quantity" id="buy_quantity" class="form-input rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="get_quantity" class="block text-gray-700 font-bold mb-2">Ganhe:</label>
                <input type="number" name="get_quantity" id="get_quantity" class="form-input rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="minimum_quantity" class="block text-gray-700 font-bold mb-2">Quantidade mínima:</label>
                <input type="number" name="minimum_quantity" id="minimum_quantity" class="form-input rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="promotion_price" class="block text-gray-700 font-bold mb-2">Preço Promocional:</label>
                <input type="number" name="promotion_price" id="promotion_price" class="form-input rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="discount_percentage" class="block text-gray-700 font-bold mb-2">Porcentagem de Desconto:</label>
                <input type="number" name="discount_percentage" id="discount_percentage" class="form-input rounded-md w-full">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Criar Regra</button>
            </div>
        </form>
    </div>
@endsection
