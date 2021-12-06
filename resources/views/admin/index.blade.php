@extends('adminlte::page')

@section('title', 'FetramsWEB')

@section('content_header')
<h4>FETRAMSWEB</h4>
<h6>Resumen General</h6>
<hr>
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
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <form class="row g-3" action="" method="">
        <div class="row">
            <div class="col-sm-4">
                <div class="card border-warning text-center">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i><span class="fas fa-fw fa-city"></span></i> <b>Resumen Empresas</b>
                        </h5>
                        <p class="card-text">REGISTRADAS : <span class="badge bg-warning btn btn-lg"
                                title="Total Registradas">{{ $registradas }}</span></p>
                        <hr>
                        <p class="card-text ">INACTIVAS: <span class="badge bg-warning btn btn-lg"
                                title="Total Activas">{{ $contar }}</span></p>
                        <hr>
                        <p class="card-text ">ACTIVAS: <span class="badge bg-warning btn btn-lg"
                                title="Total Activas">{{ $activas }}</span> </p>
                        <hr>

                        <a href="{{ route('empresas.exportempresas') }}" class="btn btn-warning">Generar Reporte</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-success text-center">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i><span class="fas fa-fw fa-car-alt"></span></i> <b>Resumen
                                Vehiculos</b> </h5>
                        <p class="card-text">REGISTRAD0S : <span class="badge bg-success btn btn-lg"
                                title="Total Registradas">{{$vehiculos}}</span></p>
                        <hr>

                        <a href="{{ route('empresas.exportvehiculos') }}" class="btn btn-success">Generar Reporte</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card border-info text-center">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i><span class="fas fa-fw fa-file-alt"></span></i> <b>Resumen
                                Pòlizas</b> </h5>
                        <p class="card-text"> Registradas: <span class="badge bg-info btn btn-lg"
                                title="Total Registradas">{{ $contarp }}</span></p>
                        <hr>
                        <p class="card-text ">Vigentes : <span class="badge bg-info btn btn-lg"
                                title="Total Registradas">{{ $polizasv }}</span></p>
                        <hr>
                        <p class="card-text"> Vencidas: <span class="badge bg-info btn btn-lg"
                                title="Total Registradas">{{ $polizas }}</span></p>
                        <hr>

                        <p class="card-text ">Por Vencer: <span class="badge bg-info btn btn-lg"
                                title="Total Registradas">{{$registradasp}}</span></p>
                        <hr>

                        <a href="{{ route('empresas.exportpolizas') }}" class="btn btn-info">Generar Reporte</a>
                    </div>
                </div>
            </div>

        </div>


    </form>
    <hr>
    <div class="d-flex justify-content-center">
        <div class="p-2">
            @php
            $link = 'https://www.mcaypcainformatica.com.co/';
            $hoy = date('Y');
            echo $hoy . '-' . 'Desarrollado ' . '<a href=' . $link . " title=' Soluciones Informáticas'>MCA&PCA</a>";
            @endphp
        </div>
    </div>


</body>

</html>
@stop


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- <script>
    console.log('Hi!'); 
</script> --}}
@stop