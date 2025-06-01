document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const correo = document.getElementById('correo').value;
  const contrasena = document.getElementById('password').value;

  fetch('../controlador/LoginControlador.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `correo=${encodeURIComponent(correo)}&contrasena=${encodeURIComponent(contrasena)}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      const destino = data.rol === 'administrador' ? '../admin.php' : '../recepcionista.php';
      window.location.href = destino;
    } else {
      document.getElementById('errorMsg').style.display = 'block';
    }
  })
  .catch(() => {
    document.getElementById('errorMsg').textContent = 'Error del servidor';
    document.getElementById('errorMsg').style.display = 'block';
  });
});
