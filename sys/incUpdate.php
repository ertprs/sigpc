<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
$UPDATE_STATUS = "0";
//verifica se exite arquivo de update em andamento ---------------------------------------------------------------------- >>>
if(file_exists(VAR_DIR_FILES."files/update/update.fai")){
	$fUPDATE = explode("-", file_get_contents(VAR_DIR_FILES."files/update/update.fai"));
	if(date('Ymd') >= $fUPDATE["1"]){//verifica se a data de update é agora
		if(date('Gi') >= $fUPDATE["0"]){//verifica se a hora de update é agora
			$UPDATE_STATUS = "1";
		}//if(date('Gi') >= $fRet["0"]){
	}//if(date('Ymd') >= $fRet["1"]){

}//if(file_exists(VAR_DIR_FILES."files/update/update.fai")){
//verifica se exite arquivo de update em andamento ---------------------------------------------------------------------- <<<

//ações do retorno ++++++++++++++++++++++++++++++++
//se nao tem ação nem uma, e tem update, poe no aviso
if(((!isset($INC_REDIRECT_OFF)) and (!isset($INC_UPDATE_AVISO))) and ($UPDATE_STATUS == "1")){ echo "<script>window.location='".SYS_URLRAIZ."update/';</script>"; exit(0); }
	
//se está no aviso e finalizou o update volta para o sistema
if((isset($INC_UPDATE_AVISO)) and ($UPDATE_STATUS == "0")){ echo "<script>window.location='".SYS_URLRAIZ."';</script>"; exit(0); }//se estiver na tela de update e não exite update, redireciona



?>