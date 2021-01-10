<?php



AXL::check_login('axl.admin');
/**
 * Exibe macrosserviços
 */
try {
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	
	$tmp = array();	
	$servicos = DB::getInstance()->get_servicos_macro_nao_cadastrados_uni($id_uni);
		foreach ($servicos as $s) {
			$tmp[$s[0]] = $s[3]; 
		}	
		TAdmin::exibir_servicos($tmp,"Macrosserviços :");
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
