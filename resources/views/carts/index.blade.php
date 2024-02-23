@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <table class="table w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome do Produto</th>
                <th class="px-4 py-2">Quantidade</th>
                <th class="px-4 py-2">Preço Unitário</th>
                <th class="px-4 py-2">Subtotal</th>
                <th class="px-4 py-2"></th>
            </tr>
            </thead>
            <tbody>
            @if ($myCart)
                @foreach ($myCart->cartItem as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $myCart->id }}</td>
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
                            <form action="{{ route('cart-items.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right font-bold">Total:</td>
                    <td colspan="2">{{ $myCart->total_price }}</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <form action="{{ route('purchase.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{ $myCart->id }}">
                            <button type="submit" class="btn btn-success">Finalizar Compra</button>
                        </form>
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="6" class="text-center">Nenhum carrinho encontrado.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
