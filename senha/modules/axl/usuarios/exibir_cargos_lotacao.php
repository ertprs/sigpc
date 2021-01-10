<?php



AXL::check_login("axl.usuarios");
/**
 * Monta interface de exibição dos cargos iguais ou abaixo hierarquicamente ao cargo do usuario atual
 */
try {
	if (empty($_POST['id_grupo'])) {
		throw new Exception("Usu&aacute;rio n&atilde;o especificado.");
	}
    $id_grupo = (int) $_POST['id_grupo'];
    $lotacao = DB::getInstance()->get_lotacao_valida(AXL::get_current_user()->get_id(), $id_grupo);
    $cargos = DB::getInstance()->get_sub_cargos($lotacao->get_cargo()->get_id());
    
	echo TUsuarios::display_lotacao_select_cargos($cargos);
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}
?>
