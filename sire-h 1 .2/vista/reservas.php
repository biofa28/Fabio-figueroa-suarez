<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reserva - Hotel Sire-H</title>
  <link rel="stylesheet" href="../estilo/paginasireh1.1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>

<header class="container-fluid sticky-top bg-white shadow-sm py-3">
  <div class="row align-items-center">
    <div class="col-4 text-start">
      <a href="../vista/Sire-H.php" class="fs-4 text-gold"><i class="bi bi-house-door-fill"></i></a>
    </div>
    <div class="col-4 text-center">
      <img src="../img/logo.png" alt="Logo SIRE-H" style="height: 50px;" />
    </div>
    <div class="col-4 text-end">
      <a href="#" class="btn btn-warning fw-bold px-4">RESERVAR AHORA</a>
    </div>
  </div>
</header>

<main class="container my-5">
  <!-- Indicador de progreso -->
  <div class="d-flex justify-content-between mb-4">
    <div class="text-center">
      <div class="rounded-circle bg-gold text-white mx-auto">1</div>
      <small>Datos Personales</small>
    </div>
    <div class="text-center">
      <div class="rounded-circle bg-secondary text-white mx-auto">2</div>
      <small>Método de Pago</small>
    </div>
    <div class="text-center">
      <div class="rounded-circle bg-secondary text-white mx-auto">3</div>
      <small>Confirmación</small>
    </div>
  </div>

  <!-- Paso 1: Datos personales -->
  <section id="reservation-section">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h2 class="text-brown fw-bold mb-4">Datos de la Reserva</h2>
        <form id="reservation-form" novalidate>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="name" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" id="name" placeholder="Juan Pérez" required />
              <div class="invalid-feedback">Por favor ingrese su nombre.</div>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" placeholder="juan@ejemplo.com" required />
              <div class="invalid-feedback">Por favor ingrese un correo válido.</div>
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Número de teléfono</label>
              <input type="tel" class="form-control" id="phone" placeholder="300XXXXXXX" required />
              <div class="invalid-feedback">Por favor ingrese su teléfono.</div>
            </div>
            <div class="col-md-6">
              <label for="reservation-date" class="form-label">Fecha de reserva</label>
              <input type="date" class="form-control" id="reservation-date" required />
              <div class="invalid-feedback">Por favor seleccione una fecha.</div>
            </div>
            <div class="col-12">
              <label for="service-type" class="form-label">Tipo de servicio</label>
              <select class="form-select" id="service-type" required>
                <option value="" disabled selected>Seleccione un servicio</option>
                <option value="Alojamiento">Alojamiento</option>
                <option value="Comida">Comida</option>
                <option value="Paquete especial">Paquete especial</option>
              </select>
              <div class="invalid-feedback">Por favor seleccione un servicio.</div>
            </div>
            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-warning w-100 fw-bold py-3">SIGUIENTE - MÉTODO DE PAGO <i class="bi bi-arrow-right ms-2"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Paso 2: Método de pago -->
  <section id="payment-section" style="display:none;">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h2 class="text-brown fw-bold mb-4">Método de Pago</h2>
        <form id="payment-form" novalidate>
          <div class="mb-4">
            <label for="payment-method" class="form-label">Seleccione método de pago</label>
            <select class="form-select" id="payment-method" required>
              <option value="" selected disabled>Seleccione un método</option>
              <option value="nequi">Nequi</option>
              <option value="pse">PSE (Banco)</option>
              <option value="credit-card">Tarjeta de Crédito/Débito</option>
            </select>
            <div class="invalid-feedback">Seleccione un método de pago.</div>
          </div>

          <div class="payment-method" id="nequi-section">
            <label for="nequi-number" class="form-label">Número asociado Nequi</label>
            <input type="text" class="form-control" id="nequi-number" placeholder="300XXXXXXXX" />
          </div>

          <div class="payment-method" id="pse-section">
            <label for="bank-select" class="form-label">Selecciona tu Banco</label>
            <select class="form-select" id="bank-select">
              <option value="" selected disabled>Seleccione un banco</option>
              <option value="bancolombia">Bancolombia</option>
              <option value="davivienda">Banco Davivienda</option>
              <option value="bbva">Banco BBVA</option>
              <option value="banco-bogota">Banco de Bogotá</option>
            </select>
          </div>

          <div class="payment-method" id="credit-card-section">
            <div class="row g-3">
              <div class="col-12">
                <label for="card-number" class="form-label">Número de tarjeta</label>
                <input type="text" class="form-control" id="card-number" placeholder="0000 0000 0000 0000" />
              </div>
              <div class="col-md-6">
                <label for="expiry-date" class="form-label">Fecha de expiración</label>
                <input type="month" class="form-control" id="expiry-date" />
              </div>
              <div class="col-md-6">
                <label for="cvv" class="form-label">Código de seguridad (CVV)</label>
                <input type="text" class="form-control" id="cvv" placeholder="000" />
              </div>
              <div class="col-12">
                <label for="card-holder-name" class="form-label">Nombre del titular</label>
                <input type="text" class="form-control" id="card-holder-name" />
              </div>
            </div>
          </div>

          <div class="form-check mt-4 mb-4">
            <input class="form-check-input" type="checkbox" id="auto-payment" />
            <label class="form-check-label" for="auto-payment">
              ¿Deseas inscribir este servicio a pago automático?
            </label>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-secondary fw-bold px-4" id="back-button">
              <i class="bi bi-arrow-left me-2"></i> REGRESAR
            </button>
            <button type="submit" class="btn btn-warning fw-bold px-4">
              FINALIZAR PAGO <i class="bi bi-check-circle ms-2"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Paso 3: Confirmación -->
  <!-- Paso 3: Confirmación -->
<section id="confirmation-section" style="display:none;">
  <div class="card shadow-sm text-center">
    <div class="card-body">
      <div class="mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
      </div>
      <h2 class="text-brown fw-bold mb-3">¡Reserva Confirmada!</h2>
      <p class="lead">Gracias por reservar con Hotel Sire-H</p>
      <p>Hemos enviado los detalles de tu reserva a tu correo electrónico.</p>

      <div class="card bg-light mt-4 mb-4 text-start">
        <div class="card-body">
          <h5 class="fw-bold text-brown mb-3">Detalles de tu reserva:</h5>
          <p><strong>Nombre:</strong> <span id="conf-name"></span></p>
          <p><strong>Fecha:</strong> <span id="conf-date"></span></p>
          <p><strong>Servicio:</strong> <span id="conf-service"></span></p>
          <p><strong>Método de pago:</strong> <span id="conf-payment"></span></p>
        </div>
      </div>
        <a href="/sire-h%201.1/vista/Sire-H.php" class="btn btn-warning py-3 px-5 fw-bold">
            VOLVER AL INICIO
        </a>


    </div>
  </div>
</section>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="../script/reservar.js"></script>
</body>
</html>
