<?php
require_once __DIR__ . '/../modelo/Usuario.php';

// Es una buena práctica iniciar la sesión al principio si este script puede ser un punto de entrada.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json'); // Aseguramos que la respuesta sea JSON

$response = ['success' => false, 'message' => 'No se pudo procesar la solicitud.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nickOCorreo = trim($_POST['correo'] ?? ''); // El campo 'correo' del form se usa para nick o email
  $contrasena = $_POST['contrasena'] ?? '';

  if (empty($nickOCorreo) || empty($contrasena)) {
    $response['message'] = 'El correo/nick y la contraseña son obligatorios.';
    http_response_code(400); // Bad Request
    echo json_encode($response);
    exit;
  }

  $modeloUsuario = new Usuario();
  $datosUsuario = $modeloUsuario->verificarCredenciales($nickOCorreo, $contrasena);

  if ($datosUsuario) {
    // Credenciales correctas, iniciar sesión
    $_SESSION['id_usuario_sireh'] = $datosUsuario['Id_Usuario'];
    $_SESSION['nombre_usuario_sireh'] = $datosUsuario['Nombre_Usuario_Sistema'];
    $_SESSION['rol_usuario_sireh'] = $datosUsuario['Nom_Rol']; // Ej: 'Administrador', 'Recepcionista'
    $_SESSION['id_rol_sireh'] = $datosUsuario['Id_Rol'];

    $response['success'] = true;
    $response['message'] = 'Login exitoso.';
    $response['rol'] = $datosUsuario['Nom_Rol']; // Para la redirección en el frontend
    
  } else {
    // Credenciales incorrectas o usuario inactivo
    $response['message'] = 'Nick/Correo o contraseña incorrectos, o usuario inactivo.';
    http_response_code(401); // Unauthorized
  }
} else {
  // Método no permitido
  $response['message'] = 'Método no permitido.';
  http_response_code(405); // Method Not Allowed
}

echo json_encode($response);
?>