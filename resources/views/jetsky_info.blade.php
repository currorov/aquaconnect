<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Jetsky</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>Hola {{ $user->name }},</h2>

    <p>Has solicitado información sobre la moto de agua con matrícula: <strong>{{ $jetsky->matricula }}</strong>.</p>

    <p>Para obtener más información sobre este Jetsky, ponte en contacto con el propietario:</p>
    
    <ul>
        <li><strong>Propietario:</strong> {{ $userjetsky->name }} {{ $userjetsky->surname }}</li>
        <li><strong>Correo electrónico:</strong> <a href="mailto:{{ $userjetsky->email }}">{{ $userjetsky->email }}</a></li>
    </ul>

    <p>Gracias,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
