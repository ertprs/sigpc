<?php



/**
 * arquivo que faz a alteração da
 * senha do usuário no banco de dados
 */
AXL::check_login("axl.inicio");

try {
	if (empty($_POST['id_usu'])) {
		throw new Exception("Usuário não especificado.");
	}
	if (empty($_POST['senha_atual'])) {
		throw new Exception("Senha atual não especificada.");
	}
	if (empty($_POST['nova_senha'])) {
		throw new Exception("Senha atual não especificada.");
	}
	$id_usu = $_POST['id_usu'];
	$senha_atual = $_POST['senha_atual'];
	$nova_senha = $_POST['nova_senha'];
	if(DB::getInstance()->alterar_senha_usu($id_usu,$nova_senha,$senha_atual)){
		Template::display_confirm_dialog('Sua senha foi alterada com sucesso.','Alteração de Senha',true);
	}else{
		TInicio::display_exception(new Exception("Senha atual inválida."), 'Alteração de Senha');
	}
}
catch (Exception $e) {
	TInicio::display_exception($e);
}

?>