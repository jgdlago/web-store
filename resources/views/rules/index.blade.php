@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center">
        <a href="{{ route('rules.create') }}" class="btn btn-primary mb-4">Nova Regra</a>

        <table class="table w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Comprar</th>
                <th class="px-4 py-2">Ganhar</th>
                <th class="px-4 py-2">Quantidade Mínima</th>
                <th class="px-4 py-2">Preço Promocional</th>
                <th class="px-4 py-2">Porcentagem de Desconto</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rules as $rule)
                <tr>
                    <td class="border px-4 py-2">{{ $rule->name }}</td>
                    <td class="border px-4 py-2">
                        @if ($rule->buy_quantity === null || $rule->buy_quantity === 0)
                            X
                        @else
                            {{ $rule->buy_quantity }}
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($rule->get_quantity === null || $rule->get_quantity === 0)
                            X
                        @else
                            {{ $rule->get_quantity }}
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($rule->minimum_quantity === null || $rule->minimum_quantity === 0)
                            X
                        @else
                            {{ $rule->minimum_quantity }}
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($rule->promotion_price === null || $rule->promotion_price === 0)
                            X
                        @else
                            {{ $rule->promotion_price }}
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($rule->discount_percentage === null || $rule->discount_percentage === 0)
                            X
                        @else
                            {{ $rule->discount_percentage }}
                        @endif
                    </td>
                    <td class="border px-4 py-2">
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

        <div class="mt-4">
            {{ $rules->links() }}
        </div>

    </div>
@endsection
