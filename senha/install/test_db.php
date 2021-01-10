<?php



try {

    $current_step = Session::getInstance()->get('AXL_INSTALL_STEP');
    if ($current_step->get_numero() == 3) {
        if (empty($_POST['db_type'])|| $_POST['db_type']=="default"){
            throw new Exception("O tipo de Banco de Dados deve ser informado.");
        }
        if (empty($_POST['db_host'])) {
            throw new Exception('O endereço do Banco de Dados deve ser informado.');
        }
        if (empty($_POST['db_port'])) {
            throw new Exception('A porta do Banco de Dados deve ser informado.');
        }
        
        if (empty($_POST['db_user'])) {
            throw new Exception('O usuário do Banco de Dados deve ser informado.');
        }
        if (empty($_POST['db_pass'])) {
            throw new Exception('A senha do Banco de Dados deve ser informado.');
        }
        if (empty($_POST['db_name'])) {
            throw new Exception('O Database deve ser informado.');
        }

        //$db['db_type'] = 'pgsql';
        $db['db_type'] = $_POST['db_type'];
        $db['db_host'] = $_POST['db_host'];
        $db['db_port'] = $_POST['db_port'];
        $db['db_name'] = $_POST['db_name'];
        $db['db_user'] = $_POST['db_user'];
        $db['db_pass'] = $_POST['db_pass'];

        Session::getInstance()->set('DATABASE', $db);

        // Abrir conexão
        //$dbh = new PDO($db['db_type'].':host='.$db['db_host'].';port='.$db['db_port'].';dbname='.$db['db_name'], $db['db_user'], $db['db_pass']);

        //Abrir conexao com bando de dados sem informar o nome da base de dados
        $dbh = new PDO($db['db_type'].':host='.$db['db_host'].';port='.$db['db_port'], $db['db_user'], $db['db_pass']);
        
        // Fechar conexão
        $dbh = null;
    
    
        $current_step->set_next_enabled(true);
        echo 'true';
    }
    else {
        Template::display_error('O teste do banco não deveria ter sido chamado nesta etapa da instalação');
    }
}
catch (PDOException $e) {
    Template::display_error('<pre>'.$e->getMessage().'</pre>');
}
catch (Exception $e) {
    Template::display_error($e->getMessage());
}
?>