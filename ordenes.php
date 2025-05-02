<?php
include 'test_connection.php'; // Incluye la conexión a la base de datos

// Función para agregar una orden de compra
function agregarOrdenCompra($idProveedor, $fechaOrden, $montoTotal, $estadoOrden) {
    global $pdo;

    try {
        $sql = "INSERT INTO OrdenCompra (idProveedor, fechaOrden, montoTotal, estadoOrden) 
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idProveedor, $fechaOrden, $montoTotal, $estadoOrden]);

        echo "Orden de compra registrada correctamente."; // Mensaje de éxito
    } catch (PDOException $e) {
        echo "Error al registrar orden de compra: " . $e->getMessage();
    }
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_orden'])) {
    $idProveedor = $_POST['idProveedor'];
    $fechaOrden = $_POST['fechaOrden'];
    $montoTotal = $_POST['montoTotal'];
    $estadoOrden = $_POST['estadoOrden'];

    // Llamar a la función para agregar la orden de compra
    agregarOrdenCompra($idProveedor, $fechaOrden, $montoTotal, $estadoOrden);
}
?>
