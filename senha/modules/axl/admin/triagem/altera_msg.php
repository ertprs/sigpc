<?php



AXL::check_login('axl.admin');
/**
 * Modifica a mensagem que será exibida.
 */
try{
	$msg = $_POST['msg'];
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$id_usu = AXL::get_current_user()->get_id();
	
	DB::getInstance()->set_senha_msg_loc($id_uni, $id_usu, $msg);
}
catch (Exception $e){
	Template::display_exception($e);
}

?>