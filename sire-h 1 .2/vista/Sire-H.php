<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIRE-H - Inicio</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../estilo/paginasireh1.0.css">
</head>
<body>
  <!-- ========== ENCABEZADO / HEADER ========== -->
  <header class="header container-fluid sticky-top">
    <div class="row align-items-center py-2">
      <div class="col-4 text-start">
        <a href="#" class="home-icon"><i class="bi bi-house-door-fill fs-4 text-gold"></i></a>
      </div>
      <div class="col-4 text-center">
        <div class="logo-container">
          <img src="../img/logo.png" alt="Logo SIRE-H" class="logo img-fluid">
          <div class="logo-text">SIRE-H</div>
        </div>
      </div>
      <div class="col-4 text-end">
        <a href="../vista/reservas.php" class="btn btn-warning reservar-btn">RESERVAR AHORA</a>
      </div>
    </div>

    <!-- ========== MENÚ DE NAVEGACIÓN ========== -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-gold mb-4" id="navbar-options">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="#quienes-somos">QUIÉNES SOMOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#galeria">GALERIA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#habitaciones">PLANES Y SERVICIOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#ubicacion">UBICACION</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto">CONTACTO</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              HABITACIONES
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../vista/hab-marcaribe.php">Habitación Mar Caribe</a></li>
              <li><a class="dropdown-item" href="../vista/hab-cieloazul.php">Habitación Cielo Azul</a></li>
              <li><a class="dropdown-item" href="../vista/hab-palmar.php">Habitación Palmar</a></li>
              <li><a class="dropdown-item" href="../vista/hab-brisatropical.php">Habitación Brisa Tropical</a></li>
              <li><a class="dropdown-item" href="../vista/hab-solyarena.php">Habitación Sol y Arena</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 
  </header>

  
  <!-- ========== SECCIÓN: QUIÉNES SOMOS ========== -->
  <section id="quienes-somos" class="py-5 bg-beige">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <h1 class="display-4 fw-bold text-brown">Bienvenido a su lujoso hogar lejos de casa</h1>
          <p class="lead text-brown">
            En el Hotel Sire-H, te ofrecemos una experiencia inigualable en el corazón de la ciudad. 
            Nuestras elegantes habitaciones combinan lujo y confort, mientras que nuestro restaurante gourmet 
            deleita con sabores únicos. Lo que nos diferencia es nuestro servicio personalizado, donde cada huésped 
            es tratado como parte de nuestra familia. Ya sea para una escapada romántica o un viaje de negocios, 
            en Hotel Sire-H encontrarás el refugio perfecto. ¡Reserva ahora y vive la verdadera hospitalidad!
          </p>
        </div>
        <div class="col-lg-6">
          <img src="../img/cuartos1.0/quienes1.png" alt="Hotel Sire-H" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </section>

  <!-- ========== SECCIÓN: GALERÍA ========== -->
  <section id="galeria" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5 display-5 fw-bold text-brown">Nuestras Instalaciones</h2>
      <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow">
          <div class="carousel-item active">
            <img src="../img/cuartos1.0/habitacion1.png" class="d-block w-100" alt="Habitación 1">
          </div>
          <div class="carousel-item">
            <img src="../img/cuartos1.0/habitacion2.png" class="d-block w-100" alt="Habitación 2">
          </div>
          <div class="carousel-item">
            <img src="../img/cuartos1.0/habitacion3.png" class="d-block w-100" alt="Habitación 3">
          </div>
          <div class="carousel-item">
            <img src="../img/cuartos1.0/habitacion4.png" class="d-block w-100" alt="Habitación 4">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>

  <!-- ========== SECCIÓN: HABITACIONES ========== -->
  <section id="habitaciones" class="py-5 bg-beige">
    <div class="container">
      <h2 class="text-center mb-5 display-5 fw-bold text-brown">Nuestras Habitaciones</h2>
      <div class="row g-4">
        <!-- Habitación 1 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow">
            <img src="../img/cuartos1.0/habitacion1.png" class="card-img-top" alt="Habitación de lujo">
            <div class="card-body">
              <p class="text-muted"><i class="bi bi-people-fill"></i> 2 adultos - 1 niño menor de 7 años</p>
              <h3 class="h5 card-title fw-bold text-brown">Habitación de lujo</h3>
              <p class="text-gold fw-bold">Desde $180.000 por noche</p>
            </div>
          </div>
        </div>
        
        <!-- Habitación 2 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow">
            <img src="../img/cuartos1.0/habitacion2.png" class="card-img-top" alt="Vista al mar">
            <div class="card-body">
              <p class="text-muted"><i class="bi bi-people-fill"></i> 2 adultos - 1 niño menor de 7 años</p>
              <h3 class="h5 card-title fw-bold text-brown">Vista al mar</h3>
              <p class="text-gold fw-bold">Desde $250.000 por noche</p>
            </div>
          </div>
        </div>
        
        <!-- Habitación 3 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow">
            <img src="../img/cuartos1.0/habitacion3.png" class="card-img-top" alt="Habitación familiar">
            <div class="card-body">
              <p class="text-muted"><i class="bi bi-people-fill"></i> 4 adultos - 3 niños</p>
              <h3 class="h5 card-title fw-bold text-brown">Habitación familiar</h3>
              <p class="text-gold fw-bold">Desde $400.000 por noche</p>
            </div>
          </div>
        </div>
        
        <!-- Habitación 4 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow">
            <img src="../img/cuartos1.0/habitacion4.png" class="card-img-top" alt="Suite ejecutiva">
            <div class="card-body">
              <p class="text-muted"><i class="bi bi-people-fill"></i> 4 adultos - 3 niños</p>
              <h3 class="h5 card-title fw-bold text-brown">Suite ejecutiva</h3>
              <p class="text-gold fw-bold">Desde $1'000.000 por noche</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== DETALLE DE HABITACIONES ========== -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-6">
          <h2 class="display-6 fw-bold text-brown mb-4">Habitación de lujo</h2>
          <img src="../img/cuartos1.0/habitacion1.png" alt="Habitación de lujo principal" class="img-fluid rounded shadow mb-4">
          <div class="d-grid">
            <a href="../vista/reserva.html" class="btn btn-warning btn-lg">RESERVAR AHORA</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="row g-3">
            <div class="col-6">
              <img src="../img/cuartos1.0/cuarto1.png" alt="Foto secundaria 1" class="img-fluid rounded shadow">
            </div>
            <div class="col-6">
              <img src="../img/cuartos1.0/cuarto2.png" alt="Foto secundaria 2" class="img-fluid rounded shadow">
            </div>
            <div class="col-12">
              <div class="p-4 bg-white rounded shadow">
                <h3 class="h5 fw-bold text-brown">Características:</h3>
                <ul class="list-unstyled">
                  <li><i class="bi bi-check-circle-fill text-gold me-2"></i> Cama king size</li>
                  <li><i class="bi bi-check-circle-fill text-gold me-2"></i> Vista al mar</li>
                  <li><i class="bi bi-check-circle-fill text-gold me-2"></i> Minibar incluido</li>
                  <li><i class="bi bi-check-circle-fill text-gold me-2"></i> Desayuno buffet</li>
                  <li><i class="bi bi-check-circle-fill text-gold me-2"></i> WiFi de alta velocidad</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== SECCIÓN: UBICACIÓN ========== -->
  <section id="ubicacion" class="py-5 bg-beige">
    <div class="container">
      <h2 class="text-center mb-5 display-5 fw-bold text-brown">¿Dónde estamos ubicados?</h2>
      <div class="ratio ratio-16x9 rounded shadow">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15600.145580156446!2d-75.5411668088864!3d10.393244622666217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef6259d441bf39f%3A0xa67ec67d8101b3d2!2sCartagena%2C%20Provincia%20de%20Cartagena%2C%20Bol%C3%ADvar!5e0!3m2!1ses!2sco!4v1715973968003!5m2!1ses!2sco" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </section>

  <!-- ========== FOOTER ========== -->
  <footer id="contacto" class="footer py-5 bg-dark text-white">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4 text-center text-lg-start">
          <h3 class="h4 fw-bold mb-4">SIRE-H</h3>
          <p>Tu refugio de lujo en el corazón de Cartagena. Experiencias inolvidables desde 2010.</p>
        </div>
        
        <div class="col-lg-4 text-center">
          <h3 class="h4 fw-bold mb-4">RESERVAS</h3>
          <p><i class="bi bi-geo-alt-fill text-gold me-2"></i> Cartagena, Colombia 12345</p>
          <p><i class="bi bi-telephone-fill text-gold me-2"></i> 1123-456-7890</p>
          <p><i class="bi bi-envelope-fill text-gold me-2"></i> adsosireh@gmail.com</p>
        </div>
        
        <div class="col-lg-4 text-center text-lg-end">
          <h3 class="h4 fw-bold mb-4">HORARIO DE ATENCIÓN</h3>
          <p><strong>Lunes a Viernes</strong><br>9:00 am a 6:00 pm</p>
          <p><strong>Sábados y domingos</strong><br>9:00 am a 12:00 am</p>
        </div>
        
        <div class="col-12 text-center mt-4">
          <h3 class="h4 fw-bold mb-3">REDES SOCIALES</h3>
          <div class="social-icons">
            <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-white mx-2 fs-4"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
        
        <div class="col-12 text-center mt-4 pt-3 border-top border-secondary">
          <p class="mb-0">&copy; 2025 Hotel SIRE-H. Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>