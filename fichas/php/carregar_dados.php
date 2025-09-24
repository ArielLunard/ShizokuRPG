<?php
include "config.php";
$conn = new mysqli($host, $user, $pass, $db);

$tipo = $_GET["tipo"] ?? "";

if ($tipo == "racas") {
  $res = $conn->query("SELECT tb_racas_id as id, raca as nome, descricao FROM tb_racas");
}
elseif ($tipo == "classes") {
  $res = $conn->query("SELECT tb_classe_id as id, classe as nome, descricao FROM tb_classe WHERE ativo = 1");
}
elseif ($tipo == "subclasses" && isset($_GET["classe"])) {
  $classeId = intval($_GET["classe"]);
  $res = $conn->query("SELECT tb_sub_classe_id as id, sub_classe as nome, descricao FROM tb_sub_classe WHERE tb_classe_id = $classeId AND ativo = 1");
}

$dados = [];
while ($row = $res->fetch_assoc()) {
  $dados[] = $row;
}

echo json_encode($dados);

