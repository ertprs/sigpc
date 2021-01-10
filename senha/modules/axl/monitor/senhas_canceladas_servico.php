<?php



AXL::check_login('axl.monitor');
/**
 * Exibe todas as senhas canceladas de um serviço
 */
try {
	
	if(empty($_POST["id_servico"]) ){
		throw new Exception("serviço não especificado");
	}
	$id_servico = $_POST["id_servico"];
	
	$servicos = array();
	if ($id_servico == -1) {
		$ids_serv = array();
		$id_uni = AXL::get_current_user()->get_unidade()->get_id();
		$servicos_mestre = DB::getInstance()->get_servicos_unidade_reativar(Servico::SERVICO_ATIVO,$id_uni);
		foreach ($servicos_mestre as $s) {
			$servicos[] =  $s->get_id(); 
		}	
	}
	else {
		$servicos[] = $id_servico;
	}
	
	$unidade = AXL::get_current_user()->get_unidade();
	
	$fila = DB::getInstance()->get_fila($servicos, $unidade->get_id(), $ids_stat=array(Atendimento::SENHA_CANCELADA,Atendimento::NAO_COMPARECEU));
	
	TMonitor::exibir_senhas_servico($fila->get_atendimentos(),'Monitor.onPrioridadeSenha();');
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>