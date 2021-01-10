<?php



AXL::check_login('axl.admin');
/**
 * Modifica o status da impressão das mensagens
 */
try{
	$status_imp = $_POST['status_imp'];
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();

	DB::getInstance()->set_msg_status($id_uni,$status_imp);
}
catch (Exception $e){
	Template::display_exception($e);
}

?>