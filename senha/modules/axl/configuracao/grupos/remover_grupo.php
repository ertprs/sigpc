<?php



AXL::check_login('axl.configuracao');
/**
 * Exibe a jenala para a confirmação de remoção de grupos
 */
try {

    if (empty($_POST['id_grupo'])) {
	    throw new Exception("O grupo a ser deletado deve ser especificado.");
    }
   
    $id_grupo = $_POST['id_grupo'];
    
    $grupo = DB::getInstance()->get_grupo_by_id($id_grupo);
    if ($grupo == null) {
    	throw new Exception("O grupo especificado para remoção não existe.");
    }
    if ($grupo->is_raiz()) {
    	throw new Exception("Não é possível remover o grupo raiz.");
    }
    
    DB::getInstance()->remover_grupo($id_grupo);
    TConfiguracao::display_confirm_dialog("Grupo removido com sucesso.");
}
catch(PDOException $e){
	if($e->getCode() >= 23000 && $e->getCode() <24000){
		TConfiguracao::display_error('Não é possivel remover o grupo porque existem unidades ou usuários associados a ele.','Remover grupo');
	}else{
		TConfiguracao::display_exception($e);
	}	
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>