<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido!");
    }

    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO tb_usuarios (nome, email, senha_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha_hash);

    if ($stmt->execute()) {
        header("Location: ../../login/login.html");
    } else {
        header("Location: ../register.html");
    }

    $stmt->close();
    $conn->close();
}
?>
