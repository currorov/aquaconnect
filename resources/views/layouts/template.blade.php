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
    <header class="fixed-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="/img/logo.png" alt="Logo" class="img-fluid" style="max-height: 80px; margin-left: 50px">
            </a>
            <div class="mx-auto text-center d-flex justify-content-center align-items-center" style="height: 80px;">
                <span class="navbar-text h1 text-white">AquaConnect</span>
            </div>
        </nav>
    </header>
    <div class="contenido">
        <!-- Contenido principal -->
        @yield('content')
    </div>
    <!-- Footer -->
    <footer class="footer text-center">
        <p>&copy; 2024 AquaConnect - Todos los derechos reservados</p>
    </footer>

</body>
</html>
