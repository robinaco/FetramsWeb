@extends('adminlte::page')

@section('title', 'FetramsWEB')

@section('content_header')
    <h4><span class="form-label badge  badge  bg-success bg-light">Listado Polizas Registradas</span></h4>
@stop

@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </head>
    <body>
        <a href="/empresas" class="btn btn-primary">Volver Listado Empresas</a>
        <hr>
        <div class="card-header">
            <table class="table table-striped table-hover" id="polizas">
                <thead>
                    <tr>
                        <th scope="col">Empresa Beneficiaria</th>
                        <th scope="col">Aseguradora</th>
                        <th scope="col">Tipo Poliza</th>
                        <th scope="col"># Poliza</th>
                        <th scope="col">Vigencia Inicial</th>
                        <th scope="col">Vigencia Final</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($polizas as $poliza)
                        <tr class="">
                            <td class="">{!! $poliza->nombreusuario !!}</td>
                            <td class="        ">{!! $poliza->aseguradora !!}</td>
                            <td class="">{!! $poliza->tipopoliza !!}
                            </td>
                            <td class="">{!! $poliza->numpoliza !!}</td>
                            <td class="       ">{!! $poliza->fechavigini !!}</td>
                            <td class=" ">{!! $poliza->fechavigfin !!}</td>
                            <td class=" ">
                                 {{-- <a href="/polizas/{{ $poliza->id }}/show" class="btn btn-warning"
                                    title="Ver Detalle Poliza"><i><span class="fas fa-fw fa-eye"></span></i></a> --}}
                                <a href="/polizas/{{ $poliza->id }}/edit" class="btn btn-success"
                                    title="Editar Información"><i><span class="fas fa-fw fa-pen"></span></i></a>
                                {{-- <a class="btn btn-danger" title="Borrar Registro"
                                    href="/polizas/{{ $poliza->id }}/destroy"><i><span href=""><i><span
                                                    class="fas fa-fw fa-trash"></span></i></a>  --}}
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-2">
                @php
                    $link = 'https://www.mcaypcainformatica.com.co/';
                    $hoy = date('Y');
                    echo $hoy . '-' . 'Desarrollado ' . '<a href=' . $link . " title='Soluciones Informáticas'>MCA&PCA</a>";
                @endphp
            </div>
        </div>
        @include("errores")
        @include("notificacion")
    </body>

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
@stop
@section('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js">
    </script>
    <script>
        $('#polizas').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
                "lengthMenu": "Ver _MENU_ Registros por página.",
                "zeroRecords": "No existen registros con ese criterio de busqueda.",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles.",
                "infoFiltered": "(Filtrando de _MAX_ registros totales.)",
                "search": 'Buscar:',
                "paginate": {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
    </script>

@stop