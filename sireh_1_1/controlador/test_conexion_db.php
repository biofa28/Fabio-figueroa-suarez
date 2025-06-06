<?php
// test_conexion_db.php
header('Content-Type: text/plain'); // Para ver la salida fácilmente

echo "Iniciando prueba de conexión a la base de datos...\n\n";

// Incluir la clase de conexión a la base de datos
require_once __DIR__ . '/../config/database.php'; // Asegúrate que esta ruta sea correcta

echo "Intentando conectar a la base de datos sireh-db...\n";

$conexion = null;
try {
    $conexion = BaseDeDatos::conectar(); // Llama al método estático
    if ($conexion) {
        echo "¡Conexión Exitosa!\n";
        echo "Host info: " . $conexion->host_info . "\n";
        echo "Server version: " . $conexion->server_info . "\n";
        echo "Client version: " . $conexion->client_info . "\n";

        // Intentar una consulta simple a la tabla Rol (que debería existir y tener datos)
        echo "\nIntentando consultar la tabla 'Rol'...\n";
        $resultado = $conexion->query("SELECT * FROM Rol LIMIT 1");

        if ($resultado) {
            echo "Consulta a la tabla 'Rol' exitosa.\n";
            if ($resultado->num_rows > 0) {
                echo "Se encontró al menos un rol.\n";
                $fila = $resultado->fetch_assoc();
                echo "Primer rol encontrado: Id_Rol = " . $fila['Id_Rol'] . ", Nom_Rol = " . $fila['Nom_Rol'] . "\n";
            } else {
                echo "La tabla 'Rol' está vacía o no se encontraron datos.\n";
            }
            $resultado->free();
        } else {
            echo "Error al consultar la tabla 'Rol': " . $conexion->error . "\n";
        }

        $conexion->close();
        echo "\nConexión cerrada.\n";

    } else {
        echo "La función BaseDeDatos::conectar() no devolvió un objeto de conexión válido.\n";
        // Esto podría indicar un problema dentro de la función conectar() en database.php
    }
} catch (mysqli_sql_exception $e) {
    echo "Excepción de MySQLi al conectar: " . $e->getMessage() . "\n";
    echo "Código de error: " . $e->getCode() . "\n";
} catch (Exception $e) {
    echo "Error General al intentar conectar: " . $e->getMessage() . "\n";
    // Esto podría incluir errores de 'die()' en tu database.php
    // Imprimir el contenido de database.php para depuración
    echo "\nContenido de config/database.php:\n";
    // Comentado por seguridad, pero útil para depurar si tienes control total del entorno
    // readfile(__DIR__ . '/../config/database.php');
}

echo "\nPrueba de conexión finalizada.\n";
?>