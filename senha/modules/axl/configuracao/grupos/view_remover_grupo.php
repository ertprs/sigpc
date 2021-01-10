<?php



AXL::check_login('axl.configuracao');
/**
 * Exibe uma janela para a confirmação de remoção de grupo.
 */
try {

    if (empty($_POST['id_grupo'])) {
	    throw new Exception("O grupo a ser removido deve estar selecionado.");
    }

    $id_grupo = $_POST['id_grupo'];
    $grupo = DB::getInstance()->get_grupo_by_id($id_grupo);
    if ($grupo->is_raiz()) {
    	throw new Exception('Não é possível remover o grupo raíz.');
    }
    $grupos = DB::getInstance()->get_sub_grupos($id_grupo);
    $aux = array();
    $aux[]= $grupo->get_nome();
    foreach ($grupos as $g) {
    	$aux[]= $g->get_nome();
    }
	TConfiguracao::display_popup_header("CONFIRMAR A REMOÇÃO DO GRUPO");
    TConfiguracao::display_confirm_remover_grupo($aux);
    TConfiguracao::display_popup_footer();

}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>