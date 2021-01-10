<?php



AXL::check_login('axl.atendimento');

/**
 * Altera o index de paginacao do monitor
 */
 
try {
	
	$pagina = (isset($_GET['page']))?$_GET['page']:Session::getInstance()->get('ATENDIMENTO_PAGINA');
	Session::getInstance()->set('ATENDIMENTO_PAGINA', $pagina);
	

}
catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>
