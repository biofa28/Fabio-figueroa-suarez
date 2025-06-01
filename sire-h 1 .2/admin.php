<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
  header('Location: vista/login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel Admin - Hotel Sire-H</title>
  <link rel="stylesheet" href="./estilo/paneles/admin.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a81368914c.js" crossorigin="anonymous"></script>
</head>
<body>



  <nav class="sidebar">
    <div class="top-bar">
      <span class="user-name">Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?><span>
    </div>
    <h2>Panel Admin</h2>
    <a href="#" class="menu-item active" data-section="inicio"><i class="fas fa-users"></i> Usuarios</a>
    <a href="#" class="menu-item" data-section="configuracion"><i class="fas fa-cogs"></i> Configuración</a>
    <a href="#" class="menu-item" data-section="registro_recepcionista"><i class="fas fa-user-plus"></i> Registrar Recepcionista</a>
    <a href="#" class="menu-item" data-section="estadisticas"><i class="fas fa-chart-line"></i> Estadísticas</a>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
  </nav>
    
  <main class="content">
    <!-- Sección Usuarios (inicio) -->
    <section id="inicio" class="section" style="display: block;">
      <h1>Bienvenido</h1>
      <p class="lead">Gestiona todas las funciones administrativas desde aquí.</p>

      <section class="cards">
        <article class="card">
          <div class="card-icon"><i class="fas fa-user-shield"></i></div>
          <h3>Usuarios Activos</h3>
          <p class="value">128</p>
          <small>Actualizado hace 5 minutos</small>
        </article>
        <article class="card">
          <div class="card-icon"><i class="fas fa-server"></i></div>
          <h3>Servidores en Línea</h3>
          <p class="value">4 / 5</p>
          <small>Estado estable</small>
        </article>
        <article class="card">
          <div class="card-icon"><i class="fas fa-bug"></i></div>
          <h3>Errores Reportados</h3>
          <p class="value error">2</p>
          <small>Requiere atención</small>
        </article>
      </section>
    </section>

    <!-- Sección Configuración -->
    <section id="configuracion" class="section" style="display: none;">
      <h1>Configuración</h1>
      <p>Aquí va la configuración del sistema.</p>
    </section>

    <!-- Sección Registrar Recepcionista -->
 <section id="registro_recepcionista" class="section" style="display:none;">
  <h1>Registrar Usuario</h1>
  <form class="form-registrar" method="POST" id="formRegistrar">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required />

    <label for="correo">Correo</label>
    <input type="email" name="correo" id="correo" required />

    <label for="contrasena">Contraseña</label>
    <input type="password" name="contrasena" id="contrasena" required />

    <label for="rol">Rol</label>
    <select name="rol" id="rol" required>
      <option value="" disabled selected>Seleccione un rol</option>
      <option value="administrador">Administrador</option>
      <option value="recepcionista">Recepcionista</option>
    </select>

    <button type="submit">Registrar</button>
  </form>
  <div id="mensaje"></div>
</section>

    <!-- Sección Estadísticas -->
    <section id="estadisticas" class="section" style="display: none;">
      <h1>Estadísticas</h1>
      <p>Aquí van las estadísticas del sistema.</p>
    </section>
  </main>

  <script src="./script/paneles/admin.js"></script>
</body>
</html>
