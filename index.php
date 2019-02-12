</!DOCTYPE html>
<html>
	<head>
		<title>Jukebox online</title>
	</head>
	<body>
		<?php
			session_start();
		   	if($_SESSION['user_id'] != null){
			?>
				<div id="header" style="">
					<p><b>Bem vindo <?php echo"seu id é ".$_SESSION['user_id'];?> </b></p>
							<b><h4>Crie uma sala</h4></b>
						<form action="action_room.php" method="post">
							<b><h4><label>Nome da sala</label></b>
							<input type="text" name="nome_sala" placeholder="Ex..Festa das amigas">
							<input type="submit" value='enviar' name="">

						</form>

					<hr>
				</div>




		<?php }else {?>

					<div id="header" style="">
						<p><b>Logue-se</b></p>
						<hr>
						<form action="auth.php" method="post">
							<label>Nome/Apelidio</label>
							<input type="text" name="nome">
							<label>Senha</label>
							<input type="password" name="senha">
							<input type="submit" name="Logar" style="background-color: black; 
								color: #ffff;">
						</form>
						<b>Ou</b>
						 <a href="cadastre.php">Inscreva-se</a>
						<hr>
					</div>

			<?php }?>
		<h1>Salas disponiveis</h1>
		<div style="min-height: 40em; background-color: red; margin-left:6em; margin-right:6em;" id="sala">
				<?php 
					include "conection_bd.php";
				$stmt = $conn -> query("select name_room,id_room from room");
				$stmt -> execute();
				$result = $stmt-> fetchall(PDO::FETCH_ASSOC);
			
				foreach($result as $resultados) {
				
					echo  "<li><table border='1' id = 'salas'><tr><td><a href=''> ".$resultados['name_room']."</a></tr></td></table></li>";

				}

			?>

		</div>	



	</body>
	<script type="text/javascript">
		

	</script>

<style type="text/css">
	#salas{
		height:5em;
		margin:10px;
		min-height: 5em;
		min-width: 7em;
		text-align: center;
		margin-right: 0px;
		
	}
	#salas_click{

	}li{
		display: inline-block;
	}

</style>
</html>