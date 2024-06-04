document.addEventListener("DOMContentLoaded", function() {
    var loginLink = document.getElementById("login_inicio");
    var conocenosLink = document.getElementById("conocenos");
    var reservaconocenosLink = document.getElementById("reserva");
    var inicioLink = document.getElementById("inicio");
    var btnReservar = document.getElementById("btn-reservar");


    btnReservar.addEventListener("click", function(event) {
        $.ajax({
            url: 'verificar_sesion.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.usuarioHaIniciadoSesion) {
                    guardarReserva();
                } else {
                    window.location.href = "../registro/inicio-de-sesion.html";
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al verificar la sesión:', error);
            }
        });
    });

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
        window.location.href = "../pistasTenis/inicio/inicio.html";
    });
});

function guardarReserva() {
    var fecha = document.getElementById("datepicker").value;
    var hora = document.getElementById("hour").value;
    var pista = document.getElementById("court").value;
    var reserva = {
        fecha: fecha,
        hora: hora,
        pista: pista
    };

    $.ajax({
        url: 'guardar_reserva.php',
        type: 'POST',
        dataType: 'json',
        data: reserva,
        success: function(response) {
            if (response.exito) {
                alert("¡Reserva realizada con éxito!");
            } else {
                alert("Error al guardar la reserva. Por favor, inténtalo de nuevo.");
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al guardar la reserva:', error);
        }
    });
}


