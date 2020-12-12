<?php include_once('cabecalho.php'); ?>
<h1>Edição de Empresa</h1>
<?php

    require_once('./src/DAO/banco.php');
    
    $empresa_id = $_GET['empresa_id'];    
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "select * from empresa where id = :empresa_id";

    $q = $pdo->prepare($sql);
    $q->bindValue(":empresa_id", $empresa_id);

    $q->execute();
 
    if(!$q->rowCount() > 0):
        header('location:erro.php');
    else:
        $row = $q->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <form  class="col-sm-12" action="src/editar-empresa-db.php" method="post">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <label for="">Razão Social:</label>
                <input type="text" class="form-control" name="razaosocial" id="razaosocial" value="<?=$row['razaosocial']?>" disabled>
            </div>
            <div class="col-sm-6 col-xs-12">
                <label for="">Nome Fantasia:</label>
                <input type="text" class="form-control" name="nomefantasia" id="nomefantasia" value="<?=$row['nomefantasia']?>">
            </div>
            <div class="col-sm-5 col-xs-12">
                <label for="">CNPJ:</label>
                <input type="text" class="form-control" name="cnpj" id="cnpj" value="<?=$row['cnpj']?>" disabled>
            </div>
            <div class="col-sm-1 col-xs-12"></div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Inscricao Estadual:</label>
                <input type="text" class="form-control" name="inscricaoestadual" id="inscricaoestadual" value="<?=$row['inscricaoestadual']?>" disabled>
            </div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Telefone:</label>
                <input type="text" class="form-control" name="telefone" id="telefone" value="<?=$row['telefone']?>">
            </div>
            <input type="hidden" name="empresa_id" id="empresa_id" value="<?=$empresa_id?>">
            <div class="col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-success" style="margin-top:15px">Gravar Edição</button>
            </div>
        </div>
    </form>
</div>
    <?php endif;?>
<?php include_once('rodape.php'); ?>