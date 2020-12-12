<?php 
require_once('DAO/banco.php');

$empresa_id = $_POST['empresa_id']; 
 
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "select p.*, 
(select c.nome from cargo as c where c.id = p.cargo_id) as cargo 
from pessoa as p 
where empresa_id = :empresa_id and cargo_id != 2 and cargo_id != 1";

$q = $pdo->prepare($sql);
$q->bindValue(":empresa_id", $empresa_id);

$q->execute();
Banco::desconectar();

$lista = array(); 

while($row = $q->fetch(PDO::FETCH_ASSOC)){ 
	$data['id'] = $row['id']; 
    $data['nome'] = $row['nome']; 
    $data['cpf'] = $row['cpf']; 
    $data['telefone'] = $row['telefone']; 
    $data['cargo'] = $row['cargo']; 
    array_push($lista, $data); 
} 

echo json_encode($lista); 

?>