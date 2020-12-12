<?php 
require_once('DAO/banco.php');

$searchTerm = $_GET['term'];
$dono_id = $_GET['dono_id'];
 
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT id, nome from pet WHERE nome LIKE '".$searchTerm."%' and pessoa_id = :dono_id";
$q = $pdo->prepare($sql);
$q->execute();
Banco::desconectar();

$lista = array(); 

while($row = $q->fetch(PDO::FETCH_ASSOC)){ 
	$data['id'] = $row['id']; 
    $data['value'] = $row['nome']; 
    array_push($lista, $data); 
} 

echo json_encode($lista); 

?>