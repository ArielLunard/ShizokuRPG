function preencherListaMultipla(containerId, campoHidden, tipo) {
  fetch(`carregar_dados.php?tipo=${tipo}`)
    .then(res => res.json())
    .then(dados => {
      const container = document.getElementById(containerId);
      container.innerHTML = "";

      dados.forEach(item => {
        const div = document.createElement("div");
        div.className = "card";
        div.setAttribute("data-id", item.id);
        div.onclick = () => alternarSelecaoMultipla(div, campoHidden);

        div.innerHTML = `<h3>${item.nome}</h3><p>${item.descricao}</p>`;
        container.appendChild(div);
      });
    });
}

function alternarSelecaoMultipla(card, campoHidden) {
  card.classList.toggle("selecionado");
  const selecionados = Array.from(
    card.parentElement.querySelectorAll(".card.selecionado")
  ).map(c => c.dataset.id);
  document.querySelector(`input[name="${campoHidden}"]`).value = selecionados.join(",");
}

document.addEventListener("DOMContentLoaded", () => {
  preencherListaMultipla("equipamentos", "itens_equipamentos", "equipamentos");
  preencherListaMultipla("armaduras", "itens_armaduras", "armaduras");
  preencherListaMultipla("consumiveis", "itens_consumiveis", "consumiveis");
});