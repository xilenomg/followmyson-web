<? 

class Data{
	
	/**
	 * converte datas para há x dias , ou x meses ou x anos
	 * @param $data = aaaa-mm-dd
	 * @author Luis Felipe
	 */
	static function simplificarData($data){
		$dataParam = strtotime($data);
		$dataAtual = time();
		$dias = ceil(($dataAtual - $dataParam)/86400)-1;
		
		
		if($dias == 0){
			return 'Hoje';
		}
		elseif($dias == 1){
			return 'Há 1 dia';
		}
		elseif($dias < 30){
			return 'Há '. $dias . ' dias';
		}
		elseif(round($dias / 30) == 1){
			return 'Há 1 mes';
		}
		elseif($dias / 30 < 12){
			return 'Há '. round($dias / 30) . ' meses';
		}
		elseif($dias / 30 / 12 == 1){
			return 'Há 1 ano';
		}
		else{
			return 'Há '.round($dias / 30 / 12). ' anos';
		}
		
	}
	
	/**
	 * Formata de Month/Day/Year para Year/month/day
	 * @param String $data
	 * @param string $separador
	 * @return string
	 */
	static function formatarDataBanco($data, $separador="-"){
		$data_formatada = @explode("/",$data);
		return $data_formatada[2].$separador.$data_formatada[0].$separador.$data_formatada[1];
	}	
	
	static function formatarDataMostrar($data, $separador="/"){
		$data_formatada = @explode("-",$data);
		return $data_formatada[2].$separador.$data_formatada[1].$separador.$data_formatada[0];
	}
	
	static function formatarDataCompletaMostrar($data, $separador = '-'){
		$data_formatada = @explode(" ",$data);
		return self::formatarDataMostrar($data_formatada[0]).' '.$separador.' '.self::formatarHora($data_formatada[1]);
	}
	
	static function formatarDataCompletaMostrarSemHora($data){
		$data_formatada = @explode(" ",$data);
		return self::formatarDataMostrar($data_formatada[0]);
	}
	
	static function formatarHora($hora){
		$hora = explode(":",$hora);
		return $hora[0].":".$hora[1];
	}
	
	static function validarData($data){
		if(strpos($data,"/")){
			$data = explode("/", $data);
			if(checkdate($data[1],$data[0],$data[2])){
				return true;
			}
			return false;
		}
		elseif(strpos($data,"-")){
			$data = explode("-", $data);
			if(checkdate($data[1],$data[2],$data[0])){
				return true;
			}
			return false;
		}
		else{
			return false;
		}
	}
	
	static function traduzirMes($mes){
		switch($mes){
			case 1: return 'Janeiro';
			break;
			case 2: return 'Fevereiro';
			break;
			case 3: return 'Março';
			break;		
			case 4: return 'Abril';
			break;
			case 5: return 'Maio';
			break;		
			case 6: return 'Junho';
			break;		
			case 7: return 'Julho';
			break;		
			case 8: return 'Agosto';
			break;		
			case 9: return 'Setembro';
			break;
			case 10: return 'Outubro';
			break;		
			case 11: return 'Novembro';
			break;		
			case 12: return 'Dezembro';
			break;		
			
			default: die("Mês inválido! <br/> Mês digitado: $mes");
		}
	}
	
	
	static function dataMaior($data1,$data2){
		// se data no formato DD/MM/AAAA então converte para AAAA-MM-DD
		
		if (strpos($data1, "-")){
			$aux = explode ("-", $data1);
			$data1 = date("Y-m-d",mktime(0,0,0,$aux[1],$aux[2],$aux[0]));
		}
		elseif (strpos($data1, "/")){
			$aux = explode ("/", $data1);
			$data1 = date("Y-m-d",mktime(0,0,0,$aux[1],$aux[0],$aux[2]));
			echo $data1;
		}
		// se data no formato DD/MM/AAAA então converte para AAAA-MM-DD
		if (strpos($data2, "-")){
			$aux = explode ("-", $data2);
			$data2 = date("Y-m-d",mktime(0,0,0,$aux[1],$aux[2],$aux[0]));
		}
		elseif (strpos($data2, "/")){
			$aux = explode ("/", $data2);
			$data2 = date("Y-m-d", mktime(0,0,0,$aux[1],$aux[0],$aux[2]));
			echo $data2;
		}
		
		// verifica se data1 é maior que data2
		if ($data1 >= $data2){
			return true;
		}
		else{
			return false;
		}
	}
	
	static function dateTimeMaior($data1,$data2){
		// se data no formato DD/MM/AAAA então converte para AAAA-MM-DD
		$data1 = $this->formataDataCompletaEN($data1);
		
		// se data no formato DD/MM/AAAA então converte para AAAA-MM-DD
		$data2 = $this->formataDataCompletaEN($data2);
		//die("");
		// verifica se data1 é maior que data2
		if ($data1 > $data2) return true;
		elseif ($data1 == $data2) return true;
		else return false;
	}
	
	static function dateAtualMaior($data,$atual){
		// se data no formato DD/MM/AAAA então converte para AAAA-MM-DD
		$data = $this->formataDataCompletaEN($data);
		
		
		// verifica se data1 é maior que data2
		if ($atual >= $data) return true;
		else return false;
	}
	
	/*****/
}
