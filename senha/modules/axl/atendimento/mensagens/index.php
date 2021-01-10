<?php



@AXL::check_login('axl.atendimento');

/**
 * Exibe mensagens enviadas pelo Monitor
 */

try {

	echo "<p>Widget de Mensagens</p>";

} catch(Exception $e) {
	TAtendimento::display_exception($e);
}

?>
