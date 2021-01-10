<?php



AXL::check_login('axl.triagem');
/**
 * Exibe conteudo do atendimento de uma senha
 */

try {
	if(!isset ($_POST["num_senha"]) ){
		throw new Exception("Senha não especificada");
	}
	$num_senha = $_POST["num_senha"];
	
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$atendimento = DB::getInstance()->get_atendimento_por_senha($num_senha, $id_uni);
	if($atendimento == false){
		echo "Senha não encontrada.";
	}else{
		echo TTriagem::exibir_atendimento($atendimento, $id_uni);
	}
	
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
