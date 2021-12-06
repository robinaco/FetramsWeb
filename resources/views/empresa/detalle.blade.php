@extends('adminlte::page')

@section('title', 'FetramsWEB')

@section('content_header')
    <h4><span class="form-label badge  badge  bg-success bg-light">Información General
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </head>

    <body>

        <a href="/empresas" class="btn btn-primary">Volver Listado Empresas</a>
        <hr>
        <div class="card border-success mb-3" style="padding:1%">
            <div class="card-body">
                <form class="row g-3" action="/empresas/{{ $empresa->id }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Nombre -- Razón
                            Social</label>
                        <input type="text" class="form-control text-danger" id="name" name="name"
                            value="{{ $empresa->nombreusuario }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label badge  badge  bg-success bg-light">Tipo
                            Documento</label>
                        <input type="text" class="form-control text-danger" readonly value="{{ $empresa->tipodocto }}">

                    </div>
                    <div class="col-md-4">
                        <label for="inputAddress" class="form-label badge  badge  bg-success bg-light">Documento</label>
                        <input type="number" class="form-control text-danger" id="docto" name="docto"
                            value="{{ $empresa->documento }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress2" class="form-label badge  badge  bg-success bg-light ">Email</label>
                        <input type="email" class="form-control text-danger" id="email" name="email"
                            value="{{ $empresa->email }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label badge  badge  bg-success bg-light">Dirección</label>
                        <input type="text" class="form-control text-danger" id="dir" name="dir"
                            value="{{ $empresa->direccion }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label badge  badge  bg-success bg-light">Municipio</label>
                        <input type="text" class="form-control text-danger" id="municipio" name="municipio" readonly
                            value="{{ $empresa->municipio }}">
                    </div>
                    <div class="col-md-8">
                        <label for="inputState" class="form-label badge  badge  bg-success bg-light">Nombre Presidente --
                            Representante</label>
                        <input type="text" class="form-control text-danger" id="replegal" name="replegal"
                            value="{{ $empresa->presidente }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">Telefono --
                            Celular</label>
                        <input type="text" class="form-control text-danger" id="tel" name="tel"
                            value="{{ $empresa->telefono }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">Habilitación</label>
                        <input type="text" class="form-control text-danger" readonly
                            value="{{ $empresa->habilitacion }}">

                    </div>
                    <div class="col-md-4">
                        <label for="inputZip" class="form-label badge  badge  bg-success bg-light">Permiso</label>
                        <input type="text" class="form-control text-danger" readonly value="{{ $empresa->permiso }}">
                    </div>
                </form>
            </div>



            <div class="card border-success mb-3" style="padding:1%">
                <div class="card-body">
                    <h4><span class="form-label badge  badge  bg-success bg-light">Documentación Adjunta Empresa</span> <a
                            href="/empresas/{{ $empresa->id }}/fileUpload" class="btn btn-warning"
                            title="Cargar Adjuntos">Cargar Documentos <i><span
                                class="fas fa-fw fa-file"></span></i></a></h4>
                    <table class="table table-md table-success table-hover id="">
                                                    <thead>
                                                        <tr>
                                                            <th scope=" col">Item</th>
                        <th scope="col">Documento Adjunto</th>
                        <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($archivos as $archivo)
                                <tr class="">
                                    <td class=""><span class="badge bg-dark btn btn-lg">
                                            {{ $loop->index + 1 }}
                                        </span></td>
                                    <td class="">
                                        <a href="javascript:void(0)"> {{ $archivo->namefile }}</a>
                                    </td>
                                    <td class="">
                                        <a class="btn btn-danger" title="Borrar Registro"
                                            href="/empresas/{{ $archivo->id }}/deleteFile">Borrar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card border-success mb-3" style="padding:1%">

                <div class="card-body">
                    <h4><span class="form-label badge  badge  bg-success bg-light">Polizas Registradas Empresa</span>
                        <a href="/empresas/{{ $empresa->id }}/CrearPoliza" class="btn btn-warning"
                            title="Cargar Adjuntos">Agregar Póliza <i><span
                                class="fas fa-fw fa-file-alt"></span></i></a>
                    </h4>
                    <table class="table table-md table-success table-hover" id="">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Aseguradora</th>
                                <th scope="col"># Poliza</th>
                                <th scope="col">Vigencia Inicial</th>
                                <th scope="col">Vigencia Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polizas as $poliza)

                                <tr class="">
                                    <td class=""><span class="badge bg-dark btn btn-lg">
                                            {{ $loop->index + 1 }}
                                        </span></td>
                                    <td class="">
                                        <span>{{ $poliza->aseguradora }} </span>
                                    </td>
                                    <td class="">
                                        <span>{{ $poliza->numpoliza }} </span>
                                    </td>
                                    <td class="">
                                        <span>{{ $poliza->fechavigini }} </span>
                                    </td>
                                    <td class="">
                                        <span>{{ $poliza->fechavigfin }} </span>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card border-success mb-3" style="padding:1%">
                <div class="card-body">
                    <h4><span class="form-label badge  badge  bg-success bg-light">Vehiculos Registrados Empresa</span>
                        <a href="/empresas/{{ $empresa->id }}/CrearVehiculo" class="btn btn-warning" title="Agregar Vehiculo">Agregar Vehiculo <i><span
                            class="fas fa-fw fa-car"></span></i></a>
                    </h4>
                    <table class="table table-md table-success table-hover" id="">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Propietario</th>
                                <th scope="col">Cedula Propietario</th>
                                <th scope="col">Celular Contacto</th>
                                <th scope="col">Polizas Registradas</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)

                                <tr class="">
                                    <td class=""><span class="badge bg-dark btn btn-lg">
                                            {{ $loop->index + 1 }}
                                        </span></td>
                                    <td class="">
                                        <span>{{ $vehiculo->placa }} </span>
                                    </td>
                                    <td class="">
                                        <span>{{ $vehiculo->modelo }} </span>
                                    </td>
                                    <td class="">
                                        <span>{{ $vehiculo->propietario }} </span>
                                    </td>
                                    <td class="">
                                        <span>{{$vehiculo->docpropietario }} </span>
                                    </td>
                                    <td class="">
                                        <span>{{$vehiculo->celular}} </span>
                                    </td>
                                    
                                    <td class="">
                                        <span>{{$vehiculo->polizas}} </span>
                                    </td>
                                    <td class="">
                                        <a href="/empresas/{{ $vehiculo->id }}/EditarVehiculo" class="btn btn-success"
                                            title="Editar Información"><i><span class="fas fa-fw fa-pen"></span></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>



    </script>

@stop
