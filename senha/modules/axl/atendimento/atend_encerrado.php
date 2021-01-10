<?php



AXL::check_login('axl.atendimento');
/**
 * Exibe uma mensagem de informação indicando o encerramento do atendimento
 */
try {
	Template::display_confirm_dialog("Atendimento encerrado","Sucesso",true);
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>