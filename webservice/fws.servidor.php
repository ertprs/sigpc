<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
if(!isset($PROTEGE_INCLUDE)){ echo "Opss... erro no URL! sem conteudo..."; exit(0); }
//INCLUDES DE CONTROLE --->>>
include "../../config/globalSession.php";//inicia sessao php
include "../../config/globalVars.php";//vars padrao
include "../../sys/langAction.php";//vars padrao
include "../../sys/globalFunctions.php";//funcoes padrao
include "../../sys/globalClass.php";//classes padrao
include "../../sys/classConexao.php";//classes de conexao
include "../../sys/incUpdate.php";//verificador de updates
//include "../sys/classValidaAcesso.php";//classes de validação de acesso
//INCLUDES DE CONTROLE ---<<<

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<	


if(isset($_POST["fws_id"])){ $P_fws_id = (int)getpost_sql($_POST["fws_id"]); }else{ $P_fws_id = "0"; }//recebe ID de localização dos dados no servidor
if(isset($_POST["bloco_de_dados"])){ $P_bloco_de_dados = trim($_POST["bloco_de_dados"]); }else{ $P_fws_id = "0"; }//recebe string de tratamento
$P_ip = $_SERVER['REMOTE_ADDR'];//IP do servidor solicitante/cliente
$P_valida = "0"; $P_include = ""; $P_msg = "";
if($P_fws_id >= "1"){// P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id >>>
	$P_valida = "1";
	//INICIAR CLASSES DE CONTROLE --->>>
	//conexao DB
	$classe_db = new classe_DB;//inicia a classe de conexao
	$classe_db->AbreConexaoPai();//Abrimos a conexão Pai
	$cMSG = new classMSG();//inicia a classe de mensagens
	//INICIAR CLASSES DE CONTROLE ---<<<
		
			
	
	
	
	

	//verifica se está com ip no bloqueio ....................................................................................................
	$cont_ipbloq = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,bloq_cont,bloq_time,bloqueio", "sys_webservice_fws_bloq", "bloq_ip LIKE '".$P_ip."'", "", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$bloq_id = $linha1["id"];
		$bloq_cont = $linha1["bloq_cont"];
		$bloq_time = $linha1["bloq_time"];
		$bloqueio = $linha1["bloqueio"];
		$cont_ipbloq++;
	}//fim while
	if($cont_ipbloq >= "1"){
		//limpa bloqueios temporal
		if(($bloq_time <= time()) and ($bloq_time != "0")){
			//exclue o registro
			$tabela = "sys_webservice_fws_bloq";
			$condicao = "id = '$bloq_id' AND bloqueio = '0'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			$bloq_time = "0";
		}//if($bloq_time <= time()){
		if($bloqueio >= "1"){ $P_msg = "Seu IP($P_ip) foi bloqueado! Entre em contato com equipe TI!"; $P_valida = "0"; }
		if(($bloq_time >= time()) and ($P_valida == "1")){ $P_msg = "IP($P_ip) bloqueado por 24hs, utrapassou tentativas de login! Entre em contato com equipe TI!"; $P_valida = "0"; }
	}//if($cont_ipbloq >= "1"){

	
	//verifica id fWS ........................................................................................................................
	if($P_valida == "1"){
		$cont_ws = "0";
		//verifica conexão com whats
		if(SYS_WHATS_FWSID == $P_fws_id){
			$cliente_login = SYS_WHATS_LOGIN;
			$cliente_senha = SYS_WHATS_SENHA;
			$cliente_chave = SYS_WHATS_CHAVE;
			$cliente_ip = SYS_WHATS_IP;
			$acesso_metodos = SYS_WHATS_METODOS;
			$P_include = "whats";
			define("SYS_WEBSERVICE_FWS_ID", $P_fws_id);
			//verifica informações de acesso
			$P_valida = "1";
			$cont_ws++;
			if(($cliente_ip != "") and ($cliente_ip != "NULL")){ if($cliente_ip != $P_ip){ $P_valida = "0"; }}//verifica se o acesso é de um ip autorizado
			if($P_valida == "1"){
				if($cliente_chave == ""){ define("SYS_WEBSERVICE_CHAVE", "0"); define("SYS_WEBSERVICE_METODOS", "FULL"); }else{
					define("SYS_WEBSERVICE_CHAVE", $cliente_chave);
					define("SYS_WEBSERVICE_METODOS", $acesso_metodos);
					$crypter = new fCriptoJs(SYS_WEBSERVICE_CHAVE);
					//DESCRIPTAR
					$P_bloco_de_dados = $crypter->Decrypt($P_bloco_de_dados);
				}
				$P_jsonArr = json_decode($P_bloco_de_dados, true);
			}//if($P_valida == "1"){
			$P_msg = "OK: ".$P_bloco_de_dados;
			//file_put_contents("../DEBUG-OK-".time().".txt","TESTE: ".$P_msg);
		}else{//if(SYS_WHATS_FWSID == $P_fws_id){	
			//verifica lista de base de dados
			$resu1 = fSQL::SQL_SELECT_SIMPLES("acesso_login,acesso_senha,acesso_chave,acesso_ip,acesso_metodos", "sys_webservice_fws", "id = '".$P_fws_id."' AND time_expira >= '".time()."' AND status = '1'", "", "1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$cliente_login = $linha1["acesso_login"];
				$cliente_senha = $linha1["acesso_senha"];
				$cliente_chave = $linha1["acesso_chave"];
				$cliente_ip = $linha1["acesso_ip"];
				$acesso_metodos = $linha1["acesso_metodos"];
				define("SYS_WEBSERVICE_FWS_ID", $P_fws_id);
				//verifica informações de acesso
				$P_valida = "1";
				$cont_ws++;
				if(($cliente_ip != "") and ($cliente_ip != "NULL")){ if($cliente_ip != $P_ip){ $P_valida = "0"; }}//verifica se o acesso é de um ip autorizado
				if($P_valida == "1"){
					if($cliente_chave == ""){ define("SYS_WEBSERVICE_CHAVE", "0"); define("SYS_WEBSERVICE_METODOS", "FULL"); }else{
						define("SYS_WEBSERVICE_CHAVE", $cliente_chave);
						define("SYS_WEBSERVICE_METODOS", $acesso_metodos);
						$crypter = new fCriptoJs(SYS_WEBSERVICE_CHAVE);
						//DESCRIPTAR
						$P_bloco_de_dados = $crypter->Decrypt($P_bloco_de_dados);
					}
					$P_jsonArr = json_decode($P_bloco_de_dados, true);
				}//if($P_valida == "1"){
				$P_msg = "OK: ".$P_bloco_de_dados;
			}//while	
		}//else{//if(SYS_WHATS_FWSID == $P_fws_id){
		if($cont_ws == "0"){ $P_valida = "0"; }//se nao encontrou web service, desliga a validação	
		//valida os dados recebidos  .............................................................................................................
		if(($cliente_login == $P_jsonArr["login"]) and ($cliente_senha == $P_jsonArr["senha"]) and ($P_valida == "1")){
			$P_metodo = $P_jsonArr["metodo"];
			$P_metodoArr = $P_jsonArr["dados_do_metodo"];
			unset($P_jsonArr);//destroe array com senhas etc
			//pega a pasta de solicitação
			$d = explode("webservice/", $_SERVER['REQUEST_URI']); $c = explode("/", $d["1"]); $INCLUDE = $c["0"]; unset($c,$d);
			$FUNCTIONS_INCLUDE = "";
			//verifica lista de INCLUDE para o web service ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
			if($INCLUDE == "sms"){ 										$FUNCTIONS_INCLUDE = "../functions/functions.sms.php";				 }//verifica se é: sms
			//verifica lista de INCLUDE para o web service ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ <<<
			//verifica lista de INCLUDE para o web service ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
			if($INCLUDE == "dados"){ 									$FUNCTIONS_INCLUDE = "../functions/functions.dados.php";			 }//verifica se é: dados
			//verifica lista de INCLUDE para o web service ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ <<<
			//se não carregou include, para execução
			if($FUNCTIONS_INCLUDE == ""){ $P_valida = "0"; }
		}else{ $P_valida = "0"; }
	}//if($P_valida == "1"){
	
	//monta bloqueio temporal de ip caso não tenha validação ...................................................................................
	if($P_valida == "0"){
		if($cont_ipbloq >= "1"){
			$bloq_cont++;
			$P_msg = "Dados de acesso incorretos! Entre em contato com equipe TI! (SE CONTINUAR TENTANDO VAMOS BLOQUEAR)";
			//atualiza dados da tabela no DB
			$tabela = "sys_webservice_fws_bloq";
			$campos = "bloq_cont";
			$valores = array($bloq_cont);
			if($bloq_cont > "3"){
				$campos .= ",bloq_time"; $valores[] = time()+120;
				$P_msg = "IP($P_ip) bloqueado por 2 minutos, utrapassou tentativas de login! Entre em contato com equipe TI! (SE CONTINUAR TENTANDO VAMOS BLOQUEAR)";
			}
			if($bloq_cont > "10"){ $campos .= ",bloqueio"; $valores[] = time(); $P_msg = "ACESSO BLOQUEADO! ".date('d/m/Y H:i:s'); }
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$bloq_id'");
		}else{//if($cont_ipbloq >= "1"){
			//$P_msg = "Dados de autenticação inválidos!";
			//VARS insert simples SQL
			$tabela = "sys_webservice_fws_bloq";
			//busca ultimo id para insert
			$id_b = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,webservice_id,bloq_ip,bloq_cont,bloq_time,bloqueio";
			$valores = array($id_b,$P_fws_id,$P_ip,"1","0","0");
			fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		}//else{//if($cont_ipbloq >= "1"){

	}//if($P_valida == "0"){
	
	
	
	
	
	
	if($P_valida == "1"){// valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - >>>
		ini_set('memory_limit', '1024M'); //max size 32m
		if(isset($_GET["debug"])){ echo "<br>-metodo: $P_metodo<br>-jsonArr:<pre>"; print_r($P_jsonArr);  echo "</pre>"; }
		//FUNÇÃO QUE CALCULA TAMANHO DA STRING DE RETORNO: RETORNANDO 1 SE ULTRAPASSOU O LIMITE
		function fWS_tmLimite($bytes){
			$val = $bytes;
			if(SYS_WEBSERVICE_CHAVE != "0"){ $val = $bytes*2.7; }//monta proporção para valor final criptografado
			if(SYS_WEBSERVICE_COMPRESS == "gz"){ $val = $bytes*1.9; }//monta proporção para valor final compactado e criptografado
			if(SYS_WEBSERVICE_COMPRESS == "deflate"){ $val = $bytes*1.9; }//monta proporção para valor final compactado e criptografado
			if($val > "36500000"){ return 1; }else{ return 0; }//VALIDA O TAMANHO FINAL DA STRING PARA GET - 35Mb
		}//fWS_tmLimite
		

		
		//funções do fWS.........................................................................................................................
		//FUNÇÃO QUE MONTA RECEBIMENTO DE FILE
		function fWS_getFile($DADOS){
			$DADOS = base64_decode($DADOS);	
			if((isset($_POST["gz"])) and ($_POST["gz"] == "1")){ $DADOS = gzuncompress($DADOS); }//verifica se é pra descompactar
			if((isset($_POST["deflate"])) and ($_POST["deflate"] == "1")){ $DADOS = gzinflate($DADOS); }//verifica se é pra descompactar	
			return $DADOS;
		}//fWS_getFile
		//FUNÇÃO QUE MONTA ENVIO DE FILE
		function fWS_sendFile($DADOS){
			if((isset($_POST["gz"])) and ($_POST["gz"] == "1")){ $DADOS = gzcompress($DADOS); }//verifica se é pra descompactar
			if((isset($_POST["deflate"])) and ($_POST["deflate"] == "1")){ $DADOS = gzdeflate($DADOS); }//verifica se é pra descompactar
			$DADOS = base64_encode($DADOS);	
			return $DADOS;
		}//fWS_sendFile
		
		//FUNÇÃO QUE MONTA RETORNO DOS DADOS
		function fWS_retDados($DADOS,$CONT_GET,$CONT_SEND){
			if(isset($_GET["debug"])){ echo "<br>-DADOS:<pre>"; print_r($DADOS);  echo "</pre>"; exit(0); }
			//atualiza dados da tabela no DB
			$campos = "t_sync";
			$tabela = "sys_webservice_fws";
			$valores = array(time());
			if($CONT_GET >= "1"){ $campos .= ",t_get"; $valores[] = time(); }
			if($CONT_SEND >= "1"){ $campos .= ",t_send"; $valores[] = time(); }
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='".SYS_WEBSERVICE_FWS_ID."'");
			//monta array monta json encode
			$ret = json_encode($DADOS);
			//verifica a aplicação de criptografia
			if(SYS_WEBSERVICE_CHAVE != "0"){
				$crypter = new fCriptoJs(SYS_WEBSERVICE_CHAVE);
				//ENCRIPTAR
				$ret = $crypter->Encrypt($ret);
			}//if(SYS_WEBSERVICE_CHAVE != "0"){	
			//libera acesso de outra URL
			header('Access-Control-Allow-Origin: *');
			echo $ret;	
		}//fWS_retDados
		//INCLUDE DE FUNÇÕES PARA METODOS
		include $FUNCTIONS_INCLUDE;
	}//if($P_valida == "1"){valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - valida - <<<
	
	
	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes	
}//if($P_fws_id >= "1"){P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id - P_fws_id <<<

//ATIVA MENSAGEM AREA PROTEGIDA
if($P_valida != "1"){
	if($P_msg != ""){
		echo "ERRO: ".$P_msg;
	}else{//if($P_msg != ""){
		header('WWW-Authenticate: Basic realm="Sem acesso externo!"');
		header('HTTP/1.0 401 Unauthorized');
		echo 'Opss... ACESSO RESTRITO, LINK NAO TEM ACESSO EXTERNO, OBRIGADO!';
		exit(0);
	}//else{//if($P_msg != ""){
}








