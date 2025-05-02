document.getElementById('requerimiento-form').addEventListener('submit', function(e) {
    // Prevenir el envío del formulario hasta que se complete la validación
    // e.preventDefault(); // No es necesario si vas a enviar el formulario

    // Obtener los valores del formulario
    const fecha = document.getElementById('fecha').value;
    const estado = document.getElementById('estado').value;
    const descripcion = document.getElementById('descripcion').value;
    const cantidad = document.getElementById('cantidad').value;

    // Validación de los campos
    if (!fecha || !estado || !descripcion || !cantidad) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Si pasa todas las validaciones, muestra un mensaje de éxito
    alert('Requerimiento creado exitosamente!');
});
