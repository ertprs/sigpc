<?php


/**
* Chama funcao para exibir o conteudo da pagina inicial do modulo relatorios opcao relatorios
*/

AXL::check_login("axl.relatorios");

try{
	TRelatorios::display_relatorio_conteudo();
	
}catch (Exception $e){
	Template::display_exception($e);
}
?>