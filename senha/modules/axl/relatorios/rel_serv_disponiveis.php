<?php



AXL::check_access('axl.relatorios');
try {
	$formato = $_GET['formato'];
	if ($formato == "pdf") {
		$rel = new RelatorioPDF();
	}
	else {
		$rel = new RelatorioHTML();
	}
	
	$rel->setTitulo("Relatório dos Serviços Disponíveis - Global");
	
	$dt_min = explode('/', $_GET['dt_min']);
	$dt_max = explode('/', $_GET['dt_max']);
	
	$tm_min = mktime(0, 0, 0, $dt_min[1], $dt_min[0], $dt_min[2]);
	$tm_max = mktime(23, 59, 59, $dt_max[1], $dt_max[0], $dt_max[2]);

	$rel->setSubTitulo('Período: '.date("d/m/Y", $tm_min)." - ".date("d/m/Y", $tm_max));

    $grupos = $_GET['idGrupo'];
    
    $serv_mestre = DB::getInstance()->get_servicos_mestre();
    
    foreach ($serv_mestre as $s){
    	$tabela = Estatistica::get_serv_disponiveis($s);
   		$rel->addComponente($tabela);
   		$rel->addComponente(Separador::getInstance());
    }
	
    $rel->output();

}
catch (Exception $e){
	Template::display_exception($e);
}

?>