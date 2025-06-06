<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
  private $db;
  private $tableName = 'usuario';      // CORREGIDO a minúscula
  private $rolTableName = 'rol';        // CORREGIDO a minúscula

  public function __construct() {
    $this->db = BaseDeDatos::conectar();
  }

  /**
   * Verifica las credenciales de un usuario del sistema (personal del hotel).
   *
   * @param string $nickUsuario El nick o correo para el login.
   * @param string $contrasena La contraseña en texto plano.
   * @return array|false Los datos del usuario si las credenciales son correctas, o false en caso contrario.
   */
  public function verificarCredenciales($nickUsuario, $contrasena) {
    // Asumimos que el login puede ser por Nick_Usuario o Correo_Electronico
    $sql = "SELECT u.*, r.Nom_Rol 
            FROM `" . $this->tableName . "` u
            JOIN `" . $this->rolTableName . "` r ON u.Id_Rol = r.Id_Rol
            WHERE (u.Nick_Usuario = ? OR u.Correo_Electronico = ?) AND u.Estado = 'activo'";
    
    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        error_log("LOGIN DEBUG - Error en prepare verificarCredenciales: " . $this->db->error);
        return false;
    }
    $stmt->bind_param("ss", $nickUsuario, $nickUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // --- INICIO DE LOGS DE DEPURACIÓN ---
    error_log("LOGIN DEBUG - Intento de login para Nick/Correo: " . $nickUsuario); 

    if ($resultado->num_rows === 1) {
      $usuario_bd = $resultado->fetch_assoc();
      
      error_log("LOGIN DEBUG - Usuario encontrado en BD: " . print_r($usuario_bd, true)); 
      error_log("LOGIN DEBUG - Contraseña del Formulario (la que ingresó el usuario): " . $contrasena); 
      error_log("LOGIN DEBUG - Hash de Contraseña almacenado en BD: " . $usuario_bd['Password_Hash']); 
      
      if (password_verify($contrasena, $usuario_bd['Password_Hash'])) {
        error_log("LOGIN DEBUG - password_verify() devolvió: ÉXITO (true)"); 
        unset($usuario_bd['Password_Hash']); 
        return $usuario_bd;
      } else {
        error_log("LOGIN DEBUG - password_verify() devolvió: FALLÓ (false)"); 
      }
    } else {
      error_log("LOGIN DEBUG - Usuario no encontrado en BD o se encontraron múltiples filas (num_rows): " . $resultado->num_rows); 
    }
    // --- FIN DE LOGS DE DEPURACIÓN ---

    $stmt->close();
    return false;
  }

  /**
   * Crea un nuevo usuario del sistema (personal del hotel).
   *
   * @param string $nombreCompleto Nombre completo del empleado.
   * @param string $nickUsuario Nick para el login.
   * @param string $correoElectronico Correo del empleado.
   * @param string $contrasena Contraseña en texto plano.
   * @param int $idRol ID del rol asignado.
   * @param string $estado Estado inicial ('activo' o 'inactivo').
   * @return int|string El ID del usuario creado, o un string indicando el error ('correo_existente', 'nick_existente', 'error_db').
   */
  public function crearUsuario($nombreCompleto, $nickUsuario, $correoElectronico, $contrasena, $idRol, $estado = 'activo') {
    // Verificar si ya existe el correo
    $stmt_check_correo = $this->db->prepare("SELECT Id_Usuario FROM `" . $this->tableName . "` WHERE Correo_Electronico = ?");
    if (!$stmt_check_correo) {
        error_log("Error en prepare check correo: " . $this->db->error); return 'error_db';}
    $stmt_check_correo->bind_param("s", $correoElectronico);
    $stmt_check_correo->execute();
    $stmt_check_correo->store_result();
    if ($stmt_check_correo->num_rows > 0) {
      $stmt_check_correo->close(); return 'correo_existente';
    }
    $stmt_check_correo->close();

    // Verificar si ya existe el Nick_Usuario
    $stmt_check_nick = $this->db->prepare("SELECT Id_Usuario FROM `" . $this->tableName . "` WHERE Nick_Usuario = ?");
     if (!$stmt_check_nick) {
        error_log("Error en prepare check nick: " . $this->db->error); return 'error_db';}
    $stmt_check_nick->bind_param("s", $nickUsuario);
    $stmt_check_nick->execute();
    $stmt_check_nick->store_result();
    if ($stmt_check_nick->num_rows > 0) {
      $stmt_check_nick->close(); return 'nick_existente';
    }
    $stmt_check_nick->close();

    // Hashear contraseña
    $hash_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $sql_insert = "INSERT INTO `" . $this->tableName . 
                  "` (Nombre_Usuario_Sistema, Nick_Usuario, Correo_Electronico, Password_Hash, Id_Rol, Estado) 
                  VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = $this->db->prepare($sql_insert);
    if (!$stmt_insert) {
        error_log("Error en prepare insert usuario: " . $this->db->error); return 'error_db';
    }

    $stmt_insert->bind_param("ssssis", $nombreCompleto, $nickUsuario, $correoElectronico, $hash_contrasena, $idRol, $estado);
    $resultado = $stmt_insert->execute();

    if (!$resultado) {
        error_log("Error en execute insert usuario: " . $stmt_insert->error);
        $stmt_insert->close();
        return 'error_db';
    }
    $id_insertado = $stmt_insert->insert_id;
    $stmt_insert->close();
    return $id_insertado;
  }

  /**
   * Lista todos los usuarios del sistema con su nombre de rol.
   *
   * @return array Lista de usuarios.
   */
  public function listarUsuarios() {
    $sql = "SELECT u.Id_Usuario, u.Nombre_Usuario_Sistema, u.Nick_Usuario, u.Correo_Electronico, u.Estado, u.Fecha_Creacion, r.Nom_Rol 
            FROM `" . $this->tableName . "` u
            JOIN `" . $this->rolTableName . "` r ON u.Id_Rol = r.Id_Rol
            ORDER BY u.Nombre_Usuario_Sistema ASC";
    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        error_log("Error en prepare listarUsuarios: " . $this->db->error);
        return []; 
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuarios = [];
    if ($resultado->num_rows > 0) {
      while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
      }
    }
    $stmt->close();
    return $usuarios;
  }

  /**
   * Obtiene un usuario específico por su ID, incluyendo el nombre del rol.
   *
   * @param int $id_usuario ID del usuario.
   * @return array|null Datos del usuario o null si no se encuentra.
   */
  public function obtenerUsuarioPorId($id_usuario) {
    $sql = "SELECT u.Id_Usuario, u.Nombre_Usuario_Sistema, u.Nick_Usuario, u.Correo_Electronico, u.Id_Rol, u.Estado, r.Nom_Rol 
            FROM `" . $this->tableName . "` u
            JOIN `" . $this->rolTableName . "` r ON u.Id_Rol = r.Id_Rol
            WHERE u.Id_Usuario = ?";
    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        error_log("Error en prepare obtenerUsuarioPorId: " . $this->db->error);
        return null;
    }
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = null;
    if ($resultado->num_rows === 1) {
      $usuario = $resultado->fetch_assoc();
    }
    $stmt->close();
    return $usuario;
  }

/**
   * Actualiza los datos de un usuario del sistema.
   *
   * @param int $idUsuario ID del usuario a actualizar.
   * @param string $nombreCompleto Nuevo nombre completo.
   * @param string $nickUsuario Nuevo nick para login.
   * @param string $correoElectronico Nuevo correo.
   * @param int $idRol Nuevo ID del rol.
   * @param string $estado Nuevo estado ('activo' o 'inactivo').
   * @param string|null $contrasena Nueva contraseña en texto plano (opcional, si no se provee no se cambia).
   * @return bool|string True si fue exitoso, o un string indicando el error ('correo_existente', 'nick_existente', 'error_db').
   */
  public function actualizarUsuario($idUsuario, $nombreCompleto, $nickUsuario, $correoElectronico, $idRol, $estado, $contrasena = null) {
    // Verificar si el nuevo correo ya existe para OTRO usuario
    $stmt_check_correo = $this->db->prepare("SELECT Id_Usuario FROM `" . $this->tableName . "` WHERE Correo_Electronico = ? AND Id_Usuario != ?");
    if (!$stmt_check_correo) { error_log("DB Error actualizando correo: ".$this->db->error); return 'error_db'; }
    $stmt_check_correo->bind_param("si", $correoElectronico, $idUsuario);
    $stmt_check_correo->execute();
    $stmt_check_correo->store_result();
    if ($stmt_check_correo->num_rows > 0) { $stmt_check_correo->close(); return 'correo_existente'; }
    $stmt_check_correo->close();

    // Verificar si el nuevo Nick_Usuario ya existe para OTRO usuario
    // --- CORRECCIÓN DEL ERROR DE TIPEO AQUÍ ---
    // Se cambió $this.tableName a $this->tableName
    $stmt_check_nick = $this->db->prepare("SELECT Id_Usuario FROM `" . $this->tableName . "` WHERE Nick_Usuario = ? AND Id_Usuario != ?");
    if (!$stmt_check_nick) { error_log("DB Error actualizando nick: ".$this->db->error); return 'error_db'; }
    $stmt_check_nick->bind_param("si", $nickUsuario, $idUsuario);
    $stmt_check_nick->execute();
    $stmt_check_nick->store_result();
    if ($stmt_check_nick->num_rows > 0) { $stmt_check_nick->close(); return 'nick_existente'; }
    $stmt_check_nick->close();

    if ($contrasena && !empty(trim($contrasena))) {
      $hash_contrasena = password_hash(trim($contrasena), PASSWORD_DEFAULT);
      $sql = "UPDATE `" . $this->tableName . "` SET Nombre_Usuario_Sistema = ?, Nick_Usuario = ?, Correo_Electronico = ?, Id_Rol = ?, Estado = ?, Password_Hash = ? WHERE Id_Usuario = ?";
      $stmt = $this->db->prepare($sql);
      if (!$stmt) { error_log("DB Error actualizando con pass: ".$this->db->error); return 'error_db'; }
      $stmt->bind_param("sssissi", $nombreCompleto, $nickUsuario, $correoElectronico, $idRol, $estado, $hash_contrasena, $idUsuario);
    } else {
      $sql = "UPDATE `" . $this->tableName . "` SET Nombre_Usuario_Sistema = ?, Nick_Usuario = ?, Correo_Electronico = ?, Id_Rol = ?, Estado = ? WHERE Id_Usuario = ?";
      $stmt = $this->db->prepare($sql);
      if (!$stmt) { error_log("DB Error actualizando sin pass: ".$this->db->error); return 'error_db'; }
      $stmt->bind_param("sssisi", $nombreCompleto, $nickUsuario, $correoElectronico, $idRol, $estado, $idUsuario);
    }
    
    $resultado = $stmt->execute();
    if (!$resultado) { 
        error_log("Error en execute actualizarUsuario: " . $stmt->error); 
        $stmt->close(); 
        return 'error_db'; 
    }
    $stmt->close();
    return true; 
  }

  /**
   * Elimina un usuario del sistema.
   *
   * @param int $id_usuario ID del usuario a eliminar.
   * @return bool True si fue exitoso, false en caso contrario.
   */
  public function eliminarUsuario($id_usuario) {
    $stmt = $this->db->prepare("DELETE FROM `" . $this->tableName . "` WHERE Id_Usuario = ?");
    if (!$stmt) { 
        error_log("Error en prepare eliminarUsuario: " . $this->db->error); 
        return false; 
    }
    $stmt->bind_param("i", $id_usuario);
    $resultado = $stmt->execute();
    if (!$resultado) { 
        error_log("Error en execute eliminarUsuario: " . $stmt->error); 
        $stmt->close(); 
        return false; 
    }
    $filas_afectadas = $stmt->affected_rows;
    $stmt->close();
    return $filas_afectadas > 0;
  }

  /**
   * Obtiene todos los roles disponibles en el sistema.
   *
   * @return array Lista de roles con Id_Rol y Nom_Rol.
   */
  public function listarRoles() {
    $sql = "SELECT Id_Rol, Nom_Rol FROM `" . $this->rolTableName . "` ORDER BY Nom_Rol ASC";
    $stmt = $this->db->prepare($sql);
    if (!$stmt) { 
        error_log("Error en prepare listarRoles: " . $this->db->error); 
        return []; 
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $roles = [];
    if ($resultado->num_rows > 0) { 
        while($fila = $resultado->fetch_assoc()) { 
            $roles[] = $fila; 
        } 
    }
    $stmt->close();
    return $roles;
  }
}
?>