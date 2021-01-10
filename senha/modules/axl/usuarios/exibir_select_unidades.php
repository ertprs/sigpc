<?php



AXL::check_login("axl.usuarios");
/**
 * 
 * Monta a interface para exibir os grupos que o usuario tem acesso
 */
try {
    if (empty($_POST['id_grupo_filtro'])) {
        throw new Exception("Grupo de filtragem não selecionado.");
    }

    $id_grupo_filtro = $_POST['id_grupo_filtro'];
    $ids_grupo = $_POST['ids_grupo'] ? $_POST['ids_grupo'] : array();
    TUsuarios::display_select_uni_serv($id_grupo, $ids_grupo);
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}
?>
