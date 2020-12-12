<?php include_once('cabecalho.php'); ?>
<h1>Edição de serviço</h1>
<p>Cadastros > Serviços > Editar</p>
<?php

    require_once('./src/DAO/banco.php');
    
    $servico_id = $_GET['servico_id'];    
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "select * from servico where id = :servico_id";

    $q = $pdo->prepare($sql);
    $q->bindValue(":servico_id", $servico_id);

    $q->execute();
 
    if(!$q->rowCount() > 0):
        header('location:erro.php');
    else:
        $row = $q->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <form  class="col-sm-12" action="src/editar-servico-db.php" method="post">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label for="">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="<?=$row['nome']?>">
            </div>
            <div class="col-sm-6 col-xs-12">
                <label for="">Descrição:</label>
                <input type="text" class="form-control" name="descricao" id="descricao" value="<?=$row['descricao']?>">
            </div>
            <input type="hidden" name="servico_id" value="<?=$servico_id?>"/>
            <div class="col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-warning" style="margin-top:15px">Gravar Edição</button>
            </div>
        </div>
                    
    </form>
</div>
    <?php endif;?>
<?php include_once('rodape.php'); ?>