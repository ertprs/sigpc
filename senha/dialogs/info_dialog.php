<?php



try {
	if (empty($_REQUEST['message'])) {
		throw new Exception("Erro interno, mensagem de informação n&atilde;o especificada para info_dialog.");
	}

	if (empty($_REQUEST['title'])) {
		$title = 'Informação';
	}
	else {
		$title = $_REQUEST['title'];
	}

	$message = $_REQUEST['message'];
	$onClickOk = $_REQUEST['onclickok'];

    Template::display_confirm_dialog($message, $title, $onClickOk);
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
