<?php



@AXL::check_login('axl.atendimento');

/**
 * Encerra e redireciona o atendimento
 */

try {
    $atendimento = Session::getInstance()->get('ATENDIMENTO');
    
    if (!empty($_GET['redirecionar'])) {
        $redirecionar = $_GET['redirecionar'];
        if ($redirecionar == "true") {
            Session::getInstance()->set("redirecionar", true);
        }
        else {
            Session::getInstance()->del("redirecionar");
        }
    }
    else {
        throw new Exception("Váriavel 'redirecionar' era esperada nos parametros GET");
    }

    if ($atendimento->get_status() == Atendimento::ATENDIMENTO_INICIADO) {
        $atendimento->set_status(Atendimento::ATENDIMENTO_ENCERRADO);
        DB::getInstance()->set_atendimento_status($atendimento->get_id(), Atendimento::ATENDIMENTO_ENCERRADO);
    }
    
    AXL::_include("modules/axl/atendimento/atender/index.php");
}
catch(Exception $e) {
	TAtendimento::display_exception($e);
}

?>
