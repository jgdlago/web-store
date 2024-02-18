@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Produtos</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Novo Produto</a>

        <table class="table w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">Código</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Descrição</th>
                <th class="px-4 py-2">Preço</th>
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
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info mr-2">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary mr-2">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
