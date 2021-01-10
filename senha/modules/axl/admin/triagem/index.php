<?php



AXL::check_access("axl.admin");

$unidade = AXL::get_current_user()->get_unidade();
TAdmin::config_msg($unidade);
?>