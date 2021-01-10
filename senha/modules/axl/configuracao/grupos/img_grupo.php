<?php



AXL::check_login('axl.configuracao');

header("Content-Type: image/png");

// evitar cache da imagem (causa problemas com os adicionados)
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$arvGrupo = new GDRenderer(30, 10, 30);

if (empty($_GET['id_grupo'])) {
	
	$arvGrupo->add(1,0, 'Nenhum grupo selecionado', '');
	
	$arvGrupo->setNodeTitleColor(array(255, 64, 64));
	$arvGrupo->setNodeMessageColor(array(255, 64, 64));
}
else {
	
	$id_grupo = $_GET['id_grupo'];
	
	$grupo = DB::getInstance()->get_grupo_by_id($id_grupo);
	
	$grupos_filhos = DB::getInstance()->get_grupos_filhos_imediatos($id_grupo);
	
	$arvGrupo->add(1,0, iconv('utf-8' ,'iso-8859-1', ' '.$grupo->get_nome()), '');
	$i = 2;
	foreach ($grupos_filhos as $gf) {
		$arvGrupo->add($i++, 1,iconv('utf-8' ,'iso-8859-1', ' '.$gf->get_nome()), '');
	}
	
	$arvGrupo->setNodeTitleColor(array(0xCC, 0xCC, 0xCC));
	$arvGrupo->setNodeMessageColor(array(0xCC, 0xCC, 0xCC));
}



$arvGrupo->setBGColor(array(255, 255, 255));
;
$arvGrupo->setLinkColor(array(0, 64, 128));
//$arvGrupo->setNodeLinks(GDRenderer::LINK_BEZIER);
$arvGrupo->setNodeBorder(array(0, 0, 0), 2);

$arvGrupo->stream();
?>