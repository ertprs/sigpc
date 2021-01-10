<?php



AXL::check_login('axl.monitor');
/**
 * chama a função que monta a interface
 * de cancelar senhas de serviços
 */
try {
	Template::display_popup_header("Cancelar Senha");
	
	TMonitor::exibir_cancelar_senha();
	Template::display_popup_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
