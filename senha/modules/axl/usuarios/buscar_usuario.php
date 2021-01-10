<?php



AXL::check_login("axl.usuarios");
/**
 * Exibe o resultado da busca por usuarios
 */
try {
	if (empty($_POST['search_type'])) {
		throw new Exception("Selecione o modo da busca.");
	}
	
	$modo = $_POST['search_type']; // tipo de busca (login, nome)
	$termo = $_POST['search_input']; // valor da busca
    $id_grupo = $_POST['id_grupo']; // procurar dentro deste grupo

    $modulo = Session::getInstance()->get(AXL::K_CURRENT_MODULE);
    $admin = AXL::get_current_user();
	$lotacao = $admin->get_lotacao();
    
    $termo_login = "%"; // todos logins
    $termo_nome = "%"; // todos nomes

	if ($termo != "") {
		if ($modo == "login") {
			if (ctype_alnum($termo)) {
				$termo_login = '%'.$termo.'%';
			}
            else {
				throw new Exception("Digite apenas letras ou números.");
			}
		}
        else {
            $termo_nome = '%'.$termo.'%';
		}
	}

    $result = DB::getInstance()->get_usuarios_grupos_by_usuario($admin->get_id(), $modulo->get_id(), $id_grupo, $termo_login, $termo_nome);

    // nao passar null, passar um array vazio
    if ($result == null) {
        $result = array();
    }
	TUsuarios::display_resultado_users_interno($result, $id_grupo);
}
catch (Exception $e) {
	TUsuarios::display_exception($e);
}

?>