<?php

class Checkup{

	//Construtor
	function Checkup(){
	}
	
	//cria hash sha1 com dados do usuario
	static function criar($dados){
		$checkup = '';
				
		foreach($dados as $chave => $valor){
			$checkup .= $valor.'&';
		}
		$checkup = substr($checkup, 0, -1);
		
		return sha1($checkup);
		
	}
	
	static function validar($dados, $checkup){
		
		$novo_checkup = self::criar($dados);
		
		if($novo_checkup == $checkup){
			return true;
		}
		return false;
	}
}
?>