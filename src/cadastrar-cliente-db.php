<?php
    session_start();
    require_once('DAO/banco.php');
    //echo $_SESSION['empresa_id'];

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $ativo = true;
    $cargo_id = 2; // cargo_id = 2 que é o cargo de cliente
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into pessoa(nome, cpf, telefone, usuario, senha, ativo, cargo_id, empresa_id) values (:nome, :cpf, :telefone, :usuario, :senha, :ativo, :cargo_id, :empresa_id)";
    $q = $pdo->prepare($sql);
    
    $q->bindValue(":nome", $nome);
    $q->bindValue(":cpf", $cpf);
    $q->bindValue(":telefone", $telefone);
    $q->bindValue(":usuario", $usuario);
    $q->bindValue(":senha", $senha);
    $q->bindValue(":ativo", $ativo);
    $q->bindValue(":cargo_id", $cargo_id);
    $q->bindValue(":empresa_id", $_SESSION['empresa_id']);

    $result = $q->execute();
    Banco::desconectar();
    
    if($result){
        header('location:../sucesso.php');
    }else{
        header('location:../erro.php');
    }

?>