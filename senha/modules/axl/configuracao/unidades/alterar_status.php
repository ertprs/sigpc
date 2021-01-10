<?php



AXL::check_login("axl.configuracao");

try {
	$id_uni = $_POST['id_uni'];
	$stat_uni = $_POST['stat_uni'];
	
	$unidade = AXL::get_current_user()->get_unidade();
	// Se ele não estiver logado em nenhuma unidade
	if($unidade == null || $unidade->get_id() != $id_uni){
		if(DB::getInstance()->set_status_uni($id_uni,$stat_uni)){
			TConfiguracao::display_confirm_dialog('Alteração do status efetuada com sucesso','Alteração de Status');
		}
	}else{
		TConfiguracao::display_error("Não é possível desativar a própria unidade.", "ERRO");
	}
}
catch (Exception $e) {
	TConfiguracao::display_exception($e);
}
?>