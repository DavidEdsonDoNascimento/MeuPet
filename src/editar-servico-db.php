
<?php 
 
 require_once('DAO/banco.php');
 
 $nome = $_POST['nome'];
 $descricao = $_POST['descricao'];
 $ativo = 1;
 $servico_id = $_POST['servico_id'];

 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "UPDATE servico SET nome = :nome, descricao = :descricao, ativo = :ativo WHERE id = :servico_id";
 $q = $pdo->prepare($sqlPessoa);


 $q->bindValue(":nome", $nome);
 $q->bindValue(":descricao", $descricao);
 $q->bindValue(":ativo", $ativo);
 $q->bindValue(":servico_id", $servico_id);

$result = $q->execute();
 
 Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>