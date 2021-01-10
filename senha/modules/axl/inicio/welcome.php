<?php



/**
 * arquivo que chama o metodo da classe TInicio 
 * que monta a interface da pagina inicial
 */
	AXL::check_access('axl.inicio');
	
	$unidade = AXL::get_current_user()->get_unidade();
	TInicio::display_welcome_page($unidade);
	
?>
