<?php 
$metodo_ok = "0";//cria variavel de verificação se encontrou metodo

set_time_limit(600);
ini_set('memory_limit', '512M');






























//MÉTODO QUE CONFIRMA COLETA DE DADOS - ARR: var
function syncPgto($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$time = $ARR["time"];
	$arr = array(); $cont = "0";
	$resu = fSQL::SQL_SELECT_SIMPLES("id,cod_banco,numero,nome,sobrenome,valor,time_deposito,status,time,sync","axl_pgto_banco","sync > '".$time."'","ORDER BY sync ASC","500");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$arr[] = $linha;
	}//fim while

	
	
	$res["cont"] = $cont;	
	$res["dados"] = $arr;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//confirmarColetaBiometrica
if($P_metodo == "syncPgto"){ syncPgto($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<




















//MÉTODO QUE SINCRONISA CADASTRO DE USUÁRIOS
function syncUsr($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$time = $ARR["time"];
	$arr = array(); $cont = "0";
	$resu = fSQL::SQL_SELECT_SIMPLES("U.id,U.nome,U.cargo,U.doc_nome,U.doc_numero,U.num_guiche,U.servicos,U.sync,L.time,L.status,L.email,L.senha","sys_usuarios U, sys_login L","U.id = L.usuarios_id AND (L.time > '".$time."' OR U.sync > '".$time."') AND cargo in ('ATENDENTE','TRIAGEM','TI')","ORDER BY U.nome ASC","500");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$arr[] = $linha;
	}//fim while

	
	
	$res["cont"] = $cont;	
	$res["dados"] = $arr;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//confirmarColetaBiometrica
if($P_metodo == "syncUsr"){ syncUsr($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<






























//FIM PARA RETORNO DE NÃO LOCALIZADO *****************************************************************************************************************#####
if($metodo_ok == "0"){ $arrRet["codigo_retorno"] = "002"; $arrRet["msg"] = "MÉTODO ($P_metodo) NAO FOI LOCALIZADO!, VERIFIQUE O MANUAL DE INTEGRAÇÃO!"; fWS_retDados($arrRet,0,0); }