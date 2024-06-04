<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../pistasTenis/registro/inicio-de-sesion.html");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Error: No se proporcionó el ID de la reserva.";
    exit();
}

$id_reserva = $_GET['id'];

$conexion = new mysqli("localhost", "root", "", "tenis");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$id_usuario = $_SESSION['usuario_id'];
$sql = "SELECT * FROM reservas WHERE id = $id_reserva AND id_cuenta = $id_usuario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows === 0) {
    echo "Error: No se encontró la reserva o no tienes permiso para eliminarla.";
    exit();
}

$sql_eliminar = "DELETE FROM reservas WHERE id = $id_reserva";
if ($conexion->query($sql_eliminar) === TRUE) {
    header("Location: ../misreservas/misreservas.php");
} else {
    echo "Error al eliminar la reserva: " . $conexion->error;
}

$conexion->close();
?>
