<?php
// sireh_1_1/controlador/HabitacionController.php

// Incluimos el archivo del modelo que se conecta a la base de datos
// y obtiene los datos.
require_once '../modelo/HabitacionModel.php';

// Indicamos que la respuesta será en formato JSON.
header('Content-Type: application/json');

try {
    // Creamos una nueva instancia del modelo de habitación.
    $modelo = new HabitacionModel();
    
    // Llamamos a la función que obtiene los tipos de habitación.
    $tiposHabitacion = $modelo->obtenerTiposHabitacion();

    // Si todo sale bien, devolvemos una respuesta exitosa junto con los datos.
    echo json_encode(['success' => true, 'data' => $tiposHabitacion]);

} catch (Exception $e) {
    // Si algo sale mal, capturamos el error y enviamos una respuesta de error.
    http_response_code(500); // Código de error interno del servidor
    echo json_encode([
        'success' => false,
        'message' => 'Error del servidor: ' . $e->getMessage()
    ]);
}
?>