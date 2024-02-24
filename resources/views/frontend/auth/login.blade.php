@extends('frontend.layout.main')

@section('content')
    <h1 class="main-ttl"><span>Entrar</span></h1>
    <div class="auth-wrap">
        <div class="auth-col">
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

            <form method="POST" class="register" action="{{ route('customer.login') }}">
                @csrf
                <p>
                    <label for="email">Email <span class="required">*</span></label><input type="email" id="email"
                        name="email" value="{{ old('email') }}">
                </p>
                <p>
                    <label for="password">Contraseña <span class="required">*</span></label><input type="password"
                        id="password" name="password">
                </p>
                <p class="auth-submit">
                    <button type="submit" class="btn btn-primary pull-right" style="background-color: #373d54;">Iniciar
                        sesión</button>
                </p>
            </form>
        </div>
    </div>
@endsection
