
<?php 
 
 require_once('DAO/banco.php');
 
 $nomefantasia = $_POST['nomefantasia'];
 $telefone = $_POST['telefone'];
 $empresa_id = $_POST['empresa_id'];

 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "UPDATE empresa SET nomefantasia = :nomefantasia, telefone = :telefone WHERE id = :empresa_id";
 $q = $pdo->prepare($sqlPessoa);


 $q->bindValue(":nomefantasia", $nomefantasia);
 $q->bindValue(":telefone", $telefone);
 $q->bindValue(":empresa_id", $empresa_id);

$result = $q->execute();
 
 Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>