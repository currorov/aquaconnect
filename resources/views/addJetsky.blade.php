@extends('layouts.template')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link href="/css/createEvent.css" rel="stylesheet">
@endsection
@section('content')
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .create-container {
            padding-bottom: 190px;
        }
    </style>
</head>
<body>
<div class="create-container">
    <h1 class="text-center mb-4 text-dark">SUBIR MOTO DE AGUA</h1>
    <form action="{{ route('submitAddJetsky') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="marca">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}" required>
            @error('nombre')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            </div>
            <div class="form-group col-md-4">
            <label for="modelo">Modelo:</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" required>
            @error('modelo')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="matricula">Matricula:</label>
                <input type="text" class="form-control" id="matricula" name="matricula" value="{{ old('matricula') }}" required>
                @error('matricula')
                    <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fecha">Fecha de matriculación:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                @error('fecha')
                    <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="hora">Horas totales:</label>
                <input type="number" class="form-control" id="hora" name="hora" value="{{ old('hora') }}" required>
                @error('hora')
                    <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required></textarea>
            @error('descripcion')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Foto de la moto de agua:</label>
            <input type="file" name="image" id="image" placeholder="image">
            @error('image')
                <p class="error-message">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">Subir moto de agua</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>


@endsection