<?php include_once('cabecalho.php'); ?>
<h1>Edição de pet</h1>
<?php

    require_once('./src/DAO/banco.php');
    
    $pet_id = $_GET['pet_id'];    
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "select pet.*, (select p.nome from pessoa as p where p.id = pet.pessoa_id) as dono  from pet where id = :pet_id";

    $q = $pdo->prepare($sql);
    $q->bindValue(":pet_id", $pet_id);

    $q->execute();
 
    if(!$q->rowCount() > 0):
        header('location:erro.php');
    else:
        $row = $q->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <form  class="col-sm-12" action="src/editar-pet-db.php" method="post">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label for="">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="<?=$row['nome']?>">
            </div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Dono:</label>
                <input type="text" class="form-control" name="dono" id="dono" value="<?=$row['dono']?>" disabled>
            </div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Data de Nascimento:</label>
                <input type="date" class="form-control" name="datanascimento" id="datanascimento" value="<?=$row['datanascimento']?>">
            </div>
            <div class="col-sm-2 col-xs-12">
                <label for="">Cor:</label>
                <input type="text" class="form-control" name="cor" id="cor" value="<?=$row['cor']?>">
            </div>
            <div class="col-sm-4 col-xs-12">
                <label for="">Espécie:</label>
                <input type="text" class="form-control" name="especie" id="especie" value="<?=$row['especie']?>">
            </div>
            <div class="col-sm-3 col-xs-12">
                <label for="">Raça:</label>
                <input type="text" class="form-control" name="raca" id="raca" value="<?=$row['raca']?>">
            </div>
            
            <input type="hidden" name="pet_id" value="<?=$pet_id?>"/>

            <div class="col-sm-5 col-xs-12"></div>
            <div class="col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-success" style="margin-top:15px">Gravar Edição</button>
            </div>
        </div>
                    
    </form>
</div>
    <?php endif;?>
<?php include_once('rodape.php'); ?>