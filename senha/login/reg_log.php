<?php



define('MODULO', 'LOGIN');
try {

    $erro = 0;
    Session::getInstance()->set(AXL::K_LOGIN_ERROR, null);

    $messages = array(
        'Usu&aacute;rio Inv&aacute;lido. Por favor, tente novamente.',
        'M&oacute;dulo Inv&aacute;lido. Por favor, entre em contato com o administrador do sistema.',
        'Senha Inv&aacute;lida. Por favor, tente novamente.',
        'Acesso Negado ao M&oacute;dulo. Por favor, entre em contato com seu gerente.',
        'Usu&aacute;rio desativado. Por favor, entre em contato com seu gerente'     
    );
	
    if (!empty($_POST['user']) && !empty($_POST['pass'])) {
		
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		if (Session::getInstance()->exists(AXL::K_CURRENT_MODULE)) {
			$mod = Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_chave();

			$erro = Login::has_acesso($user, $pass, $mod);
			//
			if ($erro == -1) {
				define('MODULO', $mod);
				$usuario = DB::getInstance()->get_usuario($user);
				
			    Session::getInstance()->setGlobal(AXL::K_CURRENT_USER, $usuario);
			    DB::getInstance()->salvar_session_id($usuario->get_id());
                DB::getInstance()->set_session_status($usuario->get_id(), Session::SESSION_ATIVA);
                
                header("Location:./?mod=$mod");
			}
            else {
			    Session::getInstance()->set(AXL::K_LOGIN_ERROR, $messages[$erro-1]);
			    header("Location:./?" . AXL::K_NEED_LOGIN);
			}			
		} else {
	        Session::getInstance()->set(AXL::K_LOGIN_ERROR, "Nenhum m&oacute;dulo carregado.");
		    header("Location:./?" . AXL::K_NEED_LOGIN);
		}
    } else {
        header("Location:./?" . AXL::K_NEED_LOGIN);
    }


} catch (Exception $e) {
	Template::display_exception($e);
}


?>
