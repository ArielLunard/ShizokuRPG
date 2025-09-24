<?php
session_start();
include "config.php";

if (!isset($_SESSION["tb_usuarios_id"])) {
    die("Você precisa estar logado.");
}
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$rank = ceil($_POST['nivel']/5);
if($rank<=0){$rank=1;}
$han = $rank*300;
// Recebe os dados do formulário
$tb_usuario_id    = $_SESSION["tb_usuarios_id"];
$nome_personagem  = $_POST['nome_personagem'];
$nivel            = $_POST['nivel'];
$tb_classe_id     = $_POST['tb_classe_id'];
$tb_sub_classe_id = $_POST['tb_sub_classe_id'];
$sau              = $_POST['sau'];
$frc              = $_POST['frc'];
$pre              = $_POST['pre'];
$ref              = $_POST['ref'];
$itl              = $_POST['itl'];
$ki               = $_POST['ki'];

if (isset($_GET['id'])) {
    // Atualização
    $id               = $_GET['id'];
    $sql = "UPDATE tb_fichas SET 
                   nome_personagem  = '$nome_personagem',
                   nivel            = $nivel,
                   sau              = $sau,
                   frc              = $frc,
                   pre              = $pre,
                   ref              = $ref,
                   itl              = $itl,
                   ki               = $ki
             WHERE tb_fichas_id = $id";

    $dados['id'] = $_GET['id']; // adiciona o ID à lista de dados
} else {
    // Inserção
    $sql = "INSERT INTO tb_fichas (
        tb_usuario_id, nome_personagem, nivel, tb_classe_id, tb_sub_classe_id, sau, frc, pre, ref, itl, ki, han
    ) VALUES (
        $tb_usuario_id, '$nome_personagem', $nivel, $tb_classe_id, $tb_sub_classe_id, $sau, $frc, $pre, $ref, $itl, $ki, $han
    )";
}
echo "<pre>";
print_r($dados);
echo "</pre>";
echo $sql;
// Executa com bind automático
$stmt = $pdo->prepare($sql);
if ($pdo->query($sql)) {
    header("Location: ../meu_perfil.php");
} else {
    echo "Erro ao cadastrar ficha.";
}

?>