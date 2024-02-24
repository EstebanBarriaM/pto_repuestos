@extends('backend.layout.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/multi/multi.css') }}">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Modelos de auto compatibles</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Producto: {{ $product->name }}</h3>
                        </div>
                        <form action="{{ route('products.compatible_models.store', $product->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <select multiple="multiple" name="car_models[]" id="car_models">
                                    @foreach ($allModels as $model)
                                        <option {{ $product->carModels->contains($model) ? 'selected' : '' }}
                                            value="{{ $model->id }}">{{ $model->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary"><i
                                        class="fa fa-arrow-left"></i> Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/backend/plugins/multi/multi.js') }}"></script>
    <script>
        $(function() {
            var select = document.getElementById("car_models");

            multi(select, {
                search_placeholder: "Buscar...",
                non_selected_header: "Modelos",
                selected_header: "Modelos seleccionados"
            });
        });
    </script>
@endsection
