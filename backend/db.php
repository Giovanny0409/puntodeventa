<?php
$host = '192.168.0.104';
$db = 'sistema_usuarios'; // El nombre de tu base de datos creada desde phpMyAdmin
$user = 'root';
$pass = '0409';

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
