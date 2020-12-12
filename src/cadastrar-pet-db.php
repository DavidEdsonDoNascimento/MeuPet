
<?php 
 
 require_once('DAO/banco.php');
 
 $nome = $_POST['nome'];
    $datanascimento = $_POST['datanascimento'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $cor = $_POST['cor'];
    $pessoa_id = $_POST['cliente_id'];
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into pet(nome, datanascimento, especie, raca, cor, pessoa_id) values (:nome, :datanascimento, :especie, :raca, :cor, :pessoa_id)";
    
    $q = $pdo->prepare($sql);    

    $q->bindValue(":nome", $nome);
    $q->bindValue(":datanascimento", $datanascimento);
    $q->bindValue(":especie", $especie);
    $q->bindValue(":raca", $raca);
    $q->bindValue(":cor", $cor);
    $q->bindValue(":pessoa_id", $pessoa_id);
 

$result = $q->execute();
 
Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>