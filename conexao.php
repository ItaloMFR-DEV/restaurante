<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurante";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
