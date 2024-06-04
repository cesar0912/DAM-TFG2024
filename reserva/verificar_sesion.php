<?php
session_start();

$usuarioHaIniciadoSesion = isset($_SESSION['usuario_id']);

echo json_encode(array('usuarioHaIniciadoSesion' => $usuarioHaIniciadoSesion));
?>
