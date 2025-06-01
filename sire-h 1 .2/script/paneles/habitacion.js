const building = document.getElementById('building');
const btnReservar = document.getElementById('btnReservar');
const resultadoDiv = document.getElementById('resultado');

const totalRooms = 20;

for(let i = 1; i <= totalRooms; i++) {
  const roomDiv = document.createElement('div');
  roomDiv.classList.add('room');
  roomDiv.textContent = `Habitación ${i}`;

  // Alternar ocupada/libre al hacer clic
  roomDiv.addEventListener('click', () => {
    if(roomDiv.classList.contains('ocupada')){
      roomDiv.classList.remove('ocupada');
      roomDiv.textContent = `Habitación ${i}`;
    } else {
      roomDiv.classList.add('ocupada');
      roomDiv.textContent = `Habitación ${i} - Ocupado`;
    }
  });

  building.appendChild(roomDiv);
}

btnReservar.addEventListener('click', () => {
  const ocupadas = [];
  document.querySelectorAll('.room.ocupada').forEach(room => {
    // Eliminar " - Ocupado" para mostrar solo el número
    ocupadas.push(room.textContent.replace(' - Ocupado', ''));
  });

  if(ocupadas.length === 0){
    resultadoDiv.textContent = 'No hay habitaciones reservadas.';
  } else {
    resultadoDiv.textContent = 'Habitaciones reservadas: ' + ocupadas.join(', ');
  }
});
