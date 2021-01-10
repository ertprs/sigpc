<?php



AXL::check_login('axl.configuracao');

/**
 * Exibe a janela para criação de cargos.
 */
try {
    $id_cargo_pai = (int) $_POST['id_cargo_pai'];
    
	TConfiguracao::display_popup_header('CRIAR CARGO');
	TConfiguracao::display_view_cargo(null, $id_cargo_pai);
	TConfiguracao::display_popup_footer();
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>