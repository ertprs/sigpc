<?php



AXL::check_login('axl.configuracao');

try {
    if (empty($_POST['id_macro'])) {
	    throw new Exception("macrosserviço não especificado.");
    }
    
    $id_macro = $_POST['id_macro'];
    
    TConfiguracao::display_sub_serv_content($id_macro);
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>