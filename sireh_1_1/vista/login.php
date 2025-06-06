<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Hotel Sire-H</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../estilo/paneles/login.css" />
</head>
<body>
  <div class="login-card shadow">
    <h2>Bienvenido</h2>
    <form id="loginForm" novalidate>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" class="form-control" id="correo" placeholder="Correo" required />
      </div>
      
      <div class="mb-4">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" required />
      </div>

      <div id="errorMsg" style="display:none; color: #d9534f; font-weight: 600;">Usuario o contraseña incorrectos</div>

      <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
    <p class="text-muted">© 2025 Hotel Sire-H</p>
  </div>
  <script src="../public/js/login.js"></script>
</body>
</html>
