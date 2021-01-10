<?php



@AXL::check_login('axl.monitor');

/**
 * Monta template do monitor
 */
try {
	$ids_stat = array(Atendimento::CHAMADO_PELA_MESA, Atendimento::ATENDIMENTO_INICIADO, Atendimento::ATENDIMENTO_ENCERRADO, Atendimento::NAO_COMPARECEU, Atendimento::ERRO_TRIAGEM, Atendimento::ATENDIMENTO_ENCERRADO_CODIFICADO);
    $id_uni = AXL::get_current_user()->get_unidade()->get_id();
    $ultima = DB::getInstance()->get_ultima_senha($id_uni, $ids_stat);
	if ($ultima == null) {
		$ultima = '- - -';
	}
	echo $ultima;
}
catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>
