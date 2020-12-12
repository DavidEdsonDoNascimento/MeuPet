<?php 

$cpf = $_POST['cpf'];
$senha = $_POST['novasenha'];
$senhaconfirma = $_POST['confirmenovasenha'];

if($senha =! $senhaconfirma):
    header("location:../recuperar-senha.php");
else:
    require_once('DAO/banco.php');
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM pessoa WHERE cpf = :cpf AND ativo = 1 limit 1";
    $q = $pdo->prepare($sql);
    $q->bindValue(":cpf", $cpf);

    $q->execute();

    if($q->rowCount() > 0):
        $row = $q->fetch(PDO::FETCH_ASSOC);
        
        $sql = "UPDATE pessoa SET senha = :senha WHERE id = :id";
        $dodo = md5($_POST['novasenha']);
        $q = $pdo->prepare($sql);
        $q->bindValue(":senha", $dodo);
        $q->bindValue(":id", $row['id']);
        $q->execute();
        
        Banco::desconectar();
        header("location:../sucesso.php?oia=".$dodo."");
    
    else:
        Banco::desconectar();
        header('location:../erro.php');
    endif;

endif;
?>