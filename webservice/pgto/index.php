<?php 
//INCLUDES DE CONTROLE --->>>
include "../../config/globalVars.php";//vars padrao
include "../../sys/globalFunctions.php";//funcoes padrao
include "../../sys/globalClass.php";//classes padrao
include "../../sys/classConexao.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<









//FUNÇÃO QUE MONTA RETORNO DOS DADOS
function fWS_retDados($DADOS,$CONT_GET,$CONT_SEND){
	//monta array monta json encode
	$ret = json_encode($DADOS);

	//libera acesso de outra URL
	header('Content-Type: application/json; charset=utf-8');
	header('Access-Control-Allow-Origin: *');
	echo "teste";
	echo $ret;	
}//fWS_retDados
//funções do fWS.........................................................................................................................




$entityBody = file_get_contents('php://input');


//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);

$P_metodo = "sync";
$P_metodoArr = json_decode($entityBody, true);

if($entityBody != ""){
	file_put_contents(date("Y-m-d_H-i-s",time()).".txt",json_encode($entityBody));
	//INICIAR CLASSES DE CONTROLE --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	//INICIAR CLASSES DE CONTROLE ---<<<	
	
	//INCLUDE - Nome padrão
	require_once("../functions/functions.pgto.php");
	
	
	
	
	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes		
	
}//if($entityBody != ""){









?>