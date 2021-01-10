<?php



/**
 * arquivo que chama a função que irá 
 * montar a tela de editar senha do usuário
 */
AXL::check_login("axl.usuarios");

try {
	Template::display_popup_header('Editar Senha Usuário');
	TUsuarios::display_edit_pass_user();
	Template::display_popup_footer();
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}

?>