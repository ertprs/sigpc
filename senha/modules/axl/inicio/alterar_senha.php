<?php



/**
 * arquivo que chama a função que irá 
 * montar a tela de editar senha do usuário
 */
AXL::check_login("axl.inicio");

try {
	Template::display_popup_header("EDITAR SENHA USUÁRIO");
	TInicio::display_edit_pass_user();
	Template::display_popup_footer();
}
catch (Exception $e) {
	TInicio::display_exception($e);
}

?>