<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'recepcionista') {
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
      <span class="user-name">Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?><span>
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

      <section class="cards">
        <article class="card">
          <div class="card-icon"><i class="fas fa-calendar-day"></i></div>
          <h3>Reservas Hoy</h3>
          <p class="value">34</p>
        </article>
        <article class="card">
          <div class="card-icon"><i class="fas fa-bed"></i></div>
          <h3>Habitaciones Disponibles</h3>
          <p class="value">12</p>
        </article>
        <article class="card">
          <div class="card-icon"><i class="fas fa-user-clock"></i></div>
          <h3>Check-Ins Pendientes</h3>
          <p class="value">5</p>
        </article>
      </section>
    </section>

    <section id="reservas" class="section">
      <h1>Reservas</h1>
      <p>Aquí va el contenido para gestionar reservas.</p>
    </section>

    <section id="habitaciones" class="section">
      <h1>Gestión de Habitaciones</h1>
      <div class="building" id="building"></div>
      <button id="btnReservar">Confirmar Reserva</button>
      <div id="resultado"></div>
    </section>

    <section id="checkin" class="section">
      <h1>Check-In</h1>
    </section>

    <section id="checkout" class="section">
      <h1>Check-Out</h1>
    </section>
  </main>

  <script src="./script/paneles/recepcionista.js"></script>
  <script src="./script/paneles/habitacion.js"></script>
</body>
</html>
