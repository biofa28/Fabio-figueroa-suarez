 <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sireh H - Hotel</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">SIRE-H</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search"/>
      <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
  </div>
</nav>
  <header>
   
    <nav>
      <a href="page/login.php" class="btn btn-primary">Iniciar sesión</a>
      <a href="page/register.php" class="btn btn-primary">Registrarse</a>
    </nav>
  </header>

<?php
include 'model/conexion.php';
?>

  <main>
    <h2 class="text-center">Habitaciones disponibles</h2>

 <div class="container p-3">
    <section class="habitaciones" >
      <div class="habitacion">
        <img src="img/fabio.jpg" alt="Suite Deluxe">
        <h3>Suite Deluxe</h3>
        <p>Vista al mar, jacuzzi, minibar, Wi-Fi</p>
        <p><strong>$220</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>
      <div class="habitacion">
        <img src="img/juan.jpg" alt="Suite Deluxe">
        <h3>Habitación Familiar</h3>
        <p>2 camas queen, estacionamiento, Wi-Fi</p>
        <p><strong>$180</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>

      <div class="habitacion">
        <img src="img/jesu.jpg" alt="Suite Deluxe">
        <h3>Suite Ejecutiva</h3>
        <p>Spa, Wi-Fi, escritorio de trabajo</p>
        <p><strong>$160</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>
    </section>
    <br><br>

    <section class="habitaciones">
      <div class="habitacion">
        <img src="img/fabio.jpg" alt="Suite Deluxe">
        <h3>Suite Deluxe</h3>
        <p>Vista al mar, jacuzzi, minibar, Wi-Fi</p>
        <p><strong>$220</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>
      <div class="habitacion">
        <img src="img/juan.jpg" alt="Suite Deluxe">
        <h3>Habitación Familiar</h3>
        <p>2 camas queen, estacionamiento, Wi-Fi</p>
        <p><strong>$180</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>

      <div class="habitacion">
        <img src="img/jesu.jpg" alt="Suite Deluxe">
        <h3>Suite Ejecutiva</h3>
        <p>Spa, Wi-Fi, escritorio de trabajo</p>
        <p><strong>$160</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>
    </section>
    <br><br>

    <section class="habitaciones">
      <div class="habitacion">
        <img src="img/fabio.jpg" alt="Suite Deluxe">
        <h3>Suite Deluxe</h3>
        <p>Vista al mar, jacuzzi, minibar, Wi-Fi</p>
        <p><strong>$220</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>
      <div class="habitacion">
        <img src="img/juan.jpg" alt="Suite Deluxe">
        <h3>Habitación Familiar</h3>
        <p>2 camas queen, estacionamiento, Wi-Fi</p>
        <p><strong>$180</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>

      <div class="habitacion">
        <img src="img/jesu.jpg" alt="Suite Deluxe">
        <h3>Suite Ejecutiva</h3>
        <p>Spa, Wi-Fi, escritorio de trabajo</p>
        <p><strong>$160</strong> por noche</p>
        <a class="btn btn-danger" href="page/reservar.php">Reservar</a>
      </div>
    </section>
</div>
     
    </section>
  

  <footer>
    <p>&copy; 2025 Sireh H</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
