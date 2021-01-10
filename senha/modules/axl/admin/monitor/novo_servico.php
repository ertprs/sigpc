<?php



AXL::check_login('axl.admin');
/**
 * Exibe a janela para a criação de um novo serviço
 */
try {
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	
	$tmp = array();	
	
	$id_serv = $_POST["id_serv"];
	$nome_serv= '';
	$status_serv = 0;
	$sigla_serv= '';
	if(empty($id_serv) ){
		$servicos = DB::getInstance()->get_servicos_macro_nao_cadastrados_uni($id_uni);
		foreach ($servicos as $s) {
			$tmp[$s[0]] = $s[3]; 
		}	
	}else{
		$nome_serv= $_POST["nome_serv"];
		if(empty($nome_serv) ){
			throw new Exception("Nome não especificado.");
		}
		$sigla_serv= $_POST["sigla_serv"];
		if(empty($sigla_serv) ){
			throw new Exception("Sigla não especificada.");
		}
		$status_serv = $_POST["status_serv"];
		if(empty($status_serv) ){
			$status_serv= 0;
		}
		$tmp[$id_serv] = $nome_serv;
		
	}
	Template::display_popup_header((empty($id_serv)? "Novo Serviço" : "Alterar Serviço"));
	TAdmin::exibir_novo_servico($tmp,$id_serv,$nome_serv,$sigla_serv,$status_serv);
	Template::display_popup_footer();	
	
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
