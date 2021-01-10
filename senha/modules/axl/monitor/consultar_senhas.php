<?php



AXL::check_login('axl.monitor');
/**
 * exibe conteudo da popoup consultar senhas
 */
try {
	Template::display_popup_header("Consultar Senhas");
	TMonitor::exibir_consultar_senhas();
	Template::display_popup_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>