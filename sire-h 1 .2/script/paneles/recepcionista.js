document.addEventListener('DOMContentLoaded', () => {
  const menuItems = document.querySelectorAll('.menu-item');
  const sections = document.querySelectorAll('.section');

  menuItems.forEach(item => {
    item.addEventListener('click', e => {
      e.preventDefault();

      // Quitar active de todos
      menuItems.forEach(mi => mi.classList.remove('active'));
      // Poner active al clickeado
      item.classList.add('active');

      const sectionToShow = item.dataset.section;

      sections.forEach(sec => {
        if (sec.id === sectionToShow) {
          sec.classList.add('active');
        } else {
          sec.classList.remove('active');
        }
      });
    });
  });
});
