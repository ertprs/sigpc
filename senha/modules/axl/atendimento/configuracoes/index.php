<?php



@AXL::check_login('axl.atendimento');

/**
 * Configuracoes do Atendente
 * ex.: numero guiche
 */

try {

	echo "<p>Widget de Configuracoes</p>";

} catch(Exception $e) {
	TAtendimento::display_exception($e);
}

?>
