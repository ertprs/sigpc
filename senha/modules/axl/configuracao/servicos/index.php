<?php



AXL::check_access('axl.configuracao');

try {
	// Configuracao servicos
	TConfiguracao::display_servicos_config();
}
catch (Exception $e) {
	Template::display_exception($e);
}

?>
