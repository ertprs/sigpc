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

	$rel->setTitulo("Relatório de Senhas por Status");

	$dt_min = explode('/', $_GET['dt_min']);
	$dt_max = explode('/', $_GET['dt_max']);

	$tm_min = mktime(0, 0, 0, $dt_min[1], $dt_min[0], $dt_min[2]);
	$tm_max = mktime(23, 59, 59, $dt_max[1], $dt_max[0], $dt_max[2]);

	$dt_min = date("Y-m-d H:i:s", $tm_min);
	$dt_max = date("Y-m-d H:i:s", $tm_max);

	$rel->setSubTitulo('Período: '.date("d/m/Y", $tm_min)." - ".date("d/m/Y", $tm_max));

    $grupos = $_GET['idGrupo'];

    $est_agregado = $_GET['check_rel_agregado'] == 1;
    $est_unidades = $_GET['check_rel_unidades'] == 1;

    $tmp = DB::getInstance()->get_unidades_by_grupos($grupos);
    $ids_uni = array();
    foreach ($tmp as $u) {
        $ids_uni[] = $u->get_id();
    }

    if ($est_agregado) {
        $tabela = Estatistica::get_qtde_senhas_por_status("Quantidade de Senhas em cada Status - Agregado", $ids_uni, $dt_min, $dt_max);
        $rel->addComponente($tabela);

        $rel->addComponente(Separador::getInstance());
    }

    if ($est_unidades) {
        foreach ($tmp as $u) {
            $tabela = Estatistica::get_qtde_senhas_por_status("Quantidade de Senhas em cada Status - ".$u->get_nome(), array($u->get_id()), $dt_min, $dt_max);
            $rel->addComponente($tabela);

            $rel->addComponente(Separador::getInstance());
        }
    }

	$rel->output();
}
catch (Exception $e) {
	TRelatorios::display_exception($e);
}
?>