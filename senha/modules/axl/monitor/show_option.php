<?php



@AXL::check_login('axl.monitor');
/**
 * carrega a pagina por pelo GET
 */
try {

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = DB::getInstance()->get_menu_link($_GET['page']);
        if (file_exists("modules/axl/monitor/$page")) {
            AXL::_include("modules/axl/monitor/$page");
        } else {
            throw new Exception("Pagina nao encontrada.");
        }
    }

} catch(Exception $e) {
	TMonitor::display_exception($e);
}

?>
