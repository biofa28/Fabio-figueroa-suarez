document.getElementById('factura-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Prevenir el envío del formulario hasta que se complete la validación

    // Obtener los valores del formulario
    const idOrdenCompra = document.getElementById('idOrdenCompra').value;
    const fechaFactura = document.getElementById('fechaFactura').value;
    const montoTotal = document.getElementById('montoTotal').value;
    const estadoFactura = document.getElementById('estadoFactura').value;

    // Validación de los campos
    if (!idOrdenCompra || !fechaFactura || !montoTotal || !estadoFactura) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Si todo está bien, envía el formulario
    this.submit();  // Enviar el formulario
});
