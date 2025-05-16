 <?php
$servername = "localhost";
$username = "root"; // Usuario por defecto en XAMPP
$password = "";     // Sin contraseña por defecto
$dbname = "sire-h";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>
