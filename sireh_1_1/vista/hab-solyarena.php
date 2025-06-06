<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Habitación Sol y Arena - Hotel Sire-H</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../estilo/paginasireh1.0.css">
</head>
<body>
  <!-- ========== ENCABEZADO / HEADER ========== -->
  <header class="header container-fluid sticky-top">
    <div class="row align-items-center py-2">
      <div class="col-4 text-start">
        <a href="../vista/Sire-H.php" class="home-icon"><i class="bi bi-house-door-fill fs-4 text-gold"></i></a>
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
  </header>

  <!-- ========== MENÚ DE NAVEGACIÓN ========== -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-gold mb-4">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="../vista/Sire-H.php#quienes-somos">QUIÉNES SOMOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vista/Sire-H.php#galeria">GALERIA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vista/Sire-H.php#habitaciones">PLANES Y SERVICIOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vista/Sire-H.php#ubicacion">UBICACION</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../vista/Sire-H.php#contacto">CONTACTO</a>
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
              <li><a class="dropdown-item active" href="../vista/hab-solyarena.php">Habitación Sol y Arena</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ========== CONTENIDO PRINCIPAL ========== -->
  <main class="container my-5">
    <!-- Encabezado de la habitación -->
    <div class="row mb-5">
      <div class="col-12 text-center">
        <h1 class="display-4 fw-bold text-brown">Habitación Sol y Arena</h1>
        <p class="lead text-muted">Vive la esencia del Caribe, donde el sol y la arena te acompañan</p>
      </div>
    </div>

    <!-- Imagen principal y descripción -->
    <div class="row align-items-center mb-5">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <img src="../img/habitaciones2.0/imagen13.jpg" alt="Habitación Sol y Arena" class="img-fluid rounded shadow-lg">
      </div>
      <div class="col-lg-6">
        <h2 class="fw-bold text-brown mb-4">Descripción</h2>
        <p class="lead">La habitación Sol y Arena ofrece una mezcla perfecta entre el calor del sol caribeño y la frescura de la arena blanca.</p>
        <p>Un refugio ideal para quienes desean descansar y disfrutar de la brisa marina, con acceso directo a la playa y todas las comodidades para una estancia inolvidable.</p>
      </div>
    </div>

    <!-- Características -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h2 class="fw-bold text-brown mb-4">Características</h2>
            <div class="row">
              <div class="col-md-6">
                <ul class="list-unstyled">
                  <li class="mb-3"><i class="bi bi-check-circle-fill text-gold me-2"></i> Acceso directo a la playa</li>
                  <li class="mb-3"><i class="bi bi-check-circle-fill text-gold me-2"></i> Cama queen-size premium</li>
                  <li class="mb-3"><i class="bi bi-check-circle-fill text-gold me-2"></i> Amplio ventanal con vistas al mar</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="list-unstyled">
                  <li class="mb-3"><i class="bi bi-check-circle-fill text-gold me-2"></i> Área de descanso con sillas de playa</li>
                  <li class="mb-3"><i class="bi bi-check-circle-fill text-gold me-2"></i> Wi-Fi gratuito y aire acondicionado</li>
                  <li class="mb-3"><i class="bi bi-check-circle-fill text-gold me-2"></i> Snack bar con productos frescos</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Imágenes adicionales -->
    <div class="row mb-5">
      <div class="col-12">
        <h2 class="fw-bold text-brown mb-4">Galería</h2>
        <div class="row g-3">
          <div class="col-md-6">
            <img src="../img/habitaciones2.0/imagen14.jpg" alt="Interior Habitación Sol y Arena" class="img-fluid rounded shadow">
          </div>
          <div class="col-md-6">
            <img src="../img/habitaciones2.0/imagen15.jpg" alt="Vista desde la habitación" class="img-fluid rounded shadow">
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario de reserva -->
   
  </main>

  <!-- ========== FOOTER ========== -->
  <footer class="footer py-5 bg-dark text-white mt-5">
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