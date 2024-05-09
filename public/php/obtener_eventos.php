<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
$eventId = $_GET['id'];

$conexion = new mysqli("localhost", "root", "", "aquaconnect");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT * FROM users_events WHERE id_event = $eventId";

$resultado = $conexion->query($query);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Convertir los resultados en un array asociativo
    $resultados = $resultado->fetch_all(MYSQLI_ASSOC);

    // Devolver los resultados como JSON
    echo json_encode($resultados);
} else {
    // Si hay un error en la consulta, devolver un mensaje de error
    echo json_encode(array('error' => 'Error en la consulta SQL'));
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
