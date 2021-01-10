<?php



@AXL::check_login('axl.triagem');

/**
 * Atualiza conteudo da triagem
 */
try {
	$serv = DB::getInstance()->get_servicos_unidade(AXL::get_current_user()->get_unidade()->get_id(), array(1));
	TTriagem::servicos($serv);

} catch(Exception $e) {
	TTriagem::display_exception($e);
}


?>
