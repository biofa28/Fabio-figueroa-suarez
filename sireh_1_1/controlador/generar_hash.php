<?php
$contrasenaPlana = 'admin123';
$hashGenerado = password_hash($contrasenaPlana, PASSWORD_DEFAULT);
echo "La contraseña es: " . $contrasenaPlana . "<br>";
echo "El hash generado es: " . $hashGenerado . "<br>";

// Opcional: Verificar el hash recién generado (debería dar true)
if (password_verify($contrasenaPlana, $hashGenerado)) {
    echo "La verificación del hash recién generado con la contraseña plana tuvo ÉXITO.<br>";
} else {
    echo "La verificación del hash recién generado con la contraseña plana FALLÓ.<br>";
}
?>