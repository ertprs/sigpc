<?php



/**
 * Reinicia as senha da unidade em uso.
 */
AXL::check_access("axl.admin");
try {
    $unidade = AXL::get_current_user()->get_unidade();
    DB::getInstance()->reiniciar_senhas_unidade($unidade->get_id());
}
catch (Exception $e) {
    Template::display_exception($e);
}
?>
