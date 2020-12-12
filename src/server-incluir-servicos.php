<?php 
require_once('DAO/banco.php');

$ids = $_POST['ids']; 
$pet_id = $_POST['pet_id']; 
$dono_id = $_POST['dono_id']; 
$pessoa_id = $_POST['pessoa_id']; 
$data = date('Y/m/d H:i:s');
//var_dump($ids); 
 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = 'insert into relatorio(pet_id, servico_id, dono_id, pessoa_id, status, data) values ';

for($i = 0; $i < count($ids); $i++){
    if(!($i == count($ids) -1))
        $sql = $sql . '('.$pet_id.', '.$ids[$i].', '.$dono_id.', '.$pessoa_id.', 1, "'.$data.'"),';
    else
        $sql = $sql . '('.$pet_id.', '.$ids[$i].', '.$dono_id.', '.$pessoa_id.', 1, "'.$data.'")';
}
 $q = $pdo->prepare($sql);

 $result = $q->execute();
 
 Banco::desconectar();

?>