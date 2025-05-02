document.getElementById('informes-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Prevenir el envío del formulario hasta que se complete la validación

    // Obtener los valores del formulario
    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFin = document.getElementById('fechaFin').value;

    // Validación de las fechas
    if (!fechaInicio || !fechaFin) {
        alert("Por favor, selecciona las fechas.");
        return;
    }

    // Si todo está bien, envía el formulario
    this.submit();  // Enviar el formulario
});
