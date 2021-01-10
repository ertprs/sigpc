<?php



AXL::check_access('axl.inicio');

try {
    $unidade = AXL::get_current_user()->get_unidade();
    if ($unidade != null)
    {
        TInicio::display_unidade_modulos($unidade);
    }
    else {
        AXL::force_unidade();
    }
}
catch (Exception $e) {
    Template::display_exception($e);
}

?>
