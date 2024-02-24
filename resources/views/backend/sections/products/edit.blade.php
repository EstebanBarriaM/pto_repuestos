@extends('backend.layout.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Editando {{ $product->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Datos del producto</h3>
                        </div>
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nombre Producto</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Ingrese nombre marca"
                                                value="{{ old('name', $product->name) }}">
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
                                                <option value=""
                                                    {{ old('category_id', $product->category_id) ? '' : 'selected' }}>
                                                    Seleccione
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $category->id) == $category->id ? 'selected' : '' }}>
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
                                                <option value=""
                                                    {{ old('product_brand_id', $product->product_brand_id) ? '' : 'selected' }}>
                                                    Seleccione</option>
                                                @foreach ($product_brands as $product_brand)
                                                    <option value="{{ $product_brand->id }}"
                                                        {{ old('product_brand_id', $product_brand->id) == $product_brand->id ? 'selected' : '' }}>
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
                                                value="{{ old('price', $product->price) }}">
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
                                                value="{{ old('stock', $product->stock) }}">
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
                                        rows="3" placeholder="Ingrese una descripcion">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
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
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Imagenes del producto</h3>
                        </div>
                        <div class="card-body">
                            @if (session()->has('flash'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i>Notificación</h5>
                                    {{ session()->get('flash') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-times"></i>Notificación</h5>
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="images">Imagenes</label>
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach ($product->productImages as $image)
                                            <tr>
                                                <td><img src="{{ Storage::url($image->name) }}"
                                                        alt="{{ $product->name }}" style="width: 80px"
                                                        class="img-fluid rounded"></td>
                                                <td style="width: 40px">
                                                    <form action="{{ route('products.destroy_image', $image->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger mt-4"
                                                            onclick="return confirm('Desea eliminar el registro?');"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <form action="{{ route('products.add_images', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input type="file"
                                                class="form-control-file @error('images') is-invalid @enderror"
                                                id="images" name="images[]" multiple>
                                            @error('images')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-info btn-block"><i
                                                    class="fa fa-plus"></i>
                                                Agregar imagenes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
