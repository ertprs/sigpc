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



}//fim else - if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina


?>
<?php


















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


































//AJAX (lista/preenche combox logradouro) ------------------------------------------------------------------>>>
if($ajax == "comboLogradouro"){
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `logradouro` LIKE '%$term%'"; //condição
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
				$row_array['id'] = maiusculo($_GET['term']);
				$row_array['text'] = $class_fLNG->txt(__FILE__,__LINE__,'NOVO').": <b>".maiusculo($_GET['term'])."</b>";
				array_push($return_arr,$row_array);
			}
		}
		
//lista ALERTAS
	$campos = "logradouro";
	$tabela = "cad_candidato_fisico_endereco";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY logradouro ORDER BY logradouro ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$legenda = $linha["logradouro"];
		
		//alimenta array de retorno
		$row_array['id'] = $legenda;
		$row_array['text'] = $legenda;
		array_push($return_arr,$row_array);

	}//fim while
	
	}//fim if(strlen($id) == 0){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);


}//fim ajax -------------------<<<<



























?>
<?php





if(isset($_GET["ajax"])){//verifia se chamou função AJAX da Pagina
	//REMOVE CONEXAO
	//fecha todas as conexoes abertas
	$classe_db->FechaConexaoAll($SCRIPTOFF);//fecha conexoes
}
?>