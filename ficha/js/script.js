function fichas() {
  var nivel = parseFloat(document.getElementById("nivel").value) || 0;
  var rank = Math.ceil((nivel + 1) / 5);
  if (rank === 0) {
    rank = 1;
  }
  var pontos = 6 + nivel;
  var sau = parseFloat(document.getElementById("sau").value) || 0;
  var frc = parseFloat(document.getElementById("for").value) || 0;
  var pre = parseFloat(document.getElementById("pre").value) || 0;
  var ref = parseFloat(document.getElementById("ref").value) || 0;
  var int = parseFloat(document.getElementById("int").value) || 0;
  var ki  = parseFloat(document.getElementById("ki").value)  || 0;

  var pontos_disp = pontos - sau - frc - pre - ref - int - ki;
  if(pontos_disp < 0){
    if(pontos_disp < 0 && sau > 0){
      if(sau+pontos_disp < 0){
        sau = 0;
      }else{
        sau=sau+pontos_disp;
      }
      pontos_disp = pontos - sau - frc - pre - ref - int - ki;
      document.getElementById("sau").value = sau;
    }
    if(pontos_disp < 0 && frc > 0){
      if(frc+pontos_disp < 0){
        frc = 0;
      }else{
        frc=frc+pontos_disp;
      }
      pontos_disp = pontos - sau - frc - pre - ref - int - ki;
      document.getElementById("for").value = frc;
    }
    if(pontos_disp < 0 && pre > 0){
      if(pre+pontos_disp < 0){
        pre = 0;
      }else{
        pre=pre+pontos_disp;
      }
      pontos_disp = pontos - sau - frc - pre - ref - int - ki;
      document.getElementById("pre").value = pre;
    }
    if(pontos_disp < 0 && ref > 0){
      if(ref+pontos_disp < 0){
        ref = 0;
      }else{
        ref=ref+pontos_disp;
      }
      pontos_disp = pontos - sau - frc - pre - ref - int - ki;
      document.getElementById("ref").value = ref;
    }
    if(pontos_disp < 0 && int > 0){
      if(int+pontos_disp < 0){
        int = 0;
      }else{
        int=int+pontos_disp;
      }
      pontos_disp = pontos - sau - frc - pre - ref - int - ki;
      document.getElementById("int").value = int;
    }
    if(pontos_disp < 0 && ki > 0){
      if(ki+pontos_disp < 0){
        ki = 0;
      }else{
        ki=ki+pontos_disp;
      }
      pontos_disp = pontos - sau - frc - pre - ref - int - ki;
      document.getElementById("ki").value = ki;
    }
  }

  var vida = (sau + 1) * 5;
  var defesa = 11 + sau + ref;
  var hbrank1 = Math.ceil(int/1);
  var hbrank2 = Math.ceil(int/2);if(rank < 2){hbrank2 = 0;} 
  var hbrank3 = Math.ceil(int/5);if(rank < 3){hbrank3 = 0;} 
  var hbrank4 = Math.ceil(int/10);if(rank < 4){hbrank4 = 0;} 
  document.getElementById("info_nivel").innerText  = "Nivel " + nivel;
  document.getElementById("info_rank").innerText   = "Rank " + rank;
  document.getElementById("info_pontos").innerText = "Pontos totais " + pontos;
  document.getElementById("info_pontos").innerText = "Pontos Disponiveis " + pontos_disp;
  document.getElementById("info_vida").innerText   = "Vida " + vida;
  document.getElementById("info_defesa").innerText = "Defesa " + defesa;
  document.getElementById("info_atkm").innerText   = "Ataque corpo a corpo +" + frc;
  document.getElementById("info_atkr").innerText   = "Ataque a distancia +" + pre;

  document.getElementById("info_hbrk1").innerText  = "Habilidades Rank 1 ("+hbrank1+")";

  if(rank >= 2){
    document.getElementById("info_hbrk2").innerText = "Habilidades Rank 2 ("+hbrank2+")";
  }else{
    document.getElementById("info_hbrk2").innerText = "";
  }
  if(rank >= 3){
    document.getElementById("info_hbrk3").innerText = "Habilidades Rank 3 ("+hbrank3+")";
  }else{
    document.getElementById("info_hbrk3").innerText = "";
  }
  if(rank >= 4){
    document.getElementById("info_hbrk4").innerText = "Habilidades Rank 4 ("+hbrank4+")";
  }else{
    document.getElementById("info_hbrk4").innerText = "";
  }

}

$(document).ready(function () {
  $("#classe").change(function () {
    var tb_classe_id = $(this).val();
    $.ajax({
      url: "php/carregar_info.php",
      method: "POST",
      data: { tb_classe_id: tb_classe_id },
      success: function (response) {
        $("#sub_classe").html(response);
      },
    });
  });
});

function adicionarItem(nome, valor, itemId) {
  const ouroAtual = parseInt(document.getElementById("ouro-atual").textContent);
  if (valor > ouroAtual) {
      alert("Ouro insuficiente!");
      return;
  }

  // Atualiza ouro na tela
  document.getElementById("ouro-atual").textContent = ouroAtual - valor;

  // Adiciona item na lista visual
  const li = document.createElement("li");
  li.textContent = nome + " (" + valor + "g)";
  document.getElementById("inventario").appendChild(li);

  // Salva no banco
  fetch("processa_compra.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "item_id=" + itemId + "&valor=" + valor
  });
}

function abrirIframe(url) {
  const iframe = document.getElementById("meuIframe");
  iframe.src = url;
  iframe.style.display = "block";
}

window.addEventListener("message", function(event) {
    if (event.data === "atualizar_equipamentos") {
        atualizarEquipamentos();
    }
});

function atualizarEquipamentos() {
    fetch("equipamentos_ajax.php")
        .then(response => response.text())
        .then(html => {
            document.getElementById("div_equipamentos").innerHTML = html;
        });
}