<?php 
require_once('DAO/banco.php');

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "select * from servico";
$q = $pdo->prepare($sql);
$q->execute();

Banco::desconectar();

$lista = array(); 

while($row = $q->fetch(PDO::FETCH_ASSOC)){ 
	$data['id'] = $row['id']; 
    $data['nome'] = $row['nome']; 
    $data['descricao'] = $row['descricao']; 
    array_push($lista, $data); 
} 

echo json_encode($lista); 

?>