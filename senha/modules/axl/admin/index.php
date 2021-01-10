<?php



AXL::check_access('axl.admin');

try {    

    # verifica se o modulo esta devidamente instalado   
    Session::getInstance()->get(AXL::K_CURRENT_MODULE)->verifica();
	
	TAdmin::display_header("Administração");
	
	// Configuracao Grupos
	//TConfiguracao::display_group_control();
	
	// Configuracao Usuarios
	TAdmin::display_administracao();
	
	// Configuracao Cargos
	//TConfiguracao::display_cargos_config();

	// Configuracao servicos
//	TConfiguracao::display_servicos_config();

	//$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	//TConfiguracao::display_configuracao($usuario);
}
catch (Exception $e) {
	Template::display_exception($e);
}

?>
