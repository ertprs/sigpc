<?php



AXL::check_access("axl.usuarios");
/**
 * Exibe um jump menu com os serviços disponiveis de uma unidade
 */
try {
    if (empty($_POST['id_uni'])) {
        throw new Exception("Unidade não especificada.");
    }
    if (empty($_POST['id_usu'])) {
        throw new Exception("Usuário não especificado.");
    }

    // TODO verificar se o usuario tem permissao
    $id_uni = $_POST['id_uni'];
    $id_usu = $_POST['id_usu'];
    
    TUsuarios::display_user_serv_list($id_usu, $id_uni, 'select_servicos_atendidos', $disabled);
}
catch (Exception $e) {
    Template::display_exception($e);
}
?>
