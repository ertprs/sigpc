<?php



AXL::check_login('axl.configuracao');
/**
 * Mostra imagem específica de acordo com o id_grupo passado
 */
try {
	TConfiguracao::display_group_control_image($_POST['id_grupo']);
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>