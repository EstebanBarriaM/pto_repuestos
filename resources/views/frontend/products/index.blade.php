@extends('frontend.layout.main')

@section('content')
    <h1 class="main-ttl"><span>Productos</span></h1>

    <div class="container">
        <div class="row">
            @if ($products->count())
                <div class="prod-items section-items">
                    @foreach ($products as $product)
                        <div class="prod-i" style="margin-bottom: 40px;">
                            <div class="prod-i-top">
                                <a href="{{ route('frontend.products.show', $product->slug) }}" class="prod-i-img">
                                    <img src="{{ $product->mainImage() }}" alt="{{ $product->name }}">
                                </a>
                                <a href="{{ route('frontend.products.show', $product->slug) }}" class="prod-i-buy">Ver</a>
                            </div>
                            <h3>
                                <a href="{{ route('frontend.products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="prod-i-price">
                                <b>${{ $product->price }}</b>
                            </p>
                        </div>
                    @endforeach
                </div>

                {!! $products->links('vendor.pagination.bootstrap-4') !!}
            @else
                <h2 style="font-size: 18px;">No tenemos registros actualmente.</h2>
            @endif
        </div>
    </div>
@endsection
