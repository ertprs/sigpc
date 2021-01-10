<?php



AXL::check_login("axl.relatorios");
/**
* Chama funcao para exibir o conteudo da pagina inicial do modulo relatorios opcao graficos
*/
try {
	TRelatorios::display_graficos_conteudo();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>