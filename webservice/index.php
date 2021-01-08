<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
if(!isset($PROTEGE_INCLUDE)){ echo "Opss... erro no URL! Acesse www.axlsolution.com.br"; exit(0); }
//INCLUDES DE CONTROLE --->>>
include "../../config/globalSession.php";//inicia sessao php
include "../../config/globalVars.php";//vars padrao
include "../../sys/langAction.php";//vars padrao
include "../../sys/globalFunctions.php";//funcoes padrao
include "../../sys/globalClass.php";//classes padrao
include "../../sys/classConexao.php";//classes de conexao
include "../../sys/incUpdate.php";//verificador de updates
include "../../config/incPacote.php";//vars do pacote de cliente
//include "../sys/classValidaAcesso.php";//classes de validação de acesso
//INCLUDES DE CONTROLE ---<<<


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<	

//pega a pasta de solicitação
$d = explode("webservice/", $_SERVER['REQUEST_URI']); $c = explode("/", $d["1"]); $INCLUDE = $c["0"]; unset($c,$d);
//verifica lista de INCLUDE para o web service
$CLASS_INCLUDE = "";
if($INCLUDE == "gatewaysms"){ 	$CLASS_INCLUDE = "../classes/class.gatewaysms.php";					 }//verifica se é: gatewaysms
if($INCLUDE == "portalrm"){ 	$CLASS_INCLUDE = "../classes/class.portalrm.php";					 }//verifica se é: portal rm
if($INCLUDE == "interface"){ 	$CLASS_INCLUDE = "../classes/class.interface.php";					 }//verifica se é: interface

//se não carregou include, para execução
if($CLASS_INCLUDE == ""){ echo "Opss... página não existe! Acesse www.axlsolution.com.br"; exit(0); }


//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
ini_set('memory_limit', '512M'); //max size



	
//INICIAR CLASSES DE CONTROLE --->>>
//conexao DB
$classe_db = new classe_DB;//inicia a classe de conexao
$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
$cMSG = new classMSG();//inicia a classe de mensagens
//INICIAR CLASSES DE CONTROLE ---<<<






 
//################################### function login ####################################>>>>
function verLogin($classe_db,$INCLUDE){
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
		header('WWW-Authenticate: Basic realm="Informe seu ID e senha de acesso!"');
		header('HTTP/1.0 401 Unauthorized');
		echo 'Opss... página não autenticada! Acesse www.axlsolution.com.br';
		exit(0);
	}else{
		//dados de variaveis
		$ini_ip = getpost_sql($_SERVER['REMOTE_ADDR']);
		$ini_login = getpost_sql($_SERVER['PHP_AUTH_USER']);
		$ini_senha = getpost_sql($_SERVER['PHP_AUTH_PW']);
		$valida = "1"; $msg = "";
		
		//verifica se está com ip no bloqueio  -------------------------------------
		$cont_ip = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,bloq_cont,bloq_time,bloqueio", "sys_webservice_bloq", "bloq_ip LIKE '".$ini_ip."'", "", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$bloq_id = $linha1["id"];
			$bloq_cont = $linha1["bloq_cont"];
			$bloq_time = $linha1["bloq_time"];
			$bloqueio = $linha1["bloqueio"];
			$cont_ip++;
		}//fim while
		if($cont_ip >= "1"){
			//limpa bloqueios
			//exclue o registro
			$limpa_time = time()-21600;
			$tabela = "sys_webservice_bloq";
			$condicao = "bloqueio <= '$limpa_time' AND bloqueio != '1' LIMIT 30";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
			if($bloqueio >= "10"){ $msg = "Seu IP($ini_ip) foi bloqueado! Entre em contato com equipe TI!"; $valida = "0"; }
			if(($bloq_time >= time()) and ($valida == "1")){ $msg = "IP($ini_ip) bloqueado por 24hs, utrapassou tentativas de login! Entre em contato com equipe TI!"; $valida = "0"; }
			if($valida == "1"){
				$arrLogin = loginSenha($ini_login,$ini_senha,$INCLUDE);
				if($arrLogin["valida"] == "0"){
					$msg = "IP($ini_ip) bloqueado por 2 minutos, utrapassou tentativas de login! Entre em contato com equipe TI!"; $valida = "0";
					$bloq_cont++;
					if($bloq_cont >= "3"){ $bloq_time = time()+120; }
					if($bloq_cont >= "15"){ $bloqueio = time(); }
					//atualiza dados da tabela no DB
					$campos = "bloq_cont,bloq_time,bloqueio";
					$tabela = "sys_webservice_bloq";
					$valores = array($bloq_cont,$bloq_time,$bloqueio);
					$condicao = "id='$bloq_id'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				}//if(loginSenha($acesso_id,$acesso_senha,$INCLUDE) != "1"){
			}//if($valida == "1"){
		}else{//if($cont_ip >= "1"){
			$arrLogin = loginSenha($ini_login,$ini_senha,$INCLUDE);
			if($arrLogin["valida"] == "0"){
				$msg = "Dados de autenticação inválidos!"; $valida = "0";
				//VARS insert simples SQL
				$tabela = "sys_webservice_bloq";
				//busca ultimo id para insert
				$id_b = fSQL::SQL_SELECT_INSERT($tabela, "id");
				$campos = "id,webservice_id,bloq_ip,bloq_cont,bloq_time,bloqueio";
				$valores = array($id_b,$arrLogin["id"],$ini_ip,"1",time(),"1");
				$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			}//if(loginSenha($acesso_id,$acesso_senha,$INCLUDE) != "1"){
		}//else{//if($cont_ip >= "1"){
		
		//retorno de validação
		if($valida != "1"){
			unset($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);
			header('WWW-Authenticate: Basic realm="Informe seu ID e senha de acesso, corretamente!');
			header('HTTP/1.0 401 Unauthorized');
			echo "Opss... $msg <br>Dúvidas acesse www.axlsolution.com.br";
			//REMOVE CONEXAO
			//fecha todas as conexoes abertas
			$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
			exit(0);
		}else{//if($valida != "1"){
			if($cont_ip >= "1"){
				//exclue o registro
				$tabela = "sys_webservice_bloq";
				$condicao = "id = '$bloq_id'";
				$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			}//if($cont_ip >= "1"){
		}//else{//if($valida != "1"){
	}
}//verLogin
function loginSenha($acesso_id,$acesso_senha,$INCLUDE){
	$cont_l = "0"; $arrRet["valida"] = "0"; $arrRet["id"] = "0";
	if($INCLUDE == "interface"){//verifica se é: interface
		if(SYS_WS_ID == $acesso_id){
			$id_i = SYS_WS_ID;
			$tabela_id_i = "0";
			$integrador_id_i = "1";
			$acesso_senha_i = SYS_WS_SENHA;		
			$ip_cliente_i = SYS_WS_IP;		
			$arrRet["id"] = SYS_WS_ID;
			$cont_l++;
		}//if(SYS_WS_ID == $acesso_id){
	}else{//if($INCLUDE == "interface"){
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,tabela_id,integrador_id,acesso_senha,ip_cliente", "sys_webservice", "acesso_id = '".$acesso_id."' AND time_expira >= '".time()."' AND status = '1'", "", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$id_i = $linha1["id"];
			$tabela_id_i = $linha1["tabela_id"];
			$integrador_id_i = $linha1["integrador_id"];
			$acesso_senha_i = $linha1["acesso_senha"];		
			$ip_cliente_i = $linha1["ip_cliente"];		
			$arrRet["id"] = $id_i;
			$cont_l++;
		}//fim while
	}//else{//if($INCLUDE == "interface"){
	if(($cont_l >= "1") and ($acesso_senha != "")){
		if($ip_cliente_i != ""){ if($ip_cliente_i != $_SERVER['REMOTE_ADDR']){ $acesso_senha_i = "ON"; $acesso_senha = "OFF"; }}
		if($acesso_senha_i == $acesso_senha){
			$arrRet["valida"] = "1";
			define("SYS_WEBSERVICE_ID", $id_i);
			define("SYS_WEBSERVICE_CHAVE", $acesso_id);
			define("SYS_WEBSERVICE_TABELA_ID", $tabela_id_i);
			define("SYS_WEBSERVICE_CLIENTE", $integrador_id_i);
		}
	}	
	return $arrRet;
}//loginSenha
//################################### function login ####################################<<<<


















//inport classe de INCLUDE - Nome padrão da classe é: classSoap
require_once($CLASS_INCLUDE);
 

// chamada do método para atender as requisição do serviço 
// se a chamada for um POST executa, senão apenas mostra as funções “cadastradas”
if($_SERVER["REQUEST_METHOD"]== "POST"){
	//criação de uma instância do servidor (coloque o endereço na sua máquina local)
	$SOAP_SERVER = new SoapServer(null, array('uri' => SYS_URLRAIZ."webservice/".$INCLUDE."/",'encoding'=>'ISO-8859-1'));  // ex.: http://localhost/seusite/soap/
	
	
	
	//#### executa login ##>>>
	verLogin($classe_db,$INCLUDE);
	
	
	
	
	
	//################################### retorno e criação do webservice ####################################>>>>
	$SOAP_SERVER->setClass("classSoap");//registro do serviço - CLASSES PUBLICADAS NO WEBSERVICE
	$SOAP_SERVER->handle();
}else{//if($_SERVER["REQUEST_METHOD"]== "POST"){


	//#### executa login ##>>>
	verLogin($classe_db,$INCLUDE);

	/*/ Initialize the PhpWsdl class
	require_once('../php-wsdl/class.phpwsdl.php');
	$soap=PhpWsdl::CreateInstance(
		null,								// PhpWsdl will determine a good namespace
		null,								// Change this to your SOAP endpoint URI (or keep it NULL and PhpWsdl will determine it)
		'../php-wsdl/cache',					// Change this to a folder with write access
		Array(								// All files with WSDL definitions in comments
			$CLASS_INCLUDE					//'classes/class.classSoap.php'
		),
		null,								// The name of the class that serves the webservice will be determined by PhpWsdl
		null,								// This demo contains all method definitions in comments
		null,								// This demo contains all complex types in comments
		false,								// Don't send WSDL right now
		false);								// Don't start the SOAP server right now
	
	// Disable caching for demonstration
	ini_set('soap.wsdl_cache_enabled',0);	// Disable caching in PHP
	PhpWsdl::$CacheTime=0;					// Disable caching in PhpWsdl
	
	// Run the SOAP server
	if($soap->IsWsdlRequested())			// WSDL requested by the client?
		$soap->Optimize=false;				// Don't optimize WSDL to send it human readable to the browser
	//$soap->ParseDocs=false;				// Uncomment this line to disable the whole documentation features
	//$soap->IncludeDocs=false;				// Uncomment this line to disable writing the documentation in WSDL XML
	//$wsdl=$soap->CreateWsdl();			// This would save the WSDL XML string in $wsdl
	//$php=$soap->OutputPhp(false,false);	// This would save a PHP SOAP client as PHP source code string in $php
	//$html=$soap->OutputHtml(false,false);	// This would save the HTML documentation string in $html
	$soap->RunServer();	//*/

	
	
}//else{//if($_SERVER["REQUEST_METHOD"]== "POST"){











//REMOVE CONEXAO
//fecha todas as conexoes abertas
$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
?>