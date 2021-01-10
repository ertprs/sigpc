<?php



AXL::check_access('axl.relatorios');

try {   
	$id_rel = $_GET['id_rel'];
	
	switch ($id_rel) {
		case 1:
			AXL::_include('modules/axl/relatorios/est_serv_mestre.php');
			break;
		case 2:
			AXL::_include('modules/axl/relatorios/est_serv_codif.php');
			break;
        case 3:
			AXL::_include('modules/axl/relatorios/est_atendentes.php');
			break;
        case 4:
			AXL::_include('modules/axl/relatorios/est_tempos_medios.php');
			break;
	}
}
catch (Exception $e) {
	TRelatorios::display_exception($e);
}
?>