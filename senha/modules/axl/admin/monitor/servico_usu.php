<?php



AXL::check_login('axl.admin');
/**
 * Adição de serviços para um usuário
 */
try {
	$id_usu = $_POST["id_usu"];
	if (empty($id_usu)) {
		throw new Exception("Usuário não especificado.");
    }

	$id_servicos= $_POST["id_servicos"];
	if (sizeof($id_servicos) == 0) {
		$id_servicos[0] = null;
	}

	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
    
    Template::display_popup_header();
    TAdmin::display_new_serv_user($id_servicos, $id_usu);
    Template::display_popup_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>