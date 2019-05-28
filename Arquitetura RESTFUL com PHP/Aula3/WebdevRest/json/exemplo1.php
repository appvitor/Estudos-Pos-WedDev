<?php

	//JSON ENCODE
	$lista = array(
		"nome"=>"Luiz",
		"idade" => 30,
		"cidade" => "Maringa"
	);

	echo json_encode($lista);

	//JSON DECODE
	$json = '{"nome":"Luiz","idade":30,"cidade":"Maringa"}';
	$lista = json_decode($json, true);
	var_dump($lista);


?>