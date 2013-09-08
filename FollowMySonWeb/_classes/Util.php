<?php

class Util{
	
	public static function redirect($url){
		header( 'Location: ' . $url );
		exit;
	}
	
	public static function createImageUrl($imageName){
		return Util::generateImagePath($imageName);
	}
	
	public static function createImagePath($imageName){
		return PATH. Util::generateImagePath($imageName);
	}
	
	public static function generateImagePath($imageName){
		$length = strlen($imageName);
		$path = '/_uploads/news/';
	
		$imageNameLength = strlen(substr($imageName,-4));
		for ($i = 0; $i < $imageNameLength && $i < 1; $i++ ){
			$path .= $imageName[$i] .'/';
		}
		return $path;
	}
	
	public static function isAjax(){
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }
    
	public static function removeAccents($string)
	{
		$a = array(
					"/[ВАБДГ]/"	=>"A",
					"/[вгабд]/"	=>"a",
					"/[КИЙЛ]/"	=>"E",
					"/[кийл]/"	=>"e",
					"/[ОНМП]/"	=>"I",
					"/[онмп]/"	=>"i",
					"/[ФХТУЦ]/"	=>"O",
					"/[фхтуц]/"	=>"o",
					"/[ЫЩЪЬ]/"	=>"U",
					"/[ыъщь]/"	=>"u"
				);
		return preg_replace(array_keys($a), array_values($a), $string);
	}
	
	public static function createDNS($s)
	{
		$s = ereg_replace("[БАВГДбавгЄд]","a",html_entity_decode($s));
		$s = ereg_replace("[ЙИКЛйикл]","e",$s);
		$s = ereg_replace("[утфхцєЦУТФХ]","o",$s);
		$s = ereg_replace("[ъщыьЪЩЫЬ]","u",$s);
		$s = ereg_replace("[нНопП]","i",$s);
		$s = str_replace("з","c",$s);
		$s = str_replace("З","c",$s);
		$s = ereg_replace(" ", "-",$s);
		$s = ereg_replace("-.-", "-",$s);
		$s = ereg_replace("&", "e",$s);
		$s = strtolower($s);
		while(ereg("--",$s)==TRUE)
			$s = str_replace("--", "-",$s);
			
		if (substr($s,-1)=="-")
			$s=substr($s,0,-1);
		$s = ereg_replace("[^a-z0-9_-]", "",$s);

		if(strlen($s)==0)
			return 'x';
		else
			return $s;
	}
	
	
	
	function sendEmail($para_nome, $para_email, $assunto, $conteudo){
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		
		try {
		  $mail->Host       = "mail.robbreport.com.br"; // SMTP server
		  $mail->SMTPAuth   = true;                  // enable SMTP authentication
		  $mail->Username   = "robbreport@robbreport.com.br"; // SMTP account username
		  $mail->Password   = "n40r35p0nd4";        // SwebMTP account password
		  $mail->AddAddress($para_email, $para_nome);
		  $mail->From		= 'robbreport@robbreport.com.br';
		  $mail->FromName	= 'Robb Report';
		  $mail->Subject = $assunto;
		  $mail->AltBody = strip_tags($conteudo);
		  $mail->Body	= $conteudo;
		  $mail->Send();
		 
		} catch (phpmailerException $e) {
		  echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
		  echo $e->getMessage(); //Boring error messages from anything else!
		}
	}


}
	



?>