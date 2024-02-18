@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Meu carrinho:</h1>

        <table class="table w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome do Produto</th>
                <th class="px-4 py-2">Quantidade</th>
                <th class="px-4 py-2">Preço Unitário</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($carts as $cart)
                @foreach ($cart->cartItem as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $cart->id }}</td>
                        <td class="border px-4 py-2">
                            @if ($item->product)
                                {{ $item->product->name }}
                            @else
                                Produto não encontrado
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">
                            @if ($item->product)
                                {{ $item->product->price }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $item->subtotal }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('carts.show', $cart->id) }}" class="btn btn-info mr-2">View</a>
                            <a href="{{ route('carts.edit', $cart->id) }}" class="btn btn-primary mr-2">Edit</a>
                            <form action="{{ route('cart-items.destroy', $item->id) }}" method="POST">
                            @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection