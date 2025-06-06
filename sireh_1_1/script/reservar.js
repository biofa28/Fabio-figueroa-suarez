document.addEventListener('DOMContentLoaded', function() {
  const paymentMethod = document.getElementById('payment-method');
  const paymentSections = document.querySelectorAll('.payment-method');
  const reservationForm = document.getElementById('reservation-form');
  const paymentSection = document.getElementById('payment-section');
  const reservationSection = document.getElementById('reservation-section');
  const backButton = document.getElementById('back-button');
  const paymentForm = document.getElementById('payment-form');
  const confirmationSection = document.getElementById('confirmation-section');

  // Ocultar secciones de pago al inicio
  paymentSections.forEach(section => {
    section.style.display = 'none';
  });

  // Mostrar la sección correspondiente al método de pago
  paymentMethod.addEventListener('change', function() {
    paymentSections.forEach(section => {
      section.style.display = 'none';
    });
    const selectedMethod = this.value;
    if (selectedMethod) {
      const sectionToShow = document.getElementById(`${selectedMethod}-section`);
      if (sectionToShow) sectionToShow.style.display = 'block';
    }
  });

  // Paso 1: Enviar formulario de reserva para mostrar método de pago
  reservationForm.addEventListener('submit', function(e) {
    e.preventDefault();
    if (!this.checkValidity()) {
      this.classList.add('was-validated');
      return;
    }
    reservationSection.style.display = 'none';
    paymentSection.style.display = 'block';
    updateProgress(2);
  });

  // Botón para regresar al paso 1
  backButton.addEventListener('click', function() {
    paymentSection.style.display = 'none';
    reservationSection.style.display = 'block';
    updateProgress(1);
  });

  // Paso 2: Enviar formulario de pago y mostrar confirmación
  paymentForm.addEventListener('submit', function(e) {
    e.preventDefault();
    if (!this.checkValidity()) {
      this.classList.add('was-validated');
      return;
    }

    // Obtener datos de reserva para mostrar en confirmación
    const reservationData = {
      name: document.getElementById('name').value,
      email: document.getElementById('email').value,
      phone: document.getElementById('phone').value,
      date: document.getElementById('reservation-date').value,
      service: document.getElementById('service-type').options[document.getElementById('service-type').selectedIndex].text,
      paymentMethod: document.getElementById('payment-method').options[document.getElementById('payment-method').selectedIndex].text
    };

    // Mostrar datos en confirmación
    document.getElementById('conf-name').textContent = reservationData.name;
    document.getElementById('conf-date').textContent = reservationData.date;
    document.getElementById('conf-service').textContent = reservationData.service;
    document.getElementById('conf-payment').textContent = reservationData.paymentMethod;

    // Ocultar método de pago y mostrar confirmación
    paymentSection.style.display = 'none';
    confirmationSection.style.display = 'block';
    updateProgress(3);

    // Aquí puedes agregar lógica para enviar datos al servidor si deseas
    console.log('Reserva confirmada:', reservationData);
  });

  // Fecha mínima para la reserva es hoy
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('reservation-date').min = today;
  document.getElementById('reservation-date').value = today;

  // Función para actualizar la barra de progreso
  function updateProgress(step) {
    const steps = document.querySelectorAll('.rounded-circle');
    steps.forEach((circle, index) => {
      if (index < step) {
        circle.classList.remove('bg-secondary');
        circle.classList.add('bg-gold');
      } else {
        circle.classList.remove('bg-gold');
        circle.classList.add('bg-secondary');
      }
    });
  }
});
