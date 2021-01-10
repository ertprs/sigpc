<?php



AXL::check_login('axl.usuarios');
/**
 * Remove lotacoes passadas por POST 
 */
try {
//    if (empty($_POST['id_usu']) || empty($_POST['id_grupo'])) {
//	    throw new Exception("Nenhuma lotação selecionada.");
//    }
	$id_usu = $_POST["id_usu"];
	if(empty($id_usu) ){
		throw new Exception("Usuário não especificado.");
	}
	
	$id_grupo = $_POST['id_grupo'];
	if(empty($id_grupo) ){
		throw new Exception("Grupo não especificado.");
	}
	
	$id_lotacoes = $_POST["id_lotacoes"];
	
    // TODO verificações de segurança sobre: id_grupo, id_cargo
    // id_grupo: não permitir ao usuario lotar/editar um funcionario em um grupo onde ele não tem acesso
    // id_cargo: não permitir ao funcionario atribuir um cargo acima do seu.
    
	foreach($id_lotacoes as $id)
	{
		DB::getInstance()->remover_lotacao($id_usu, $id);
	}
	TUsuarios::display_confirm_dialog('Lotação removida com sucesso','Remover Lotação');
    
}
catch(Exception $e) {
	TUsuarios::display_exception($e);
}
?>