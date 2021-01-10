<?php



AXL::check_login("axl.usuarios");
/**
 * Exibe interface para edição ou adicao de lotacao de um usuario
 */
try {
	
	TUsuarios::display_popup_header($titulo = (empty($_POST['id_grupo'])?"Criar Lotação":"Editar Lotação"));
	
	// adicionando
	if (empty($_POST['id_grupo'])) {
		if(!empty($_POST['id_usu'])){
			$id_usu = $_POST['id_usu'];
		}
		$id_grupo_selecionado = $_POST['id_grupo_selecionado'] ;
		TUsuarios::display_user_group(AXL::get_current_user(),null,null,$id_usu, $id_grupo_selecionado);
	}
	else { // editando
		if (empty($_POST['id_cargo'])) {
			throw new Exception("Cargo não especificado.");
		}
		$id_usu = $_POST['id_usu'];
		$id_grupo = $_POST['id_grupo'];
		$id_cargo = $_POST['id_cargo'];
		$grupo = DB::getInstance()->get_grupo_by_id($id_grupo);
		$cargo = DB::getInstance()->get_cargo($id_cargo);
		TUsuarios::display_user_group(AXL::get_current_user(), $grupo, $cargo);
	}
	
	TUsuarios::display_popup_footer();
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}

?>