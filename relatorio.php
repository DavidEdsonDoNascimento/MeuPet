<?php
include_once('cabecalho.php'); 
    
if(empty($_SESSION['usuario']))
    header('location:login.php');
?>

<h1>Relatório</h1>

<?php 
require_once('./src/DAO/banco.php');

$pet_id = $_GET['pet_id'];

$sql = '
select 
(select p.nome from pet as p where p.id = r.pet_id) as pet,
(select ps.nome from pessoa as ps where ps.id = r.pessoa_id) as dono,
(select s.nome from servico as s where s.id = r.servico_id) as servico,
status,
data
from relatorio as r
where r.pet_id = :pet_id
order by data desc
';

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);    

$q->bindValue(":pet_id", $pet_id);

$q->execute();

if($q->rowCount() > 0){
        echo '<table class="table table-hover table-bordered table-light">
        <thead>
            <tr>
            <th scope="col">Pet</th>
            <th scope="col">Serviço</th>         
            <th scope="col">Status</th>         
            <th scope="col">Data</th>         
            </tr>
        </thead>
        <tbody>';

        while($row = $q->fetch(PDO::FETCH_ASSOC)){ 

            echo '
                <tr>
                    <td>'.$row['pet'].'</td>
                    <td>'.$row['servico'].'</td>
                    <td>'.(($row['status'] == 1) ? "Aguardando" : (($row['status'] == 2) ? "Sendo Atendido" : "Pronto")).'</td>
                    <td>'.date("d/m/Y s:i:G", strtotime($row['data'])).'</td>
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
    ?>
<?php include_once('rodape.php'); ?>