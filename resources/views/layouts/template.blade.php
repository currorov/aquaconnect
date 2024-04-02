<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaConnect</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @yield('styles')
    <link href="/css/main.min.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="/img/logo.png" alt="Logo" class="img-fluid" style="max-height: 80px;">
        </a>
        <div class="mx-auto text-center d-flex justify-content-center align-items-center" style="height: 80px; padding-left: 20%;">
            <span class="navbar-text h1 text-white">AquaConnect</span>
        </div>
        <div class="navbar-nav ml-auto">
            <button class="nav-item btn btn-primary" href="#">Iniciar sesión</button>
            <button class="nav-item btn btn-primary ml-3" href="#">Registrarse</button>
        </div>
    </nav>

    <!-- Contenido principal -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer text-center">
        <p>&copy; 2024 AquaConnect - Todos los derechos reservados</p>
    </footer>

</body>
</html>
