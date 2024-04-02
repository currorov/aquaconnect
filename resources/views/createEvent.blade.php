@extends('layouts.template')

@section('styles')

@endsection
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4 text-dark">CREAR EVENTO</h1>
        <div class="form-group">
            <label for="nombre">Título del Evento</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fecha">Fecha del Evento</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="form-group col-md-6">
                <label for="hora">Hora del Evento</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>
        </div>
        <div class="form-group">
            <label for="lugar">Lugar del Evento</label>
            <input type="text" class="form-control" id="lugar" name="lugar" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción del Evento</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Crear Evento</button>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


@endsection