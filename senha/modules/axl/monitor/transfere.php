<?php



@AXL::check_login('axl.monitor');
/**
 * Transfere uma senha para outro serviço
 */

try {

    if (empty($_POST['id_atend']) || empty($_POST['novo_servico']))
	    throw new Exception("Erro ao tentar transferir senha.");

    $id_atend 		= $_POST['id_atend'];
    $servico 	= $_POST['novo_servico'];
    $prioridade = (isset($_POST['prioridade']))?$_POST['prioridade']:1;
    DB::getInstance()->transfere_senha($id_atend, $servico, $prioridade);

} catch(Exception $e) {
	TMonitor::display_exception($e);
}


?>
