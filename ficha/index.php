
<!DOCTYPE html>
<html>
<?php include('php/carregar_info.php');?>
<?php include("../login/php/verifica_sessao.php");?>
<?php 
if (!isset($_SESSION["tb_usuarios_id"])) {
    header("Location: ../login/login.php");
    exit();
}

$tb_usuario_id = $_SESSION['tb_usuarios_id'];
if(isset($_GET['id']))  {$tb_fichas_id  = $_GET['id'];}
if(isset($tb_fichas_id)){$_SESSION['tb_fichas_id'] = $tb_fichas_id;}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

if(isset($_GET['id'])){
// Consulta os dados do usuário
$sql = "SELECT nome_personagem,nivel,cls.classe,cls.tb_classe_id,scl.sub_classe,scl.tb_sub_classe_id,han,sau,frc,pre,ref,itl,ki FROM tb_fichas fch,tb_classe cls,tb_sub_classe scl WHERE fch.tb_classe_id = cls.tb_classe_id AND fch.tb_sub_classe_id = scl.tb_sub_classe_id AND fch.tb_fichas_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $tb_fichas_id]);
$fichas = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fichas) {
    $nome_personagem  = $fichas['nome_personagem'];
    $nivel            = $fichas['nivel'];
    $classe           = $fichas['classe'];
    $tb_classe_id     = $fichas['tb_classe_id'];
    $sub_classe       = $fichas['sub_classe'];
    $tb_sub_classe_id = $fichas['tb_sub_classe_id'];
    $han              = $fichas['han'];
    $sau              = $fichas['sau'];
    $frc              = $fichas['frc'];
    $pre              = $fichas['pre'];
    $ref              = $fichas['ref'];
    $int              = $fichas['itl'];
    $ki               = $fichas['ki'];
    }

    $rank = ceil($nivel/5);
    if($rank<=0){$rank=1;}
    $pontos = 6 + $nivel;
    $pontos_disponiveis = $pontos-$sau-$frc-$pre-$ref-$int-$ki;
    $vida = ($sau+1)*5;
    $defesa = 11 + $sau + $ref;
    $hbrank1 = ceil($int/1);
    $hbrank2 = ceil($int/2); if($rank < 2){$hbrank2 = 0;} 
    $hbrank3 = ceil($int/5); if($rank < 3){$hbrank3 = 0;} 
    $hbrank4 = ceil($int/10);if($rank < 4){$hbrank4 = 0;}
}
?>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="../img/image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="../img/image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="../img/favicon.ico">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title><?= $nome_personagem?> - Shizoku</title>
    <script src="js/script.js">fichas();</script>
</head>
<body>
<div class="cont">
    <div class="cont-1 sub-cont">
        <form action="php/cadastro_ficha.php<?php if(isset($_GET['id'])){echo '?id='.$_GET['id'];} ?>" method="POST">
            <div>
                <label for="classe">Nome:</label>
                <input type="text" id="nome_personagem" value="<?php if(isset($nome_personagem)){echo $nome_personagem;}?>" name="nome_personagem" class="imput">
            </div>
            <div>
                <label for="classe">Nivel:</label>
                <input type="number" id="nivel" value="<?php if(isset($_GET['id'])){echo $nivel;}?>" name="nivel" OnKeyUp="fichas()" OnClick="fichas()" class="imput">
            </div>
            <div>
                <label for="classe">Classe:</label>
                <select id="classe" name="tb_classe_id" class="imput">
                    <?php 
                    if(isset($_GET['id'])){echo('<option value="'.$tb_classe_id.'">'.$classe.'</option>');}else{echo('<option value="null">Selecione uma classe</option>');}
                    classe($conn);
                    ?>
                </select>
            </div>
            <div>
                <label for="sub_classe">Sub classe:</label>
                <select id="sub_classe" name="tb_sub_classe_id" class="imput">
                    <?php
                    if(isset($_GET['id'])){echo('<option value="'.$tb_sub_classe_id.'">'.$sub_classe.'</option>');}else{echo('<option value="null">Selecione uma sub classe</option>');}
                    ?>
                </select>
            </div>
            <div>
                <label for="classe" title="Saúde">(SAU):</label>
                <input type="number" id="sau" name="sau" value="<?php if(isset($_GET['id'])){echo $sau;}?>" OnKeyUp="fichas()" OnClick="fichas()" class="imput">
            </div>
            <div>
                <label for="classe" title="Força">(FOR):</label>
                <input type="number" id="for" name="frc" value="<?php if(isset($_GET['id'])){echo $frc;}?>" OnKeyUp="fichas()" OnClick="fichas()" class="imput">
            </div>
            <div>
                <label for="classe" title="Precisão">(PRE):</label>
                <input type="number" id="pre" name="pre" value="<?php if(isset($_GET['id'])){echo $pre;}?>" OnKeyUp="fichas()" OnClick="fichas()" class="imput">
            </div>
            <div>
                <label for="classe" title="Reflexo">(REF):</label>
                <input type="number" id="ref" name="ref" value="<?php if(isset($_GET['id'])){echo $ref;}?>" OnKeyUp="fichas()" OnClick="fichas()" class="imput">
            </div>
            <div>
                <label for="classe" title="Inteligência">(INT):</label>
                <input type="number" id="int" name="itl" value="<?php if(isset($_GET['id'])){echo $int;}?>" OnKeyUp="fichas()" OnClick="fichas()" class="imput">
            </div>
            <div>
                <label for="classe" title="Ki">(KI):</label>
                <input type="number" id="ki" name="ki"   value="<?php if(isset($_GET['id'])){echo $ki;}?>" OnKeyUp="fichas()" OnClick="fichas()" class="imput">
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <div class="cont-2 sub-cont">
    <div id="ficha">
        <a href="../tecnicas/">Tecnicas</a>
        <div id="info_nivel"  class="Info"><?php if(isset($_GET['id'])){echo 'Nivel '.$nivel;}?></div>
        <div id="info_rank"   class="Info"><?php if(isset($_GET['id'])){echo 'Rank '.$rank;}?></div>
        <div id="info_pontos" class="Info"><?php if(isset($_GET['id'])){echo 'Pontos Disponiveis '.$pontos_disponiveis;}?></div>
        <div id="info_vida"   class="Info"><?php if(isset($_GET['id'])){echo 'Vida '.$vida;}?></div>
        <div id="info_defesa" class="Info"><?php if(isset($_GET['id'])){echo 'Defesa '.$defesa;}?></div>
        <div id="info_atkm"   class="Info"><?php if(isset($_GET['id'])){echo 'Ataque corpo a corpo +'.$frc;}?></div>
        <div id="info_atkr"   class="Info"><?php if(isset($_GET['id'])){echo 'Ataque a distancia +'.$pre;}?></div>
        <div id="info_hbrk1"  class="Info"><?php if(isset($_GET['id'])){echo 'Habilidades Rank 1 ('.$hbrank1.')';}?></div>
        <div id="info_hbrk2"  class="Info"><?php if(isset($_GET['id']) && $rank >= 2){echo 'Habilidades Rank 2 ('.$hbrank2.')';}?></div>
        <div id="info_hbrk3"  class="Info"><?php if(isset($_GET['id']) && $rank >= 3){echo 'Habilidades Rank 3 ('.$hbrank3.')';}?></div>
        <div id="info_hbrk4"  class="Info"><?php if(isset($_GET['id']) && $rank >= 4){echo 'Habilidades Rank 4 ('.$hbrank4.')';}?></div>
    </div>
    <?php if(isset($_GET['id'])){echo 'Han '.$han;}?><br>
    <a href="#" onclick="abrirIframe('php/cadastro_equipamento.php')">Cadastrar Novo Item</a>
    <iframe id="meuIframe" style="width: 100%;height: 15vh;display: block;border: none;"></iframe>
    <div id="equipamentos">
        <table>
            <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Dado</th>
                        <th>Modificador</th>
                        <th>Alcance</th>
                        <th>Tipo</th>
                        <th>Requisito</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_GET['id']))  {
                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
                    } catch (PDOException $e) {
                        die("Erro na conexão: " . $e->getMessage());
                    }

                    // Consulta os equipamentos
                    $sql = "SELECT eqp.tb_equipamento_id, eqp.nome, eqp.dado, eqp.modificador, eqp.Alcance, eqp.Tipo, eqp.Requisito, eqp.Valor FROM tb_equipamento eqp, tb_ficha_itens itm WHERE eqp.tb_equipamento_id = itm.tb_equipamento_id and itm.tb_fichas_id = ".$tb_fichas_id;
                    $stmt = $pdo->query($sql);
                    $equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($equipamentos as $equip): ?>
                <tr>
                    <td><?= htmlspecialchars($equip['nome']) ?></td>
                    <td><?= htmlspecialchars($equip['dado']) ?></td>
                    <td><?= htmlspecialchars($equip['modificador']) ?></td>
                    <td><?= htmlspecialchars($equip['Alcance']) ?></td>
                    <td><?= htmlspecialchars($equip['Tipo']) ?></td>
                    <td><?= htmlspecialchars($equip['Requisito']) ?></td>
                    <td><?= htmlspecialchars($equip['Valor']) ?></td>
                </tr>
            <?php endforeach;
            }
            ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <script src="js/script.js">
        fichas();
        
    function abrirIframe(url) {
        const iframe = document.getElementById("meuIframe");
        iframe.src = url;
        iframe.style.display = "block";
    }

    </script>
</div>
</body>
</html>