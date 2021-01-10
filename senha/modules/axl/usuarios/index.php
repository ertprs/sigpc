<?php



AXL::check_access('axl.usuarios');
/**
 * Carrega o template padrao do mudulo usuarios
 */
try {

	TUsuarios::display_header("Controle de Usuários");
    
	// Configuracao Usuarios
	TUsuarios::display_usuarios_template();
    
}
catch (Exception $e) {
	Template::display_exception($e);
}

?>
