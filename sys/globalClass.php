<?php 

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

############## INICIO - CLASSES ###########>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>






//inicio classe monta MENU PRINCIPAL ------------------------------------------------------------------------------->

//classe monta MENU PRINCIPAL
class  classMENU{ //***************************************************************************************************************@
	//VARS  ------------------------------------------------------------------->>>>
	private $arrayMENU_ID;
	private $arrayMENU_LIST;
	private $arrayItemMENU_ID;
	private $arrayItemMENU_LIST;
	private $arrayItemSUBMENU_ID;
	private $arrayItemSUBMENU_LIST;
	private $arrayItemSUBMENUEXTRA_ID;
	private $arrayItemSUBMENUEXTRA_LIST;
	
	//SET GET VARS ------------------------------------------------------------>>>>
	private function setArrayMENU_ID($var){				$this->arrayMENU_ID = $var; }//seta array interno
	private function setArrayMENU_LIST($var){			$this->arrayMENU_LIST = $var; }//seta array interno
	private function setArrayItemMENU_ID($var){			$this->arrayItemMENU_ID = $var; }//seta array interno
	private function setArrayItemMENU_LIST($var){		$this->arrayItemMENU_LIST = $var; }//seta array interno
	private function setArrayItemSUBMENU_ID($var){		$this->arrayItemSUBMENU_ID = $var; }//seta array interno
	private function setArrayItemSUBMENU_LIST($var){	$this->arrayItemSUBMENU_LIST = $var; }//seta array interno
	private function setArrayItemSUBMENUEXTRA_ID($var){	$this->arrayItemSUBMENUEXTRA_ID = $var; }//seta array interno
	private function setArrayItemSUBMENUEXTRA_LIST($var){$this->arrayItemSUBMENUEXTRA_LIST = $var; }//seta array interno
	
	public function getArrayMENU_ID(){				return $this->arrayMENU_ID; }//resgata array
	public function getArrayMENU_LIST(){			return $this->arrayMENU_LIST; }//resgata array
	public function getArrayItemMENU_ID(){			return $this->arrayItemMENU_ID; }//resgata array
	public function getArrayItemMENU_LIST(){		return $this->arrayItemMENU_LIST; }//resgata array
	public function getArrayItemSUBMENU_ID(){		return $this->arrayItemSUBMENU_ID; }//resgata array
	public function getArrayItemSUBMENU_LIST(){		return $this->arrayItemSUBMENU_LIST; }//resgata array
	public function getArrayItemSUBMENUEXTRA_ID(){	return $this->arrayItemSUBMENUEXTRA_ID; }//resgata array
	public function getArrayItemSUBMENUEXTRA_LIST(){return $this->arrayItemSUBMENUEXTRA_LIST; }//resgata array
	
	
	
	//METODOS ----------------------------------------------------------------->>>>
	
	//adiciona menu
	public function addMENU($idM,$tituloM,$tituloiMinM){
		$aMENU_ID = $this->getArrayMENU_ID();
		$aMENU_LIST = $this->getArrayMENU_LIST();
		$aMENU_ID[] = $idM;
		$aMENU_LIST["$idM"] = array("titulo" => $tituloM, "titulomin" => $tituloiMinM);
		$this->setArrayMENU_ID($aMENU_ID);
		$this->setArrayMENU_LIST($aMENU_LIST);
	}//fim function addMENU
	
	//adiciona item no menu
	public function addItemMENU($idM,$idiM,$tituloiM,$tituloiMiniM,$faisheriM,$varGetiM=""){
		$aMENU_ID = $this->getArrayItemMENU_ID();
		$aMENU_LIST = $this->getArrayItemMENU_LIST();
		$aMENU_ID["$idM"][] = $idiM;
		$aMENU_LIST["$idM"]["$idiM"] = array("titulo" => $tituloiM, "titulomin" => $tituloiMiniM, "faisher" => $faisheriM, "varget" => $varGetiM);
		$this->setArrayItemMENU_ID($aMENU_ID);
		$this->setArrayItemMENU_LIST($aMENU_LIST);
	}//fim function addItemMENU
	
	//adiciona item no sub menu
	public function addItemSUBMENU($idM,$idiM,$idiSM,$tituloiSM,$tituloiSMiniSM,$faisheriSM,$varGetiSM=""){
		$aMENU_ID = $this->getArrayItemSUBMENU_ID();
		$aMENU_LIST = $this->getArrayItemSUBMENU_LIST();
		$aMENU_ID["$idM"]["$idiM"][] = $idiSM;
		$aMENU_LIST["$idM"]["$idiM"]["$idiSM"] = array("titulo" => $tituloiSM, "titulomin" => $tituloiSMiniSM, "faisher" => $faisheriSM, "varget" => $varGetiSM);
		$this->setArrayItemSUBMENU_ID($aMENU_ID);
		$this->setArrayItemSUBMENU_LIST($aMENU_LIST);
	}//fim function addItemSUBMENU
	
	//adiciona item no sub menu
	public function addItemSUBMENUEXTRA($idM,$idiM,$idiSM,$idiSMEX,$tituloiSMEX,$tituloiSMiniSMEX,$faisheriSMEX,$varGetiSMEX=""){
		$aMENU_ID = $this->getArrayItemSUBMENUEXTRA_ID();
		$aMENU_LIST = $this->getArrayItemSUBMENUEXTRA_LIST();
		$aMENU_ID["$idM"]["$idiM"]["$idiSM"][] = $idiSMEX;
		$aMENU_LIST["$idM"]["$idiM"]["$idiSM"]["$idiSMEX"] = array("titulo" => $tituloiSMEX, "titulomin" => $tituloiSMiniSMEX, "faisher" => $faisheriSMEX, "varget" => $varGetiSMEX);
		$this->setArrayItemSUBMENUEXTRA_ID($aMENU_ID);
		$this->setArrayItemSUBMENUEXTRA_LIST($aMENU_LIST);
	}//fim function addItemSUBMENUEXTRA
	
	
	//imprime/monta o menu
	public function imprimirMENU(){
		$arrayMENU_ID = $this->getArrayMENU_ID();
		$arrayMENU_LIST = $this->getArrayMENU_LIST();
		$arrayItemMENU_ID = $this->getArrayItemMENU_ID();
		$arrayItemMENU_LIST = $this->getArrayItemMENU_LIST();
		$arrayItemSUBMENU_ID = $this->getArrayItemSUBMENU_ID();
		$arrayItemSUBMENU_LIST = $this->getArrayItemSUBMENU_LIST();
		$arrayItemSUBMENUEXTRA_ID = $this->getArrayItemSUBMENUEXTRA_ID();
		$arrayItemSUBMENUEXTRA_LIST = $this->getArrayItemSUBMENUEXTRA_LIST();
		$HTML = "";
		//echo "arrayMENU_ID<pre>"; print_r($arrayMENU_ID); echo "</pre>";
		//echo "arrayMENU_LIST<pre>"; print_r($arrayMENU_LIST); echo "</pre>";
		//echo "arrayItemMENU_ID<pre>"; print_r($arrayItemMENU_ID); echo "</pre>";
		//echo "arrayItemMENU_LIST<pre>"; print_r($arrayItemMENU_LIST); echo "</pre>";
		//echo "arrayItemSUBMENU_ID<pre>"; print_r($arrayItemSUBMENU_ID); echo "</pre>";
		//echo "arrayItemSUBMENU_LIST<pre>"; print_r($arrayItemSUBMENU_LIST); echo "</pre>";
		//echo "arrayItemSUBMENUEXTRA_ID<pre>"; print_r($arrayItemSUBMENUEXTRA_ID); echo "</pre>";
		//echo "arrayItemSUBMENUEXTRA_LIST<pre>"; print_r($arrayItemSUBMENUEXTRA_LIST); echo "</pre>";
		
		 $ICO = '<i class="glyphicon-link"></i> ';
		//monta array
		$array = $arrayMENU_ID;
		$cont_ARRAY = ceil(count($array));
		//listar item ja cadastrados
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $valor){
				$idM = $valor;
				$tituloM = $arrayMENU_LIST["$idM"]["titulo"];
				$htmlMENU = '<li id="li_top'.$idM.'" class="dropdown-topmenu"><a href="#" data-toggle="dropdown" class="dropdown-toggle ftopmenu-n"><span>'.$tituloM.'</span><span class="caret"></span></a>{?MENU?}</li>';
				$htmlItemMENU = "";

				//monta array - item do menu
				$arrayM = $arrayItemMENU_ID["$idM"];
				$cont_ARRAY = ceil(count($arrayM));
				//listar item ja cadastrados
				if($cont_ARRAY >= "1"){
					foreach ($arrayM as $pos => $valor){
						$idiM = $valor;
						$tituloiM = $arrayItemMENU_LIST["$idM"]["$idiM"]["titulo"];
						$tituloiMiniM = $arrayItemMENU_LIST["$idM"]["$idiM"]["titulomin"];
						$faisheriM = $arrayItemMENU_LIST["$idM"]["$idiM"]["faisher"];
						$varGetiM = $arrayItemMENU_LIST["$idM"]["$idiM"]["varget"];
						$link = 'class="fsubmenu-n"'; $lIco = "";
						if($faisheriM != ""){ $link = 'onClick="faisher_ajaxAba(\''.$idM.'\', \''.$tituloiMiniM.'\', \''.$faisheriM.'\', \''.$varGetiM.'\');return false;" class="fsubmenu"'; $lIco = $ICO; }
						$hIemMENU = '<li{?CSSSUBMENU?}><a href="#" '.$link.'>'.$lIco.$tituloiM.'</a>{?SUBMENU?}</li>';
						$htmlItemSUBMENU = "";
						

						//monta array - item do submenu
						$arraySM = $arrayItemSUBMENU_ID["$idM"]["$idiM"];
						$cont_ARRAY = ceil(count($arraySM));
						//listar item ja cadastrados
						if($cont_ARRAY >= "1"){
							foreach ($arraySM as $pos => $valor){
								$idiSM = $valor;
								$tituloiSM = $arrayItemSUBMENU_LIST["$idM"]["$idiM"]["$idiSM"]["titulo"];
								$tituloiMiniSM = $arrayItemSUBMENU_LIST["$idM"]["$idiM"]["$idiSM"]["titulomin"];
								$faisheriSM = $arrayItemSUBMENU_LIST["$idM"]["$idiM"]["$idiSM"]["faisher"];
								$varGetiSM = $arrayItemSUBMENU_LIST["$idM"]["$idiM"]["$idiSM"]["varget"];
								$link = 'class="fsubmenuextra-n"'; $lIco = "";
								if($faisheriSM != ""){ $link = 'onClick="faisher_ajaxAba(\''.$idM.'\', \''.$tituloiMiniSM.'\', \''.$faisheriSM.'\', \''.$varGetiSM.'\');return false;" class="fsubmenuextra"'; $lIco = $ICO; }
								$hItemSUBMENU = '<li{?CSSSUBMENUEXTRA?}><a href="#" '.$link.'>'.$lIco.$tituloiSM.'</a>{?SUBMENUEXTRA?}</li>';
								$htmlItemSUBMENUEXTRA = "";
								
								//monta array - item do submenuextra
								$arraySMEX = $arrayItemSUBMENUEXTRA_ID["$idM"]["$idiM"]["$idiSM"];
								$cont_ARRAY = ceil(count($arraySMEX));
								//listar item ja cadastrados
								if($cont_ARRAY >= "1"){
									foreach ($arraySMEX as $pos => $valor){
										$idiSMEX = $valor;
										$tituloiSMEX = $arrayItemSUBMENUEXTRA_LIST["$idM"]["$idiM"]["$idiSM"]["$idiSMEX"]["titulo"];
										$tituloiMiniSMEX = $arrayItemSUBMENUEXTRA_LIST["$idM"]["$idiM"]["$idiSM"]["$idiSMEX"]["titulomin"];
										$faisheriSMEX = $arrayItemSUBMENUEXTRA_LIST["$idM"]["$idiM"]["$idiSM"]["$idiSMEX"]["faisher"];
										$varGetiSMEX = $arrayItemSUBMENUEXTRA_LIST["$idM"]["$idiM"]["$idiSM"]["$idiSMEX"]["varget"];
										$link = 'class="fsubmenuextraex-n"'; $lIco = "";
										if($faisheriSMEX != ""){ $link = 'onClick="faisher_ajaxAba(\''.$idM.'\', \''.$tituloiMiniSMEX.'\', \''.$faisheriSMEX.'\', \''.$varGetiSMEX.'\');return false;" class="fsubmenuextraex"'; $lIco = $ICO; }
										$htmlItemSUBMENUEXTRA .= '<li><a href="#" '.$link.'>'.$lIco.$tituloiSMEX.'</a></li>';
									}//fim foreach
								}//fim if($cont_ARRAY >= "1"){							
		
								//adiciona item ao menu criado
								if($htmlItemSUBMENUEXTRA != ''){
									$hItemSUBMENU = str_replace('{?CSSSUBMENUEXTRA?}', ' class="dropdown-submenu"', $hItemSUBMENU);
									$hItemSUBMENU = str_replace('{?SUBMENUEXTRA?}', '<ul class="dropdown-menu">{?SUBMENUEXTRA?}</ul>', $hItemSUBMENU);
									$htmlItemSUBMENU .= str_replace('{?SUBMENUEXTRA?}', $htmlItemSUBMENUEXTRA, $hItemSUBMENU);
								}else{
									if($faisheriSM != ""){
										$hItemSUBMENU = str_replace('{?CSSSUBMENUEXTRA?}', "", $hItemSUBMENU);
										$htmlItemSUBMENU .= str_replace('{?SUBMENUEXTRA?}', $htmlItemSUBMENUEXTRA, $hItemSUBMENU);
									}
								}
								
								
							}//fim foreach
						}//fim if($cont_ARRAY >= "1"){
						
		
						//adiciona item ao menu criado
						if($htmlItemSUBMENU != ''){
							$hIemMENU = str_replace('{?CSSSUBMENU?}', ' class="dropdown-submenu"', $hIemMENU);
							$hIemMENU = str_replace('{?SUBMENU?}', '<ul class="dropdown-menu">{?SUBMENU?}</ul>', $hIemMENU);
							$htmlItemMENU .= str_replace('{?SUBMENU?}', $htmlItemSUBMENU, $hIemMENU);
						}else{
							if($faisheriM != ""){
								$hIemMENU = str_replace('{?CSSSUBMENU?}', "", $hIemMENU);
								$htmlItemMENU .= str_replace('{?SUBMENU?}', $htmlItemSUBMENU, $hIemMENU);
							}
						}
					}//fim foreach
				}//fim if($cont_ARRAY >= "1"){

				
				//adiciona menu criado
				if($htmlItemMENU != ""){
					$htmlMENU = str_replace('{?MENU?}', '<ul class="dropdown-menu">{?MENU?}</ul>', $htmlMENU);
					$HTML .= str_replace('{?MENU?}', $htmlItemMENU, $htmlMENU);
				}
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){

		return $HTML;
	}//fim function imprimirMENU



	
	
	//imprime/monta a guia de abas do menu
	public function imprimirAbasMENU(){
		$arrayMENU_ID = $this->getArrayMENU_ID();
		$arrayMENU_LIST = $this->getArrayMENU_LIST();
		$HTML = "";
		//monta array
		$array = $arrayMENU_ID;
		$cont_ARRAY = ceil(count($array));
		//listar item ja cadastrados
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $valor){
				$idM = $valor;
				$tituloiMinM = $arrayMENU_LIST["$idM"]["titulomin"];
				$HTML .= '
<div class="subnav" style="display:none;" id="aba'.$idM.'">
	<div class="subnav-title"><a href="#" class="toggle-subnav"><i class="icon-angle-down"></i><span>'.$tituloiMinM.'</span></a>
	</div>
	<ul class="subnav-menu" id="ul_aba'.$idM.'"></ul>
</div>';
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){

		echo $HTML;
	}//fim function imprimirAbasMENU
	
	
} //fim class  classMENU  //***************************************************************************************************************@

//fim classe monta MENU PRINCIPAL ---------------------------------------------------------------------------------<












//inicio classe para criacao de mensagem de erro e sucesso 2.5 ------------------------------------------>
/*
?? A CLASSE DEPENDO DO CSS E JQUERY 1.3.2 OU SUPERIOR ????
//Exemplode uso das mensagens

//INICIA A CLASSE de MENSAGENS: !! <Na versao 2.0 o sistema já inicia a class no final desse item > !!
$MSG = new TMENSAGEM();

//EXEMPLO DA CRIACAO DE MENSAGEM
$MSG->add("Endereço Secundário Apagado com Sucesso.","SUCESSO");

//MOSTRAR TODAS AS MENSAGENS CRIADAS
$MSG->show_all();

//SE NAO ENCONTRAR ERRO EXECUTA BLOCO:
if(! $MSG->tem_erro() ){

*/
if (!class_exists ('TMENSAGEM')) {
class TMENSAGEM { //***************************************************************************************************************@
	var $n_msg = 0;
	var $mensagem;
	var $tipo;
	
	function add ($mensagem, $tipo = "ERRO") {
		$this->mensagem[$this->n_msg] = $mensagem;
		
		if($tipo == "ERRO" || $tipo == 1) {
			$this->tipo[$this->n_msg] = 1;
			$this->n_msg++;
			}
			
		else if ($tipo == "SUCESSO" || $tipo == 2) {
			$this->tipo[$this->n_msg] = 2;
			$this->n_msg++;
			}
			
		else if ($tipo == "ALERTA" || $tipo == 3) {
			$this->tipo[$this->n_msg] = 3;
			$this->n_msg++;
			}
			
		else if ($tipo == "INFORMACAO" || $tipo == 4) {
			$this->tipo[$this->n_msg] = 4;
			$this->n_msg++;
			}
		
		else if ($tipo == "ERROSITE" || $tipo == 5) {
			$this->tipo[$this->n_msg] = 5;
			$this->n_msg++;
			}
		
			
		
		}
		
	function show_all($DIR_IMG='') {
		$this->show_erro($DIR_IMG);		
		$this->show_sucesso($DIR_IMG);
		$this->show_atencao($DIR_IMG);
		$this->show_informacao($DIR_IMG);
		$this->show_erro_site($DIR_IMG);
		}
		
	function show_erro ($DIR_IMG) {
		if( $this->tem_erro() == TRUE) {
			$var_rand = rand(9,99999999);
?>
<script type="text/javascript">
	var segundos_fim_e<?=$var_rand?> = "30000";
	atualiza_e<?=$var_rand?>(segundos_fim_e<?=$var_rand?>/1000);        
	function atualiza_e<?=$var_rand?>(segundos){                
		if(segundos>0){                       
			 $("#tempo_msgg_e<?=$var_rand?>").html(segundos);                        
			 segundos = segundos-1;
			 if(segundos <= 0){
				 $('.erro').fadeOut(1500);
			 }else{
			 	contador2 = setTimeout('atualiza_e<?=$var_rand?>(\''+segundos+'\')', 1000);                
			 }
		}
	}          
	function fecha_e<?=$var_rand?>(){                
		$('.erro').fadeOut(1500);
		$("[rel=tooltip]").tooltip('hide');
		return false;
	}  
</script>
            <div class="erro" rel="tooltip" data-placement="top" data-original-title="Ocultar a Mensagem" onclick="fecha_e<?=$var_rand?>();"><img src="<?=$DIR_IMG?>img/mensagem/erro.png" class="mensagem_imagem" />
			  <div class="mensagem_titulo">Erro</div>
<?php
			for($i=0; $i<$this->n_msg; $i++) 
				if($this->tipo[$i] == 1) {
					?><div class="mensagem"><?=$this->mensagem[$i]?></div><?php 
					}
?>
            <div style="font-size:10px; font-family:Tahoma, Geneva, sans-serif; color:#666;" align="right">clique para fechar[<span id="tempo_msgg_e<?=$var_rand?>"></span>]</div>
            </div><?php
			}
		}
	
	
	
	function show_erro_site ($DIR_IMG) {
		if( $this->tem_erro_site() == TRUE) {
			?><div class="erro" rel="tooltip" data-placement="top" data-original-title="Ocultar a Mensagem" onclick="$('.erro').fadeOut(1500); $("[rel=tooltip]").tooltip('hide'); return false;"><?php
			for($i=0; $i<$this->n_msg; $i++) 
				if($this->tipo[$i] == 5) {
					?><div class="mensagem"><font color="#2B6C54">&#8226;</font> <?=$this->mensagem[$i]?></div><?php 
					}
			?></div><?php
			}
		}
		

	function show_sucesso ($DIR_IMG) {
		if( $this->tem_sucesso() == TRUE) {
			$var_rand = rand(9,99999999);
?>
<script type="text/javascript">
	var segundos_fim_s<?=$var_rand?> = "25000";
	atualiza_s<?=$var_rand?>(segundos_fim_s<?=$var_rand?>/1000);        
	function atualiza_s<?=$var_rand?>(segundos){                
		if(segundos>0){                       
			 $("#tempo_msgg_s<?=$var_rand?>").html(segundos);                        
			 segundos = segundos-1;
			 if(segundos <= 0){
				 $('.sucesso').fadeOut(1500);
			 }else{
			 	contador2 = setTimeout('atualiza_s<?=$var_rand?>(\''+segundos+'\')', 1000);                
			 }
		}
	}           
	function fecha_s<?=$var_rand?>(){                
		$('.sucesso').fadeOut(1500);
		$("[rel=tooltip]").tooltip('hide');
		return false;
	}       
</script>
            <div class="sucesso" rel="tooltip" data-placement="top" data-original-title="Ocultar a Mensagem" onclick="fecha_s<?=$var_rand?>();"><img src="<?=$DIR_IMG?>img/mensagem/sucesso.png" class="mensagem_imagem" />
				<div class="mensagem_titulo">Sucesso</div>
<?php
			for($i=0; $i<$this->n_msg; $i++)
				if($this->tipo[$i] == 2) {
					?><div class="mensagem"><?=$this->mensagem[$i]?></div><?php 
					}
?>
            <div style="font-size:10px; font-family:Tahoma, Geneva, sans-serif; color:#666;" align="right">clique para fechar[<span id="tempo_msgg_s<?=$var_rand?>"></span>]</div>
            </div><?php
			}

		}

	function show_atencao ($DIR_IMG) {
		if( $this->tem_atencao() == TRUE) {
			$var_rand = rand(9,99999999);
?>
<script type="text/javascript">
	var segundos_fim_a<?=$var_rand?> = "15000";
	atualiza_a<?=$var_rand?>(segundos_fim_a<?=$var_rand?>/1000);        
	function atualiza_a<?=$var_rand?>(segundos){                
		if(segundos>0){                       
			 $("#tempo_msgg_a<?=$var_rand?>").html(segundos);                        
			 segundos = segundos-1;
			 if(segundos <= 0){
				 $('.alerta').fadeOut(1500);
			 }else{
			 	contador2 = setTimeout('atualiza_a<?=$var_rand?>(\''+segundos+'\')', 1000);                
			 }
		}
	}                  
	function fecha_a<?=$var_rand?>(){                
		$('.alerta').fadeOut(1500);
		$("[rel=tooltip]").tooltip('hide');
		return false;
	}
</script>
            <div class="alerta" rel="tooltip" data-placement="top" data-original-title="Ocultar a Mensagem" onclick="fecha_a<?=$var_rand?>();"><img src="<?=$DIR_IMG?>img/mensagem/alerta.png" class="mensagem_imagem" />
				<div class="mensagem_titulo">Alerta</div>
<?php
			for($i=0; $i<$this->n_msg; $i++)
				if($this->tipo[$i] == 3) {
					?><div class="mensagem"><?=$this->mensagem[$i]?></div><?php 
					}
?>
            <div style="font-size:10px; font-family:Tahoma, Geneva, sans-serif; color:#666;" align="right">clique para fechar[<span id="tempo_msgg_a<?=$var_rand?>"></span>]</div>
            </div><?php
			}
		}
		
	function show_informacao ($DIR_IMG) {
		if( $this->tem_informacao() == TRUE) {
			$var_rand = rand(9,99999999);
?>
<script type="text/javascript">
	var segundos_fim_i<?=$var_rand?> = "20000";
	atualiza_i<?=$var_rand?>(segundos_fim_i<?=$var_rand?>/1000);        
	function atualiza_i<?=$var_rand?>(segundos){                
		if(segundos>0){                       
			 $("#tempo_msgg_i<?=$var_rand?>").html(segundos);                        
			 segundos = segundos-1;
			 if(segundos <= 0){
				 $('.informacao').fadeOut(1500);
			 }else{
			 	contador2 = setTimeout('atualiza_i<?=$var_rand?>(\''+segundos+'\')', 1000);                
			 }
		}
	}               
	function fecha_i<?=$var_rand?>(){                
		$('.informacao').fadeOut(1500);
		$("[rel=tooltip]").tooltip('hide');
		return false;
	}  
</script>
            <div class="informacao" rel="tooltip" data-placement="top" data-original-title="Ocultar a Mensagem" onclick="fecha_i<?=$var_rand?>();"><img src="<?=$DIR_IMG?>img/mensagem/informacao.png" class="mensagem_imagem" />
				<div class="mensagem_titulo">Informação</div>
<?php
			for($i=0; $i<$this->n_msg; $i++)
				if($this->tipo[$i] == 4) {
					?><div class="mensagem"><?=$this->mensagem[$i]?></div><?php 
					}
?>
            <div style="font-size:10px; font-family:Tahoma, Geneva, sans-serif; color:#666;" align="right">clique para fechar[<span id="tempo_msgg_i<?=$var_rand?>"></span>]</div>
            </div><?php
			}
		}

	function tem_erro() {
		for($i=0; $i<$this->n_msg; $i++)	
			if($this->tipo[$i] == 1)
				return TRUE;
		return FALSE;
		}
		
	
	function tem_erro_site() {
		for($i=0; $i<$this->n_msg; $i++)	
			if($this->tipo[$i] == 5)
				return TRUE;
		return FALSE;
		}
		
		
	
	function tem_sucesso() {
		for($i=0; $i<$this->n_msg; $i++)	
			if($this->tipo[$i] == 2)
				return TRUE;
		return FALSE;
		}
		
	function tem_atencao() {
		for($i=0; $i<$this->n_msg; $i++)	
			if($this->tipo[$i] == 3)
				return TRUE;
		return FALSE;
		}
		
	function tem_informacao() {
		for($i=0; $i<$this->n_msg; $i++)	
			if($this->tipo[$i] == 4)
				return TRUE;
		return FALSE;
		}
	}
}//fim da classe de mensagems de erro e sucesso //***************************************************************************************************************@


//INICIA A CLASSE de MENSAGENS - O SISTEMA 2.0 INICIA AUTO
$MSG = new TMENSAGEM(); 


//fim classe para criacao de mensagem de erro e sucesso 2.5 ------------------------------------------<












class fSQL { //******************************************************************| versão 1.2 |*********************************************@
// INICIO FUNÇÕES DO SQL -----------------##############@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>
	
	/*
	Imprimir erros e debug do SQL
	*/
	static function SQL_ERROS_LEG($pesquisa,$debug='0'){
		if(SYS_CONFIG_DEBUG == "1"){
			$html = '<div style="width:80%; z-index:9999999999999; background:#FFE8E8; border:#F00 1px solid; padding:10px; left:5px; top:5px; position:absolute;" onclick="this.style.display=\'none\';"><div style="float:right; background:#F00; padding:3px; color:#FFF; font-size:10px; cursor:pointer;">(x)FECHAR</div><b>:)</b> Ops... o servidor falhou, entre em contato com o suporte e informe o ERRO:<br><b>'.$pesquisa.'</b></div>'; 
		}else{//if(SYS_CONFIG_DEBUG == "1"){
			$html = '<div style="width:80%; z-index:9999999999999; background:#FFE8E8; border:#F00 1px solid; padding:10px; font-size:14px; left:5px; top:5px; position:absolute;" onclick="this.style.display=\'none\';"><div style="float:right; background:#F00; padding:3px; color:#FFF; font-size:10px; cursor:pointer;">(x)FECHAR</div><b>:)</b> Ops... um sql no servidor falhou, atualize a janela e tente novamente!</div>'; 
		}//else{//if(SYS_CONFIG_DEBUG == "1"){
		if($debug >= "1"){ $html = '<div style="width:80%; z-index:9999999999999; background:#FFE8E8; border:#F00 1px solid; padding:10px; left:5px; top:'.$debug.'px; position:absolute;" onclick="this.style.display=\'none\';">DEBUG SQL:<br><b>'.$pesquisa.'</b></div>'; }
		return $html;
	}//fim SQL_ERROS_LEG
	
	
	
	
	
	
	/*
	pesquisa simples SQL
	-Exemplo:
	*/
	static function SQL_GERAL($sql, $debug=''){
			//faz SQL no banco selecionado
			$resu = mysql_query($sql)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			//or die("<script>alert('Ops... o servidor falhou na busca, tente mais tarde!'); window.location='?';</ script>");
			//or die("<script>alert('Ops... o servidor falhou, tente mais tarde!'); window.location='../login.php?sair=1';</ script>");
			//".mysql_error()."
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $resu;
	}//fim pesquisa geral SQL
	
	
	
	/*
	pesquisa simples SQL
	-Exemplo:
	*/
	static function SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='', $limit='', $join='', $debug=''){
		/*if(($campos != "*") and (!preg_match("/\./i", $campos))){
			$campos = trim($campos);
			$campos = str_replace("`", "", $campos);
			$campos = str_replace(",", "`,`", $campos);
			$campos = "`".$campos."`";
		}//*/
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			if($limit != ""){ $limit = "LIMIT ".$limit; }else{ $limit = ""; }
			//faz SQL no banco selecionado
			$pesquisa = "SELECT $campos FROM $tabela $join $where $order $limit";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			//".mysql_error()."
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $resu;
	}//fim pesquisa simples SQL
	
	
	
	
	/*
	pesquisa UNION SQL
	-Exemplo: nome do campo: UNI retorna o numero da tabela 1 ou 2
	*/
	static function SQL_SELECT_UNION($campos, $tabelas, $where='', $order='', $limit='', $join='', $debug=''){
		/*if(($campos != "*") and (!preg_match("/\./i", $campos))){
			$campos = trim($campos);
			$campos = str_replace("`", "", $campos);
			$campos = str_replace(",", "`,`", $campos);
			$campos = "`".$campos."`";
		}//*/
		$d = explode(",",$tabelas); $tabela1 = $d["0"]; $tabela2 = $d["1"];
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			if($limit != ""){ $limit = "LIMIT ".$limit; }else{ $limit = ""; }
			//faz SQL no banco selecionado
			$pesquisa = "(SELECT 1 AS UNI,$campos FROM $tabela1 $join $where) UNION (SELECT 2 AS UNI,$campos FROM $tabela2 $join $where) $order $limit";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			//or die("<script>alert('Ops... o servidor falhou na busca, tente mais tarde!'); window.location='?';</ script>");
			//or die("<script>alert('Ops... o servidor falhou, tente mais tarde!'); window.location='../login.php?sair=1';</ script>");
			//".mysql_error()."
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $resu;
	}//fim pesquisa UNION SQL
	
	
	
	/*
	pesquisa dupla SQL
	-Exemplo: SELECT * FROM combo_files F, usuarios_permissoes U WHERE tab = '1' AND F.permissao = U.permissao
	*/
	static function SQL_SELECT_DUPLO($campos, $tabelas, $where='', $order='', $limit='', $join='', $debug=''){
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			if($limit != ""){ $limit = "LIMIT ".$limit; }else{ $limit = ""; }
			
			//faz SQL no banco selecionado
			$pesquisa = "SELECT $campos FROM $tabelas $join $where $order $limit";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			//or die("<script>alert('Ops... o servidor falhou na busca, tente mais tarde!'); window.location='?';</ script>");
			//or die("<script>alert('Ops... o servidor falhou, tente mais tarde!'); window.location='../login.php?sair=1';</ script>");
			//".mysql_error()."
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $resu;
	}//fim pesquisa simples SQL
	
	
	
	
	
	/*
	Conta os registros de uma consulta SQL
	*/
	static function SQL_CONT($result){
			$resu = mysql_num_rows($result);
		return $resu;
	}//fim pesquisa simples SQL
	
	
	
	/*
	conta registros de um filtro SQL
	-Exemplo:
	*/
	static function SQL_CONTAGEM($tabela, $where='', $limit='', $group='', $join='', $debug=''){
		$contagem = "0";
			$group = str_replace("GROUP BY ", "", $group);
			$group = str_replace(" ", "", $group);
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			if($limit != ""){ $limit = "LIMIT ".$limit; }else{ $limit = ""; }
			if($group != ""){ $sql_cont = "COUNT(DISTINCT ".$group.") AS contagem"; }else{ $sql_cont = "COUNT(*) AS contagem"; }
			//faz SQL no banco selecionado
			$pesquisa = "SELECT $sql_cont FROM $tabela $join $where $limit";
			$resu = mysql_query($pesquisa)or die(fSQL::SQL_ERROS_LEG($pesquisa));
			$linha = mysql_fetch_assoc($resu);
			$contagem = $linha["contagem"];
			//or die("<script>alert('Ops... o servidor falhou na busca, tente mais tarde!'); window.location='?';</ script>");
			//or die("<script>alert('Ops... o servidor falhou, tente mais tarde!'); window.location='../login.php?sair=1';</ script>");
			//".mysql_error()."
	
		if($debug != ""){ //iif DEBUG, imprime o SQL
			echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
		}
		return $contagem;
	}//fim pesquisa contagem SQL
	
	
	
	/*
	conta registros de um filtro SQL
	-Exemplo:
	*/
	static function SQL_SUM($campo, $tabela, $where='', $group='', $debug=''){
		$contagem = "0";
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			$sql_cont = "SUM(".$campo.") AS contagem";
			//faz SQL no banco selecionado
			$pesquisa = "SELECT $sql_cont FROM $tabela $where $group";
			$resu = mysql_query($pesquisa)or die(fSQL::SQL_ERROS_LEG($pesquisa));
			$linha = mysql_fetch_assoc($resu);
			if($linha["contagem"] > "0"){ $contagem = $linha["contagem"]; }
			//or die("<script>alert('Ops... o servidor falhou na busca, tente mais tarde!'); window.location='?';</ script>");
			//or die("<script>alert('Ops... o servidor falhou, tente mais tarde!'); window.location='../login.php?sair=1';</ script>");
			//".mysql_error()."
	
		if($debug != ""){ //iif DEBUG, imprime o SQL
			echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
		}
		return $contagem;
	}//fim pesquisa contagem SQL
	
	
	
	/*
	conta registros de um filtro UNION SQL
	-Exemplo:
	*/
	static function SQL_CONTAGEM_UNION($tabelas, $where='', $limit='', $group='', $join='', $debug=''){
		$contagem = "0";
		$group = str_replace("GROUP BY ", "", $group);
		$group = str_replace(" ", "", $group);
		if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
		if($limit != ""){ $limit = "LIMIT ".$limit; }else{ $limit = ""; }
		if($group != ""){ $group = "DISTINCT ".$group.", "; }else{ $group = ""; }
		$d = explode(",",$tabelas); $tabela1 = $d["0"]; $tabela2 = $d["1"];
		//faz SQL no banco selecionado
		$pesquisa = "SELECT $group COUNT(*) + (SELECT $group COUNT(*) FROM $tabela1 $join $where $limit) AS contagem FROM $tabela2 $join $where $limit";
		$resu = mysql_query($pesquisa)or die(fSQL::SQL_ERROS_LEG($pesquisa));
		$linha = mysql_fetch_assoc($resu);
		$contagem = $linha["contagem"];
		//select count(*) + (select count(*) from tabela2) as somatotal from tabela1
	
		if($debug != ""){ //iif DEBUG, imprime o SQL
			echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
		}
		return $contagem;
	}//fim pesquisa contagem SQL
	
	
	
	
	/*
	pesquisa DISTINCT SQL
	-Exemplo:
	campo: $campos = "campo1";
	tabela: $tabela = "nome da tabela";
	where: $where = "id='1'";
	order: $order = "ORDER BY id DESC";
	*/
	static function SQL_SELECT_DISTINCT($campo, $tabela, $where='', $order='', $limit='', $join='', $debug=''){
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			if($limit != ""){ $limit = "LIMIT ".$limit; }else{ $limit = ""; }
			//faz SQL no banco selecionado
			$pesquisa = "SELECT DISTINCT `$campo` FROM `$tabela` $join $where $order $limit";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
			return $resu;
	}//fim pesquisa DISTINCT SQL
	
	
	
	
	
	/*
	pesquisa simples com retorno de um registro SQL
	-Exemplo:
	*/
	static function SQL_SELECT_ONE($campos, $tabela, $where='', $order='', $join='', $debug=''){
		/*if(($campos != "*") and (!preg_match("/\./i", $campos))){
			$campos = trim($campos);
			$campos = str_replace("`", "", $campos);
			$campos = str_replace(",", "`,`", $campos);
			$campos = "`".$campos."`";
		}//*/
		if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
		//faz SQL no banco selecionado
		$pesquisa = "SELECT $campos FROM $tabela $join $where $order LIMIT 1";
		$result = mysql_query($pesquisa)
		or die(fSQL::SQL_ERROS_LEG($pesquisa));
		$resu = mysql_fetch_assoc($result);
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $resu;
	}//fim pesquisa simples com retorno de um registro SQL
	
	
	
	
	/*
	pesquisa simples com retorno de um registro SQL
	-Exemplo: com retorno de apenas um campo
	*/
	static function SQL_SELECT_UNICO($campo, $tabela, $where='', $order='', $join='', $debug=''){
		if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
		//faz SQL no banco selecionado
		$pesquisa = "SELECT $campo AS campo FROM $tabela $join $where $order LIMIT 1";
		$result = mysql_query($pesquisa)
		or die(fSQL::SQL_ERROS_LEG($pesquisa));
		$resu = mysql_fetch_assoc($result);
		$campo_ret = $resu["campo"];
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $campo_ret;
	}//fim pesquisa simples com retorno de um registro SQL
	
	
	
	/*
	update simples SQL
	Exemplos:
	campos: $campos = "campo1,campo2,campo3";
	tabela: $tabela = "nome da tabela";
	valores: $valores = array("valor1","valor2","valor3");
	condicao: $condicao = "id='1' AND data !=NULL";
	*/
	static function SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao='', $debug=''){
		if($condicao != ""){
			$sql_campos = "";
			$cont = "0";
			//converte o array de campos recebido
			$array_campos = explode(",", $campos);
			//verifica a lista do array recebido
			foreach ($array_campos as $pos => $valor ){
				if($cont >= "1"){ $sql_campos .= " , "; }
				if($valores["$cont"] == "NULL"){ $sql_campos .= "`".$valor."` = ".$valores["$cont"].""; }else{ $sql_campos .= "`".$valor."` = '".mysql_real_escape_string($valores["$cont"])."'"; }
				$cont++;
			}//fim foreach
	
			//grava na tabela
			//faz SQL no banco selecionado
			$pesquisa = "UPDATE $tabela SET $sql_campos WHERE $condicao";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			$gravados = $resu;
			$retorno = "1";
	
		}else{ $retorno = "0"; } //else if($condicao != ""){
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $retorno;
	}//fim update simples SQL
	
	
	
	/*
	update de operação matemática SQL
	Exemplos:
	campos: $campos = "campo1,campo2,campo3";
	tabela: $tabela = "nome da tabela";
	valores: $valores = array("valor1","valor2","valor3");
	condicao: $condicao = "id='1' AND data !=NULL";
	operacoes: $operacoes = array("+","-","+");
	*O sistema pega o valor do campo1 atual e aplica a OPERACAO
	SQL_UPDATE_OPERACAO("campo1","tabela",array("1"),array("+"));
	*/
	static function SQL_UPDATE_OPERACAO($campos, $tabela, $valores, $condicao, $operacoes, $sql_adicional="", $debug=''){
		if($condicao != ""){
			$sql_campos = "";
			$cont = "0";
			//converte o array de campos recebido
			$array_campos = explode(",", $campos);
			//verifica a lista do array recebido
			foreach ($array_campos as $pos => $valor ){
				if($cont >= "1"){ $sql_campos .= " , "; }
				$sql_campos .= "`".$valor."` = `".$valor."`".$operacoes["$cont"]."'".$valores["$cont"]."'";
				$cont++;
			}//fim foreach
			if($sql_adicional != ""){ $sql_campos .= " , ".$sql_adicional; }
	
			//grava na tabela
			//faz SQL no banco selecionado
			$pesquisa = "UPDATE $tabela SET $sql_campos WHERE $condicao";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			$gravados = $resu;
			$retorno = "1";
		}else{ $retorno = "0"; } //else if($condicao != ""){
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $retorno;
	}//fim update de operação matemática SQL
	
	
	
	/*
	update incremento de campo SQL
	Exemplos:
	campo: $campo = "campo1";
	tabela: $tabela = "nome da tabela";
	condicao: $condicao = "id='1' AND data !=NULL";
	//Essa funcao pega um campo que tinha um valor 3 exemplo, incrementa ele alterando para 4
	*/
	static function SQL_UPDATE_INCREMENTO($campo, $tabela, $condicao='', $debug=''){
		if($condicao != ""){
	
			//grava na tabela
			//faz SQL no banco selecionado
			$pesquisa = "UPDATE $tabela SET $campo = $campo + 1 WHERE $condicao";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			$gravados = $resu;
			$retorno = "1";
	
		}else{ $retorno = "0"; } //else if($condicao != ""){
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		return $retorno;
	}//fim update simples SQL
	
	
	
	
	
	/*
	pesquisa busca ultimo id para utilizar em inserts SQL
	-Exemplo:
	*/
	static function SQL_SELECT_INSERT($tabela, $campo='id', $where='', $debug=''){
			if($campo == ""){ $campo = "id"; }
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			$id_n = "0";
			//faz SQL no banco selecionado
			$pesquisa = "SELECT $campo FROM $tabela $where ORDER BY $campo DESC LIMIT 1";
			
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			while($linha = mysql_fetch_assoc($resu)){
				$id_n = $linha["$campo"];
			}//fim while
			$id_n++;
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
	
		return $id_n;
	}//fim pesquisa ultimo id para insert SQL
	
	
	
	
	
	/*
	pesquisa busca id para utilizar SQL
	-Exemplo:
	*/
	static function SQL_SELECT_ID($tabela, $where='', $campo='id', $join='', $debug=''){
			if($campo == ""){ $campo = "id"; }
			if($where != ""){ $where = "WHERE ".$where; }else{ $where = ""; }
			$id_n = "0";
			//faz SQL no banco selecionado
			$pesquisa = "SELECT $campo FROM $tabela $join $where ORDER BY $campo DESC LIMIT 1";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			while($linha = mysql_fetch_assoc($resu)){
				$id_n = $linha["$campo"];
			}//fim while
	
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
	
		return $id_n;
	}//fim pesquisa ultimo id para insert SQL
	
	
	
	
	
	/*
	insert simples SQL
	Exemplos:
	campos: $campos = "campo1,campo2,campo3";
	tabela: $tabela = "nome da tabela";
	valores: $valores = array("valor1","valor2","valor3");
	*/
	static function SQL_INSERT_SIMPLES($campos, $tabela, $valores, $debug=''){
			$sql_campos = "";
			$sql_vars = "";
			$cont = "0";
			//converte o array de campos recebido
			$array_campos = explode(",", $campos);
			//verifica a lista do array recebido
			foreach ($array_campos as $pos => $valor ){
				if($cont >= "1"){ $sql_campos .= " , "; $sql_vars .= " , "; }
				$sql_campos .= "`".$valor."`";
				if($valores["$cont"] == "NULL"){ $sql_vars .= $valores["$cont"]; }else{ $sql_vars .= "'".mysql_real_escape_string($valores["$cont"])."'"; }
				$cont++;
			}//fim foreach
	
			//grava na tabela
			//faz SQL no banco selecionado
			$pesquisa = "INSERT INTO `$tabela` ( $sql_campos ) VALUES ( $sql_vars )";
			$resu = mysql_query($pesquisa)
			or die(fSQL::SQL_ERROS_LEG($pesquisa));
			$gravados = mysql_insert_id();
			
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		
			return $gravados;
	}//fim insert simples SQL
	
	
	
	
	
	/*
	insert id SQL
	Exemplos:
	Utilizar para retorno de ID após um INSERT, retorno de ultimo ID do insert
	*/
	static function SQL_INSERT_ID(){
		return mysql_insert_id();
	}//fim insert id SQL
	
	
	
	
	/*
	delete simples SQL
	Exemplos:
	tabela: $tabela = "nome da tabela";
	condicao: $condicao = "id='1' AND data !=NULL";
	*/
	static function SQL_DELETE_SIMPLES($tabela, $condicao='', $debug=''){
		if($condicao != ""){
				//deleta na tabela
				//faz SQL no banco selecionado
				$pesquisa = "DELETE FROM $tabela WHERE $condicao";
				$resu = mysql_query($pesquisa)
				or die(fSQL::SQL_ERROS_LEG($pesquisa));
				$gravados = $resu;
		}
		
			if($debug != ""){ //iif DEBUG, imprime o SQL
				echo fSQL::SQL_ERROS_LEG($pesquisa,$debug);
			}
		
		return $gravados;
	}//fim delete simples SQL
	
	
	
	
	
	/*
	fetch_assoc SQL
	Função:
	Listar dados while de uma consulta SQL
	*/
	static function FETCH_ASSOC($result, $debug=''){
		return mysql_fetch_assoc($result);
	}//fim delete simples SQL
	
	
	
	
	
	
	/*
	fetch_array SQL
	Função:
	Listar dados while de uma consulta SQL em um ARRAY
	*/
	static function FETCH_ARRAY($result){
		return mysql_fetch_array($result);
	}//fim delete simples SQL
	
	
	
	
	
	//verifica se tabela existe no DB
	/* Exemplo de USO:
	echo VER_TABELA("DB", "nometabela");
	*/
	static function VER_TABELA($tabela){ 
			if(!(mysql_query("SELECT * FROM $tabela LIMIT 1"))) { 
				//echo "essa tabela não existe"; 
				return 0;
			} else { 
				//echo "essa tabela existe"; 
				return 1;
			} 
	}//fim funtioction ver_tabela()
	
	
	
	
	//converte resultado SQL em ARRAY
	// Function to Convert Results into an ARRAY 
	static function result_to_array($result){ 
		// Defining an array 
		$result_array = array(); 
		// Creating the Array of all users 
		for ($i = 0; $row = mysql_fetch_assoc($result); $i++){
			$result_array[$i] = $row; 
		} 
		// returns the array of all users by Multi Dimensional Array 
		return $result_array; 
	} // Function to Convert Results into an ARRAY 
	




	//Função monta where para select com separador de busca 
	//Exemplo: fSQL::WHERE_SEPARADOR(",","teste","nome LIKE '!VAR-BUSCA!' OR sobrenome LIKE '!VAR-BUSCA!'"); sistema retorna uma lista
	static function WHERE_SEPARADOR($SEPARADOR, $VARBUSCA, $WHERE="1=2"){
		$retorno = ""; if($WHERE == ""){ $retorno = "1=2"; }
		if($WHERE != ""){
			//monta array de dados
			$array = explode($SEPARADOR, $VARBUSCA);
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				foreach ($array as $pos => $valor){
					if($valor != ""){
						if($retorno != ""){ $retorno .= " AND "; }
						$retorno .= "( ".str_replace("!VAR-BUSCA!",$valor,$WHERE)." )";
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){
		}//if($WHERE != ""){
			
		return "( ".$retorno." )";
	}//fim WHERE_SEPARADOR($IDUSER, CAMPO);


//fim funcoes de SQL ---------<<<<<<<<<<<<<<	
}//fSQL //****************************************************| versão 1.1 |***********************************************************@




















/* CLASSE DE AÇÕES PARA NÚMERO DE CELULAR - ( fNCELULAR - 1.1 ) ------------------------------------------------------------------>>>*/
/*	//FUNÇÕES DISPONÍVEIS
	-Conulta de operadora fNCELULAR::qualOperadora(NUMERO);
*/
class fNCELULAR{

	//formato numero: dd + 9 + numero, exemplo: 62982307752
	//retorna nome da operadora em maiusculo, exemplo: TIM
	//em caso de retorno vazio, é pq não encontrou operadora
	static function qualOperadora($telefone){
		$curlIndividual = array();
		$operadora = "";
		$curlTodos = curl_multi_init();
		$curlIndividual[$telefone] = curl_init('http://consultanumero.info/consulta');
		curl_setopt_array($curlIndividual[$telefone], array(
				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0',
				CURLOPT_SSL_VERIFYPEER => 1,
				CURLOPT_SSL_VERIFYHOST => 2,
				CURLOPT_CONNECTTIMEOUT => 5,
				CURLOPT_PROTOCOLS => CURLPROTO_HTTPS | CURLPROTO_HTTP,
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => 'tel='.$telefone,
				CURLOPT_RETURNTRANSFER => 1
		));
		curl_multi_add_handle($curlTodos, $curlIndividual[$telefone]);

		$Executando = 1;
		while($Executando> 0){
				curl_multi_exec($curlTodos, $Executando);
				curl_multi_select($curlTodos);
		}//fim while
		foreach($curlIndividual as $telefone => $curl){
				$resultado = curl_multi_getcontent($curl);
				//if(preg_match('/<img src="(.?)" alt="(.?)" title="(.*?)" \/>/i', $resultado, $matches)) {
				if(preg_match('@title="([^"]+)"@', $resultado, $matches)) {	
					//$operadora = strtoupper($matches[2]);
					$operadora = strtoupper($matches[1]);
				}//fim if
		}//fim foreach	
		return trim($operadora);
	}//fim qualOperadora
	
	//verifica se número é um celular ou fixo
	static function identificaTelefone($NUM){
		$ret = "NULO";
		$NUM = str_replace(array(".","-"," ","(",")","+"),"",$NUM);//limpa numero
		$primeiro = substr($NUM,0,1);//pega primeiro digito
		if($primeiro == "0"){
			$identificador = substr($NUM,3,1);//pega identificador
		}else{
			$identificador = substr($NUM,2,1);//pega identificador		
		}
		if($identificador >= "7"){ $ret = "CELULAR"; }else{ $ret = "FIXO"; }
		return $ret;
	}//identificaTelefone
	
	//adiciona o nono digito em número de celular brasil
	static function nonoDigito($NUM){
		$ret = $NUM;
		if(strlen($NUM) == "12"){
			$ret = substr($NUM,0,4)."9".substr($NUM,4,15);
		}//if(strlen($NUM) == "12"){
		return $ret;
	}//nonoDigito
	
	//cria um número de celular com privacidade, ocultando parte do número
	static function privCelular($NUM){
		$NUM = str_replace(array(".","-"," ","(",")","+"),"",$NUM);//limpa celular		
		//esconde numero de celular
		$ini = substr($NUM, 0, 1);
		$fim = substr($NUM, -2);
		$ret = "(".$ini."*) *****-**".$fim;
		return $ret;
	}//privCelular
	
	//cria uma formatação para o número de telefone
	static function formataTelBR($NUM){
		$TEL = str_replace(array(".","-"," ","(",")","+"),"",$NUM);//limpa 
		if(substr($TEL,0,1) == "0"){ $TEL = substr($TEL,1,strlen($TEL)-1); }
		$tam = strlen(preg_replace("/[^0-9]/", "", $TEL));
		  if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
		  return "+".substr($TEL,0,$tam-11)."(".substr($TEL,$tam-11,2).")".substr($TEL,$tam-9,5)."-".substr($TEL,-4);
		  }
		  if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
		  return "+".substr($TEL,0,$tam-10)."(".substr($TEL,$tam-10,2).")".substr($TEL,$tam-8,4)."-".substr($TEL,-4);
		  }
		  if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
		  return "(".substr($TEL,0,2).")".substr($TEL,2,5)."-".substr($TEL,7,11);
		  }
		  if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
		  return "(".substr($TEL,0,2).")".substr($TEL,2,4)."-".substr($TEL,6,10);
		  }
		  if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
		  return substr($TEL,0,$tam-4)."-".substr($TEL,-4);
		  }
	}//formadaTelBR
}//class fNCELULAR
/* CLASSE DE AÇÕES PARA NÚMERO DE CELULAR - ( fNCELULAR ) ------------------------------------------------------------------<<<*/














/* CLASSE DE ENVIO DE SMS - ( fSMS - 2.0 ) ------------------------------------------------------------------>>>*/
/*	//ENCRIPTAR
	$class_sms = new fSMS("sistema");//definir grupo de envio
	$encrypted = $crypter->Encrypt("dados a encriptar");
*/
class fSMS{
	private $Confirma = "ON";

	public function __construct($var=""){
	}

	public function setConfirma($acao){//liga e desliga a confirmação de envio no retorno do servidor (auto reenvio 1h) - ON ou OFF
		$this->Confirma = fGERAL::getpost_sql($acao);
	}

	//funcao limpa NUMERO DE SMS
	/*	Exemplo de USO:	$var = "(62) 3232-0000"; echo limpa_SMS($var);//imprime: 556232320000*/
	public function limpaSMS($numero){
	//monta numero para envio
		$numero = str_replace(" ", "", $numero);
		$numero = str_replace("-", "", $numero);
		$numero = str_replace("(", "", $numero);
		$numero = str_replace(")", "", $numero);
		return  str_replace("+", "", $numero);
	}//function fim limpa NUMERO DE SMS

	
	public function enviaSMS($numero,$texto,$time_envio="0"){
		$ret = "ERRO";
		if($texto != ""){ $val = "1"; }else{ $val = "0"; $ret = "TEXTO VAZIO"; }
		if($time_envio <= "0"){ $time_envio = time(); }
		$numero = $this->limpaSMS($numero);
		$texto = semacentos(SYS_CLIENTE_NOME_SMS."]>".$texto);
		$texto = primeiro_nome($texto,"","160");
		if((strlen($numero) != "10") and (strlen($numero) != "11")){ $val = "0"; $ret = "NUMERO INCORRETO"; }
		if($val == "1"){
			$ret = "SUCESSO";
			//VARS insert simples SQL
			$tabela = "sys_sendsms";
			//busca ultimo id para insert
			$id_s = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,mensagem,numero,time_envio";
			$valores = array($id_s,$texto,"55".$numero,$time_envio);
			if($this->Confirma == "OFF"){ $campos .= ",time_send"; $valores[] = "10"; }//ativa a não confirmação/reenvio
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		}//if($val == "1"){
		return $ret;
	}

	
	private function candidatoSMS($candidato_id,$tipo,$texto,$numeros="PRINCIPAL",$time_envio="0"){
		$ret = "0";
		if($numeros == "FULL"){ $sql_n = ""; }else{ $sql_n = "principal = '1'"; }
		if($tipo == "FISICO"){ $tabela = "cad_candidato_fisico_celular"; if($sql_n != ""){ $sql_n .= " AND "; } $sql_n .= " candidato_fisico_id = '$candidato_id'"; }
		if($tipo == "JURIDICO"){ $tabela = "cad_candidato_juridico_celular"; if($sql_n != ""){ $sql_n .= " AND "; } $sql_n .= " candidato_juridico_id = '$candidato_id'"; }
		if($tabela != ""){
			//busca lista de numeros
			$resui = fSQL::SQL_SELECT_SIMPLES("celular", $tabela, $sql_n,"", "10");
			while($linhai = fSQL::FETCH_ASSOC($resui)){
				$envio = $this->enviaSMS($linhai["celular"],$texto);
				if($envio == "SUCESSO"){ $ret++; }
			}//fim while
		}//if($tabela != ""){
		return $ret;
	}

	
	public function candidatoFisicoSMS($candidato_id,$texto,$numeros="PRINCIPAL",$time_envio="0"){
		$ret = $this->candidatoSMS($candidato_id,"FISICO",$texto,$numeros,$time_envio);
		return $ret;
	}

	
	public function candidatoJuridicoSMS($candidato_id,$texto,$numeros="PRINCIPAL",$time_envio="0"){
		$ret = $this->candidatoSMS($candidato_id,"JURIDICO",$texto,$numeros,$time_envio);
		return $ret;
	}
}//class fSMS
/* CLASSE DE ENVIO DE SMS - ( fSMS ) ------------------------------------------------------------------<<<*/










class fSMS_ECASH{
	public static function send($msg,$num) {
		if(strlen($num) == 12){
			$num = substr($num,3,9);
		}
		$url = SYS_ECASH_URL."?clientcell=".$num."&message=".$msg."&application=".SYS_ECASH_APP."&sender=".SYS_ECASH_SENDER."&user=".SYS_ECASH_USER."&password=".SYS_ECASH_PASS;
		$opts = array(
			  "ssl"=>array(
			  		"verify_peer"=>false,
			  		"verify_peer_name"=>false
			  )
		);
		$context = stream_context_create($opts);		
		$contentsBin = file_get_contents($url, false, $context);		
	}
}





















/* CLASSE DE ENVIO DE TORPEDOS - ( fTORPEDOS - 1.0 ) ------------------------------------------------------------------>>>*/
/*	 >> INICIAR CLASSE COM O CAMINHO DA PASTA DA ASSISTENTE
ENVIOS DE MENSAGENS COM DESPACHO POR WHATS E SMS E UTILIZAÇÃO DE ASSISTENTE IIA
*/
class fTORPEDOS{
	private $Caminho = "";
	private $Origem = "";
	private $PessoaNome = "";
	private $PessoaCpf = "";
	private $PessoaDatan = "";
	private $PessoaSexo = "";
	private $AcaoSMS = "1";
	private $ClassBiiBi;

	public function __construct($caminho="sys/"){
		$this->Caminho = $caminho;		
		//CLASSE DE INTERFACE BiiBi ++++++++++++++++++++++++++++++++++++++++++++++++ >>>
		include $this->Caminho."BiiBi/class/class.BiiBi.php";//classe		
		//inicia a classe BiiBi
		$this->ClassBiiBi = new classBiiBi($this->Caminho."BiiBi/");		
	}


	public function origemEnvio($envio=""){	
		$this->Origem = $envio;			
	}//origemEnvio
	

	public function updatePessoa($nome="",$cpf="",$datan="",$sexo=""){	
		$this->PessoaNome = $nome;			
		$this->PessoaCpf = $cpf;	
		$this->PessoaDatan = $datan;			
		$this->PessoaSexo = $sexo;			
	}//updatePessoa
	
	

	public function sendTorpedo($chave_cpf,$chave_celular,$texto_sms,$texto_torpedo,$parametros="",$file=""){	
		if(SYS_TORPEDO_ON == "1"){	
			//VERIFICA PESSOA
			$retPessoa = $this->ClassBiiBi->setPessoa("0",$chave_cpf,$chave_celular);		
			if($retPessoa["valida"] == "1"){
				//VERIFICA CHAT
				$retChat = $this->ClassBiiBi->setChatUltimo($this->Origem);// define o ultimo chat localizado
				//$arrRet["retChat"] = $retChat;
				if($retChat["valida"] == "1"){
					$retPes = $this->ClassBiiBi->updatePessoa($this->PessoaNome,$this->PessoaCpf,$this->PessoaDatan,$this->PessoaSexo);
					$retMsg = $this->ClassBiiBi->interfaceMsgSend($texto_torpedo,$parametros,$file);
					//$arrRet["retPes"] = $retPes;
					//$arrRet["retMsg"] = $retMsg;
					if($retMsg["valida"] == "1"){
						if($this->AcaoSMS != "1"){ $timeout = "2"; }else{ $timeout = "0"; }
						//VARS insert simples SQL
						$tabela = "bii_torpedo";
						$campos = "origem,origem_ano,origem_id,numero,texto,sms,time,timeout";
						$valores = array("2",date('Y'),$retMsg["id"],$retMsg["celular"],$texto_torpedo,$texto_sms,time(),$timeout);
						fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
						$torpedo_id = fSQL::SQL_INSERT_ID();
						//verifica origem de envios
						if($retChat["origem"] == "2"){//WHATSAPP
							//VARS insert simples SQL
							$tabela = "sys_whats_send";
							$campos = "controlador_id,numero,file,mensagem,time,time_motor,motor_confirma,whats_sem,whats_enviado,whats_confirma";
							$valores = array($torpedo_id,$retMsg["celular"],$retMsg["file"],$retMsg["msg"],time(),"0","0","0","0","0");
							fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);	
							//verifica se tem envio de contato whats
							if(isset($retMsg["fileAdd"])){
								$campos = "controlador_id,numero,file,mensagem,falar,time,time_motor,motor_confirma,whats_sem,whats_enviado,whats_confirma";
								$valores = array("0",$retMsg["celular"],$retMsg["fileAdd"],"Meu contato!","0",(time()+5),"0","0","0","0","0");
								fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
							}//if(isset($retChat["fileAdd"])){
						}//if($retMsg["origem"] == "2"){//WHATSAPP
					}else{//if($retMsg["valida"] == "1"){
						//ENVIAR SMS
						$this->sendSMS($chave_celular,$texto_sms,"0");
					}//else{//if($retMsg["valida"] == "1"){				
				}else{//if($retChat["valida"] == "1"){
					//ENVIAR SMS
					$this->sendSMS($chave_celular,$texto_sms,"0");
				}//else{//if($retChat["valida"] == "1"){						
			}else{//if($retPessoa["valida"] == "1"){
				//ENVIAR SMS
				$this->sendSMS($chave_celular,$texto_sms,"0");
			}//else{//if($retPessoa["valida"] == "1"){
		}else{//if(SYS_TORPEDO_ON == "1"){
			//ENVIAR SMS
			$this->sendSMS($chave_celular,$texto_sms,"0");
		}//else{//if(SYS_TORPEDO_ON == "1"){
		//return $arrRet;
	}//sendTorpedo





	public function acaoSMS($sms="1"){// 0 off, 1 on	
		$this->AcaoSMS = $sms;			
	}//acaoSMS
	
	
	
	private function sendSMS($numero,$texto,$time_envio="0"){	
		if($this->AcaoSMS == "1"){
			//classe de envio de SMS
			$classSMS = new fSMS("sistema");
			$smsRet = $classSMS->enviaSMS($numero, $texto,$time_envio);//enviaSMS($numero,$texto,$time_envio="0"){
		}//if($this->AcaoSMS == "1"){
	}//sendSMS


}//class fTORPEDOS
/* CLASSE DE ENVIO DE TORPEDOS - ( fTORPEDOS ) ------------------------------------------------------------------<<<*/
































/* CLASSE DE CONSULTA DADOS SITE RECEITA - ( fRECEITA - 1.1 ) ------------------------------------------------------------------>>>*/
/*	 >> INICIAR CLASSE COM O CAMINHO DA PASTA TEMP DE FILES
	....................... consulta CNPJ site receita ......>>
	//INICIAR CLASSE --->>> CONSULTAR CNPJ - busca captcha para consulta de CNPJ [PRIMEIRA PARTE]
	$CLASS["fRECEITA"] = new fRECEITA(VAR_DIR_FILES."files/temp/");//inicia a classe
	$arrCaptcha = $CLASS["fRECEITA"]->pegarCaptchaCnpj();//Ret: $arrRet["cookie"] = id de cookie; $arrRet["dados"] = base64 html imagem;
	//echo "DADOS CAPTCHA:<pre>"; print_r($arrCaptcha); echo "</pre>";
	....................... consulta CNPJ site receita ......<<
	
	****DEPENDÊNCIA DE TABELA: sys_cookie_file_temp
*/
class fRECEITA{
	private $CaminhoTemp = "";//caminho da pasta de temp
	private $CookieId = "";//id do cookie
	
	//recebe dados inicias de formação da classe - caminho recebido deve ser finalizado com /
	public function __construct($caminho){
		$this->CaminhoTemp = $caminho;
		$this->CookieId = md5(uniqid(time())).time().".cookie";//cria ao nome do cookie - id de consulta
		$this->limpaCookieExpirados();//limpa antigo
	}
	
	//carregar id de cookie já existente - utilizada para as funcções de consulta, deve ser declarado antes: this->consultarCnpj
	public function setIdCookie($cookieid){
		$this->CookieId = $cookieid;
	}//setIdCookie
	
	//valida caminho TEMP de arquivos existe
	private function validaCaminho(){
		if((file_exists($this->CaminhoTemp)) and ($this->CaminhoTemp != "") and ($this->CaminhoTemp != "/") and ($this->CaminhoTemp != "../")){
			return true;
		}else{
			return false;
		}
	}//validaCaminho
	
	//limpa cookies que não fora utilizados e permanecem no sistema a mais de 2horas (tempo de validade lançado na criação)
	private function limpaCookieExpirados($idfile=""){
		if($this->validaCaminho()){
			//verifica se existem arquivos inutilizados no sistema
			$campos = "id,file";
			$tabela = "sys_cookie_file_temp";
			if($idfile != ""){ $where = "aplicacao = 'RECEITA' AND file = '".$idfile."'"; }else{ $where = "aplicacao = 'RECEITA' AND time <= '".time()."'"; }
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "", "50");
			while($linha = fSQL::FETCH_ASSOC($resu)){				
				//exclue o arquivo
				if(($linha["file"] != "") and ($linha["file"] != "/")){
					delete($this->CaminhoTemp.$linha["file"]);
				}				
				//exclue o registro
				fSQL::SQL_DELETE_SIMPLES($tabela, "id = '".$linha["id"]."'");
			}//fim while fetch
		}//if($this->validaCaminho()){
	}//limpaCookieExpirados
	
	//função que pega imagem do captcha CNPJ do site da receita
	//ARRAY DE RETORNO arrRet["dados"] : BASE64(uso HTML) DO CAPTCHA ou erro : 0 - arrRet["cookie"] : id do cookie a armazenar para consulta
	public function pegarCaptchaCnpj(){
		$arrRet["cookie"] = $this->CookieId; $arrRet["dados"] = "0";
		if($this->validaCaminho()){
			//Headers comuns em todas as chamadas CURL, com exceçao do Índice [0], que muda para CPF e CNPJ
			$headers = array(
				0 => '',// aqui vai o HOST da consulta conforme a necessidade (CPF ou CNPJ)
				1 => 'User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:53.0) Gecko/20100101 Firefox/53.0',
				2 => 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				3 => 'Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.5,en;q=0.3',
				4 => 'Connection: keep-alive',
				5 => 'Upgrade-Insecure-Requests: 1'	
			);	
			//urls para obtenção dos dados
			$url = 'http://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/Cnpjreva_Solicitacao2.asp';
			$url_captcha = 'http://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/captcha/gerarCaptcha.asp';
			$host = 'Host: www.receita.fazenda.gov.br';		
			//define o hosts a ser usado no header da chamada curl conforme $key
			$headers[0] = $host;		
			//define o nome do arquivo de cookie a ser usado para cada chamada conforme $key
			$cookieFile = $this->CaminhoTemp.$this->CookieId;
			//cria o arquivo se ele não existe
			if(!file_exists($cookieFile)){
				$file = fopen($cookieFile, 'w');
				fclose($file);
			}else{//if(!file_exists($cookieFile)){
				//pega os dados de sessão gerados na visualização do captcha dentro do cookie
				$file = fopen($cookieFile, 'r');
				while (!feof($file))
				{$conteudo .= fread($file, 1024);}
				fclose ($file);			
				$explodir = explode(chr(9),$conteudo);
				$sessionName = trim($explodir[count($explodir)-2]);
				$sessionId = trim($explodir[count($explodir)-1]);			
				//constroe o parâmetro de sessão que será passado no próximo curl
				$cookie = $sessionName.'='.$sessionId;
			}//}else{//if(!file_exists($cookieFile)){
				
			//grava na tabela de controle temp
			$campos = "aplicacao,file,time";
			$valores = array("RECEITA",$this->CookieId,(time()+7200));//adiciona time de 2hs para expirar
			fSQL::SQL_INSERT_SIMPLES($campos, "sys_cookie_file_temp", $valores);
			
			//inicia primeira consulta ao URL
			set_time_limit(60);// to infinity for example
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);	
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);//O número de segundos a aguardar ao tentar se conectar. Use 0 para esperar indefinidamente. 
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);//O número máximo de segundos para permitir que as funções cURL sejam executadas.	
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);		
		
			// trata os resultados da consulta curl
			if(!empty($result)){
				//pega os dados de sessão gerados nas primeiras chamadas e que estão dentro do cookie
				$file = fopen($cookieFile, 'r');
				while (!feof($file)){ $conteudo .= fread($file, 1024); }
				fclose ($file);
				$explodir = explode(chr(9),$conteudo);
				$sessionName = trim($explodir[count($explodir)-2]);
				$sessionId = trim($explodir[count($explodir)-1]);	
				//constroe o parâmetro de sessão que será passado no próximo curl
				$cookie = $sessionName.'='.$sessionId;
				//faz segunda chamada para pegar o captcha
				set_time_limit(60);// to infinity for example
				$ch = curl_init($url_captcha);
				//continua setando parâmetros da chamada curl
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		// headers da chamada 
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);	// dados do arquivo de cookie
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);	// dados do arquivo de cookie
				curl_setopt($ch, CURLOPT_COOKIE, $cookie);			// cookie com os dados da sessão
				curl_setopt($ch, CURLOPT_REFERER, $url);			// refer = url da chamada anterior
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);//O número de segundos a aguardar ao tentar se conectar. Use 0 para esperar indefinidamente. 
				curl_setopt($ch, CURLOPT_TIMEOUT, 60);//O número máximo de segundos para permitir que as funções cURL sejam executadas.	
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);		
				//extrai resultados conforme
				$arrRet["dados"] = 'data:image/png;base64,'.base64_encode($result);//monta exibição de base64 HTML
				//file_put_contents($cookieFile.".jpg",$result);
			}//if(!empty($result)){
			//monta retorno
			return $arrRet;	
		}//if($this->validaCaminho()){	
	}//pegarCaptchaCnpj
	
	
	//deve carregar o cookie existente na função: this->setIdCookie
	public function consultarCnpj($cnpj, $captcha){
		$arrRet['valida'] = "0"; $arrRet['msg'] = "Opss... caminho do cookie não foi localizado!";
		if($this->validaCaminho()){	
			$cookieFile = $this->CaminhoTemp.$this->CookieId;
			$arrRet['msg'] = "Opss... o cookie não foi localizado!";
			if(file_exists($cookieFile)){
				//pega os dados de sessão gerados na visualização do captcha dentro do cookie
				$file = fopen($cookieFile, 'r');
				while(!feof($file)){ $conteudo .= fread($file, 1024); }
				fclose ($file);					
				$explodir = explode(chr(9),$conteudo);					
				$sessionName = trim($explodir[count($explodir)-2]);
				$sessionId = trim($explodir[count($explodir)-1]);
				
				// se não tem falg	1 no cookie então acrescenta
				if(!strstr($conteudo,'flag	1')){
					// linha que deve ser inserida no cookie antes da consulta cnpj
					// observações argumentos separados por tab (chr(9)) e new line no final e inicio da linha (chr(10))
					// substitui dois chr(10) padrão do cookie para separar cabecario do conteudo , adicionando o conteudo $linha , que tb inicia com dois chr(10)
					$linha = chr(10).chr(10).'www.receita.fazenda.gov.br	FALSE	/pessoajuridica/cnpj/cnpjreva/	FALSE	0	flag	1'.chr(10);
					// novo cookie com o flag=1 dentro dele , antes da linha de sessionname e sessionid
					$novo_cookie = str_replace(chr(10).chr(10),$linha,$conteudo);
					// apaga o cookie antigo
					unlink($cookieFile);
					
					// cria o novo cookie , com a linha flag=1 inserida
					$file = fopen($cookieFile, 'w');
					fwrite($file, $novo_cookie);
					fclose($file);
				}//if(!strstr($conteudo,'flag	1')){
				
				//constroe o parâmetro de sessão que será passado no próximo curl
				$cookie = $sessionName.'='.$sessionId.';flag=1';	
				
				// dados que serão submetidos a consulta por post
				$post = array(
					'submit1'						=> 'Consultar',
					'origem'						=> 'comprovante',
					'cnpj' 							=> $cnpj, 
					'txtTexto_captcha_serpro_gov_br'=> $captcha,
					'search_type'					=> 'cnpj'
				);					
				$post = http_build_query($post, NULL, '&');
				
				// prepara headers da consulta
				$headers = array(
					'Host: www.receita.fazenda.gov.br',
					'User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:53.0) Gecko/20100101 Firefox/53.0',
					'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
					'Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.5,en;q=0.3',
					'Connection: keep-alive',
					'Upgrade-Insecure-Requests: 1',	
				);
				//inicia consulta ao URL
				set_time_limit(60);// to infinity for example
				$ch = curl_init('http://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/valida.asp');
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);		// aqui estão os campos de formulário
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);	// dados do arquivo de cookie
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);	// dados do arquivo de cookie
				curl_setopt($ch, CURLOPT_COOKIE, $cookie);	    // dados de sessão e flag=1
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
				curl_setopt($ch, CURLOPT_REFERER, 'http://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/Cnpjreva_Solicitacao2.asp');
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);//O número de segundos a aguardar ao tentar se conectar. Use 0 para esperar indefinidamente. 
				curl_setopt($ch, CURLOPT_TIMEOUT, 60);//O número máximo de segundos para permitir que as funções cURL sejam executadas.	
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$html = curl_exec($ch); //print_r($html); //DEBUG
				curl_close($ch);
				// Função para extrair o que interessa da HTML e colocar em array
				// respostas que interessam
				$campos = array('NÚMERO DE INSCRIÇÃO',
					'DATA DE ABERTURA',
					'NOME EMPRESARIAL',
					'TÍTULO DO ESTABELECIMENTO (NOME DE FANTASIA)',
					'CÓDIGO E DESCRIÇÃO DA ATIVIDADE ECONÔMICA PRINCIPAL',
					'CÓDIGO E DESCRIÇÃO DAS ATIVIDADES ECONÔMICAS SECUNDÁRIAS',
					'CÓDIGO E DESCRIÇÃO DA NATUREZA JURÍDICA',
					'LOGRADOURO',
					'NÚMERO',
					'COMPLEMENTO',
					'CEP',
					'BAIRRO/DISTRITO',
					'MUNICÍPIO',
					'UF',
					'ENDEREÇO ELETRÔNICO',
					'TELEFONE',
					'ENTE FEDERATIVO RESPONSÁVEL (EFR)',
					'SITUAÇÃO CADASTRAL',
					'DATA DA SITUAÇÃO CADASTRAL',
					'MOTIVO DE SITUAÇÃO CADASTRAL',
					'SITUAÇÃO ESPECIAL',
					'DATA DA SITUAÇÃO ESPECIAL');			
				$nome_campos_array = array("cnpj","data_abertura","razao","fantasia","atividade_principal","atividade_secundaria","natureza","logradouro","numero","complemento","cep","bairro","cidade","uf","email","telefone","efr","situacao","situacao_data","situacao_motivo","situacao_especial","situacao_especial_data");
				// caracteres que devem ser eliminados da resposta
				$caract_especiais = array(chr(9),chr(10),chr(13),'&nbsp;','</b>','  ','<b>MATRIZ<br>','<b>FILIAL<br>');
				// prepara a resposta para extrair os dados
				$html = str_replace('<br><b>','<b>',str_replace($caract_especiais,'',strip_tags($html,'<b><br>')));				
				$html3 = $html;
				// faz a extração
				for($i=0;$i<count($campos);$i++){		
					$html2 = strstr($html,utf8_decode($campos[$i]));
					$nome_campo = $nome_campos_array[$i];
					$inicio = utf8_decode($campos[$i]).'<b>'; $fim = '<br>'; $total = $html2;
					$dados = str_replace($inicio,'',str_replace(strstr(strstr($total,$inicio),$fim),'',strstr($total,$inicio)));
					//$dados = str_replace("<b>","",$dados);
					//$dados = str_replace("</b>","",$dados);		
					if($i == "0" && $dados == ""){ break; }//não preencher campos se retorno vazio
					$resultado[$nome_campo] = utf8_encode(trim($dados));
					$html=$html2;
				}//for($i=0;$i<count($campos);$i++){
				
				// extrai os CNAEs secundarios , quando forem mais de um
				if($resultado["atividade_secundaria"] != ""){
					if(strstr($resultado["atividade_secundaria"],'<b>')){
						$cnae_secundarios = explode('<b>',$resultado["atividade_secundaria"]);
						$resultado["atividade_secundaria"] = $cnae_secundarios;
						unset($cnae_secundarios);
					}else{//if(strstr($resultado[5],'<b>')){
						$resultado["atividade_secundaria"]["0"] = $resultado["atividade_secundaria"];
					}//}else{//if(strstr($resultado[5],'<b>')){
				}//if($resultado["atividade_secundaria"] != ""){
				
				// devolve STATUS da consulta correto
				if(!$resultado["cnpj"]){
					if(strstr($html3,utf8_decode('O número do CNPJ não é válido'))){
						$arrRet['msg'] = "CNPJ incorreto!";
					}elseif(strstr($html3,utf8_decode('Não existe no Cadastro de Pessoas'))){
						$arrRet['msg'] = "CNPJ não existe!";
					}else{//if(strstr($html3,utf8_decode('O número do CNPJ não é válido'))){
						$arrRet['msg'] = "Imagem de segurança não está correta...";
					}//}else{//if(strstr($html3,utf8_decode('O número do CNPJ não é válido'))){ 
				}else{ 
					$arrRet['valida'] = '1';
					$arrRet['msg'] = "Dados recebidos com sucesso!";
					$arrRet['dados'] = $resultado;
				}//if(!$resultado[0]){
				
				//apaga cookie de consulta
				$this->limpaCookieExpirados($this->CookieId);
				//retorno de dados
				return $arrRet;
			}//if(file_exists($cookieFile)){
		}//if($this->validaCaminho()){	
	}//consultarCnpj

}//class fRECEITA
/* CLASSE DE CONSULTA DADOS SITE RECEITA - ( fRECEITA ) ------------------------------------------------------------------<<<*/
































/* CLASSE DE CRIA UM ARQUIVO ZIP TEMPORÁRIO DE DOWNLOAD - ( fZIPTMP - 1.0 ) ------------------------------------------------------------------>>>*/
/*	 >> INICIAR CLASSE COM O CAMINHO DA PASTA TEMP DE FILES
	Cria um arquivo TMP para downaload e expira	
	****DEPENDÊNCIA DE TABELA: sys_download_zip_temp
		
	//INICIAR CLASSE --->>>
	$CLASS["fZIPTMP"] = new fZIPTMP(VAR_DIR_FILES."files/temp/",$cVLogin->userId());//inicia a classe
	//CLASSE #######=> adiciona arquivo
	$CLASS["fZIPTMP"]->addArquivos(VAR_DIR_FILES,"setup1.exe");
	$CLASS["fZIPTMP"]->addArquivos(VAR_DIR_FILES,"video1.mp4");
	$CLASS["fZIPTMP"]->addArquivos(VAR_DIR_FILES,"video1.mp4","video_clone.mp4");
	//CLASSE #######=> baixar zip - retorna informações de id de downaload
	$zipRet = $CLASS["fZIPTMP"]->downloadZip();
	echo "zipRet:<pre>"; print_r($zipRet); echo "</pre>";
*/
class fZIPTMP{
	private $Zip;//variavel de criação do zip
	private $ZipOK = "0";//variavel confirma o ZIP
	private $ZipFilesCont = "0";//variavel contagem de arquivos no ZIP
	private $ZipTemp = "";//nome do zip
	private $CaminhoTemp = "";//caminho da pasta de temp
	private $User_id = "";//id do usuário para controle de segurança
	private $Segundos = "60";//segundos de expirar o link
	
	//recebe dados inicias de formação da classe - caminho recebido deve ser finalizado com /
	public function __construct($caminho_temp,$user_id){
		$this->Zip = new ZipArchive();
		$nome_zip = "ziptemp-".md5(uniqid(time())).".zip";//cria ao nome do cookie - id de consulta
		$this->ZipTemp = $nome_zip;
		$this->CaminhoTemp = $caminho_temp;
		$this->User_id = $user_id;
		if($this->Zip->open($this->CaminhoTemp.$this->ZipTemp, ZIPARCHIVE::CREATE) == TRUE){
			$this->ZipOK = "1";
		}
	}	
	
	//alterar o tempo de expiração padrão
	public function setSegundos($segundos){
		$this->Segundos = (int)$segundos;
	}//setSegundos		

	public function addArquivos($caminho,$nome_file,$novo_nome_file=""){
		if(($this->ZipOK == "1") and ($this->mostraExtensao($caminho.$nome_file) != "php")){
			if($novo_nome_file == ""){ $novo_nome_file = $nome_file; }//define um nome se vazio
			if(file_exists($caminho.$nome_file)){
				$this->tmFileTIMELIMIT($caminho.$nome_file);//verifica se almenta tempo de execução php
				$this->Zip->addFile($caminho.$nome_file, $novo_nome_file);
				$this->ZipFilesCont++;
			}//if(file_exists($caminho.$nome_file)){
		}//if($this->ZipOK == "1"){
	}//addArquivos	

	public function addPastas($local,$caminho=""){
		if($this->ZipOK == "1"){
			if($caminho == ""){ $caminho = $local; }//alimenta arquivo
			$filesArray = scandir($local);
			foreach ($filesArray as $key => $folder){
				//echo "<br>XXX-".$local.$folder.'<br>';
				if(is_dir($local.$folder) && $folder != '.' && $folder != '..'){
					//echo "<br>PASTA-".$local.$folder.'<br>';
					$this->Zip->addEmptyDir(str_replace("---".$caminho, "", "---".$local.$folder));
					$this->addPastas($local.$folder."/",$caminho);
				}elseif(is_file($local.$folder) && $folder != '.' && $folder != '..'){
					if($this->mostraExtensao($local) != "php"){
						$this->Zip->addFile($local.$folder, str_replace("---".$caminho, "", "---".$local.$folder));
						$this->ZipFilesCont++;
					}//($this->mostraExtensao($local) != "php")
				}
			}
		}//if($this->ZipOK == "1"){
	}//addArquivos
	
	//função que faz o downaload após inclusao dos arquivos
	public function downloadZip(){
		$arrRet["id"] = "0"; $arrRet["caminho"] = "";
		if($this->ZipOK == "1"){
			$this->Zip->close();//cria zip
			//grava na tabela de controle temp
			$campos = "user_id,zip,time";
			$valores = array($this->User_id,$this->ZipTemp,(time()+$this->Segundos));//adiciona time de 2hs para expirar
			fSQL::SQL_INSERT_SIMPLES($campos, "sys_download_zip_temp", $valores);
			$arrRet["id"] = fSQL::SQL_INSERT_ID();
			$arrRet["caminho"] = $this->CaminhoTemp.$this->ZipTemp;
			$arrRet["contFiles"] = $this->ZipFilesCont;
			//limpa antigos
			$this->limpaZipExpirados();
		}//if($this->ZipOK == "1"){
		return $arrRet;
	}//downloadZip
	
	//limpa zips antigos já expirados (tempo de validade lançado na criação)
	public function limpaZipExpirados($id=""){
		if((file_exists($this->CaminhoTemp)) and ($this->CaminhoTemp != "") and ($this->CaminhoTemp != "/") and ($this->CaminhoTemp != "../")){
			//verifica se existem arquivos inutilizados no sistema
			$campos = "id,zip";
			$tabela = "sys_download_zip_temp";
			if($idfile != ""){ $where = "id = '".$id."'"; }else{ $where = "time <= '".time()."'"; }
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "", "50");
			while($linha = fSQL::FETCH_ASSOC($resu)){				
				//exclue o arquivo
				if(($linha["zip"] != "") and ($linha["zip"] != "/")){
					delete($this->CaminhoTemp.$linha["zip"]);
				}				
				//exclue o registro
				fSQL::SQL_DELETE_SIMPLES($tabela, "id = '".$linha["id"]."'");
			}//fim while fetch
		}//if((file_exists($this->CaminhoTemp)) and ($this->CaminhoTemp != "") and ($this->CaminhoTemp != "/") and ($this->CaminhoTemp != "../")){
	}//limpaZipExpirados

	//mostrar extensao de arquivos - uso interno de validação
	private function mostraExtensao($arquivo,$ret='min'){
		$ex = strrchr($arquivo, ".");//seprara a extencao
		$ex = str_replace(".","",$ex);//tira o ponto
		if($ret == "min"){
			$ex = strtolower($ex);//coloca minusculo
		}
		if($ret == "nome"){
			$arquivo_ = str_replace($ex,'',$arquivo);
			$ex = strtolower($ex);//coloca minusculo
			$ex = $arquivo_.$ex;
		}
		return $ex;
	}//fim funcao mostra extencao
	
	//funcao que informa o tamanho de um arquivo, total
	private function tmFileTIMELIMIT($file) {
		if(file_exists($file)){
			$tamanho = filesize($file);		
			$kb = 1024;
			$mb = 1048576;
			$gb = 1073741824;
			$tb = 1099511627776;	 
			if($tamanho<$kb){
				//bytes
				$this->Segundos = $this->Segundos+1;//adiciona tempo de cache
			}else if($tamanho>=$kb&&$tamanho<$mb){
				//Kb
				$this->Segundos = $this->Segundos+1;//adiciona tempo de cache
			}else if($tamanho>=$mb&&$tamanho<$gb){
				//Mb
				if(number_format($tamanho/$mb,2) >= "100"){	set_time_limit(60);
					$this->Segundos = $this->Segundos+120;//adiciona tempo de cache
				}
				if(number_format($tamanho/$mb,2) >= "300"){ set_time_limit(120);
					$this->Segundos = $this->Segundos+300;//adiciona tempo de cache
				}
				if(number_format($tamanho/$mb,2) >= "500"){ set_time_limit(180);
					$this->Segundos = $this->Segundos+600;//adiciona tempo de cache
				}
			}else if($tamanho>=$gb&&$tamanho<$tb){
				//Gb
				set_time_limit(300);
				$this->Segundos = $this->Segundos+1200;//adiciona tempo de cache
			}
		}//if(file_exists($file)){
	}//tmFile

}//class fZIPTMP
/* CLASSE DE CRIA UM ARQUIVO ZIP TEMPORÁRIO DE DOWNLOAD - ( fZIPTMP - 1.0 ) ------------------------------------------------------------------<<<*/



































/* CLASSE DE COMUNICAÇÃO WEB SERVICE CLIENTE - ( fClienteWS - Versão 1.2 ) ------------------------------------------------------------------>>>*/
/*	//WEB SERVICE SOAP CLIENTE
	$class_sms = new fClienteWS();//definir grupo de envio
	$encrypted = $crypter->Encrypt("dados a encriptar");
*/
class fClienteWS{
	private $Url;
	private $Login;
	private $Senha;
	private $ClienteSOAP = NULL;

	public function __construct($url, $login, $senha){
		$this->conecta($url, $login, $senha);
	}//__construct

	public function conecta($url, $login, $senha){
		$this->Url = $url;
		$this->Login = $login;
		$this->Senha = $senha;
		$this->Https = $https;
		$this->conexaoSOAP();
	}//conecta
	
	/*Função destinada a verificacao de URL externas*/
	private function urlExists($url,$vars="302,200,401"){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt ($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; //Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_exec($ch);
		$curlRet = curl_getinfo($ch);
		if(preg_match("/\,".$curlRet["http_code"]."\,/",",".$vars.",")){ return true; }else{ return false; }
	}//urlExists

	private function conexaoSOAP(){
		//verifica se existe conexao com servidor
		if($this->urlExists($this->Url."index.php") == "1"){
			//verifica se utiliza o HTTPS
			if((preg_match("/https:\/\//i", $this->Url)) or (preg_match("/HTTPS:\/\//i", $this->Url))){
				$context = stream_context_create(array('ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true )));			
				//faz a instancia ao webserver 
				$this->ClienteSOAP = new SoapClient(null, array(
					'location' => $this->Url."index.php",
					'uri' => $this->Url,
					'stream_context' => $context,
					'encoding'=>'ISO-8859-1',
					'trace' => 1,
					'exceptions' => 0,
					'login' => $this->Login,
					'password' =>$this->Senha));
			}else{//if((preg_match("/https:\/\//i", $this->Url)) or (preg_match("/HTTPS:\/\//i", $this->Url))){
				//faz a instancia ao webserver 
				$this->ClienteSOAP = new SoapClient(null, array(
					'location' => $this->Url."index.php",
					'uri' => $this->Url,
					'encoding'=>'ISO-8859-1',
					'trace' => 1,
					'exceptions' => 0,
					'login' => $this->Login,
					'password' =>$this->Senha));
			}//else{//if((preg_match("/https:\/\//i", $this->Url)) or (preg_match("/HTTPS:\/\//i", $this->Url))){
		}// if urlExists
	}//conecta	

	//Peparar e Retornar pacote de dados para envio ao servidor SOAP
	private function getsendFile($dados,$acao="get"){
		if($acao == "get"){
			$dados = base64_decode($dados);//decodifica
			$dados = @gzuncompress($dados);//descompacta	
		}
		if($acao == "send"){
			$dados = @gzcompress($dados,9);//compacta
			$dados = base64_encode($dados);//encodifica	
		}
		return $dados;
	}//fim get send
	private function jsonArray($dados,$acao="enc"){
		if($acao == "dec"){
		return json_decode($dados, true);
		}else{
			//$dados = stripslashes_deep($dados);//remove tags \' para '
			return json_encode($dados);
		}
	}//jsonArray
	//Peparar e Retornar pacote de dados para envio ao servidor SOAP
	private function soapDados($dados,$acao="get",$tipo="array"){
		if($dados != ""){
			if($acao == "get"){
				$dados = $this->getsendFile($dados,"get");
				if($tipo == "array"){ $dados = $this->jsonArray($dados,"dec");	}
			}
			if($acao == "send"){
				if($tipo == "array"){ $dados = $this->jsonArray($dados,"enc"); }
				$dados = $this->getsendFile($dados,"send");
			}
		}//if($dados != ""){
		return $dados;
	}//fim get send
	
	
	
	
	//retorna o status da conexão
	public function status(){
		if($this->ClienteSOAP == NULL){ return "OFFLINE"; }else{ return "ONLINE"; }
	}//status
	
	//retorna a variavel de conexao SOAP
	public function conexao(){
		return $this->ClienteSOAP;
	}//conexao
	
	//desconectar a variavel SOAP
	public function desconectar(){
		$this->ClienteSOAP = NULL;
	}//desconectar	
	
	public function executa($incFuncao,$dados="",$tGet="array",$tPost="array"){
		if($this->ClienteSOAP == NULL){ return ""; }else{
			$CLIENTE = $this->ClienteSOAP;
//			$result = "";
			//FAZ TRATAMENTO DE ENTRADA
			if($tPost == "array"){ $dados = $this->soapDados($dados,"send","array"); }
			if($tPost == "file"){ $dados = $this->soapDados($dados,"send","file"); }
			// chamada do serviço SOAP
			if($tGet == "vazio"){ 
				eval("\$result = \$this->ClienteSOAP->".$incFuncao."();");
			}else{
				eval("\$result = \$this->ClienteSOAP->".$incFuncao."(\$dados);");
			}
			//$vFalse = get_object_vars($result);//retorna false se deu tudo certo
			//if(!$vFalse == false){ $tGet = ""; $tPost = ""; $result = ""; }//retorna false se deu tudo certo
			//FAZ TRATAMENTO DE SAÍDA
			if($tGet == "debug"){ echo "<br>-RES: <pre>"; print_r($result);  echo "</pre>"; }//DEBUG DIRETO
			if($tGet == "array"){ $result = $this->soapDados($result,"get","array"); }
			if($tGet == "file"){ $result = $this->soapDados($result,"get","file"); }
			if($tPost == "debug"){ echo "<br>-RES: <pre>"; print_r($result);  echo "</pre>"; }//DEBUG DEPOIS DE MONTAR RETORNO
			return $result;
		}//fim if NULL
	}//fim executa	
	
	
}//class fClienteWS
/* CLASSE DE COMUNICAÇÃO WEB SERVICE CLIENTE - ( fClienteWS ) ------------------------------------------------------------------<<<*/














/* CLASSE DE CRIPTOGRAFIA - ( fCrypter 1.0 ) ------------------------------------------------------------------>>>*/
/*	//ENCRIPTAR
	$crypter = new Crypter("senha de acesso");
	$encrypted = $crypter->Encrypt("dados a encriptar");

	//DESCRIPTAR
	$crypter = new Crypter("senha de acesso");
	$decrypted = $crypter->Decrypt("dados a descriptar");
*/
class fCrypter{
	private $Pass;
	private $Key;
	private $Text;
	private $Algo = MCRYPT_RIJNDAEL_256;//MCRYPT_BLOWFISH
	private $Salt;

	public function __construct($Pass){
		$this->Pass = $Pass;
		$this->geraKey();
	}

	public function Encrypt($data){
		if(!$data){
			return false;
		}
		//Optional Part, only necessary if you use other encryption mode than ECB
		$iv_size = mcrypt_get_iv_size($this->Algo, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		

		$crypt = mcrypt_encrypt($this->Algo, $this->Key, $data, MCRYPT_MODE_ECB, $iv);
		return trim(urlencode(base64_encode($crypt)));
	}
	
	public function Decrypt($data){
		if(!$data){
			return false;
		}
		
		$data = urldecode($data);
		$crypt = base64_decode($data);		
		//Optional Part, only necessary if you use other encryption mode than ECB
		$iv_size = mcrypt_get_iv_size($this->Algo, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
		$decrypt = mcrypt_decrypt($this->Algo, $this->Key, $crypt, MCRYPT_MODE_ECB, $iv);
		return trim($decrypt);
	
	}
	private function geraKey(){
		$this->Key = substr($this->Pass, 0, mcrypt_get_key_size($this->Algo, MCRYPT_MODE_ECB));
	}
}//class fCrypter
/* CLASSE DE CRIPTOGRAFIA - ( fCrypter 1.0 ) ------------------------------------------------------------------<<<*/
















/* CLASSE DE CRIPTOGRAFIA JAVASCRIPT - ( fCriptoJs 1.0 ) ------------------------------------------------------------------>>>*/
/*  //DA SENHA
	16, 24 ou 32 - caracteres
	//ENCRIPTAR
	$crypter = new fCriptoJs("senha de acesso");
	$encrypted = $crypter->Encrypt("dados a encriptar");

	//DESCRIPTAR
	$crypter = new fCriptoJs("senha de acesso");
	$decrypted = $crypter->Decrypt("dados a descriptar");
*/
class fCriptoJs{
	private $Pass;
	private $Key;
	private $Text;
	private $Algo = MCRYPT_RIJNDAEL_256;//MCRYPT_BLOWFISH
	private $Salt;

	public function __construct($Pass=""){
		if($Pass != ""){ $this->setPass($Pass); }
	}
	
	public function setPass($Pass){
		$this->Pass = $Pass;
		$this->geraKey();
	}

	public function Encrypt($data){
		if(!$data){
			return false;
		}
		$crypt = mcrypt_encrypt($this->Algo, $this->Key, $data, MCRYPT_MODE_ECB);
		$crypt = bin2hex($crypt);
		$crypt = urlencode(base64_encode($crypt));
		$crypt = str_replace('%', '_-_', $crypt);
		return trim($crypt);
	}
	
	public function Decrypt($data){
		if(!$data){
			return false;
		}
		$data = str_replace('_-_', '%', $data);
		$data = urldecode($data);
		$crypt = base64_decode($data);
		$crypt = hex2bin($crypt);
		$decrypt = mcrypt_decrypt($this->Algo, $this->Key, $crypt, MCRYPT_MODE_ECB);
		return trim($decrypt);	
	}
	
	private function geraKey(){
		$this->Key = substr($this->Pass, 0, mcrypt_get_key_size($this->Algo, MCRYPT_MODE_ECB));
	}
}//class fCriptoJs
/* CLASSE DE CRIPTOGRAFIA JAVASCRIPT - ( fCriptoJs 1.0 ) ------------------------------------------------------------------<<<*/

























/* CLASSE DE FUNCOES SERVIDOR - ( fServidor 2.5 ) ------------------------------------------------------------------<<<*/
class fServidor{
	
	public function statsServerFSize($bytes){
			$types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
			for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
					return( round( $bytes, 2 ) . $types[$i] );
	}//statsServerFSize
	
	public function statsDb(){
		//monta tags no array do usuario
		$resu1 = fSQL::SQL_SELECT_SIMPLES("SUM(table_rows) AS db_linhas, SUM( data_length + index_length ) AS db_tamanho", "information_schema.tables", "table_schema = '".VAR_DBPAI_BASE."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$linha["db_linhas"] = number_format($linha["db_linhas"],0, '', '.');			
			$linha["db_tamanho"] = fServidor::statsServerFSize($linha["db_tamanho"]);
			$arrRet = $linha;
		}//fim while
		//RETORNO
		return $arrRet;
	}//statsDb
		
	public function statsInodes($CAMINHO){
		$particao = trim(shell_exec("df -P /home/suporte/ | tail -1 | cut -d' ' -f 1"));
		return trim(shell_exec("df -i | grep '".$particao."' | awk '{print $5}'"));
	}//statsInodes
	
	//retorna array com info do server
	// Ex: Array
	/*
    	[PRETTY_NAME] => Debian GNU/Linux 9 (stretch)
   		[NAME] => Debian GNU/Linux
    	[VERSION_ID] => 9
    	[VERSION] => 9 (stretch)
    	[ID] => debian
    	[HOME_URL] => https://www.debian.org/
    	[SUPPORT_URL] => https://www.debian.org/support
    	[BUG_REPORT_URL] => https://bugs.debian.org/
	*/
	public function statsOS(){
		$arrRet = array();
		if (strtolower(substr(PHP_OS, 0, 5)) === 'linux'){
			$vars = array();
			$files = glob('/etc/*-release');
			foreach ($files as $file){
				$lines = array_filter(array_map(function($line) {
					// split value from key
					$parts = explode('=', $line);
		
					// makes sure that "useless" lines are ignored (together with array_filter)
					if (count($parts) !== 2) return false;
		
					// remove quotes, if the value is quoted
					$parts[1] = str_replace(array('"', "'"), '', $parts[1]);
					return $parts;
		
				}, file($file)));
				foreach ($lines as $line){
					$arrRet[$line[0]] = $line[1];
				}
			}
		}	
		
		return $arrRet;	
	}//statsOS
	
	public function statsFull($CAMINHO_F="",$CAMINHO="/",$CAMINHOEXE=""){
		if($CAMINHO_F == ""){ $CAMINHO_F = VAR_DIR_FILES; }
		if($CAMINHOEXE == ""){ $CAMINHOEXE = $CAMINHO_F; }
		$arrRet = fServidor::statsDb();	
		if(preg_match("/Linux/i", PHP_OS)){//só reorna se for linux
			//CPU
			$exec_loads = sys_getloadavg();
			$exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
			$arrRet["cpu_clock"] = $exec_cores+1;
			$arrRet["cpu_uso_porcentagem"] = round($exec_loads[1]/($exec_cores+1)*100, 0).'%';
			//MEMORIA
			$exec_free = explode("\n", trim(shell_exec('free')));
			//echo "<pre>exec_free:"; print_r($exec_free); echo "</pre>";
			$get_mem = preg_split("/[\s]+/", $exec_free[1]);
			//$arrRet["mem"] = number_format(round($get_mem[2]/1024/1024, 2), 2).'/'.number_format(round($get_mem[1]/1024/1024, 2), 2);
			$arrRet["mem_livre"] = fServidor::statsServerFSize((round($get_mem[1], 2))*1024);
			$arrRet["mem_total"] = fServidor::statsServerFSize((round(($get_mem[1]+$get_mem[2]), 2))*1024);
			$arrRet["mem_uso"] = fServidor::statsServerFSize((round($get_mem[2], 2))*1024);
			$arrRet["mem_uso_porcentagem"] = round($get_mem[2]*100/($get_mem[1]+$get_mem[2]), 0).'%';
			//SWAP
			$get_swap = preg_split("/[\s]+/", $exec_free[2]);
			if(preg_match("/Swap/i", $get_swap["0"])){
				$arrRet["swap_livre"] = fServidor::statsServerFSize((round($get_swap[1], 2))*1024);
				$arrRet["swap_total"] = fServidor::statsServerFSize((round(($get_swap[1]+$get_swap[2]), 2))*1024);
				$arrRet["swap_uso"] = fServidor::statsServerFSize((round($get_swap[2], 2))*1024);
				$arrRet["swap_uso_porcentagem"] = round($get_swap[2]*100/($get_swap[1]+$get_swap[2]), 0).'%';
			}
			//DISCO SERVIDOR
			$arrRet["disco_livre"] = disk_free_space($CAMINHO);
			$arrRet["disco_total"] = disk_total_space($CAMINHO);
			$arrRet["disco_uso"] = $arrRet["disco_total"]-$arrRet["disco_livre"];
			/* porcentagem do disco utilizado */
			$arrRet["disco_uso_porcentagem"] = sprintf('%.0f',($arrRet["disco_uso"]/$arrRet["disco_total"])*100)."%";
			/* formatar tamanho de bytes para MB, GB, etc. */
			$arrRet["disco_livre"] = fServidor::statsServerFSize($arrRet["disco_livre"]);
			$arrRet["disco_total"] = fServidor::statsServerFSize($arrRet["disco_total"]);
			$arrRet["disco_uso"] = fServidor::statsServerFSize($arrRet["disco_uso"]);
			//DISCO FILES
			$arrRet["files_livre"] = disk_free_space($CAMINHO_F);
			$arrRet["files_total"] = disk_total_space($CAMINHO_F);
			$arrRet["files_uso"] = $arrRet["files_total"]-$arrRet["files_livre"];
			/* porcentagem do disco utilizado */
			$arrRet["files_uso_porcentagem"] = sprintf('%.0f',($arrRet["files_uso"]/$arrRet["files_total"])*100)."%";
			/* formatar tamanho de bytes para MB, GB, etc. */
			$arrRet["files_livre"] = fServidor::statsServerFSize($arrRet["files_livre"]);
			$arrRet["files_total"] = fServidor::statsServerFSize($arrRet["files_total"]);
			$arrRet["files_uso"] = fServidor::statsServerFSize($arrRet["files_uso"]);
			//inodes
			$arrRet["disco_inodes"] = fServidor::statsInodes($CAMINHO);
			$arrRet["files_inodes"] = fServidor::statsInodes($CAMINHO_F);
			//os info
			$info_os = fServidor::statsOS();
			if(ceil(count($info_os)) >= "1"){
				$arrRet["os"] = $info_os["NAME"];
				$arrRet["version_os"] = $info_os["VERSION_ID"];				
			}//if(ceil(count($info_os)) >= "1"){
			
			//RETORNO
			return $arrRet;
		}else{//if(preg_match("/Linux/i", PHP_OS)){//só reorna se for linux		
			$sRet = json_decode(trim(shell_exec($CAMINHOEXE.'files/sysInfo/infoWin.exe '.$CAMINHO_F)), true);
			//CPU
			$arrRet["cpu_clock"] = $sRet["cpu_total"]+1;
			$arrRet["cpu_uso_porcentagem"] = str_replace(" ", "", $sRet["cpu_used"]);
			//MEMORIA
			//$arrRet["mem"] = number_format(round($get_mem[2]/1024/1024, 2), 2).'/'.number_format(round($get_mem[1]/1024/1024, 2), 2);
			$arrRet["mem_livre"] = fServidor::statsServerFSize(($sRet["mem_total"]-$sRet["mem_used"])*1024);
			$arrRet["mem_total"] = fServidor::statsServerFSize($sRet["mem_total"]*1024);
			$arrRet["mem_uso"] = fServidor::statsServerFSize($sRet["mem_used"]*1024);
			$arrRet["mem_uso_porcentagem"] = round($sRet["mem_used"]*100/$sRet["mem_total"], 0).'%';
			//SWAP
			$get_swap = preg_split("/[\s]+/", $exec_free[3]);
			$arrRet["swap_livre"] = fServidor::statsServerFSize(($sRet["swap_total"]-$sRet["swap_used"])*1024);
			$arrRet["swap_total"] = fServidor::statsServerFSize($sRet["swap_total"]*1024);
			$arrRet["swap_uso"] = fServidor::statsServerFSize($sRet["swap_used"]*1024);
			$arrRet["swap_uso_porcentagem"] = round($sRet["swap_used"]*100/$sRet["swap_total"], 0).'%';
			//DISCO SERVIDOR
			$arrRet["disco_livre"] = $sRet["disco_total"]-$sRet["disco_used"];
			$arrRet["disco_total"] = $sRet["disco_total"];
			$arrRet["disco_uso"] = $sRet["disco_used"];
			/* porcentagem do disco utilizado */
			$arrRet["disco_uso_porcentagem"] = sprintf('%.0f',($arrRet["disco_uso"]/$arrRet["disco_total"])*100)."%";
			/* formatar tamanho de bytes para MB, GB, etc. */
			$arrRet["disco_livre"] = fServidor::statsServerFSize($arrRet["disco_livre"]*1024);
			$arrRet["disco_total"] = fServidor::statsServerFSize($arrRet["disco_total"]*1024);
			$arrRet["disco_uso"] = fServidor::statsServerFSize($arrRet["disco_uso"]*1024);
			//DISCO FILES
			$arrRet["files_livre"] = $sRet["files_total"]-$sRet["files_used"];
			$arrRet["files_total"] = $sRet["files_total"];
			$arrRet["files_uso"] = $sRet["files_used"];
			/* porcentagem do disco utilizado */
			$arrRet["files_uso_porcentagem"] = sprintf('%.0f',($arrRet["files_uso"]/$arrRet["files_total"])*100)."%";
			/* formatar tamanho de bytes para MB, GB, etc. */
			$arrRet["files_livre"] = fServidor::statsServerFSize($arrRet["files_livre"]*1024);
			$arrRet["files_total"] = fServidor::statsServerFSize($arrRet["files_total"]*1024);
			$arrRet["files_uso"] = fServidor::statsServerFSize($arrRet["files_uso"]*1024);
		}//else{//if(preg_match("/Linux/i", PHP_OS)){//só reorna se for linux	
		return $arrRet;
	}//statsFull
	
}//class fServidor
/* CLASSE DE FUNCOES SERVIDOR - ( fServidor 2.5 ) ------------------------------------------------------------------<<<*/

















/* CLASSE DE GERAÇÃO DE PDFs - ( fPDF 3.3 ) ------------------------------------------------------------------>>>*/
/*	GERAR PDF 04/06/2015 ; 09/06/2016 ; 21/06/2017 ; 12/12/2017 ; 14/03/2018 ; 21/03/2018
$classe_pdf = new fPDF("../");//inicia a classe informando o caminho da pasta: sys
$classe_pdf->nomeFile("teste");
$classe_pdf->mostraData(date('d/m/Y H:i')."h");//mostra data no título
$classe_pdf->papel("A4");//mudar tamanho do papel
$classe_pdf->orientacao("paisagem");//mudar papel para paisagem
$classe_pdf->cabecalho("nome é 1","nome é 2");
$classe_pdf->nPagina();
$classe_pdf->legPagina("Legenda");
$classe_pdf->legAssinatura("Legenda de Assinatura Lateral");//assinatura lateral  de páginas
$classe_pdf->conteudo("conteudo dos dados ção<br>novos teste<hr>pagina é 2");
$classe_pdf->gerarPDF("view");
*/
class fPDF{
	private $Caminho;	
	private $NomeFile;	
	private $Cabecalho;
	private $MarcaDagua = "";
	private $tituloData = "";
	private $LegAssinatura = "";
	private $Npagina = "0";
	private $LegPagina = "";
	private $cssPage = "0";
	private $HtmlRet;
	private $CabecalhoW1 = "50%";
	private $CabecalhoW2 = "50%";
	private $CabecalhoH = "60";
	private $MarginTop = "38";
	private $Papel = "A4";
	private $Orientacao = "portrait";//orientation: 'portrait' or 'landscape'
	private $Memoria = "";

	public function __construct($caminho=''){
		ini_set("memory_limit", "200M");
		if(!file_exists($caminho."sys/dompdf/autoload.inc.php")){ $caminho = "OFF"; }		
		$this->Caminho = $caminho;
		$this->NomeFile = "AXLPDF-".time()."-".date('d-m-Y');
		$c["1"] = ""; $c["2"] = "";	$this->Cabecalho = $c;
	}//__construct

	public function memoria($memoria){
		$this->Memoria = $memoria;
	}//memoria

	public function nomeFile($nome){
		$nome = str_replace(".pdf", "", $nome);
		$nome = str_replace(".PDF", "", $nome);
		if($nome != ""){ $this->NomeFile = $nome.".pdf"; }
	}

	public function cabecalho($primeiro,$segundo=''){
		$cabecalho["1"] = $primeiro;
		if($segundo != ""){ $cabecalho["2"] = $segundo; }
		$this->Cabecalho = $cabecalho;
	}//cabecalho

	public function mDagua($urlImg,$mTop="1"){
		if(file_exists($urlImg)){
			$arrImg = getimagesize($urlImg);
			$lMargin = (int)$arrImg["0"]/2;
			$html = '<div style="left:50%; z-index:0; margin-left:-'.$lMargin.'px; margin-top:'.$mTop.'px; position:absolute;"><img src="'.$urlImg.'"/></div>';
			$this->MarcaDagua = $html;
		}
	}

	public function cabecalhoW($item,$valor){
		if(($item == "1") and ($valor != "")){ $this->CabecalhoW1 = $valor; }
		if(($item == "2") and ($valor != "")){ $this->CabecalhoW2 = $valor; }
	}

	public function cabecalhoH($h){
		if($h != "0"){ $this->CabecalhoH = $h; }
	}

	public function marginTop($px){
		$this->MarginTop = $h;
	}

	public function mostraData($data){
		$this->tituloData = $data;
	}

	public function papel($tipo){
		$this->Papel = $tipo;
	}

	public function cssPage($css){
		$this->cssPage = $css;
	}

	public function orientacao($tipo){
		if(($tipo == "paisagem") or ($tipo == "landscape") or ($tipo == "P")){ $this->Orientacao = "landscape"; }else{ $this->Orientacao = "portrait"; }
	}

	public function nPagina(){
		$this->Npagina = "1";
	}

	public function legPagina($var){
		$this->LegPagina = $var;
	}

	public function legAssinatura($var){
		$this->LegAssinatura = $var;
	}

	public function conteudo($html){
		global $class_fLNG;
		//corrige bug de salto de linha
		$html = str_replace('<h1','<span class=".h1"',$html); $html = str_replace("</h1","</span",$html);
		$html = str_replace('<h2','<span class=".h2"',$html); $html = str_replace("</h2","</span",$html);
		$html = str_replace('<h3','<span class=".h3"',$html); $html = str_replace("</h3","</span",$html);
		$html = str_replace('<h4','<span class=".h4"',$html); $html = str_replace("</h4","</span",$html);
		$html = str_replace('<h5','<span class=".h5"',$html); $html = str_replace("</h5","</span",$html);
		$html = str_replace('<h6','<span class=".h6"',$html); $html = str_replace("</h6","</span",$html);		
		//remove caracteres word
		$html = str_replace('<o:p','<p',$html); $html = str_replace("</o:p","</p",$html);		
		//verifica cabeçalho
		$margin_top = $this->CabecalhoH+38;//margem do topo
		if(($this->Cabecalho["1"] == "") and ($this->Cabecalho["2"] == "")){
			$margin_top = $this->MarginTop;//margem do topo
		}//if(($this->Cabecalho["1"] == "") and ($this->Cabecalho["2"] == "")){
		$css_page = "margin:".$margin_top."px 38px 38px 38px;";
		
		//verifica se recebe css page externo
		if($this->cssPage != "0"){
			$css_page = $this->cssPage;//css externo
		}//if($this->cssPage != "0"){
			
		//verifica a orientação do papel
		//if($this->Orientacao == "landscape"){ $ass_w = "590"; }else{ $ass_w = "920"; } -brn
		
		//inicio do html 38px == 1cm
		$htmlRet = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//PT-BR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>SIGPC</title>
<style type="text/css">
@page {
	'.$css_page.'
	counter-reset: teste;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000;
	margin:0;
}
#header,
#footer {
	position: fixed;
	left: 0;
	right: 0;
	bottom: 0;
	z-index:2;
}
#header {
	top: -'.$this->CabecalhoH.'px;
	padding-bottom:5px;
	z-index:2;
}
#header .data{
	font-weight:normal; font-style:italic; font-size:10px;
}
#header table,
#footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}
#divHtml {
  z-index:2;
}
hr {
  page-break-after: always;
  border: 0;
}
.h1 { font-size: 2em; margin-top: 0.67em; margin-bottom: 0.67em; margin-left: 0; margin-right: 0; font-weight: bold; }
.h2 { font-size: 1.5em; margin-top: 0.83em; margin-bottom: 0.83em; margin-left: 0; margin-right: 0; font-weight: bold; }
.h3 {  font-size: 1.17em; margin-top: 1em; margin-bottom: 1em; margin-left: 0; margin-right: 0; font-weight: bold; }
.h4 {  margin-top: 1.33em; margin-bottom: 1.33em; margin-left: 0; margin-right: 0; font-weight: bold; }
.h5 {  font-size: .83em; margin-top: 1.67em; margin-bottom: 1.67em; margin-left: 0; margin-right: 0; font-weight: bold; }
.h6 {  font-size: .67em; margin-top: 2.33em; margin-bottom: 2.33em; margin-left: 0; margin-right: 0; font-weight: bold; }
</style>  
</head>
<body>
';
		//verifica se adiciona numeros de paginas  $color = array(0.1,0.1,0.1);
		if($this->Npagina == "1"){
			$htmlRet .= '
<script type="text/php">
if ( isset($pdf) ) {
  $size = 8;
  $color = array(0.5,0.5,0.5);
    
  $text_height = $fontMetrics->getFontHeight($font, $size);
  $width = $fontMetrics->getTextWidth(utf8_encode("'.$class_fLNG->txt(__FILE__,__LINE__,'Página').' 1 de 2 '.$this->LegPagina.'"), $font, $size);

  $foot = $pdf->open_object();
  $w = $pdf->get_width();
  $h = $pdf->get_height();
  // Draw a line along the bottom
  $y = $h - $text_height - 10;
  $pdf->line(25, $y - 7, $w - 25, $y - 7, $color, 0.5);
  $pdf->close_object();
  $pdf->add_object($foot, "all");
  $text = "'.$class_fLNG->txt(__FILE__,__LINE__,'Página').' {PAGE_NUM} de {PAGE_COUNT} '.$this->LegPagina.'";  
  // Center the text
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);';
  
		//verifica se adiciona legenda de assinatura de paginas
		if($this->LegAssinatura != ""){
			$htmlRet .= '
  $font = $fontMetrics->getFont("helvetica", "bold");
  $size = 6;
  $width = $fontMetrics->getTextWidth("'.$this->LegAssinatura.'", $font, $size);  
  $assin = $pdf->open_object();
  $w = $pdf->get_width();
  $h = $pdf->get_height();
  // Draw a line along the bottom
  $y = $h - $text_height - 10;
  $pdf->line(25, $y - 7, $w - 25, $y - 7, $color, 0.5);
  $pdf->close_object();
  $pdf->add_object($assin, "all");
  $text = "'.$this->LegAssinatura.'";  
  // Center the text
  $pdf->page_text($w - 5, $h / 2 + $width / 2, $text, $font, $size, $color, 0, 0, -90);';
		}//if($this->LegAssinatura != ""){  
	$htmlRet .= '
}
</script>';
		}//if($this->Npagina == "1"){

	
		//verifica se tem cabecalho ou rodape
		if(($this->Cabecalho["1"] != "") or ($this->Cabecalho["2"] != "")){
			$htmlRet .= '
<div id="header">
  <table>
    <tr>';
	
			//ferifica se mostra data cabeçalho
			if($this->tituloData != ""){ $mostraData = '<span class="data">'.$this->tituloData.'</span><br>'; }else{ $mostraData = ''; }
			
			//verifica se adiciona segunda parte do cabeçalho
			if($this->Cabecalho["2"] != ""){
				$htmlRet .= '
      <td style="padding:0; vertical-align:bottom;	width:'.$this->CabecalhoW1.';">'.$this->Cabecalho["1"].'</td>';
				$htmlRet .= '
      <td style="text-align:right; padding:0; vertical-align:bottom; width:'.$this->CabecalhoW2.';">'.$mostraData.$this->Cabecalho["2"].'</td>';
			}else{//if($this->Cabecalho["2"] == "1"){
				$htmlRet .= '
      <td valign="bottom" style="padding:0;">'.$mostraData.$this->Cabecalho["1"].'</td>';
			}//else{//if($this->Cabecalho["2"] == "1"){
		
			$htmlRet .= '
    </tr>
  </table>
  '.$this->MarcaDagua.'
</div>';
		}else{//if(($this->Cabecalho["1"] != "") or ($this->Cabecalho["2"] != "")){
			if($this->MarcaDagua != ""){
			$htmlRet .= '
<div id="header">
  '.$this->MarcaDagua.'
</div>';
			}//$this->MarcaDagua
		}//else{//if(($this->Cabecalho["1"] != "") or ($this->Cabecalho["2"] != "")){
			

		$htmlRet .= '
<div id="divHtml">'.$html.'</div></body></html>
';
//$htmlRet = $html;
//echo $htmlRet; exit(0);

    	$htmlRet = stripslashes($htmlRet);
		$this->HtmlRet = $htmlRet;
	}//conteudo
	
	public function gerarPDF($acao){
		if($this->Caminho != "OFF"){
			//require_once($this->Caminho."sys/dompdf/dompdf_config.inc.php");//class de PDF -brn
			require_once($this->Caminho."sys/dompdf/autoload.inc.php");//class de PDF						
			if($this->Memoria != ""){ $old_limit = ini_set("memory_limit", $this->Memoria); }//max size
			if($acao == "down"){
				//gera o pdf - COM DOWNLOAD
				//$dompdf = new DOMPDF(); -brn
				$dompdf = new Dompdf\Dompdf();				
				$dompdf->load_html($this->HtmlRet);
				$dompdf->set_paper($this->Papel, $this->Orientacao);
				$dompdf->render();
				$dompdf->stream($this->NomeFile);//*/
			}elseif($acao == "save"){
				//gera o pdf - COM DOWNLOAD
				//$dompdf = new DOMPDF(); -brn
				$dompdf = new Dompdf\Dompdf();				
				$dompdf->load_html($this->HtmlRet);
				$dompdf->set_paper($this->Papel, $this->Orientacao);
				$dompdf->render();
				$pdf = $dompdf->output(); // Cria o pdf
				if(file_put_contents($this->NomeFile,$pdf)) { //Tenta salvar o pdf gerado
					return true; // Salvo com sucesso.
				} else {
					return false; // Erro ao salvar o arquivo
				}
			}elseif($acao == "bin"){
				//gera o pdf - COM RETORNO BINÁRIO
				//$dompdf = new DOMPDF(); -brn
				$dompdf = new Dompdf\Dompdf();				
				$dompdf->load_html($this->HtmlRet);
				$dompdf->set_paper($this->Papel, $this->Orientacao);
				$dompdf->render();
				$pdf = $dompdf->output(); // Cria o pdf
				return $pdf; // retorna o pdf em string
			}else{
				//gera o pdf - SEM DOWNLOAD
				//$dompdf = new DOMPDF(); -brn
				$dompdf = new Dompdf\Dompdf();				
				$options["Attachment"] = "0";//abrir no navegador
				$dompdf->load_html($this->HtmlRet);
				$dompdf->set_paper($this->Papel, $this->Orientacao);
				$dompdf->render();
				$dompdf->stream($this->NomeFile, $options);//*/
			}
		}else{ echo "Erro no conteúdo! Classe OFF."; }
	}//gerarPDF
	
	
	
	//faça a chamada da função passando o nome do diretório para $file
	private function deleteDir($file) {
		if(file_exists($file)) {
		 //  chmod($file,0777);
		   if (is_dir($file)) {
			 $handle = opendir($file);
			 while($filename = readdir($handle)) {
			   if ($filename != "." && $filename != "..") {
				delete($file."/".$filename);
			   }
			 }
			closedir($handle);
			 rmdir($file);
		   } else {
			unlink($file);
		   }
		}
	}//fim função remove arquivos e pastas
	
	
	//função de conversão de PDF comum para JPG-PDF (converte as páginas em jpg depois volta pra pdf) +++++++++++++++++++++++++++++
	public function convertPDF($file_pdf,$temp_dir,$temp_pdf_bin="",$file_destino="",$timeout="300"){
		$contRet = "0";
		if(((file_exists($file_pdf)) and (file_exists($temp_dir))) or (($temp_pdf_bin != "") and (file_exists($temp_dir)))){
			//Gerando um nome aleatório para a pasta temp
			$pastaTemp = md5(uniqid(time()));
			$caminhoTemp = $temp_dir.$pastaTemp;
			mkdir($caminhoTemp, 0775);
			chmod($caminhoTemp, 0775);
			if(file_exists($caminhoTemp)){

				//verifica se cria um arquivo com binário do PDF
				if($temp_pdf_bin != ""){
					$file_pdf = $caminhoTemp."/temp.pdf";
					file_put_contents($file_pdf,$temp_pdf_bin);//cria um PDF temporário
				}//if($temp_pdf_bin != ""){
				//ajusta nomes de tratamento
				if($file_destino == ""){
					$caminhoOld = $file_pdf."_OLD.pdf";
					$caminhoConv = $file_pdf;
					$exec = "mv ".$caminhoConv." ".$caminhoOld;
					$output = exec($exec);  //echo "<br><br>CMD($exec): <br>".$output;//cria cópia de conversão
					//rename($caminhoConv, $caminhoOld);
				}else{ $caminhoConv = $file_destino; $caminhoOld = $file_pdf; }	
				//busca tamanho máximo de páginas
				$cont_pgs = "0";
				$exec = 'identify -format "%G\n" '.$caminhoOld;
				$output = shell_exec($exec); //echo "<br><br>CMD($exec): <br>".$output;		
				$arrD = explode("\n", trim($output));
				$wid = "0"; $hei = "0";//vars de tamnho padrão
				$cont_ARRAY = ceil(count($arrD));
				//listar item ja cadastrados
				if($cont_ARRAY >= "1"){
					foreach ($arrD as $pos => $valor){
						if($valor != ""){
							$d = explode("x", $valor); //echo "<br>-".$valor;
							if($d["0"] > $wid){ $wid = $d["0"]; }
							if($d["1"] > $hei){ $hei = $d["1"]; }
							$cont_pgs++;	
						}//if($valor != ""){
					}//fim foreach
				}//fim if($cont_ARRAY >= "1"){
				//verifica se o número de páginas for grande faz ajsute da execução do PHP
				if($cont_pgs > "5"){ set_time_limit(60); }//aumenta tempo de execução PHP
				if($cont_pgs > "10"){ set_time_limit(120); }//aumenta tempo de execução PHP
				if($cont_pgs > "20"){ set_time_limit(300); }//aumenta tempo de execução PHP
				//se não encontrou valores põe padrão A4 - 595x842
				if($wid == "0"){ $wid = "595"; } if($hei == "0"){ $hei = "842"; }
				//verifica se página maior que A2
				$correcao = "";
				if($wid > $hei){//"paisagem";
					if($wid > "1684"){
						$wid = "1684"; $hei = "1190";
						$correcao = '<div style="position:absolute; left:5px; bottom:15px; color:#F00; z-index:66; font-size:10px;">SYS: DOCUMENTO FOI REDUZIDO AUTOMATICAMENTE PARA O FORMATO A2 - PAISAGEM</div>';
					}
				}else{//"retrato";
					if($wid > "1190"){
						$wid = "1190"; $hei = "1684";
						$correcao = '<div style="position:absolute; left:5px; bottom:15px; color:#F00; z-index:66; font-size:10px;">SYS: DOCUMENTO FOI REDUZIDO AUTOMATICAMENTE PARA O FORMATO A2 - RETRATO</div>';
					}
				}
				//gera os JPGs para montagem
				//$resolucao = "135";	if($wid >= "800"){ $resolucao = "200"; }//monta a resolução	se pagina maior ajusta - -dJPEGQ=20 (baixo)
				$resolucao = "140";	if($wid >= "800"){ $resolucao = "250"; }//monta a resolução	se pagina maior ajusta - -dJPEGQ=25 (medio)
				$exec = 'pageNum=`ghostscript -q -dNODISPLAY -c "('.$caminhoOld.') (r) file runpdfbegin pdfpagecount = quit"`
timeout '.$timeout.'s ghostscript -dNumRenderingThreads=4 -dNOPAUSE -sDEVICE=jpeg -dFirstPage=1 -dLastPage=$pageNum -sOutputFile="'.$caminhoTemp.'/image%d.jpg" -dJPEGQ=25 -r'.$resolucao.' -q '.$caminhoOld.' -c quit';
				$output = exec($exec);// echo "<br><br>CMD($exec): <br>".$output;	
				//verifica pasta TEMP com imagens
				$wid_i = ($wid-4); $hei_i = ($hei-4);//dimensões máximas das imagens
				$html_imgs = "";//vars de tags html
				$filesArray = scandir($caminhoTemp);
				//echo "<br>ARR:  <pre>"; print_r($filesArray); echo "</pre>";
				unset($filesArray[array_search('', $filesArray)]); unset($filesArray[array_search('.', $filesArray)]);
				unset($filesArray[array_search('..', $filesArray)]); unset($filesArray[array_search('temp.pdf', $filesArray)]);
				$cont_ARRAY = ceil(count($filesArray));
				//listar item ja cadastrados
				if($cont_ARRAY >= "1"){
					$cont = "0";
					foreach ($filesArray as $pos => $valor){
						if($valor != ""){ $cont++;
							//$url_arq = $caminhoTemp."/".$valor; //echo "<br>- $url_arq";
							$url_arq = $caminhoTemp."/image".$cont.".jpg"; //echo "<br>- $url_arq";
							chmod($url_arq, 0775);					
							//verifica o tamanho da imagem
							$tamanhos = getimagesize("$url_arq");//$tamanhos[0] w - $tamanhos[1] h
							$pt_w = ($tamanhos[0]*0.75292857248934); $pt_h = ($tamanhos[1]*0.75292857248934);
							//calcular W
							if($pt_w <= $pt_h){
								$p_calc = $pt_h/$pt_w;
								if($pt_w >= $wid){
									$wid_i = $wid;
								}else{
									$wid_i = $pt_w;
								}
								$hei_i = ($p_calc*$wid_i);
								if($hei_i > $hei){
									$wid_i = $hei/$p_calc;
									$hei_i = $hei;
								}
							}else{//if($pt_w <= $pt_h){
								$p_calc = $pt_w/$pt_h;
								if($pt_h <= $hei){
									$hei_i = $hei;
								}else{
									$_calc = $pt_h/$hei;
									$hei_i = $_calc*$hei;
								}
								$wid_i = ($p_calc*$hei);
								if($wid_i > $wid){
									$hei_i = $wid/$p_calc;
									$wid_i = $wid;
								}								
							}//else{//if($pt_w <= $pt_h){							
							$wid_i = ($wid_i-4); $hei_i = ($hei_i-4);								
							//monta dimensões
							$html_imgs .= '<div style="text-align:center; width:'.$wid.'pt; height:'.$hei.'pt;"><img src="'.$url_arq.'" style="width:'.$wid_i.'pt; height:'.$hei_i.'pt;">'.$correcao.'</div>';						
																		
						}//if($valor != ""){
					}//fim foreach
				}//fim if($cont_ARRAY >= "1"){
				//echo "<br>FINAL: ".$wid.' x '.$hei;
				//echo $html_imgs;
				//inicia montagem do PDF de fato
				if($html_imgs != ""){
					if(($file_destino == "") and ($caminhoOld != "") and ($caminhoOld != "/")){ shell_exec("rm -rvf ".$caminhoOld); }//remove copia de conversao
					$html_load = stripslashes($html_imgs);					
					//verifica se existe erro no bloco de códigos
					try {					
						//CLASSES GERAR PDF ---> > >
						$this->nomeFile($caminhoConv);
						$this->cssPage("margin:0;");
						$customPaper = array(0,0,$wid,$hei);
						$this->papel($customPaper);
						//$classe_pdf->orientacao("paisagem"); }///para aivar modo paisagem - 250px
						$this->conteudo($html_load); 
						//$this->gerarPDF("view"); exit(0);						
						//verifica se recebeu binário do PDF, retorna o binário
						if($temp_pdf_bin != ""){
							$contRet = $this->gerarPDF("bin");//põe binário no retorno
						}else{//if($temp_pdf_bin != ""){						
							//gera o pdf - FILE
							if($this->gerarPDF("save")){
								$contRet++;//define retorno OK
							}else{
								if(($file_destino == "") and ($caminhoOld != "")){ shell_exec("mv ".$caminhoOld." ".$caminhoConv); }//volta cópia de conversão
							}							
						}//else{//if($temp_pdf_bin != ""){
					} catch (Exception $e) {
						if(($file_destino == "") and ($caminhoOld != "")){ shell_exec("mv ".$caminhoOld." ".$caminhoConv); }//volta cópia de conversão
					}//catch*/
				}//if($html_imgs != ""){
				//apaga pasta temp criada
				$this->deleteDir($caminhoTemp);
			}//if(file_exists($caminhoTemp)){
		}//if(((file_exists($file_pdf)) and (file_exists($temp_dir))) or (($temp_pdf_bin != "") and (file_exists($temp_dir)))){
		return $contRet;
	}//convertPDF
	
	
	//................ FUNÇÕES DE USO DIRETO .....................	
	static function compressPDF($origem,$destino="",$nivel="screen",$timeout="300"){
		if($destino == "FORCE"){ $destino = ""; $force = "1"; }else{ $force = "0"; } 
		if($origem == $destino){ $destino = ""; }		
		set_time_limit($timeout);
		if((($nivel == "default") or ($nivel == "screen") or ($nivel == "ebook")) and ($origem != "")){ $exec = "";
			$caminhoOrig = $origem;
			$tmIni = filesize($caminhoOrig);
			if($destino == ""){
				$caminhoOld = $origem."_OLD";
				if($exec != ""){ $exec .= ";"; } $exec .= "mv ".$caminhoOrig." ".$caminhoOld;//cria cópia de conversão
			}else{ $caminhoOrig = $destino; $caminhoOld = $origem; }
			if($exec != ""){ $exec .= ";"; } $exec .= "timeout ".$timeout."s ghostscript -sDEVICE=pdfwrite -dSAFER -dCompatibilityLevel=1.5 -dPDFSETTINGS=/".$nivel." -dAutoRotatePages=/None -dNOPAUSE -dQUIET -dBATCH -sOutputFile=".$caminhoOrig." ".$caminhoOld;
			//if($exec != ""){ $exec .= ";"; } $exec .= "ghostscript  -q -dNOPAUSE -dBATCH -dSAFER -sDEVICE=pdfwrite -dCompatibilityLevel=1.5 -dPDFSETTINGS=/".$nivel." -dEmbedAllFonts=true -dSubsetFonts=true -dAutoRotatePages=/None -dColorImageDownsampleType=/Bicubic -dColorImageResolution=150 -dGrayImageDownsampleType=/Bicubic -dGrayImageResolution=150 -dMonoImageDownsampleType=/Bicubic -dMonoImageResolution=150 -sOutputFile=".$caminhoOrig." ".$caminhoOld;
			$output = shell_exec($exec); $exec = "";
			if($output == ""){//caso tenha ativado o TIMEOUT volta o arquivo original
				if($destino == ""){	$exec .= "rm -rvf ".$caminhoOrig; }//remove copia de conversao
				if($exec != ""){ $exec .= ";"; } $exec .= "mv ".$caminhoOld." ".$caminhoOrig;
			}else{
				if($destino == ""){	$exec .= "rm -rvf ".$caminhoOld; }//remove copia de conversao				
			}
			//flush(); ob_flush();
			//$tmOld = filesize($caminhoOrig);
			/*if($force == "1"){
				if($destino == ""){	$exec = "rm -rvf ".$caminhoOld; }//remove copia de conversao
			}else{
				$valida_conversao = "1";
				if(strlen($output) >= "10"){ $valida_conversao = "0"; }//verifica se teve retorno de erros 
				if($valida_conversao == "1"){
					$out = shell_exec("du -hsb ".$caminhoOrig); $l = explode("	", $out); $tmOld = (int)$l["0"];
					if($tmOld > $tmIni){ $valida_conversao = "0"; }
				}//if($valida_conversao == "1"){
				if($valida_conversao == "0"){
					//se houe erros ele tenta uma outra forma de conversão
					$exec = "gs -dPDFSETTINGS=/prepress -dAutoRotatePages=/None -dSAFER -dCompatibilityLevel=1.4 -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sstdout=%stderr -dGrayImageResolution=50 -dMonoImageResolution=50 -dColorImageResolution=20 -sOutputFile=".$caminhoOrig." ".$caminhoOld;//linha da conversão
					$exec .= ";rm -rvf ".$caminhoOld;//linha remove copia de conversao
				}else{//if($valida_conversao == "0"){	
					if($destino == ""){	$exec = "rm -rvf ".$caminhoOld; }//remove copia de conversao
				}//else{//if($valida_conversao == "0"){	
			}//*/
			if($exec != ""){ $output .= shell_exec($exec); }
		}//if((($nivel == "default") or ($nivel == "screen") or ($nivel == "ebook")) and ($origem != "")){
	}//compressPDF
	
	static function ajusteFpdiPDF($origem,$timeout="300"){
		$caminhoOrig = $origem; $caminhoOld = $origem."_OLD";
		$exec = "mv ".$caminhoOrig." ".$caminhoOld;//cria cópia de conversão
		$exec .= ";timeout ".$timeout.'s ghostscript -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="'.$caminhoOrig.'" "'.$caminhoOld.'"';
		$exec .= ";rm -rvf ".$caminhoOld;
		exec($exec);
	}//ajusteFpdiPDF
}//class fPDF
/* CLASSE DE PDF - ( fPDF 3.3 ) ------------------------------------------------------------------<<<*/
















/* CLASSE DE GERAÇÃO DE CSVS - ( fCSV 1.0 ) ------------------------------------------------------------------>>>*/
/*	GERAR CSV 10/06/2015
$classe_csv = new fCSV();//inicia a classe
$classe_csv->titulo("Titulo do CSV");//tículo, vai na primeira celula/linha
$classe_csv->addHtml("campo;campo\n");//envio dados completos 
$classe_csv->gerarCSV();

$classe_csv = new fCSV();//inicia a classe
$classe_csv->titulo("Titulo do CSV");//tículo, vai na primeira celula/linha
$classe_csv->addCampo("campo");//cria campo da linha - adicionar varios desse pra formar a linha
$classe_csv->addCampo("campo");//cria campo da linha - adicionar varios desse pra formar a linha
$classe_csv->addLinha();//cria/quebra uma linha
$classe_csv->addCampo("campo");//cria campo da linha - adicionar varios desse pra formar a linha
$classe_csv->addCampo("campo");//cria campo da linha - adicionar varios desse pra formar a linha
$classe_csv->bufferCampo("nome var","conteudo campo");//cria campo da linha buffer - cria uma var de campos que pode ser adicionado em uma posição a frente
$classe_csv->addCampoBuffer("nome var");//adiciona campos da linha buffer - buffer criado é adicionado
$classe_csv->addLinha();//cria/quebra uma linha
$classe_csv->gerarCSV();

*/
class fCSV{	
	private $NomeFile;	
	private $Titulo = "";
	private $tituloData = "";
	private $Encode = "utf8_decode";
	private $Buffer;
	private $HtmlRet;

	//funcao prepara CVS
	public function preparaCampo($html){
		$html = $this->encode($html);//codificação
		$html = addslashes($html); $html = strip_tags($html);
		$html = str_replace("&nbsp", "", $html);
		$html = preg_replace("/\r?\n/","", $html);
		$html = preg_replace('/\s/',' ',$html);
		$html = str_replace(";", " ", $html);
		return str_replace("  ", " ", $html);
	}

	public function encode($dados){
		if($this->Encode == "utf8_decode"){ $dados = utf8_decode($dados); }
		if($this->Encode == "utf8_encode"){ $dados = utf8_encode($dados); }
		return $dados;
	}

	public function setEncode($encode){
		if($encode != ""){ $this->Encode = $encode; }
	}

	public function nomeFile($nome){
		if($nome != ""){ $this->NomeFile = $nome; }
	}
		
	public function titulo($titulo){
		$this->Titulo = $this->preparaCampo($titulo);
	}

	public function mostraData($data){
		$this->tituloData = $this->preparaCampo($data);
	}
		
	public function addHtml($html){
		$this->HtmlRet = $this->encode($html);
	}
	
	public function addCampo($html){
		$this->HtmlRet .= $this->preparaCampo($html).";";
	}
	
	public function bufferCampo($var,$html){
		$this->Buffer["$var"] .= $this->preparaCampo($html).";";
	}
	
	public function addCampoBuffer($var,$acao=""){
		if($acao == "limpar"){ unset($this->Buffer["$var"]); }
		if(isset($this->Buffer["$var"])){
			$this->HtmlRet .= $this->Buffer["$var"];
			unset($this->Buffer["$var"]);
		}
	}

	public function addLinha(){
		$dados = $this->HtmlRet.";-[-]";
		$dados = str_replace(";;-[-]", "", $dados); $dados = str_replace(";-[-]", "", $dados);
		$this->HtmlRet = $dados."\n";
	}
	
	public function gerarCSV(){
		if($this->Titulo != ""){
			if($this->tituloData != ""){
				$this->HtmlRet = $this->Titulo.";".$this->tituloData."\n".$this->HtmlRet;
			}else{
				$this->HtmlRet = $this->Titulo."\n".$this->HtmlRet;				
			}
		}
		$html_load = stripslashes($this->HtmlRet);		
		// envia todos cabecalhos HTTP para o browser (tipo, tamanho, etc..)
		header("Content-Description: File Transfer");
		header("Content-Type: application/save"); 
		header("Content-Disposition: attachment; filename=\"".$this->NomeFile.".csv\""); 
		header("Content-Transfer-Encoding: binary");		
		//imprime o conteudo
		echo $html_load;
	}
}//class fCSV
/* CLASSE DE CSV - ( fCSV 1.0 ) ------------------------------------------------------------------<<<*/













class fGERAL{ //***************************************************************************************************************@
	
	static function NVerificadorValida($nverificador){
		$nverificador = fGERAL::limpaCode($nverificador);
		$arr["nverificador"] = $nverificador;
		$arr["tipo_servico_id"] = substr($nverificador,0,1);
		
		$arr["time"] = substr($nverificador,1,9)."0";		
		$arr["origem_id"] = substr($nverificador,12,1);		
		$arr["code"] = substr($nverificador,1,11);		
		
		$valida = true;
		//validar tipo serviço
		$array = categoriaServicoArrCompleto();	if(!isset($array[$arr["tipo_servico_id"]])){ $valida = false; }
		//validar time
		$time_base = strtotime(date("Y-m-d", strtotime('-5 days', time())));
		if($arr["time"] < $time_base){ $valida = false; }
		//validar origem
		$linha = fSQL::SQL_SELECT_ONE("apelido,icon","sys_perfil","origem_id = '".$arr["origem_id"]."'");
		if($linha["apelido"] == "" and $arr["origem_id"] >= "1"){ $valida = false; }else{ $arr["origem_id_n"] = $linha["apelido"]; }
		//validar code
		if(cpfj($arr["code"]) != "1"){ $valida = false; }
		
		if(!$valida){ $arr = ""; }else{
			$array = categoriaServicoArrCompleto();
			$array = $array[$arr["tipo_servico_id"]];
			$arr["tipo_servico"] = $array["tipo"];
		}
		
		return $arr;
	}//NVerificadorValida
	
	static function jsonArray($dados,$acao="enc"){
		if($acao == "dec"){
			//$dados = str_replace("\\\\", "\\", $dados);
			$vars = json_decode($dados, true);
		}else{
			//$dados = stripslashes_deep($dados);//remove tags \' para '			
			$vars = json_encode($dados);
			//if($acao == "encDB"){ $vars = str_replace("\\\\\\'", "", $vars); }
			//if($acao == "encDB"){ $vars = str_replace("\\", "\\\\", $vars); $vars = str_replace("\\\\\\'", "", $vars); }
		}
		if($vars == "null"){ $vars = 'NULL'; }
		return $vars;
	}//jsonArray
	

	//funcao que corrige url kookies
	static function kookiesUrl(){
		$url = str_replace("www.", "", $_SERVER['HTTP_HOST']);//"redeqg.com.br";//url mestre
		$d = explode(":", $url);
		return $d["0"];
	}//fim da funcao kookiesUrl
	
	//funcao que verifica subdominio url kookies
	static function kookiesUrlSub(){
		$url = str_replace("www.", "", $_SERVER['HTTP_HOST']);
		$urlS = str_replace(".br", "", $url);
		$cont = substr_count($urlS, ".");
		$ret = "";
		if($cont >= "2"){
			$d = explode(".", $url);
			$sub = str_replace($d["0"].".", "", $url);
			$d = explode(":", $sub);
			$ret = $d["0"];
		}
		return $ret;
	}//fim da funcao kookiesUrlSub

	//funcao que seta os kookies do siatema
	static function kookies($nome_var,$var, $grava){
		$URL_COOKIES = fGERAL::kookiesUrl();
		///verifica se guarda o cookie neste conputador
		$valida = "0";
		if($grava == "1"){
			$tempo = time()+157788000;//5 anos
			setcookie($nome_var.SYS_COOKIE_ID,$var, $tempo,"/",$URL_COOKIES);
			//setcookie($nome_var,$var, $tempo,"/",".colegioluciavasconcelos.com");
			$valida++;
		}else{
			setcookie($nome_var.SYS_COOKIE_ID,$var,0,"/",$URL_COOKIES);
			//setcookie($nome_var,$var,0,"/",".colegioluciavasconcelos.com");
			$valida++;
		}//fim else
		return $valida;
	}//fim da funcao que seta o cookie
	
	//funcao que pega os kookies do site
	static function getKookies($nome_var){
		if(isset($_COOKIE[$nome_var.SYS_COOKIE_ID])){ return $_COOKIE[$nome_var.SYS_COOKIE_ID]; }
	}//fim da funcao que pega o cookie
	
	//funcao que destroe os kookies do site
	static function kookies_OFF($nome_var){
		$URL_COOKIES = fGERAL::kookiesUrl();
		$SUB_COOKIES = fGERAL::kookiesUrlSub();
		///verifica se guarda o cookie neste conputador
		$tempo = -3600; 
		$var = "";
		setcookie($nome_var.SYS_COOKIE_ID,$var, $tempo,"/",$URL_COOKIES);
		if($SUB_COOKIES != ""){ setcookie($nome_var.SYS_COOKIE_ID,$var, $tempo,"/",$SUB_COOKIES); }
	}//fim da funcao que seta o cookie
	
	//funcao que seta os kookies html do siatema
	static function kookie_html($nome_var,$var){
		echo "<script>setCookie('".$nome_var."', '".$var."');</script>";
	}//fim da funcao que seta o cookie
	
	
	
	
	
	//trata vars GET x POST NO MYSQL
	static function getpost_sql($string,$extra='0'){
		//$string = utf8_decode($string);
		$string = trim($string);
		$string = addslashes($string);
		$string = get_magic_quotes_gpc() ? stripslashes($string) : $string;    
		//$string = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($string) : mysql_escape_string($string);
		$string = str_replace('<script','< script',$string);
		$string = str_replace('</script','< /script',$string);
		if($extra == "0"){
			$string = str_replace('\"','"',$string);
		}
		if($extra == "MAIUSCULO"){
			$string = maiusculo($string);
		}
		if($extra == "ENTER"){
			$string = nl2br($string);
			$string = str_replace("\r\n","",$string);
			$string = str_replace("\r","",$string);
			$string = str_replace("\n","",$string);
		}
		if($extra == "DIVISOR"){
			$string = str_replace('[,]','',$string);
			$string = str_replace('[-]','',$string);
		}
		if($extra == "FILE"){
			$string = str_replace('\"','"',$string);
			$string = str_replace('\n','',$string);
		}
		if($extra == "DOC"){
			$string = str_replace('.','',$string);
			$string = str_replace('-','',$string);
			$string = str_replace('/','',$string);
		}
		if($extra == "PREFIXO"){
			$string = removePrefixo($string);
		}
		if($extra == "VALOR"){
			$string = removePrefixo($string);
			$string = valSoma($string);
		}
		if($extra == "VALOR_VALIDA"){
			$string = removePrefixo($string);
			$string = valSoma($string);
			if(!is_numeric($string)){ $string = 0; }
		}
		if($extra == "enc"){
			$string = utf8_encode($string);
		}
		if($extra == "dec"){
			$string = utf8_decode($string);
		}
		if($extra == "DATA"){
			$string = data_mysql($string);
			if(($string == "") or ($string == "00/00/0000") or ($string == "0000-00-00")){ $string = 'NULL'; }
		}
		if($extra == "NULL"){
			if($string == ""){ $string = 'NULL'; }
		}
		if($extra == "ARRAY-P"){
			$string = str_replace(',','.',$string);
			if($string == ""){ $string = 'NULL'; }else{
				$string = "[.".$string.".]";
			}
		}
		if($extra == "ARRAY-V"){
			if($string == ""){ $string = 'NULL'; }else{
				$string = "[,".$string.",]";
			}
		}
		return $string;
	}//fim get post
	
	//Função verifica que o email é válido
	/*
	Exemplo de USO:
	echo verifica_email($email); //retorna 1 se for válido
	*/
	static function verifica_email($EMail){
		$valida_email = "0";
		if(filter_var($EMail, FILTER_VALIDATE_EMAIL)){
			$valida_email = "1";
		}
		if($valida_email == "1"){
			list($User, $Domain) = explode("@", $EMail);
			if (function_exists('checkdnsrr')) {
				$Result = checkdnsrr($Domain, 'MX');
			} else {
				$Result = "1";//
			}
	
			//$Result = checkdnsrr($Domain, 'MX');
			$valida_email = $Result;
		}
		if($valida_email != "1"){ $valida_email = "0"; }
		return $valida_email;
	}//fim função verifica_email($EMail)
	
	

		
	
	/*Função destinada a verificacao de URL externas*/
	static function url_exists($url){
		$fp=@fopen($url,"r");
		return ($fp)? 1 : 0;
	}//fim url_exists 
	
	//limpar cache do navegador
	static function limparCacheNavegador() {
		header("Pragma: no-cache");
		header("Cache: no-cache");
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}//limparCacheNavegador
	
	
	//funcao gera KEY(alfanumerica) unico
	/*
	Exemplo de USO:
	echo key_rand();//imprime: 77d018b49bad0e75f1b908e794370b14 (numero unico)
	*/
	static function key_rand($var=''){
	//monta numero para envio
		return md5($var.uniqid(time().rand(), true));
	}//function 
	//fim gera KEY(alfanumerica) unico
	
	
	
	
	
	
	//função gerar chave randonica de scring
	static function gerarChave($ncaracteres,$acao="padrao") {
		$caracterespermitidos = $acao; $nchars = $ncaracteres+5;
		if($acao == "padrao"){ $caracterespermitidos = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; }
		if($acao == "numerico"){ $caracterespermitidos = "1234567890"; }
		if($acao == "nivel1"){ $caracterespermitidos = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"; }
		if($acao == "nivel2"){ $caracterespermitidos = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; }
		if($acao == "nivel3"){ $caracterespermitidos = ")(*&¨%$#@!ºª:><,.;?/\|´`1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; }
		$total_carac = strlen ($caracterespermitidos);
		for ($i=0; $i <= $nchars; $i++) {
			$chave .= $caracterespermitidos{rand(0,$total_carac)};
		}
		//return $chave."-".strlen ($chave);
		$chave = substr($chave,0,$ncaracteres);
		return $chave;
	}//gerarChave
	

	
	
	
	///***************************** cria e verifica serial *****************************///////////
	/*cria o serial
	exemplo: $serial = getSerial( 'VERIFICADOR NOME' );
	*/
	static function getSerial($name = null, $divisor=''){
		$a = hash( 'crc32' , 'chave secreta' );
		$b = hash( 'crc32' , sprintf( '%s%s' , md5( $name ) , md5( $a ) ) );
		$c = sscanf( sprintf( '%s%s' , $a , $b ) , '%4s%4s%4s%4s' );
		$d = 1;
		
		for ( $i = 0 ; $i < 4 ; $i++ )
		for ( $j = 0 ; $j < 4 ; $d += pow( ord( $c[ $i ]{ $j } ) , $i ) , $j++ );
		
		$c[ 4 ] = $d;
		
		return vsprintf( '%s'.$divisor.'%s'.$divisor.'%s'.$divisor.'%s'.$divisor.'%05x' , $c );
	}
	/* verifica serial
	Exemplo: validaSerial( $serial )ç
	*/
	static function validaSerial($serial, $divisor=''){
		$c = sscanf( $serial , '%4s'.$divisor.'%4s'.$divisor.'%4s'.$divisor.'%4s' );
		$d = 1;
		
		for ( $i = 0 ; $i < 4 ; $i++ )
		for ( $j = 0 ; $j < 4 ; $d += pow( ord( $c[ $i ]{ $j } ) , $i ) , $j++ );
		
		$c[ 4 ] = $d;
		
		return !strcmp( $serial , vsprintf( '%s-%s-%s-%s-%05x' , $c ) );
	}
	///***************************** cria e verifica serial *****************************///////////




	//Peparar e Retornar pacote de dados para envio ao servidor SOAP
	static function getsendFile($dados,$acao="get"){
		if($acao == "get"){
			$dados = base64_decode($dados);//decodifica
			$dados = gzuncompress($dados);//descompacta	
		}
		if($acao == "send"){
			$dados = gzcompress($dados,9);//compacta
			$dados = base64_encode($dados);//encodifica	
		}
		return $dados;
	}//fim get send
	
	
	
	
	

	//crypto de senhas para DB
	static function cryptoSenhaDB($dados){
		$crypter = new fCrypter(VAR_KEY_SYS);
		$dados = $crypter->Encrypt($dados);
		return $dados;
	}//fim cryptoSenhaDB
	
	
	

	//crypto de informações do sistema com chave do cliente
	static function cryptoSys($dados,$acao="enc"){
		if($acao == "dec"){
			$crypter = new fCrypter(VAR_KEY_SYS);
			$dados = $crypter->Decrypt($dados);
		}
		if($acao == "enc"){	
			$crypter = new fCrypter(VAR_KEY_SYS);
			$dados = $crypter->Encrypt($dados);
		}
		return $dados;
	}//fim cryptoSys
	
	
	
	
	

	//comproimir e descomprimir dados
	static function compressFile($dados,$acao="get"){
		if($acao == "get"){
			$dados = gzuncompress($dados);//descompacta
		}
		if($acao == "send"){
			$dados = gzcompress($dados,9);//compacta
		}
		return $dados;
	}//fim compressFile
	
	
	
	

	//Peparar e Retornar pacote de dados para envio ao log
	static function logFile($dados,$acao="get"){
		if($acao == "get"){
			$dados = gzuncompress($dados);//descompacta	
			$crypter = new fCrypter(VAR_KEY_SYS);
			$dados = $crypter->Decrypt($dados);
		}
		if($acao == "send"){	
			$crypter = new fCrypter(VAR_KEY_SYS);
			$dados = $crypter->Encrypt($dados);
			$dados = gzcompress($dados,9);//compacta
		}
		return $dados;
	}//fim logFile
	

	static function arrayLog($TABELA,$CAMPOS,$VALORES){
		return array("tabela" => $TABELA, "campos" => $CAMPOS, "valores" => $VALORES);
	}//arrayLog
	

	static function gravaLog($TABELA,$ID,$TABELA_ARRAY,$USER,$SYS="0"){
		//cria a pasta de arquivos do usuario
		$file_tb = VAR_DIR_FILES."files/logs/".$TABELA; //caminho/nome da pasta
		$file_tbi = $file_tb."/".$ID; //caminho/nome da pasta
		$cria = fGERAL::criaPasta($file_tb, "0775"); //confere a criação e retona 1
		if($cria == 1){ fBKP::bkpAddFolder($file_tb); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
		$cria = fGERAL::criaPasta($file_tbi, "0775"); //confere a criação e retona 1
		if($cria == 1){ fBKP::bkpAddFolder($file_tbi); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
		//gera o nome do arquivo
		$nomeFile = fGERAL::fileTime($file_tbi);
		$array = array("time" => time(), "user" => $USER, "sys" => $SYS, "tabela" => $TABELA_ARRAY);
		$array = stripslashes_deep($array);//remove tags \' para '
		$file_ret = fGERAL::logFile(json_encode($array),"send");
		file_put_contents($file_tbi."/".$nomeFile,$file_ret);
		fBKP::bkpFile($file_tbi."/".$nomeFile);//adiciona arquivo em lista de arquivo BACKUP
	}//gravaLog
	

	static function lerLog($FILE){
		//verifica se existe arquivo de log
		//if(file_exists($FILE)){ $array = json_decode(fGERAL::logFile(file_get_contents($FILE)), true); }else{ $array = ""; }
		//chmod($FILE, 0777);
		if(file_exists($FILE)){ $array = fGERAL::logFile(file_get_contents($FILE)); }else{ $array = ""; }
		return $array;
	}//lerLog
	
	
	static function delRegistroLog($TABELA,$ID,$USER){
		//cria a pasta de arquivos do usuario
		$file_tb = VAR_DIR_FILES."files/logs/".$TABELA; //caminho/nome da pasta
		$file_tbi = $file_tb."/".$ID; //caminho/nome da pasta
		$file_tbl = $file_tb."/lixo"; //caminho/nome da pasta
		$cria = fGERAL::criaPasta($file_tbl, "0777"); //confere a criação e retona 1
		if($cria == 1){ fBKP::bkpAddFolder($file_tbl); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
		if(file_exists($file_tbi)){
			//gera o nome do arquivo
			$nomeFile = fGERAL::fileTime($file_tbl);
			//move o arquivo para o novo local
			rename($file_tbi, $file_tbl."/".$nomeFile);
			//cria registro da exclusao
			$array = array("time" => time(), "user" => $USER, "id" => $ID);
			$array = stripslashes_deep($array);//remove tags \' para '
			$file_ret = fGERAL::logFile(json_encode($array),"send");
			file_put_contents($file_tbl."/".$nomeFile."/reg",$file_ret);
			fBKP::bkpFile($file_tbl."/".$nomeFile."/reg");//adiciona arquivo em lista de arquivo BACKUP
		}//if(file_exists($file_tbi)){
	}//delRegistroLog
	
	
		
	

	//Peparar e Retornar pacote de dados para envio web service cliente
	static function webFile($dados,$chave,$acao="get"){
		if($dados == ""){ $acao = "off"; }
		if($acao == "get"){
			$dados = base64_decode($dados);
			$dados = gzuncompress($dados);//descompacta	
			$crypter = new fCrypter($chave);
			$dados = $crypter->Decrypt($dados);
		}
		if($acao == "send"){	
			$crypter = new fCrypter($chave);
			$dados = $crypter->Encrypt($dados);
			$dados = gzcompress($dados,9);//compacta
			$dados = base64_encode($dados);
		}
		return $dados;
	}//fim webFile
//FUNCAO DE CRIPTOGRAFIA FAISHER RANDONICA COM CRAVE ---------------- <<<<<
	
	
	
	
	
	/* fileTime
	Funcao utilizada para criar nome de arquivo com base no TIME UNIX, evita repetir dentro da mesma pasta
	*/
	static function fileTime($CAMINHO="../"){
		$file_t = time();
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		if(file_exists($CAMINHO."/".$file_t)){ $file_t++; }
		return $file_t;
	}//fileTime
	
	
	
	
	
	/* arrayItens
	Funcao utilizada para criar um arary de itens sub array de um array
	*/
	static function arrayItens($ARRAY){
		if(is_array($ARRAY)){
			$arrRet = array();
			//monta array
			$cont_ARRAY = ceil(count($ARRAY));
			//listar item ja cadastrados
			if($cont_ARRAY >= "1"){
				foreach ($ARRAY as $pos => $valor){
					if(is_array($valor)){
						$arrRet = array_merge($arrRet, $valor);
					}else{ $arrRet[] = $valor; } 
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){
			return $arrRet;
		}//if(is_array($ARRAY)){
	}//arrayItens
	
	
		
	
	/*Atribuir mascaras
	$cnpj = "11222333000199";
	$cpf = "00100200300";
	$cep = "08665110";
	$data = "10102010";
	 
	echo mask($cnpj,'##.###.###/####-##');
	echo mask($cpf,'###.###.###-##');
	echo mask($cep,'#####-###');
	echo mask($data,'##/##/####');
	echo mask($fone,'(##) ####-####');
	*/
	static function mask($val, $mask){
		$val = str_replace(".", "", $val);
		$val = str_replace("-", "", $val);
		$val = str_replace('/', "", $val);
		$val = str_replace(' ', "", $val); 
		$val = str_replace('(', "", $val); 
		$val = str_replace(')', "", $val); 
		 $maskared = '';
		 $k = 0;
		 for($i = 0; $i<=strlen($mask)-1; $i++){
			 if($mask[$i] == '#'){
				 if(isset($val[$k])){ $maskared .= $val[$k++]; }
			 }else{
				if(isset($mask[$i])){ $maskared .= $mask[$i]; }
			 }
		 }
		 return $maskared;
	}//mask
	

	
	
	//função que monta datatime para mysql
	/*
	Exemplo do uso:
	1: - com time unix
	*/
	static function datatime_mysql($timeg){
		if($timeg == ""){ $converte='off'; $time1 = "0"; }
		if(preg_match("/-/", $timeg)){ $converte = "time"; }else{  $converte = "data"; }
		if($converte == "time"){
			$t = explode(" ", $timeg);
			$d = explode("-", $t[0]);
			$h = explode(":", $t[1]);
			$dia1 = $d[2]; // Dia inicial da contagem regressiva
			$mes1 = $d[1]; // Mês inicial da contagem regressiva
			$ano1 = $d[0]; // Ano inicial da contagem regressiva
			$hor = $h[0]; // horas
			$min = $h[1]; // minuto
			$seg = $h[2]; // segundos
			if(($dia1 == "0") or ($mes1 == "0") or ($ano1 == "0")){ $time1 = "0"; }else{
				$time1 = mktime($hor,$min,$seg,$mes1,$dia1,$ano1);
			}
		}
		if($converte == "data"){
			$dia1 = date("d",$timeg); // Dia inicial da contagem regressiva
			$mes1 = date("m",$timeg); // Mês inicial da contagem regressiva
			$ano1 = date("Y",$timeg); // Ano inicial da contagem regressiva
			$hor = date("H",$timeg); // horas
			$min = date("i",$timeg); // minuto
			$seg = date("s",$timeg); // segundos
			$time1 = $ano1."-".$mes1."-".$dia1." ".$hor.":".$min.":".$seg;	
		}
		return $time1;
	}//fim funcao datatime_mysql
	
	
	
	
	//Função para listar arquivos de um diretório/pasta usando ordenação por nomes
	//Retorno de array com a lista
	static function listaArquivos($dir,$ordem="asc",$limit="0,0",$remove1="",$remove2="",$remove3=""){
		if(file_exists($dir)){
			$filesArray = scandir($dir);
			unset($filesArray[array_search('', $filesArray)]);
			unset($filesArray[array_search('.', $filesArray)]);
			unset($filesArray[array_search('..', $filesArray)]);
			if($remove1 != ""){ unset($filesArray[array_search($remove1, $filesArray)]); }
			if($remove2 != ""){ unset($filesArray[array_search($remove2, $filesArray)]); }
			if($remove3 != ""){ unset($filesArray[array_search($remove3, $filesArray)]); }
			if($ordem == "cont"){ 
				$arrayRet = ceil(count($filesArray)); unset($filesArray);
			}else{
				$array = array_merge($filesArray); unset($filesArray);
				if($ordem == "desc"){ rsort($array); }
				if(($limit != "0,0") and ($limit != ",") and ($limit != "")){ $d = explode(",",$limit); if($d["0"]=="0"){ $d["1"]++; } $arrayRet = array_slice($array, $d["0"], $d["1"]); }else{ $arrayRet = $array; }
			}
			return $arrayRet;
		}else{ if($ordem == "cont"){ return 0; } }//if(file_exists($filesArray)){
	}//listaArquivos
	
	
	
	
	//Função para criar nova PASTA CONT
	//Informe o caminho, função verifica a pasta e cria pasta cont, retornando o valor criado string
	static function criaPastaCont($dir,$remove1="",$remove2="",$remove3=""){
		$cont = "0";
		if(($dir != "") and ($dir != "/")){
			$array = fGERAL::listaArquivos($dir,"desc","0,0",$remove1,$remove2,$remove3);
			if(isset($array["0"])){ $cont = ((int)$array["0"])+1; }else{ $cont = "1"; }
			$cria = fGERAL::criaPasta($dir."/".$cont, "0777"); //confere a criação e retona 1
		}
		return $cont;
	}//criaPastaCont
	
	
	
	
	
	
	
	
	//Função para criar novo FILE CONT
	//Informe o caminho, função verifica a pasta e cria file cont vazio, retornando o valor criado string
	static function criaFileCont($dir,$acao="criar",$remove1="",$remove2="",$remove3=""){
		$cont = "0";
		if(($dir != "") and ($dir != "/")){
			$array = fGERAL::listaArquivos($dir,"desc","0,0",$remove1,$remove2,$remove3);
			if(isset($array["0"])){ $cont = ((int)$array["0"])+1; }else{ $cont = "1"; }
			if($acao != "retorno"){
				file_put_contents($dir."/".$cont,"");
			}
		}
		return $cont;
	}//criaFileCont
	
	
	
	
	
	
	
	
	
	//Função para criar nova PASTA CONT com proteção de repetição (deve usar em conjunto com criaPastaFielContValida)
	//Informe o caminho, função verifica a pasta e cria pasta cont, retornando o valor cont criado
	//code é passado e gravado no arquivo de controle do cont /cria_cont onde após a criação e verificação o mesmo deve ser excluido
	static function criaPastaFielCont($dir,$code,$remove1="",$remove2="",$remove3=""){
		$arrRer["cria_cont"] = ""; $cont = "0";
		try {
			if(($dir != "") and ($dir != "/")){
				$array = fGERAL::listaArquivos($dir,"desc","0,0",$remove1,$remove2,$remove3);
				if(isset($array["0"])){ $cont = ((int)$array["0"])+1; }else{ $cont = "1"; }
				if(!file_exists($dir."/".$cont)){
					if(!file_exists($dir."/".$cont)){//verifica se ja existe
						///cria o diretorio
						if(@mkdir($dir."/".$cont, 0775)){
							chmod($dir."/".$cont, 0775);
							 if(file_exists($dir."/".$cont)){//verifica se criou
								$arrRer["cria_cont"] = $dir."/".$cont."/cria_cont";
								if(file_exists($arrRer["cria_cont"])){
									$arrRer["cria_cont"] = ""; $cont = "0";
								}else{
									file_put_contents($arrRer["cria_cont"],$code);
								}
							}//file_exists
						}else{
							$arrRer["cria_cont"] = ""; $cont = "0";
						}//catch
					}//file_exists
				}else{
					$cont = "0";
				}
			}//if(($dir != "") and ($dir != "/")){
		} catch (Exception $e) {
			$arrRer["cria_cont"] = ""; $cont = "0";
		}//catch		
		//monta retorno
		$arrRer["cont"] = $cont;
		return $arrRer;
	}//criaPastaFielCont		
	//Função para validar o retorno da função criaPastaFielCont (valida e exclue o arquivo de controle)
	//Informe o array de retorno recebido da função anterior criaPastaFielContValida e o code criado para validação
	static function criaPastaFielContValida($array,$code){
		$cont = "0";
		if(($array["cont"] >= "1") and ($array["cria_cont"] != "") and ($array["cria_cont"] != "/") and ($array["cria_cont"] != "./")){
			$val = file_get_contents($array["cria_cont"]);
			if($val == $code){				
				try {
					delete($array["cria_cont"]);
					$cont = $array["cont"];
				} catch (Exception $e) {
					$cont = "0";
				}//catch
			}
		}//if($array["cont"] >= "1"){
		return $cont;
	}//criaPastaFielContValida

	//Função para criar novo FILE CONT com proteção de repetição (deve usar em conjunto com criaFileFielContValida)
	//Informe o caminho, função verifica a pasta e cria arquivo cont, retornando o valor cont criado
	static function criaFileFielCont($dir,$code,$remove1="",$remove2="",$remove3=""){
		$arrRer["cria_cont"] = ""; $cont = "0";
		try {
			if(($dir != "") and ($dir != "/")){
				$array = fGERAL::listaArquivos($dir,"desc","0,0",$remove1,$remove2,$remove3);
				if(isset($array["0"])){ $cont = ((int)$array["0"])+1; }else{ $cont = "1"; }
				if(!file_exists($dir."/".$cont)){
					$arrRer["cria_cont"] = $dir."/".$cont;
					if(file_exists($arrRer["cria_cont"])){
						$arrRer["cria_cont"] = ""; $cont = "0";
					}else{
						file_put_contents($arrRer["cria_cont"],$code);
					}
				}else{
					$cont = "0";
				}
			}//if(($dir != "") and ($dir != "/")){
		} catch (Exception $e) {
			$arrRer["cria_cont"] = ""; $cont = "0";
		}//catch
		//monta retorno
		$arrRer["cont"] = $cont;
		return $arrRer;
	}//criaPastaFielCont		
	//Função para validar o retorno da função criaPastaFielCont (valida e exclue o arquivo de controle)
	//Informe o array de retorno recebido da função anterior criaPastaFielContValida e o code criado para validação
	static function criaFileFielContValida($array,$code){
		$cont = "0";
		if(($array["cont"] >= "1") and ($array["cria_cont"] != "") and ($array["cria_cont"] != "/") and ($array["cria_cont"] != "./")){
			$val = file_get_contents($array["cria_cont"]);
			if($val == $code){
				try {
					file_put_contents($array["cria_cont"],"");
					$cont = $array["cont"];	
				} catch (Exception $e) {
					$cont = "0";
				}//catch
			}
		}//if($array["cont"] >= "1"){
		return $cont;
	}//criaPastaFielContValida	
	
	//Função para criar pastas ou files CONT ID
	//Informe o caminho e tipo de item a criar //$retCont = fGERAL::criaContID($caminhoData,"pasta"); $retCont = fGERAL::criaContID($caminhoData,"file");
	static function criaContID($caminho,$tipo="pasta",$remove1="",$remove2="",$remove3=""){
		//inicia o criação da pasta cont
		$valida_code = md5(uniqid(time())).rand(0,rand());
		$cont = "0"; $retValida = "0";
		while($cont <= "50"){ $cont++;
			//se for pasta
			if($tipo == "pasta"){	
				$arrFileCont = fGERAL::criaPastaFielCont($caminho,$valida_code,$remove1,$remove2,$remove3);
				$retValida = fGERAL::criaPastaFielContValida($arrFileCont,$valida_code,$remove1,$remove2,$remove3);
			}else{//if($tipo == "pasta"){
				$arrFileCont = fGERAL::criaFileFielCont($caminho,$valida_code,$remove1,$remove2,$remove3);
				$retValida = fGERAL::criaFileFielContValida($arrFileCont,$valida_code,$remove1,$remove2,$remove3);	
			}//else{//if($tipo == "pasta"){
			if(($cont >= "10") and ($cont <= "15")){ usleep(50000); }//atraza/pausa o script
			if(($cont >= "17") and ($cont <= "24")){ usleep(500000); }//atraza/pausa o script - meio segundo
			if(($cont >= "30") and ($cont <= "35")){ usleep(1000000); }//atraza/pausa o script - um segundo
			if($retValida >= "1"){ $cont = "1000"; break; }
		}//while
		return $retValida;
	}//criaContID
	
	
	
	
	
	
	
	
	
	/*Função de busca de itens em array
	Verifica a QTD que um item é encontrado em array*/
	static function contaItemArray($elem, $array){
		$cont = "0";		
		if(in_array($elem, $array)){
			$top = sizeof($array) - 1;
			$bottom = 0;
			while($bottom <= $top){
				if($array[$bottom] == $elem){
					$cont++;
				}
				$bottom++;
			}//while
		}//in_array
		return $cont;
	}//contaItemArray
	
	
	
	/*Função que verifica se existe itens repetidos em array
	Se existe retorn true caso não existtir retorna false*/
	static function repetidoItemArray($array){
		if(is_array($array)){
			$cont = ceil(count($array));
			$arrayU = array_unique($array);	
			$contU = ceil(count($arrayU));	
			if($contU == $cont){
				return false;
			}else{
				return true;			
			}
		}else{ return false; }
	}//repetidoItemArray
	
	
	
	
	//funcao que tira a esquerda - echo tira_zero($var);
	static function tiraZero($var){
		$var = str_replace("01", "1", $var);
		$var = str_replace("02", "2", $var);
		$var = str_replace("03", "3", $var);
		$var = str_replace("04", "4", $var);
		$var = str_replace("05", "5", $var);
		$var = str_replace("06", "6", $var);
		$var = str_replace("07", "7", $var);
		$var = str_replace("08", "8", $var);
		$var = str_replace("09", "9", $var);
		return $var;
	}//fim da funcao que insere zero a esquerda
	
	



	
	//funcao prepara string para soma de valores
	static function valSoma($dados){
		if(($dados == "") or ($dados == " ") or ($dados == "  ")){ $dados = "0"; }
		if(preg_match("/\./i", $dados)){ $ponto = "1"; }else{ $ponto = "0"; }
		if(preg_match("/\,/i", $dados)){ $virgula = "1"; }else{ $virgula = "0"; }
		if(($ponto == "1") and ($virgula == "1")){
			$dados = str_replace(".", "", $dados);
			$dados = str_replace(",", ".", $dados);
		}
		if(($ponto == "0") and ($virgula == "1")){
			$dados = str_replace(",", ".", $dados);
		}
		return $dados;
	}////fim da função valSoma


	//Função prepara valor para banco de dados
	/*
	Exemplo de USO:
	echo dbValor($valor); 
	*/
	static function dbValor($valor){	
		$valor = str_replace(" ", "", $valor);	
		$valor = str_replace("R$", "", $valor);	
		$valor = fGERAL::valSoma($valor);
		$valor = number_format($valor, 2, '.', '');//adiciona dois digitos
		return $valor;
	}//fim funcao dbValor()
	
	
	
	//##inicio função cria o pasta/diretório
	//Exemplo:
	// $cria = criaPasta("caminho/caminho/[pasta a criar]"); //confere a criação e retona 1
	static function criaPasta($caminho, $permissao='0777'){
		if(!file_exists($caminho)){ //verifica se ja existe
			///cria o diretorio
			// mkdir ($caminho, $permissao);
			mkdir($caminho, 0777);
			chmod($caminho, 0777);
			 if(file_exists($caminho)){ //verifica se criou
				 return 1;
			 }else{//retorna 1 para sucesso e 0 erro
				 return 0;
			 }
		}else{
			return 0;
		}
	}////##fim função cria o pasta/diretório
	
	



	//mostrar extensao de arquivos
	/*
	Exemplode uso:
	$arquivo = "arquivo.txt"; //nome do arquivo
	echo "Retorna o que vem apos o . > ".mostraExtensao($arquivo);
	*/
	static function mostraExtensao($arquivo,$ret='0'){
		$ex = strrchr($arquivo, ".");//seprara a extencao
		$ex = str_replace(".","",$ex);//tira o ponto
		if($ret == "min"){
			$ex = strtolower($ex);//coloca minusculo
		}
		if($ret == "nome"){
			$arquivo_ = str_replace($ex,'',$arquivo);
			$ex = strtolower($ex);//coloca minusculo
			$ex = $arquivo_.$ex;
		}
		return $ex;
	}//fim funcao mostra extencao
	


	
	//funcao que informa o tamanho de um arquivo, total
	/*
	Exemplo de uso:
	$tamanho_total = tmFile("upload/usuarios/user/foto.jpg");
	echo"<b>Tamanho do arquivo: </b> - $tamanho_total ";
	*/
	static function tmFile($file) {
		if(file_exists($file)){
			$tamanho = filesize($file);		
			$kb = 1024;
			$mb = 1048576;
			$gb = 1073741824;
			$tb = 1099511627776;	 
			if($tamanho<$kb){
				return($tamanho." bytes");	   
			}else if($tamanho>=$kb&&$tamanho<$mb){
				$kilo = number_format($tamanho/$kb,2);
				return($kilo." Kb");
			}else if($tamanho>=$mb&&$tamanho<$gb){
				$mega = number_format($tamanho/$mb,2);
				return($mega." Mb");
			}else if($tamanho>=$gb&&$tamanho<$tb){
				$giga = number_format($tamanho/$gb,2);
				return($giga." Gb");
			}
		}//if(file_exists($file)){
	}//tmFile
	//fim funcao que informa o tamanho de um arquivo, total
	
	
	//função para icone de perfils
	static function icoPerfil($var){
		$ico = "icon-star";
		//busca itens anteriores
		if(($var == "") or ($var == "0")){ $ico = "icon-search"; }
		if($var == "1"){ $ico = "icon-desktop"; }
		if($var == "2"){ $ico = "icon-money"; }
		if($var == "3"){ $ico = "icon-home"; }
		if($var == "4"){ $ico = "icon-bullhorn"; }
		if($var == "5"){ $ico = "icon-screenshot"; }
		if($var == "6"){ $ico = "icon-search"; }
		if($var == "7"){ $ico = "icon-legal"; }
		if($var == "8"){ $ico = "glyphicon-bank"; }
		if($var == "9"){ $ico = "glyphicon-book_open"; }
		if($var == "10"){ $ico = "icon-user"; }
		if($var == "11"){ $ico = "glyphicon-anchor"; }
		if($var == "12"){ $ico = "glyphicon-cars"; }
		if($var == "13"){ $ico = "icon-medkit"; }
		if($var == "14"){ $ico = "glyphicon-heart"; }
		if($var == "15"){ $ico = "glyphicon-usd"; }
		if($var == "16"){ $ico = "glyphicon-spade"; }
		if($var == "17"){ $ico = "glyphicon-tint"; }
		if($var == "18"){ $ico = "glyphicon-tree_conifer"; }
		if($var == "19"){ $ico = "glyphicon-adjust_alt"; }
		if($var == "20"){ $ico = "glyphicon-stats"; }
		if($var == "21"){ $ico = "glyphicon-rotation_lock"; }
		if($var == "22"){ $ico = "glyphicon-lock"; }
		if($var == "23"){ $ico = "glyphicon-soccer_ball"; }
		if($var == "24"){ $ico = "glyphicon-settings"; }
		if($var == "25"){ $ico = "glyphicon-bus"; }
		//busca nos perfils
		$resu = fSQL::SQL_SELECT_SIMPLES("icon", "sys_perfil", "id = '".$var."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu)){
			$ico = $linha["icon"];
		}//fim while
		return $ico;
	}//fim icoPerfil
	
	
	
	//função para icone de perfils
	static function icoOrigem($var){
		$ico = "icon-star";
		//busca itens anteriores
		if(($var == "") or ($var == "0")){ $ico = "icon-search"; }
		if($var == "1"){ $ico = "icon-desktop"; }
		if($var == "2"){ $ico = "icon-money"; }
		if($var == "3"){ $ico = "icon-home"; }
		if($var == "4"){ $ico = "icon-bullhorn"; }
		if($var == "5"){ $ico = "icon-screenshot"; }
		if($var == "6"){ $ico = "icon-search"; }
		if($var == "7"){ $ico = "icon-legal"; }
		if($var == "8"){ $ico = "glyphicon-bank"; }
		if($var == "9"){ $ico = "glyphicon-book_open"; }
		if($var == "10"){ $ico = "icon-user"; }
		if($var == "11"){ $ico = "glyphicon-anchor"; }
		if($var == "12"){ $ico = "glyphicon-cars"; }
		if($var == "13"){ $ico = "icon-medkit"; }
		if($var == "14"){ $ico = "glyphicon-heart"; }
		if($var == "15"){ $ico = "glyphicon-usd"; }
		if($var == "16"){ $ico = "glyphicon-spade"; }
		if($var == "17"){ $ico = "glyphicon-tint"; }
		if($var == "18"){ $ico = "glyphicon-tree_conifer"; }
		if($var == "19"){ $ico = "glyphicon-adjust_alt"; }
		if($var == "20"){ $ico = "glyphicon-stats"; }
		if($var == "21"){ $ico = "glyphicon-rotation_lock"; }
		if($var == "22"){ $ico = "glyphicon-lock"; }
		if($var == "23"){ $ico = "glyphicon-soccer_ball"; }
		if($var == "24"){ $ico = "glyphicon-settings"; }
		if($var == "25"){ $ico = "glyphicon-bus"; }
		//busca nos perfils
		$resu = fSQL::SQL_SELECT_SIMPLES("icon", "sys_perfil", "origem_id = '".$var."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu)){
			$ico = $linha["icon"];
		}//fim while
		return $ico;
	}//fim icoPerfil	
	

	
	
	/**
	 * Método para gerar CPF válido, com máscara ou não
	 * @example cpfRandom(0)
	 *          para retornar CPF sem máscar
	 * @param int $mascara
	 * @return string
	 */
	static function cpfRandom($inicial="",$mascara="") {
		$n1 = rand(0, 9);
		$n2 = rand(0, 9);
		if($inicial != "" and strlen($inicial) == "2"){ $n1 = substr($inicial,0,1); $n2 = substr($inicial,1,1); }
		$n3 = rand(0, 9);
		$n4 = rand(0, 9);
		$n5 = rand(0, 9);
		$n6 = rand(0, 9);
		$n7 = rand(0, 9);
		$n8 = rand(0, 9);
		$n9 = rand(0, 9);
		$d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
		$d1 = 11 - (fGERAL::mod($d1, 11) );
		if ($d1 >= 10) {
			$d1 = 0;
		}
		$d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
		$d2 = 11 - (fGERAL::mod($d2, 11) );
		if ($d2 >= 10) {
			$d2 = 0;
		}
		$retorno = '';
		if ($mascara == 1) {
			$retorno = '' . $n1 . $n2 . $n3 . "." . $n4 . $n5 . $n6 . "." . $n7 . $n8 . $n9 . "-" . $d1 . $d2;
		} else {
			$retorno = '' . $n1 . $n2 . $n3 . $n4 . $n5 . $n6 . $n7 . $n8 . $n9 . $d1 . $d2;
		}
		return $retorno;
	}
	

	
	/**
	 * @param type $dividendo
	 * @param type $divisor
	 * @return type
	 */
	static function mod($dividendo, $divisor) {
		return round($dividendo - (floor($dividendo / $divisor) * $divisor));
	}



	
	/*//funcao que cria um numero randonico com quantidade de digitos informado entre 2 e 15 digitos
	Exemplo de USO: (maximo 15 numeros)
	echo codeRand(5);//imprime: 04578
	*/
	static function codeRand($digitos='2', $inicial=""){
		if($digitos == "11"){
			$var = fGERAL::cpfRandom($inicial);
		}else{
			if($digitos == "2"){ $var = rand(9,99); }
			if($digitos == "3"){ $var = rand(9,999); }
			if($digitos == "4"){ $var = rand(9,9999); }
			if($digitos == "5"){ $var = rand(9,99999); }
			if($digitos == "6"){ $var = rand(9,999999); }
			if($digitos == "7"){ $var = rand(9,9999999); }
			if($digitos == "8"){ $var = rand(9,99999999); }
			if($digitos == "9"){ $var = rand(9,999999999); }
			if($digitos == "10"){ $var = rand(9,9999999999); }
			if($digitos == "11"){ $var = rand(9,99999999999); }
			if($digitos == "12"){ $var = rand(9,999999999999); }
			if($digitos == "13"){ $var = rand(9,9999999999999); }
			if($digitos == "14"){ $var = rand(9,99999999999999); }
			if($digitos == "15"){ $var = rand(9,999999999999999); }
			$var = fGERAL::completaZero($var, $digitos);
			//se nao deu os caracteres, gera novamente
			if(strlen($var) < $digitos){
				if($digitos == "2"){ $var = rand(9,99); }
				if($digitos == "3"){ $var = rand(9,999); }
				if($digitos == "4"){ $var = rand(9,9999); }
				if($digitos == "5"){ $var = rand(9,99999); }
				if($digitos == "6"){ $var = rand(9,999999); }
				if($digitos == "7"){ $var = rand(9,9999999); }
				if($digitos == "8"){ $var = rand(9,99999999); }
				if($digitos == "9"){ $var = rand(9,999999999); }
				if($digitos == "10"){ $var = rand(9,9999999999); }
				if($digitos == "11"){ $var = rand(9,99999999999); }
				if($digitos == "12"){ $var = rand(9,999999999999); }
				if($digitos == "13"){ $var = rand(9,9999999999999); }
				if($digitos == "14"){ $var = rand(9,99999999999999); }
				if($digitos == "15"){ $var = rand(9,999999999999999); }
				$var = fGERAL::completaZero($var, $digitos);
			}
		}
		//retorna o valor
		return $var;
	}//fim da funcao codeRand
	
	
	
	
	
	
	
	
	//faz contagem em string de ANO e quantidades string[.QTD-ANO.QTD-ANO.QTD-ANO.]
	/*Exemplo de uso:
	$ano = "2013";
	$stringAno = "[.1-2012.3-2013.2-2014.]";
	echo "<br>STRING: ".$stringAno;	*/
	static function stringAnoQTD($ano,$stringAno,$acao="+"){
		$ret = $stringAno;
		if($ano != ""){
			if($acao == "-"){
				if($stringAno == ""){
					$ret = "";
				}else{//if($stringAno == ""){
					$stringAno = str_replace(".1-".$ano.".", ".", $stringAno);
					//verifica se ja existe o ano
					if(preg_match("/-".$ano."\./i", $stringAno)){
						$d = explode("-".$ano.".", $stringAno);
						$contL = strrchr($d["0"], ".");
						$cont = str_replace(".", "", $contL)-1;
						$p1 = str_replace($contL."F", ".", $d["0"]."F");
						$ret = $p1.$cont."-".$ano.".".$d["1"];
					}else{//if(preg_match("/-".$ano."\./i", $stringAno)){
						$ret = $stringAno;
					}//else{//if(preg_match("/-".$ano."\./i", $stringAno)){
				}//else{//if($stringAno == ""){
			}else{//if($acao == "-"){
				if($stringAno == ""){
					$ret = "[.1-".$ano.".]";
				}else{//if($stringAno == ""){
					//verifica se ja existe o ano
					if(preg_match("/-".$ano."\./i", $stringAno)){
						$d = explode("-".$ano.".", $stringAno);
						$contL = strrchr($d["0"], ".");
						$cont = str_replace(".", "", $contL)+1;
						$p1 = str_replace($contL."F", ".", $d["0"]."F");
						$ret = $p1.$cont."-".$ano.".".$d["1"];
					}else{//if(preg_match("/-".$ano."\./i", $stringAno)){
						$ret = str_replace(".]", ".1-".$ano.".]", $stringAno);
					}//else{//if(preg_match("/-".$ano."\./i", $stringAno)){
				}//else{//if($stringAno == ""){
			}//else{//if($acao == "-"){
		}//if($ano != ""){
		if($ret == "[.1-.]"){ $ret = ""; }
		if($ret == "[.-.]"){ $ret = ""; }
		if($ret == "[.]"){ $ret = ""; }
		return $ret;
	}//stringAnoQTD





	
	/* Formata data adicionando zero a esquerda
	Antes: 1/9/2015
	Depois 01/09/2015
	*/
	static function legData($dia,$mes,$ano){
		return fGERAL::completaZero($dia,"2")."/".fGERAL::completaZero($mes,"2")."/".$ano;
	}//fim legData





	
	//Função calcula valores de financiamento
	/*faz cálculo de parcelas/financimento de valores aplicando uma taxa de juros com valore minimo ou quantidade de parcelas
	$valor = "1000";
	$tx_juros = "2";
	$numero_parcelas = "1";
	$parcela_minima="0";
	echo "<br>$numero_parcelas"; print_r(fGERAL::calculaFinanciameto($valor,$tx_juros,$numero_parcelas,$parcela_minima));
	*/
	static function calculaFinanciameto($valor,$tx_juros,$numero_parcelas,$parcela_minima="0"){
		$valor = valSoma($valor);
		$tx_juros = valSoma($tx_juros);
		//verifica as qtd parcelas
		if($parcela_minima >= "1"){	$numero_parcelas = $valor/$parcela_minima; }
		$numero_parcelas = (int)$numero_parcelas;
		if($numero_parcelas >= "1"){}else{ $numero_parcelas = "1"; }
		
		// Definindo as variáveis
		$conta_valor = $valor; // Valor a ser financiado, desconta-se o valor da entrada
		$conta_taxa = ($tx_juros / 100); // Exemplo: 2% que é (2/100=0.02) usa-se (ponto) ao invés de vírgula pq é padrão
		//realiza os calculos de financiamento simples
		$conta = pow((1 + $conta_taxa), $numero_parcelas);
		$conta = (1 / $conta);
		$conta = (1 - $conta);
		$conta = ($conta_taxa / $conta);
		$parcela = number_format($conta_valor * $conta, 2, '.', '');
		$total_geral = number_format($parcela*$numero_parcelas, 2, '.', '');
		$valor_juros = $total_geral-$conta_valor;
		$valor_parcela_juros = ($total_geral-$conta_valor)/$numero_parcelas;
		
		// Converte os números e monta retorno
		//$arrRet["valor"] = number_format($conta_valor, 2, '.', '');
		$arrRet["qtd_parcelas"] = $numero_parcelas;
		$arrRet["valor_parcela"] = $parcela;
		$arrRet["valor_parcela_juros"] = number_format($valor_parcela_juros, 2, '.', '');
		$arrRet["valor_juros"] = number_format($valor_juros, 2, '.', '');
		$arrRet["valor_total"] = $total_geral;
		return $arrRet;
	}//calculaFinanciameto



	
	
	/* Função faz contagem entre datas retornando dias meses e anos
	$databd1 = '30/06/2015';
	$databd2 = '30/07/2015';
	echo "<br>DATA:"; print_r(contagemDatas($databd1,$databd2));
	*/
	static function contagemDatas($databd1,$databd2,$acao="padrao"){
		$data1 = explode("/", $databd1);
		$data2 = explode("/", $databd2);
		$ano = $data2[2] - $data1[2];
		$mes = $data2[1] - $data1[1];
		$dia = $data2[0] - $data1[0];
		$ultimo_dia = date("t", mktime(0,0,0,$data2[1],'01',$data2[2]));
		if($mes < 0){
			$ano--;
			$mes = 12 + $mes;
		}	
		if($dia < 0){
			$mes--;
			$dia = $ultimo_dia + $dia;
		}
		if($acao == "padrao"){
			$soma = $ano*12;
			$arrRet["meses"] = $mes+$soma;
			$arrRet["dias"] = $dia;
		}
		if($acao == "dif"){
			$time_dif = mktime(0,0,0,$data2[1],$data2[0],$data2[2])-mktime(0,0,0,$data1[1],$data1[0],$data1[2]);
			$dias = (int)floor( $time_dif / (60 * 60 * 24)); //dias
			$arrRet["anos"] = $ano;
			$soma = $ano*12;
			$arrRet["meses"] = $mes+$soma;
			$arrRet["dias"] = $dias;
		}
		return $arrRet;
	}//contagemDatas
	
	
	/*Função de cálculo de financiamento em duas datas, retornando o valor dos juros
	$databd1 = '01/06/2015';
	$databd2 = '17/07/2015';
	$valor = "1000";
	$tx_juros = "2";
	echo "<br>JUROS:<pre>"; print_r(calculaFinanciametoDatas($databd1,$databd2,$valor,$tx_juros)); echo "</pre>";
	*/
	static function calculaFinanciametoDatas($databd1,$databd2,$valor,$tx_juros,$campo=""){
		$ret_valor = $valor;
		$ret_juros = "0";
		$arrDados = fGERAL::contagemDatas($databd1,$databd2);
		$meses = $arrDados["meses"];
		$dias = $arrDados["dias"];
		if($meses >= "1"){
			$arrFin = fGERAL::calculaFinanciameto($valor,$tx_juros,$meses);
			$ret_valor = $arrFin["valor_total"];
			$ret_juros = $arrFin["valor_juros"];
		}
		if($dias >= "1"){
			if($meses == "0"){
				$meses++;
				$arrFin = fGERAL::calculaFinanciameto($valor,$tx_juros,$meses);
			}
			$dias_ultimo_mes = ultimoDiaMes($databd2);
			$juros = ($arrFin["valor_juros"]/$dias_ultimo_mes)*$dias;
			$ret_valor = $ret_valor+$juros;
			$ret_juros = $ret_juros+$juros;
		}
		//monta retorno
		$arrRet["divida"] = number_format($ret_valor, 2, '.', '');
		$arrRet["juros"] = number_format($ret_juros, 2, '.', '');
		if($campo != ""){ $arrRet = $arrRet["$campo"]; }
		return $arrRet;
	}//calculaFinanciametoDatas
	

	
	//função de retorno de porcentagem de valores
	/*Exemplode uso:
	$valor_a = "1000"; $juro = "10";
	echo "<br>TAXA:  <pre>"; print_r(fGERAL::calcularPorcentagem($valor_a, $juro)); echo "</pre>";
	echo "<br>JUROS:  <pre>"; print_r(fGERAL::calcularPorcentagem($valor_a, $juro, "valor_juros")); echo "</pre>";
	echo "<br>TOTAL:  <pre>"; print_r(fGERAL::calcularPorcentagem($valor_a, $juro, "valor_total")); echo "</pre>";
	Array  $arrRet["valor_juros"] $arrRet["valor_total"]
	*/
	static function calcularPorcentagem($valor,$tx_juros,$campo=""){
		$arrRet["valor_juros"] = "0";
		$arrRet["valor_total"] = $valor;
		if(($valor > "0") and ($tx_juros > "0")){
			$d = fGERAL::calculaFinanciameto($valor, $tx_juros, "1");
			$arrRet["valor_juros"] = $d["valor_juros"];
			$arrRet["valor_total"] = $d["valor_total"];
		}
		if($campo != ""){
			if($campo == "valor_juros"){ unset($arrRet); $arrRet = $d["valor_juros"]; }
			if($campo == "valor_total"){ unset($arrRet); $arrRet = $d["valor_total"]; }
		}
		return $arrRet;
	}//fim funcao retorno de porcentagem
	

	
	//função de retorno de porcentagem de total
	/*Exemplode uso:
	$valor_total = "1000"; $valor = "100";
	echo fGERAL::retornoPorcentagem($valor, $valor_total); Retorno: 10 ou seja 10%
	*/
	static function retornoPorcentagem($valor,$valor_total){
		if(($valor > "0") and ($valor_total > "0")){
			return (($valor / $valor_total) * 100);
		}else{
			return 0;
		}
	}//fim funcao retornoPorcentagem


	




	
	
	//funcao que insere zero a esquerda - echo completaZero($var);
	/*
	Exemplo de uso:
	$var = "1";
	echo "VAR: ".completaZero($var,'2');
	//imprime: 01
	*/
	static function completaZero($var, $zeros='2'){
		$var = str_pad($var, $zeros, "0", STR_PAD_LEFT);
		return $var;
	}//fim da funcao que insere zero a esquerda
	
	
	
	
	//codifica e descodifica numeros na variavel GET
	static function cod_get($var,$tipo='get'){
		if($tipo == "get"){
			$var = str_replace("0", "Qw_", $var);
			$var = str_replace("1", "tF_", $var);
			$var = str_replace("2", "hJ_", $var);
			$var = str_replace("3", "Ox_", $var);
			$var = str_replace("4", "vB_", $var);
			$var = str_replace("5", "Ax_", $var);
			$var = str_replace("6", "zK_", $var);
			$var = str_replace("7", "Up_", $var);
			$var = str_replace("8", "mN_", $var);
			$var = str_replace("9", "Er_", $var);
		}//fim if($tipo == "get"){
		if($tipo == "cripto"){
			$var = str_replace("0", "fQw_", $var);
			$var = str_replace("1", "rtF_", $var);
			$var = str_replace("2", "WhJ_", $var);
			$var = str_replace("3", "sOx_", $var);
			$var = str_replace("4", "EvB_", $var);
			$var = str_replace("5", "lAx_", $var);
			$var = str_replace("6", "RzK_", $var);
			$var = str_replace("7", "nUp_", $var);
			$var = str_replace("8", "EmN_", $var);
			$var = str_replace("9", "lEr_", $var);
		}//fim if($tipo == "get"){
		return $var;
		}//fim da funcao cod_get
	static function dec_get($var,$tipo='get'){
		if($tipo == "get"){
			$var = str_replace("Qw_", "0", $var);
			$var = str_replace("tF_", "1", $var);
			$var = str_replace("hJ_", "2", $var);
			$var = str_replace("Ox_", "3", $var);
			$var = str_replace("vB_", "4", $var);
			$var = str_replace("Ax_", "5", $var);
			$var = str_replace("zK_", "6", $var);
			$var = str_replace("Up_", "7", $var);
			$var = str_replace("mN_", "8", $var);
			$var = str_replace("Er_", "9", $var);
		}//if($tipo == "get"){
		if($tipo == "cripto"){
			$var = str_replace("fQw_", "0", $var);
			$var = str_replace("rtF_", "1", $var);
			$var = str_replace("WhJ_", "2", $var);
			$var = str_replace("sOx_", "3", $var);
			$var = str_replace("EvB_", "4", $var);
			$var = str_replace("lAx_", "5", $var);
			$var = str_replace("RzK_", "6", $var);
			$var = str_replace("nUp_", "7", $var);
			$var = str_replace("EmN_", "8", $var);
			$var = str_replace("lEr_", "9", $var);
		}//fim if($tipo == "get"){
		return $var;
		}//fim da funcao dec_get
	//fim da codificacao das variaveis GET

	
	
	//inicio FUNÇÕES DE CRIPTOGRAFIA NUMERICA 1.2 ----- SISTEMA DE SEGURANÇA ----- #####################  >>>>>>
	/*FUNÇÃO DE ENCRIPTAR NUMERICAMENTE STRINGS
	Exemplo de USO:
	$text = "ola mundo";//string
	$acao = "enc";//acao - se enc codifica, se des descodifica
	$cont_i = "3"; //numero de inicio dos multiplos - quao maior o numero, maior sera a string final encriptada
	$cont_s = "3"; //numero do multiplicador de multiplos - quao maior o numero, maior sera a string final encriptada
	echo fGERAL::cptoFaisher($text, $acao='1', $cont_i='3', $cont_s='3');*/
	static function cptoFaisher($text, $acao='enc', $cont_i='17', $cont_s='27', $verificador='12', $quebra='0'){
		//função e dependente de funcoes:  cod_get($var), dec_get($var), completaZero($cont_i, $cont_z);
		//$cont_i = "1"; //inicio da contagem
		//$cont_s = "16"; //mutiplicador de intervalo da contagem
		$cont_linhas = "114"; //total de linhas do array
		
		//faz a contagem do numero final da lisgagem - $cont_i
		$cont_i_n = $cont_linhas*$cont_s;
		$cont_i_n = $cont_i_n+$cont_i;
		$cont_z = strlen($cont_i_n);//busca o numero de caracteres
		
		//maiusculas
		$array_alfa[] = ' '; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 1
		$array_alfa[] = 'A'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 2
		$array_alfa[] = 'B'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 3
		$array_alfa[] = 'C'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 4
		$array_alfa[] = 'D'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 5
		$array_alfa[] = 'E'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 6
		$array_alfa[] = 'F'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 7
		$array_alfa[] = 'G'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 8
		$array_alfa[] = 'H'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 9
		$array_alfa[] = 'I'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 10
		$array_alfa[] = 'J'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 11
		$array_alfa[] = 'K'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 12
		$array_alfa[] = 'L'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 13
		$array_alfa[] = 'M'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 14
		$array_alfa[] = 'N'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 15
		$array_alfa[] = 'O'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 16
		$array_alfa[] = 'P'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 17
		$array_alfa[] = 'Q'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 18
		$array_alfa[] = 'R'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 19
		$array_alfa[] = 'S'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 20
		$array_alfa[] = 'T'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 21
		$array_alfa[] = 'U'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 22
		$array_alfa[] = 'V'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 23
		$array_alfa[] = 'W'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 24
		$array_alfa[] = 'X'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 25
		$array_alfa[] = 'Y'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 26
		$array_alfa[] = 'Z'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 27
		//minusculas
		$array_alfa[] = 'a'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 28
		$array_alfa[] = 'b'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 29
		$array_alfa[] = 'c'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 30
		$array_alfa[] = 'd'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 31
		$array_alfa[] = 'e'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 32
		$array_alfa[] = 'f'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 33
		$array_alfa[] = 'g'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 34
		$array_alfa[] = 'h'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 35
		$array_alfa[] = 'i'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 36
		$array_alfa[] = 'j'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 37
		$array_alfa[] = 'k'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 38
		$array_alfa[] = 'l'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 39
		$array_alfa[] = 'm'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 40
		$array_alfa[] = 'n'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 41
		$array_alfa[] = 'o'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 42
		$array_alfa[] = 'p'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 43
		$array_alfa[] = 'q'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 44
		$array_alfa[] = 'r'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 45
		$array_alfa[] = 's'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 46
		$array_alfa[] = 't'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 47
		$array_alfa[] = 'u'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 48
		$array_alfa[] = 'v'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 49
		$array_alfa[] = 'w'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 50
		$array_alfa[] = 'x'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 51
		$array_alfa[] = 'y'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 52
		$array_alfa[] = 'z'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 53
		//assentos maiusculo
		$array_alfa[] = 'Á'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 54
		$array_alfa[] = 'É'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 55
		$array_alfa[] = 'Í'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 56
		$array_alfa[] = 'Ó'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 57
		$array_alfa[] = 'Ú'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 58
		$array_alfa[] = 'Â'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 59
		$array_alfa[] = 'Ê'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 60
		$array_alfa[] = 'Ô'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 61
		$array_alfa[] = 'Î'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 62
		$array_alfa[] = 'Û'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 63
		$array_alfa[] = 'Ã'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 64
		$array_alfa[] = 'Õ'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 65
		$array_alfa[] = 'Ç'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 66
		$array_alfa[] = 'À'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 67
		$array_alfa[] = 'È'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 68
		//assentos minusculos
		$array_alfa[] = 'á'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 69
		$array_alfa[] = 'é'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 70
		$array_alfa[] = 'í'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 71
		$array_alfa[] = 'ó'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 72
		$array_alfa[] = 'ú'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 73
		$array_alfa[] = 'â'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 74
		$array_alfa[] = 'ê'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 75
		$array_alfa[] = 'ô'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 76
		$array_alfa[] = 'î'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 77
		$array_alfa[] = 'û'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 78
		$array_alfa[] = 'ã'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 79
		$array_alfa[] = 'õ'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 80
		$array_alfa[] = 'ç'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 81
		$array_alfa[] = 'à'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 82
		$array_alfa[] = 'è'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 83
		//especiai
		$array_alfa[] = '"'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 84
		$array_alfa[] = '!'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 85
		$array_alfa[] = '@'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 86
		$array_alfa[] = '#'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 87
		$array_alfa[] = '$'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 88
		$array_alfa[] = '%'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 89
		$array_alfa[] = '&'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 90
		$array_alfa[] = '*'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 91
		$array_alfa[] = '('; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 92
		$array_alfa[] = ')'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 93
		$array_alfa[] = '-'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 94
		$array_alfa[] = '_'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 95
		$array_alfa[] = '+'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 96
		$array_alfa[] = '='; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 97
		$array_alfa[] = '['; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 98
		$array_alfa[] = ']'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 99
		$array_alfa[] = '{'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 100
		$array_alfa[] = '}'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 101
		$array_alfa[] = ':'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 102
		$array_alfa[] = ';'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 103
		$array_alfa[] = ','; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 104
		$array_alfa[] = '.'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 105
		$array_alfa[] = '\\'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s;// 106
		$array_alfa[] = '|'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 107
		$array_alfa[] = '?'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 108
		$array_alfa[] = '/'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 109
		$array_alfa[] = '<'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 110
		$array_alfa[] = '>'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 111
		$array_alfa[] = '^'; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s; // 112
		$array_alfa[] = "\n"; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s;// 113
		$array_alfa[] = "\r"; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); $cont_i = $cont_i+$cont_s;// 114
		$array_alfa[] = '\''; $array_num[] = fGERAL::completaZero($cont_i, $cont_z); // 115
		
		if($acao == "enc"){//encriptar
			$textN = fGERAL::cod_get($text,"cripto"); //encod os numeros		
			if($verificador != "0"){ $textN = str_replace('[/v/]', '', $textN); $textN .= fGERAL::cod_get('[/v/]'.$verificador,"cripto"); }//adiciona verificador
			$output  = str_replace($array_alfa, $array_num, $textN);
			if($quebra >= "1"){ $output = wordwrap($output, $quebra, "\n", true); }
			
		}else{//desencriptar
			$text = str_replace("\n", "", $text);
			$text = str_replace("\r", "", $text);
			//valida se o que recebeu foi numeros, se nao, retorna VAZIO
			if(preg_match('/[^0-9]/',$text)){
				$output = "VAZIO";
			}else{ //else if(preg_match('[^0-9]',$text)){
				$output  = "";
				//cria o array dividindo os caracteres por grupo
				$l_ARRAY = str_split($text, $cont_z); //fax uma quebra da string exemplo: 999999999 para: Array ( 999, 999, 999 ) 
				//verifica se existe lista
				$cod_ARRAY = ceil(count($l_ARRAY)); //verifica se existe linhas no array
				//verifica se existe o array
				if($cod_ARRAY >= "1"){
					$listaIDS_a = $l_ARRAY; //lista o array
					foreach ($listaIDS_a as $pos => $valor ){
						$valor_n  = str_replace($array_num, $array_alfa, $valor);
						$output  .= $valor_n;
					}//fim foreach
					$output = fGERAL::dec_get($output,"cripto");//desc os numeros
					if($verificador != "0"){ $output_ = explode('[/v/]', $output); if($output_["1"] != $verificador){ $output = "VAZIO"; }else{ $output = $output_["0"]; } }//adiciona verificador
				}else{ $output = "VAZIO"; } //fim da verificacao
			}//fim if(preg_match('[^0-9]',$text)){
		}
		return $output;		
	}//fim da função - cptoFaisher($text, $acao='enc', $cont_i='17', $cont_s='27', $verificador='12', $quebra='0')	
	//fim FUNÇÕES DE CRIPTOGRAFIA NUMERICA ----- SISTEMA DE SEGURANÇA ----- #####################  <<<<<<
	
	//##################### FUNÇÕES DE CRIPTOGRAFIA [teste] FIM <<<<<<<<<<<<<<<<<<<<<<<<<<<<<





	//FUNÇÃO DE RETORNO DE MARCAÇÃO JAVA DE ARRAY DE BUSCA
	static function marcaBusca($array,$idelemento){
		$leg = "";
		if(is_array($array)){
			$cont_ARRAY = ceil(count($array));
			//listar item ja cadastrados
			if($cont_ARRAY >= "1"){
				foreach ($array as $pos => $valor){
					if($valor != ""){
						$leg .= "	$('#".$idelemento."').highlight('".$valor."');\n";
					}
				}//fim foreach			
			}//fim if($cont_ARRAY >= "1"){
		}
		return $leg;
	}//marcaBusca
	
	
	
	
	
	
	
	
	
	
	//cria arquivo de dados de armazenamento
	static function criarDados($campos,$valores){
		$array = array_combine(explode(",",$campos),$valores);
		$file_ret = fGERAL::logFile(fGERAL::jsonArray($array,"enc"),"send");
		return $file_ret;
	}//criarDados
	
	
	
	
	
		
	
	
	
	
	
	//Função monta retorno de ((VARIAVEL-OK)) para vars reconhecidas
	static function varsOK($HTML,$ARRAY,$ACAO=""){ $vars = "";
		//monta array
		$array = $ARRAY;
		$cont_ARRAY = ceil(count($array));
		//listar item ja cadastrados
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $pos_valor){
				if($pos_valor != ""){
					if($ACAO == "vars"){
						if(preg_match("/\[\[".$pos_valor."\]\]/i", $HTML)){ if($vars != ""){ $vars .= "."; } $vars .= $pos_valor; }
					}else{
						$HTML = str_replace('[['.$pos_valor.']]', "((VARIAVEL-OK))", $HTML);
					}
				}//if($pos_valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
		if($ACAO == "vars"){ $HTML = $vars; }
		return $HTML;
	}//fim varsOK
	
	
	
	
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ LEGENDAS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	
	/* Formata LEG SCANNER
	Funcao utilizada para formatar a exibição do número de scanner
	Exemplo: 2015 08 13 4415 7
	         ANO MES DIA RAND CONT
	*/
	static function legNumCont($ano,$mes,$dia,$rand,$cont,$limpa="0"){
		$c_leg = $ano."-".fGERAL::completaZero($mes,"2")."-".fGERAL::completaZero($dia,"2").".".$rand.".".$cont;
		if($limpa == "1"){ $c_leg = fGERAL::limpaCode($c_leg); }
		return $c_leg;
	}//legCode
	//funcao de retorno do número
	static function returnNumCont($num){
		$num = fGERAL::limpaCode($num);
		if(strlen($num) >= "13"){
			$d["ano"] = substr($num,0,4);
			$d["mes"] = substr($num,4,2);
			$d["dia"] = substr($num,6,2);
			$d["rand"] = substr($num,8,4);
			$d["cont"] = substr($num,12,50);
		}else{
			$d["ano"] = ""; $d["mes"] = ""; $d["dia"] = ""; $d["rand"] = ""; $d["cont"] = "";
		}
		return $d;
	}//fim returnNumCont
	
	
	




	//funcao de retorno do codigo RAND
	//retorn array com dados id e code
	static function codeRandRetorno($code){
		return fGERAL::returnCode($code);
	}//fim codeRandRetorno
	
	
	//fumção limpa caracteres de RM code
	static function limpaCode($code){
		$c_leg = str_replace(" ", "", $code);
		$c_leg = str_replace("/", "", $c_leg);
		$c_leg = str_replace("-", "", $c_leg);
		$c_leg = str_replace(".", "", $c_leg);
		$c_leg = str_replace("(", "", $c_leg);
		$c_leg = str_replace(")", "", $c_leg);
		$c_leg = str_replace("[", "", $c_leg);
		$c_leg = str_replace("]", "", $c_leg);
		return $c_leg;
	}//limpaCode
	
	//informa id de tabela de code informado
	static function legCodeTabela($code,$acao=""){
		if($acao == "ultimo"){ return substr($code,-1); }else{ return substr($code,-2); }
	}//fim legCodeTabela
	
	
	
	/* Formata LEG CODE
	Funcao utilizada para formatar a exibição do code
	*/
	static function legCode($id,$code,$limpa="0"){
		$c_leg = $code;
		if($limpa == "1"){ $c_leg = fGERAL::limpaCode($c_leg); }
		return $c_leg;
	}//legCode	
	//funcao de retorno do codigo
	static function returnCode($code){
		$code = fGERAL::limpaCode($code);
		$d["tabela"] = substr($code,-2);
		$d["code"] = substr($code,-6);
		$d["id"] = str_replace($d["code"]."]", "", $code."]");
		return $d;
	}//fim returnCode
	
	


}//class fGERAL { //***************************************************************************************************************@
	
	
	
	
	
	
	
	
	
	

















	
	
	
	














	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	

























//classe para gestao de funcções geral de Registro Multifinalitário - RM
class fRM{ //***************************************************************************************************************@
	
	



	//DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD AÇÕES NO DEPARTAMENTO DDDDDDDDDDDDDDDDDDDDDDDDD>>>
	//Função monta nome de departamento
	static function dadosDepto($DEPTO_ID, $DADO="nome"){ $retorno = "";
		if($DADO == "rmNome"){ $DADO = "nome"; }
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resu1 = fSQL::SQL_SELECT_SIMPLES($DADO, "sys_perfil_deptos", "id = '".$DEPTO_ID."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			if(preg_match("/\,/", $DADO)){ $retorno = $linha; }else{ $retorno = $linha["$DADO"]; }
		}//fim while
		return $retorno;
	}//fim dadosDepto($DEPTO_ID, CAMPOS);
	//DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD AÇÕES NO DEPARTAMENTO DDDDDDDDDDDDDDDDDDDDDDDDD<<<
	



	//UUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU AÇÕES NO USUÁRIO UUUUUUUUUUUUUUUUUUUUUUUU>>>
	//Função monta nome de usuario
	static function dadosUser($USER, $DADO="nome"){ $retorno = ""; $acao = "";
		if($DADO == "rmNome"){ $DADO = "nome"; }
		if($DADO == "codeNome"){ $DADO = "code,nome"; $acao = "codeNome"; }
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resu1 = fSQL::SQL_SELECT_SIMPLES($DADO, "sys_usuarios", "id = '".$USER."'", "", "1");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			if($acao == "codeNome"){
				$retorno = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($USER,$linha["code"])." ".$linha["nome"];
			}else{
				if(preg_match("/\,/", $DADO)){ $retorno = $linha; }else{ $retorno = $linha["$DADO"]; }
			}
		}//fim while
		return $retorno;
	}//fim dadosUser($IDUSER, CAMPOS);
	//UUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU AÇÕES NO USUÁRIO UUUUUUUUUUUUUUUUUUUUUUUU<<<


	
	//CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC AÇÕES NO CANDIDATO CCCCCCCCCCCCCCCCCCC>>>
	/* getRMCandidato
	Funcao utilizada para retornar o Rm de id de candidato
	*/
	static function getRMCandidato($id,$tipo="F",$limpa="0"){
		$c_leg = "";
		if($tipo == "F"){//candidato
			$linha = fSQL::SQL_SELECT_ONE("id,code", "cad_candidato_fisico", "id = '$id'", "");
			$c_leg = fGERAL::legCode($linha["id"],$linha["code"]);
		}
		if($tipo == "J"){//candidato jurídico
			$linha = fSQL::SQL_SELECT_ONE("id,code", "cad_candidato_juridico", "id = '$id'", "");
			$c_leg = fGERAL::legCode($linha["id"],$linha["code"]);
		}
		if($limpa == "1"){ $c_leg = fGERAL::limpaCode($c_leg); }
		return $c_leg;
	}//getRMCandidato
	//CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC AÇÕES NO CANDIDATO CCCCCCCCCCCCCCCCCCC<<<
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NA PROPRIEDADE PPPPPPPPPPPPPPPPPPPP>>>
	/* getRMPropriedade
	Funcao utilizada para retornar o Rm de id de propriedade
	*/
	static function getRMPropriedade($id,$limpa="0"){
		$linha = fSQL::SQL_SELECT_ONE("id,code", "geo_propriedade", "id = '$id'", "");
		$c_leg = fGERAL::legCode($linha["id"],$linha["code"]);
		if($limpa == "1"){ $c_leg = fGERAL::limpaCode($c_leg); }
		return $c_leg;
	}//getRMPropriedade
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NA PROPRIEDADE PPPPPPPPPPPPPPPPPPPP<<<
	
	
	//DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD AÇÕES EM DUAM DDDDDDDDDDDDDDDDDDDDDDDDDDD>>>
	//CLASSE PARA INICIAR DADOS DE DUAM
	static function classDuam($ano="",$mes="",$dia="",$cont="0",$code="",$user_id="",$user="",$caminhoScript="../"){
	
		//INCLUDE DE CLASSES DE DUAM ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
		include $caminhoScript."classDb/fin_duam.php";//classes de conexao
		if(class_exists('classFin_duam')){	
			//INICIAR CLASSE --->>>
			$class_fin_duam = new classFin_duam($ano,$mes,$dia,$cont,$code,$user_id,$user);//ini class ($ano,$mes,$dia,$cont_duam,$user_id,$user)-DATA DE VENCIMENTO
		}//class_exists
		//INCLUDE DE CLASSES DE DUAM ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ <<<
		
		//dados de retorno
		$RET["duam"] = $class_fin_duam;
		return $RET;
	}//classDuam
	
		
	/* duamStatus
	Funcao utilizada para retornar o status atual de uma DUAM
	*/
	static function duamStatus($ano,$mes="full",$dia="",$cont="",$code="",$acao="full"){
		if($ano == "NULL"){ $ano = ""; } if($mes == "NULL"){ $mes = ""; } if($dia == "NULL"){ $dia = ""; } if($cont == "NULL"){ $cont = ""; }//limpa vars em caso de NULL
		$arrRet["status"] = "OFF";
		//verifica se recebeu contagem banco com data: 01/01/2015 123
		if($mes == "contagem"){ $c = explode(" ", $ano); $d = explode("/", $c["0"]); $ano = $d["2"]; $mes = $d["1"]; $dia = $d["0"]; $cont = substr($c["1"],0,-1); $code = "004".fGERAL::legCodeTabela($c["1"],"ultimo"); $arrRet["ano"] = $ano; $arrRet["mes"] = $mes; $arrRet["dia"] = $dia; $arrRet["cont"] = $cont; }
		//varifica se recebeu RM no ano
		if(strlen($ano) > "13"){ $acao = $mes; $d = fGERAL::returnCodeDuam($ano); $ano = $d["ano"]; $mes = $d["mes"]; $dia = $d["dia"]; $cont = $d["cont"]; $code = $d["code"]; }
		if(($ano != "") and ($mes != "") and ($dia != "") and ($ano >= "1") and ($mes >= "1") and ($dia >= "1")){
			$arrRet["status"] = "ERRO";
			$tabela_id = fGERAL::legCodeTabela($code);
			$where = "cont = '$cont' AND venc_ano = '$ano' AND venc_mes = '$mes' AND venc_dia = '$dia'";
			$campos1 = "duam_pai,parcela,valor_total"; $campos2 = "duam_pai,parcela,valor_total,status";
			if($acao == "status"){ $campos1 = "id"; $campos2 = "status"; }
			if($acao == "juros"){
				$campos1 = "duam_pai,parcela,valor_taxa,valor_total,grupos_juros_id,servico_id"; $campos2 = "duam_pai,parcela,valor_taxa,valor_total,grupos_juros_id,servico_id,status";
			}
			if($acao == "datas"){
				$campos1 = "duam_pai,parcela,valor_total"; $campos2 = "duam_pai,parcela,valor_total,status";
				$arrRet["data_venc"] = fGERAL::dataCodeDuam($dia,$mes,$ano);
			}
			//verifica DUAM fisico
			if($tabela_id == "40"){
				$cont_ativo = "0";
				$resu1 = fSQL::SQL_SELECT_SIMPLES($campos1, "fin_duam_fisico", $where, "");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					if($acao != "status"){
						$duam_pai_d = $linha1["duam_pai"];
						$parcela_d = $linha1["parcela"];
						$valor_total_d = $linha1["valor_total"];
						if($acao == "juros"){ $valor_taxa_d = $linha1["valor_taxa"]; $grupos_juros_id_d = $linha1["grupos_juros_id"]; $servico_id_d = $linha1["servico_id"]; }
					}//if($acao != "status"){
					$cont_ativo++;
				}//fim while
				if($cont_ativo >= "1"){
					$arrRet["status"] = "1";
					if($acao != "status"){
						$arrRet["duam_pai"] = $duam_pai_d;
						$arrRet["parcela"] = $parcela_d;
						$arrRet["valor_pagto"] = $valor_total_d;
						if($acao == "juros"){
							$arrRet["valor_pagto"] = fGERAL::dbValor($valor_total_d-$valor_taxa_d); $arrRet["juros_id"] = $grupos_juros_id_d; $arrRet["servico_id"] = $servico_id_d;
						}//if($acao == "juros"){
						$arrRet["anoi"] = "0";//ano do arquivo
					}//if($acao != "status"){
				}else{//if($cont_ativo >= "1"){
					//verifica repositorio de DUAM
					$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "fin_duam_fisico_anos", "ano = '$ano'", "","1");
					while($linha1 = fSQL::FETCH_ASSOC($resu1)){
						$ano_r = $linha1["ano"];
						$resu2 = fSQL::SQL_SELECT_SIMPLES($campos2, "fin_duam_fisico_".$ano_r, $where, "");
						while($linha2 = fSQL::FETCH_ASSOC($resu2)){
							$status_d = $linha2["status"];
							$arrRet["status"] = $status_d;
							if($acao != "status"){
								if($status_d == "1"){ $arrRet["status"] = "DIV"; }
								$arrRet["duam_pai"] = $linha2["duam_pai"];
								$arrRet["parcela"] = $linha2["parcela"];
								$arrRet["valor_pagto"] = $linha2["valor_total"];
								if($acao == "juros"){
									$arrRet["valor_pagto"] = fGERAL::dbValor($linha2["valor_total"]-$linha2["valor_taxa"]);
									$arrRet["juros_id"] = $linha2["grupos_juros_id"]; $arrRet["servico_id"] = $linha2["servico_id"];
								}//if($acao == "juros"){
								$arrRet["anoi"] = $ano_r;//ano do arquivo
							}//if($acao != "status"){
						}//fim while
					}//fim while
				}//else{//if($cont_ativo >= "1"){
			}//if($tabela_id == "40"){
			//verifica DUAM jurídico
			if($tabela_id == "41"){
				$cont_ativo = "0";
				$resu1 = fSQL::SQL_SELECT_SIMPLES($campos1, "fin_duam_juridico", $where, "");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					if($acao != "status"){
						$duam_pai_d = $linha1["duam_pai"];
						$parcela_d = $linha1["parcela"];
						$valor_total_d = $linha1["valor_total"];
						if($acao == "juros"){ $valor_taxa_d = $linha1["valor_taxa"]; $grupos_juros_id_d = $linha1["grupos_juros_id"]; $servico_id_d = $linha1["servico_id"]; }
					}//if($acao != "status"){
					$cont_ativo++;
				}//fim while
				if($cont_ativo >= "1"){
					$arrRet["status"] = "1";
					if($acao != "status"){
						$arrRet["duam_pai"] = $duam_pai_d;
						$arrRet["parcela"] = $parcela_d;
						$arrRet["valor_pagto"] = $valor_total_d;
						if($acao == "juros"){
							$arrRet["valor_pagto"] = fGERAL::dbValor($valor_total_d-$valor_taxa_d); $arrRet["juros_id"] = $grupos_juros_id_d; $arrRet["servico_id"] = $servico_id_d;
						}//if($acao == "juros"){
						$arrRet["anoi"] = "0";
					}//if($acao != "status"){					
				}else{//if($cont_ativo >= "1"){
					//verifica repositorio de DUAM
					$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "fin_duam_juridico_anos", "ano = '$ano'", "","1");
					while($linha1 = fSQL::FETCH_ASSOC($resu1)){
						$ano_r = $linha1["ano"];
						$resu2 = fSQL::SQL_SELECT_SIMPLES($campos2, "fin_duam_juridico_".$ano_r, $where, "");
						while($linha2 = fSQL::FETCH_ASSOC($resu2)){
							$status_d = $linha2["status"];
							$arrRet["status"] = $status_d;
							if($acao != "status"){
								if($status_d == "1"){ $arrRet["status"] = "DIV"; }
								$arrRet["duam_pai"] = $linha2["duam_pai"];
								$arrRet["parcela"] = $linha2["parcela"];
								$arrRet["valor_pagto"] = $linha2["valor_total"];
								if($acao == "juros"){
									$arrRet["valor_pagto"] = fGERAL::dbValor($linha2["valor_total"]-$linha2["valor_taxa"]);
									$arrRet["juros_id"] = $linha2["grupos_juros_id"]; $arrRet["servico_id"] = $linha2["servico_id"];
								}//if($acao == "juros"){
								$arrRet["anoi"] = $ano_r;
							}//if($acao != "status"){
						}//fim while
					}//fim while
				}//else{//if($cont_ativo >= "1"){
			}//if($tabela_id == "41"){
		}//if(($ano != "") and ($mes != "") and ($dia != "") and ($ano >= "1") and ($mes >= "1") and ($dia >= "1")){
		if($acao == "status"){ $arrRet = $arrRet["status"]; }
		return $arrRet;
	}//duamStatus
	
	
	//recupera o arquivo de dados do DUAM grava do .fai
	static function duamDados($rm){
		//varifica se recebeu RM no ano
		if(strlen($rm) > "13"){ $acao = $mes; $d = fGERAL::returnCodeDuam($rm); $ano = $d["ano"]; $mes = $d["mes"]; $dia = $d["dia"]; $cont = $d["cont"]; $code = $d["code"]; }
		if(($ano != "") and ($mes != "") and ($dia != "") and ($cont != "")){
			$fileCaminho = VAR_DIR_FILES."files/tabelas/fin_duam/".$ano."/".$mes."/".$dia."/".$cont; //caminho completo da pasta do dia
			if(file_exists($fileCaminho)){
				$file_ret = file_get_contents($fileCaminho);
				if($file_ret != ""){
					$arr = fGERAL::jsonArray(fGERAL::logFile($file_ret,"get"),"dec");
				}//if
			}//if(file_exists($fileCaminho)){
		}//if(($ano != "") and ($mes != "") and ($dia != "") and ($cont != "")){
		return $arr;
	}//duamDados
	//DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD AÇÕES EM DUAM DDDDDDDDDDDDDDDDDDDDDDDDDDD<<<
	
	
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NO PROTOCOLO PPPPPPPPPPPPPPPPPPPPPP>>>
	//CLASSE PARA INICIAR DADOS DE PROTOCOLO
	static function classProtocolo($id_a="",$user="",$depto="",$caminhoScript="../"){
		//verifica se recebeu código já abre o protocolo
		if(($id_a != "") and ($user != "") and ($depto != "")){
			$aCode = fGERAL::returnCode7($id_a);
			if($aCode["ano"] != ""){ $cont_encontrou = "1"; }else{ $cont_encontrou = "0"; }
		}				
		include $caminhoScript."class/protocolo.php";//classes de conexao
		if(class_exists('classProtocolo')){	
			//INICIAR CLASSE --->>> PROTOCOLO
			$class_protocolo = new classProtocolo;//inicia a classe
		}//class_exists
		
		if($cont_encontrou == "1"){		
			//CLASSE #######=> seta os dados de controle para manipulação
			$RET["encontrou"] = $class_protocolo->setIds($aCode["ano"],$aCode["mes"],$aCode["dia"],$aCode["cont"],$user,$depto);//setIds($ano,$mes,$dia,$cont,$user,$depto)
		}else{ $RET["encontrou"] = "0"; }
		//dados de retorno
		$RET["protocolo"] = $class_protocolo;
		return $RET;
	}//classProtocolo


	/*getProtocolo
	Funcao utilizada para retornar o protocolo de RM
	*/
	static function getProtocolo($rm,$acao=""){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]; //caminho completo da pasta do protocolo
			if(file_exists($verPasta."/EXECUTANDO")){ $tabela = "protocolo_executando"; }else{ $tabela = "protocolo_arquivo_".$aCode["ano"]; }
			//verifica se a ação é mapa de tramitação
			$extra_campo = ""; $extra_tipo_tramitacao = "OFF";
			if($acao == "mapa_tramitacao"){
				//campos para mapa
				$extra_campo = ",T.mapa_tramitacao AS tipo_tramitacao";
				if(file_exists($verPasta."/dados.fai")){
					$arrProt = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($verPasta."/dados.fai"),"get"),"dec");
					//verifica se já foi alterado o mapa
					if(isset($arrProt["tipo_tramitacao"])){
						$extra_tipo_tramitacao = $arrProt["tipo_tramitacao"];
						if($extra_tipo_tramitacao == "VAZIO"){ $extra_tipo_tramitacao = ""; }
						$extra_campo = "";
					}//if(isset($arrProt["tipo_tramitacao"])){
				}//if(file_exists($protPasta."/dados.fai")){				
			}//if($acao == "mapa_tramitacao"){
			//dados sql	
			$campos = "P.code,P.ano,P.mes,P.dia,P.cont,P.mapa_tramitacao,P.paginas,P.time,P.status,T.nome AS tipo".$extra_campo.",CF.nome AS fis_nome,CF.cpf AS fis_doc,CJ.fantasia AS jur_nome,CJ.cnpj AS jur_doc"; //campos da tabela
			$where .= " ( P.`ano` = '".$aCode["ano"]."' AND P.`mes` = '".$aCode["mes"]."' AND P.`dia` = '".$aCode["dia"]."' AND P.`cont` = '".$aCode["cont"]."' ) AND P.tipo_id = T.id"; //condição
			$join = "INNER JOIN adm_protocolo_tipo T LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id LEFT JOIN cad_candidato_juridico CJ ON P.candidato_juridico_id = CJ.id"; //join
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela." P", $where, "GROUP BY P.id","", $join);
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$fis_nome = $linha1["fis_nome"];
				$fis_doc = $linha1["fis_doc"];
				$jur_nome = $linha1["jur_nome"];
				$jur_doc = $linha1["jur_doc"];
				//monta informações do requerente
				$requerente_leg = "Indefinido";
				if(($fis_nome != "") and ($fis_nome != NULL)){
					$requerente_leg = "<b>$fis_nome</b>,";
					$requerente_leg .= "<br>PESSOA FÍSICA - CPF. $fis_doc";
				}//if(($fis_nome != "") and ($fis_nome != NULL)){
				if(($jur_nome != "") and ($jur_nome != NULL)){
					$requerente_leg = "<b>$jur_nome</b>,";
					$requerente_leg .= "<br>PESSOA JURÍDICA";
					if(($jur_doc != "") and ($jur_doc != NULL)){ $requerente_leg .= " - CNPJ. $jur_doc"; }
				}//if(($jur_nome != "") and ($jur_nome != NULL)){
				$linha1["requerente"] = $requerente_leg;
				//verifica mapa tramitação
				if($acao == "mapa_tramitacao"){
					if($extra_tipo_tramitacao != "OFF"){
						$linha1["tipo_tramitacao"] = $extra_tipo_tramitacao;
					}
				}//if($acao == "mapa_tramitacao"){
				//alimenta linha de retorno
				$arrRet = $linha1;
			}//fim do while 
			
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $arrRet;
	}//getProtocolo
	
		
	
	/* protocoloCriarEvento
	Funcao utilizada para criar eventos no protocolo
	*/
	static function protocoloCriarEvento($rm,$departamento_id,$user,$evento,$descricao,$timeline="",$timeline_id=""){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/eventos"; //caminho completo da pasta do protocolo	
			if(file_exists($verPasta)){
				$url_buffer = $verPasta."/0";
				if(file_exists($url_buffer)){
					$arrFile = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($url_buffer),"get"),"dec");
					$cont_BF = ceil(count($arrFile));
					if($cont_BF >= "7"){
						$c_file = fGERAL::criaFileCont($verPasta,"retorno"); rename($url_buffer, $verPasta."/".$c_file); unset($arrFile);
						fBKP::bkpFile($verPasta."/".$c_file);//adiciona arquivo em lista de arquivo BACKUP
					}
				}
				//inicia criação do array de dados
				$array["evento"] = $evento; $array["descricao"] = $descricao; $array["departamento_id"] = $departamento_id; $array["user"] = $user;
				if($timeline != ""){ $array["timeline"] = $timeline; } if($timeline_id != ""){ $array["timeline_id"] = $timeline_id; }//verifica se adiciona itens de timeline
				//pega o nome do departamento
				$array["departamento"] = "";
				$resu = fSQL::SQL_SELECT_SIMPLES("code,nome", "sys_perfil_deptos", "id = '".$array["departamento_id"]."'", "");
				while($linha = fSQL::FETCH_ASSOC($resu)){
					$array["departamento"] = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($array["departamento_id"],$linha["code"])." ".$linha["nome"];
				}//fim while
				$array["time"] = time();
				$arrFile[] = $array;
				$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrFile,"enc"),"send");
				file_put_contents($verPasta."/0",$file_ret);
				fBKP::bkpFile($verPasta."/0");//adiciona arquivo em lista de arquivo BACKUP				
			}//if(file_exists($verPasta)){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return time();
	}//protocoloCriarEvento
	
	
	
	
	
	
	
	
		
	
	/* protocoloSendSMS
	Funcao utilizada para enviar legenda de mensagem de torpedos no protocolo
	*/
	static function protocoloLegTorpedo($nome,$mensagem,$rm){
		//PROCESSA DADOS DE RETORNO
		$cnt = "0";
		$cnt++; $arrInfo[$cnt] = "Olha ".$nome.", Seu processo Número ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nGerou a mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Eu tenho uma informação de seu processo ".$nome.", Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nMensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Opa ".$nome.", Nº ".SYS_CONFIG_RM_SIGLA." ".$rm." de um processo, me pediu pra te entregar essa mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = $nome.", Seu processo Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nTem a seguinte mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Tenho uma mensagem para você ".$nome.", o processo Nº ".SYS_CONFIG_RM_SIGLA." ".$rm.": \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "O processo Número ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nTem a seguinte mensagem: \n<u>".$mensagem."</u> \nÉ pra você ".$nome."!";
		$cnt++; $arrInfo[$cnt] = "<u>".$mensagem."</u> \n\nVeio do processo Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."! OK, ".$nome."... ";
		$cnt++; $arrInfo[$cnt] = $nome.", Tenho mais uma mensagem: \n<u>".$mensagem."</u> \nEla veio do processo Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."!";
		$cnt++; $arrInfo[$cnt] = $nome.", Processo Número ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nPreciso te entregar a seguinte mensagem: \n<u>".$mensagem."</u>";
		$info = $arrInfo[rand(1,$cnt)];
		return $info;
	}//protocoloLegTorpedo
	
	
	
	
	
	
		
	
	/* protocoloSendSMS
	Funcao utilizada para enviar SMS no protocolo
	*/
	static function protocoloSendSMS($rm,$departamento_id,$user,$mensagem,$acao_evento="1",$time_envio="0"){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]; //caminho completo da pasta do protocolo
			if((!file_exists($verPasta."/SMSOFF")) and (file_exists($verPasta."/EXECUTANDO"))){
				//WHERE de dados SQL
				$SQL_where = " ( `ano` = '".$aCode["ano"]."' AND `mes` = '".$aCode["mes"]."' AND `dia` = '".$aCode["dia"]."' AND `cont` = '".$aCode["cont"]."' )"; //condição						
				//campos de consulta SQL
				$SQL_campos = "id,candidato_fisico_id,procurador_fisico_id"; //campo da tabela			
				//retorna linha de dados SQL
				$linha = fSQL::SQL_SELECT_ONE($SQL_campos, "protocolo_executando", $SQL_where);
				//adiciona e ajusta dados adicionais a consulta SQL
				$code_RM = fGERAL::legCode7($rm);	
				//busca dados do candidato
				if($linha["procurador_fisico_id"] >= "1"){ $fisico_id = $linha["procurador_fisico_id"]; }else{ $fisico_id = $linha["candidato_fisico_id"]; }
				//campos de consulta SQL
				$SQL_campos = "CF.nome AS fis_nome, CF.cpf, CF.datan, CF.sexo"; //campo da tabela
				$SQL_campos .= ",C.celular"; //campo da tabela				
				//JOIN de dados SQL
				$SQL_join = "LEFT JOIN cad_candidato_fisico_celular C ON CF.id = C.candidato_fisico_id"; //join
				//WHERE de dados SQL
				$SQL_where = "CF.id = '$fisico_id' AND C.principal = '1'"; //condição			
				//retorna linha de dados SQL
				$linha2 = fSQL::SQL_SELECT_ONE($SQL_campos,"cad_candidato_fisico CF", $SQL_where, "GROUP BY CF.id", $SQL_join);
				
				//dados de envio de SMS/TORPEDOS
				$nome_res = maiusculo(primeiro_nome($linha2["fis_nome"],"1","11"));
				$texto_torpedo = fRM::protocoloLegTorpedo($nome_res,$mensagem,$code_RM);
				$texto_torpedo .= "\n:)\nCaso precise que eu fale mais desse processo, me responde: <b>FALE MAIS ou SIM</b>";
				$parametros = "[MAIS]".fGERAL::limpaCode($rm);
				$texto_sms = $nome_res.", Processo ".SYS_CONFIG_RM_SIGLA." ".$code_RM." > ".$mensagem;
				//classe de envio de TORPEDOS (mensagens,SMS)
				$classTORPEDO = new fTORPEDOS(VAR_DIR_RAIZ."sys/");
				$classTORPEDO->updatePessoa($linha2["fis_nome"],$linha2["cpf"],$linha2["datan"],$linha2["sexo"]);
				$smsRet = $classTORPEDO->sendTorpedo($linha2["cpf"],$linha2["celular"],$texto_sms,$texto_torpedo,$parametros);
				if($acao_evento == "1"){
					//atualiza contagem SMS
					$condicao = "id='".$linha["id"]."'";
					fSQL::SQL_UPDATE_OPERACAO("sms_cont", "protocolo_executando", array("1"), $condicao, array("+"));
					fRM::protocoloCriarEvento($rm,$departamento_id,$user,"Envio de TORPEDO", "Foi enviado um TORPEDO(mensagem) para: <br>Número: ".$linha2["celular"]." em ".date('d/m/Y H:i')."h <br>Com a mensagem: <b>".$texto_sms."</b>","sms",$linha2["celular"]);
				}//if($acao_evento == "1"){	
			}//if((!file_exists($verPasta."/SMSOFF")) and (file_exists($verPasta."/EXECUTANDO"))){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
	}//protocoloSendSMS
	
	
	
	/* protocoloTramiteTrocaApensos
	Funcao utilizada para trocar depto de protocolo apensados em outro protocolo na tramitação
	*/
	static function protocoloTramiteTrocaApensos($id,$perfil_id,$depto_a,$time_parado,$user){
		if($id >= "1"){								
			//verifica registro ativo do protocolo
			$resuA = fSQL::SQL_SELECT_SIMPLES("id,ano,mes,dia,cont", "protocolo_executando", "apensado_id = '".$id."'", "", "100");
			while($linha2 = fSQL::FETCH_ASSOC($resuA)){
				$id_ = $linha2["id"];
				//verifica código já abre o protocolo
				unset($arrProtA,$valores);
				$protPastaA = VAR_DIR_FILES."files/tabelas/protocolo/".$linha2["ano"]."/".fGERAL::completaZero($linha2["mes"],"2")."/".fGERAL::completaZero($linha2["dia"],"2")."/".$linha2["cont"];
				if(file_exists($protPastaA."/dados.fai")){
					$arrProtA = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($protPastaA."/dados.fai"),"get"),"dec");				
				}
				$arrProtA["perfil_a"] = $perfil_id;
				$arrProtA["depto_a"] = $depto_a;
				$arrProtA["time_parado"] = $time_parado;
				$arrProtA["user_id"] = 'NULL';
				$arrProtA["user_a"] = $user;
				$arrProtA["sync"] = time();
				$campos = "perfil_a"; $valores[] = $arrProtA["perfil_a"];
				$campos .= ",depto_a"; $valores[] = $arrProtA["depto_a"];
				$campos .= ",user_id"; $valores[] = $arrProtA["user_id"];
				$campos .= ",time_parado"; $valores[] = $arrProtA["time_parado"];
				$campos .= ",user_a"; $valores[] = $arrProtA["user_a"];
				$campos .= ",sync"; $valores[] = $arrProtA["sync"];	
				fSQL::SQL_UPDATE_SIMPLES($campos, "protocolo_executando", $valores, "id = '".$id_."'");
				$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrProtA,"enc"),"send");
				file_put_contents($protPastaA."/dados.fai",$file_ret);
				fBKP::bkpFile($protPastaA."/dados.fai");//adiciona arquivo em lista de arquivo BACKUP
				fRM::protocoloTramiteTrocaApensos($id_,$perfil_id,$depto_a,$time_parado,$user);//verifica se tem apensos nesse processo
			}//while
		}//if($id >= "1"){	
		return $arrRet;
	}//protocoloTramiteTrocaApensos
	
	
	
	/* protocoloTramite
	Funcao utilizada para retornar o protocolo de RM
	*/
	static function protocoloTramite($rm,$departamento_id,$user,$numero_guia,$acao,$receptor_id="",$vai_volta="0",$caminhoScript="../"){
		//verifica se recebeu código já abre o protocolo
		$aCode = fGERAL::returnCode7($rm);
		$protPasta = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"];
		if(file_exists($protPasta."/dados.fai")){
			$arrProt = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($protPasta."/dados.fai"),"get"),"dec");
			//pega o nome do departamento
			$resuM = fSQL::SQL_SELECT_SIMPLES("code,perfil_id,nome", "sys_perfil_deptos", "id = '".$departamento_id."'", "");
			while($linha = fSQL::FETCH_ASSOC($resuM)){
				$depto_perfil_d = $linha["perfil_id"];
				$depto_nome_d = $linha["nome"]."( ".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($departamento_id,$linha["code"])." )";
			}//fim while
			//campos para mapa
			$mapa_editado = "0";
			$extra_campo = ",T.mapa_tramitacao AS tipo_tramitacao,T.parado_tipo";
			$extra_where = " AND P.tipo_id = T.id";
			$extra_tabela = ", adm_protocolo_tipo T";
			$extra_tipo_tramitacao = "";
			$tipo_tramitacao_novo = "";//variavel que identifica alteração em mapa tramitação - vai e volta
			//verifica se já foi alterado o mapa
			if(isset($arrProt["tipo_tramitacao"])){
				$mapa_editado = "1";
				$extra_tipo_tramitacao = $arrProt["tipo_tramitacao"];
				$extra_campo = ",T.parado_tipo";
			}//if(isset($arrProt["tipo_tramitacao"])){
			//verifica registro ativo do protocolo
			$campos = "P.id,P.depto_a,P.mapa_tramitacao_id,P.mapa_tramitacao,D.code,D.perfil_id,D.nome".$extra_campo; //campos da tabela
			$where .= " P.`id` = '".$arrProt["id"]."' AND P.depto_a = D.id".$extra_where; //condição
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, "protocolo_executando P, sys_perfil_deptos D".$extra_tabela, $where, "GROUP BY P.id");
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$id = $linha1["id"];
				$depto_a = $linha1["depto_a"]; $depto_a_ = $depto_a;
				$mapa_tramitacao_id = $linha1["mapa_tramitacao_id"];
				$mapa_tramitacao = arrayDB($linha1["mapa_tramitacao"]);
				$depto_rm = fGERAL::legCode($depto_a,$linha1["code"]);
				$perfil_id = $linha1["perfil_id"]; $perfil_id_ = $perfil_id;
				$depto_nome = $linha1["nome"];
				$parado_tipo = $linha1["parado_tipo"];
				if($mapa_editado == "0"){
					$tipo_tramitacao = arrayDB($linha1["tipo_tramitacao"]);
				}else{//if($extra_tabela != ""){
					$tipo_tramitacao = arrayDB($extra_tipo_tramitacao); if($tipo_tramitacao == "VAZIO"){ $tipo_tramitacao = ""; }
				}//else{//if($extra_tabela != ""){
				$status_n = "";
				//AÇÕES DO TRÂMITE DE PROTOCOLOS
				if($acao == "tramite"){
					$status_n = "4";//EM TRAMITAÇÃO
					fRM::protocoloCriarEvento($rm,$departamento_id,$user,"Envio de Processo", "Processo enviado de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." através da Guia de Tramitação Nº ".$numero_guia,"tramite",$numero_guia);
					//verifica se envia ou nao SMS no processo de tramite
					if($receptor_id == "SEM_SMS"){
						$receptor_id = "";
					}else{//if($receptor_id == "SEM_SMS"){
						fRM::protocoloSendSMS($rm,$departamento_id,$user,"Aguarde, seu processo está em tramitação para ".$depto_nome_d);
					}//else{//if($receptor_id == "SEM_SMS"){
				}//if($acao == "tramite"){
				if($acao == "recebido"){
					$status_n = "1";//ATIVO
					$depto_a = $departamento_id;
					$perfil_id = $depto_perfil_d;
					fRM::protocoloCriarEvento($rm,$departamento_id,$user,"Recebimento de Processo", "Processo movido de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." através da Guia de Tramitação Nº ".$numero_guia,"tra_recebido",$numero_guia);
					//verifica possíveis notificações no processo	
					$resu2 = fSQL::SQL_SELECT_SIMPLES("rm", "protocolo_executando_notificacao", "protocolo_id = '".$id."'", "", "200");
					while($linha2 = fSQL::FETCH_ASSOC($resu2)){
						fRM::notificacaoAcaoProcessoTramite($linha2["rm"],$perfil_id,$depto_a,$receptor_id,$user);						
					}//while
					
					//atualiza o mapa de tramitação ...............................................................................................>>>>
					$seguindo_mapa = "0"; $marca_mapa = ".0.";
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//monta array
						$mapa_tramitacao_arr = explode(",",$mapa_tramitacao);//cria o array
					}
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						$tipo_tramitacao_arr = explode(",",$tipo_tramitacao);
						//inicia verificação caso já exista uma tramitação
						$busca_primeiro = "1";
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
							//monta array
							$array = array_reverse($mapa_tramitacao_arr);//reverte o array para leitura 
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor == ".F."){ $marca_mapa = ".F.";$busca_primeiro = "0"; $seguindo_mapa = "0"; break; }
									$arrSb = explode("-", $valor);
									if($arrSb["0"] >= "1"){//verifica o ultimo elemento que seguiu o mapa	
										$cont_ = "0";
										//monta array
										$arrayS = $tipo_tramitacao_arr;
										$cont_ARRAYS = ceil(count($arrayS));
										if($cont_ARRAYS >= "1"){
											foreach ($arrayS as $posS => $valorS){
												$arrSS = explode("-", $valorS);
												if($cont_ == "1"){//adiciona o item
													$marca_mapa = ".F.";
													if($arrSS["2"] == $depto_a){ $seguindo_mapa = $arrSS["0"];  }
												}//if($cont_ == "1"){
												if($cont_ == "2"){//adiciona o proximo item
													$busca_primeiro = "0";
													$marca_mapa = ".".$arrSS["2"].".";
												}//if($cont_ == "2"){
												if(($arrSS["0"] == $arrSb["0"]) or ($cont_ >= "1")){ $cont_++; }//verifica se a contagem é igual - pega o proximo item no laço
												if($cont_ >= "3"){ break; }//para laço
											}//fim foreach
											if($cont_ == "2"){ $marca_mapa = ".F."; $busca_primeiro = "0"; }//nao tem proximo, define como fim
										}//fim if($cont_ARRAYS >= "1"){
										break;				
									}//if($arrSb["0"] >= "1"){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
						}//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//busca primeiro do mapa
						if($busca_primeiro == "1"){
							//monta array
							$array = explode(",",$tipo_tramitacao);
							$arrSb = explode("-", $array["0"]);//primeiro item do array
							$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							if($arrSb["2"] == $depto_a){ $seguindo_mapa = $arrSb["0"]; }//verifica se cumpriu mapa
							//pega proximo depto
							if(isset($array["1"])){
								if($seguindo_mapa >= "1"){
									$arrSb = explode("-", $array["1"]);//primeiro item do array
								}else{
									$arrSb = explode("-", $array["0"]);//primeiro item do array
								}
								$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							}else{
								$marca_mapa = ".F.";//pega o próximo depto a enviar
							}
						}//if($busca_primeiro == "1"){		
						//verifica se chegou ao fim do mapa
						if($seguindo_mapa >= "1"){
							$mapa_tramitacao_id = $depto_a;
						}else{//if($seguindo_mapa >= "1"){
							if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
								$mapa_tramitacao_arr__ = $mapa_tramitacao_arr;
								$marca_mapa = array_pop($mapa_tramitacao_arr__);//pega ultimo item
							}
						}//else{//if($seguindo_mapa >= "1"){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
											
					//atualiza string do mapa
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
						array_pop($mapa_tramitacao_arr);//remove ultimo item
						$mapa_tramitacao = implode(",",$mapa_tramitacao_arr);
						$mapa_tramitacao .= ",";
					}else{ $mapa_tramitacao = ""; }//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
					//verifica se tem vai e volta e mapa para definir...........................................................................
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						if(($vai_volta == "1") and ($seguindo_mapa == "0")){
							//pega dados de mapa se já existente
							unset($vDepto);
							//monta array de dados
							$array = $mapa_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach($array as $pos => $valor){
									if($valor != ""){
										$arrSb = explode("-", $valor);
										if($arrSb["2"] >= "1"){						
											$arrSb = explode("-", $valor);
											if($arrSb["0"] >= "1"){				
												if(isset($vDepto[$arrSb["2"]])){ $vDepto[$arrSb["2"]] = $vDepto[$arrSb["2"]]+1; }else{ $vDepto[$arrSb["2"]] = "1"; }
											}//$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
										}//if($arrSb["2"] >= "1"){
									}//if($valor != ""){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
							//inicia o processo de verificação do mapa e inclusão de novo depto
							$cont_ID = "0"; $cont_list = "0";//cont de controle do laço
							//monta array
							$array = $tipo_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							//listar item ja cadastrados
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor != ""){
										$arrSub = explode("-", $valor);//[,ORDEM-PERFIL_ID-DEPTO_ID,]
										$cont_list++;
										//verifica se já tramitou
										if(isset($vDepto[$arrSub["2"]])){
											//JA PASSOU NO MAPA
											$vDepto[$arrSub["2"]] = $vDepto[$arrSub["2"]]-1;//retira da contagem
											if($vDepto[$arrSub["2"]] <= "0"){ unset($vDepto[$arrSub["2"]]); }//se zerou a contagem, remove da variavel
										}else{//if(isset($vDepto[$arrSub["2"]])){
											$cont_ID++;//incrementa controle de ids do sort
											if($cont_ID == "1"){
												if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;
												$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
												$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
												$cont_list++;
											}
										}//else{//if(isset($vDepto[$arrSub["2"]])){
										if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$arrSub["1"]."-".$arrSub["2"];
									}//if($valor != ""){
								}//fim foreach
								///se no laço nao localizou, coloca no fim do mapa
								if($cont_ID == "0"){
									$cont_list++;
									if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;
									$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
									$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
								}//if($cont_ID == "0"){
							}//fim if($cont_ARRAY >= "1"){	
						}//if(($vai_volta == "1") and ($seguindo_mapa == "0")){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
					$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
					//atualiza o mapa de tramitação ...............................................................................................<<<<
				}//if($acao == "recebido"){
				if($acao == "cancelado"){
					$status_n = "1";//ATIVO
					fRM::protocoloCriarEvento($rm,$departamento_id,$user,"Retorno de Processo", "Processo devolvido de ".$depto_nome_d." para ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) através da Guia de Tramitação Nº ".$numero_guia,"tra_cancelado",$numero_guia);
					//verifica se existe se precisa remover auto tramitação
					if(file_exists($protPasta."/auto_tramitacao.fai")){
						delete($protPasta."/auto_tramitacao.fai");
						fBKP::bkpDelFile($protPasta."/auto_tramitacao.fai");//adiciona arquivo em lista de excluídos BACKUP
					}//if(file_exists($protPasta."/auto_tramitacao.fai")){
				}//if($acao == "cancelado"){
				//APLICA STATUS DA AÇÃO
				if($status_n != ""){
					$arrProt["status"] = $status_n;
					//faz o ajuste de dados na tabela ---------------------------------------
					$campos = "status";
					$valores = array($arrProt["status"]);//define status como duam em aberto
					if($acao == "recebido"){//só atualiza sync se a tramiração ocorreu
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){ $mapa_tramitacao = "[,".$mapa_tramitacao.",]"; }
						if($mapa_tramitacao_id == ""){ $mapa_tramitacao_id = 'NULL'; }
						//monta time parado
						if($parado_tipo != "0"){
							if((!isset($arrProt["time_parado"])) or ($arrProt["time_parado"] == "0") or ($arrProt["time_parado"] == "")){ $arrProt["time_parado"] = $arrProt["sync"]; }
							$time_parado = $arrProt["time_parado"];
						}else{ $time_parado = time(); }//if($parado_tipo != "0"){	
						//verifica se tem recepator e define responsável
						$user_sel = 'NULL';
						$receptor_idd = (int)$receptor_id; if($receptor_idd >= "1"){ $user_sel = $receptor_idd; } if(($user_sel == "") or ($user_sel == "0")){ $user_sel = 'NULL'; }
						$arrProt["perfil_a"] = $perfil_id;
						$arrProt["depto_a"] = $depto_a;
						$arrProt["mapa_tramitacao_id"] = $mapa_tramitacao_id;
						$arrProt["mapa_tramitacao"] = $mapa_tramitacao;
						$arrProt["time_parado"] = $time_parado;
						$arrProt["user_id"] = 'NULL';
						$arrProt["user_auxiliar"] = 'NULL';
						$arrProt["user_a"] = $user;
						$arrProt["sync"] = time();
						$campos .= ",perfil_a"; $valores[] = $arrProt["perfil_a"];
						$campos .= ",depto_a"; $valores[] = $arrProt["depto_a"];
						$campos .= ",mapa_tramitacao_id"; $valores[] = $arrProt["mapa_tramitacao_id"];
						$campos .= ",mapa_tramitacao"; $valores[] = $arrProt["mapa_tramitacao"];
						$campos .= ",user_id"; $valores[] = $arrProt["user_id"];
						$campos .= ",user_auxiliar"; $valores[] = $arrProt["user_auxiliar"];
						$campos .= ",time_parado"; $valores[] = $arrProt["time_parado"];
						$campos .= ",user_a"; $valores[] = $arrProt["user_a"];
						$campos .= ",sync"; $valores[] = $arrProt["sync"];
						//verifica se muda mapa de tramitação
						if($tipo_tramitacao_novo != ""){
							$tipo_tramitacao_novo = "[,".$tipo_tramitacao_novo.",]";
							$arrProt["tipo_tramitacao"] = $tipo_tramitacao_novo;
							$arrProt["tipo_tramitacao_user"] = "VAI E VOLTA NO TRÂMITE";
						}//if($tipo_tramitacao_novo != ""){	
						//verifica se existe auxiliares
					}//if($acao == "recebido"){
					fSQL::SQL_UPDATE_SIMPLES($campos, "protocolo_executando", $valores, "id = '".$arrProt["id"]."'");
					$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrProt,"enc"),"send");
					file_put_contents($protPasta."/dados.fai",$file_ret);
					fBKP::bkpFile($protPasta."/dados.fai");//adiciona arquivo em lista de arquivo BACKUP
					//verifica se existe apensados...................................>>>
					if($acao == "recebido"){					
						//faz atualização em conversas do processo se existir
						$campos = "perfil_a,depto_a,user_id";
						$valores = array($arrProt["perfil_a"],$arrProt["depto_a"],$arrProt["user_id"]);//define status como duam em aberto
						fSQL::SQL_UPDATE_SIMPLES($campos, "protocolo_executando_conversas", $valores, "protocolo_id = '".$arrProt["id"]."'");									
						//verifica registro ativo do protocolo apensado
						fRM::protocoloTramiteTrocaApensos($arrProt["id"],$perfil_id,$depto_a,$time_parado,$user);//verifica se tem apensos nesse processo
						//verifica se existe se precisa realizar ações de auto tramitação
						if(file_exists($protPasta."/auto_tramitacao.fai")){
							$arrAuto = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($protPasta."/auto_tramitacao.fai"),"get"),"dec");//id, valor
							if((isset($arrAuto["id"])) and ($arrAuto["id"] != "")){
								//INICIA FUNÇÃO DE CLASSE DE PROTOCOLO +++
								$CLASS_PROT = fRM::classProtocolo("","","",$caminhoScript);
								//CLASSE #######=> seta os dados de controle para manipulação
								$CLASS_PROT["protocolo"]->setIds($arrProt["ano"],$arrProt["mes"],$arrProt["dia"],$arrProt["cont"],$user,$departamento_id);//setIds($ano,$mes,$dia,$user,$depto)								
								//INCLUDE DE CLASSES DE DUAM
								include $caminhoScript."classDb/fin_duam.php";//classes	
								//CLASSE #######=> editar dados de serviço no processo
								$servicoRet = $CLASS_PROT["protocolo"]->acaoServico("1","SERVIÇO DE INÍCIO DO PROCESSO!",$arrAuto["id"],$arrAuto["valor"],$receptor_id);//- APLICAR AÇÃO EM SERVIÇO
							}//if(isset($arrAuto["id"])) or ($arrAuto["id"] != "")){
							delete($protPasta."/auto_tramitacao.fai");
							fBKP::bkpDelFile($protPasta."/auto_tramitacao.fai");//adiciona arquivo em lista de excluídos BACKUP														
						}//if(file_exists($protPasta."/auto_tramitacao.fai")){
					}//if($acao == "recebido"){
					//verifica se existe apensados...................................<<<
				}//if($status_n != ""){
			}//fim do while			
		}//if(file_exists($apensarPasta."/dados.fai")){
		return $arrRet;
	}//protocoloTramite
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NO PROTOCOLO PPPPPPPPPPPPPPPPPPPPPP<<<
	
	
	
	
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NO OFÍCIO PPPPPPPPPPPPPPPPPPPPPP>>>
	//CLASSE PARA INICIAR DADOS DE OFÍCIO
	static function classOficio($id_a="",$user="",$depto="",$caminhoScript="../"){
		//verifica se recebeu código já abre o ofício
		if(($id_a != "") and ($user != "") and ($depto != "")){
			$aCode = fGERAL::returnCode7($id_a);
			if($aCode["ano"] != ""){ $cont_encontrou = "1"; }else{ $cont_encontrou = "0"; }
		}				
		include $caminhoScript."class/oficio.php";//classes de conexao
		if(class_exists('classOficio')){	
			//INICIAR CLASSE --->>> OFÍCIO
			$class_oficio = new classOficio;//inicia a classe
		}//class_exists
		
		if($cont_encontrou == "1"){		
			//CLASSE #######=> seta os dados de controle para manipulação
			$RET["encontrou"] = $class_oficio->setIds($aCode["ano"],$aCode["mes"],$aCode["dia"],$aCode["cont"],$user,$depto);//setIds($ano,$mes,$dia,$cont,$user,$depto)
		}else{ $RET["encontrou"] = "0"; }
		//dados de retorno
		$RET["oficio"] = $class_oficio;
		return $RET;
	}//classOficio




	/* getOficio
	Funcao utilizada para retornar o ofício de RM
	*/
	static function getOficio($rm,$acao=""){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/oficio/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]; //caminho completo da pasta do ofício
			if(file_exists($verPasta."/EXECUTANDO")){ $tabela = "oficio_executando"; }else{ $tabela = "oficio_arquivo_".$aCode["ano"]; }
			//verifica se a ação é mapa de tramitação
			$extra_campo = ""; $extra_tipo_tramitacao = "OFF";
			if($acao == "mapa_tramitacao"){
				//campos para mapa
				$extra_campo = ",T.mapa_tramitacao AS tipo_tramitacao";
				if(file_exists($verPasta."/dados.fai")){
					$arrOfic = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($verPasta."/dados.fai"),"get"),"dec");
					//verifica se já foi alterado o mapa
					if(isset($arrOfic["tipo_tramitacao"])){
						$extra_tipo_tramitacao = $arrOfic["tipo_tramitacao"];
						if($extra_tipo_tramitacao == "VAZIO"){ $extra_tipo_tramitacao = ""; }
						$extra_campo = "";
					}//if(isset($arrOfic["tipo_tramitacao"])){
				}//if(file_exists($protPasta."/dados.fai")){				
			}//if($acao == "mapa_tramitacao"){
			//dados sql	
			$campos = "P.code,P.ano,P.mes,P.dia,P.cont,P.mapa_tramitacao,P.user_id_i,P.time,P.status,T.nome AS tipo".$extra_campo.",U.code AS solicitante_code,U.nome AS solicitante_nome,U.cargo AS solicitante_cargo"; //campos da tabela
			$where .= " ( P.`ano` = '".$aCode["ano"]."' AND P.`mes` = '".$aCode["mes"]."' AND P.`dia` = '".$aCode["dia"]."' AND P.`cont` = '".$aCode["cont"]."' ) AND P.tipo_id = T.id AND P.user_id_i = U.id"; //condição
			$join = "INNER JOIN adm_oficio_tipo T INNER JOIN sys_usuarios U"; //join
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela." P", $where, "GROUP BY P.id","", $join);
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				//monta informações do requerente	
				$requerente_leg = "<b>".$linha1["solicitante_nome"]." ( ".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($linha1["user_id_i"],$linha1["solicitante_code"])." )</b>,";
				if($linha1["solicitante_cargo"] != ""){ $requerente_leg .= "<br><i>".$linha1["solicitante_cargo"]."</i>"; }
				if(fRM::oficioStatusSolicitanteTroca($rm) == "1"){
					$requerente_leg .= '<br><a href="#" class="btn btn-warning btn-mini"><i class="icon-unlock"></i> PERMITINDO A TROCA DE SOLICITANTE - (está permitindo a troca) </a>';
				}
				$linha1["requerente"] = $requerente_leg;
				//verifica mapa tramitação
				if($acao == "mapa_tramitacao"){
					if($extra_tipo_tramitacao != "OFF"){
						$linha1["tipo_tramitacao"] = $extra_tipo_tramitacao;
					}
				}//if($acao == "mapa_tramitacao"){				
				//alimenta linha de retorno
				$arrRet = $linha1;
			}//fim do while 
			
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $arrRet;
	}//getOficio
	
		
	
	/* oficioStatusSolicitanteTroca
	Funcao utilizada para verificar se existe solicitação de troca de solicitante no ofício
	*/
	static function oficioStatusSolicitanteTroca($rm){
		$aCode = fGERAL::returnCode7($rm);
		$varRet = 0;
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/oficio/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]; //caminho completo da pasta do ofício	
			if(file_exists($verPasta)){
				if(file_exists($verPasta."/SOLICITANTETROCA")){ $varRet = 1; }
			}//if(file_exists($verPasta)){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $varRet;
	}//oficioStatusSolicitanteTroca
	
		
	
	/* oficioCriarEvento
	Funcao utilizada para criar eventos no ofício
	*/
	static function oficioCriarEvento($rm,$departamento_id,$user,$evento,$descricao,$timeline="",$timeline_id=""){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/oficio/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/eventos"; //caminho completo da pasta do ofício	
			if(file_exists($verPasta)){
				$url_buffer = $verPasta."/0";
				if(file_exists($url_buffer)){
					$arrFile = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($url_buffer),"get"),"dec");
					$cont_BF = ceil(count($arrFile));
					if($cont_BF >= "7"){
						$c_file = fGERAL::criaFileCont($verPasta,"retorno"); rename($url_buffer, $verPasta."/".$c_file); unset($arrFile);
						fBKP::bkpFile($verPasta."/".$c_file);//adiciona arquivo em lista de arquivo BACKUP
					}
				}
				//inicia criação do array de dados
				$array["evento"] = $evento; $array["descricao"] = $descricao; $array["departamento_id"] = $departamento_id; $array["user"] = $user;
				if($timeline != ""){ $array["timeline"] = $timeline; } if($timeline_id != ""){ $array["timeline_id"] = $timeline_id; }//verifica se adiciona itens de timeline
				//pega o nome do departamento
				$array["departamento"] = "";
				$resu = fSQL::SQL_SELECT_SIMPLES("code,nome", "sys_perfil_deptos", "id = '".$array["departamento_id"]."'", "");
				while($linha = fSQL::FETCH_ASSOC($resu)){
					$array["departamento"] = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($array["departamento_id"],$linha["code"])." ".$linha["nome"];
				}//fim while
				$array["time"] = time();
				$arrFile[] = $array;
				$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrFile,"enc"),"send");
				file_put_contents($verPasta."/0",$file_ret);	
				fBKP::bkpFile($verPasta."/0");//adiciona arquivo em lista de arquivo BACKUP			
			}//if(file_exists($verPasta)){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $timeFile;
	}//oficioCriarEvento
	
	
	
	
	/* oficioTramite
	Funcao utilizada para retornar o ofício de RM
	*/
	static function oficioTramite($rm,$departamento_id,$user,$numero_guia,$acao,$receptor_id,$vai_volta="0"){
		//verifica se recebeu código já abre o ofício
		$aCode = fGERAL::returnCode7($rm);
		$oficPasta = VAR_DIR_FILES."files/tabelas/oficio/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"];
		if(file_exists($oficPasta."/dados.fai")){
			$arrOfic = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($oficPasta."/dados.fai"),"get"),"dec");
			//pega o nome do departamento
			$resuM = fSQL::SQL_SELECT_SIMPLES("code,perfil_id,nome", "sys_perfil_deptos", "id = '".$departamento_id."'", "");
			while($linha = fSQL::FETCH_ASSOC($resuM)){
				$depto_perfil_d = $linha["perfil_id"];
				$depto_nome_d = $linha["nome"]."( ".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($depto_d,$linha["code"])." )";
			}//fim while
			//campos para mapa
			$extra_campo = ",T.mapa_tramitacao AS tipo_tramitacao";
			$extra_where = " AND P.tipo_id = T.id";
			$extra_tabela = ", adm_oficio_tipo T";
			$extra_tipo_tramitacao = "";
			$tipo_tramitacao_novo = "";//variavel que identifica alteração em mapa tramitação - vai e volta
			//verifica se já foi alterado o mapa
			if(isset($arrOfic["tipo_tramitacao"])){
				$extra_tipo_tramitacao = $arrOfic["tipo_tramitacao"];
				$extra_campo = ""; $extra_where = ""; $extra_tabela = "";
			}//if(isset($arrOfic["tipo_tramitacao"])){
			//pega o nome do receptor
			$user_nome_d = "Qualquer receptor no depto";
			if(($receptor_id >= "1") and ($receptor_id != "NULL")){
				$resuM = fSQL::SQL_SELECT_SIMPLES("code,nome", "sys_usuarios", "id = '".$receptor_id."'", "");
				while($linha = fSQL::FETCH_ASSOC($resuM)){
					$user_nome_d = $linha["nome"]." ( ".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($receptor_id,$linha["code"])." )";
				}//fim while
			}else{ $receptor_id = "NULL"; }//if($receptor_id >= "1"){
			//verifica registro ativo do ofício
			$campos = "P.id,P.depto_a,P.mapa_tramitacao_id,P.mapa_tramitacao,D.code,D.perfil_id,D.nome".$extra_campo; //campos da tabela
			$where .= " P.`id` = '".$arrOfic["id"]."' AND P.depto_a = D.id".$extra_where; //condição
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, "oficio_executando P, sys_perfil_deptos D".$extra_tabela, $where, "GROUP BY P.id");
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$id = $linha1["id"];
				$depto_a = $linha1["depto_a"]; $depto_a_ = $depto_a;
				$mapa_tramitacao_id = $linha1["mapa_tramitacao_id"];
				$mapa_tramitacao = arrayDB($linha1["mapa_tramitacao"]);
				$depto_rm = fGERAL::legCode($depto_a,$linha1["code"]);
				$perfil_id = $linha1["perfil_id"]; $perfil_id_ = $perfil_id;
				$depto_nome = $linha1["nome"];
				if($extra_tabela != ""){
					$tipo_tramitacao = arrayDB($linha1["tipo_tramitacao"]);
				}else{//if($extra_tabela != ""){
					$tipo_tramitacao = arrayDB($extra_tipo_tramitacao); if($tipo_tramitacao == "VAZIO"){ $tipo_tramitacao = ""; }
				}//else{//if($extra_tabela != ""){
				$status_n = "";
				//AÇÕES DO TRÂMITE DE OFÍCIOS
				if($acao == "tramite"){
					$status_n = "4";//EM TRAMITAÇÃO
					fRM::oficioCriarEvento($rm,$departamento_id,$user,"Envio de Ofício", "Ofício enviado de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." a ".$user_nome_d." através da Guia de Tramitação Nº ".$numero_guia,"tramite",$numero_guia);
				}//if($acao == "tramite"){
				if($acao == "recebido"){
					$status_n = "1";//ATIVO
					$depto_a = $departamento_id;
					$perfil_id = $depto_perfil_d;
					fRM::oficioCriarEvento($rm,$departamento_id,$user,"Retirada de Ofício", "Ofício movido de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." através da Guia de Tramitação Nº ".$numero_guia,"tra_recebido",$numero_guia);
					//atualiza o mapa de tramitação ...............................................................................................>>>>
					$seguindo_mapa = "0"; $marca_mapa = ".0.";
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//monta array
						$mapa_tramitacao_arr = explode(",",$mapa_tramitacao);//cria o array
					}
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						$tipo_tramitacao_arr = explode(",",$tipo_tramitacao);
						//inicia verificação caso já exista uma tramitação
						$busca_primeiro = "1";
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
							//monta array
							$array = array_reverse($mapa_tramitacao_arr);//reverte o array para leitura 
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor == ".F."){ $marca_mapa = ".F.";$busca_primeiro = "0"; $seguindo_mapa = "0"; break; }
									$arrSb = explode("-", $valor);
									if($arrSb["0"] >= "1"){//verifica o ultimo elemento que seguiu o mapa	
										$cont_ = "0";
										//monta array
										$arrayS = $tipo_tramitacao_arr;
										$cont_ARRAYS = ceil(count($arrayS));
										if($cont_ARRAYS >= "1"){
											foreach ($arrayS as $posS => $valorS){
												$arrSS = explode("-", $valorS);
												if($cont_ == "1"){//adiciona o item
													$marca_mapa = ".F.";
													if($arrSS["2"] == $depto_a){ $seguindo_mapa = $arrSS["0"];  }
												}//if($cont_ == "1"){
												if($cont_ == "2"){//adiciona o proximo item
													$busca_primeiro = "0";
													$marca_mapa = ".".$arrSS["2"].".";
												}//if($cont_ == "2"){
												if(($arrSS["0"] == $arrSb["0"]) or ($cont_ >= "1")){ $cont_++; }//verifica se a contagem é igual - pega o proximo item no laço
												if($cont_ >= "3"){ break; }//para laço
											}//fim foreach
											if($cont_ == "2"){ $marca_mapa = ".F."; $busca_primeiro = "0"; }//nao tem proximo, define como fim
										}//fim if($cont_ARRAYS >= "1"){
										break;				
									}//if($arrSb["0"] >= "1"){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
						}//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//busca primeiro do mapa
						if($busca_primeiro == "1"){
							//monta array
							$array = explode(",",$tipo_tramitacao);
							$arrSb = explode("-", $array["0"]);//primeiro item do array
							$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							if($arrSb["2"] == $depto_a){ $seguindo_mapa = $arrSb["0"]; }//verifica se cumpriu mapa
							//pega proximo depto
							if(isset($array["1"])){
								if($seguindo_mapa >= "1"){
									$arrSb = explode("-", $array["1"]);//primeiro item do array
								}else{
									$arrSb = explode("-", $array["0"]);//primeiro item do array
								}
								$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							}else{
								$marca_mapa = ".F.";//pega o próximo depto a enviar
							}
						}//if($busca_primeiro == "1"){		
						//verifica se chegou ao fim do mapa
						if($seguindo_mapa >= "1"){
							$mapa_tramitacao_id = $depto_a;
						}else{//if($seguindo_mapa >= "1"){
							if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
								$mapa_tramitacao_arr__ = $mapa_tramitacao_arr;
								$marca_mapa = array_pop($mapa_tramitacao_arr__);//pega ultimo item
							}
						}//else{//if($seguindo_mapa >= "1"){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
											
					//atualiza string do mapa
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						array_pop($mapa_tramitacao_arr);//remove ultimo item
						$mapa_tramitacao = implode(",",$mapa_tramitacao_arr);
						$mapa_tramitacao .= ",";
					}else{ $mapa_tramitacao = ""; }//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
					//verifica se tem vai e volta e mapa para definir...........................................................................
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						if(($vai_volta == "1") and ($seguindo_mapa == "0")){
							//pega dados de mapa se já existente
							unset($vDepto);
							//monta array de dados
							$array = $mapa_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach($array as $pos => $valor){
									if($valor != ""){
										$arrSb = explode("-", $valor);
										if($arrSb["2"] >= "1"){						
											$arrSb = explode("-", $valor);
											if($arrSb["0"] >= "1"){				
												if(isset($vDepto[$arrSb["2"]])){ $vDepto[$arrSb["2"]] = $vDepto[$arrSb["2"]]+1; }else{ $vDepto[$arrSb["2"]] = "1"; }
											}//$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
										}//if($arrSb["2"] >= "1"){
									}//if($valor != ""){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
							//inicia o processo de verificação do mapa e inclusão de novo depto
							$cont_ID = "0"; $cont_list = "0";//cont de controle do laço
							//monta array
							$array = $tipo_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							//listar item ja cadastrados
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor != ""){
										$arrSub = explode("-", $valor);//[,ORDEM-PERFIL_ID-DEPTO_ID,]
										$cont_list++;
										//verifica se já tramitou
										if(isset($vDepto[$arrSub["2"]])){
											//JA PASSOU NO MAPA
											$vDepto[$arrSub["2"]] = $vDepto[$arrSub["2"]]-1;//retira da contagem
											if($vDepto[$arrSub["2"]] <= "0"){ unset($vDepto[$arrSub["2"]]); }//se zerou a contagem, remove da variavel
										}else{//if(isset($vDepto[$arrSub["2"]])){
											$cont_ID++;//incrementa controle de ids do sort
											if($cont_ID == "1"){
												if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;
												$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
												$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
												$cont_list++;
											}
										}//else{//if(isset($vDepto[$arrSub["2"]])){
										if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$arrSub["1"]."-".$arrSub["2"];
									}//if($valor != ""){
								}//fim foreach
								///se no laço nao localizou, coloca no fim do mapa
								if($cont_ID == "0"){
									$cont_list++;
									if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;
									$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
									$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
								}//if($cont_ID == "0"){
							}//fim if($cont_ARRAY >= "1"){	
						}//if(($vai_volta == "1") and ($seguindo_mapa == "0")){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
					$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
					//atualiza o mapa de tramitação ...............................................................................................<<<<
				}//if($acao == "recebido"){
				if($acao == "cancelado"){
					$status_n = "1";//ATIVO
					fRM::oficioCriarEvento($rm,$departamento_id,$user,"Retorno de Ofício", "Ofício devolvido de ".$depto_nome_d." para ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) através da Guia de Tramitação Nº ".$numero_guia,"tra_cancelado",$numero_guia);
				}//if($acao == "cancelado"){
				//APLICA STATUS DA AÇÃO
				if($status_n != ""){
					$arrOfic["status"] = $status_n;
					//faz o ajuste de dados na tabela ---------------------------------------
					$campos = "status";
					$valores = array($arrOfic["status"]);//define status como duam em aberto
					if($acao == "recebido"){//só atualiza sync se a tramiração ocorreu
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){ $mapa_tramitacao = "[,".$mapa_tramitacao.",]"; }
						if($mapa_tramitacao_id == ""){ $mapa_tramitacao_id = 'NULL'; }
						//verifica se tem recepator e define responsável
						$user_sel = "0";	if($acao == "recebido"){ $receptor_idd = (int)$receptor_id; if($receptor_idd >= "1"){ $user_sel = $receptor_idd; } }
						$arrOfic["perfil_a"] = $perfil_id;
						$arrOfic["depto_a"] = $depto_a;
						$arrOfic["user_id_a"] = $user_sel;
						$arrOfic["mapa_tramitacao_id"] = $mapa_tramitacao_id;
						$arrOfic["mapa_tramitacao"] = $mapa_tramitacao;
						$arrOfic["user_a"] = $user;
						$arrOfic["sync"] = time();
						$campos .= ",perfil_a"; $valores[] = $arrOfic["perfil_a"];
						$campos .= ",depto_a"; $valores[] = $arrOfic["depto_a"];
						$campos .= ",user_id_a"; $valores[] = $arrOfic["user_id_a"];
						$campos .= ",mapa_tramitacao_id"; $valores[] = $arrOfic["mapa_tramitacao_id"];
						$campos .= ",mapa_tramitacao"; $valores[] = $arrOfic["mapa_tramitacao"];
						$campos .= ",user_a"; $valores[] = $arrOfic["user_a"];
						$campos .= ",sync"; $valores[] = $arrOfic["sync"];
						//verifica se muda mapa de tramitação
						if($tipo_tramitacao_novo != ""){
							$tipo_tramitacao_novo = "[,".$tipo_tramitacao_novo.",]";
							$arrOfic["tipo_tramitacao"] = $tipo_tramitacao_novo;
							$arrOfic["tipo_tramitacao_user"] = "VAI E VOLTA NO TRÂMITE";
						}//if($tipo_tramitacao_novo != ""){
					}//if($acao == "recebido"){
					fSQL::SQL_UPDATE_SIMPLES($campos, "oficio_executando", $valores, "id = '".$arrOfic["id"]."'");
					$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrOfic,"enc"),"send");
					file_put_contents($oficPasta."/dados.fai",$file_ret);
					fBKP::bkpFile($oficPasta."/dados.fai");//adiciona arquivo em lista de arquivo BACKUP	
				}//if($status_n != ""){
			}//fim do while			
		}//if(file_exists($apensarPasta."/dados.fai")){
		return $arrRet;
	}//oficioTramite
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NO OFÍCIO PPPPPPPPPPPPPPPPPPPPPP<<<
	
	
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NA NOTIFICAÇÃO PPPPPPPPPPPPPPPPPPPPPP>>>
	//CLASSE PARA INICIAR DADOS DE NOTIFICAÇÃO
	static function classNotificacao($id_a="",$user="",$depto="",$caminhoScript="../"){
		//verifica se recebeu código já abre o notificação
		if(($id_a != "") and ($user != "") and ($depto != "")){
			$aCode = fGERAL::returnCode9($id_a);
			if($aCode["ano"] != ""){ $cont_encontrou = "1"; }else{ $cont_encontrou = "0"; }
		}				
		include $caminhoScript."class/notificacao.php";//classes de conexao
		if(class_exists('classNotificacao')){	
			//INICIAR CLASSE --->>> NOTIFICAÇÃO
			$class_notificacao = new classNotificacao;//inicia a classe
		}//class_exists
		
		if($cont_encontrou == "1"){		
			//CLASSE #######=> seta os dados de controle para manipulação
			$RET["encontrou"] = $class_notificacao->setIds($aCode["ano"],$aCode["mes"],$aCode["dia"],$aCode["cont"],$user,$depto);//setIds($ano,$mes,$dia,$cont,$user,$depto)
		}else{ $RET["encontrou"] = "0"; }
		//dados de retorno
		$RET["notificacao"] = $class_notificacao;
		return $RET;
	}//classNotificacao


	/* getNotificacao
	Funcao utilizada para retornar a notificação de RM
	*/
	static function getNotificacao($rm,$acao=""){
		$aCode = fGERAL::returnCode9($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/notificacao/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]; //caminho completo da pasta
			if(file_exists($verPasta."/EXECUTANDO")){ $tabela = "notificacao_executando"; }else{ $tabela = "notificacao_arquivo_".$aCode["ano"]; }
			//verifica se a ação é mapa de tramitação
			$extra_campo = ""; $extra_tipo_tramitacao = "OFF";
			if($acao == "mapa_tramitacao"){
				//campos para mapa
				$extra_campo = ",T.mapa_tramitacao AS tipo_tramitacao";
				if(file_exists($verPasta."/dados.fai")){
					$arrNoti = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($verPasta."/dados.fai"),"get"),"dec");
					//verifica se já foi alterado o mapa
					if(isset($arrNoti["tipo_tramitacao"])){
						$extra_tipo_tramitacao = $arrNoti["tipo_tramitacao"];
						if($extra_tipo_tramitacao == "VAZIO"){ $extra_tipo_tramitacao = ""; }
						$extra_campo = "";
					}//if(isset($arrNoti["tipo_tramitacao"])){
				}//if(file_exists($protPasta."/dados.fai")){				
			}//if($acao == "mapa_tramitacao"){
			//dados sql	
			$campos = "P.code,P.ano,P.mes,P.dia,P.cont,P.mapa_tramitacao,P.time,P.status,T.nome AS tipo".$extra_campo.",CF.nome AS fis_nome,CF.cpf AS fis_doc,CJ.fantasia AS jur_nome,CJ.cnpj AS jur_doc"; //campos da tabela
			$where .= " ( P.`ano` = '".$aCode["ano"]."' AND P.`mes` = '".$aCode["mes"]."' AND P.`dia` = '".$aCode["dia"]."' AND P.`cont` = '".$aCode["cont"]."' ) AND P.tipo_id = T.id"; //condição
			$join = "INNER JOIN adm_notificacao_tipo T LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id LEFT JOIN cad_candidato_juridico CJ ON P.candidato_juridico_id = CJ.id"; //join
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela." P", $where, "GROUP BY P.id","", $join);
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$fis_nome = $linha1["fis_nome"];
				$fis_doc = $linha1["fis_doc"];
				$jur_nome = $linha1["jur_nome"];
				$jur_doc = $linha1["jur_doc"];
				//monta informações do requerente
				$requerente_leg = "Indefinido";
				if(($fis_nome != "") and ($fis_nome != NULL)){
					$requerente_leg = "<b>$fis_nome</b>,";
					$requerente_leg .= "<br>PESSOA FÍSICA - CPF. $fis_doc";
				}//if(($fis_nome != "") and ($fis_nome != NULL)){
				if(($jur_nome != "") and ($jur_nome != NULL)){
					$requerente_leg = "<b>$jur_nome</b>,";
					$requerente_leg .= "<br>PESSOA JURÍDICA";
					if(($jur_doc != "") and ($jur_doc != NULL)){ $requerente_leg .= " - CNPJ. $jur_doc"; }
				}//if(($jur_nome != "") and ($jur_nome != NULL)){
				$linha1["requerente"] = $requerente_leg;	
				//verifica mapa tramitação
				if($acao == "mapa_tramitacao"){
					if($extra_tipo_tramitacao != "OFF"){
						$linha1["tipo_tramitacao"] = $extra_tipo_tramitacao;
					}
				}//if($acao == "mapa_tramitacao"){			
				//alimenta linha de retorno
				$arrRet = $linha1;
			}//fim do while 
			
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $arrRet;
	}//getNotificacao
	
		
	
	/* notificacaoCriarEvento
	Funcao utilizada para criar eventos na notificação
	*/
	static function notificacaoCriarEvento($rm,$departamento_id,$user,$evento,$descricao,$timeline="",$timeline_id=""){
		$aCode = fGERAL::returnCode9($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/notificacao/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/eventos"; //caminho completo da pasta	
			if(file_exists($verPasta)){
				$url_buffer = $verPasta."/0";
				if(file_exists($url_buffer)){
					$arrFile = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($url_buffer),"get"),"dec");
					$cont_BF = ceil(count($arrFile));
					if($cont_BF >= "7"){
						$c_file = fGERAL::criaFileCont($verPasta,"retorno"); rename($url_buffer, $verPasta."/".$c_file); unset($arrFile);
						fBKP::bkpFile($verPasta."/".$c_file);//adiciona arquivo em lista de arquivo BACKUP
					}
				}
				//inicia criação do array de dados
				$array["evento"] = $evento; $array["descricao"] = $descricao; $array["departamento_id"] = $departamento_id; $array["user"] = $user;
				if($timeline != ""){ $array["timeline"] = $timeline; } if($timeline_id != ""){ $array["timeline_id"] = $timeline_id; }//verifica se adiciona itens de timeline
				//pega o nome do departamento
				$array["departamento"] = "";
				$resu = fSQL::SQL_SELECT_SIMPLES("code,nome", "sys_perfil_deptos", "id = '".$array["departamento_id"]."'", "");
				while($linha = fSQL::FETCH_ASSOC($resu)){
					$array["departamento"] = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($array["departamento_id"],$linha["code"])." ".$linha["nome"];
				}//fim while
				$array["time"] = time();
				$arrFile[] = $array;
				$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrFile,"enc"),"send");
				file_put_contents($verPasta."/0",$file_ret);
				fBKP::bkpFile($verPasta."/0");//adiciona arquivo em lista de arquivo BACKUP				
			}//if(file_exists($verPasta)){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return time();
	}//notificacaoCriarEvento
	
		
	
	/* notificacaoAcaoProcesso
	Funcao utilizada para adiciona ou remover noficicação de processo
	Obs: Pra remover enviar processo_rm = NULL
	*IMPORTANTE: Deve ser removido no processo... retorno de array */
	static function notificacaoAcaoProcesso($rm,$departamento_id,$user,$processo_rm){
		if($processo_rm == ""){ $processo_rm = "NULL"; }
		$arrRet["cont"] = "0";
		$aCode = fGERAL::returnCode9($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verDados = VAR_DIR_FILES."files/tabelas/notificacao/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/dados.fai"; //caminho completo	
			if(file_exists($verDados)){
				$arrNoti = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($verDados),"get"),"dec");
				if($arrNoti["situacao"] == "1"){ $SQL_tabela = "notificacao_executando"; }else{ $SQL_tabela = "notificacao_arquivo_".$aCode["ano"]; }	
				$processo_	= $arrNoti["processo_rm"];
				//atualiza dados da tabela no DB
				$campos = "processo_rm";
				$valores = array($processo_rm);//define status como duam em aberto
				if($arrNoti["depto_a"] != $departamento_id){//verifica se muda depto
					$arrNoti["depto_a"] = $departamento_id;
					$campos .= ",depto_a"; $valores[] = $departamento_id;
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Departamento Alterado","Notificação teve seu departamento alterado automaticamente em ação de processo.","depto",$departamento_id);
					if($arrNoti["user_id"] != "NULL"){
						fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Removido Responsável", "Responsabilidade da notificação volta ao departamento. Removido automaticamente com o processo.","resp",$arrNoti["user_id"]);
						$arrNoti["user_id"] = "NULL";
						$campos .= ",user_id"; $valores[] = "NULL";
					}
				}//muda depto
				fSQL::SQL_UPDATE_SIMPLES($campos, $SQL_tabela, $valores, "id = '".$arrNoti["id"]."'");
				//inicia atualização de arquivo de dados
			 	$arrNoti["processo_rm"] = $processo_rm;
				$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrNoti,"enc"),"send");
				file_put_contents($verDados,$file_ret);
				fBKP::bkpFile($verDados);//adiciona arquivo em lista de arquivo BACKUP	
				//eventos
				if($processo_rm == "NULL"){ 
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Removido de Processo","Notificação foi removida do processo ".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode7($processo_).", agora permanece sem processo.","processo",$processo_);
				}else{
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Adicionado em Processo","Notificação foi adicionada do processo ".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode7($processo_rm).", agora permanece em processo.","processo",$processo_rm);
				}
				//monta retorno
				$arrRet["cont"] = "1";
				$arrRet["rm"] = $rm;
				$arrRet["tipo_id"] = $arrNoti["tipo_id"];
				$arrRet["duam_ano"] = $arrNoti["duam_ano"];
				$arrRet["duam_mes"] = $arrNoti["duam_mes"];
				$arrRet["duam_dia"] = $arrNoti["duam_dia"];
				$arrRet["duam_cont"] = $arrNoti["duam_cont"];
				$arrRet["duam_code"] = $arrNoti["duam_code"];
				$arrRet["status"] = $arrNoti["status"];			
				$arrRet["processo_rm"] = $arrNoti["processo_rm"];					
			}//if(file_exists($verDados)){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $arrRet;
	}//notificacaoAcaoProcesso
	
		
	
	/* notificacaoAcaoProcessoTramite
	Funcao utilizada para verifica a noficicação em tramitação de processo
	Obs: Verifica se muda os dados de perfil, depto, user
	*IMPORTANTE: Deve ser ser aplicado na lista de notificações durante o tramite do processo */
	static function notificacaoAcaoProcessoTramite($rm,$perfil_id,$departamento_id,$user_id,$user){
		if($user_id == ""){ $user_id = "NULL"; }
		$contRet = "0";
		$aCode = fGERAL::returnCode9($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verDados = VAR_DIR_FILES."files/tabelas/notificacao/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/dados.fai"; //caminho completo	
			if(file_exists($verDados)){
				$arrNoti = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($verDados),"get"),"dec");
				if($arrNoti["situacao"] == "1"){ $SQL_tabela = "notificacao_executando"; }else{ $SQL_tabela = "notificacao_arquivo_".$aCode["ano"]; }	
				//atualiza dados da tabela no DB
				if(($arrNoti["perfil_a"] != $perfil_id) or ($arrNoti["depto_a"] != $departamento_id)){//verifica se muda depto
					$arrNoti["perfil_a"] = $perfil_id;
					$arrNoti["depto_a"] = $departamento_id;
					$campos = "perfil_a,depto_a";
					$valores = array($perfil_id,$departamento_id);
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Departamento Alterado","Notificação teve seu departamento alterado automaticamente em ação de processo.","depto",$departamento_id);
					if($arrNoti["user_id"] != $user_id){
						fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Atualizado Responsável", "Responsabilidade da notificação foi alterada. Automaticamente com o processo.","resp",$arrNoti["user_id"]);
						$arrNoti["user_id"] = $user_id;
						$campos .= ",user_id"; $valores[] = $user_id;
					}
					fSQL::SQL_UPDATE_SIMPLES($campos, $SQL_tabela, $valores, "id = '".$arrNoti["id"]."'");
					//inicia atualização de arquivo de dados
					$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrNoti,"enc"),"send");
					file_put_contents($verDados,$file_ret);
					fBKP::bkpFile($verDados);//adiciona arquivo em lista de arquivo BACKUP	
					//monta retorno
					$contRet++;	
				}//muda depto			
			}//if(file_exists($verDados)){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $contRet;
	}//notificacaoAcaoProcessoTramite
	
	
		
		
	
	/* notificacaoLegTorpedo
	Funcao utilizada para enviar legenda de mensagem de torpedos na notificação
	*/
	static function notificacaoLegTorpedo($nome,$mensagem,$rm){
		//PROCESSA DADOS DE RETORNO
		$cnt = "0";
		$cnt++; $arrInfo[$cnt] = "Olha ".$nome.", Sua notificação Número ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nGerou a mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Eu tenho uma informação de sua notificação ".$nome.", Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nMensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Opa ".$nome.", Nº ".SYS_CONFIG_RM_SIGLA." ".$rm." de uma notificação, me pediu pra te entregar essa mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = $nome.", Sua notificação Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nTem a seguinte mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Tenho uma mensagem para você ".$nome.", a notificação Nº ".SYS_CONFIG_RM_SIGLA." ".$rm.": \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "A notificação Número ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nTem a seguinte mensagem: \n<u>".$mensagem."</u> \nÉ pra você ".$nome."!";
		$cnt++; $arrInfo[$cnt] = "<u>".$mensagem."</u> \n\nVeio da notificação Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."! OK, ".$nome."... ";
		$cnt++; $arrInfo[$cnt] = $nome.", Tenho mais uma mensagem: \n<u>".$mensagem."</u> \nEla veio da notificação Nº ".SYS_CONFIG_RM_SIGLA." ".$rm."!";
		$cnt++; $arrInfo[$cnt] = $nome.", Notificação Número ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nPreciso te entregar a seguinte mensagem: \n<u>".$mensagem."</u>";
		$info = $arrInfo[rand(1,$cnt)];
		return $info;
	}//notificacaoLegTorpedo
	
	
		
		
	
	/* notificacaoLegTorpedoChaveweb
	Funcao utilizada para enviar legenda de mensagem de torpedos na notificação para envio de chave web
	*/
	static function notificacaoLegTorpedoChaveweb($nome,$rm,$chaveweb){
		//PROCESSA DADOS DE RETORNO
		$cnt = "0";
		$cnt++; $arrInfo[$cnt] = "Olha ".$nome.", para acessar sua notificação ".SYS_CONFIG_RM_SIGLA." ".$rm.", \nChave Web: \n<u>".$chaveweb."</u> Detalhes, acesse www.axlsolution.com.br/rni";
		$cnt++; $arrInfo[$cnt] = $nome.", notificação ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nChave web: \n<u>".$chaveweb."</u> Detalhes, acesse www.axlsolution.com.br/rni";
		$cnt++; $arrInfo[$cnt] = "Opa ".$nome.", da notificação ".SYS_CONFIG_RM_SIGLA." ".$rm.", tenho a Chave Web: \n<u>".$chaveweb."</u> Detalhes, acesse www.axlsolution.com.br/rm";
		$cnt++; $arrInfo[$cnt] = $nome.", para detalhes da notificação ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nacesse www.axlsolution.com.br/rni use Chave Web: \n<u>".$chaveweb."</u>";
		$cnt++; $arrInfo[$cnt] = "Acesse www.axlsolutionpublico.com.br/rm para detalhes da notificação aberta, Nº ".SYS_CONFIG_RM_SIGLA." ".$rm.": \nChave Web: <u>".$chaveweb."</u>";
		$cnt++; $arrInfo[$cnt] = "A notificação Número ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nChave Web: \n<u>".$chaveweb."</u> \nDetalhes, acesse www.axlsolution.com.br/rm";
		$cnt++; $arrInfo[$cnt] = $nome.", Tenho um acesso para sua notificação em www.axlsolution.com.br/rm Chave Web: \n<u>".$chaveweb."</u> \nNº ".SYS_CONFIG_RM_SIGLA." ".$rm."!";
		$cnt++; $arrInfo[$cnt] = $nome.", Importante você acessar www.axlsolution.com.br/rm e acompanhar a notificação ".SYS_CONFIG_RM_SIGLA." ".$rm."! \nChave Web: \n<u>".$chaveweb."</u>";
		$info = $arrInfo[rand(1,$cnt)];
		return $info;
	}//notificacaoLegTorpedoChaveweb
	
	
	
	
	
	
		
	
	/* notificacaoSendSMS
	Funcao utilizada para enviar SMS na notificação
	*/
	static function notificacaoSendSMS($rm,$departamento_id,$user,$mensagem,$acao_evento="1",$time_envio="0"){
		$aCode = fGERAL::returnCode9($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/notificacao/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]; //caminho completo da pasta
			if((!file_exists($verPasta."/SMSOFF")) and (file_exists($verPasta."/EXECUTANDO"))){
				//WHERE de dados SQL
				$SQL_where = " ( `ano` = '".$aCode["ano"]."' AND `mes` = '".$aCode["mes"]."' AND `dia` = '".$aCode["dia"]."' AND `cont` = '".$aCode["cont"]."' )"; //condição						
				//campos de consulta SQL
				$SQL_campos = "id,candidato_fisico_id"; //campo da tabela			
				//retorna linha de dados SQL
				$linha = fSQL::SQL_SELECT_ONE($SQL_campos, "notificacao_executando", $SQL_where);
				//adiciona e ajusta dados adicionais a consulta SQL
				$code_RM = fGERAL::legCode9($rm);	
				//busca dados do candidato
				$fisico_id = $linha["candidato_fisico_id"];
				//campos de consulta SQL
				$SQL_campos = "CF.nome AS fis_nome, CF.cpf, CF.datan, CF.sexo"; //campo da tabela
				$SQL_campos .= ",C.celular"; //campo da tabela				
				//JOIN de dados SQL
				$SQL_join = "LEFT JOIN cad_candidato_fisico_celular C ON CF.id = C.candidato_fisico_id"; //join
				//WHERE de dados SQL
				$SQL_where = "CF.id = '$fisico_id' AND C.principal = '1'"; //condição			
				//retorna linha de dados SQL
				$linha2 = fSQL::SQL_SELECT_ONE($SQL_campos,"cad_candidato_fisico CF", $SQL_where, "GROUP BY CF.id", $SQL_join);				
				//dados de envio de SMS/TORPEDOS
				$nome_res = maiusculo(primeiro_nome($linha2["fis_nome"],"1","11"));
				$texto_torpedo = fRM::notificacaoLegTorpedo($nome_res,$mensagem,$code_RM);
				$texto_torpedo .= "\n:)\nCaso precise que eu fale mais dessa notificação, me responde: <b>FALE MAIS ou SIM</b>";
				$parametros = "[MAIS]".fGERAL::limpaCode($rm);
				$texto_sms = $nome_res.", Notificação ".SYS_CONFIG_RM_SIGLA." ".$code_RM." > ".$mensagem;
				//classe de envio de TORPEDOS (mensagens,SMS)
				$classTORPEDO = new fTORPEDOS(VAR_DIR_RAIZ."sys/");
				$classTORPEDO->updatePessoa($linha2["fis_nome"],$linha2["cpf"],$linha2["datan"],$linha2["sexo"]);
				$smsRet = $classTORPEDO->sendTorpedo($linha2["cpf"],$linha2["celular"],$texto_sms,$texto_torpedo,$parametros);
				if($acao_evento == "1"){
					//atualiza contagem SMS
					$condicao = "id='".$linha["id"]."'";
					fSQL::SQL_UPDATE_OPERACAO("sms_cont", "notificacao_executando", array("1"), $condicao, array("+"));
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Envio de TORPEDO", "Foi enviado um TORPEDO(mensagem) para: <br>Número: ".$linha2["celular"]." em ".date('d/m/Y H:i')."h <br>Com a mensagem: <b>".$texto_sms."</b>","sms",$linha2["celular"]);
				}//if($acao_evento == "1"){	
			}//if((!file_exists($verPasta."/SMSOFF")) and (file_exists($verPasta."/EXECUTANDO"))){
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
	}//notificacaoSendSMS
	
	
	
	/* notificacaoTramite
	Funcao utilizada para retornar a notificação de RM
	*/
	static function notificacaoTramite($rm,$departamento_id,$user,$numero_guia,$acao,$receptor_id="",$vai_volta="0"){
		//verifica se recebeu código já abre a notificação
		$aCode = fGERAL::returnCode9($rm);
		$notiPasta = VAR_DIR_FILES."files/tabelas/notificacao/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"];
		if(file_exists($notiPasta."/dados.fai")){
			$arrNoti = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($notiPasta."/dados.fai"),"get"),"dec");
			//pega o nome do departamento
			$resuM = fSQL::SQL_SELECT_SIMPLES("code,perfil_id,nome", "sys_perfil_deptos", "id = '".$departamento_id."'", "");
			while($linha = fSQL::FETCH_ASSOC($resuM)){
				$depto_perfil_d = $linha["perfil_id"];
				$depto_nome_d = $linha["nome"]."( ".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($departamento_id,$linha["code"])." )";
			}//fim while
			//campos para mapa
			$extra_campo = ",T.mapa_tramitacao AS tipo_tramitacao";
			$extra_where = " AND P.tipo_id = T.id";
			$extra_tabela = ", adm_notificacao_tipo T";
			$extra_tipo_tramitacao = "";
			$tipo_tramitacao_novo = "";//variavel que identifica alteração em mapa tramitação - vai e volta
			//verifica se já foi alterado o mapa
			if(isset($arrNoti["tipo_tramitacao"])){
				$extra_tipo_tramitacao = $arrNoti["tipo_tramitacao"];
				$extra_campo = ""; $extra_where = ""; $extra_tabela = "";
			}//if(isset($arrNoti["tipo_tramitacao"])){
			//verifica registro ativo da notificação
			$campos = "P.id,P.depto_a,P.mapa_tramitacao_id,P.mapa_tramitacao,P.status,D.code,D.perfil_id,D.nome".$extra_campo; //campos da tabela
			$where .= " P.`id` = '".$arrNoti["id"]."' AND P.depto_a = D.id".$extra_where; //condição
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, "notificacao_executando P, sys_perfil_deptos D".$extra_tabela, $where, "GROUP BY P.id");
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$id = $linha1["id"];
				$depto_a = $linha1["depto_a"]; $depto_a_ = $depto_a;
				$mapa_tramitacao_id = $linha1["mapa_tramitacao_id"];
				$mapa_tramitacao = arrayDB($linha1["mapa_tramitacao"]);
				$depto_rm = fGERAL::legCode($depto_a,$linha1["code"]);
				$perfil_id = $linha1["perfil_id"]; $perfil_id_ = $perfil_id;
				$depto_nome = $linha1["nome"];
				if($extra_tabela != ""){
					$tipo_tramitacao = arrayDB($linha1["tipo_tramitacao"]);
				}else{//if($extra_tabela != ""){
					$tipo_tramitacao = arrayDB($extra_tipo_tramitacao); if($tipo_tramitacao == "VAZIO"){ $tipo_tramitacao = ""; }
				}//else{//if($extra_tabela != ""){
				$status_atual = $linha1["status"];
				$status_n = "";
				//AÇÕES DO TRÂMITE DE NOTIFICAÇÕES
				if($acao == "tramite"){
					$status_n = "4";//EM TRAMITAÇÃO
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Envio de Notificação", "Notificação enviada de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." através da Guia de Tramitação Nº ".$numero_guia,"tramite",$numero_guia);
					fRM::notificacaoSendSMS($rm,$departamento_id,$user,"Aguarde, sua notificação está em tramitação para ".$depto_nome_d);
				}//if($acao == "tramite"){
				if($acao == "recebido"){
					$status_n = "1";//ATIVO
					$depto_a = $departamento_id;
					$perfil_id = $depto_perfil_d;
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Retirada de Notificação", "Notificação movida de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." através da Guia de Tramitação Nº ".$numero_guia,"tra_recebido",$numero_guia);
					//atualiza o mapa de tramitação ...............................................................................................>>>>
					$seguindo_mapa = "0"; $marca_mapa = ".0.";
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//monta array
						$mapa_tramitacao_arr = explode(",",$mapa_tramitacao);//cria o array
					}
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						//inicia verificação caso já exista uma tramitação
						$tipo_tramitacao_arr = explode(",",$tipo_tramitacao);
						$busca_primeiro = "1";
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
							//monta array
							$array = array_reverse($mapa_tramitacao_arr);//reverte o array para leitura 
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor == ".F."){ $marca_mapa = ".F.";$busca_primeiro = "0"; $seguindo_mapa = "0"; break; }
									$arrSb = explode("-", $valor);
									if($arrSb["0"] >= "1"){//verifica o ultimo elemento que seguiu o mapa	
										$cont_ = "0";
										//monta array
										$arrayS = $tipo_tramitacao_arr;
										$cont_ARRAYS = ceil(count($arrayS));
										if($cont_ARRAYS >= "1"){
											foreach ($arrayS as $posS => $valorS){
												$arrSS = explode("-", $valorS);
												if($cont_ == "1"){//adiciona o item
													$marca_mapa = ".F.";
													if($arrSS["2"] == $depto_a){ $seguindo_mapa = $arrSS["0"];  }
												}//if($cont_ == "1"){
												if($cont_ == "2"){//adiciona o proximo item
													$busca_primeiro = "0";
													$marca_mapa = ".".$arrSS["2"].".";
												}//if($cont_ == "2"){
												if(($arrSS["0"] == $arrSb["0"]) or ($cont_ >= "1")){ $cont_++; }//verifica se a contagem é igual - pega o proximo item no laço
												if($cont_ >= "3"){ break; }//para laço
											}//fim foreach
											if($cont_ == "2"){ $marca_mapa = ".F."; $busca_primeiro = "0"; }//nao tem proximo, define como fim
										}//fim if($cont_ARRAYS >= "1"){
										break;				
									}//if($arrSb["0"] >= "1"){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
						}//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//busca primeiro do mapa
						if($busca_primeiro == "1"){
							//monta array
							$array = explode(",",$tipo_tramitacao);
							$arrSb = explode("-", $array["0"]);//primeiro item do array
							$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							if($arrSb["2"] == $depto_a){ $seguindo_mapa = $arrSb["0"]; }//verifica se cumpriu mapa
							//pega proximo depto
							if(isset($array["1"])){
								if($seguindo_mapa >= "1"){
									$arrSb = explode("-", $array["1"]);//primeiro item do array
								}else{
									$arrSb = explode("-", $array["0"]);//primeiro item do array
								}
								$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							}else{
								$marca_mapa = ".F.";//pega o próximo depto a enviar
							}
						}//if($busca_primeiro == "1"){		
						//verifica se chegou ao fim do mapa
						if($seguindo_mapa >= "1"){
							$mapa_tramitacao_id = $depto_a;
						}else{//if($seguindo_mapa >= "1"){
							if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
								$mapa_tramitacao_arr__ = $mapa_tramitacao_arr;
								$marca_mapa = array_pop($mapa_tramitacao_arr__);//pega ultimo item
							}
						}//else{//if($seguindo_mapa >= "1"){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
											
					//atualiza string do mapa
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
						array_pop($mapa_tramitacao_arr);//remove ultimo item
						$mapa_tramitacao = implode(",",$mapa_tramitacao_arr);
						$mapa_tramitacao .= ",";
					}else{ $mapa_tramitacao = ""; }//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
					//verifica se tem vai e volta e mapa para definir...........................................................................
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						if(($vai_volta == "1") and ($seguindo_mapa == "0")){
							//pega dados de mapa se já existente
							unset($vDepto);
							//monta array de dados
							$array = $mapa_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach($array as $pos => $valor){
									if($valor != ""){
										$arrSb = explode("-", $valor);
										if($arrSb["2"] >= "1"){						
											$arrSb = explode("-", $valor);
											if($arrSb["0"] >= "1"){				
												if(isset($vDepto[$arrSb["2"]])){ $vDepto[$arrSb["2"]] = $vDepto[$arrSb["2"]]+1; }else{ $vDepto[$arrSb["2"]] = "1"; }
											}//$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
										}//if($arrSb["2"] >= "1"){
									}//if($valor != ""){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
							//inicia o processo de verificação do mapa e inclusão de novo depto
							$cont_ID = "0"; $cont_list = "0";//cont de controle do laço
							//monta array
							$array = $tipo_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							//listar item ja cadastrados
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor != ""){
										$arrSub = explode("-", $valor);//[,ORDEM-PERFIL_ID-DEPTO_ID,]
										$cont_list++;
										//verifica se já tramitou
										if(isset($vDepto[$arrSub["2"]])){
											//JA PASSOU NO MAPA
											$vDepto[$arrSub["2"]] = $vDepto[$arrSub["2"]]-1;//retira da contagem
											if($vDepto[$arrSub["2"]] <= "0"){ unset($vDepto[$arrSub["2"]]); }//se zerou a contagem, remove da variavel
										}else{//if(isset($vDepto[$arrSub["2"]])){
											$cont_ID++;//incrementa controle de ids do sort
											if($cont_ID == "1"){
												if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;

												$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
												$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
												$cont_list++;
											}
										}//else{//if(isset($vDepto[$arrSub["2"]])){
										if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$arrSub["1"]."-".$arrSub["2"];
									}//if($valor != ""){
								}//fim foreach
								///se no laço nao localizou, coloca no fim do mapa
								if($cont_ID == "0"){
									$cont_list++;
									if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;
									$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
									$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
								}//if($cont_ID == "0"){
							}//fim if($cont_ARRAY >= "1"){	
						}//if(($vai_volta == "1") and ($seguindo_mapa == "0")){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
					$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
					//atualiza o mapa de tramitação ...............................................................................................<<<<
				}//if($acao == "recebido"){
				if($acao == "cancelado"){
					$status_n = "1";//ATIVO
					fRM::notificacaoCriarEvento($rm,$departamento_id,$user,"Retorno de Notificação", "Notificação devolvida de ".$depto_nome_d." para ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) através da Guia de Tramitação Nº ".$numero_guia,"tra_cancelado",$numero_guia);
				}//if($acao == "cancelado"){
				//APLICA STATUS DA AÇÃO
				if($status_n != ""){
					if($status_n == "4"){//se é tramitação, guarda o status
						$arrNoti["status_tramite"] = $status_atual;//guarda o status em um buffer
					}else{//if($status_n == "4"){
						$status_n = $arrNoti["status_tramite"];
						unset($arrNoti["status_tramite"]);//remove do array o buffer de status
					}//else{//if($status_n == "4"){
					$arrNoti["status"] = $status_n;
					
					//faz o ajuste de dados na tabela ---------------------------------------
					$campos = "status";
					$valores = array($arrNoti["status"]);//define status como duam em aberto
					if($acao == "recebido"){//só atualiza sync se a tramiração ocorreu
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){ $mapa_tramitacao = "[,".$mapa_tramitacao.",]"; }
						if($mapa_tramitacao_id == ""){ $mapa_tramitacao_id = 'NULL'; }
						//verifica se tem recepator e define responsável
						$user_sel = 'NULL';	$receptor_idd = (int)$receptor_id; if($receptor_idd >= "1"){ $user_sel = $receptor_idd; }
						$arrNoti["perfil_a"] = $perfil_id;
						$arrNoti["depto_a"] = $depto_a;
						$arrNoti["mapa_tramitacao_id"] = $mapa_tramitacao_id;
						$arrNoti["mapa_tramitacao"] = $mapa_tramitacao;
						$arrNoti["user_id"] = $user_sel;
						$arrNoti["user_a"] = $user;
						$arrNoti["sync"] = time();
						$campos .= ",perfil_a"; $valores[] = $arrNoti["perfil_a"];
						$campos .= ",depto_a"; $valores[] = $arrNoti["depto_a"];
						$campos .= ",mapa_tramitacao_id"; $valores[] = $arrNoti["mapa_tramitacao_id"];
						$campos .= ",mapa_tramitacao"; $valores[] = $arrNoti["mapa_tramitacao"];
						$campos .= ",user_id"; $valores[] = $arrNoti["user_id"];
						$campos .= ",user_a"; $valores[] = $arrNoti["user_a"];
						$campos .= ",sync"; $valores[] = $arrNoti["sync"];
						//verifica se muda mapa de tramitação
						if($tipo_tramitacao_novo != ""){
							$tipo_tramitacao_novo = "[,".$tipo_tramitacao_novo.",]";
							$arrNoti["tipo_tramitacao"] = $tipo_tramitacao_novo;
							$arrNoti["tipo_tramitacao_user"] = "VAI E VOLTA NO TRÂMITE";
						}//if($tipo_tramitacao_novo != ""){
					}//if($acao == "recebido"){
					fSQL::SQL_UPDATE_SIMPLES($campos, "notificacao_executando", $valores, "id = '".$arrNoti["id"]."'");
					$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrNoti,"enc"),"send");
					file_put_contents($notiPasta."/dados.fai",$file_ret);
					fBKP::bkpFile($notiPasta."/dados.fai");//adiciona arquivo em lista de arquivo BACKUP	
				}//if($status_n != ""){
			}//fim do while			
		}//if(file_exists($apensarPasta."/dados.fai")){
		return $arrRet;
	}//notificacaoTramite
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NA NOTIFICAÇÃO PPPPPPPPPPPPPPPPPPPPPP<<<
	
	





}//class fRM { //***************************************************************************************************************@
	
	
	
	
	
	
	



	
	
	
	
	
	

























//classe para gestao de funções de multi-gestão
class fMultiGestao{ //***************************************************************************************************************@
	
	
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NO PROTOCOLO PPPPPPPPPPPPPPPPPPPPPP>>>
	//CLASSE PARA INICIAR DADOS DE PROTOCOLO MULTI-GESTÃO
	static function classMultiGestaoProtocolo($multigestao_id="",$id_a="",$user="",$depto="",$caminhoScript="../"){
		//verifica se recebeu código já abre o protocolo
		if(($multigestao_id != "") and ($id_a != "") and ($user != "") and ($depto != "")){
			$aCode = fGERAL::returnCode7($id_a);
			if($aCode["ano"] != ""){ $cont_encontrou = "1"; }else{ $cont_encontrou = "0"; }
		}				
		include $caminhoScript."class/multigestao.php";//classes de conexao
		if(class_exists('classMultiGestaoProtocolo')){	
			//INICIAR CLASSE --->>> PROTOCOLO
			$class_protocolo = new classMultiGestaoProtocolo;//inicia a classe
		}//class_exists
		
		if($cont_encontrou == "1"){		
			//CLASSE #######=> seta os dados de controle para manipulação
			$RET["encontrou"] = $class_protocolo->setIds($multigestao_id,$aCode["ano"],$aCode["mes"],$aCode["dia"],$aCode["cont"],$user,$depto);//setIds($ano,$mes,$dia,$cont,$user,$depto)
		}else{ $RET["encontrou"] = "0"; }
		//dados de retorno
		$RET["protocolo"] = $class_protocolo;
		return $RET;
	}//classMultiGestaoProtocolo


	/*getProtocolo
	Funcao utilizada para retornar o protocolo de RM
	*/
	static function getProtocolo($rm,$acao=""){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			$verPasta = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]; //caminho completo da pasta do protocolo
			if(file_exists($verPasta."/EXECUTANDO")){ $tabela = "protocolo_executando"; }else{ $tabela = "protocolo_arquivo_".$aCode["ano"]; }
			//verifica se a ação é mapa de tramitação
			$extra_campo = ""; $extra_tipo_tramitacao = "OFF";
			if($acao == "mapa_tramitacao"){
				//campos para mapa
				$extra_campo = ",T.mapa_tramitacao AS tipo_tramitacao";
				if(file_exists($verPasta."/dados.fai")){
					$arrProt = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($verPasta."/dados.fai"),"get"),"dec");
					//verifica se já foi alterado o mapa
					if(isset($arrProt["tipo_tramitacao"])){
						$extra_tipo_tramitacao = $arrProt["tipo_tramitacao"];
						if($extra_tipo_tramitacao == "VAZIO"){ $extra_tipo_tramitacao = ""; }
						$extra_campo = "";
					}//if(isset($arrProt["tipo_tramitacao"])){
				}//if(file_exists($protPasta."/dados.fai")){				
			}//if($acao == "mapa_tramitacao"){
			//dados sql	
			$campos = "P.code,P.ano,P.mes,P.dia,P.cont,P.mapa_tramitacao,P.paginas,P.time,P.status,T.nome AS tipo".$extra_campo.",CF.nome AS fis_nome,CF.cpf AS fis_doc,CJ.fantasia AS jur_nome,CJ.cnpj AS jur_doc"; //campos da tabela
			$where .= " ( P.`ano` = '".$aCode["ano"]."' AND P.`mes` = '".$aCode["mes"]."' AND P.`dia` = '".$aCode["dia"]."' AND P.`cont` = '".$aCode["cont"]."' ) AND P.tipo_id = T.id"; //condição
			$join = "INNER JOIN adm_protocolo_tipo T LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id LEFT JOIN cad_candidato_juridico CJ ON P.candidato_juridico_id = CJ.id"; //join
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela."_x_EDITAR P", $where, "GROUP BY P.id","", $join);
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$fis_nome = $linha1["fis_nome"];
				$fis_doc = $linha1["fis_doc"];
				$jur_nome = $linha1["jur_nome"];
				$jur_doc = $linha1["jur_doc"];
				//monta informações do requerente
				$requerente_leg = "Indefinido";
				if(($fis_nome != "") and ($fis_nome != NULL)){
					$requerente_leg = "<b>$fis_nome</b>,";
					$requerente_leg .= "<br>PESSOA FÍSICA - CPF. $fis_doc";
				}//if(($fis_nome != "") and ($fis_nome != NULL)){
				if(($jur_nome != "") and ($jur_nome != NULL)){
					$requerente_leg = "<b>$jur_nome</b>,";
					$requerente_leg .= "<br>PESSOA JURÍDICA";
					if(($jur_doc != "") and ($jur_doc != NULL)){ $requerente_leg .= " - CNPJ. $jur_doc"; }
				}//if(($jur_nome != "") and ($jur_nome != NULL)){
				$linha1["requerente"] = $requerente_leg;
				//verifica mapa tramitação
				if($acao == "mapa_tramitacao"){
					if($extra_tipo_tramitacao != "OFF"){
						$linha1["tipo_tramitacao"] = $extra_tipo_tramitacao;
					}
				}//if($acao == "mapa_tramitacao"){
				//alimenta linha de retorno
				$arrRet = $linha1;
			}//fim do while 
			
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return $arrRet;
	}//getProtocolo
	
	
	
	
	
	/* iniciaConexaofWS
	Funcao utilizada para criar conexão com multi-gestão
	*/
	function iniciaConexaofWS($multigestao_id,$caminhoScript="../"){
		if($multigestao_id >= "1"){
			if(!defined('clientefWS')){
				include $caminhoScript."sys/class/class.clientefWS.php";//classes de conexao
			}
			$ClientefWS = NULL; $cont = "0";
			//pega informações da multi-gestão
			$resu1 = fSQL::SQL_SELECT_SIMPLES("multi_url,multi_fws_id,multi_login,multi_senha,multi_chave", "sys_webservice_multigestao", "id = '".$multigestao_id."'", "");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$multi_url = $linha1["multi_url"];
				$multi_fws_id = $linha1["multi_fws_id"];
				$multi_login = $linha1["multi_login"];
				$multi_senha = $linha1["multi_senha"];
				$multi_chave = $linha1["multi_chave"];
				$cont++;
			}//fim while
			if($cont >= "1"){
				//APLICA A CLASSE DE CONEXÃO COM O SERVIDOR fWS
				$ClientefWS = new clientefWS($multi_url);
				$ClientefWS->setFWS($multi_fws_id);
				$ClientefWS->setLogin($multi_login);
				$ClientefWS->setSenha($multi_senha);
				$ClientefWS->setCompressFiles("gz");//compactar (descomentar faz aplicar compactação nos arquivo BASE64 enviados e recebidos)
				//$this->ClientefWS->setCompressFiles("deflate");//compactar (descomentar faz aplicar compactação nos arquivo BASE64 enviados e recebidos)
				//$this->ClientefWS->setDebug(1);//imprimir a string que recebe sem descriptografar
				$ClientefWS->setChave($multi_chave);
				$tamanho_max_post = "30000000";//DEFINIR O TAMANHO MÁXIMO DO POST APÓS A APLICAÇÃO DE CRIPTOGRAFIA - BYTES
				$ClientefWS->setMaxPost($tamanho_max_post);
				//*CASO UTILIZE A COMPACTAÇÃO, SÓ APLIQUE UM DOS ITENS SELECIONADOS/DISPONÍVEIS ACIMA						
				/*/MÉTODO DE CONSULTA fWS
				$arrGetWS["numero1"] = 3;
				$arrGetWS["numero2"] = 2;
				$fWSret = $this->ClientefWS->getWS("somaNumeros",$arrGetWS);//CONSULTA fWS
				echo "somaNumeros:<pre>"; print_r($fWSret); echo "</pre>";	//*/	
			}//if($cont >= "1"){
			return $ClientefWS;
		}else{ return NULL; }//if($multigestao_id >= "1"){
	}//iniciaConexaofWS
		
		
		
	
	
	//cria ação de sincronismo de processo com a multi-gestão
	function protocoloCriarAcaoSync($multigestao_id,$rm,$tipo,$acao,$acao_id,$time="0"){
		if($time >= "1"){}else{ $time = time(); }//se não recebeu um time, cria um
		//validações
		$valida = "1";
		if($acao == ""){ $valida = "0"; }//valida tipo de ação a aplicar
		if($acao_id == ""){ $valida = "0"; }//valida se tem um id da aplicação de ação
		if($multigestao_id >= "1"){}else{ $valida = "0"; }//valida id de multi-gestão
		if($multigestao_id == ""){ $valida = "0"; }//valida
		if($rm == ""){ $valida = "0"; }//valida se tem rm
		if($valida == "1"){
			//VARS insert simples SQL
			$tabela = "multi_protocolo_sync";
			$campos = "multigestao_id,rm,tipo,acao,acao_id,erro,time";
			$valores = array($multigestao_id,$rm,$tipo,$acao,$acao_id,"0",$time);
			fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		}//if($valida == "1"){
		return $valida;
	}//protocoloCriarAcaoSync
		
		
		
	
	/* protocoloCriarEvento
	Funcao utilizada para criar eventos no protocolo
	*/
	static function protocoloCriarEvento($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,$evento,$descricao,$timeline="",$timeline_id=""){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
			//inicia criação vars de dados
			$array["evento"] = $evento; $array["descricao"] = $descricao; $array["departamento_id"] = $departamento_id; $array["user"] = $user;
			if($timeline != ""){ $array["timeline"] = $timeline; } if($timeline_id != ""){ $array["timeline_id"] = $timeline_id; }//verifica se adiciona itens de timeline
			if($tramite_acao == "1"){
				$verPasta = VAR_DIR_FILES."files/tabelas/multi_protocolo/".$multigestao_id."/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/eventos";
				$array["gestao"] = SYS_CLIENTE_NOME;
				//pega o nome do departamento
				$array["departamento"] = "";
				$resu = fSQL::SQL_SELECT_SIMPLES("D.code,D.nome,P.nome AS depto_perfil", "sys_perfil_deptos D, sys_perfil P", "D.id = '".$array["departamento_id"]."' AND D.perfil_id = P.id","GROUP BY P.id");
				while($linha = fSQL::FETCH_ASSOC($resu)){
					$array["departamento"] = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($array["departamento_id"],$linha["code"])." ".$linha["nome"];
					$array["depto_perfil"] = $linha["depto_perfil"];
					$array["departamento_id"] = "0";
				}//fim while
				if(file_exists($verPasta)){
					$url_buffer = $verPasta."/0";
					$sync_update = "";//var de controle para arquivo atualizado para sync
					if(file_exists($url_buffer)){
						$arrFile = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($url_buffer),"get"),"dec");
						$cont_BF = ceil(count($arrFile));
						if($cont_BF >= "7"){
							$c_file = fGERAL::criaFileCont($verPasta,"retorno"); rename($url_buffer, $verPasta."/".$c_file); unset($arrFile);
							fBKP::bkpFile($verPasta."/".$c_file);//adiciona arquivo em lista de arquivo BACKUP
							$sync_update = $c_file;//informar arquivo atualizado para o sync
						}
					}
					//inicia criação do array de dados
					$array["time"] = time();				
					//inicia SYNC para Multi-Gestão +++++++++++++++++++++++++++++++>>>
					$rSync = fMultiGestao::protocoloCriarAcaoSync($multigestao_id,$rm,"eventos","update","0",$array["time"]);//protocoloCriarAcaoSync()
					if($sync_update != ""){ $rSync = fMultiGestao::protocoloCriarAcaoSync($multigestao_id,$rm,"eventos","insert",$sync_update,$array["time"]); }//se adicionou arquivo
					//inicia SYNC para Multi-Gestão +++++++++++++++++++++++++++++++<<<				
					//grava evento aqui				
					$arrFile[] = $array;
					$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrFile,"enc"),"send");
					file_put_contents($verPasta."/0",$file_ret);
					fBKP::bkpFile($verPasta."/0");//adiciona arquivo em lista de arquivo BACKUP				
				}//if(file_exists($verPasta)){
			}//1.DEVOLVER A MULTI-GESTÃO	
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		return time();
	}//protocoloCriarEvento
	
	
	
	
	
	
	
	
		
	
	/* protocoloSendSMS
	Funcao utilizada para enviar legenda de mensagem de torpedos no protocolo
	*/
	static function protocoloLegTorpedo($nome,$mensagem,$rm,$rm_sigla){
		//PROCESSA DADOS DE RETORNO
		$cnt = "0";
		$cnt++; $arrInfo[$cnt] = "Olha ".$nome.", Seu processo Número ".$rm_sigla." ".$rm."! \nGerou a mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Eu tenho uma informação de seu processo ".$nome.", Nº ".$rm_sigla." ".$rm."! \nMensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Opa ".$nome.", Nº ".$rm_sigla." ".$rm." de um processo, me pediu pra te entregar essa mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = $nome.", Seu processo Nº ".$rm_sigla." ".$rm."! \nTem a seguinte mensagem: \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "Tenho uma mensagem para você ".$nome.", o processo Nº ".$rm_sigla." ".$rm.": \n<u>".$mensagem."</u>";
		$cnt++; $arrInfo[$cnt] = "O processo Número ".$rm_sigla." ".$rm."! \nTem a seguinte mensagem: \n<u>".$mensagem."</u> \nÉ pra você ".$nome."!";
		$cnt++; $arrInfo[$cnt] = "<u>".$mensagem."</u> \n\nVeio do processo Nº ".$rm_sigla." ".$rm."! OK, ".$nome."... ";
		$cnt++; $arrInfo[$cnt] = $nome.", Tenho mais uma mensagem: \n<u>".$mensagem."</u> \nEla veio do processo Nº ".$rm_sigla." ".$rm."!";
		$cnt++; $arrInfo[$cnt] = $nome.", Processo Número ".$rm_sigla." ".$rm."! \nPreciso te entregar a seguinte mensagem: \n<u>".$mensagem."</u>";
		$info = $arrInfo[rand(1,$cnt)];
		return $info;
	}//protocoloLegTorpedo
	
	
	
	
	
	
		
	
	/* protocoloSendSMS
	Funcao utilizada para enviar SMS no protocolo
	*/
	static function protocoloSendSMS($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,$mensagem,$acao_evento="1",$time_envio="0"){
		$aCode = fGERAL::returnCode7($rm);
		if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){	
			if($tramite_acao == "1"){
				$verPasta = VAR_DIR_FILES."files/tabelas/multi_protocolo/".$multigestao_id."/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"];
				if((!file_exists($verPasta."/SMSOFF")) and (file_exists($verPasta."/EXECUTANDO"))){				
					//VARS insert simples SQL
					$tabela = "multi_protocolo_torpedo";
					$campos = "multigestao_id,rm,mensagem,acao_evento,time_envio,erro,time";
					$valores = array($multigestao_id,fGERAL::limpaCode($rm),$mensagem,$acao_evento,$time_envio,"0",$time);
					fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
					if($acao_evento == "1"){
						$arrProt = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($verPasta."/dados.fai"),"get"),"dec");
						//atualiza contagem SMS
						$condicao = "id='".$arrProt["id"]."'";
						fSQL::SQL_UPDATE_OPERACAO("sms_cont", "multi_protocolo_executando", array("1"), $condicao, array("+"));
						fMultiGestao::protocoloCriarEvento($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,"Envio de TORPEDO", "Foi enviado um TORPEDO(mensagem) para: <br>Número: ".$linha2["celular"]." em ".date('d/m/Y H:i')."h <br>Com a mensagem: <b>".$texto_sms."</b>","sms",$linha2["celular"]);
					}//if($acao_evento == "1"){	
				}//if((!file_exists($verPasta."/SMSOFF")) and (file_exists($verPasta."/EXECUTANDO"))){
			}//1.DEVOLVER A MULTI-GESTÃO
		}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
	}//protocoloSendSMS
	
	
	
	/* protocoloTramiteExterno
	Funcao utilizada para retornar o protocolo de RM
	*/
	static function protocoloTramiteExterno($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,$numero_guia,$acao,$receptor_id="",$vai_volta="0"){
		//verifica se recebeu código já abre o protocolo
		$aCode = fGERAL::returnCode7($rm);		
		if($tramite_acao == "2"){
			$tabela_prot = "multi_protocolo_executando";
			$protPasta = VAR_DIR_FILES."files/tabelas/multi_protocolo/".$multigestao_id."/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"];
		}//1.DEVOLVER A MULTI-GESTÃO	
		if($tramite_acao == "1"){			
			$tabela_prot = "protocolo_executando";
			$protPasta = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"];
		}//2.ENVIAR A MULTI-GESTÃO
		//pega o nome do departamento
		$resuM = fSQL::SQL_SELECT_SIMPLES("code,perfil_id,nome", "sys_multigestao_perfil_deptos", "multigestao_id = '".$multigestao_id."' AND id_externo = '".$departamento_id."'", "");
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$depto_perfil_d = $linha["perfil_id"];
			$depto_nome_d = $linha["nome"]."( RM/RE ".fGERAL::legCode($departamento_id,$linha["code"])." - MULTI-GESTÃO)";
		}//fim while
		//verifica se o processo já existe na base
		if(file_exists($protPasta."/dados.fai")){
			$arrProt = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($protPasta."/dados.fai"),"get"),"dec");
			//campos para mapa
			$mapa_editado = "0";
			$extra_tipo_tramitacao = "";
			//verifica se já foi alterado o mapa
			if(isset($arrProt["tipo_tramitacao"])){
				$mapa_editado = "1";
				$extra_tipo_tramitacao = $arrProt["tipo_tramitacao"];
			}//if(isset($arrProt["tipo_tramitacao"])){
			//verifica registro ativo do protocolo
			$campos = "id,depto_a,mapa_tramitacao_id,mapa_tramitacao"; //campos da tabela
			$where = " `id` = '".$arrProt["id"]."'"; //condição
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela_prot, $where, "");
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$id = $linha1["id"];
				$depto_a = $linha1["depto_a"]; $depto_a_ = $depto_a;
				$mapa_tramitacao_id = $linha1["mapa_tramitacao_id"];
				$mapa_tramitacao = arrayDB($linha1["mapa_tramitacao"]);
				//pega nome do depto
				if($tramite_acao == "1"){
					//pega o nome do departamento
					$resu = fSQL::SQL_SELECT_SIMPLES("code,nome,perfil_id", "sys_multigestao_perfil_deptos", "multigestao_id = '".$multigestao_id."' AND id_externo = '".$depto_a."'", "");
					while($linha = fSQL::FETCH_ASSOC($resu)){
						$depto_rm = "RM/RE ".fGERAL::legCode($depto_a,$linha["code"]);
						$depto_nome = $linha["nome"];
						$perfil_id = $linha["perfil_id"]; $perfil_id_ = $perfil_id;
					}//fim while
				}//1.DEVOLVER A MULTI-GESTÃO	
				if($tramite_acao == "2"){
					//pega o nome do departamento
					$resu = fSQL::SQL_SELECT_SIMPLES("code,nome,perfil_id", "sys_perfil_deptos", "id = '".$depto_a."'", "");
					while($linha = fSQL::FETCH_ASSOC($resu)){
						$depto_rm = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($depto_a,$linha["code"]);
						$depto_nome = $linha["nome"];
						$perfil_id = $linha["perfil_id"]; $perfil_id_ = $perfil_id;
					}//fim while
				}//2.ENVIAR A MULTI-GESTÃO					
				
				//informações do mapa de tramitação já percorrido
				if($mapa_editado == "0"){
					$tipo_tramitacao = arrayDB($linha1["tipo_tramitacao"]);
				}else{//if($extra_tabela != ""){
					$tipo_tramitacao = arrayDB($extra_tipo_tramitacao); if($tipo_tramitacao == "VAZIO"){ $tipo_tramitacao = ""; }
				}//else{//if($extra_tabela != ""){
				$status_n = "";
				//AÇÕES DO TRÂMITE DE PROTOCOLOS
				if($acao == "tramite"){
					$status_n = "14";//EM TRAMITAÇÃO MULTI-GESTÃO (AGUARDANDO RECEBIMENTO)
					$msg_evento =  "Processo enviado de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." através da Guia de Tramitação Nº ".$numero_guia;
					fMultiGestao::protocoloCriarEvento($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,"Envio de Processo", $msg_evento,"mg_tramite",$numero_guia);
					fMultiGestao::protocoloSendSMS($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,"Aguarde, seu processo está em tramitação para ".$depto_nome_d);
				}//if($acao == "tramite"){
					
					
				/*// zz receber guia
				if($acao == "recebido"){
					
					
					//INICIAR CLASSE --->>> MULTI-GESTÃO
					$CLASS["classMultiGestaoProtocoloAdd"] = new classMultiGestaoProtocoloAdd;//inicia a classe
					//CLASSE #######=> seta os dados de multi-gestão
					$encontrou = $CLASS["classMultiGestaoProtocoloAdd"]->setMultiGestao($multigestao_id);//setMultiGestao($multigestao_id)	
					if($encontrou == "1"){
					
					
										
							
						//DEFINIR VARS - fWS
						$arrGetWS["numero_guia"] = $numero_guia;
						$arrGetWS["rm"] = $rm;
						$arrGetWS["user"] = $user;
						//MÉTODO DE CONSULTA fWS
						$fWSret = $this->ClientefWS->getWS("getProtocoloRemessa",$arrGetWS);//CONSULTA fWS
						//echo "syncDados:<pre>"; print_r($fWSret); echo "</pre>";
						//verifica lista de dados recebidos
						if(isset($fWSret["valida"])){
							if($fWSret["valida"] == "1"){
								$this->ConexaoCont++;//identifica que houve conexão
								//verifica se recebeu protocolo
								if(isset($fWSret["dados"])){
									$acao = $fWSret["acao"];
									$dados = $fWSret["dados"];				
									if($acao == "1"){//informação vem da multigestão já trocada
										if(file_exists($protPasta."/dados.fai")){//verifica se o protocolo ja existe ou nao
										
										
										
										// zzz - fazer a verificação e receber processos que já vinheram aqui
											file_put_contents($protPasta."/COPIA_MULTIGESTAO",$this->Multigestao_id);
											fBKP::bkpFile($protPasta."/COPIA_MULTIGESTAO");//adiciona arquivo em lista de arquivo BACKUP							
										}else{//if(file_exists($apensarPasta."/dados.fai")){
											$this->setIds($dados["ano"],$dados["mes"],$dados["dia"],$dados["cont"],$user,$departamento_id);//seta vars de start
											$this->novoProtocoloMultigestao($dados,$perfil_id);//adiciona novo protocolo multi-gestão
										}//else{//if(file_exists($apensarPasta."/dados.fai")){	
									}//acao 1.DEVOLVER A MULTI-GESTÃO	
										
									if($acao == "2"){//informação vem da multigestão já trocada
									
									
									
									
										//zzz - receber o processo enviado a multi-gestão
										
										
										
									}//acao 2.ENVIAR A MULTI-GESTÃO	
									
									
									
								}//if(isset($fWSret["dados"])){	
							}//if($fWSret["valida"] == "1"){		
						}//if(isset($fWSret["valida"])){
					
					
					
					}//if($encontrou == "1"){
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					$status_n = "1";//ATIVO
					$depto_a = $departamento_id;
					$perfil_id = $depto_perfil_d;
					fRM::protocoloCriarEvento($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,"Recebimento de Processo", "Processo movido de ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) para ".$depto_nome_d." através da Guia de Tramitação Nº ".$numero_guia,"tra_recebido",$numero_guia);
					//verifica possíveis notificações no processo	
					$resu2 = fSQL::SQL_SELECT_SIMPLES("rm", "protocolo_executando_notificacao", "protocolo_id = '".$id."'", "", "200");
					while($linha2 = fSQL::FETCH_ASSOC($resu2)){
						fRM::notificacaoAcaoProcessoTramite($linha2["rm"],$perfil_id,$depto_a,$receptor_id,$user);						
					}//while
					
					//atualiza o mapa de tramitação ...............................................................................................>>>>
					$seguindo_mapa = "0"; $marca_mapa = ".0.";
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//monta array
						$mapa_tramitacao_arr = explode(",",$mapa_tramitacao);//cria o array
					}
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						$tipo_tramitacao_arr = explode(",",$tipo_tramitacao);
						//inicia verificação caso já exista uma tramitação
						$busca_primeiro = "1";
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
							//monta array
							$array = array_reverse($mapa_tramitacao_arr);//reverte o array para leitura 
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor == ".F."){ $marca_mapa = ".F.";$busca_primeiro = "0"; $seguindo_mapa = "0"; break; }
									$arrSb = explode("-", $valor);
									if($arrSb["0"] >= "1"){//verifica o ultimo elemento que seguiu o mapa	
										$cont_ = "0";
										//monta array
										$arrayS = $tipo_tramitacao_arr;
										$cont_ARRAYS = ceil(count($arrayS));
										if($cont_ARRAYS >= "1"){
											foreach ($arrayS as $posS => $valorS){
												$arrSS = explode("-", $valorS);
												if($cont_ == "1"){//adiciona o item
													$marca_mapa = ".F.";
													if($arrSS["2"] == $depto_a){ $seguindo_mapa = $arrSS["0"];  }
												}//if($cont_ == "1"){
												if($cont_ == "2"){//adiciona o proximo item
													$busca_primeiro = "0";
													$marca_mapa = ".".$arrSS["2"].".";
												}//if($cont_ == "2"){
												if(($arrSS["0"] == $arrSb["0"]) or ($cont_ >= "1")){ $cont_++; }//verifica se a contagem é igual - pega o proximo item no laço
												if($cont_ >= "3"){ break; }//para laço
											}//fim foreach
											if($cont_ == "2"){ $marca_mapa = ".F."; $busca_primeiro = "0"; }//nao tem proximo, define como fim
										}//fim if($cont_ARRAYS >= "1"){
										break;				
									}//if($arrSb["0"] >= "1"){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
						}//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){	
						//busca primeiro do mapa
						if($busca_primeiro == "1"){
							//monta array
							$array = explode(",",$tipo_tramitacao);
							$arrSb = explode("-", $array["0"]);//primeiro item do array
							$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							if($arrSb["2"] == $depto_a){ $seguindo_mapa = $arrSb["0"]; }//verifica se cumpriu mapa
							//pega proximo depto
							if(isset($array["1"])){
								if($seguindo_mapa >= "1"){
									$arrSb = explode("-", $array["1"]);//primeiro item do array
								}else{
									$arrSb = explode("-", $array["0"]);//primeiro item do array
								}
								$marca_mapa = ".".$arrSb["2"].".";//pega o próximo depto a enviar
							}else{
								$marca_mapa = ".F.";//pega o próximo depto a enviar
							}
						}//if($busca_primeiro == "1"){		
						//verifica se chegou ao fim do mapa
						if($seguindo_mapa >= "1"){
							$mapa_tramitacao_id = $depto_a;
						}else{//if($seguindo_mapa >= "1"){
							if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
								$mapa_tramitacao_arr__ = $mapa_tramitacao_arr;
								$marca_mapa = array_pop($mapa_tramitacao_arr__);//pega ultimo item
							}
						}//else{//if($seguindo_mapa >= "1"){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
											
					//atualiza string do mapa
					if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
						array_pop($mapa_tramitacao_arr);//remove ultimo item
						$mapa_tramitacao = implode(",",$mapa_tramitacao_arr);
						$mapa_tramitacao .= ",";
					}else{ $mapa_tramitacao = ""; }//if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){
					//verifica se tem vai e volta e mapa para definir...........................................................................
					if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
						if(($vai_volta == "1") and ($seguindo_mapa == "0")){
							//pega dados de mapa se já existente
							unset($vDepto);
							//monta array de dados
							$array = $mapa_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							if($cont_ARRAY >= "1"){
								foreach($array as $pos => $valor){
									if($valor != ""){
										$arrSb = explode("-", $valor);
										if($arrSb["2"] >= "1"){						
											$arrSb = explode("-", $valor);
											if($arrSb["0"] >= "1"){				
												if(isset($vDepto[$arrSb["2"]])){ $vDepto[$arrSb["2"]] = $vDepto[$arrSb["2"]]+1; }else{ $vDepto[$arrSb["2"]] = "1"; }
											}//$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
										}//if($arrSb["2"] >= "1"){
									}//if($valor != ""){
								}//fim foreach
							}//fim if($cont_ARRAY >= "1"){
							//inicia o processo de verificação do mapa e inclusão de novo depto
							$cont_ID = "0"; $cont_list = "0";//cont de controle do laço
							//monta array
							$array = $tipo_tramitacao_arr;
							$cont_ARRAY = ceil(count($array));
							//listar item ja cadastrados
							if($cont_ARRAY >= "1"){
								foreach ($array as $pos => $valor){
									if($valor != ""){
										$arrSub = explode("-", $valor);//[,ORDEM-PERFIL_ID-DEPTO_ID,]
										$cont_list++;
										//verifica se já tramitou
										if(isset($vDepto[$arrSub["2"]])){
											//JA PASSOU NO MAPA
											$vDepto[$arrSub["2"]] = $vDepto[$arrSub["2"]]-1;//retira da contagem
											if($vDepto[$arrSub["2"]] <= "0"){ unset($vDepto[$arrSub["2"]]); }//se zerou a contagem, remove da variavel
										}else{//if(isset($vDepto[$arrSub["2"]])){
											$cont_ID++;//incrementa controle de ids do sort
											if($cont_ID == "1"){
												if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;
												$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
												$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
												$cont_list++;
											}
										}//else{//if(isset($vDepto[$arrSub["2"]])){
										if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$arrSub["1"]."-".$arrSub["2"];
									}//if($valor != ""){
								}//fim foreach
								///se no laço nao localizou, coloca no fim do mapa
								if($cont_ID == "0"){
									$cont_list++;
									if($tipo_tramitacao_novo != ""){ $tipo_tramitacao_novo .= ","; } $tipo_tramitacao_novo .= $cont_list."-".$perfil_id_."-".$depto_a_;
									$mapa_tramitacao_id = $depto_a_;//alimenta nova tramitação
									$marca_mapa = ".".$depto_a_.".";//alimenta nova tramitação
								}//if($cont_ID == "0"){
							}//fim if($cont_ARRAY >= "1"){	
						}//if(($vai_volta == "1") and ($seguindo_mapa == "0")){
					}//if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL")){
					$mapa_tramitacao .= $seguindo_mapa."-".$perfil_id."-".$depto_a."-".time().",".$marca_mapa;
					//atualiza o mapa de tramitação ...............................................................................................<<<<
				}//if($acao == "recebido"){
					*/
					
					
				
				if($acao == "cancelado"){
					$status_n = "1";//ATIVO
					fRM::protocoloCriarEvento($multigestao_id,$tramite_acao,$rm,$departamento_id,$user,"Retorno de Processo", "Processo devolvido de ".$depto_nome_d." para ".$depto_nome."( ".SYS_CONFIG_RM_SIGLA." ".$depto_rm." ) através da Guia de Tramitação Nº ".$numero_guia,"tra_cancelado",$numero_guia);
				}//if($acao == "cancelado"){
					
				//APLICA STATUS DA AÇÃO
				if($status_n != ""){
					$arrProt["status"] = $status_n;
					//faz o ajuste de dados na tabela ---------------------------------------
					$campos = "status";
					$valores = array($arrProt["status"]);//define status como duam em aberto
					
					/*
					if($acao == "recebido"){//só atualiza sync se a tramiração ocorreu
						if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){ $mapa_tramitacao = "[,".$mapa_tramitacao.",]"; }
						if($mapa_tramitacao_id == ""){ $mapa_tramitacao_id = 'NULL'; }
						//monta time parado
						if($parado_tipo != "0"){
							if((!isset($arrProt["time_parado"])) or ($arrProt["time_parado"] == "0") or ($arrProt["time_parado"] == "")){ $arrProt["time_parado"] = $arrProt["sync"]; }
							$time_parado = $arrProt["time_parado"];
						}else{ $time_parado = time(); }//if($parado_tipo != "0"){	
						//verifica se tem recepator e define responsável
						$user_sel = 'NULL';
						$receptor_idd = (int)$receptor_id; if($receptor_idd >= "1"){ $user_sel = $receptor_idd; } if(($user_sel == "") or ($user_sel == "0")){ $user_sel = 'NULL'; }
						$arrProt["perfil_a"] = $perfil_id;
						$arrProt["depto_a"] = $depto_a;
						$arrProt["mapa_tramitacao_id"] = $mapa_tramitacao_id;
						$arrProt["mapa_tramitacao"] = $mapa_tramitacao;
						$arrProt["time_parado"] = $time_parado;
						$arrProt["user_id"] = $user_sel;
						$arrProt["user_a"] = $user;
						$arrProt["sync"] = time();
						$campos .= ",perfil_a"; $valores[] = $arrProt["perfil_a"];
						$campos .= ",depto_a"; $valores[] = $arrProt["depto_a"];
						$campos .= ",mapa_tramitacao_id"; $valores[] = $arrProt["mapa_tramitacao_id"];
						$campos .= ",mapa_tramitacao"; $valores[] = $arrProt["mapa_tramitacao"];
						$campos .= ",user_id"; $valores[] = $arrProt["user_id"];
						$campos .= ",time_parado"; $valores[] = $arrProt["time_parado"];
						$campos .= ",user_a"; $valores[] = $arrProt["user_a"];
						$campos .= ",sync"; $valores[] = $arrProt["sync"];
						//verifica se muda mapa de tramitação
						if($tipo_tramitacao_novo != ""){
							$tipo_tramitacao_novo = "[,".$tipo_tramitacao_novo.",]";
							$arrProt["tipo_tramitacao"] = $tipo_tramitacao_novo;
							$arrProt["tipo_tramitacao_user"] = "VAI E VOLTA NO TRÂMITE";
						}//if($tipo_tramitacao_novo != ""){						
					}//if($acao == "recebido"){
						*/
						
						
						
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela_prot, $valores, "id = '".$arrProt["id"]."'");
					$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrProt,"enc"),"send");
					file_put_contents($protPasta."/dados.fai",$file_ret);
					fBKP::bkpFile($protPasta."/dados.fai");//adiciona arquivo em lista de arquivo BACKUP
					
					/*
					//verifica se existe apensados...................................>>>
					if($acao == "recebido"){					
						//faz atualização em conversas do processo se existir
						$campos = "perfil_a,depto_a,user_id";
						$valores = array($arrProt["perfil_a"],$arrProt["depto_a"],$arrProt["user_id"]);//define status como duam em aberto
						fSQL::SQL_UPDATE_SIMPLES($campos, "protocolo_executando_conversas", $valores, "protocolo_id = '".$arrProt["id"]."'");									
						//verifica registro ativo do protocolo
						$resuA = fSQL::SQL_SELECT_SIMPLES("id,ano,mes,dia,cont", "protocolo_executando", "apensado_id = '".$arrProt["id"]."'", "", "100");
						while($linha2 = fSQL::FETCH_ASSOC($resuA)){
							$id_ = $linha2["id"];
							//verifica código já abre o protocolo
							unset($arrProtA,$valores);
							$protPastaA = VAR_DIR_FILES."files/tabelas/protocolo/".$linha2["ano"]."/".fGERAL::completaZero($linha2["mes"],"2")."/".fGERAL::completaZero($linha2["dia"],"2")."/".$linha2["cont"];
							if(file_exists($protPastaA."/dados.fai")){
								$arrProtA = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($protPastaA."/dados.fai"),"get"),"dec");
								
							}
							$user_sel = 'NULL';
							$arrProtA["perfil_a"] = $perfil_id;
							$arrProtA["depto_a"] = $depto_a;
							$arrProtA["time_parado"] = $time_parado;
							$arrProtA["user_id"] = $user_sel;
							$arrProtA["user_a"] = $user;
							$arrProtA["sync"] = time();
							$campos = "perfil_a"; $valores[] = $arrProtA["perfil_a"];
							$campos .= ",depto_a"; $valores[] = $arrProtA["depto_a"];
							$campos .= ",user_id"; $valores[] = $arrProtA["user_id"];
							$campos .= ",time_parado"; $valores[] = $arrProtA["time_parado"];
							$campos .= ",user_a"; $valores[] = $arrProtA["user_a"];
							$campos .= ",sync"; $valores[] = $arrProtA["sync"];	
							fSQL::SQL_UPDATE_SIMPLES($campos, "protocolo_executando", $valores, "id = '".$id_."'");
							$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrProtA,"enc"),"send");
							file_put_contents($protPastaA."/dados.fai",$file_ret);
							fBKP::bkpFile($protPastaA."/dados.fai");//adiciona arquivo em lista de arquivo BACKUP
						}//while
					}//if($acao == "recebido"){
					*/
					
					//verifica se existe apensados...................................<<<
				}//if($status_n != ""){
			}//fim do while		
				
		}else{//if(file_exists($protPasta."/dados.fai")){ --- se processo não existe na base, realiza a cópia
			//INICIAR CLASSE --->>> MULTI-GESTÃO
			$CLASS["classMultiGestaoProtocoloAdd"] = new classMultiGestaoProtocoloAdd;//inicia a classe
			//CLASSE #######=> seta os dados de multi-gestão
			$encontrou = $CLASS["classMultiGestaoProtocoloAdd"]->setMultiGestao($multigestao_id);//setMultiGestao($multigestao_id)	
			if($encontrou == "1"){				
				if($acao == "recebido"){
					//DEFINIR VARS - fWS
					$arrGetWS["numero_guia"] = $numero_guia;
					$arrGetWS["rm"] = $rm;
					$arrGetWS["user"] = $user;
					//MÉTODO DE CONSULTA fWS
					$fWSret = $CLASS["classMultiGestaoProtocoloAdd"]->ClientefWS_getWS("getProtocoloRemessa",$arrGetWS);//CONSULTA fWS
					//echo "getProtocoloRemessa:<pre>"; print_r($fWSret); echo "</pre>";
					//verifica lista de dados recebidos
					if(isset($fWSret["valida"])){
						if($fWSret["valida"] == "1"){
							//verifica se recebeu protocolo
							if(isset($fWSret["dados"])){
								$acao = $fWSret["acao"];
								$dados = $fWSret["dados"];				
								if($acao == "1"){//informação vem da multigestão já trocada (não era daqui, está recebendo)
									$CLASS["classMultiGestaoProtocoloAdd"]->setIds($dados["ano"],$dados["mes"],$dados["dia"],$dados["cont"],$user,$departamento_id);//seta vars de start
									$arrRet = $CLASS["classMultiGestaoProtocoloAdd"]->novoProtocoloMultigestao($dados,$receptor_id,$depto_perfil_d);//adiciona novo protocolo multi-gestão
								}//acao 1.DEVOLVER A MULTI-GESTÃO									
								if($acao == "2"){//informação vem da multigestão já trocada (já era daqui, está devolvendo)
										
										
										
										
									//zzz - receber o processo enviado a multi-gestão
											
											
									
								}//acao 2.ENVIAR A MULTI-GESTÃO									
							}//if(isset($fWSret["dados"])){	
						}//if($fWSret["valida"] == "1"){		
					}//if(isset($fWSret["valida"])){		
				}//if($acao == "recebido"){					
			}//if($encontrou == "1"){
					
					
					
					
					
					
					
					
					
					
					
					
					
		}//else{//if(file_exists($protPasta."/dados.fai")){
		return $arrRet;
	}//protocoloTramiteExterno
	
	
	
	//PPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP AÇÕES NO PROTOCOLO PPPPPPPPPPPPPPPPPPPPPP<<<
	
	
	
	
	
	
	










}//class fMultiGestao { //***************************************************************************************************************@
	
	
	
	
	
	
	












	
	
	
	
	
	















	
	
	












	
	
	
	
	
	
















//classe para gestao de apoio a TABELAS
class fTBL{ //***************************************************************************************************************@
	
	
	
	/* nomeTabela
	Funcao utilizada para definir nome humano de tabelas do sistema
	*/
	static function nomeTabela($tabela){
		$tabela_leg = $tabela;
		if(($tabela == "sys_permissao_grupos") or ($tabela == "1")){ 					$tabela_leg = "Grupo de Acessos"; }
		if(($tabela == "sys_usuarios") or ($tabela == "2")){ 							$tabela_leg = "Usuários do Sistema"; }
		if(($tabela == "sys_login") or ($tabela == "3")){ 								$tabela_leg = "Login do Sistema"; }
		if(($tabela == "cad_candidato_fisico_docs") or ($tabela == "4")){ 			$tabela_leg = "Documentos Candidato"; }
		if(($tabela == "cad_candidato_juridico_docs") or ($tabela == "5")){ 			$tabela_leg = "Documentos Candidato Jurídico"; }
		if(($tabela == "geo_propriedade_docs") or ($tabela == "6")){ 					$tabela_leg = "Documentos Propriedade"; }
		if(($tabela == "protocolo_executando_arquivos") or ($tabela == "7")){ 			$tabela_leg = "Arquivos/Anexos Protocolo"; }
		if(($tabela == "protocolo") or ($tabela == "8")){ 								$tabela_leg = "Protocolo/Processo"; }
		if(($tabela == "protocolo_remessa") or ($tabela == "15")){ 						$tabela_leg = "Trâmite de processos internos"; }
		if(($tabela == "fin_duam") or ($tabela == "16")){ 								$tabela_leg = "DUAM"; }
		if(($tabela == "sys_perfil_deptos") or ($tabela == "17")){ 						$tabela_leg = "Departamentos"; }
		if(($tabela == "sys_webservice") or ($tabela == "18")){ 						$tabela_leg = "Gestão de Web Service"; }
		if(($tabela == "fin_conta") or ($tabela == "20")){ 								$tabela_leg = "Contas/Banco de Faturamento de DUAM"; }
		if(($tabela == "fin_conta_banco_layout") or ($tabela == "21")){					$tabela_leg = "Layout de DUAM para Emissão"; }
		if(($tabela == "fin_grupo_juros") or ($tabela == "22")){						$tabela_leg = "Grupo de Juros Faturamento de DUAM"; }
		if(($tabela == "fin_receita") or ($tabela == "23")){ 							$tabela_leg = "Gestão de Receitas Financeiras"; }
		if(($tabela == "fin_servico") or ($tabela == "24")){ 							$tabela_leg = "Gestão de Serviços"; }
		if(($tabela == "fin_conta_retorno") or ($tabela == "25")){						$tabela_leg = "Arquivo Retorno Baixas DUAM (CNAB)"; }
		if(($tabela == "geo_area_zonaitbi") or ($tabela == "26")){						$tabela_leg = "Zona ITBI"; }
		if(($tabela == "geo_propriedade_edificio") or ($tabela == "27")){				$tabela_leg = "Edifício de Propriedade"; }
		if(($tabela == "geo_area") or ($tabela == "28")){								$tabela_leg = "Gestão de Área"; }
		if(($tabela == "cad_candidato_fisico") or ($tabela == "29")){				$tabela_leg = "Gestão de Candidato"; }
		if(($tabela == "cad_candidato_juridico") or ($tabela == "30")){				$tabela_leg = "Gestão de Candidato Jurídico"; }
		if(($tabela == "sys_login_session") or ($tabela == "31")){						$tabela_leg = "Sessão de Login"; }
		if(($tabela == "geo_area_logradouro_servicos") or ($tabela == "33")){			$tabela_leg = "Serviços do Logradouro"; }
		if(($tabela == "geo_area_logradouro_tipo") or ($tabela == "34")){				$tabela_leg = "Tipos de Logradouro"; }
		if(($tabela == "geo_area_posicao") or ($tabela == "35")){						$tabela_leg = "Posição de Áreas"; }
		if(($tabela == "cad_candidato_juridico_natureza") or ($tabela == "36")){		$tabela_leg = "Tipo de Natureza Jurídica"; }
		if(($tabela == "cad_candidato_juridico_tipo") or ($tabela == "37")){			$tabela_leg = "Tipo de Candidato Jurídico"; }
		if(($tabela == "cad_candidato_celular_tipo") or ($tabela == "38")){			$tabela_leg = "Tipo de Celular"; }
		if(($tabela == "cad_candidato_docs_tipo") or ($tabela == "39")){				$tabela_leg = "Tipo de Documento"; }
		if(($tabela == "cad_candidato_email_tipo") or ($tabela == "40")){			$tabela_leg = "Tipo de Email"; }
		if(($tabela == "cad_candidato_fone_tipo") or ($tabela == "41")){				$tabela_leg = "Tipo de Telefone"; }
		if(($tabela == "geo_propriedade_edificio_bloco") or ($tabela == "42")){			$tabela_leg = "Blocos de Edifícios"; }
		if(($tabela == "geo_propriedade_inf_tipo_grupo") or ($tabela == "43")){			$tabela_leg = "Grupo de Informações da Propriedade"; }
		if(($tabela == "geo_propriedade_docs_tipo") or ($tabela == "44")){				$tabela_leg = "Tipos Documento da Propriedade"; }
		if(($tabela == "geo_propriedade_tipo") or ($tabela == "45")){					$tabela_leg = "Tipos de Propeiedade"; }
		if(($tabela == "adm_protocolo_tipo") or ($tabela == "46")){						$tabela_leg = "Tipos de Solicitações em Processos"; }
		if(($tabela == "adm_protocolo_tipo_inf") or ($tabela == "47")){					$tabela_leg = "Informação Complementar de Processos"; }
		if(($tabela == "geo_propriedade_escritura") or ($tabela == "48")){				$tabela_leg = "Escritura de Propriedade"; }
		if(($tabela == "geo_area_zona") or ($tabela == "49")){							$tabela_leg = "Zona de Áreas"; }
		if(($tabela == "geo_area_setor") or ($tabela == "50")){							$tabela_leg = "Setor de Áreas"; }
		if(($tabela == "geo_area_bairro") or ($tabela == "51")){						$tabela_leg = "Bairro de Áreas"; }
		if(($tabela == "geo_area_logradouro") or ($tabela == "52")){					$tabela_leg = "Logradouro de Áreas"; }
		if(($tabela == "apoio_docs_validacao") or ($tabela == "53")){					$tabela_leg = "Validação de Arquivos"; }
		if(($tabela == "apoio_scanner") or ($tabela == "54")){							$tabela_leg = "Scanner de Arquivos"; }
		if(($tabela == "sys_permissao_expediente") or ($tabela == "56")){ 				$tabela_leg = "Controle de Expediente"; }
		if(($tabela == "com_appimagensinicio") or ($tabela == "57")){ 					$tabela_leg = "Adicionar Imagens ao Aplicativo AXL"; }
		if(($tabela == "com_appdenunciasgrupo") or ($tabela == "58")){ 					$tabela_leg = "Grupos de Denúncias"; }
		if(($tabela == "com_appdenunciascategoria") or ($tabela == "59")){ 				$tabela_leg = "Categorias de Denúncias"; }
		if(($tabela == "com_appdenuncias") or ($tabela == "60")){ 						$tabela_leg = "Denúncias"; }
		if(($tabela == "com_appdenuncias_ativas") or ($tabela == "61")){ 				$tabela_leg = "Denúncias Ativas"; }
		if(($tabela == "com_appdenuncias_finalizadas") or ($tabela == "62")){ 			$tabela_leg = "Denúncias Finalizadas"; }
		if(($tabela == "com_appredesocial") or ($tabela == "63")){ 						$tabela_leg = "Redes Sociais Aplicativo AXL"; }
		if(($tabela == "com_appeventos") or ($tabela == "64")){ 						$tabela_leg = "Eventos Aplicativo AXL"; }
		if(($tabela == "com_appfeiras") or ($tabela == "65")){	 						$tabela_leg = "Feiras Livres Aplicativo AXL"; }
		if(($tabela == "com_appprefeito") or ($tabela == "66")){	 					$tabela_leg = "Prefeito Aplicativo AXL"; }
		if(($tabela == "com_appsecretarias") or ($tabela == "67")){	 					$tabela_leg = "Secretarias Aplicativo AXL"; }
		if(($tabela == "com_appsatisfacao") or ($tabela == "68")){	 					$tabela_leg = "Enquetes de Satisfação Aplicativo AXL"; }
		if(($tabela == "com_appnoticias") or ($tabela == "69")){	 					$tabela_leg = "Notícias Aplicativo AXL"; }
		if(($tabela == "com_appvideos") or ($tabela == "70")){		 					$tabela_leg = "Vídeos Aplicativo AXL"; }
		if(($tabela == "com_registrocidadao") or ($tabela == "71")){		 			$tabela_leg = "Registro Cidadão Aplicativo AXL"; }
		if(($tabela == "fin_duam_fisico") or ($tabela == "72")){		 				$tabela_leg = "DUAM Físico"; }
		if(($tabela == "fin_duam_juridico") or ($tabela == "73")){		 				$tabela_leg = "DUAM Jurídico"; }
		if(($tabela == "geo_propriedade") or ($tabela == "81")){						$tabela_leg = "Propeiedade"; }
		if(($tabela == "adm_oficio_tipo") or ($tabela == "84")){						$tabela_leg = "Tipos de Solicitações em Ofício"; }
		if(($tabela == "adm_oficio_tipo_inf") or ($tabela == "85")){					$tabela_leg = "Informação Complementar de Ofício"; }
		if(($tabela == "adm_oficio_descritivo_modelo") or ($tabela == "86")){			$tabela_leg = "Descritivos Modelo de Ofício"; }
		if(($tabela == "oficio_remessa") or ($tabela == "87")){ 						$tabela_leg = "Trâmite de ofícios internos"; }
		if(($tabela == "tvg_dispositivos") or ($tabela == "88")){ 						$tabela_leg = "Dispositivo TV Gestão"; }
		if(($tabela == "adm_notificacao_tipo") or ($tabela == "89")){					$tabela_leg = "Tipos de Solicitações em Notificação"; }
		if(($tabela == "adm_notificacao_tipo_inf") or ($tabela == "90")){				$tabela_leg = "Informação Complementar de Notificação"; }
		if(($tabela == "notificacao") or ($tabela == "91")){ 							$tabela_leg = "Notificação Digital"; }
		if(($tabela == "notificacao_executando_arquivos") or ($tabela == "92")){ 		$tabela_leg = "Arquivos/Anexos Notificação"; }
		if(($tabela == "oficio_executando_arquivos") or ($tabela == "93")){ 			$tabela_leg = "Arquivos/Anexos Ofícios"; }
		if(($tabela == "notificacao_remessa") or ($tabela == "94")){ 					$tabela_leg = "Trâmite de notificações internas"; }
		if(($tabela == "com_appservicoscategoria") or ($tabela == "95")){ 				$tabela_leg = "App Categorias de Serviços"; }
		if(($tabela == "sys_perfil") or ($tabela == "96")){				 				$tabela_leg = "Perfils de Gestão"; }
		if(($tabela == "sys_webservice_dados") or ($tabela == "97")){ 					$tabela_leg = "Gestão de Web Service AXL de Dados"; }
		if(($tabela == "sys_webservice_smartlogin") or ($tabela == "98")){ 				$tabela_leg = "Gestão de Web Service Smart Login"; }
		if(($tabela == "sys_webservice_smartlogin") or ($tabela == "98")){ 				$tabela_leg = "Gestão de Web Service Smart Login"; }
		if(($tabela == "cad_candidato_juridico_celular") or ($tabela == "99")){ 		$tabela_leg = "Celular Candidato Jurídica"; }
		if(($tabela == "cad_candidato_juridico_fone") or ($tabela == "100")){ 		$tabela_leg = "Telefone Candidato Jurídica"; }
		if(($tabela == "cad_candidato_juridico_procurador") or ($tabela == "101")){ 	$tabela_leg = "Procurador Candidato Jurídica"; }
		if(($tabela == "cad_candidato_fisico_procurador") or ($tabela == "102")){ 	$tabela_leg = "Procurador Candidato Física"; }
		if(($tabela == "multigestao_remessa") or ($tabela == "103")){ 					$tabela_leg = "Trâmite de Multi-Gestão"; }
		return $tabela_leg;
	}//nomeTabela	
	
	/* numeroTabela
	Funcao utilizada para definir número de referencia as tabelas do sistema
	*/
	static function numeroTabela($tabela){
		$tabela_n = "0";
		if($tabela == "sys_permissao_grupos"){ 								$tabela_n = "1"; }
		if($tabela == "sys_usuarios"){ 										$tabela_n = "2"; }
		if($tabela == "sys_login"){ 										$tabela_n = "3"; }
		if($tabela == "cad_candidato_fisico_docs"){ 						$tabela_n = "4"; }
		if($tabela == "cad_candidato_juridico_docs"){ 					$tabela_n = "5"; }
		if($tabela == "geo_propriedade_docs"){ 								$tabela_n = "6"; }
		if($tabela == "protocolo_executando_arquivos"){ 					$tabela_n = "7"; }
		if($tabela == "protocolo"){ 										$tabela_n = "8"; }
		if($tabela == "protocolo_remessa"){ 								$tabela_n = "15"; }
		if($tabela == "fin_duam"){ 											$tabela_n = "16"; }
		if($tabela == "sys_perfil_deptos"){ 								$tabela_n = "17"; }
		if($tabela == "sys_webservice"){ 									$tabela_n = "18"; }
		if($tabela == "fin_conta"){ 										$tabela_n = "20"; }
		if($tabela == "fin_conta_banco_layout"){ 							$tabela_n = "21"; }
		if($tabela == "fin_grupo_juros"){ 									$tabela_n = "22"; }
		if($tabela == "fin_receita"){ 										$tabela_n = "23"; }
		if($tabela == "fin_servico"){ 										$tabela_n = "24"; }
		if($tabela == "fin_conta_retorno"){ 								$tabela_n = "25"; }
		if($tabela == "geo_area_zonaitbi"){ 								$tabela_n = "26"; }
		if($tabela == "geo_propriedade_edificio"){ 							$tabela_n = "27"; }
		if($tabela == "geo_area"){ 											$tabela_n = "28"; }
		if($tabela == "cad_candidato_fisico"){ 							$tabela_n = "29"; }
		if($tabela == "cad_candidato_juridico"){ 						$tabela_n = "30"; }
		if($tabela == "sys_login_session"){ 								$tabela_n = "31"; }
		if($tabela == "geo_area_logradouro_servicos"){ 						$tabela_n = "33"; }
		if($tabela == "geo_area_logradouro_tipo"){ 							$tabela_n = "34"; }
		if($tabela == "geo_area_posicao"){ 									$tabela_n = "35"; }
		if($tabela == "cad_candidato_juridico_natureza"){ 				$tabela_n = "36"; }
		if($tabela == "cad_candidato_juridico_tipo"){ 					$tabela_n = "37"; }
		if($tabela == "cad_candidato_celular_tipo"){ 					$tabela_n = "38"; }
		if($tabela == "cad_candidato_docs_tipo"){ 						$tabela_n = "39"; }
		if($tabela == "cad_candidato_email_tipo"){ 						$tabela_n = "40"; }
		if($tabela == "cad_candidato_fone_tipo"){ 						$tabela_n = "41"; }
		if($tabela == "geo_propriedade_edificio_bloco"){ 					$tabela_n = "42"; }
		if($tabela == "geo_propriedade_inf_tipo_grupo"){ 					$tabela_n = "43"; }
		if($tabela == "geo_propriedade_docs_tipo"){ 						$tabela_n = "44"; }
		if($tabela == "geo_propriedade_tipo"){ 								$tabela_n = "45"; }
		if($tabela == "adm_protocolo_tipo"){ 								$tabela_n = "46"; }
		if($tabela == "adm_protocolo_tipo_inf"){ 							$tabela_n = "47"; }
		if($tabela == "geo_propriedade_escritura"){ 						$tabela_n = "48"; }
		if($tabela == "geo_area_zona"){ 									$tabela_n = "49"; }
		if($tabela == "geo_area_setor"){ 									$tabela_n = "50"; }
		if($tabela == "geo_area_bairro"){ 									$tabela_n = "51"; }
		if($tabela == "geo_area_logradouro"){ 								$tabela_n = "52"; }
		if($tabela == "apoio_docs_validacao"){ 								$tabela_n = "53"; }
		if($tabela == "apoio_scanner"){ 									$tabela_n = "54"; }
		if($tabela == "sys_permissao_expediente"){ 							$tabela_n = "56"; }
		if($tabela == "com_appimagensinicio"){ 								$tabela_n = "57"; }
		if($tabela == "com_appdenunciasgrupo"){ 							$tabela_n = "58"; }
		if($tabela == "com_appdenunciascategoria"){ 						$tabela_n = "59"; }
		if($tabela == "com_appdenuncias"){ 									$tabela_n = "60"; }
		if($tabela == "com_appdenuncias_ativas"){ 							$tabela_n = "61"; }
		if($tabela == "com_appdenuncias_finalizadas"){ 						$tabela_n = "62"; }
		if($tabela == "com_appredesocial"){ 								$tabela_n = "63"; }
		if($tabela == "com_appeventos"){ 									$tabela_n = "64"; }
		if($tabela == "com_appfeiras"){ 									$tabela_n = "65"; }
		if($tabela == "com_appprefeito"){ 									$tabela_n = "66"; }
		if($tabela == "com_appsecretarias"){ 								$tabela_n = "67"; }
		if($tabela == "com_appsatisfacao"){ 								$tabela_n = "68"; }
		if($tabela == "com_appnoticias"){ 									$tabela_n = "69"; }
		if($tabela == "com_appvideos"){ 									$tabela_n = "70"; }
		if($tabela == "com_registrocidadao"){ 								$tabela_n = "71"; }
		if($tabela == "fin_duam_fisico"){ 									$tabela_n = "72"; }
		if($tabela == "fin_duam_juridico"){ 								$tabela_n = "73"; }
		if($tabela == "geo_propriedade"){ 									$tabela_n = "81"; }
		if($tabela == "adm_oficio_tipo"){ 									$tabela_n = "84"; }
		if($tabela == "adm_oficio_tipo_inf"){ 								$tabela_n = "85"; }
		if($tabela == "adm_oficio_descritivo_modelo"){ 						$tabela_n = "86"; }
		if($tabela == "oficio_remessa"){ 									$tabela_n = "87"; }
		if($tabela == "tvg_dispositivos"){ 									$tabela_n = "88"; }
		if($tabela == "adm_notificacao_tipo"){ 								$tabela_n = "89"; }
		if($tabela == "adm_notificacao_tipo_inf"){ 							$tabela_n = "90"; }
		if($tabela == "notificacao"){ 										$tabela_n = "91"; }
		if($tabela == "notificacao_executando_arquivos"){ 					$tabela_n = "92"; }
		if($tabela == "oficio_executando_arquivos"){ 						$tabela_n = "93"; }
		if($tabela == "notificacao_remessa"){ 								$tabela_n = "94"; }
		if($tabela == "com_appservicoscategoria"){ 							$tabela_n = "95"; }
		if($tabela == "sys_perfil"){ 										$tabela_n = "96"; }
		if($tabela == "sys_webservice_dados"){ 								$tabela_n = "97"; }
		if($tabela == "sys_webservice_smartlogin"){ 						$tabela_n = "98"; }
		if($tabela == "cad_candidato_juridico_celular"){					$tabela_n = "99"; }
		if($tabela == "cad_candidato_juridico_fone"){ 					$tabela_n = "100"; }
		if($tabela == "cad_candidato_juridico_procurador"){ 				$tabela_n = "101"; }
		if($tabela == "cad_candidato_fisico_procurador"){ 				$tabela_n = "102"; }
		if($tabela == "multigestao_remessa"){ 								$tabela_n = "103"; }
		return $tabela_n;
	}//numeroTabela	
	
	
	
	
	
	/* acaoTabela
	Funcao utilizada para definir nome humano de ação em tabelas do sistema
	*/
	static function acaoTabela($tabela){
		$tabela_n = "0";
		if(($tabela == "adicionar") or ($tabela == "1")){ 					$tabela_n = "Adicionar Novo"; }
		if(($tabela == "editar") or ($tabela == "2")){ 						$tabela_n = "Editar"; }
		if(($tabela == "excluir") or ($tabela == "3")){ 					$tabela_n = "Excluir"; }
		if(($tabela == "bloquear") or ($tabela == "4")){ 					$tabela_n = "Bloquear"; }
		if(($tabela == "cancelar") or ($tabela == "5")){ 					$tabela_n = "Cancelar"; }
		if(($tabela == "receber") or ($tabela == "6")){ 					$tabela_n = "Receber"; }
		if(($tabela == "parcelar") or ($tabela == "7")){ 					$tabela_n = "Parcelar"; }
		if(($tabela == "negociar") or ($tabela == "8")){ 					$tabela_n = "Negociar"; }
		if(($tabela == "ativar") or ($tabela == "9")){ 						$tabela_n = "Ativar"; }
		if(($tabela == "processar") or ($tabela == "10")){ 					$tabela_n = "Processar"; }
		if(($tabela == "cancelarparcelamento") or ($tabela == "11")){ 		$tabela_n = "Cancelar Parcelamento"; }
		if(($tabela == "baixar") or ($tabela == "12")){ 					$tabela_n = "Baixar"; }
		if(($tabela == "alterarfoto") or ($tabela == "13")){ 				$tabela_n = "Alterar Foto"; }
		if(($tabela == "excluirfoto") or ($tabela == "14")){ 				$tabela_n = "Excluir Foto"; }
		if(($tabela == "alterarsenha") or ($tabela == "15")){ 				$tabela_n = "Alterar Senha"; }
		if(($tabela == "desconectar") or ($tabela == "16")){ 				$tabela_n = "Desconectar"; }
		if(($tabela == "enviarcontrato") or ($tabela == "17")){ 			$tabela_n = "Enviar Contrato"; }
		if(($tabela == "validar") or ($tabela == "18")){ 					$tabela_n = "Validar"; }
		if(($tabela == "upload") or ($tabela == "19")){ 					$tabela_n = "Upload"; }
		if(($tabela == "acessowebremover") or ($tabela == "20")){ 			$tabela_n = "Remover Acesso Web"; }
		if(($tabela == "smsstatus") or ($tabela == "21")){ 					$tabela_n = "Status SMS"; }
		if(($tabela == "finalizar") or ($tabela == "22")){		 			$tabela_n = "Finalizar"; }
		if(($tabela == "desencubar") or ($tabela == "23")){ 				$tabela_n = "Desencubar"; }
		if(($tabela == "reativar") or ($tabela == "24")){ 					$tabela_n = "Reativar"; }
		if(($tabela == "qtdpaginas") or ($tabela == "25")){ 				$tabela_n = "QTD Páginas"; }
		if(($tabela == "acaoservicos") or ($tabela == "26")){ 				$tabela_n = "Ação em Serviços"; }
		if(($tabela == "acaotramitearquivo") or ($tabela == "29")){ 		$tabela_n = "Ação no Trâmite de Arquivo"; }
		if(($tabela == "adicionartramitearquivo") or ($tabela == "30")){	$tabela_n = "Adicionar Trâmite de Arquivo"; }
		if(($tabela == "adicionarpublicacao") or ($tabela == "31")){ 		$tabela_n = "Adicionar Publicação"; }
		if(($tabela == "excluirpublicacao") or ($tabela == "32")){ 			$tabela_n = "Excluir Publicação"; }
		if(($tabela == "apensar") or ($tabela == "33")){ 					$tabela_n = "Apensar"; }
		if(($tabela == "desapensar") or ($tabela == "34")){ 				$tabela_n = "Desapensar"; }
		if(($tabela == "emissao") or ($tabela == "35")){ 					$tabela_n = "Emissão"; }
		if(($tabela == "solicitantetrocastatus") or ($tabela == "36")){ 	$tabela_n = "Troca de Solicitante do Ofício"; }
		if(($tabela == "acaodescritivo") or ($tabela == "37")){				$tabela_n = "Ação em Descritivo"; }
		if(($tabela == "notificacao") or ($tabela == "38")){				$tabela_n = "Ação em Notificação"; }
		if(($tabela == "congelar") or ($tabela == "39")){		 			$tabela_n = "Congela/Descongela"; }
		return $tabela_n;
	}//acaoTabela
	
	/* acaoTabela
	Funcao utilizada para definir id de ação em tabelas do sistema
	*/
	static function idAcaoTabela($tabela){
		$tabela_n = "0";
		if($tabela == "adicionar"){ 										$tabela_n = "1"; }
		if($tabela == "editar"){ 											$tabela_n = "2"; }
		if($tabela == "excluir"){ 											$tabela_n = "3"; }
		if($tabela == "bloquear"){ 											$tabela_n = "4"; }
		if($tabela == "cancelar"){ 											$tabela_n = "5"; }
		if($tabela == "receber"){ 											$tabela_n = "6"; }
		if($tabela == "parcelar"){ 											$tabela_n = "7"; }
		if($tabela == "negociar"){ 											$tabela_n = "8"; }
		if($tabela == "ativar"){ 											$tabela_n = "9"; }
		if($tabela == "processar"){ 										$tabela_n = "10"; }
		if($tabela == "cancelarparcelamento"){ 								$tabela_n = "11"; }
		if($tabela == "baixar"){ 											$tabela_n = "12"; }
		if($tabela == "alterarfoto"){ 										$tabela_n = "13"; }
		if($tabela == "excluirfoto"){ 										$tabela_n = "14"; }
		if($tabela == "alterarsenha"){ 										$tabela_n = "15"; }
		if($tabela == "desconectar"){ 										$tabela_n = "16"; }
		if($tabela == "enviarcontrato"){ 									$tabela_n = "17"; }
		if($tabela == "validar"){ 											$tabela_n = "18"; }
		if($tabela == "upload"){ 											$tabela_n = "19"; }
		if($tabela == "acessowebremover"){ 									$tabela_n = "20"; }
		if($tabela == "smsstatus"){ 										$tabela_n = "21"; }
		if($tabela == "finalizar"){ 										$tabela_n = "22"; }
		if($tabela == "desencubar"){ 										$tabela_n = "23"; }
		if($tabela == "reativar"){ 											$tabela_n = "24"; }
		if($tabela == "qtdpaginas"){ 										$tabela_n = "25"; }
		if($tabela == "acaoservicos"){ 										$tabela_n = "26"; }
		if($tabela == "acaotramitearquivo"){ 								$tabela_n = "29"; }
		if($tabela == "adicionartramitearquivo"){ 							$tabela_n = "30"; }
		if($tabela == "adicionarpublicacao"){ 								$tabela_n = "31"; }
		if($tabela == "excluirpublicacao"){ 								$tabela_n = "32"; }
		if($tabela == "apensar"){ 											$tabela_n = "33"; }
		if($tabela == "desapensar"){ 										$tabela_n = "34"; }
		if($tabela == "emissao"){ 											$tabela_n = "35"; }
		if($tabela == "solicitantetrocastatus"){ 							$tabela_n = "36"; }
		if($tabela == "acaodescritivo"){ 									$tabela_n = "37"; }
		if($tabela == "notificacao"){ 										$tabela_n = "38"; }
		if($tabela == "congelar"){ 											$tabela_n = "39"; }
		return $tabela_n;
	}//idAcaoTabela
	
	
	
	
	/* idTabela
	Funcao utilizada para definir nome humano de tabelas do sistema
	*/
	static function idTabela($tabela){
		$tabela_leg = "00";
		//cadastros 01 - 19
		if($tabela == "geo_area"){									$tabela_leg = "01"; }
		if($tabela == "cad_candidato_fisico"){					$tabela_leg = "02"; }
		if($tabela == "cad_candidato_juridico"){					$tabela_leg = "03"; }
		if($tabela == "com_appdenuncias"){							$tabela_leg = "04"; }
		if($tabela == "geo_propriedade_escritura"){					$tabela_leg = "05"; }
		if($tabela == "geo_propriedade"){							$tabela_leg = "06"; }
		if($tabela == "sys_usuarios"){								$tabela_leg = "07"; }
		if($tabela == "sys_perfil_deptos"){							$tabela_leg = "08"; }
		if($tabela == "fin_servico"){								$tabela_leg = "09"; }
		if($tabela == "com_registrocidadao"){						$tabela_leg = "10"; }
		if($tabela == "com_registrocidadao_verificacao"){			$tabela_leg = "11"; }
		
		//protocolos 20 - 39
		if($tabela == "protocolo"){									$tabela_leg = "20"; }
		if($tabela == "oficio"){									$tabela_leg = "25"; }
		if($tabela == "notificacao"){								$tabela_leg = "30"; }
		
		//duam 40 - 41
		if($tabela == "fin_duam_fisico"){							$tabela_leg = "40"; }
		if($tabela == "fin_duam_juridico"){							$tabela_leg = "41"; }
		
		return $tabela_leg;
	}//idTabela
	
	
	
	
	/* legTabela
	Funcao utilizada para definir nome de ID de tabelas do sistema
	*/
	static function legTabela($tabela,$ret="0"){
		$tabela_o = $tabela; $tabela = fGERAL::legCodeTabela($tabela);
		$tabela_leg = "";
		//cadastros 01 - 19
		if($tabela == "01"){				$tabela_leg = "geo_area"; }
		if($tabela == "02"){				$tabela_leg = "cad_candidato_fisico"; }
		if($tabela == "03"){				$tabela_leg = "cad_candidato_juridico"; }
		if($tabela == "04"){				$tabela_leg = "com_appdenuncias"; }
		if($tabela == "05"){				$tabela_leg = "geo_propriedade_escritura"; }
		if($tabela == "06"){				$tabela_leg = "geo_propriedade"; }
		if($tabela == "07"){				$tabela_leg = "sys_usuarios"; }
		if($tabela == "08"){				$tabela_leg = "sys_perfil_deptos"; }
		if($tabela == "09"){				$tabela_leg = "fin_servico"; }
		if($tabela == "10"){				$tabela_leg = "com_registrocidadao"; }
		if($tabela == "11"){				$tabela_leg = "com_registrocidadao_verificacao"; }
		
		//protocolos 20 - 39
		if($tabela == "20"){				$tabela_leg = "protocolo"; }
		if($tabela == "25"){				$tabela_leg = "oficio"; }
		if($tabela == "30"){				$tabela_leg = "notificacao"; }
		
		//duam 40 - 41
		if($tabela == "40"){				$tabela_leg = "fin_duam_fisico"; }
		if($tabela == "41"){				$tabela_leg = "fin_duam_juridico"; }
		
		if(($ret == "1") and ($tabela_leg == "")){ $tabela_leg = $tabela_o; }
		return $tabela_leg;
	}//legTabela
	
	
	
	
	
	/* validaTabela
	Funcao valida code em tabelas de aplicação
	*/
	static function validaTabela($code){
		$tabela_id = fGERAL::legCodeTabela($code);
		return fTBL::legTabela($tabela_id);
	}//validaTabela

	
	
	
	
	/* caminhoDocs
	Funcao busca caminho de arquivo tabela docs */
	static function caminhoDocs($tabela,$id="",$file="",$acao="",$rm=""){
		$arrRet["caminho"] = ""; $arrRet["file"] = ""; $arrRet["valida"] = "";
		//cad_candidato_fisico_docs
		if($tabela == "cad_candidato_fisico_docs"){ $arrRet["caminho"] = VAR_DIR_FILES."files/tabelas/cad_candidato_fisico_docs/";
			if(($id != "") and ($file != "")){ $arrRet["file"] = "doc-".$id.".".fGERAL::mostraExtensao($file); $arrRet["valida"] = "valida-".$id;  }
		}//if cad_candidato_fisico_docs
		//cad_candidato_juridicoco_docs
		if($tabela == "cad_candidato_juridico_docs"){ $arrRet["caminho"] = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/";
			if(($id != "") and ($file != "")){ $arrRet["file"] = "doc-".$id.".".fGERAL::mostraExtensao($file); $arrRet["valida"] = "valida-".$id;  }
		}//if cad_candidato_juridicoco_docs
		//geo_propriedade_docs
		if($tabela == "geo_propriedade_docs"){ $arrRet["caminho"] = VAR_DIR_FILES."files/tabelas/geo_propriedade_docs/";
			if(($id != "") and ($file != "")){ $arrRet["file"] = "doc-".$id.".".fGERAL::mostraExtensao($file); $arrRet["valida"] = "valida-".$id;  }
		}//if geo_propriedade_docs		
		//protocolo_executando_arquivos
		if(($tabela == "protocolo_executando_arquivos") and ($rm != "")){ $aCode = fGERAL::returnCode7($rm);
			if($aCode["ano"] != ""){
				$arrRet["caminho"] = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/arquivos/files/";
				if(($id != "") and ($file != "")){ $arrRet["file"] = "doc-".$id.".".fGERAL::mostraExtensao($file); $arrRet["valida"] = "valida-".$id;  }
			}
		}//if protocolo_executando_arquivos
		//notificacao_executando_arquivos
		if(($tabela == "notificacao_executando_arquivos") and ($rm != "")){ $aCode = fGERAL::returnCode9($rm);
			if($aCode["ano"] != ""){
				$arrRet["caminho"] = VAR_DIR_FILES."files/tabelas/notificacao/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/arquivos/files/";
				if(($id != "") and ($file != "")){ $arrRet["file"] = "doc-".$id.".".fGERAL::mostraExtensao($file); $arrRet["valida"] = "valida-".$id;  }
			}
		}//if notificacao_executando_arquivos
		if(($tabela == "multi_protocolo_executando_arquivos") and ($rm != "")){			
			$d = explode("M",$rm); $multigestao_id = $d["0"]; $rm = $d["1"]; $aCode = fGERAL::returnCode7($rm);
			if($aCode["ano"] != ""){
				$arrRet["caminho"] = VAR_DIR_FILES."files/tabelas/multi_protocolo/".$multigestao_id."/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/arquivos/files/";
				if(($id != "") and ($file != "")){ $arrRet["file"] = "doc-".$id.".".fGERAL::mostraExtensao($file); $arrRet["valida"] = "valida-".$id;  }
			}
		}//if multi_protocolo_executando_arquivos
		
			
		if($acao == "file"){
			if(!file_exists($arrRet["caminho"].$arrRet["file"])){ $arrRet["file"] = ""; }
		}
		if($acao == "valida"){
			if(!file_exists($arrRet["caminho"]."valida-".$id)){ $arrRet["valida"] = ""; }
		}
		if($acao == "exists"){
			if(!file_exists($arrRet["caminho"].$arrRet["file"])){ $arrRet["file"] = ""; }
			if(!file_exists($arrRet["caminho"]."valida-".$id)){ $arrRet["valida"] = ""; }
		}		
		return $arrRet;
	}//caminhoDocs


}//class fTBL { //***************************************************************************************************************@
	
	
	
	
	
	
	











//classe de MENSAGENS
class  classMSG { //***************************************************************************************************************@
	//VARS  ------------------------------------------------------------------->>>>
	private $mensagem;
	private $time_sucesso = "";
	private $time_info = "";
	private $time_erro = "";
	private $time_alerta = "";
	
	//SET GET VARS ------------------------------------------------------------>>>>
	private function setMensagem($var){	$var = str_replace("\n"," ",$var); $this->mensagem = $var; }
	private function getMensagem(){	return $this->mensagem; }
	private function delMensagem(){	unset($this->mensagem); }
	
	
	//METODOS ----------------------------------------------------------------->>>>
	public function addMSG($TIPO,$MSG,$TIME=""){
		$mensagem = $this->getMensagem();
		if(($TIPO == "SUCESSO") and ($MSG != "")){
			if(($TIME != "") and ($TIME >= "1")){ $this->time_sucesso = $TIME; }//seta time de mansagem
			if((isset($mensagem["SUCESSO"])) and ($mensagem["SUCESSO"] != "")){ $mensagem["SUCESSO"] .= "<br>"; } $mensagem["SUCESSO"] = $mensagem["SUCESSO"].$MSG;
		}//SUCESSO
		if(($TIPO == "INFO") and ($MSG != "")){
			if(($TIME != "") and ($TIME >= "1")){ $this->time_info = $TIME; }//seta time de mansagem
			if((isset($mensagem["INFO"])) and ($mensagem["INFO"] != "")){ $mensagem["INFO"] .= "<br>"; } $mensagem["INFO"] = $mensagem["INFO"].$MSG;
		}//INFO
		if(($TIPO == "ERRO") and ($MSG != "")){
			if(($TIME != "") and ($TIME >= "1")){ $this->time_erro = $TIME; }//seta time de mansagem
			if((isset($mensagem["ERRO"])) and ($mensagem["ERRO"] != "")){ $mensagem["ERRO"] .= "<br>"; } $mensagem["ERRO"] = $mensagem["ERRO"].$MSG;
		}//ERRO
		if(($TIPO == "ALERTA") and ($MSG != "")){
			if(($TIME != "") and ($TIME >= "1")){ $this->time_alerta = $TIME; }//seta time de mansagem
			if((isset($mensagem["ALERTA"])) and ($mensagem["ALERTA"] != "")){ $mensagem["ALERTA"] .= "<br>"; } $mensagem["ALERTA"] = $mensagem["ALERTA"].$MSG;
		}//ALERTA
		$this->setMensagem($mensagem);
	}//fim function msgDisplay
	
	//imprimir mensagem
	public function imprimirMSG($DIV="",$TIMER="10000"){
		global $class_fLNG;
		$MSG = $this->getMensagem();
		if($MSG["DIV"] == ""){
			$divADD = "dMSG".rand(999,9999999); echo "<div style=\"padding-top:1px;\" id=\"".$divADD."\"></div>";
		}else{ $divADD = $DIV; }
		if((isset($MSG["SUCESSO"])) and ($MSG["SUCESSO"] != "")){
			if(($this->time_sucesso != "") and ($this->time_sucesso >= "1")){ $TIMER = $this->time_sucesso; }//seta time de mansagem
			echo "<script>$.doTimeout('vTimerMsgs', 500, function(){ exibMensagem('".$divADD."','sucesso','<i class=\"icon-info-sign\"></i> ".$MSG["SUCESSO"]."','".$TIMER."'); });</script>";
		}//SUCESSO
		if((isset($MSG["INFO"])) and ($MSG["INFO"] != "")){
			if(($this->time_info != "") and ($this->time_info >= "1")){ $TIMER = $this->time_info; }//seta time de mansagem
			echo "<script>$.doTimeout('vTimerMsgi', 500, function(){ exibMensagem('".$divADD."','info','<i class=\"icon-info-sign\"></i> ".$MSG["INFO"]."','".$TIMER."');});</script>";
		}//INFO
		if((isset($MSG["ERRO"])) and ($MSG["ERRO"] != "")){
			if(($this->time_erro != "") and ($this->time_erro >= "1")){ $TIMER = $this->time_erro; }//seta time de mansagem
			echo "<script>$.doTimeout('vTimerMsge', 500, function(){ exibMensagem('".$divADD."','erro','<i class=\"icon-info-sign\"></i> ".$MSG["ERRO"]."','".$TIMER."');});</script>";
		}//ERRO
		if((isset($MSG["ALERTA"])) and ($MSG["ALERTA"] != "")){
			if(($this->time_alerta != "") and ($this->time_alerta >= "1")){ $TIMER = $this->time_alerta; }//seta time de mansagem
			echo "<script>$.doTimeout('vTimerMsga', 500, function(){ exibMensagem('".$divADD."','alerta','<i class=\"icon-info-sign\"></i> ".$MSG["ALERTA"]."','".$TIMER."');});</script>";
		}//ALERTA
		$this->delMensagem();
	}//fim function msgDisplay
		
	
} //fim class  classMSG  //***************************************************************************************************************@










	
	
	
	
	
	















	
	
	












	
	
	
	
	
	


















/* CLASSE DE FUNCOES BACKUP FILES - ( fBKP 1.2 ) ------------------------------------------------------------------------->>>*/
//classe para gestao de apoio a BACKUP (necessário conexão com base de dados e tabela: bkp_anos)
class fBKP{ //***************************************************************************************************************@
	
	//Função para criar microtima ou extrair o time de microtime gerado
	static function fMicrotime($val=""){
		$leg = "";
		if($val != ""){
			$leg = str_replace(substr($val,-8,(strlen($val))), "", $val);
		}else{
			list($usec, $sec) = explode(" ", microtime());
			$d = explode(".", $usec);
			$leg = $sec.$d["1"];
		}
		return $leg;
	}//fMicrotime	
	
	//Função realiza limpeza de dia anterior
	static function limpaAnterior($data_ant,$ano_sql){
		$d = explode("-", $data_ant); $ano = $d["0"]; $mes = $d["1"]; $dia = $d["2"];
		if($ano >= "2018"){ }else{//if($ano >= "2018"){	
			//busca primeiro ano
			$resu = mysql_query("SELECT ano,mes,dia FROM bkp_ano_".$ano_sql." ORDER BY id ASC LIMIT 1")or die("ERRO NA TABELA LIMPA BACKUP - BKP");
			$linha = mysql_fetch_assoc($resu);
			$ano = $linha["ano"]; $mes = $linha["mes"]; $dia = $linha["dia"];
			$data_ant = $ano."-".str_pad($mes, "2", "0", STR_PAD_LEFT)."-".str_pad($dia, "2", "0", STR_PAD_LEFT);
		}//else{//if($ano >= "2018"){
		if($ano >= "2018"){//verifica se o ano tem referencia ao ano de inicio de aplicação da ferramenta
			try {
				//limpa os dados antigos				
				mysql_query("DELETE FROM bkp_ano_dia WHERE ano != '".$ano."' AND mes != '".$mes."' AND dia != '".$dia."'");
				mysql_query("UPDATE bkp_anos SET data_ant = '".$data_ant."' WHERE ano = '".$ano_sql."'")or die("ERRO UPDATE TABELA 0 DE BACKUP - BKP");
			} catch (Exception $e) {				
			}//catch
		}//if($ano >= "2018"){
	}//limpaAnterior
	/*	
	SELECT * FROM `bkp_ano_2018` WHERE ano = '2018' AND mes = '07' AND dia != '13' GROUP BY caminho ORDER BY `microtime`  DESC
DELETE a FROM bkp_ano_2018 AS a, bkp_ano_2018 AS b WHERE ( a.ano = '2018' AND a.mes = '07' AND a.dia = '11' ) AND ( a.ano=b.ano AND a.mes=b.mes AND a.dia=b.dia AND a.caminho=b.caminho ) AND a.id != b.id	
	*/
	
	/* gravaAcao
	Funcao utilizada para gravar a ação de registro de alteração
	*/
	static function gravaAcao($tipo,$conteudo){	
		$fMicrotime = fBKP::fMicrotime();
		$valida = "0";	
		try {
			//monta inofrmações de data .....................................................
			$ano = date('Y'); $mes = date('m'); $dia = date('d');		
			//verifica se cria a tabela
			$resu = mysql_query("SELECT COUNT(*) AS contagem,data_ant FROM bkp_anos WHERE ano = '".$ano."'")or die("ERRO NA TABELA DE BACKUP - BKP");
			$linha = mysql_fetch_assoc($resu);
			$contagem = $linha["contagem"];
			if($contagem >= "1"){// - faz limpeza de data anterior
				$data_hoje = date('Y-m-d'); $data_hoje_cont = str_replace("-","",$data_hoje);
				$data_ant = $linha["data_ant"]; $data_ant_cont = str_replace("-","",$data_ant);
				if($data_ant != $data_hoje){
					if($data_hoje_cont >= $data_ant_cont){
						//fazer limpeza de data anterior
						fBKP::limpaAnterior($data_ant,$ano);
					}//if($data_hoje_cont >= $data_ant_cont){
				}//if($data_ant != $data_hoje){	
				//verifica dia
				$resu = mysql_query("SELECT id,COUNT(*) AS cont_dia FROM bkp_ano_dia WHERE ano = '".$ano."' AND mes = '".$mes."' AND dia = '".$dia."' AND caminho = '".$conteudo."'")or die("ERRO NA TABELA D1 - BKP");
				$linha = mysql_fetch_assoc($resu);
				$cont_dia = $linha["cont_dia"];
				if($cont_dia >= "1"){
					$id_dia = $linha["id"];
					mysql_query("UPDATE bkp_ano_dia SET microtime = '".$fMicrotime."' WHERE id = '".$id_dia."'")or die("ERRO UPDATE TABELA D1 - BKP");
				}else{//if($cont_dia >= "1"){
					//VARS insert SQL
					mysql_query("INSERT INTO `bkp_ano_dia` ( ano,mes,dia,tipo,caminho,microtime ) VALUES ( '".$ano."','".$mes."','".$dia."','".$tipo."','".$conteudo."','".$fMicrotime."' )")or die("ERRO ADD DIA - BKP");			
					//VARS insert SQL
					mysql_query("INSERT INTO `bkp_ano_".$ano."` ( ano,mes,dia,tipo,caminho,microtime ) VALUES ( '".$ano."','".$mes."','".$dia."','".$tipo."','".$conteudo."','".$fMicrotime."' )")or die("ERRO ADD ANO - BKP");				
				}//else{//if($cont_dia >= "1"){					
						
			}else{//if($contagem >= "1"){ - cria tabela de dados caso seja necessário
				//VARS insert SQL
				mysql_query("INSERT INTO `bkp_anos` ( ano,data_ant,time ) VALUES ( '".$ano."', '".time()."', '".date('Y-m-d')."' )")or die("ERRO CRIAR TABELA 0 DE BACKUP - BKP");			
				//cria nova tabela
				mysql_query("CREATE TABLE IF NOT EXISTS `bkp_ano_".$ano."` ( `id` BIGINT NOT NULL AUTO_INCREMENT, `ano` INT(4) NULL, `mes` INT(2) NULL, `dia` INT(2) NULL, `tipo` VARCHAR(10) NULL, `caminho` MEDIUMTEXT NULL, `microtime` BIGINT NOT NULL, PRIMARY KEY (`id`));")or die("ERRO CRIAR TABELA DE BACKUP - BKP");	
				
				//VARS insert SQL
				mysql_query("INSERT INTO `bkp_ano_dia` ( ano,mes,dia,tipo,caminho,microtime ) VALUES ( '".$ano."','".$mes."','".$dia."','".$tipo."','".$conteudo."','".$fMicrotime."' )")or die("ERRO ADD DIA - BKP");			
				//VARS insert SQL
				mysql_query("INSERT INTO `bkp_ano_".$ano."` ( ano,mes,dia,tipo,caminho,microtime ) VALUES ( '".$ano."','".$mes."','".$dia."','".$tipo."','".$conteudo."','".$fMicrotime."' )")or die("ERRO ADD ANO - BKP");		
			}//else{//if($contagem >= "1"){
			$valida = "1";
		} catch (Exception $e) {
			$valida = "0";
		}//catch
		if($valida == "0"){
			if(!file_exists(VAR_DIR_FILES."backupERRO")){ mkdir(VAR_DIR_FILES."backupERRO", 0775); chmod(VAR_DIR_FILES."backupERRO", 0775); }//cria pasta
			file_put_contents(VAR_DIR_FILES."backupERRO/".md5(uniqid(time())).rand(0,rand()),"[".$tipo."]".$conteudo);
		}
		return $valida;		
	}//gravaAcao	
	
	/* bkpFile
	Funcao utilizada para armazenar lista de arquivos editados
	Exemplo: fBKP::bkpFile("/pasta/caminho/arquivo.txt");//adiciona arquivo em lista de arquivo BACKUP
	*/
	static function bkpFile($caminho_file){
		if(SYS_CONFIG_SYS_SYNC_BACKUP == "1"){ $idValida = fBKP::gravaAcao("ARQUIVO",$caminho_file); }//grava o arquivo de informações
	}//bkpFile	
	
	/* bkpAddFolder
	Funcao utilizada para armazenar lista de arquivos editados
	Exemplo: if($cria == 1){ fBKP::bkpAddFolder($upload_raiz); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
	*/
	static function bkpAddFolder($caminho_file){
		if(SYS_CONFIG_SYS_SYNC_BACKUP == "1"){ $idValida = fBKP::gravaAcao("PASTA",$caminho_file); }//grava o arquivo de informações		
	}//bkpAddFolder	
	
	/* bkpDelFile
	Funcao utilizada para armazenar lista de arquivos excluidos
	Exemplo: fBKP::bkpDelFile("/pasta/caminho/arquivo.txt");//adiciona arquivo em lista de excluídos BACKUP
	*/
	static function bkpDelFile($caminho_file){
		if(SYS_CONFIG_SYS_SYNC_BACKUP == "1"){ $idValida = fBKP::gravaAcao("APAGAR",$caminho_file); }//grava o arquivo de informações		
	}//bkpDelFile	

}//class fBKP { //***************************************************************************************************************@
/* CLASSE DE FUNCOES BACKUP FILES - ( fBKP 1.2 ) -------------------------------------------------------------------------<<<*/



class fSENHA{
	
	static function gerarSenha($unidade_id,$servico_id,$prioridade_id,$nome,$senha_antiga=''){
		$url = WS_URL_SENHA."?novaSenha=1";
		$url .= "&unidade_id=".$unidade_id."&servico_id=".$servico_id."&prioridade_id=".$prioridade_id."&nome=".$nome;
		if($senha_antiga != ""){
			$url .= "&senha_antiga=".$senha_antiga;
		}
		//echo "<br>url:".$url;
		
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		

		$linha = file_get_contents($url, false, stream_context_create($arrContextOptions));	
		//echo "<br>linha:".$linha;
		$linha = json_decode($linha, true);
		//echo "ARRAY: <pre>"; print_r($linha); echo "</pre>";
		$senha = $linha["senha"];	
		return $senha;
	}//gerarSenha
	
	static function status($usuario_id,$servicos,$unidade_id){
		$url = WS_URL_SENHA."?getStatus=1";
		$url .= "&usuario_id=".$usuario_id."&servicos=".$servicos."&unidade_id=".$unidade_id;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
				
		//echo "<br>url:".$url;
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo "<br>linha:".$result;
		$result = json_decode($result, true);
		//echo "ARRAY: <pre>"; print_r($result); echo "</pre>";
		return $result;
	}//status
	
	
	static function listaNaoCompareceu($unidade_id){
		$url = WS_URL_SENHA."?listaNaoCompareceu=1";
		$url .= "&unidade_id=".$unidade_id;
		//echo "<br>url:".$url;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo "<br>linha:".$result;
		$result = json_decode($result, true);
		//echo "ARRAY: <pre>"; print_r($result); echo "</pre>";
		return $result;
	}//status	
	
	static function proximo($usuario_id,$unidade_id,$servicos,$num_guiche){
		$url = WS_URL_SENHA."?proximo=1";
		$url .= "&usuario_id=".$usuario_id."&unidade_id=".$unidade_id."&servicos=".$servicos."&num_guiche=".$num_guiche;
		//echo "<br>url:".$url;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo "<br>linha:".$result;
		$result = json_decode($result, true);
		//echo "ARRAY: <pre>"; print_r($result); echo "</pre>";
		return $result;		
	}//acao


	static function acao($usuario_id,$unidade_id,$servico_id,$senha,$status,$redirecionar_servico_id=""){
		$url = WS_URL_SENHA."?acao=1";
		$url .= "&usuario_id=".$usuario_id."&unidade_id=".$unidade_id."&servico_id=".$servico_id."&senha=".$senha."&status=".$status."&redirecionar_servico_id=".$redirecionar_servico_id;
		//echo "<br>url:".$url;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo "<br>linha:".$result;
		$result = json_decode($result, true);
		//echo "ARRAY: <pre>"; print_r($result); echo "</pre>";
		return $result;		
	}//acao
	
	
	static function encerrar($usuario_id,$unidade_id,$servico_id,$senha,$redirecionar_servico_id=""){
		$url = WS_URL_SENHA."?encerrar=1";
		$url .= "&usuario_id=".$usuario_id."&unidade_id=".$unidade_id."&servico_id=".$servico_id."&senha=".$senha."&redirecionar_servico_id=".$redirecionar_servico_id;
		//echo "<br>url:".$url;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo "<br>linha:".$result;
		$result = json_decode($result, true);
		//echo "ARRAY: <pre>"; print_r($result); echo "</pre>";
		return $result;		
	}//encerrar	
	
	
	static function iniciar($usuario_id,$unidade_id,$servico_id,$senha){
		$url = WS_URL_SENHA."?iniciar=1";
		$url .= "&usuario_id=".$usuario_id."&unidade_id=".$unidade_id."&servico_id=".$servico_id."&senha=".$senha;
		//echo "<br>url:".$url;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo "<br>linha:".$result;
		$result = json_decode($result, true);
		//echo "ARRAY: <pre>"; print_r($result); echo "</pre>";
		return $result;		
	}//iniciar		
	
	static function chamarNovamente($usuario_id,$unidade_id,$servico_id,$senha,$num_guiche){
		$url = WS_URL_SENHA."?chamarNovamente=1";
		$url .= "&unidade_id=".$unidade_id."&servico_id=".$servico_id."&senha=".$senha."&num_guiche=".$num_guiche;
		//echo "<br>url:".$url;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//echo "<br>linha:".$result;
		$result = json_decode($result, true);
		//echo "ARRAY: <pre>"; print_r($result); echo "</pre>";
		return $result;		
	}//acao	
	
	
	static function reiniciarSenhas(){
		$url = WS_URL_SENHA."?reiniciarSenhas=1";
		//echo "<br>url:".$url;
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 		
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		return $result;
	}//acao		
	
	static function servicoTipoLeg($servico_id){
		global $class_fLNG;
		$leg = "";
		if($servico_id == "1"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'Permis de Conduir'); }
		if($servico_id == "2"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'Veículo'); }
		if($servico_id == "3"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'Reclamação'); }		
		if($servico_id == "4"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'Informação'); }		
		if($servico_id == "5"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'Coleta Biométrica'); }		
		if($servico_id == "6"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'Retirada'); }				
		return $leg;	
	}//legPrioridade	
	
	
}//fSENHA





class fPROCESSO{
	
	//cria arquivo de dados do processo dentro de eventos: time()
	static function criarEvento($evento,$descricao,$user,$cargo,$processo_id="",$verPasta=""){
		if($verPasta == ""){
			$linha = fSQL::SQL_SELECT_ONE("ano,mes,dia,code","axl_processo","id = '".$processo_id."'");
			$verPasta = VAR_DIR_FILES."files/tabelas/axl_processo/".$linha["ano"]."/".completa_zero($linha["mes"],"2")."/".completa_zero($linha["dia"],"2")."/".$linha["code"]."/";
		}//if($pasta != ""){
			
		if(($verPasta != "") and ($evento != "")){
			$cria = fGERAL::criaPasta($verPasta."/eventos", "0775"); //confere a criação e retona 1
			$url_buffer = $verPasta."/eventos/0";
			if(file_exists($url_buffer)){
				$arrFile = fGERAL::jsonArray(fGERAL::logFile(file_get_contents($url_buffer),"get"),"dec");
				$cont_BF = ceil(count($arrFile));
				if($cont_BF >= "7"){
					$c_file = fGERAL::criaFileCont($verPasta."/eventos","retorno"); rename($url_buffer, $verPasta."/eventos/".$c_file); unset($arrFile);
				}
			}

			//inicia criação do array de dados
			$array["evento"] = $evento; $array["descricao"] = $descricao; $array["cargo"] = $cargo; $array["user"] = $user;
			$array["time"] = time();
			$arrFile[] = $array;
			$file_ret = fGERAL::logFile(fGERAL::jsonArray($arrFile,"enc"),"send");
			file_put_contents($verPasta."eventos/0",$file_ret);
		}//if($verPasta != ""){
	}//criarEvento	
	
	//busca arquivos de dados do processo dentro de eventos: time()
	public function getEventos($processo_id="",$verPasta="",$cont_limit="0",$acao="",$limit="1"){//cont_limit: a partir de qual, limit: quantos exibir
		if($verPasta == ""){
			$linha = fSQL::SQL_SELECT_ONE("ano,mes,dia,code","axl_processo","id = '".$processo_id."'");
			$verPasta = VAR_DIR_FILES."files/tabelas/axl_processo/".$linha["ano"]."/".$linha["mes"]."/".$linha["dia"]."/".$linha["code"]."/";
		}//if($pasta != ""){
			
		if($verPasta != ""){
			$listaArray = array();
			$cont_total = "0";
			$fileCaminho = $verPasta."/eventos";
			//if($limit >= "2"){ $cont_limit = "0"; }//corrige o conta caso recebeu limit
			//verifica se exibe dados do arquivo 0
			if(($cont_limit == "0") or ($cont_limit == "")){
				//verifica se busca o arquivo 0
				if(file_exists($fileCaminho."/0")){
					$file_ret = file_get_contents($fileCaminho."/0");
					if($file_ret != ""){
						$arr = fGERAL::jsonArray(fGERAL::logFile($file_ret,"get"),"dec");
						$cont_total = ceil(count($arr));//faz contagem de total de registros
							if($cont_total >= "1"){
								unset($arrayLs);
								foreach($arr as $pos => $arrSub){
									$arrayLs[] = $arrSub;	
								}//fim foreach
								if(isset($arrayLs)){
									$listaArray = array_merge($listaArray,array_reverse($arrayLs));//adiciona itens ao array de retorno
									$limit--;//contagem do limit
								}//if(isset($arrayLs)){
							}//fim if($filesArray >= "1"){
					}//if($file_ret != ""){					
				}//if(file_exists($fileCaminho."/0")){	
			}//if(($cont_limit == "0") or ($cont_limit == "")){	
			//verifica proximo arquivo lista
			$cont_b = fGERAL::listaArquivos($fileCaminho,"cont");//verifica quantidade de arquivos da lista
			if($cont_b >= "2"){ $mult = $cont_b-1; $cont_total = $cont_total+($mult*7); }//faz contagem de total de registros
			if($limit >= "1"){
				//$limit++;//aumenta contagem do limit para compensar o 0
				if($cont_b >= "1"){
					while($limit >= "1"){
							//$retArray["DEBUG"] = "cont_limit: $cont_limit";
						$c_file = $cont_b-$cont_limit;
						$limit--;//contagem do limit
						$cont_limit++;//incrementa cont de listagem
						if($c_file >= "1"){
							if(file_exists($fileCaminho."/".$c_file)){
								$file_ret = file_get_contents($fileCaminho."/".$c_file);
								if($file_ret != ""){
									$arr = fGERAL::jsonArray(fGERAL::logFile($file_ret,"get"),"dec");
									if(ceil(count($arr)) >= "1"){
										unset($arrayLs);
										foreach($arr as $pos => $arrSub){
											$arrayLs[] = $arrSub;
										}//fim foreach
										if(isset($arrayLs)){
											$listaArray = array_merge($listaArray,array_reverse($arrayLs));//adiciona itens ao array de retorno
										}//if(isset($arrayLs)){
									}//fim if($filesArray >= "1"){
								}//if($file_ret != ""){					
							}//if(file_exists($fileCaminho."/".$c_file)){
						}//if($c_file >= "1"){
					}//while($limit >= "1"){
				}//if($cont_b >= "1"){
			}//if($limit >= "1"){
			$retArray["cont_f"] = $cont_b;
			$retArray["cont"] = $cont_total;
			$retArray["lista"] = $listaArray;
			return $retArray;
		}//if($verPasta != ""){
	}//getEventos	
}//class fPROCESSO{

############## FIM - CLASSES ###########<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
?>
