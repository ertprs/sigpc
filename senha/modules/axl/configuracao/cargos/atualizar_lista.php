<?php



AXL::check_login('axl.configuracao');

/**
 * Atualiza as árvores dos cargos
 */
try {
	TConfiguracao::display_arvore_cargos();
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>