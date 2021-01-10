<?php



AXL::check_login("axl.triagem");
/**
 * Imprime ultima
 * @var unknown_type
 */
$unidade = AXL::get_current_user()->get_unidade();
$senha = DB::getInstance()->get_ultima_senha($unidade->get_id());
TTriagem::imprime($senha, $unidade);

?>