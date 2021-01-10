<?php



AXL::check_login('axl.atendimento');

/**
 * Altera o index de paginacao do monitor
 */
 
try {
	
	$pagina = (isset($_GET['page']))?$_GET['page']:Session::getInstance()->get('PAGINA_CONTEUDO');
	Session::getInstance()->set('PAGINA_CONTEUDO', $pagina);
}
catch (Exception $e) {
	Template::display_exception($e);
}


?>
