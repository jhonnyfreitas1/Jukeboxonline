<?php
$palavra = $_POST['arquivo'];
$numero = 0; // não alterar
$diretorio = "music"; // diretório para a busca
// *.* é todos arquivos de todas extensões do diretório
	
foreach (glob("$diretorio/*.*") as $arquivo) {
	$separa = explode("/", $arquivo);
	if(strstr($separa[1], $palavra)==TRUE) {
		
	echo "<li><button id='retorno' class='retorno'  onclick='teste(this)' value='".$separa[1]."'>".substr_replace($separa[1],'', -4)."</button></li>";

}
}
if (strstr($separa[1], $palavra)!=TRUE) {
	echo "Nada encontrado";

} 

?>