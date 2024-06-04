<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas del usuario</title>
    <style>
        body{
            width: 99%;
            height: 100%;
            background: url("https://media.istockphoto.com/id/1176735816/es/foto/pista-de-tenis-azul-y-arena-cubierta-iluminada-con-ventiladores-vista-frontal-superior.jpg?s=612x612&w=0&k=20&c=-BJV7X3L9TZpIVxtyVv0OKWjF7lQ_i7sr5Og6pjXodo=");
           
            background-repeat: no-repeat;
            background-size: cover;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        tr td{
            color:white;
        }
        tr:hover td{
            background-color: #f5f5f5;
            color:black;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            color: red;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
session_start();

if ( $_SESSION['usuario_id'] == null) {
    header("Location: ../pistasTenis/registro/inicio-de-sesion.html");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "tenis");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$id_usuario = $_SESSION['usuario_id']; 
$sql = "SELECT * FROM reservas WHERE id_cuenta = $id_usuario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo "<h2>Reservas del usuario:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Fecha</th><th>Hora</th><th>Número de Pista</th><th>Acción</th></tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['fecha'] . "</td>";
        echo "<td>" . $fila['hora'] . "</td>";
        echo "<td>" . $fila['id_pista'] . "</td>";
        echo "<td><a href='eliminar_reserva.php?id=" . $fila['id'] . "'>Eliminar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron reservas para este usuario.";
}

$conexion->close();
?>
<a href="../inicio/inicio.html" class="button">Regresar</a>
<a href="../misreservas/cerrar-sesion.php" class="button">Cerrar sesión</a>
</body>
</html>
