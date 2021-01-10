<?php



AXL::check_login('axl.monitor');

/**
 * Altera o index de paginacao do monitor
 */
try {
	
	if (isset($_GET['page'])) {		
	    $atual = Session::getInstance()->get('MONITOR_PAGINA');
	    $total = sizeof(Session::getInstance()->get('MONITOR')->get_servicos());
	    if ($_GET['page'] == -1) {
	        $pagina = ($atual-4 < 0)?0:$atual-4;
	    }
	    else if ($_GET['page'] == 1) {
	        $pagina = ($atual+4 >= $total)?$atual:$atual+4;
	    }
	    Session::getInstance()->set('MONITOR_PAGINA', $pagina);
	}
	else if (isset($_GET['goto_page'])) {
	    Session::getInstance()->set('MONITOR_PAGINA', $_GET['goto_page']);
	}
}
catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>
