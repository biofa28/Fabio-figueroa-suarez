// Precios base y configuraciones por tipo de habitación
const configHabitaciones = {
  sencilla: {
    precioBase: 180000,
    minPersonas: 1,
    maxPersonas: 1,
    precioPorPersonaExtra: 0,
    descripcion: "Habitación Sencilla"
  },
  doble: {
    precioBase: 250000,
    minPersonas: 1,
    maxPersonas: 2,
    precioPorPersonaExtra: 0,
    descripcion: "Habitación Doble"
  },
  familiar: {
    precioBase: 400000,
    minPersonas: 3,
    maxPersonas: 5,
    precioPorPersonaExtra: 50000, // Se cobra por persona extra
    descripcion: "Habitación Familiar"
  }
};

let carrito = [];

// Función para validar fechas
function validarFechas(entrada, salida) {
  const hoy = new Date();
  hoy.setHours(0, 0, 0, 0);
  
  const fechaEntrada = new Date(entrada);
  const fechaSalida = new Date(salida);
  
  // Validar que las fechas no sean anteriores a hoy
  if (fechaEntrada < hoy || fechaSalida < hoy) {
    alert("Las fechas no pueden ser anteriores al día de hoy");
    return false;
  }
  
  // Validar que la fecha de salida sea posterior a la de entrada
  if (fechaSalida <= fechaEntrada) {
    alert("La fecha de salida debe ser posterior a la de entrada");
    return false;
  }
  
  return true;
}

// Función para calcular el precio total
function calcularPrecio(tipoHabitacion, personas) {
  const config = configHabitaciones[tipoHabitacion];
  let precioTotal = config.precioBase;
  
  // Calcular costo por personas extras (solo para familiar)
  if (tipoHabitacion === 'familiar' && personas > config.minPersonas) {
    const personasExtra = personas - config.minPersonas;
    precioTotal += personasExtra * config.precioPorPersonaExtra;
  }
  
  return precioTotal;
}

// Función para agregar al carrito
function agregarAlCarrito() {
  const tipoHabitacion = document.getElementById('tipoHabitacion').value;
  const personas = parseInt(document.getElementById('personas').value);
  const entrada = document.getElementById('entrada').value;
  const salida = document.getElementById('salida').value;
  
  // Validar campos requeridos
  if (!entrada || !salida) {
    alert("Por favor selecciona las fechas de entrada y salida");
    return;
  }
  
  // Validar fechas
  if (!validarFechas(entrada, salida)) {
    return;
  }
  
  // Validar número de personas según tipo de habitación
  const config = configHabitaciones[tipoHabitacion];
  
  if (personas < config.minPersonas) {
    alert(`La habitación ${config.descripcion} requiere mínimo ${config.minPersonas} persona(s)`);
    return;
  }
  
  if (personas > config.maxPersonas) {
    if (config.precioPorPersonaExtra > 0) {
      if (!confirm(`La habitación ${config.descripcion} tiene un máximo de ${config.maxPersonas} personas. 
      \nPersonas adicionales tendrán un costo extra de $${config.precioPorPersonaExtra.toLocaleString()} por persona.
      \n¿Deseas continuar?`)) {
        return;
      }
    } else {
      alert(`La habitación ${config.descripcion} solo permite máximo ${config.maxPersonas} persona(s)`);
      return;
    }
  }
  
  // Calcular precio total
  const precioTotal = calcularPrecio(tipoHabitacion, personas);
  
  // Crear objeto de reserva
  const reserva = {
    tipo: tipoHabitacion,
    descripcion: config.descripcion,
    personas: personas,
    entrada: entrada,
    salida: salida,
    precio: precioTotal,
    fechaReserva: new Date().toLocaleDateString()
  };
  
  // Agregar al carrito
  carrito.push(reserva);
  actualizarCarrito();
  
  // Feedback al usuario
  alert(`¡Reserva agregada!\n${config.descripcion} para ${personas} persona(s)\nTotal: $${precioTotal.toLocaleString()}`);
}

// Función para actualizar el carrito
function actualizarCarrito() {
  const carritoList = document.getElementById('carritoList');
  const totalPrecio = document.getElementById('totalPrecio');
  
  if (carrito.length === 0) {
    carritoList.innerHTML = '<p class="text-muted">No hay elementos en el carrito</p>';
    totalPrecio.textContent = '$0';
    return;
  }
  
  carritoList.innerHTML = '';
  let total = 0;
  
  carrito.forEach((item, index) => {
    total += item.precio;
    
    const reservaItem = document.createElement('div');
    reservaItem.className = 'reserva-item d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded';
    reservaItem.innerHTML = `
      <div>
        <strong>${item.descripcion}</strong><br>
        <small>${item.personas} persona(s) | ${item.entrada} a ${item.salida}</small>
      </div>
      <div class="text-end">
        <strong>$${item.precio.toLocaleString()}</strong><br>
        <button class="btn btn-sm btn-link text-danger p-0" onclick="eliminarReserva(${index})">
          <i class="bi bi-trash"></i> Eliminar
        </button>
      </div>
    `;
    
    carritoList.appendChild(reservaItem);
  });
  
  totalPrecio.textContent = `$${total.toLocaleString()}`;
}

// Función para eliminar reserva
function eliminarReserva(index) {
  carrito.splice(index, 1);
  actualizarCarrito();
}

// Función para realizar compra
function realizarCompra() {
  if (carrito.length === 0) {
    alert('No hay reservas en el carrito');
    return;
  }
  
  // Guardar en sessionStorage
  sessionStorage.setItem('carritoReserva', JSON.stringify(carrito));
  
  // Redireccionar a reserva.html
  window.location.href = "../reservas/reserva.html";
}

// Función para redireccionar a reserva
function irAReserva() {
  if (carrito.length === 0) {
    alert('Por favor agrega al menos una habitación al carrito');
    return;
  }
  
  sessionStorage.setItem('carritoReserva', JSON.stringify(carrito));
  window.location.href = "../reservas/reserva.html";
}

// Inicializar el formulario
document.addEventListener('DOMContentLoaded', function() {
  // Configurar fecha mínima (hoy)
  const hoy = new Date().toISOString().split('T')[0];
  document.getElementById('entrada').min = hoy;
  document.getElementById('entrada').value = hoy;
  
  const manana = new Date();
  manana.setDate(manana.getDate() + 1);
  document.getElementById('salida').min = manana.toISOString().split('T')[0];
  document.getElementById('salida').value = manana.toISOString().split('T')[0];
  
  // Actualizar límites de personas al cambiar tipo de habitación
  document.getElementById('tipoHabitacion').addEventListener('change', function() {
    const tipo = this.value;
    const personasInput = document.getElementById('personas');
    const config = configHabitaciones[tipo];
    
    personasInput.min = config.minPersonas;
    personasInput.max = config.maxPersonas;
    personasInput.value = config.minPersonas;
  });
  
  // Inicializar con los valores de la primera opción
  const tipoInicial = document.getElementById('tipoHabitacion').value;
  const configInicial = configHabitaciones[tipoInicial];
  document.getElementById('personas').min = configInicial.minPersonas;
  document.getElementById('personas').max = configInicial.maxPersonas;
  document.getElementById('personas').value = configInicial.minPersonas;
});