<?php



@AXL::check_login('axl.triagem');
/**
 * carrega pagina passada pelo GET
 */
try {

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = DB::getInstance()->get_menu_link($_GET['page']);
        if (file_exists("modules/axl/triagem/$page")) {
            AXL::_include("modules/axl/triagem/$page");
        } else {
            throw new Exception("Pagina nao encontrada.");
        }
    }

} catch(Exception $e) {
	TTriagem::display_exception($e);
}

?>