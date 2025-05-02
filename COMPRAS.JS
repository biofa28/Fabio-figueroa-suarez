document.addEventListener("DOMContentLoaded", function () {
    console.log("Página principal cargada correctamente.");

    // Efecto al pasar el mouse por encima de las tarjetas
    const cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
        // Agregar efecto hover en las tarjetas
        card.addEventListener('mouseover', function() {
            card.style.transform = 'scale(1.05)'; // Aumentar el tamaño de la tarjeta
        });

        card.addEventListener('mouseout', function() {
            card.style.transform = 'scale(1)'; // Restaurar el tamaño original
        });
    });

    // Mostrar mensaje de bienvenida al hacer clic en un módulo
    const links = document.querySelectorAll('.card-title a'); // Todos los enlaces dentro de las tarjetas

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const moduleName = link.textContent; // Obtener el nombre del módulo
            console.log(`Has hecho clic en el módulo: ${moduleName}`);
            alert(`Bienvenido al módulo de ${moduleName}. Ahora puedes gestionar las operaciones correspondientes.`);
        });
    });

    // Puedes agregar más interacciones dinámicas aquí según lo necesites
});
