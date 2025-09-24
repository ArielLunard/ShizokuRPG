<?php
include('php/config.php');

// Após salvar a ficha e obter $ficha_id
function inserirItens($conn, $ficha_id, $campo, $coluna) {
  if (!empty($_POST[$campo])) {
    $ids = explode(",", $_POST[$campo]);
    foreach ($ids as $id) {
      $conn->query("INSERT INTO tb_ficha_itens (tb_fichas_id, {$coluna}) VALUES ($ficha_id, $id)");
    }
  }
}

$ficha_id = $_POST['ficha_id'] ?? 0;
inserirItens($conn, $ficha_id, "itens_equipamentos", "tb_equipamento_id");
inserirItens($conn, $ficha_id, "itens_armaduras", "tb_armaduras_id");
inserirItens($conn, $ficha_id, "itens_consumiveis", "tb_consumiveis_id");

echo json_encode(["status" => "ok"]);