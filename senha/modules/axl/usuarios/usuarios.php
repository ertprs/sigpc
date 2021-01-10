<?php



AXL::check_login('axl.usuarios');
/**
 * 
 * Exibe o conteudo padrao do modulo usuarios
 */
try {

    TUsuarios::display_users_config();

} catch(Exception $e) {
	TUsuarios::display_exception($e);
}

?>
