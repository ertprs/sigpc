<?php



AXL::check_login('axl.configuracao');
try {
/**
 * exibe a janela de criação de um novo grupo
 */
    $id_grupo_pai = (int) $_POST['id_grupo_pai'];

	TConfiguracao::display_popup_header('CRIAR GRUPO');
	TConfiguracao::display_grupo(null, $id_grupo_pai);
	TConfiguracao::display_popup_footer();
} 
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>