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












































//AJAX (gerar ID) ------------------------------------------------------------------>>>
if($ajax == "geraId"){
	$formCadastroPincipal = $_GET["formCadastroPincipal"];
	$var = fGERAL::gerarChave(24);
	echo "<script>$.doTimeout('vTimerLoad".$INC_FAISHER["div"]."', 100, function(){ $('#".$formCadastroPincipal." #acesso_id').val('".$var."'); });</script>";
}//fim ajax -------------------<<<<






















//AJAX (gerar senha) ------------------------------------------------------------------>>>
if($ajax == "geraSenha"){
	$formCadastroPincipal = $_GET["formCadastroPincipal"];
	$var = fGERAL::gerarChave(64,"nivel2");
	echo "<script>$.doTimeout('vTimerLoad".$INC_FAISHER["div"]."', 100, function(){ $('#".$formCadastroPincipal." #acesso_senha').val('".$var."'); });</script>";
}//fim ajax -------------------<<<<







































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	$tabela_lerLog = "sys_ws_portal_rm";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_ws_portal_rm", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$tabela_n_a = $linha1["tabela_n"];
	$legenda_a = $linha1["legenda"];
	$url_a = $linha1["url"];
	$responsavel_a = $linha1["responsavel"];
	$fone_a = $linha1["fone"];
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
	
	
	
	

	

	$tabela_n_a = legTabelasWebservice("sys_ws_portal_rm");
	
	
	
	$resu1 = fSQL::SQL_SELECT_SIMPLES("integrador_id,acesso_id,acesso_senha,ip_cliente,versao_app,time,time_get,time_send,time_expira,status", "sys_webservice", "tabela_n = '$tabela_n_a' AND tabela_id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$integrador_id_i = $linha1["integrador_id"];
	$acesso_id_i = $linha1["acesso_id"];
	$acesso_senha_i = $linha1["acesso_senha"];
	$ip_cliente_i = $linha1["ip_cliente"];
	$versao_app_i = $linha1["versao_app"];
	$time_i = $linha1["time"];
	$time_get_i = $linha1["time_get"];
	$time_send_i = $linha1["time_send"];
	$time_expira_i = $linha1["time_expira"];
	$status_i = $linha1["status"];
	}//fim while

	$integrador_id_n = "Cliente de Terceiros (outras empresas/não compactar)";
	if($integrador_id_i == "1"){ $integrador_id_n = "Cliente Integrador (cliente do integrador/compactar)"; }

	$status_n = "Bloqueado (sem acesso)";
	if($status_i == "1"){ $status_n = "Ativo (com acesso)"; }


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
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('VISUALIZAR DADOS DE PORTAL <?=SYS_CONFIG_RM_SIGLA?> #<?=$id_a?>');

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosger".$array_temp;//id de controle
						$boxUI_titulo = "Dados Gerais";// titulo
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
										<?php $cont_exib++; $d["content"] = "Referência/nome[,]".$legenda_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Referência/legenda</label>
											<div class="controls display">
											  <?=$legenda_a?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "URL de publicação[,]".$url_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">URL de publicação</label>
											<div class="controls display">
											  <?=$url_a?>
											</div>
										</div>
										<?php if($responsavel_a != ""){ $cont_exib++; $d["content"] = "Nome do responsável técnico[,]".$responsavel_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nome do responsável técnico</label>
											<div class="controls display">
											  <?=$responsavel_a?>
											</div>
										</div>
                                        <?php }?>
										<?php if($fone_a != ""){ $cont_exib++; $d["content"] = "Nº telefone do responsável[,]".$fone_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nº telefone do responsável</label>
											<div class="controls display">
											  <?=$fone_a?>
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
                        $boxUI_id = "daddoswebser".$array_temp;//id de controle
						$boxUI_titulo = "Dados do Web Service (uso do cliente)";// titulo
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
										<?php $cont_exib++; $d["content"] = "URL[,]".SYS_URLRAIZ."webservice/portalrm/"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">URL</label>
											<div class="controls display-plus" id="url<?=$INC_FAISHER["div"]?>" onClick="SelectText('url<?=$INC_FAISHER["div"]?>');">
											  <?=SYS_URLRAIZ?>webservice/portalrm/
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "ID de acesso[,]".$acesso_id_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">ID de acesso</label>
											<div class="controls display-plus" id="idacess<?=$INC_FAISHER["div"]?>" onClick="SelectText('idacess<?=$INC_FAISHER["div"]?>');">
											  <?=$acesso_id_i?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Senha de acesso[,]".$acesso_senha_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Senha de acesso</label>
											<div class="controls display-plus" id="sacess<?=$INC_FAISHER["div"]?>" onClick="SelectText('sacess<?=$INC_FAISHER["div"]?>');">
											  <?=$acesso_senha_i?>
											</div>
										</div>
										<?php if($ip_cliente_i != ""){ $cont_exib++; $d["content"] = "IP do cliente[,]".$ip_cliente_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">IP do cliente</label>
											<div class="controls display-plus">
											  <?=$ip_cliente_i?>
											  <span class="help-block"><i class="icon-info-sign"></i> <b>ATENÇÃO!</b> IP do cliente foi definido, o sistema só permite o uso do acesso vindo desse IP informado.</span>
											</div>
										</div>
                                        <?php }?>
										<?php $cont_exib++; $d["content"] = "Status do acesso[,]".$status_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Status do acesso</label>
											<div class="controls display">
											  <?=$status_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Qual cliente de acesso vai utilizar?[,]".$integrador_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Qual cliente de acesso vai utilizar?</label>
											<div class="controls display">
											  <?=$integrador_id_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Versão do APP cliente[,]".$versao_app_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Versão do APP cliente</label>
											<div class="controls display">
											  <?=$versao_app_i?>
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
  <input name="nome" id="nome" type="hidden" value="cadastro_wsportalrm_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Web Service Portal <?=SYS_CONFIG_RM_SIGLA?> (não divulgue esses dados)" />
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
	$tabela_lerLog = "sys_ws_portal_rm";

	//faz o proximo e anterior
	if(isset($_GET["anterior"])){ $id_a = "0";
		$anterior = getpost_sql($_GET["anterior"]); if($anterior == ""){ $anterior = "9999999999999999999999"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$anterior'", "ORDER BY id DESC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior
	if(isset($_GET["proximo"])){ $id_a = "0";
		$proximo = getpost_sql($_GET["proximo"]); if($proximo == ""){ $proximo = "0"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$proximo'", "ORDER BY id ASC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior


if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_ws_portal_rm", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$tabela_n_a = $linha1["tabela_n"];
	$legenda_a = $linha1["legenda"];
	$url_a = $linha1["url"];
	$responsavel_a = $linha1["responsavel"];
	$fone_a = $linha1["fone"];
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
	


	$tabela_n_a = legTabelasWebservice("sys_ws_portal_rm");
	
	
	
	
	$resu1 = fSQL::SQL_SELECT_SIMPLES("integrador_id,acesso_id,acesso_senha,ip_cliente,versao_app,time,time_get,time_send,time_expira,status", "sys_webservice", "tabela_n = '$tabela_n_a' AND tabela_id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$integrador_id_i = $linha1["integrador_id"];
	$acesso_id_i = $linha1["acesso_id"];
	$acesso_senha_i = $linha1["acesso_senha"];
	$ip_cliente_i = $linha1["ip_cliente"];
	$versao_app_i = $linha1["versao_app"];
	$time_i = $linha1["time"];
	$time_get_i = $linha1["time_get"];
	$time_send_i = $linha1["time_send"];
	$time_expira_i = $linha1["time_expira"];
	$status_i = $linha1["status"];
	}//fim while

}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$legenda_a = "";
	$numero_a = "";
	$acesso_id_i = fGERAL::gerarChave(24);
	$acesso_senha_i = fGERAL::gerarChave(64,"nivel2");
	$ip_cliente_i = "";
	$time_expira_i = time()+86400;
	$integrador_id_i = "1";
	$status_i = "1";
	
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('CADASTRAR NOVO PORTAL <?=SYS_CONFIG_RM_SIGLA?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('EDITAR CADASTRO DE PORTAL <?=SYS_CONFIG_RM_SIGLA?> #<?=$id_a?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
		<?php }?>
	
	});
	<?php if($id_a == "0"){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); $('#<?=$formCadastroPincipal?> #legenda').focus(); });//TIMER
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
						$boxUI_titulo = "Dados Gerais";// titulo
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
											<label class="control-label">Referência/legenda</label>
											<div class="controls">
											  <input type="text" name="legenda" id="legenda" value="<?=$legenda_a?>" class="span9 cssFonteMai" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">URL de publicação</label>
											<div class="controls">
											  <input type="text" name="url" id="url" value="<?=$url_a?>" class="input-xlarge span9" data-rule-required="true">
											  <span class="help-block"><i class="icon-info-sign"></i> Endereço web de onde vai ser publicado o Portal <?=SYS_CONFIG_RM_SIGLA?>.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nome do responsável técnico</label>
											<div class="controls">
											  <input type="text" name="responsavel" id="responsavel" value="<?=$responsavel_a?>" class="span9 cssFonteMai" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nº telefone do responsável</label>
											<div class="controls">
											  <input type="text" name="fone" id="fone" value="<?=$fone_a?>" class="span6 mask_phone" data-rule-required="true">
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoswebservice".$array_temp;//id de controle
						$boxUI_titulo = "Dados do Web Service (uso do cliente)";// titulo
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
											<label class="control-label">URL</label>
											<div class="controls display-plus" onclick="SelectText($(this))">
											  <?=SYS_URLRAIZ?>webservice/portalrm/
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">ID de acesso</label>
											<div class="controls">
											  <input type="text" name="acesso_id" id="acesso_id" value="<?=$acesso_id_i?>" class="span12" readonly data-rule-required="true">
                                              <button class="btn" onclick="geraId<?=$INC_FAISHER["div"]?>();return false;" rel="tooltip" data-placement="left" data-original-title="Gerar/alterar id de acesso"><i class="icon-random"></i> <?php if($id_a >= "1"){ echo 'Alterar id de acesso';  }else{ echo 'Gerar novo id de acesso'; }?></button>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Senha de acesso</label>
											<div class="controls">
											  <input type="text" name="acesso_senha" id="acesso_senha" value="<?=$acesso_senha_i?>" class="span12" readonly data-rule-required="true">
                                              <button class="btn" onclick="geraSenha<?=$INC_FAISHER["div"]?>();return false;" rel="tooltip" data-placement="left" data-original-title="Gerar/alterar senha de acesso"><i class="icon-random"></i> <?php if($id_a >= "1"){ echo 'Alterar senha de acesso';  }else{ echo 'Gerar nova senha de acesso'; }?></button>
											</div>
										</div>
<script>
function geraId<?=$INC_FAISHER["div"]?>(){
	if(confirm("Realmente confirma a alteração do ID DE ACESSO? <?php if($id_a >= "1"){ echo '\\n\\n\\nCaso exista conexão com outros serviços, deverá atualizar as chaves nos mesmos!';  }?>") == true){
		faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&formCadastroPincipal=<?=$formCadastroPincipal?>&ajax=geraId', 'get', 'ADD');
	}
}//geraId

function geraSenha<?=$INC_FAISHER["div"]?>(){
	if(confirm("Realmente confirma a alteração da SENHA DE ACESSO? <?php if($id_a >= "1"){ echo '\\n\\n\\nCaso exista conexão com outros serviços, deverá atualizar as chaves nos mesmos!';  }?>") == true){
		faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&formCadastroPincipal=<?=$formCadastroPincipal?>&ajax=geraSenha', 'get', 'ADD');
	}
}//geraSenha
</script>
                                     
										<div class="control-group">
											<label class="control-label">IP do cliente</label>
											<div class="controls">
											  <input type="text" name="ip_cliente" id="ip_cliente" value="<?=$ip_cliente_i?>" placeholder="Sem IP de Cliente Definido" class="span4">
											  <span class="help-block"><i class="icon-info-sign"></i> Definir um IP fixo para seu cliente, aumenta a segurança do seu sistema. Ao definir o IP, o web service só permite conexões que se originam do IP informado.</span>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Expirar o acesso em</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="time_expira" id="time_expira" value="<?=date('d/m/Y',$time_expira_i)?>" class='input-small mask_date datepick' data-rule-required="true">
													<span class="add-on icon-calendar"></span>
												</div>
												<span class="help-block"><i class="icon-info-sign"></i> Nessa data após o acesso ao web service com esses dados são bloqueados, mesmo o status estando ativo.</span>
											</div>
										</div>   
										<div class="control-group">
											<label class="control-label">Status do acesso</label>
											<div class="controls">
												<div class="span6">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status1" value="1" data-skin="square" data-color="green" <?php if($status_i == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status1">Ativo (com acesso)</label>
												  </div>
												</div>
												<div class="span6">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status2" value="0" data-skin="square" data-color="red" <?php if($status_i != "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status2">Bloqueado (sem acesso)</label>
												  </div>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Qual cliente de acesso vai utilizar?</label>
											<div class="controls">
												<div class="span6">
													<div class="check-line">
														<input name="integrador_id" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="integrador_id1" value="1" data-skin="square" data-color="blue" <?php if($integrador_id_i == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="integrador_id1">Cliente Integrador (cliente do integrador/compactar)</label>
												  </div>
												</div>
												<div class="span6">
													<div class="check-line">
														<input name="integrador_id" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="integrador_id2" value="0" data-skin="square" data-color="grey" <?php if($integrador_id_i != "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="integrador_id2">Cliente de Terceiros (outras empresas/não compactar)</label>
												  </div>
												</div>
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





//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc")){
		

		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,tabela_n", "sys_ws_portal_rm", "id = '$id_excluir'", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$id_ = $linha1["id"];
			$tabela_n_ = $linha1["tabela_n"];
			
			$resu2 = fSQL::SQL_SELECT_SIMPLES("id", "sys_webservice", "tabela_n = '$tabela_n_' AND tabela_id = '$id_'", "");
			while($linha2 = fSQL::FETCH_ASSOC($resu2)){
				$id_i = $linha2["id"];
				//exclue o registro
				$tabela = "sys_webservice";
				$condicao = "id = '$id_i'";
				fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				fGERAL::delRegistroLog("sys_webservice",$id_i,$cVLogin->userReg());//salvar/gerar log de exclusao
			}//fim while
			
			//exclue o registro
			$tabela = "sys_ws_portal_rm";
			$condicao = "id = '$id_'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			fGERAL::delRegistroLog("sys_ws_portal_rm",$id_,$cVLogin->userReg());//salvar/gerar log de exclusao
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("sys_webservice", "excluir", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Registro excluido com sucesso! ACESSO REMOVIDO.");
		}//fim while		
	}else{
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Erro nas permissões de seu usuário!");
	}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){//verifica permissão

}//fim if(isset($_GET["id_excluir"])){
//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||<







 







//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$legenda_a = getpost_sql($_POST["legenda"],"MAIUSCULO");
	$url_a = getpost_sql($_POST["url"]);
	$responsavel_a = getpost_sql($_POST["responsavel"],"MAIUSCULO");
	$fone_a = getpost_sql($_POST["fone"]);
	$acesso_id_a = getpost_sql($_POST["acesso_id"]);
	$acesso_senha_a = getpost_sql($_POST["acesso_senha"]);
	$ip_cliente_a = getpost_sql($_POST["ip_cliente"], "NULL");
	$time_expira_a = getpost_sql($_POST["time_expira"]);
	$status_a = getpost_sql($_POST["status"]);
	$integrador_id_a = getpost_sql($_POST["integrador_id"]);
	$tabela_n_a = legTabelasWebservice("sys_ws_portal_rm");
		
		
		


//VALIDAÇÔES ------------------------------**********
	//valida campo legenda_a -- XXX
	if($legenda_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo legenda/nome não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo url_a -- XXX
	if($url_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe a URL onde será publicado, preencha corretamente!";//msg
	}//fim if valida campo
	
	//verifica se já existe no sistem
	$sql_complemto = " AND id != '$id_a'";	
	if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
	$cont_ = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_ws_portal_rm", "legenda = '$legenda_a' $sql_complemto", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$cont_++;
	}//fim while
	if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- A legenda/nome ($legenda_a) está em uso, não pode ser utilizados legenda/nome iguais! Utilize outro nome.";//msg
	}//fim if valida campo
	
	//verifica se já existe no sistem
	$sql_complemto = " AND tabela_n = '$tabela_n_a' AND tabela_id != '$id_a'";	
	if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
	$cont_ = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_webservice", "acesso_id = '$acesso_id_a' AND acesso_senha = '$acesso_senha_a' $sql_complemto", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$cont_++;
	}//fim while
	if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- O ID/senha de acesso gerado está em uso por outro web service! Utilize o botão Gerar/Alterar para gerar outras.";//msg
	}//fim if valida campo

	//valida campo time_expira_a -- XXX
	if($time_expira_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe a data de expirar não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo



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


	//converte data de expirar em time UNIX
	$time_expira_a = time_data_hora($time_expira_a." 00:00");
	
	
	
	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO


	//VARS insert simples SQL
	$tabela = "sys_ws_portal_rm";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,tabela_n,legenda,url,responsavel,fone,user,time,user_a,sync";
	$valores = array($id_a,$tabela_n_a,$legenda_a,$url_a,$responsavel_a,$fone_a,$cVLogin->userReg(),time(),"0",time());
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria


	//VARS insert simples SQL
	$tabela = "sys_webservice";
	//busca ultimo id para insert
	$id_i = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,tabela_n,tabela_id,referencia,integrador_id,acesso_id,acesso_senha,ip_cliente,time_expira,status";
	$valores = array($id_i,$tabela_n_a,$id_a,$legenda_a,$integrador_id_a,$acesso_id_a,$acesso_senha_a,$ip_cliente_a,$time_expira_a,$status_a);
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	





	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_webservice", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_ws_portal_rm",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Gateway de Envios SMS cadastrado com sucesso!$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");



}else{  //############# ELSE - ALTERA REGISTRO |-


		
	//atualiza dados da tabela no DB
	$campos = "legenda,url,responsavel,fone,user_a,sync";
	$tabela = "sys_ws_portal_rm";
	$valores = array($legenda_a,$url_a,$responsavel_a,$fone_a,$cVLogin->userReg(),time());
	$condicao = "id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
		
	//atualiza dados da tabela no DB
	$campos = "referencia,integrador_id,acesso_id,acesso_senha,ip_cliente,time_expira,status";
	$tabela = "sys_webservice";
	$valores = array($legenda_a,$integrador_id_a,$acesso_id_a,$acesso_senha_a,$ip_cliente_a,$time_expira_a,$status_a);
	$condicao = "tabela_n = '$tabela_n_a' AND tabela_id = '$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	




	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_webservice", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_ws_portal_rm",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso.$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
	
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{	
		$id = $id_a;
		$texto = "<b>".$legenda_a;
		
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
	$SQL_campos = "G.id,G.legenda,W.versao_app,W.time,W.time_get,W.time_send,W.time_expira,W.status"; //campos da tabela
	$SQL_tabela = "sys_ws_portal_rm G, sys_webservice W"; //tabela
	$SQL_where = "G.tabela_n = W.tabela_n AND G.id = W.tabela_id"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&"; //variaveis para a paginacao
	$ORDEM_C = "G.legenda";//campo de ordenar
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
if($rapida_b != ""){ $filtro_marca[] = $rapida_b;
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( G.`id` = '$rapida_b' OR `legenda` LIKE '%$rapida_b%' OR `url` LIKE '%$rapida_b%' OR `responsavel` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){ $filtro_marca[] = $datai_b; $filtro_marca[] = $dataf_b;
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$dataf_b</b>";
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$datai_b</b> (data foi ajustada)"; }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " G.time >= '$timei_a' AND G.time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){ $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( G.`legenda` LIKE '%$nome_b%' ) "; //condição 
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
?>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
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
				<?php $c_or = "G.legenda"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Referência/Legenda</th>
				<th>SYNC</th>
				<?php $c_or = "W.status"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Status/Expira</th>
				<th>Ação</th>
			</tr>
		</thead>
	<tbody>
<?php




///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $pEdit = "1"; }else{ $pEdit = "0"; }//loginAcesso
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc")){ $pExc = "1"; }else{ $pExc = "0"; }//loginAcesso


	

//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
	if($n_paginas >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$id_a = $linha1["id"];
	$legenda = $linha1["legenda"];
	$versao_app = $linha1["versao_app"];
	$time = $linha1["time"];
	$time_get = $linha1["time_get"];
	$time_send = $linha1["time_send"];
	$time_expira = $linha1["time_expira"];
	$status = $linha1["status"];
	
	$status_leg = "BLOQUEADO";
	if($status == "1"){ $status_leg = "<b>ATIVO</b>"; }

?>
										<tr>
											<td class="sVisu"><b><?=maiusculo($legenda)?></b></td>
											<td class="sVisu">
		<div><button class="btn btn-<?=legCorSyncWebservice($time)?>" style="width:100%;" rel="tooltip" data-placement="left" data-original-title="Comunicação com o cliente">SYNC: <?=difHoraTime($time)?></button></div>
		<div><button class="btn btn-<?=legCorSyncWebservice($time_get)?>" style="margin-top:2px; width:100%;" rel="tooltip" data-placement="left" data-original-title="Copiou dados">GET: <?=difHoraTime($time_get)?></button></div>
		<div><button class="btn btn-<?=legCorSyncWebservice($time_send)?>" style="margin-top:2px; width:100%;" rel="tooltip" data-placement="left" data-original-title="Enviou dados">SEND: <?=difHoraTime($time_send)?></button></div>
                                            </td>
											<td class='sVisu'><?=$status_leg?><br><i>Expirar <?=difHoraTime(time(),$time_expira,"2","")?></i><br><?php if($versao_app != ""){?>Versão: <?=$versao_app?><?php }?></td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
												<?php if($pExc == "1"){?><a href="#" onclick="if(confirm('Gostaria realmete de remover \'<?=$legenda?>\'?')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&id_excluir=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="Remover"><i class="icon-remove"></i></a><?php }?>
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