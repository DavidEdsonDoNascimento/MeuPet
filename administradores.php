<?php 
    include_once('cabecalho.php'); 
    require_once('./src/DAO/banco.php');
?>

<script>

$(document).ready(function(){
    var empresa_id = $("#empresa_id")[0].value;

    $.ajax({
        url: "src/server-administradores-db.php",
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
                    cargo_id: 1,
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
    var tabelaadministradores = $("#tabela-administradores")[0];
            var lista = $("#lista-administradores")[0];
            
            if(tabelaadministradores != undefined){
                tabelaadministradores.parentNode.removeChild(tabelaadministradores);
                $("#lista-administradores")[0].style.display = "none"
            }

            var t = document.createElement("table");
            t.classList.add("table");
            t.classList.add("table-bordered");
            t.classList.add("table-light");
            t.setAttribute('id', 'tabela-administradores');
            //cabeçalho
            var thead = document.createElement("thead");
            var trhead = document.createElement("tr");
            
            var th_nome = document.createElement("th");
            th_nome.appendChild(document.createTextNode("Nome"));

            var th_cpf = document.createElement("th");
            th_cpf.appendChild(document.createTextNode("CPF"));

            var th_telefone = document.createElement("th");
            th_telefone.appendChild(document.createTextNode("Telefone"));

            var th_cargo = document.createElement("th");
            th_cargo.appendChild(document.createTextNode("Cargo"));

            var th_editar = document.createElement("th");
            th_editar.appendChild(document.createTextNode(""));

            trhead.appendChild(th_nome);
            trhead.appendChild(th_cpf);
            trhead.appendChild(th_telefone);
            trhead.appendChild(th_cargo);
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
                    var td_cpf = document.createElement("td");
                    var td_telefone = document.createElement("td");
                    var td_cargo = document.createElement("td");
                    var td_editar = document.createElement("td");
                    

                    //coloca informacao td
                    td_nome.appendChild(document.createTextNode(result[i].nome));
                    td_cpf.appendChild(document.createTextNode(result[i].cpf));
                    td_telefone.appendChild(document.createTextNode(result[i].telefone));
                    td_cargo.appendChild(document.createTextNode(result[i].cargo));
                    
                    var link_editar = document.createElement("a");
                    link_editar.classList.add("btn");
                    link_editar.classList.add("btn-warning");
                    link_editar.setAttribute('href', "editar-colaborador.php?pessoa_id=" + result[i].id);
                    link_editar.appendChild(document.createTextNode("Editar"));
                    td_editar.appendChild(link_editar);
                    
                    tr.appendChild(td_nome);
                    tr.appendChild(td_cpf);
                    tr.appendChild(td_telefone);
                    tr.appendChild(td_cargo);
                    tr.appendChild(td_editar);
                    
                    //incluir no tbody
                    tBody.appendChild(tr);
                    //incluir no table que vai dentro do bloco endereco
                }
                t.appendChild(tBody);
                $("#lista-administradores")[0].appendChild(t);
                $("#lista-administradores").fadeIn();
}

</script>

<h1>Administradores</h1>
<p>Cadastros > Administradores</p>
<input type="hidden" id="empresa_id" value="<?=$_SESSION['empresa_id']?>" />

<div class="row" style="margin: 15px">
    <input type="text" id="txt-campo-nome-ou-cpf" placeholder="Digite o nome ou CPF" class="form-control col-sm-6">
    <button id="btn-busca-nome-ou-cpf" class="btn btn-secundary col-sm-2">Buscar</button>
    <div class="col-sm-3"></div>
    <a class="btn btn-success" href="cadastrar-administrador.php">Incluir</a>
</div>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div id="lista-administradores" style="display:none; margin-top: 15px"></div>
    </div>
</div>
<?php include_once('rodape.php'); ?>