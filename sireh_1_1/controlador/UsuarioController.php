<?php
// Iniciar sesión es crucial para acceder a $_SESSION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../modelo/Usuario.php';

header('Content-Type: application/json');

// Determinar la acción solicitada (desde GET o POST)
$accion = $_GET['accion'] ?? ($_POST['accion'] ?? '');

// Lista de acciones que requieren autenticación de administrador
$accionesProtegidasAdmin = ['crear', 'actualizar', 'eliminar', 'listar', 'obtenerPorId', 'listarRoles'];

if (in_array($accion, $accionesProtegidasAdmin)) {
    if (!isset($_SESSION['rol_usuario_sireh']) || $_SESSION['rol_usuario_sireh'] !== 'Administrador') {
        http_response_code(403); // Forbidden
        echo json_encode(['success' => false, 'message' => 'Acceso no autorizado. Se requiere rol de Administrador.']);
        exit;
    }
}

$usuarioModel = new Usuario();
// Preparamos una respuesta por defecto
$response = ['success' => false, 'message' => 'Acción no especificada o inválida.'];

switch ($accion) {
    case 'listar':
        $usuarios = $usuarioModel->listarUsuarios();
        $response = ['success' => true, 'data' => $usuarios];
        break;

    case 'obtenerPorId':
        $id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_VALIDATE_INT);
        if ($id_usuario && $id_usuario > 0) {
            $usuario = $usuarioModel->obtenerUsuarioPorId($id_usuario);
            if ($usuario) {
                $response = ['success' => true, 'data' => $usuario];
            } else {
                http_response_code(404);
                $response = ['success' => false, 'message' => 'Usuario no encontrado.'];
            }
        } else {
            http_response_code(400);
            $response = ['success' => false, 'message' => 'ID de usuario proporcionado es inválido.'];
        }
        break;

    case 'crear':
        $nombreCompleto = trim($_POST['nombre_reg'] ?? '');
        $nickUsuario = trim($_POST['nick_usuario_reg'] ?? '');
        $correo = trim($_POST['correo_reg'] ?? '');
        $contrasena = $_POST['contrasena_reg'] ?? '';
        $idRol = filter_input(INPUT_POST, 'rol_reg', FILTER_VALIDATE_INT);
        $estado = 'activo'; // Por defecto al crear, o puedes añadirlo al form

        if ($nombreCompleto && $nickUsuario && $correo && $contrasena && $idRol) {
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $response = ['success' => false, 'message' => 'Formato de correo inválido.'];
                http_response_code(400);
                break;
            }
            if (strlen($contrasena) < 6) {
                $response = ['success' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres.'];
                http_response_code(400);
                break;
            }

            $resultado = $usuarioModel->crearUsuario($nombreCompleto, $nickUsuario, $correo, $contrasena, $idRol, $estado);

            if ($resultado === 'correo_existente') {
                $response = ['success' => false, 'message' => 'El correo electrónico ya está registrado.'];
                http_response_code(409); // Conflict
            } elseif ($resultado === 'nick_existente') {
                $response = ['success' => false, 'message' => 'El Nick/Login ya está en uso.'];
                http_response_code(409); 
            } elseif ($resultado === 'error_db') {
                $response = ['success' => false, 'message' => 'Error interno al crear el usuario.'];
                http_response_code(500); 
            } elseif (is_int($resultado) && $resultado > 0) {
                $response = ['success' => true, 'message' => 'Usuario registrado con éxito.', 'id_usuario_creado' => $resultado];
            } else {
                $response = ['success' => false, 'message' => 'No se pudo registrar el usuario (respuesta inesperada del modelo).'];
                http_response_code(500);
            }
        } else {
            $response = ['success' => false, 'message' => 'Todos los campos marcados con * son obligatorios.'];
            http_response_code(400);
        }
        break;
        
    case 'actualizar':
        $id_usuario = filter_input(INPUT_POST, 'id_usuario_edit', FILTER_VALIDATE_INT);
        $nombreCompleto = trim($_POST['nombre_edit'] ?? '');
        $nickUsuario = trim($_POST['nick_edit'] ?? '');
        $correo = trim($_POST['correo_edit'] ?? '');
        $idRol = filter_input(INPUT_POST, 'rol_edit', FILTER_VALIDATE_INT); // Viene del select con name="rol_edit"
        $estado = $_POST['estado_edit'] ?? ''; // Viene del select con name="estado_edit"
        $contrasena = $_POST['contrasena_edit'] ?? null; // Es opcional

        if ($id_usuario && $nombreCompleto && $nickUsuario && $correo && $idRol && in_array($estado, ['activo', 'inactivo'])) {
             if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $response = ['success' => false, 'message' => 'Formato de correo inválido.'];
                http_response_code(400);
                break;
            }
            // Validar contraseña solo si se proporciona una nueva y no está vacía después de trim
            $trimmedContrasena = $contrasena ? trim($contrasena) : '';
            if (!empty($trimmedContrasena) && strlen($trimmedContrasena) < 6) {
                $response = ['success' => false, 'message' => 'La nueva contraseña debe tener al menos 6 caracteres.'];
                http_response_code(400);
                break;
            }

            $resultado = $usuarioModel->actualizarUsuario(
                $id_usuario, 
                $nombreCompleto, 
                $nickUsuario, 
                $correo, 
                $idRol, 
                $estado, 
                !empty($trimmedContrasena) ? $trimmedContrasena : null // Pasar null si está vacía
            );
            
            if ($resultado === 'correo_existente') {
                $response = ['success' => false, 'message' => 'El correo ya está en uso por otro usuario.'];
                http_response_code(409);
            } elseif ($resultado === 'nick_existente') {
                $response = ['success' => false, 'message' => 'El Nick/Login ya está en uso por otro usuario.'];
                http_response_code(409);
            } elseif($resultado === 'error_db') {
                $response = ['success' => false, 'message' => 'Error de base de datos al actualizar el usuario.'];
                http_response_code(500);
            } elseif ($resultado === true) {
                $response = ['success' => true, 'message' => 'Usuario actualizado con éxito.'];
            } else {
                // Si $resultado es false (no 'error_db', etc.), puede ser que no hubo cambios.
                // El modelo actualizarUsuario devuelve true en éxito, incluso si no hay filas afectadas.
                // Si llega aquí, es un error no manejado por el modelo o un false inesperado.
                $response = ['success' => false, 'message' => 'No se pudo actualizar el usuario o no se realizaron cambios.'];
                http_response_code(500); // O 200 si prefieres indicar que no hubo cambios pero no fue un error
            }
        } else {
            // Construir un mensaje de error más detallado si es posible
            $camposFaltantes = [];
            if (!$id_usuario) $camposFaltantes[] = "ID de usuario";
            if (!$nombreCompleto) $camposFaltantes[] = "Nombre";
            if (!$nickUsuario) $camposFaltantes[] = "Nick";
            if (!$correo) $camposFaltantes[] = "Correo";
            if (!$idRol) $camposFaltantes[] = "Rol";
            if (!in_array($estado, ['activo', 'inactivo'])) $camposFaltantes[] = "Estado inválido";
            
            $response = ['success' => false, 'message' => 'Faltan datos o son inválidos: ' . implode(', ', $camposFaltantes) . '.'];
            http_response_code(400);
        }
        break;

    case 'eliminar':
        $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
        if ($id_usuario && $id_usuario > 0) {
            if (isset($_SESSION['id_usuario_sireh']) && $_SESSION['id_usuario_sireh'] == $id_usuario) {
                 $response = ['success' => false, 'message' => 'No puedes eliminar tu propia cuenta de administrador.'];
                 http_response_code(403);
                 break;
            }

            if ($usuarioModel->eliminarUsuario($id_usuario)) {
                $response = ['success' => true, 'message' => 'Usuario eliminado con éxito.'];
            } else {
                // El modelo devuelve false si hay error de DB o si no se afectaron filas.
                // Si es por FK, el error de DB debería haber sido logueado por el modelo.
                $response = ['success' => false, 'message' => 'Error al eliminar el usuario. Es posible que tenga registros asociados o no exista.'];
                http_response_code(500); 
            }
        } else {
            $response = ['success' => false, 'message' => 'ID de usuario inválido para eliminar.'];
            http_response_code(400);
        }
        break;

    case 'listarRoles':
        $roles = $usuarioModel->listarRoles();
        // Asumiendo que listarRoles devuelve un array, incluso vacío, en éxito, o false en error.
        if (is_array($roles)) { 
            $response = ['success' => true, 'data' => $roles];
        } else {
            $response = ['success' => false, 'message' => 'Error al obtener la lista de roles.'];
            http_response_code(500);
        }
        break;
    
    default:
        http_response_code(400); // Bad Request para acción no reconocida
        // La $response ya tiene el mensaje 'Acción no especificada o inválida.'
        break;
}

echo json_encode($response);
?>