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
	
	$rel->setTitulo("Relatório dos Serviços Disponíveis - Unidade");
	
	$dt_min = explode('/', $_GET['dt_min']);
	$dt_max = explode('/', $_GET['dt_max']);
	
	$tm_min = mktime(0, 0, 0, $dt_min[1], $dt_min[0], $dt_min[2]);
	$tm_max = mktime(23, 59, 59, $dt_max[1], $dt_max[0], $dt_max[2]);
	
	$dt_min = date("Y-m-d H:i:s", $tm_min);
	$dt_max = date("Y-m-d H:i:s", $tm_max);
	
	$rel->setSubTitulo('Período: '.date("d/m/Y", $tm_min)." - ".date("d/m/Y", $tm_max));

    $grupos = $_GET['idGrupo'];
    
    $tmp = DB::getInstance()->get_unidades_by_grupos($grupos);
    $unidades = array();
    foreach ($tmp as $u) {
        $unidades[] = $u;
    }
    
    foreach($unidades as $u){
		$tabela = Estatistica::get_serv_disponiveis_uni($u);
	    $rel->addComponente($tabela);
	    $rel->addComponente(Separador::getInstance());
    }
    $rel->output();
    

}
catch (Exception $e){
	Template::display_exception($e);
}

?>