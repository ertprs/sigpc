<?php



@AXL::check_login('axl.triagem');

/**
 * Exibe a data atual do sistema
 */

try {

    echo AXL::get_date("d/m/Y H:i:s");
    
} catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>