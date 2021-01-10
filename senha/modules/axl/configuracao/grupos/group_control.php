<?php



AXL::check_login('axl.configuracao');
/**
 * Constrói a tela de gerenciamento de grupos no Config global 
 */
try {
	TConfiguracao::display_group_control_content();
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>