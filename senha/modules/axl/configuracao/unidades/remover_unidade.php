<?php



AXL::check_login('axl.configuracao');

try {

    if (empty($_POST['id_uni'])) {
	    throw new Exception("A unidade a ser deletada deve ser especificado.");
    }
   
    $id_uni = $_POST['id_uni'];
    $uni_atual = AXL::get_current_user()->get_unidade();
    $unidade = DB::getInstance()->get_unidade($id_uni);
    if ($unidade == null) {
    	throw new Exception("A unidade especificada para remoção não existe.");
    }else{
    	if($uni_atual != null && $uni_atual->get_id() == $unidade->get_id()){
    		throw new Exception("Não é possível remover a própria unidade.");
    	}
    }
    DB::getInstance()->remover_unidade($id_uni);
    TConfiguracao::display_confirm_dialog("Unidade removida com sucesso.","Remover Unidade","Configuracao.alterarConteudo('unidades/index.php');");
}

catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>