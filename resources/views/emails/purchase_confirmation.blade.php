@component('mail::message')
    # Confirmação de Compra - Pedido #{{ $purchase->id }}

    Olá,
    Abaixo estão os detalhes do seu pedido:

    **Data da Compra:** {{ $purchase->purchased_at }}

    **Produtos:**
    @php
        $products = json_decode($purchase->products, true);
    @endphp

    @foreach ($products as $product)
        **Nome:** {{ $product['product_name'] }}
        **Preço Unitário:** {{ $product['product_price'] }}
        **Quantidade:** {{ $product['quantity'] }}
        **Subtotal:** {{ $product['subtotal'] }}
    @endforeach

    **Total da Compra:** R$ {{ $purchase->total_price }}

    Obrigado,<br>
    {{ config('app.name') }}
@endcomponent
