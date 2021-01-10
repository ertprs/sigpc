<?php



$accepted = $_POST['accepted'] == "true";

$current_step = Session::getInstance()->get('AXL_INSTALL_STEP');

if ($current_step->get_numero() == 2) {
	$current_step->set_next_enabled($accepted);
}

AXL::_include('install/navigation.php');

?>