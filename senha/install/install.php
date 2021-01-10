<?php



define("PATH", "");

if (Config::AXL_INSTALLED) {
	Template::display_error('O AXL já está instalado.');
}
else {
	TInstall::display_header('AXL Livre');
	
	// prepara instalação
	$step[0] = new InstallStep(0, "Início", false, true, false, true); // install welcome
	$step[1] = new InstallStep(1, "Verificação de Requisitos", true, true, true, true); // install check
	$step[2] = new InstallStep(2, "Licença", true, true, true, false); // license
	$step[3] = new InstallStep(3, "Configurar Banco de Dados", true, true, true, false, 'Install.prevStep();', '', 'Install.carregarDadosDB();'); // DB
    $step[4] = new InstallStep(4, "Configurar Administrador", true, true, true, true, '', 'Install.checkAdmin();'); // Admin
	$step[5] = new InstallStep(5, "Aplicar", true, false, true, false); // Aplicar
	
	Session::getInstance()->setGlobal('AXL_INSTALL', $step);
	
	if (!Session::getInstance()->exists('AXL_INSTALL_STEP')) {
		$current_step = $step[0];
		Session::getInstance()->setGlobal('AXL_INSTALL_STEP', $current_step);
	}
	else {
		$current_step = Session::getInstance()->get('AXL_INSTALL_STEP');
	}
	
	TInstall::display_install_template();
	
	TInstall::display_footer();
        
        
        /*Necessário para passo 4 da instalação*/
        $pgsql = phpversion('pdo_pgsql');
                if (!version_compare($valor, '1.0.2', '>=') && !extension_loaded('pgsql')) {
                    
                    echo '<script>var pgsql=0;</script>';
                    
                } else{ echo '<script>var pgsql=1;</script>';}
             
                // PDO MySQL E MySQL
                $mysql = phpversion('pdo_mysql');
                if (!version_compare($valor, '1.0.2', '>=') && !extension_loaded('mysql')) {
                    
                    echo '<script>var mysql=0;</script>';
                } else{ echo '<script>var mysql=1;</script>';}
                
}
?>