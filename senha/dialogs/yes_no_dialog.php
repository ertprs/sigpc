<?php



try {
	if (empty($_REQUEST['message']) || empty($_REQUEST['onclickok'])) {
		throw new Exception("Erro interno, mensagem ou evento onclick n&atilde;o especificado para dialog de confirma&ccedil;&atilde;o.");
	}
	
	if (empty($_REQUEST['title'])) {
		$title = 'Confirma&ccedil;&atilde;o';
	}
	else {
		$title = $_REQUEST['title'];
	}
	
	$message = $_REQUEST['message'];
	$onclickok = $_REQUEST['onclickok'];
	$onclickcancel = $_REQUEST['onclickcancel'];
	
	Template::display_yes_no_dialog($message, $title, "window.closePopup(this);".$onclickok,false, $onclickcancel);
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>