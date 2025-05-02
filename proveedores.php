<?php
include 'test_connection.php'; // Incluye la conexión a la base de datos

// Función para agregar un proveedor
function agregarProveedor($nombre, $direccion, $telefono, $email, $rnc, $estado) {
    global $pdo;

    try {
        $sql = "INSERT INTO Proveedor (nombre, direccion, telefono, email, rnc, estado) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $direccion, $telefono, $email, $rnc, $estado]);

        echo "Proveedor agregado correctamente.";
    } catch (PDOException $e) {
        echo "Error al agregar proveedor: " . $e->getMessage();
    }
}

// Función para actualizar un proveedor existente
function actualizarProveedor($idProveedor, $nombre, $direccion, $telefono, $email, $rnc, $estado) {
    global $pdo;

    try {
        $sql = "UPDATE Proveedor SET nombre = ?, direccion = ?, telefono = ?, email = ?, rnc = ?, estado = ? 
                WHERE idProveedor = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $direccion, $telefono, $email, $rnc, $estado, $idProveedor]);

        echo "Proveedor actualizado correctamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar proveedor: " . $e->getMessage();
    }
}

// Función para eliminar un proveedor
function eliminarProveedor($idProveedor) {
    global $pdo;

    try {
        $sql = "DELETE FROM Proveedor WHERE idProveedor = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idProveedor]);

        echo "Proveedor eliminado correctamente.";
    } catch (PDOException $e) {
        echo "Error al eliminar proveedor: " . $e->getMessage();
    }
}

// Verificar si el formulario fue enviado para agregar un proveedor
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_proveedor'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $rnc = $_POST['rnc'];
    $estado = $_POST['estado'];

    agregarProveedor($nombre, $direccion, $telefono, $email, $rnc, $estado);
}
?>
