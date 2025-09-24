<?php
session_start();
$tb_fichas_id = $_SESSION['tb_fichas_id'];
$tb_equipamento_id = $_POST['tb_equipamento_id'];
$valor = $_POST['valor'];

$pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "usuario", "senha");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT han FROM tb_fichas WHERE tb_fichas_id = ?");
$stmt->execute([$tb_fichas_id]);
$ouro = $stmt->fetchColumn();

if ($ouro >= $valor) {
    $stmt = $pdo->prepare("UPDATE tb_fichas SET han = han - ? WHERE tb_fichas_id = ?");
    $stmt->execute([$valor, $tb_fichas_id]);

    $stmt = $pdo->prepare("INSERT INTO tb_ficha_itens(tb_ficha_itens_id, tb_fichas_id, tb_equipamento_id, tb_armaduras_id, tb_consumiveis_id, quantidade) VALUES (?, ?)");
    $stmt->execute([$tb_fichas_id, $tb_equipamento_id]);

    echo "Compra realizada.";
} else {
    http_response_code(400);
    echo "Ouro insuficiente.";
}
?>