<?php



AXL::check_access('axl.relatorios');

try {    
	
	if (isset($_GET['rel'])) {
		AXL::_include("modules/axl/relatorios/relatorios.php");
	}
	else {
	    # verifica se o modulo esta devidamente instalado   
	    Session::getInstance()->get(AXL::K_CURRENT_MODULE)->verifica();
		
		TRelatorios::display_header("Relatórios");
		
		// Configuracao Usuarios
		TRelatorios::display_relatorios();
	}
}
catch (Exception $e) {
	TRelatorios::display_exception($e);
}

?>