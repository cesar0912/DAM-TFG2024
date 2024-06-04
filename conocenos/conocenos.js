document.addEventListener("DOMContentLoaded", function() {
    var loginLink = document.getElementById("login_inicio");
    var conocenosLink = document.getElementById("conocenos");
    var reservaconocenosLink = document.getElementById("reserva");
    var inicioLink = document.getElementById("inicio");
loginLink.addEventListener("click", function(event) {
    event.preventDefault();
    
    fetch("verificar_sesion.php")
    .then(response => response.json())
    .then(data => {
        if (data.usuarioHaIniciadoSesion) {
            window.location.href = "../misreservas/misreservas.php";
        } else {
            window.location.href = "../registro/inicio-de-sesion.html";
        }
    })
    .catch(error => {
        console.error('Error al verificar la sesión:', error);
    });
});
    conocenosLink.addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = "../conocenos/conocenos.html";
    });
    reservaconocenosLink.addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = "../reserva/reserva.html";
    });
    inicioLink.addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = "../inicio/inicio.html";
    });
});