<?php



AXL::check_login("axl.configuracao");

try {
	if (empty($_POST['search_type'])) {
		throw new Exception("Selecione o modo da busca.");
	}
//	if (sizeof($_POST['search_input'])<1) {
//		throw new Exception("Especifique o termo de busca");
//	}
	
	$modo = $_POST['search_type'];
	$termo = $_POST['search_input'];
	if($termo == ""){
		$result = DB::getInstance()->get_unidades();
	}//else if(ctype_alnum($termo)){
		$termo = '%'.$termo.'%';
		if ($modo == "codigo") {
			$unidade = DB::getInstance()->get_unidade_by_codigo($termo);
			$result = array();
			if ($unidade!= null) {
				$result = $unidade;
			}
		}else {
		//	modo = nome
			$unidade = DB::getInstance()->get_unidade_by_name($termo);
			
			$result = array();
			if ($unidade != null) {
				$result = $unidade;
			}
		}
//	}else{
//		throw new Exception("Digite apenas letras ou números.");
//	}
	TConfiguracao::display_resultado_unidades_interno($result);
}
catch (Exception $e) {
	TConfiguracao::display_exception($e);
}

?>