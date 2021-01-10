<?php



AXL::check_login('axl.admin');
/**
 * Adiciona um serviço para um usuario
 */
try {
	$id_usu = $_POST["id_usu"];
	if(empty($id_usu) ){
		throw new Exception("Usuário não especificado.");
	}
	$id_serv= $_POST["id_serv"];
	if(empty($id_serv) ){
		throw new Exception("Serviço não especificado.");
	}
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	foreach($id_serv as $id){
		DB::getInstance()->adicionar_servico_usu($id_uni,$id,$id_usu);		
	}
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>