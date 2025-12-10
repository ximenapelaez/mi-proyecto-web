<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "SpaSystem";

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar un elemento del carrito
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST["id"]);
    $query = "DELETE FROM Carrito WHERE id = $id";
    $conn->query($query);
}

$conn->close();
?>
