<?php include_once('cabecalho.php'); ?>
<h1>Empresas</h1>

<?php
    require_once('./src/DAO/banco.php');
    
    $sql = "select * from empresa";

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $q = $pdo->prepare($sql);    
    $result = $q->execute();

 
    $q->execute();
 
    if($q->rowCount() > 0){
        echo '<table class="table table-hover table-bordered table-light">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">razao social</th>
            <th scope="col">nome fantasia</th>
            <th scope="col">cnpj</th>
            <th scope="col">inscricao estadual</th>          
            <th scope="col">telefone</th>          
            <th scope="col"></th>          
            <th scope="col"></th>          
            </tr>
        </thead>
        <tbody>';

        while($row = $q->fetch(PDO::FETCH_ASSOC)){ 

            echo '
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['razaosocial'].'</td>
                    <td>'.$row['nomefantasia'].'</td>
                    <td>'.$row['cnpj'].'</td>
                    <td>'.$row['inscricaoestadual'].'</td>
                    <td>'.$row['telefone'].'</td>
                    <td>
                        <a href="editar-empresa.php?empresa_id='.$row["id"].'" class="btn btn-warning">
                            Editar
                        </a>
                    </td>
                    <td>
                        <a href="usuario-master.php?empresa_id='.$row["id"].'" class="btn btn-info">
                            Masters
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
    echo '<a class="btn btn-success" href="cadastrar-empresa.php">Incluir</a>';

    Banco::desconectar();
?>

<?php include_once('rodape.php'); ?>