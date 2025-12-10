<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$database = "SpaSystem";

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del carrito para un cliente específico (puedes usar sesiones para cliente_id dinámico)
$cliente_id = 1; // Cambia según el cliente logueado
$query = "SELECT Carrito.id, Servicios.nombre, Carrito.cantidad, Servicios.precio 
          FROM Carrito 
          INNER JOIN Servicios ON Carrito.servicio_id = Servicios.id 
          WHERE Carrito.cliente_id = $cliente_id";
$result = $conn->query($query);

$carrito = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carrito[] = $row;
    }
}

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($carrito);

// Cerrar conexión
$conn->close();
?>
