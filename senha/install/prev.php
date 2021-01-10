<?php



$current_step = Session::getInstance()->get('AXL_INSTALL_STEP');		
if ($current_step->has_previous_step() && $current_step->get_previous_enabled()) {
	$steps = Session::getInstance()->get('AXL_INSTALL');
	if (isset($steps[$current_step->get_numero() - 1])) {
		Session::getInstance()->setGlobal('AXL_INSTALL_STEP', $steps[$current_step->get_numero() - 1]);
	}
	else {
		throw new Exception('Passo anterior da instalação deveria existir, mas não foi encontrado!');
	}
}
AXL::_include('install/install_content.php');
?>