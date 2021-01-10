<?php



AXL::check_login("axl.usuarios");
/**
 * Altera status de um usuario
 */
try {
	$id_usu = $_POST['id_usu'];
	$stat_usu = $_POST['stat_usu'];
	
	if(Session::getInstance()->get(AXL::K_CURRENT_USER)->get_id() != $id_usu){
		if(DB::getInstance()->set_status_usu($id_usu,$stat_usu)){
			TUsuarios::display_confirm_dialog('Alteração do status efetuada com sucesso','Alteração de Status');
		}
	}else{
		TUsuarios::display_error("Não é possível desativar-se.", "ERRO");
	}
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}
?>