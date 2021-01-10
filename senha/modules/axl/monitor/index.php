<?php



AXL::check_access('axl.monitor');

/**
 * Monta template do monitor
 */

try {
	
	# verifica se o modulo esta devidamente instalado
	Session::getInstance()->get(AXL::K_CURRENT_MODULE)->verifica();
	
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	TMonitor::display_header("Monitor");
	
	// pega o menu do monitor e os servicos da unidade
	$menus = DB::getInstance()->get_menu(Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_chave());
	$servicos = DB::getInstance()->get_servicos_unidade($id_uni, array(1));
	
	// guarda o objeto monitor na sessao
	$monitor = new Monitor($menus, $servicos, DB::getInstance()->get_total_fila($id_uni));
	Session::getInstance()->set('MONITOR', $monitor);
	
	$pagina = (Session::getInstance()->exists('MONITOR_PAGINA'))?Session::getInstance()->get('MONITOR_PAGINA'):0;
    Session::getInstance()->set('MONITOR_PAGINA', $pagina);

	TMonitor::display_monitor(Session::getInstance()->get('MONITOR'));
	TMonitor::display_footer();	

} catch (Exception $e) {
	Template::display_exception($e);
}


?>
