<?php
class BaseDeDatos {
  public static function conectar() {
    $conexion = new mysqli("localhost", "root", "", "sireh-db");

    if ($conexion->connect_error) {
      die("Conexión fallida: " . $conexion->connect_error);
    }

    return $conexion;
  }
}

// La llave '}' extra que estaba aquí ha sido eliminada.