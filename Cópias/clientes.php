<?php include_once('cabecalho.php'); ?>
<h1>Clientes</h1>

<?php
    require_once('./src/DAO/banco.php');
    
    $pdo = Banco::conectar();
    $sql = "select * from pessoa where empresa_id = :empresa_id and cargo_id = 2";
    $q = $pdo->prepare($sql);    
    $q->bindValue(":empresa_id", $_SESSION['empresa_id']);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $q->execute();

    $q->execute();
 
    if($q->rowCount() > 0){
        echo '
        
        <table class="table table-hover table-bordered table-light">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">telefone</th> 
            <th></th>         
            <th></th>         
            </tr>
        </thead>
        <tbody>';

        while($row = $q->fetch(PDO::FETCH_ASSOC)){ 

            echo '
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['nome'].'</td>
                    <td>'.$row['cpf'].'</td>
                    <td>'.$row['telefone'].'</td>
                    <td>
                        <a href="editar-colaborador.php?pessoa_id='.$row["id"].'" class="btn btn-warning">
                            Editar
                        </a>
                    </td>
                    <td>
                        <a href="pets.php?cliente_id='.$row["id"].'" class="btn btn-success">
                            Pets
                        </a>
                    </td>
                </tr>
                ';
                
        }
        echo '
                </tbody>
            </table>
            ';


    }
    else{
        echo '<p>Nenhum registro encontrado</p>';
    }
    Banco::desconectar();
?>

<?php include_once('rodape.php'); ?>