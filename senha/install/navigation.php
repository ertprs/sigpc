<?php



$current_step = Session::getInstance()->get('AXL_INSTALL_STEP');
echo TInstall::display_install_navigation($current_step->has_previous_step(), $current_step->has_next_step(), $current_step->get_previous_enabled(), $current_step->get_next_enabled(), $current_step->get_js_on_prev(), $current_step->get_js_on_next());

?>