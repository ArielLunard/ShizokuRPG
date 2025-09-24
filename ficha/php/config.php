<?php
$host = "127.0.0.1";
$db   = "u834715996_shizoku";
$user = "u834715996_devariel";
$pass = "DevAri25!";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?> 
