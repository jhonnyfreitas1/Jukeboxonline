<?php
$palavra = $_POST['arquivo'];
$numero = 0; // não alterar
$diretorio = "music"; // diretório para a busca
// *.* é todos arquivos de todas extensões do diretório
foreach (glob("$diretorio/*.*") as $arquivo) {
	$separa = explode("/", $arquivo);
	if(strstr($separa[1], $palavra)==TRUE) {
	

	echo $separa[1]."<br>";	

}
}

?>