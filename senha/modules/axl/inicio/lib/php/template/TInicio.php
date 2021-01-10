<?php



/**
 * Classe TInicio
 *
 * responsavel pela estrutura HTML do Inicio
 *
 */
class TInicio extends Template {

	/**
	 * Método para importar arquivos de css e js
	 * @param $title
	 * 
	 */
	public static function display_header($title='') {
		$tema = parent::get_tema();
		$mod_dir = Session::getInstance()->get(AXL::K_CURRENT_MODULE)->get_dir();
		$misc = '<link rel="stylesheet" href="themes/'. $tema->get_dir() .'/css/inicio.css" type="text/css" />' . "\n";
		$misc .= '<script type="text/javascript" src="modules/'.$mod_dir.'/lib/js/inicio.js"></script>' . "\n";
		$misc .= '<script type="text/javascript">
			                var inicio = new Inicio();
			                AXL.addOnLoadListener(inicio.refresh);
		          </script>';
		parent::display_header($title, $misc);
	}
	
	/**
	 * 
	 */
	static function display_welcome_place_holder() {
		?>
			<div id="axl_welcome">
			<?php	$unidade = AXL::get_current_user()->get_unidade();
				if($unidade != null )
					TInicio::display_unidade_modulos($unidade);
			?>
			</div>
			
		<?php
	}

	/**
	 * Constrói tela de home (inicio)
	 * @param $unidade
	 */
	static function display_welcome_page($unidade) {
        $usuario = AXL::get_current_user();
		?>
			<h1><?php echo AXL::NAME; ?></h1>
			<div id="sair_menu">							
				<div id="sair_axl" title="Clique para sair do sistema">
    				<a href='?logout'>Sair AXL</a>
    				<img src="images/sair.png" />
    			</div>
                <?php
                if ($usuario->get_unidade() != null && count(DB::getInstance()->get_unidades_by_usuario($usuario->get_id()))>1) {
                    ?>
                    <div id="trocar_unidade">
                        <a href='?unidade&trocar=1'>Sair Unidade</a>
                        <img src="images/trocar_unidade.png" />
                    </div>
                    <?php
                }
                ?>
    			<div id="alterar_senha" title="Clique para alterar sua senha">
    				<a onclick='Inicio.alterarSenha()'>Alterar Senha</a>
    				<img src="images/key.png" />
    			</div>
		    </div>
			<div id="unidade_modulos" >
            </div>
            <?php
                $modulos = DB::getInstance()->get_modulos(array(Modulo::MODULO_ATIVO), array(Modulo::MODULO_GLOBAL));
                 foreach ($modulos as $m) {
		    		if ($m->get_chave() != "axl.inicio" && AXL::has_access($m)){
                		TInicio::display_modulos("Módulos Globais", $modulos);
                		break;
		    		}
                 }
                 //TODO o foreach acima foi feito para que quando um usuario nao tiver acesso a nenhum modulo global
                 //o titulo: Módulos Globais, não apareca. Sugestao melhorar o codigo se possivel
            ?>
    		<div style = "clear: both">
    			<p>AXL Livre - 2009</p>
    		</div>
		<?php
	}

    public static function display_seleciona_unidade() {
        ?>
        <!-- <h1>Defina sua Unidade:</h1>-->
        <?php
//        $aux = array();
//		foreach ($unidades as $unidade) {
//			if($unidade->get_stat_uni() == 1){
//				$aux[$unidade->get_id()] = $unidade->get_codigo()." - ".$unidade->get_nome();
//			}
//		}
//		$content = Template::display_jump_menu($aux, "id_uni", "", null, "", 1);
    }

    public static function display_unidade_modulos(Unidade $unidade) {
        ?>
        <h2><?php echo $unidade->get_codigo();?> - <?php echo $unidade->get_nome();?></h2>
        <?php
        $modulos = DB::getInstance()->get_modulos(array(Modulo::MODULO_ATIVO), array(Modulo::MODULO_UNIDADE));
        foreach ($modulos as $m){
        	if(AXL::has_access($m)){
        		TInicio::display_modulos("Módulos", $modulos);
        		break;
        	}
        }
    }

    public static function display_modulos($titulo, $modulos) {
        ?>
            <div class="lista_modulos" align="center">
				<h3><?php echo $titulo;?></h3>
				<div align = "center">
	    			 <div align = "center">
	    			<?php
//	    				$altura_img = 150;
//	    				$largura_img = 300;
	    				$modulos_por_linha = 4;
	    				$contador = 1;
					    foreach ($modulos as $m) {
				    		if ($m->get_chave() != "axl.inicio" && AXL::has_access($m)) {
						    	?>
                                
						    	<div align = "center"

						    	<?php 
                                                        if($contador % ($modulos_por_linha+1) == 0) {
                                                            echo "style=\"clear: both;\"";
                                                        }
                                                        $img_src = substr($m->get_img(), 0, -3). "jpg";
                                                        ?>
						    			 id="modulos_icons" >
											<a href='?mod=<?php echo $m->get_chave();?>'>
						    					<img src="<?php echo $img_src?>" />
						    					<br>
						    					<?php echo $m->get_nome();?>
						    				</a>
						    			</div>
						    	<?php

					    		if($contador % $modulos_por_linha == 0){
							    	?>
							    		</div>
							    		<div align = "center">
							    	<?php
							    }
							    $contador++;
					    	}
					    }
    					?>
					    </div>
				</div>
    		</div>
        <?php
    }
	
	/**
	 * Tela de editar senha do usuário
	 */
	public static function display_edit_pass_user() {
	    $id_usu = AXL::get_current_user()->get_id();
		?>
	    <form id="form_senha" onsubmit ="Inicio.confirmaAlterarSenha(); return false;">
	    	<input type="hidden" id="input_id_usuario" value="<?php echo $id_usu;?>" />
            <div><span>Senha atual: </span><input type="password" id="senha_atual" maxlength="40" /><?php parent::display_label_advertencia('id_senha_atual')?></div>
            <div><span>Nova senha: </span><input type="password" id="nova_senha" maxlength="40" /><?php parent::display_label_advertencia('id_senha_nova')?></div>
            <div><span>Confirmar nova senha: </span><input type="password" id="confirmar_nova_senha" maxlength="40" /><?php parent::display_label_advertencia('id_senha_confirma')?></div>

            <span class="config_user_control">
               <input type="submit" class="btn"  value="Salvar" />
               <input type="button" class="btn" onclick="window.closePopup(this);" value="Cancelar" />
            </span>
         </form>
        <?php
	}
}

?>
