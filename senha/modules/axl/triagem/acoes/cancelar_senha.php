<?php



@AXL::check_login('axl.triagem');

/**
 * 
 * Exibe a interface de cancelar senhas
 */

try {
	Template::display_popup_header("CANCELAR SENHA");
	
	TTriagem::exibir_cancelar_senha();

	Template::display_popup_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>