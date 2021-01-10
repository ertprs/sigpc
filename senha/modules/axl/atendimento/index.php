<?php



AXL::check_access('axl.atendimento');

/**
 * Monta template do atendimento
 */

try {    

    # verifica se o modulo esta devidamente instalado   
    Session::getInstance()->get(AXL::K_CURRENT_MODULE)->verifica();
	
	TAtendimento::display_header("Atendimento");
	
	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	
	# verifica se a unidade está definida
	if ($usuario->get_unidade() instanceof Unidade) {
		#verifica se o guichê de atendimento está definido
		if (!($usuario->get_num_guiche() > 0)) {
			$n = $_COOKIE['Atendimento_guiche'];
	        TAtendimento::display_input_dialog("Informe o número do seu guiche.", "Atendimento", "Atendimento.setGuiche", $n);
		}
	    else {
		    AXL::_include("modules/axl/atendimento/atend.php");
	    }
	}
	else {
		// TODO remover
	}
    
    TAtendimento::display_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
