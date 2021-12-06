@extends('adminlte::page')

@section('title', 'FetramsWEB')

@section('content_header')
    <h4><span class="form-label badge  badge  bg-success bg-light">Agregar Póliza Empresa : {{ $empresa->nombreusuario }}
        </span></h4>
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
        <div class="card border-warning mb-3" style="padding:1%">
            <i><span class="badge bg-danger">Campos marcados con * son obligatorios.</span></i>
            <div class="card-title">
                <form class="row g-3" action="/empresas/SavePoliza" method="POST">
                    @csrf
                    <input type="hidden" value="{{$empresa->id}}" name="idempresa" id="idempresa">
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label badge  badge  bg-success bg-light">* Aseguradora</label>
                        <input type="text" class="form-control" name="aseguradora" id="aseguradora"
                            value="{{ old('aseguradora') }}">
                        @error('aseguradora')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label badge  badge  bg-success bg-light">Versión
                            Clausulado</label>
                        <input type="text" class="form-control" name="vc" id="vc" value="{{ old('vc') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputAddress" class="form-label badge  badge  bg-success bg-light">* Tipo Póliza</label>
                        <select name="tpoliza" id="tpoliza" class="form-control">
                            <option value="0">Seleccione Tipo Poliza</option>
                            <option value="RCEB" {{ old('tpoliza') == 'RCEB' ? 'selected' : '' }}>RESPONSABILIDAD CIVIL EXTRACONTRACTUAL BÁSICA</option>
                            <option value="RCEBVS" {{ old('tpoliza') == 'RCEBVS' ? 'selected' : '' }}> RESPONSABILIDAD CIVIL CONTRACTUAL BÁSICA PARA VEHÍCULOS DE SERVICIO
                            </option>
                            <option value="ACPETT" {{ old('tpoliza') == 'ACPETT' ? 'selected' : '' }}>ACCIDENTES PERSONALES EMPRESAS DE TRANSPORTE TERRESTRE</option>
                        </select>
                        @error('tpoliza')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label badge  badge  bg-success bg-light">
                            * # Póliza</label>
                        <input type="text" class="form-control" name="numpol" id="numpol" value="{{ old('numpol') }}">
                        @error('numpol')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label badge  badge  bg-success bg-light">
                            # Anexo</label>
                        <input type="text" class="form-control" name="numanx" id="numanx" value="{{ old('numanx') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label badge  badge  bg-success bg-light"># Certificado</label>
                        <input type="text" class="form-control" id="certificado" name="certificado" value="{{ old('certificado') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label badge  badge  bg-success bg-light"># Riesgo</label>
                        <input type="text" class="form-control" id="numriesgo" name="numriesgo" value="{{ old('numriesgo') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label badge  badge  bg-success bg-light">Tipo Documento</label>
                        <input type="text" class="form-control" id="tdocumento" name="tdocumento" value="{{ old('tdocumento') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Fecha de
                            Expedición</label>
                        <input type="date" id="fexp" name="fexp" class="form-control" value="{{ old('fexp') }}">
                        @error('fexp')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">Sucursal
                            Expedición</label>
                        <input type="text" id="suc" name="suc" class="form-control" value="{{ old('suc') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Vigencia Inicial
                            Desde:Horas</label>
                        <input type="time" id="vini" name="vini" class="form-control"  value="{{ old('vini') }}">
                        @error('vini')<small>* {{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Fecha Inicial
                            Desde</label>
                        <input type="date" id="fini" name="fini" class="form-control" value="{{ old('fini') }}">
                        @error('vini')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Fecha Final Hasta</label>
                        <input type="date" id="ffin" name="ffin" class="form-control" value="{{ old('ffin') }}">
                        @error('ffin')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">* Vigencia Final
                            Hasta:Horas</label>
                        <input type="time" id="vfhr" name="vfhr" class="form-control" value="{{ old('vfhr') }}">
                        @error('vfhr')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-12">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">Observaciones</label>
                        <textarea name="obs" id="obs" cols="30" rows="3" class="form-control" value="{{ old('obs') }}" ></textarea>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning ">Registrar Poliza</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop
