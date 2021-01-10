<?php



AXL::check_login('axl.atendimento');
 
/**
 * Carregador de conteudo
 * 
 * Carrega o conteudo do pagina atual na pagina a partir do link do menu
 * 
 */

try {
	if (!Session::getInstance()->exists('ATENDIMENTO_PAGINA')) {
        AXL::_include("modules/axl/atendimento/atender/index.php");
    }
    else {
    	$link = "modules/axl/atendimento/" . DB::getInstance()->get_menu_link(Session::getInstance()->get('ATENDIMENTO_PAGINA'));
        if (is_file($link)) {
        	AXL::_include($link);
        }
        else {
            throw new Exception("Pagina nao encontrada.");
        }
    }
}
catch(Exception $e) {
	TAtendimento::display_exception($e);
}


?>
