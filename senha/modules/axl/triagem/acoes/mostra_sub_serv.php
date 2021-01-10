<?php



AXL::check_login('axl.triagem');

/**
 * mostra subservicos
 */
try {
	Template::display_popup_header();
	$id_mestre = $_GET['id_mestre'];
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	
	TTriagem::list_sub_serv($id_mestre, $id_uni);
	Template::display_popup_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>