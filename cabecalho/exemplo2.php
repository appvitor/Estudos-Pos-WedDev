<?php
	
	$url = "http://viacep.com.br/ws/01001000/json/";
    $ch  = curl_init($url);

    curl_setopt($ch, CURLOPT_HTTPHEADER,array(    
        "Accept: application/json"
    ));
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resultado = curl_exec($ch);
    curl_close($ch);
    
    $cep = json_decode($resultado);
    var_dump($cep);




	

	

?>