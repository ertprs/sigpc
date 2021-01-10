<?php



/**
 *	Destroi a sessao do usuario
 */
Session::getInstance()->destroy();
header('Location:./');

?>