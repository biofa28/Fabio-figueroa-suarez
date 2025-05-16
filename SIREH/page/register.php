 <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registro - Sireh H</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  
  <div class="formulario">
    <h2>Crear cuenta</h2>
    <form action="php/registro.php" method="post">
      <input type="text" name="nombre" placeholder="Nombre completo" required />
      <input type="email" name="correo" placeholder="Correo electrónico" required />
      <input type="tel" name="telefono" placeholder="Teléfono" required />
      <input type="text" name="usuario" placeholder="Nombre de usuario" required />
      <input type="password" name="contraseña" placeholder="Contraseña" required />
      <button type="submit">Registrar</button>
    </form>
  </div>
</body>
</html>
