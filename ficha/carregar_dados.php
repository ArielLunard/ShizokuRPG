<?php
include('php/config.php');
header('Content-Type: application/json');

$tipo = $_GET['tipo'] ?? '';

switch ($tipo) {
  case 'equipamentos':
    $sql = "SELECT tb_equipamento_id AS id, nome, CONCAT('Dano: ', dado, ' + ', modificador, ' | Tipo: ', Tipo, ' | Alcance: ', Alcance) AS descricao FROM tb_equipamento";
    break;
  case 'armaduras':
    $sql = "SELECT tb_armaduras_id AS id, armadura AS nome, CONCAT('Bônus: ', bonus, ' | Movimento: ', movimento, ' | Ação: ', acao) AS descricao FROM tb_armaduras";
    break;
  case 'consumiveis':
    $sql = "SELECT tb_consumiveis_id AS id, consumivel AS nome, CONCAT('Dano: ', dado, ' | Alcance: ', alcance, ' | Área: ', area) AS descricao FROM tb_consumiveis";
    break;
  default:
    echo json_encode([]);
    exit;
}

$result = $conn->query($sql);
$dados = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($dados);