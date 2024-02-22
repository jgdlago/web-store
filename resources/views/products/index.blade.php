@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Produtos</h1>
        @auth
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Novo Produto</a>
        @endauth

        <table class="table w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">Código</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Descrição</th>
                <th class="px-4 py-2">Preço</th>
                <th class="px-4 py-2">Quantidade</th>
                <th class="px-4 py-2"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->product_code }}</td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">{{ $product->price }}</td>
                    <td class="border px-4 py-2">
                        @auth
                            @if(auth()->user()->cart)
                                <form action="{{ route('cart-items.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{ auth()->user()->cart->id }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="flex items-center">
                                        <input type="number" name="quantity" class="form-input rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" min="1" value="1">
                                        <button type="submit" class="btn btn-primary ml-2">
                                            <i class="fas fa-plus text-lg text-green-600 ml-4"></i>
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart text-lg text-green-600 ml-4"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </div>
@endsection
