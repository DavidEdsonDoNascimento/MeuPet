<?php 
include_once('cabecalho.php'); 
?>
<h1>Pets em atendimento</h1>

<?php
    
    
    require_once('./src/DAO/banco.php');
 $pdo = Banco::conectar();

 $sql = 'select 
 (select p.nome from pet as p where p.id = r.pet_id) as pet,
 (select ps.nome from pessoa as ps where ps.id = r.pessoa_id) as dono,
 status,
 data
 from relatorio as r
 ';

 $q = $pdo->prepare($sql);
 
 $q->bindValue(":empresa_id", $_SESSION['empresa_id']);
 
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $q->execute();
?>
<div class="row">
    <input type="text" name="txtbusca" class="form-control col-sm-4" placeholder="Digite o CPF"/>
    <button class="btn btn-success">Buscar</button>
</div>
<?php
   
 
    if($q->rowCount() > 0){
        echo '<table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Telefone</th>          
                <th scope="col">Cargo</th>          
                <th scope="col"></th>
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
                    <td>'.$row['cargo'].'</td>
                    <td>
                    <a href="editar-colaborador.php?pessoa_id='.$row["id"].'" class="btn btn-warning">
                        Editar
                    </a>
                    </td>
                ';
            echo '</tr>';
                
        }
        echo '
                </tbody>
            </table>
            ';


    }
    
    Banco::desconectar();
?>

<?php include_once('rodape.php'); ?>