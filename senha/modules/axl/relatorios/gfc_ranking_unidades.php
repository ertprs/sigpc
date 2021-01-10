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

	$rel->setTitulo("Ranking das Unidades de Atendimento");

	$dt_min = explode('/', $_GET['dt_min']);
	$dt_max = explode('/', $_GET['dt_max']);

	$tm_min = mktime(0, 0, 0, $dt_min[1], $dt_min[0], $dt_min[2]);
	$tm_max = mktime(23, 59, 59, $dt_max[1], $dt_max[0], $dt_max[2]);

	$dt_min = date("Y-m-d H:i:s", $tm_min);
	$dt_max = date("Y-m-d H:i:s", $tm_max);

	$rel->setSubTitulo('Período: '.date("d/m/Y", $tm_min)." - ".date("d/m/Y", $tm_max));

    $grupos = $_GET['idGrupo'];

    $tmp = DB::getInstance()->get_unidades_by_grupos($grupos);
    $ids_uni = array();
    foreach ($tmp as $u) {
        $ids_uni[] = $u->get_id();
    }

    // Os mesmos dados são usados para os gráficos de Ranking, ordenados de forma distinta em cada gráfico
    $array = DB::getInstance()->get_ranking_unidades($ids_uni, $dt_min, $dt_max);

    $func = array("Graficos", "compara_tme"); // ordenação por TME -> Graficos::compara_tme()
    $graidle = Graficos::get_hb_ranking_unidades($array, $func, "Ranking das Unidades - TME");
    $rel->addComponente($graidle);

    $rel->addComponente(Separador::getInstance());

    $func = array("Graficos", "compara_tmd"); // ordenação por TMD -> Graficos::compara_tmd()
    $graidle = Graficos::get_hb_ranking_unidades($array, $func, "Ranking das Unidades - TMD");
    $rel->addComponente($graidle);

    $rel->addComponente(Separador::getInstance());

    $func = array("Graficos", "compara_tma"); // ordenação por TMA -> Graficos::compara_tma()
    $graidle = Graficos::get_hb_ranking_unidades($array, $func, "Ranking das Unidades - TMA");
    $rel->addComponente($graidle);

    $rel->addComponente(Separador::getInstance());

    $func = array("Graficos", "compara_tmp"); // ordenação por TMP -> Graficos::compara_tmp()
    $graidle = Graficos::get_hb_ranking_unidades($array, $func, "Ranking das Unidades - TMP");
    $rel->addComponente($graidle);
    
    $rel->output();
}
catch (Exception $e) {
    Template::display_exception($e);
}

?>
