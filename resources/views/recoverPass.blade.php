<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Jetsky</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>Hola {{ $user->name }},</h2>

    <p>Su nueva contraseña es: <strong>{{ $password }}</strong>.</p>

    <p>Gracias,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
