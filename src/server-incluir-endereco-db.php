<?php 
require_once('DAO/banco.php');

$rua = $_POST['rua']; 
$numero = $_POST['numero']; 
$bairro = $_POST['bairro']; 
$cep = $_POST['cep']; 
$complemento = $_POST['complemento']; 
$pessoa_id = $_POST['pessoa_id']; 
$cidade_id = $_POST['cidade_id']; 

 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = 'insert into endereco(rua, numero, bairro, cep, complemento, pessoa_id, cidade_id) values (:rua, :numero, :bairro, :cep, :complemento, :pessoa_id, :cidade_id)';
 $q = $pdo->prepare($sql);
 $q->bindValue(":rua", $rua);
 $q->bindValue(":numero", $numero);
 $q->bindValue(":bairro", $bairro);
 $q->bindValue(":cep", $cep);
 $q->bindValue(":complemento", $complemento);
 $q->bindValue(":pessoa_id", $pessoa_id);
 $q->bindValue(":cidade_id", $cidade_id);

 $result = $q->execute();
 
 Banco::desconectar();

 $response = array("success" => true);
echo json_encode($response);

?>