<?php



AXL::check_access('axl.inicio');

try {

	TInicio::display_header(Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_nome());
	
	//$unidade = AXL::get_current_user()->get_unidade();
	//TInicio::display_welcome_page($unidade);
	TInicio::display_welcome_place_holder();
	
    TInicio::display_footer();

} catch(Exception $e) {
	Template::display_exception($e);
}

?>
