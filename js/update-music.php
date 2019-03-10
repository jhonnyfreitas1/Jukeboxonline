<?php
include 'conection_bd.php';
$id = $_GET['id'];
	echo "o id é".$id;

	$stmt = $conn ->prepare("DELETE FROM musics WHERE id=?");
	$stmt -> bindValue(1,$id); 
	$result = $stmt -> execute();
	if ($result == true){
		echo $result;
	}else{
		echo  "deu erro";
	}