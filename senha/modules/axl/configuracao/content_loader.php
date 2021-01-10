<?php



AXL::check_login('axl.configuracao');
 
/**
 * Carregador de conteudo
 * 
 * Carrega o conteudo do pagina atual na pagina a partir do link do menu
 * 
 */
try {
	if (empty($_GET['id_menu'])) {
		throw new Exception('Erro carregando conteudo.');
    }
    
    $id_menu = (int) Session::getInstance()->get('id_menu');
    
	$link = "modules/axl/configuracao/" . DB::getInstance()->get_menu_link($id_menu);
	if (file_exists($link)) {
		AXL::_include($link);
	}
	else {
		throw new Exception("Página não encontrada.");
	}

}
catch (Exception $e) {
	TAtendimento::display_exception($e);
}


?>
