<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//INCLUDES DE CONTROLE --->>>
include "config/globalSession.php";//inicia sessao php
include "config/globalVars.php";//vars padrao
include "sys/langAction.php";//vars padrao
include "sys/globalFunctions.php";//funcoes padrao
include "sys/globalClass.php";//classes padrao
include "sys/classConexao.php";//classes de conexao
include "sys/incUpdate.php";//verificador de updates
include "config/incPacote.php";//vars do pacote de cliente
include "sys/classValidaAcesso.php";//classes de validação de acesso
//include "sys/cabecalho_ajax.php";//classes de conexao
//INCLUDES DE CONTROLE ---<<<


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

	
//FUNCOES INICIAIS --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
//FUNCOES INICIAIS ---<<<




//CLASSES PROTEGE PAGINA/LOGIN --->>>
//protege a pagina
$cVLogin = new classVLOGIN;//inicia a classe de login
$cVLogin->loginCookie();//verifica o login e cria array de login
$cVLogin->loginSession("down");//faz a atualização de session do login atual
//CLASSES PROTEGE PAGINA/LOGIN ---<<<



$ativa_bloqueia = "0"; //desativa bloqueio
if(isset($_GET['zip'])){
	$zip_id = getpost_sql($_GET["zip"]);
	//verifica se existe o id ligado ao usuario
	$cont = "0";
	$resu = fSQL::SQL_SELECT_SIMPLES("zip", "sys_download_zip_temp", "id = '".$zip_id."' AND user_id = '".$cVLogin->userId()."'", "", "1");
	while($linha = fSQL::FETCH_ASSOC($resu)){				
		//exclue o arquivo
		$n_file = VAR_DIR_FILES."files/temp/".$linha["zip"];
		$cont++;
	}//fim while fetch
	if($cont == "0"){ echo "Arquivo ZIP nao localizado...<br>"; $ativa_bloqueia .= "-zip"; }//desativa abertura se nao localizado


}else{//if(isset($_GET['zip'])){
	//url do arquivo
	$n_file = $_GET['f']; //deve enviar assim : cripto_faisher("../caminho/", "enc"); - file
	
	//descriptografa
	$n_file = fGERAL::cptoFaisher($n_file, "des");//descodifica
	$n_arquivo = fGERAL::cptoFaisher($n_arquivo, "des");//descodifica
		
	
	$array_validar = $_GET['i']; //deve enviar assim : cripto_faisher($SYS_ID."[,]".time().rand(), "enc");
	$array_validar = fGERAL::cptoFaisher($array_validar, "des");//descodifica
	$d = explode("[,]", $array_validar);
	if($d["0"] != $cVLogin->getVarLogin("SYS_USER_ID")){ $ativa_bloqueia .= "-user"; }
	if($d["1"] >= "1"){ }else{ $ativa_bloqueia .= "-cont"; }

}//else{//if(isset($_GET['zip'])){

//verifica se exsite bloqueio
if(strtolower(strrchr($n_file, ".")) == "php"){ $ativa_bloqueia .= "-php"; }
if($ativa_bloqueia != "0"){
	echo "Ops... algo errado!";
	exit(0);
}

//recebe informações do nome a gerar do arquivo
$n_nome = $_GET['n']; //nao e encriptada - nome do novo arquivo que sera gerado


//verifica se o nome esta vazio - se estiver, nao encontra o arquivo
if($n_file == ""){ $n_caminho = ""; $n_arquivo = ""; }


//verifica se o arquivo existe --- ###########################
if(file_exists($n_file)){//verifica se existe
	$type = filetype($n_file);
	$size = filesize($n_file);
	
	//se for um arquivo PHP, cancela o download
	$extensao =  fGERAL::mostraExtensao($n_file);
	if($extensao == "php"){ exit(0); }
	
	//monta o arquivo
	header("Content-Description: File Transfer");
	header("Content-Type:$type");
	header("Content-Lenght:$size");
	header("Content-Disposition: attachment; filename=\"$n_nome\"");
	readfile($n_file);
}//verifica se existe o arquivo



//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
