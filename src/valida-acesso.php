<?php 
session_start();

require_once('DAO/banco.php');

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM pessoa WHERE usuario = :usuario AND senha = :senha and ativo = 1 limit 1";
$q = $pdo->prepare($sql);
$q->bindValue(":usuario", $usuario);
$q->bindValue(":senha", $senha);

$q->execute();
Banco::desconectar();

if($q->rowCount() > 0)
{
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id'] = $row['id'];
    $_SESSION['nome'] = $row['nome'];
    $_SESSION['usuario'] = $row['usuario'];
    $_SESSION['nivel'] = $row['empresa_id'] == 1 ? 1000 : $row['cargo_id'];
    //$_SESSION['visualiza_servicos'] 
    $_SESSION['empresa_id'] = $row['empresa_id'];
    $response = array("success" => true);
    echo json_encode($response);
}
else
{
    unset ($_SESSION['id']);
    unset ($_SESSION['nome']);
    unset ($_SESSION['usuario']);
    unset ($_SESSION['nivel']);
    unset ($_SESSION['empresa_id']);
    $response = array("success" => false);
    echo json_encode($response);
}

?>