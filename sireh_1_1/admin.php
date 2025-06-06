<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar rol - ¡IMPORTANTE! Usar el valor exacto de Nom_Rol de tu tabla Rol
if (!isset($_SESSION['rol_usuario_sireh']) || $_SESSION['rol_usuario_sireh'] !== 'Administrador') {
  // Si la sesión no es válida, destruir la sesión actual para limpiar
  // y luego redirigir al login.
  session_unset(); // Elimina todas las variables de sesión
  session_destroy(); // Destruye la sesión
  header('Location: vista/login.php'); // Asegúrate que esta ruta sea correcta desde admin.php
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Admin - Hotel Sire-H</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link rel="stylesheet" href="./estilo/paneles/admin.css" />
  
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a81368914c.js" crossorigin="anonymous"></script>
  <style>
    /* Estilos adicionales o para sobrescribir Bootstrap si es necesario */
    body {
      display: flex; /* Para layout con sidebar */
      min-height: 100vh;
      background-color: #f8f9fa; /* Un fondo suave para el área de contenido */
    }
    .sidebar {
      /* Tus estilos actuales para el sidebar. Asegúrate que width esté definido. */
      /* Ejemplo: width: 270px; background: #1f2a44; color: #f5e6c4; ... */
      /* Lo más importante es que no entre en conflicto con el .content */
      position: fixed; /* O sticky, dependiendo de tu preferencia */
      top: 0;
      left: 0;
      height: 100vh;
      z-index: 100; /* Por encima del contenido */
      overflow-y: auto; /* Para scroll si el menú es largo */
    }
    .content {
      flex-grow: 1;
      padding: 20px;
      margin-left: 270px; /* Mismo ancho que el sidebar para evitar superposición */
      /* background-color: #f8f9fa; /* Fondo del área de contenido */
    }
    .btn-accion-principal {
        background-color: #8a6d19; /* --gold */
        color: white;
        border: none;
        transition: background-color 0.2s ease-in-out;
    }
    .btn-accion-principal:hover {
        background-color: #5A2B00; /* --brown o un dorado más oscuro */
        color: white;
    }
    .modal-header {
        background-color: #1f2a44; /* Azul profundo del sidebar */
        color: #f5e6c4; /* Dorado pálido del sidebar */
    }
    .modal-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%); /* Para que el botón de cerrar sea visible en fondo oscuro */
    }
    .table { /* Pequeños ajustes para la tabla si es necesario */
        margin-top: 1rem;
    }
    .alert { /* Para los mensajes de éxito/error */
        margin-top: 1rem;
    }
    /* Asegúrate que tu .form-registrar (si aún lo usas) no choque con BS */
  </style>
</head>
<body>

  <nav class="sidebar"> <div class="top-bar">
      <span class="user-name">Hola, <?php echo isset($_SESSION['nombre_usuario_sireh']) ? htmlspecialchars($_SESSION['nombre_usuario_sireh']) : 'Usuario'; ?></span>
    </div>
    <h2>Panel Admin</h2>
    <a href="#" class="menu-item" data-section="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#" class="menu-item active" data-section="gestion_usuarios"><i class="fas fa-users"></i> Gestión Usuarios</a>
    <a href="#" class="menu-item" data-section="registro_personal"><i class="fas fa-user-plus"></i> Registrar Personal</a>
    <a href="#" class="menu-item" data-section="configuracion"><i class="fas fa-cogs"></i> Configuración</a>
    <a href="#" class="menu-item" data-section="estadisticas"><i class="fas fa-chart-line"></i> Estadísticas</a>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
  </nav>
    
  <main class="content"> <section id="dashboard" class="section" style="display: none;">
      <h1 class="mb-4">Dashboard</h1>
      <p class="lead">Resumen general del sistema.</p>
      <div class="row">
        <div class="col-md-4">
          <div class="card text-white bg-primary mb-3">
            <div class="card-header"><i class="fas fa-user-shield"></i> Usuarios Activos</div>
            <div class="card-body">
              <h5 class="card-title" id="usuariosActivosCount">0</h5>
              <p class="card-text">Total de usuarios registrados en el sistema.</p>
            </div>
          </div>
        </div>
        </div>
    </section>

    <section id="gestion_usuarios" class="section" style="display: none;"> 
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Usuarios del Sistema</h1>
        <button id="btnIrARegistroPersonalEnGestion" class="btn btn-accion-principal">
          <i class="fas fa-user-plus"></i> Registrar Nuevo Personal
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
          <thead class="table-dark">
            <tr>
              <th>Nombre</th>
              <th>Nick/Login</th>
              <th>Correo</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Fecha Registro</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody id="tablaUsuariosBody">
            </tbody>
        </table>
      </div>
    </section>

    <section id="registro_personal" class="section" style="display:none;">
      <h1 class="mb-4">Registrar Nuevo Personal del Sistema</h1>
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title mb-3">Datos del Nuevo Usuario</h5>
          <form id="formRegistrarPersonal">
            <div class="mb-3">
              <label for="nombre_reg" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nombre_reg" id="nombre_reg" required />
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nick_usuario_reg" class="form-label">Nick (para Login) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nick_usuario_reg" id="nick_usuario_reg" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="correo_reg" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="correo_reg" id="correo_reg" required />
                </div>
            </div>
            <div class="mb-3">
              <label for="contrasena_reg" class="form-label">Contraseña <span class="text-danger">*</span></label>
              <input type="password" class="form-control" name="contrasena_reg" id="contrasena_reg" required placeholder="Mínimo 6 caracteres" />
            </div>
            <div class="mb-3">
              <label for="rol_reg_select" class="form-label">Rol <span class="text-danger">*</span></label>
              <select class="form-select" name="rol_reg" id="rol_reg_select" required>
                <option value="" disabled selected>Seleccione un rol...</option>
                </select>
            </div>
            <button type="submit" class="btn btn-accion-principal w-100 py-2">Registrar Usuario</button>
          </form>
          <div id="mensajeRegistro" class="mt-3"></div> 
        </div>
      </div>
    </section>

    <div class="modal fade" id="modalEditarUsuarioBS" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="formEditarUsuarioBS"> <div class="modal-body">
                <input type="hidden" name="id_usuario_edit" id="id_usuario_edit">
                <div class="mb-3">
                  <label for="nombre_edit" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" required />
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nick_edit" class="form-label">Nick (Login) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nick_edit" id="nick_edit" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="correo_edit" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="correo_edit" id="correo_edit" required />
                    </div>
                </div>
                <div class="mb-3">
                  <label for="contrasena_edit" class="form-label">Nueva Contraseña (dejar en blanco para no cambiar)</label>
                  <input type="password" class="form-control" name="contrasena_edit" id="contrasena_edit" placeholder="Mínimo 6 caracteres" />
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rol_edit_select" class="form-label">Rol <span class="text-danger">*</span></label>
                        <select class="form-select" name="rol_edit" id="rol_edit_select" required>
                          </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="estado_edit" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select class="form-select" name="estado_edit" id="estado_edit" required>
                          <option value="activo">Activo</option>
                          <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div id="mensajeEditar" class="mt-3"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-accion-principal">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <section id="configuracion" class="section" style="display: none;">
        <h1 class="mb-4">Configuración del Sistema</h1>
        <p>Funcionalidades de configuración general del hotel y del sistema SIRE-H.</p>
        </section>
    <section id="estadisticas" class="section" style="display: none;">
        <h1 class="mb-4">Estadísticas y Reportes</h1>
        <p>Visualización de datos clave, ocupación, ingresos, y generación de reportes.</p>
        </section>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="./script/paneles/admin.js"></script> 
</body>
</html>