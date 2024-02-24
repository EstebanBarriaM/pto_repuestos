@extends('backend.layout.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Compras </h1>
                </div><!-- /.col -->
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
                                        <th>#</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Metodo pago</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer }}</td>
                                            <td>${{ $order->total }}</td>
                                            <td>
                                                @if ($order->payment_method == 'debit')
                                                    Debito
                                                @else
                                                    Credito
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->state == 'pending')
                                                    <span class="badge badge-warning">Pendiente</span>
                                                @elseif($order->state == 'paid')
                                                    <span class="badge badge-success">Pagado</span>
                                                @else
                                                    <span class="badge badge-danger">Rechazado</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary btn-order-detail"
                                                    data-order-items='@json($order->items)'>
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
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

        <!-- Modal -->
        <div class="modal fade" id="itemsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle</h5>
                    </div>
                    <div class="modal-body" id="modal-body-items"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
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

            $('.btn-order-detail').click(function() {
                let items = $(this).data('order-items');
                $('#modal-body-items').empty();
                let html = `<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>

                    <tbody>
                        ${items.map(function (item) {
                            return `<tr>
                                <td>${item.product}</td>
                                <td>${item.quantity}</td>
                                <td>${item.price}</td>
                            </tr>`
                        }).join('')}
                    </tbody>
                </table>`;
                $('#modal-body-items').html(html);
                $('#itemsModal').modal('show');
            });
        });
    </script>
@endsection
