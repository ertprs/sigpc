<?php



@AXL::check_login('axl.triagem');

/**
 * Altera o index de paginacao do monitor
 */
 
try {
	
	$pagina = (isset($_GET['page']))?$_GET['page']:Session::getInstance()->get('TRIAGEM_PAGINA');
	Session::getInstance()->set('TRIAGEM_PAGINA', $pagina);
	

} catch(Exception $e) {
	TMonitor::display_exception($e);
}
?>