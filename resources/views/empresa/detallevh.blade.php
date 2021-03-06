@extends('adminlte::page')

@section('title', 'FetramsWEB')

@section('content_header')
<h4><span class="form-label badge  badge  bg-success bg-light">Información General Vehiculo
        {{ $vehiculo->placa }}</span></h4>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <a href="/empresas/{{ $vehiculo->idempresa }}/show"" class=" btn btn-primary">Volver a Información Empresa</a>
    <hr>
    <div class="card border-secondary mb-3" style="padding:1%">
        <div class="card-body">
            <form class="row g-3" action="/empresas/{{ $vehiculo->id }}/UpdateVehiculo" method="POST">
                @csrf
                <input type="hidden" value="{{ $vehiculo->idempresa }}" name="idempresa" id="idempresa">
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Marca</label>
                    <select id="marca" name="marca" class="form-control">
                        <option value="0">Seleccione una Marca</option>
                        @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->descripcion}}</option>
                        @endforeach
                    </select>
                    @error('marca')<small>* {{ $message }}</small>@enderror
                </div>

                <div class="col-md-4">
                    <label for="inputState" class="form-label  badge  bg-success bg-light">* Modelo</label>
                    <select name="modelo" id="modelo" class="form-control">
                        <option value="0">Seleccione un Modelo</option>
                        @for ($year = 2000; $year <= date('Y'); $year++) <option value="{{ $year }}">{{ $year }}
                            </option>
                            @endfor
                    </select>
                    @error('modelo')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-2">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa" value="{{ $vehiculo->placa}}" min="6">
                    @error('placa')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-2">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Kilometraje</label>
                    <input type="number" class="form-control" id="km" name="km" value="{{ $vehiculo->kilometros}}">
                    @error('km')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-3">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Chasis</label>
                    <input type="text" class="form-control" id="chasis" name="chasis" value="{{ $vehiculo->chasis}}">
                    @error('chasis')<small>* {{ $message }}</small>@enderror
                </div>

                <div class="col-md-3">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">Motor</label>
                    <input type="text" class="form-control" id="motor" name="motor" value="{{ $vehiculo->motor}}">
                </div>
                <div class="col-md-3">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Matricula</label>
                    <input type="text" class="form-control" id="matricula" name="matricula"
                        value="{{ $vehiculo->numatricula}}">
                    @error('matricula')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-3">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Tipo Servicio</label>
                    <select name="tservicio" id="tservicio"  class="form-control">
                    <option value="0">Seleccione un servicio</option>
                    <option value="PT">Particular</option>
                    <option value="PU">Público</option>
                    <option value="ES">Especial</option>
                    </select>
                    @error('tservicio')<small>* {{ $message }}</small>@enderror
                </div>

                <div class="col-md-4">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Tecnicomecanica</label>
                    <input type="text" class="form-control" id="tecno" name="tecno" value="{{ $vehiculo->tecnomec}}">
                    @error('tecno')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* # Soat</label>
                    <input type="text" class="form-control" id="soat" name="soat" value="{{ $vehiculo->numsoat}}">
                    @error('soat')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* # Licencia Conduccion</label>
                    <input type="text" class="form-control" id="lcn" name="lcn" value="{{ $vehiculo->lconduccion}}">
                    @error('lcn')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Nombre Propietario</label>
                    <input type="text" class="form-control" id="namep" name="namep" value="{{ $vehiculo->propietario}}">
                    @error('namep')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Documento Identidad</label>
                    <input type="number" class="form-control" id="di" name="di" value="{{ $vehiculo->docpropietario}}">
                    @error('di')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Celular -- Telefono</label>
                    <input type="number" class="form-control" id="celtel" name="celtel" value="{{ $vehiculo->celular}}" min="7">
                    @error('celtel')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">* Poliza Seguros</label>
                
                    <select  id="policy" name="policy[]" multiple="" class="form-control">
                        @foreach ($policy as $policye)
                        <option value="{{ $policye->tipopoliza }}">{{ $policye->tipopoliza}}</option>
                        @endforeach
                    </select>
                    @error('policy')<small>* {{ $message }}</small>@enderror
                </div> 
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label badge  bg-success bg-light">Observaciones</label>
                  <textarea name="obs" id="obs" cols="30" rows="4" class="form-control">{{ $vehiculo->observaciones}}</textarea>
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



</script>

@stop