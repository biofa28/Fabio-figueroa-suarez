document.addEventListener('DOMContentLoaded', () => {
  const menuItems = document.querySelectorAll('.menu-item');
  const sections = document.querySelectorAll('.section');
  const form = document.getElementById('formRegistrar');
  const mensajeDiv = document.getElementById('mensaje');

  // Cambiar secciones visibles
  menuItems.forEach(item => {
    item.addEventListener('click', e => {
      e.preventDefault();
      menuItems.forEach(i => i.classList.remove('active'));
      item.classList.add('active');
      const target = item.getAttribute('data-section');
      sections.forEach(sec => {
        sec.style.display = (sec.id === target) ? 'block' : 'none';
      });
    });
  });

  // Enviar formulario con fetch sin recargar
  form.addEventListener('submit', e => {
    e.preventDefault();
    mensajeDiv.textContent = '';
    mensajeDiv.className = '';

    const formData = new FormData(form);

    fetch('controlador/registrar_recepcionista.php', {  // Ajusta esta ruta según estructura
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(text => {
      mensajeDiv.textContent = text;
      if (text.toLowerCase().includes('éxito')) {
        mensajeDiv.classList.add('mensaje', 'exito');
        form.reset();
      } else {
        mensajeDiv.classList.add('mensaje', 'error');
      }
    })
    .catch(() => {
      mensajeDiv.textContent = 'Error al registrar usuario.';
      mensajeDiv.classList.add('mensaje', 'error');
    });
  });
});
