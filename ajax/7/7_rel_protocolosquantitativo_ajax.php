<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";



//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<










//++++++++++++++++++++++AJAX QUE EXIBE [[BUSCA DIRETA]] ----------------------------########################################-------------------------------------->>>
//$status_data = '{id: "0", text: "<b>EM ATENDIMENTO</b>"}';
if($ajax == "buscaDireta"){
    //id temp para registro de array
	$formBusca = "formBuscDir".$INC_FAISHER["div"];
	
	
?>
<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
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
			btbusca<?=$INC_FAISHER["div"]?>('exibir');
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
	btbusca<?=$INC_FAISHER["div"]?>('exibir');
});
$("#<?=$formBusca?> .limpaInput").on("change", function(e){	btbusca<?=$INC_FAISHER["div"]?>('exibir'); });
function pCbusca<?=$INC_FAISHER["div"]?>(v_id){
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.fadeIn();
}
function lCbusca<?=$INC_FAISHER["div"]?>(v_id){
	$('#<?=$formBusca?> #'+v_id).val('');
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.hide();
}
function btbusca<?=$INC_FAISHER["div"]?>(v_acao){
	if(v_acao == "exibir"){
		$('#inf_bd<?=$INC_FAISHER["div"]?>').hide(); $('#bt_bd<?=$INC_FAISHER["div"]?>').fadeIn();
	}else{
		$('#bt_bd<?=$INC_FAISHER["div"]?>').hide(); $('#inf_bd<?=$INC_FAISHER["div"]?>').fadeIn(2000);
	}
}

//buscas avancada
function bAvancada<?=$INC_FAISHER["div"]?>(){
	var v_get = '';//pega dados do tabs
	v_get = v_get+'&var_extra='+$("#var_extra<?=$INC_FAISHER["div"]?>").val();//var extra
	<?php $idCJ = "perfil_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	<?php $idCJ = "data_aberturai_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_aberturaf_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_synci_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_syncf_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }	
	<?php $idCJ = "tipo_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	<?php $idCJ = "status_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	<?php $idCJ = "usuario_id_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }

	btbusca<?=$INC_FAISHER["div"]?>('ocultar');
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Filtrando dados...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "perfil_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }
	<?php $idCJ = "data_abertura_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('data_aberturai_b'); lCbusca<?=$INC_FAISHER["div"]?>('data_aberturaf_b'); }
	<?php $idCJ = "data_sync_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('data_synci_b'); lCbusca<?=$INC_FAISHER["div"]?>('data_syncf_b'); }	
	<?php $idCJ = "tipo_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }	
	<?php $idCJ = "status_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }
	<?php $idCJ = "usuario_id_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }
	btbusca<?=$INC_FAISHER["div"]?>('ocultar');
	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">        
  

        

        
	<div class="control-group row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Unidade')?></label>
			<div class="controls select2-full">
<?php


	///VERIFICA PERMISSÕES DE ACESSO
	$perfil_data = "";
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("id,origem_id,nome,apelido", "sys_perfil", "id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "","1");
		while($linha = fSQL::FETCH_ASSOC($resuM)){			
			$perfil_data = '{id: "'.$linha["origem_id"].'", text: "<i class='.fGERAL::icoPerfil($linha["id"]).'></i> <b>'.$linha["nome"].'</b> ('.$linha["apelido"].')"}';	
		}//fim while
	}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){

?>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #perfil_b').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Unidade >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=selOrigem<?php if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){ echo '&atual=1'; }?>&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($perfil_data != ""){?>$("#<?=$formBusca?> #perfil_b").select2("data", <?=$perfil_data?>); $("#<?=$formBusca?> #perfil_b").select2("readonly", true);<?php }?>
	$("#<?=$formBusca?> #perfil_b").on("change", function(e){ btbusca<?=$INC_FAISHER["div"]?>('exibir'); });	
});
</script>
<input type='hidden' value="" name='perfil_b' id='perfil_b' style=" width:100%;"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status atual do processo')?></label>
			<div class="controls select2-full">
<input type='hidden' value="" name='status_b' id='status_b' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #status_b').select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar um status >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=protocoloStatus&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($status_data != ""){?>$("#<?=$formBusca?> #status_b").select2("data", <?=$status_data?>); <?php }?>
	$("#<?=$formBusca?> #status_b").on("change", function(e){ btbusca<?=$INC_FAISHER["div"]?>('exibir'); });
});
</script>
			</div>
		</div>
        
		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Operador')?></label>
			<div class="controls select2-full">

<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #usuario_id_b').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Operador >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=usuariosTodos&status=1&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	$("#<?=$formBusca?> #usuario_id_b").on("change", function(e){ btbusca<?=$INC_FAISHER["div"]?>('exibir'); });	
});
</script>
<input type='hidden' value="" name='usuario_id_b' id='usuario_id_b' style=" width:100%;"/>
			</div>
		</div>        
		
	</div><!-- End .span6 -->
    
	<div class="span6">

		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo de solicitação')?></label>
			<div class="controls select2-full">
<input type='hidden' value="" name='tipo_b' id='tipo_b' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #tipo_b').select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar um tipo de solicitação >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=protocoloTipo&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	$("#<?=$formBusca?> #tipo_b").on("change", function(e){ btbusca<?=$INC_FAISHER["div"]?>('exibir'); });
});
</script>
			</div>
		</div>

		<div class="control-group">
			<label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de abertura')?></label>
			<div class="controls">
				<div class="input-append"><input type="text" name="data_aberturai_b" id="data_aberturai_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Data inicial')?>" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div> <?=$class_fLNG->txt(__FILE__,__LINE__,'até')?> 
				<div class="input-append"><input type="text" name="data_aberturaf_b" id="data_aberturaf_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Data final')?>" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de interação')?></label>
			<div class="controls">
				<div class="input-append"><input type="text" name="data_synci_b" id="data_synci_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Data inicial')?>" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div> <?=$class_fLNG->txt(__FILE__,__LINE__,'até')?> 
				<div class="input-append"><input type="text" name="data_syncf_b" id="data_syncf_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Data final')?>" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
			</div>
		</div>        
	</div><!-- End .span6 -->
	</div><!-- End .row-fluid -->
        

    
	<div class="span12">
		<div class="form-actions">
			<div style="display:none; color:#F30;" id="bt_bd<?=$INC_FAISHER["div"]?>"><button type="button" class="btn btn-primary btn-large enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Aplicar filtro agora')?></button> *<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique em filtrar para exibir os resultados (a lista abaixo ainda não foi atualizada).')?></div>
			<span class="help-block" id="inf_bd<?=$INC_FAISHER["div"]?>"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Utilize as opções acima para filtrar/modificar o resultado dos dados.')?></span>
		</div>
	</div>
</form>
<?php	
	

}//fim ajax  -------------------------------------------- <<<








































if($ajax == "detalhesProcesso"){
	$id_a = $_GET["id"];
	
	$linha = fSQL::SQL_SELECT_ONE("*","axl_processo","id = '".$id_a."'");
	$ano = $linha["ano"];
	$mes = $linha["mes"];	
	$dia = $linha["dia"];
	$code = $linha["code"];	
	$candidato_fisico_id_a = $linha["candidato_fisico_id"];
	$pgto_id_a = $linha["pgto_id"];
	$tipo_servico_a = $linha["tipo_servico"];	
	$origem_id_a = $linha["origem_id"];	
	$servico_id_a = $linha["servico_id"];
	$time_a = $linha["time"];
	$user_a = $linha["user"];
	$status_a = $linha["status"];		
	$coleta_id_a = $linha["coleta_id"];		
	$coleta_time_a = $linha["coleta_time"];		
	$emissao_time_a = $linha["emissao_time"];		
	$entrega_data_a = $linha["entrega_data"];			
	$motivo_id_a = $linha["motivo_id"];
	$obs_geral_a = $linha["obs_geral"];	
	$validade_time_a = $linha["validade_time"];				
	$validade_anos_a = $linha["validade_anos"];					
	$cancelamento_suspensao_id_a = $linha["cancelamento_suspensao_id"];	

	$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$ano."/".completa_zero($mes,"2")."/".completa_zero($dia,"2")."/".$code."/";
	



	if($coleta_id_a >= "1"){
		$linha = fSQL::SQL_SELECT_ONE("abis_status,abis_status_acao","axl_coleta_biometrica","id = '".$coleta_id_a."' AND origem_id = '".$origem_id_a."'");
		$coleta_abis_status = $linha["abis_status"];	
		$coleta_abis_status_acao = $linha["abis_status_acao"];		
	}//if($coleta_id_a >= "1"){
	
	$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome,datan,nacionalidade,grupo_sanguineo,suspensao_i,suspensao_f,sync","cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	$pessoa_n = "<span class='display-plus'>".$cVLogin->popDetalhes("C",$candidato_fisico_id_a,"3_con_candidatofisico","".$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO')).SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($candidato_fisico_id_a,$linha2["code"])." - <b>".$linha2["nome"]."</b><br>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>'."</span>";
	$pessoa_n .= $class_fLNG->txt(__FILE__,__LINE__,'Sobrenome').": <b>".$linha2["sobrenome"]."</b>";			
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento').": <b>".data_mysql($linha2["datan"]).", ".calcular_idade($linha2["datan"])." anos</b>";			
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nacionalidade').": <b>".maiusculo($linha2["nacionalidade"])."</b>";
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Grupo Sanguineo').": <b>".$linha2["grupo_sanguineo"]."</b>";						
	if($linha2["suspensao_i"] >= "1"){
		$dataf = date("d/m/Y",$linha2["suspensao_f"]);
		if($linha2["suspensao_f"] == "99999999"){ $dataf = $class_fLNG->txt(__FILE__,__LINE__,'indeterminado'); }
		$pessoa_n .= "<br><span style='color:red;'>".$class_fLNG->txt(__FILE__,__LINE__,'Suspenso de !!datai!! até !!dataf!!',array("datai"=>date("d/m/Y",$linha2["suspenso_i"]),"dataf"=>$dataf)).": <b>".$linha2["grupo_sanguineo"]."</b>";						
	}//if($linha2["suspensao_i"] >= "1"){
	
	
	$pgto_id_n = "";
	if($pgto_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("cod_banco,numero,valor,time_deposito","axl_pgto_banco","id = '$pgto_id_a'");
		$pgto_id_n = $class_fLNG->txt(__FILE__,__LINE__,'Banco').": ".legBanco($linha2["cod_banco"]);
		$pgto_id_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nº pagamento')." ".$linha2["numero"]." - GNF $ ".formataValor($linha2["valor"]);		
		$pgto_id_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'depósito realizado em !!data!!',array("data"=>date("d/m/Y H:i", $linha2["time_deposito"])));
	}//if($pgto_id_a >= "1"){
	
	$linha2 = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id_a."'");
	$origem_id_n = $linha2["nome"];
	
	//busca dados
	$linha2 = fSQL::SQL_SELECT_ONE("nome,informacoes","adm_protocolo_tipo", "id = '".$servico_id_a."'");	
	$servico_id_n = $linha2["nome"];	
	$informacoes_i = arrayDB($linha2["informacoes"]);	
	
	$processo_n = "<div style='float:left;'><i style='font-size: 40px;' class='".categoriaServicoIco($tipo_servico_a)."'></i></div> ".maiusculo(categoriaServicoLeg($tipo_servico_a))." - ".$servico_id_n;	
			
	$status_n = processoStatusLeg($status_a);

	$log_n = $class_fLNG->txt(__FILE__,__LINE__,'Processo iniciado em !!data!!, por !!user!!',array("data"=>date("d/m/Y H:i",$time_a),"user"=>$user_a));

	$coleta_n = "";	if($coleta_time_a >= "1"){ $coleta_n = date("d/m/Y H:i",$coleta_time_a); }
	$emissao_n = ""; if($emissao_time_a >= "1"){ $emissao_n = date("d/m/Y H:i",$emissao_time_a); }	
	$validade_n = ""; if($validade_time_a >= "1"){ $validade_n = $class_fLNG->txt(__FILE__,__LINE__,'Válido por !!anos!! anos, vence em:',array("anos"=>$validade_anos_a))." ".date("d/m/Y",$validade_time_a); }	
	$entrega_data_n = ""; if($entrega_data_a != "0000-00-00"){ $entrega_data_n = date("d/m/Y",strtotime($entrega_data_a)); }	
	
	//busca dados
	$motivo_id_n = "";
	if($motivo_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("etapa,descricao","axl_motivo_cancelamento", "id = '".$motivo_id_a."'");	
		$motivo_id_n = legEtapaCancelamento($linha2["etapa"]);
		if($linha2["descricao"] != ""){
			$motivo_id_n .= " - ".$linha2["descricao"];
		}
	}//if($motivo_id_a >= "1"){

	$arrColeta = array(); $coleta_dir = "";
	if($coleta_id_a >= "1"){
		$arrColeta = fSQL::SQL_SELECT_ONE("*","axl_coleta_biometrica","id = '".$coleta_id_a."'");
		$coleta_dir = VAR_DIR_FILES."files/tabelas/coleta/".$arrColeta["ano"]."/".completa_zero($arrColeta["mes"],"2")."/".completa_zero($arrColeta["dia"],"2")."/".$coleta_id_a."/";	
	}
	//echo $coleta_dir;
	
	
	
	$eventosArray = fPROCESSO::getEventos($id_a,$processo_dir,"0","","30");//getEventos() - CARREGA ARRAY DE EVENTOS	
		
	$cMSG->imprimirMSG();//imprimir mensagens criadas		
	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;	
?>
<form class="form-horizontal form-bordered form-validate" onSubmit="return false;">
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo processo')?></label>
                <div class="controls display-plus">
                  <?=$processo_n?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Origem')?></label>
                <div class="controls">
                  <?=$origem_id_n?>
                </div>
            </div> 
            <?php if($pgto_id_n != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Pagamento')?></label>
                <div class="controls ">
                  <?=$pgto_id_n?>
                </div>
            </div>    
            <?php }//if($pgto_id_n != ""){?>   
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitante')?></label>
                <div class="controls">
                  <?=$pessoa_n?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></label>
                <div class="controls display-plus">
                  <?=$status_n?>
                </div>
            </div> 
            <?php if($motivo_id_n != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo')?></label>
                <div class="controls display-plus">
                  <?=$motivo_id_n?>
                </div>
            </div> 
            <?php }//if($coleta_n != ""){?>  
            <?php if($obs_geral_a != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Observação geral')?></label>
                <div class="controls display-plus">
                  <?=$obs_geral_a?>
                </div>
            </div> 
            <?php }//if($obs_geral_a != ""){?>  
            <?php if($emissao_n != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Emissão')?></label>
                <div class="controls">
                  <?=$emissao_n?>
                </div>
            </div> 
            <?php }//if($emissao_n != ""){?>    
            <?php if($validade_n != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Validade')?></label>
                <div class="controls">
                  <?=$validade_n?>
                </div>
            </div> 
            <?php }//if($validade_n != ""){?>                                    
            <?php if($coleta_n != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Coleta biométrica')?></label>
                <div class="controls">
                  <?=$coleta_n?>
                </div>
            </div>                            
            <?php }//if($coleta_n != ""){?>            
            <?php if($emissao_n != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Emissão')?></label>
                <div class="controls">
                  <?=$emissao_n?>
                </div>
            </div>                            
            <?php }//if($emissao_n != ""){?>                        
            <?php if($entrega_data_n != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Entrega')?></label>
                <div class="controls">
                  <?=$entrega_data_n?>
                </div>
            </div>                            
            <?php }//if($entrega_data_n != ""){?>                        
            
            <?php 
			if($cancelamento_suspensao_id_a >= "1"){
				$linhaxxx = fSQL::SQL_SELECT_ONE("id,acao,motivo,motivo_descricao,data_p,status,data_c,data_p,sync","axl_cancelamento_suspensao","id = '".$cancelamento_suspensao_id_a."'");
				if($linhaxxx["status"] <= "1"){
					$leg = motivoCancelamento($linhaxxx["motivo"]);
					
					if($linhaxxx["status"] == "0"){ $leg .= " (".$class_fLNG->txt(__FILE__,__LINE__,'Aguardando análise').")"; }
					if($linhaxxx["status"] == "1"){ $leg .= " (".$class_fLNG->txt(__FILE__,__LINE__,'Solicitação aprovada').")"; }
					
					$leg .= '<a href="#" class="btn btn-default" onclick="pmodalHtml(\'<i class=icon-search></i> '.$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DA SOLICITAÇÃO').'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=detalhesAcao&id='.$linhaxxx["id"].'\');"> <i class="icon-external-link"></i></a>';
					
					if($linhaxxx["motivo_descricao"] != ""){ $leg .= "<br><small>".$linhaxxx["motivo_descricao"]."</small>"; }
					if($linhaxxx["data_p"] >= "1"){
						$dataf = date("d/m/Y",$linhaxxx["data_p"]);
						if($linhaxxx["data_p"] == "99999999"){ $dataf = $class_fLNG->txt(__FILE__,__LINE__,'Indeterminado'); }
						
						if($linhaxxx["status"] == "1"){ 
							$leg .= "<br><small>".$class_fLNG->txt(__FILE__,__LINE__,'!!tipo!! pelo período: de !!datai!! até !!dataf!!',array("tipo"=>acaoProcessoLeg($linhaxxx["acao"]),"datai"=>date("d/m/Y",$linhaxxx["sync"]),"dataf"=>$dataf))."</small>";
						}else{//if($linhaxxx["status"] == "1"){
							$leg .= "<br><small>".$class_fLNG->txt(__FILE__,__LINE__,'!!tipo!! pelo período: até !!dataf!!',array("tipo"=>acaoProcessoLeg($linhaxxx["acao"]),"dataf"=>$dataf))."</small>";
						}//}else{//if($linhaxxx["status"] == "1"){
					}//if($linhaxxx["data_p"] >= "1"){
			?>
            <div class="control-group">
                <label class="control-label" style="color:red;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitação de !!tipo!!',array("tipo"=>acaoProcessoLeg($linhaxxx["acao"])))?></label>
                <div class="controls">
                  <?=$leg?>
                </div>
            </div>                            
            <?php 
				}//if($linhaxxx["status"] <= "1"){
			}//if($cancelamento_suspensao_id_a >= "1"){
			?>                                    
            
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Log')?></label>
                <div class="controls">
                  <?=$log_n?>
                  <br>
                  
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_log">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" style="padding:3px !important;" data-toggle="collapse" data-parent="#ac_log" href="#acc_log" id="a_log" onclick="return false;">
											<?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?>
										</a>
									</div>
									<div id="acc_log" class="accordion-body collapse" style="height:0px;">
										<div class="accordion-inner" style="padding:0;">                  
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Data/Hora')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Evento')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Descrição')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Usuário')?></th>                                            
										</tr>
									</thead>
									<tbody>
<?php                                    
$cont = "0";
//monta array de dados
$array = $eventosArray["lista"];
$cont_ARRAY = ceil(count($array));
if($cont_ARRAY >= "1"){
	foreach($array as $pos => $valor){
		if($valor != ""){
			$cont++;                                                      
?>
										<tr>
											<td><?=date('d/m/Y H:i',$valor["time"])?>h</td>
											<td><?=$valor["evento"]?></td>
											<td><?=$valor["descricao"]?></td>
											<td><?=sentenca($valor["user"])?><br><?=$valor["cargo"]?></td>
											
										</tr>
<?php 
		}//if($valor != ""){
	}//fim foreach
}//fim if($cont_ARRAY >= "1"){
?>             
									</tbody>
								</table>	
                                        </div><!-- End .accordion-inner -->
									</div>
								</div>
                            <a href="#" onclick="$('#a_log').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> - <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a>
							</div><!-- End .accordion-widget ----------------------------------------------- -->                                       
                </div>
            </div>          
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosatend".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'DADOS DO ATENDIMENTO');// titulo
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
<?php
		if($informacoes_i != ""){
			//monta array
			unset($array); $array = explode(".",$informacoes_i);
			$cont_ARRAY = ceil(count($array));
			//listar item ja cadastrados
			if($cont_ARRAY >= "1"){
				foreach ($array as $pos => $tipo_id){
					if($tipo_id != ""){
						//pegar info do campo
						$linha = fSQL::SQL_SELECT_ONE("tipo_campo","adm_protocolo_tipo_inf","id = '".$tipo_id."'");
						$tipo_campo = $linha["tipo_campo"];
						
						if($tipo_campo == "99"){//CAMPO DE CATEGORIA
							$categorias = "";
							$resu = fSQL::SQL_SELECT_SIMPLES("nome,valor","axl_processo_campos","processo_id = '".$id_a."' AND tipo_campo = '".$tipo_campo."'");
							while($linha = fSQL::FETCH_ASSOC($resu)){
								if($categorias != ""){ $categorias .= "<br>"; }
								$categorias .= $linha["nome"];
							}						
?>
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Categoria(s)')?></label>
                                                <div class="controls">
													<?=$categorias?>
                                                </div>
                                            </div> 
<?php
						}//if($tipo_id == "99"){//CAMPO DE CATEGORIA
						
						

						if($tipo_campo == "1" || $tipo_campo == "3"){//inputs
							$linha = fSQL::SQL_SELECT_ONE("nome,valor","axl_processo_campos","processo_id = '".$id_a."' AND tipo_campo = '".$tipo_campo."' AND tipo_id = '".$tipo_id."'");
?>
                                            <div class="control-group">
                                                <label class="control-label"><?=sentenca($linha["nome"])?></label>
                                                <div class="controls">
													<?=$linha["valor"]?>
                                                </div>
                                            </div> 
<?php
						}//if($tipo_id == "99"){//CAMPO DE CATEGORIA	
						
						
						
						
						
						
						if($tipo_campo == "80"){//restrições médicas
							$linha = fSQL::SQL_SELECT_ONE("nome,valor","axl_processo_campos","processo_id = '".$id_a."' AND tipo_campo = '".$tipo_id."' AND tipo_id = '".$tipo_id."'");
							$valor = $linha["valor"];
							
							$restricoes = "-";
							$arr = explode(",",$valor);
							foreach ($arr as $restricao_id){							
								$linhaxxx = fSQL::SQL_SELECT_ONE("legenda","axl_restricoes_medicas","id = '".$restricao_id."'");
								if($linhaxxx["legenda"] != ""){
									if($restricoes != ""){ $restricoes .= "<br>"; }
									$restricoes .= $linhaxxx["legenda"];
								}
							}//fim foreacah
							
?>
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Restrições médicas')?></label>
                                                <div class="controls">
													<?=$restricoes?>
                                                </div>
                                            </div> 
<?php
						}//if($tipo_id == "99"){//CAMPO DE CATEGORIA													
						
						
						
						
						
						if($tipo_campo == "9"){//inputs
							$cont = "0";
							$linha = fSQL::SQL_SELECT_ONE("nome,valor","axl_processo_campos","processo_id = '".$id_a."' AND tipo_campo = '".$tipo_campo."' AND tipo_id = '".$tipo_id."'");							
							if($linha["valor"] == ""){ continue; }
							$caminho_file = $processo_dir."files/".$linha["valor"];
							
?>
                                            <div class="control-group">
                                                <label class="control-label"><?=sentenca($linha["nome"])?></label>
                                                <div class="controls">
													<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$cont?>]" id="iimg_<?=$cont?>"><?=$cVLogin->icoFile($caminho_file, "")?></a>
                                                    <a href="#" onclick="$('#iimg_<?=$cont?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
                                                </div>
                                            </div> 
<?php
						}//if($tipo_id == "99"){//CAMPO DE CATEGORIA							
						
?>									
<?php
					}//if($tipo_id != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){
		}//if($informacoes_a != ""){	
?>	
                                        
                                        </div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->           
                            
                            
                            
                            
<?php if($coleta_id_a >= "1"){?>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosbiometria".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'DADOS BIOMÉTRICOS');// titulo
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

<?php
?>                                        
                                        
                                                    <table class="table table-hover table-nomargin table-bordered" style="border:1px black solid; border-bottom:0px;">
                                                    	<thead>
                                                        	<tr>
                                                            	<th style="width:100px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto')?></th>
                                                            	<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados')?></th>                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        	<tr>
                                                            	<td style="text-align:center;">
                                                                	<a href="img.php?<?=$cVLogin->imgFile($coleta_dir."foto.jpg", "full")?>" rel="prettyPhoto[gallery<?=$cont?>]" id="iimg_<?=$cont?>" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para expandir')?>"><?=$cVLogin->icoFile($coleta_dir."foto.jpg", "")?></a><br>
                                                                	<a href="img.php?<?=$cVLogin->imgFile($coleta_dir."assinatura.jpg", "full")?>" rel="prettyPhoto[gallery<?=$cont?>]" id="iimg_<?=$cont?>" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para expandir')?>"><?=$cVLogin->icoFile($coleta_dir."assinatura.jpg", "")?></a>
                                                                </td>
																<td><?=$pessoa_n?></td>                                                               	                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-hover table-nomargin table-bordered" style="border:1px black solid; border-top:0px;">
															<tr>
                                                            	<td style="width:100px; border-right:red solid 1px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Direito')?></td>
												<?php 
												for($posicao=1; $posicao <= 5; $posicao++){
													$dedo_file = $coleta_dir."dedo".$posicao.".jpg";
												?>
																	<td style="text-align:center; padding:0px; margin:0px; border:red solid 1px; border-left:0px; cursor:pointer;"><span style="float:left; font-size:9px; padding-left:1px;"><?=$posicao?></span><span style="float:right; font-size:9px;padding-right:1px;"><?=$arrColeta["nfiq".$posicao]?></span><a href="img.php?<?=$cVLogin->imgFile($dedo_file, "full")?>" rel="prettyPhoto[gallery<?=$cont?>]" id="iimg_<?=$cont?>" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para expandir')?>"><?=$cVLogin->icoFile($dedo_file, "")?></a><br><?=legDedo($posicao)?></td>
												<?php }//for($posicao=1; $posicao <= 5; $posicao++){?>                                                
                                                            </tr>
															<tr>
                                                            	<td style="width:100px; border-right:red solid 1px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Esquerdo')?></td>
                                                            	
												<?php 
												for($posicao=6; $posicao <= 10; $posicao++){
													$dedo_file = $coleta_dir."dedo".$posicao.".jpg";
												?>
																	<td style="text-align:center; padding:0px; margin:0px; border:red solid 1px; border-left:0px; cursor:pointer;"><span style="float:left; font-size:9px; padding-left:1px;"><?=$posicao?></span><span style="float:right; font-size:9px;padding-right:1px;"><?=$arrColeta["nfiq".$posicao]?></span><a href="img.php?<?=$cVLogin->imgFile($dedo_file, "full")?>" rel="prettyPhoto[gallery<?=$cont?>]" id="iimg_<?=$cont?>" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para expandir')?>"><?=$cVLogin->icoFile($dedo_file, "")?></a><br><?=legDedo($posicao)?></td>
												<?php }//for($posicao=6; $posicao <= 10; $posicao++){?>                                                
                                                            </tr>                                                            
                                                        </tbody>
                                                    </table>                                        
                                        
                                        </div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->                                          
                            
<?php }//if($coleta_id_a >= "1"){?>                            

            <div class="form-actions">
    			<button type="button" class="btn btn-large" onclick="pmodalDisplay('hide');return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
            </div>                              
                            
</form>
<?php	
}//detalhesProcesso








































if($ajax == "detalhesCandidato"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	$id_a = $_GET["id"];
	$arrCandidato = fSQL::SQL_SELECT_ONE("*","cad_candidato_fisico","id = '".$id_a."'");
	$arrHabilitacao = fSQL::SQL_SELECT_ONE("*","cad_candidato_fisico_habilitacao","candidato_fisico_id = '".$id_a."'");	
	
	$arrDoc = docPessoaFisica($id_a);
	$linha = fSQL::SQL_SELECT_ONE("celular","cad_candidato_fisico_celular","candidato_fisico_id = '".$id_a."' AND principal = '1'");
	$celular = $linha["celular"];
	
	$linha = fSQL::SQL_SELECT_ONE("email","cad_candidato_fisico_email","candidato_fisico_id = '".$id_a."' AND principal = '1'");
	$email = $linha["email"];	
	
	$arrEnd = fSQL::SQL_SELECT_ONE("*","cad_candidato_fisico_endereco","candidato_fisico_id = '".$id_a."'");	
	$linha = fSQL::SQL_SELECT_ONE("cidade_nome","combo_cidades","id = '".$arrEnd["cidade_id"]."'");
	$endereco = $arrEnd["bairro"].", ".$arrEnd["quadra"].", ".$linha["cidade_nome"]."/".$arrEnd["uf"]." - ".$arrEnd["pais"];
	if($arrEnd["logradouro"] != ""){ $endereco = $arrEnd["logradouro"].", ".$endereco; }
	$endereco .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Referência').": ".$arrCandidato["referencia"];
	if($arrCandidato["codigo_energia"] != ""){ $endereco .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Código energia').": ".$arrCandidato["codigo_energia"]; }
	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;	
?>
<form class="form-horizontal form-bordered form-validate" onSubmit="return false;">
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></label>
                <div class="controls display-plus">
                  <?=SYS_CONFIG_RM_SIGLA?> <?=$arrCandidato["code"]?> - <?=$arrCandidato["nome"]?> <?=$arrCandidato["sobrenome"]?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
                <div class="controls">
                  <?=data_mysql($arrCandidato["datan"]).", ".$class_fLNG->txt(__FILE__,__LINE__,'!!idade!! anos',array("idade"=>calcular_idade($arrCandidato["datan"])))?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome da mãe')?></label>
                <div class="controls ">
                  <?=$arrCandidato["mae"]?>
                </div>
            </div>    
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento')?></label>
                <div class="controls display">
                  <?=$arrDoc["nome"]?> <?=$arrDoc["numero"]?> (<?=$class_fLNG->txt(__FILE__,__LINE__,'emitido em !!data!!',array("data"=>data_mysql($arrDoc["data_emissao"])))?>)
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº celular')?></label>
                <div class="controls display">
                  <?=$celular?>
                </div>
            </div> 
            <?php if($email != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'E-mail')?></label>
                <div class="controls display">
                  <?=$email?>
                </div>
            </div> 
            <?php }//if($email != ""){?>  
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Endereço')?></label>
                <div class="controls">
                  <?=$endereco?>
                </div>
            </div>                       
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cadastrado em')?></label>
                <div class="controls">
                	<?=$arrCandidato["user"]?>, <?=date("d/m/Y H:i",$arrCandidato["time"])?>h
                </div>
            </div> 
                      
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosprocesso".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Processos');// titulo
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
                                        	<table class="table table-hover table-nomargin table-bordered">
                                            	<thead>
                                                	<tr>
                                                    	<td><?=SYS_CONFIG_PROCESSO_SIGLA?></td>
                                                        <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo')?></td>
                                                        <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></td>
                                                        <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php
$cont = "0";
$campos = "id,code,tipo_servico,servico_id,status,time,emissao_id,emissao_espelho,emissao_time,validade_time";
$resu = fSQL::SQL_SELECT_SIMPLES($campos,"axl_processo","candidato_fisico_id = '".$id_a."'");
while($linha = fSQL::FETCH_ASSOC($resu)){
	
	$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$linha["servico_id"]."'");
	$tipo = $linhaxxx["nome"];
	
	$status = processoStatusLeg($linha["status"]);
	$status .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Aberto em !!data!!',array("data"=>date("d/m/Y",$linha["time"])));
	if($linha["emissao_time"] >= "1"){ $status .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Emitido em !!data!!',array("data"=>date("d/m/Y",$linha["emissao_time"]))); }
	if($linha["validade_time"] >= "1"){ $status .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Valido até !!data!!',array("data"=>date("d/m/Y",$linha["validade_time"]))); }	
	
	$button = "";
?>
													<tr>
                                                    	<td><?=$linha["code"]?></td>
                                                    	<td><?=$tipo?></td>
                                                    	<td><?=$status?></td>
                                                    	<td><a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO')?> #<?=$linha["code"]?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesProcesso&id=<?=$linha["id"]?>');return false;" class="btn btn-default btn-block" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a></td>
                                                    </tr>
<?php	
}//while($linha = fSQL::FETCH_ASSOC($resu)){
?>
                                                
                                                </tbody>
                                            </table>

                                        
                                        </div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->           
                            
                            
                            
                   
            <div class="form-actions">
    			<button type="button" class="btn btn-large" onclick="pmodalDisplay('hide');return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
            </div>                                
                            
</form>
<?php	
}//detalhesCandidato

















































//AJAX (gráfico de comparação de tipos de status) ------------------------------------------------------------------>>>
if($ajax == "graficoProStatus"){
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){ echo $class_fLNG->txt(__FILE__,__LINE__,'Opss... sem premissão!'); exit(0); }//loginAcesso


	if(isset($_GET["var_extra"])){    	$var_extra = getpost_sql($_GET["var_extra"]);   }else{ $var_extra = "1";    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||----------------------------------->>>
	unset($filtro_b);
	if(isset($_GET["data_aberturai_b"])){       		 $data_aberturai_b = getpost_sql($_GET["data_aberturai_b"]);     	  }else{ $data_aberturai_b = "";    }
	if(isset($_GET["data_aberturaf_b"])){       		 $data_aberturaf_b = getpost_sql($_GET["data_aberturaf_b"]);       	  }else{ $data_aberturaf_b = "";    }
	if(isset($_GET["data_synci_b"])){       		 	 $data_synci_b = getpost_sql($_GET["data_synci_b"]);     	  	      }else{ $data_synci_b = "";   	    }
	if(isset($_GET["data_syncf_b"])){       			 $data_syncf_b = getpost_sql($_GET["data_syncf_b"]);       	  		  }else{ $data_syncf_b = "";    	}	
	if(isset($_GET["tipo_b"])){       				 	 $tipo_b = getpost_sql($_GET["tipo_b"]);     	     				  }else{ $tipo_b = "";	    	    }
	if(isset($_GET["perfil_b"])){   					 $perfil_b = getpost_sql($_GET["perfil_b"]);   					  	  }else{ $perfil_b = "";    	    }
	if(isset($_GET["status_b"])){       				 $status_b = getpost_sql($_GET["status_b"]);       		   			  }else{ $status_b = "";    	    }
	if(isset($_GET["usuario_id_b"])){       			 $usuario_id_b = getpost_sql($_GET["usuario_id_b"]);       		  	  }else{ $usuario_id_b = "";   	    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||-----------------------------------<<<
	$SQL_tabela = "axl_processo P";

	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
		$perfili_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	

	$SQL_where = ""; //condição


//verifica se recebeu uma solicitação de busca por data de cadastro
if(($data_aberturai_b != "") or ($data_aberturaf_b != "")){ 
		if($data_aberturai_b == ""){ $data_aberturai_b = $data_aberturaf_b; } if($data_aberturaf_b == ""){ $data_aberturaf_b = $data_aberturai_b; }
		$timei_a = time_data_hora("$data_aberturai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_aberturaf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturaf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturai_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.time >= '$timei_a' AND P.time <= '$timef_a' "; //condição
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por data de sync
if(($data_synci_b != "") or ($data_syncf_b != "")){ 
		if($data_synci_b == ""){ $data_synci_b = $data_syncf_b; } if($data_syncf_b == ""){ $data_syncf_b = $data_synci_b; }
		$timei_a = time_data_hora("$data_synci_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_syncf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_syncf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_synci_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.sync >= '$timei_a' AND P.sync <= '$timef_a' "; //condição
}//fim da busca por data sync


//verifica se recebeu uma solicitação de busca por tipo_b
if($tipo_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "adm_protocolo_tipo", "id = '$tipo_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.servico_id = '$tipo_b'"; //condição 
}//fim da busca por tipo_b



//verifica se recebeu uma solicitação de busca por status_b
if($status_b != ""){
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Status')." <b>".processoStatusLeg($status_b)."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.status = '$status_b'"; //condição 
}//fim da busca por status_b



//verifica se recebeu uma solicitação de busca por usuario_id_b
if($usuario_id_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_usuarios", "id = '$usuario_id_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.user = '".$usuario_id_b."-%'"; //condição 
}//fim da busca por usuario_id_b


//VERIFICA PERMISSÃO EXTRA
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	//verifica se recebeu uma solicitação de busca por perfili_b
	if($perfil_b != ""){
			$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
			if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= "P.origem_id = '$perfil_b'"; //condição 
	}//fim da busca por perfili_b
}else{//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	$perfil_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.origem_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'"; //condição 
}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){



//se não selecionou perfil
if($perfil_b == ""){
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Todos as <b>Unidades</b>');
}//if(($perfili_b == "") and ($perfila_b == "")){



	
//monta dados do grafico
$java = "";
$cont_reg = "0";
$cont_regT = "0";
//dados da tabela
$table_colspan = "2";//quantidade de colunas
$table_titu = '<tr><th>'.$class_fLNG->txt(__FILE__,__LINE__,'STATUS DE REFERÊNCIA').'</th><th>'.$class_fLNG->txt(__FILE__,__LINE__,'QUANTIDADE').'</th></tr>';//título das colunas
$table_dados = '';//inicia a linha que recebe os dados
echo "<br>SQL_where:".$SQL_where;
//inicia a busca dos dados
$resu1 = fSQL::SQL_SELECT_SIMPLES("P.status, SUM(1) AS soma", $SQL_tabela, "$SQL_where", "GROUP BY P.status ORDER BY RAND()");
while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$nome_i = processoStatusLeg($linha1["status"]);
	$soma = $linha1["soma"];
	$cont_regT = $cont_regT+$soma;
	if($java != ""){ 
		$java .= ", ['".$nome_i."',   ".valorGrafico($soma)."]";
	}else{
		$java .= "{ name: '".$nome_i."', y: ".valorGrafico($soma).", sliced: true, selected: true }";
	}
	 $cont_reg++;
	 //tabela
	 $table_dados .= '<tr><td>'.$nome_i.'</td><td><b>'.$soma.'</b></td></tr>';//inicia a linha que recebe os dados
}//while
if($cont_reg == "1"){ $java = "['".$nome_i."', ".valorGrafico($soma)."]"; }
		


//config controle ids html/js
$ids_hmtl = "ProStatus";
$info_titu = $class_fLNG->txt(__FILE__,__LINE__,'Comparativo de Status de Processos');//título de exibição
$info_titusub = $class_fLNG->txt(__FILE__,__LINE__,'Total !!cont!! processos localizados',array("cont"=>$cont_regT));//subtítulo de exibição
if($filtro_b != ""){ $info_titusub .= " - ".$filtro_b; }//adiciona dados do filtro no subtítulo
?>
<script type="text/javascript">
	//recarrega se mudar tamanho da pagina
	var rezi = window.onresize = grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>;
	function grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(){				
        $('#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			credits: {
				enabled: false
			},
			title: {
				text: "<?=$info_titu?>"
			},
			subtitle: {
				text: "<?=$info_titusub?>"
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y}</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.y}',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						},
						connectorColor: 'silver'
					}
				}
			},
			series: [{
				type: 'pie',
				name: 'Quantidade',
				data: [<?=$java?>]
			}],
			exporting: {
				sourceWidth: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").width(),
				sourceHeight: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").height(),
				// scale: 2 (default)
			},
			navigation: {
				buttonOptions: {
					align: 'left',
					verticalAlign: 'bottom',
					y: -20
				}
			}
		});
		$(".highcharts-button").show();//volta botao de export
	}
	$.doTimeout('vTimerOnLoadgrafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>', 0, function(){ ajustaDivWin(); grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(); });//TIMER	
	function btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(v_exibe){
		$("#div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide(); $("#div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide();
		$("#div_"+v_exibe+"<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").fadeIn();
	}
	function export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>() {
		var htmlPlanilha = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>PlanilhaTeste</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>' + document.getElementById("table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").innerHTML + '</table></body></html>';	 
		var htmlBase64 = btoa(htmlPlanilha);
		window.location="data:application/vnd.ms-excel;base64," + htmlBase64;
	}
</script>
<div style="width:100%; overflow:auto; overflow-y:hidden;" class="windiv" id="div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; right:0px; margin:10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('lista');"><i class="icon-list"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EXIBIR EM LISTA')?></button>
	<div id="grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>" style="width:100%; min-height:250px; margin: 0 auto; padding-top:20px;" class="windivIn"></div>
</div>

<div style="width:100%; height:100%; overflow:auto; overflow-x:hidden; display:none;" class="windiv" id="div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; margin:10px 0 0 10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('grafico');"><i class="glyphicon-charts"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EXIBIR EM GRÁFICO')?></button>    
    <div style="padding:15px; text-align:right;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar dados Excel')?> <button class="btn btn-primary" onclick="export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>();"><i class="icon-download-alt"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DOWNLOAD')?></button></div>    
	<table class="table table-hover table-bordered table-nomargin table-striped" id="table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:center; font-size:18px; text-transform:uppercase;"><?=$info_titu?></th>
			</tr>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:right; font-weight:normal;"><?=$info_titusub?></th>
			</tr>
            <?=$table_titu?>
		</thead>
        <tbody>
            <?=$table_dados?>
        </tbody>
	</table>
    <div style="clear:both; height:50px;"></div>
</div>
<?php

}//fim ajax -------------------<<<<














































































//AJAX (gráfico de comparação detipos de solicitação) ------------------------------------------------------------------>>>
if($ajax == "graficoProTipo"){
	
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){ echo $class_fLNG->txt(__FILE__,__LINE__,'Opss... sem premissão!'); exit(0); }//loginAcesso


	if(isset($_GET["var_extra"])){    	$var_extra = getpost_sql($_GET["var_extra"]);   }else{ $var_extra = "1";    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||----------------------------------->>>
	unset($filtro_b);
	if(isset($_GET["data_aberturai_b"])){       		 $data_aberturai_b = getpost_sql($_GET["data_aberturai_b"]);     	  }else{ $data_aberturai_b = "";    }
	if(isset($_GET["data_aberturaf_b"])){       		 $data_aberturaf_b = getpost_sql($_GET["data_aberturaf_b"]);       	  }else{ $data_aberturaf_b = "";    }
	if(isset($_GET["data_synci_b"])){       		 	 $data_synci_b = getpost_sql($_GET["data_synci_b"]);     	  	      }else{ $data_synci_b = "";   	    }
	if(isset($_GET["data_syncf_b"])){       			 $data_syncf_b = getpost_sql($_GET["data_syncf_b"]);       	  		  }else{ $data_syncf_b = "";    	}	
	if(isset($_GET["tipo_b"])){       				 	 $tipo_b = getpost_sql($_GET["tipo_b"]);     	     				  }else{ $tipo_b = "";	    	    }
	if(isset($_GET["perfil_b"])){   					 $perfil_b = getpost_sql($_GET["perfil_b"]);   					  	  }else{ $perfil_b = "";    	    }
	if(isset($_GET["status_b"])){       				 $status_b = getpost_sql($_GET["status_b"]);       		   			  }else{ $status_b = "";    	    }
	if(isset($_GET["usuario_id_b"])){       			 $usuario_id_b = getpost_sql($_GET["usuario_id_b"]);       		  	  }else{ $usuario_id_b = "";   	    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||-----------------------------------<<<
	$SQL_tabela = "axl_processo P";

	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
		$perfili_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	

	$SQL_where = ""; //condição


//verifica se recebeu uma solicitação de busca por data de cadastro
if(($data_aberturai_b != "") or ($data_aberturaf_b != "")){ 
		if($data_aberturai_b == ""){ $data_aberturai_b = $data_aberturaf_b; } if($data_aberturaf_b == ""){ $data_aberturaf_b = $data_aberturai_b; }
		$timei_a = time_data_hora("$data_aberturai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_aberturaf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturaf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturai_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.time >= '$timei_a' AND P.time <= '$timef_a' "; //condição
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por data de sync
if(($data_synci_b != "") or ($data_syncf_b != "")){ 
		if($data_synci_b == ""){ $data_synci_b = $data_syncf_b; } if($data_syncf_b == ""){ $data_syncf_b = $data_synci_b; }
		$timei_a = time_data_hora("$data_synci_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_syncf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_syncf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_synci_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.sync >= '$timei_a' AND P.sync <= '$timef_a' "; //condição
}//fim da busca por data sync


//verifica se recebeu uma solicitação de busca por tipo_b
if($tipo_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "adm_protocolo_tipo", "id = '$tipo_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.servico_id = '$tipo_b'"; //condição 
}//fim da busca por tipo_b



//verifica se recebeu uma solicitação de busca por status_b
if($status_b != ""){
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Status')." <b>".processoStatusLeg($status_b)."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.status = '$status_b'"; //condição 
}//fim da busca por status_b



//verifica se recebeu uma solicitação de busca por usuario_id_b
if($usuario_id_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_usuarios", "id = '$usuario_id_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.user = '".$usuario_id_b."-%'"; //condição 
}//fim da busca por usuario_id_b


//VERIFICA PERMISSÃO EXTRA
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	//verifica se recebeu uma solicitação de busca por perfili_b
	if($perfil_b != ""){
			$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
			if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= "P.origem_id = '$perfil_b'"; //condição 
	}//fim da busca por perfili_b
}else{//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	$perfil_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.origem_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'"; //condição 
}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){



//se não selecionou perfil
if($perfil_b == ""){
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Todos as <b>Unidades</b>');
}//if(($perfili_b == "") and ($perfila_b == "")){






	
//monta dados do grafico
$javaTitu = "";
$java1 = ""; $java2 = "";
$min_width = "940";
$cont_reg = "0";
//dados da tabela
$table_colspan = "4";//quantidade de colunas
$table_titu = '<tr><th>'.$class_fLNG->txt(__FILE__,__LINE__,'TIPO DE SOLICITAÇÃO').'</th><th>'.$class_fLNG->txt(__FILE__,__LINE__,'QUANTIDADE').'</th></tr>';//título das colunas
$table_dados = '';//inicia a linha que recebe os dados

//monta dados
if($SQL_where != ""){ $SQL_where .= " AND "; }
$resu1 = fSQL::SQL_SELECT_SIMPLES("P.servico_id,T.nome, SUM(1) AS soma", $SQL_tabela.", adm_protocolo_tipo T", "$SQL_where P.servico_id = T.id", "GROUP BY P.servico_id ORDER BY soma DESC");
while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$tipo_id_i = $linha1["servico_id"];
	$nome_i = $linha1["nome"];
	$soma = $linha1["soma"];

	//tabela de dados
	if($javaTitu != ""){ $javaTitu .= " , "; } $javaTitu .= "'".$nome_i."'";
	//if($java != ""){ $java .= " , "; } $java .= "['".$nome_i."', ".$soma."]";  $min_width =  $min_width+20;//incrementa largura
	if($java1 != ""){ $java1 .= " , "; } $java1 .= $soma; 
	$min_width =  $min_width+100;//incrementa largura	
	 $cont_reg++;
	 //tabela
	 $table_dados .= '<tr><td>'.$nome_i.'</td><td><b>'.$soma.'</b></td></tr>';//inicia a linha que recebe os dados
}//while/*/

//config controle ids html/js
$ids_hmtl = "ProTipo";
$info_titu = $class_fLNG->txt(__FILE__,__LINE__,'Tipos de solicitações de processos realizadas');//título de exibição
$info_titusub = $class_fLNG->txt(__FILE__,__LINE__,'Total !!cont!! tipos localizados',array("cont"=>$cont_reg));//subtítulo de exibição
if($filtro_b != ""){ $info_titusub .= " - ".$filtro_b; }//adiciona dados do filtro no subtítulo
?>
<script type="text/javascript">
	//recarrega se mudar tamanho da pagina
	var rezi = window.onresize = grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>;
	function grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(){
		$("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").css("min-width", "<?=$min_width?>px");
        $('#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>').highcharts({			
			chart: {
				type: 'column'
			},
			credits: {
				enabled: false
			},
			title: {
				text: "<?=$info_titu?>",
				align: 'left',
				x: 10,
				y: 0,
				style: {
					fontSize: '14px',
					fontFamily: 'Verdana, sans-serif'
				}
			},
			subtitle: {
				text: "<?=$info_titusub?>",
				align: 'left',
				x: 10,
				y: 15,
				floating: true,
				style: {
					fontSize: '9px'
				}
			},
			xAxis: {
				categories: [
					<?=$javaTitu?>
				],
				type: 'category',
				labels: {
					rotation: -45,
					formatter: function() {
						var temp = this.value.length > 20 ? this.value.slice(0, 19)+'...' : this.value;
						return '<span title="'+ this.value +'">' + temp + '</span>';
					},
					useHTML: true,
					style: {
						fontSize: '7px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: null
				}
			},
			legend: {
				x: 50,
				y: -15,
        		align: 'left',
				shadow: false
			},
			tooltip: {
				shared: true
			},
			plotOptions: {
				column: {
					grouping: false,
					shadow: false,
					borderWidth: 0
				}
			},
			series: [{
				name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Quantidade de Processos')?>',
				data: [<?=$java1?>],
				pointPadding: 0.4,
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					format: '{point.y:.0f}', // one decimal
					y: 10, // 10 pixels down from the top
					style: {
						fontSize: '11px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			}],
			exporting: {
				sourceWidth: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").width(),
				sourceHeight: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").height(),
				// scale: 2 (default)
			},
			navigation: {
				buttonOptions: {
					align: 'left',
					verticalAlign: 'bottom',
					y: -20
				}
			}
		});
		$(".highcharts-button").show();//volta botao de export
	}
	$.doTimeout('vTimerOnLoadgrafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>', 0, function(){ ajustaDivWin(); grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(); });//TIMER	
	function btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(v_exibe){
		$("#div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide(); $("#div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide();
		$("#div_"+v_exibe+"<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").fadeIn();
	}
	function export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>() {
		var htmlPlanilha = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>PlanilhaTeste</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>' + document.getElementById("table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").innerHTML + '</table></body></html>';	 
		var htmlBase64 = btoa(htmlPlanilha);
		window.location="data:application/vnd.ms-excel;base64," + htmlBase64;
	}
</script>
<div style="width:100%; overflow:auto; overflow-y:hidden;" class="windiv" id="div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; right:0px; margin:10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('lista');"><i class="icon-list"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EXIBIR EM LISTA')?></button>
	<div id="grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>" style="width:100%; min-height:250px; margin: 0 auto; padding-top:20px;" class="windivIn"></div>
</div>

<div style="width:100%; height:100%; overflow:auto; overflow-x:hidden; display:none;" class="windiv" id="div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; margin:10px 0 0 10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('grafico');"><i class="glyphicon-charts"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EXIBIR EM GRÁFICO')?></button>    
    <div style="padding:15px; text-align:right;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar dados Excel')?> <button class="btn btn-primary" onclick="export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>();"><i class="icon-download-alt"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DOWNLOAD')?></button></div>    
	<table class="table table-hover table-bordered table-nomargin table-striped" id="table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:center; font-size:18px; text-transform:uppercase;"><?=$info_titu?></th>
			</tr>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:right; font-weight:normal;"><?=$info_titusub?></th>
			</tr>
            <?=$table_titu?>
		</thead>
        <tbody>
            <?=$table_dados?>
        </tbody>
	</table>
    <div style="clear:both; height:50px;"></div>
</div>
<?php


}//fim ajax -------------------<<<<








































//AJAX (gráfico de comparação detipos de solicitação) ------------------------------------------------------------------>>>
if($ajax == "graficoProArrecada"){
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){ echo $class_fLNG->txt(__FILE__,__LINE__,'Opss... sem premissão!'); exit(0); }//loginAcesso


	if(isset($_GET["var_extra"])){    	$var_extra = getpost_sql($_GET["var_extra"]);   }else{ $var_extra = "1";    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||----------------------------------->>>
	unset($filtro_b);
	if(isset($_GET["data_aberturai_b"])){       		 $data_aberturai_b = getpost_sql($_GET["data_aberturai_b"]);     	  }else{ $data_aberturai_b = "";    }
	if(isset($_GET["data_aberturaf_b"])){       		 $data_aberturaf_b = getpost_sql($_GET["data_aberturaf_b"]);       	  }else{ $data_aberturaf_b = "";    }
	if(isset($_GET["data_synci_b"])){       		 	 $data_synci_b = getpost_sql($_GET["data_synci_b"]);     	  	      }else{ $data_synci_b = "";   	    }
	if(isset($_GET["data_syncf_b"])){       			 $data_syncf_b = getpost_sql($_GET["data_syncf_b"]);       	  		  }else{ $data_syncf_b = "";    	}	
	if(isset($_GET["tipo_b"])){       				 	 $tipo_b = getpost_sql($_GET["tipo_b"]);     	     				  }else{ $tipo_b = "";	    	    }
	if(isset($_GET["perfil_b"])){   					 $perfil_b = getpost_sql($_GET["perfil_b"]);   					  	  }else{ $perfil_b = "";    	    }
	if(isset($_GET["status_b"])){       				 $status_b = getpost_sql($_GET["status_b"]);       		   			  }else{ $status_b = "";    	    }
	if(isset($_GET["usuario_id_b"])){       			 $usuario_id_b = getpost_sql($_GET["usuario_id_b"]);       		  	  }else{ $usuario_id_b = "";   	    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||-----------------------------------<<<
	$SQL_tabela = "axl_processo P";

	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
		$perfili_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	

	$SQL_where = ""; //condição


//verifica se recebeu uma solicitação de busca por data de cadastro
if(($data_aberturai_b != "") or ($data_aberturaf_b != "")){ 
		if($data_aberturai_b == ""){ $data_aberturai_b = $data_aberturaf_b; } if($data_aberturaf_b == ""){ $data_aberturaf_b = $data_aberturai_b; }
		$timei_a = time_data_hora("$data_aberturai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_aberturaf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturaf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturai_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.time >= '$timei_a' AND P.time <= '$timef_a' "; //condição
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por data de sync
if(($data_synci_b != "") or ($data_syncf_b != "")){ 
		if($data_synci_b == ""){ $data_synci_b = $data_syncf_b; } if($data_syncf_b == ""){ $data_syncf_b = $data_synci_b; }
		$timei_a = time_data_hora("$data_synci_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_syncf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_syncf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_synci_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.sync >= '$timei_a' AND P.sync <= '$timef_a' "; //condição
}//fim da busca por data sync


//verifica se recebeu uma solicitação de busca por tipo_b
if($tipo_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "adm_protocolo_tipo", "id = '$tipo_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.servico_id = '$tipo_b'"; //condição 
}//fim da busca por tipo_b



//verifica se recebeu uma solicitação de busca por status_b
if($status_b != ""){
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Status')." <b>".processoStatusLeg($status_b)."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.status = '$status_b'"; //condição 
}//fim da busca por status_b



//verifica se recebeu uma solicitação de busca por usuario_id_b
if($usuario_id_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_usuarios", "id = '$usuario_id_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.user = '".$usuario_id_b."-%'"; //condição 
}//fim da busca por usuario_id_b


//VERIFICA PERMISSÃO EXTRA
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	//verifica se recebeu uma solicitação de busca por perfili_b
	if($perfil_b != ""){
			$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
			if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= "P.origem_id = '$perfil_b'"; //condição 
	}//fim da busca por perfili_b
}else{//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	$perfil_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.origem_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'"; //condição 
}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){



//se não selecionou perfil
if($perfil_b == ""){
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Todos as <b>Unidades</b>');
}//if(($perfili_b == "") and ($perfila_b == "")){






	
//monta dados do grafico
$javaTitu = "";
$java1 = ""; $java2 = "";
$min_width = "940";
$cont_reg = "0";
//dados da tabela
$table_colspan = "4";//quantidade de colunas
$table_titu = '<tr><th>'.$class_fLNG->txt(__FILE__,__LINE__,'ARRECADAÇÃO POR TIPO DE PROCESSO').'</th><th>'.$class_fLNG->txt(__FILE__,__LINE__,'TIPO').'</th><th>'.$class_fLNG->txt(__FILE__,__LINE__,'VALOR').'</th></tr>';//título das colunas
$table_dados = '';//inicia a linha que recebe os dados

//monta dados
$arr = array();
if($SQL_where != ""){ $SQL_where .= " AND "; }
$resu1 = fSQL::SQL_SELECT_SIMPLES("P.id,P.servico_id,T.nome", $SQL_tabela.", adm_protocolo_tipo T", "$SQL_where P.servico_id = T.id", "ORDER BY T.nome DESC");
while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$processo_id = $linha1["id"];
	$tipo_id_i = $linha1["servico_id"];
	$nome_i = $linha1["nome"];
	$valor = 0;

	if($tipo_id_i == "14" || $tipo_id_i == "16"){
		$resuxxx = fSQL::SQL_SELECT_SIMPLES("nome","axl_processo_campos","tipo_campo = '99' AND processo_id = '".$processo_id."'");
		while($linhaxxx = fSQL::FETCH_ASSOC($resuxxx)){
			$linhax = fSQL::SQL_SELECT_ONE("valor","axl_tabela_valores","servico_id = '".$tipo_id_i."' AND categoria = '".$linhaxxx["nome"]."'");
			$valor += $linhax["valor"];
			$nome = $linhaxxx["nome"]." (".$nome_i.")";
			if(!isset($arr[$nome])){
				$arr[$nome]["valor"] = 0;
				$arr[$nome]["qtd"] = 0;	
			}//if(!isset($arr[$tipo_id_i])){
			$arr[$nome]["valor"] += $valor;	
			$arr[$nome]["qtd"]++;			
			
		}//fim while
	}else{//if($tipo_id_i == "14" || $tipo_id_i == "16"){
		$linhax = fSQL::SQL_SELECT_ONE("valor","axl_tabela_valores","servico_id = '".$tipo_id_i."'");
		$valor += $linhax["valor"];		
		
		if(!isset($arr[$nome_i])){
			$arr[$nome_i]["valor"] = 0;
			$arr[$nome_i]["qtd"] = 0;		
		}//if(!isset($arr[$tipo_id_i])){
		$arr[$nome_i]["valor"] += $valor;	
		$arr[$nome_i]["qtd"]++;		
	}//}else{//if($tipo_id_i == "14" || $tipo_id_i == "16"){
	
	

}//while/*/
//echo "<pre>"; print_r($arr); echo "</pre>";

foreach($arr as $nome => $array){
	//tabela de dados
	if($javaTitu != ""){ $javaTitu .= " , "; } $javaTitu .= "'".$nome."'";
	//if($java != ""){ $java .= " , "; } $java .= "['".$nome_i."', ".$soma."]";  $min_width =  $min_width+20;//incrementa largura
	if($java1 != ""){ $java1 .= " , "; } $java1 .= $array["valor"]; 
	$min_width =  $min_width+100;//incrementa largura	
	 $cont_reg++;
	 //tabela
	 $table_dados .= '<tr><td>'.$nome.'</td><td><b>'.$array["qtd"].'</b></td><td><b>GNF $'.formataValor($array["valor"],"",",",".","2").'</b></td></tr>';//inicia a linha que recebe os dados	
}


//config controle ids html/js
$ids_hmtl = "ProTipo";
$info_titu = $class_fLNG->txt(__FILE__,__LINE__,'Arrecadação por Tipo de Processo');//título de exibição
$info_titusub = $class_fLNG->txt(__FILE__,__LINE__,'Total !!cont!! tipos localizados',array("cont"=>$cont_reg));//subtítulo de exibição
if($filtro_b != ""){ $info_titusub .= " - ".$filtro_b; }//adiciona dados do filtro no subtítulo
?>
<script type="text/javascript">
	//recarrega se mudar tamanho da pagina
	var rezi = window.onresize = grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>;
	function grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(){
		$("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").css("min-width", "<?=$min_width?>px");
        $('#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>').highcharts({			
			chart: {
				type: 'column'
			},
			credits: {
				enabled: false
			},
			title: {
				text: "<?=$info_titu?>",
				align: 'left',
				x: 10,
				y: 0,
				style: {
					fontSize: '14px',
					fontFamily: 'Verdana, sans-serif'
				}
			},
			subtitle: {
				text: "<?=$info_titusub?>",
				align: 'left',
				x: 10,
				y: 15,
				floating: true,
				style: {
					fontSize: '9px'
				}
			},
			xAxis: {
				categories: [
					<?=$javaTitu?>
				],
				type: 'category',
				labels: {
					rotation: -45,
					formatter: function() {
						var temp = this.value.length > 20 ? this.value.slice(0, 19)+'...' : this.value;
						return '<span title="'+ this.value +'">' + temp + '</span>';
					},
					useHTML: true,
					style: {
						fontSize: '7px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: null
				}
			},
			legend: {
				x: 50,
				y: -15,
        		align: 'left',
				shadow: false
			},
			tooltip: {
				shared: true
			},
			plotOptions: {
				column: {
					grouping: false,
					shadow: false,
					borderWidth: 0
				}
			},
			series: [{
				name: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Arrecadação por Tipo')?>',
				data: [<?=$java1?>],
				pointPadding: 0.4,
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					format: '{point.y:.00f}', // one decimal
					y: 10, // 10 pixels down from the top
					style: {
						fontSize: '11px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			}],
			exporting: {
				sourceWidth: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").width(),
				sourceHeight: $("#grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").height(),
				// scale: 2 (default)
			},
			navigation: {
				buttonOptions: {
					align: 'left',
					verticalAlign: 'bottom',
					y: -20
				}
			}
		});
		$(".highcharts-button").show();//volta botao de export
	}
	$.doTimeout('vTimerOnLoadgrafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>', 0, function(){ ajustaDivWin(); grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(); });//TIMER	
	function btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>(v_exibe){
		$("#div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide(); $("#div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").hide();
		$("#div_"+v_exibe+"<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").fadeIn();
	}
	function export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>() {
		var htmlPlanilha = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>PlanilhaTeste</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>' + document.getElementById("table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>").innerHTML + '</table></body></html>';	 
		var htmlBase64 = btoa(htmlPlanilha);
		window.location="data:application/vnd.ms-excel;base64," + htmlBase64;
	}
</script>
<div style="width:100%; overflow:auto; overflow-y:hidden;" class="windiv" id="div_grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; right:0px; margin:10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('lista');"><i class="icon-list"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EXIBIR EM LISTA')?></button>
	<div id="grafico<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>" style="width:100%; min-height:250px; margin: 0 auto; padding-top:20px;" class="windivIn"></div>
</div>

<div style="width:100%; height:100%; overflow:auto; overflow-x:hidden; display:none;" class="windiv" id="div_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
	<button class="btn btn-orange btn-large" style="position:absolute; z-index:9; margin:10px 0 0 10px; border-radius:20px;" onclick="btlista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>('grafico');"><i class="glyphicon-charts"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EXIBIR EM GRÁFICO')?></button>    
    <div style="padding:15px; text-align:right;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar dados Excel')?> <button class="btn btn-primary" onclick="export_<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>();"><i class="icon-download-alt"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DOWNLOAD')?></button></div>    
	<table class="table table-hover table-bordered table-nomargin table-striped" id="table_lista<?=$ids_hmtl?><?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:center; font-size:18px; text-transform:uppercase;"><?=$info_titu?></th>
			</tr>
			<tr>
				<th colspan="<?=$table_colspan?>" style="text-align:right; font-weight:normal;"><?=$info_titusub?></th>
			</tr>
            <?=$table_titu?>
		</thead>
        <tbody>
            <?=$table_dados?>
        </tbody>
	</table>
    <div style="clear:both; height:50px;"></div>
</div>
<?php


}//fim ajax -------------------<<<<














































































//AJAX (gerar arquivo exportar/donwload) ------------------------------------------------------------------>>>
if($ajax == "exportaLista"){
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"exp")){ echo $class_fLNG->txt(__FILE__,__LINE__,'Opss... sem premissão!'); exit(0); }//loginAcesso
	//INFORMAÇÕES DA PAGINAÇÃO DE ARQUIVOS
	if(isset($_GET["fileTipo"])){	$fileTipo = getpost_sql($_GET["fileTipo"]);	}else{ $fileTipo = "";	}
	if(isset($_GET["fileCont"])){	$fileCont = getpost_sql($_GET["fileCont"]);	}else{ $fileCont = "1";	}
	if($fileTipo == "LISTA_PDF"){ $reg_por_pagina = SYS_CONFIG_TOTALEXPORT_PDF; }else{ $reg_por_pagina = SYS_CONFIG_TOTALEXPORT; }
	$fileContTotal = "1";
	$nome_file_download = $class_fLNG->txt(__FILE__,__LINE__,'lista-processos');
	$titulo_file_donwload = $class_fLNG->txt(__FILE__,__LINE__,'Processos');
	
	//tempo de execução
	if($reg_por_pagina >= "1000"){ set_time_limit(60); }//aumenta tempo de execução PHP
	if($reg_por_pagina >= "5000"){ set_time_limit(120); }//aumenta tempo de execução PHP
	if($reg_por_pagina >= "10000"){ set_time_limit(240); }//aumenta tempo de execução PHP
	
	
	//INICIA SQL DE MONTAGEM DE DADOS	


	if(isset($_GET["var_extra"])){    	$var_extra = getpost_sql($_GET["var_extra"]);   }else{ $var_extra = "1";    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||----------------------------------->>>
	unset($filtro_b);
	if(isset($_GET["data_aberturai_b"])){       		 $data_aberturai_b = getpost_sql($_GET["data_aberturai_b"]);     	  }else{ $data_aberturai_b = "";    }
	if(isset($_GET["data_aberturaf_b"])){       		 $data_aberturaf_b = getpost_sql($_GET["data_aberturaf_b"]);       	  }else{ $data_aberturaf_b = "";    }
	if(isset($_GET["data_synci_b"])){       		 	 $data_synci_b = getpost_sql($_GET["data_synci_b"]);     	  	      }else{ $data_synci_b = "";   	    }
	if(isset($_GET["data_syncf_b"])){       			 $data_syncf_b = getpost_sql($_GET["data_syncf_b"]);       	  		  }else{ $data_syncf_b = "";    	}	
	if(isset($_GET["tipo_b"])){       				 	 $tipo_b = getpost_sql($_GET["tipo_b"]);     	     				  }else{ $tipo_b = "";	    	    }
	if(isset($_GET["perfil_b"])){   					 $perfil_b = getpost_sql($_GET["perfil_b"]);   					  	  }else{ $perfil_b = "";    	    }
	if(isset($_GET["status_b"])){       				 $status_b = getpost_sql($_GET["status_b"]);       		   			  }else{ $status_b = "";    	    }
	if(isset($_GET["usuario_id_b"])){       			 $usuario_id_b = getpost_sql($_GET["usuario_id_b"]);       		  	  }else{ $usuario_id_b = "";   	    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||-----------------------------------<<<
	$SQL_tabela = "axl_processo P";

	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
		$perfili_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	

	$SQL_where = ""; //condição


	


//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_tabela = "axl_processo P";
	$SQL_campos = "P.id,P.origem_id,P.code,P.ano,P.mes,P.dia,P.code,P.tipo_servico,P.servico_id,P.candidato_fisico_id,P.status,P.pgto_id,P.time,T.nome as servico_nome,CF.nome as candidato_fisico_nome,CF.code as candidato_fisico_code,CF.sobrenome AS candidato_fisico_sobrenome"; //campos da tabela
	$SQL_join = "INNER JOIN adm_protocolo_tipo T LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id"; //join
	$SQL_where = "P.servico_id = T.id"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&var_extra=$var_extra&periodo_b=$periodo_b&"; //variaveis para a paginacao
	$ORDEM_C = "P.time";//campo de ordenar
	$ORDEM = "DESC";// ASC ou DESC
	$SQL_group = "GROUP BY P.id"; // agrupar o resultado GROUP BY
	






//verifica se recebeu uma solicitação de busca por data de cadastro
if(($data_aberturai_b != "") or ($data_aberturaf_b != "")){ 
		if($data_aberturai_b == ""){ $data_aberturai_b = $data_aberturaf_b; } if($data_aberturaf_b == ""){ $data_aberturaf_b = $data_aberturai_b; }
		$timei_a = time_data_hora("$data_aberturai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_aberturaf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturaf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturai_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.time >= '$timei_a' AND P.time <= '$timef_a' "; //condição
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por data de sync
if(($data_synci_b != "") or ($data_syncf_b != "")){ 
		$ORDEM_C = "P.sync";
		if($data_synci_b == ""){ $data_synci_b = $data_syncf_b; } if($data_syncf_b == ""){ $data_syncf_b = $data_synci_b; }
		$timei_a = time_data_hora("$data_synci_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_syncf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_syncf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $$filtro_ = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_synci_b."</b>")); }
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $filtro_;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.sync >= '$timei_a' AND P.sync <= '$timef_a' "; //condição
}//fim da busca por data sync


//verifica se recebeu uma solicitação de busca por tipo_b
if($tipo_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "adm_protocolo_tipo", "id = '$tipo_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.servico_id = '$tipo_b'"; //condição 
}//fim da busca por tipo_b



//verifica se recebeu uma solicitação de busca por status_b
if($status_b != ""){
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Status')." <b>".processoStatusLeg($status_b)."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.status = '$status_b'"; //condição 
}//fim da busca por status_b



//verifica se recebeu uma solicitação de busca por usuario_id_b
if($usuario_id_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_usuarios", "id = '$usuario_id_b'");
		if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.user = '".$usuario_id_b."-%'"; //condição 
}//fim da busca por usuario_id_b


//VERIFICA PERMISSÃO EXTRA
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	//verifica se recebeu uma solicitação de busca por perfili_b
	if($perfil_b != ""){
			$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
			if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= "P.origem_id = '$perfil_b'"; //condição 
	}//fim da busca por perfili_b
}else{//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	$perfil_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'");
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.origem_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'"; //condição 
}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){



//se não selecionou perfil
if($perfil_b == ""){
	if($filtro_b != ""){ $filtro_b .= ", "; } $filtro_b .= $class_fLNG->txt(__FILE__,__LINE__,'Todos as <b>Unidades</b>');
}//if(($perfili_b == "") and ($perfila_b == "")){


	
//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio.$AJAX_GET;//vars get para reenvio no paginaçao AJAX
	$AJAX_GET_OR = "ORDEM_C=$ORDEM_C&ORDEM=$ORDEM&";//vars get para reenvio no paginaçao AJAX com ORDER
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<



//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
//trata dados do sql paginação abaixo
			$max = $reg_por_pagina; //busca o padrao do sistema, registros por pagina
			$pagina = $fileCont;
			if($pagina >= "1"){}else{ $pagina = 1; }
			$fileContTotal = fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
			$paginas_total = ceil($fileContTotal / $max);
			if(($fileTipo != "LISTA_CSV") and ($fileTipo != "LISTA_PDF")){
				$comeco = ($pagina*$max) - $max;			
				$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", "$comeco,$max", $SQL_join);
			}//if($fileTipo != "OFF"){
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<







	//download PDF ------------------------------------------------------------------------------------------ || PDF || >>>
	if($fileTipo == "PDF"){
		//css
		$html_dados = '<style> .bordasimples{border-collapse:collapse; empty-cells:show;} .bordasimples tr td { border:#CCC 1px solid; margin-top:10px; padding:5px;} </style>';
		
		//verifica se foi aplicado filtros
		if($filtro_b != ""){ $html_dados .= "FILTROS: <b>".$filtro_b."</b>"; }
		
		//inicia a tabela de dados
		$html_dados .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" class="bordasimples">';
  
		//titulos dos dados
		$html_dados .= '<tr>';
		$html_dados .= '<td>'.SYS_CONFIG_PROCESSO_SIGLA.'</td>';
		$html_dados .= '<td>'.$class_fLNG->txt(__FILE__,__LINE__,'Tipo Serviço').'</td>';
		$html_dados .= '<td>'.$class_fLNG->txt(__FILE__,__LINE__,'Solicitante').'</td>';
		$html_dados .= '<td>'.$class_fLNG->txt(__FILE__,__LINE__,'Unidade').'</td>';
		$html_dados .= '<td>'.$class_fLNG->txt(__FILE__,__LINE__,'Status').'</td>';	
		$html_dados .= '</tr>';		
		
		//faz a contagem de registro e da continuidade
		if($fileCont >= "2"){ $soma = $fileCont-1; $cont = $soma*$reg_por_pagina; }else{ $cont = "0"; }
//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
if($fileContTotal >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$code = $linha1["code"];
	$ano = $linha1["ano"];
	$mes = $linha1["mes"];
	$dia = $linha1["dia"];
	$origem_id = $linha1["origem_id"];
	$tipo_servico = $linha1["tipo_servico"];
	$servico_id = $linha1["servico_id"];
	$candidato_fisico_id = $linha1["candidato_fisico_id"];
	$status = $linha1["status"];
	$pgto_id = $linha1["pgto_id"];
	$servico_nome = $linha1["servico_nome"];
	$candidato_fisico_nome = $linha1["candidato_fisico_nome"];
	$candidato_fisico_code = $linha1["candidato_fisico_code"];
	$candidato_fisico_sobrenome = $linha1["candidato_fisico_sobrenome"];	
	$time = $linha1["time"];
	$linha = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id."'");
	$origem_id_n = $linha["nome"];
	
	//define o valor da verificação do sinal
	$criado_aberto = retornaDias($dia.'/'.$mes.'/'.$ano); $criado_aberto_leg = $criado_aberto;

	$tipo_servico_n = "<b>".$servico_nome."</b> (".maiusculo(categoriaServicoLeg($tipo_servico)).")";
	
	$solicitante_n = "<b>".$candidato_fisico_nome." ".$candidato_fisico_sobrenome."</b> (".SYS_CONFIG_RM_SIGLA." ".$candidato_fisico_code.")";	
	
  	$cont++;
		//tabela de dados
		$html_dados .= '<td><b>'.$code.'</td>';	
		$html_dados .= '<td><b>'.$tipo_servico_n.'</td>';	
		$html_dados .= '<td><b>'.$solicitante_n.'</td>';	
		$html_dados .= '<td><b>'.$origem_id_n.'<br>'.$class_fLNG->txt(__FILE__,__LINE__,'aberto em !!data!!',array("data"=>date("d/m/Y",$time))).'</td>';	
		$html_dados .= '<td><b>'.processoStatusLeg($status).'</td>';	
		$html_dados .= '</tr>';	
		
		


}//fim do while de padinação SQL
}//fim do if($fileContTotal >= "1"){ de paginacao SQL
		
		

		//finaliza tabela de dados
		$html_dados .= '</table>';	
    	$html_load = stripslashes($html_dados); //echo $html_load; exit(0);
		//CLASSES GERAR PDF ---> > >
		$classe_pdf = new fPDF("../");//inicia a classe informando o caminho da pasta: sys
		$classe_pdf->nomeFile($nome_file_download."_CONT-".$fileCont."-".$paginas_total);
		$classe_pdf->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
		$classe_pdf->orientacao("paisagem");//mudar papel para paisagem
		$classe_pdf->cabecalho('<img src="'.VAR_DIR_FILES.'files/logos/logo_impressao.png">',$titulo_file_donwload." ".$fileCont." de ".$paginas_total);//colunas de exibição de cabeçalho
		$classe_pdf->cabecalhoW("1","1%"); $classe_pdf->cabecalhoW("2","99%");//largura de coluna 1 e 2 do cabeçalho
		$classe_pdf->nPagina();//ativa exeibição número de páginas
		$classe_pdf->conteudo($html_load);
		//gera o pdf - COM DOWNLOAD
		$classe_pdf->gerarPDF("down");	

	}//if($fileTipo == "PDF"){ ------------------------------------------------------------------------------------------ || PDF || <<<
	
	
	
	
	
	
	
	







	//download CSV ------------------------------------------------------------------------------------------ || CSV || >>>
	if($fileTipo == "CSV"){
		
		//CLASSES GERAR CSV ---> > >
		$classe_csv = new fCSV();//inicia a classe
		$classe_csv->nomeFile($nome_file_download."_CONT-".$fileCont."-".$paginas_total);
		$classe_csv->titulo($titulo_file_donwload." ".$fileCont." de ".$paginas_total);
		$classe_csv->mostraData($cVLogin->perfil()." - ".date('d/m/Y H:i')."h");//mostra data no título
		
		//verifica se foi aplicado filtros
		if($filtro_b != ""){
			$classe_csv->addCampo($class_fLNG->txt(__FILE__,__LINE__,'FILTROS').": ");//cria campo da linha - adicionar varios desse pra formar a linha
			$classe_csv->addCampo($filtro_b);//cria campo da linha - adicionar varios desse pra formar a linha
			$classe_csv->addLinha();//cria/quebra uma linha
		}
  
		//titulos das colunas
		$classe_csv->addCampo(SYS_CONFIG_PROCESSO_SIGLA);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($class_fLNG->txt(__FILE__,__LINE__,'Tipo Serviço'));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($class_fLNG->txt(__FILE__,__LINE__,'Solicitante'));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($class_fLNG->txt(__FILE__,__LINE__,'Unidade'));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($class_fLNG->txt(__FILE__,__LINE__,'Status'));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addLinha();//cria/quebra uma linha
		
		
		
		
		
		//faz a contagem de registro e da continuidade
		if($fileCont >= "2"){ $soma = $fileCont-1; $cont = $soma*$reg_por_pagina; }else{ $cont = "0"; }
//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
if($fileContTotal >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$code = $linha1["code"];
	$ano = $linha1["ano"];
	$mes = $linha1["mes"];
	$dia = $linha1["dia"];
	$origem_id = $linha1["origem_id"];
	$tipo_servico = $linha1["tipo_servico"];
	$servico_id = $linha1["servico_id"];
	$candidato_fisico_id = $linha1["candidato_fisico_id"];
	$status = $linha1["status"];
	$pgto_id = $linha1["pgto_id"];
	$servico_nome = $linha1["servico_nome"];
	$candidato_fisico_nome = $linha1["candidato_fisico_nome"];
	$candidato_fisico_code = $linha1["candidato_fisico_code"];
	$candidato_fisico_sobrenome = $linha1["candidato_fisico_sobrenome"];	
	$time = $linha1["time"];
	$linha = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id."'");
	$origem_id_n = $linha["nome"];
	
	//define o valor da verificação do sinal
	$criado_aberto = retornaDias($dia.'/'.$mes.'/'.$ano); $criado_aberto_leg = $criado_aberto;

	$tipo_servico_n = "<b>".$servico_nome."</b> (".maiusculo(categoriaServicoLeg($tipo_servico)).")";
	
	$solicitante_n = "<b>".$candidato_fisico_nome." ".$candidato_fisico_sobrenome."</b> (".SYS_CONFIG_RM_SIGLA." ".$candidato_fisico_code.")";	
		
		
  	$cont++;
		//tabela de dados
		$classe_csv->addCampo($code);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($tipo_servico_n);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($solicitante_n);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($requerente_leg);//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo($origem_id_n.' - '.$class_fLNG->txt(__FILE__,__LINE__,'aberto em !!data!!',array("data"=>date("d/m/Y",$time))));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addCampo(processoStatusLeg($status));//cria campo da linha - adicionar varios desse pra formar a linha
		$classe_csv->addLinha();//cria/quebra uma linha	



}//fim do while de padinação SQL
}//fim do if($fileContTotal >= "1"){ de paginacao SQL
		
		

		//CLASSES GERAR CSV ---> > >
		$classe_csv->gerarCSV();	

	}//if($fileTipo == "CSV"){ ------------------------------------------------------------------------------------------ || CSV || <<<
	
	
	
	
		
	
	
	
















	
	
	
	
	
	
	
// ### LISTA DE BOTOES  ------------------------------------------------------------------------------------------ || >>>
if(($fileTipo == "LISTA_PDF") or ($fileTipo == "LISTA_CSV")){
?>
<?php if($filtro_b != ""){ ?><div style="padding:0 5px 0 10px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'FILTROS')?>: <b><?=$filtro_b?></b></div><?php }?>
<div style="padding:5px 5px 5px 10px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Clique no arquivo para download')?>: <?php if($paginas_total >= "2"){?><b>*<?=$class_fLNG->txt(__FILE__,__LINE__,'Muitos registros, dividimos em partes...')?> :)</b><?php if($fileTipo == "LISTA_PDF"){?><br>**<?=$class_fLNG->txt(__FILE__,__LINE__,'O PDF NÃO CONSEGUE AGRUPAR MUITOS REGISTROS COMO NO CSV CONSEGUE')?> ;)<?php }}?></div>
	<table class="table table-hover table-bordered table-nomargin table-striped" id="tableExport<?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Parte(s)')?></th>
				<?php if($fileTipo == "LISTA_PDF"){?><th><?=$class_fLNG->txt(__FILE__,__LINE__,'Baixar em PDF (documento)')?> &nbsp;&nbsp;&nbsp;</th><?php }?>
				<?php if($fileTipo == "LISTA_CSV"){?><th><?=$class_fLNG->txt(__FILE__,__LINE__,'Baixar em CSV (excel)')?> &nbsp;&nbsp;&nbsp;</th><?php }?>
			</tr>
		</thead>
        <tbody>
<?php

//parte única
if($paginas_total == "1"){
?>
            <tr>
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Parte única')?></td>
                <?php if($fileTipo == "LISTA_PDF"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('PDF','1');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para download')?>"><i class=" icon-cloud-download"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'PDF com !!cont!! registro(s)',array("cont"=>$fileContTotal))?> </button></td><?php }?>
                <?php if($fileTipo == "LISTA_CSV"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('CSV','1');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para download')?>"><i class=" icon-cloud-download"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CSV com !!cont!! registro(s)',array("cont"=>$fileContTotal))?> </button></td><?php }?>
            </tr>
<?php
}//if($paginas_total == "1"){
//parte única


			
//partes do arquivo
if($paginas_total >= "2"){
	$cont = "0"; $total = $fileContTotal;
	while($paginas_total > $cont){
		$cont++;
		if($total >= $reg_por_pagina){ $reg = $reg_por_pagina; }else{ $reg = $total; }
		$total = $total-$reg_por_pagina;
?>
            <tr>
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'!!ordinario!!ª parte',array("ordinario"=>$cont))?></td>
                <?php if($fileTipo == "LISTA_PDF"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('PDF','<?=$cont?>');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para download')?>"><i class=" icon-cloud-download"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'PDF com !!cont!! registro(s)',array("cont"=>$reg))?> </button></td><?php }?>
                <?php if($fileTipo == "LISTA_CSV"){?><td><button type="button" onclick="enviaExportIframe<?=$INC_FAISHER["div"]?>('CSV','<?=$cont?>');" style="margin:5px;" class="btn btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para download')?>"><i class=" icon-cloud-download"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CSV com !!cont!!> registro(s)',array("cont"=>$reg))?> </button></td><?php }?>
            </tr>
<?php
	}//fim while
}//if($paginas_total >= "2"){
//partes do arquivo


//sem resultados
if($paginas_total == "0"){
?>
            <tr>
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Vazio')?></td>
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Sem resultados')?></td>
            </tr>
<?php
}//if($paginas_total == "0"){
//sem resultados


?>
        </tbody>
	</table>
<?php if($paginas_total >= "2"){ ?><span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Devido a grande quantidade de dados, o sistema separou em partes o resultado.')?></span><?php }?>
<iframe src="" style="width:0px; height:0px; overflow:hidden; border:0; display:none;" name="export<?=$INC_FAISHER["div"]?>" id="export<?=$INC_FAISHER["div"]?>"></iframe>
<script type="text/javascript">
function enviaExportIframe<?=$INC_FAISHER["div"]?>(v_tipo,v_file){
	loaderFoco('tableExport<?=$INC_FAISHER["div"]?>','exportload<?=$INC_FAISHER["div"]?>','<?=$class_fLNG->txt(__FILE__,__LINE__,'Montado !!tipo!! pode demorar um pouco :) Aguarde...',array("tipo"=>"'+v_tipo+'"))?>');//cria um loader dinamico
	$('#exportload<?=$INC_FAISHER["div"]?>').show();
	//create form to send request 
	$('<form action="<?=$AJAX_PAG?>?scriptoff&<?=$AJAX_GET?>&ajax=<?=$ajax?>&fileTipo='+v_tipo+'&fileCont='+v_file+'" method="post" target="export<?=$INC_FAISHER["div"]?>"></form>').appendTo('#export<?=$INC_FAISHER["div"]?>').submit().remove();
	//detecnta evento de retorno e desliga evento
	$(window).bind("focus",function(event){ $('#exportload<?=$INC_FAISHER["div"]?>').fadeOut(); $(this).unbind("focus"); });
}//enviaExportIframe
</script>
<?php
}//if(($fileTipo == "LISTA_PDF") or ($fileTipo == "LISTA_CSV")){
// ### LISTA DE BOTOES  ------------------------------------------------------------------------------------------ || <<<








}//fim ajax -------------------<<<<




























































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//




?>
<?php





























//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){
	if(isset($_GET["var_extra"])){    	$var_extra = getpost_sql($_GET["var_extra"]);   }else{ $var_extra = "1";    }





























//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||----------------------------------->>>
	unset($filtro_b);
	if(isset($_GET["data_aberturai_b"])){       		 $data_aberturai_b = getpost_sql($_GET["data_aberturai_b"]);     	  }else{ $data_aberturai_b = "";    }
	if(isset($_GET["data_aberturaf_b"])){       		 $data_aberturaf_b = getpost_sql($_GET["data_aberturaf_b"]);       	  }else{ $data_aberturaf_b = "";    }
	if(isset($_GET["data_synci_b"])){       		 	 $data_synci_b = getpost_sql($_GET["data_synci_b"]);     	  	      }else{ $data_synci_b = "";   	    }
	if(isset($_GET["data_syncf_b"])){       			 $data_syncf_b = getpost_sql($_GET["data_syncf_b"]);       	  		  }else{ $data_syncf_b = "";    	}	
	if(isset($_GET["tipo_b"])){       				 	 $tipo_b = getpost_sql($_GET["tipo_b"]);     	     				  }else{ $tipo_b = "";	    	    }
	if(isset($_GET["perfil_b"])){   					 $perfil_b = getpost_sql($_GET["perfil_b"]);   					  	  }else{ $perfil_b = "";    	    }
	if(isset($_GET["status_b"])){       				 $status_b = getpost_sql($_GET["status_b"]);       		   			  }else{ $status_b = "";    	    }
	if(isset($_GET["usuario_id_b"])){       			 $usuario_id_b = getpost_sql($_GET["usuario_id_b"]);       		  	  }else{ $usuario_id_b = "";   	    }
//pega vars de busca ------------------------------------------------------------------------------------- || BUSCA ||-----------------------------------<<<

	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
		$perfil_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
		
		
		
		


//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_tabela = "axl_processo P";
	$SQL_campos = "P.id,P.origem_id,P.code,P.ano,P.mes,P.dia,P.code,P.tipo_servico,P.servico_id,P.candidato_fisico_id,P.status,P.pgto_id,P.time,T.nome as servico_nome,CF.nome as candidato_fisico_nome,CF.code as candidato_fisico_code,CF.sobrenome AS candidato_fisico_sobrenome"; //campos da tabela
	$SQL_join = "INNER JOIN adm_protocolo_tipo T LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id"; //join
	$SQL_where = "P.servico_id = T.id"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&var_extra=$var_extra&periodo_b=$periodo_b&"; //variaveis para a paginacao
	$ORDEM_C = "P.id";//campo de ordenar
	$ORDEM = "DESC";// ASC ou DESC
	$SQL_group = "GROUP BY P.id"; // agrupar o resultado GROUP BY
	










//verifica se recebeu uma solicitação de busca por data de cadastro
if(($data_aberturai_b != "") or ($data_aberturaf_b != "")){ $filtro_marca[] = $data_aberturai_b; $filtro_marca[] = $data_aberturaf_b;
		if($data_aberturai_b == ""){ $data_aberturai_b = $data_aberturaf_b; } if($data_aberturaf_b == ""){ $data_aberturaf_b = $data_aberturai_b; }
		$timei_a = time_data_hora("$data_aberturai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_aberturaf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_abertura_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturaf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_abertura_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_aberturai_b."</b>","dataf"=>"<b>".$data_aberturai_b."</b>")); }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.time >= '$timei_a' AND P.time <= '$timef_a' "; //condição
		$AJAX_GET .= "data_aberturai_b=$data_aberturai_b&data_aberturaf_b=$data_aberturaf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por data de sync
if(($data_synci_b != "") or ($data_syncf_b != "")){ $filtro_marca[] = $data_synci_b; $filtro_marca[] = $data_syncf_b;
		if($data_synci_b == ""){ $data_synci_b = $data_syncf_b; } if($data_syncf_b == ""){ $data_syncf_b = $data_synci_b; }
		$timei_a = time_data_hora("$data_synci_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$data_syncf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_sync_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_syncf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_abertura_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$data_synci_b."</b>","dataf"=>"<b>".$data_synci_b."</b>")); }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.sync >= '$timei_a' AND P.sync <= '$timef_a' "; //condição
		$AJAX_GET .= "data_synci_b=$data_synci_b&data_syncf_b=$data_syncf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data sync






//verifica se recebeu uma solicitação de busca por tipo_b
if($tipo_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "adm_protocolo_tipo", "id = '$tipo_b'"); $filtro_marca[] = $linha1["nome"];
		$filtro_b["tipo_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.servico_id = '$tipo_b'"; //condição 
		$AJAX_GET .= "tipo_b=$tipo_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por tipo_b



//verifica se recebeu uma solicitação de busca por usuario_id_b
if($usuario_id_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_usuarios", "id = '$usuario_id_b'"); $filtro_marca[] = $linha1["nome"];
		$filtro_b["usuario_id_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca tipo !!nome!!',array("nome"=>"<b>".$linha1["nome"]."</b>"));
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.user = '".$usuario_id_b."-%'"; //condição 
		$AJAX_GET .= "usuario_id_b=$usuario_id_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por usuario_id_b





//verifica se recebeu uma solicitação de busca por status_b
if($status_b != ""){ $filtro_marca[] = processoStatusLeg($status_b);
		$filtro_b["status_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Status')." <b>".processoStatusLeg($status_b)."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.status = '$status_b'"; //condição 
		$AJAX_GET .= "status_b=$status_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por status_b






//VERIFICA PERMISSÃO EXTRA
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	//verifica se recebeu uma solicitação de busca por perfili_b
	if($perfil_b != ""){
			$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'"); $filtro_marca[] = $linha1["nome"];
			$filtro_b["perfil_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= "P.origem_id = '$perfil_b'"; //condição 
			$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
	}//fim da busca por perfili_b
}else{//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){
	$perfil_b = $cVLogin->getVarLogin("SYS_USER_PERFIL_ID");
	$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "origem_id = '$perfil_b'"); $filtro_marca[] = $linha1["nome"];
	$filtro_b["perfil_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Unidade')." <b>".$linha1["nome"]."</b>";
	if($SQL_where != ""){ $SQL_where .= " AND "; }
	$SQL_where .= " P.origem_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'"; //condição 
}//if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"vip")){

//se não selecionou perfil
if($perfil_b == ""){
	$filtro_b["perfili_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Todos as <b>Unidades</b>');
}//if(($perfili_b == "") and ($perfila_b == "")){





if($filtro_b["data_abertura_b"] == "" && $filtro_b["data_sync_b"] == ""){

	$SQL_where .= " AND P.id = '0'";
		
	$msg = $class_fLNG->txt(__FILE__,__LINE__,'Para buscar é necessário informar o período de busca! <br>- Data de abertura do processo <br>- Data de interação do processo');
?>
        <div class="alert alert-warning">
            <b><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></b><br><?=$msg?></b>
        </div>
<?php
		exit(0);	
}//if($tab_id == "2"){


	if($filtro_b["data_sync_b"] != ""){ $ORDEM_C = "P.sync"; }//if($filtro_b["data_sync_b"] != ""){
	
//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio.$AJAX_GET;//vars get para reenvio no paginaçao AJAX
	$AJAX_GET_OR = "ORDEM_C=$ORDEM_C&ORDEM=$ORDEM&";//vars get para reenvio no paginaçao AJAX com ORDER
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<




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
			$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", "$comeco,$max", $SQL_join);
			$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
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
				<button type="button" style="float:right; margin:3px 3px;" class="btn btn-mini" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');" rel="tooltip" data-placement="left" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remove Busca')?>"><i class="icon-remove"></i></button>
				<p>
<?php
	$listaIDS_a = $array; //nome do cookie
	foreach ($listaIDS_a as $pos => $valor){
?>
	<div class="bg-shadowb15" style="float:left; margin:0 5px 5px 0; padding:5px;"><span style="float:left; padding-right:5px;"><?=$valor?></span> <button type="button" style="float:right;" class="btn btn-mini" rel="tooltip" data-placement="right" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover Item')?>" onclick="<?php if($pos == "rapida_b"){?>bRapida<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }else{?>bAvancada<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }?>"><i class="icon-remove"></i></button></div>
<?php
	}//fim foreach
?>
<div style="clear:both;"></div>
</p>
				<span class="time"> <b><?=$n_paginas?></b> <?=$class_fLNG->txt(__FILE__,__LINE__,'registros encontrados')?></span>
			</div>
		</li>
	</ul>
<div style="clear:both;"></div>
<?php
}//fim if($cont_ARRAY >= "1"){
?>
<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";



?>

  
  
  
<form action="relatorio.php" target="tar<?=$INC_FAISHER["div"]?>" id="relatorio<?=$INC_FAISHER["div"]?>" name="relatorio<?=$INC_FAISHER["div"]?>" method="POST" onsubmit="openWindow('relatorio.php', 'tar<?=$INC_FAISHER["div"]?>', '980', '800', 'yes', 'yes');">
<input type='hidden' value="<?=str_replace('ajax=lista&', '', $AJAX_GET)?>" name='vars' id='vars<?=$INC_FAISHER["div"]?>' />
<input type='hidden' value="" name='ajax' id='ajax<?=$INC_FAISHER["div"]?>' />
</form>
<script type="text/javascript">
function enviaRelatorio<?=$INC_FAISHER["div"]?>(v_ajax){
	$('#ajax<?=$INC_FAISHER["div"]?>').val(v_ajax);
	$('#relatorio<?=$INC_FAISHER["div"]?>').submit();
}//enviaRelatorio

function enviaExporta<?=$INC_FAISHER["div"]?>(v_tipo){
	pmodalHtml(v_tipo+' - ARQUIVO(S) GERADO(S)','<?=$AJAX_PAG?>','get','scriptoff&faisher=<?=$faisher?>&ajax=exportaLista&fileTipo=LISTA_'+v_tipo+'&'+$('#vars<?=$INC_FAISHER["div"]?>').val());
}//enviaExporta
</script>
<?php


	///VERIFICA PERMISSÕES DE ACESSO
	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){
?>
<div <?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exp")){ echo 'class="span6"'; }?> style="margin-left:0;">
	<ul class="messages" style="margin-top:0; margin-right:0;">
		<li class="left">
			<div class="image"><img src="img/extras/icoGrafico.png" alt=""></div>
			<div class="message"><span class="caret"></span><span class="name"><?=$class_fLNG->txt(__FILE__,__LINE__,'RELATÓRIOS GRÁFICOS/LISTA DISPONÍVEIS NO FILTRO')?></span>
				<p style="padding:10px 10px 0 0;"><?php $cont_bt = "0";?>
				<button type="button" onclick="enviaRelatorio<?=$INC_FAISHER["div"]?>('graficoProStatus');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Compara status dos processos listados')?>"><?php $cont_bt++; echo $cont_bt;?>. <i class="glyphicon-pie_chart"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Comparativo de Status dos Processos')?></button>
				<button type="button" onclick="enviaRelatorio<?=$INC_FAISHER["div"]?>('graficoProTipo');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Quantidade em cada tipo dos processos listados')?>"><?php $cont_bt++; echo $cont_bt;?>. <i class="glyphicon-charts"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Tipos de Solicitações de Processos')?></button>
                <button type="button" onclick="enviaRelatorio<?=$INC_FAISHER["div"]?>('graficoProArrecada');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Valor de arrecadação de cada tipo de processo')?>"><?php $cont_bt++; echo $cont_bt;?>. <i class="glyphicon-charts"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Arrecação por Tipo de Processo')?></button>

                <span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'É possível ver ele em gráfico ou em lista, só selecionar')?> ;)</span>
				</p>
			</div>
		</li>
	</ul>
</div>
<?php
	}//loginAcesso



	///VERIFICA PERMISSÕES DE ACESSO
	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exp")){
?>
<div <?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"gra")){ echo 'class="span6"'; }else{ echo 'style="margin-left:0;"';}?>>
	<ul class="messages" style="margin-top:0; margin-right:0;">
		<li class="left">
			<div class="image"><img src="img/extras/icoExporta.png" alt=""></div>
			<div class="message"><span class="caret"></span><span class="name"><?=$class_fLNG->txt(__FILE__,__LINE__,'EXPORTAR/DOWNLOAD !!cont!! RESULTADOS',array("cont"=>$n_paginas))?></span>
				<p style="padding:10px 10px 0 0;"><?php $cont_bt = "0";?>
				<button type="button" onclick="enviaExporta<?=$INC_FAISHER["div"]?>('CSV');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar lista em CSV/Planilha')?>"><?php $cont_bt++; echo $cont_bt;?>. <i class="icon-magic"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar Lista de Arquivos CSV')?></button>
				<?php if(defined('SYS_CONFIG_TOTALEXPORT_PDF')){?><button type="button" onclick="enviaExporta<?=$INC_FAISHER["div"]?>('PDF');" style="margin:5px; text-align:left;" class="btn btn-primary btn-block" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar lista em PDF')?>"><?php $cont_bt++; echo $cont_bt;?>. <i class="icon-magic"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar Lista de Arquivos PDF')?></button><?php }?>
                <span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'É possível baixar uma planilha, só selecionar')?> :)</span>
				</p>
			</div>
		</li>
	</ul>
</div>
<?php
	}//loginAcesso


?>
<div style="clear:both;"></div>
  
  
  
  
  
  
  
    
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
<input id="GET_BUSCARAPIDA<?=$INC_FAISHER["div"]?>" type="hidden" value="periodo_b=<?=$ano_b?>" />
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

//faz abertura automática de protocolo informado pelo número
if($code_RM != ""){
?>
$.doTimeout('vTimerReg<?=$INC_FAISHER["div"]?>', 1200, function(){ janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$code_RM?>'); });//TIMER<?php }?>



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
$.doTimeout('vTimerRol<?=$id_Rolagem?>', 900, function(){ resize_Tela<?=$id_Rolagem?>(); });//TIMER
$("#acao<?=$INC_FAISHER["div"]?>").click(function(){ resize_Tela<?=$id_Rolagem?>(); });
</script>
<div id="divRol<?=$id_Rolagem?>" style="width:100%; overflow:auto;">
<div id="divRol<?=$id_Rolagem?>Cont" style="width:100%; min-width:980px; padding-top:20px;">
<input id="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" name="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" type="hidden" value="<?=$AJAX_GET?>&pagina=1" />
	<table id="datatable_principal<?=$INC_FAISHER["div"]?>" class="table table-hover table-nomargin table-bordered dataTable">
		<thead>
			<tr>
				<?php $c_or = "P.code"; ?><th style="width:20px;" class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=SYS_CONFIG_PROCESSO_SIGLA?></th>
				<?php $c_or = "T.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo Serviço')?></th>
				<?php $c_or = "CF.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitante')?></th>
				<?php $c_or = "P.origem_id"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Unidade')?></th>                
				<?php $c_or = "P.status"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></th>
                <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
			</tr>
		</thead>
	<tbody>
<?php




///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->loginAcesso("7_pro_protocolos")){ $_pro_protocolos = "1"; }else{ $_pro_protocolos = "0"; }//loginAcesso
	

//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
	if($n_paginas >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$id_a = $linha1["id"];
	$code = $linha1["code"];
	$ano = $linha1["ano"];
	$mes = $linha1["mes"];
	$dia = $linha1["dia"];
	$origem_id = $linha1["origem_id"];
	$tipo_servico = $linha1["tipo_servico"];
	$servico_id = $linha1["servico_id"];
	$candidato_fisico_id = $linha1["candidato_fisico_id"];
	$status = $linha1["status"];
	$pgto_id = $linha1["pgto_id"];
	$servico_nome = $linha1["servico_nome"];
	$candidato_fisico_nome = $linha1["candidato_fisico_nome"];
	$candidato_fisico_code = $linha1["candidato_fisico_code"];
	$candidato_fisico_sobrenome = $linha1["candidato_fisico_sobrenome"];	
	$time = $linha1["time"];

	$linha = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id."'");
	$origem_id_n = $linha["nome"];
	
	//define o valor da verificação do sinal
	//$criado_aberto = retornaDias($dia.'/'.$mes.'/'.$ano); $criado_aberto_leg = $criado_aberto;
	//$parado_aberto = retornaDias(date('d/m/Y', $sync)); $parado_aberto_leg = $parado_aberto;

	$tipo_servico_n = "<b>".$servico_nome."</b>";
	$tipo_servico_n .= "<br><small><i class='".categoriaServicoIco($tipo_servico)."'> ".maiusculo(categoriaServicoLeg($tipo_servico))."</i></small>";
	
	$solicitante_n = '<b>'.$candidato_fisico_nome.' '.$candidato_fisico_sobrenome.'</b> <a href="#" class="btn btn-default" onclick="pmodalHtml(\'<i class=icon-search></i> '.$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO').' #'.$candidato_fisico_code.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=detalhesCandidato&id='.$candidato_fisico_id.'\');return false;"><i class="icon-external-link"></i></a><br>'.SYS_CONFIG_RM_SIGLA.' '.$candidato_fisico_code;			
?>
										<tr>
											<td class="sVisu"><?=$code?></td>
											<td class="sVisu"><?=$tipo_servico_n?></span></td>
											<td class="sVisu"><?=$solicitante_n?></td>
											<td class="sVisu"><?=$origem_id_n?><br><?=$class_fLNG->txt(__FILE__,__LINE__,'aberto em !!data!!',array("data"=>date("d/m/Y", $time)))?></td>
											<td class="sVisu"><?=processoStatusLeg($status,"<br>")?></td>
                                            <td><a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO')?> #<?=$code?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesProcesso&id=<?=$id_a?>');return false;" class="btn btn-default"><i class="icon-search"></i> </a></td>
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
	
		
	///DESATIVA O BOTÃO NOVO
	$pCadastro = "OFF";
	
	//include de padrao
	$INC_VAR["buscaRapida"] = "OFF";//ON - OFF > Busca rápida, retorno ajax [buscaRapida]
	$INC_VAR["buscaAvancada"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaDireta"] = "ON";//ON - OFF > Busca direta fixa, retorno ajax [buscaDireta]
	$INC_VAR["var_extra"] = "1";//uso de var_extra
	//$INC_VAR["varget"] = ""; //vars GET para adicionar no start
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>