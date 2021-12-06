@extends('adminlte::page')

@section('title', 'FetramsWEB')

@section('content_header')
    <h4><span class="form-label badge  badge  bg-success bg-light">Adjuntar Documentos Empresa :
            {{ $empresa->nombreusuario }} </span></h4>
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
        <a href="/empresas/{{ $empresa->id }}/show" class="btn btn-primary">Volver</a>
        <hr>
        <div class="card border-success mb-3">
            <div class="card-body">
                <form action="/empresas/{{ $empresa->id }}/saveUpload" method="POST" enctype="multipart/form-data"
                    class="row g-3">
                    @csrf
                    <div class="col-md-12">
                        <label for="formFileMultiple" class="form-label badge badge-danger">Selecciona los documentos para
                            cargar en formatos(.jpeg, .png, .pdf, .bmp) </label>
                        <input class="form-control form-control-lg"" type="file" id="files[]" name="files[]" multiple
                            required>
                        <input type="hidden" value="{{ $empresa->documento }}" name="docto" id="docto">
                        @error('files[]')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Cargar Archivos</button>
                    </div>
                </form>
            </div>

        </div>
        @include("errores")
        @include("notificacion")

    </body>

    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
