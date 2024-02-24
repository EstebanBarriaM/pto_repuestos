@extends('frontend.layout.main')

@section('content')
    <div class="banners-wrap">
        <h3 class="component-ttl"><span>Categorias</span></h3>

        @if ($categories->count())
            <div class="banners-list">
                @foreach ($categories as $category)
                    <div class="banner-i style_22">
                        <h3 class="banner-i-ttl">{{ $category->name }}</h3>
                        <span class="banner-i-bg" style="background: url({{ Storage::url($category->image) }});"></span>
                        <div class="banner-i-cont">
                            <p class="banner-i-link"><a
                                    href="{{ route('frontend.products.by_category', $category->slug) }}">Ver</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h2 style="font-size: 18px; margin-bottom: 100px;">No tenemos registros actualmente.</h2>
        @endif
    </div>

    <div class="fr-pop-wrap" style="margin-bottom: 120px;">
        <h3 class="component-ttl"><span>Recien llegados</span></h3>

        @if ($products->count())
            <div class="prod-items section-items">
                @foreach ($products as $product)
                    <div class="prod-i">
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
        @else
            <h2 style="font-size: 18px;">No tenemos registros actualmente.</h2>
        @endif
    </div>
@endsection
