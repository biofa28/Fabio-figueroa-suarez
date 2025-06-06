<?php
// sireh_1_1/modelo/HabitacionModel.php

require_once __DIR__ . '/../config/database.php';

class HabitacionModel {
  private $db;

  public function __construct() {
    $this->db = BaseDeDatos::conectar();
  }

  /**
   * Obtiene todos los tipos de habitación activos desde la base de datos.
   * @return array Un array con los datos de los tipos de habitación.
   */
  public function obtenerTiposHabitacion() {
    // Esta consulta lee la información que ya tienes en tu tabla `tipohabitacion`
    $sql = "SELECT Id_TipoHabitacion, Nom_TipoHabitacion, Precio_Base_Noche FROM `tipohabitacion` ORDER BY Precio_Base_Noche ASC";
    
    $resultado = $this->db->query($sql);
    $tiposHabitacion = [];

    if ($resultado && $resultado->num_rows > 0) {
      while ($fila = $resultado->fetch_assoc()) {
        $tiposHabitacion[] = $fila;
      }
    }
    
    return $tiposHabitacion;
  }
}
?>