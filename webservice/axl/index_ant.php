<?php 
//INCLUDES DE CONTROLE --->>>
include "../../config/globalVars.php";//vars padrao
include "../../sys/globalFunctions.php";//funcoes padrao
include "../../sys/globalClass.php";//classes padrao
include "../../sys/classConexao.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<


//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
$cMSG = new classMSG();//inicia a classe de mensagens
//INICIAR CLASSES DE CONTROLE ---<<<






//FUNÇÃO QUE MONTA RETORNO DOS DADOS
function fWS_retDados($DADOS,$CONT_GET,$CONT_SEND){
	//monta array monta json encode
	$ret = json_encode($DADOS);

	//libera acesso de outra URL
	header('Access-Control-Allow-Origin: *');
	echo $ret;	
}//fWS_retDados
//funções do fWS.........................................................................................................................



file_put_contents(date("Y-m-d_H-i-s",time()).".txt",json_encode($_POST));


$P_metodo = "";
if(isset($_POST["metodo"])){ $P_metodo = trim($_POST["metodo"]); }else{ $P_metodo = ""; }//recebe string de tratamento
if($P_metodo != ""){

	$P_dados = $_POST["dados_do_metodo"];
	$P_metodoArr = json_decode($P_dados, true);

	//INCLUDE - Nome padrão
	require_once("../functions/functions.axl.php");
}//if($P_bloco_de_dados != ""){






//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes	

?>