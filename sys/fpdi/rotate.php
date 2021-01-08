<?php
/**
 * This file is part of FPDI
 *
 * @package   FPDI_ROTATE
 * @copyright Copyright (c) 2016 Breno Cruvinel - breno.cruvinel09@gmail.com
 * @version   1.0
 * @rotacionar itens de impressão
 */

class PDF_Rotate extends FPDI // erweitert FPDI 
	{ 
	var $angle=0; 
	
	function Rotate($angle,$x=-1,$y=-1) 
	{ 
		if($x==-1) 
		$x=$this->x; 
		if($y==-1) 
		$y=$this->y; 
		if($this->angle!=0) 
		$this->_out('Q'); 
		$this->angle=$angle; 
		if($angle!=0) 
		{ 
			$angle*=M_PI/180; 
			$c=cos($angle); 
			$s=sin($angle); 
			$cx=$x*$this->k; 
			$cy=($this->h-$y)*$this->k; 
			$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy)); 
		} 
	} 
	
	function _endpage() 
	{ 
		if($this->angle!=0) 
		{ 
			$this->angle=0; 
			$this->_out('Q'); 
		} 
		parent::_endpage(); 
	} 
} 

class FPDI_ROTATE extends PDF_Rotate { 
	function RotatedText($x,$y,$txt,$angle) 
	{ 
		//Text rotated around its origin 
		$this->Rotate($angle,$x,$y); 
		$this->Text($x,$y,$txt); 
		$this->Rotate(0); 
	} 
	
	function RotatedImage($file,$x,$y,$w,$h,$angle) 
	{ 
		//Image rotated around its upper-left corner 
		$this->Rotate($angle,$x,$y); 
		$this->Image($file,$x,$y,$w,$h); 
		$this->Rotate(0); 
	} 
} 