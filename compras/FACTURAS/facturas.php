<?php
include 'test_connection.php'; // Conexión a la base de datos

// Función para agregar una factura
function agregarFactura($idOrdenCompra, $fechaFactura, $montoTotal, $estadoFactura) {
    global $pdo;

    try {
        $sql = "INSERT INTO Factura (idOrdenCompra, fechaFactura, montoTotal, estadoFactura) 
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idOrdenCompra, $fechaFactura, $montoTotal, $estadoFactura]);

        echo "Factura registrada correctamente."; // Mensaje de éxito
    } catch (PDOException $e) {
        echo "Error al registrar factura: " . $e->getMessage();
    }
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_factura'])) {
    $idOrdenCompra = $_POST['idOrdenCompra'];
    $fechaFactura = $_POST['fechaFactura'];
    $montoTotal = $_POST['montoTotal'];
    $estadoFactura = $_POST['estadoFactura'];

    // Llamar a la función para agregar la factura
    agregarFactura($idOrdenCompra, $fechaFactura, $montoTotal, $estadoFactura);
}
?>
