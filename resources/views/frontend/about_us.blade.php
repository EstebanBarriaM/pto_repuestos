@extends('frontend.layout.main')

@section('content')
    <h1 class="main-ttl"><span>Nosotros</span></h1>

    <div class="container">
        <div class="row">
            <img style="width: 60%; margin-top: 40px;" src="{{ asset('assets/frontend/img/logo.png') }}"
                alt="Logo PuertoRepuesto" class="img-responsive center-block">

            <p style="margin-top: 40px;">
                Somos <strong>PuertoRepuesto</strong>, una tienda especializada en repuestos y accesorios multimarca para tu
                automóvil.
            </p>
            <br>
            <p>
                Nuestro objetivo es construir la mejor plataforma digital para que puedas comprar repuestos con
                confianza, rapidez y seguridad, acompañado en todo momento por nuestros especialistas.
            </p>
            <br>
            <p>
                Para nuestros clientes, tenemos un catálogo de productos seleccionados en constante crecimiento, con
                información detallada y apoyo continuo de nuestros especialistas en la búsqueda y selección, para que la
                experiencia de compra sea siempre la mejor. Si no lo tenemos, lo buscamos. Nos caracteriza el trabajo que
                hacemos para que sepas si es compatible con tu auto y evitar errores y devoluciones.
            </p>
        </div>
    </div>
@endsection
