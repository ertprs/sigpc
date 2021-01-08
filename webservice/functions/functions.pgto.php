<?php 
$metodo_ok = "0";//cria variavel de verificação se encontrou metodo

set_time_limit(600);
ini_set('memory_limit', '512M');






























//MÉTODO QUE CONFIRMA COLETA DE DADOS - ARR: var
function sync($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$time = $ARR["time"];
	$arr = array(); $cont = "0";
	$resu = fSQL::SQL_SELECT_SIMPLES("id,cod_banco,numero,nome,sobrenome,valor,time_deposito,status,time,sync","axl_pgto_banco","sync > '".$time."'","ORDER BY sync ASC","20");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$arr[] = $linha;
	}

	
	
	$res["cont"] = $cont;	
	$res["dados"] = $arr;
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO	
}//confirmarColetaBiometrica
if($P_metodo == "sync"){ sync($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<




































//FIM PARA RETORNO DE NÃO LOCALIZADO *****************************************************************************************************************#####
if($metodo_ok == "0"){ $arrRet["codigo_retorno"] = "002"; $arrRet["msg"] = "MÉTODO ($P_metodo) NAO FOI LOCALIZADO!, VERIFIQUE O MANUAL DE INTEGRAÇÃO!"; fWS_retDados($arrRet,0,0); }