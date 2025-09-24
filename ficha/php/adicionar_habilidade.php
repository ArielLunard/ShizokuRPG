<?php
session_start();
include "config.php";
$tb_fichas_id = $_SESSION['tb_fichas_id'];

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $habilidade_id = $_POST['habilidade_id'];

    $stmt = $pdo->prepare("SELECT custo FROM habilidades WHERE id = ?");
    $stmt->execute([$habilidade_id]);
    $habilidade = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT ouro FROM fichas WHERE id = ?");
    $stmt->execute([$ficha_id]);
    $ouro = $stmt->fetchColumn();

    if (!$habilidade) {
        echo "<p>Habilidade inválida.</p>";
    } elseif ($ouro < $habilidade['custo']) {
        echo "<p style='color:red'>Ouro insuficiente para aprender essa habilidade.</p>";
    } else {
        $stmt = $pdo->prepare("UPDATE fichas SET ouro = ouro - ? WHERE id = ?");
        $stmt->execute([$habilidade['custo'], $ficha_id]);

        $stmt = $pdo->prepare("INSERT INTO ficha_habilidades (ficha_id, habilidade_id) VALUES (?, ?)");
        $stmt->execute([$ficha_id, $habilidade_id]);

        echo "<p style='color:green'>Habilidade aprendida com sucesso!</p>";

        echo "<script>parent.postMessage('atualizar_habilidades', '*');</script>";
    }
}

$stmt = $pdo->prepare("
    SELECT h.id, h.nome, h.descricao, h.custo
    FROM habilidades h
    WHERE h.id NOT IN (
        SELECT habilidade_id FROM ficha_habilidades WHERE ficha_id = ?
    )
");
$stmt->execute([$ficha_id]);
$habilidades = $stmt->fetchAll();
?>

<h2>Aprender Habilidade</h2>
<form method="POST">
    <label>Habilidade:</label>
    <select name="habilidade_id" required>
        <option value="">-- Selecione --</option>
        <?php foreach ($habilidades as $h): ?>
            <option value="<?= $h['id'] ?>">
                <?= htmlspecialchars($h['nome']) ?> (<?= $h['custo'] ?>g)
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <button type="submit">Aprender</button>
</form>
