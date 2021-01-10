<?php



AXL::check_access('axl.configuracao');

try {
	// Configuracao Cargos
	TConfiguracao::display_cargos_config();
}
catch (Exception $e) {
	Template::display_exception($e);
}

?>
