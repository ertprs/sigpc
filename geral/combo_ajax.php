<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
$ajax = "OFF"; //zera a variavel AJAX e nao executa as funcoes ajax
//vars para paginacao em AJAX -------------------------------------|| AJAX --- >>>
$AJAX_PAG = "combo_ajax.php";//pagina que vai ser carregada

//vars para paginacao em AJAX -------------------------------------|| AJAX --- <<<
if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	$ajax = $_GET["ajax"];

	//INCLUDES DE CONTROLE --->>>
	include "../config/globalSession.php";//inicia sessao php
	include "../config/globalVars.php";//vars padrao
	include "../sys/langAction.php";//inicia arquivo de linguage	
	include "../sys/globalFunctions.php";//funcoes padrao
	include "../sys/globalClass.php";//classes padrao
	include "../sys/classConexao.php";//classes de conexao
	include "../sys/incUpdate.php";//verificador de updates
	include "../config/incPacote.php";//vars do pacote de cliente
	include "../sys/classValidaAcesso.php";//classes de validação de acesso
	$SCRIPTOFF = "0";//desliga scripts
	include "../sys/cabecalho_ajax.php"; //cabeçalho ajax para correção de acentos e cache
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
	$cVLogin->loginSession();//faz a atualização de session do login atual
	//CLASSES PROTEGE PAGINA/LOGIN ---<<<


}//fim else - if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina


?>
<?php
















//AJAX QUE EXIBE ITEM DE PERFIL DE ACESSO ------------------------------------------------------------------>>>
if($ajax == "perfilAcesso"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["statusAll"])){ $sql_busca = ""; }else{ $sql_busca = "( status = '1' OR status = '2')"; }
	if(isset($_GET["atual"])){ if($sql_busca != ""){ $sql_busca .= " AND "; } $sql_busca .= "id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'"; }
	
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= "( `nome` LIKE '%$term%' OR `apelido` LIKE '%$term%')"; //condição
	}//fim da busca por nome
	
	//remove da lista
	if((isset($_GET["del"])) and ($_GET["del"] != "")){
		$del = getpost_sql($_GET["del"]);
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= " id != '".str_replace(",", "' AND id != '", $del)."'";
	}//fim isset remove

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	//remove da lista
	$todas = "";
	if(isset($_GET["todas"])){
		$todas = $_GET["todas"];
		//alimenta array de retorno
		$row_array['id'] = "TODAS";
		$row_array['text'] = "TODOS OS PERFILS<br><i>Todos unidades disponíveis no sistema.</i>";
		array_push($return_arr,$row_array);
	}//fim isset todas
	
	if($todas != "TODAS"){	
		//lista
		$campos = "id,nome,apelido";
		$tabela = "sys_perfil";
		$where = $sql_busca;
		if($where != ""){ $where .= " AND id != '1'"; }
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY id ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$legenda = $linha["nome"];
			$apelido = $linha["apelido"];
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = '<i class="'.fGERAL::icoPerfil($id).'"></i> <b>'.$id.'. '.$legenda."</b> (".$apelido.")";
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
	
	}//if($todas != "TODAS"){	
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<

























//AJAX QUE EXIBE ITEM DE PERFIL DE ACESSO ------------------------------------------------------------------>>>
if($ajax == "selOrigem"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["statusAll"])){ $sql_busca = ""; }else{ $sql_busca = "( status = '1' OR status = '2')"; }
	if(isset($_GET["atual"])){ if($sql_busca != ""){ $sql_busca .= " AND "; } $sql_busca .= "origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'"; }
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= "( `nome` LIKE '%$term%' OR `apelido` LIKE '%$term%')"; //condição
	}//fim da busca por nome
	
	//remove da lista
	if((isset($_GET["del"])) and ($_GET["del"] != "")){
		$del = getpost_sql($_GET["del"]);
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= " id != '".str_replace(",", "' AND id != '", $del)."'";
	}//fim isset remove

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	//remove da lista
	$todas = "";
	if(isset($_GET["todas"])){
		$todas = $_GET["todas"];
		//alimenta array de retorno
		$row_array['id'] = "TODAS";
		$row_array['text'] = "TODOS AS UNIDADES<br><i>Todas unidades disponíveis.</i>";
		array_push($return_arr,$row_array);
	}//fim isset todas
	
	if($todas != "TODAS"){	
		//lista
		$campos = "id,nome,apelido,origem_id";
		$tabela = "sys_perfil";
		$where = $sql_busca;
		if($where != ""){ $where .= " AND "; } $where .= " id != '1'";
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY origem_id ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["origem_id"];
			$legenda = $linha["nome"];
			$apelido = $linha["apelido"];
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = '<i class="'.fGERAL::icoOrigem($id).'"></i> <b>'.$legenda."</b> (".$apelido.")";
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
	
	}//if($todas != "TODAS"){	
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<



















































//AJAX QUE EXIBE ITEM DE PERFIL DE ACESSO ------------------------------------------------------------------>>>
if($ajax == "selRestricao"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= "( `legenda` LIKE '%$term%')"; //condição
	}//fim da busca por nome
	
	//remove da lista
	if((isset($_GET["del"])) and ($_GET["del"] != "")){
		$del = getpost_sql($_GET["del"]);
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= " id != '".str_replace(",", "' AND id != '", $del)."'";
	}//fim isset remove

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	//lista
	$campos = "id,legenda";
	$tabela = "axl_restricoes_medicas";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["legenda"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $legenda;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<















































//AJAX QUE EXIBE ITEM DE PERFIL DE ACESSO ------------------------------------------------------------------>>>
if($ajax == "selServico"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }

	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= "( `nome` LIKE '%$term%')"; //condição
	}//fim da busca por nome
	
	//remove da lista
	if((isset($_GET["del"])) and ($_GET["del"] != "")){
		$del = getpost_sql($_GET["del"]);
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= " id != '".str_replace(",", "' AND id != '", $del)."'";
	}//fim isset remove

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	//lista
	$campos = "id,nome,tipo_servico";
	$tabela = "adm_protocolo_tipo";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$tipo_servico = categoriaServicoLeg($linha["tipo_servico"]);
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = '<b>'.$legenda."</b><br><small>".$tipo_servico."</small>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<




















































//AJAX QUE EXIBE ITEM DE DEPARTAMENTO DO PERFIL DE ACESSO ------------------------------------------------------------------>>>
if($ajax == "perfilDepto"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$perfil_id = getpost_sql($_GET["perfil_id"]); if(preg_match("/\,/i", $perfil_id)){ $perfil_id = "0"; }else{ $perfil_id = (int)$perfil_id; }
	$sql_busca = "perfil_id = '$perfil_id'";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		$sql_busca .= " AND ( `id` = '".$aCode["id"]."' OR `nome` LIKE '%$term%' OR `obs` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome
	
	//remove da lista
	if((isset($_GET["delDepto"])) and ($_GET["delDepto"] != "")){
		$delDepto = getpost_sql($_GET["delDepto"]);
		$sql_busca .= " AND  `id` != '$delDepto' "; //condição		
	}//fim isset remove
	
	//filtra status
	if((isset($_GET["status"])) and ($_GET["status"] != "")){
		$status = getpost_sql($_GET["status"]);
		$sql_busca .= " AND  `status` = '$status' "; //condição		
	}//fim isset status

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	
	$valida = "1";
	
	if($perfil_id >= "1"){}else{
		if($valida == "1"){
			if(isset($_GET["perfil_leg"])){ $perfil_leg = getpost_sql($_GET["perfil_leg"]); }else{ $perfil_leg = "Selecione primeiro o perfil de acesso..."; }
			$valida = "0";
			//alimenta array de retorno
			$row_array['id'] = "";
			$row_array['text'] = $perfil_leg;
			array_push($return_arr,$row_array);
		}
	}//if($perfil_id >= "1"){}else{
		
	

if($valida == "1"){		
//lista ALERTAS
	$campos = "id,code,nome,obs";
	$tabela = "sys_perfil_deptos";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$obs = $linha["obs"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$legenda."</b> (".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).")<br>".$obs;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while

}//if($valida == "1"){
	
	
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<




















































//AJAX QUE EXIBE ITEM DE DEPARTAMENTO COM PERFIL ------------------------------------------------------------------>>>
if($ajax == "deptos"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "D.perfil_id = P.id";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		$sql_busca .= " AND ( D.`id` = '".$aCode["id"]."' OR D.`nome` LIKE '%$term%' OR D.`obs` LIKE '%$term%' OR P.`nome` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome
	
	//remove da lista
	if((isset($_GET["delDepto"])) and ($_GET["delDepto"] != "")){
		$delDepto = getpost_sql($_GET["delDepto"]);
		$sql_busca .= " AND  D.`id` != '$delDepto' "; //condição		
	}//fim isset remove
	
	//filtra status
	if((isset($_GET["status"])) and ($_GET["status"] != "")){
		$status = getpost_sql($_GET["status"]);
		$sql_busca .= " AND  D.`status` = '$status' "; //condição		
	}//fim isset status

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	
			
//lista ALERTAS
	$campos = "D.id,D.perfil_id,D.code,D.nome,D.obs,P.nome AS perfil, P.apelido";
	$tabela = "sys_perfil_deptos D, sys_perfil P";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY D.id ORDER BY D.nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$perfil_id = $linha["perfil_id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$obs = $linha["obs"];
		$perfil = $linha["perfil"];
		$apelido = $linha["apelido"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "Perfil:<i>".$perfil_id.". ".$perfil." (".$apelido.")</i><br><b>".$legenda."</b> (".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).")<br>".$obs;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<




















































//AJAX QUE EXIBE ITEM DE DEPARTAMENTO DO USUARIO ------------------------------------------------------------------>>>
if($ajax == "usuarioDepto"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "status = '1' AND "; if(isset($_GET["statusoff"])){ $sql_busca = ""; }
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		$sql_busca .= " ( `id` = '".$aCode["id"]."' OR `nome` LIKE '%$term%' OR `obs` LIKE '%$term%' ) AND "; //condição
	}//fim da busca por nome
	//array de departamentos do usuario
	$ARR = $cVLogin->loginDeptos();
	//VEWIRIFICA DEPTO SECUNDARIO
	if(is_array($ARR["adicional"])){ $sql_array_sec = implode("' OR id = '",$ARR["adicional"]); }else{ $sql_array_sec = ""; }
	

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	
				
//lista 
	$campos = "id,code,nome,obs";
	$tabela = "sys_perfil_deptos";
	$where = $sql_busca." id = '".$ARR["principal"]."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$obs = $linha["obs"];
		if($sql_array_sec != ""){ $deptoP = " - [principal]"; }else{ $deptoP = ""; }
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$legenda."</b>".$deptoP." (".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).")<br>".$obs;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
			
			
			
//lista 
	if($sql_array_sec != ""){
		$campos = "id,code,nome,obs";
		$tabela = "sys_perfil_deptos";
		$where = $sql_busca." ( id = '".$sql_array_sec."' )";
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$code = $linha["code"];
			$legenda = $linha["nome"];
			$obs = $linha["obs"];
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = "<b>".$legenda."</b> (".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).")<br>".$obs;
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
	}//if($sql_array_sec != ""){

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<



















































//AJAX QUE EXIBE ITEM USUARIOS POR DEPARTAMENTO ------------------------------------------------------------------>>>
if($ajax == "usuariosPorDepto"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["perfil_id"])){ $perfil_id = getpost_sql($_GET["perfil_id"]); }else{ $perfil_id = "0"; }
	if(isset($_GET["depto_id"])){ $depto_id = getpost_sql($_GET["depto_id"]); }else{ $depto_id = "0"; }
	if(isset($_GET["user_id_del"])){ $user_id_del = getpost_sql($_GET["user_id_del"]); }else{ $user_id_del = "0"; }
	$sql_busca = "P.perfil_id = '$perfil_id' AND P.permissao_grupo_id = G.id AND ( G.perfil_depto_id = '$depto_id' OR G.perfil_deptos LIKE '%.".$depto_id.".%' ) AND P.usuarios_id = U.id AND P.usuarios_id = L.usuarios_id AND L.status = '1'";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		$sql_busca .= " AND ( U.`id` = '".$aCode["id"]."' OR U.`nome` LIKE '%$term%' )"; //condição
	}//fim da busca por nome
	if(($user_id_del >= "1") and ($user_id_del != "")){
		$sql_busca .= " AND P.usuarios_id != '$user_id_del'"; //condição
	}//if(($user_id_del >= "1") and ($user_id_del != "")){
	

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	
	$valida = "1";
		
	
	if($perfil_id >= "1"){}else{
		if($valida == "1"){
			$valida = "0";
			//alimenta array de retorno
			$row_array['id'] = "";
			$row_array['text'] = "Selecione primeiro o perfil de acesso...";
			array_push($return_arr,$row_array);
		}
	}//if($perfil_id >= "1"){}else{
		
	
	if($depto_id >= "1"){}else{
		if($valida == "1"){
			$valida = "0";
			//alimenta array de retorno
			$row_array['id'] = "";
			$row_array['text'] = "Selecione primeiro o departamento...";
			array_push($return_arr,$row_array);
		}
	}//if($depto_id >= "1"){}else{


if($valida == "1"){	
//lista 
	$campos = "G.perfil_depto_id,U.id,U.code,U.nome,U.cargo";
	$tabela = "sys_login_pacote P, sys_permissao_grupos G, sys_usuarios U, sys_login L";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY P.usuarios_id ORDER BY U.nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$cargo = $linha["cargo"];
		$perfil_depto_id = $linha["perfil_depto_id"];
		if($depto_id == $perfil_depto_id){ $depto_leg = "<[DEPTO PRINCIPAL]"; }else{ $depto_leg = "<[DEPTO AUXILIAR]"; }
		if(($cargo != "") and ($cargo != "NULL")){ $cargo = "<br><i>".sentenca($cargo)."</i>"; }else{ $cargo = ""; }
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$legenda."</b> (".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).") ".$depto_leg.$cargo;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
			
		
}//if($valida == "1"){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<


















































//AJAX QUE EXIBE ITEM USUARIOS POR PERFIL ------------------------------------------------------------------>>>
if($ajax == "usuariosPorPerfil"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["perfil_id"])){ $perfil_id = getpost_sql($_GET["perfil_id"]); }else{ $perfil_id = "0"; }
	if(isset($_GET["status"])){ $status = getpost_sql($_GET["status"]); }else{ $status = ""; }
	$sql_busca = "P.perfil_id = '$perfil_id' AND P.permissao_grupo_id = G.id AND P.usuarios_id = U.id";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		$sql_busca .= " AND ( U.`id` = '".$aCode["id"]."' OR U.`nome` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome
	
	
	//remove da lista
	if((isset($_GET["delUsers"])) and ($_GET["delUsers"] != "")){
		$delUsers = getpost_sql($_GET["delUsers"]);
		$sql_busca .= " AND  U.`id` != '".str_replace(",", "' AND  U.`id` != '", $delUsers)."'"; //condição
	}//fim isset remove
	
	//remove da lista
	$tabela_add = "";
	if($status != ""){
		$tabela_add = ", sys_login L";
		$sql_busca .= " AND P.usuarios_id = L.usuarios_id AND  L.`status` = '".$status."'"; //condição
	}//fim isset remove

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	
	$valida = "1";
		
	
	if($perfil_id >= "1"){}else{
		if($valida == "1"){
			if(isset($_GET["perfil_leg"])){ $perfil_leg = getpost_sql($_GET["perfil_leg"]); }else{ $perfil_leg = $class_fLNG->txt(__FILE__,__LINE__,'Selecione primeiro o perfil de acesso...'); }
			$valida = "0";
			//alimenta array de retorno
			$row_array['id'] = "";
			$row_array['text'] = $perfil_leg;
			array_push($return_arr,$row_array);
		}
	}//if($perfil_id >= "1"){}else{
		

if($valida == "1"){	
	//se insere nome do depto
	if(isset($_GET["nome_deptos"])){
		$campos = "G.perfil_depto_id,U.id,U.code,U.nome";
	}else{
		$campos = "U.id,U.code,U.nome,U.cargo";
	}
	$tabela = "sys_login_pacote P, sys_permissao_grupos G, sys_usuarios U".$tabela_add;
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY P.usuarios_id ORDER BY U.nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$cargo = $linha["cargo"];
		if(($cargo != "") and ($cargo != "NULL")){ $cargo = "<br><i>".sentenca($cargo)."</i>"; }else{ $cargo = ""; }
		//se insere nome do depto
		if(isset($_GET["nome_deptos"])){
			$perfil_depto_id = $linha["perfil_depto_id"];
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu2 = fSQL::SQL_SELECT_SIMPLES("nome", "sys_perfil_deptos", "id = '$perfil_depto_id'", "","1");
			while($linha2 = fSQL::FETCH_ASSOC($resu2)){
				$cargo = "<br><i>Depto Principal: ".$linha2["nome"]."</i>";
			}
		}//if(isset($_GET["nome_deptos"])){		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$legenda."</b> (".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).")".$cargo;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
		
			
		
			
		
}//if($valida == "1"){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<



























































//AJAX QUE EXIBE ITEM USUARIOS TODOS ------------------------------------------------------------------>>>
if($ajax == "usuariosTodos"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["status"])){ $status = getpost_sql($_GET["status"]); }else{ $status = ""; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= "(U.`id` = '".$aCode["id"]."' OR U.`nome` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome
	
	
	//remove da lista
	if((isset($_GET["delUsers"])) and ($_GET["delUsers"] != "")){
		$delUsers = getpost_sql($_GET["delUsers"]);
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= "U.`id` != '".str_replace(",", "' AND  U.`id` != '", $delUsers)."'"; //condição
	}//fim isset remove
	
	//remove da lista
	$tabela_add = "";
	if($status != ""){
		$tabela_add = ", sys_login L";
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= "U.id = L.usuarios_id AND  L.`status` = '".$status."'"; //condição
	}//fim isset remove

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	
		

//lista 
	$campos = "U.id,U.code,U.nome,U.cargo";
	$tabela = "sys_usuarios U".$tabela_add;
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY U.id ORDER BY U.nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$cargo = $linha["cargo"];
		if(($cargo != "") and ($cargo != "NULL")){ $cargo = "<br><i>".sentenca($cargo)."</i>"; }else{ $cargo = ""; }
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$legenda."</b>".$cargo;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
			

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<











































//AJAX QUE EXIBE ITEM DE GRUPO DE ACESSO ------------------------------------------------------------------>>>
if($ajax == "grupoAcesso"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$perfil_id = (int)$_GET["perfil_id"];
	$sql_busca = "G.perfil_id = '$perfil_id' AND G.perfil_depto_id = D.id AND G.perfil_id = P.id";
	if(isset($_GET["full"])){ $sql_busca = "G.perfil_depto_id = D.id AND G.perfil_id = P.id"; $perfil_id = "1"; }
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca .= " AND ( G.`nome` LIKE '%$term%' OR D.`nome` LIKE '%$term%' OR P.`nome` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
		
	if($perfil_id >= "1"){		
//lista ALERTAS
	$campos = "G.id,G.nome,G.perfil_id,D.nome AS depto,P.nome AS perfil";
	$tabela = "sys_permissao_grupos G, sys_perfil_deptos D, sys_perfil P";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY G.id ORDER BY D.nome ASC,G.nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$perfil_id = $linha["perfil_id"];
		$depto = $linha["depto"];
		$perfil = $linha["perfil"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$id.". ".$legenda."</b><br>Dep.: ".$depto.' ('.$perfil_id.'. '.$perfil.")";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	
	}else{
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Selecione primeiro o perfil de acesso...');
		array_push($return_arr,$row_array);
	}//if($perfil_id >= "1"){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<











































//AJAX QUE EXIBE ITEM DE GRUPO DE ACESSO COM PERFIL ------------------------------------------------------------------>>>
if($ajax == "grupoAcessoPerfil"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "G.perfil_id = P.id AND G.perfil_depto_id = D.id";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca .= " AND ( G.`nome` LIKE '%$term%' OR P.`apelido` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome
	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	
			
	//lista ALERTAS
	$campos = "G.id,G.nome,G.perfil_id,D.nome AS depto,P.nome AS perfil,P.apelido";
	$tabela = "sys_permissao_grupos G, sys_perfil_deptos D, sys_perfil P";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY G.id ORDER BY P.id,D.nome ASC,G.nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$perfil_id = $linha["perfil_id"];
		$depto = $linha["depto"];
		$perfil = $linha["perfil"];
		$apelido = $linha["apelido"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Perfil').": ".$perfil_id.". ".$apelido." (".$perfil.")<br>".$class_fLNG->txt(__FILE__,__LINE__,'Grupo').": <b>".$legenda."</b><br>".$class_fLNG->txt(__FILE__,__LINE__,'Depto').": ".$depto.'<div style="clear:both; border-bottom:#CCC 2px solid; height:10px;"></div>';
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<











































//AJAX QUE EXIBE ITEM DE CONTROLE DE ACESSO DE GRUPOS ------------------------------------------------------------------>>>
if($ajax == "controleExpediente"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca .= " ( `id` = '$term' OR `nome` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
			
//lista ALERTAS
	$campos = "id,nome";
	$tabela = "sys_permissao_expediente";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$id." - ".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<




















































//AJAX QUE EXIBE ITEM DE SETOR DE AREAS ------------------------------------------------------------------>>>
if($ajax == "setor"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `id` = '$term' OR `legenda` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
		
	
//lista ALERTAS
	$campos = "id,legenda";
	$tabela = "geo_area_setor";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["legenda"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $id." - <b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<



















































//AJAX QUE EXIBE ITEM DE BAIRROS DE AREAS ------------------------------------------------------------------>>>
if($ajax == "bairros"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `id` = '$term' OR `legenda` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
		
	
//lista ALERTAS
	$campos = "id,legenda";
	$tabela = "geo_area_bairro";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["legenda"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $id." - <b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<





















































//AJAX QUE EXIBE ITEM DE LOGRADOUROS DE AREAS ------------------------------------------------------------------>>>
if($ajax == "logradouros"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "L.tipo_id = T.id";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca .= " AND ( L.`id` = '$term' OR L.`legenda` LIKE '%$term%' OR T.`legenda` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	//verifica se solicitou filtro por bairros
	if(isset($_GET["bairro"])){
		$bairro = $_GET["bairro"];
		if(($bairro == "") or ($bairro == "0")){
			//alimenta array de retorno
			$row_array['id'] = "";
			$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'<b>ATENÇÃO!</b> Primeiro selecione um bairro!');
			array_push($return_arr,$row_array);
			$bairro = "OFF";
		}
		$sql_busca .= " AND L.`bairros` LIKE '%.$bairro.%' "; //condição
	}//if(isset($_GET["bairro"])){
	
//lista ALERTAS
	$campos = "L.id,L.legenda,T.legenda AS tipo";
	$tabela = "geo_area_logradouro L, geo_area_logradouro_tipo T";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_DUPLO($campos, $tabela, $where, "GROUP BY L.id ORDER BY L.legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["legenda"];
		$tipo = $linha["tipo"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $id." - ".$tipo." > <b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<




































//AJAX QUE EXIBE ITEM DE TIPOS DE CANDIDATO JURIDICO ------------------------------------------------------------------>>>
if($ajax == "tipojuridica"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `id` = '$term' OR `legenda` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
		
	
//lista ALERTAS
	$campos = "id,legenda";
	$tabela = "cad_candidato_juridico_tipo";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["legenda"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $id." - <b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<














































//AJAX QUE EXIBE ITEM DE TIPOS DE NATUREZA JURIDICO ------------------------------------------------------------------>>>
if($ajax == "naturezajuridica"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `id` = '$term' OR `codigo` LIKE '$term' OR `legenda` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
		
	
//lista ALERTAS
	$campos = "id,codigo,legenda";
	$tabela = "cad_candidato_juridico_natureza";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$codigo = $linha["codigo"];
		$legenda = $linha["legenda"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $codigo." - <b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<














































//AJAX QUE EXIBE ITEM DE TIPOS DE DOCUMENTOS DE CONTROBUINTES ------------------------------------------------------------------>>>
if($ajax == "candidatoDocsTipo"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `id` = '$term' OR `legenda` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
		
	
//lista ALERTAS
	$campos = "id,legenda";
	$tabela = "cad_candidato_docs_tipo";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["legenda"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $id." - <b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<





























































//AJAX QUE EXIBE ITEM DE ESTADO/UF ------------------------------------------------------------------>>>
if($ajax == "pais"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = "`nome` LIKE '%$term%'"; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();

		
//lista ALERTAS
	$campos = "id,nome";
	$tabela = "combo_pais";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["nome"];
		$legenda = $linha["nome"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $legenda;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	


	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<







































//AJAX QUE EXIBE ITEM DE ESTADO/UF ------------------------------------------------------------------>>>
if($ajax == "uf"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = "`uf_sigla` LIKE '%$term%' OR `uf_nome` LIKE '%$term%'"; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();

	//verifica selecao de UF
	if(isset($_GET["pais"])){
		$pais_b = $_GET["pais"];
		if($sql_busca != ""){$sql_busca .= " AND ";}
		$sql_busca .= "`pais` = '".$pais_b."'";
		if($pais_b == ""){
			//alimenta array de retorno
			$row_array['id'] = "0";
			$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Selecione primeiro o país');
			array_push($return_arr,$row_array);
		}
	}//if(isset($_GET["uf"])){

if((isset($_GET["pais"])) and ($pais_b != "")){	
		
		//verifica se adiciona itens
		if((isset($_GET["add"])) and strlen($_GET['term']) > 0){
			if(ereg('[^0-9]',$term)){//so imprime se nao for numero
				//alimenta array de retorno
				$row_array['id'] = "NOVO:".maiusculo($_GET['term']);
				$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'NOVO').": <b>".maiusculo($_GET['term'])."</b>";
				array_push($return_arr,$row_array);
			}
		}		
		
	//lista ALERTAS
		$campos = "uf_sigla,uf_nome";
		$tabela = "combo_uf";
		$where = $sql_busca;
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY uf_nome ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["uf_sigla"];
			$legenda = $linha["uf_nome"];
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = $legenda;
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
	
	

}//if((isset($_GET["pais"])) and ($pais_b != "")){	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<







































//AJAX QUE EXIBE ITEM DE CIDADE ------------------------------------------------------------------>>>
if($ajax == "cidade"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = "`uf` LIKE '%$term%' OR `cidade_nome` LIKE '%$term%'"; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	//verifica selecao de UF
	if(isset($_GET["uf"])){
		$uf_b = $_GET["uf"];
		if($sql_busca != ""){$sql_busca .= " AND ";}
		$sql_busca .= "`uf` = '".$uf_b."'";
		if($uf_b == ""){
			//alimenta array de retorno
			$row_array['id'] = "0";
			$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Selecione primeiro o estado');
			array_push($return_arr,$row_array);
		}
	}//if(isset($_GET["uf"])){

if((isset($_GET["uf"])) and ($uf_b != "")){
	

	
		//verifica se adiciona itens
		if((isset($_GET["add"])) and strlen($_GET['term']) > 0){
			if(ereg('[^0-9]',$term)){//so imprime se nao for numero
				//alimenta array de retorno
				$row_array['id'] = "NOVO:".maiusculo($_GET['term']);
				$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'NOVO').": <b>".maiusculo($_GET['term'])."</b>";
				array_push($return_arr,$row_array);
			}
		}		
	
	//lista ALERTAS
		$campos = "id,uf,cidade_nome";
		$tabela = "combo_cidades";
		$where = $sql_busca;
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY cidade_nome ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$legenda = $linha["cidade_nome"];
			$uf = $linha["uf"];
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = $legenda."/".$uf;
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while


}//if((isset($_GET["uf"])) and ($uf_b != "")){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<

































//AJAX QUE EXIBE ITEM DE COMBO BAIRROS ------------------------------------------------------------------>>>
if($ajax == "comboBairros"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = "`bairro_nome` LIKE '%$term%'"; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	
	//verifica selecao de cidade
	if(isset($_GET["cidade"])){
		$cidade_id_b = $_GET["cidade"];
		if($sql_busca != ""){$sql_busca .= " AND ";}
		$sql_busca .= "`cidade_id` = '".$cidade_id_b."'";
		if($cidade_id_b == ""){
			//alimenta array de retorno
			$row_array['id'] = "0";
			$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Selecione primeiro uma cidade');
			array_push($return_arr,$row_array);
			
			//imprime JSON de retorno
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			exit(0);
		}
	}//if(isset($_GET["cidade"])){
	
	if(strlen($term) <= 1){
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Comece a digitar para buscar ou adicionar novo...');
		array_push($return_arr,$row_array);
	}else{
	
		//verifica se adiciona itens
		if((isset($_GET["add"])) and strlen($_GET['term']) > 0){
			if(ereg('[^0-9]',$term)){//so imprime se nao for numero
				//alimenta array de retorno
				$row_array['id'] = "NOVO:".maiusculo($_GET['term']);
				$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'NOVO').": <b>".maiusculo($_GET['term'])."</b>";
				array_push($return_arr,$row_array);
			}
		}
						
		
//lista ALERTAS
	$campos = "id,bairro_nome";
	$tabela = "combo_bairros";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY bairro_nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["bairro_nome"];
		if(!isset($_GET["id"])){ $id = $legenda; }
			
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $legenda;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	}//fim if(strlen($id) == 0){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<







































//AJAX QUE EXIBE ITEM DE CANDIDATO FISICO ------------------------------------------------------------------>>>
if($ajax == "candidatofisico"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["user"])){ $user = $_GET["user"]; }else{ $user = ""; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		$sql_busca = " `id` = '".$aCode["id"]."' OR `nome` LIKE '%$term%' OR `code` LIKE '%$term%' OR `sobrenome` LIKE '%$term%' "; //condição
	}//fim da busca por nome
	
	if($user != ""){
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca = " user LIKE '".$user."-%' ";
	}//if($user != ""){

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	if(isset($_GET["add"])){		
		///VERIFICA PERMISSÕES DE ACESSO
		if($cVLogin->loginAcesso("3_con_candidatofisico","cad")){
			//alimenta array de retorno
			$row_array['id'] = "NOVO";
			$row_array['text'] = " ".$class_fLNG->txt(__FILE__,__LINE__,'<b>ADICIONAR NOVO CADASTRO</b> (abrir formulário de cadastro)').'<div style="clear:both; border-bottom:#CCC 2px solid; height:10px;"></div>';
			array_push($return_arr,$row_array);
		}//loginAcesso
	}//if(isset($_GET["add"])){ 
	
//lista ALERTAS
	$campos = "id,code,nome,sobrenome";
	$tabela = "cad_candidato_fisico";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"]." ".$linha["sobrenome"];
		
		$arrDoc = docPessoaFisica($id);
		
		$html = $cVLogin->popDetalhes("C",$id,"3_con_candidatofisico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO')).SYS_CONFIG_RM_SIGLA." ".$code." - <b>".$legenda."</b><br><small>".$arrDoc["nome"]." ".$arrDoc["numero"]."</small>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
		
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $html;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<






























//AJAX QUE EXIBE ITEM DE CANDIDATO FISICO ------------------------------------------------------------------>>>
if($ajax == "candidatofisicoTriagem"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);
		$sql_busca = " `id` = '".$aCode["id"]."' OR `nome` LIKE '%$term%' OR `code` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	if(strlen($term) <= 1){
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'informe o nome da pessoa...');
		array_push($return_arr,$row_array);
	}else{
				
		if(isset($_GET["add"])){		
			//alimenta array de retorno
			$row_array['id'] = "NOVO:".maiusculo($term);
			$row_array['text'] = "<b>".maiusculo($term)."</b>";
			array_push($return_arr,$row_array);
		}//if(isset($_GET["add"])){ 					

		
	//lista ALERTAS
		$campos = "id,code,nome,sobrenome";
		$tabela = "cad_candidato_fisico";
		$where = $sql_busca;
		$cont = "0";
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){ $cont++;
			$id = $linha["id"];
			$code = $linha["code"];
			$legenda = $linha["nome"];
			$sobrenome = $linha["sobrenome"];			
			$html = $cVLogin->popDetalhes("C",$id,"3_con_candidatofisico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO')).SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code)." - <b>".$legenda." ".$sobrenome."</b><br>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
			
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = $html;
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
		
	
	}
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<












































//AJAX QUE EXIBE ITEM DE CANDIDATO JURIDICO ------------------------------------------------------------------>>>
if($ajax == "candidatojuridico"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);		
		$sql_busca = " `id` = '".$aCode["id"]."' OR `nome` LIKE '%$term%' OR `fantasia` LIKE '%$term%' OR `code` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	if(isset($_GET["add"])){		
		///VERIFICA PERMISSÕES DE ACESSO
		if($cVLogin->loginAcesso("3_con_candidatojuridico","cad")){
			//alimenta array de retorno
			$row_array['id'] = "NOVO";
			$row_array['text'] = " ".$class_fLNG->txt(__FILE__,__LINE__,'<b>ADICIONAR NOVO CADASTRO</b> (abrir formulário de cadastro)').'<div style="clear:both; border-bottom:#CCC 2px solid; height:10px;"></div>';
			array_push($return_arr,$row_array);
		}//loginAcesso
	}//if(isset($_GET["add"])){ 
	
//lista ALERTAS
	$campos = "id,code,nome,cnpj";
	$tabela = "cad_candidato_juridico";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$html = $cVLogin->popDetalhes("C",$id,"3_con_candidatojuridico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO'))."<b>".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code)." - <b>".$legenda."</b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
		
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $html;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<





























//AJAX QUE EXIBE ITEM DE CANDIDATO JURIDICO ------------------------------------------------------------------>>>
if($ajax == "candidatojuridicoTriagem"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$aCode = fGERAL::codeRandRetorno($term);		
		$sql_busca = " `id` = '".$aCode["id"]."' OR `nome` LIKE '%$term%' OR `fantasia` LIKE '%$term%' OR `code` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	if(strlen($term) <= 1){
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'informe o nome da empresa...');
		array_push($return_arr,$row_array);
	}else{	
		
		if(isset($_GET["add"])){		
			//alimenta array de retorno
			$row_array['id'] = "NOVO:".maiusculo($term);
			$row_array['text'] = "<b>".$class_fLNG->txt(__FILE__,__LINE__,'NOVO').": ".maiusculo($term)."</b>";
			array_push($return_arr,$row_array);
		}//if(isset($_GET["add"])){ 
		
	
	//lista ALERTAS
		$campos = "id,code,nome,cnpj";
		$tabela = "cad_candidato_juridico";
		$where = $sql_busca;
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$code = $linha["code"];
			$legenda = $linha["nome"];
			$html = $cVLogin->popDetalhes("C",$id,"3_con_candidatojuridico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO'))."<b>".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code)." - <b>".$legenda."</b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
			
			
			//alimenta array de retorno
			$row_array['id'] = $id;
			$row_array['text'] = $html;
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
	}
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<

























//AJAX QUE EXIBE ITEM DE CANDIDATO JURIDICO ------------------------------------------------------------------>>>
if($ajax == "comboProcesso"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["tipo"])){ $tipo = $_GET["tipo"]; }else{ $tipo = ""; }
	if(isset($_GET["status"])){ $status_b = $_GET["status"]; }else{ $status_b = "0"; }
	if ($status_b <= 2) { $status_b = 0; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `code` LIKE '%".$term."%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	if(strlen($term) != 11){
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'informe o número do processo...');
		array_push($return_arr,$row_array);
	}else{	
		
		if($tipo == "fisico"){ $sql_busca .= " AND candidato_fisico_id >= '1'"; }
		if($tipo == "juridico"){ $sql_busca .= " AND candidato_juridico_id >= '1'"; }
		
		//lista ALERTAS
		$campos = "id,code,candidato_fisico_id,candidato_juridico_id,servico_id,tipo_servico,status";
		$tabela = "axl_processo";
		$where = $sql_busca;
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY code ASC",$page_limit);
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$code = $linha["code"];
			$candidato_fisico_id = $linha["candidato_fisico_id"];
			$candidato_juridico_id = $linha["candidato_juridico_id"];		
			$servico_id = $linha["servico_id"];	
			$tipo_servico = $linha["tipo_servico"];
			$status = $linha["status"];	

			$valida = 1;
			if ($status_b == "0" and $status >= 3){ $valida = 0; }
			if ($valida == 1 and $status_b == "4" and $status == 4){ $valida = 0; }
			if ($valida == 1 and $status_b == "5" and $status == 5){ $valida = 0; }
			
			if ($valida == 0) {
				//alimenta array de retorno
				$row_array['id'] = "";
				$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Este processo não está com status !!status!!',array("status"=>processoStatusLeg($status_b)));	
				array_push($return_arr,$row_array);
				break;
			}			
			
			$nome = "";
			if($candidato_fisico_id >= "1"){
				$linha1 = fSQL::SQL_SELECT_ONE("nome,sobrenome","cad_candidato_fisico","id = '$candidato_fisico_id'");
				$nome = $linha1["nome"]." ".$linha1["sobrenome"];
			}else{
				$linha1 = fSQL::SQL_SELECT_ONE("nome,code","cad_candidato_juridico","id = '$candidato_juridico_id'");
				$nome = $linha1["nome"]." (".$linha1["code"].")";			
			}
			
			$tipo_servico = categoriaServicoLeg($tipo_servico);
			$linha1 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '$servico_id'");
			$tipo_servico_n = $linha1["nome"];
			
			$html = "<b>".SYS_CONFIG_PROCESSO_SIGLA." ".$code." - ".$tipo_servico."</b><br>".$tipo_servico_n."<br><small><i>".$nome."</i></small>";
			//alimenta array de retorno
			$row_array['id'] = $code;
			$row_array['text'] = $html;
			//formata amarelo
			if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
			$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
			array_push($return_arr,$row_array);
	
		}//fim while
	}
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<































//AJAX QUE EXIBE ITEM DE CNAE SUBCLASSE ------------------------------------------------------------------>>>
if($ajax == "cnaeSubclasse"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `id` = '$term' OR `codigo` LIKE '%$term%' OR `legenda` LIKE '%$term%' "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
		

//lista ALERTAS
	$campos = "id,codigo,legenda";
	$tabela = "combo_cnae_subclasse";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY legenda ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$codigo = $linha["codigo"];
		$legenda = $linha["legenda"];
		
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'Código').": ".$codigo."<br><b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<




























































//AJAX QUE EXIBE ITEM DE INFORMAÇÕES COMPLEMENTARES DO PROTOCOLO ------------------------------------------------------------------>>>
if($ajax == "protocoloTipoInf"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["perfil_id"])){ $perfil_id = $_GET["perfil_id"]; }else{ $perfil_id = "0"; }
	$sql_busca = "perfil_id = '".$perfil_id."'";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca .= " AND ( `id` = '$term' OR `nome` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	
//lista ALERTAS
	$campos = "id,nome,tipo_campo,obrigatorio";
	$tabela = "adm_protocolo_tipo_inf";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$tipo_campo = $linha["tipo_campo"];
		$obrigatorio = $linha["obrigatorio"];
		if($obrigatorio == "0"){ $obrigatorio_leg = ""; }else{ $obrigatorio_leg = " [OBRIGATÓRIO]"; }
		if($tipo_campo == "1"){ $tipo_campo_n = "CAMPO DE OPÇÕES"; }
		if($tipo_campo == "2"){ $tipo_campo_n = "CAMPO NUMÉRICO"; }
		if($tipo_campo == "3"){ $tipo_campo_n = "CAMPO DE TEXTO"; }
		if($tipo_campo == "9"){ $tipo_campo_n = "CAMPO DE ARQUIVO"; }
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $cVLogin->popDetalhes("C",$id,"7_pro_protocolotipoinf","DETALHES DA INFORMAÇÃO COMPLEMENTAR").$id." - <b>".$legenda."</b>".$obrigatorio_leg."<br><i>".$tipo_campo_n."</i>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<






















//AJAX QUE EXIBE ITEM DE TIPO DE PROTOCOLO ------------------------------------------------------------------>>>
if($ajax == "protocoloTipo"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["perfil_id"])){ $perfil_id = $_GET["perfil_id"]; }else{ $perfil_id = "0"; }
	//$sql_busca = "perfil_id = '".$perfil_id."' AND status = '1'";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		if($sql_busca != ""){ $sql_busca .= " AND "; }
		$sql_busca .= " AND ( `id` = '$term' OR `nome` LIKE '%$term%' OR `assunto_padrao` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome


	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	
//lista ALERTAS
	$campos = "id,nome";
	$tabela = "adm_protocolo_tipo";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY nome ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $id.". <b>".$legenda."</b>";
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);

	}//fim while
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<






























//AJAX QUE EXIBE LISTA DE STATUS SIPONIVEIS NO PROTOCOLO ------------------------------------------------------------------>>>
if($ajax == "protocoloStatus"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	if(isset($_GET["tab_id"])){ $tab_id = $_GET["tab_id"]; }else{ $tab_id = ""; }
	if($tab_id != "0"){ $tab_id_leg = "(".$tab_id.")"; }else{ $tab_id_leg = ""; }

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	if($status == "0"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'EM ATENDIMENTO'); }
	if($status == "1"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'EM COLETA'); }	
	if($status == "2"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'COLETA REALIZADA (AGUARDANDO ABIS)'); }	
	if($status == "3"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'EM IMPRESSÃO'); }	
	if($status == "4"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'IMPRESSO'); }	
	if($status == "5"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'ATIVO'); }	
	if($status == "6"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'CANCELADO'); }	
	if($status == "7"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'COLETA RECUSADA'); }		
	if($status == "8"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'IMPRESSÃO CANCELADA'); }		
	if($status == "9"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'VENCIDO'); }		
	if($status == "10"){ $leg = $class_fLNG->txt(__FILE__,__LINE__,'SUSPENSO'); }		
	
	//alimenta array de retorno
	$row_array['id'] = "0";//EM ATENDIMENTO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);	
	
	//alimenta array de retorno
	$row_array['id'] = "1";//EM COLETA
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	if($tab_id == "0"){}else{ array_push($return_arr,$row_array); }

	//alimenta array de retorno
	$row_array['id'] = "2";//APENSADO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	//alimenta array de retorno
	$row_array['id'] = "3";//EM TRAMITAÇÃO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	//alimenta array de retorno
	$row_array['id'] = "4";//AGUARDANDO PAGAMENTO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	//alimenta array de retorno
	$row_array['id'] = "5";//AGUARDANDO INTERAÇÃO DO CANDIDATO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	//alimenta array de retorno
	$row_array['id'] = "6";//DEFERIDO/ACEITO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	//alimenta array de retorno
	$row_array['id'] = "7";//INDEFERIDO/NEGADO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	
	//alimenta array de retorno
	$row_array['id'] = "8";//INDEFERIDO/NEGADO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	
	//alimenta array de retorno
	$row_array['id'] = "9";//INDEFERIDO/NEGADO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);
	
	
	//alimenta array de retorno
	$row_array['id'] = "10";//INDEFERIDO/NEGADO
	$row_array['text'] = "<b>".processoStatusLeg($row_array['id'])." </b>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	array_push($return_arr,$row_array);			
	
	
	
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<




































































if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
}
