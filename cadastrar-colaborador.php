<?php 
    include_once('cabecalho.php');
    require_once('./src/DAO/banco.php');

    $sql = "select * from cargo where id > 2";

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);    
    
    $result = $q->execute();

    $q->execute();


?>
<script>
$(document).ready(function(){
    $("#cadastrar-colaborador").click(function(){

        var nome = $("#nome")[0].value;
        var cpf = $("#cpf")[0].value;
        var telefone = $("#telefone")[0].value;
        var email = $("#email")[0].value;
        var usuario = $("#usuario")[0].value;
        var senha = $("#senha")[0].value;
        var empresa_id = $("#empresa_id")[0].value;
        var cargo_id = $("#cargo_id")[0].value;

        if($("#nome")[0].value == "" || $("#cpf")[0].value == "" || $("#telefone")[0].value == "" || $("#email")[0].value == "" || 
           $("#usuario")[0].value == "" || $("#senha")[0].value == "" || $("#empresa_id")[0].value == "" || $("#cargo_id")[0].value == ""){
            alert("Preencha todos os campos");
            return false;
        }else{
            $.ajax({
                url: "src/server-incluir-colaborador-db.php",
                type: "post",
                dataType: "json",
                data: {
                    nome: nome,
                    cpf: cpf,
                    telefone: telefone,
                    email: email,
                    usuario: usuario,
                    senha: senha,
                    empresa_id: empresa_id,
                    cargo_id: cargo_id
                },
                success: function(result){                    
                    if(result.success == true){
                        alert("Colaborador cadastrado com sucesso!");
                        setTimeout(() => {
                            window.location.href = "http://localhost/meupet/colaboradores.php";
                        }, 2000);

                    }else{
                        alert("Ocorreu algum problema com seu cadastro, Entre em contato com nossos analistas!");
                    }
                },
                error: function(er){
                    console.log("erro");
                    console.log(er);
                }
            });
            return true;
        }

    });
});
</script>

<h1>Cadastro de colaborador</h1>
<p>Cadastros > Colaborador > Incluir</p>
<div class="row">
        <div class="col-sm-5 col-xs-12">
            <label for="">Nome Completo:</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>
        <div class="col-sm-4 col-xs-12">
            <label for="">CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf">
        </div>
        <div class="col-sm-3 col-xs-12">
            <label for="">Telefone:</label>
            <input type="text" class="form-control" name="telefone" id="telefone">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-xs-12">
            <label for="">E-mail:</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>
    
        <input type="hidden" name="empresa_id" id="empresa_id" value="<?=$_SESSION['empresa_id']?>">
    
        <div class="col-sm-4 col-xs-12">
            <label for="">cargo:</label>
            <select name="cargo_id" id="cargo_id" class="form-control">
                <?php 
                if($q->rowCount() > 0):
                    while($row = $q->fetch(PDO::FETCH_ASSOC)):
                ?>
                <option value="<?=$row['id']?>"><?=$row['nome']?></option>
                <?php 
                    endwhile;
                endif;
                ?>
            </select>
        </div>
        <div class="col-sm-5 col-xs-12"></div>
    </div>

<div class="row">  
    <div class="col-sm-12 col-xs-12">
        <h4>Informações de Acesso</h4>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-xs-12">
        <label for="">Usuário:</label>
        <input type="text" class="form-control" name="usuario" id="usuario">
    </div>
    <div class=" col-sm-6 col-xs-12">
        <label for="">Senha:</label>
        <input type="password" class="form-control" name="senha" id="senha">
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-xs-4">
        <button type="submit" class="btn btn-success" id="cadastrar-colaborador" style="margin-top:15px">Cadastrar</button>
    </div>
    <div class="col-sm-8 col-xs-4"></div>
</div>

<?php include_once('rodape.php'); ?>