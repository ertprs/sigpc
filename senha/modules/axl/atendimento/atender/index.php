<?php



AXL::check_login('axl.atendimento');

/**
 * Se nao tiver atendimento aberto retira o proximo da lista
 */

try {

	if (Session::getInstance()->exists('ATENDIMENTO')) {
		$atendimento = Session::getInstance()->get('ATENDIMENTO');
		TAtendimento::display_by_status($atendimento, Session::getInstance()->get(AXL::K_CURRENT_USER));
	}
	else {
		TAtendimento::display_atendimento_chamar();
	}

}
catch (Exception $e) {
	TAtendimento::display_exception($e);
}

?>
