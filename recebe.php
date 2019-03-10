<?php 
session_start();
	include "conection_bd.php";
$nome = explode('-',$_POST['titulo']);
$mp3 = $_POST['mp3'];
$id = $_POST['id_sala'];
	

	$stmt1 = $conn -> query("SELECT COUNT(id_music)
	FROM musics where fk_sala_id=".$id); 
	$stmt1 -> execute();
	$result2 = $stmt1 -> fetch();
	 $numero = intval($result2[0])+1;
	 
	 $stmt = $conn -> prepare("INSERT INTO musics(title,artist,ordem,fk_id_user,fk_sala_id,mp3) VALUES (?,?,?,?,?,?)");
	 $stmt ->bindValue(1, $nome[1]);
	 $stmt ->bindValue(2, $nome[0]);
	 $stmt ->bindValue(3, $numero);
	 $stmt ->bindValue(4, $_SESSION['user_id']);
	 $stmt ->bindValue(5, $id);
	 $stmt ->bindValue(6, $mp3);
	$result = $stmt -> execute();

