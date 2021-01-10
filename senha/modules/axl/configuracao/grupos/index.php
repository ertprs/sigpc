<?php



AXL::check_access('axl.configuracao');

try {
	// Configuracao Grupos
	TConfiguracao::display_group_control();
}
catch (Exception $e) {
	Template::display_exception($e);
}

?>
