@extends('backend.layout.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categorias</h1>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Nuevo
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
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td><img style="width: 80px;" class="img-fluid rounded"
                                                    src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST" style="display: inline-block;">
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
                    </div>
                </div>
            </div>
        </div>
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
