<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
include "../../config/globalSession.php";//inicia sessao php
//session_start("irmaos");
/*
* Versão: 3
*/
class fCaptchaSeg {
	//vars
	var $sysFontArr = array('./text0.dat','./text1.dat','./text2.dat','./text3.dat','./text4.dat');//caminho do arquivo de fonte: .ttf
	var $sysFontTM = 0.45;
	var $sysWidth;
	var $sysHeight;
	var $sysCharacters;
	var $sysLegenda;
	var $sysColorBG = "#FFFFFF";//cor do fundo
	var $sysColorRuido = "#DBDBEA";//cor do ruido
	var $sysColorLinhas = "#444";//cor do linhas
	var $sysColorText = "#444";//cor do texto
	
    public function __construct($width='120',$height='40',$characters='6',$legenda='') {
		$this->sysWidth = $width;
		$this->sysHeight = $height;
		$this->sysCharacters = $characters;
		$this->sysLegenda = $legenda;
	}
	
    public function setFont() {
		$this->sysFont = $this->sysFontArr[rand(0,4)];
	}	
	
    public function exibirImagem() {
		$code = $this->setFont();
		$code = $this->generateCode();
		$arrCorBG = $this->hex2RGB($this->sysColorBG);
		$arrCorRuido = $this->hex2RGB($this->sysColorRuido);
		$arrCorLinhas = $this->hex2RGB($this->sysColorLinhas);
		$arrCorText = $this->hex2RGB($this->sysColorText);
		/* font size will be 75% = 0.75 of the image height */
		$font_size = $this->sysHeight * $this->sysFontTM;
		$image = @imagecreate($this->sysWidth, $this->sysHeight) or die('Cannot initialize new GD image stream');	
		/* set the colours RGB */
		$background_color = imagecolorallocate($image, $arrCorBG["red"], $arrCorBG["green"], $arrCorBG["blue"]);
		$text_color = imagecolorallocate($image, $arrCorText["red"], $arrCorText["green"], $arrCorText["blue"]);
		$noise_color = imagecolorallocate($image, $arrCorRuido["red"], $arrCorRuido["green"], $arrCorRuido["blue"]);
		/* generate random dots in background */
		for( $i=0; $i<($this->sysWidth*$this->sysHeight)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$this->sysWidth), mt_rand(0,$this->sysHeight), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($this->sysWidth*$this->sysHeight)/150; $i++ ) {
			imageline($image, mt_rand(0,$this->sysWidth), mt_rand(0,$this->sysHeight), mt_rand(0,$this->sysWidth), mt_rand(0,$this->sysHeight), $noise_color);
		}
		//gerar linhas no fundo
		$line_color = imagecolorallocate($image, $arrCorLinhas["red"], $arrCorLinhas["green"], $arrCorLinhas["blue"]); 
		for($i=0;$i<10;$i++) {
			imageline($image,0,rand()%50,$this->sysWidth,rand()%50,$line_color);
		}		
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->sysFont, $code) or die('Error in imagettfbbox function');
		$x = ($this->sysWidth - $textbox[4])/rand(1,10);
		$y = ($this->sysHeight - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->sysFont , $code) or die('Error in imagettftext function');
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$_SESSION["codigo_SEG_".$this->sysLegenda] = $code;
		$_SESSION["time_SEG_".$this->sysLegenda] = time();
	}

	private function generateCode() {
		/* list all possible characters, similar looking characters and vowels have been removed */
//		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$possible = '1234567890';
		$code = '';
		$i = 0;
		while ($i < $this->sysCharacters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}	

	private function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {//array(3) { ["red"]=> int(255) ["green"]=> int(0) ["blue"]=> int(0) }
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
		$rgbArray = array();
		if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations

			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false; //Invalid hex color code
		}
		return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
	}

}//fCaptchaSeg

//verifica os tamanhos
$width = isset($_GET['width']) ? $_GET['width'] : '120';
$height = isset($_GET['height']) ? $_GET['height'] : '40';
$characters = isset($_GET['characters']) && $_GET['characters'] > 1 ? $_GET['characters'] : '6';
$legenda = isset($_GET['id_leg']) ? $_GET['id_leg'] : 'faisher';

//verifica se nao e muito grande
if($width > "300"){ $width = "300"; }
if($height > "300"){ $height = "300"; }
if($characters > "20"){ $characters = "20"; }

//gera imagem
$CASS["captcha"] = new fCaptchaSeg($width,$height,$characters,$legenda);
$CASS["captcha"]->exibirImagem();
