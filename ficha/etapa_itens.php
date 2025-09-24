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
    <div class="etapa" id="etapa-itens">
      <h2>Escolha seus Itens (Opcional)</h2>

      <h3>Equipamentos</h3>
      <div id="equipamentos" class="card-container"></div>

      <h3>Armaduras</h3>
      <div id="armaduras" class="card-container"></div>

      <h3>Consumíveis</h3>
      <div id="consumiveis" class="card-container"></div>

      <input type="hidden" name="itens_equipamentos" />
      <input type="hidden" name="itens_armaduras" />
      <input type="hidden" name="itens_consumiveis" />

      <button type="button" onclick="voltarEtapa()">Voltar</button>
      <button type="submit">Finalizar</button>
    </div>
  </form>

  <script src="script.js"></script>
</body>
</html>
