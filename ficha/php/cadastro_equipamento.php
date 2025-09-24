<?php
session_start();
include "config.php";
$tb_fichas_id = $_SESSION['tb_fichas_id'];

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tb_equipamento_id  = $_POST['tb_equipamento_id'];

    $stmt = $pdo->prepare("SELECT valor FROM tb_equipamento  WHERE tb_equipamento_id = ?");
    $stmt->execute([$tb_equipamento_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo "<p>Item inválido.</p>";
    } else {
        $valor_item = (int)$item['valor'];

        $stmt = $pdo->prepare("SELECT han FROM tb_fichas WHERE tb_fichas_id = ?");
        $stmt->execute([$tb_fichas_id]);
        $ouro = (int)$stmt->fetchColumn();

        if ($ouro < $valor_item) {
            echo "<p style='color:red'>Ouro insuficiente! Você tem {$ouro}g e o item custa {$valor_item}g.</p>";
        } else {
            $stmt = $pdo->prepare("UPDATE tb_fichas SET han = han - ? WHERE tb_fichas_id = ?");
            $stmt->execute([$valor_item, $tb_fichas_id]);

            $stmt = $pdo->prepare("INSERT INTO tb_ficha_itens (tb_fichas_id, tb_equipamento_id) VALUES (?, ?)");
            $stmt->execute([$tb_fichas_id, $tb_equipamento_id]);

            echo "<p style='color:green'>Item vinculado à ficha! {$valor_item}g descontado.</p>";
        }
    }
}

$sql = "SELECT tb_equipamento_id, nome, valor FROM tb_equipamento  ORDER BY nome";
$stmt = $pdo->query($sql);
$tb_equipamento  = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Adicionar Equipamento à Ficha</h2>

<form method="POST">
    <label>Equipamento:</label>
    <select name="tb_equipamento_id" required>
        <option value="">-- Selecione --</option>
        <?php foreach ($tb_equipamento  as $equip): ?>
            <option value="<?= $equip['tb_equipamento_id'] ?>">
                <?= htmlspecialchars($equip['nome']) ?> (<?= $equip['valor'] ?>h)
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Vincular à Ficha</button>
</form>
