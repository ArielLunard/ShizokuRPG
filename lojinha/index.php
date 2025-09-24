<?php
include('php/config.php');

if (!$conn) die("Erro ao conectar ao banco de dados.");

$id_ficha = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id_ficha <= 0) die("Ficha inválida.");

$queryHan = mysqli_query($conn, "SELECT han FROM tb_fichas WHERE tb_fichas_id = $id_ficha");
$ficha = mysqli_fetch_assoc($queryHan);
if (!$ficha) die("Ficha não encontrada.");
$han_atual = (int) $ficha['han'];

// Dados
function fetchItens($conn, $tabela) {
  $resultado = mysqli_query($conn, "SELECT * FROM $tabela");
  $itens = [];
  while($row = mysqli_fetch_assoc($resultado)) $itens[] = $row;
  return $itens;
}

$consumiveis = fetchItens($conn, "tb_consumiveis");
$equipamentos = fetchItens($conn, "tb_equipamento");
$armaduras = fetchItens($conn, "tb_armaduras");
?>
<!DOCTYPE html>
<html>
<?php include("../login/php/verifica_sessao.php");?>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="../img/image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="../img/image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="../img/favicon.ico">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Lojinha - Shizoku</title>
    <script src="js/script.js">fichas();</script>
</head>
<body>
<div id="lojinha">
  <h2>Loja Ninja</h2>
  <p>HAN disponível: <span id="han"><?= $han_atual ?></span></p>
  <div class="tabs">
    <button onclick="mostrarCategoria('consumiveis')">Consumíveis</button>
    <button onclick="mostrarCategoria('equipamentos')">Equipamentos</button>
    <button onclick="mostrarCategoria('armaduras')">Armaduras</button>
  </div>
  <div id="itens"></div>
  <ul id="inventario"><h4>Inventário:</h4></ul>
</div>
<script>
let han = <?= $han_atual ?>;
let inventario = [];
const idFicha = <?= $id_ficha ?>;
const itens = {
  consumiveis: <?= json_encode($consumiveis) ?>,
  equipamentos: <?= json_encode($equipamentos) ?>,
  armaduras: <?= json_encode($armaduras) ?>
};
function mostrarCategoria(cat) {
  const container = document.getElementById("itens");
  container.innerHTML = "";
  itens[cat].forEach(item => {
    const div = document.createElement("div");
    div.className = "item";
    let nome = item.consumivel || item.nome || item.armadura || 'Item';
    let valor = item.valor || item.Valor || 0;
    let idItem = item.tb_consumiveis_id || item.tb_equipamento_id || item.tb_armaduras_id;
    let tipo = cat.slice(0, -1); // 'consumivel', 'equipamento', 'armadura'
    let descricao = "";
    for (let chave in item) {
      if (['valor', 'Valor', 'nome', 'consumivel', 'armadura'].includes(chave)) continue;
      if (chave.includes('_id')) continue;
      valor = valor.charAt(0).toUpperCase() + valor.slice(1);
      descricao += `<strong>${chave}:</strong> ${item[chave]}<br>`;
    }
    div.innerHTML = `
      <h3>${nome}</h3>
      <p>${descricao}</p>
      <p><strong>Valor: ${valor} HAN</strong></p>
      <button onclick="comprarItem('${nome}', ${valor}, '${tipo}', ${idItem})">Comprar</button>
    `;
    container.appendChild(div);
  });
}
function comprarItem(nome, custo, tipo_item, id_item) {
  if (han < custo) return alert("HAN insuficiente!");
  fetch("comprar_item.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `id_ficha=${idFicha}&id_item=${id_item}&tipo_item=${tipo_item}&custo=${custo}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.sucesso) {
      han = data.novo_han;
      document.getElementById("han").textContent = han;
      inventario.push(nome);
      atualizarInventario();
      alert(`${nome} comprado com sucesso!`);
    } else {
      alert("Erro: " + (data.erro || "Falha desconhecida."));
    }
  })
  .catch(() => alert("Erro ao processar compra."));
}
function atualizarInventario() {
  const inv = document.getElementById("inventario");
  inv.innerHTML = "<h4>Inventário:</h4>";
  inventario.forEach(item => {
    const li = document.createElement("li");
    li.textContent = item;
    inv.appendChild(li);
  });
}
mostrarCategoria('consumiveis');
</script>
</body>
</html>