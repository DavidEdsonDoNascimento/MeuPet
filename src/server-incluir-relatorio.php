<?php 
require_once('DAO/banco.php');

$pet_id = $_POST['pet_id']; 
$servico_id = $_POST['servico_id']; 
$pessoa_id = $_POST['pessoa_id']; 
$dono_id = $_POST['dono_id']; 
$status = $_POST['status']; 
$data = date('Y/m/d H:i:s');
//var_dump($ids); 
 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = 'insert into relatorio(pet_id, servico_id, pessoa_id, dono_id, status, data) values (:pet_id, :servico_id, :pessoa_id, :dono_id, :status, :data)';

 $q = $pdo->prepare($sql);
 
 $q->bindValue(":pet_id", $pet_id);
 $q->bindValue(":servico_id", $servico_id);
 $q->bindValue(":pessoa_id", $pessoa_id);
 $q->bindValue(":dono_id", $dono_id);
 $q->bindValue(":status", $status);
 $q->bindValue(":data", $data);

 $result = $q->execute();
 
 Banco::desconectar();
if($result){
    $response = array("success" => true);
    echo json_encode($response);
}else{
    $response = array("success" => false);
    echo json_encode($response);
}

?>