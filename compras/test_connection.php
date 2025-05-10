<?php
// Parámetros de conexión a la base de datos
$host = 'localhost';  // Usamos localhost en lugar de 127.0.0.1
$dbname = 'compras';   // Nombre de la base de datos
$user = 'root';        // Usuario de MySQL (por lo general es root en XAMPP)
$password = '';        // Contraseña en XAMPP (por defecto está vacía)

// Intentar conectar a la base de datos
try {
    // Establecer la conexión con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mostrar los errores si ocurre algún problema

    echo "Conexión exitosa a la base de datos.";  // Mensaje de éxito
} catch (PDOException $e) {
    // Si ocurre un error de conexión, mostrar el mensaje de error
    die("Error de conexión: " . $e->getMessage());
}
?>
