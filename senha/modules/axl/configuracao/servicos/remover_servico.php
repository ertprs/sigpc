<?php



AXL::check_login('axl.configuracao');

try {
    if (empty($_POST['id_serv'])) {
	    throw new Exception("Selecione o serviço.");
    }
    $id_serv = $_POST['id_serv'];
    
    DB::getInstance()->remover_servico($id_serv);
    TConfiguracao::display_confirm_dialog("Serviço removido com sucesso.");
}
catch (PDOException $e) {
	// erros de Violação de Restrição
	if ($e->getCode() >= 23000 && $e->getCode() <= 23999) {
		TConfiguracao::display_error("Este serviço não pode ser removido pois existem registros no banco de dados que fazem referência ao mesmo.");
	}
	else {
		TConfiguracao::display_exception($e);
	}
}
catch (Exception $e) {
	TConfiguracao::display_exception($e);
}
?>