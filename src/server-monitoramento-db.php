<?php
require_once('./src/DAO/banco.php');

$sql = '
select 
r.pet_id as pet_id,
r.servico_id as servico_id,
(select p.nome from pet as p where p.id = r.pet_id) as pet,
(select ps.nome from pessoa as ps where ps.id = r.pessoa_id) as atendente,
(select s.nome from servico as s where s.id = r.servico_id) as servico,
status,
data
from relatorio as r
order by data desc, status
';

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);    

$q->execute();

$lista = array(); 


Banco::desconectar();

while($row = $q->fetch(PDO::FETCH_ASSOC)){ 

    $data['pet_id'] = $row['pet_id']; 
    $data['servico_id'] = $row['servico_id']; 
    $data['pet'] = $row['pet']; 
    $data['atendente'] = $row['atendente']; 
    $data['servico'] = $row['servico']; 
    $data['status'] = $row['status']; 
    $data['data'] = $row['data']; 
    array_push($lista, $data); 
}
echo json_encode($lista); 

?>