document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('form-reservation');
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const step3 = document.getElementById('step3');
  const totalPriceEl = document.getElementById('total-price');
  const paypalContainer = document.getElementById('paypal-btn-container');
  const roomSelect = document.getElementById('roomtype');

  let reservationData = {};
  let tiposHabitacion = []; // Variable para guardar los datos de la BD

  // Esta función se ejecuta al cargar la página para obtener los tipos de habitación.
  function cargarTiposHabitacion() {
    fetch('../controlador/HabitacionController.php')
      .then(response => {
        if (!response.ok) {
          throw new Error('Respuesta del servidor no fue OK');
        }
        return response.json();
      })
      .then(data => {
        if (data.success && data.data.length > 0) {
          tiposHabitacion = data.data; // Guardamos los datos
          roomSelect.innerHTML = '<option value="" disabled selected>Selecciona una opción</option>';
          
          tiposHabitacion.forEach(tipo => {
            const option = document.createElement('option');
            option.value = tipo.Id_TipoHabitacion;
            option.textContent = `${tipo.Nom_TipoHabitacion} - $${parseFloat(tipo.Precio_Base_Noche).toFixed(2)} USD/noche`;
            roomSelect.appendChild(option);
          });
        } else {
          roomSelect.innerHTML = '<option value="" disabled selected>No hay habitaciones disponibles</option>';
        }
      })
      .catch(error => {
        console.error('Error al cargar tipos de habitación:', error);
        roomSelect.innerHTML = '<option value="" disabled selected>Error al cargar datos</option>';
      });
  }

  // El cálculo del total ahora es dinámico.
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      return;
    }

    const checkin = new Date(document.getElementById('checkin').value);
    const checkout = new Date(document.getElementById('checkout').value);
    const days = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));

    if (days <= 0) {
      alert('La fecha de salida debe ser posterior a la de llegada.');
      return;
    }

    const habitacionSeleccionada = tiposHabitacion.find(
      h => h.Id_TipoHabitacion === roomSelect.value
    );

    if (!habitacionSeleccionada) {
      alert('Por favor, selecciona un tipo de habitación válido.');
      return;
    }

    const precioPorNoche = parseFloat(habitacionSeleccionada.Precio_Base_Noche);

    reservationData = {
      fullname: document.getElementById('fullname').value,
      email: document.getElementById('emailaddr').value,
      phone: document.getElementById('phone').value,
      id: document.getElementById('id_usuario').value,
      checkin: document.getElementById('checkin').value,
      checkout: document.getElementById('checkout').value,
      guests: document.getElementById('guests').value,
      id_servicio: parseInt(roomSelect.value),
      days: days,
      total: days * precioPorNoche,
    };

    totalPriceEl.textContent = `$${reservationData.total.toFixed(2)} USD`;
    step1.classList.add('hidden');
    step2.classList.remove('hidden');

    renderPayPalButton(reservationData.total);
  });
  
  document.getElementById('backToStep1').addEventListener('click', () => {
    step2.classList.add('hidden');
    step1.classList.remove('hidden');
  });

  document.getElementById('newBooking').addEventListener('click', () => {
    form.reset();
    form.classList.remove('was-validated');
    step3.classList.add('hidden');
    step1.classList.remove('hidden');
    cargarTiposHabitacion(); 
  });

  function renderPayPalButton(amount) {
    paypalContainer.innerHTML = '';
    paypal.Buttons({
      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: amount.toFixed(2),
              currency_code: 'USD'
            }
          }]
        });
      },
      onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
          mostrarConfirmacion(details.id);
        });
      },
      onError: function (err) {
        console.error('PayPal Error:', err);
        alert('Ocurrió un error con el pago. Intenta nuevamente.');
      }
    }).render('#paypal-btn-container');
  }

  function mostrarConfirmacion(txid) {
    step2.classList.add('hidden');
    step3.classList.remove('hidden');
    document.getElementById('conf-name').textContent = reservationData.fullname;
    document.getElementById('conf-email').textContent = reservationData.email;
    document.getElementById('conf-phone').textContent = reservationData.phone;
    document.getElementById('conf-idusuario').textContent = reservationData.id;
    document.getElementById('conf-checkin').textContent = reservationData.checkin;
    document.getElementById('conf-checkout').textContent = reservationData.checkout;
    document.getElementById('conf-days').textContent = reservationData.days;
    document.getElementById('conf-guests').textContent = reservationData.guests;
    
    const habitacionSeleccionada = tiposHabitacion.find(h => h.Id_TipoHabitacion == reservationData.id_servicio);
    document.getElementById('conf-roomtype').textContent = habitacionSeleccionada ? habitacionSeleccionada.Nom_TipoHabitacion : 'No especificada';

    document.getElementById('conf-total').textContent = `$${reservationData.total.toFixed(2)} USD`;
    document.getElementById('conf-txid').textContent = txid;

    const datos = {
      ...reservationData,
      transaction_id: txid
    };

    fetch('../controlador/ReservaController.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(datos)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorData => {
                throw new Error(errorData.message || 'Error desconocido del servidor.');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'ok') {
            console.log('Respuesta del servidor:', data.message);
        } else {
            alert('Hubo un problema al registrar tu reserva: ' + data.message);
        }
    })
    .catch(err => {
        console.error('Error en fetch:', err);
        alert('Error crítico al conectar con el servidor: ' + err.message);
    });
  }

  // Al cargar la página, llamamos a la función para llenar el select de habitaciones.
  cargarTiposHabitacion();
});