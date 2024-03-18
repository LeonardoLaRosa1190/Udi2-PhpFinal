<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "final_udi2";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
