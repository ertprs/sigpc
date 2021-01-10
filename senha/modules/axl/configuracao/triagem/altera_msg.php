<?php



AXL::check_login('axl.configuracao');

try{
	$msg = $_POST['msg'];
	$op = $_POST['op'];
	$id_usu = AXL::get_current_user()->get_id();
	echo ($id_uni);
	
	if ($op== 0){
		DB::getInstance()->set_senha_msg_global_unidades_locais($id_usu, $msg);		
	}else{
		DB::getInstance()->set_senha_msg_global($id_usu, $msg);	
	}
}
catch (Exception $e){
	Template::display_exception($e);
}

?>