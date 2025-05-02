document.getElementById('orden-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Prevenir el envío del formulario hasta que se complete la validación

    // Obtener los valores del formulario
    const idProveedor = document.getElementById('idProveedor').value;
    const fechaOrden = document.getElementById('fechaOrden').value;
    const montoTotal = document.getElementById('montoTotal').value;
    const estadoOrden = document.getElementById('estadoOrden').value;

    // Validación de los campos
    if (!idProveedor || !fechaOrden || !montoTotal || !estadoOrden) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Si todo está bien, envía el formulario
    this.submit();  // Enviar el formulario
});
