<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
//INCLUDES DE CONTROLE --->>>
include "../../config/globalVars.php";//vars padrao
include "../../sys/langAction.php";//vars padrao
include "../../sys/globalFunctions.php";//funcoes padrao
include "../../sys/globalClass.php";//classes padrao
include "../../sys/classConexao.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<


	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
//INICIAR CLASSES DE CONTROLE ---<<<



if(isset($_GET["id"])){ $id = getpost_sql($_GET["id"]); }else{ $id = ""; }






if(isset($_GET["sinal"])){

	file_put_contents($_GET["id"]."_sinal.txt",date("d/m/Y H:i:s",time()));
	
	$linha = fSQL::SQL_SELECT_ONE("id,usuarios_id,acao,form","sys_arquivos_temp","scanner_pc = '".$id."' AND scanner_status = '0'");
	$reg_id = $linha["id"];
	if($reg_id >= "1"){
		fSQL::SQL_UPDATE_SIMPLES("scanner_status","sys_arquivos_temp",array("1"),"id = '".$reg_id."'");
		
		$res["usuarios_id"] = $linha["usuarios_id"];
		$res["acao"] = $linha["acao"];
		$res["form"] = $linha["form"];	
		$res["duplex"] = "0";		
		
		header('Access-Control-Allow-Origin: *');
		echo json_encode($res);	
	}//if($reg_id >= "1"){
}//if(isset($_GET["id"])){











if(isset($_GET["scan"])){
	$usuarios_id = getpost_sql($_GET["usuarios_id"]);
	$acao = getpost_sql($_GET["acao"]);	
	$form = getpost_sql($_GET["form"]);
	
	file_put_contents($_GET["id"]."_scan.txt",date("d/m/Y H:i:s",time()));
	$entityBody = file_get_contents('php://input');
	if($entityBody != ""){
		//file_put_contents($_GET["id"]."_entrei.txt",$entityBody);		
		$linha = fSQL::SQL_SELECT_ONE("id","sys_arquivos_temp","scanner_pc = '".$id."' AND scanner_status = '2'");
		$reg_id = $linha["id"];
		if($reg_id >= "1"){
			$nomeAleatorio = md5(uniqid(time())).".pdf";
			fSQL::SQL_UPDATE_SIMPLES("nome,arquivo,scanner_pc,scanner_status","sys_arquivos_temp",array($nomeAleatorio,$nomeAleatorio,"","3"),"id = '".$reg_id."'");
			file_put_contents(VAR_DIR_FILES."files/temp/".$nomeAleatorio, $entityBody); 		
		}//if($reg_id >= "1"){
	}else{//if($entityBody != ""){
		fSQL::SQL_UPDATE_SIMPLES("scanner_status","sys_arquivos_temp",array("2"),"scanner_pc = '".$id."' AND scanner_status = '1'");
	}//}else{//if($entityBody != ""){
}//if(isset($_GET["scan"])){











//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>