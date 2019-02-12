<?php 
session_start()

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
 		$nome = base64_decode($_GET['nms']);
 		echo "<script>document.title ='Sala: ".$nome."'</script>";
		$id =  base64_decode($_GET['singlenumber']);
	

	?>

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
           // response =  JSON.parse(response);
            var response = response;
    

       		document.getElementById('results-music').innerHTML = 
       		"<a id='musicas'>"+response+"</a>";
           	console.log(response);
           	
            } 	
        });
    });
</script>
</html>