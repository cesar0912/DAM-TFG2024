document.addEventListener('DOMContentLoaded', function() {
    const registrationForm = document.getElementById('registrationForm');
    const registerLink = document.getElementById('registerLink');
    const loginLink = document.getElementById('loginLink');
    const loginForm = document.getElementById('loginForm');
    const backButton = document.getElementById('buttonBack');
    registerLink.addEventListener('click', function(event) {
        event.preventDefault(); 
        registrationForm.style.display = 'block'; 
        loginForm.style.display = 'none'; 
    });
    loginLink.addEventListener('click', function(event) {
        event.preventDefault();
        registrationForm.style.display = 'none';
        loginForm.style.display = 'block'; 
    });
    backButton.addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = "../inicio/inicio.html";
    });
});
