@extends('frontend.layout.main')

@section('content')
    <h1 class="main-ttl"><span>{{ $product->name }}</span></h1>

    <div class="prod-wrap">
        <!-- Product Images -->
        <div class="prod-slider-wrap">
            <div class="prod-slider">
                <ul class="prod-slider-car">
                    @foreach ($product->productImages as $image)
                        <li>
                            <a data-fancybox-group="product" class="fancy-img" href="{{ Storage::url($image->name) }}">
                                <img src="{{ Storage::url($image->name) }}" alt="{{ $product->name }}">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="prod-thumbs">
                <ul class="prod-thumbs-car">
                    @foreach ($product->productImages as $image)
                        <li>
                            <a data-slide-index="{{ $loop->iteration - 1 }}" href="#">
                                <img src="{{ Storage::url($image->name) }}" alt="{{ $product->name }}">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="prod-cont">
            <h3 style="font-size: 20px; margin-bottom: 10px;">
                <span style="background-color: #373d54;" class="label label-default">Categoría:
                    {{ $product->category->name }}</span>
            </h3>

            <h3 style="font-size: 20px; margin-bottom: 10px;">
                <span style="background-color: #373d54;" class="label label-default">Marca:
                    {{ $product->productBrand->name }}</span>
            </h3>

            <div class="prod-cont-txt">
                {{ $product->description }}
            </div>

            <form method="POST" action="{{ route('frontend.add_to_cart') }}">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="prod-info">
                    <p class="prod-price">
                        <b class="item_current_price">${{ $product->price }}</b>
                    </p>
                    <p class="prod-qnt">
                        <input value="1" type="text" id="quantity" name="quantity" readonly>
                        <a id="buttonPlus" href="#" class="prod-plus"><i class="fa fa-angle-up"></i></a>
                        <a id="buttonMinus" href="#" class="prod-minus"><i class="fa fa-angle-down"></i></a>
                    </p>
                    <p class="prod-addwrap">
                        <button type="submit" class="prod-add"
                            @if ($product->stock == 0) disabled style="pointer-events: none; background-color: #807f8d;" @endif>
                            @if ($product->stock > 0)
                                Agregar al carro
                            @else
                                Sin stock
                            @endif
                        </button>
                    </p>
                </div>
            </form>

            @if ($product->carModels->count())
                <h3>Modelos de auto compatibles:</h3>

                <ul class="prod-i-props">
                    @foreach ($product->carModels as $model)
                        <li>
                            <b>{{ $model->carBrand->title }}</b> {{ $model->title }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            var quantity = $('#quantity').val();
            var stock = {{ $product->stock }};

            $('#buttonPlus').click(function(e) {
                e.preventDefault();

                if (quantity < stock) {
                    quantity++;
                    $('#quantity').val(quantity);
                }
            });

            $('#buttonMinus').click(function(e) {
                e.preventDefault();
                if (quantity > 1) {
                    quantity--;
                    $('#quantity').val(quantity);
                }
            });
        });
    </script>
@endsection
