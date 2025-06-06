console.log('Archivo JS cargado');

function updateCountdowns() {
  const rows = document.querySelectorAll('#reservas tbody tr');
  const now = new Date().getTime();

  rows.forEach(row => {
    const fechaCreacion = new Date(row.dataset.fecha).getTime();
    const limite = fechaCreacion + 24 * 60 * 60 * 1000;
    const diff = limite - now;
    const countdownCell = row.querySelector('.countdown');
    const estadoCell = row.querySelector('.estado');

    if (diff > 0) {
      const h = Math.floor(diff / (1000 * 60 * 60));
      const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      const s = Math.floor((diff % (1000 * 60)) / 1000);
      countdownCell.textContent = `${h}h ${m}m ${s}s`;
      row.style.backgroundColor = '';
      estadoCell.textContent = 'pendiente';
    } else {
      countdownCell.textContent = 'Tiempo Expirado';
      row.style.backgroundColor = '#f8d7da';
      estadoCell.textContent = 'cancelada';
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const menuItems = document.querySelectorAll('.menu-item');
  const sections = document.querySelectorAll('.section');
  let countdownInterval;

  function showSection(id) {
    sections.forEach(sec => {
      if (sec.id === id) {
        sec.classList.add('active');
      } else {
        sec.classList.remove('active');
      }
    });

    if (id === 'reservas') {
      updateCountdowns();
      countdownInterval = setInterval(updateCountdowns, 1000);
    } else if (countdownInterval) {
      clearInterval(countdownInterval);
    }
  }

  menuItems.forEach(item => {
    item.addEventListener('click', e => {
      e.preventDefault();

      menuItems.forEach(mi => mi.classList.remove('active'));
      item.classList.add('active');

      const sectionToShow = item.dataset.section;
      showSection(sectionToShow);
    });
  });

  // Inicializa mostrando la sección activa (por defecto)
  const activeSection = document.querySelector('.menu-item.active');
  if (activeSection) {
    showSection(activeSection.dataset.section);
  }
});
