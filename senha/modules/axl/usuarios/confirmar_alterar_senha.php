<?php



AXL::check_login("axl.usuarios");
/**
 * Altera senha de um usuario
 */
try {
	if (empty($_POST['id_usu'])) {
		throw new Exception("Usuário não especificado.");
	}
	if (empty($_POST['nova_senha'])) {
		throw new Exception("Senha atual não especificada.");
	}
	$id_usu = $_POST['id_usu'];
	$nova_senha = $_POST['nova_senha'];
    
	if (!DB::getInstance()->alterar_senha_mod_usu($id_usu, $nova_senha)) {
        throw new Exception("Senha inválida.");
	}
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}

?>