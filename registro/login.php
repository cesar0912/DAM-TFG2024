<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conexion = new mysqli("localhost", "root", "", "tenis");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Busca el hash de la contraseña en la base de datos
    $query = "SELECT id, contraseña FROM cuenta WHERE correo = '$email'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password_hash = $row['contraseña'];
        
        // Verifica si la contraseña proporcionada coincide con el hash almacenado
        if (password_verify($password, $stored_password_hash)) {
            // La contraseña es correcta
            $usuario_id = $row['id'];
            $_SESSION['usuario_id'] = $usuario_id;

            header("Location: ../misreservas/misreservas.php");
            exit();
        } else {
            header("Location: ../registro/inicio-de-sesion.html");
        }
    } else {
        
            header("Location: ../registro/inicio-de-sesion.html");
    }

    $conexion->close();
}
?>
