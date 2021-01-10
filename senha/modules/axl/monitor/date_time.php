<?php



@AXL::check_login('axl.monitor');
/**
 * Exibe data e hora
 */
try {

    echo AXL::get_date("d/m/Y H:i:s");
    
} catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>
