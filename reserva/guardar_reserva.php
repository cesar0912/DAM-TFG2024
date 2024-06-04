<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../registro/inicio-de-sesion.html");
    exit(); 
}


$fecha_formulario = $_POST['datepicker'];
$fecha_mysql = date("Y-m-d", strtotime($fecha_formulario));
$hora = $_POST['hour'];
$pista = $_POST['court'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tenis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$sql = "INSERT INTO reservas (id_cuenta, id_pista, fecha, hora) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $_SESSION['usuario_id'], $pista, $fecha_mysql, $hora);

if ($stmt->execute()) {
    header("Location: ../misreservas/misreservas.php");
} else {
    
}
$conn->close();
?>
