<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery-ui.css">
    <link href="css/estilo.css" rel="stylesheet"/>	    
    <link href="css/datatables.min.css" rel="stylesheet"/>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/datatables.min.js"></script>
	<style>
		.dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu a::after {
            transform: rotate(-90deg);
            position: absolute;
            right: 6px;
            top: .8em;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-left: .1rem;
            margin-right: .1rem;
        }
	</style>
</head>
<body class="background">

<?php include_once('menu.php'); ?>

<div class="container" style="padding: 15px">