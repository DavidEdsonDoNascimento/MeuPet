
<?php 
 
 require_once('DAO/banco.php');
 
 $nome = $_POST['nome'];
 $cpf = $_POST['cpf'];
 $telefone = $_POST['telefone'];
 $email = $_POST['email'];
 $usuario = $_POST['usuario'];
 $senha = md5($_POST['senha']);
 $ativo = 1;
 $cargo_id = $_POST['cargo_id'];
 $empresa_id = $_POST['empresa_id'];
 
 $pdo = Banco::conectar();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlPessoa = "insert into pessoa(nome, cpf, telefone, email, usuario, senha, ativo, cargo_id, empresa_id) values (:nome, :cpf, :telefone, :email, :usuario, :senha, :ativo, :cargo_id, :empresa_id)";
 $q = $pdo->prepare($sqlPessoa);


 $q->bindValue(":nome", $nome);
 $q->bindValue(":cpf", $cpf);
 $q->bindValue(":telefone", $telefone);
 $q->bindValue(":email", $email);
 $q->bindValue(":usuario", $usuario);
 $q->bindValue(":senha", $senha);
 $q->bindValue(":ativo", $ativo);
 $q->bindValue(":cargo_id", $cargo_id);
 $q->bindValue(":empresa_id", $empresa_id);

$result = $q->execute();
 
 Banco::desconectar();
 
 if($result){
     $response = array("success" => true);
     echo json_encode($response);
}
else{
    $response = array("success" => false);
    echo json_encode($response);
}
 ?>