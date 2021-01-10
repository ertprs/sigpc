<?php



AXL::check_login('axl.triagem');
/**
 * Monta interface de reativar senha
 */
try {
	
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$servicos = DB::getInstance()->get_servicos_unidade_reativar(Servico::SERVICO_ATIVO,$id_uni);
	Template::display_popup_header("REATIVAR SENHA");
	TTriagem::exibir_reativar_senha($servicos);
	Template::display_popup_footer();	
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
