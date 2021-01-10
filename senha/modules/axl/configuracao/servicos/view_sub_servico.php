<?php



AXL::check_login('axl.configuracao');

/**
 * Monta template para criar/editar subservico
 */
try {
	$id_macro = $_POST['id_macro'];
	if (!empty($_POST['id_serv'])) {
		$id_serv = $_POST['id_serv'];
		$servico = DB::getInstance()->get_servico($id_serv);
	}
	else {
		$servico = null;
	}
	
	TConfiguracao::display_popup_header(($servico)?'EDITAR SUBSERVIÇO':'CRIAR SUBSERVIÇO');
	TConfiguracao::display_view_sub_serv($servico, $id_macro);
	TConfiguracao::display_popup_footer();
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>