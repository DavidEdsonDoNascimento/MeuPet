<?php include_once('cabecalho.php'); ?>
<h1>Usuário Master</h1>

<?php
    require_once('./src/DAO/banco.php');
    
    $empresa_id = $_GET['empresa_id'];

    $sql = "select * from pessoa where empresa_id = :empresa_id and cargo_id  = 1 and usuario like \"master-%\"";

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $q = $pdo->prepare($sql);    
    $q->bindValue(":empresa_id", $empresa_id);

    $result = $q->execute();

 
    $q->execute();
 
    if($q->rowCount() > 0){
        echo '<table class="table table-hover table-bordered table-light">
        <thead>
            <tr>
            <th scope="col">Nome</th>
            <th scope="col">Usuário</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>';

        while($row = $q->fetch(PDO::FETCH_ASSOC)){ 

            echo '
                <tr>
                    <td>'.$row['nome'].'</td>
                    <td>'.$row['usuario'].'</td>
                    <td></td>
                </tr>
                ';
                
        }
        echo '
                </tbody>
            </table>
            ';


    }
    else{
        echo '<a class="btn btn-success" href="cadastrar-usuario-master.php?empresa_id='.$empresa_id.'">Incluir</a>';
    }

    Banco::desconectar();
?>

<?php include_once('rodape.php'); ?>