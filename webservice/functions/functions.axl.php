<?php 
$metodo_ok = "0";//cria variavel de verificação se encontrou metodo

set_time_limit(600);
ini_set('memory_limit', '512M');






//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<























//MÉTODO QUE CONFIRMA COLETA DE DADOS - ARR: var
function confirmarColetaBiometrica($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
global $class_fLNG;
	$candidato_fisico_code = $ARR["numero_rnt"];
	$code = $ARR["numero_processo"];	
	$id_origem = (int)$ARR["id_origem"];
	$grafica_id = $ARR["id_coleta"];
	$foto = $ARR["foto"];	
	$assinatura = $ARR["assinatura"];	
	$impressoes_digitais = $ARR["impressoes_digitais"];	
	
	$valida = "";
	if($code == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº do processo é obrigatório'); }
	if($id_origem == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem é obrigatório'); }else{//if($id_origem == ""){
		$linha = fSQL::SQL_SELECT_ONE("id","sys_perfil","origem_id = '$id_origem' AND id != '1'");
		if($linha["id"] <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem não é válido'); }
	}//}else{//if($id_origem == ""){
	//$valida .= "--".ceil(count($impressoes_digitais));
	$codigo_retorno = (int)"3";//falha no processamento	
	
	if($valida == ""){
		$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,status","axl_processo","code = '".$code."'");
		$processo_id = $linha["id"];
		
		if($processo_id <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum processo com este nº !!code!!',array("code"=>$code)); }
		//if($linha["status"] != "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Processo não está em coleta'); }
		//file_put_contents(time()."_DEBUG.txt",$valida);
		if($valida == ""){

			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Confirmação da Coleta Biométrica'),$class_fLNG->txt(__FILE__,__LINE__,'Dados biométricos recebidos'),$class_fLNG->txt(__FILE__,__LINE__,'Automático'),$class_fLNG->txt(__FILE__,__LINE__,'Sistema'),$processo_id,"");	
			
			$codigo_retorno = (int)"1"; $valida = thomasCodRetorno($codigo_retorno);
	
			$ano = date("Y"); $mes = date("m");	$dia = date("d");		
		
			$candidato_fisico_id = $linha["candidato_fisico_id"];
			$campos = "ano,mes,dia,origem_id,grafica_id,candidato_fisico_id,candidato_fisico_code,time";
			$valores = array($ano,$mes,$dia,$id_origem,$grafica_id,$candidato_fisico_id,$candidato_fisico_code,time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_coleta_biometrica",$valores);
			$coleta_id = fSQL::SQL_INSERT_ID();
			//SALVAR ARQUIVOS
			$upload_dir = VAR_DIR_FILES."files/tabelas/coleta/"; if(!file_exists($upload_dir)){ fGERAL::criaPasta($upload_dir); }
			$upload_dir .= $ano."/"; if(!file_exists($upload_dir)){ fGERAL::criaPasta($upload_dir); }		
			$upload_dir .= $mes."/"; if(!file_exists($upload_dir)){ fGERAL::criaPasta($upload_dir); }		
			$upload_dir .=$dia."/"; if(!file_exists($upload_dir)){ fGERAL::criaPasta($upload_dir); }					
			$upload_dir .= $coleta_id."/"; if(!file_exists($upload_dir)){ fGERAL::criaPasta($upload_dir); }		
			
			$campos = ""; unset($valores); $valores = array();
			foreach($impressoes_digitais as $array){
				if($array["imagem_digital"] != ""){
					if($campos != ""){ $campos .= ","; } 
					$campos .= "nfiq".$array["posicao"]; 
					$valores[] = $array["nfiq"];
					//salvar arquivo
					$imgdata = base64_decode($array["imagem_digital"]);
					$file = "dedo".$array["posicao"].".jpg";
					file_put_contents($upload_dir.$file, $imgdata); 			
				}//if($array["imagem_digital"] != ""){
			}//fim foreach
			
			
			//foto
			if($foto != ""){ 
				$imgdata = base64_decode($foto);
				$file = "foto.jpg";				
				if($campos != ""){ $campos .= ","; } $campos .= "foto"; $valores[] = $file;
				file_put_contents($upload_dir.$file, $imgdata); 
			}//if($foto != ""){ 
			
			//assinatura
			if($assinatura != ""){ 
				$imgdata = base64_decode($assinatura);
				$file = "assinatura.jpg";
				if($campos != ""){ $campos .= ","; } $campos .= "assinatura"; $valores[] = $file;
				file_put_contents($upload_dir.$file, $imgdata); 
			}//if($assinatura != ""){ 
			
			if($campos != ""){ fSQL::SQL_UPDATE_SIMPLES($campos,"axl_coleta_biometrica",$valores,"id = '".$coleta_id."'");	}
				
			//ATUALIZAR STATUS -> 2: COLETA REALIZADA
			fSQL::SQL_UPDATE_SIMPLES("status,sync,coleta_id,coleta_time","axl_processo",array("0",time(),$coleta_id,time()), "id = '".$processo_id."'");
			
			
			//enviar SMS
			$linha = fSQL::SQL_SELECT_ONE("C.nome,T.celular","cad_candidato_fisico C,cad_candidato_fisico_celular T","C.id = '".$candidato_fisico_id."' AND C.id = T.candidato_fisico_id AND principal = '1'");
			if($linha["celular"] != ""){
				$linha["celular"] = substr($linha["celular"],3,strlen($linha["celular"])-3);
				$msg = "Vos donnees ont ete capturees avec succes - SIGPC RNC n. ".$code;
				$msg = str_replace(" ","%20",$msg);		
				fSMS_ECASH::send($msg, $linha["celular"]);				
			}
		}//if($valida == ""){
	}//if($valida == ""){
	

		
	
	
	$res["codigo_retorno"] = $codigo_retorno;	
	$res["descricao_retorno"] = $valida;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//confirmarColetaBiometrica
if($P_metodo == "confirmarColetaBiometrica"){ confirmarColetaBiometrica($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<





























//MÉTODO QUE CANCELA COLETA DE DADOS - ARR: var
function cancelarAutorizacaoColeta($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
global $class_fLNG;
	$candidato_fisico_rnt = $ARR["numero_rnt"];
	$code = $ARR["numero_processo"];	
	$id_origem = (int)$ARR["id_origem"];
	$codigo_motivo = $ARR["codigo_motivo"];	
	$motivo_cancelamento = $ARR["motivo_cancelamento"];		

	
	$valida = "";
	if($code == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº do processo é obrigatório'); }
	if($id_origem == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem é obrigatório'); }else{//if($id_origem == ""){
		$linha = fSQL::SQL_SELECT_ONE("id","sys_perfil","origem_id = '$id_origem' AND id != '1'");
		if($linha["id"] <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem não é válido'); }
	}//}else{//if($id_origem == ""){
	if($codigo_motivo == "0" || $codigo_motivo == "" || $codigo_motivo == NULL){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Motivo de cancelamento é obrigatório'); }		
	if($motivo_cancelamento == "0" || $motivo_cancelamento == "" || $motivo_cancelamento == NULL){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Motivo de cancelamento é obrigatório'); }		

	$codigo_retorno = (int)"3";//falha no processamento
	
	if($valida == ""){
		$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,status","axl_processo","code = '".$code."'");
		$processo_id = $linha["id"];
		
		if($processo_id <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum processo com este nº !!code!!',array("code"=>$code)); }
		//if($linha["status"] != "1"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Processo não está em coleta'); }
		
		if($valida == ""){

			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Cancelamento da Coleta Biométrica'),$class_fLNG->txt(__FILE__,__LINE__,'Cancelamento da autorização da coleta'),$class_fLNG->txt(__FILE__,__LINE__,'Automático'),$class_fLNG->txt(__FILE__,__LINE__,'Sistema'),$processo_id,"");

			$codigo_retorno = (int)"1"; $valida = thomasCodRetorno($codigo_retorno);

			$campos = "processo_id,processo_code,etapa,motivo_codigo,descricao,resolvido,time,sync";
			$valores = array($processo_id,$code,"1",$codigo_motivo,$motivo_cancelamento,"0",time(),time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_motivo_cancelamento",$valores);
			$motivo_id = fSQL::SQL_INSERT_ID();
			
			//ATUALIZAR STATUS -> 0: EM ATENDIMENTO
			fSQL::SQL_UPDATE_SIMPLES("status,sync,motivo_id","axl_processo",array("0",time(),$motivo_id), "id = '".$processo_id."'");
		}//if($valida == ""){
	}//if($valida == ""){
	
	$res["codigo_retorno"] = $codigo_retorno;	
	$res["descricao_retorno"] = $valida;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//cancelarAutorizacaoColeta
if($P_metodo == "cancelarAutorizacaoColeta"){ cancelarAutorizacaoColeta($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<







































//MÉTODO QUE INFORMA EMISSÃO - ARR: var
function informarEmissaoDocumento($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
global $class_fLNG;
	$candidato_fisico_rnt = $ARR["numero_rnt"];
	$code = $ARR["numero_processo"];	
	$id_origem = (int)$ARR["id_origem"];
	$id_emissao = $ARR["id_emissao"];
	$numero_espelho = $ARR["numero_espelho"];
	

	$valida = "";
	if($code == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº do processo é obrigatório'); }
	if($id_origem == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem é obrigatório'); }else{//if($id_origem == ""){
		$linha = fSQL::SQL_SELECT_ONE("id","sys_perfil","origem_id = '$id_origem' AND id != '1'");
		if($linha["id"] <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem não é válido'); }
	}//}else{//if($id_origem == ""){
	if($id_emissao == "0" || $id_emissao == "" || $id_emissao == NULL){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID emissão é obrigatório'); }		
	if($numero_espelho == "0" || $numero_espelho == "" || $id_emissao == NULL){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Número do espelho é obrigatório'); }		
	
	$codigo_retorno = (int)"3";//falha no processamento
	
	if($valida == ""){
		$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,origem_id,status,servico_id","axl_processo","code = '".$code."'");
		$processo_id = $linha["id"];
		$candidato_fisico_id = $linha["candidato_fisico_id"];
		$origem_id = $linha["origem_id"];
		$servico_id = $linha["servico_id"];
		
		if($processo_id <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum processo com este nº !!code!!',array("code"=>$code)); }
		if($linha["status"] != "3"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Processo não está em impressão'); }
		
		
		if($valida == ""){

			$codigo_retorno = (int)"1"; $valida = thomasCodRetorno($codigo_retorno);
			//ATUALIZAR STATUS -> 4: IMPRESSO
			fSQL::SQL_UPDATE_SIMPLES("status,sync,emissao_id,emissao_time,emissao_espelho","axl_processo",array("4",time(),$id_emissao,time(),$numero_espelho), "id = '".$processo_id."'");
			
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Documento emitido'),$class_fLNG->txt(__FILE__,__LINE__,'Documento emitido'),$class_fLNG->txt(__FILE__,__LINE__,'Automático'),$class_fLNG->txt(__FILE__,__LINE__,'Sistema'),$processo_id,"");	
			
			//enviar SMS
			$linha = fSQL::SQL_SELECT_ONE("C.nome,T.celular","cad_candidato_fisico C,cad_candidato_fisico_celular T","C.id = '".$candidato_fisico_id."' AND C.id = T.candidato_fisico_id AND principal = '1'");
			if($linha["celular"] != ""){
				$linha["celular"] = substr($linha["celular"],3,strlen($linha["celular"])-3);
				$msg = "Votre Permis de Conduire est pret, veuillez chercher le SIGPC pour le retrait - RNC n. ".$code;
				$msg = str_replace(" ","%20",$msg);		
				fSMS_ECASH::send($msg, $linha["celular"]);					
			}
							
			//enviar email
			$linha = fSQL::SQL_SELECT_ONE("C.nome,E.email","cad_candidato_fisico C,cad_candidato_fisico_email E","C.id = '".$candidato_fisico_id."' AND C.id = E.candidato_fisico_id");
			if($linha["email"] != ""){

				
				$email = $linha["email"];
				$nome = $linha["nome"];
				$linha = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id."'");
				$origem_id_n = $linha["nome"];
				
				$linha = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id."'");
				$tipo = $linha["nome"];
				
				$notificacao = $class_fLNG->txt(__FILE__,__LINE__,'A emissão do documento !!tipo!! foi concluída, prossiga até a !!unidade!! para a retirada!',array("tipo"=>$tipo,"unidade"=>$origem_id_n));
				
				$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
				//monta mensagem template
				$html_template = str_replace("!nome_fisico!",$nome,$html_template);
				$html_template = str_replace("!notificacao!",$notificacao,$html_template);
								
				//#################### INICIO ENVIA EMAIL ##################>>>>>>>>>>>>>>>>
				$opts = array(
					'http'=>array('header'=>"Content-type: application/x-www-form-urlencoded", 'method'=>'POST', 'content'=>http_build_query(array(
						//CONFIGURAÇÕES
						'MAIL_HOST' => SYS_MAIL_HOST,
						'MAIL_TIPO' => SYS_MAIL_TIPO,// SMTP ("","ssl","tls")
						'MAIL_PORTA' => SYS_MAIL_PORTA,//465
						'MAIL_USER' => SYS_MAIL_USER,
						'MAIL_PASS' => SYS_MAIL_PASS,
						'MAIL_NOME' => SYS_MAIL_NOME,
						'MAIL_EMAIL' => SYS_MAIL_EMAIL,
						'MAIL_DEBUG' => "0",//ativar debug -- 1 = Erros e mensagens, 2 = Apenas mensagens, SMTP::DEBUG_SERVER
						//DADOS DO ENVIO
						'SEND_NOME' => primeiro_nome($nome),
						'SEND_EMAIL' => $email,
						'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, Emissão Documento',array("nome"=>primeiro_nome($nome))).' - '.SYS_CLIENTE_NOME_RESUMIDO,
						'SEND_BODY' => $html_template
						))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
				); $context = stream_context_create($opts);
				//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
				$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
				//file_put_contents(time()."_email.txt",$contentResp);
			}//if($linha["email"] != ""){
		}//if($valida == ""){
	}//if($valida == ""){
	

	$res["codigo_retorno"] = $codigo_retorno;	
	$res["descricao_retorno"] = $valida;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//docEmissao
if($P_metodo == "informarEmissaoDocumento"){ informarEmissaoDocumento($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<






























//MÉTODO QUE informa status ABIS - ARR: var
function informarStatusABIS($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
global $class_fLNG;
	$candidato_fisico_rnt = $ARR["numero_rnt"];
	$code = $ARR["numero_processo"];	
	$id_origem = (int)$ARR["id_origem"];
	$id_coleta = $ARR["id_coleta"];	
	$status_abis = $ARR["status_abis"];		
	$problemas = $ARR["problemas"];		
	

	
	$valida = "";
	if($code == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº do processo é obrigatório'); }
	if($id_origem == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem é obrigatório'); }else{//if($id_origem == ""){
		$linha = fSQL::SQL_SELECT_ONE("id","sys_perfil","origem_id = '$id_origem' AND id != '1'");
		if($linha["id"] <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem não é válido'); }
	}//}else{//if($id_origem == ""){
	if($id_coleta == "0" || $id_coleta == "" || $id_coleta == NULL){ $valida = "ID coleta é obrigatório"; }		
	if($status_abis == "0" || $status_abis == "" || $status_abis == NULL){ $valida = "Status ABIS é obrigatório"; }			
	
	$codigo_retorno = (int)"3";//falha no processamento
	
	if($valida == ""){
		$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,status,coleta_id,servico_id,ano,mes,dia,externo,status","axl_processo","code = '".$code."'");
		$processo_id = $linha["id"];
		$coleta_id = $linha["coleta_id"];
		$servico_id = $linha["servico_id"];
		$candidato_fisico_id = $linha["candidato_fisico_id"];
		$externo = $linha["externo"];

		if($processo_id <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum processo com este nº !!code!!',array("code"=>$code)); }
		//if($linha["status"] != "2"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Processo não está aguardando status ABIS'); }
		
		if($valida == ""){
			$upload_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$linha["ano"]."/".completa_zero($linha["mes"],"2")."/".completa_zero($linha["dia"],"2")."/".$code."/";			
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'ABIS'),$class_fLNG->txt(__FILE__,__LINE__,'Retorno ABIS recebido'),$class_fLNG->txt(__FILE__,__LINE__,'Automático'),$class_fLNG->txt(__FILE__,__LINE__,'Sistema'),$processo_id,"");	
			
			if($status_abis == "1"){
				$valida_ws = verificarAutorizacaoProcesso($processo_id);
		
				if($valida_ws == "1"){
					//AUTORIZAR EMISSÃO
					//WS THOMAS++++++++++++++++++++++++++++++++++++++++++
					
					//verificar se processo completo - autorizar impressão
					$linha = fSQL::SQL_SELECT_ONE("informacoes","adm_protocolo_tipo","id = '".$servico_id."'");
					$informacoes = arrayDB($linha["informacoes"]);
		
					
					//monta array
					unset($array); $array = explode(".",$informacoes);
					$cont_ARRAY = ceil(count($array));
					//listar item ja cadastrados
					if($cont_ARRAY >= "1"){
						foreach ($array as $pos => $tipo_id){
							$linhaxxx = fSQL::SQL_SELECT_ONE("id,obrigatorio","adm_protocolo_tipo_inf","id = '".$tipo_id."'");							
							if($linhaxxx["obrigatorio"] == "1"){
								$cont = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$tipo_id."'");
								if($cont <= "0"){ $valida_ws = "0"; break; }
							}//if($linhaxxx["obrigatorio"] == "1"){						
						}//foreach ($array as $pos => $tipo_id){
					}//if($cont_ARRAY >= "1"){
				}
				
				//autorizar impressão
				$msg_ws = "";
				if($valida_ws == "1"){
					if($externo == 1){
						fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array("999",time()),"id = '".$processo_id."'");
						fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo completo!'),$class_fLNG->txt(__FILE__,__LINE__,'Processo completo, aguardando liberação (CADAC).'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$upload_dir);
					}else{
						$result = thomasWSimpressaoEnviar($processo_id,$id_origem);
						if($result["codigo_retorno"] == "1"){ 
							fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização para Impressão'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão'),$class_fLNG->txt(__FILE__,__LINE__,'Automático'),$class_fLNG->txt(__FILE__,__LINE__,'Sistema'),$processo_id,"");	
						}
					}
				}//if($valida == "1"){				
				
				
			}else{//if($status_abis == "1"){
				$linha = fSQL::SQL_SELECT_ONE("nome,sobrenome","cad_candidato_fisico","id = '".$candidato_fisico_id."'");
				
				$notificacao = $class_fLNG->txt(__FILE__,__LINE__,'Existe um processo de Deduplicação ABIS aguardando análise.');
				$notificacao .= "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'Nº RNT')." ".$code;
				$notificacao .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'SOBRENOME').": ".$linha["sobrenome"];
				$notificacao .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'NOME').": ".$linha["nome"];
				
				$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
				//monta mensagem template
				$html_template = str_replace("!nome_fisico!","",$html_template);
				$html_template = str_replace("!notificacao!",$notificacao,$html_template);
								
				//#################### INICIO ENVIA EMAIL ##################>>>>>>>>>>>>>>>>
				$opts = array(
					'http'=>array('header'=>"Content-type: application/x-www-form-urlencoded", 'method'=>'POST', 'content'=>http_build_query(array(
						//CONFIGURAÇÕES
						'MAIL_HOST' => SYS_MAIL_HOST,
						'MAIL_TIPO' => SYS_MAIL_TIPO,// SMTP ("","ssl","tls")
						'MAIL_PORTA' => SYS_MAIL_PORTA,//465
						'MAIL_USER' => SYS_MAIL_USER,
						'MAIL_PASS' => SYS_MAIL_PASS,
						'MAIL_NOME' => SYS_MAIL_NOME,
						'MAIL_EMAIL' => SYS_MAIL_EMAIL,
						'MAIL_DEBUG' => "0",//ativar debug -- 1 = Erros e mensagens, 2 = Apenas mensagens, SMTP::DEBUG_SERVER
						//DADOS DO ENVIO
						'SEND_NOME' => "TGA",
						'SEND_EMAIL' => "breno.cruvinel09@gmail.com",
						'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'Análise deduplicação ABIS - RNC ').$code.' - '.SYS_CLIENTE_NOME_RESUMIDO,
						'SEND_BODY' => $html_template
						))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
				); $context = stream_context_create($opts);
				//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
				$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);				
				
				
				//PROBLEMA ++++++++++++++
				//$problemas = json_encode($problemas, true);
				foreach($problemas as $array){
					if($array["numero_processo"] == "" || $array["numero_processo"] == "null" || $array["numero_processo"] == NULL){ $valida = "Nº do processo problema não foi informado."; break; }
					
					$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,coleta_id","axl_processo","code = '".$array["numero_processo"]."'");
					$duplicado_processo_id = $linha["id"];
					$duplicado_coleta_id = $linha["coleta_id"];
					$duplicado_candidato_fisico_id = $linha["candidato_fisico_id"];				
					
					$result = thomasWSabisProblema($array["id_problema"]);
					
					$campos = "coleta_id,id_problema,origem_id,processo_id,processo_code,candidato_fisico_id,candidato_fisico_code,duplicado_grafica_id,duplicado_coleta_id,tipo_problema,score_foto,score_digital,score,acao,time,sync";
					$valores = array($coleta_id,$array["id_problema"],$array["id_origem"],$duplicado_processo_id,$array["numero_processo"],$duplicado_candidato_fisico_id,$array["numero_rnt"],$array["id_coleta"],$duplicado_coleta_id,$result["tipo_problema"],$result["score_foto"],$result["score_digital"],$result["score"],"0",time(),time());
					fSQL::SQL_INSERT_SIMPLES($campos,"axl_abis_problemas",$valores);
					$abis_problema_id = fSQL::SQL_INSERT_ID();
				}//foreach($problemas as $array){
				
				if($valida == ""){
					//ATUALIZAR STATUS -> 2: COLETA REALIZADA
					fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array("2",time()), "id = '".$processo_id."'");									
				}//if($valida == ""){
			}//}else{//if($status_abis == "1"){
			
			if($valida == ""){
				$codigo_retorno = (int)"1"; $valida = thomasCodRetorno($codigo_retorno);	
				//atualizar abis na coleta
				fSQL::SQL_UPDATE_SIMPLES("abis_status,abis_status_acao,sync","axl_coleta_biometrica",array($status_abis,"0",time()),"id = '$coleta_id'");
			}//if($valida == ""){

		}//if($valida == ""){
	}//if($valida == ""){
	
	$res["codigo_retorno"] = $codigo_retorno;	
	$res["descricao_retorno"] = $valida;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//coletaDadosCancela
if($P_metodo == "informarStatusABIS"){ informarStatusABIS($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<


























//MÉTODO QUE INFORMA RETIRADA - ARR: var
function informarEntregaDocumento($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
global $class_fLNG;
	$candidato_fisico_rnt = $ARR["numero_rnt"];
	$code = $ARR["numero_processo"];	
	$id_origem = (int)$ARR["id_origem"];
	$id_emissao = $ARR["id_emissao"];
	$data_entrega = $ARR["data_entrega"];	
	$local_entrega = $ARR["local_entrega"];	
	$tipo_entrega = $ARR["tipo_entrega"];	
	$arquivo_anexo = $ARR["arquivo_anexo"];	
	

	$valida = "";
	if($code == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº do processo é obrigatório'); }
	if($id_origem == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem é obrigatório'); }else{//if($id_origem == ""){
		$linha = fSQL::SQL_SELECT_ONE("id","sys_perfil","origem_id = '$id_origem' AND id != '1'");
		if($linha["id"] <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem não é válido'); }
	}//}else{//if($id_origem == ""){
	if($id_emissao <= "0" || $id_emissao == "" || $id_emissao == NULL){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID emissão é obrigatório'); }
	if($data_entrega <= "0" || $data_entrega == "" || $data_entrega == NULL){ $valida = "Data de entrega é obrigatório"; }
	$codigo_retorno = (int)"3";//falha no processamento
	
	if($valida == ""){
		$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,status","axl_processo","code = '".$code."'");
		$processo_id = $linha["id"];
		
		
		if($processo_id <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum processo com este nº !!code!!',array("code"=>$code)); }
		if($linha["status"] != "4"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Processo não está aguardando entrega'); }
		
		if($valida == ""){

			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Documento Entregue'),$class_fLNG->txt(__FILE__,__LINE__,'Documento entregue/retirado pelo candidato'),$class_fLNG->txt(__FILE__,__LINE__,'Automático'),$class_fLNG->txt(__FILE__,__LINE__,'Sistema'),$processo_id,"");	

			$codigo_retorno = (int)"1"; $valida = thomasCodRetorno($codigo_retorno);
			//ATUALIZAR STATUS -> 5: ATIVO (RETIRADO)
			$campos = "status,sync,entrega_data,entrega_local,entrega_tipo";
			$valores = array("5",time(),$data_entrega,$local_entrega,$tipo_entrega);
			//ver se existe arquivo anexo
			if($arquivo_anexo != ""){
				$ano = $linha["ano"]; $mes = $linha["mes"]; $dia = $linha["dia"];
				$upload_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$ano."/".$mes."/".$dia."/".$code."/";
				if(file_exists($upload_dir)){
					$upload_dir .= "entrega/"; $cria = fGERAL::criaPasta($fileCaminho, "0775"); //confere a criação e retona 1	
				}else{ $upload_dir = ""; }//if(file_exists($upload_dir)){
	
				if($upload_dir != ""){
					$file = "entrega_file.pdf";
					$campos = ",entrega_file"; $valores[] = $file;
					$imgdata = base64_decode($arquivo_anexo);
					file_put_contents($upload_dir.$file, $imgdata); 
				}//if($upload_dir != ""){
			}//if($arquivo_anexo != ""){
			
			fSQL::SQL_UPDATE_SIMPLES($campos,"axl_processo",$valores, "id = '".$processo_id."'");
		}//if($valida == ""){
	}//if($valida == ""){
	
	
	$res["codigo_retorno"] = $codigo_retorno;	
	$res["descricao_retorno"] = $valida;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//docRetirado
if($P_metodo == "informarEntregaDocumento"){ informarEntregaDocumento($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<



























//MÉTODO QUE CANCELA COLETA DE DADOS - ARR: var
function cancelarEmissao($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
global $class_fLNG;
	$candidato_fisico_rnt = $ARR["numero_rnt"];
	$code = $ARR["numero_processo"];	
	$id_origem = (int)$ARR["id_origem"];
	$codigo_motivo = $ARR["codigo_motivo"];	
	$motivo_cancelamento = $ARR["motivo_cancelamento"];		
	$id_emissao = $ARR["id_emissao"];			

	
	$valida = "";
	if($code == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Nº do processo é obrigatório'); }
	if($id_origem == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem é obrigatório'); }else{//if($id_origem == ""){
		$linha = fSQL::SQL_SELECT_ONE("id","sys_perfil","origem_id = '$id_origem' AND id != '1'");
		if($linha["id"] <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'ID da origem não é válido'); }
	}//}else{//if($id_origem == ""){
	if($codigo_motivo == "0" || $codigo_motivo == "" || $codigo_motivo == NULL){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Motivo de cancelamento é obrigatório'); }		
	if($motivo_cancelamento == "0" || $motivo_cancelamento == "" || $motivo_cancelamento == NULL){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Motivo de cancelamento é obrigatório'); }		

	$codigo_retorno = (int)"3";//falha no processamento
	
	if($valida == ""){
		$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,status","axl_processo","code = '".$code."'");
		$processo_id = $linha["id"];
		
		if($processo_id <= "0"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum processo com este nº !!code!!',array("code"=>$code)); }
		if($linha["status"] != "3" and $linha["status"] != "4"){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Processo não está em impressão / impresso'); }
		
		if($valida == ""){
			
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização de Emissão Cancelada'),$class_fLNG->txt(__FILE__,__LINE__,'Autorização de emissão foi cancelada pela gráfica'),$class_fLNG->txt(__FILE__,__LINE__,'Automático'),$class_fLNG->txt(__FILE__,__LINE__,'Sistema'),$processo_id,"");	
			
			$codigo_retorno = (int)"1"; $valida = thomasCodRetorno($codigo_retorno);

			$campos = "processo_id,processo_code,etapa,motivo_codigo,descricao,resolvido,time,sync";
			$valores = array($processo_id,$code,"IMPRESSÃO",$codigo_motivo,$motivo_cancelamento,"0",time(),time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_motivo_cancelamento",$valores);
			$motivo_id = fSQL::SQL_INSERT_ID();
			
			//ATUALIZAR STATUS -> 0: EM ATENDIMENTO
			fSQL::SQL_UPDATE_SIMPLES("status,sync,motivo_id","axl_processo",array("0",time(),$motivo_id), "id = '".$processo_id."'");
		}//if($valida == ""){
	}//if($valida == ""){
	
	$res["codigo_retorno"] = $codigo_retorno;	
	$res["descricao_retorno"] = $valida;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//cancelarAutorizacaoColeta
if($P_metodo == "cancelarEmissao"){ cancelarEmissao($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<



























//MÉTODO QUE CANCELA COLETA DE DADOS - ARR: var
function authUser($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	global $class_fLNG;
	$login = $ARR["login"];
	$senha = $ARR["senha"];	
	$sistema_id = $ARR["id_sistema"];

	$valida = "";
	if($login == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Login é obrigatório!'); }
	if($valida == "" && $senha == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Senha é obrigatória'); }
	if($valida == "" && $sistema_id == ""){ $valida = $class_fLNG->txt(__FILE__,__LINE__,'Sistema é obrigatório'); }

	$codigo_retorno = 0;//sem acesso
	$nome = ""; $codigo = "";
	
	if($valida == ""){
		
		$linha = fSQL::SQL_SELECT_ONE("L.id,L.senha,L.sistemas,L.usuarios_id,U.nome","sys_login L, sys_usuarios U","L.usuarios_id = U.id AND L.email = '".$login."'");
		if ($linha["id"] <= "0") {
			$valida = $class_fLNG->txt(__FILE__,__LINE__,'Usuãrio não está cadastrado');
		} else {//if ($linha["id"] <= "0") {
			$nome = $linha["nome"];
			$codigo = $linha["usuarios_id"];
			$upw = fGERAL::cryptoSenhaDB($senha);
			if ($upw != $linha["senha"]) {
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Usuário e senha não conferem!');
			} else {//if ($senha != $linha["senha"]) {
				if (!preg_match("/.".$sistema_id."./",$linha["sistemas"])) {
					$valida = $class_fLNG->txt(__FILE__,__LINE__,'Usuário não possui acesso ao sistema!');
				}//if (preg_match("/,".$sistema.",/",$linha["sistema"])) {
			}//} else {//if ($senha != $linha["senha"]) {
		}//} else {//if ($linha["id"] <= "0") {
	}
	
	if ($valida == ""){
		$res["codigo_retorno"] = 1;
		$res["nome"] = $nome;
		$res["codigo"] = $codigo;		
	}else{
		$res["codigo_retorno"] = 0;
		$res["descricao_retorno"] = $valida;
	}
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO		
}//authUser
if($P_metodo == "authUser"){ authUser($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<













































//FIM PARA RETORNO DE NÃO LOCALIZADO *****************************************************************************************************************#####
if($metodo_ok == "0"){ $arrRet["codigo_retorno"] = "002"; $arrRet["msg"] = "MÉTODO ($P_metodo) NAO FOI LOCALIZADO!, VERIFIQUE O LAYOUT DE INTEGRAÇÃO!"; fWS_retDados($arrRet,0,0); }