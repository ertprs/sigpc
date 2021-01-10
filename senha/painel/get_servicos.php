<?php



define("PATH", "../");
require('../lib/environ.php');

if (!isset($_GET['id_uni']) || ((int)$_GET['id_uni'] < 1))
	exit;
	
$servicos = DB::getInstance()->get_servicos_unidade((int) $_GET['id_uni'], array(1));

foreach ($servicos as $s) {
	echo "{$s->get_id()}#{$s->get_sigla()}#{$s->get_nome()}\n";
}

?>