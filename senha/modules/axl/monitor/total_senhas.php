<?php



@AXL::check_login('axl.monitor');

/**
 * Monta template do monitor
 */
try {
    $unidade = AXL::get_current_user()->get_unidade();
    $total = DB::getInstance()->get_total_fila($unidade->get_id());
    
	Session::getInstance()->get('MONITOR')->set_total_senhas($total);
    echo Session::getInstance()->get('MONITOR')->get_total_senhas();

} catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>
