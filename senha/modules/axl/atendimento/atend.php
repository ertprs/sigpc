<?php



AXL::check_login('axl.atendimento');
/**
 * Constrói a tela de atendimento
 */
try {
    
    TAtendimento::display_atendimento(Session::getInstance()->get(AXL::K_CURRENT_USER));

} catch(Exception $e) {
	TAtendimento::display_exception($e);
}


?>
