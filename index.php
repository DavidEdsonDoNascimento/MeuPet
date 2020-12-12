<?php 

include_once('cabecalho.php'); 
 
if(empty($_SESSION['usuario']))
    header('location:login.php');
?>
<?php include_once('rodape.php'); ?>