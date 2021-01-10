<?php



AXL::check_login('axl.atendimento');
/**
 * Usado quando o usuário cancela alguma ação do atendimento. 
 * Erro triagem e encerrar atendimento
 */
try {
	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	
	$atendimento = Session::getInstance()->get('ATENDIMENTO');
	// Necessário para o caso em que o usuário pressiona o "voltar"
	// no encerrar atendimento.
	if($atendimento->get_status()==Atendimento::ATENDIMENTO_ENCERRADO)
		$atendimento->set_status(Atendimento::ATENDIMENTO_INICIADO);
	if ($atendimento->get_status()==Atendimento::ATENDIMENTO_INICIADO){
		AXL::_include("modules/axl/atendimento/atender/index.php");
	}else{
		TAtendimento::display_atendimento_iniciar($atendimento, $usuario);
	}
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>