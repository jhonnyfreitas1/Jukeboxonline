<?php
session_start();
include 'conection_bd.php';
$id = $_POST['id'];

	$stmt = $conn -> prepare("DELETE FROM musics WHERE id_music=?");
	$stmt -> bindValue(1,$id); 
	$result = $stmt -> execute();
	
	echo "true";