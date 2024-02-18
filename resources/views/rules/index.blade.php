@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Regras</h1>
        <a href="{{ route('rules.create') }}" class="btn btn-primary mb-4">Nova Regra</a>

        <table class="table w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Quantidade para Comprar</th>
                <th class="px-4 py-2">Quantidade para Ganhar</th>
                <th class="px-4 py-2">Quantidade Mínima para Ativar</th>
                <th class="px-4 py-2">Preço Promocional</th>
                <th class="px-4 py-2">Porcentagem de Desconto</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rules as $rule)
                <tr>
                    <td class="border px-4 py-2">{{ $rule->id }}</td>
                    <td class="border px-4 py-2">{{ $rule->buy_quantity }}</td>
                    <td class="border px-4 py-2">{{ $rule->get_quantity }}</td>
                    <td class="border px-4 py-2">{{ $rule->minimum_quantity }}</td>
                    <td class="border px-4 py-2">{{ $rule->promotion_price }}</td>
                    <td class="border px-4 py-2">{{ $rule->discount_percentage }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('rules.show', $rule->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('rules.edit', $rule->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('rules.destroy', $rule->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
