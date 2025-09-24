<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $nova_senha = $_POST["nova_senha"];

    // Verifica se o token é válido e não expirou
    $stmt = $conn->prepare("SELECT tb_usuario_id FROM tb_recuperacao_senha WHERE token = ? AND expiracao > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $usuario_id = $usuario["tb_usuario_id"];

        // Hash da nova senha
        $senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);

        // Atualiza a senha no banco
        $stmt = $conn->prepare("UPDATE tb_usuarios SET senha_hash = ? WHERE tb_usuarios_id = ?");
        $stmt->bind_param("si", $senha_hash, $usuario_id);
        $stmt->execute();

        // Remove o token usado
        $stmt = $conn->prepare("DELETE FROM tb_recuperacao_senha WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        header("Location: ../login.html");
    } else {
        header("Location: ../login.html");
    }

    $stmt->close();
    $conn->close();
}
?>
