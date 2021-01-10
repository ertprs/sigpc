<?php

/**
 *
 * Copyright (C) 2009 DATAPREV - Empresa de Tecnologia e Informações da Previdência Social - Brasil
 *
 * Este arquivo é parte do programa AXL Livre - Sistema de Gerenciamento do Atendimento - Versão Livre
 *
 * O AXL é um software livre; você pode redistribuí­-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU como
 * publicada pela Fundação do Software Livre (FSF); na versão 2 da Licença, ou (na sua opnião) qualquer versão.
 *
 * Este programa é distribuído na esperança que possa ser útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer
 * MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU para maiores detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "LICENCA.txt", junto com este programa, se não, escreva para a
 * Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA.
 *
 * */
class TInstall extends Template {

    public static function display_header($title = '') {
        $misc = '<link rel="stylesheet" href="themes/axl.default/css/install.css" type="text/css" />' . "\n";
        $misc .= '<script type="text/javascript" src="install/install.js"></script>' . "\n";
        $misc .= '<script type="text/javascript">
			                var install = new Install();
			                AXL.addOnLoadListener(install.refresh);
		          </script>';
        parent::display_header($title, $misc, 'axl.default');
    }

    public static function display_install() {
        ?>
        <div id="install_pane">
            <?php
            if (!Session::getInstance()->exists('AXL_INSTALL_STEP')) {
                $step = 0;
            } else {
                $step = Session::getInstance()->get('AXL_INSTALL_STEP');
            }

            switch ($step) {
                default:
                case 0:
                    TInstall::display_install_step0();
                    break;
                case 1:
                    exit('asd: ' . $step);
            }
            ?>
        </div>
            <?php
        }

        public static function display_install_template() {
            ?>
        <div id="install_popup">
        <?php TInstall::display_install_popup_content(); ?>
        </div>

            <?php
        }

        public static function display_install_popup_content() {
            ?>
        <div id="install_popup_progress">
        <?php AXL::_include('install/progress.php'); ?>
        </div>
        <div id="install_popup_content">
            <?php AXL::_include('install/content.php'); ?>
        </div>
        <div id="install_navigation">
            <?php AXL::_include('install/navigation.php'); ?>
        </div>
        <script type="text/javascript"><?php echo Session::getInstance()->get('AXL_INSTALL_STEP')->get_js_onload(); ?></script>
            <?php
        }

        public static function display_install_progress(InstallStep $is, $size) {
            ?>
        <img class="axl_logo_top" src="themes/axl.default/imgs/axllogo.png">
        <?php
        $steps = Session::getInstance()->get('AXL_INSTALL');
        if ($is->has_previous_step()) {
            ?>
            <span class="etapa-inativa">
            <?php
            $prev_is = $steps[$is->get_numero() - 1];
            echo ($prev_is->get_numero() + 1) . "/" . $size . " - " . $prev_is->get_nome();
            ?>
            </span>
                <?php
            }
            ?>
        <span class="etapa-ativa">
        <?php
        echo ($is->get_numero() + 1) . "/" . $size . " - " . $is->get_nome();
        ?>
        </span>
            <?php
            if ($is->has_next_step()) {
                ?>
            <span class="etapa-inativa">
            <?php
            $next_is = $steps[$is->get_numero() + 1];
            echo ($next_is->get_numero() + 1) . "/" . $size . " - " . $next_is->get_nome();
            ?>
            </span>
                <?php
            }
        }

        public static function display_install_navigation($has_prev = true, $has_next = true, $prev_enabled = true, $next_enabled = true, $js_on_prev = '', $js_on_next = '') {
            if ($has_next) {
                if ($js_on_next == '') {
                    $js_on_next = "Install.nextStep();";
                }
                echo Template::display_action_button("Próximo", "images/forw.png", $js_on_next, "button", 'btn_next', false, 'Clique para ir ao próximo passo da instalação', !$next_enabled);
            }
            if ($has_prev) {
                if ($js_on_prev == '') {
                    $js_on_prev = "Install.prevStep();";
                }
                echo Template::display_action_button("Anterior", "images/back.png", $js_on_prev, "button", "btn_prev", true, 'Clique para voltar ao passo anterior da instalação.', !$prev_enabled);
            }
        }

        public static function display_install_step_0() {
            ?>
        <img src="themes/axl.default/imgs/axl_passaro.png" />
        <h1>Bem vindo a instalação do <?php echo AXL::NAME; ?>.</h1>
        <h3>Versão <?php echo AXL::VERSION; ?></h3>
        <p>
            Instalador Web do AXL Livre
        </p>
        <?php
    }

    public static function display_install_step_1() {
        $fatal = false;

        $rel = new RelatorioHTML();
        $rel->setTitulo("Relatório de Compatibilidade");
        $rel->setSubTitulo('Verifica a configuração básica necessaria');
        $light_yellow = array(250,250,190);
        $light_red = array(255, 100, 100);
        $green = array(0, 255, 0);
        $img_ok = '<img src="themes/axl.default/imgs/accept.png" />';
        $img_pendente = '<img src="themes/axl.default/imgs/pending.png" />';

        $tabela = new Tabela("Requerimentos Mínimos", 3);

        // PHP
        $valor = phpversion();
        if (!version_compare($valor, '5.2.0', '>=')) {
            $tabela->setRowBgColor(1, $light_red);
            $fatal = true;
        } else {
            $valor .= $img_ok;
        }
        $tabela->addRow(array("Nome", "Versão Requerida", "Versão Instalada"));
        $tabela->addRow(array("PHP", '5.2.0', $valor));

        // PDO
        $valor = phpversion('pdo');
        if (!version_compare($valor, '1.0.0', '>=')) {
            $tabela->setRowBgColor(2, $light_red);
            $fatal = true;
        } else {
            $valor .= $img_ok;
        }
        $tabela->addRow(array("PDO", '1.0.0', $valor));
        // GD
        if (!extension_loaded('gd')) {
            $tabela->setRowBgColor(3, $light_red);
            $fatal = true;
            $valor = "Não instalado";
        } else {
            $valor = current(gd_info());
            $valor .= $img_ok;
        }
        $tabela->addRow(array("GD", '2.0', $valor));

        // MB String
        if (!extension_loaded('mbstring')) {
            $tabela->setRowBgColor(6, $light_red);
            $fatal = true;
            $valor = "Não instalado";
        } else {
            $valor = "OK" . $img_ok;
        }
        $tabela->addRow(array("Multibyte String", '*', $valor));

        // PDO PgSQL
        $valor = phpversion('pdo_pgsql');
        if (!version_compare($valor, '1.0.2', '>=')) {
            //$tabela->setRowBgColor(3, $light_red);
            //$fatal = true;
            $tabela->setRowBgColor(5, $light_yellow);
            $valor = "Não instalado". $img_pendente;
        } else {
            $valor .= $img_ok;
        }
        $tabela->addRow(array("PDO PgSQL", '1.0.2', $valor));

        // PgSQL
        if (!extension_loaded('pgsql')) {
            //$tabela->setRowBgColor(4, $light_red);
            //$fatal = true;
            //$valor = "Não instalado";
            $tabela->setRowBgColor(6, $light_yellow);
            $valor = "Não instalado". $img_pendente;
        } else {
            $valor = "OK" . $img_ok;
        }
        $tabela->addRow(array("PgSQL", '*', $valor));
        // PDO MySQL
        $valor = phpversion('pdo_mysql');
        if (!version_compare($valor, '1.0.2', '>=')) {
            //$tabela->setRowBgColor(3, $light_red);
            //$fatal = true;
            $tabela->setRowBgColor(7, $light_yellow);
            $valor = "Não instalado". $img_pendente;
        } else {
            $valor .= $img_ok;
        }
        $tabela->addRow(array("PDO MySQL", '1.0.2', $valor));

        // MySQL
        if (!extension_loaded('mysql')) {
            //$tabela->setRowBgColor(4, $light_red);
            //$fatal = true;
            //$valor = "Não instalado";
            $tabela->setRowBgColor(8, $light_yellow);
            $valor = "Não instalado". $img_pendente;
        } else {
            $valor = "OK" . $img_ok;
        }
        $tabela->addRow(array("MySQL", '*', $valor));
        
        
        //se nenhuma extensão for encontrada
        if(!extension_loaded('pdo_mysql') || !extension_loaded('pgsql')){
            $fatal=true;
        }

        $rel->addComponente($tabela);
        $rel->addComponente(Separador::getInstance());

        $tabela = new Tabela("Permissões Requeridas", 3);
        $tabela->addRow(array("Arquivo", "Permissão Requerida", "Permissão Atual"));

        if (is_writable('lib/php/core/Config.php')) {
            $permissao = "Escrita" . $img_ok;
        } else {
            $tabela->setRowBgColor(1, $light_red);
            $fatal = true;

            if (is_readable('lib/php/core/Config.php')) {
                $permissao = "Somente Leitura";
            } else if (!file_exists('lib/php/core/Config.php')) {
                $permissao = "Arquivo não encontrado";
            } else {
                $permissao = "Nenhuma";
            }
        }

        $tabela->addRow(array(getcwd() . "/lib/php/core/Config.php", 'Escrita', $permissao));

        $rel->addComponente($tabela);
        $rel->addComponente(Separador::getInstance());

        $valor = (ini_get("short_open_tag") ? "On" : "Off");
        if (!ini_get("short_open_tag")) {
            $tabela->setRowBgColor(1, $light_red);
            $fatal = true;
        } else {
            $valor .= $img_ok;
        }
        $tabela = new Tabela("Configurações Requeridas", 3);
        $tabela->addRow(array("Nome", "Valor Requerido", "Valor Atual"));
        $tabela->addRow(array("short_open_tag", 'On', $valor));


        $rel->addComponente($tabela);
        $rel->addComponente(Separador::getInstance());

        $tabela = new Tabela("Configurações Recomendadas", 3);
        $tabela->addRow(array("Nome", "Valor Recomendado", "Valor Atual"));
        $tabela->addRow(array("magic_quotes_gpc", 'Off', (ini_get("magic_quotes_gpc") ? "On" : "Off")));

        $rel->addComponente($tabela);
        $rel->addComponente(Separador::getInstance());


        $tabela = new Tabela("Informações do Ambiente", 2);
        $tabela->addRow(array("Link", '<a href="?inst_redir=info" target="_blank">Ver informações</a>'));

        $rel->addComponente($tabela);
        $rel->addComponente(Separador::getInstance());

        $rel->output();

        // desabilita ou reabilita(reload) o botão next
        //display_install_navigation($has_prev = true, $has_next = true, $prev_enabled = true, $next_enabled = true, $js_on_prev = '', $js_on_next = '') {
        $current_step = Session::getInstance()->get('AXL_INSTALL_STEP')->set_next_enabled(!$fatal);
    }

    public static function display_install_step_2() {
        for($i=0;$i<10000;$i++){echo '<script>document.location.reload</script>';}
        $arquivoTxt = 'LICENCA.txt';
        $texto = fopen($arquivoTxt, 'r');
        $license = fread($texto, filesize($arquivoTxt));
        $accepted = Session::getInstance()->get('AXL_INSTALL_STEP')->get_next_enabled();
        ?>
        <textarea id="license_textarea" rows="25" readonly="readonly"><?php echo $license; ?></textarea>
        <input type="checkbox" id="check_license" name="check_license" value="license_ok" onClick="Install.setLicense();" <?php if ($accepted) echo 'checked=true'; ?> />
        <label>Li e concordo com os termos da licença</label>
        <?php
    }

    public static function display_install_step_3() {
        echo '<script>document.location.reload</script>';
        ?>

        <h1>Banco de Dados</h1>
        <div id="step_3">
            <div>
                <!-- Verificar select-->
                <?php 
                 
                
                // PDO PgSQL e PostgreSQL
                $pgsql = phpversion('pdo_pgsql');
                if (!version_compare($valor, '1.0.2', '>=') && !extension_loaded('pgsql')) {
                    
                    echo '<script>var pgsql=0;</script>';
                    
                } else{ echo '<script>var pgsql=1;</script>';}
             
                // PDO MySQL E MySQL
                $mysql = phpversion('pdo_mysql');
                if (!version_compare($valor, '1.0.2', '>=') && !extension_loaded('mysql')) {
                    
                    echo '<script>var mysql=0;</script>';
                } else{ echo '<script>var mysql=1;</script>';}
                
                //------
                
                
                ?>
                <script>
                    var cont_db_type = 0;
                                
                </script>
                <label>Banco de dados:</label> &nbsp;
                <select name="db_type" id="db_type" style="width: 150px;"
                         
                        onchange='
                                var op_db_type = this.value;
                                var mensagem_db_error = " não pode ser instalado. \n\
                                                    Verifique os requisitos necessários para instalar este banco de dados\n\
                                                e tente novamente.";                                                              
                                if (op_db_type == "mysql") {
                                    document.getElementById("db_port").value = "3306";
                                    if(mysql == 0){
                                        document.getElementById("advertencia").innerHTML="MySQL"+mensagem_db_error;
                                        document.getElementById("btn_test_db").disabled=true;
                                    }else{
                                        document.getElementById("advertencia").innerHTML="";
                                        document.getElementById("btn_test_db").disabled=false;
                                    }
                                    
                                }
                                if (op_db_type == "pgsql") {
                                    document.getElementById("db_port").value = "5432";
                                    if(pgsql == 0){
                                      //  alert("PostgreSQL Nao pode ser instalado");
                                        document.getElementById("advertencia").innerHTML="PostgreSQL"+mensagem_db_error;
                                        document.getElementById("btn_test_db").disabled=true;
                                    } else{
                                        document.getElementById("advertencia").innerHTML="";
                                        document.getElementById("btn_test_db").disabled=false;
                                    }
                                        
                                    
                                    
                                }
                                Install.onChangeDBData();
                                return true;
                                    'z>
                    <option value="default" selected></option>
                    <option value="pgsql">PostgreSQL</option>
                    <option value="mysql">MySQL</option>
                </select>
               
            </div>

            <div>
                <label>Host:</label>
                <input type="text" id="db_host" name="db_host" value="127.0.0.1" onkeyup="Install.onChangeDBData();
                        return true; "/>
            </div>
            <div>
                <label>Porta:</label>
                <input type="text" id="db_port" name="db_port"  onkeyup="Install.onChangeDBData();
                    return true;"/>
            </div>
            <div>
                <label>Usuário:</label>
                <input type="text" id="db_user" name="db_user" onkeyup="Install.onChangeDBData();
                        return true;"/>
            </div>
            <div>
                <label>Senha:</label>
                <input type="password" id="db_pass" name="db_pass" onkeyup="Install.onChangeDBData();
                        return true;"/>
            </div>
            <div>
                <label>Database:</label>
                <input type="text" id="db_name" name="db_name" onkeyup="Install.onChangeDBData();
                        return true;"/>
            </div>
        </div>
        <div>
            <p class="advertencia" id="advertencia">Atenção: O banco de dados especificado na instalação será criado automaticamente, se não existir. Caso exista, será recriado e todos os dados existentes no banco antigo serão PERMANENTEMENTE PERDIDOS.</p>
        </div>

        <div>
            <label>É necessário testar o banco antes de prosseguir.</label>
        <?php echo Template::display_button("Testar", "images/forw.png", "Install.testDB();", "button", 'btn_test_db', 'btn_test_db', false, 'Clique para testar a conexão com o Banco de Dados.'); ?>
        </div>
        <div id="db_show_result"></div>
            <?php
        }

        public static function display_install_step_4() {
            ?>
        <form id="frm_usu_admin" action="" method="">
            <h1>Criação de Usuário Administrador do AXL Livre</h1>
            <div id="step_4">
                <div>
                    <label>Nome:</label>
                    <input type="text" id="nm_usu" name="nm_usu" onkeypress="return AXL.txtBoxAlfaNumerico(this, event, null);"/>
                </div>
                <div>
                    <label>Sobrenome:</label>
                    <input type="text" id="ult_nm_usu" name="ult_nm_usu" onkeypress="return AXL.txtBoxAlfaNumerico(this, event, null);"/>
                </div>
                <div>
                    <label>Usuário:</label>
                    <input type="text" id="login_usu" name="login_usu" onkeypress="return AXL.txtBoxAlfaNumerico(this, event, null);"/>
                </div>
                <div>
                    <label>Senha:</label>
                    <input type="password" id="senha_usu" name="senha_usu"/>
                </div>
                <div>
                    <label>Confirmar Senha:</label>
                    <input type="password" id="senha_usu_2" name="senha_usu_2"/>
                </div>
                <div id="set_admin_result">
                </div>
            </div>

        </form>
        <div class="cleaner"></div>
        <?php
    }

    public static function display_install_step_5() {
        ?>
        <h1>Instalar</h1>
        <div>
            <p>Clique em Instalar para iniciar o processo de instalação do sistema.</p>
            <p>Atenção: Ao clicar em instalar, caso exista uma instalação do AXL Livre no banco especificado a mesma será sobrescrita.</p>
        <?php echo Template::display_button("Instalar", "images/forw.png", "Install.instalar();", '', "button", 'btn_install_final', false, 'Clique para iniciar o processo final de instalação.'); ?>
        </div>
        <div id="display_install_loading">
        </div>
        <?php
    }

}
?>