<?php



AXL::check_login('axl.monitor');
/**
 * Reativa uma senha cancelada (altera status para SENHA_EMITIDA)
 */
try {
	
	$id_atendimento = $_POST["id_atendimento"];
	$id_pri = $_POST["id_prio"];
	if(empty($id_atendimento) ){
		throw new Exception("Atendimento não especificado");
	}
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$atendimento = DB::getInstance()->get_atendimento($id_atendimento,$id_uni);
	$atendimento->set_status(Atendimento::SENHA_EMITIDA);
	DB::getInstance()->set_atendimento_status($id_atendimento,Atendimento::SENHA_EMITIDA);
	DB::getInstance()->set_atendimento_prioridade($id_atendimento, $id_pri);
	Template::display_confirm_dialog("Senha reativada com sucesso","Sucesso");
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>