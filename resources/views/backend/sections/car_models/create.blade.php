@extends('backend.layout.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nuevo Modelo</h1>
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
                            <h3 class="card-title">Datos del modelo</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('car_model.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="car_brand_id">Marca</label>
                                    <select class="form-control @error('car_brand_id') is-invalid @enderror"
                                        id="car_brand_id" name="car_brand_id">
                                        <option value="" {{ old('car_brand_id') ? '' : 'selected' }}>Seleccione
                                        </option>
                                        @foreach ($car_brands as $car_brand)
                                            <option value="{{ $car_brand->id }}"
                                                {{ old('car_brand_id') == $car_brand->id ? 'selected' : '' }}>
                                                {{ $car_brand->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('car_brand_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Modelo</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="Ingrese nombre del modelo"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button>
                                <a href="{{ route('car_model.index') }}" class="btn btn-secondary"><i
                                        class="fa fa-arrow-left"></i> Volver</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
