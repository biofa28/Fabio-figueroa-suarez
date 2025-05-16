 <?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (usuario, contraseña) VALUES ('$usuario', '$contraseña')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado correctamente.";
        // Aquí puedes redirigir a login o mostrar mensaje bonito
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
