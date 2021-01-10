<?php



@AXL::check_login('axl.monitor');

/**
 * Exibe as filas dos servicos
 */
try {
	
	TMonitor::display_monitor_filas(Session::getInstance()->get('MONITOR'), Session::getInstance()->get('MONITOR_PAGINA'));
	

} catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>
