document.getElementById('pago-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Prevenir el envío del formulario hasta que se complete la validación

    // Obtener los valores del formulario
    const idFactura = document.getElementById('idFactura').value;
    const fechaPago = document.getElementById('fechaPago').value;
    const monto = document.getElementById('monto').value;
    const metodoPago = document.getElementById('metodoPago').value;

    // Validación de los campos
    if (!idFactura || !fechaPago || !monto || !metodoPago) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Si todo está bien, envía el formulario
    this.submit();  // Enviar el formulario
});
