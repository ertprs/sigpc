<?php



AXL::check_login('axl.monitor');

/**
 * Monta template do transfere senha
 */

if (empty($_GET['id_atend']) || empty($_GET['senha']) || empty($_GET['servico']) || !isset($_GET['prioridade'])) {
	throw new Exception("Erro transferindo senha.");
}

$id_atend = $_GET['id_atend'];
$senha = $_GET['senha'];
$servico = $_GET['servico'];
$prioridade = $_GET['prioridade'];

TMonitor::display_popup_header("Transferir Senha");
TMonitor::display_transfere_senha($id_atend, $senha, $servico, $prioridade);
TMonitor::display_popup_footer();

?>