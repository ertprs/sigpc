<?php



AXL::check_login("axl.configuracao");

try {
	TConfiguracao::display_popup_header('CRIAR UNIDADE');
	$grupos_disponiveis = DB::getInstance()->get_grupos_folha_disponiveis();
	if(count($grupos_disponiveis)>0){
		TConfiguracao::display_nova_unidade();
	}else{
		TConfiguracao::display_error("Não há nenhum grupo disponível para alocar uma nova unidade.","CRIAR NOVA UNIDADE - ATENÇÃO",true,"window.close()");
	}
	TConfiguracao::display_popup_footer();
}
catch (Exception $e) {
	TConfiguracao::display_exception($e);
}
?>