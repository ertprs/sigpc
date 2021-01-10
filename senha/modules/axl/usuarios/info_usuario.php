<?php



AXL::check_login("axl.usuarios");
/**
 * Monta interface de edição do usuario
 */
try {
	if (empty($_POST['id_usu'])) {
		TUsuarios::display_popup_header('CRIAR USUÁRIO');
		TUsuarios::display_edit_user();
		TUsuarios::display_popup_footer();
	}
	else {
		$id_usu = $_POST['id_usu'];
        $id_grupo = $_POST['id_grupo'];
	
		$usuario = DB::getInstance()->get_usuario_by_id($id_usu);
		if ($usuario == null) {
			throw new Exception("Usuário não encontrado.");
		}
        
		TUsuarios::display_edit_user($usuario, $id_grupo);
	}
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}

?>