<?php
include 'test_connection.php'; // Conexión a la base de datos

// Función para generar el informe basado en los filtros
function generarInforme($fechaInicio, $fechaFin, $idProveedor) {
    global $pdo;

    // Construcción de la consulta SQL con los filtros
    $sql = "SELECT o.idOrdenCompra, o.fechaOrden, o.montoTotal, o.estadoOrden, p.nombre AS proveedor, p.telefono, p.email, pa.monto AS montoPago
            FROM OrdenCompra o
            INNER JOIN Proveedor p ON o.idProveedor = p.idProveedor
            LEFT JOIN Pago pa ON o.idOrdenCompra = pa.idOrdenCompra
            WHERE o.fechaOrden BETWEEN ? AND ?";

    if ($idProveedor) {
        $sql .= " AND o.idProveedor = ?";
    }

    $stmt = $pdo->prepare($sql);

    if ($idProveedor) {
        $stmt->execute([$fechaInicio, $fechaFin, $idProveedor]);
    } else {
        $stmt->execute([$fechaInicio, $fechaFin]);
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Devuelve todos los registros encontrados
}

// Verificar si los filtros han sido enviados
if (isset($_GET['fechaInicio']) && isset($_GET['fechaFin'])) {
    $fechaInicio = $_GET['fechaInicio'];
    $fechaFin = $_GET['fechaFin'];
    $idProveedor = $_GET['proveedor'] ?: null; // Si no se selecciona proveedor, se pasa como null

    // Obtener los resultados del informe
    $informes = generarInforme($fechaInicio, $fechaFin, $idProveedor);
}
?>

<!-- Mostrar el informe en una tabla -->
<div class="container mt-5">
    <h3>Informe de Compras</h3>
    <?php if (isset($informes) && count($informes) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Orden</th>
                    <th>Fecha de Orden</th>
                    <th>Proveedor</th>
                    <th>Monto Total</th>
                    <th>Estado de Orden</th>
                    <th>Monto Pago</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($informes as $informe): ?>
                    <tr>
                        <td><?php echo $informe['idOrdenCompra']; ?></td>
                        <td><?php echo $informe['fechaOrden']; ?></td>
                        <td><?php echo $informe['proveedor']; ?></td>
                        <td><?php echo $informe['montoTotal']; ?></td>
                        <td><?php echo $informe['estadoOrden']; ?></td>
                        <td><?php echo $informe['montoPago']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron resultados para los filtros proporcionados.</p>
    <?php endif; ?>
</div>
