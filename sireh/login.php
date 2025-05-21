<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SIRE-H | Sistema de Registro Hotelero</title>
  <link rel="stylesheet" href="estilo/login.css">
</head>
<body>

  <!-- Logo encima, centrado -->
  <div class="logo-container">
    <img src="img/logo.png" alt="Logo SIRE-H" class="logo" />
  </div>

  <!-- Título y subtítulo -->
  <div class="contenido">
    <h1>LOG IN</h1>
  </div>

  <!-- Formulario -->

<?php
include("modelo/conexion.php");
include("controlador/controlador.php");
?>

<form method="post" class="form-container">
  <div class="form-group">
    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" name="usuario">
  </div>
  <div class="form-group">
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password">
  </div>

  <div class="button-group">
    <input name="btningresar" class="btn" type="submit" value="INICIAR">
  </div>

  <div class="forgot-password">¿OLVIDASTE TU CONTRASEÑA?</div>

  <!-- Aquí mostramos los mensajes -->
  <p id="message" style="text-align: center; margin-top: 15px;"></p>


</body>
</html>
