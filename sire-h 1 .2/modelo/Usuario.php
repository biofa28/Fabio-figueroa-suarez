<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
  private $db;

  public function __construct() {
    $this->db = BaseDeDatos::conectar();
  }

  public function verificarCredenciales($correo, $contrasena) {
    $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
      $usuario_bd = $resultado->fetch_assoc();
      if (password_verify($contrasena, $usuario_bd['contraseña'])) {
        return $usuario_bd;
      }
    }

    return false;
  }

  public function crearUsuario($nombre, $correo, $contrasena_hash, $rol) {
    // Verifica si ya existe el correo
    $stmt = $this->db->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
    if (!$stmt) return false;
    
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->close();
      return false; // correo ya registrado
    }
    $stmt->close();

    // Inserta nuevo usuario
    $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)");
    if (!$stmt) return false;

    $stmt->bind_param("ssss", $nombre, $correo, $contrasena_hash, $rol);
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado;
  }
}
