<?php



AXL::check_login('axl.monitor');
/**
 * Determina status de senha como cancelada
 */
try {
	
	$id_atendimento = $_POST["id_atendimento"];
	
	if(empty($id_atendimento) ){
		throw new Exception("Atendimento não especificado");
	}
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$atendimento = DB::getInstance()->get_atendimento($id_atendimento, $id_uni);
	$atendimento->set_status(Atendimento::SENHA_CANCELADA);
	DB::getInstance()->set_atendimento_status($id_atendimento, Atendimento::SENHA_CANCELADA);
	Template::display_confirm_dialog("Senha cancelada com sucesso", "Sucesso");
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>