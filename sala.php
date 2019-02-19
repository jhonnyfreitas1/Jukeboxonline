<?php 
session_start();
if (isset($_SESSION['user_id'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title> </title>
	<link rel="stylesheet" type="text/css" href="music.css">
</head>
<h1>Bem vindo a sua sala <?php echo  $_SESSION['nome_user']; ?></h1>
<hr>
<body>
	<form action="buscar.php" method="POST" id="form">
	buscar arquivos com... <input type="text" id="texto" name="arquivo" value="">
	<input type="submit" name="busca" id="btn1">
	</form>
	
	<div id="results-music" style="border-style: outset;border-width:5px; width: 300px; height:400px; float: left; margin-top: 20px;" >
		resultados 
	</div>

	<div id="fila-music" style="border-style: outset;border-width:5px; width: 300px; height:400px; float: right; margin-top: 20px;">
		
	</div>
	<?php 
 		$id =  base64_decode($_GET['singlenumber']);
 		include 'conection_bd.php';
		$stmt = $conn -> prepare('SELECT theme_room FROM room where id_room = ?');
		$stmt -> bindValue(1, $id);
		$stmt -> execute();
		$var = $stmt -> fetch(PDO::FETCH_ASSOC);
 		$nome = base64_decode($_GET['nms']);

 		echo "<script>document.title ='Sala: ".$nome."'
			document.body.style.backgroundColor ='".$var['theme_room'].
 		"'</script>";
		
		
		
		
	?>
	 <center><a href="index.php">Sair</a> </center>
</body>
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
	 $('#form').on('submit', function(e){
            e.preventDefault();
            var that = this;
            var arquivo = $('#form input[name="arquivo"').val();
      
            $.ajax({
            type:'POST',
            url:'buscar.php',
            datatype:'json',
            data:{arquivo:arquivo},
            success: function(response){
         
       		document.getElementById('results-music').innerHTML = 
       		"<table id='musicas'>"+response+"</table>";
           	console.log(response);
           	
            } 	
        });
    }); 
</script>
</html>
<?php } else 
{	echo "<script> alert('se loga ai mane');</script>";
	header('location:index.php');
}
?>