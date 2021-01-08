<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
$metodo_ok = "0";//cria variavel de verificação se encontrou metodo


//MÉTODO QUE SOMA DOIS NÚMEROS - ARR: numero1, numero2
function somaNumeros($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$res["resultado"] = $ARR["numero1"]+$ARR["numero2"];	
	$res["descricao"] = "A soma dos valores (".$ARR["numero1"]."+".$ARR["numero2"].") é: ".$res["resultado"]." - ".date('d/m/Y H:i:s');
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO
}//somaNumeros
if($P_metodo == "somaNumeros"){ somaNumeros($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<


































//MÉTODO QUE CONFIRMA CONEXÃO - ARR: var
function confirmaConexao($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$res["valida"] = "1";
	$res["retorno"] = $ARR["var"];
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO
}//confirmaConexao
if($P_metodo == "confirmaConexao"){ confirmaConexao($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<















//MÉTODO QUE REALIZA O SYNC DE MENSAGENS SMS - ARR: arrayJson, limitGet
function syncSMS($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_arrayJson = getpost_sql($ARR["arrayJson"]);
	$f_limitGet = getpost_sql($ARR["limitGet"]);
	if($f_arrayJson != ""){ $arrReceive = fGERAL::jsonArray($f_arrayJson,"dec"); }
	if($f_limitGet > "20"){ $f_limitGet = "20"; }else{ $f_limitGet = (int)$f_limitGet; }//se limit for maior que 20 fixa em 20
	
	//verifica se recebeu SMS
	if(is_array($arrReceive)){
		//monta array de dados
		$cont_ARRAY = ceil(count($arrReceive));
		if($cont_ARRAY >= "1"){
			foreach ($arrReceive as $pos => $valor){
				if(($valor["num"] != "") and ($valor["msg"] != "")){
					$num = getpost_sql($valor["num"]);
					$msg = getpost_sql($valor["msg"]);
					$CONT_GET++;
					//VARS insert simples SQL
					$tabela = "sys_receivesms";
					//busca ultimo id para insert
					$id_b = fSQL::SQL_SELECT_INSERT($tabela, "id");
					$campos = "id,mensagem,numero,time";
					$valores = array($id_b,$msg,$num,time());
					fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);						
				}//if(($valor["num"] != "") and ($valor["msg"] != "")){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){			
	}//if(is_array($arrReceive)){
		
	//volta os devifidos enviando caso tenha utrapassado o tempo de agaurdo
	$time_aguardo = time()-7200;//atraza o time 1hora
	//atualiza dados da tabela no DB
	$campos = "time_send";
	$tabela = "sys_sendsms";
	$valores = array("0");
	$condicao = "time_send != '10' AND time_send <= '".$time_aguardo."'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		
	//verifica se existe SMS a enviar
	$time_send = time()+10;//adianta o relogio de busca em 10 segundos
	$where = "time_envio <= '".$time_send."' AND ( time_send = '0' OR time_send = '10' )";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,mensagem,numero,time_envio,time_send", "sys_sendsms", $where, "ORDER BY time_envio ASC", $f_limitGet);
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$mensagem_e = $linha["mensagem"];
		$numero_e = $linha["numero"];
		$time_envio_e = $linha["time_envio"];
		$time_send_e = $linha["time_send"];
		$CONT_SEND++;//contagem de envios
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
		$arr[] = $d;
	}//fim while enviar
	
	//dados de array retorno	
	$arrRet["valida"] = "1";
	if($CONT_SEND >= "1"){
		$arrRet["dados"] = $arr;//retorno dos dados
	}//if($CONT_SEND >= "1"){	
		
		
	//EXCLUIR MUITO ANTIGOS MESMO COM PERSISTENCIA
	$time_antigo = time()-86400;//atraza o time 24horas
	//exclue o registro
	$tabela = "sys_sendsms";
	$condicao = "time_envio <= '".$time_antigo."' AND time_send >= '100' LIMIT 100";
	fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	
	
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//syncSMS
if($P_metodo == "syncSMS"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ syncSMS($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<




  






































//MÉTODO QUE REALIZA CONFIRMAÇÃO DE MENSAGENS SMS - ARR: lista_ids
function confirmaEnvioSMS($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_lista_ids = getpost_sql($ARR["lista_ids"]);
	if($f_lista_ids != ""){
		$sql_del = "id = '".str_replace(",","' OR id = '",$f_lista_ids)."'";
		//exclue o registro
		$tabela = "sys_sendsms";
		$condicao = "( ".$sql_del." ) AND time_send >= '100'";
		fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		$arrRet["confirma"] = "1";
	}else{ $arrRet["confirma"] = "0"; }//if($f_lista_ids != ""){
	$arrRet["valida"] = "1";
	$arrRet["debug"] = $ARR;
	
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//confirmaEnvioSMS
if($P_metodo == "confirmaEnvioSMS"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ confirmaEnvioSMS($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<




  























































//FIM PARA RETORNO DE NÃO LOCALIZADO *****************************************************************************************************************#####
if($metodo_ok == "0"){ $arrRet["valida"] = "0"; $arrRet["msg"] = "MÉTODO ($P_metodo) NAO FOI LOCALIZADO!, VERIFIQUE O MANUAL DE INTEGRAÇÃO!"; fWS_retDados($arrRet,0,0); }
if($metodo_ok == "NEGADO"){ $arrRet["valida"] = "0"; $arrRet["msg"] = "DESCULPE, O ACESSO AO MÉTODO: ".$P_metodo." FOI NEGADO, PROCURE A GESTÃO DE TI"; fWS_retDados($arrRet,0,0); }