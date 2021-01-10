<?php



AXL::check_access('axl.configuracao');

try {
	// Configuracao Unidades
	TConfiguracao::display_unidades_config();
}
catch (Exception $e) {
	Template::display_exception($e);
}

?>
