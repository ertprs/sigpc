<?php



try {
    $current_step = Session::getInstance()->get('AXL_INSTALL_STEP');

    if ($current_step->get_numero() != 4) {
        throw new Exception("Etapa da instalação inconsistente com este script.");
    }

    if (empty($_POST['login_usu']) || empty($_POST['nm_usu']) || empty($_POST['ult_nm_usu']) || empty($_POST['senha_usu']) || empty($_POST['senha_usu_2'])) {
        throw new Exception("Preencha todos os campos corretamente.");
    }

    $adm['login_usu'] = $_POST['login_usu'];
    $adm['nm_usu'] = $_POST['nm_usu'];
    $adm['ult_nm_usu'] = $_POST['ult_nm_usu'];
    $adm['senha_usu'] = $_POST['senha_usu'];

    if (strlen($adm['login_usu']) < 5) {
        throw new Exception('O login deve possuir 5 ou mais letras/números.');
    }
    if (!ctype_alnum($adm['login_usu'])) {
        throw new Exception('O login deve conter somente letras e números.');
    }
    if (!ctype_alnum($adm['senha_usu'])) {
        throw new Exception('O login deve conter somente letras e números.');
    }
    if (strlen($adm['senha_usu']) < 6) {
        throw new Exception('A senha deve possuir 6 ou mais letras/números.');
    }
    if ($_POST['senha_usu'] != $_POST['senha_usu_2']) {
        throw new Exception('A senha não confere com a confirmação de senha.');
    }
    

    Session::getInstance()->set('INSTALL_ADMIN', $adm);
    echo 'true';
}
catch (Exception $e) {
    Template::display_error($e->getMessage());
}
?>
