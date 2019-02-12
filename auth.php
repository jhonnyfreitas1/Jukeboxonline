<?php 
	$nome = $_POST['nome'];
	$senha = $_POST['senha'];

	include "conection_bd.php";

	$stmt = $conn -> prepare("SELECT id_user from users where name_user = ? and user_pass = ?");
	$stmt -> bindValue(1, $nome);
	$stmt -> bindValue(2, $senha);
	$stmt -> execute() ;
	$resultado = $stmt -> fetch();
	if ($resultado[0] != null) {
		session_start();
		$_SESSION['user_id'] = $resultado[0];	
		$_SESSION['nome_user'] = $nome;
		header("location:index.php");

	}else{
		echo "nao existe";
	}
?>