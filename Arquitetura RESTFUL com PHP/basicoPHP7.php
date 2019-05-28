<?php
	$lista = array(
		'nome'=>'Luiz', 
		'idade' => 30, 
		'cidade' => 'Maringa'
	);

	$frase ='Ola PHP!';

	echo json_encode($frase);
	json_decode($frase);
	echo '<br>';
	var_dump($frase);

	//$pessoa = new stdClass(); //standard Class, uma classe genérica
	class Pessoa{
		public $nome;
		public $idade;
		public $cidade;
	}

	$pessoa = new Pessoa();
	$pessoa->nome = 'Luiz Henrique';
	$pessoa->idade = 25;
	$pessoa->cidade = 'Maringa';
	echo json_encode($pessoa);
	echo '<br>';
	var_dump($pessoa);

	$pessoa1 = new Pessoa();
	$pessoa1->nome = 'Paulo';
	$pessoa1->idade = 25;
	$pessoa1->cidade = 'Maringa';

	$pessoa2 = new Pessoa();
	$pessoa2->nome = 'Mateus';
	$pessoa2->idade = 13;
	$pessoa2->cidade = 'Maringa';

	$pessoas = array();
	$pessoas[] = $pessoa1;
	$pessoas[] = $pessoa2;

	echo json_encode($pessoas);
?>