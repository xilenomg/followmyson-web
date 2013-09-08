<?
/********************************
Arquivo imagem.php

Classe PHP para tratamentos com imagens.

Criado por: Luis Felipe Corr�a P�rez
********************************/
	if(!class_exists("Imagem")){
		
		class Imagem{
			##########################################################################################################
			# IMAGE FUNCTIONS																						 #
			# You do not need to alter these functions																 #
			##########################################################################################################
			function resizeImage($image,$width,$height,$scale) {
				list($imagewidth, $imageheight, $imageType) = getimagesize($image);
				$imageType = image_type_to_mime_type($imageType);
				$newImageWidth = ceil($width * $scale);
				$newImageHeight = ceil($height * $scale);
				$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
				switch($imageType) {
					case "image/gif":
						$source=imagecreatefromgif($image);
						break;
					case "image/pjpeg":
					case "image/jpeg":
					case "image/jpg":
						$source=imagecreatefromjpeg($image);
						break;
					case "image/png":
					case "image/x-png":
						$source=imagecreatefrompng($image);
						break;
				}
				imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
			
				switch($imageType) {
					case "image/gif":
						imagegif($newImage,$image);
						break;
					case "image/pjpeg":
					case "image/jpeg":
					case "image/jpg":
						imagejpeg($newImage,$image,90);
						break;
					case "image/png":
					case "image/x-png":
						imagepng($newImage,$image);
						break;
				}
			
				chmod($image, 0777);
				return $image;
			}
			//You do not need to alter these functions
			function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
				list($imagewidth, $imageheight, $imageType) = getimagesize($image);
				$imageType = image_type_to_mime_type($imageType);
			
				$newImageWidth = ceil($width * $scale);
				$newImageHeight = ceil($height * $scale);
				$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
				switch($imageType) {
					case "image/gif":
						$source=imagecreatefromgif($image);
						break;
					case "image/pjpeg":
					case "image/jpeg":
					case "image/jpg":
						$source=imagecreatefromjpeg($image);
						break;
					case "image/png":
					case "image/x-png":
						$source=imagecreatefrompng($image);
						break;
				}
				imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
				switch($imageType) {
					case "image/gif":
						imagegif($newImage,$thumb_image_name);
						break;
					case "image/pjpeg":
					case "image/jpeg":
					case "image/jpg":
						imagejpeg($newImage,$thumb_image_name,90);
						break;
					case "image/png":
					case "image/x-png":
						imagepng($newImage,$thumb_image_name);
						break;
				}
				chmod($thumb_image_name, 0777);
				return $thumb_image_name;
			}
			//You do not need to alter these functions
			function getHeight($image) {
				$size = getimagesize($image);
				$height = $size[1];
				return $height;
			}
			//You do not need to alter these functions
			function getWidth($image) {
				$size = getimagesize($image);
				$width = $size[0];
				return $width;
			}
			
			function createThumbnail($imagePath, $x1, $y1, $x2, $y2, $qualidade=95){
				// GD Function List
			    $gdExtensions = array (
				    'jpg'=>'jpeg',
		    		'jpeg'=>'jpeg',
				    'gif'=>'gif',
				    'bmp'=>'wbmp',
				    'png'=>'png'
			    );
			    
			    $extension = strtolower(substr($imagePath, -3));
			    list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($imagePath);
			 
			    $check = false;
			 
			    $gdExtension = $gdExtensions[$extension];
			    $function_to_read = "imagecreatefrom".$gdExtension;
			    $function_to_write = "image".$gdExtension;
			 
			    // Read the source file
			    $source_handle = $function_to_read($imagePath);
			 
			    if ( $source ) {
			    	
			    	
			        // Create a blank image
			        $destination_handle = imagecreatetruecolor($x2-$x1, $y2-$y1);
			 
			        // Put the cropped area onto the blank image
			        $check = imagecopyresampled($destination_handle, $source_handle, 0, 0, $x1, $y1, $thumbWidth, $thumbHeight, $w, $h);
			    }
			 
			    // Save the image
			    $function_to_write($destination_handle, $newFilename);
			    ImageDestroy($destination_handle);
			 
			    // Check for any errors
			    if ($check){
			    	return true;
			    }
			    return false;
			
			}
			
			
			
			function getAltura($imagem, $largura){
				$tamanho = getimagesize($imagem);
				$proporcao = $tamanho[1]*$largura/$tamanho[0];
				$proporcao = number_format($proporcao,2);
				return $proporcao;
			}
			
			function getLargura($imagem, $altura){
				$tamanho = getimagesize($imagem);
				//d w540 x h300
				//p w300? x h166
				$proporcao = $tamanho[0]*$altura/$tamanho[1];
				$proporcao = number_format($proporcao,2);
				return $proporcao;
			}
			
			function geraMiniatura($imagem,$largura, $altura, $qualidade=100){
				
				// GD Function List
				$gdExtensions = array (
						'jpg'=>'jpeg',
						'jpeg'=>'jpeg',
						'png'=>'png'
				);
				
				$extension_array = explode('.', $imagem);
				$extension = $extension_array[sizeof($extension_array) - 1];
				
				if ( !array_key_exists($extension, $gdExtensions) ){
					return null;
				}
				
				$gdExtension = $gdExtensions[$extension];
				
				$function_to_read = "imagecreatefrom".$gdExtension;
	    		$function_to_write = "image".$gdExtension;
				
				$tamanho = getimagesize($imagem);
				if($largura<$tamanho[0] || $altura<$tamanho[1]){
					
					//NOME DO ARQUIVO DA MINIATURA
					$imagem_gerada = $imagem;
					
					//CRIA UMA NOVA IMAGEM
					$imagem_orig = $function_to_read($imagem);
					
					//LARGURA
					$pontoX = imagesx($imagem_orig);
					
					//ALTURA
					$pontoY = imagesy($imagem_orig); 
					
					//CRIA O THUMBNAIL
					$imagem_fin = imagecreatetruecolor($largura, $altura); 
					
					//COPIA A IMAGEM ORIGINAL PARA DENTRO
					imagecopyresampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY); 
					
					//SALVA A IMAGEM
					if ( $gdExtension == 'jpeg' || $gdExtension == 'png'){
						$function_to_write($imagem_fin, $imagem_gerada, $qualidade);
					}
					else{
						$function_to_write($imagem_fin, $imagem_gerada);						
					} 
					
					//LIBERA A MEM�RIA
					imagedestroy($imagem_orig);
					imagedestroy($imagem_fin);
					
				}
				return true;
			}
			
	
			
			function getExtensao($nome){
				return substr($nome, $nome-4);
			}
			
			function fazParteMiniatura($imagem, $largura, $altura, $qualidade=95){
				//NOME DO ARQUIVO DA MINIATURA
				$imagem_gerada = $imagem;
				//CRIA UMA NOVA IMAGEM
				$imagem_orig = @imagecreatefromjpeg($imagem);
				//LARGURA
				$pontoX = @imagesx($imagem_orig);
				//ALTURA
				$pontoY = @imagesy($imagem_orig); 
				//CRIA O THUMBNAIL
				$imagem_fin = @imagecreatetruecolor($largura, $altura); 
				//COPIA A IMAGEM ORIGINAL PARA DENTRO
				//@imagecopyresampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura_m+1, $altura_m+1, $pontoX, $pontoY);
				$src_x = ($pontoX/2)-($largura/2);
				$src_y = ($pontoY/2)-($altura/2);
				@imagecopyresampled($imagem_fin,$imagem_orig,0,0,$src_x,$src_y,$pontoX,$pontoY,$pontoX,$pontoY);
				//SALVA A IMAGEM
				@imagejpeg($imagem_fin, $imagem_gerada, $qualidade); 
				
				//LIBERA A MEM�RIA
				@imagedestroy($imagem_orig);
				@imagedestroy($imagem_fin);
		
			}
		}
		$objImagem = new Imagem();
	}
?>