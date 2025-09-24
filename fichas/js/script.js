let etapaAtual = 0;
const etapas = document.querySelectorAll(".etapa");

function mostrarEtapa(n) {
  etapas.forEach(etapa => etapa.classList.remove("active"));
  etapas[n].classList.add("active");
  etapaAtual = n;
}

function proximaEtapa() {
  if (etapaAtual < etapas.length - 1) mostrarEtapa(etapaAtual + 1);
}

function voltarEtapa() {
  if (etapaAtual > 0) mostrarEtapa(etapaAtual - 1);
}

function preencherCards(containerId, campoHidden, tipo, filtroId = null) {
  let url = `php/carregar_dados.php?tipo=${tipo}`;
  if (filtroId) url += `&classe=${filtroId}`;

  fetch(url)
    .then(res => res.json())
    .then(dados => {
      const container = document.getElementById(containerId);
      container.innerHTML = "";

      dados.forEach(item => {
        const div = document.createElement("div");
        div.className = "card";
        div.setAttribute("data-id", item.id);
        div.onclick = () => selecionarOpcao(div, campoHidden);

        div.innerHTML = `<h3>${item.nome}</h3><p class="descricao">${item.descricao}</p>`;
        container.appendChild(div);
      });
    });
}

function selecionarOpcao(elemento, campoHidden) {
  const cards = elemento.parentElement.querySelectorAll(".card");
  cards.forEach(card => card.classList.remove("selecionado"));
  elemento.classList.add("selecionado");
  document.querySelector(`input[name="${campoHidden}"]`).value = elemento.dataset.id;
}

document.addEventListener("DOMContentLoaded", () => {
  preencherCards("racas", "tb_racas_id", "racas");
  preencherCards("classes", "tb_classe_id", "classes");
});

function carregarSubclassesEIr() {
  const classeId = document.querySelector('input[name="tb_classe_id"]').value;
  if (!classeId) {
    alert("Escolha uma classe antes.");
    return;
  }

  preencherCards("subclasses", "tb_sub_classe_id", "subclasses", classeId);
  proximaEtapa();
}

document.getElementById("form-ficha").addEventListener("submit", async e => {
  e.preventDefault();
  const formData = new FormData(e.target);
  const response = await fetch("php/salvar_ficha.php", {
    method: "POST",
    body: formData
  }).then(response => response.text())
  .then(data => {
    if (data.includes("sucesso")) {
      alert("Ficha cadastrada com sucesso!");
      setTimeout(() => {
        window.location.href = "https://shizoku.com.br/ficha/meu_perfil.php";
      }, 1000);
    } else {
      alert("Erro ao cadastrar ficha: " + data);
    }
  })
  .catch(error => {
    alert("Erro inesperado: " + error);
  });
});
