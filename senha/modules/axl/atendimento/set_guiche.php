<?php



AXL::check_login('axl.atendimento');

/**
 * Define o numero do guiche do atendente
 */
 
try {
    
    if (!isset($_GET['guiche'])) {
    	throw new Exception("Guiche não especificado.");
    }
    
    $n = (int) $_GET['guiche'];
    if ($n < 1 || $n > 255) {
    	throw new Exception("O guiche deve estar entre 1 e 255.");
    }
    
    setcookie('Atendimento_guiche',$n,time()+60*60*24*30*48 );
    Session::getInstance()->get(AXL::K_CURRENT_USER)->set_num_guiche($n);
    AXL::_include("modules/axl/atendimento/atend.php");
	

}
catch (Exception $e) {
	TAtendimento::display_exception($e,'',"window.redir('?mod=axl.atendimento')");
}


?>
