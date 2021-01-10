<?php



/**
 * arquivo que chama a funçao para montar a interface
 * de cancelar senha por senha 
 */
AXL::check_login('axl.monitor');

try {
		
	TMonitor::exibir_cancelar_senha_por_senha();
		
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>