<?php



AXL::check_login('axl.admin');
/**
 * Remove um serviço
 */
try {
	$id_serv = $_POST["id_serv"];
	if(empty($id_serv) ){
		throw new Exception("Serviço não especificado.");
	}
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
//	var_dump($id_uni,$id_serv,$id_loc,$nome_novo_serv,$sigla);
	DB::getInstance()->remover_servico_uni($id_uni,$id_serv);
	TAdmin::display_confirm_dialog("Serviço excluído com sucesso.","Excluir Serviço");
	}catch (PDOException $e) {
	if($e->getCode() == 23503){
		Template::display_error('O serviço não pode ser removido pois há atendimentos associados a ele.');
	}
	else {
		Template::display_exception($e);
	}
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>