<?php 
require_once('DAO/banco.php');
 
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pessoa_id = $_POST['pessoa_id'];

$sql = "SELECT e.*, (select c.nome from cidade as c where c.id = e.cidade_id) as cidade from endereco as e WHERE pessoa_id = :pessoa_id";
$q = $pdo->prepare($sql);
$q->bindValue(":pessoa_id", $pessoa_id);
$q->execute();
Banco::desconectar();

$lista = array(); 

while($row = $q->fetch(PDO::FETCH_ASSOC)){ 
	$data['id'] = $row['id']; 
    $data['numero'] = $row['numero']; 
    $data['rua'] = $row['rua']; 
    $data['bairro'] = $row['bairro']; 
    $data['complemento'] = $row['complemento']; 
    $data['cep'] = $row['cep']; 
    $data['cidade'] = $row['cidade']; 
    array_push($lista, $data); 
} 

echo json_encode($lista); 

?>