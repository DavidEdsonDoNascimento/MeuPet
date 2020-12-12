<?php 
require_once('DAO/banco.php');

$nome_ou_cpf = $_POST['nome_ou_cpf']; 
$ehCpf = $_POST['ehCpf']; 
$cargo_id = $_POST['cargo_id']; 
$empresa_id = $_POST['empresa_id']; 
$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "select p.*, 
(select c.nome from cargo as c where c.id = p.cargo_id) as cargo 
from pessoa as p 
where empresa_id = :empresa_id and cargo_id = :cargo_id ";

$sql = ($ehCpf == 1) ?  ($sql ."and p.cpf = $nome_ou_cpf") : ($sql ."and p.nome like '".$nome_ou_cpf."%'");

$q = $pdo->prepare($sql);

$q->bindValue(":cargo_id", $cargo_id);
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