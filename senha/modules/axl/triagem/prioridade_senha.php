<?php



AXL::check_login('axl.triagem');
/**
 * Exibe prioridade de uma senha
 */
try {
//	if (empty($_POST['id_atend'])) {
//		throw new Exception("Erro interno, atendimento não especificado.");
//	}
	
	
	$prioridades = DB::getInstance()->get_prioridades();
	
	if (empty($_POST['id_atend'])) {

		TTriagem::exibir_prioridade_senha($prioridades,'');
	
	}else {
		
		$id_atend = $_POST['id_atend'];
		$atendimento = DB::getInstance()->get_atendimento($id_atend);
		$id_prio = $atendimento->get_cliente()->get_senha()->get_prioridade()->get_id();
	
		
		TTriagem::exibir_prioridade_senha($prioridades, $id_prio);

	}
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
