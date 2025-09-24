<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido!");
    }

    $stmt = $conn->prepare("SELECT tb_usuarios_id, nome, senha_hash FROM tb_usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario["senha_hash"])) {
            $_SESSION["tb_usuarios_id"] = $usuario["tb_usuarios_id"];
            $_SESSION["nome"] = $usuario["nome"];
            header("Location: ../../");
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $stmt->close();
    $conn->close();
}
?>
