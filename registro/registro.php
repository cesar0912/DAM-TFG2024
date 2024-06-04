<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conexion = new mysqli("localhost", "root", "", "tenis");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $query = "INSERT INTO cuenta (correo, contraseña, nombre) VALUES ('$email', '$password','$nombre')";

    if ($conexion->query($query) === TRUE) {
        $usuario_id = $conexion->insert_id;
        
        $_SESSION['usuario_id'] = $usuario_id;

        header("Location: ../misreservas/misreservas.php");
        exit();
    } else {
    }

    $conexion->close();
}
?>
