@extends('layouts.template')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link href="/css/createEvent.css" rel="stylesheet">
@endsection
@section('content')
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="create-container">
    <h1 class="text-center mb-4 text-dark">CREAR EVENTO</h1>
    <form action="{{ route('submitCreateEvent') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre">Título del Evento</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fecha">Fecha del Evento</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                @error('fecha')
                    <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="hora">Hora del Evento</label>
                <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora') }}" required>
                @error('hora')
                    <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div id="map"></div>
            <label for="lugar">Ubicación:</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}">
            <input type="range" min="-90" max="90" step="0.000001" id="latitude"  value="{{ old('latitude') }}" hidden>
            <input type="range" min="-180" max="180" step="0.000001" id="longitude" value="{{ old('longitude') }}" hidden>
        
            @error('latitude')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="lugar">Descripción de la Ubicación</label>
            <textarea type="text" class="form-control" id="desc_ubi" name="desc_ubi" value="{{ old('desc_ubi') }}" required></textarea>
            @error('desc_ubi')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción del Evento</label>
            <textarea class="form-control" id="desc_event" name="desc_event" rows="3" value="{{ old('desc_event') }}" required></textarea>
            @error('desc_event')
                <p class="text-sm md:text-base text-red-500" >{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">Crear Evento</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!--Para el mapa-->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="/js/mapCreateEvent.js"></script>


</body>


@endsection