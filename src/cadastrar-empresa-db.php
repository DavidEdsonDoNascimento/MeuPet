
<?php 
 
 require_once('DAO/banco.php');
 
 $razaosocial = $_POST['razaosocial'];
 $nomefantasia = $_POST['nomefantasia'];
 $cnpj = $_POST['cnpj'];
 $inscricaoestadual = $_POST['inscricaoestadual'];
 $telefone = $_POST['telefone'];
 
 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "insert into empresa (razaosocial, nomefantasia, cnpj, inscricaoestadual, telefone) values (:razaosocial, :nomefantasia, :cnpj, :inscricaoestadual, :telefone)";
 $q = $pdo->prepare($sqlPessoa);


 $q->bindValue(":razaosocial", $razaosocial);
 $q->bindValue(":nomefantasia", $nomefantasia);
 $q->bindValue(":cnpj", $cnpj);
 $q->bindValue(":inscricaoestadual", $inscricaoestadual);
 $q->bindValue(":telefone", $telefone);

$result = $q->execute();
 
Banco::desconectar();
 
 if($result)
    header('location:../sucesso.php');
else
    header('location:../erro.php');
 ?>