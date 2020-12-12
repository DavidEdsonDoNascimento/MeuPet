
<?php 
 
 require_once('DAO/banco.php');
 
 $nome = $_POST['nome'];
 $datanascimento = $_POST['datanascimento'];
 $cor = $_POST['cor'];
 $especie = $_POST['especie'];
 $raca = $_POST['raca'];
 $pet_id = $_POST['pet_id'];

 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "UPDATE pet SET nome = :nome, datanascimento = :datanascimento, cor = :cor, especie = :especie, raca = :raca  WHERE id = :pet_id";
 $q = $pdo->prepare($sqlPessoa);


 $q->bindValue(":nome", $nome);
 $q->bindValue(":datanascimento", $datanascimento);
 $q->bindValue(":cor", $cor);
 $q->bindValue(":especie", $especie);
 $q->bindValue(":raca", $raca);
 $q->bindValue(":pet_id", $pet_id);

$result = $q->execute();
 
 Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>