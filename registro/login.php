<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conexion = new mysqli("localhost", "root", "", "tenis");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $query = "SELECT id FROM cuenta WHERE correo = '$email' AND contraseña = '$password'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usuario_id = $row['id'];

        $_SESSION['usuario_id'] = $usuario_id;

        header("Location: ../misreservas/misreservas.php");
        exit();
    } else {
    }

    $conexion->close();
}
?>
