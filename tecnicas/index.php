<?php
include('php/config.php');
// Filtros
$classe = isset($_GET['classe']) ? $_GET['classe'] : '';
$rank = isset($_GET['rank']) ? $_GET['rank'] : '';
$elemento = isset($_GET['elemento']) ? $_GET['elemento'] : '';

$classes = $conn->query("SELECT DISTINCT classe FROM tb_tecnicas ORDER BY classe");
$ranks = $conn->query("SELECT DISTINCT rank FROM tb_tecnicas ORDER BY rank");
$elementos = $conn->query("SELECT DISTINCT Elemento FROM tb_tecnicas ORDER BY Elemento");

// Query SQL com filtros
$sql = "SELECT `tecnica`, `tipo`, `requisito`, `rank`, `custo`, `perceptivel`, `Elemento`, `alcance`, `classe`, `descricao` FROM `tb_tecnicas` WHERE 1 = 1";
if (!empty($classe)) {
    $sql .= " AND classe = '" . $conn->real_escape_string($classe) . "'";
}
if (!empty($rank)) {
    $sql .= " AND rank = '" . $conn->real_escape_string($rank) . "'";
}
if (!empty($elemento)) {
    $sql .= " AND Elemento = '" . $conn->real_escape_string($elemento) . "'";
}

$result = $conn->query($sql);
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="img/image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="img/image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="../img/favicon.ico">
    <link rel="manifest" href="img/site.webmanifest">
    <title>Relatório de Técnicas</title>
    <link rel="stylesheet" href="css/estilo.css">
<style>

</style>
</head>
<body>
<div class="header">
<form method='GET' class='filters'>
        <label>Classe:</label>
        <select name='classe'>
            <option value=''>Todas</option>
            <?php while ($row = $classes->fetch_assoc()) {
                        $selected = ($classe == $row['classe']) ? "selected" : "";
                        echo "<option value='{$row['classe']}' $selected>{$row['classe']}</option>";
                    }
            ?>
        </select>
        <label>Rank:</label>
        <select name='rank'>
            <option value=''>Todos</option>
            <?php while ($row = $ranks->fetch_assoc()) {
                $selected = ($rank == $row['rank']) ? "selected" : "";
                echo "<option value='{$row['rank']}' $selected>{$row['rank']}</option>";
            }
            ?>
        </select>
        <label>Elemento:</label>
        <select name='elemento'>
            <option value=''>Todos</option>
            <?php while ($row = $elementos->fetch_assoc()) {
                    $selected = ($elemento == $row['Elemento']) ? "selected" : "";
                    echo "<option value='{$row['Elemento']}' $selected>{$row['Elemento']}</option>";
                }
            ?>
        </select>
    <input type='submit' value='Filtrar'>
</form>
</div>
<div class="tecnicas">
    <?php
    // Exibir os dados
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    
        if($row['Elemento'] == 'Água'){
            $class = 'agua';
        }
        if($row['Elemento'] == 'Fogo'){
            $class = 'fogo';
        }
        if($row['Elemento'] == 'Terra'){
            $class = 'terra';
        }
        if($row['Elemento'] == 'Raio'){
            $class = 'raio';
        }
        if($row['Elemento'] == 'Vento'){
            $class = 'vento';
        }
        if($row['Elemento'] == 'Vida'){
            $class = 'vida';
        }
        if($row['Elemento'] == 'Neutro'){
            $class = 'neutro';
        }
        if($class == ''){
            $class = 'multi';
        }
        
    ?>
        <div class="grid">
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1.25rem;">Rank <?=$row['rank']?>: <?=$row['tecnica']?></h3>
                <span class="subtitulo">Classe: <?=$row['classe']?></span>
                <span class="subtitulo">Alcance: <?=$row['alcance']?>m</span>
                <span class="<?=$class?>"><?=$row['Elemento']?></span>
            </div>
            <p class="text-muted"><?=$row['descricao']?></p>
            <div style="margin-top: 8px; display: flex; justify-content: space-between;" class="text-muted">
                <span>Custo:       <?=$row['custo']?></span>
                <span>Tipo:        <?=$row['tipo']?></span>
                <span>Requisito:   <?=$row['requisito']?></span>
                <span>Perceptível: <?=$row['perceptivel']?></span>
            </div>
        </div>
        </div>
    <?php
    $class = '';
    }
    } else {
        echo "<tr><td colspan='11'>Nenhuma técnica encontrada.</td></tr>";
    }
    ?>
        </div>
    </body>
</html>
<?php
// Fechar conexão
$conn->close();
?>