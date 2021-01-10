<?php



AXL::check_login('axl.usuarios');
/**
 * Insere ou atualiza as informacoes de uma lotacao
 */
try {
    if (empty($_POST['id_usu']) || empty($_POST['id_grupo']) || empty($_POST['id_cargo']) || !isset($_POST['acao'])) {
	    throw new Exception("Preencha os campos corretamente.");
    }
	
    $id_usu = $_POST['id_usu'];
    $id_grupo = $_POST['id_grupo'];
    $id_grupo_default = $_POST['id_grupo_default'];
    $id_cargo = $_POST['id_cargo'];
    $acao = $_POST['acao'];
    
    // TODO verificações de segurança sobre: id_grupo, id_cargo
    // id_grupo: não permitir ao usuario lotar/editar um funcionario em um grupo onde ele não tem acesso
    // id_cargo: não permitir ao funcionario atribuir um cargo acima do seu.
    
    if ($acao == Template::ACAO_INSERIR) {
    	DB::getInstance()->inserir_lotacao($id_usu, $id_grupo, $id_cargo);
    }
    else {
    	if(DB::getInstance()->atualizar_lotacao($id_usu, $id_grupo, $id_cargo, $id_grupo_default)){
    		TUsuarios::display_confirm_dialog('Lotação atualizada com sucesso','Atualizar Lotação');
    	}
    }
    
}
catch (PDOException $e) {
	// Chave primária duplicada
	if ($e->getCode() >= 23000 && $e->getCode() <= 23999) {
		TUsuarios::display_error('Usuário já lotado neste grupo.<br />Somente uma lotação por grupo é permitida.');
	}
	else {
		TUsuarios::display_exception($e);
	}
}
catch(Exception $e) {
	TUsuarios::display_exception($e);
}
?>