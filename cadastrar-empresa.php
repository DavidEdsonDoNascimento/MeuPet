<?php 
    include_once('cabecalho.php');
?>

<h1>Cadastro de empresa</h1>
<div class="row">
    <form  class="col-sm-12" action="src/cadastrar-empresa-db.php" method="post">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <label for="">Razão Social:</label>
                <input type="text" class="form-control" name="razaosocial" id="razaosocial">
            </div>
            <div class="col-sm-6 col-xs-12">
                <label for="">Nome Fantasia:</label>
                <input type="text" class="form-control" name="nomefantasia" id="nomefantasia">
            </div>
            <div class="col-sm-5 col-xs-12">
                <label for="">CNPJ:</label>
                <input type="text" class="form-control" name="cnpj" id="cnpj">
            </div>
            <div class="col-sm-1 col-xs-12"></div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Inscricao Estadual:</label>
                <input type="text" class="form-control" name="inscricaoestadual" id="inscricaoestadual">
            </div>
            <div class="col-sm-3 col-xs-12"></div>
        </div>
                    
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <label for="">Telefone:</label>
                <input type="text" class="form-control" name="telefone" id="telefone">
            </div>
        </div>
        
        <div class="col-sm-4 col-xs-4">
            <button type="submit" class="btn btn-primary" style="margin-top:15px">Cadastrar</button>
        </div>
    </form>
</div>

<?php include_once('rodape.php'); ?>