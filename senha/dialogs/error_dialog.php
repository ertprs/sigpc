<?php



try {
	if (empty($_REQUEST['message'])) {
		throw new Exception("Erro interno, mensagem de erro n&atilde;o especificada para dialog de erro.");
	}
	
	if (empty($_REQUEST['title'])) {
		$title = 'Erro';
	}
	else {
		$title = $_REQUEST['title'];
	}
	
	$message = $_REQUEST['message'];
	$onClickOk = $_REQUEST['onclickok'];
	
	Template::display_header();
	Template::display_error($message, $title, 0, $onClickOk);
	Template::display_footer();
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>