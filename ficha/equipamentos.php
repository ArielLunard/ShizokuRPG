
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="img/image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="img/image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="../img/favicon.ico">
    <link rel="manifest" href="img/site.webmanifest">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Ficha</title>
    <script src="js/script.js"></script>
</head>
<?php include('php/carregar_info.php');?>
<?php include("../login/php/verifica_sessao.php");?>
<body>
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
                    <td><?= htmlspecialchars($equip['dado']) ?></td>
                    <td><?= htmlspecialchars($equip['modificador']) ?></td>
                    <td><?= htmlspecialchars($equip['Alcance']) ?></td>
                    <td><?= htmlspecialchars($equip['Tipo']) ?></td>
                    <td><?= htmlspecialchars($equip['Requisito']) ?></td>
                    <td><?= htmlspecialchars($equip['Valor']) ?></td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
            </div>
    </div>
</body>
</html>