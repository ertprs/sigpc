<?php



AXL::check_login('axl.triagem');

/**
 * distribui senhas da triagem
 */
 
try {
	if (empty($_POST['id_servico']) || empty($_POST['id_prio'])) {
		throw new Exception("Serviço ou prioridade não especificado.");
	}
	
	if (Session::getInstance()->exists('TRIAGEM')) {
		
		$usuario = Session::getInstance()->get(AXL::K_CURRENT_USER);
		$id_usuario = $usuario->get_id();
		$id_unidade = $usuario->get_unidade()->get_id();
			
		$id_servico = $_POST['id_servico'];
		$id_prio = $_POST['id_prio'];
		$nm_cliente = $_POST['client_name'];
		$ident_cliente = $_POST['client_ident'];

        $senha_distribuida = false;
        $falhas_counter = 0;
        for ($i = 0; $i < 5 && !$senha_distribuida; $i++) {
            try {
                $senha = DB::getInstance()->distribui_senha($id_unidade, $id_servico, $id_prio, 0, Atendimento::SENHA_EMITIDA, $nm_cliente, $ident_cliente, AXL::get_date("Y-m-d H:i:s"));
                $senha_distribuida = true;
            }
            catch (PDOException $e) {
                // Essa exception pode ocorrer tanto por um erro no SQL
                // como pela proteção de concorrencia.

                // incrementa
                $falhas_counter++;

                if ($falhas_counter >= 5) {
                    // limite de erros atingido, joga a exceção pra frente.
                    throw $e;
                }
                
                // aguarda 1 segundo após falha
                sleep(1);
            }
        }
		
		Session::getInstance()->set("ultima_senha", $senha);
	}
	else {
	    throw new Exception("Erro de sessão na triagem.");
	}
}
catch(Exception $e) {
	TTriagem::display_exception($e);
}

?>