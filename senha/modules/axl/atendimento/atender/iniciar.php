<?php



@AXL::check_login('axl.atendimento');

/**
 * Redireciona para a tela inicial de atendimento
 */
try {
    
	$atendimento = Session::getInstance()->get('ATENDIMENTO');
    if ($atendimento->get_status() == Atendimento::CHAMADO_PELA_MESA) {
        $atendimento->set_status(Atendimento::ATENDIMENTO_INICIADO);
        DB::getInstance()->set_atendimento_status($atendimento->get_id(), Atendimento::ATENDIMENTO_INICIADO);
    }
    
    AXL::_include("modules/axl/atendimento/atender/index.php");
}
catch (Exception $e) {
	TAtendimento::display_exception($e);
}

?>