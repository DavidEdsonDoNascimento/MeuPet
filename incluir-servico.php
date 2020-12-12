<?php
include_once('cabecalho.php'); 
    
if(empty($_SESSION['usuario']))
    header('location:login.php');
?>
<script>
$(document).ready(function(){
    $("#btnConfirmar").click(function(){
        array = [];

        $("input:checked").each(function(){
            array.push($(this).attr("id"));
        });
            
        $.ajax({
            url: 'src/server-incluir-servicos.php',
            type: 'post',
            data: { 
                ids: array,
                pet_id: $('#pet_id')[0].value,
                dono_id: $('#dono_id')[0].value,
                pessoa_id: $('#pessoa_id')[0].value
            },
            success: function(r){
                alert("Serviço incluido com sucesso!");
                window.location.href="http://localhost/meupet/monitoramento.php";
            },
            error: function(e){

                console.log("ERRO:");
                console.log(e);
            }
        });
    });
});
</script>
<h1>Incluir Serviços</h1>
<?php 

require_once('./src/DAO/banco.php');

$pet_id = $_GET['pet_id'];

$tag_id = $_GET['tag_id'];

if($tag_id == "atd"){
    echo "<p>Atendimentos > Pets > Incluir Serviços</p>";
}
else{
    if($tag_id == "cli")
        echo "<p>Cadastros > Clientes > Pets > Incluir Serviços</p>";
        
}

$sql = "select p.*, (select ps.nome from pessoa as ps where ps.id = p.pessoa_id) as dono from pet as p where p.id = :pet_id";

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);    

$q->bindValue(":pet_id", $pet_id);

$result = $q->execute();

$sqlServicos = "select * from servico where ativo = 1";
$qServ = $pdo->prepare($sqlServicos);  
$rServ = $qServ->execute();

if($q->rowCount() > 0){
    $rs = $q->fetch(PDO::FETCH_ASSOC);
    echo '<table class="table table-bordered table-light" style="width: 350px">
            <thead>
                <tr>
                    <th scope="col">
                Pet
                    </th>
                    <th scope="col">
                Dono
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>'.$rs['nome'].'</td>
                    <td>'.$rs['dono'].'</td>
                </tr>
            </tbody>
        </table>';
    echo '<input type="hidden" id="pet_id" value="'.$rs['id'].'"/>';
    echo '<input type="hidden" id="dono_id" value="'.$rs['pessoa_id'].'"/>';
    echo '<input type="hidden" id="pessoa_id" value="'.$_SESSION['id'].'"/>';
    echo '<p><a href="relatorio.php?pet_id='.$pet_id.'" class="btn btn-info">Relatório</a></p>';
}

if($qServ->rowCount() > 0){
    echo '<h3>Serviços</h3>';
    while($row = $qServ->fetch(PDO::FETCH_ASSOC)){ 

        echo '
        <p>'
        .$row['nome'].
        ' <input type="checkbox" id="'.$row['id'].'">
        </p>';
            
    }
    echo '<button class="btn btn-success" id="btnConfirmar">Confirmar</button>';


    }
    ?>
<?php include_once('rodape.php'); ?>
