<?php 
session_start();
	if (isset($_SESSION['user_id'])){
		$nome_sala = $_POST['nome_sala'];

		include 'conection_bd.php';

		$stmt =$conn -> prepare('INSERT INTO room (name_room,user_id) values (?,?)');
		$stmt -> bindValue(1, $nome_sala);
		$stmt -> bindValue(2, $_SESSION['user_id']);
		var_dump($result = $stmt -> execute());
		
		$stmt1 = $conn -> query("SELECT LAST_INSERT_ID()");
			$stmt1 -> execute();
		$var = $stmt1 ->fetch();
			
		header('location:sala.php?nms='.base64_encode($nome_sala)."&singlenumber=".base64_encode($var[0]));
	}
?>