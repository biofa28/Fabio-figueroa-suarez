<?php
// Incluimos el archivo que contiene la CLASE Reserva.
require_once '../modelo/Reservas.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $json = file_get_contents('php://input');
  $data = json_decode($json, true);

  if ($data) {
    // --- AJUSTE REALIZADO AQUÍ ---
    // Creamos un nuevo objeto (una instancia) de la clase Reserva.
    // Antes, esta línea faltaba, por lo que la variable $reserva no existía.
    $reserva = new Reserva(); 

    // Ahora sí podemos llamar a la función del objeto.
    $result = $reserva->crearReservaDesdePago($data);
    
    if ($result === true) {
      echo json_encode(['status' => 'ok', 'message' => 'Reserva registrada correctamente en la tabla principal.']);
    } else {
      http_response_code(500); // Internal Server Error
      echo json_encode(['status' => 'error', 'message' => $result]);
    }
  } else {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos o no recibidos']);
  }
} else {
  http_response_code(405); // Method Not Allowed
  echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}