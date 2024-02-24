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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Se encontraron los siguientes errores:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <form action="{{ route('frontend.my_account.save') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="full_name">Nombre</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    value="{{ $customer->full_name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $customer->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary"
                                style="background-color: #373d54; margin-top: 10px;">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
