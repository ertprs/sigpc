<?php



AXL::check_login('axl.usuarios');
/**
 * 
 * Monta interface da popup dos serviços por unidade que o usuario editado ainda não tem acesso
 */
try {
    $id_uni = $_POST['id_uni'];
    if (empty($id_uni)) {
		throw new Exception("Unidade não especificada.");
	}
    
	$id_servicos = $_POST["id_servicos"];
	if (sizeof($id_servicos) == 0) {
		$id_servicos[0] = null;
	}
    
    Template::display_popup_header("ADICIONAR SERVIÇO");
    TUsuarios::display_new_serv_user($id_servicos, $id_uni);
    Template::display_popup_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>