<?php



AXL::check_access('axl.relatorios');

try {   
	$id_rel = $_GET['id_rel'];
	
	switch ($id_rel) {
		case 1:
			AXL::_include('modules/axl/relatorios/rel_serv_disponiveis.php');
			break;
		case 2:
			AXL::_include('modules/axl/relatorios/rel_serv_disponiveis_uni.php');
			break;
		case 3:
			AXL::_include('modules/axl/relatorios/rel_senhas_encerradas.php');
			break;
		case 4:
			AXL::_include('modules/axl/relatorios/rel_temp_atendimento.php');
			break;
        case 5:
            AXL::_include('modules/axl/relatorios/rel_senhas_por_status.php');
			break;
	}
}
catch (Exception $e) {
	TRelatorios::display_exception($e);
}
?>