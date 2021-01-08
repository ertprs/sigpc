<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";
//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<









//++++++++++++++++++++++AJAX QUE EXIBE [[BUSCA AVANÇADA]] ----------------------------########################################-------------------------------------->>>
if($ajax == "buscaDireta"){
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formBusca = "formBusc".$array_temp;

	/////////// INCLUDE JS EXCLUSIVO --------------------- 
	$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
	$INC_JSCSS = $INC_FAISHER["div"]."bp";
	include "inc/inc_js-exclusivo.php";			
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
	var v_get = '&tab_id='+$('#tab_id<?=$INC_FAISHER["div"]?>').val();//pega dados do tabs
	<?php $idCJ = "doc_tipo_b";?>if($("#<?=$formBusca?> input[name='<?=$idCJ?>']:checked").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> input[name='<?=$idCJ?>']:checked").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datan_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "doc_numero_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "tipo_cfc_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>:checked").is(':checked')){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>:checked").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "tipo_medico_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").is(':checked')){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>:checked").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Filtrando dados...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "doc_numero_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datan_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }	
	<?php $idCJ = "tipo_cfc_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }	
	<?php $idCJ = "tipo_medico_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }	

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
	<div class="span6">
   
      
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº do documento')?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="doc_numero_b" id="doc_numero_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o nº do documento')?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
            </div>
        </div>    
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
            <div class="controls">
            	<div class="input-append"><input type="text" class="input-xlarge mask_date" id="datan_b" name="datan_b"/><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
                <div style="height:15px;"></div>
            </div>
        </div>   
        <div class="control-group">
            <label class="control-label">Tipo de usuário</label>
            <div class="controls">
                <div style="height:10px;"></div>
                <div class="check-demo-col">                
                    <div class="check-line">
                        <input name="tipo_cfc_b" type="checkbox" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="tipo_cfc_b" value="
AUTO-ÉCOLE" data-skin="square" onchange="bAvancada<?=$INC_FAISHER["div"]?>()" data-color="blue" checked="checked"> <label class='inline' for="tipo_b2" style="font-weight:bold; font-size:14px;">
AUTO-ÉCOLE</label>
                    </div>
                </div>
                <div class="check-demo-col">
                    <div class="check-line">
                        <input name="tipo_medico_b" type="checkbox" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="tipo_medico_b" value="CLINIQUE MÉDICALE" data-skin="square" onchange="bAvancada<?=$INC_FAISHER["div"]?>()" data-color="blue" checked="checked"> <label class='inline' for="tipo_b2" style="font-weight:bold; font-size:14px;">CLINIQUE MÉDICALE</label>
                    </div>                
                </div>
            </div>
        </div>          
	</div><!-- End .span6 -->
    
	<div class="span6">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo do documento')?></label>
            <div class="controls">
                <div class="check-line">
                    <input name="doc_tipo_b" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo1" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')?>" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="doc_tipo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo_b" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo2" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo_b" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo3" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo3"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID Estrangeiro')?></label>
                </div>
                
            </div>
        </div>     
	</div><!-- End .span6 -->

    
	<div class="span12">
		<div class="form-actions">
			<button type="button" class="btn btn-primary enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar agora')?></button>
			<button type="button" class="btn" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');$('#dAbusca<?=$INC_FAISHER["div"]?> .bt_expandebusca').click();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar busca')?></button>
		</div>
	</div>
</form>
<?php	
	

}//fim ajax  -------------------------------------------- <<<































































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;

	$cont = "0";
	$campos = "U.id,U.nome,U.datan,U.sexo,U.cargo,U.doc_nome,U.doc_numero,U.mae,U.celular,U.time,U.status_leg";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_usuarios U", "id = '$id_a'");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_a = $linha1["id"];
		$nome_a = $linha1["nome"];
		$datan_a = data_mysql($linha1["datan"]);
		$sexo_a = $linha1["sexo"];
		$cargo_a = $linha1["cargo"];
		$doc_nome_a = $linha1["doc_nome"];
		$doc_numero_a = $linha1["doc_numero"];
		$mae_a = $linha1["mae"];
		$celular_a = $linha1["celular"];
		$time_a = $linha1["time"];
		$motivo_a = $linha1["status_leg"];
		$cont++;
	}//fim while

	if($motivo_a == "0"){ $motivo_a = ""; }

	//verifica se nao encontrou nada
	if($cont == "0"){
		//CRIACAO DE MENSAGEM
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!'));
		//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------------- MENSAGENS ------------------------- ||||||||||||||
		$cMSG->imprimirMSG();//imprimir mensagens criadas
		exit(0);
	}//verifica se nao encontrou nada	
	
	
	$resu1 = fSQL::SQL_SELECT_DUPLO("email,status", "sys_login", "usuarios_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$email_a = $linha1["email"];
		$status_a = $linha1["status"];
	}//fim while
	$status_n = legVerificacaoCredenciamento($status_a);
	
	
	
	
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_DUPLO($campos, "sys_usuarios_endereco", "usuario_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_end = $linha1["id"];
		$pais_a = $linha1["pais"];
		$uf_a = $linha1["uf"];
		$cidade_id_a = $linha1["cidade_id"];
		$bairro_a = $linha1["bairro"];
		$logradouro_a = $linha1["logradouro"];
		$referencia_a = $linha1["referencia"];		
		$codigo_energia_a = $linha1["codigo_energia"];		
	}//fim while	
	
	
	$pasta_caminho = VAR_DIR_FILES."files/tabelas/usuarios/".$id_a."/";	
	
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
	
	$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$rm_?>');//alimenta id de abertura
	$('#bt_visual<?=$INC_FAISHER["div"]?>').hide();
	$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'VISUALIZAR DADOS DE CREDENCIAMENTO')?> #<?=$rm?>');

});
<?php if(isset($_GET["POP"])){ $anterior="0";$proximo="0"; ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 1000, function(){ $("#pModalConteudo").scrollTop(0); $('#pModalRodape').html('<a href="#" onclick="<?=$cVLogin->linkMENU($faisher,"id_v=".$id_a,"popup-java")?>pfullcontentDisplay(\'hide\');return false;" class="btn btn-success" rel="tooltip" data-placement="left" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar o POPUP em outra janela')?>"><i class="icon-share"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'VISUALIZAR FORA DO POPUP')?></a>'); });//TIMER
<?php }else{ //if(isset($_GET["POP"])){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER
<?php }//else{ //if(isset($_GET["POP"])){ ?>
</script>


<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-bordered form-column form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgera".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados Gerais da Solicitação');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID')?></label>
                                            <div class="pagination pagination-large">
                                                <ul>
                                                    
                                                    <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" class="font-bebas-m" rel="tooltip" data-placement="bottom" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Registro atual (clique para selecionar)')?>"><?=$id_a?></a></li>
                                                </ul>
                                            </div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitado em')?></label>
											<div class="controls display">
											  <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>

										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo de Acesso')?></label>
											<div class="controls display-plus">
											  <?=$cargo_a?>
											</div>
										</div>


										<div class="control-group" id="ver_imgs<?=$INC_FAISHER["div"]?>">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documentos anexos a solicitação')?></label>
											<div class="controls">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados/Arquivo')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
										</tr>
									</thead>
									<tbody>

<?php

$cont_img = "0";

//verifica frente do documento
$caminho_file = $pasta_caminho."/doc-rccm.pdf";
if(file_exists($caminho_file)){
			$cont_img++;
?>
										<tr id="tr_i<?=$cont_img?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="iimg_<?=$cont_img?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$class_fLNG->txt(__FILE__,__LINE__,'DOCUMENTO RCCM')?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#iimg_<?=$cont_img?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
                                          </td>
										</tr>
<?php
}//if(file_exists($caminho_file)){
//verifica verso do documento
$caminho_file = $pasta_caminho."/doc.pdf";
if(file_exists($caminho_file)){
			$cont_img++;
?>
										<tr id="tr_i<?=$cont_img?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="iimg_<?=$cont_img?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$class_fLNG->txt(__FILE__,__LINE__,'DOCUMENTO PESSOAL')?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#iimg_<?=$cont_img?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
                                          </td>
										</tr>
<?php
}//if(file_exists($caminho_file)){
?>
									</tbody>
								</table>

<?php 
if($cont_img == "0"){

?>
<script>$(document).ready(function(){ $("#ver_imgs<?=$INC_FAISHER["div"]?>").hide(); });</script>
<?php }?>    
											</div>
										</div>
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->

 


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscidadao".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados da Pessoa');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome')?></label>
											<div class="controls display-plus">
											  <?=$nome_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sexo')?></label>
											<div class="controls display">
											  <?=legSexo($sexo_a)?>
											</div>
										</div>
										<div class="control-group">

											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
											<div class="controls display">
											  <?=$datan_a.", ".$class_fLNG->txt(__FILE__,__LINE__,'!!idade!! anos',array("idade"=>calcular_idade($datan_a)))?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento')?></label>
											<div class="controls display">
											  <?=$doc_nome_a?> <?=$doc_numero_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome da mãe')?></label>
											<div class="controls display">
											  <?=$mae_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Celular')?></label>
											<div class="controls display">
											  <?=$celular_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Email')?></label>
											<div class="controls display">
											  <?=$email_a?>
											</div>
										</div>

                                        <div class="control-group">
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'País')?></label>
                                            <div class="controls display">
                                              <?=$pais_a?>
                                            </div>
                                        </div>                                        
                                        <div class="control-group row-fluid">                                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Subdivisão/Estado')?></label>
                                                <div class="controls display">
                                                  <?=$uf_a?>
                                                </div>
                                            </div>
										</div>                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Prefeitura/Cidade')?></label>
                                                <div class="controls display">
                                                  <?=$cidade_id_a?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        
                                        <div class="control-group row-fluid">                                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Setor')?></label>
                                                <div class="controls display">
                                                  <?=$bairro_a?>
                                                </div>
                                            </div>                                        
										</div>                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Logradouro')?></label>
                                                <div class="controls display">
                                                  <?=$logradouro_a?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        <div class="control-group">
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Referência')?></label>
                                            <div class="controls display">
                                              <?=$referencia_a?>
                                            </div>
                                        </div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Código de Energia')?></label>
											<div class="controls display">
											  <?=$codigo_energia_a?>
											</div>
										</div>                                        

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->

 








                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadostecnic".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Informações da Decisão');// titulo
						$boxUI_status = "1";// 1 - aberto, 0 - fechado, off - desligado
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


<?php if($status_a == "3"){?>   
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Decisão da solicitação')."[,]".$class_fLNG->txt(__FILE__,__LINE__,'AINDA NÃO APLICADA (aguardando decisão)'); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Decisão do credenciamento')?></label>
											<div class="controls display-plus">
											  <?=$class_fLNG->txt(__FILE__,__LINE__,'AINDA NÃO APLICADA (aguardando decisão)')?>
											</div>
										</div>      
<?php }else{//if($status_a == "3"){?>



										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Decisão da credenciamento')."[,]".$decisao_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Decisão da credenciamento')?></label>
											<div class="controls display-plus">
											  <?=$status_n?>
											</div>
										</div>

										<?php if($motivo_a != ""){ $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Motivo')."[,]".$texto_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo')?></label>
											<div class="controls display">
												<?=imprime_enter($motivo_a)?>
											</div>
										</div>
                                        <?php }?>

										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Data')."[,]".date("d/m/Y H:i",$sync_a); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data')?></label>
											<div class="controls display">
												<?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Usuário da decisão')."[,]".$user_a_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Usuário da decisão')?></label>
											<div class="controls display">
												<?=$user_a_a?>
											</div>
										</div> 
<?php }//else{//if($status_a == "2"){?>
                                                                            

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?> 

   
   



  									<div class="form-actions">
											<?php if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large" rel="tooltip" data-original-title="Ocultar Janela" onclick="pmodalDisplay('hide');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar Detalhes')?></button>
											<?php }else{//if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar PDF')?>" onclick="enviaPDF<?=$INC_FAISHER["div"]?>();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar PDF(imprimir)')?></button>&nbsp;<button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar CSV')?>" onclick="enviaCSV<?=$INC_FAISHER["div"]?>();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar CSV')?></button>&nbsp;<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="displayAcao<?=$INC_FAISHER["div"]?>('fecha');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
											<?php }//if(isset($_GET["POP"])){ ?>
										</div>

  <input name="acao" id="acao" type="hidden" value="print" />
  <input name="nome" id="nome" type="hidden" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'credenciamento')?>_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'Dados de Credenciamento')?>" />
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


	$cont = "0";
	$campos = "U.id,U.nome,U.datan,U.sexo,U.cargo,U.doc_nome,U.doc_numero,U.mae,U.celular,U.time";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_usuarios U", "id = '$id_a'");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_a = $linha1["id"];
		$nome_a = $linha1["nome"];
		$datan_a = data_mysql($linha1["datan"]);
		$sexo_a = $linha1["sexo"];
		$cargo_a = $linha1["cargo"];
		$doc_nome_a = $linha1["doc_nome"];
		$doc_numero_a = $linha1["doc_numero"];
		$mae_a = $linha1["mae"];
		$celular_a = $linha1["celular"];
		$time_a = $linha1["time"];
		$cont++;
	}//fim while

	//verifica se nao encontrou nada
	if($cont == "0"){
		//CRIACAO DE MENSAGEM
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!'));
		//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------------- MENSAGENS ------------------------- ||||||||||||||
		$cMSG->imprimirMSG();//imprimir mensagens criadas
		exit(0);
	}//verifica se nao encontrou nada	

	$resu1 = fSQL::SQL_SELECT_DUPLO("email,status", "sys_login", "usuarios_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$email_a = $linha1["email"];
		$status_a = $linha1["status"];
	}//fim while
	$status_n = legVerificacaoCredenciamento($status_a);
	
	
	
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_DUPLO($campos, "sys_usuarios_endereco", "usuario_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_end = $linha1["id"];
		$pais_a = $linha1["pais"];
		$uf_a = $linha1["uf"];
		$cidade_id_a = $linha1["cidade_id"];
		$bairro_a = $linha1["bairro"];
		$logradouro_a = $linha1["logradouro"];
		$referencia_a = $linha1["referencia"];		
		$codigo_energia_a = $linha1["codigo_energia"];		
	}//fim while	
	
	
	$pasta_caminho = VAR_DIR_FILES."files/tabelas/usuarios/".$id_a."/";



?>

<script type="text/javascript">
<?php if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){ $('#<?=$formCadastroPincipal?> #div_idred<?=$INC_FAISHER["div"]?>').html('<b><?php if($id_a >= "1"){ echo fGERAL::legCode($id_a,$code_a); }else{ echo "NOVO REGISTRO";}?></b>'); });
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 1000, function(){ $("#pModalConteudo").scrollTop(0); $('#pModalRodape').html('<a href="#" onclick="<?=$cVLogin->linkMENU($faisher,"id_a=".$id_a,"popup-java")?>return false;" class="btn btn-success" rel="tooltip" data-placement="left" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Editar em outra janela')?>"><i class="icon-share"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EDITAR FORA DO POPUP')?></a>'); });//TIMER
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
					janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=0&code='+val);
					return false;/* impede o sumbit caso esteja dentro de um form */
				}
			})
		//FIM JQUERY executa com ENTER
		
		$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$rm_?>');//alimenta id de abertura
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'SOLICITAÇÃO DE CREDENCIAMENTO DE !!cargo!!',array("cargo"=>$cargo_a))?> #<?=$id_a?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
	
	});
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER
<?php }//else{ //if(isset($_GET["POP"])){ ?>
</script>
<?php

/////////// INCLUDE JS EXCLUSIVO ---------------------
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";



?>
<div id="divContent_loader<?=$array_temp?>">
<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-column form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroPincipal<?=$array_temp?>();return false;">

             <input name="id_a" type="hidden" id="id_a" value="<?=$id_a?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <input name="nome" type="hidden" id="nome" value="<?=$nome_a?>" />
             <input name="email" type="hidden" id="email" value="<?=$email_a?>" />
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgera".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados Gerais da Solicitação');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID')?></label>
                                            <div class="pagination pagination-large">
                                                <ul>
                                                    
                                                    <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" class="font-bebas-m" rel="tooltip" data-placement="bottom" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Registro atual (clique para selecionar)')?>"><?=$id_a?></a></li>
                                                </ul>
                                            </div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitado em')?></label>
											<div class="controls display">
											  <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>

										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo de Acesso')?></label>
											<div class="controls display-plus">
											  <?=$cargo_a?>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status da solicitação')?></label>
											<div class="controls display-plus">
											  <?=$status_n?>
											</div>
										</div>

                                        
                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'INSTRUÇÕES')?></label>
											<div class="controls">
											  <div class="alert alert-info">
											    <strong><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></strong> <?=$class_fLNG->txt(__FILE__,__LINE__,'Verificar corretamente os dados para garantir a segurança do sistema.')?><br>
                                                 <strong>*<?=$class_fLNG->txt(__FILE__,__LINE__,'SE TUDO ESTIVER OK, PODE ACEITAR O CREDENCIAMENTO, CASO CONTRÁRIO, DEVE NEGAR!')?></strong>
											  </div>
											</div>
										</div>

										<div class="control-group" id="ver_imgs<?=$INC_FAISHER["div"]?>">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documentos anexos a solicitação')?></label>
											<div class="controls">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados/Arquivo')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
										</tr>
									</thead>
									<tbody>

<?php

$cont_img = "0";

//verifica frente do documento
$caminho_file = $pasta_caminho."/doc-rccm.pdf";
if(file_exists($caminho_file)){
			$cont_img++;
?>
										<tr id="tr_i<?=$cont_img?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="iimg_<?=$cont_img?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$class_fLNG->txt(__FILE__,__LINE__,'DOCUMENTO RCCM')?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#iimg_<?=$cont_img?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
                                          </td>
										</tr>
<?php
}//if(file_exists($caminho_file)){
//verifica verso do documento
$caminho_file = $pasta_caminho."/doc.pdf";
if(file_exists($caminho_file)){
			$cont_img++;
?>
										<tr id="tr_i<?=$cont_img?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="iimg_<?=$cont_img?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$class_fLNG->txt(__FILE__,__LINE__,'DOCUMENTO PESSOAL')?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#iimg_<?=$cont_img?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
                                          </td>
										</tr>
<?php
}//if(file_exists($caminho_file)){
?>
									</tbody>
								</table>

<?php 
if($cont_img == "0"){

?>
<script>$(document).ready(function(){ $("#ver_imgs<?=$INC_FAISHER["div"]?>").hide(); });</script>
<?php }?>    
											</div>
										</div>
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->

 


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscidadao".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados da Pessoa');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome')?></label>
											<div class="controls display-plus">
											  <?=$nome_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sexo')?></label>
											<div class="controls display">
											  <?=legSexo($sexo_a)?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
											<div class="controls display">
											  <?=$datan_a.", ".$class_fLNG->txt(__FILE__,__LINE__,'!!idade!! anos',array("idade"=>calcular_idade($datan_a)))?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento')?></label>
											<div class="controls display">
											  <?=$doc_nome_a?> <?=$doc_numero_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome da mãe')?></label>
											<div class="controls display">
											  <?=$mae_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Celular')?></label>
											<div class="controls display">
											  <?=$celular_a?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Email')?></label>
											<div class="controls display">
											  <?=$email_a?>
											</div>
										</div>

                                        <div class="control-group">
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'País')?></label>
                                            <div class="controls display">
                                              <?=$pais_a?>
                                            </div>
                                        </div>                                        
                                        <div class="control-group row-fluid">                                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Subdivisão/Estado')?></label>
                                                <div class="controls display">
                                                  <?=$uf_a?>
                                                </div>
                                            </div>
										</div>                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Prefeitura/Cidade')?></label>
                                                <div class="controls display">
                                                  <?=$cidade_id_a?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        
                                        <div class="control-group row-fluid">                                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Setor')?></label>
                                                <div class="controls display">
                                                  <?=$bairro_a?>
                                                </div>
                                            </div>                                        
										</div>                        
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Logradouro')?></label>
                                                <div class="controls display">
                                                  <?=$logradouro_a?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        <div class="control-group">
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Referência')?></label>
                                            <div class="controls display">
                                              <?=$referencia_a?>
                                            </div>
                                        </div>
                                                                                
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Código de Energia')?></label>
											<div class="controls display">
											  <?=$codigo_energia_a?>
											</div>
										</div>                                        
                                        




										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->

 


         
                            
                            

                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosistec".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Informações da Decisão do Credenciamento');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></label>
											<div class="controls display">
											  <?=$class_fLNG->txt(__FILE__,__LINE__,'Autorizar credenciamento do(a) !!nome!! para realização de ações como !!cargo!!?',array("nome"=>$nome_a,"cargo"=>$cargo_a))?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Decisão da solicitação')?></label>
											<div class="controls">
												<div class="span4" style="border:0;">
													<div class="check-line">
														<input name="decisao" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck css_decisao' id="decisao1" value="1" data-skin="square" data-color="blue"> <label class='inline' for="decisao1"><?=$class_fLNG->txt(__FILE__,__LINE__,'ACEITAR')?></label>
												  </div>
												</div>
												<div class="span4" style="border:0;">
													<div class="check-line">
														<input name="decisao" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck css_decisao' id="decisao2" value="2" data-skin="square" data-color="red"> <label class='inline' for="decisao2"><?=$class_fLNG->txt(__FILE__,__LINE__,'NEGAR')?></label>
												  </div>
												</div>
											</div>
										</div>
<script>
$(document).ready(function(e) {
    $("#<?=$formCadastroPincipal?> input[name='decisao']").on("change", function(){
		val = $("#<?=$formCadastroPincipal?> input[name='decisao']:checked").val();
		if(val == "2"){
			$("#<?=$formCadastroPincipal?> #div_motivo<?=$INC_FAISHER["div"]?>").fadeIn();
		}else{
			$("#<?=$formCadastroPincipal?> #div_motivo<?=$INC_FAISHER["div"]?>").fadeOut();			
		}
	});
});
</script>                                        

										<div class="control-group" id="div_motivo<?=$INC_FAISHER["div"]?>" style="display:none;">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo')?></label>
											<div class="controls">
												<textarea name="motivo" id="motivo" rows="4" class="input-block-level cssFonteMai" data-rule-required="true" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Observações')?>"></textarea>
                                                <span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo no qual o cadastro foi negado. Será enviado para o solicitante.')?></span>
											</div>
										</div>
            
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->      
  
  
            


  <div class="form-actions">
											<button type="submit" class="btn btn-large btn-primary"><?=$class_fLNG->txt(__FILE__,__LINE__,'Salvar alterações')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" /></button>
											<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="<?php if(isset($_GET["POP"])){ echo "pmodalDisplay('hide');"; }else{?>displayAcao<?=$INC_FAISHER["div"]?>('fecha');<?php }?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
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
		loaderFoco(\"divContent_loader".$array_temp."\",\"divContent_loader_load".$array_temp."\",\" ".$class_fLNG->txt(__FILE__,__LINE__,'já estamos salvando o registro...')."\",\"".$loaderFoco."\");//cria um loader dinamico
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
	if(isset($_GET["tab_id"])){			$tab_id = getpost_sql($_GET["tab_id"]);		}else{ $tab_id = "0";		}











 







//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$decisao_a = getpost_sql($_POST["decisao"]);
	$motivo_a = getpost_sql($_POST["motivo"]);
	$nome_a = getpost_sql($_POST["nome"]);	
	$email_a = getpost_sql($_POST["email"]);	


		


//VALIDAÇÔES ------------------------------**********
	//valida campo gestor_perfil_id -- XXX
	if(($decisao_a != "1") and ($decisao_a != "2")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'A decisão deve ser preenchida não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo texto_sms_a -- XXX
	if(($decisao_a == "2") and ($motivo_a == "")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'É necessário informar o motivo de recusa do credenciamento, preencha corretamente!');//msg
	}//fim if valida campo
	

		



	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($verifica_erro != "0"){//verifica se existe erro
		$verificaRegistro = "0";//reabre form
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erros encontrados!')?></b><br><?=$verifica_erro?>',60000);
				<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
				<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml');<?php }//fim else if(isset($_GET["POP"])){ ?>
			});//TIMER
		</script>
		<?php
		if(isset($_GET["POP"])){ exit(0); }
	}else{//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
		$verificaRegistro = "1";
	}




}//fim isset if(isset($_POST["id_a"])){
	
//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){


	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a >= "1"){ //############# IF - GRAVA REGISTRO |-----> SQL CADASTRO
	
	
	$msg_retorno = $class_fLNG->txt(__FILE__,__LINE__,'Solicitação de credenciamento finalizada com sucesso!');
	if($decisao_a == "1"){ 
		$status_a = "1"; $msg_retorno .= " <b>".$class_fLNG->txt(__FILE__,__LINE__,'Decisão ACEITO')."</b>."; 
		$notificacao_msg = $class_fLNG->txt(__FILE__,__LINE__,'Seu credenciamento foi <b>ACEITO</b>!<br><br>Acesse seu ambiente utilizando e-mail e senha cadastrados e inicie já os trabalhos!');
		
	
	}else{ 
		$status_a = "5"; $msg_retorno .= " <b>".$class_fLNG->txt(__FILE__,__LINE__,'Decisão NEGADO')."</b>."; 
		$notificacao_msg = $class_fLNG->txt(__FILE__,__LINE__,'Seu credenciamento foi <b>NEGADO</b>!')."<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'Motivo').": ".$motivo_a;
		
		//atualiza dados da tabela no DB
		$campos = "status,status_leg,user_a,sync";
		$tabela = "sys_usuarios";
		$valores = array("2",$class_fLNG->txt(__FILE__,__LINE__,'Credenciamento Negado'),$cVLogin->userReg(),time());
		$condicao = "id='$id_a'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);		
		
		fSQL::SQL_DELETE_SIMPLES("sys_login_pacote","usuarios_id = '$id_a'");
		fSQL::SQL_DELETE_SIMPLES("sys_login","usuarios_id = '$id_a'");		
	}

	//atualiza dados da tabela no DB
	$campos = "user_a,status,sync";
	$tabela = "sys_login";
	$valores = array($cVLogin->userReg(),$status_a,time());
	$condicao = "usuarios_id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);			

	
	//prepara envio de email
	
	$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
	//monta mensagem template
	$html_template = str_replace("!nome_fisico!",$nome_a,$html_template);
	$html_template = str_replace("!notificacao!",$notificacao_msg,$html_template);
					
	//#################### INICIO ENVIA EMAIL ##################>>>>>>>>>>>>>>>>
	$opts = array(
		'http'=>array('header'=>"Content-type: application/x-www-form-urlencoded", 'method'=>'POST', 'content'=>http_build_query(array(
			//CONFIGURAÇÕES
			'MAIL_HOST' => SYS_MAIL_HOST,
			'MAIL_TIPO' => SYS_MAIL_TIPO,// SMTP ("","ssl","tls")
			'MAIL_PORTA' => SYS_MAIL_PORTA,//465
			'MAIL_USER' => SYS_MAIL_USER,
			'MAIL_PASS' => SYS_MAIL_PASS,
			'MAIL_NOME' => SYS_MAIL_NOME,
			'MAIL_EMAIL' => SYS_MAIL_EMAIL,
			'MAIL_DEBUG' => "0",//ativar debug -- 1 = Erros e mensagens, 2 = Apenas mensagens, SMTP::DEBUG_SERVER
			//DADOS DO ENVIO
			'SEND_NOME' => primeiro_nome($nome_a),
			'SEND_EMAIL' => $email_a,
			'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, Decisão Credenciamento',array("nome"=>primeiro_nome($nome_a)))." - ".SYS_CLIENTE_NOME_RESUMIDO,
			'SEND_BODY' => $html_template
			))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
	); $context = stream_context_create($opts);
	//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
	$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
	echo "<br>contentResp:".$contentResp;
	if($contentResp != "1"){
		$cMSG->addMSG("INFO",'<br><br>'.$class_fLNG->txt(__FILE__,__LINE__,'Opss... Ouve um problema ao enviar o email de notificação! <br><br><b>Por favor, tente novamente mais tarde!').' ;)<b>');
		//echo 'Mailer Error: ' . $mail->ErrorInfo;
	}else{
		$cMSG->addMSG("SUCESSO",'<br><br>'.$class_fLNG->txt(__FILE__,__LINE__,'Notificação por e-mail enviada com sucesso!').' ;)<b>');
	}
	
	
	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_usuarios", "credenciamento", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO",$msg_retorno."<a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"".$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')."\"><i class=\"icon-search\"></i></a>");






	
}//fim do if($id_a >= "1"){ //############# FIM ELSE - ALTERA REGISTRO |-










}//fim if($verificaRegistro == "1"){//############################################################### FIM VERIFICACOES||<
































//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "U.id,U.nome,U.cargo,U.doc_nome,U.doc_numero,U.sync,L.status"; //campos da tabela
	$SQL_tabela = "sys_usuarios U, sys_login L"; //tabela
	$SQL_where = "U.id = L.usuarios_id AND U.cargo IN ('CLINIQUE MÉDICALE','AUTO-ÉCOLE')"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "U.id";//campo de ordenar
	$ORDEM = "DESC";// ASC ou DESC
	$SQL_group = "GROUP BY U.id"; // agrupar o resultado GROUP BY

//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio;//vars get para reenvio no paginaçao AJAX
	$AJAX_GET_OR = "ORDEM_C=$ORDEM_C&ORDEM=$ORDEM&";//vars get para reenvio no paginaçao AJAX com ORDER
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<

//verifica tab_id
	if($tab_id == "0"){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " L.`status` = '3' "; //condição 
	}




//pega vars de busca
	unset($filtro_b);
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["doc_tipo_b"])){       				 $doc_tipo_b = getpost_sql($_GET["doc_tipo_b"]);       		   		  }else{ $doc_tipo_b = "";    		    }
	if(isset($_GET["doc_numero_b"])){       			 $doc_numero_b = getpost_sql($_GET["doc_numero_b"]);       		   	  }else{ $doc_numero_b = "";    		    }
	if(isset($_GET["datan_b"])){       					 $datan_b = getpost_sql($_GET["datan_b"]);       		     		  }else{ $datan_b = "";    		    }
	if(isset($_GET["tipo_cfc_b"])){       				 $tipo_cfc_b = getpost_sql($_GET["tipo_cfc_b"]);       		     	  }else{ $tipo_cfc_b = "";    		    }
	if(isset($_GET["tipo_medico_b"])){       			 $tipo_medico_b = getpost_sql($_GET["tipo_medico_b"]);       		  }else{ $tipo_medico_b = "";    		    }






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){ $filtro_marca[] = $rapida_b;
		$filtro_b["rapida_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca rápida por !!busca!!',array("busca"=>'<b>'.$rapida_b.'</b>'));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`nome` LIKE '%$rapida_b%' OR U.`doc_numero` LIKE '%$rapida_b%' OR U.`cargo` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por rapida_b
if($doc_numero_b != ""){ $filtro_marca[] = $doc_numero_b;
		$filtro_b["doc_numero_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca por !!doc!! !!num!!',array("doc"=>'<b>'.$doc_tipo_b.'</b>',"num"=>'<b>'.$doc_numero_b.'</b>'));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`doc_nome` = '$doc_tipo_b' AND U.`doc_numero` = '$doc_numero_b' ) "; //condição 
		$AJAX_GET .= "doc_numero_b=$doc_numero_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por rapida_b
if($datan_b != ""){ $filtro_marca[] = $datan_b;
		$filtro_b["datan_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento !!busca!!',array("busca"=>'<b>'.$datan_b.'</b>'));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`datan` = '".data_mysql($datan_b)."' ) "; //condição 
		$AJAX_GET .= "datan_b=$datan_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){ $filtro_marca[] = $datai_b; $filtro_marca[] = $dataf_b;
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>'<b>$datai_b</b>',"dataf"=>'<b>$dataf_b</b>'));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>'<b>$datai_b</b>',"dataf"=>'<b>$dataf_b</b>')); }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " V.time >= '$timei_a' AND V.time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro




//verifica se recebeu uma solicitação de busca por status_b
if($status_b != ""){
		$filtro_b["status_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Status')." <b>".legVerificacaoCredenciamento($status_b)."</b>"; $filtro_marca[] = legVerificacaoCredenciamento($status_b);
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "L.status = '$status_b'"; //condição 
		$AJAX_GET .= "status_b=$status_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por status_b



//verifica se recebeu uma solicitação de busca por tipo_cfc_b
if($tipo_cfc_b != ""){ $filtro_marca[] = $tipo_cfc_b;
		$filtro_b["tipo_cfc_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Tipo')." <b>".$tipo_cfc_b."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`cargo` = '$tipo_cfc_b' ) "; //condição 
		$AJAX_GET .= "tipo_cfc_b=$tipo_cfc_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por tipo_cfc_b


//verifica se recebeu uma solicitação de busca por tipo_medico_b
if($tipo_medico_b != ""){ $filtro_marca[] = $tipo_medico_b;
		$filtro_b["tipo_medico_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Tipo')." <b>".$tipo_medico_b."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`cargo` = '$tipo_medico_b' ) "; //condição 
		$AJAX_GET .= "tipo_medico_b=$tipo_medico_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por tipo_cfc_b



if(ceil(count($filtro_b)) != "2" and $tab_id == "1"){
	$SQL_where .= " AND U.id = '0'";
?>
	<div class="alert alert-warning">
    	<b><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></b><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Para buscar é necessário utilizar algum filtro.')?>
    </div>
<?php
	exit(0);	
}//if(ceil(count($filtro_b)) <= "0"){




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
			<div class="message"><span class="caret"></span><span class="name"><?=$class_fLNG->txt(__FILE__,__LINE__,'Resultado da busca realizada no(s) iten(s)')?></span>
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
				<span class="time"> <?=$class_fLNG->txt(__FILE__,__LINE__,'!!npaginas!! registros encontrados',array("npaginas"=>'<b>'.$n_paginas.'</b>'))?></span>
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
	
	//atualiza dados de tabs
	$('.tabs-<?=$INC_FAISHER["div"]?>').removeClass('active');
	$('#<?=$tab_id?>-<?=$INC_FAISHER["div"]?>').addClass('active');
	$('#tab_id<?=$INC_FAISHER["div"]?>').val('<?=$tab_id?>');
	//conta registros aba
	$('#cont-0<?=$INC_FAISHER["div"]?>').html('(<?=fSQL::SQL_CONTAGEM("sys_usuarios U, sys_login L", "U.id = L.usuarios_id AND L.status = '3'")?>)');
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
				<?php $c_or = "U.id"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">#</th>
				<?php $c_or = "U.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome')?></th>
				<?php $c_or = "U.doc_numero"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento')?></th>
				<?php $c_or = "U.cargo"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Função')?></th>
				<?php $c_or = "L.status"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
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
	$status = $linha1["status"];
	$sync = $linha1["sync"];
	$nome = $linha1["nome"];
	$doc_nome = $linha1["doc_nome"];
	$doc_numero = $linha1["doc_numero"];
	$cargo = $linha1["cargo"];


	$status_leg = legVerificacaoCredenciamento($status);
	if($status == "3"){ $status_leg = "<b>".$status_leg."</b>"; }
?>
										<tr>
											<td class="sVisu"><b><?=$id_a?></b></td>
											<td class="sVisu"><b><?=$nome?></b></td>
											<td class="sVisu"><i><?=$doc_nome?> - <?=$doc_numero?></i></td>
											<td class="sVisu"><?=$cargo?></td>                                            
											<td class="sVisu"><?=$status_leg?><br><?=difHoraTime($sync)?></td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
												<?php if($status == "3" and $cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Editar')?>"><i class="icon-edit"></i></a><?php }?>
                                          </td>
										</tr>
<?php 

}//fim do while de padinação SQL
	}//fim do if($n_paginas >= "1"){ de paginacao SQL

?>
									</tbody>
								</table>
<?php if($n_paginas <= "0"){?>
	<div style="height:150px; padding:20px 0 0 10px; clear:both;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum resultado correspondente à sua pesquisa.')?></div>
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
	if(isset($_GET["tab_id"])){			$tab_id = getpost_sql($_GET["tab_id"]);		}else{ $tab_id = "0";		}
	
	
	$pCadastro = "OFF";//desliga botão NOVO
	//include de padrao
	$INC_VAR["tabSel"] = $tab_id;//adicionar array de guias [tab]
	$INC_VAR["tabs"][] = '0[,]<i class="icon-time"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Aguardando').' <span id="cont-0'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '1[,]<i class="icon-ok-sign"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Finalizados').' <span id="cont-1'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["buscaAvancada"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaDireta"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaRapida"] = "OFF";
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>