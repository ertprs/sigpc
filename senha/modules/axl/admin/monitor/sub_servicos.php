<?php



AXL::check_login('axl.admin');
/**
 * Exibe subserviços.
 */
try {
	
//	if(empty($_POST["id_servico"]) ){
//		throw new Exception("serviço não especificado");
//	}
//	$id_macro = $_POST["id_servico"];
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$subServicos = DB::getInstance()->get_servicos_sub_nao_cadastrados_uni($id_uni);
	
	$id_macro = "";
	
	$tmp = array();
	foreach ($subServicos as $serv){
		if ($id_macro != $serv[1]){
			$id_macro = $serv[1];
			$tmp["id_macro".$serv[1]] = "-- ".mb_strtoupper(DB::getInstance()->get_servico($serv[1])->get_nome(),'UTF-8')." --";
		}
		$tmp[$serv[0]] = $serv[3];		
	}
	TAdmin::exibir_servicos($tmp,"Subserviços :");
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>