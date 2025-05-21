document.addEventListener('DOMContentLoaded', function() {
  // Mostrar secciones de pago según método seleccionado
  const paymentMethod = document.getElementById('payment-method');
  const paymentSections = document.querySelectorAll('.payment-method');
  
  paymentMethod.addEventListener('change', function() {
    // Ocultar todas las secciones primero
    paymentSections.forEach(section => {
      section.style.display = 'none';
    });
    
    // Mostrar la sección correspondiente
    const selectedMethod = this.value;
    if (selectedMethod) {
      document.getElementById(`${selectedMethod}-section`).style.display = 'block';
    }
  });

  // Manejar el envío del formulario de reserva
  const reservationForm = document.getElementById('reservation-form');
  const paymentSection = document.getElementById('payment-section');
  const reservationSection = document.getElementById('reservation-section');
  
  reservationForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validar formulario
    if (!this.checkValidity()) {
      this.classList.add('was-validated');
      return;
    }
    
    // Mostrar sección de pago y ocultar la de reserva
    reservationSection.style.display = 'none';
    paymentSection.style.display = 'block';
    
    // Actualizar indicador de progreso
    updateProgress(2);
  });

  // Botón para volver atrás
  const backButton = document.getElementById('back-button');
  backButton.addEventListener('click', function() {
    paymentSection.style.display = 'none';
    reservationSection.style.display = 'block';
    updateProgress(1);
  });

  // Manejar el envío del formulario de pago
  const paymentForm = document.getElementById('payment-form');
  const confirmationSection = document.getElementById('confirmation-section');
  
  paymentForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validar formulario
    if (!this.checkValidity()) {
      this.classList.add('was-validated');
      return;
    }
    
    // Obtener datos del formulario de reserva
    const reservationData = {
      name: document.getElementById('name').value,
      email: document.getElementById('email').value,
      phone: document.getElementById('phone').value,
      date: document.getElementById('reservation-date').value,
      service: document.getElementById('service-type').options[document.getElementById('service-type').selectedIndex].text,
      paymentMethod: document.getElementById('payment-method').options[document.getElementById('payment-method').selectedIndex].text
    };
    
    // Mostrar datos en la sección de confirmación
    document.getElementById('conf-name').textContent = reservationData.name;
    document.getElementById('conf-date').textContent = reservationData.date;
    document.getElementById('conf-service').textContent = reservationData.service;
    document.getElementById('conf-payment').textContent = reservationData.paymentMethod;
    
    // Generar y mostrar el volante de pago exitoso
    showSuccessPayment(reservationData);
    
    paymentSection.style.display = 'none';
    confirmationSection.style.display = 'block';
    updateProgress(3);
    
    // Envío de datos al servidor (simulado)
    console.log('Datos de reserva:', reservationData);
    console.log('Datos de pago:', {
      paymentMethod: paymentMethod.value,
      nequiNumber: document.getElementById('nequi-number')?.value,
      bank: document.getElementById('bank-select')?.value,
      cardNumber: document.getElementById('card-number')?.value,
      expiryDate: document.getElementById('expiry-date')?.value,
      cvv: document.getElementById('cvv')?.value,
      cardHolder: document.getElementById('card-holder-name')?.value,
      autoPayment: document.getElementById('auto-payment').checked
    });
  });

  // Inicializar fecha mínima para reserva
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('reservation-date').min = today;
  document.getElementById('reservation-date').value = today;

  // Función para actualizar el indicador de progreso
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

  // Función para mostrar el volante de pago exitoso
  function showSuccessPayment(reservationData) {
    // Limpiar contenido previo
    const cardBody = confirmationSection.querySelector('.card-body');
    cardBody.innerHTML = '';
    
    // Crear elementos del volante
    const successIcon = document.createElement('div');
    successIcon.className = 'mb-4';
    successIcon.innerHTML = '<i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>';
    
    const title = document.createElement('h2');
    title.className = 'fw-bold text-brown mb-3';
    title.textContent = '¡Pago Exitoso!';
    
    const subtitle = document.createElement('p');
    subtitle.className = 'lead';
    subtitle.textContent = 'Gracias por reservar con Hotel Sire-H';
    
    const message = document.createElement('p');
    message.textContent = 'Hemos enviado los detalles de tu reserva a tu correo electrónico.';
    
    // Crear tarjeta con detalles
    const detailsCard = document.createElement('div');
    detailsCard.className = 'card bg-light mt-4 mb-4 text-start';
    
    const cardBodyContent = document.createElement('div');
    cardBodyContent.className = 'card-body';
    
    const cardTitle = document.createElement('h5');
    cardTitle.className = 'fw-bold text-brown mb-3';
    cardTitle.textContent = 'Detalles de tu pago:';
    
    // Crear elementos de detalles
    const nameDetail = document.createElement('p');
    nameDetail.innerHTML = `<strong>Nombre:</strong> ${reservationData.name}`;
    
    const dateDetail = document.createElement('p');
    dateDetail.innerHTML = `<strong>Fecha:</strong> ${reservationData.date}`;
    
    const serviceDetail = document.createElement('p');
    serviceDetail.innerHTML = `<strong>Servicio:</strong> ${reservationData.service}`;
    
    const paymentDetail = document.createElement('p');
    paymentDetail.innerHTML = `<strong>Método de pago:</strong> ${reservationData.paymentMethod}`;
    
    const referenceDetail = document.createElement('p');
    referenceDetail.innerHTML = `<strong>Referencia de pago:</strong> ${generatePaymentReference()}`;
    
    const totalDetail = document.createElement('p');
    totalDetail.innerHTML = `<strong>Total pagado:</strong> $${calculateTotal(reservationData.service).toLocaleString()}`;
    
    // Construir estructura
    cardBodyContent.appendChild(cardTitle);
    cardBodyContent.appendChild(nameDetail);
    cardBodyContent.appendChild(dateDetail);
    cardBodyContent.appendChild(serviceDetail);
    cardBodyContent.appendChild(paymentDetail);
    cardBodyContent.appendChild(referenceDetail);
    cardBodyContent.appendChild(totalDetail);
    
    detailsCard.appendChild(cardBodyContent);
    
    // Botón de volver al inicio
    const homeButton = document.createElement('a');
    homeButton.href = '../index.html';
    homeButton.className = 'btn btn-warning mt-3 py-3 px-5 fw-bold';
    homeButton.textContent = 'VOLVER AL INICIO';
    
    // Agregar todos los elementos al cardBody
    cardBody.appendChild(successIcon);
    cardBody.appendChild(title);
    cardBody.appendChild(subtitle);
    cardBody.appendChild(message);
    cardBody.appendChild(detailsCard);
    cardBody.appendChild(homeButton);
  }

  // Función para generar referencia de pago
  function generatePaymentReference() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let result = '';
    for (let i = 0; i < 10; i++) {
      result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
  }

  // Función para calcular el total
  function calculateTotal(service) {
    const prices = {
      'Alojamiento': 350000,
      'Comida': 120000,
      'Paquete especial': 500000
    };
    return prices[service] || 250000;
  }
});