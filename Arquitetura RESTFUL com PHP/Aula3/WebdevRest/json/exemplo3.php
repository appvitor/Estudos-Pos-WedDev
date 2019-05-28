<?php
	
	$pessoa1 = new stdClass();
	$pessoa1->nome = "Luiz Henrique";
	$pessoa1->idade = 25;
	$pessoa1->cidade = "Maringa";
	
	$pessoa2 = new stdClass();
	$pessoa2->nome = "Maria da Silva";
	$pessoa2->idade = 39;
	$pessoa2->cidade = "Curitiba";

	$pessoas = array();
	$pessoas[] = $pessoa1;
	$pessoas[] = $pessoa2;

	echo json_encode($pessoas);
	

	

?>