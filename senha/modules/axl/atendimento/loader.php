<?php



/**
 * Arquivo invocado no primeiro acesso ao modulo Atendimento nesta sessão, responsavel por restaurar
 * o atendimento do DB de volta para a Session
 */
$usuario = AXL::get_current_user();

$id_usu = $usuario->get_id();
$id_uni = $usuario->get_unidade()->get_id();
$status = array(Atendimento::CHAMADO_PELA_MESA, Atendimento::ATENDIMENTO_INICIADO, Atendimento::ATENDIMENTO_ENCERRADO);
$atendimentos = DB::getInstance()->get_atendimentos_by_usuario($id_usu, $id_uni, $status);

if (sizeof($atendimentos) > 0) {
	Session::getInstance()->set('ATENDIMENTO', $atendimentos[0]);
}

?>