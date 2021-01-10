<?php



AXL::check_access('axl.relatorios');

try {    
	
}
catch (Exception $e) {
	TRelatorios::display_exception($e);
}

?>