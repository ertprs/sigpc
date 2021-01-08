<?php // Breno Cruvinel - breno.cruvinel09@gmail.com

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<

//valida pagina se aberto separadamente
if(!isset($SYS_VALIDASEMQUADRO)){
   	 //faz um alerta
		print("<script>");
		print("{");
		print("window.location='../index.php';}");
		print("</script>");
		exit(0);
}

















//VARIÁVEIS DE EXECUÇÃO ---------
$VAR_PAUSE_SYNC = "0";
$VAR_HORA = (int)date('Hi');//hora atual em inteiro
$VAR_PARAR = "0";//variável quew quando em 1, para as execuções
$VAR_CONT = "0";//conta ciclos de execução while
$VAR_CONT_PARAR = "100";//numero máximo para parar ciclo
$VAR_CONT_ATUAL = $VAR_CONT_PARAR;//numero de cont ainda disponivel

//VARIÁVEIS DE RESULTADO ---------
$VAR_CONT_GET = "0";//faz contagem de busca web service
$VAR_CONT_SEND = "0";//faz contagem de recebimento web service




//echo "<br>VARHORA:".$VAR_HORA;

//verifica se tem execução paralela
$VAR_PAUSE_SYNC	= fSQL::SQL_CONTAGEM("sys_cron_log", "timef = '0'");
//echo "<br>VAR_PAUSE_SYNC:".$VAR_PAUSE_SYNC;
if($VAR_PAUSE_SYNC == "0"){//PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC >>>




//LIMPA LOG CRON DE CONTROLE~~~~~~~~~~~~~~~~~
	//VARS insert simples SQL
	$tabela = "sys_cron_log";
	//busca ultimo id para insert
	$id_CONTROLE = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,time,timef";
	$valores = array($id_CONTROLE,time(),"0");
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
//LIMPA LOG CRON DE CONTROLE~~~~~~~~~~~~~~~~






/*
//######################################################################## VERIFICA UPDATE DE FERRAMENTA ################################################################>>>>
	$VAR_LEG_UPDATE = "NÃO VERIFICADO";//DEFINE A LEGENDA DE RETORNO DO UPDATE
	//busca updates do servidor de SYNC
	if(file_exists(VAR_DIR_FILES."files/update/update.fai")){
		$VAR_LEG_UPDATE = "EM ANDAMENTO";//DEFINE A LEGENDA DE RETORNO DO UPDATE
	}else{//if(file_exists(VAR_DIR_FILES."files/update/update.fai")){
		if($CONTROLE_WHILE_CONT == "1"){//EXECUTA SÓ NO PRIMEIRO LAÇO
			$VAR_LEG_UPDATE = "VERIFICADO";//DEFINE A LEGENDA DE RETORNO DO UPDATE
			//verifica registros de update
			$cont_updt = "0"; $copilacao_updt = "0"; $c_producao_updt = "0"; $status_updt = "0";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("versao,copilacao,status", "sys_updates", "", "ORDER BY copilacao DESC","1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$versao_updt = $linha1["versao"];
				$copilacao_updt = $linha1["copilacao"];
				$status_updt = $linha1["status"];
			}//fim while
			//verifica versão de produção
			if($status_updt == "1"){
				$c_producao_updt = $copilacao_updt;//define qual copilação está em produção
				
			}else{//if($status_updt == "0"){
				$resu1 = fSQL::SQL_SELECT_SIMPLES("copilacao", "sys_updates", "status = '1'", "ORDER BY copilacao DESC","1");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					$c_producao_updt = $linha1["copilacao"];//define qual copilação está em produção
				}//fim while
				
			}//else{//if($status_updt == "0"){
			//verifica registros de update EXCLUSIVA config
			$config_copilacao_updt = "0";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("config_copilacao", "sys_updates", "config_copilacao >= '1'", "ORDER BY config_copilacao DESC","1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$config_copilacao_updt = $linha1["config_copilacao"];
			}//fim while
			//pega informações do servidor para envio
			$arrInfo = fServidor::statsFull(VAR_DIR_FILES);
			//verifica usuarios
			$arrInfo["usuarios_online"] = fSQL::SQL_CONTAGEM("sys_login_session", "");
			$arrInfo["usuarios_total"] = fSQL::SQL_CONTAGEM("sys_usuarios", "");
			if($arrInfo["usuarios_online"] >= "1"){ $arrInfo["usuarios_porcentagem"] = sprintf('%.0f',($arrInfo["usuarios_online"]/$arrInfo["usuarios_total"])*100); }else{ $arrInfo["usuarios_porcentagem"] = "0"; }
			//echo "arrInfo<pre>"; print_r($arrInfo); echo "</pre>";
			//DEFINIR VARS DE CONSULTA - fWS
			$arrGetWS["copilacao"] = $copilacao_updt;
			$arrGetWS["copilacao_producao"] = $c_producao_updt;
			$arrGetWS["config_copilacao"] = $config_copilacao_updt;
			$arrGetWS["serverStats"] = $arrInfo;
			$fWSret = $clientefWS->getWS("syncUpdate",$arrGetWS);//CONSULTA fWS
			//echo "fWSret<pre>"; print_r($fWSret); echo "</pre>"; //exit(0);
			//verifica se existe update faz o tratamento
			if($fWSret["valida"] == "1"){
				$VAR_LEG_UPDATE = "UPDATE RECEBIDA: ";//DEFINE A LEGENDA DE RETORNO DO UPDATE			
				//cria a pasta de arquivos
				$pasta_updt = VAR_DIR_FILES."files/update"; //caminho/nome da pasta
				$cria = cria_pasta($pasta_updt, "0775"); //confere a criação e retona 1
				$pasta_updt_copilacao = $pasta_updt."/copilacao"; //caminho/nome da pasta
				$cria = cria_pasta($pasta_updt_copilacao, "0775"); //confere a criação e retona 1
				//atualização de codigo geral..........................................................
				if(isset($fWSret["dados"]["update_file"])){
					//dados para o intert da update					
					$linha = $fWSret["dados"]["update"];
					$update_ser = $clientefWS->getFile($fWSret["dados"]["update_ser"]);//recebe o arquivo coloca o base64_decode e verifica se descompacta - (classe fWS instanciada)
					$file_bin = $clientefWS->getFile($fWSret["dados"]["update_file"]);//recebe o arquivo coloca o base64_decode e verifica se descompacta - (classe fWS instanciada)
					file_put_contents($pasta_updt_copilacao."/".$linha["copilacao"].".zip", $file_bin);
					//monta dados para insert
					if(($linha["hora"] == "") or ($linha["hora"] == "0")){ $linha["hora"] = date('Gi', (time()+300)); }
					//VARS insert simples SQL
					$campos = "tipo,versao,copilacao,data,notas,config_copilacao,hora,datai,status,time";
					$valores = array("1",$linha["versao"],$linha["copilacao"],$linha["data"],$linha["notas"],"0",$linha["hora"],$linha["datai"],$linha["status"],"0");
					fSQL::SQL_INSERT_SIMPLES($campos, "sys_updates", $valores);
					$id_a = fSQL::SQL_INSERT_ID();	
					$VAR_LEG_UPDATE .= " APLICAÇÃO/DB ";//DEFINE A LEGENDA DE RETORNO DO UPDATE	
					//grava itens SER................................................
					$file_dat = unserialize($update_ser);
					$i_data_a = $file_dat["data"];
					$i_array_a = $file_dat["array"];
					//monta array
					$array = $i_array_a;
					$cont_ARRAY = ceil(count($array));
					//listar item ja cadastrados
					if($cont_ARRAY >= "1"){
						foreach ($array as $pos => $valor){
							if(is_array($valor)){								
								//VARS insert simples SQL
								$campos = "updates_id,modulo_id,titulo,descricao";
								$valores = array($id_a,$valor["modulo"],$valor["titulo"],$valor["descricao"]);
								fSQL::SQL_INSERT_SIMPLES($campos, "sys_updates_itens", $valores);
							}//valor
						}//fim foreach			
					}//fim if($cont_ARRAY >= "1")....................................			
				}//if(isset($fWSret["dados"]["update_file"])){
				//atualização de codigo config (exclusivo).............................................					
				if(isset($fWSret["dados"]["config_file"])){
					//dados para o intert da update exclusivo
					$linha = $fWSret["dados"]["config"];
					$file_bin = $clientefWS->getFile($fWSret["dados"]["config_file"]);//recebe o arquivo coloca o base64_decode e verifica se descompacta - (classe fWS instanciada)
					file_put_contents($pasta_updt_copilacao."/config_".$linha["copilacao"].".zip", $file_bin);
					//monta dados para insert
					if(($linha["hora"] == "") or ($linha["hora"] == "0")){ $linha["hora"] = date('Gi', (time()+300)); }
					//VARS insert simples SQL
					$campos = "tipo,versao,copilacao,config_copilacao,config_data,config_notas,hora,datai,status,time";
					$valores = array("2","0","0",$linha["copilacao"],$linha["data"],$linha["notas"],$linha["hora"],$linha["datai"],$linha["status"],"0");
					fSQL::SQL_INSERT_SIMPLES($campos, "sys_updates", $valores);
					$VAR_LEG_UPDATE .= " EXCLUSIVO ";//DEFINE A LEGENDA DE RETORNO DO UPDATE
				}//if(isset($fWSret["dados"]["config_file"])){
			}//if($fWSret["valida"] == "1"){
		}//if($CONTROLE_WHILE_CONT == "1"){//EXECUTA SÓ NO PRIMEIRO LAÇO
	}//else{//if(file_exists(VAR_DIR_FILES."files/update/update.fai")){
	
	//verifica se busca autorização de updates
	if($CONTROLE_WHILE_CONT == "1"){//EXECUTA SÓ NO PRIMEIRO LAÇO
		//verifica registros de update
		$cont_updt = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("copilacao", "sys_updates", "status = '0'", "","1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$cont_updt++;
		}//fim while
		//verifica autorização de updates
		if($cont_updt >= "1"){
			//DEFINIR VARS DE CONSULTA - fWS
			$arrGetWS["acao"] = "verifica";
			$arrGetWS["copilacao"] = "0";
			$fWSret = $clientefWS->getWS("syncUpdateManual",$arrGetWS);//CONSULTA fWS
			//echo "fWSret<pre>"; print_r($fWSret); echo "</pre>"; //exit(0);
			//verifica se existe update faz o tratamento
			if($fWSret["copilacao"] >= "1"){
				$VAR_LEG_UPDATE .= " LIBERAÇÃO-MANUAL(".$fWSret["copilacao"].") ";//DEFINE A LEGENDA DE RETORNO DO UPDATE						
				//atualiza dados da tabela no DB
				$tabela = "sys_updates";
				$campos = "status";
				$valores = array("2");
				$condicao = "copilacao <= '".$fWSret["copilacao"]."' AND status = '0'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				//volta no WS e confirma o recebimento
				//DEFINIR VARS DE CONSULTA - fWS
				$arrGetWS["acao"] = "confirma";
				$arrGetWS["copilacao"] = $fWSret["copilacao"];
				$fWSret = $clientefWS->getWS("syncUpdateManual",$arrGetWS);//CONSULTA fWS
			}//if($fWSret["copilacao"] >= "1"){
		}//if($cont_updt >= "1"){
	}//if($CONTROLE_WHILE_CONT == "1"){//EXECUTA SÓ NO PRIMEIRO LAÇO
	
	//aplica o update recebido caso seu status indique
	if(!file_exists(VAR_DIR_FILES."files/update/update.fai")){
		if($CONTROLE_WHILE_CONT == "1"){//EXECUTA SÓ NO PRIMEIRO LAÇO
			$VAR_LEG_UPDATE = "VERIFICADO";//DEFINE A LEGENDA DE RETORNO DO UPDATE
			//verifica registros de update - GERAL
			$cont_updt = "0";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id,config_copilacao,hora,datai", "sys_updates", "config_copilacao >= '1' AND status = '2'", "ORDER BY config_copilacao ASC","1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$id_updt = $linha1["id"];
				$tipo_updt = "2";
				$config_copilacao_updt = $linha1["config_copilacao"];
				$hora_updt = $linha1["hora"];
				$datai_updt = $linha1["datai"];
				$cont_updt++;
			}//fim while
			//verifica registros de update - EXCLUSIVO
			if($cont_updt == "0"){
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id,versao,copilacao,hora,datai", "sys_updates", "copilacao >= '1' AND status = '2'", "ORDER BY copilacao ASC","1");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					$id_updt = $linha1["id"];
					$tipo_updt = "1";
					$versao_updt = $linha1["versao"];
					$copilacao_updt = $linha1["copilacao"];
					$hora_updt = $linha1["hora"];
					$datai_updt = $linha1["datai"];
					$cont_updt++;
				}//fim while
			}//if($cont_updt == "0"){
			//verifica se existe atualização
			if($cont_updt == "1"){
				$pasta_updt = VAR_DIR_FILES."files/update/"; //caminho/nome da pasta
				//verifica o tipo de update a iniciar
				$file_updt = "";
				if($tipo_updt == "2"){
					$VAR_LEG_UPDATE = "UPDATE EXCLUSIVO INICIADO";//DEFINE A LEGENDA DE RETORNO DO UPDATE								
					$file_ = VAR_DIR_FILES."files/update/copilacao/config_".$config_copilacao_updt.".zip"; //caminho/nome da pasta
					if(file_exists($file_)){ $file_updt = $file_; }
				}else{
					$VAR_LEG_UPDATE = "UPDATE GERAL INICIADO";//DEFINE A LEGENDA DE RETORNO DO UPDATE								
					$file_ = VAR_DIR_FILES."files/update/copilacao/".$copilacao_updt.".zip"; //caminho/nome da pasta
					if(file_exists($file_)){ $file_updt = $file_; }
					file_put_contents(VAR_DIR_RAIZ."versao.fai", "V.".$versao_updt."-C.".$copilacao_updt."-T.".time());//grava arquivo que define versão principal
				}
				//verifica se existe arquivo de UPDATE
				if($file_updt != ""){	
					//descompact a atualizacao
					$zip = new ZipArchive; // A variável $zip recebe da biblioteca do php.ini o comando ZipArquive
					if($zip->open($file_updt) === TRUE){ // Verificando se o arquivo recebido na variável $nome_real existe e abrindo o arquivo
						$zip->extractTo($pasta_updt); // Se o arquivo existir, ele será totalmente descompactado dentro da pasta arquivos
						$zip->close(); // Fechando o comando ZipArquive
						delete($file_updt);	
						//cria o arquivo de inicio do update
						if(($linha["hora"] == "") or ($hora_updt == "0")){ $hora_updt = date('Gi', (time()+300)); }//ajusta hora adicionando 5min, caso seja antiga
						$datai_updt = str_replace("-", "",$datai_updt);	if(date('Ymd') > $datai_updt){ $datai_updt = date('Ymd'); }//ajusta data caso seja antiga, pões hoje
						file_put_contents($pasta_updt."update.fai", $hora_updt."-".$datai_updt);//grava arquivo de update							
						//atualiza dados da tabela no DB
						$tabela = "sys_updates";
						$campos = "status";
						$valores = array("1");
						fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id = '".$id_updt."'");
						$VAR_LEG_UPDATE .= " OK ";//DEFINE A LEGENDA DE RETORNO DO UPDATE
					}//$zip->open					
				}else{//if($file_updt != ""){
					//exclue o registro
					$tabela = "sys_updates";
					fSQL::SQL_DELETE_SIMPLES($tabela, "id = '".$id_updt."'");
					$VAR_LEG_UPDATE .= " ERRO-ZIP ";//DEFINE A LEGENDA DE RETORNO DO UPDATE		
				}//else{//if($file_updt != ""){
				
			}//if($cont_updt == "1"){
		}//if($CONTROLE_WHILE_CONT == "1"){//EXECUTA SÓ NO PRIMEIRO LAÇO
	}//if(!file_exists(VAR_DIR_FILES."files/update/update.fai")){

//######################################################################## VERIFICA UPDATE DE FERRAMENTA ################################################################<<<<
//echo "<br>---Executou: $VAR_CONT <br>";//verifica se executou algo ate aqui


*/












//#################################################################################### EXECUÇÃO FULL TIME ################################################################>>>>































































































//#################################################################################### EXECUÇÃO FULL TIME ################################################################<<<<
























//echo "<br>".$VAR_HORA."|".$VAR_PARAR;


//#################################################################################### EXECUÇÃO HORÁRIO: 01:00H ÁS 04:00H ################################################>>>>
$EXECUCAO_HORARIO1 = "0"; unset($QTD_MESES);
if((($VAR_HORA >= "0000") and ($VAR_HORA <= "0100")) and ($VAR_PARAR == "0")){
	
	//verificar se já realizou o reinicio das senhas
	$time = "0";
	$log_senha = VAR_DIR_FILES."files/sysInfo/log_senha"; 
	if(file_exists($log_senha)){ $time = file_get_contents($log_senha); }
	//echo "<br>".date("d",$time)."|".date("d")."|||||".date("m",$time)."|".date("m")."|||||".date("Y",$time)."|",date("Y");
	
	if((date("d",$time) != date("d")) or (date("m",$time) != date("m")) or (date("Y",$time) != date("Y"))){
		//echo "<br>REINICIAR SENHAS";
		$result = fSENHA::reiniciarSenhas();
		
		fSQL::SQL_DELETE_SIMPLES("axl_triagem","id >= '1'");
		//echo "<br>result:".$result;
		file_put_contents($log_senha,time());
	}//if((date("d",$time) != date("d")) or (date("m",$time) != date("m")) or (date("Y",$time) != date("Y"))){







}//fim if if((($VAR_HORA >= "100") and ($VAR_HORA <= "400")) and ($VAR_PARAR == "0")){
//#################################################################################### EXECUÇÃO HORÁRIO: 01:00H ÁS 04:00H ################################################<<<<*/


































//#################################################################################################################################################################
//#################################################################################### EXECUÇÃO HORÁRIO - OBSOLETO ################################################>>>>
//#################################################################################################################################################################
$EXECUCAO_HORARIO_OBSOLETO = "0";
if((($VAR_HORA >= "2300") or ($VAR_HORA <= "600")) and ($VAR_PARAR == "0")){ $EXECUCAO_HORARIO_OBSOLETO = "1"; }//if((($VAR_HORA >= "2300") or ($VAR_HORA <= "600")) and ($VAR_PARAR == "0")){ //23:00H ÁS 06:00H
if(($CONTROLE_WHILE_CONT == "2") and ($VAR_CONT == "0")){ $EXECUCAO_HORARIO_OBSOLETO = "2"; }//se nao houve execução e está no 2 laço, liga o obsoleto
if($EXECUCAO_HORARIO_OBSOLETO >= "1"){




	
			
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
	
	
	//INÍCIO LAÇO DE EXECUÇÃO: expirar procurador Físico/Jurídico @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>
	if($VAR_PARAR == "0"){		
		//exclue o registro Físicos
		$tabela = "cad_candidato_fisico_procurador";
		$condicao = "time_expira < '".time()."'";
		fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	
		//exclue o registro Jurídico
		$tabela = "cad_candidato_juridico_procurador";
		$condicao = "time_expira < '".time()."'";
		fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);		
	}//if($VAR_PARAR == "0"){ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<<<

	
	
	
	//INÍCIO LAÇO DE EXECUÇÃO: expirar suspesnsão @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>
	if($VAR_PARAR == "0"){
		$campos = "suspensao_i,suspensao_f";
		$valores = array("0","0");			
		$tabela = "cad_candidato_fisico";
		$condicao = "suspensao_f < '".time()."' AND suspensao_f >= '1'";
		fSQL::SQL_UPDATE_SIMPLES($campos,$tabela,$valores,$condicao);
		
		fSQL::SQL_UPDATE_SIMPLES($campos,"axl_processo",$valores,"suspensao_f < '".time()."' AND suspensao_f >= '1'");		
	}//if($VAR_PARAR == "0"){ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<<<

	


}//if($EXECUCAO_HORARIO_OBSOLETO >= "1"){
//########################################################################################################################################################################
//#################################################################################### EXECUÇÃO HORÁRIO: 23:00H ÁS 06:00H ################################################<<<<
//########################################################################################################################################################################
 






















//monta o log #####################################################################################################################################################################
$cron_log = "EXEC>> ".date('d/m/Y H:i:s');
$cron_log .= " {Update: $VAR_LEG_UPDATE, Ciclos: $VAR_CONT_PARAR, Executou: $VAR_CONT, Restou: $VAR_CONT_ATUAL} - RESULT{Get: $VAR_CONT_GET, Send: $VAR_CONT_SEND, CONTRATOS AED: $VAR_CONT_AED}";
if($EXECUCAO_HORARIO1 >= "1"){ $cron_log .= " {EXECUCAO_HORARIO($VAR_HORA): $EXECUCAO_HORARIO1}"; }
if($EXECUCAO_HORARIO_OBSOLETO >= "1"){ $cron_log .= " {EXECUCAO_HORARIO(OBSOLETO): $EXECUCAO_HORARIO_OBSOLETO}"; }


//LIMPA LOG CRON DE CONTROLE~~~~~~~~~~~~~~~~~
	//atualiza dados da tabela no DB
	$campos = "executou,log,ip,timef";
	$tabela = "sys_cron_log";
	$valores = array($VAR_CONT,$cron_log,$_SERVER["REMOTE_ADDR"],time());
	$condicao = "id='$id_CONTROLE'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
//LIMPA LOG CRON DE CONTROLE~~~~~~~~~~~~~~~~





	//IMPRIMIR RESUMOS DE VARIAVEIS
	echo $cron_log;

	flush(); ob_flush(); sleep($CONTROLE_SLEEP);//pause e retorno de dados




}//if($VAR_PAUSE_SYNC == "0"){PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC PAUSE-SYNC <<<



