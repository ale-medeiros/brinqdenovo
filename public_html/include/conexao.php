<?php
$servername = "127.0.0.1:3306";
$database = "u616154191_brinque";
$username = "u616154191_admin";
$password = "V?bj0f!8o*";

$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Definir charset para evitar problemas com acentos
$conn->set_charset("utf8");
?>