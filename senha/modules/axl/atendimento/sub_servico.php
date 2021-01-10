<?php



AXL::check_login('axl.atendimento');
/**
 * Exibe uma lista de subserviço.
 */
try {
	
	if(empty($_POST["id_servico"]) ){
		throw new Exception("serviço não especificado");
	}
	$id_servico = $_POST["id_servico"];

	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
    $sub_servicos = DB::getInstance()->get_servicos_sub($id_servico, array(Servico::SERVICO_ATIVO));

    // verifica se existem subserviços
    if ($sub_servicos == null || sizeof($sub_servicos) == 0) {
        // verifica se o serviço realmente existe
        $servico = DB::getInstance()->get_servico($id_servico);
        if ($servico == null) {
            throw new Exception("O serviço selecionado não existe no sistema.");
        }
        else {
            $sub_servicos = array($servico);
        }
    }
	TAtendimento::exibir_sub_servico($sub_servicos);
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>