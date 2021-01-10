<?php



@AXL::check_login('axl.atendimento');

/**
 * Estatisticas de Atendimento
 */ 

try {

	echo "<p>Widget de Estatisticas</p>";

} catch(Exception $e) {
	TAtendimento::display_exception($e);
}

?>
