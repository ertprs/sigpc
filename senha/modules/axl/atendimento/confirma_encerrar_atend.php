<?php



AXL::check_login('axl.atendimento');
/**
 * Encerra o atendimento e volta para a tela inicial do módulo Atendimento.
 */
try {
	
	if(empty($_POST["list_servico_atendido"]) ){
		throw new Exception("Nenhum serviço atendido.");
	}
	$servicos = $_POST["list_servico_atendido"];

    $atendimento = Session::getInstance()->get("ATENDIMENTO");
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$id_atend = $atendimento->get_id();

	

    DB::getInstance()->set_atendimento_status($id_atend, Atendimento::ATENDIMENTO_ENCERRADO_CODIFICADO);
    DB::getInstance()->encerra_atendimentos($id_atend, $id_uni, $servicos);

    $atendimento->set_status(Atendimento::ATENDIMENTO_ENCERRADO_CODIFICADO);

    $redirecionado = false;
    // redirecionar, se for o caso
    if (!empty($_POST["servico_erro_triagem"]) && !empty($_POST['check_redirecionar'])) {
        $check_redirecionar = $_POST['check_redirecionar'];
        $id_servico_redir = $_POST["servico_erro_triagem"];

        if ($check_redirecionar == "true") {
            
            $num_senha = $atendimento->get_cliente()->get_senha()->get_numero();
            $id_prio = $atendimento->get_cliente()->get_senha()->get_prioridade()->get_id();
            $nm_cliente = $atendimento->get_cliente()->get_nome();
            $ident_cliente = $atendimento->get_cliente()->get_ident();

            // O dt_cheg da nova senha deve ser o momento atual
            DB::getInstance()->erro_triagem($id_uni, $id_servico_redir, $num_senha, $id_prio, 0, Atendimento::SENHA_EMITIDA, $nm_cliente, $ident_cliente, AXL::get_date("Y/m/d H:i:s"));
            $redirecionado = true;
        }
    }

    Session::getInstance()->del('ATENDIMENTO');
    Session::getInstance()->del("redirecionar");

    if ($redirecionado) {
        Template::display_confirm_dialog("Atendimento encerrado e redirecionado.","Sucesso",true);
    }
	else {
        Template::display_confirm_dialog("Atendimento encerrado","Sucesso",true);
    }
    
	AXL::_include("modules/axl/atendimento/atender/index.php");
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
