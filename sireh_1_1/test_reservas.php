<?php
session_start();
$_SESSION['rol'] = 'recepcionista'; // forzar sesión activa

// Simulación de datos de reservas
$reservas = [
  ['id'=>1, 'nombre'=>'Juan', 'servicio'=>'Habitación Doble', 'fecha_registro'=>date('Y-m-d H:i:s', strtotime('-23 hours')), 'estado'=>'pendiente'],
  ['id'=>2, 'nombre'=>'Ana', 'servicio'=>'Suite', 'fecha_registro'=>date('Y-m-d H:i:s', strtotime('-25 hours')), 'estado'=>'pendiente'],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Test Reservas</title>
<style>
  tr.expired { background-color: #f8d7da; }
</style>
</head>
<body>

<h1>Reservas Test</h1>

<table id="tabla-reservas" border="1" cellpadding="5" cellspacing="0" style="width:100%; text-align:left;">
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>Servicio</th><th>Fecha Registro</th><th>Tiempo Restante</th><th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($reservas as $r): ?>
    <tr data-fecha="<?php echo $r['fecha_registro']; ?>" data-idreserva="<?php echo $r['id']; ?>">
      <td><?php echo $r['id']; ?></td>
      <td><?php echo $r['nombre']; ?></td>
      <td><?php echo $r['servicio']; ?></td>
      <td><?php echo $r['fecha_registro']; ?></td>
      <td class="countdown"></td>
      <td class="estado"><?php echo $r['estado']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script>
function updateCountdowns() {
  const rows = document.querySelectorAll('#tabla-reservas tbody tr');
  const now = new Date().getTime();

  rows.forEach(row => {
    const fechaCreacion = new Date(row.dataset.fecha).getTime();
    const limite = fechaCreacion + 24*60*60*1000;
    const diff = limite - now;
    const countdownCell = row.querySelector('.countdown');
    const estadoCell = row.querySelector('.estado');

    if(diff > 0){
      const h = Math.floor(diff/(1000*60*60));
      const m = Math.floor((diff%(1000*60*60))/(1000*60));
      const s = Math.floor((diff%(1000*60))/1000);
      countdownCell.textContent = `${h}h ${m}m ${s}s`;
      row.classList.remove('expired');
      estadoCell.textContent = 'pendiente';
    }else{
      countdownCell.textContent = 'Tiempo Expirado';
      row.classList.add('expired');
      estadoCell.textContent = 'cancelada';
    }
  });
}

setInterval(updateCountdowns, 1000);
updateCountdowns();
</script>

</body>
</html>
