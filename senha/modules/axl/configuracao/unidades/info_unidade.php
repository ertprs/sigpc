<?php



AXL::check_login("axl.configuracao");

try {
	if (empty($_POST['id_uni'])) {
		TConfiguracao::display_popup_header();
		TConfiguracao::display_nova_unidade();
		TConfiguracao::display_popup_footer();
	}
	else {
		$id_uni = $_POST['id_uni'];
		$unidade = DB::getInstance()->get_unidade($id_uni);
		
		if ($unidade == null) {
			throw new Exception("Unidade n&atilde;o encontrada.");
		}
		TConfiguracao::display_edit_uni($unidade);
	}
}
catch (Exception $e) {
	TConfiguracao::display_exception($e);
}

?>