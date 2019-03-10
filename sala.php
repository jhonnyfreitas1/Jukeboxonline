<?php 
session_start();
if (isset($_SESSION['user_id'])){
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/default.css"/>
		<title> </title>
		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="/js/plugins/jplayer/jquery.jplayer.min.js"></script>
		<script type="text/Javascript" src="/js/default.js">
		

		</script>
		<script type="text/Javascript" src="/js/teste.js">
		

		</script>
		<link rel="stylesheet" type="text/css" href="music.css">
	</head>
	<h2>Bem vindo a sua sala <?php echo  $_SESSION['nome_user']; ?></h2>
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
		
	    <div class="top-bar">
	         <div class="container">
	             <div class="player-controls">
	                 <span class="player-prev">Prev</span>
	               	 <span class="player-play">Play</span>
	                 <span class="player-pause">Pause</span>
	                 <span class="player-stop">Stop</span>
	                 <span class="player-next">Next</span>
	             </div>

	             <div class="player"></div>
	             <div class="player-timeline">
	                 <div class="player-timeline-control"></div>
	             </div>
	             <div class="player-display">
	                 Playing: <span class="player-current-track"></span>
	             </div>
	         </div>
	    </div>
</body>
  <?php
        $stmt1 = $conn -> prepare("SELECT title,artist,mp3,id_music from musics where fk_sala_id = ? order by ordem");
        	$stmt1-> bindValue(1,$id); 
        	$stmt1 -> execute();
        	$result = $stmt1 -> fetchall(PDO::FETCH_ASSOC);
        		//var_dump($result);
 		var_dump($result);

	       
	      // for ($i=0; $i <=sizeof($result); $i++) {
	       	
	      //  	$playlist = $playlist +  array(
	      //  		  array(
	      //  		'artist' => $result[$i]['artist'],
	      //  		'title' => $result[$i]['nome_musica'],
	      //  		'mp3' => $result[$i]['mp3'].".mp3"
	      //  	 )

	      //  	);
	       			 
	       			 	
	       			 				 	
    /*$playlist = array (
        array (
            "artist" => 'PH Daft Punk',
            "title" => 'Technologic',
            "mp3" => 'songs/technologic.mp3',
        ), array (
            "artist" => 'Daft Punk',
            "title" => 'Human After All',
            "mp3" => 'songs/human-after-all.mp3',
        )*/
       
        ?>	

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
	 	function teste(e){
	 		 
             var value = e;
             var titulo = value.innerHTML;
             var artista = 'default';
             var mp3 = "music/"+value.value;
             $.ajax({
                type:'POST',
                url:'recebe.php',
                datatype:'json',
                data:{titulo:titulo,artista:artista,mp3:mp3,id_sala:<?php echo $id;?>},
                success: function(response){
                    alert(response);
                }
             });
        

	 	}


	 	var playlist = <?= json_encode($result); ?>;
        
	</script>
</html>
<?php } else 
{	echo "<script> alert('se loga ai mane');</script>";
	header('location:index.php');
}
?>