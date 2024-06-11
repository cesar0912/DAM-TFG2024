document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = document.getElementById('registrationForm');
    const registerLink = document.getElementById('registerLink');
    const loginLink = document.getElementById('loginLink');
    const loginForm = document.getElementById('loginForm');
    const backButton = document.getElementById('buttonBack');
    registerLink.addEventListener('click', function (event) {

        window.location.href = "../registro/registro.html";
    });
    loginLink.addEventListener('click', function (event) {
        event.preventDefault();
        window.location.href = "../registro/inicio-de-sesion.html";
    });
    backButton.addEventListener("click", function (event) {
        event.preventDefault();
        window.location.href = "../inicio/inicio.html";
    });
});
