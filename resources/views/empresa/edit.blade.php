@extends('adminlte::page')

@section('title', 'FetramsWEB')

@section('content_header')
    <h4><span class="form-label badge  badge  bg-success bg-light">Actualizar Datos Empresa :
            {{ $empresa->nombreusuario }}</span></h4>
@stop

@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <a href="/empresas" class="btn btn-primary">Volver</a>
        <hr>
        <div class="card border-secondary mb-3" style="padding:1%">
            <i><span class="badge bg-danger">Campos marcados con * son obligatorios.</span></i>
            <div class="card-body">
                <form class="row g-3" action="/empresas/{{ $empresa->id }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Nombre -- Razón
                            Social</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $empresa->nombreusuario }}">
                        @error('name')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label badge  badge  bg-success bg-light">* Tipo
                            Documento</label>
                        <select name="tdocto" id="tdocto" class="form-control">
                            <option value="0">Seleccione Tipo</option>
                            <option value="NIT" {{ old('tdocto') == 'NIT' ? 'selected' : '' }}>NIT</option>
                            <option value="Cedula Ciudadania" {{ old('tdocto') == 'Cedula Ciudadania' ? 'selected' : '' }}>Cedula Ciudadania</option>
                            <option value="Cedula Extranjeria" {{ old('tdocto') == 'Cedula Extranjeria' ? 'selected' : '' }}>Cedula Extranjeria</option>
                            <option value="Tarjeta Extrangeria Extranjeria" {{ old('tdocto') == 'Tarjeta Extrangeria Extranjeria' ? 'selected' : '' }}>Tarjeta Extrangeria Extranjeria</option>
                            <option value="Pasaporte" {{ old('tdocto') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                            <option value="Tarjeta identidad" {{ old('tdocto') == 'Tarjeta identidad' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                            <option value="NUIP" {{ old('tdocto') == 'NUIP' ? 'selected' : '' }}>NUIP</option>
                            <option value="Registro Civil" {{ old('tdocto') == 'Registro Civil' ? 'selected' : '' }}>Registro Civil</option>
                        </select>
                        @error('tdocto')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputAddress" class="form-label badge  badge  bg-success bg-light">* Documento</label>
                        <input type="number" class="form-control" id="docto" name="docto" min="7"
                            value="{{ $empresa->documento }}">
                            @error('docto')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress2" class="form-label badge  badge  bg-success bg-light">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $empresa->email }}">
                        @error('email')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label badge  badge  bg-success bg-light">* Dirección</label>
                        <input type="text" class="form-control" id="dir" name="dir" value="{{ $empresa->direccion }}">
                        @error('dir')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label badge  badge  bg-success bg-light">* Municipio</label>
                        <select id="municipio" name="municipio" class="form-control">
                            <option value="0">Seleccione Municipio</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio }}">{{ $municipio }}</option>
                            @endforeach
                        </select>
                        @error('municipio')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-8">
                        <label for="inputState" class="form-label badge  badge  bg-success bg-light">* Nombre Presidente --
                            Representante</label>
                        <input type="text" class="form-control" id="replegal" name="replegal"
                            value="{{ $empresa->presidente }}">
                            @error('replegal')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Telefono --
                            Celular</label>
                        <input type="text" class="form-control" id="tel" name="tel" value="{{ $empresa->telefono }}">
                        @error('tel')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Habilitación</label>
                        <select name="hb" id="hb" class="form-control">
                            <option value="0">Seleccione una Opción</option>
                            <option value="Decreto">Decreto</option>
                            <option value="Resolución">Resolución</option>
                        </select>
                        @error('hb')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Nùmero Habilitación</label>
                        <input type="text" class="form-control" id="numh" name="numh" value="{{ $empresa->numhabilitacion }}">
                        @error('numh')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Permiso</label>
                        <select name="permiso" id="permiso" class="form-control">
                            <option value="0">Seleccione una Opción</option>
                            <option value="Decreto">Decreto</option>
                            <option value="Resolución">Resolución</option>
                        </select>
                        @error('permiso')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Nùmero Permiso</label>
                        <input type="text" class="form-control" id="numper" name="numper" value="{{ $empresa->numpermiso }}">
                        @error('numper')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-secondary">Actualizar Información</button>
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/app.css">

@stop

@section('js')
    <script>
        // console.log('Hi!');
    </script>
@stop
