<?php



/**
 * Define a unidade do usuário
 */ 
try {
    
    if (!isset($_POST['id_uni'])) {
    	throw new Exception("Selecione uma unidade.");
    }
	$id_uni = (int) $_POST['id_uni'];
	
	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	$unidades = DB::getInstance()->get_unidades_by_usuario($usuario->get_id());
	
	$tmp = array();
	foreach ($unidades as $u) {
		$tmp[$u->get_id()] = $u;
	}
	
	// Verificação de segurança
	// Usuario tentou definir uma unidade ao qual não tem acesso
	$unidade = $tmp[$id_uni];
	if ($unidade != null) {
		$usuario->set_unidade($unidade);
		header("Location:?mod=" . Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_chave());
	}
	else {	
		throw new Exception('Acesso negado a unidade selecionada.');
	}
	

}
catch (Exception $e) {
	Template::display_exception($e, 'Erro', "window.redir('?unidade')");
}


?>