<?php



AXL::check_access('axl.relatorios');

try {
	$id_rel = $_GET['id_rel'];

	switch ($id_rel) {
		case 1:
			AXL::_include('modules/axl/relatorios/gfc_ranking_unidades.php');
			break;
        case 2:
			AXL::_include('modules/axl/relatorios/gfc_atendimentos_efetuados.php');
			break;
        case 3:
			AXL::_include('modules/axl/relatorios/gfc_variacao_tms.php');
			break;
	}
}
catch (Exception $e) {
	TRelatorios::display_exception($e);
}
?>