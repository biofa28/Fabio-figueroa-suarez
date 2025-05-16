 <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Reservar habitación - Sireh H</title>
  <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
  <?php
  include 'model/conexion.php'; 
  ?>
  <div class="formulario">
    <h2>Reservar habitación</h2>
    <form action="php/reservar.php" method="post">
      <label for="habitacion">Tipo de habitación</label>
      <select name="habitacion" id="habitacion">
        <option value="1">Suite Deluxe</option>
        <option value="2">Familiar</option>
        <option value="3">Ejecutiva</option>
      </select>
      <label for="fecha">Fecha</label>
      <input type="date" name="fecha" required />
      <button type="submit">Reservar</button>
    </form>
  </div>

</body>
</html>
