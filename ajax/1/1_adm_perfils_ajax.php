<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";













//++++++++++++++++++++++AJAX QUE EXIBE [[BUSCA AVANÇADA]] ----------------------------########################################-------------------------------------->>>
if($ajax == "buscaAvancada"){
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formBusca = "formBusc".$array_temp;
	
?>
<script>
$(document).ready(function(){
//JQUERY executa com ENTER
	/* ao pressionar uma tecla em um campo*/
	$("#<?=$formBusca?>").keypress(function(e){
		var tecla = (e.keyCode?e.keyCode:e.which);
		/* verifica se a tecla pressionada foi o ENTER */
		if(tecla == 13){//codigo a executar	
			bAvancada<?=$INC_FAISHER["div"]?>();
			return false;/* impede o sumbit caso esteja dentro de um form */
		}
	})
//FIM JQUERY executa com ENTER
});
//limpa campos
$('#<?=$formBusca?> .limpaCampo').click(function(){
	$(this).hide();
	content = $(this).parents('#<?=$formBusca?> .input-append').find("input");
	content.val('');
	bAvancada<?=$INC_FAISHER["div"]?>();
});
$("#<?=$formBusca?> .limpaInput").on("change", function(e){	bAvancada<?=$INC_FAISHER["div"]?>(); });
function pCbusca<?=$INC_FAISHER["div"]?>(v_id){
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.fadeIn();
}
function lCbusca<?=$INC_FAISHER["div"]?>(v_id){
	$('#<?=$formBusca?> #'+v_id).val('');
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.hide();
}

//buscas avancada
function bAvancada<?=$INC_FAISHER["div"]?>(){
	var v_get = '';
	<?php $idCJ = "nome_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datai_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "dataf_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','Filtrando dados...');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "nome_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('datai_b'); lCbusca<?=$INC_FAISHER["div"]?>('dataf_b'); }

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
	<div class="span6">
		<div class="control-group">
			<label class="control-label">Nome</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="nome_b" id="nome_b" placeholder="Informe nome ou parte do nome" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span6">
		<div class="control-group">
			<label class="control-label">Data de cadastro</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="datai_b" id="datai_b" placeholder="Data inicial" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div> até 
				<div class="input-append"><input type="text" name="dataf_b" id="dataf_b" placeholder="Data final" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span12">
		<div class="form-actions">
			<button type="button" class="btn btn-primary enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> Buscar agora</button>
			<button type="button" class="btn" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');$('#dAbusca<?=$INC_FAISHER["div"]?> .bt_expandebusca').click();">Cancelar/Ocultar</button>
		</div>
	</div>
</form>
<?php	
	

}//fim ajax  -------------------------------------------- <<<




























//açoes do file ------------------------------------------------------------------>>>
if(isset($_GET["trocaLogomarca"])){
	//recebe novo arquivo
	$array_temp = 	getpost_sql($_GET["array_temp"]);
	$idIframe = 	getpost_sql($_GET["idIframe"]);
	
	//caminho do arquivo padrão
	$file_c = VAR_DIR_FILES.'files/logos/logo_impressao.png';	
//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'logoPPadrao".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$nome_e = $linha["nome"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//exclue arquivo atual
			delete($file_c);
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $file_c);
			fBKP::bkpFile($file_c);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","A Logomarca PADRÃO utilizada para impressões em ".SYS_CLIENTE_NOME_RESUMIDO." foi alterada com sucesso!");
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<
}//fim  -------------------<<<<






































//################################# EXCUIR LOGOMARCA DE PERFIL ||||||||||||||||>
if($ajax == "excluirLogoPerfil"){
	$excluir_logo = (int)getpost_sql($_GET["perfil_id"]);
	if($excluir_logo >= "1"){
		$file_e = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$excluir_logo.'.png';
		delete($file_e);
		fBKP::bkpDelFile($file_e);//adiciona arquivo em lista de excluídos BACKUP
		echo "REMOVIDO!<BR>UTILIZANDO LOGO PADRÃO...!";
	}

?>
<script> $(document).ready(function(){ pmodalDisplay('hide'); }); </script>
<?php
}//if($ajax == ""){































//AJAX (abre seleção de icon) ------------------------------------------------------------------>>>
if($ajax == "selIcon"){
	$formCadastroPincipal = $_GET["form"];
	$id_a = getpost_sql($_GET["id_a"]);

?>
<script type="text/javascript">
$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 700, function(){ $("#pModalConteudo").scrollTop(0); });//TIMER
$(document).ready(function(){
	$('#div_icon_contents<?=$INC_FAISHER["div"]?> i').click(function(){
		var classe = $(this).attr('class');
		if(classe.match(/btn-green/g) != null){
			classe = classe.replace("btn btn-green ", "");
			$('#<?=$formCadastroPincipal?> #icon').val(classe);
			$('#<?=$formCadastroPincipal?> #icon_n').attr('class',classe);
			$('#<?=$formCadastroPincipal?> #icon_n').fadeIn();
			pmodalDisplay('hide');
		}else{
			alert("Desculpe... \nEsse ícone já está sendo utilizado em outro perfil, selecione outro!");	
		}
	});
});
</script>
<style>
#div_icon_contents<?=$INC_FAISHER["div"]?>{
	font-size:30px;	
}
#div_icon_contents<?=$INC_FAISHER["div"]?> i{
	margin-bottom:3px;
}
#div_icon_contents<?=$INC_FAISHER["div"]?> i:hover{
	font-weight:bold;
}
</style>
<div id="div_icon_contents<?=$INC_FAISHER["div"]?>">
<?php
$html_icons = file_get_contents(VAR_DIR_RAIZ."css/line-awesome/inc_list.html");
$html_icons = str_replace('class="la la-','class="btn btn-green la la-',$html_icons);
//desabilitar já em uso
$resu1 = fSQL::SQL_SELECT_SIMPLES("icon", "sys_perfil", "id != '$id_a' AND icon != ''", "","200");
while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$html_icons = str_replace('class="btn btn-green '.$linha1["icon"],'class="btn '.$linha1["icon"],$html_icons);
}//fim while
echo $html_icons;
?>
</div>
<?php



}//fim ajax -------------------<<<<


































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	$tabela_lerLog = "sys_perfil";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_perfil", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_a = $linha1["nome"];
	$apelido_a = $linha1["apelido"];
	$icon_a = $linha1["icon"];
	$modulos_a = $linha1["modulos"];
	$exclusivo_a = $linha1["exclusivo"];
	$status_a = $linha1["status"];
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont_encontrou++;
	}//fim while
}//fim do if if($id_a != "0"){





//verifica se nao encontrou nada
if($cont_encontrou == "0"){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!");
	//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
	$cMSG->imprimirMSG();//imprimir mensagens criadas
	exit(0);
}//verifica se nao encontrou nada
	
	
	


	
	//status
	$status_n = "BLOQUEADO"; if($status_a == "1"){ $status_n = "ATIVO"; } if($status_a == "2"){ $status_n = "LIMITED/LIMITADO"; }
	





?>

<script type="text/javascript">
$(document).ready(function(){
	//JQUERY executa com ESC
    $(document).keyup(function(e){
        var tecla = (e.keyCode?e.keyCode:e.which);
        /* verifica se a tecla pressionada foi o ESC */
        if(tecla == 27){ if($('#idFaisher').val() == "<?=$INC_FAISHER["permissao"]?>"){ displayAcao<?=$INC_FAISHER["div"]?>('fecha'); }	}
    });
	//FIM JQUERY executa com ESC
	
	$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$id_a?>');//alimenta id de abertura
	$('#bt_visual<?=$INC_FAISHER["div"]?>').hide();
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("VISUALIZAR DADOS DE PERFIL DE GESTÃO #<?=$id_a?>");

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosger".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Identificação do Perfil de Gestão";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										<?php $cont_exib++; $d["content"] = "ID registro[,]".$id_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">ID registro</label>
                                            <div class="pagination pagination-large">
                                                <ul>
                                                    <?php if($anterior >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$anterior?>');return false;" style="border:0;" rel="tooltip" data-placement="left" data-original-title="Anterior"><i class="icon-arrow-left"></i></a></li><?php }?>
                                                    <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" rel="tooltip" data-placement="bottom" data-original-title="Registro atual (clique para selecionar)"><?=$id_a?></a></li>
                                                    <?php if($proximo >= "1"){?><li><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$proximo?>');return false;" style="border:0;" rel="tooltip" data-placement="right" data-original-title="Próximo"><i class="icon-arrow-right"></i></a></li><?php }?>
                                                </ul>
                                            </div>
										</div>
										<?php $cont_exib++; $d["content"] = "Nome/sigla[,]".$nome_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nome/sigla</label>
											<div class="controls display">
											  <?=$nome_a?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Apelido[,]".$apelido_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Apelido</label>
											<div class="controls display">
											  <?=$apelido_a?>
											</div>
										</div>
										<?php if($icon_a != ""){ $cont_exib++; $d["content"] = "Ícone de identificação[,]<i class=\"".$icon_a."\" style=\"font-size:50px;\"></i>"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Ícone de identificação</label>
											<div class="controls display">
											  <i class="<?=$icon_a?>" style="font-size:50px;"></i>
											</div>
										</div>
                                        <?php }?>
										<?php
                                        $caminho_file = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$id_a.'.png';
                                        if(file_exists($caminho_file)){
                                        ?>
										<div class="control-group">
											<label class="control-label">Logo de impressão</label>
											<div class="controls">
												<img src="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" style="padding:1px; border:#CCC 1px solid;">
											</div>
										</div>
										<?php 
                                        }//fim do file                                         
                                        ?>
										<?php $cont_exib++; $d["content"] = "Status de utilização[,]".$status_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Status de utilização</label>
											<div class="controls display">
											  <?=$status_n?>
											</div>
										</div>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadomudulo".$array_temp;//id de controle
						$boxUI_titulo = "Módulos a Disponibilizar Recursos no Perfil";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
										
										<div class="control-group">
											<label class="control-label">Módulos</label>
											<div class="controls display">
                                            SELECIONADOS:
<?php
	//modulos
	$modulos_n = "";
	$resu2 = fSQL::SQL_SELECT_SIMPLES("P.modulo_id,M.legenda", "sys_perfil_modulos P, sys_permissao_modulo M", "P.perfil_id = '$id_a' AND P.modulo_id = M.id", "GROUP BY P.modulo_id ORDER BY P.modulo_id ASC");
	while($linha2 = fSQL::FETCH_ASSOC($resu2)){
		$cont_exib++; $d["content"] = "Módulo[,]".$linha2["modulo_id"].". ".$linha2["legenda"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
		echo "<br>".$linha2["modulo_id"].". ".$linha2["legenda"];
		$modulos_n = "1";
	}
	if($modulos_n == ""){ echo "<br>*SEM MÓDULO ADICIONADO"; }
?>
											</div>
										</div>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?> 


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadomuduloextra".$array_temp;//id de controle
						$boxUI_titulo = "Recursos Extras";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
										
										<?php if($exclusivo_a >= "1"){ $cont_exib++; $d["content"] = "Exclusivo[,]DEFINIDO COMO EXCLUSIVO (independente)"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Exclusivo</label>
											<div class="controls display">
											  DEFINIDO COMO EXCLUSIVO (independente)
											</div>
										</div>
										<?php }?>
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    



            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infregistro".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Registro";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
  						<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										
										<?php $cont_exib++; $d["content"] = "Data de cadastro[,]".$user_a.", ".date("d/m/Y H:i",$time_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Data de cadastro</label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ $cont_exib++; $d["content"] = "Data de alteração[,]".$user_a_a.", ".date("d/m/Y H:i",$sync_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Data de alteração</label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($time_a_a != ""){?>
                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Log</label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> Carregar histórico de alterações do registro <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="Visualizar"><i class="icon-eye-close"></i> Ocultar</a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>


									  </div><!-- End .accordion-inner -->
									</div>
                            </div>
                                                    <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
                          </div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);





?>  



  									<div class="form-actions">
											<?php if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large" rel="tooltip" data-original-title="Ocultar Janela" onclick="pmodalDisplay('hide');">Fechar Detalhes</button>
                                            <script> $.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 1000, function(){ $("#pModalConteudo").scrollTop(0); }); </script>
											<?php }else{//if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="Exportar PDF" onclick="enviaPDF<?=$INC_FAISHER["div"]?>();">Gerar PDF(imprimir)</button>&nbsp;<button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="Exportar CSV" onclick="enviaCSV<?=$INC_FAISHER["div"]?>();">Gerar CSV</button>&nbsp;<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="displayAcao<?=$INC_FAISHER["div"]?>('fecha');">Fechar</button>
											<?php }//if(isset($_GET["POP"])){ ?>
										</div>

  <input name="acao" id="acao" type="hidden" value="print" />
  <input name="nome" id="nome" type="hidden" value="cadastro_perfilgestao_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Perfil de Gestão" />
  <input name="dados" id="dados" type="hidden" value="<?=urlencode(serialize($PRINT_DATA))?>" />
  <input name="head" id="head" type="hidden" value="" /><input name="html" id="html" type="hidden" value="" />
</form>
<script type="text/javascript">
//prepara o envio do CSV
function enviaCSV<?=$INC_FAISHER["div"]?>(){
	$('#<?=$formVisualizaPincipal?> #acao').val('csv');
	$('#<?=$formVisualizaPincipal?> #head').val('');
	$('#<?=$formVisualizaPincipal?> #html').val('');
	$('#<?=$formVisualizaPincipal?>').submit();
}
//prepara o envio do PDF
function enviaPDF<?=$INC_FAISHER["div"]?>(){
	$('#<?=$formVisualizaPincipal?> #acao').val('pdf');
	$('#<?=$formVisualizaPincipal?> #head').val('');
	$('#<?=$formVisualizaPincipal?> #html').val('');
	$('#<?=$formVisualizaPincipal?>').submit();
}
</script>
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php



















//AJAX QUE EXIBE REGISTRO ------------------------------------------------------------------>>>
if($ajax == "registro"){
	$id_a = $_GET["id_a"];

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;
	$tabela_lerLog = "sys_perfil";

	//faz o proximo e anterior
	if(isset($_GET["anterior"])){ $id_a = "0";
		$anterior = getpost_sql($_GET["anterior"]); if($anterior == ""){ $anterior = "9999999999999999999999"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$anterior' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "ORDER BY id DESC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior
	if(isset($_GET["proximo"])){ $id_a = "0";
		$proximo = getpost_sql($_GET["proximo"]); if($proximo == ""){ $proximo = "0"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$proximo' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "ORDER BY id ASC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior


if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_perfil", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_a = $linha1["nome"];
	$apelido_a = $linha1["apelido"];
	$icon_a = $linha1["icon"];
	$modulos_a = $linha1["modulos"];
	$exclusivo_a = $linha1["exclusivo"];
	$status_a = $linha1["status"];
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont++;
	}//fim while
	//verifica se nao encontrou nada
	if($cont == "0"){
		//CRIACAO DE MENSAGEM
		$cMSG->addMSG("ERRO","Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!");
		//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------------- MENSAGENS ------------------------- ||||||||||||||
		$cMSG->imprimirMSG();//imprimir mensagens criadas
		exit(0);
	}//verifica se nao encontrou nada
	










}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$nome_a = "";
	$apelido_a = "";
	$icon_a = "";
	$modulos_a = "[.2.3.6.7.8.9.]";
	$exclusivo_a = "0";
	$status_a = "1";
	
//zera as vars de data
	$user_a = $cVLogin->getVarLogin("SYS_USER_NOME");//quem realizou o cadastro
	$time_a = time(); //quando foi realizado o cadastro
	$user_a_a = "";//quel alterou o cadastro
	$sync_a = time(); //quando foi alterado o cadastro

}//limpa os campos se o registro e novo

?>
<script type="text/javascript">
<?php if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){ $('#<?=$formCadastroPincipal?> #div_idred<?=$INC_FAISHER["div"]?>').html('<b><?php if($id_a >= "1"){ echo $id_a; }else{ echo "NOVO REGISTRO";}?></b>'); });
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 1000, function(){ $("#pModalConteudo").scrollTop(0); });//TIMER
<?php }else{ //if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){
		//JQUERY executa com ESC
		/* ao pressionar uma tecla em um campo*/
		$(document).keyup(function(e){
			var tecla = (e.keyCode?e.keyCode:e.which);
			/* verifica se a tecla pressionada foi o ESC */
			if(tecla == 27){ if($('#idFaisher').val() == "<?=$INC_FAISHER["permissao"]?>"){ displayAcao<?=$INC_FAISHER["div"]?>('fecha'); }	}
		});
		//FIM JQUERY executa com ESC
		//JQUERY executa com ENTER
			/* ao pressionar uma tecla em um campo*/
			$("#id_inc<?=$INC_FAISHER["div"]?>").keypress(function(e){
				var tecla = (e.keyCode?e.keyCode:e.which);
				var val = Number($(this).val());
				/* verifica se a tecla pressionada foi o ENTER */
				if((tecla == 13) && (val >= "1")){//codigo a executar	
					janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a='+val);
					return false;/* impede o sumbit caso esteja dentro de um form */
				}
			})
		//FIM JQUERY executa com ENTER
		
		$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$id_a?>');//alimenta id de abertura
		<?php if($id_a == "0"){ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("CADASTRAR NOVO PERFIL DE GESTÃO");
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("EDITAR CADASTRO DE PERFIL DE GESTÃO #<?=$id_a?>");
		$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
		<?php }?>
	
	});
	<?php if($id_a == "0"){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); $('#<?=$formCadastroPincipal?> #nome').focus(); });//TIMER
	<?php }?>
<?php }//else{ //if(isset($_GET["POP"])){ ?>
</script>
<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";



?>

<div id="divContent_loader<?=$array_temp?>">
<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroPincipal<?=$array_temp?>();return false;">

             <input name="id_a" type="hidden" id="id_a" value="<?=$id_a?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgerais".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Identificação do Perfil de Gestão";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        
										<div class="control-group">
											<label class="control-label">ID registro</label>
											<div class="controls" id="div_idred<?=$INC_FAISHER["div"]?>">
												<div class="input-append input-prepend">
												  <button class="btn" type="button" onclick="regAnt<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="left" data-original-title="Registro anterior"><i class="icon-arrow-left"></i></button>
													<input type="text" class='input-medium' id="id_inc<?=$INC_FAISHER["div"]?>" placeholder="<?php if($id_a >= "1"){ echo $id_a; }else{ echo "NOVO REGISTRO"; }?>" style="text-align:center;" value="<?php if($id_a >= "1"){ echo $id_a; }?>" rel="tooltip" data-placement="bottom" data-original-title="Informe para buscar [Enter]">
													<button class="btn" type="button" onclick="regPro<?=$INC_FAISHER["div"]?>($('#id_inc<?=$INC_FAISHER["div"]?>').val());" rel="tooltip" data-placement="right" data-original-title="Próximo registro"><i class="icon-arrow-right"></i></button>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nome/sigla</label>
											<div class="controls">
											  <input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="input-xlarge span6" maxlength="30" data-rule-required="true" <?php if($id_a == "1"){ echo 'readonly="readonly"'; }?>>
                                              <span class="help-block"><i class="icon-info-sign"></i> <?php if($id_a == "1"){ echo 'No perfil TI não é possível ajustar o NOME!'; }else{?>"Nome curto" ou nome menor, informar arqui um nome pequeno e objetivo para identificação do perfil de gestão.<?php }?></span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Apelido</label>
											<div class="controls">
											  <input type="text" name="apelido" id="apelido" value="<?=$apelido_a?>" class="input-xlarge span9" maxlength="120" data-rule-required="true">
                                              <span class="help-block"><i class="icon-info-sign"></i> Nome maior ou completo para identificação do perfil de gestão.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Ícone de identificação</label>
											<div class="controls">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td><i class="<?=$icon_a?>" id="icon_n" style="font-size:50px; <?php if($icon_a == ""){ echo 'display:none;'; }?>"></i>&nbsp;&nbsp;</td>
                                                <?php if($id_a != "1"){?><td valign="middle"><button class="btn btn-info" onclick="selIcon<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-plus-sign"></i> Selecionar um ícone de identificação</button></td><?php }?>
                                              </tr>
                                            </table>
											  <input name="icon" type="hidden" id="icon" value="<?=$icon_a?>" />
                                              <span class="help-block"><i class="icon-info-sign"></i> <?php if($id_a == "1"){ echo 'Ícone do perfil TI é fixo, não altera.'; }else{ echo 'Definir um ícone para identificação do perfil. *(Obrigatório)'; }?></span>
<?php if($id_a != "1"){?>
<script>
function selIcon<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class="icon-pencil"></i> SELECIONE UM ÍCONE DE IDENTIFICAÇÃO','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=selIcon&form=<?=$formCadastroPincipal?>&id_a=<?=$id_a?>');
}//selIcon
</script>
<?php }?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Logo de impressão</label>
											<div class="controls">
	<table class="table table-hover table-nomargin table-bordered dataTable">
		<thead>
			<tr>
				<th>Logomarca&nbsp;ATUAL</th>
				<th>Ação (ENVIAR LOGOMARCA DE IMPRESSÃO)</th>
			</tr>
		</thead>
	<tbody>
		<tr>
			<td style="vertical-align:top; text-align:center;" id="delLogoEx<?=$INC_FAISHER["div"]?>">
<?php

$caminho_file = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$id_a.'.png';
if(file_exists($caminho_file)){
?>
<script>
function removeLogoEx<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class="icon-warning-sign" style="color:#F90;"></i> CONFIRMA EXCLUIR A LOGO DO PERFIL?','<b>Confirma remover a logo exclusiva do perfil?</b><br>*Essa ação vai devolver ao perfil a logo padrão do sistema, exposta na lista anterior.<br><br></span>','html');
	$('#pModalRodape').html('<button class="btn btn-danger btn-large" onclick="faisher_ajax(\'delLogoEx<?=$INC_FAISHER["div"]?>\', \'0\', \'<?=$AJAX_PAG?>\', \'faisher=<?=$faisher?>&ajax=excluirLogoPerfil&perfil_id=<?=$id_a?>\');">EXCLUIR A LOGO</button> <button class="btn btn-large" data-dismiss="modal">Cancelar</button>');
}//removeLogoEx
</script>
<img src="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" style="padding:1px; border:#CCC 1px solid;"><br>
<a href="#" onclick="removeLogoEx<?=$INC_FAISHER["div"]?>();return false;" class="btn btn-large" rel="tooltip" title="Remover a Logomarca"><i class="icon-trash" style="font-size:24px;"></i></a>
<?php 
}else{ echo "::LOGOMARCA PADRÃO::"; }//fim do file 

?>
            </td>
			<td style="vertical-align:top;">

                                            <?php
                                            //montar IFRAME
											$idTemp = $array_temp;//id do retorno
											$idIframe = "logoPPerfil".$array_temp;//id do iframe
                                            $arqTipo = "imagenspng";//tipos de arquivos
                                            $n_arqQtd = "1";//quantidade de arquivos maximo
                                            $maxImg = "158x48";//tamanho máximo em pixels da imagem 999x999
											$desc = "0";//ativar descicao, 1 ligado, 0 desligado
											?>
											  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&maxImg=<?=$maxImg?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
                                                <span class="help-block"><i class="icon-info-sign"></i> Arquivo é obrigatório estar no <b>Formato PNG com 158px de largura e 48px de altura</b> <a href="downloads.php?<?=$cVLogin->varsDownalod(VAR_DIR_FILES.'files/logos/logo_impressao.png', "exemplo-logomarca.png")?>" class="btn btn-mini" rel="tooltip" title="Download PNG"><i class="icon-download-alt"></i> Baixar PNG Exemplo</a>. <b>*PODEM SER UTILIZADO PNG COM TRANPARÊNCIAS!</b></span>

            
          </td>
	  </tr>
	  </tbody>
	</table>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Status de utilização</label>
											<div class="controls">
												<div class="span4">
													<div class="check-line">
														<input name="statusX" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status1" value="1" data-skin="square" data-color="green" disabled="disabled" <?php if($status_a == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status1">ATIVO (liberado)</label>
												  </div>
												</div>
                                                <?php if($id_a != "1"){?>
												<div class="span4">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status2" value="2" data-skin="square" data-color="orange" <?php if($status_a == "2"){ echo 'checked="checked"'; }?>> <label class='inline' for="status2">LIMITED/LIMITADO (acesso com limitações)</label>
												  </div>
												</div>
												<div class="span4">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status0" value="0" data-skin="square" data-color="red" <?php if($status_a == "0"){ echo 'checked="checked"'; }?>> <label class='inline' for="status0">BLOQUEADO (sem acesso)</label>
												  </div>
												</div>
                                                <?php }//if($id_a != "1"){?>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosomodulos".$array_temp;//id de controle
						$boxUI_titulo = "Módulos a Disponibilizar Recursos no Perfil";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                                                       

										<div class="control-group">
											<label class="control-label">Módulos</label>
											<div class="controls">
                                            <span class="help-block"><i class="icon-info-sign"></i> Aqui são os módulos disponíveis em seu contrato, todos são integrados ao sistema, você vai definir qual perfil gerencia ou não cada recurso.</span>
<?php

	$resu0 = fSQL::SQL_SELECT_SIMPLES("id,legenda,obs", "sys_permissao_modulo", "", "ORDER BY id ASC");
	while($linha0 = fSQL::FETCH_ASSOC($resu0)){
		$id_m = $linha0["id"];
		$legenda_m = $linha0["legenda"];
		$obs_m = $linha0["obs"];
		$sc_chek = "";
		if(preg_match("/\.".$id_m."\./i", SYS_PACOTE_MODULOS)){//verifica ser está no pacote axl
			if(preg_match("/\.".$id_m."\./i", $modulos_a)){ $sc_chek = 'checked="checked"'; }
			if(($id_a == "1") and (($id_m == "1") or ($id_m == "2"))){ $sc_chek = 'checked="checked" disabled="disabled"'; }
?>
		<div style="height:10px;"></div>
		<div class="check-line">
			<input name="modulo_<?=$id_m?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="modulo_<?=$id_m?>" value="<?=$id_m?>" data-skin="square" data-color="blue" <?=$sc_chek?>> <label class='inline' for="modulo_<?=$id_m?>" style="font-weight:bold; font-size:16px;" rel="tooltip" data-placement="right" title="<?=$obs_m?>"><?=$id_m?>. <?=maiusculo($legenda_m)?> <i class="icon-info-sign"></i></label>
		</div>
<?php
		}//preg_match
	}//while($linha0

?>

											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosoextra".$array_temp;//id de controle
						$boxUI_titulo = "Recursos Extras";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                                                       

										<div class="control-group">
											<label class="control-label">Exclusivo</label>
											<div class="controls">

	<div style="height:10px;"></div>
		<div class="check-line">
			<input name="exclusivo" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="exclusivo" value="<?=time()?>" data-skin="square" onchange="checkExclusivo<?=$INC_FAISHER["div"]?>()" data-color="blue" <?php if($exclusivo_a >= "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="exclusivo" style="font-weight:bold; font-size:14px;">Ativar recurso EXCLUSIVO (tornar independente)</label>
		</div>
<script>
function checkExclusivo<?=$INC_FAISHER["div"]?>(){
	<?php if($id_a == "1"){ ?>
	$("#<?=$formCadastroPincipal?> #exclusivo").prop("checked", false);
	$(".css_exclusivo<?=$INC_FAISHER["div"]?>").hide();	
	alert('Desculpe! O perfil TI é padrão, não pode receber esse atributo... :)');
	<?php }else{//if($id_a == "1"){ ?>
	if($("#<?=$formCadastroPincipal?> #exclusivo").prop("checked") == true){
		$(".css_exclusivo<?=$INC_FAISHER["div"]?>").fadeIn();
	}else{
		$(".css_exclusivo<?=$INC_FAISHER["div"]?>").fadeOut();		
	}
	<?php }//else{//if($id_a == "1"){ ?>
}
</script>
                                            <span class="help-block"><i class="icon-info-sign"></i> Essa funcionalidade separa alguns recursos do perfil, permitindo que o mesmo gerencie finanças e usuários do sistema de forma independente e separada dos demais.</span>

											</div>
										</div>                        

										<div class="control-group css_exclusivo<?=$INC_FAISHER["div"]?>" <?php if($exclusivo_a == "0"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">ATENÇÃO</label>
											<div class="controls" style="color:#F30;">
                                             Ao tornar o perfil EXCLUSIVO, o sistema restringe o acesso de itens financeiros e ferramentas exclusivas, permitindo ser gerenciados apenas pelo perfil.
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            
            



            
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infcadastrais".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Registro";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
  <div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        

	
                                        
										<div class="control-group">
											<label class="control-label">Data de cadastro</label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ ?>
										<div class="control-group">
											<label class="control-label">Data de alteração</label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($user_a_a != ""){?>

                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Log</label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> Carregar histórico de alterações do registro <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="Visualizar"><i class="icon-eye-close"></i> Ocultar</a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>
                                        
                                        
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->                            





  <div class="form-actions">
											<button type="submit" class="btn btn-large btn-primary"><?php if($id_a >= "1"){ echo "Salvar alterações"; }else{?>Adicionar Novo<?php }?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" /></button>
											<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="<?php if(isset($_GET["POP"])){ echo "pmodalDisplay('hide');"; }else{?>displayAcao<?=$INC_FAISHER["div"]?>('fecha');<?php }?>">Cancelar</button>
										</div>
									</form>
                                    
</div>
<div id="divContent_oculto<?=$array_temp?>" style="display:none;"></div>                                   
<?php
if(isset($_GET["POP"])){ $loaderFoco = "1"; }else{ $loaderFoco = "0"; }
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#".$formCadastroPincipal."').validate().form() == false){ valedaform = \"0\"; }
	if(valedaform == \"1\"){
		loaderFoco('divContent_loader".$array_temp."','divContent_loader_load".$array_temp."',' já estamos salvando o registro...','".$loaderFoco."');//cria um loader dinamico	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=lista&faisher=$faisher&'+$('#AJAX_GET".$INC_FAISHER["div"]."').val()+'";//vars GET de envio URL
$AJAX_FORM_INC = $formCadastroPincipal;//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormCadastroPincipal".$array_temp;//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = $AJAX_PAG; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "btSalvar".$array_temp.", #divContent_loader_load".$array_temp; //div de carregando
$AJAX_HIDE_INC = ".esconder-sendload".$INC_FAISHER["div"];//esconder ao carregar
$AJAX_SHOW_INC = ".esconder-sendload".$INC_FAISHER["div"];//mostrar ao carregar
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"]; //div de dados
$AJAX_COD_SUCESS_INC = "displayAcao".$INC_FAISHER["div"]."('fechaHtml');"; //cod java on sucess
if(isset($_GET["POP"])){ $AJAX_PAG_DIV_INC = "divContent_oculto".$array_temp; $AJAX_GET_INC = "ajax=lista&faisher=$faisher&POP=".$_GET["POP"]; $AJAX_COD_SUCESS_INC = ""; }
include "../sys/inc_sendForms.php";
?>
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php





























//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){









 







//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$nome_a = sentenca(getpost_sql($_POST["nome"]));
	$apelido_a = sentenca(getpost_sql($_POST["apelido"]));
	$icon_a = getpost_sql($_POST["icon"]);
	if(isset($_POST["status"])){ $status_a = getpost_sql($_POST["status"]); }else{ $status_a = "1"; }
	if(isset($_POST["exclusivo"])){ $exclusivo_a = getpost_sql($_POST["exclusivo"]); }else{ $exclusivo_a = "0"; }
	$nome_a = substr($nome_a,0,30);//limita em 30
	//$verifica_erro .= "<br>SER:".json_encode($_POST);
		
		
		


//VALIDAÇÔES ------------------------------**********
	//valida campo nome_a -- XXX
	if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo Nome não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo apelido_a -- XXX
	if($apelido_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo Apelido não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo icon_a -- XXX
	if($icon_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- O ícone de identificação não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	
	//verifica se já existe no sistem
	$sql_complemto = " AND id != '$id_a'";	
	if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
	$cont_ = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_perfil", "( nome = '$nome_a' OR apelido = '$apelido_a' ) $sql_complemto", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$cont_++;
	}//fim while
	if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- O nome/apelido ($nome_a/$apelido_a) está em uso, não pode ser utilizados nomes iguais! Utilize outro...";//msg
	}//fim if valida campo
	
	
	//verifica se exedeu o pacote axl
	if(($id_a == "") or ($id_a == "0")){
		$cont_perils = fSQL::SQL_CONTAGEM("sys_perfil", "");
		if($cont_perils >= SYS_PACOTE_PERFIL_QTD){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- A criação de perfils em seu pacote é de ".SYS_PACOTE_PERFIL_QTD.", você já excedeu o máximo! Fale com seu representante no Axl...";//msg
		}//fim if valida campo
	}//if(($id_a == "") or ($id_a == "0")){



	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($verifica_erro != "0"){//verifica se existe erro
		$verificaRegistro = "0";//reabre form
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b>Erros encontrados!</b><br><?=$verifica_erro?>',60000);
				<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
				<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml');<?php }//fim else if(isset($_GET["POP"])){ ?>
			});//TIMER
		</script>
		<?php
		if(isset($_GET["POP"])){ exit(0); }
	}else{//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
		$verificaRegistro = "1";
	}




	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad")){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso

}//fim isset if(isset($_POST["id_a"])){
	
//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){


	
	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO


	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "sys_perfil";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,nome,apelido,icon,exclusivo,status,user,time,user_a,sync";
	$valores = array($id_a,$nome_a,$apelido_a,$icon_a,$exclusivo_a,$status_a,$cVLogin->userReg(),time(),"0",time());
	fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	//verifica modulos inseridos
	$modulos_a = "";
	$resu0 = fSQL::SQL_SELECT_SIMPLES("id", "sys_permissao_modulo", "", "ORDER BY id ASC");
	while($linha0 = fSQL::FETCH_ASSOC($resu0)){
		$id_m = $linha0["id"];
		if(preg_match("/\.".$id_m."\./i", SYS_PACOTE_MODULOS)){//verifica ser está no pacote axl
			if(isset($_POST["modulo_".$id_m])){
				if($modulos_a != ""){ $modulos_a .= "."; }
				$modulos_a .= getpost_sql($_POST["modulo_".$id_m]);
				//VARS insert simples SQL
				$tabela2 = "sys_perfil_modulos";
				$campos2 = "perfil_id,modulo_id";
				$valores2 = array($id_a,$id_m);
				fSQL::SQL_INSERT_SIMPLES($campos2, $tabela2, $valores2);
			}
		}//preg_match
	}//while($linha0
	if($modulos_a != ""){
		$modulos_a = "[.".$modulos_a.".]";
		//atualiza dados da tabela no DB
		$camposU = "modulos";
		$valoresU = array($modulos_a);
		fSQL::SQL_UPDATE_SIMPLES($camposU, $tabela, $valoresU, "id='$id_a'");
		$campos .= ",modulos"; $valores[] = $modulos_a;
	}//if($modulos_a != ""){
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	

	//caminho do arquivo exclusivo do perfil
	$file_c = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$id_a.'.png';	
//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'logoPPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$nome_e = $linha["nome"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//exclue arquivo atual
			if(file_exists($file_c)){ delete($file_c); }
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $file_c);
			fBKP::bkpFile($file_c);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("INFO","A Logomarca exclusiva utilizada para impressões foi adicionada com sucesso!");
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<


	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_perfil", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_perfil",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Novo perfil de gestão cadastrado com sucesso!$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");



}else{  //############# ELSE - ALTERA REGISTRO |-


	//verifica modulos inseridos
	$modulos_a = ""; $modulos_sql = "";
	$resu0 = fSQL::SQL_SELECT_SIMPLES("id", "sys_permissao_modulo", "", "ORDER BY id ASC");
	while($linha0 = fSQL::FETCH_ASSOC($resu0)){
		$id_m = $linha0["id"];
		if(preg_match("/\.".$id_m."\./i", SYS_PACOTE_MODULOS)){//verifica ser está no pacote axl
			if(isset($_POST["modulo_".$id_m])){
				$modulo_id_a = getpost_sql($_POST["modulo_".$id_m]);
				if($modulos_a != ""){ $modulos_a .= "."; } $modulos_a .= $modulo_id_a;
				$modulos_sql .= " AND modulo_id != '$modulo_id_a'";				
				$cont_mod = "0";
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_perfil_modulos", "perfil_id = '".$id_a."' AND modulo_id = '".$modulo_id_a."'", "", "1");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					$cont_mod++;
				}//fim while
				if($cont_mod == "0"){
					//VARS insert simples SQL
					$tabela2 = "sys_perfil_modulos";
					$campos2 = "perfil_id,modulo_id";
					$valores2 = array($id_a,$id_m);
					fSQL::SQL_INSERT_SIMPLES($campos2, $tabela2, $valores2);						
				}//else{//if($cont_mod == "0"){
			}
		}//preg_match
	}//while($linha0
	if($id_a == "1"){//verifica se é perfil TI
		if(!preg_match("/\.1\./i", $modulos_a)){
				$modulo_id_a = "1";
				if($modulos_a != ""){ $modulos_a .= "."; } $modulos_a .= $modulo_id_a;
				$modulos_sql .= " AND modulo_id != '$modulo_id_a'";				
				$cont_mod = "0";
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_perfil_modulos", "perfil_id = '".$id_a."' AND modulo_id = '".$modulo_id_a."'", "", "1");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					$cont_mod++;
				}//fim while
				if($cont_mod == "0"){
					//VARS insert simples SQL
					$tabela2 = "sys_perfil_modulos";
					$campos2 = "perfil_id,modulo_id";
					$valores2 = array($id_a,$modulo_id_a);
					fSQL::SQL_INSERT_SIMPLES($campos2, $tabela2, $valores2);						
				}//else{//if($cont_mod == "0"){
		}//if(!preg_match("/\.1\./i", $modulos_a)){
		if(!preg_match("/\.2\./i", $modulos_a)){
				$modulo_id_a = "2";
				if($modulos_a != ""){ $modulos_a .= "."; } $modulos_a .= $modulo_id_a;
				$modulos_sql .= " AND modulo_id != '$modulo_id_a'";				
				$cont_mod = "0";
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_perfil_modulos", "perfil_id = '".$id_a."' AND modulo_id = '".$modulo_id_a."'", "", "1");
				while($linha1 = fSQL::FETCH_ASSOC($resu1)){
					$cont_mod++;
				}//fim while
				if($cont_mod == "0"){
					//VARS insert simples SQL
					$tabela2 = "sys_perfil_modulos";
					$campos2 = "perfil_id,modulo_id";
					$valores2 = array($id_a,$modulo_id_a);
					fSQL::SQL_INSERT_SIMPLES($campos2, $tabela2, $valores2);						
				}//else{//if($cont_mod == "0"){
		}//if(!preg_match("/\.2\./i", $modulos_a)){
	}//if($id_a == "1"){//verifica se é perfil TI
	if($modulos_a != ""){ $modulos_a = "[.".$modulos_a.".]"; }
	//exclue o registro
	$tabela = "sys_perfil_modulos";
	fSQL::SQL_DELETE_SIMPLES($tabela, "perfil_id = '".$id_a."' $modulos_sql");
		
	//atualiza dados da tabela no DB
	$campos = "nome,apelido,icon,modulos,exclusivo,status,user_a,sync";
	$tabela = "sys_perfil";
	$valores = array($nome_a,$apelido_a,$icon_a,$modulos_a,$exclusivo_a,$status_a,$cVLogin->userReg(),time());
	$condicao = "id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	


	//caminho do arquivo exclusivo do perfil
	$file_c = VAR_DIR_FILES.'files/logos/logo_impressao_perfil'.$id_a.'.png';	
//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'logoPPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$nome_e = $linha["nome"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//exclue arquivo atual
			if(file_exists($file_c)){ delete($file_c); }
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $file_c);
			fBKP::bkpFile($file_c);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("INFO","A Logomarca exclusiva utilizada para impressões foi alterada com sucesso!");
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<




	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_perfil", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_perfil",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso. <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a> <br><b>*EM CASOS DE ALTERAÇÃO DE MÓDULOS, OS USUARIOS LOGADOS PODEM NÃO VISUALIZAR POR COMPLETO ATÉ SAIR E LOGAR NOVAMENTE!</b>",30000);
	
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{
		if($tipo_campo_a == "1"){ $tipo_campo_n = "OPÇÃO"; }
		if($tipo_campo_a == "2"){ $tipo_campo_n = "NUMÉRICO"; }
		if($tipo_campo_a == "3"){ $tipo_campo_n = "TEXTO"; }
	
		$id = $id_a;
		$texto = $id." - <b>".$nome_a."</b><br><i>".$tipo_campo_n."</i>";
		
		//adiciona vars POP
		$POP = fGERAL::cptoFaisher($_GET["POP"], "dec");
		$POP = str_replace("{ID}", $id, $POP);
		$POP = str_replace("{TXT}", $texto, $POP);		
	}//if($POP == "1"){
?>
	<script>
	//TIMER
	$.doTimeout('vTimerOPENListPOP', 500, function(){
		<?=$POP?>
		pmodalDisplay('hide');
	});//TIMER
	</script>
<?php
	exit(0);
}










}//fim if($verificaRegistro == "1"){//############################################################### FIM VERIFICACOES||<
































//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "id,nome,apelido,icon,exclusivo,status"; //campos da tabela
	$SQL_tabela = "sys_perfil"; //tabela
	$SQL_where = ""; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&"; //variaveis para a paginacao
	$ORDEM_C = "id";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = ""; // agrupar o resultado GROUP BY

//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio;//vars get para reenvio no paginaçao AJAX
	$AJAX_GET_OR = "ORDEM_C=$ORDEM_C&ORDEM=$ORDEM&";//vars get para reenvio no paginaçao AJAX com ORDER
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<




//pega vars de busca
	unset($filtro_b);
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["nome_b"])){       					 $nome_b = getpost_sql($_GET["nome_b"]);       		     			  }else{ $nome_b = "";    		    }
	if(isset($_GET["datai_b"])){       					 $datai_b = getpost_sql($_GET["datai_b"]);       		   			  }else{ $datai_b = "";    		    }
	if(isset($_GET["dataf_b"])){       					 $dataf_b = getpost_sql($_GET["dataf_b"]);       		   			  }else{ $dataf_b = "";    		    }






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){  $filtro_marca[] = $rapida_b;
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( `id` = '$rapida_b' OR `nome` LIKE '%$rapida_b%' OR `apelido` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){  $filtro_marca[] = $datai_b;  $filtro_marca[] = $dataf_b;
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$dataf_b</b>";
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$datai_b</b> (data foi ajustada)"; }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " time >= '$timei_a' AND time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){  $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( `nome` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome











//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
//trata dados do sql paginação abaixo
			//inicia a montagem das consultas ao DB que farão a paginação
			if(isset($_GET["R_PAGINA"])){ //busca o numero de registros por pagina a exibir
				$R_PAGINA_N = $_GET["R_PAGINA"];
				if($R_PAGINA_N <= "100"){ sessoes("REG_PAG",$R_PAGINA_N); }else{ sessoes("REG_PAG","100"); }//cria a variavel
			}
			if(sessoes_v("REG_PAG") == "1"){ $reg_por_pagina = sessoes_p("REG_PAG"); }else{ $reg_por_pagina = "10"; }
			$max = $reg_por_pagina; //busca o padrao do sistema, registros por pagina
			if(isset($_GET['pagina'])){ $pagina = $_GET['pagina']; }
			if($pagina >= "1"){}else{ $pagina = 1; }
			$comeco = ($pagina*$max) - $max;
			
			//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
			$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", "$comeco,$max");
			$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group");
			$n_reg_pagina	= fSQL::SQL_CONT($QueryListaPag);
			$paginas_total 	= ceil($n_paginas / $max);
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<





//verifica perfils disponiveis
$cont_perils = SYS_PACOTE_PERFIL_QTD-$n_paginas;
if($cont_perils >= "1"){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","<b>Você já está em uso $n_paginas perfils onde o total disponível em seu pacote axl é ".SYS_PACOTE_PERFIL_QTD."!</b>");
}else{
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("INFO","<b>Você já alcançou pacote axl é ".SYS_PACOTE_PERFIL_QTD." perfils! Para adicionar perfils novos, entre em contato com a Equipe AXL... :)</b><br><br>*É livre para alterar as informações dos perfils já criados!");
}
?>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
	<table class="table table-hover table-nomargin table-bordered dataTable">
		<thead>
			<tr>
				<th colspan="2">Logomarca de Impressão PADRÃO do Sistema (TROCA LOGOMARCA PADRÃO DE IMPRESSÃO)</th>
			</tr>
		</thead>
	<tbody>
		<tr>
			<td style="vertical-align:top;">
<?php

//id temp para registro de array
$array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
$caminho_file = VAR_DIR_FILES.'files/logos/logo_impressao.png';
if(file_exists($caminho_file)){
?> 
<DIV style="padding:3px;">LOGOMARCA ATUAL SENDO UTILIZADA</DIV>
<img src="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" style="padding:1px; border:#CCC 1px solid;">
<?php 
}else{ echo "::PROCURE O GESTOR AXL, EXISTE UM PROBLEA COM SUA LOGOMARCA::"; }//fim do file 

?>
            </td>
			<td style="vertical-align:top;">

<DIV style="padding:3px;">ENVIAR NOVA LOGOMARCA (SUBSTITUIR A PADRÃO)</DIV>

                                            <?php
                                            //montar IFRAME
											$idTemp = $array_temp;//id do retorno
											$idIframe = "logoPPadrao".$array_temp;//id do iframe
                                            $arqTipo = "imagenspng";//tipos de arquivos
                                            $n_arqQtd = "1";//quantidade de arquivos maximo
                                            $maxImg = "158x48";//tamanho máximo em pixels da imagem 999x999
											$desc = "0";//ativar descicao, 1 ligado, 0 desligado
											$funcao = "salavLogoP";//ativar funcao java con retorno de QTD enviados
											?>
											  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&maxImg=<?=$maxImg?>&funcao=<?=$funcao?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
                                                <span class="help-block"><i class="icon-info-sign"></i> Arquivo é obrigatório estar no <b>Formato PNG com 158px de largura e 48px de altura</b> <a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, "exemplo-logomarca.png")?>" class="btn btn-mini" rel="tooltip" title="Download PNG"><i class="icon-download-alt"></i> Baixar PNG Exemplo</a>. <b>*PODEM SER UTILIZADO PNG COM TRANPARÊNCIAS!</b></span>
<script>                                
function salavLogoP(v_retorno){
	if(v_retorno >= "1"){ $('#btSalvarP<?=$array_temp?>').fadeIn(); }else{ $('#btSalvarP<?=$array_temp?>').fadeOut(); }
}//salavFoto

function recarregaIframe(){
	$("#<?=$idIframe?>").attr('src', "geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>");
}//recarregaIframe
</script>

											<button type="submit" class="btn btn-large btn-primary" style="display:none; margin-bottom:50px;" id="btSalvarP<?=$array_temp?>" onclick="faisher_ajax('<?="dAjax_lista".$INC_FAISHER["div"]?>', 'btSalvarFLoad<?=$array_temp?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&trocaLogomarca=1&array_temp=<?=$array_temp?>&idIframe=<?=$idIframe?>');">Substituir a Logomarca Atual? <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvarFLoad<?=$array_temp?>" /></button>
											</div>
            
          </td>
	  </tr>
	  </tbody>
	</table>
<div style="clear:both; height:50px;"></div>
<?php
//monta array
$array = $filtro_b;
$cont_ARRAY = ceil(count($array));
//listar item ja cadastrados
if($cont_ARRAY >= "1"){
?>
	<ul class="messages" style="margin-top:0; margin-right:0;">
		<li class="left">
			<div class="image"><img src="img/extras/icoBusca.png" alt=""></div>
			<div class="message"><span class="caret"></span><span class="name">Resultado da busca realizada no(s) iten(s)</span>
				<button type="button" style="float:right; margin:3px 3px;" class="btn btn-mini" onclick="bRapida<?=$INC_FAISHER["div"]?>Remove('all');" rel="tooltip" data-placement="left" data-original-title="Remove Busca"><i class="icon-remove"></i></button>
				<p>
<?php
	$listaIDS_a = $array; //nome do cookie
	foreach ($listaIDS_a as $pos => $valor){
?>
	<div class="bg-shadowb15" style="float:left; margin:0 5px 5px 0; padding:5px;"><span style="float:left; padding-right:5px;"><?=$valor?></span> <button type="button" style="float:right;" class="btn btn-mini" rel="tooltip" data-placement="right" data-original-title="Remover Item" onclick="<?php if($pos == "rapida_b"){?>bRapida<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }else{?>bAvancada<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }?>"><i class="icon-remove"></i></button></div>
<?php
	}//fim foreach
?>
<div style="clear:both;"></div>
</p>
				<span class="time"> <b><?=$n_paginas?></b> registros encontrados</span>
			</div>
		</li>
	</ul>
<div style="clear:both;"></div>
<?php
}//fim if($cont_ARRAY >= "1"){
?>
<?php
//paginação
//$REG_TOTAL_INC = "1"; //criar a variavel faz exibir os totais por página
$TIPO_INC = "padraoajax";//tipo de pg
$GET_INC = $AJAX_GET.$AJAX_GET_OR; //vars GET
$PAG_INC = $AJAX_PAG;
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"];
$AJAX_CARREGANDO_INC = "dAjax_lista".$INC_FAISHER["div"]."_load";
$AJAX_APPEND_INC = "ADD";//funcao ADD ajax faisher
include "../inc_paginacao.php";

?>
<script type="text/javascript">
$(document).ready(function(){
<?=fGERAL::marcaBusca($filtro_marca,"datatable_principal".$INC_FAISHER["div"])?>
	$('#contTitu<?=$INC_FAISHER["div"]?>').html(' (<?=$n_paginas?>)');
	$('#datatable_principal<?=$INC_FAISHER["div"]?> tbody tr').click(function() {
		var idClick = $(this).find('.sAcao');
		$(this).find(".sVisu").click(function() {
			if($('#dCentro_acao<?=$INC_FAISHER["div"]?>').is(':visible')){}else{
				idClick.click();
			}
		});

	});
	$('#datatable_principal<?=$INC_FAISHER["div"]?> thead tr th').click(function() {
		var idClick = $(this).attr("id");
		if($('#dCentro_acao<?=$INC_FAISHER["div"]?>').is(':visible')){}else{
			if((idClick != "") && (idClick != null)){ carregaLista<?=$INC_FAISHER["div"]?>($('#AJAX_GET<?=$INC_FAISHER["div"]?>_OR').val()+'&ORDEM_C='+idClick); }
		}

	});
	$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val('<?=$AJAX_GET.$AJAX_GET_OR?>&pagina=<?=$pagina?>');//salva vars get
});





<?php
//ID de controle ---  ########### rolagem faisher ################# ++++
$id_Content = "divAjax_lista".$INC_FAISHER["div"];
$id_Rolagem = "Lista".$INC_FAISHER["div"];
?>
//ao redimencionar a pagina
function resize_Tela<?=$id_Rolagem?>() {
	var v_largura = $("#<?=$id_Content?>").width();	$("#divRol<?=$id_Rolagem?>").css('width',v_largura+'px');
	//atualiza rolagem da caixa
	rolagemFaisher('divRol<?=$id_Rolagem?>','setasH');//rolagem
}//resize_TelaRelato
$(window).resize(function(){ resize_Tela<?=$id_Rolagem?>(); });
$.doTimeout('vTimerRol<?=$id_Rolagem?>', 500, function(){ resize_Tela<?=$id_Rolagem?>(); });//TIMER
$("#acao<?=$INC_FAISHER["div"]?>").click(function(){ resize_Tela<?=$id_Rolagem?>(); });
</script>
<div id="divRol<?=$id_Rolagem?>" style="width:100%; overflow:auto;">
<div id="divRol<?=$id_Rolagem?>Cont" style="width:100%; min-width:980px; padding-top:20px;">
<input id="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" name="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" type="hidden" value="<?=$AJAX_GET?>&pagina=1" />
	<table id="datatable_principal<?=$INC_FAISHER["div"]?>" class="table table-hover table-nomargin table-bordered dataTable">
		<thead>
			<tr>
				<?php $c_or = "id"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">#ID</th>
				<?php $c_or = "nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Nome/Apelido</th>
				<th>Módulos</th>
				<?php $c_or = "status"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Status/Uso</th>
				<th>Ação</th>
			</tr>
		</thead>
	<tbody>
<?php




///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $pEdit = "1"; }else{ $pEdit = "0"; }//loginAcesso


	

//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
	if($n_paginas >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$id_a = $linha1["id"];
	$nome = $linha1["nome"];
	$apelido = $linha1["apelido"];
	$icon = $linha1["icon"];
	$exclusivo = $linha1["exclusivo"];
	$status = $linha1["status"];
	//modulos
	$modulos_leg = "";
	$resu2 = fSQL::SQL_SELECT_SIMPLES("P.modulo_id,M.legenda", "sys_perfil_modulos P, sys_permissao_modulo M", "P.perfil_id = '$id_a' AND P.modulo_id = M.id", "GROUP BY P.modulo_id ORDER BY P.modulo_id ASC");
	while($linha2 = fSQL::FETCH_ASSOC($resu2)){
		if($modulos_leg != ""){ $modulos_leg .= "<br>"; }
		$modulos_leg .= $linha2["modulo_id"].". ".$linha2["legenda"];
	}
	if($modulos_leg == ""){ $modulos_leg = "SEM ACESSO"; }
	
	//status
	$uso_leg = "Exclusivo  e Integrado"; if($exclusivo == "0"){ $uso_leg = "Geral e Integrado"; }
	$status_leg = "BLOQUEADO"; if($status == "1"){ $status_leg = "ATIVO"; } if($status == "2"){ $status_leg = "LIMITED"; }
?>
										<tr>
											<td class="sVisu"><b>#<?=$id_a?></b></td>
											<td class="sVisu"><i class="<?=$icon?>" style="font-size:25px; <?php if($icon == ""){ echo 'display:none;'; }?>"></i><b><?=maiusculo($nome)?></b><br><?=$apelido?></td>
											<td class='sVisu'><?=$modulos_leg?></td>
											<td class='sVisu'><b><?=$status_leg?></b><br><?=$uso_leg?></td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
                                          </td>
										</tr>
<?php 

}//fim do while de padinação SQL
	}//fim do if($n_paginas >= "1"){ de paginacao SQL

?>
									</tbody>
								</table>
<?php if($n_paginas <= "0"){?>
	<div style="height:150px; padding:20px 0 0 10px; clear:both;"><i class="icon-info-sign"></i> Não foi encontrado nenhum resultado correspondente à sua pesquisa.</div>
<?php }?>
</div>
</div><!-- #fim rolagem faisher -->
<?php
//paginação
$REG_TOTAL_INC = "1"; //criar a variavel faz exibir os totais por página
$TIPO_INC = "padraoajax";//tipo de pg
$GET_INC = $AJAX_GET.$AJAX_GET_OR; //vars GET
$PAG_INC = $AJAX_PAG;
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"];
$AJAX_CARREGANDO_INC = "dAjax_lista".$INC_FAISHER["div"]."_load";
$AJAX_APPEND_INC = "ADD";//funcao ADD ajax faisher
include "../inc_paginacao.php";

?>
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php











































//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>
if($ajax == "home"){
	
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad")){ $pCadastro = "OFF"; }//loginAcesso
	
	//include de padrao
	$INC_VAR["buscaAvancada"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>