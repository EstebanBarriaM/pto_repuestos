@extends('frontend.layout.main')

@section('content')
    <h1 class="main-ttl"><span>Mi cuenta</span></h1>

    <div class="section-sb">
        <div class="section-sb-current">
            <ul class="section-sb-list" id="section-sb-list">
                <li class="categ-1">
                    <a href="{{ route('frontend.my_account.view') }}">
                        <span class="categ-1-label">Mis datos</span>
                    </a>
                </li>
                <li class="categ-1">
                    <a href="{{ route('frontend.my_orders') }}">
                        <span class="categ-1-label">Mis compras</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="section-cont">
        <div class="prod-items section-items">
            <div class="row">
                <div class="col-sm-12">
                    <div class="thumbnail" style="padding: 30px;">
                        @if ($orders->count())
                            <div class="cart-items-wrap">
                                <table class="cart-items">
                                    <thead>
                                        <tr>
                                            <td class="cart-image">#</td>
                                            <td class="cart-ttl">Total</td>
                                            <td class="cart-price">Metodo pago</td>
                                            <td class="cart-quantity">Estado</td>
                                            <td class="cart-summ">Detalle</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="cart-price">
                                                    <b>{{ $order->id }}</b>
                                                </td>
                                                <td class="cart-price">
                                                    <b>${{ $order->total }}</b>
                                                </td>
                                                <td class="cart-price">
                                                    @if ($order->payment_method == 'debit')
                                                        <b>Debito</b>
                                                    @else
                                                        <b>Credito</b>
                                                    @endif
                                                </td>
                                                <td class="cart-price">
                                                    @if ($order->state == 'pending')
                                                        <span class="label label-warning"
                                                            style="color: #fff;">Pendiente</span>
                                                    @elseif($order->state == 'paid')
                                                        <span class="label label-success" style="color: #fff;">Pagado</span>
                                                    @else
                                                        <span class="label label-danger"
                                                            style="color: #fff;">Rechazado</span>
                                                    @endif
                                                </td>
                                                <td class="cart-price">
                                                    <button type="button" class="btn btn-sm btn-primary btn-order-detail"
                                                        data-order-items='@json($order->items)'><i
                                                            class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {!! $orders->links('vendor.pagination.bootstrap-4') !!}
                        @else
                            <h2 style="font-size: 18px;">No encontramos compras.</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="itemsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle</h4>
                </div>
                <div class="modal-body" id="modal-body-items"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
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
