<?php



AXL::check_login('axl.configuracao');
/**
 * Exibe a janela de edição de grupos
 */
try {

    if (empty($_POST['id_grupo'])) {
	    throw new Exception("O grupo a ser editado deve estar selecionado.");
    }

    $id_grupo = $_POST['id_grupo'];
    $grupo = DB::getInstance()->get_grupo_by_id($id_grupo);
    
    TConfiguracao::display_popup_header("EDITAR GRUPO");
	TConfiguracao::display_grupo($grupo);
	TConfiguracao::display_popup_footer();
} 
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>