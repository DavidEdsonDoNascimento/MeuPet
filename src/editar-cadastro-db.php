
<?php 
 
 require_once('DAO/banco.php');
 
 $nome = $_POST['nome'];
 $telefone = $_POST['telefone'];
 $email = $_POST['email'];
 $ativo = $_POST['ativo'];
 $pessoa_id = $_POST['pessoa_id'];

 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "UPDATE pessoa SET nome = :nome, telefone = :telefone, email = :email, ativo = :ativo  WHERE id = :pessoa_id";
 $q = $pdo->prepare($sqlPessoa);


 $q->bindValue(":nome", $nome);
 $q->bindValue(":telefone", $telefone);
 $q->bindValue(":email", $email);
 $q->bindValue(":ativo", $ativo);
 $q->bindValue(":pessoa_id", $pessoa_id);

$result = $q->execute();
 
 Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>