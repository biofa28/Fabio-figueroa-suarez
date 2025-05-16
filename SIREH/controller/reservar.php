 <?php
include 'conexion.php';

$habitacion = $_POST['habitacion'];
$fecha = $_POST['fecha'];
$id_usuario = 1; // En práctica, se toma de la sesión

// Verificar si está disponible
$sql = "SELECT * FROM reservas WHERE id_habitacion = $habitacion AND fecha = '$fecha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Habitación no disponible para esa fecha.";
} else {
    $sql = "INSERT INTO reservas (id_usuario, id_habitacion, fecha) VALUES ($id_usuario, $habitacion, '$fecha')";
    if ($conn->query($sql) === TRUE) {
        echo "¡Reserva realizada!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
