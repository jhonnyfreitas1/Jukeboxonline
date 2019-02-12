<?php 
$nome = $_POST['nome'];
$senha = $_POST['senha'];
include 'conection_bd.php';

$stmt = $conn -> prepare('insert into users (name_user ,user_pass) values (?,?)');
$stmt->bindValue(1, $nome);
$stmt -> bindParam(2,$senha);
$stmt -> execute();

	if ($stmt == true) {

		header("location:index.php");
	}else{
		echo "<script> alert('erro ai no baguljh');</script>";
	}
?>