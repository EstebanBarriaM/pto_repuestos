@extends('backend.layout.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nuevo Producto</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Datos del producto</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nombre Producto</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Ingrese nombre marca"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">Categoria</label>
                                            <select class="form-control @error('category_id') is-invalid @enderror"
                                                id="category_id" name="category_id">
                                                <option value="" {{ old('category_id') ? '' : 'selected' }}>Seleccione
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_brand_id">Marca</label>
                                            <select class="form-control @error('product_brand_id') is-invalid @enderror"
                                                id="product_brand_id" name="product_brand_id">
                                                <option value="" {{ old('product_brand_id') ? '' : 'selected' }}>
                                                    Seleccione</option>
                                                @foreach ($product_brands as $product_brand)
                                                    <option value="{{ $product_brand->id }}"
                                                        {{ old('product_brand_id') == $product_brand->id ? 'selected' : '' }}>
                                                        {{ $product_brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_brand_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Precio</label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                                id="price" name="price" placeholder="Ingrese precio"
                                                value="{{ old('price') }}">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="text" class="form-control @error('stock') is-invalid @enderror"
                                                id="stock" name="stock" placeholder="Ingrese stock"
                                                value="{{ old('stock') }}">
                                            @error('stock')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripcion</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3" placeholder="Ingrese una descripcion">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="images">Imagenes</label>
                                    <input type="file" class="form-control-file @error('images') is-invalid @enderror"
                                        id="images" name="images[]" multiple>
                                    @error('images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                    Guardar</button>
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
