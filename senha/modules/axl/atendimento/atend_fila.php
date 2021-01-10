<?php



AXL::check_login('axl.atendimento');

/**
 * Exibe a fila do atendimento
 */

try {
	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	$fila = DB::getInstance()->get_fila($usuario->get_servicos(), $usuario->get_unidade()->get_id());
	TAtendimento::display_atendimento_fila($usuario, $fila);

}
catch(Exception $e) {
	TAtendimento::display_exception($e);
}


?>
