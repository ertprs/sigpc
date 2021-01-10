<?php



@AXL::check_login('axl.atendimento');

/**
 * Exibe a tela de erro de triagem
 */
try {
	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	$atendimento = Session::getInstance()->get('ATENDIMENTO');
	TAtendimento::exibir_erro_triagem($atendimento,$usuario);
    
}
catch(Exception $e) {
	TAtendimento::display_exception($e);
}


?>
