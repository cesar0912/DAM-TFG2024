<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar la contraseña (por ejemplo, longitud mínima de 6 caracteres)
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
    $error_message = "La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y números.";
    }

    if (isset($error_message)) {
    exit();
    }

    $conexion = new mysqli("localhost", "root", "", "tenis");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificar si el usuario ya está registrado
    $email = $conexion->real_escape_string($email); // Escapar entrada para evitar inyección SQL
    $checkQuery = "SELECT * FROM cuenta WHERE correo = '$email'";
    $result = $conexion->query($checkQuery);

    if ($result) {
    if ($result->num_rows > 0) {
        
        exit();
    }
    } else {
        $error_message = "Error al ejecutar la consulta: " . $conexion->error;
    }

   
    $password = password_hash($password, PASSWORD_BCRYPT); 
    $query = "INSERT INTO cuenta (correo, contraseña, nombre) VALUES ('$email', '$password', '$nombre')";

    if ($conexion->query($query) === TRUE) {
        $usuario_id = $conexion->insert_id;
        
        $_SESSION['usuario_id'] = $usuario_id;

        header("Location: ../misreservas/misreservas.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . $conexion->error;
    }

    $conexion->close();
}
?>
