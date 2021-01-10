<?php



define('MODULO', 'LOGIN_UNIDADE');

try {
	if (!AXL::is_logged()) {
		AXL::force_login();
	}
	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	
	$trocar = $_GET['trocar'];
	if ($trocar) {
		$modulo = Session::getInstance()->get(AXL::K_CURRENT_MODULE);
		
		Session::getInstance()->reset();
		$usuario->set_unidade();
		
		Session::getInstance()->setGlobal(AXL::K_CURRENT_MODULE, $modulo);
		Session::getInstance()->setGlobal(AXL::K_CURRENT_USER, $usuario);
        header("Location:?mod=axl.inicio");
	}
	
	if (AXL::has_unidade()) {
	    header("Location:?mod=" . Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_chave());
	}
	
	$unidades = DB::getInstance()->get_unidades_by_usuario($usuario->get_id());
	$total_unidades = sizeof($unidades);
	if ($total_unidades == 0) {
		Template::display_header("AXL");
		Template::display_error('Seu usuário não está associado a nenhuma unidade.','ERRO',0,"location.href='?".AXL::K_LOGOUT."'");
		Template::display_footer();
	}
	else if ($total_unidades == 1) {
		$unidade = array_shift($unidades);
		$usuario->set_unidade($unidade);
		
		header("Location:?mod=" . Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_chave());
		//Template::display_confirm_dialog('Logado automaticamente na unidade: '.$unidade->get_codigo()." - ".$unidade->get_nome(), "Atendimento");
	} else {
		// ajusta array de unidades para mapeamento key => value
		$aux = array();
		foreach ($unidades as $unidade) {
			if($unidade->get_stat_uni() == 1){
				$aux[$unidade->get_id()] = $unidade->get_codigo()." - ".$unidade->get_nome();
			}
		}
		$content = Template::display_jump_menu($aux, "id_uni", "", null, "", 1);
		
		Template::display_header("AXL");
		echo Template::display_select_unidade($content, 'Defina sua unidade:', "AXL.setUnidade");
        //echo $content;
		Template::display_footer();
	}
}
catch (Exception $e) {
	Template::display_header("AXL");
	Template::display_exception($e, 'Erro', "window.redir('?logout')");
	Template::display_footer();
}
?>