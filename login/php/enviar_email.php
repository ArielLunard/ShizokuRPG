<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido!");
    }

    // Verifica se o e-mail está cadastrado
    $stmt = $conn->prepare("SELECT tb_usuarios_id, nome FROM tb_usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $usuario_id = $usuario["tb_usuarios_id"];
        $nome = $usuario["nome"];

        // Gera um token seguro
        $token = bin2hex(random_bytes(32));
        $expiracao = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Salva o token no banco
        $stmt = $conn->prepare("INSERT INTO tb_recuperacao_senha (tb_usuario_id, token, expiracao) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $usuario_id, $token, $expiracao);
        $stmt->execute();

        // Link para o Token
        $link = "http://shizoku.com.br/login/redefinir_senha.html?token=" . $token;

        // Variaveis do email
        $assunto = 'Redefinição de senha';
        $dataHora = date("d/m/Y H:i:s", strtotime("-3 hour"));

        //Pegar IP
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Corpo do email
        $corpo = "Olá, $nome.<br>
Recebemos uma solicitação para acessar sua conta no Shizoku.<br>
Se foi você quem tentou fazer login ou redefinir sua senha, ignore esta mensagem ou siga as instruções em nosso site.<br>
Se você **não** reconhece esta tentativa, recomendamos alterar sua senha imediatamente por segurança.<br>
Data/Hora da tentativa: $dataHora<br>
IP de origem: $ip<br>
Em caso de dúvidas, entre em contato com nosso suporte equipe@shizoku.com.br.<br>
Caso contrário você pode redefinir sua senha clicando ".'<a href="'.$link.'">aqui</a>.

Equipe Shizoku!';

        // Cabeçalhos corretos para email HTML
        $headers = "From: equipe@shizoku.com.br\r\n";
        $headers .= "Reply-To: arielolunard@gmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Enviar o email
        if (mail($email,$assunto,$corpo,$headers))
            header("Location: ../login.html");
        } else {
            echo "E-mail não encontrado!";
        }
    $stmt->close();
    $conn->close();
}
?>