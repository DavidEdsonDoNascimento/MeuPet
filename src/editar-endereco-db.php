
<?php 
 
 require_once('DAO/banco.php');
 
 $rua = $_POST['rua'];
 $numero = $_POST['numero'];
 $complemento = $_POST['complemento'];
 $bairro = $_POST['bairro'];
 $cep = $_POST['cep'];
 $observacao = $_POST['observacao'];
 $cidade_id = $_POST['cidade_id'];
 $id = $_POST['endereco_id'];

 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "UPDATE endereco SET rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, cep = :cep, observacao = :observacao, cidade_id = :cidade_id WHERE id = :id";
 
 $q = $pdo->prepare($sqlPessoa);

 $q->bindValue(":rua", $rua);
 $q->bindValue(":numero", $numero);
 $q->bindValue(":complemento", $complemento);
 $q->bindValue(":bairro", $bairro);
 $q->bindValue(":cep", $cep);
 $q->bindValue(":observacao", $observacao);
 $q->bindValue(":cidade_id", $cidade_id);
 $q->bindValue(":id", $id);

$result = $q->execute();
 
 Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>