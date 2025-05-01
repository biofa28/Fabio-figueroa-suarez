document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Simulación de autenticación (en producción, usar API)
    if (username === 'compras' && password === '123') {
        window.location.href = 'ordenes-compra.html';
    } else {
        alert('Credenciales incorrectas');
    }
});