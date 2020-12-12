<?php 
    include_once('cabecalho.php');
    require_once('./src/DAO/banco.php');
    
    $cargo = $_GET['cargo'];


    $sql = "select * from cargo";

    if(isset($cargo))
        $sql = $sql." where id = :id ";

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);    
    
    if(isset($cargo))
        $q->bindValue(":id", $cargo);
    
    $result = $q->execute();

    $q->execute();


?>

<h1>Atendimento</h1>
<div class="row">
    <form  class="col-sm-12" action="src/cadastrar.php" method="post">
        <div class="row">
            <div class="col-sm-5 col-xs-12">
                <label for="">Cliente:</label>
                <input type="text" class="form-control" name="nome" id="nome">
                <input type="hidden" name="pessoa_id" id="pessoa_id">
            </div>
            <div class="col-sm-4 col-xs-12">
                <label for="">Pet:</label>
                <input type="text" class="form-control" name="pet" id="pet">
                <input type="hidden" name="pet_id" id="pet_id">
            </div>
            <div class="col-sm-4 col-xs-12">
                <label for="">Serviços:</label>
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
            <div class="col-sm-3 col-xs-12"></div>

        </div>
                    
        <div class="col-sm-12 col-xs-12">
            <h4>Informações de Acesso</h4>
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
        <div class="col-sm-4 col-xs-4">
            <button type="submit" class="btn btn-primary" style="margin-top:15px">Cadastrar</button>
        </div>
    </form>
</div>

<?php include_once('rodape.php'); ?>