<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar rol - ¡IMPORTANTE! Usar el valor exacto de Nom_Rol de tu tabla Rol
if (!isset($_SESSION['rol_usuario_sireh']) || $_SESSION['rol_usuario_sireh'] !== 'Recepcionista') {
  header('Location: vista/login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel Recepcionista - Hotel Sire-H</title>
  <link rel="stylesheet" href="./estilo/paneles/recepcionista.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a81368914c.js" crossorigin="anonymous"></script> 
</head>
<body>

  <nav class="sidebar">
    <h2>Recepción</h2>
    <div class="top-bar">
      <span class="user-name">Hola, <?php echo isset($_SESSION['nombre_usuario_sireh']) ? htmlspecialchars($_SESSION['nombre_usuario_sireh']) : 'Usuario'; ?></span>
    </div>
    <a href="#" class="menu-item active" data-section="inicio"><i class="fas fa-home"></i> Inicio</a>
    <a href="#" class="menu-item" data-section="reservas"><i class="fas fa-calendar-check"></i> Reservas</a>
    <a href="#" class="menu-item" data-section="habitaciones"><i class="fas fa-bed"></i> Habitaciones</a>
    <a href="#" class="menu-item" data-section="checkin"><i class="fas fa-user-check"></i> Check-In</a>
    <a href="#" class="menu-item" data-section="checkout"><i class="fas fa-user-times"></i> Check-Out</a>
    <a href="logout.php" class="btn-logout">Cerrar sesión</a>
  </nav>

  <main class="content">
    <section id="inicio" class="section active">
      <h1>Bienvenido</h1>
      <p class="lead">Administra las reservas y la atención al huésped desde aquí.</p>
      </section>
    </main>

  <script src="./script/paneles/recepcionista.js"></script>
  <script src="./script/paneles/habitacion.js"></script>
</body>
</html>