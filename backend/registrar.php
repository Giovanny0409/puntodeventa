<?php
include "db.php";

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$tipo = $_POST['tipo'];

$sql = "INSERT INTO usuarios (nombre, usuario, password, tipo) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $usuario, $password, $tipo);
$stmt->execute();

header("Location: ../login.html");
exit();
?>
