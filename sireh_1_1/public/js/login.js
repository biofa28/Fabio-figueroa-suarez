document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault(); // Prevenir el envío tradicional del formulario

  console.log('Formulario enviado'); // DEBUG

  const correo = document.getElementById('correo').value;
  const contrasena = document.getElementById('password').value;
  const errorMsgDiv = document.getElementById('errorMsg');
  
  // Limpiar mensaje de error anterior y ocultarlo
  if (errorMsgDiv) {
    errorMsgDiv.textContent = ''; 
    errorMsgDiv.style.display = 'none';
  }

  console.log('Datos a enviar:', { correo, contrasena }); // DEBUG

  fetch('../controlador/LoginControlador.php', { // La ruta relativa parece ser correcta desde donde se carga login.php
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `correo=${encodeURIComponent(correo)}&contrasena=${encodeURIComponent(contrasena)}`
  })
  .then(res => {
    console.log('Respuesta cruda del servidor:', res); // DEBUG (Muestra el objeto Response)
    if (!res.ok) {
      // Si la respuesta HTTP no es OK (ej. 401, 403, 404, 500), 
      // intenta leer el cuerpo como texto para obtener un mensaje de error del servidor si lo hay.
      return res.text().then(text => {
        // Intentar parsear como JSON si es posible, si no, usar el texto.
        try {
          const errorData = JSON.parse(text);
          throw new Error(errorData.message || text || `Error HTTP: ${res.status}`);
        } catch (e) {
          throw new Error(text || `Error HTTP: ${res.status}`);
        }
      });
    }
    return res.json(); // Si es OK (2xx), intenta parsear como JSON
  })
  .then(data => {
    console.log('Datos JSON procesados:', data); // DEBUG
    if (data.success) {
      console.log('Login exitoso. Rol recibido:', data.rol); // DEBUG
      
      // Usar rutas absolutas desde la raíz del servidor de desarrollo PHP.
      // Si tu servidor PHP (php -S localhost:3000) se inició desde la carpeta sireh_1_1,
      // entonces la raíz es '/' que corresponde a sireh_1_1.
      let destino = null;
      if (data.rol === 'Administrador') { // Asegúrate que esto coincida exactamente con Nom_Rol
        destino = '/admin.php';
      } else if (data.rol === 'Recepcionista') { // Asegúrate que esto coincida exactamente con Nom_Rol
        destino = '/recepcionista.php';
      }
      
      console.log('Destino determinado:', destino); // DEBUG

      if (destino) {
        window.location.href = destino;
      } else {
        console.error('Rol no reconocido o destino nulo. Rol recibido:', data.rol); // DEBUG
        if (errorMsgDiv) {
            errorMsgDiv.textContent = 'Rol de usuario no reconocido (' + (data.rol || 'desconocido') + '). Contacte al administrador.';
            errorMsgDiv.style.display = 'block';
        }
      }
    } else {
      // Si data.success es false, el backend debería enviar un mensaje.
      console.log('Login fallido (data.success = false). Mensaje:', data.message); // DEBUG
      if (errorMsgDiv) {
        errorMsgDiv.textContent = data.message || 'Usuario o contraseña incorrectos.';
        errorMsgDiv.style.display = 'block';
      }
    }
  })
  .catch(error => {
    console.error('Error en fetch, procesamiento JSON o error HTTP no OK:', error); // DEBUG
    if (errorMsgDiv) {
        // El objeto error puede tener un mensaje, o ser el texto de la respuesta si res.ok fue false.
        errorMsgDiv.textContent = error.message || 'Error de comunicación con el servidor.';
        errorMsgDiv.style.display = 'block';
    }
  });
});