<?php



AXL::check_login('axl.configuracao');

/**
 * Monta template do novo grupo
 */
try {
	
	TConfiguracao::display_macro_serv_control();
	TConfiguracao::display_sub_serv_control();
	

}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>