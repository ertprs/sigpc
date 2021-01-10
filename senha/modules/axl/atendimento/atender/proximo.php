<?php



@AXL::check_login('axl.atendimento');

/**
 * Coloca a senha do cliente no painel
 */
 
try {
	/**
	 * 
	 * @var Usuario usuario
	 */
	$usuario = AXL::get_current_user();
	$unidade = $usuario->get_unidade();
	$servicos = $usuario->get_servicos();
	
	if (!Session::getInstance()->exists('ATENDIMENTO')) {
		// altera status na tabela atendimento e retorna o Atendimento
	    $atendimento = DB::getInstance()->chama_proximo_atendimento($usuario->get_id(), $unidade->get_id(), $servicos, $usuario->get_num_guiche());
	    //verirfica se têm fila
	    if ($atendimento == null) {
	    	throw new Exception("A fila está vazia.");
	    }
	    
	    // coloca o atendimento na Sessão do usuario
	    Session::getInstance()->set('ATENDIMENTO', $atendimento);
	}
	else {
		$atendimento = Session::getInstance()->get('ATENDIMENTO');
	}
		
	$msg_senha = $atendimento->get_cliente()->get_senha()->is_prioridade() ? "Prioridade" : "Atendimento";
    // insere na tabela do painel
	DB::getInstance()->chama_proximo($unidade->get_id(), $atendimento->get_servico(), $atendimento->get_cliente()->get_senha()->get_numero(), $atendimento->get_cliente()->get_senha()->get_sigla(), $msg_senha, "Guichê", $usuario->get_num_guiche());
    
	if ($atendimento->get_status() == Atendimento::CHAMADO_PELA_MESA) {
		AXL::_include("modules/axl/atendimento/atender/index.php");
	}
	else {
	    throw new Exception("Erro ao chamar proximo da fila. Status: ".$atendimento->get_status());
	}

} catch(Exception $e) {
	TAtendimento::display_exception($e);
	AXL::_include("modules/axl/atendimento/atender/index.php");
}
?>
