<?php



define("PATH", "../");
require('../lib/environ.php');

$unidades = DB::getInstance()->get_unidades();

foreach ($unidades as $u) {
	echo "{$u->get_id()}#{$u->get_codigo()}#{$u->get_nome()}\n";
}

?>