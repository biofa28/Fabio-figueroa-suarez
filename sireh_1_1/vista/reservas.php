<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reserva Hotel - Hotel Sire-H</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  
  <link href="../estilo/paginasireh1.1.css" rel="stylesheet" />
  <link href="../estilo/reservas.css" rel="stylesheet" />
</head>
<body class="bg-beige">

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
        </div>
    </div>
  </header>

  <main class="container my-5">
    <div class="step-container">

      <div id="step1">
        <div class="text-center mb-4">
          <h1 class="step-header">Reserva tu Estadía</h1>
          <p class="text-muted">Completa tus datos para continuar con el pago seguro.</p>
        </div>
        <form id="form-reservation" novalidate>
          <div class="row g-3">
            <div class="col-12">
              <label for="fullname" class="form-label">Nombre completo</label>
              <input type="text" id="fullname" class="form-control" required placeholder="Juan Pérez" />
              <div class="invalid-feedback">Por favor ingresa tu nombre completo.</div>
            </div>
            <div class="col-md-6">
              <label for="emailaddr" class="form-label">Correo electrónico</label>
              <input type="email" id="emailaddr" class="form-control" required placeholder="ejemplo@correo.com" />
              <div class="invalid-feedback">Ingresa un correo válido.</div>
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Teléfono</label>
              <input type="tel" id="phone" class="form-control" required placeholder="3001234567" />
              <div class="invalid-feedback">Ingresa un número telefónico.</div>
            </div>
            <div class="col-12">
              <label for="id_usuario" class="form-label">Número de cédula</label>
              <input type="text" id="id_usuario" class="form-control" required placeholder="1234567890" />
              <div class="invalid-feedback">Ingresa tu número de cédula.</div>
            </div>
            <div class="col-md-6">
              <label for="checkin" class="form-label">Fecha de llegada</label>
              <input type="date" id="checkin" class="form-control" required />
              <div class="invalid-feedback">Selecciona una fecha de llegada.</div>
            </div>
            <div class="col-md-6">
              <label for="checkout" class="form-label">Fecha de salida</label>
              <input type="date" id="checkout" class="form-control" required />
              <div class="invalid-feedback">Selecciona una fecha de salida válida.</div>
            </div>
            <div class="col-md-6">
              <label for="guests" class="form-label">Número de huéspedes</label>
              <input type="number" id="guests" class="form-control" min="1" value="1" required />
              <div class="invalid-feedback">Ingresa el número de huéspedes.</div>
            </div>
            <div class="col-md-6">
              <label for="roomtype" class="form-label">Tipo de habitación</label>
              <select id="roomtype" class="form-select" required>
                <option value="" disabled selected>Cargando tipos de habitación...</option>
              </select>
              <div class="invalid-feedback">Selecciona un tipo de habitación.</div>
            </div>
          </div>
          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary-custom btn-lg">Continuar al Pago</button>
          </div>
        </form>
      </div>

      <div id="step2" class="hidden">
        <div class="text-center mb-4">
          <h1 class="step-header">Pago Seguro con PayPal</h1>
          <p>Estás a un paso de confirmar tu reserva. El monto total a pagar es de <strong id="total-price" class="text-success"></strong>.</p>
        </div>
        <div id="paypal-btn-container" class="text-center"></div>
        <div class="d-grid mt-3">
          <button id="backToStep1" class="btn btn-outline-secondary">Volver a Reserva</button>
        </div>
      </div>

      <div id="step3" class="hidden">
        <div class="text-center mb-4">
          <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
          <h1 class="step-header mt-3">¡Reserva Confirmada!</h1>
          <p>Hemos enviado un correo con los detalles de tu reserva. ¡Te esperamos!</p>
        </div>
        <div class="invoice p-4 rounded">
          <h5 class="fw-bold mb-3">Resumen de tu Reserva</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between"><strong>Nombre:</strong> <span id="conf-name"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Email:</strong> <span id="conf-email"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Teléfono:</strong> <span id="conf-phone"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Cédula:</strong> <span id="conf-idusuario"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Llegada:</strong> <span id="conf-checkin"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Salida:</strong> <span id="conf-checkout"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Días:</strong> <span id="conf-days"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Huéspedes:</strong> <span id="conf-guests"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>Habitación:</strong> <span id="conf-roomtype"></span></li>
            <li class="list-group-item d-flex justify-content-between bg-light"><strong>Total pagado:</strong> <span id="conf-total" class="fw-bold"></span></li>
            <li class="list-group-item d-flex justify-content-between"><strong>ID de transacción:</strong> <span id="conf-txid"></span></li>
          </ul>
        </div>
        <div class="d-grid mt-4">
          <button id="newBooking" class="btn btn-primary-custom btn-lg">Realizar Nueva Reserva</button>
        </div>
      </div>

    </div>
  </main>
  
  <footer class="footer py-5 bg-dark text-white mt-5">
    <div class="container text-center">
      <p class="mb-0">&copy; 2025 Hotel SIRE-H. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script src="../script/reservas.js"></script>
  <script src="https://www.paypal.com/sdk/js?client-id=AaZVvA8Etr0gAQpgio5vH0y-Bx9pNC4zoWIxty8PpmkG4Ej8m9oloV8peJ9zhZ1iJ-vvLTqu5pMcU496&currency=USD"></script>
</body>
</html>