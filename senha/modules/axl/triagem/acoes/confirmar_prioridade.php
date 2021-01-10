<?php



AXL::check_login('axl.triagem');
/**
 * Confirma seleção da prioridade
 */
try {
	Template::display_popup_header('Prioridade');
	$id_servico = $_POST['id_servico'];
	$id_prio = $_POST['id_prio'];
	
	TTriagem::display_confima_prioridade($id_servico,$id_prio);
	Template::display_popup_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
