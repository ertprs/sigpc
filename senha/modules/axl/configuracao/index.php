<?php



AXL::check_access('axl.configuracao');

try {    

    # verifica se o modulo esta devidamente instalado   
    Session::getInstance()->get(AXL::K_CURRENT_MODULE)->verifica();
	
	TConfiguracao::display_header("Configuração");
	
	// Configuracao Grupos
	//TConfiguracao::display_group_control();
	
	// Configuracao Usuarios
	//TConfiguracao::display_users_config();
	
	// Configuracao Cargos
	//TConfiguracao::display_cargos_config();

	// Configuracao servicos
//	TConfiguracao::display_servicos_config();

	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	TConfiguracao::display_configuracao($usuario);
}
catch (Exception $e) {
	Template::display_exception($e);
}

?>
