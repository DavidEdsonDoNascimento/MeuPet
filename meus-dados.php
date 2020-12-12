<?php 
    include_once('cabecalho.php');

    require_once('./src/DAO/banco.php');
    
    $sql = "select * from pessoa where id = :id ";

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);    
    $q->bindValue(":id", $_SESSION['id']);
    $result = $q->execute();

 
    $q->execute();


    if($q->rowCount() > 0){
        $row = $q->fetch(PDO::FETCH_ASSOC);
    }
?>

<h1>Meus Dados</h1>
<div class="row">
    <form  class="col-sm-12" action="src/editar-meus-dados-db.php" method="post">
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
            <div class="col-sm-6 col-xs-12">
                <label for="">Usuário:</label>
                <input type="text" class="form-control" value="<?=$row['usuario']?>" disabled>
            </div>
            <div class="col-sm-6 col-xs-12">
                <label for="">E-mail:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?=$row['email']?>">
            </div>
            <input type="hidden" name="pessoa_id" id="pessoa_id" value="<?=$_SESSION['id']?>" >
        </div>
        <br>
        <button class="btn btn-warning" type="submit">Gravar Edição</button>
    </form>
</div>

<?php include_once('rodape.php'); ?>