<?php
session_start();
include "db.php";

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
  $fila = $resultado->fetch_assoc();
  if (password_verify($password, $fila['password'])) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");

    exit();
  }
}
header("Location: ../login.html?error=1");
exit();
?>
