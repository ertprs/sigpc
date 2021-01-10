<?php



AXL::check_access("axl.configuracao");
/**
 * Reinicia a senha de todas as unidades.
 */
try {
    DB::getInstance()->reiniciar_senhas_global();
}
catch (Exception $e) {
    Template::display_exception($e);
}
?>
