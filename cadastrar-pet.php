<?php 

include_once('cabecalho.php'); 
    
    if(empty($_SESSION['usuario']))
        header('location:login.php');

?>
<h1>Pet</h1>

<?php
    $tag_id = $_GET['tag_id'];

    if($tag_id == "atd"){
        echo "<p>Atendimentos > Pets > Incluir</p>";
    }
    else{
        if($tag_id == "cli")
            echo "<p>Cadastros > Clientes > Pets > Incluir</p>";
    }
?>
    <div class="container planodefundo">
        <form action="./src/cadastrar-pet-db.php" method="post">
            <div class="row">
                
                <div class="col-sm-3 col-xs-12">
                    <label for="">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" required />
                </div>
                <div class="col-sm-3 col-xs-12">
                    <label for="">Data de Nascimento:</label>
                    <input type="date" name="datanascimento" id="datanascimento" class="form-control" required />
                </div>
                <div class="col-sm-2 col-xs-12">
                    <label for="">Cor:</label>
                    <input type="text" class="form-control" name="cor" id="cor" required>
                </div>
                <div class="col-sm-2">
                    <label for="">Espécie:</label>
                    <input type="text" name="especie" id="especie" class="form-control" required />
                </div>
                
                <div class="col-sm-2 col-xs-12">
                    <label for="">Raça:</label>
                    <input type="text" class="form-control" name="raca" id="raca" required>
                </div>
                
                <input type="hidden" name="cliente_id" id="cliente_id" value="<?=$_GET['cliente_id']?>" />
            
                <div class="col-sm-2" style="margin-top: 15px">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>               
            </div>
        </form>
    </div>

<?php include_once('rodape.php'); ?>