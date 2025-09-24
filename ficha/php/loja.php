<?php
// Conexão com o banco
$pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "usuario", "senha");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Consulta os itens cadastrados
$sql = "SELECT tb_equipamento_id, nome, valor FROM equipamentos";
$stmt = $pdo->query($sql);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h3>Loja de Equipamentos</h3>
<ul>
    <?php foreach ($itens as $item): ?>
        <li>
            <button onclick="comprar(<?= $item['tb_equipamento_id'] ?>, '<?= addslashes($item['nome']) ?>', <?= $item['valor'] ?>)">
                Comprar <?= $item['nome'] ?> - <?= $item['valor'] ?>g
            </button>
        </li>
    <?php endforeach; ?>
</ul>

<script>
    function comprar(id, nome, valor) {
        parent.adicionarItem(nome, valor, id);
    }
</script>
