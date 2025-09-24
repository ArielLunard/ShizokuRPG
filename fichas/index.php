<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="img/image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="img/image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="../img/favicon.ico">
    <link rel="manifest" href="img/site.webmanifest">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Novo Personagem - Shizoku</title>
    <link rel="stylesheet" href="css/estilos.css" />
</head>
<?php 
session_start();
if (!isset($_SESSION["tb_usuarios_id"])) {
    header("Location: ../login/login.php");
    exit();
}

$tb_usuario_id = $_SESSION['tb_usuarios_id'];
?>
<body>
  <h1>Novo Personagem</h1>
  <form id="form-ficha">
    
    <!-- Etapa 1 -->
    <div class="etapa active" id="etapa-1">
      <h2>Nome e Nível</h2>
      <input type="text" name="nome_personagem" placeholder="Nome do personagem" required />
      <input type="number" name="nivel" placeholder="Nível" min="1" max="20" required />
      <button type="button" onclick="proximaEtapa()">Próximo</button>
    </div>

    <!-- Etapa 2 -->
    <div class="etapa" id="etapa-2">
      <h2>Raça</h2>
      <div class="card-opcoes" id="racas"></div>
      <input type="hidden" name="tb_racas_id" required />
      <button type="button" onclick="voltarEtapa()">Voltar</button>
      <button type="button" onclick="proximaEtapa()">Próximo</button>
    </div>

    <!-- Etapa 3 -->
    <div class="etapa" id="etapa-3">
    <h2>Classe</h2>
    <div class="card-opcoes" id="classes"></div>
    <input type="hidden" name="tb_classe_id" required />
    <button type="button" onclick="voltarEtapa()">Voltar</button>
    <button type="button" onclick="carregarSubclassesEIr()">Próximo</button>
    </div>

    <!-- Etapa 4 -->
    <div class="etapa" id="etapa-4">
    <h2>Subclasse</h2>
    <div class="card-opcoes" id="subclasses"></div>
    <input type="hidden" name="tb_sub_classe_id" required />
    <button type="button" onclick="voltarEtapa()">Voltar</button>
    <button type="submit">Finalizar</button>
    </div>

  </form>

  <script src="js/script.js"></script>
</body>
</html>
