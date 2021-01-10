<?php



AXL::check_login("axl.usuarios");
/**
 * Exibe a lotação do admin neste grupo e os cargos visiveis a ele
 */
try {
	if (empty($_POST['id_grupo'])) {
		throw new Exception("Usuário não especificado.");
	}
	$id_grupo = $_POST['id_grupo'];
	
	$admin = AXL::get_current_user();
	// Obtem a lotacao do Admin no grupo especificado
	// Atraves da lotacao teremos seu cargo naquele grupo e por consequencia saberemos quais 
	// cargos ele pode oferecer naquele grupo
	$lotacao = DB::getInstance()->get_lotacao_valida($admin->get_id(), $id_grupo);
	
	DB::getInstance()->get_sub_cargos($lotacao->get_cargo()->get_id());
	
	TUsuarios::display_lotacao_select_cargos();
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}
?>