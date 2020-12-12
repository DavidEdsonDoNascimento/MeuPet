<?php include_once('cabecalho.php'); ?>

<h1>Edição de endereço</h1>

<?php

    require_once('./src/DAO/banco.php');
    
    $endereco_id = $_GET['endereco_id'];    
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "select 
    e.*,
    (select nome from pessoa as p where p.id = e.pessoa_id) as pessoa,
    (select nome from cidade as c where c.id = e.cidade_id) as cidade
    from endereco as e
    where id = :endereco_id";

    $q = $pdo->prepare($sql);
    $q->bindValue(":endereco_id", $endereco_id);

    $q->execute();
 
    if(!$q->rowCount() > 0):
        header('location:erro.php');
    else:
        $row = $q->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <form  class="col-sm-12" action="src/editar-endereco-db.php" method="post">
        <div class="row">
        <input type="hidden" name="endereco_id" id="endereco_id" value="<?=$row['id']?>">
            <div class="col-sm-4 col-xs-12">
                <label for="">Rua:</label>
                <input type="text" class="form-control" name="rua" id="rua" value="<?=$row['rua']?>">
            </div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Número:</label>
                <input type="text" class="form-control" name="numero" id="numero" value="<?=$row['numero']?>">
            </div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Complemento:</label>
                <input type="text" class="form-control" name="complemento" id="complemento" value="<?=$row['complemento']?>">
            </div>
            <div class="col-sm-2 col-xs-12">
                <label for="">Bairro:</label>
                <input type="text" class="form-control" name="bairro" id="bairro" value="<?=$row['bairro']?>">
            </div>
            <div class="col-sm-4 col-xs-12">
                <label for="">C.E.P:</label>
                <input type="text" class="form-control" name="cep" id="cep" value="<?=$row['cep']?>">
            </div>
            
            
            <div class="col-sm-3 col-xs-12">
                <label for="">Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="form-control" value="<?=$row['cidade']?>" required />
                <input type="hidden" name="cidade_id" id="cidade_id" class="form-control" value="<?=$row['cidade_id']?>" required />
            </div>
            <div class="col-sm-5 col-xs-12"></div>

            <div class="col-sm-12 col-xs-12">
                <label for="">Observação:</label>
                <textarea name="observacao" id="observacao" cols="30" rows="5" value="<?=$row['observacao']?>" class="form-control">                
                </textarea>
            </div>                    

            <div class="col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-success" style="margin-top:15px">Gravar Edição</button>
            </div>
        </div>
                    
    </form>
</div>
    <?php endif;?>
<?php include_once('rodape.php'); ?>