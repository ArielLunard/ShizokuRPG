<?php
include('config.php');

if (!$conn) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro de conexão com o banco."]);
    exit;
}

$id_ficha = isset($_POST['id_ficha']) ? (int) $_POST['id_ficha'] : 0;
$id_item = isset($_POST['id_item']) ? (int) $_POST['id_item'] : 0;
$tipo_item = $_POST['tipo_item'] ?? '';
$custo = isset($_POST['custo']) ? (int) $_POST['custo'] : 0;

$tipos_validos = ['consumivel', 'equipamento', 'armadura'];
if ($id_ficha <= 0 || $id_item <= 0 || !in_array($tipo_item, $tipos_validos) || $custo <= 0) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados inválidos."]);
    exit;
}

$resFicha = mysqli_query($conn, "SELECT han FROM tb_fichas WHERE id = $id_ficha");
$ficha = mysqli_fetch_assoc($resFicha);
if (!$ficha) {
    http_response_code(404);
    echo json_encode(["erro" => "Ficha não encontrada."]);
    exit;
}

$han_atual = (int) $ficha['han'];
if ($han_atual < $custo) {
    http_response_code(403);
    echo json_encode(["erro" => "HAN insuficiente."]);
    exit;
}

$novo_han = $han_atual - $custo;
mysqli_query($conn, "UPDATE tb_fichas SET han = $novo_han WHERE id = $id_ficha");

$coluna_id = "tb_{$tipo_item}s_id";
$sql_check = "SELECT * FROM tb_ficha_itens WHERE tb_fichas_id = $id_ficha AND $coluna_id = $id_item";
$res_check = mysqli_query($conn, $sql_check);

if ($row = mysqli_fetch_assoc($res_check)) {
    $id_registro = $row['tb_ficha_itens_id'];
    mysqli_query($conn, "UPDATE tb_ficha_itens SET quantidade = quantidade + 1 WHERE tb_ficha_itens_id = $id_registro");
} else {
    $colunas = "tb_fichas_id, $coluna_id, quantidade";
    $valores = "$id_ficha, $id_item, 1";
    mysqli_query($conn, "INSERT INTO tb_ficha_itens ($colunas) VALUES ($valores)");
}

echo json_encode(["sucesso" => true, "novo_han" => $novo_han]);
?>