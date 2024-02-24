@extends('backend.layout.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Productos </h1>
                </div><!-- /.col -->
                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Nuevo
                        registro</a>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('flash'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i>Notificación</h5>
                                    {{ session()->get('flash') }}
                                </div>
                            @endif

                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10%">Imagen</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Categoria</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th width="10%">Modelos compatibles</th>
                                        <th width="8%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td><img style="width: 80px;" class="img-fluid rounded"
                                                    src="{{ $product->mainImage() }}" alt="{{ $product->name }}"></td>
                                            <td> {{ $product->name }} </td>
                                            <td> {{ $product->productBrand->name }} </td>
                                            <td> {{ $product->category->name }} </td>
                                            <td> ${{ $product->price }} </td>
                                            <td> {{ $product->stock }} </td>
                                            <td>
                                                <a href="{{ route('products.compatible_models', $product->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-plus"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Desea eliminar el registro?');"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!-- /.container-fluid -->
    </section>
@endsection

@section('js')
    <script>
        $(function() {
            $("#table").DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                }
            });
        });
    </script>
@endsection
