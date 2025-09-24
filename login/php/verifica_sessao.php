<?php
session_start();

if (!isset($_SESSION['tb_usuarios_id'])) {
    header("Location: ../login.php");
    exit();
}

$usuario_id = $_SESSION['tb_usuarios_id'];
$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário';
?>