 <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Login - Sireh H</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <div class="formulario">
    <h2>Iniciar Sesión</h2>
    <form action="php/login.php" method="post">
      <input type="text" name="usuario" placeholder="Usuario" required />
      <input type="password" name="contraseña" placeholder="Contraseña" required />
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>
