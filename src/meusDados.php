

<?php 

include_once('./paginas/cabecalho.php'); 

    if(empty($_SESSION['email']))
        header('location:login.php');
    
    require_once('DAO/banco.php');
    $id = $_GET['id'];
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM pessoa WHERE id = :id limit 1";
    $q = $pdo->prepare($sql);
    $q->bindValue(":id", $id);
    $q->execute();
    Banco::desconectar();

    $lista = array(); 
    while($row = $q->fetch(PDO::FETCH_ASSOC)){ 
        $data['id'] = $row['id']; 
        $data['value'] = $row['nome']; 
        array_push($lista, $data); 
    } 
?>

<h1>Cadastro de Transportadora</h1>
<div class="row">
    <form action="cadastrar.php" method="post">
        <div class="col-sm-10 col-xs-10"></div>
        <input type="checkbox" name="ativo" id="ativo" class="col-sm-2 col-xs-2" checked="checked">
        <div class="col-sm-12 col-xs-12"></div>
        
        <div class="form-group col-sm-5 col-xs-12">
            <label for="">Razão Social:</label>
            <input type="text" class="form-control" name="razaosocial" id="razaosocial">
        </div>
        <div class="form-group col-sm-4 col-xs-12">
            <label for="">Nome Fantasia:</label>
            <input type="text" class="form-control" name="nomefantasia" id="nomefantasia">
        </div>
        <div class="form-group col-sm-3 col-xs-12">
            <label for="">CNPJ:</label>
            <input type="text" class="form-control" name="documento" id="documento">
        </div>
                    
        <input type="hidden" name="categoria" id="categoria" value="3">
        
        <div class="form-group col-sm-12 col-xs-12">
            <label for="">Endereco:</label>
            <textarea name="endereco" id="endereco" class="form-control" cols="30" rows="2"></textarea>
        </div>
        
        <div class="form-group col-sm-3 col-xs-12">
            <label for="">Telefone Preferencial:</label>
            <input type="text" class="form-control col-sm-3 col-xs-12" name="telefonepreferencial" id="telefonepreferencial">
        </div>
        <div class="form-group col-sm-3 col-xs-12">
            <label for="">Telefone Opcional 1:</label>
            <input type="text" class="form-control col-sm-3 col-xs-12" name="telefoneopcional1" id="telefoneopcional1">
        </div>
        <div class="form-group col-sm-3 col-xs-12">
            <label for="">Telefone Opcional 2:</label>
            <input type="text" class="form-control" name="telefoneopcional2" id="telefoneopcional2">
        </div>
        <div class="form-group  col-sm-3 col-xs-12">
            <label for="">Telefone Opcional 3:</label>
            <input type="text" class="form-control col-sm-3 col-xs-12" name="telefoneopcional3" id="telefoneopcional3">
        </div>
        <div class="form-group col-sm-12 col-xs-12">
            <label for="">Obs:</label>
            <textarea name="observacao" id="observacao" class="form-control" cols="30" rows="4"></textarea>
        </div>
        <div class="form-group col-sm-12 col-xs-12">
            <h4>Informações de Acesso</h4>
        </div>
        <div class="form-group col-sm-6 col-xs-12">
            <label for="">E-mail:</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group  col-sm-6 col-xs-12">
            <label for="">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha">
        </div>
        <div class="form-group col-sm-4 col-xs-4">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>



