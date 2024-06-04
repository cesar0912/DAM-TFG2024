<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tenis";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$fecha = $_POST['fecha'];
$fecha_mysql = date("Y-m-d", strtotime($fecha));

$pista = $_POST['pista'];
echo "<script>";
echo "console.log('Fecha: $fecha_mysql, Pista: $pista');";
echo "</script>";

$sql = "SELECT hora FROM reservas WHERE fecha = '$fecha_mysql' AND id_pista = $pista";

$result = $conn->query($sql);

$horas_reservadas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $horas_reservadas[] = $row['hora'];
    }
}

echo json_encode($horas_reservadas);

$conn->close();
?>

