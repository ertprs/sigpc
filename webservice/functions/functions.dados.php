<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
$metodo_ok = "0";//cria variavel de verificação se encontrou metodo


//MÉTODO QUE SOMA DOIS NÚMEROS - ARR: numero1, numero2
function somaNumeros($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$res["resultado"] = $ARR["numero1"]+$ARR["numero2"];	
	$res["descricao"] = "A soma dos valores (".$ARR["numero1"]."+".$ARR["numero2"].") é: ".$res["resultado"]." - ".date('d/m/Y H:i:s');
	fWS_retDados($res,$CONT_GET,$CONT_SEND);//RETORNO
}//somaNumeros
if($P_metodo == "somaNumeros"){ somaNumeros($P_metodoArr); $metodo_ok = "1"; }//*************************************************************************<<<





















































//MÉTODO QUE BUSCA LISTA CANDIDATO - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, rm, nome, cpf
function consultaCandidatoFisico($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_rm = fGERAL::limpaCode(getpost_sql($ARR["rm"]));
	$f_nome = getpost_sql($ARR["nome"]);
	$f_cpf = getpost_sql($ARR["cpf"],"DOC");
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "C.id,C.code,C.nome,C.sexo,C.datan,C.rg,C.cpf,C.pis,C.cnh,C.mae,C.pai,C.sync AS time,E.numero,E.lote,E.quadra,E.complemento,E.logradouro,E.bairro,E.uf,I.cidade_nome AS cidade, E.cep"; //campos da tabela
	
	//echo "<BR><BR>RECURSO TEMPORARIAMENTE INDISPONÍVEL :)<BR>";
	$SQL_campos = "C.id,C.code,C.nome,C.sexo,E.lote,E.complemento,E.logradouro"; //campos da tabela
	$SQL_tabela = "cad_candidato_fisico C"; //tabela
	$SQL_join = "LEFT JOIN cad_candidato_fisico_endereco E ON C.id = E.candidato_fisico_id LEFT JOIN combo_cidades I ON E.cidade_id = I.id"; //join
	$SQL_where = ""; //condição
	$ORDEM_C = "C.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY C.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
		

	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " C.sync >= '$timei' AND C.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_rm
	if($f_rm != ""){
			$aCode = fGERAL::codeRandRetorno($f_rm);
			$filtro_leg .= "\n - Busca ".SYS_CONFIG_RM_SIGLA." <b>$f_rm</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( C.`id` = '".$aCode["id"]."' AND C.`code` = '".$aCode["code"]."' ) "; //condição 
	}//fim da busca por f_rm
			
	//verifica se recebeu uma solicitação de busca por nome
	if($f_nome != ""){
			$filtro_leg .= "\n - Busca por <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( C.`nome` LIKE '%$f_nome%' ) "; //condição 
	}//fim da busca por nome
			
	//verifica se recebeu uma solicitação de busca por cpf
	if($f_cpf != ""){
			$filtro_leg .= "\n -Busca CPF <b>$f_cpf</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( C.`cpf` LIKE '%$f_cpf%' ) "; //condição 
	}//fim da busca por cpf_b


	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){		
		$id_a = $linha["id"];
		$linha["rm"] = fGERAL::legCode($linha["id"],$linha["code"]); unset($linha["id"],$linha["code"]);
		$linha["datan"] = data_mysql($linha["datan"]);
		$linha["rg"] = $linha["rg"]." ".$linha["rg_orgao"]; unset($linha["rg_orgao"]);
		
		//pega informações de contato
		unset($arr_fone);
		$resu1 = fSQL::SQL_SELECT_SIMPLES("fone", "cad_candidato_fisico_fone", "candidato_fisico_id = '$id_a'", "ORDER BY principal DESC, time ASC", "3");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$arr_fone[] = $linha1["fone"];	
		}//while
		if(isset($arr_fone)){ $linha["telefones"] = $arr_fone; }
		unset($arr_cel);
		$resu1 = fSQL::SQL_SELECT_SIMPLES("celular", "cad_candidato_fisico_celular", "candidato_fisico_id = '$id_a'", "ORDER BY principal DESC, time ASC", "3");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$arr_cel[] = $linha1["celular"];
		}//while
		if(isset($arr_cel)){ $linha["celulares"] = $arr_cel; }		
		unset($arr_email);
		$resu1 = fSQL::SQL_SELECT_SIMPLES("email", "cad_candidato_fisico_email", "candidato_fisico_id = '$id_a'", "ORDER BY principal DESC, time ASC", "3");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$arr_email[] = $linha1["email"];	
		}//while
		if(isset($arr_email)){ $linha["emails"] = $arr_email; }
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaCandidatoFisico
if($P_metodo == "consultaCandidatoFisico"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaCandidatoFisico($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<




































































//MÉTODO QUE BUSCA LISTA CANDIDATO JURÍDICO - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, rm, nome, cnpj
function consultaCandidatoJuridico($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_rm = fGERAL::limpaCode(getpost_sql($ARR["rm"]));
	$f_nome = getpost_sql($ARR["nome"]);
	$f_cnpj = getpost_sql($ARR["cnpj"],"DOC");
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "T.legenda AS tipo_empresa,J.id,J.code,J.propriedade_id,J.nome,J.fantasia,J.cnpj,J.insc_estadual,J.insc_municipal,J.data_abertura,J.admin_candidato_fisico_id,J.admin_candidato_juridico_id,J.sync AS time,E.numero,E.lote,E.quadra,E.complemento,E.logradouro,E.bairro,E.uf,I.cidade_nome AS cidade,E.cep,CNA.codigo AS cnae_codigo,CNA.legenda AS cnae_descricao"; //campos da tabela
	
	
	//echo "<BR><BR>RECURSO TEMPORARIAMENTE INDISPONÍVEL :)<BR>";
	$SQL_campos = "T.legenda AS tipo_empresa,J.id,J.code,J.propriedade_id,J.fantasia,J.cnpj,J.insc_estadual,J.insc_municipal,J.admin_candidato_fisico_id,J.admin_candidato_juridico_id,J.sync AS time,E.numero,E.lote,E.quadra,E.complemento,E.logradouro,CNA.codigo AS cnae_codigo"; //campos da tabela
	$SQL_tabela = "cad_candidato_juridico J"; //tabela
	$SQL_join = "LEFT JOIN cad_candidato_juridico_tipo T ON J.tipo_id = T.id LEFT JOIN cad_candidato_juridico_endereco E ON J.id = E.candidato_juridico_id LEFT JOIN combo_cidades I ON E.cidade_id = I.id LEFT JOIN combo_cnae_subclasse CNA ON J.cnae_principal = CNA.id"; //join
	$SQL_where = ""; //condição
	$ORDEM_C = "J.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY J.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	
		
	
	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " J.sync >= '$timei' AND J.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_rm
	if($f_rm != ""){
			$aCode = fGERAL::codeRandRetorno($f_rm);
			$filtro_leg .= "\n - Busca ".SYS_CONFIG_RM_SIGLA." <b>$f_rm</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( J.`id` = '".$aCode["id"]."' AND J.`code` = '".$aCode["code"]."' ) "; //condição 
	}//fim da busca por f_rm
			
	//verifica se recebeu uma solicitação de busca por nome
	if($f_nome != ""){
			$filtro_leg .= "\n - Busca por <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( J.`nome` LIKE '%".$f_nome."%' OR J.`fantasia` LIKE '%".$f_nome."%' ) "; //condição  
	}//fim da busca por nome
			
	//verifica se recebeu uma solicitação de busca por cnpj
	if($f_cnpj != ""){
			$filtro_leg .= "\n -Busca CPF <b>$f_cnpj</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( J.`cnpj` LIKE '%$f_cnpj%' ) "; //condição 
	}//fim da busca por f_cnpj


	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){		
		$id_a = $linha["id"];
		$linha["rm"] = fGERAL::legCode($linha["id"],$linha["code"]); unset($linha["id"],$linha["code"]);	
		$linha["data_abertura"] = data_mysql($linha["data_abertura"]);		
		///pega insformações do responsável físico ou jurídico
		$linha["responsavel"] = "NAO DEFINIDO";
		$linha["responsavel_rm"] = "";
		$linha["responsavel_nome"] = "NÃO DEFINIDO";
		if($linha["admin_candidato_fisico_id"] >= "1"){
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome,cpf", "cad_candidato_fisico", "id = '".$linha["admin_candidato_fisico_id"]."'");
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$linha["responsavel"] = "FÍSICO";
				$linha["responsavel_rm"] = fGERAL::legCode($linha1["id"],$linha1["code"]);
				$linha["responsavel_nome"] = $linha1["nome"];
				$linha["responsavel_cpf"] = $linha1["cpf"];
			}//fim while
		}//if($linha["admin_candidato_fisico_id"] >= "1"){	
		if($linha["admin_candidato_juridico_id"] >= "1"){
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome,cnpj", "cad_candidato_juridico", "id = '".$linha["admin_candidato_juridico_id"]."'");
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$linha["responsavel"] = "JURÍDICO";
				$linha["responsavel_rm"] = fGERAL::legCode($linha1["id"],$linha1["code"]);
				$linha["responsavel_nome"] = $linha1["nome"];
				$linha["responsavel_cnpj"] = $linha1["cnpj"];
			}//fim while
		}//if($linha["admin_candidato_juridico_id"] >= "1"){
		unset($linha["admin_candidato_fisico_id"],$linha["admin_candidato_juridico_id"]);
		
		//verifica se precisa pegar a propriedade
		if($linha["propriedade_id"] >= "1"){
			$campos = "A.quadra,A.lote,L.legenda AS logradouro,N.numero";
			$SQL_join = "INNER JOIN geo_area A INNER JOIN geo_area_logradouro L JOIN geo_propriedade_numerooficial N ON P.id = N.propriedade_id AND N.principal = '1'"; //join
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, "geo_propriedade P", "P.id = '".$linha["propriedade_id"]."' AND P.area_id = A.id AND A.logradouro_id = L.id", "GROUP BY P.id ORDER BY A.id DESC","1", $SQL_join);
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$linha["quadra"] = $linha1["quadra"];
				$linha["lote"] = $linha1["lote"];
				$linha["logradouro"] = $linha1["logradouro"];
				$linha["numero"] = $linha1["numero"];
				$linha["uf"] = SYS_CLIENTE_UF;
				$linha["cidade"] = SYS_CLIENTE_NOME_RESUMIDO;
				unset($linha["cep"]);
			}//fim while		
		}//if($linha["propriedade_id"] >= "1"){*/
		unset($linha["propriedade_id"]);
		
		//pega informações de contato
		unset($arr_fone);
		$resu1 = fSQL::SQL_SELECT_SIMPLES("fone", "cad_candidato_juridico_fone", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC", "3");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$arr_fone[] = $linha1["fone"];	
		}//while
		if(isset($arr_fone)){ $linha["telefones"] = $arr_fone; }
		unset($arr_cel);
		$resu1 = fSQL::SQL_SELECT_SIMPLES("celular", "cad_candidato_juridico_celular", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC", "3");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$arr_cel[] = $linha1["celular"];
		}//while
		if(isset($arr_cel)){ $linha["celulares"] = $arr_cel; }		
		unset($arr_email);
		$resu1 = fSQL::SQL_SELECT_SIMPLES("email", "cad_candidato_juridico_email", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC", "3");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$arr_email[] = $linha1["email"];	
		}//while
		if(isset($arr_email)){ $linha["emails"] = $arr_email; }
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaCandidatoJuridico
if($P_metodo == "consultaCandidatoJuridico"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaCandidatoJuridico($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA ZONA TBI DE ÁREAS - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, id, nome
function consultaGeoZonaTbi($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_id = (int)getpost_sql($ARR["id"]);
	$f_nome = getpost_sql($ARR["nome"]);
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "id,legenda AS nome,sync AS time"; //campos da tabela
	$SQL_tabela = "geo_area_zonaitbi"; //tabela
	$SQL_join = ""; //join
	$SQL_where = ""; //condição
	$ORDEM_C = "sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = ""; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	

	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " sync >= '$timei' AND sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_id
	if($f_id != ""){
			$filtro_leg .= "\n - Busca ID <b>$f_id</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( `id` = '".$f_id."' ) "; //condição 
	}//fim da busca por f_id
	
			
	//verifica se recebeu uma solicitação de busca por nome
	if($f_nome != ""){
			$filtro_leg .= "\n -Busca nome <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( `legenda` LIKE '%$f_nome%' ) "; //condição 
	}//fim da busca por f_nome
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaGeoZonaTbi
if($P_metodo == "consultaGeoZonaTbi"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaGeoZonaTbi($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA SETOR DE ÁREAS - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, id, nome
function consultaGeoSetor($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_id = (int)getpost_sql($ARR["id"]);
	$f_nome = getpost_sql($ARR["nome"]);
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "id,legenda AS nome,sync AS time"; //campos da tabela
	$SQL_tabela = "geo_area_setor"; //tabela
	$SQL_join = ""; //join
	$SQL_where = ""; //condição
	$ORDEM_C = "sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = ""; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	

	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " sync >= '$timei' AND sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_id
	if($f_id != ""){
			$filtro_leg .= "\n - Busca ID <b>$f_id</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( `id` = '".$f_id."' ) "; //condição 
	}//fim da busca por f_id
	
			
	//verifica se recebeu uma solicitação de busca por nome
	if($f_nome != ""){
			$filtro_leg .= "\n -Busca nome <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( `legenda` LIKE '%$f_nome%' ) "; //condição 
	}//fim da busca por f_nome
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaGeoSetor
if($P_metodo == "consultaGeoSetor"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaGeoSetor($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA BAIRRO DE ÁREAS - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, id, nome
function consultaGeoBairro($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_id = (int)getpost_sql($ARR["id"]);
	$f_nome = getpost_sql($ARR["nome"]);
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "id,legenda AS nome,sync AS time"; //campos da tabela
	$SQL_tabela = "geo_area_bairro"; //tabela
	$SQL_join = ""; //join
	$SQL_where = ""; //condição
	$ORDEM_C = "sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = ""; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	

	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " sync >= '$timei' AND sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_id
	if($f_id != ""){
			$filtro_leg .= "\n - Busca ID <b>$f_id</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( `id` = '".$f_id."' ) "; //condição 
	}//fim da busca por f_id
	
			
	//verifica se recebeu uma solicitação de busca por nome
	if($f_nome != ""){
			$filtro_leg .= "\n -Busca nome <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( `legenda` LIKE '%$f_nome%' ) "; //condição 
	}//fim da busca por f_nome
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaGeoBairro
if($P_metodo == "consultaGeoBairro"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaGeoBairro($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA LOGRADOURO DE ÁREAS - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, id, nome
function consultaGeoLogradouro($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_id = (int)getpost_sql($ARR["id"]);
	$f_nome = getpost_sql($ARR["nome"]);
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "L.id,T.legenda AS tipo,L.legenda AS nome,L.sync AS time"; //campos da tabela
	$SQL_tabela = "geo_area_logradouro L, geo_area_logradouro_tipo T"; //tabela
	$SQL_join = ""; //join
	$SQL_where = "L.tipo_id = T.id"; //condição
	$ORDEM_C = "L.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY L.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	
	
	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " L.sync >= '$timei' AND L.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_id
	if($f_id != ""){
			$filtro_leg .= "\n - Busca ID <b>$f_id</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( L.`id` = '".$f_id."' ) "; //condição 
	}//fim da busca por f_id
	
			
	//verifica se recebeu uma solicitação de busca por nome
	if($f_nome != ""){
			$filtro_leg .= "\n -Busca nome <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( L.`legenda` LIKE '%$f_nome%' ) "; //condição 
	}//fim da busca por f_nome
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaGeoLogradouro
if($P_metodo == "consultaGeoLogradouro"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaGeoLogradouro($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA ÁREAS - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, rm, quadra, lote, bairro
function consultaGeoAreas($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_rm = fGERAL::limpaCode(getpost_sql($ARR["rm"]));
	$f_quadra = getpost_sql($ARR["quadra"]);
	$f_lote = getpost_sql($ARR["lote"]);
	$f_bairro = getpost_sql($ARR["bairro"]);
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "A.id,A.code,ZT.legenda AS zona_tbi,P.legenda AS posicao_area,S.legenda AS setor,B.legenda AS bairro,T.legenda AS logradouro_tipo,L.legenda AS logradouro,A.quadra,A.lote,A.lat AS latitude,A.long AS longitide,A.area AS area_terreno,A.medida_profundidade,A.medida_lateral_direita,A.medida_lateral_esquerda,A.medida_frente,A.medida_fundo,A.medida_chanfrado,A.sync AS time"; //campos da tabela
	$SQL_tabela = "geo_area A, geo_area_zonaitbi ZT, geo_area_posicao P, geo_area_setor S, geo_area_bairro B, geo_area_logradouro L, geo_area_logradouro_tipo T"; //tabela
	$SQL_join = ""; //join
	$SQL_where = "A.zonaitbi_id = ZT.id AND A.posicao_id = P.id AND A.setor_id = S.id AND A.bairro_id = B.id AND A.logradouro_id = L.id AND L.tipo_id = T.id"; //condição
	$ORDEM_C = "A.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY A.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	

	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " A.sync >= '$timei' AND A.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_rm
	if($f_rm != ""){
			$aCode = fGERAL::codeRandRetorno($f_rm);
			$filtro_leg .= "\n - Busca ".SYS_CONFIG_RM_SIGLA." <b>$f_rm</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( A.`id` = '".$aCode["id"]."' AND A.`code` = '".$aCode["code"]."' ) "; //condição 
	}//fim da busca por f_rm
			
	//verifica se recebeu uma solicitação de busca por quadra
	if($f_quadra != ""){
			$filtro_leg .= "\n - Busca Qd. <b>$f_quadra</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( A.`quadra` LIKE '%$f_quadra%' ) "; //condição 
	}//fim da busca por quadra
			
	//verifica se recebeu uma solicitação de busca por lote
	if($f_lote != ""){
			$filtro_leg .= "\n -Busca Lt. <b>$f_lote</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( A.`lote` LIKE '%$f_lote%' ) "; //condição 
	}//fim da busca por lote
	
			
	//verifica se recebeu uma solicitação de busca por bairro
	if($f_bairro != ""){
			$filtro_leg .= "\n -Busca bairro/setor <b>$f_bairro</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( S.`legenda` LIKE '%$f_bairro%' OR B.`legenda` LIKE '%$f_bairro%' ) "; //condição 
	}//fim da busca por f_bairro
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){		
		$id_a = $linha["id"];
		$linha["rm"] = fGERAL::legCode($linha["id"],$linha["code"]); unset($linha["id"],$linha["code"]);
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaGeoAreas
if($P_metodo == "consultaGeoAreas"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaGeoAreas($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<






















































//MÉTODO QUE BUSCA LISTA EDIFÍCIOS DE PROPRIEDADES - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, id, nome
function consultaProEdificio($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_id = (int)getpost_sql($ARR["id"]);
	$f_nome = getpost_sql($ARR["nome"]);
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "E.id,B.nome AS bloco_nome,E.nome,E.qtd_pavimentos,E.qtd_elevadores,E.data_inaugura AS data_inauguracao,E.sync AS time"; //campos da tabela
	$SQL_tabela = "geo_propriedade_edificio E, geo_propriedade_edificio_bloco B"; //tabela
	$SQL_join = ""; //join
	$SQL_where = "E.bloco_id = B.id"; //condição
	$ORDEM_C = "E.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY E.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	
	
	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " E.sync >= '$timei' AND E.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_id
	if($f_id != ""){
			$filtro_leg .= "\n - Busca ID <b>$f_id</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( E.`id` = '".$f_id."' ) "; //condição 
	}//fim da busca por f_id
	
			
	//verifica se recebeu uma solicitação de busca por nome
	if($f_nome != ""){
			$filtro_leg .= "\n -Busca nome <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( E.`nome` LIKE '%$f_nome%' ) "; //condição 
	}//fim da busca por f_nome
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		$linha["data_inauguracao"] = data_mysql($linha["data_inauguracao"]);
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaProEdificio
if($P_metodo == "consultaProEdificio"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaProEdificio($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA PROPRIEDADES - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, rm, cpf, cnpj, bairro, numero
function consultaProPropriedade($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_rm = fGERAL::limpaCode(getpost_sql($ARR["rm"]));
	$f_cpf = getpost_sql($ARR["cpf"],"DOC");
	$f_cnpj = getpost_sql($ARR["cnpj"],"DOC");
	$f_bairro = getpost_sql($ARR["bairro"]);
	$f_numero = getpost_sql($ARR["numero"]);
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "P.id,P.code,P.area_id,P.edificio_id,P.escritura_id,P.medida_profundidade,P.medida_lateral_direita,P.medida_lateral_esquerda,P.medida_frente,P.medida_fundo,P.medida_chanfrado,P.area_aberta_coberta,P.area_edificada,P.area_comum,P.area_construida_total,P.area_verde,P.fracao_ideal,P.ano_edificacao,P.codigo_antigo,P.sync AS time,T.legenda AS tipo,CF.nome AS fis_nome,CF.datan AS fis_data,CF.cpf AS fis_doc,CJ.fantasia AS jur_nome,CJ.data_abertura AS jur_data,CJ.cnpj AS jur_doc,V.valor_venal_total,V.data AS valor_venal_data,A.code AS area_code,A.quadra,A.lote,L.legenda AS logradouro,N.numero,B.legenda AS bairro"; //campos da tabela
	$SQL_tabela = "geo_propriedade P"; //tabela
	$SQL_join = "INNER JOIN geo_propriedade_tipo T INNER JOIN geo_area A INNER JOIN geo_area_logradouro L INNER JOIN geo_area_bairro B LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id LEFT JOIN cad_candidato_juridico CJ ON P.candidato_juridico_id = CJ.id LEFT JOIN geo_propriedade_valores V ON P.valores_id = V.id LEFT JOIN geo_propriedade_numerooficial N ON P.id = N.propriedade_id AND N.principal = '1'"; //join
	$SQL_where = "P.tipo_id = T.id AND P.area_id = A.id AND A.logradouro_id = L.id AND A.bairro_id = B.id"; //condição
	$ORDEM_C = "P.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC geo_area_bairro
	$SQL_group = "GROUP BY P.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	
	
	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.sync >= '$timei' AND P.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_rm
	if($f_rm != ""){
			$aCode = fGERAL::codeRandRetorno($f_rm);
			$filtro_leg .= "\n - Busca ".SYS_CONFIG_RM_SIGLA." <b>$f_rm</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( A.`id` = '".$aCode["id"]."' AND A.`code` = '".$aCode["code"]."' ) "; //condição 
	}//fim da busca por f_rm

	//verifica se recebeu uma solicitação de busca por f_cpf
	if($f_cpf != ""){
			$filtro_leg .= "\n - Busca CPF <b>$f_cpf</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( CF.`cpf` LIKE '%$f_cpf%' ) "; //condição 
	}//fim da busca por f_cpf
	
			
	//verifica se recebeu uma solicitação de busca por f_cnpj
	if($f_cnpj != ""){
			$filtro_leg .= "\n - Busca CNPJ <b>$f_cnpj</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( CJ.`cnpj` LIKE '%$f_cnpj%' ) "; //condição 
	}//fim da busca por f_cnpj
	
			
	//verifica se recebeu uma solicitação de busca por f_bairro
	if($f_bairro != ""){
			$filtro_leg .= "\n - Busca bairro <b>$f_bairro</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( B.`legenda` LIKE '%$f_bairro%' ) "; //condição 
	}//fim da busca por f_bairro
	
			
	//verifica se recebeu uma solicitação de busca por f_numero
	if($f_numero != ""){
			$filtro_leg .= "\n - Busca nº <b>$f_numero</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( N.`numero` = '$f_numero' ) "; //condição 
	}//fim da busca por f_numero
	
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		$linha["rm"] = fGERAL::legCode($linha["id"],$linha["code"]); unset($linha["id"],$linha["code"]);
		$linha["valor_venal_data"] = data_mysql($linha["valor_venal_data"]);
		$edificio_id_a = $linha["edificio_id"]; unset($linha["edificio_id"]);
		$escritura_id_a = $linha["escritura_id"]; unset($linha["escritura_id"]);
		$linha["area_rm"] = fGERAL::legCode($linha["area_id"],$linha["area_code"]); unset($linha["area_id"],$linha["area_code"]);
		//verifica se tem edifício e bloco
		if($edificio_id_a >= "1"){
			$join = "LEFT JOIN geo_propriedade_edificio_bloco B ON E.bloco_id = B.id"; //join
			$resuM = fSQL::SQL_SELECT_SIMPLES("E.nome,B.nome AS bloco", "geo_propriedade_edificio E", "E.id = '$edificio_id_a'", "","",$join);
			while($linh1a = fSQL::FETCH_ASSOC($resuM)){
				$linha["edificio_nome"] = $linha1["nome"];
				if($linha1["bloco"] != ""){ $linha["edificio_bloco"] = $linha1["bloco"]; }
			}//fim while
		}//if($edificio_id_a >= "1"){
		//verifica dados da escritura	
		if($escritura_id_a >= "1"){
			$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,cartorio,matriculacri,escritura_livro,escritura_folha", "geo_propriedade_escritura", "id = '$escritura_id_a'");
			while($linha1 = fSQL::FETCH_ASSOC($resuM)){
				$leg_i = "";
				if($linha1["matriculacri"] != ""){ if($leg_i == ""){ 	$leg_i .= ", "; }else{ $leg_i .= ", "; } $leg_i .= "CRI: ".$linha1["matriculacri"];	 }
				if($linha1["escritura_livro"] != ""){ if($leg_i == ""){ $leg_i .= ", "; }else{ $leg_i .= ", "; } $leg_i .= "Livro: ".$linha1["escritura_livro"]; }
				if($linha1["escritura_folha"] != ""){ if($leg_i == ""){ $leg_i .= ", "; }else{ $leg_i .= ", "; } $leg_i .= "Folha: ".$linha1["escritura_folha"]; }
				$linha["escritura"] = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($linha1["id"],$linha1["code"])." - ".$linha1["cartorio"].$leg_i;
			}//fim while
		}//if($escritura_id_a >= "1"){
	
		//dados do proprietário
		if($linha["fis_nome"] != ""){
			$linha["proprietario_tipo"] = "FÍSICO";
			$linha["proprietario_nome"] = $linha["fis_nome"];
			$linha["proprietario_nascimento"] = data_mysql($linha["fis_data"]);
			$linha["proprietario_cpf"] = $linha["fis_doc"];
		}
		if($linha["jur_nome"] != ""){
			$linha["proprietario_tipo"] = "JURÍDICO";
			$linha["proprietario_nome"] = $linha["jur_nome"];
			$linha["proprietario_abertura"] = data_mysql($linha["jur_data"]);
			$linha["proprietario_cnpj"] = $linha["jur_doc"];
		}
		unset($linha["jur_nome"],$linha["jur_data"],$linha["jur_doc"],$linha["fis_nome"],$linha["fis_data"],$linha["fis_doc"]);
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaProPropriedade
if($P_metodo == "consultaProPropriedade"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaProPropriedade($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA PROCESSOS - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, situacao, rm, nome, tipo_id
function consultaProcesso($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_situacao = getpost_sql($ARR["situacao"]);
	$f_rm = fGERAL::limpaCode(getpost_sql($ARR["rm"]));
	$f_nome = getpost_sql($ARR["nome"]);
	$f_tipo_id = getpost_sql($ARR["tipo_id"]);
	//verifica ano selecionado
	if(($f_situacao == "encubado") or ($f_situacao == "arquivado")){
		$ano_b = $f_ano; $f_ano = "";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "protocolo_arquivo_anos", "ano = '$ano_b'", "", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$f_ano = $linha1["ano"];
		}//fim while
		if($f_ano == ""){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "protocolo_arquivo_anos", "", "ORDER BY ano DESC", "1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$f_ano = $linha1["ano"];
			}//fim while
		}//if($f_ano == ""){		
	}//if(($f_situacao == "encubado") or ($f_situacao == "arquivado")){
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//verifica situacao ///////////////////////////////////////////////////////////
	$situacao = "EM EXECUÇÃO";
	if($f_situacao == "execucao"){
		$SQL_tabela = "protocolo_executando P"; //tabela
	}
	if(($f_situacao == "encubado") or ($f_situacao == "arquivado")){		
		$SQL_tabela = "protocolo_arquivo_".$f_ano." P"; //tabela	
		$situacao = maiusculo($f_situacao);	
	}
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "P.id,P.code,P.ano,P.mes,P.dia,P.cont,P.perfil_i AS perfil_inicial,P.perfil_a AS perfil_atual,P.propriedade_id,P.sigilo,P.apensado,P.status,P.time AS time_criado,P.sync AS time_alteracao,T.nome AS tipo,P.tipo_id,DI.nome AS depto_inicial,D.nome AS depto_atual,CF.nome AS fis_nome,CF.cpf AS fis_doc,CJ.fantasia AS jur_nome,CJ.cnpj AS jur_doc,PRO.code AS propriedade_code,PRO_T.legenda AS propriedade_tipo,PRO_A.quadra AS propriedade_quadra,PRO_A.lote AS propriedade_lote,PRO_L.legenda AS propriedade_logradouro,PRO_B.legenda AS propriedade_bairro"; //campos da tabela
	if($SQL_tabela == ""){ $SQL_tabela = "protocolo_executando P"; $f_situacao = "execucao"; }//tabela
	$SQL_join = "INNER JOIN adm_protocolo_tipo T INNER JOIN sys_perfil_deptos D INNER JOIN sys_perfil_deptos DI LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id LEFT JOIN cad_candidato_juridico CJ ON P.candidato_juridico_id = CJ.id LEFT JOIN geo_propriedade PRO ON P.propriedade_id = PRO.id LEFT JOIN geo_propriedade_tipo PRO_T ON PRO.tipo_id = PRO_T.id LEFT JOIN geo_area PRO_A ON PRO.area_id = PRO_A.id LEFT JOIN geo_area_logradouro PRO_L ON PRO_A.logradouro_id = PRO_L.id LEFT JOIN geo_area_bairro PRO_B ON PRO_A.bairro_id = PRO_B.id"; //join
	$SQL_where = "P.tipo_id = T.id AND P.depto_i = DI.id AND P.depto_a = D.id"; //condição
	$ORDEM_C = "P.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC geo_area_bairro
	$SQL_group = "GROUP BY P.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
	
	
	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.sync >= '$timei' AND P.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_rm
	if($f_rm != ""){
			$aCode = fGERAL::returnCode7($f_rm);
			$filtro_leg .= "\n - Busca ".SYS_CONFIG_RM_SIGLA." <b>$f_rm</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( P.`ano` = '".$aCode["ano"]."' AND P.`mes` = '".$aCode["mes"]."' AND P.`dia` = '".$aCode["dia"]."' AND P.`cont` = '".$aCode["cont"]."' ) "; //condição 
	}//fim da busca por f_rm

	//verifica se recebeu uma solicitação de busca por f_nome
	if($f_nome != ""){
			$filtro_leg .= "\n - Busca <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( P.`assunto` LIKE '%$f_nome%' OR T.`nome` LIKE '%$f_nome%' OR D.`nome` LIKE '%$f_nome%' OR CF.`nome` LIKE '%$f_nome%' OR CF.`cpf` LIKE '%".fGERAL::limpaCode($f_nome)."%' OR CJ.`fantasia` LIKE '%$f_nome%' OR CJ.`cnpj` LIKE '%".fGERAL::limpaCode($f_nome)."%' ) "; //condição
	}//fim da busca por f_nome

	//verifica se recebeu uma solicitação de busca por f_tipo_id
	if($f_tipo_id != ""){
			$filtro_leg .= "\n - Busca tipo ID <b>$f_tipo_id</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= "P.`tipo_id` = '".$f_tipo_id."'"; //condição
	}//fim da busca por f_tipo_id
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		$id_a = $linha["id"];
		$linha["propriedade_rm"] = fGERAL::legCode($linha["propriedade_id"],$linha["propriedade_code"]); unset($linha["propriedade_id"],$linha["propriedade_code"]);
		$linha["rm"] = fGERAL::legCode7($linha["ano"],$linha["mes"],$linha["dia"],$linha["cont"],$linha["code"]); 
		$linha["criado_aberto_dias"] = retornaDias($linha["dia"].'/'.$linha["mes"].'/'.$linha["ano"]);
		$linha["parado_aberto_dias"] = retornaDias(date('d/m/Y', $linha["time_alteracao"]));	

		//verifica lista de serviços ....................................................................................................................
		unset($arr_servicos);
		$where = " P.protocolo_id = '".$id_a."' AND P.servico_id = S.id"; //condição 
		//tabela de verificação
		if($f_situacao == "execucao"){ $tabela = "protocolo_executando_servico P, fin_servico S"; }else{ $tabela = "protocolo_arquivo_servico_".$f_ano." P, fin_servico S"; }
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("P.duam_ano,P.duam_mes,P.duam_dia,P.duam_cont,P.duam_code,P.status,P.user,S.id AS servico_id, S.nome AS servico", $tabela, $where, "GROUP BY P.id ORDER BY P.id DESC", "15");
		while($linha1 = fSQL::FETCH_ASSOC($resuM)){			
			//verifica DUAM
			$arrDuam = fRM::duamStatus($linha1["duam_ano"],$linha1["duam_mes"],$linha1["duam_dia"],$linha1["duam_cont"],$linha1["duam_code"]);
			if($arrDuam["status"] == "1"){
				$linha1["duam"] = fGERAL::legCodeDuam($linha1["duam_ano"],$linha1["duam_mes"],$linha1["duam_dia"],$linha1["duam_cont"],$linha1["duam_code"],1);
				$linha1["duam_valor"] = formataValor($arrDuam["valor_pagto"],"",",",".");
				$arrListaDuam[] = array("duam" => $linha1["duam"], "duam_valor" => $linha1["duam_valor"]);//duam de exibicao
			}else{ $linha1["duam"] = "0"; $linha1["duam_status"] = legDuamStatus($arrDuam["status"]); }//if($arrDuam["status"] == "1"){
			$linha1["status"] = legProtocoloStatusServico($linha1["status"]);
			unset($linha1["duam_ano"],$linha1["duam_mes"],$linha1["duam_dia"],$linha1["duam_cont"],$linha1["duam_code"],$linha1["user"],$linha1["servico_id"]);
			$arr_servicos[] = $linha1;
		}//fim while
		if(isset($arr_servicos)){ $linha["servicos"] = $arr_servicos; }



		//verifica lista de trâmite arquivos .........................................................................................................................
		unset($arr_tramitearquivos);			
		//tabela de verificação: veirifica se está na execução ou outros
		if($f_situacao == "execucao"){	
			$campos = "cont,tipo,file,time";
			$resuM = fSQL::SQL_SELECT_SIMPLES($campos, "protocolo_executando_arquivos", "protocolo_id = '".$id_a."' AND file != '' AND status != '0'", "ORDER BY cont DESC", "50");
			while($linha2 = fSQL::FETCH_ASSOC($resuM)){
				$arr_tramitearquivos[] = $linha2;
			}//fim while
		}else{//if($f_situacao == "execucao"){
			$fileCaminho = VAR_DIR_FILES."files/tabelas/protocolo/".$linha["ano"]."/".fGERAL::completaZero($linha["mes"],"2")."/".fGERAL::completaZero($linha["dia"],"2")."/".$linha["cont"]."/arquivos";
			$filesArray = fGERAL::listaArquivos($fileCaminho,"desc","0,50");			
			if(ceil(count($filesArray)) >= "1"){
				foreach($filesArray as $pos => $arquivo){
					if(($arquivo != "") and ($arquivo != "files")){
						$file_ret = file_get_contents($fileCaminho."/".$arquivo);
						if($file_ret != ""){
							unset($arr); $arr = fGERAL::jsonArray(fGERAL::logFile($file_ret,"get"),"dec");
							if(($arr["file"] != "") and ($arr["status"] != "0")){
								unset($linha2); $linha2["cont"] = $arr["cont"];
								$linha2["tipo"] = $arr["tipo"];
								$linha2["file"] = $arr["file"];
								$linha2["time"] = $arr["time"];
								$arr_tramitearquivos[] = $linha2;
							}
						}
					}//if
				}//fim foreach
			}//fim if($filesArray >= "1"){
		}//else{//if($f_situacao == "execucao"){		
		if(isset($arr_tramitearquivos)){ $linha["tramite_arquivos"] = $arr_tramitearquivos; }
		
		//remove itens do array
		unset($linha["id"],$linha["ano"],$linha["mes"],$linha["dia"],$linha["cont"],$linha["code"]);	
		//dados do solicitante
		if($linha["fis_nome"] != ""){
			$linha["solicitante_tipo"] = "FÍSICO";
			$linha["solicitante_nome"] = $linha["fis_nome"];
			$linha["solicitante_cpf"] = $linha["fis_doc"];
		}
		if($linha["jur_nome"] != ""){
			$linha["solicitante_tipo"] = "JURÍDICO";
			$linha["solicitante_nome"] = $linha["jur_nome"];
			$linha["solicitante_cnpj"] = $linha["jur_doc"];
		}
		unset($linha["jur_nome"],$linha["jur_doc"],$linha["fis_nome"],$linha["fis_doc"]);
		$linha["situacao"] = $situacao;
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaProcesso
if($P_metodo == "consultaProcesso"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaProcesso($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<




































//MÉTODO QUE BUSCA FOLHA DE ROSTO DE PROCESSO - ARR: rm
function consultaProcessoFolhaRostoPDF($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_rm = getpost_sql($ARR["rm"]);
	$arrRet["valida"] = "0";
	$aCode = fGERAL::returnCode7($f_rm);
	if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		
			//INICIA FUNÇÃO DE CLASSE DE PROTOCOLO +++
			$CLASS = fRM::classProtocolo($f_rm,"WEB SERVICE","0","../../");
			if($CLASS["encontrou"] >= "1"){
				
				
				//CLASSE #######=> dados para manipulação
				$CLASS["protocolo"]->loadLinhaDados();//loadLinhaDados() - CARREGA LINHA DE DADOS
				$code_RM = $CLASS["protocolo"]->getLinha("code_rm");
				
//monta linha de dados ------------------------------------------------------------------------------------------------------
	//adiciona dados a montagem do PDF
	unset($d); $d["content"] = '<table width="100%" align="center" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td style="text-align:justify; font-size:16px; padding:20px;">Eu <b>'.$CLASS["protocolo"]->getLinha("fis_nome").', CPF '.$CLASS["protocolo"]->getLinha("fis_doc").'</b> declaro que todas as informações fornecidas no processo  '.SYS_CONFIG_RM_SIGLA.' '.$code_RM.' são verdadeiras, corretas e completas.
Confirmo ainda ter ciência do compromisso assumido de comprimir as solicitações do processo registrado em <b>'.date('d/m/Y H:i', $CLASS["protocolo"]->getLinha("time")).'h</b> sobre o número <b>'.SYS_CONFIG_RM_SIGLA.' '.$code_RM.'</b>.</td>
    </tr>
	<tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="50%" height="34" align="center" valign="bottom">__________________________________________________</td>
      <td width="50%" align="center" valign="bottom">________________________________________________</td>
    </tr>
    <tr>
      <td align="center" style="font-size:11px;">'.$CLASS["protocolo"]->getLinha("fis_nome").'</td>
      <td align="center" style="font-size:11px;">TESTEMUNHA (atendente)</td>
    </tr>
</table></td>
    </tr>
</table>'; $d["type"] = "html"; $PRINT_ARRAY[] = $d;

//alimenta o array de impressão
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = "TERMO DE SOLICITAÇÃO/FOLHA DE ROSTO DO PROCESSO"; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);

//monta nomes de solicitante e interessado
if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
	$linhaSolicitante = '
    <tr>
      <td><b>Requerente/solic.</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("jur_nome").", CNPJ ".$CLASS["protocolo"]->getLinha("jur_doc").'</td>
    </tr>
    <tr>
      <td><b>Interessado</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("fis_nome").", CPF ".$CLASS["protocolo"]->getLinha("fis_doc").'</td>
    </tr>';
}else{//if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
	$linhaSolicitante = '
    <tr>
      <td><b>Requerente/solic.</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("fis_nome").", CPF ".$CLASS["protocolo"]->getLinha("fis_doc").'</td>
    </tr>';
}//else{//if($CLASS["protocolo"]->getLinha("jur_nome") != ""){

//monta linha de dados ------------------------------------------------------------------------------------------------------
	//adiciona dados a montagem do PDF
	unset($d); $d["content"] = '<table width="98%" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="78%"><table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td width="26%"><b>Número '.SYS_CONFIG_RM_SIGLA.'</b></td>
      <td width="74%">'.$code_RM.'</td>
    </tr>
    <tr>
      <td width="26%"><b>Data de criação</b></td>
      <td width="74%">'.date('d/m/Y H:i', $CLASS["protocolo"]->getLinha("time")).'h</td>
    </tr>
    '.$linhaSolicitante.'
    <tr>
      <td><b>Tipo de solicitação</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("tipo_nome").'</td>
    </tr>
    <tr>
      <td><b>Assunto</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("assunto").'</td>
    </tr>
    <tr>
      <td><b>Depto de criação</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("deptoi_nome").'</td>
    </tr>
</table></td>
      <td width="22%" align="center" valign="middle" style="font-size:10px;"><img src="'.$CLASS["protocolo"]->getLinha("qr").'"/><br>[ACOMPANHE ONLINE]</td>
    </tr>
</table>'; $d["type"] = "html"; $PRINT_ARRAY[] = $d;
unset($d); $d["content"] = "3"; $d["type"] = "linha"; $PRINT_ARRAY[] = $d;//espaçamento de linha px
unset($d); $d["type"] = "borda"; $PRINT_ARRAY[] = $d;//borda horizontal

unset($d); $d["content"] = "30"; $d["type"] = "linha"; $PRINT_ARRAY[] = $d;//espaçamento de linha px

//adiciona dados a montagem do PDF
unset($d); $d["content"] = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="32" align="right"><img src="img/tesoura.png" width="30"/></td><td style="font-size:10px;">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</td></tr></table>'; $d["type"] = "html"; $PRINT_ARRAY[] = $d;

unset($d); $d["content"] = "5"; $d["type"] = "linha"; $PRINT_ARRAY[] = $d;//espaçamento de linha px
unset($d); $d["type"] = "borda"; $PRINT_ARRAY[] = $d;//borda horizontal

//alimenta o array de impressão
unset($d); $d["top"] = "10"; $PRINT_DATA[] = $d;//spacer no topo
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = "PROCESSO ".SYS_CONFIG_RM_SIGLA." ".$code_RM; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);


//monta linha de dados ------------------------------------------------------------------------------------------------------
	//adiciona dados a montagem do PDF
	unset($d); $d["content"] = '<table width="98%" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="78%"><table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td width="26%"><b>Número '.SYS_CONFIG_RM_SIGLA.'</b></td>
      <td width="74%">'.$code_RM.'</td>
    </tr>
    <tr>
      <td width="26%"><b>Data de criação</b></td>
      <td width="74%">'.date('d/m/Y H:i', $CLASS["protocolo"]->getLinha("time")).'h</td>
    </tr>
    '.$linhaSolicitante.'
    <tr>
      <td><b>Tipo de solicitação</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("tipo_nome").'</td>
    </tr>
    <tr>
      <td><b>Assunto</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("assunto").'</td>
    </tr>
    <tr>
      <td><b>Depto de criação</b></td>
      <td>'.$CLASS["protocolo"]->getLinha("deptoi_nome").'</td>
    </tr>
</table></td>
      <td width="22%" align="center" valign="middle" style="font-size:10px;"><img src="'.$CLASS["protocolo"]->getLinha("qr").'"/><br>[ACOMPANHE ONLINE]</td>
    </tr>
</table>'; $d["type"] = "html"; $PRINT_ARRAY[] = $d;

unset($d); $d["content"] = "5"; $d["type"] = "linha"; $PRINT_ARRAY[] = $d;//espaçamento de linha px

//alimenta o array de impressão
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = "PROCESSO (".maiusculo(SYS_CLIENTE_NOME_RESUMIDO).") ".SYS_CONFIG_RM_SIGLA." ".$code_RM; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);

//verifica se inclue  MULTI-GESTÃO externa ...................................................................................................................................
$multigestao_tag1 = ""; $multigestao_tag2 = ""; $multigestao_fig = VAR_DIR_FILES.'files/logos/logo_impressao.png'; $multigestao_figW = '130';
if($CLASS["protocolo"]->getLinha("multigestao_id") >= "1"){
	$multigestao_tag1 = '<tr>
	  <td width="26%"><b>Em Gestão externa</b></td>
	  <td width="74%">Está na gestão externa <b>'.$CLASS["protocolo"]->getLinha("multigestao").'</b></td>
	</tr>';
	$multigestao_tag2 = " (EM MULTI-GESTÃO EXTERNA)";
	$multigestao_fig = 'img/fig_integracao.png'; $multigestao_figW = '80';
}//if($CLASS["protocolo"]->getLinha("multigestao_id") >= "1"){

//monta linha de dados ------------------------------------------------------------------------------------------------------
//adiciona dados a montagem do PDF
unset($d); $d["content"] = '<table width="98%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="78%"><table width="100%" border="0" cellspacing="0" cellpadding="3">
   <tr>
     <td><b>Acessar/Ver Online</b></td>
     <td>'.SYS_CLIENTE_URL_EXTERNA.'</td>
   </tr>
<tr>
  <td width="26%"><b>Ajuda IMPORTANTE</b></td>
  <td width="74%">Para acompanhamento online ao acessar endereço acima, selecione a Gestão:  <b>'.maiusculo(SYS_CLIENTE_UF_NOME).'</b> >> <b>'.maiusculo(SYS_CLIENTE_NOME_RESUMIDO).'</b>. Em caso de dúvidas estamos a disposição :)</td>
'.$multigestao_tag1.'
</tr>
</table></td>
  <td width="22%" align="center" valign="middle" style="font-size:10px;"><img src="'.$multigestao_fig.'" style="width:'.$multigestao_figW.'px;"/></td>
</tr>
</table>'; $d["type"] = "html"; $PRINT_ARRAY[] = $d;	
	
//alimenta o array de impressão
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = "INSTRUÇÃO DE ACESSO ONLINE ".$multigestao_tag2; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);
				//cria e busca o PDF
				$opts = array(
					'http'=>array('header'=>"Content-type: application/x-www-form-urlencoded", 'method'=>'POST', 'content'=>http_build_query(array(
						'acao' => 'pdf',
						'nome' => "protocolo_".date('d-m-Y'),
						'titulo' => "Processo ".SYS_CONFIG_RM_SIGLA." ".$code_RM,
						'dados' => urlencode(serialize($PRINT_DATA)),
						'head' => '',
						'html' => ''
						))
				));
				$context = stream_context_create($opts);
				$file = file_get_contents(SYS_URLRAIZ.'export.php?get=1', false, $context);
				unset($arr); $arr["file"] = fWS_sendFile($file);	//prepara para envio com fWS	
							
				//VARS
				$CONT_SEND++;//contagem de envios
			}//if($CLASS["protocolo"] >= "1"){		
	}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["dados"] = $arr;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA ".SYS_CONFIG_RM_SIGLA." INFORMADO ($f_rm)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaProcessoFolhaRostoPDF
if($P_metodo == "consultaProcessoFolhaRostoPDF"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaProcessoFolhaRostoPDF($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<


































//MÉTODO QUE BUSCA MANIFESTO DO PROCESSO - ARR: rm
function consultaProcessoManifestoPDF($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_rm = getpost_sql($ARR["rm"]);
	$arrRet["valida"] = "0";
	$aCode = fGERAL::returnCode7($f_rm);
	if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		
			//INICIA FUNÇÃO DE CLASSE DE PROTOCOLO +++
			$CLASS = fRM::classProtocolo($f_rm,"WEB SERVICE","0","../../");
			if($CLASS["encontrou"] >= "1"){
				
			//CLASSE #######=> dados para manipulação
			$CLASS["protocolo"]->loadLinhaDados();//loadLinhaDados() - CARREGA LINHA DE DADOS
			$code_RM = $CLASS["protocolo"]->getLinha("code_rm");
			
			//monta o manifesto
			$html_manifesto = "";
			$cont_total_arq = "0";//contagem de total de arquivos
	
			$html_manifesto .= '
<div style="padding:5px; font-size:14px; font-weight:bold; text-align:center;">MANIFESTO DE PROCESSO '.SYS_CONFIG_RM_SIGLA.' '.$code_RM.'</div>
<div style="padding:5px; font-size:16px; text-decoration:underline; font-weight:bold; text-align:center;">'.$CLASS["protocolo"]->getLinha("tipo_nome").'</div><br>
<p style="text-indent:40px; font-size:14px;">Processo registrado  sobe o número '.SYS_CONFIG_RM_SIGLA.' '.$code_RM.'  na data <strong>'.nome_data(date('d/m/Y', $CLASS["protocolo"]->getLinha("time"))).'</strong> no qual foi solicitado por ';

			//monta nomes de solicitante e interessado
			if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
				$html_manifesto .= '<strong>'.$CLASS["protocolo"]->getLinha("jur_nome").', CNPJ '.$CLASS["protocolo"]->getLinha("jur_doc").'</strong>, tendo como  interessado <strong>'.$CLASS["protocolo"]->getLinha("fis_nome").', CPF '.$CLASS["protocolo"]->getLinha("fis_doc").'</strong>';
			
			}else{//if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
				$html_manifesto .= '<strong>'.$CLASS["protocolo"]->getLinha("fis_nome").', CPF '.$CLASS["protocolo"]->getLinha("fis_doc").'</td></strong>';
			
			}//else{//if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
			$html_manifesto .= '. Nessa data foi aberto um processo para tratar do  assunto <strong>'.$CLASS["protocolo"]->getLinha("assunto").'</strong>, o processo foi criado no sistema pelo servidor/colaborador(a)  '.SYS_CONFIG_RM_SIGLA.maiusculo($CLASS["protocolo"]->getLinha("user")).' no departamento '.maiusculo($CLASS["protocolo"]->getLinha("deptoi_nome")).'.</p>
<p style="text-indent:40px; font-size:14px;">Existiu uma tramitação entre  departamentos onde foi enviado ao departamento';  

			//monta legenda/informações do mapa detramitação
			$tipo_tramitacao = arrayDB($CLASS["protocolo"]->getLinha("tipo_tramitacao"));
			$mapa_tramitacao = arrayDB($CLASS["protocolo"]->getDat("mapa_tramitacao"));
			$cont = "0";
			//monta array de dados
			$array = explode(",",$mapa_tramitacao);
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				foreach($array as $pos => $valor){
					if($valor != ""){
						$arrSb = explode("-", $valor);
						//se tem depto definido, busca os  dados
						if($arrSb["2"] >= "1"){			
							$cont++;					
							//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
							$resuM = fSQL::SQL_SELECT_SIMPLES("D.code,D.nome,P.nome AS perfil_nome", "sys_perfil_deptos D, sys_perfil P", "D.id = '".$arrSb["2"]."' AND D.perfil_id = P.id", "GROUP BY D.id");
							while($linha = fSQL::FETCH_ASSOC($resuM)){
								$depto_leg = "<strong>".$linha["nome"]."</strong> (".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($arrSb["2"],$linha["code"]).", ".$linha["perfil_nome"].")";
								
								if($cont > "1"){ $html_manifesto .= ', depois para '; }
								$html_manifesto .= maiusculo($depto_leg).' em '.date('d/m/Y',$arrSb["3"]);
								if($arrSb["0"] >= "1"){ $html_manifesto .= '[SEGUIU MAPA DE TRAMITAÇÃO]'; }
								if(($tipo_tramitacao != "") and ($tipo_tramitacao != "NULL") and ($arrSb["0"] == "0")){ $html_manifesto .= '[TRAMITOU FORA DO MAPA]'; }
							}//fim while
						}//if($arrSb["2"] >= "1"){
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){

			//se existe responsável pelo processo
			if($CLASS["protocolo"]->getLinha("user_id") >= "1"){
				$html_manifesto .= ",  com a responsabilidade do servidor/colaborador(a) ".maiusculo(fRM::dadosUser($CLASS["protocolo"]->getLinha("user_id"),"rmNome"));			
			}//if($CLASS["protocolo"]->getLinha("user_id") >= "1"){
  
			$html_manifesto .= '.</p><p style="text-indent:40px; font-size:14px;">Hoje, '.nome_data(date('d/m/Y')).' às '.date('H:i').'hs a situação  do processo é <strong>'.maiusculo($CLASS["protocolo"]->getLinha("situacao")).'</strong>,  com o status atual de <strong>'.legProtocoloStatus($CLASS["protocolo"]->getLinha("status")).'</strong>.';
			if($CLASS["protocolo"]->getLinha("dias_criado") >= "1"){
				$html_manifesto .= " De sua criação até a última interação que ele recebeu, passaram-se ".$CLASS["protocolo"]->getLinha("dias_criado")." dias";
			}else{
				$html_manifesto .= "Foi criado hoje";
			}
			$html_manifesto .= "e o mesmo permanece parado desde ".nome_data(date('d/m/Y', $CLASS["protocolo"]->getLinha("sync")))." às ".date('H:i', $CLASS["protocolo"]->getLinha("sync"))."hs.</p>";

			//lista serviços do processo
			//CLASSE #######=> dados para manipulação
			$servicosArray = $CLASS["protocolo"]->getServicos("0,500","servico_code");//getServicos() - CARREGA ARRAY DE SERVIÇOS
			//echo "DADOS:<pre>"; print_r($servicosArray); echo "</pre>";
			$cont_servicos = "0"; $html_servicos = "";
			//monta array de dados
			$array = $servicosArray["dados"];
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				foreach($array as $pos => $valor){
					if($valor != ""){
						$cont_servicos++;
						$html_servicos .= '<div style="text-indent:5px; font-size:13px;">'.$valor["cont"].'. <strong>'.$valor["servico"].'</strong> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($valor["servico_id"],$valor["servico_code"]).');</div>';
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){

			//lita de notificações do processo
			//CLASSE #######=> dados para manipulação
			$notificacaoArray = $CLASS["protocolo"]->getNotificacaoLista("0,500");//getNotificacaoLista() - CARREGA ARRAY DE NOTIFICAÇÕES
			//echo "DADOS:<pre>"; print_r($notificacaoArray); echo "</pre>";
			$cont_notificacao = "0"; $html_notificacao = "";
			//monta array de dados
			$array = $notificacaoArray["lista"];
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				foreach($array as $pos => $valor){
					if($valor != ""){
						$cont_notificacao++;	
						$html_notificacao .= '<div style="text-indent:5px; font-size:13px;">'.$cont_notificacao.'. <strong>'.$valor["nome"].'</strong> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode9($valor["rm"]).');</div>';
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){

			//lista de trâmite de arquivos no processo
			//CLASSE #######=> dados para manipulação
			$arqivosArray = $CLASS["protocolo"]->getTamiteArquivos("0,500","export");//getPublicacoes() - CARREGA ARRAY DE ARQUIVOS
			//echo "DADOS:<pre>"; print_r($arqivosArray); echo "</pre>";
			$cont_arquivos = "0"; $html_arquivos = "";
			//monta array de dados
			$array = $arqivosArray["lista"];
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				foreach($array as $pos => $valor){
					if($valor["file"] != ""){
						$cont_arquivos++;		
						$html_arquivos .= '<div style="text-indent:5px; font-size:13px;">'.$valor["cont"].'. <b>'.maiusculo(fGERAL::mostraExtensao($valor["file"])).'</b> <i>('.$valor["file"].')</i></div>';
						$cont_total_arq++;//contagem de total de arquivos
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){ 

			//publicações do processo
			//CLASSE #######=> dados para manipulação
			$publicaArray = $CLASS["protocolo"]->getPublicacoes("0,1");//getPublicacoes() - CARREGA ARRAY DE PUBLICAÇÕES
			//echo "DADOS:<pre>"; print_r($publicaArray); echo "</pre>";
			$cont_publica = $publicaArray["cont"];

			//eventos do processo
			//CLASSE #######=> dados para manipulação
			$eventosArray = $CLASS["protocolo"]->getEventos("0");//getEventos() - CARREGA ARRAY DE EVENTOS	
			$cont_evento = $eventosArray["cont"];	

			//monta informações coletadas acima
			$html_manifesto .= '<p style="text-indent:40px; font-size:14px;">No processo temos';
			if($html_servicos != ""){ $html_manifesto .= $cont_servicos.' serviço'; if($cont_servicos > "1"){ $html_manifesto .= 's'; } $html_manifesto .= ' adicionado'; if($cont_servicos > "1"){ $html_manifesto .= 's'; } }
			if($html_notificacao != ""){ $html_manifesto .= ', registrados '.$cont_notificacao.' notificaç';  if($cont_notificacao > "1"){ $html_manifesto .= 'ões'; }else{ $html_manifesto .= 'ão'; } }
			if($html_arquivos != ""){ $html_manifesto .= ',  '.$cont_arquivos.' arquivo'; if($cont_arquivos > "1"){ $html_manifesto .= 's'; } $html_manifesto .= ' já adicionado'; if($cont_arquivos > "1"){ $html_manifesto .= 's'; } $html_manifesto .= '/anexado'; if($cont_arquivos > "1"){ $html_manifesto .= 's'; } }
			if($cont_publica >= "1"){ $html_manifesto .= ', '; if($cont_publica > "1"){ $html_manifesto .= 'foram realizadas'; }else{ $html_manifesto .= 'foi realizado'; } $html_manifesto .= ' '.$cont_publica.' publicaç'; if($cont_publica > "1"){ $html_manifesto .= 'ões'; }else{ $html_manifesto .= 'ão'; } }
			$html_manifesto .= ', no total  aconteceram '.$cont_evento.'  eventos na linha do tempo do processo.</p>';

			//texto/descrição do processo
			$texto_a = $CLASS["protocolo"]->getTexto();//getTexto() - CARREGA TEXTO
			if($texto_a != ""){
				$html_manifesto .= '<p style="text-indent:40px; font-size:14px;">Ao detalhar o processo  encontramos uma descrição adicionada em sua abertura:</p>'.$texto_a.'<p></p><p></p>';
			}//if($texto_a != ""){

			if($html_servicos != ""){
				$cont_total_arq++;//contagem de total de arquivos
				$html_manifesto .= '<p></p>
			<div style="text-indent:40px; font-size:14px;">Nos serviços adicionados ao processo, temos:</div>
			'.$html_servicos.'
			<div style="font-size:14px;">';
				if($cont_servicos > "1"){ $html_manifesto .= '*Todos  podem ser detalhados'; }else{ $html_manifesto .= '*Ele pode ser detalhado'; }
				$html_manifesto .= ' nos SERVIÇOS DO PROCESSO <i>(PROCESSO_'.SYS_CONFIG_RM_SIGLA.'_'.$f_rm.'_-_LISTA_SERVICOS.pdf)</i>.</div><p></p>';
			}//if($html_servicos != ""){

			if($html_notificacao != ""){
				$cont_total_arq++;//contagem de total de arquivos
				$html_manifesto .= '<p></p>
			<div style="text-indent:40px; font-size:14px;">Nas notificações registradas no  processo temos</div>
			'.$html_notificacao.'
			<div style="font-size:14px;">';
				if($cont_notificacao > "1"){ $html_manifesto .= '*Todas  podem ser detalhadas'; }else{ $html_manifesto .= '*Ele pode ser detalhada'; }
				$html_manifesto .= ' em NOTIFICAÇÕES DO PROCESSO <i>(PROCESSO_'.SYS_CONFIG_RM_SIGLA.'_'.$f_rm.'_-_LISTA_NOTIFICACOES.pdf)</i>.</div><p></p>';
			}//if($html_notificacao != ""){	

			if($html_arquivos != ""){
				$html_manifesto .= '<p></p><div style="text-indent:40px; font-size:14px;">Dos arquivos em anexo disponíveis  temos em TRÂMITE DE ARQUIVOS DO PROCESSO os seguintes arquivos: </div>'.$html_arquivos.'<p></p>';
			}//if($html_arquivos != ""){
	

			if($cont_publica > "1"){ 
				$cont_total_arq++;//contagem de total de arquivos
				$html_manifesto .= '<p style="text-indent:40px; font-size:14px;">Nas PUBLICAÇÕES DO PROCESSO,  temos a lista de análises, despachos ou parecer ao processo, podendo ser visualizadas  de forma detalhada <i>(PROCESSO_'.SYS_CONFIG_RM_SIGLA.'_'.$f_rm.'_-_LISTA_PUBLICACOES.pdf)</i>.</p>';
			}//if($cont_publica > "1"){ 



			$cont_total_arq++;//contagem de total de arquivos
			$html_manifesto .= '<p style="text-indent:40px; font-size:14px;">Por fim, todos os eventos e  acontecimentos no processo foram registrados, temos uma linha do tempo com tudo  que aconteceu passo a passo no processo, disponível em LINHA DO TEMPO DE  PROCESSOS <i>(PROCESSO_'.SYS_CONFIG_RM_SIGLA.'_'.$f_rm.'_-_LINHA_DO_TEMPO.pdf)</i>.</p>
<p style="text-indent:40px; font-size:14px;">Junto a esse manifesto referente ao processo, existem <strong>'.$cont_total_arq.' arquivos/PDF</strong> em anexo que complementa os detalhes do manifesto.</p><p></p><p></p>
<p align="right" style="font-size:14px;">'.SYS_CLIENTE_NOME_RESUMIDO.', '.nome_data(date('d/m/Y')).' às '.date('H:i').'hs.<br>Sistema  AXL</p>';
		
			//verifica qual logomarca de impressão usar -------------------------------------------------------------------------->>>
			$caminho_logo_impressao = VAR_DIR_FILES.'files/logos/logo_impressao.png';
			//verifica qual logomarca de impressão usar --------------------------------------------------------------------------<<<				
			//CLASSES GERAR PDF ---> > >
			$classe_pdf = new fPDF("../../");//inicia a classe informando o caminho da pasta: sys
			$classe_pdf->nomeFile("manifesto.pdf");
			$classe_pdf->mostraData("INTEGRAÇÃO WEB SERVICE - ".date('d/m/Y H:i')."h");//mostra data no título
			$classe_pdf->cabecalho('<img src="'.$caminho_logo_impressao.'">','Exporta processo '.SYS_CONFIG_RM_SIGLA.' '.$code_RM.' - MANIFESTO');//colunas de exibição de cabeçalho
			$classe_pdf->cabecalhoW("1","1%"); $classe_pdf->cabecalhoW("2","99%");//largura de coluna 1 e 2 do cabeçalho
			$classe_pdf->legPagina(' - PROCESSO '.SYS_CONFIG_RM_SIGLA.' '.$code_RM);//legenda complementar em númeração de página
			$classe_pdf->nPagina();//ativa exeibição número de páginas
			$classe_pdf->conteudo(stripslashes($html_manifesto));
			//salva o pdf - SEM DOWNLOAD
			$file = $classe_pdf->gerarPDF("bin");
			unset($arr); $arr["file"] = fWS_sendFile($file);	//prepara para envio com fWS	
			
		
		
	
							
				//VARS
				$CONT_SEND++;//contagem de envios
			}//if($CLASS["protocolo"] >= "1"){		
	}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["dados"] = $arr;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA ".SYS_CONFIG_RM_SIGLA." INFORMADO ($f_rm)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaProcessoManifestoPDF
if($P_metodo == "consultaProcessoManifestoPDF"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaProcessoManifestoPDF($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<


































//MÉTODO QUE BUSCA PUBLICAÇÕES DO PROCESSO DO PROCESSO - ARR: rm
function consultaProcessoPublicacoesPDF($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	//echo "<BR><BR>RECURSO TEMPORARIAMENTE INDISPONÍVEL :)<BR>";
	exit(0);
	$f_rm = getpost_sql($ARR["rm"]);
	$arrRet["valida"] = "0";
	$aCode = fGERAL::returnCode7($f_rm);
	if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
		
			//INICIA FUNÇÃO DE CLASSE DE PROTOCOLO +++
			$CLASS = fRM::classProtocolo($f_rm,"WEB SERVICE","0","../../");
			if($CLASS["encontrou"] >= "1"){
				
			//CLASSE #######=> dados para manipulação
			$CLASS["protocolo"]->loadLinhaDados();//loadLinhaDados() - CARREGA LINHA DE DADOS
			$code_RM = $CLASS["protocolo"]->getLinha("code_rm");			
			//inicia montagem de publicações do processo
			$html_publicacoes = '<table width="100%" border="0" cellspacing="0" cellpadding="1" style="padding:5px;">
  <tr>
    <td style="padding:5px; font-size:16px; border-bottom:#CCC 2px solid; font-weight:bold;">PROCESSO '.SYS_CONFIG_RM_SIGLA.' ' .$code_RM.'</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Data de criação</td>
    <td width="65%" style="padding:5px;">'.date('d/m/Y H:i', $CLASS["protocolo"]->getLinha("time")).'h</td>
  </tr>
</table>';
			
			//monta nomes de solicitante e interessado
			if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
				$html_publicacoes .= '<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Requerente/solicitante</td>
    <td width="65%" style="padding:5px;">'.$CLASS["protocolo"]->getLinha("jur_nome").', CNPJ '.$CLASS["protocolo"]->getLinha("jur_doc").'</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Interessado</td>
    <td width="65%" style="padding:5px;">'.$CLASS["protocolo"]->getLinha("fis_nome").', CPF '.$CLASS["protocolo"]->getLinha("fis_doc").'</td>
  </tr>
</table>';

			}else{//if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
				$html_publicacoes .= '<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Requerente/solicitante</td>
    <td width="65%" style="padding:5px;">'.$CLASS["protocolo"]->getLinha("fis_nome").', CPF '.$CLASS["protocolo"]->getLinha("fis_doc").'</td>
  </tr>
</table>';

			}//else{//if($CLASS["protocolo"]->getLinha("jur_nome") != ""){
			
			$html_publicacoes .= '<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Tipo de solicitação</td>
    <td width="65%" style="padding:5px;">'.$CLASS["protocolo"]->getLinha("tipo_nome").'</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Assunto</td>
    <td width="65%" style="padding:5px;">'.$CLASS["protocolo"]->getLinha("assunto").'</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Status</td>
    <td width="65%" style="padding:5px;">'.legProtocoloStatus($CLASS["protocolo"]->getLinha("status"))."/".maiusculo($CLASS["protocolo"]->getLinha("situacao")).'</td>
  </tr>
</table>
<div style="clear:both; height:30px;"></div>
<div style="background:#000; color:#FFF; padding:3px; font-size:12px;">LISTA DE PUBLICAÇÕES NO PROCESSO</div>';



			//CLASSE #######=> dados para manipulação
			$publicaArray = $CLASS["protocolo"]->getPublicacoes("0,500");//getPublicacoes() - CARREGA ARRAY DE PUBLICAÇÕES
			//echo "DADOS:<pre>"; print_r($publicaArray); echo "</pre>";

			$cont = "0";
			//monta array de dados
			$array = $publicaArray["lista"];
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				foreach($array as $pos => $valor){
					if($valor != ""){
						$cont++;			
						$html_publicacoes .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" style="padding:5px;">
  <tr>
    <td style="padding:5px; font-size:14px; border-top:#000 2px solid;'; if(!isset($valor["excluido"])){ $html_publicacoes .= 'font-weight:bold;'; } $html_publicacoes .= '">'.$valor["cont"].'. '.maiusculo(legProtocoloPublicacaoTipo($valor["tipo"])).' ('.legProtocoloPublicacaoControle($valor["controle"]).') '; if(isset($valor["excluido"])){ $html_publicacoes .= ' - REMOVIDO/EXCLUÍDO'; } $html_publicacoes .= '</td>
  </tr>
</table>';
						if(!isset($valor["excluido"])){
							if($valor["servico"] != "--"){
								$html_publicacoes .= '<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Serviço ref.:</td>
    <td width="65%" style="padding:5px;">'.$valor["servico"].'</td>
  </tr>
</table>';
							}
							if($valor["descricao"] != ""){
								$html_publicacoes .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" style="padding:5px;">
  <tr>
    <td style="padding:5px; font-size:12px; border-bottom:#CCC 1px dotted;">Justificativa/texto</td>
  </tr>
</table>
'.$valor["descricao"].'
<table width="100%" border="0" cellspacing="0" cellpadding="1" style="padding:5px;">
  <tr>
    <td style="padding:5px; font-size:12px; border-top:#CCC 1px dotted;">&nbsp;</td>
  </tr>
</table>';
							}
							
							$html_publicacoes .= '<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="35%" style="color:#666; padding:5px;">Servidor/data de cadastro:</td>
    <td width="65%" style="padding:5px;">'.sentenca($valor["user"]).', '.date('d/m/Y H:i',$valor["time"]).'h</td>
  </tr>
</table>
<div style="clear:both; height:50px;"></div>';
							}// if(!isset($valor["excluido"])){

		}//if($valor != ""){
	}//fim foreach
}//fim if($cont_ARRAY >= "1"){

			
			//verifica qual logomarca de impressão usar -------------------------------------------------------------------------->>>
			$caminho_logo_impressao = VAR_DIR_FILES.'files/logos/logo_impressao.png';
			//verifica qual logomarca de impressão usar --------------------------------------------------------------------------<<<			
				
			//CLASSES GERAR PDF ---> > >
			$classe_pdf = new fPDF("../../");//inicia a classe informando o caminho da pasta: sys
			$classe_pdf->nomeFile("publicacoes.pdf");
			$classe_pdf->mostraData("INTEGRAÇÃO WEB SERVICE - ".date('d/m/Y H:i')."h");//mostra data no título
			$classe_pdf->cabecalho('<img src="'.$caminho_logo_impressao.'">','Exporta processo '.SYS_CONFIG_RM_SIGLA.' '.$code_RM.' - LISTA PUBLICAÇÕES');//colunas de exibição de cabeçalho
			$classe_pdf->cabecalhoW("1","1%"); $classe_pdf->cabecalhoW("2","99%");//largura de coluna 1 e 2 do cabeçalho
			$classe_pdf->legPagina(' - PROCESSO '.SYS_CONFIG_RM_SIGLA.' '.$code_RM);//legenda complementar em númeração de página
			$classe_pdf->nPagina();//ativa exeibição número de páginas
			$classe_pdf->conteudo(stripslashes($html_publicacoes));				
			//salva o pdf - SEM DOWNLOAD
			$file = $classe_pdf->gerarPDF("bin");
			unset($arr); $arr["file"] = fWS_sendFile($file);	//prepara para envio com fWS	
				
							
				//VARS
				$CONT_SEND++;//contagem de envios
			}//if($CLASS["protocolo"] >= "1"){		
	}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["dados"] = $arr;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA ".SYS_CONFIG_RM_SIGLA." INFORMADO ($f_rm)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaProcessoPublicacoesPDF
if($P_metodo == "consultaProcessoPublicacoesPDF"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaProcessoPublicacoesPDF($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<


































//MÉTODO QUE BUSCA ARQUIVO DO PROCESSO DO PROCESSO - ARR: rm, cont
function consultaProcessoTramiteArquivo($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>

	//echo "<BR><BR>RECURSO TEMPORARIAMENTE INDISPONÍVEL :)<BR>";
	exit(0);
	
	$f_rm = getpost_sql($ARR["rm"]);
	$f_cont = getpost_sql($ARR["cont"]); $f_cont = str_replace(".", "", $f_cont);
	$arrRet["valida"] = "0";
	$aCode = fGERAL::returnCode7($f_rm);
	if(($aCode["ano"] != "") and ($aCode["cont"] >= "1") and ($f_cont >= "1") and ($f_cont != "")){
			$fileCaminho = VAR_DIR_FILES."files/tabelas/protocolo/".$aCode["ano"]."/".$aCode["mes"]."/".$aCode["dia"]."/".$aCode["cont"]."/arquivos";
			if(file_exists($fileCaminho."/".$f_cont)){
				$file_ret = file_get_contents($fileCaminho."/".$f_cont);
				if($file_ret != ""){
					unset($arr_i); $arr_i = fGERAL::jsonArray(fGERAL::logFile($file_ret,"get"),"dec");
					if($arr_i["file"] != ""){
						$local_tipo = "protocolo";
						if(($arr_i["status"] == "5") and ($arr_i["tabela"] != "")){ $local_tipo = "referencia"; }
						//verifica o tipo de local do arquivo
						if($local_tipo == "referencia"){
							$arr_i["file_caminho"] = VAR_DIR_FILES."files/tabelas/".$arr_i["tabela"]."/doc-".$arr_i["docs_id"].".".fGERAL::mostraExtensao($arr_i["file"]);
							if(!file_exists($arr_i["file_caminho"])){ $arr_i["file"] = ""; $arr_i["file_caminho"] = ""; }				
						}else{//if($local_tipo == "referencia"){				
							$arr_i["file_caminho"] = $fileCaminho."/files/doc-".$arr_i["cont"].".".fGERAL::mostraExtensao($arr_i["file"]);
							if(!file_exists($arr_i["file_caminho"])){ $arr_i["file"] = ""; $arr_i["file_caminho"] = ""; }
						}//if($local_tipo == "referencia"){
						if($arr_i["file"] != ""){
							$arr["nome"] = $arr_i["file"];
							$arr["tipo"] = fGERAL::mostraExtensao($arr_i["file"]);
							$file = file_get_contents($arr_i["file_caminho"]);
							$arr["file"] = fWS_sendFile($file);	//prepara para envio com fWS
							//VARS
							$CONT_SEND++;//contagem de envios
						}
					}//só adiciona se existir arquivo					
				}//if($file_ret != ""){
			}//if(file_exists($fileCaminho."/".$f_cont))){
	}//if(($aCode["ano"] != "") and ($aCode["cont"] >= "1")){
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["dados"] = $arr;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		if($f_cont == ""){ $f_cont =  "VAZIO"; }
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA ".SYS_CONFIG_RM_SIGLA." INFORMADO ($f_rm) - CONT: $f_cont";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaProcessoTramiteArquivo
if($P_metodo == "consultaProcessoTramiteArquivo"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaProcessoTramiteArquivo($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA OFÍCIOS - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, situacao, rm, nome
function consultaOficio($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_situacao = getpost_sql($ARR["situacao"]);
	$f_rm = fGERAL::limpaCode(getpost_sql($ARR["rm"]));
	$f_nome = getpost_sql($ARR["nome"]);
	//verifica ano selecionado
	if(($f_situacao == "encubado") or ($f_situacao == "arquivado")){
		$ano_b = $f_ano; $f_ano = "";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "oficio_arquivo_anos", "ano = '$ano_b'", "", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$f_ano = $linha1["ano"];
		}//fim while
		if($f_ano == ""){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "oficio_arquivo_anos", "", "ORDER BY ano DESC", "1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$f_ano = $linha1["ano"];
			}//fim while
		}//if($f_ano == ""){		
	}//if(($f_situacao == "encubado") or ($f_situacao == "arquivado")){
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//verifica situacao ///////////////////////////////////////////////////////////
	$situacao = "EM EXECUÇÃO";
	if($f_situacao == "execucao"){
		$SQL_tabela = "oficio_executando P"; //tabela
	}
	if(($f_situacao == "encubado") or ($f_situacao == "arquivado")){		
		$SQL_tabela = "oficio_arquivo_".$f_ano." P"; //tabela	
		$situacao = maiusculo($f_situacao);	
	}
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "P.id,P.code,P.ano,P.mes,P.dia,P.cont,P.perfil_i AS perfil_inicial,P.perfil_a AS perfil_atual,P.user_id_i,P.user_id_a,P.sigilo,P.apensado,P.status,P.time AS time_cadastro,P.sync AS time_alteracao,T.nome AS tipo,DI.nome AS depto_inicial_nome,D.nome AS depto_atual_nome"; //campos da tabela
	$SQL_campos .= ",U.code AS solicitante_code,U.nome AS solicitante_nome,U.cargo AS solicitante_cargo"; //campo da tabela
	$SQL_campos .= ",UR.code AS responsavel_code,UR.nome AS responsavel_nome,UR.cargo AS responsavel_cargo"; //campo da tabela
	if($SQL_tabela == ""){ $SQL_tabela = "oficio_executando P"; $f_situacao = "execucao"; }//tabela
	$SQL_join = "INNER JOIN adm_oficio_tipo T INNER JOIN sys_perfil_deptos DI INNER JOIN sys_perfil_deptos D INNER JOIN sys_usuarios U INNER JOIN sys_usuarios UR"; //join
	$SQL_where = "P.tipo_id = T.id AND P.depto_i = DI.id AND P.depto_a = D.id AND P.user_id_i = U.id AND P.user_id_a = UR.id"; //condição
	$ORDEM_C = "P.sync";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC geo_area_bairro
	$SQL_group = "GROUP BY P.id"; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
		
	
	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.sync >= '$timei' AND P.sync <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_rm
	if($f_rm != ""){
			$aCode = fGERAL::returnCode7($f_rm);
			$filtro_leg .= "\n - Busca ".SYS_CONFIG_RM_SIGLA." <b>$f_rm</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( P.`ano` = '".$aCode["ano"]."' AND P.`mes` = '".$aCode["mes"]."' AND P.`dia` = '".$aCode["dia"]."' AND P.`cont` = '".$aCode["cont"]."' ) "; //condição 
	}//fim da busca por f_rm

	//verifica se recebeu uma solicitação de busca por f_nome
	if($f_nome != ""){
			$filtro_leg .= "\n - Busca <b>$f_nome</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( P.`assunto` LIKE '%$f_nome%' OR T.`nome` LIKE '%$f_nome%' OR D.`nome` LIKE '%$f_nome%' OR U.`nome` LIKE '%$f_nome%' OR U.`cargo` LIKE '%$f_nome%' OR U.`cpf` LIKE '%".fGERAL::limpaCode($f_nome)."%' OR UR.`nome` LIKE '%$f_nome%' OR UR.`cpf` LIKE '%".fGERAL::limpaCode($f_nome)."%' OR UR.`cargo` LIKE '%$f_nome%' ) "; //condição
	}//fim da busca por f_nome
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
	//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
	$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit, $SQL_join);
	$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		$id_a = $linha["id"];
		$linha["rm"] = fGERAL::legCode7($linha["ano"],$linha["mes"],$linha["dia"],$linha["cont"],$linha["code"]); 
		$linha["criado_aberto_dias"] = retornaDias($linha["dia"].'/'.$linha["mes"].'/'.$linha["ano"]);
		$linha["parado_aberto_dias"] = retornaDias(date('d/m/Y', $linha["time_alteracao"]));		
		$linha["solicitante_rm"] = fGERAL::legCode($linha["user_id_i"],$linha["solicitante_code"]);
		$linha["responsavel_rm"] = fGERAL::legCode($linha["user_id_a"],$linha["responsavel_code"]); unset($linha["user_id_i"],$linha["user_id_a"],$linha["solicitante_code"],$linha["responsavel_code"]);
		unset($linha["id"],$linha["ano"],$linha["mes"],$linha["dia"],$linha["cont"],$linha["code"]);
		$linha["situacao"] = $situacao;
		
		//verifica lista de descritivos
		unset($arr_descritivos);
		$where = "O.oficio_id = '".$id_a."' AND O.depto_id = D.id"; //condição 
		//tabela de verificação		
		if($f_situacao == "execucao"){
			$tabela = "oficio_executando_descritivos O, sys_perfil_deptos D";
		}else{ $tabela = "oficio_arquivo_descritivos_".$f_ano." O, sys_perfil_deptos D"; }
		$resuM = fSQL::SQL_SELECT_SIMPLES("O.depto_id,O.cont,O.tipo,O.titulo,O.texto,O.deferido_cont,O.indeferido_cont,O.status,O.user,O.time,D.code,D.nome", $tabela, $where, "GROUP BY O.id ORDER BY O.cont DESC", "15");
		while($linha1 = fSQL::FETCH_ASSOC($resuM)){
			$linha1["tipo"] = legOficioDescritivoTipo($linha1["tipo"]);
			$linha1["status"] = legOficioStatusDescritivo($linha1["status"]);
			$linha1["depto"] = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($linha1["depto_id"],$linha1["code"])." ".$linha1["nome"];
			$linha1["user"] = $linha1["user"].", ".date('d/m/Y H:i', $linha1["time"]);
			unset($linha1["depto_id"],$linha1["code"],$linha1["nome"],$linha1["time"]);
			$arr_descritivos[] = $linha1;
		}//fim while
		if(isset($arr_descritivos)){ $linha["descritivos"] = $arr_descritivos; }
		

		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaOficio
if($P_metodo == "consultaOficio"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaOficio($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





















































//MÉTODO QUE BUSCA LISTA DUAM - ARR: limit, ano, diai, mesi, horai, diaf, mesf, horaf, situacao, rm, data_vencimento
function consultaFinDuam($ARR){ $CONT_GET="0"; $CONT_SEND="0";//*********************************************************************************************>>>
	$f_limit = getpost_sql($ARR["limit"]);
	$f_ano = (int)getpost_sql($ARR["ano"]);
	$f_diai = getpost_sql($ARR["diai"]);
	$f_mesi = getpost_sql($ARR["mesi"]);
	$f_horai = getpost_sql($ARR["horai"]);
	$f_diaf = getpost_sql($ARR["diaf"]);
	$f_mesf = getpost_sql($ARR["mesf"]);
	$f_horaf = getpost_sql($ARR["horaf"]);
	$f_situacao = getpost_sql($ARR["situacao"]);
	$f_rm = fGERAL::limpaCode(getpost_sql($ARR["rm"]));
	$f_data_vencimento = getpost_sql($ARR["data_vencimento"]);
	//verifica ano selecionado
	if($f_situacao == "1"){
		$ano_b = $f_ano; $f_ano = "";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "fin_duam_fisico_anos", "ano = '$ano_b'", "", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$f_ano = $linha1["ano"];
		}//fim while
		if($f_ano == ""){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "fin_duam_fisico_anos", "", "ORDER BY ano DESC", "1");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$f_ano = $linha1["ano"];
			}//fim while
		}//if($f_ano == ""){		
	}//if($f_situacao == "1"){
	//monta limit
	$l = explode(",",$f_limit);
	$limit1 = (int)$l["0"];
	$limit2 = (int)$l["1"];
	if($limit1 >= "0"){}else{ $limit1 = "0"; }
	if($limit2 >= "31"){ $limit2 = "30"; }
	if($limit2 <= "0"){ $limit2 = "5"; }
	$limit = $limit1.",".$limit2;
	//monta as data de inicio
	if($f_diai > "31"){ $f_diai = "31"; } if($f_diai < "1"){ $f_diai = "1"; }
	if($f_mesi > "12"){ $f_mesi = "12"; } if($f_mesi < "1"){ $f_mesi = "1"; }
	if(strlen($f_horai) == "8"){
		$h = explode(":", $f_horai); $hi = $h["0"]; $mi = $h["1"]; $si = $h["2"];
		if($hi > "23"){ $hi = "23"; } if($hi < "0"){ $hi = "0"; }
		if($mi > "59"){ $mi = "59"; } if($mi < "0"){ $mi = "0"; }
		if($si > "59"){ $si = "59"; } if($si < "0"){ $si = "0"; }
	}else{ $hi = "00"; $mi = "00"; $si = "00"; }
	//monta as data de fim
	if($f_diaf > "31"){ $f_diaf = "31"; } if($f_diaf < "1"){ $f_diaf = "1"; }
	if($f_mesf > "12"){ $f_mesf = "12"; } if($f_mesf < "1"){ $f_mesf = "1"; }
	if(strlen($f_horaf) == "8"){
		$h = explode(":", $f_horaf); $hf = $h["0"]; $mf = $h["1"]; $sf = $h["2"];
		if($hf > "23"){ $hf = "23"; } if($hf < "0"){ $hf = "0"; }
		if($mf > "59"){ $mf = "59"; } if($mf < "0"){ $mf = "0"; }
		if($sf > "59"){ $sf = "59"; } if($sf < "0"){ $sf = "0"; }
	}else{ $hf = "23"; $mf = "59"; $sf = "59"; }
	$timei = time_data_hora($f_diai."/".$f_mesi."/".$f_ano." ".$hi.":".$mi.":".$si);
	$timef = time_data_hora($f_diaf."/".$f_mesf."/".$f_ano." ".$hf.":".$mf.":".$sf);
	$arrRet["valida"] = "0";
	
	
	$bytesList = "0";//INICIA VARIAVEIS DE SOMA DE BYTES DA LISTA	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
	//verifica situacao ///////////////////////////////////////////////////////////
	$situacao = "ATIVOS/NÃO VENCIDOS";
	$SQL_tabela = "fin_duam_fisico,fin_duam_juridico"; //tabela
	if($f_situacao == "1"){		
		$SQL_tabela = "fin_duam_fisico_".$f_ano.","."fin_duam_juridico_".$f_ano; //tabela	
		$situacao = "ATIVOS/ARQUIVADOS/VENCIDOS";
	}
	//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "candidato_id,code,venc_ano,venc_mes,venc_dia,cont,ref_ano AS referencia_ano,ref_mes AS referencia_mes,parcela,parcela_total,valor_taxa,valor_juros,valor_total,time"; //campos da tabela
	if($f_situacao == "1"){ $SQL_campos .= ",status"; }
	$SQL_where = ""; //condição
	$ORDEM_C = "time";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC geo_area_bairro
	$SQL_group = ""; // agrupar o resultado GROUP BY
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<
		
	
	//filtro por data
	$filtro_leg = " - Na data: ".date('d/m/Y H:i:s', $timei)." até ".date('d/m/Y H:i:s', $timef)." (cadastro/alteração)";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " time >= '$timei' AND time <= '$timef' "; //condição

	//verifica se recebeu uma solicitação de busca por f_rm
	if($f_rm != ""){
			$aCode = fGERAL::returnCodeDuam($f_rm);
			$filtro_leg = " - Busca ".SYS_CONFIG_RM_SIGLA." <b>$f_rm</b>";
			$SQL_where = " ( `venc_ano` = '".$aCode["ano"]."' AND `venc_mes` = '".$aCode["mes"]."' AND `venc_dia` = '".$aCode["dia"]."' AND `cont` = '".$aCode["cont"]."' ) "; //condição 
			//verifica se muda tabela
			$rm_data = $aCode["ano"].$aCode["mes"].$aCode["dia"];
			if($rm_data < date('Ymd')){
				$SQL_tabela = "fin_duam_fisico_".$aCode["ano"].","."fin_duam_juridico_".$aCode["ano"]; //tabela	
				$situacao = "ATIVOS/ARQUIVADOS/VENCIDOS";			
			}else{
				$situacao = "ATIVOS/NÃO VENCIDOS";
				$SQL_tabela = "fin_duam_fisico,fin_duam_juridico"; //tabela
			}
	}//fim da busca por f_rm
	
	
	//verifica se recebeu uma solicitação de busca por f_data_vencimento
	if($f_data_vencimento != ""){
			$d = explode("/",$f_data_vencimento);
			$filtro_leg = "\n - Busca vencimento <b>$f_data_vencimento</b>";
			$SQL_where = " ( `venc_ano` = '".$d["2"]."' AND `venc_mes` = '".$d["1"]."' AND `venc_dia` = '".$d["0"]."' ) "; //condição 
			//verifica se muda tabela
			$rm_data = $aCode["ano"].$aCode["mes"].$aCode["dia"];
			if($rm_data < date('Ymd')){
				$resu1 = fSQL::SQL_SELECT_SIMPLES("ano", "fin_duam_fisico_anos", "ano = '".$d["2"]."'", "", "1");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					$SQL_tabela = "fin_duam_fisico_".$linha1["ano"].","."fin_duam_juridico_".$linha1["ano"]; //tabela	
					$situacao = "ATIVOS/ARQUIVADOS/VENCIDOS";
				}//fim while			
			}else{
				$situacao = "ATIVOS/NÃO VENCIDOS";
				$SQL_tabela = "fin_duam_fisico,fin_duam_juridico"; //tabela
			}
	}//fim da busca por f_data_vencimento
	
	
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>	
	$QueryListaPag 	= fSQL::SQL_SELECT_UNION($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", $limit);
	$n_paginas 		= fSQL::SQL_CONTAGEM_UNION($SQL_tabela, $SQL_where, "", "");
	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<

	//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
	//inicia a listagem do SQL de paginação
	while($linha = fSQL::FETCH_ASSOC($QueryListaPag)){
		//número do duam
		$linha["data_vencimento"] = fGERAL::legData($linha["venc_dia"],$linha["venc_mes"],$linha["venc_ano"]);
		$linha["rm"] = fGERAL::legCodeDuam($linha["venc_ano"],$linha["venc_mes"],$linha["venc_dia"],$linha["cont"],$linha["code"]);
		$linha["contagem_banco_duam"] = $linha["cont"].fGERAL::legCodeTabela($linha["code"],"ultimo");		
		//monta legenda de QTD parcelas
		if(($linha["parcela"] >= "1") and ($linha["parcela_total"] >= "1")){ $linha["parcelas"] = $linha["parcela"]."/".$linha["parcela_total"]; }else{ $linha["parcelas"] =  "ÚNICA"; }
		
		//busca dados do candidato 
		if($linha["UNI"] == "1"){
			$linha2 = fSQL::SQL_SELECT_ONE("nome,cpf", "cad_candidato_fisico", "id = '".$linha["candidato_id"]."'", "");
			$linha["candidato_nome"] = $linha2["nome"];
			$linha["candidato_doc"] = $linha2["cpf"];
			$linha["candidato_tipo"] = "FÍSICO";
		}else{//if($linha["UNI"] == "1"){
			$linha2 = fSQL::SQL_SELECT_ONE("nome,cnpj", "cad_candidato_juridico", "id = '".$linha["candidato_id"]."'", "");
			$linha["candidato_nome"] = $linha2["nome"];
			$linha["candidato_doc"] = $linha2["cnpj"];
			$linha["candidato_tipo"] = "JURÍDICO";
		}//else{//if($linha["UNI"] == "1"){			
		//leg status
		if(isset($linha["status"])){ $linha["status"] = legDuamStatus($linha["status"]); }else{ $linha["status"] = legDuamStatus("1"); }		
		$linha["situacao"] = $situacao;
		unset($linha["venc_ano"],$linha["venc_mes"],$linha["venc_dia"],$linha["cont"],$linha["code"],$linha["candidato_id"],$linha["parcela"],$linha["parcela_total"],$linha["UNI"]);		
		
		//VARS
		$arr = $linha;
		$bytesList = $bytesList+mb_strlen(json_encode($arr));//SOMA BAYTES DA LISTA		
		$arrList[] = $arr;//array de retorno
		$CONT_SEND++;//contagem de envios
		if(fWS_tmLimite($bytesList) == 1){ break; }//VERIFICA SE ULTRAPASSOU O LIMITE DISPONÍVEL PARA O GET
	}//fim do while de padinação SQL
	
	
	if($CONT_SEND >= "1"){
		$arrRet["valida"] = "1"; unset($arrRet["msg"]);
		$arrRet["filtro"] = $filtro_leg;
		$arrRet["contApartir"] = $limit1;
		$arrRet["cont"] = $CONT_SEND;
		$arrRet["contTotal"] = $n_paginas;
		$arrRet["dados"] = $arrList;//retorno dos dados
	}else{//if($CONT_SEND >= "1"){
		$arrRet["valida"] = "0"; $arrRet["msg"] = "SEM RESULTADOS PARA OS PARÂMETROS INFORMADOS ($filtro_leg)";
	}//}else{//if($CONT_SEND >= "1"){
		
	fWS_retDados($arrRet,$CONT_GET,$CONT_SEND);//RETORNO
}//consultaFinDuam
if($P_metodo == "consultaFinDuam"){ $metodo_ok = "NEGADO"; if(preg_match("/\.".$P_metodo."\./i", SYS_WEBSERVICE_METODOS)){ consultaFinDuam($P_metodoArr); $metodo_ok = "1"; } }//*************************<<<





































































































//FIM PARA RETORNO DE NÃO LOCALIZADO *****************************************************************************************************************#####
if($metodo_ok == "0"){ $arrRet["valida"] = "0"; $arrRet["msg"] = "MÉTODO ($P_metodo) NAO FOI LOCALIZADO!, VERIFIQUE O MANUAL DE INTEGRAÇÃO!"; fWS_retDados($arrRet,0,0); }
if($metodo_ok == "NEGADO"){ $arrRet["valida"] = "0"; $arrRet["msg"] = "DESCULPE, O ACESSO AO MÉTODO: ".$P_metodo." FOI NEGADO, PROCURE A GESTÃO DE TI"; fWS_retDados($arrRet,0,0); }