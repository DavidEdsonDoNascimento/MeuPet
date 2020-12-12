<?php 
require_once('DAO/banco.php');

$email = $_POST['email'];
$cpf = $_POST['cpf'];

$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM pessoa WHERE email = :email AND cpf = :cpf and ativo = 1 limit 1";
$q = $pdo->prepare($sql);
$q->bindValue(":email", $email);
$q->bindValue(":cpf", $cpf);

$q->execute();

if($q->rowCount() > 0)
{
    $row = $q->fetch(PDO::FETCH_ASSOC);
    
    // vai gerar uma senha aleatória com 8 caracteres
    $senhaaleatoria = generatePassword(8); 

    //vai fazer o insert da senha
    $md5senha = md5($senhaaleatoria);

    $sql = "UPDATE pessoa SET senha = :senha WHERE id = :id";
    
    $q = $pdo->prepare($sql);
    $q->bindValue(":senha", $md5senha);
    $q->bindValue(":id", $row['id']);
    $q->execute();
    
    Banco::desconectar();
    header("location:../criar-novo-acesso.php?senhatemporaria=$senhaaleatoria");
}
else
{
    Banco::desconectar();
    header('location:../erro.php');
}


/** 
 * Gera senhas aleatórias
 *
 * @param int $qtyCaraceters quantidade de caracteres na senha, por padrão 8
 * @author Carlos Ferreira &lt;carlos@especializati.com.br&gt;
 * @return String 
*/
function generatePassword($qtyCaraceters = 8)
{
    //Letras minúsculas embaralhadas
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
 
    //Letras maiúsculas embaralhadas
    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
 
    //Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;
 
    //Caracteres Especiais
    $specialCharacters = str_shuffle('!@#$%*-');
 
    //Junta tudo
    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;
 
    //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);
 
    //Retorna a senha
    return $password;
}
?>