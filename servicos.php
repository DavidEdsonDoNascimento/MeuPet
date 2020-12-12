<?php include_once('cabecalho.php'); ?>
<script>
$(document).ready(function(){
    $.ajax({
        url: "src/server-servicos-db.php",
        type: "post",
        dataType: "json",
        success: function(result){
            Cria_Tabela(result);
        },
        error: function(er){
            console.log("ERRO:");
            console.log(er);
        }
    });
});

function Cria_Tabela(result){
    var tabela_servicos = $("#tabela-servicos")[0];
    var lista = $("#lista-servicos")[0];
    
    if(tabela_servicos != undefined){
        tabela_servicos.parentNode.removeChild(tabela_servicos);
        $("#lista-servicos")[0].style.display = "none"
    }

    var t = document.createElement("table");
    t.classList.add("table");
    t.classList.add("table-bordered");
    t.classList.add("table-light");
    t.setAttribute('id', 'tabela-servicos');
    //cabeçalho
    var thead = document.createElement("thead");
    var trhead = document.createElement("tr");
    
    var th_nome = document.createElement("th");
    th_nome.appendChild(document.createTextNode("Nome"));

    var th_descricao = document.createElement("th");
    th_descricao.appendChild(document.createTextNode("Descricao"));

    var th_editar = document.createElement("th");
    th_editar.appendChild(document.createTextNode(""));

    trhead.appendChild(th_nome);
    trhead.appendChild(th_descricao);
    trhead.appendChild(th_editar);
    thead.appendChild(trhead);
    t.appendChild(thead);
    //fim cabecalho


    var tBody = document.createElement("tbody");

        for(var i = 0; i< result.length; i++){

            //cria tr
            var tr = document.createElement("tr");
            
            //cria td
            var td_nome = document.createElement("td");
            var td_descricao = document.createElement("td");
            var td_editar = document.createElement("td");
            

            //coloca informacao td
            td_nome.appendChild(document.createTextNode(result[i].nome));
            td_descricao.appendChild(document.createTextNode(result[i].descricao));
            
            var link_editar = document.createElement("a");
            link_editar.classList.add("btn");
            link_editar.classList.add("btn-warning");
            link_editar.setAttribute('href', "editar-servicos.php?servico_id=" + result[i].id);
            link_editar.appendChild(document.createTextNode("Editar"));
            td_editar.appendChild(link_editar);
            
            tr.appendChild(td_nome);
            tr.appendChild(td_descricao);
            tr.appendChild(td_editar);
            
            //incluir no tbody
            tBody.appendChild(tr);
            //incluir no table que vai dentro do bloco endereco
        }
        t.appendChild(tBody);
        $("#lista-servicos")[0].appendChild(t);
        $("#lista-servicos").fadeIn();
}

</script>
    <h1>Serviços</h1>
    <p>Cadastros > Serviços</p>
<div class="row" style="margin: 15px">
    <a class="btn btn-success" href="cadastrar-servico.php">Incluir</a>
</div>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div id="lista-servicos" style="display:none; margin-top: 15px"></div>
    </div>
</div>

<?php include_once('rodape.php'); ?>