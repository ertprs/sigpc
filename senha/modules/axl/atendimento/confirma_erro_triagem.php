<?php



AXL::check_login('axl.atendimento');
/**
 * Confirma o erro de triagem e volta para a tela inicial do módulo Atendimento.
 */
try {
//	Template::display_confirm_dialog("confirma erro triagem","");
	$id_servico = $_POST["id_servico"];
	
	$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
	$id_usuario = $usuario->get_id();
	$id_unidade = $usuario->get_unidade()->get_id();
	$atendimento = Session::getInstance()->get('ATENDIMENTO');
	//$dt_cheg = $atendimento->get_dt_cheg();
	$cliente = $atendimento->get_cliente();
	$num_senha = $cliente->get_senha()->get_numero();
	$id_prio = $cliente->get_senha()->get_prioridade()->get_id();
	$num_guiche = $usuario->get_num_guiche();
	$nm_cliente = $cliente->get_nome();
	
	//buscar o ident_cli do banco
	$ident_cliente = "";
	
	Session::getInstance()->del('ATENDIMENTO');
	DB::getInstance()->set_atendimento_status($atendimento->get_id(), Atendimento::ERRO_TRIAGEM);

    // O dt_cheg da nova senha deve ser o momento atual
	DB::getInstance()->erro_triagem($id_unidade, $id_servico, $num_senha, $id_prio, 0, Atendimento::SENHA_EMITIDA, $nm_cliente, $ident_cliente, AXL::get_date("Y/m/d H:i:s"));
	
	AXL::_include("modules/axl/atendimento/atender/index.php");
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>