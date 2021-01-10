<?php



AXL::check_login('axl.configuracao');

/**
 * Exibe a janela para edição de cargos.
 */
try {
	if (empty($_POST['id_cargo'])) {
		throw new Exception("Cargo não especificado.");
	}
	
	$id_cargo = $_POST['id_cargo'];
	$cargo = DB::getInstance()->get_cargo($id_cargo);
	
	// get array permissoes do cargo
	$pcs = DB::getInstance()->get_permissoes_cargo($id_cargo);
	foreach ($pcs as $pc) {
		$cargo ->add_permissao($pc);
	}
	
	TConfiguracao::display_popup_header('EDITAR CARGO');
	TConfiguracao::display_view_cargo($cargo);
	TConfiguracao::display_popup_footer();
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>