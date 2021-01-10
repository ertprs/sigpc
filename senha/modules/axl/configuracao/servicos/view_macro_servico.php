<?php



AXL::check_login('axl.configuracao');

/**
 * Monta template para criar/editar macrosservico
 */
try {
	
	if (!empty($_POST['id_serv'])) {
		$id_serv =(int) $_POST['id_serv'];
		$servico = DB::getInstance()->get_servico($id_serv);
	}
	else {
		$servico = null;
	}
	TConfiguracao::display_popup_header($servico ? 'Editar Macrosserviço' : 'Criar Macrosserviço');
	TConfiguracao::display_view_macro_serv($servico);
	TConfiguracao::display_popup_footer();
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>