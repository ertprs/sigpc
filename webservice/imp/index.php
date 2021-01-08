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










if(isset($_GET["id"])){
	$id = getpost_sql($_GET["id"]);
	
	file_put_contents($_GET["id"].".txt",date("d/m/Y H:i:s",time()));
	
	$linha = fSQL::SQL_SELECT_ONE("id,senha,senha_prioridade,candidato_fisico_id,nome,time","axl_triagem","senha_imp = '".$id."'");
	$reg_id = $linha["id"];
	if($reg_id >= "1"){
		$senha = $linha["senha"];	
		$candidato_fisico_id = $linha["candidato_fisico_id"];	
		$nome = $linha["nome"];			
		$time = $linha["time"];	
		$senha_prioridade = $linha["senha_prioridade"];	
		fSQL::SQL_UPDATE_SIMPLES("senha_imp","axl_triagem",array(""),"id = '".$reg_id."'");

		if($candidato_fisico_id >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("nome","cad_candidato_fisico","id = '$candidato_fisico_id'");
			$nome = $linha["nome"];
		}//if($candidato_fisico_id >= "1"){
		
		$res["senha"] = $senha;
		$res["nome"] = $nome;
		$res["data"] = date("d/m/Y H:i",$time);
		$res["prioridade"] = legPrioridade($senha_prioridade);
		
		header('Access-Control-Allow-Origin: *');
		echo json_encode($res);	
	}//if($reg_id >= "1"){
}//if(isset($_GET["id"])){












//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>