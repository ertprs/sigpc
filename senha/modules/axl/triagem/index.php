<?php



AXL::check_access('axl.triagem');
/**
 * Monta template da Triagem
 */
try{
	 # verifica se o modulo esta devidamente instalado   
    Session::getInstance()->get(AXL::K_CURRENT_MODULE)->verifica();

	if(!Session::getInstance()->exists("TRIAGEM")){
        $triagem = new Triagem(Session::getInstance()->get(AXL::K_CURRENT_USER),DB::getInstance()->get_servicos_mestre_unidade(1, array(Servico::SERVICO_ATIVO)));
		Session::getInstance()->set('TRIAGEM',$triagem);
	}
    TTriagem::display_header("Triagem");
    TTriagem::display_triagem(Session::getInstance()->get(AXL::K_CURRENT_USER));

} catch (Exception $e) {
	Template::display_exception($e);
}

?>