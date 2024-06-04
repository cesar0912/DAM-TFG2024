<?php
session_start();

$_SESSION['usuario_id'] = null;

if (isset($_SESSION['usuario_id'])) {
    header("Location: ../pistasTenis/inicio/inicio.html");
    exit();
} else {
    header("Location: ../pistasTenis/registro/inicio-de-sesion.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redirección con inicio de sesión</title>
</head>
<body>
</body>
</html>

