<?php



AXL::check_access("axl.configuracao");

$unidade = AXL::get_current_user()->get_unidade();
//Template::display_popup_header();
TConfiguracao::config_msg($unidade);
//Template::display_popup_footer();
?>