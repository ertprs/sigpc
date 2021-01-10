<?php



/**
* Chama funcao para exibir o conteudo da pagina inicial do modulo relatorios opcao estatistica
*/
AXL::check_login("axl.relatorios");

try {
	TRelatorios::display_estatisticas_conteudo();
	
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>