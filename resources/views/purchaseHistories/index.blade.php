@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold mb-4">Histórico de Compras</h1>

        <div class="w-full lg:w-3/4">
            <table class="table w-full rounded-lg overflow-hidden">
                <thead >
                <tr>
                    <th class="px-4 py-2">Preço total</th>
                    <th class="px-4 py-2">Data da Compra</th>
                    <th class="px-4 py-2">Produtos</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchaseHistories as $history)
                    <tr>
                        <td class="border px-4 py-2">{{ $history->total_price }}</td>
                        <td class="border px-4 py-2">{{ $history->purchased_at }}</td>
                        <td class="border px-4 py-2">
                            <ul class="flex flex-col gap-2">
                                @foreach (json_decode($history->products) as $product)
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->product_name }}</div>
                                            <div class="text-sm text-gray-500">Preço: {{ $product->product_price }}</div>
                                            <div class="text-sm text-gray-500">Quantidade: {{ $product->quantity }}</div>
                                            <div class="text-sm text-gray-500">Subtotal: {{ $product->subtotal }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
