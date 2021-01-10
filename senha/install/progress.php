<?php



$size = sizeof(Session::getInstance()->get('AXL_INSTALL'));
$current_step = Session::getInstance()->get('AXL_INSTALL_STEP');

TInstall::display_install_progress($current_step, $size);
?>