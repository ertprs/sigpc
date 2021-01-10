<?php



AXL::check_login('axl.atendimento');

/** 
 * Atualiza o estado do atendimento para "não compareceu"
 */
try {
	$atendimento = Session::getInstance()->get('ATENDIMENTO');
	if ($atendimento == null) {
		// o atendimento pode não existir ou existir com valor == null
		throw new Exception("Erro ao encerrar atendimento por não comparecimento, atendimento inexistente ou nulo na session.");
	}

	$atendimento->set_status(Atendimento::NAO_COMPARECEU);
	DB::getInstance()->set_atendimento_status($atendimento->get_id(), Atendimento::NAO_COMPARECEU);
	    
	Session::getInstance()->del('ATENDIMENTO');

	AXL::_include("modules/axl/atendimento/atender/index.php");


}
catch (Exception $e) {
	TAtendimento::display_exception($e);
}
?>