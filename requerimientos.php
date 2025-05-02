<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'test_connection.php'; // Asegúrate de que este archivo de conexión a la base de datos esté correcto.

// Función para agregar un requerimiento
function agregarRequerimiento($fecha, $estado, $descripcion, $cantidad, $observaciones) {
    global $pdo;

    try {
        $sql = "INSERT INTO Requerimiento (fecha, estado, descripcion, cantidad, observaciones) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fecha, $estado, $descripcion, $cantidad, $observaciones]);

        echo "Requerimiento agregado correctamente.";
    } catch (PDOException $e) {
        echo "Error al agregar requerimiento: " . $e->getMessage();
    }
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_requerimiento'])) {
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $observaciones = $_POST['observaciones'];

    // Agregar el requerimiento a la base de datos
    agregarRequerimiento($fecha, $estado, $descripcion, $cantidad, $observaciones);
    // Redirige de vuelta a la página del formulario para evitar el reenvío del formulario
    header("Location: requerimientos.html");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_requerimiento'])) {
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $observaciones = $_POST['observaciones'];

    // Imprimir los valores para verificar que los datos llegan correctamente
    echo "Fecha: " . $fecha . "<br>";
    echo "Estado: " . $estado . "<br>";
    echo "Descripción: " . $descripcion . "<br>";
    echo "Cantidad: " . $cantidad . "<br>";
    echo "Observaciones: " . $observaciones . "<br>";

    // Aquí debes agregar la función para insertar en la base de datos
}
$sql = "INSERT INTO Requerimiento (fecha, estado, descripcion, cantidad, observaciones) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$fecha, $estado, $descripcion, $cantidad, $observaciones]);

?>
