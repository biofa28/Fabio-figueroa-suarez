<?php
// Datos de conexión
$servidor = "localhost"; // Dirección del servidor (si estás usando localhost)
$usuario = "root"; // Usuario de MySQL (por defecto "root" en local)
$contraseña = ""; // Contraseña (por defecto está vacía en XAMPP)
$base_de_datos = "sireh"; // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos '$base_de_datos'.";
}
?>
