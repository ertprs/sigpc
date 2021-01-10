<?php



AXL::check_login('axl.monitor');
/**
 * Exibe senhas da fila de clientes
 */
try {
	
	if(empty($_POST["id_servico"]) ){
		throw new Exception("serviço não especificado");
	}
	$servicos = array($_POST["id_servico"]);
	$unidade = AXL::get_current_user()->get_unidade();
	$fila = DB::getInstance()->get_fila($servicos, $unidade->get_id());
	
	TMonitor::exibir_senhas_servico($fila->get_atendimentos());
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>