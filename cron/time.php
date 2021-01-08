<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);



//INCLUDES DE CONTROLE --->>>
include "../config/globalSession.php";//inicia sessao php
include "../config/globalVars.php";//vars padrao
include "../sys/langAction.php";//vars padrao
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);//ATIVA ERRSO GERAL
//VERIFICA UPDATE DE FILES - ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE -->>>
$INC_REDIRECT_OFF = "ON";
include "../sys/incUpdate.php";//verificador de updates
if($UPDATE_STATUS == "1"){
	//exclue os arquivos já executados
	if(file_exists(VAR_DIR_FILES."files/update/updateFilesDel.DEL")){ unlink(VAR_DIR_FILES."files/update/updateFilesDel.DEL"); unlink(VAR_DIR_FILES."files/update/updateFilesDel.php"); }
	if(file_exists(VAR_DIR_FILES."files/update/updateFiles.DEL")){ unlink(VAR_DIR_FILES."files/update/updateFiles.DEL"); unlink(VAR_DIR_FILES."files/update/updateFiles.php"); }
	//executa as rotinas de update disponíveis
	if(file_exists(VAR_DIR_FILES."files/update/updateFilesDel.php")){ include VAR_DIR_FILES."files/update/updateFilesDel.php"; echo "APLICACAO-DEL"; exit(0); }// Update - Files Del
	if(file_exists(VAR_DIR_FILES."files/update/updateFiles.php")){ include VAR_DIR_FILES."files/update/updateFiles.php"; echo "APLICACAO"; exit(0); }// Update - Files
	//verifica se exclue o verificador de update
	if((!file_exists(VAR_DIR_FILES."files/update/updateDbIn.php")) and (!file_exists(VAR_DIR_FILES."files/update/updateDb.php")) and (!file_exists(VAR_DIR_FILES."files/update/updateDbOut.php"))){
		unlink(VAR_DIR_FILES."files/update/update.fai");
	}//se não tem update de DB exclue controle de update
}//if($UPDATE_STATUS == "1"){
//VERIFICA UPDATE DE FILES - ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE --<<<

include "../sys/globalFunctions.php";//funcoes padrao
include "../sys/globalClass.php";//classes padrao
include "../sys/classConexao.php";//classes de conexao
//include "../sys/classValidaAcesso.php";//classes de validação de acesso
//INCLUDES DE CONTROLE ---<<<



//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
$cMSG = new classMSG();//inicia a classe de mensagens
//INICIAR CLASSES DE CONTROLE ---<<<


//VERIFICA UPDATE DE BANCO DE DADOS - DB ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE -->>>
if($UPDATE_STATUS == "1"){
	//exclue os arquivos já executados
	if(file_exists(VAR_DIR_FILES."files/update/updateDbIn.DEL")){ unlink(VAR_DIR_FILES."files/update/updateDbIn.DEL"); unlink(VAR_DIR_FILES."files/update/updateDbIn.php"); }//Db IN
	if(file_exists(VAR_DIR_FILES."files/update/updateDb.DEL")){ unlink(VAR_DIR_FILES."files/update/updateDb.DEL"); unlink(VAR_DIR_FILES."files/update/updateDb.php"); }//Db
	if(file_exists(VAR_DIR_FILES."files/update/updateDbOut.DEL")){ unlink(VAR_DIR_FILES."files/update/updateDbOut.DEL"); unlink(VAR_DIR_FILES."files/update/updateDbOut.php");	}//Db OUT
	//executa as rotinas de update disponíveis
	if(file_exists(VAR_DIR_FILES."files/update/updateDbIn.php")){ include VAR_DIR_FILES."files/update/updateDbIn.php"; echo "DB-IN"; exit(0); }// Update - Db IN
	if(file_exists(VAR_DIR_FILES."files/update/updateDb.php")){ include VAR_DIR_FILES."files/update/updateDb.php"; echo "DB"; exit(0); }// Update - Db
	if(file_exists(VAR_DIR_FILES."files/update/updateDbOut.php")){ include VAR_DIR_FILES."files/update/updateDbOut.php"; echo "DB-OUT"; exit(0); }// Update - Db OUT
	if(file_exists(VAR_DIR_FILES."files/update/update.fai")){ unlink(VAR_DIR_FILES."files/update/update.fai"); }//excluir o identificador de update
}//if($UPDATE_STATUS == "1"){
//VERIFICA UPDATE DE BANCO DE DADOS - DB ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE ++ UPDATE --<<<



$SYS_VALIDASEMQUADRO = "JESUS TE AMA!";
set_time_limit(600);//almenta tempo de execução PHP
//if(!isset($_GET["debug"])){ echo "DEBUG"; exit(0);}









//LIMPA LOG CRON DE CONTROLE~~~~~~~~~~~~~~~~~
$time_limpa = time()-1800;//30min
$time_pause = time()-120;//2min
//exclue o registro
$tabela = "sys_cron_log";
$condicao = "( time <= '$time_limpa' ) OR ( time <= '$time_pause' AND timef = '0')";
fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
//LIMPA LOG CRON DE CONTROLE~~~~~~~~~~~~~~~~



//CONFIGURAR O CRONTAB LINUX PRA ECECUTAR DE 1 EM 1 MINUTO
//laço infinito para gestao de minuto a minuto
$CONTROLE_WHILE_CONT = "0"; $CONTROLE_SLEEP = "5";
while($CONTROLE_WHILE_CONT < "4"){
	$CONTROLE_WHILE_CONT++;
	echo "\\n<br> ".$CONTROLE_WHILE_CONT.". ";
	//INCLUDE ### rotinas de time sync
	include "inc/inc_time.php";
	//sleep(2);//pause e retorno de dados
	file_put_contents("TIME",time());
}//fim while




//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
