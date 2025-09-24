<!DOCTYPE html>
<?php session_start();
      include('login/php/config.php');
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shizoku</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="img/image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="img/image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="img/favicon.ico">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="stylesheet" href="css/estilo.css">
</head>
    <body>
    <div id="home" class="home">
        <div class="menu">
            <div class="logo-title">
                <img class="logo" src="img/logo-transp.png">
                Shizoku
            </div>
            <div class="mn-esq-title">
                <a href="#classe">Classes</a>
                <a href="#combate">Combate</a>
                <a href="#equipamento">Equipamentos</a>
                <a href="login/login.html">Login</a>
                <?php if (isset($_SESSION["tb_usuarios_id"])) {?>
                <div class="submenu">
                        <a href="ficha/meu_perfil.php"> Perfil</a>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
    <div id="classe" class="classes"> 
        <div class="pano-animado">
            <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#7b1e1e" fill-opacity="1">
                <animate attributeName="d" dur="6s" repeatCount="indefinite"
                    values="
                    M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z;
                    M0,128 C360,64 1080,192 1440,128 L1440,320 L0,320 Z;
                    M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z
                    " />
                </path>
            </svg>
        </div>
        <div id="ninja" class="hidden ninja classes"> 
            <div class="cont-regras clas-descricao"><div class="img-desc-classe"><img src="img/desc-ninja.jpg"></div><div class="cont-texto-regra">Ninjas, focados em espionagem e combates curtos. Com tecnicas rapidas e mortais, são precisos e silenciosos com ninjutsos poderosos!</div></div>
            <div class="cont-subclass">
                <div class="subclass">
                    <span class="title">Clã Iga</span><br>
                    <span class="title">Habilidade: </span><span class="title">Dākusuteppu</span><br>
                    <span>Um dos clãs mais temidos os Iga são famosos pelos seus trabalhos de assassinatos furtivos e silenciosos são usuários de Dākusuteppu, uma técnica que permite o usuário ficar camuflado sob meia luz.</span>
                </div>
                <div class="subclass">
                    <span class="title">Clã Koga</span><br>
                    <span class="title">Habilidade: </span><span class="title">Shāpuna bijon</span><br>
                    <span>Os koga tem uma técnica que dá ao seu portador um de FTL utilizando armas de arremesso.</span>
                </div>
                <div class="subclass">
                    <span class="title">Clã Sugawara</span><br>
                    <span class="title">Habilidade: </span><span class="title">Oto</span><br>
                    <span>Conhecidos como som da morte, os Sugawara conseguem atirar 1 projétil a mais, porém a alta velocidade da arma de arremesso faz com que um leve assobio saia do projétil.</span>
                </div>
            </div>
            <div class="cont-rank">
                <p class="title">Níveis Ninja</p><br>
                <span class="title">Osa(Rank 4):</span> O mais ato dos níveis ninjas ele se compõe por líderes poderosos ou ninjas de extremo poder.(Lvl 15 mais).<br>
                <span class="title">Jounin(Rank 3):</span> Apenas com anos de treinamento e com um nível alto pode ser chamado de jounin.(Lvl 10 mais).<br>
                <span class="title">Chunin(Rank 2):</span> Compõem a maioria dos ninjas, eles são bem treinados e já conhecem bons jutsus.(Lvl 5 mais).<br>
                <span class="title">Genin(Rank 1):</span> Ninjas recém formados de baixo nível e com poucos.(Lvl 0 mais).<br>
                </div>
            </div>
            <div class="pano-animado">
            <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#7b1e1e" fill-opacity="1">
                <animate attributeName="d" dur="6s" repeatCount="indefinite"
                    values="
                    M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z;
                    M0,128 C460,64 1080,192 1840,128 L1840,0 L0,0 Z;
                    M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z
                    " />
                </path>
            </svg>
            </div>
            <div class="pano-animado">
                <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
                    <path fill="#7b1e1e" fill-opacity="1">
                    <animate attributeName="d" dur="6s" repeatCount="indefinite"
                        values="
                        M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z;
                        M0,128 C360,64 1080,192 1440,128 L1440,320 L0,320 Z;
                        M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z
                        " />
                    </path>
                </svg>
            </div>
            <div id="samurais" class="hidden samurais classes"> 
                <div class="cont-regras clas-descricao"><div class="img-desc-classe"><img src="img/desc-samurai.jpg"></div><div class="cont-texto-regra">Samurais, são guerreiros implacaveis e resilientes. Suas tecnicas conseguem lidar com grandes quantidades de oponentes ou um duelo frenetico.</div></div>
                <div class="cont-subclass">
                    <div class="subclass">
                        <span class="title">Estilo Kenjutsu</span><br>
                        <span class="title">Habilidade: </span><span class="title">Kendo</span><br>
                        <span>Kenjutsu é a arte de combate com espadas, criada pelos Samurais no Japão feudal. Graças ao seu saque rápido os usuários desta técnica tem prioridade de combate sempre tendo a iniciativa mais alta exceto se surpreso.</span>
                    </div>
                    <div class="subclass">
                        <span class="title">Estilo Iaijutsu</span><br>
                        <span class="title">Habilidade: </span><span class="title">Tameshigiri</span><br>
                        <span>Tameshigir esta técnica dá ao seu portador um de FTL utilizando Katana e Wakizashi.</span>
                    </div>
                    <div class="subclass">
                        <span class="title">Estilo Musashi</span><br>
                        <span class="title">Habilidade: </span><span class="title">Hyoho Niten</span><br>
                        <span>Hyoho Niten esta técnica dá ao seu portador a habilidade de usar dupla empunhadura mesmo sem os requisitos porém só pode utilizar uma arma média e uma leve.</span>
                    </div>
                </div>
                <div class="cont-rank">
                    <p class="title">Níveis Samurai</p><br>
                    <span class="title">Kensei(Rank 4):</span> O mais alto nível, reservado para espadachins lendários.(Lvl 15 mais).<br>
                    <span class="title">Hanshi(Rank 3):</span> Considerado referência na arte da guerra.(Lvl 10 mais).<br>
                    <span class="title">Kyoshi(Rank 2):</span> Samurai veterano.(Lvl 5 mais).<br>
                    <span class="title">Renshi(Rank 1):</span> Samurai habilidoso, mas ainda em aprendizado.(Lvl 0 mais).<br>
                </div>
            </div>
            <div class="pano-animado">
            <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#7b1e1e" fill-opacity="1">
                <animate attributeName="d" dur="6s" repeatCount="indefinite"
                    values="
                    M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z;
                    M0,128 C460,64 1080,192 1840,128 L1840,0 L0,0 Z;
                    M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z
                    " />
                </path>
            </svg>
            </div>
            <div class="pano-animado">
                <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
                    <path fill="#7b1e1e" fill-opacity="1">
                    <animate attributeName="d" dur="6s" repeatCount="indefinite"
                        values="
                        M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z;
                        M0,128 C360,64 1080,192 1440,128 L1440,320 L0,320 Z;
                        M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z
                        " />
                    </path>
                </svg>
            </div>
            <div id="samurais" class="hidden samurais classes"> 
                <div class="cont-regras clas-descricao"><div class="img-desc-classe"><img src="img/desc-monge.jpg"></div><div class="cont-texto-regra">Monges, grandes estudiosos da naturesa e do corpo. Monges são rapidos e combatentes poderosos mesmo desarmados são perigosos.</div></div>
                <div class="cont-subclass">
                    <div class="subclass">
                        <span class="title">Monastério Shaolin</span><br>
                        <span class="title">Habilidade: </span><span class="title">Kung-Fu</span><br>
                        <span>O famoso monastério Shaolin é o mais reconhecido por suas técnicas de mão limpa. Essa técnica permite ao usuário realizar um ataque desarmado sem consumir uma ação uma vez por turno(apenas se desarmado).</span>
                    </div>
                    <div class="subclass">
                        <span class="title">Monastério Lee</span><br>
                        <span class="title">Habilidade: </span><span class="title">Chakra</span><br>
                        <span>O famoso monastério Lee é o mais reconhecido por seus estudos. Esse monastério permite a seus discípulos usarem técnicas de outras classes com o dobro de custo.</span>
                    </div>
                    <div class="subclass">
                        <span class="title">Monastério Wudang</span><br>
                        <span class="title">Habilidade: </span><span class="title">Tai-Chi</span><br>
                        <span>O famoso monastério Wudang é o mais reconhecido por suas técnicas elementais. Essa técnica permite ao usuário usar metade do custo arredondado para baixo(isso não interfere nas limitações como 1 p/C).</span>
                    </div>
                </div>
                <div class="cont-rank">
                    <p class="title">Níveis Monge</p><br>
                    <span class="title">Mestre(Rank 4):</span> Após anos de dedicação e treinamento os monges conseguem extrair seu potencial total os elevando a níveis incríveis de corpo e espírito.(Lvl 15 mais).<br>
                    <span class="title">Externo(Rank 3):</span> Os monges com maior dedicação, determinação e estudo são os únicos que conseguem chegar a um nível tão alto.(Lvl 10 mais).<br>
                    <span class="title">Pupilo(Rank 2):</span> Um dedicado monge que segue a um mestre ou possui com sigo os ensinamentos de um deles.(Lvl 5 mais).<br>
                    <span class="title">Interno(Rank 1):</span> Um recém ingressado no monastério.(Lvl 0 mais).<br>
                </div>
            </div>
            <div class="pano-animado">
            <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#7b1e1e" fill-opacity="1">
                <animate attributeName="d" dur="6s" repeatCount="indefinite"
                    values="
                    M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z;
                    M0,128 C460,64 1080,192 1840,128 L1840,0 L0,0 Z;
                    M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z
                    " />
                </path>
            </svg>
            </div>
    </div>
    <div id="combate" class="combate">
        <div class="pano-animado">
            <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#7b1e1e" fill-opacity="1">
                <animate attributeName="d" dur="6s" repeatCount="indefinite"
                    values="
                    M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z;
                    M0,128 C360,64 1080,192 1440,128 L1440,320 L0,320 Z;
                    M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z
                    " />
                </path>
            </svg>
        </div>
        <div class="sub-combate">
            <div class="sub-combate-cont"> 
                <div class="sub-cont-titulo">
                    Combate
                </div>
            </div>
            <div class="sub-combate-cont"> 
                <div class="cont-regras">
                <p class="regras-descricao">Deslocamento (MVT):</p>
                    <span>O deslocamento base de cada personagem é de 3m.</span>
                </div>
            </div>
            <div class="sub-combate-cont"> 
                <div class="cont-regras"> 
                <p class="regras-descricao">Furtividade (FUR):</p>
                    <span>Em um ação na qual um jogador deseja ser furtivo ele deve rolar um D20 somar PRE e descontar as penalidades dos equipamentos enquanto estiver furtivo seus deslocamento será reduzido a 1 mts do padrão. Alguns equipamentos causam penalidades na furtividade conforme são informados na tabela.</span>
                </div>
            </div>
            <div class="sub-combate-cont"> 
                <div class="cont-regras">
                <p class="regras-descricao">Ações (ACO)</p>
                    <span>A cada turno podem ser feitas 3 ações:</span><br>
                    <span>Ação de ataque armas ou técnicas</span><br>
                    <span>Ação de movimento igual a seu deslocamento.</span><br>
                    <span>Ação para guardar itens ou pegar itens, armar uma resposta a uma ofensiva ou usar uma técnica não ofensiva.</span><br>
                    <span>Até 2 ações podem ser guardadas para ativar reações sem elas não é possível ativar uma reação se todas as ações foram usadas.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Velocidade (VEL):</p>
                    <span>Como em qualquer batalha, a velocidade é um fator muito influenciador. Para definir a ordem quando um combate começa é necessário jogar um D20 mais MOD de REF. Quando em um combate você ou um oponente tem metade ou o dobro de velocidade, o detentor da maior velocidade pode executar um ataque ou ação exclusivamente sobre o de velocidade inferior à sua metade.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Defesa (DEF):</p>
                    <span>10 + metade de REF mais SAU. Para que um golpe te acerte é necessário que o resultado do acerto seja maior ou igual a sua defesa.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Acerto (ACT):</p>
                    <span>Para acerto é definido que por padrão se rola um D20 mais MOD de acerto do ataque, com exceção de golpes em área. O resultado deve ser maior que a DEF do(s) oponente(s)  para que o ataque seja bem sucedido contra o(s) oponente(s).</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Fatalidade (FTL):</p>
                    <span>Ao rolar o acerto o crítico é reduzido em X sendo X a fatalidade do ataque, o crítico via FTL não garante acerto.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                    <p class="regras-descricao">Crítico:</p>
                    <span>No caso de um resultado 20 no dado de D20 se realiza um crítico um sucesso quase absoluto porém fica a critério do mestre e da mesa ponderar os limites de um sucesso no mundo. Em um ataque rolasse os dados e se soma os modificadores pode ser dobrado ou rola-se novamente e soma-se ao resultado anterior.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Ataque Surpresa:</p>
                    <span>Um ataque surpresa faz toda a diferença. Quando é desferido um ataque sobre um oponente distraído(e não perceber), cegado ou imobilizado é ignorada metade da DEF do atacado desde que não sofra uma das condições citadas.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Dupla empunhadura:</p>
                    <span>Quando um personagem possui 10 em PRE pode empunhar 2 armas porém são somados os requisitos das armas empunhadas.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Postura:</p>
                    <span>Quando o personagem assume uma postura ele ativa uma passiva porém se ele trocar de postura ele perde a passiva anterior e assume a nova.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Golpe bem Sucedido (GBS):</p>
                    <span>Quando um golpe causa dano a um oponente este golpe é considerado um golpe bem sucedido. Lembrando que dano não é o mesmo que golpear.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Quebrar Postura:</p>
                    <span>Um personagem quando faz um número X de GBS ele ativa a quebra de postura. A quebra de postura faz com que um personagem saia de sua postura, se ele não estiver em postura ele perde 1 ACO neste turno caso não tenha ACO perderá no próximo turno.</span>
                </div>
            </div>
            <div class="sub-combate-cont">
                <div class="cont-regras">
                <p class="regras-descricao">Amedrontado:</p>
                    <span>Oponentes amedrontados gastam um ACO a mais para realizar uma ação ofenciva contra você.</span>
                </div>
            </div>
        </div>
        <div class="pano-animado">
        <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#7b1e1e" fill-opacity="1">
            <animate attributeName="d" dur="6s" repeatCount="indefinite"
                values="
                M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z;
                M0,128 C460,64 1080,192 1840,128 L1840,0 L0,0 Z;
                M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z
                " />
            </path>
        </svg>
        </div>
    </div>
    <div id="equipamento" class="equipamento">
    <div class="pano-animado">
        <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#7b1e1e" fill-opacity="1">
            <animate attributeName="d" dur="6s" repeatCount="indefinite"
                values="
                M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z;
                M0,128 C360,64 1080,192 1440,128 L1440,320 L0,320 Z;
                M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z
                " />
            </path>
        </svg>
    </div>
    <div class="sub-equipamento">
        <div class="sub-equipamento-cont"> 
            <div class="sub-cont-titulo">
                Equipamentos
            </div>
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
                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
                    } catch (PDOException $e) {
                        die("Erro na conexão: " . $e->getMessage());
                    }

                    // Consulta os equipamentos
                    $sql = "SELECT tb_equipamento_id, nome, dado, modificador, Alcance, Tipo, Requisito, Valor FROM tb_equipamento";
                    $stmt = $pdo->query($sql);
                    $equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($equipamentos as $equip): ?>
                <tr>
                    <td><?= htmlspecialchars($equip['nome']) ?></td>
                    <td class="td-dir"><?= htmlspecialchars($equip['dado']) ?></td>
                    <td><?= htmlspecialchars($equip['modificador']) ?></td>
                    <td class="td-dir"><?= htmlspecialchars($equip['Alcance']) ?></td>
                    <td><?= htmlspecialchars($equip['Tipo']) ?></td>
                    <td class="td-dir"><?= htmlspecialchars($equip['Requisito']) ?></td>
                    <td class="td-dir">Han <?= htmlspecialchars($equip['Valor']) ?></td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pano-animado">
    <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#7b1e1e" fill-opacity="1">
        <animate attributeName="d" dur="6s" repeatCount="indefinite"
            values="
            M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z;
            M0,128 C460,64 1080,192 1840,128 L1840,0 L0,0 Z;
            M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z
            " />
        </path>
    </svg>
    </div>
    </div>
    <div id="equipamento" class="equipamento">
    <div class="pano-animado">
        <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#7b1e1e" fill-opacity="1">
            <animate attributeName="d" dur="6s" repeatCount="indefinite"
                values="
                M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z;
                M0,128 C360,64 1080,192 1440,128 L1440,320 L0,320 Z;
                M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z
                " />
            </path>
        </svg>
    </div>
    <div class="sub-equipamento">
        <div class="sub-equipamento-cont"> 
            <div class="sub-cont-titulo">
                Armaduras
            </div>
            <p>
               As penalidade são arredondados para baixo.
            </p>
            <table>
            <thead>
                    <tr>
                        <th>Nome</th>
                        <th>DEF</th>
                        <th>MOV</th>
                        <th>ACO</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
                    } catch (PDOException $e) {
                        die("Erro na conexão: " . $e->getMessage());
                    }

                    // Consulta os armaduras
                    $sql = "SELECT * FROM tb_armaduras";
                    $stmt = $pdo->query($sql);
                    $equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($equipamentos as $equip): ?>
                <tr>
                    <td><?= htmlspecialchars($equip['armadura']) ?></td>
                    <td class="td-dir"><?= htmlspecialchars($equip['bonus']) ?></td>
                    <td class="td-dir">-<?= htmlspecialchars($equip['movimento']) ?></td>
                    <td class="td-dir">-<?= htmlspecialchars($equip['acao']) ?></td>
                    <td class="td-dir">Han <?= htmlspecialchars($equip['valor']) ?></td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pano-animado">
    <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#7b1e1e" fill-opacity="1">
        <animate attributeName="d" dur="6s" repeatCount="indefinite"
            values="
            M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z;
            M0,128 C460,64 1080,192 1840,128 L1840,0 L0,0 Z;
            M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z
            " />
        </path>
    </svg>
    </div>
    </div>
    
    <div id="equipamento" class="equipamento">
    <div class="pano-animado">
        <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#7b1e1e" fill-opacity="1">
            <animate attributeName="d" dur="6s" repeatCount="indefinite"
                values="
                M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z;
                M0,128 C360,64 1080,192 1440,128 L1440,320 L0,320 Z;
                M0,96 C360,160 1080,32 1440,96 L1440,320 L0,320 Z
                " />
            </path>
        </svg>
    </div>
    <div class="sub-equipamento">
        <div class="sub-equipamento-cont"> 
            <div class="sub-cont-titulo">
                Consumiveis
            </div>
            <table>
            <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Dano</th>
                        <th>Dado</th>
                        <th>Alcance</th>
                        <th>Area</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
                    } catch (PDOException $e) {
                        die("Erro na conexão: " . $e->getMessage());
                    }

                    // Consulta os consumiveis
                    $sql = "SELECT * FROM tb_consumiveis";
                    $stmt = $pdo->query($sql);
                    $equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($equipamentos as $equip): ?>
                <tr>
                    <td><?= htmlspecialchars($equip['consumivel']) ?></td>
                    <td class="td-dir"><?= htmlspecialchars($equip['dano']) ?></td>
                    <td class="td-dir"><?= htmlspecialchars($equip['dado']) ?></td>
                    <td class="td-dir"><?= htmlspecialchars($equip['alcance']) ?>m</td>
                    <td class="td-dir"><?= htmlspecialchars($equip['area']) ?>m</td>
                    <td class="td-dir">Han <?= htmlspecialchars($equip['valor']) ?></td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pano-animado">
    <svg class="onda" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#7b1e1e" fill-opacity="1">
        <animate attributeName="d" dur="6s" repeatCount="indefinite"
            values="
            M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z;
            M0,128 C460,64 1080,192 1840,128 L1840,0 L0,0 Z;
            M0,96 C460,160 1080,32 1840,96 L1840,0 L0,0 Z
            " />
        </path>
    </svg>
    </div>
    </div>
</body>
</html>