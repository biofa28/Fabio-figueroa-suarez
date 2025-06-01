<?php
require_once __DIR__ . '/../modelo/Usuario.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recibimos el correo y la contraseña del formulario
  $correo = $_POST['correo'] ?? '';
  $contrasena = $_POST['contrasena'] ?? '';

  $modeloUsuario = new Usuario();
  $datos = $modeloUsuario->verificarCredenciales($correo, $contrasena);

  if ($datos) {
    $_SESSION['usuario'] = $datos['nombre']; // mostramos el nombre del usuario
    $_SESSION['rol'] = $datos['rol'];
    echo json_encode(['success' => true, 'rol' => $datos['rol']]);
  } else {
    echo json_encode(['success' => false]);
  }
}
