<?php



AXL::check_login('axl.usuarios');
/**
 * Grava as configurações do usuario
 */
/*Template::display_popup_header();
echo '<pre>';
print_r($_POST);
exit();*/

try {
	$id_usu = (int) $_POST["id_usu"];

    // se id_usu estiver vazio entao estamos craindo um usuario
    // caso contrario, estamos editando um usuario
    $criando = empty($id_usu); 

	$login_usu = $_POST["login_usu"];
	if (empty($login_usu)) {
		throw new Exception("Usuário não especificado.");
	}

	$nm_usu = $_POST["nm_usu"];
	if (empty($nm_usu)) {
		throw new Exception("Nome não especificado.");
	}
    
	$ult_nm_usu = $_POST["ult_nm_usu"];
	if (empty($ult_nm_usu)) {
		throw new Exception("Sobrenome não especificado.");
	}
    
	$lotacoes = $_POST['lotacoes'] ? $_POST['lotacoes'] : array();

	$servicos_add = $_POST['servicos_add'] ? $_POST['servicos_add'] : array();
    $servicos_del = $_POST['servicos_del'] ? $_POST['servicos_del'] : array();

    // criando
    if ($criando) {
        $senha_usu = $_POST['senha_usu'];
        $senha_usu2 = $_POST['senha_usu2'];

        if (empty($senha_usu) || empty($senha_usu2)) {
            throw new Exception("A senha e sua confirmação devem ser preenchidas.");
        }
        if (strlen($senha_usu) < 6) {
            throw new Exception("A senha deve possuir no mínimo 6 caracteres.");
        }
        if ($senha_usu != $senha_usu2) {
            throw new Exception("A senha não confere com a comfirmação, confira digitação.");
        }
        
        $usuario = DB::getInstance()->inserir_usuario($login_usu, $nm_usu, $ult_nm_usu, $senha_usu);
        $id_usu = $usuario->get_id();
    }
    else {
        DB::getInstance()->alterar_usu($id_usu, $login_usu, $nm_usu, $ult_nm_usu);
        DB::getInstance()->remover_lotacoes($id_usu);
    }

    foreach ($lotacoes as $id_grupo => $id_cargo) {
        DB::getInstance()->inserir_lotacao($id_usu, $id_grupo, $id_cargo);
    }

    foreach ($servicos_add as $id_uni => $servs) {
        foreach ($servs as $id_serv) {
            DB::getInstance()->adicionar_servico_usu($id_uni, $id_serv, $id_usu);
        }
    }

    foreach ($servicos_del as $id_uni => $servs) {
        foreach ($servs as $id_serv) {
            DB::getInstance()->remover_servico_usu($id_uni, $id_serv, $id_usu);
        }
    }

    if (!$criando) {
        DB::getInstance()->set_session_status($id_usu, Session::SESSION_DESATUALIZADA);
    }

    echo "true";
}
catch (PDOException $e) {
    
	if ($e->getCode() >= 213000 && $e->getCode() <= 23999) {
		TUsuarios::display_error('O login informado já está cadastrado para outro usuário.','Erro');
	}
    else {
		Template::display_exception($e);	
	}
}
catch (Exception $e) {
    Template::display_exception($e);
}
?>