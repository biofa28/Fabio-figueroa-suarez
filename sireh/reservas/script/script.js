const botones = {
  'RESERVAR': 'reserva',
  'CONSULTAR RESERVA': 'consulta',
  'CHECK IN': 'checkin',
  'CHECK OUT': 'checkout',
  'CONSUMO': 'consumo',
  'REPORTES': 'reportes'
};

// Mostrar/Ocultar paneles
document.querySelectorAll('.menu button').forEach(btn => {
  btn.addEventListener('click', () => {
    Object.values(botones).forEach(id => {
      const panel = document.getElementById(id);
      if (panel) panel.style.display = 'none';
    });

    const texto = btn.textContent.trim().toUpperCase();
    const panelId = botones[texto];
    if (panelId) {
      const panelMostrar = document.getElementById(panelId);
      if (panelMostrar) panelMostrar.style.display = 'block';
    }
  });
});

// Calcular total a pagar
const precioPorPersonaPorNoche = 100000;
const fechaInicial = document.getElementById('fecha-inicial');
const fechaFinal = document.getElementById('fecha-final');
const personas = document.getElementById('personas');
const totalDiv = document.getElementById('total-pago');

function calcularTotal() {
  const inicio = new Date(fechaInicial.value);
  const fin = new Date(fechaFinal.value);
  const numPersonas = parseInt(personas.value, 10);

  if (inicio && fin && !isNaN(numPersonas)) {
    const noches = Math.ceil((fin - inicio) / (1000 * 60 * 60 * 24));
    if (noches > 0) {
      const total = noches * numPersonas * precioPorPersonaPorNoche;
      totalDiv.textContent = '$' + total.toLocaleString('es-CO');
    } else {
      totalDiv.textContent = 'Fechas inválidas';
    }
  } else {
    totalDiv.textContent = '';
  }
}

if (fechaInicial && fechaFinal && personas) {
  fechaInicial.addEventListener('change', calcularTotal);
  fechaFinal.addEventListener('change', calcularTotal);
  personas.addEventListener('change', calcularTotal);
}

// Simular reservas e información de habitaciones
const reservas = [
  { id: 1, nombre: "Juan Pérez", inicio: "2025-05-20", fin: "2025-05-23", habitacion: "101", estado: "Ocupado" },
  { id: 2, nombre: "Ana García", inicio: "2025-05-21", fin: "2025-05-24", habitacion: "102", estado: "Reservado" }
];

const habitaciones = [
  { numero: 101, estado: "Ocupado" },
  { numero: 102, estado: "Reservado" },
  { numero: 103, estado: "Disponible" },
  { numero: 104, estado: "Disponible" }
];

// Mostrar reservas en la tabla
const tablaReservas = document.querySelector(".tabla-reservas tbody");
reservas.forEach(r => {
  const tr = document.createElement("tr");
  tr.innerHTML = `
    <td>${r.id}</td>
    <td>${r.nombre}</td>
    <td>${r.inicio}</td>
    <td>${r.fin}</td>
    <td>${r.habitacion}</td>
    <td>${r.estado}</td>
  `;
  tablaReservas.appendChild(tr);
});

// Mostrar estado de habitaciones
const listaHabitaciones = document.querySelector(".estado-habitaciones ul");
habitaciones.forEach(h => {
  const li = document.createElement("li");
  li.textContent = `Habitación ${h.numero}: ${h.estado}`;
  listaHabitaciones.appendChild(li);
});
