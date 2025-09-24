<?php
include "config.php";
$conn = new mysqli($host, $user, $pass, $db);

session_start();
$tb_usuario_id = $_SESSION['tb_usuarios_id'];

$nivel = intval($_POST['nivel']);
$rank = ceil($nivel / 5);
if ($rank <= 0) {
  $rank = 1;
}
$han = $rank * 300;

// Query com parâmetros
$stmt = $conn->prepare("
  INSERT INTO tb_fichas (
    nome_personagem, nivel, tb_racas_id, tb_classe_id, tb_sub_classe_id,
    sau, frc, pre, ref, itl, ki, han, tb_usuario_id
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

// Atributos padrões (por enquanto)
$sau = $frc = $pre = $ref = $itl = $ki = 0;

// bind_param precisa dos tipos corretos: s (string), i (int), d (double)
$stmt->bind_param(
  "siiiiiiiiiiii", // 1 string + 12 inteiros
  $_POST["nome_personagem"],
  $nivel,
  $_POST["tb_racas_id"],
  $_POST["tb_classe_id"],
  $_POST["tb_sub_classe_id"],
  $sau,
  $frc,
  $pre,
  $ref,
  $itl,
  $ki,
  $han,
  $tb_usuario_id
);

if ($stmt->execute()) {
  echo "Ficha cadastrada com sucesso!";
} else {
  echo "Erro ao salvar ficha: " . $stmt->error;
}
?>
