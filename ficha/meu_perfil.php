<?php
include('php/config.php');
session_start();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$sql = "SELECT tb_fichas_id,nome_personagem,nivel,cls.classe,scl.sub_classe,han FROM tb_fichas fch,tb_classe cls,tb_sub_classe scl WHERE fch.tb_classe_id = cls.tb_classe_id AND fch.tb_sub_classe_id = scl.tb_sub_classe_id AND fch.tb_usuario_id = ".$_SESSION["tb_usuarios_id"];
$stmt = $pdo->query($sql);
$fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="img/image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="img/image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="../img/favicon.ico">
    <link rel="manifest" href="img/site.webmanifest">
    <title>Meu perfil - Shizoku</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="pergaminho">
    <h2>Minhas Fichas</h2>
<?php
    if (!isset($_SESSION["tb_usuarios_id"])) {
        header("Location: ../login/login.php");
        exit();
    }
    
    $tb_usuario_id = $_SESSION['tb_usuarios_id'];
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
    
    // Consulta os dados do usuário
    $sql = "SELECT tb_usuarios_id, nome, email FROM tb_usuarios WHERE tb_usuarios_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $tb_usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        echo "Nome: " . $usuario['nome'] . "<br>";
        echo "Email: " . $usuario['email'] . "<br>";
    } else {
        echo "Usuário não encontrado.";
    }
?>
    <a class="criar" href="../fichas/index.php"> Criar Personagem.</a>
  </div>
    <div class="fichas">
    <?php foreach ($fichas as $ficha): ?>
    <a href="index.php?id=<?= htmlspecialchars($ficha['tb_fichas_id']) ?>">
        <div class="personagem">
            <div class="cont-img"><div class="img-bck" style="background: url(../img/desc-<?=htmlspecialchars(strtolower($ficha['classe']))?>.jpg) no-repeat;"><img class="img-class" src="../img/desc-<?=htmlspecialchars(strtolower($ficha['classe']))?>.jpg"></div></div>
            <div><?= htmlspecialchars($ficha['nome_personagem']) ?></div>
            <div><?= htmlspecialchars($ficha['classe']) ?> <?= htmlspecialchars($ficha['nivel']) ?></div>
            <div><?= htmlspecialchars($ficha['sub_classe']) ?></div>
            <div>Han <?= htmlspecialchars($ficha['han']) ?></div>
        </div>
    </a>
    <?php endforeach; ?>
    </div>
</body>
</html>