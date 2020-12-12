<?php include_once('cabecalho.php'); ?>
<script>
$(document).ready(function(){
    var empresa_id = $("#empresa_id")[0].value;

    $.ajax({
        url: "src/server-clientes-db.php",
        type: "post",
        dataType: "json",
        data: {
            empresa_id: empresa_id
        },
        success: function(result){
            Cria_Tabela(result);
        },
        error: function(er){
            console.log("ERRO:");
            console.log(er);
        }
    });

    $("#btn-busca-nome-ou-cpf").click(function(){
        var nome_ou_cpf = $("#txt-campo-nome-ou-cpf")[0].value;
        var ehCpf = (!Number.isNaN(parseInt(nome_ou_cpf)) == true) ? 1 : 0;
        
        if(nome_ou_cpf == ""){
            alert("Preencha o campo de busca!");
            return false;
        }else{
            $.ajax({
                url:"src/server-busca-colaborador-db.php",
                type: "post",
                dataType: "json",
                data: {
                    nome_ou_cpf: nome_ou_cpf,
                    ehCpf: ehCpf,
                    cargo_id: 2,
                    empresa_id: empresa_id
                },
                success: function(result){
                    Cria_Tabela(result);
                },
                error: function(er){
                    console.log("ERRO:");
                    console.log(er);
                }
            });
        }
    });
});

function Cria_Tabela(result){
    var tabela_clientes = $("#tabela-clientes")[0];
    var lista = $("#lista-clientes")[0];
    
    if(tabela_clientes != undefined){
        tabela_clientes.parentNode.removeChild(tabela_clientes);
        $("#lista-clientes")[0].style.display = "none"
    }

    var t = document.createElement("table");
    t.classList.add("table");
    t.classList.add("table-bordered");
    t.classList.add("table-light");
    t.setAttribute('id', 'tabela-clientes');
    //cabeçalho
    var thead = document.createElement("thead");
    var trhead = document.createElement("tr");
    
    var th_nome = document.createElement("th");
    th_nome.appendChild(document.createTextNode("Nome"));

    var th_cpf = document.createElement("th");
    th_cpf.appendChild(document.createTextNode("CPF"));

    var th_telefone = document.createElement("th");
    th_telefone.appendChild(document.createTextNode("Telefone"));

    var th_editar = document.createElement("th");
    th_editar.appendChild(document.createTextNode(""));
    
    var th_pets = document.createElement("th");
    th_pets.appendChild(document.createTextNode(""));

    trhead.appendChild(th_nome);
    trhead.appendChild(th_cpf);
    trhead.appendChild(th_telefone);
    trhead.appendChild(th_editar);
    trhead.appendChild(th_pets);
    thead.appendChild(trhead);
    t.appendChild(thead);
    //fim cabecalho


    var tBody = document.createElement("tbody");

        for(var i = 0; i< result.length; i++){

            //cria tr
            var tr = document.createElement("tr");
            
            //cria td
            var td_nome = document.createElement("td");
            var td_cpf = document.createElement("td");
            var td_telefone = document.createElement("td");
            var td_editar = document.createElement("td");
            var td_pets = document.createElement("td");
            

            //coloca informacao td
            td_nome.appendChild(document.createTextNode(result[i].nome));
            td_cpf.appendChild(document.createTextNode(result[i].cpf));
            td_telefone.appendChild(document.createTextNode(result[i].telefone));
            
            var link_editar = document.createElement("a");
            link_editar.classList.add("btn");
            link_editar.classList.add("btn-warning");
            link_editar.setAttribute('href', "editar-colaborador.php?pessoa_id=" + result[i].id);
            link_editar.appendChild(document.createTextNode("Editar"));
            td_editar.appendChild(link_editar);
            
            var link_pets = document.createElement("a");
            link_pets.classList.add("btn");
            link_pets.classList.add("btn-success");
            link_pets.setAttribute('href', "pets.php?cliente_id=" + result[i].id + "&tag_id=cli");
            link_pets.appendChild(document.createTextNode("Pets"));
            td_pets.appendChild(link_pets);

            tr.appendChild(td_nome);
            tr.appendChild(td_cpf);
            tr.appendChild(td_telefone);
            tr.appendChild(td_editar);
            tr.appendChild(td_pets);
            
            //incluir no tbody
            tBody.appendChild(tr);
            //incluir no table que vai dentro do bloco endereco
        }
        t.appendChild(tBody);
        $("#lista-clientes")[0].appendChild(t);
        $("#lista-clientes").fadeIn();
}

</script>

<h1>Clientes</h1>
<p>Cadastros > Clientes</p>
<input type="hidden" id="empresa_id" value="<?=$_SESSION['empresa_id']?>" />

<div class="row" style="margin: 15px">
    <input type="text" id="txt-campo-nome-ou-cpf" placeholder="Digite o nome ou CPF" class="form-control col-sm-6">
    <button id="btn-busca-nome-ou-cpf" class="btn btn-secundary col-sm-2">Buscar</button>
    <div class="col-sm-3"></div>
    <a class="btn btn-success" href="cadastrar-cliente.php">Incluir</a>
</div>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div id="lista-clientes" style="display:none; margin-top: 15px"></div>
    </div>
</div>

<?php include_once('rodape.php'); ?>