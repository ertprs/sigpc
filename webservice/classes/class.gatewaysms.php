<?php

if(basename($_SERVER['SCRIPT_FILENAME'])==basename(__FILE__))
	exit;

/**
* Web service de integração SYNC: axlsolution-SMS
* 
* @service classSoap
*/
class classSoap{//SYS_WEBSERVICE_ID - SYS_WEBSERVICE_TABELA_ID - SYS_WEBSERVICE_CHAVE - SYS_WEBSERVICE_CLIENTE
	//verifica se é cliente axlsolution - aplica criptografia com a chave sendo ID
	private function clienteIntegrador($dados,$acao="send"){
		if(SYS_WEBSERVICE_CLIENTE != "0"){
			$dados = fGERAL::webFile($dados,SYS_WEBSERVICE_CHAVE,$acao);//send get
		}
		return $dados;
	}//clienteIntegrador
	
	//informa o status do web service de SYNC
	private function statusWebService($cont_send,$cont_get){
		//atualiza dados da tabela no DB
		$campos = "time";
		$tabela = "sys_webservice";
		$valores = array(time());
		if($cont_send >= "1"){ $campos .= ",time_send"; $valores[] = time(); }
		if($cont_get >= "1"){ $campos .= ",time_get"; $valores[] = time(); }
		$condicao = "id='".SYS_WEBSERVICE_ID."'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	}//statusWebService
	
	
	
	
	
	
	
	/**
	* Metodo de retorno padrao versaoScript
	* Tem a funcao de informar ao web service a versao de seu cliente.
	* @param string $VERSAO_DO_CLIENTE
	* @param string $ACAO
	* @return array Retorno de array com mensagem ou arquivo ou retorno 1
	*/
	public function versaoScript($VERSAO_DO_CLIENTE,$ACAO='ver'){
		$versao_do_cliente = getpost_sql($VERSAO_DO_CLIENTE);
		//atualiza dados da tabela no DB
		$campos = "versao_app,time";
		$tabela = "sys_webservice";
		$valores = array($versao_do_cliente,time());
		$condicao = "id='".SYS_WEBSERVICE_ID."'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		
		//retorno de mensagens
		$result["file"] = "0";
		$result["msg"] = "Atualizado!";
							
		return $result;
	}//versaoScript
	
	
	
	
	
	
	
	/**
	* Metodo de retorno padrao confirmaChave
	* Tem a funcao de confirmação com web service a chave de criptografia de seu cliente.
	* @param string $CHAVE_CLIENTE
	* @return array Retorno de 1 (correta) ou 0 (incorreto)
	*/
	public function confirmaChave($CHAVE){
		if($CHAVE == SYS_WEBSERVICE_CHAVE){ return "1"; }else{ return 0; }
		//return SYS_WEBSERVICE_CHAVE;
	}//confirmaChave
	

	

	
	
	
	/**
	* Metodo de retorno padrao syncSMS
	* Tem a funcao de enviar e receber SMS do web service em uma unica acao.
	* ARRAY PADRAO (array lista de sub array): array["0"] = subarray, array["1"] = subarray, array["2"] = subarray, etc.
	* SUB ARRAY (sub array de duas posicoes): subarray["id"] = "556282998877" - subarray["num"] = "556282998877" -  subarray["msg"] = "Mensagem do SMS"
	* ACAO: Recebe lista de SMS a enviar e envia SMS recebidos.
	* Apos o recebimento dos dados SMS devem confirmar as mesmas pela funcao confirmaSMS($lista_ids)
	* @param string $arrayJson recebe array json exemplo FUNCAO PHP json_encode($dados)
	* @return string retorno de array json FUNCAO PHP json_encode($dados)
	*/
	public function syncSMS($arrayJson,$limitGet="1"){
		if($arrayJson != ""){ $arrReceive = fGERAL::jsonArray($this->clienteIntegrador($arrayJson,"get"),"dec"); }
		if($limitGet > "20"){ $limitGet = "20"; }else{ $limitGet = (int)$limitGet; }//se limit for maior que 20 fixa em 20
		$cont_send = "0"; $cont_get = "0";
		//verifica se recebeu SMS
		if(is_array($arrReceive)){
			//monta array de dados
			$cont_ARRAY = ceil(count($arrReceive));
			if($cont_ARRAY >= "1"){
				foreach ($arrReceive as $pos => $valor){
					if(($valor["num"] != "") and ($valor["msg"] != "")){
						$num = getpost_sql($valor["num"]);
						$msg = getpost_sql($valor["msg"]);
						$cont_get++;
						//VARS insert simples SQL
						$tabela = "sys_receivesms";
						//busca ultimo id para insert
						$id_b = fSQL::SQL_SELECT_INSERT($tabela, "id");
						$campos = "id,mensagem,numero,gateway_id,time";
						$valores = array($id_b,$msg,$num,SYS_WEBSERVICE_TABELA_ID,time());
						$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);						
					}//if(($valor["num"] != "") and ($valor["msg"] != "")){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){			
		}//if(is_array($arrReceive)){
			
		//volta os devifidos enviando caso tenha utrapassado o tempo de aguardo
		$time_aguardo = time()-7200;//atraza o time 1hora
		//atualiza dados da tabela no DB
		$campos = "time_send";
		$valores = array("0");
		$condicao = "time_send != '10' AND time_send <= '".$time_aguardo."' AND gateway LIKE '%.".SYS_WEBSERVICE_TABELA_ID.".%'";
		fSQL::SQL_UPDATE_SIMPLES($campos, "sys_sendsms", $valores, $condicao);
			
		//verifica se existe SMS a enviar
		$time_send = time()+10;//adianta o relogio de busca em 10 segundos
		$where = "time_envio <= '".$time_send."' AND gateway LIKE '%.".SYS_WEBSERVICE_TABELA_ID.".%' AND ( time_send = '0' OR time_send = '10' )";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,mensagem,numero,time_envio,time_send", "sys_sendsms", $where, "ORDER BY time_envio ASC", $limitGet);
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_e = $linha["id"];
			$mensagem_e = $linha["mensagem"];
			$numero_e = $linha["numero"];
			$time_envio_e = $linha["time_envio"];
			$time_send_e = $linha["time_send"];
			$cont_send++;
			$d["id"] = $id_e; $d["msg"] = $mensagem_e; $d["num"] = $numero_e; $d["time"] = $time_envio_e;
			//verifica se é envio sem confirmação
			if($time_send_e == "10"){
				$d["id"] = "0";
				//exclue o registro
				$tabela = "sys_sendsms";
				$condicao = "id='$id_e'";
				$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			}else{//if($time_send_e == "10"){
				//atualiza dados da tabela no DB
				$campos = "time_send";
				$tabela = "sys_sendsms";
				$valores = array(time());
				$condicao = "id='$id_e'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			}//else{//if($time_send_e == "10"){
			//adiciona a lista de envio
			$arrRet[] = $d;
		}//fim while enviar
		$this->statusWebService($cont_send,$cont_get);
		//monta retorno
		if(isset($arrRet)){
			$ret = $this->clienteIntegrador(fGERAL::jsonArray($arrRet,"enc"));
		}else{ $ret = ""; }
		return $ret;
	}//syncSMS


	
	
	
	
	
	/**
	* Metodo de retorno padrao confirmaEnvioSMS
	* Tem a funcao de confirmar os ids de SMS como enviados.
	* LISTA: 1,43,5,6,6 
	* ACAO: Recebe lista de SMS confirmando como enviadas.
	* @param string $lista_ids ids separados por virgulas
	* @return string retorno de sucesso: 1
	*/
	public function confirmaEnvioSMS($lista_ids){
		$lista_ids = getpost_sql($lista_ids);
		if($lista_ids != ""){
			$sql_del = "id = '".str_replace(",","' OR id = '",$lista_ids)."'";
			//exclue o registro
			$tabela = "sys_sendsms";
			//$condicao = "( ".$sql_del." ) AND gateway LIKE '%.".SYS_WEBSERVICE_TABELA_ID.".%'";
			$condicao = "( ".$sql_del." ) AND time_send >= '100'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			return 1;
		}else{ return 0; }//if($lista_ids != ""){
	}//confirmaEnvioSMS
	
		
	
}//class classSoap{*/