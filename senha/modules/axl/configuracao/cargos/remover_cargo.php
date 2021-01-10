<?php



AXL::check_login('axl.configuracao');
/**
 * Remove um cargo e exibe a confirmação de remoção.
 */
try {
    if (empty($_POST['id_cargo'])) {
	    throw new Exception("O cargo a ser removido deve estar selecionado.");
    }
    
    $id_cargo = $_POST['id_cargo'];
    DB::getInstance()->remover_cargo($id_cargo);
    TConfiguracao::display_confirm_dialog("Cargo removido com sucesso.");
}
catch (PDOException $e) {
	if ($e->getCode() >= 23000 && $e->getCode() < 24000) {
		TConfiguracao::display_error('Cargo não removido, pois existem grupos utilizando o cargo especificado para remoção.');
	}
	else {
		TConfiguracao::display_exception($e);
	}
}
catch(Exception $e) {
	TConfiguracao::display_exception($e);
}
?>