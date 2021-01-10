<?php




AXL::check_login('axl.triagem');
/**
 * 
 * Monta a interface de cancelar senha por senha
 */
try {
		
	TTriagem::exibir_cancelar_senha_por_senha();
		
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>