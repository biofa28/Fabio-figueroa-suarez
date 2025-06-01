<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
  header('Location: ../vista/login.php');
  exit;
}

require_once __DIR__ . '/../modelo/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre'] ?? '');
  $correo = trim($_POST['correo'] ?? '');
  $contrasena = $_POST['contrasena'] ?? '';
  $rol = $_POST['rol'] ?? '';

  if ($nombre && $correo && $contrasena && $rol) {
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $modelo = new Usuario();

    $creado = $modelo->crearUsuario($nombre, $correo, $hash, $rol);

    if ($creado === 'correo_existente') {
      echo "Error: El correo ya está registrado.";
    } else if ($creado) {
      echo "Usuario registrado con éxito.";
    } else {
      echo "EL CORREO YA EXISTE.";
    }
  } else {
    echo "Todos los campos son obligatorios.";
  }
} else {
  echo "Método no permitido.";
}
