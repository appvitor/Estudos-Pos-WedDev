<?php
	
	$pessoa = new stdClass();
	$pessoa->nome = "Luiz Henrique";
	$pessoa->idade = 25;
	$pessoa->cidade = "Maringa";

	echo json_encode($pessoa);

	

	

?>