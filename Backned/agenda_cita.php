
<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$host = "localhost";
$user = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$database = "SpaSystem";

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Procesar los datos enviados por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $service = $conn->real_escape_string($_POST["service"]);
    $date = $conn->real_escape_string($_POST["date"]);
    $time = $conn->real_escape_string($_POST["time"]);

    // Verificar si el cliente ya existe
    $queryCliente = "SELECT id FROM Clientes WHERE correo = '$email'";
    $resultCliente = $conn->query($queryCliente);

    if ($resultCliente->num_rows > 0) {
        // Cliente ya existe
        $cliente_id = $resultCliente->fetch_assoc()["id"];
    } else {
        // Insertar nuevo cliente
        $queryInsertCliente = "INSERT INTO Clientes (nombre, correo) VALUES ('$name', '$email')";
        if ($conn->query($queryInsertCliente) === TRUE) {
            $cliente_id = $conn->insert_id;
        } else {
            die("Error al insertar cliente: " . $conn->error);
        }
    }

    // Insertar la cita
    $queryCita = "INSERT INTO Citas (cliente_id, servicio_id, fecha, hora) VALUES ('$cliente_id', '$service', '$date', '$time')";
    if ($conn->query($queryCita) === TRUE) {
        echo "Cita agendada con éxito.";
    } else {
        die("Error al agendar cita: " . $conn->error);
    }
}
print_r($_POST);


// Cerrar conexión
$conn->close();
?>
