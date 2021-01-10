<?php



$current_step = Session::getInstance()->get('AXL_INSTALL_STEP');

call_user_func(array('TInstall', 'display_install_step_'.$current_step->get_numero()));
?>