<?php 
    include_once('cabecalho.php');
    require_once('./src/DAO/banco.php');
    
    $pessoa_id = $_GET['pessoa_id'];


    $sql = 'select p.*,  
    (select nome from cargo as c where c.id = p.cargo_id) as cargo
    from pessoa as p 
    where id = :pessoa_id';


    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);    
    
    $q->bindValue(":pessoa_id", $pessoa_id);
    
    $result = $q->execute();

    $q->execute();
    $row = $q->fetch(PDO::FETCH_ASSOC);

?>
<script>
$(document).ready(function(){
    $("#atualiza-listagem-enderecos").click(function(){
        pessoa_id = $("#pessoa_id")[0].value;
        $.ajax({
            url: "src/server-lista-enderecos-db.php",
            type: "post",
            data: { 
                pessoa_id: pessoa_id
            },
            dataType: "json",
            success: function(result){
                console.log(result);
                var tabelaenderecos = $("#tabela-enderecos")[0];
                var lista = $("#lista-enderecos")[0];
                
                if(tabelaenderecos != undefined){
                    tabelaenderecos.parentNode.removeChild(tabelaenderecos);
                    $("#lista-enderecos")[0].style.display = "none"
                }

                var t = document.createElement("table");
                t.classList.add("table");
                t.classList.add("table-bordered");
                t.classList.add("table-light");
                t.setAttribute('id', 'tabela-enderecos');
                //cabeçalho
                var thead = document.createElement("thead");
                var trhead = document.createElement("tr");
                
                var th_rua = document.createElement("th");
                th_rua.appendChild(document.createTextNode("Rua"));

                var th_numero = document.createElement("th");
                th_numero.appendChild(document.createTextNode("Número"));

                var th_complemento = document.createElement("th");
                th_complemento.appendChild(document.createTextNode("Complemento"));

                var th_bairro = document.createElement("th");
                th_bairro.appendChild(document.createTextNode("Bairro"));

                var th_cep = document.createElement("th");
                th_cep.appendChild(document.createTextNode("CEP"));

                var th_cidade = document.createElement("th");
                th_cidade.appendChild(document.createTextNode("Cidade"));

                var th_editar = document.createElement("th");
                th_editar.appendChild(document.createTextNode(""));
                
                trhead.appendChild(th_rua);
                trhead.appendChild(th_numero);
                trhead.appendChild(th_complemento);
                trhead.appendChild(th_bairro);
                trhead.appendChild(th_cep);
                trhead.appendChild(th_cidade);
                trhead.appendChild(th_editar);
                
                thead.appendChild(trhead);
                t.appendChild(thead);
                //fim cabecalho

                var tBody = document.createElement("tbody");

                for(var i = 0; i< result.length; i++){

                    //cria tr
                    var tr = document.createElement("tr");
                    
                    //cria td
                    var td_rua = document.createElement("td");
                    var td_numero = document.createElement("td");
                    var td_complemento = document.createElement("td");
                    var td_bairro = document.createElement("td");
                    var td_cep = document.createElement("td");
                    var td_cidade = document.createElement("td");
                    var td_editar = document.createElement("td");

                    //coloca informacao td
                    td_rua.appendChild(document.createTextNode(result[i].rua));
                    td_numero.appendChild(document.createTextNode(result[i].numero));
                    td_complemento.appendChild(document.createTextNode(result[i].complemento));
                    td_bairro.appendChild(document.createTextNode(result[i].bairro));
                    td_cep.appendChild(document.createTextNode(result[i].cep));
                    td_cidade.appendChild(document.createTextNode(result[i].cidade));
                    
                    
                    var link_editar = document.createElement("a");
                    link_editar.classList.add("btn");
                    link_editar.classList.add("btn-warning");
                    link_editar.setAttribute('href', "editar-endereco.php?endereco_id=" + result[i].id);
                    link_editar.appendChild(document.createTextNode("Editar"));
                    td_editar.appendChild(link_editar);

                    tr.appendChild(td_rua);
                    tr.appendChild(td_numero);
                    tr.appendChild(td_complemento);
                    tr.appendChild(td_bairro);
                    tr.appendChild(td_cep);
                    tr.appendChild(td_cidade);
                    tr.appendChild(td_editar);
                    //incluir no tbody
                    tBody.appendChild(tr);
                    //incluir no table que vai dentro do bloco endereco
                }
                t.appendChild(tBody);
                $("#lista-enderecos")[0].appendChild(t);
                $("#lista-enderecos").fadeIn();
            },
            error: function(er){
                console.log("erro:");
                console.log(er)
            }
        })
    });
    $("#cadastrar-endereco").click(function(){
        $("#form-cadastro-endereco").fadeToggle("slow");
    });
    $("#salvar-endereco").click(function(){
        rua = $("#rua")[0].value;
        numero = $("#numero")[0].value;
        complemento = $("#complemento")[0].value;
        bairro = $("#bairro")[0].value;
        cep = $("#cep")[0].value;
        pessoa_id = $("#pessoa_id")[0].value;
        cidade_id = $("#cidade_id")[0].value;

        
        if($("#rua")[0].value == "" || $("#numero")[0].value == "" || $("#bairro")[0].value == "" || $("#cidade_id")[0].value == ""){
            alert("Preencha todos os campos");
            return false;
        }else{
            $.ajax({
                url: "src/server-incluir-endereco-db.php",
                type: "post",
                dataType: "json",
                data: {
                    rua: rua,
                    numero: numero,
                    complemento: complemento,
                    bairro: bairro,
                    cep: cep,
                    pessoa_id: pessoa_id,
                    cidade_id: cidade_id
                },
                success: function(result){
                    console.log("sucesso");
                    alert("Endereço cadastrado com sucesso!");
                },
                error: function(er){
                    console.log("erro");
                    console.log(er);
                }
            });

            $("#form-cadastro-endereco").fadeToggle("slow");
            return true;
        }
    });

    $("#btn-editar").click(function(){
        var nome = $("#nome")[0].value;
        var telefone = $("#telefone")[0].value;
        var email = $("#email")[0].value;
        var ativo = $("#ativo")[0].checked == true ? 1 : 0;
        var pessoa_id = $("#pessoa_id")[0].value;
        
        $.ajax({
            url: "src/server-editar-cadastro-db.php",
            type: "post",
            dataType: "json",
            data: {
                nome: nome,
                telefone: telefone,
                email: email,
                ativo: ativo,
                pessoa_id: pessoa_id
            },
            success: function(result){
                alert("Edição de cadastro efetuada com sucesso!");
            },
            error: function(er){
                console.log("erro:");
                console.log(er);
            }
        });
        //
    });

});
</script>
<h1>Cadastro de <?=(($row['cargo_id'] == 1)? $row['cargo'] : ($row['cargo_id'] == 2) ? $row['cargo']: "Colaboradores")?></h1>
<p>Cadastros > <?=(($row['cargo_id'] == 1)? $row['cargo'] : ($row['cargo_id'] == 2) ? $row['cargo']: "Colaboradores")?> > Editar</p>
    <div class="row">
        <div class="col-sm-10 col-xs-12"></div>
        <div class="col-sm-2 col-xs-12">
            <label>
                Ativo
                <?php if($row['ativo'] == 0):
                        echo '<input type="checkbox" class="form-control" name="ativo" id="ativo" />';
                        else:
                            echo '<input type="checkbox" class="form-control" name="ativo" id="ativo" checked/>';
                        endif; 
                ?>
            </label>
        </div>
    </div>
        <div class="row">
            <div class="col-sm-5 col-xs-12">
                <label for="">Nome Completo:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="<?=$row['nome']?>">
            </div>
            <div class="col-sm-4 col-xs-12">
                <label for="">CPF:</label>
                <input type="text" class="form-control" name="cpf" id="cpf" value="<?=$row['cpf']?>" disabled>
            </div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Telefone:</label>
                <input type="text" class="form-control" name="telefone" id="telefone" value="<?=$row['telefone']?>">
            </div>
                <input type="hidden" name="empresa_id" id="empresa_id" value="<?=$row['empresa_id']?>">
            <div class="col-sm-4 col-xs-12">
                <label for="">cargo:</label>
                <input type="text" class="form-control" value="<?=$row['cargo']?>" disabled/>
            </div>
            <div class="col-sm-3 col-xs-12"></div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <h4>Informações de Acesso</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <label for="">Usuário:</label>
                <input type="text" class="form-control" value="<?=$row['usuario']?>" disabled>
            </div>
            <div class=" col-sm-6 col-xs-12">
                <label for="">E-mail:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?=$row['email']?>">
            </div>
            <input type="hidden" name="pessoa_id" id="pessoa_id" value="<?=$pessoa_id?>">
            <div class="col-sm-4 col-xs-4">
                <button type="button" id="btn-editar" class="btn btn-warning" style="margin-top:15px">Gravar Edição</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12" style="margin-top: 15px">
                <h4>Endereço</h4>
            </div>
        </div>
    <div class="col-sm-12 col-xs-12">
        <button class="btn btn-primary" id="atualiza-listagem-enderecos">Atualizar Endereços</button>
        <button class="btn btn-info" id="cadastrar-endereco">+ Endereço</button>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div id="lista-enderecos" style="display:none; margin-top: 15px" ></div>
        </div>
    </div>
    <div class="row" id="form-cadastro-endereco" style="display:none">
            <div class="col-sm-4">
                <label for="">Rua:</label>
                <input type="text" name="rua" id="rua" class="form-control" required />
            </div>
            <div class="col-sm-2">
                <label for="">Número:</label>
                <input type="text" name="numero" id="numero" class="form-control" required />
            </div>
            <div class="col-sm-4">
                <label for="">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control" required />
            </div>
            <div class="col-sm-2">
                <label for="">CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control" required />
            </div>
            <div class="col-sm-2">
                <label for="">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" required />
            </div>
            <div class="col-sm-2">
                <label for="">Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="form-control" required />
                <input type="hidden" name="cidade_id" id="cidade_id" class="form-control" required />
            </div>
        <button class="btn btn-success" id="salvar-endereco" style="margin-top: 15px">Cadastrar Endereço</button>
    </div>

<?php include_once('rodape.php'); ?>