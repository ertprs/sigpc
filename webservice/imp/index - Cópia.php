<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "../../../config/globalVars.php";//vars padrao
include "../../../sys/globalFunctions.php";//funcoes padrao
include "../../../sys/globalClass.php";//classes padrao
include "../../../sys/classConexao.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<


	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
//INICIAR CLASSES DE CONTROLE ---<<<





header('Access-Control-Allow-Origin: *');

$res["senha"] = "H0001";
$res["nome"] = "BRENO";
$res["data"] = date("d/m/Y H:i",time());
$res["prioridade"] = "NORMAL";
echo json_encode($res);





//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>