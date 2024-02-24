@extends('frontend.layout.main')

@section('content')
    <h1 class="main-ttl"><span>Carrito</span></h1>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($cart)
        <div class="cart-items-wrap">
            <table class="cart-items">
                <thead>
                    <tr>
                        <td class="cart-image">Imágen</td>
                        <td class="cart-ttl">Producto</td>
                        <td class="cart-price">Precio</td>
                        <td class="cart-quantity">Cantidad</td>
                        <td class="cart-summ">Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart['products'] as $product)
                        <tr>
                            <td class="cart-image">
                                <img src="{{ $product['photo'] }}" alt="{{ $product['name'] }}">
                            </td>
                            <td class="cart-ttl">
                                {{ $product['name'] }}
                            </td>
                            <td class="cart-price">
                                <b>${{ $product['price'] }}</b>
                            </td>
                            <td class="cart-price">
                                <b>{{ $product['quantity'] }}</b>
                            </td>
                            <td class="cart-price">
                                <b>${{ $product['subtotal'] }}</b>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <ul class="cart-total">
            <li class="cart-summ">TOTAL: <b>${{ $cart['total'] }}</b></li>
        </ul>
        <div class="cart-submit">
            <a href="#" class="cart-submit-btn"
                onclick="event.preventDefault(); document.getElementById('checkout-form').submit();">Pagar</a>
            <a href="{{ route('frontend.clear_cart') }}" class="cart-clear">Limpiar carro</a>
        </div>

        <form id="checkout-form" action="{{ route('frontend.checkout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <h2 style="font-size: 18px;">Carrito vacío.</h2>
    @endif
@endsection
