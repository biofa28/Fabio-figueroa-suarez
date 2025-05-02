document.getElementById('proveedor-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevenir el envío del formulario hasta que se complete la validación

    // Obtener los valores del formulario
    const nombre = document.getElementById('nombre').value;
    const direccion = document.getElementById('direccion').value;
    const telefono = document.getElementById('telefono').value;
    const email = document.getElementById('email').value;
    const rnc = document.getElementById('rnc').value;
    const estado = document.getElementById('estado').value;

    // Validación de los campos
    if (!nombre || !direccion || !telefono || !email || !rnc || !estado) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Si todo está bien, envía el formulario
    this.submit(); // Enviar el formulario
});
