@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Promoções</h1>
        <a href="{{ route('promotions.create') }}" class="btn btn-primary mb-4">Nova Promoção</a>

        <table class="table w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Código do Produto</th>
                <th class="px-4 py-2">Regra</th>
                <th class="px-4 py-2"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($promotions as $promotion)
                <tr>
                    <td class="border px-4 py-2">{{ $promotion->id }}</td>
                    <td class="border px-4 py-2">{{ $promotion->name }}</td>
                    <td class="border px-4 py-2">{{ $promotion->product_code }}</td>
                    <td class="border px-4 py-2">{{ $promotion->rule->name }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('promotions.show', $promotion->id) }}" class="btn btn-info mr-2">View</a>
                        <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-primary mr-2">Edit</a>
                        <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST">
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
