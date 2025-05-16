 <!-- login.php -->
<?php
session_start();
include 'conexion.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
  $_SESSION['usuario'] = $usuario;
  header("Location: ../index.html");
} else {
  echo "<script>alert('Datos incorrectos'); window.location='../login.html';</script>";
}
?>

<!-- registro.php -->
<?php
include 'conexion.php';

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$clave = $_POST['clave'];

$query = "INSERT INTO usuarios (usuario, email, clave) VALUES ('$usuario', '$email', '$clave')";

if (mysqli_query($conexion, $query)) {
  echo "<script>alert('Registro exitoso'); window.location='../login.html';</script>";
} else {
  echo "Error: " . mysqli_error($conexion);
}
?>

<!-- reservar.php -->
<?php
include 'conexion.php';

$habitacion = $_POST['habitacion'];
$entrada = $_POST['fecha_entrada'];
$salida = $_POST['fecha_salida'];
$servicios = isset($_POST['servicios']) ? implode(', ', $_POST['servicios']) : '';

$query_verificar = "SELECT * FROM reservas WHERE habitacion = '$habitacion' AND (
  (fecha_entrada <= '$entrada' AND fecha_salida > '$entrada') OR
  (fecha_entrada < '$salida' AND fecha_salida >= '$salida')
)";

$resultado = mysqli_query($conexion, $query_verificar);

if (mysqli_num_rows($resultado) > 0) {
  echo "<script>alert('Habitación ocupada en esa fecha.'); window.location='../reservar.html';</script>";
} else {
  $insertar = "INSERT INTO reservas (habitacion, fecha_entrada, fecha_salida, servicios) VALUES ('$habitacion', '$entrada', '$salida', '$servicios')";
  mysqli_query($conexion, $insertar);
  echo "<script>alert('Reserva exitosa'); window.location='../index.html';</script>";
}
?>

<!-- conexion.php -->
<?php
$conexion = mysqli_connect("localhost", "root", "", "sireh_h");
if (!$conexion) {
  die("Error de conexión: " . mysqli_connect_error());
}
?>

<!-- SQL para crear la base de datos (sireh_h.sql) -->