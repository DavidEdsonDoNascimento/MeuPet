
<?php 
 
 require_once('DAO/banco.php');
 
 $nome = $_POST['nome'];
 $descricao = $_POST['descricao'];
 $ativo = 1;

 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "insert into servico(nome, descricao, ativo) values (:nome, :descricao, :ativo)";
 $q = $pdo->prepare($sqlPessoa);


 $q->bindValue(":nome", $nome);
 $q->bindValue(":descricao", $descricao);
 $q->bindValue(":ativo", $ativo);

$result = $q->execute();
 
 Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>