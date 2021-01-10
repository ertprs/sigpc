<?php



@AXL::check_login('axl.triagem');
 
/**
 * Carregador de conteudo
 * 
 * Carrega o conteudo do pagina atual na pagina a partir do link do menu
 * 
 */

try {
	if (Session::getInstance()->exists('TRIAGEM_PAGINA')) {
       $link = "modules/axl/triagem/" . DB::getInstance()->get_menu_link(Session::getInstance()->get('TRIAGEM_PAGINA'));
        if (file_exists($link)) {
        	AXL::_include("$link");        	
        } else {
      	  	Session::getInstance()->del('TRIAGEM_PAGINA');
            throw new Exception("Pagina nao encontrada.");
        }
        Session::getInstance()->del('TRIAGEM_PAGINA');
    }
} catch(Exception $e) {
	TTriagem::display_exception($e);
}
?>