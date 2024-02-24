@extends('frontend.layout.main')

@section('content')
    <h1 class="main-ttl"><span>Contáctanos</span></h1>

    <div class="container">
        <div class="row">
            <img style="width: 60%; margin-top: 40px;" src="{{ asset('assets/frontend/img/logo.png') }}"
                alt="Logo PuertoRepuesto" class="img-responsive center-block">

            <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">
                <form>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Su nombre">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Su correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea name="message" id="message" rows="5" class="form-control" placeholder="Su mensaje"
                            style="resize: none;"></textarea>
                    </div>

                    <button type="button" class="btn btn-block btn-primary"
                        style="background-color: #373d54;">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
