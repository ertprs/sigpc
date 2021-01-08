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
	var v_get = '&tab_id='+$('#tab_id<?=$INC_FAISHER["div"]?>').val();//pega dados do tabs
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















































//AJAX (lista/preenche combox lista de ordem) ------------------------------------------------------------------>>>
if($ajax == "selOrdem"){
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$servico = $_GET["servico"];
	$servicos = $_GET["servicos"];
	if($servicos != ""){ $servicos = arrayDB("[".$servicos."]"); }

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
			
	
	if(($servico == "") or ($servico == "0")){
		//alimenta array de retorno
		$row_array['id'] = "OFF";
		$row_array['text'] = "Primeiro selecione o serviço...";
		array_push($return_arr,$row_array);
		
	}else{	
		//alimenta array de retorno
		$row_array['id'] = "0";
		$row_array['text'] = "IMEDIATO/ABERTURA (Executar com abertura do Processo)";
		array_push($return_arr,$row_array);
		
		
		//monta array
		$array = explode(",",$servicos);
		$cont_ARRAY = ceil(count($array));
		//listar item ja cadastrados
		if(($cont_ARRAY >= "1") and ($servicos != "")){
			foreach ($array as $pos => $valor){
				if($valor != ""){
					//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
					$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome", "fin_servico", "id != '$servico' AND id = '$valor'");
					while($linha = fSQL::FETCH_ASSOC($resuM)){
						$id = $linha["id"];
						$legenda = $linha["nome"];
						//alimenta array de retorno
						$row_array['id'] = $id;
						$row_array['text'] = "EXECUTAR APÓS <b>".$legenda."</b>";
						array_push($return_arr,$row_array);
					}//while				
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){		
	
	}//fim}else{
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);


}//fim ajax -------------------<<<<




























































//AJAX (abre de deptos add) ------------------------------------------------------------------>>>
if($ajax == "addDepto"){
	$formCadastroPincipal = getpost_sql($_GET["form"]);
	$sort_id = getpost_sql($_GET["sort_id"]);
	$cont = getpost_sql($_GET["cont"]);
	$dados = getpost_sql($_GET["dados"]);

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroSecundario = "formCadastroSec".$array_temp;
	
	
	//seleciona perfil atual
	$iperfil_data = '{id: "'.$cVLogin->getVarLogin("SYS_USER_PERFIL_ID").'", text: "<i class=\''.fGERAL::icoPerfil($cVLogin->getVarLogin("SYS_USER_PERFIL_ID")).'\'></i> <b>'.$cVLogin->getVarLogin("SYS_USER_PERFIL_ID").'. '.$cVLogin->getVarLogin("SYS_USER_PERFIL_NOME").'</b> (PERFIL/SECRETARIA ATUAL)"}';
?>

<form id="<?=$formCadastroSecundario?>" name="<?=$formCadastroSecundario?>" action="#" method="POST" class='form-horizontal form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroSec<?=$array_temp?>();return false;">

<div id="divContentLoad<?=$array_temp?>">
             <input name="id_i" type="hidden" id="id_i" value="<?=$id_i?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <div style="padding-top:1px;" id="formSecMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosidentific".$array_temp;//id de controle
						$boxUI_titulo = "Selecione os Dados do Departamento a Adicionar";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" />
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                               
										<div class="control-group">
											<label class="control-label"> Perfil/secretaria do depto</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroSecundario?> #iperfil').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um perfil do depto >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilAcesso&scriptoff",
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
	$("#<?=$formCadastroSecundario?> #iperfil").select2("data", <?=$iperfil_data?>);
	$("#<?=$formCadastroSecundario?> #iperfil").on("change", function(e){ if($(this).val() == ""){ 
			$.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroSecundario?> #iperfil").select2("open"); });
	} });
	
});
</script>
<input type='hidden' value="" name='iperfil' id='iperfil' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Perfil/secretaria de origem do departamento a adicionar.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Departamento de tramitação </label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroSecundario?> #idepto').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um departamento de destino >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilDepto&status=1&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					perfil_id: $("#<?=$formCadastroSecundario?> #iperfil").val()
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
	$("#<?=$formCadastroSecundario?> #idepto").on("change", function(e){
		if($(this).val() != ""){
			faisher_ajax('div_oculta', 'btSalvar<?=$array_temp?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=addDeptoAplicar&form=<?=$formCadastroPincipal?>&sort_id=<?=$sort_id?>&cont=<?=$cont?>&dados=<?=$dados?>&depto='+$(this).val(),'get','ADD');			
		}
	});
});
</script>
<input type='hidden' value="" name='idepto' id='idepto' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Selecione um departamento para adicionar ao mapa de tramitação.</span>
											</div>
										</div>  
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
</div>
									</form>
<?php



}//fim ajax -------------------<<<<


//AJAX (aplica seleção de depto) ------------------------------------------------------------------>>>
if($ajax == "addDeptoAplicar"){
	$formCadastroPincipal = getpost_sql($_GET["form"]);
	$sort_id = getpost_sql($_GET["sort_id"]);
	$cont = (int)$_GET["cont"];
	$dados = getpost_sql($_GET["dados"]);
	$depto = getpost_sql($_GET["depto"]);
	$cont++;
	
	//pega dados do depto e perfil
	$linha2 = fSQL::SQL_SELECT_ONE("D.code,D.nome,D.perfil_id,P.nome AS perfil_nome,P.apelido AS perfil_apelido", "sys_perfil_deptos D, sys_perfil P", "D.id = '".$depto."' AND D.perfil_id = P.id", "GROUP BY D.perfil_id");
	$sort_titu = "Depto: <b>".SYS_CONFIG_RM_SIGLA.fGERAL::legCode($arrSub["2"],$linha2["code"])." ".$linha2["nome"]."</b>";
	if($linha2["perfil_id"] != $cVLogin->getVarLogin("SYS_USER_PERFIL_ID")){ $sort_titu .= ' <span class="badge badge-warning"><i class="icon-info-sign"></i> PERFIL/SECRETARIA EXTERNA</span>'; }
	$sort_html = "<b>".maiusculo($linha2["perfil_apelido"])."</b> (".$linha2["perfil_id"].". ".$linha2["perfil_nome"].")";
	
	//adiciona as vars
	if($dados != ""){ $dados .= ","; } $dados .= $depto;
?>
<script type="text/javascript">
$.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){
	var sor_html = '<?=$sort_html?><div id="comm-<?=$sort_id?>-<?=$cont?>-off"><a href="#" class="btn btn-mini btn-lime" onclick="addInstrucao<?=$sort_id?>(\'<?=$cont?>\');return false;" rel="tooltip" data-placement="left" data-original-title="Descrever ajuda ao executor"><i class="icon-magic"></i> ADICIONAR INSTRUÇÕES DE EXECUÇÃO</a></div><div style="display:none;" id="comm-<?=$sort_id?>-<?=$cont?>-on"><a href="#" class="btn btn-mini btn-danger" onclick="delInstrucao<?=$sort_id?>(\'<?=$cont?>\');return false;" rel="tooltip" data-placement="left" data-original-title="Remover instruções"><i class="icon-remove"></i> REMOVER INSTRUÇÕES DE EXECUÇÃO</a><textarea name="comm-<?=$sort_id?>-<?=$cont?>" id="comm-<?=$sort_id?>-<?=$cont?>" rows="3" class="input-block-level" style="margin-top:5px;" placeholder="Informações de como proceder com o processo ao executor do processo"></textarea><span class="help-block"><i class="icon-info-sign"></i> <b>AJUDA: </b>Adicione aqui instruções objetivas e focadas para o executor do processo quando o mapa estiver nesse ponto.</span></div>';
	sortAddO('<?=$formCadastroPincipal?>','<?=$sort_id?>','<?=$cont?>','<?=$depto?>','<?=$sort_titu?>',sor_html);
	pmodalDisplay('hide');
	$("#<?=$formCadastroPincipal?> #<?=$sort_id?>_cont").val('<?=$cont?>');
});
</script>
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
	$tabela_lerLog = "adm_protocolo_tipo";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "adm_protocolo_tipo", "id = '$id_a' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_a = $linha1["nome"];
	$assunto_padrao_a = $linha1["assunto_padrao"];
	$criado_amarelo_a = $linha1["criado_amarelo"];
	$criado_vermelho_a = $linha1["criado_vermelho"];
	$parado_tipo_a = $linha1["parado_tipo"];
	$parado_amarelo_a = $linha1["parado_amarelo"];
	$parado_vermelho_a = $linha1["parado_vermelho"];
	$dias_encubar_a = $linha1["dias_encubar"];
	$informacoes_a = arrayDB($linha1["informacoes"]);
	$mapa_tramitacao_a = arrayDB($linha1["mapa_tramitacao"]);
	$mapa_depto_id_a = $linha1["mapa_depto_id"];
	$restricoes_deptos_a = arrayDB($linha1["restricoes_deptos"]);
	$servico_categoria_id_a = $linha1["servico_categoria_id"];
	$servico_depto_id_a = $linha1["servico_depto_id"];
	$servico_obs_a = $linha1["servico_obs"];
	$servico_cobranca_a = $linha1["servico_cobranca"];
	$servico_solicitante_a = $linha1["servico_solicitante"];
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
	
	
	



	//monta array
	$informacoes_n = "";
	$array = explode(".",$informacoes_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$linha2 = fSQL::SQL_SELECT_ONE("nome,tipo_campo,obrigatorio", "adm_protocolo_tipo_inf", "id = '".$valor."'", "");
				$legenda = $linha2["nome"];
				$tipo_campo = $linha2["tipo_campo"];
				$obrigatorio = $linha2["obrigatorio"];
				if($obrigatorio == "0"){ $obrigatorio_leg = ""; }else{ $obrigatorio_leg = " <[OBRIGATÓRIO]"; }
				if($tipo_campo == "1"){ $tipo_campo_n = "CAMPO DE OPÇÕES"; }
				if($tipo_campo == "2"){ $tipo_campo_n = "CAMPO NUMÉRICO"; }
				if($tipo_campo == "3"){ $tipo_campo_n = "CAMPO DE TEXTO"; }
				if($tipo_campo == "9"){ $tipo_campo_n = "CAMPO DE ARQUIVO"; }
				if($informacoes_n != ""){ $informacoes_n .= " <br>"; }
				$informacoes_n .= $cVLogin->popDetalhes("V",$valor,"7_pro_protocolotipoinf","DETALHES DA INFORMAÇÃO COMPLEMENTAR").$valor.'.<b>'.$legenda.'</b> - <i>'.$tipo_campo_n.'</i>'.'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	

	
	$status_n = "ATIVO";
	if($status_a != "1"){	$status_n = "<b>BLOQUEADO</b><br><i>Em ".date('d/m/Y H:i',$time)."h</i>"; }
	
	
	//busca informações do departamento de inicio para auto tramitação
	$mapa_depto_id_n = "";
	if($mapa_depto_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$mapa_depto_id_a."'", "");
		$code = $linha2["code"];
		$legenda = $linha2["nome"];
		$obs = $linha2["obs"];
		$mapa_depto_id_n = '<b>'.$legenda.'</b> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($mapa_depto_id_a,$code).')<br>'.$obs;
	}//if($mapa_depto_id_a >= "1"){


	//monta lista de deptos em restrição
	//monta array
	$restricoes_deptos_n = "";
	$array = explode(".",$restricoes_deptos_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$linha2 = fSQL::SQL_SELECT_ONE("code,nome", "sys_perfil_deptos", "id = '".$valor."'", "");
				$code = $linha2["code"];
				$legenda = $linha2["nome"];
				if($restricoes_deptos_n != ""){ $restricoes_deptos_n .= "<br>"; }
				$restricoes_deptos_n .= ' - <b>'.$legenda.'</b> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($valor,$code).')';
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){




	//informações de categoria de serviços para aplicativo axl
	$servico_categoria_id_n = "";
	if($servico_categoria_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("icon,legenda", "com_appservicoscategoria", "id = '".$servico_categoria_id_a."'", "");
		$icon = $linha2["icon"];
		$legenda = $linha2["legenda"];
		$servico_categoria_id_n = $servico_categoria_id_a.'. <i class=\''.$icon.'\'></i> <b>'.$legenda.'</b>';
	}//if($servico_categoria_id_a >= "1"){	
	//busca informações do departamento de inicio para 
	$servico_depto_id_n = "";
	if($servico_depto_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$servico_depto_id_a."'", "");
		$code = $linha2["code"];
		$legenda = $linha2["nome"];
		$obs = $linha2["obs"];
		$servico_depto_id_n = '<b>'.$legenda.'</b> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($servico_depto_id_a,$code).')<br>'.$obs;
	}//if($servico_depto_id_a >= "1"){
		
		
	//aviso de cobrança de serviços
	$servico_cobranca_n = "NÃO EXIBIR AVISO (é grátis/sem cobrança)";
    if($servico_cobranca_a == "1"){ $servico_cobranca_n = "EXIBIR AVISO (vai haver taxas/cobrança)"; }
		
	//define quem solicita o serviço
	$servico_solicitante_n = "TODOS - Físico/Jurídico";
    if($servico_solicitante_a == "F"){ $servico_solicitante_n = "CPF - Só por Pessoa Física"; }
    if($servico_solicitante_a == "J"){ $servico_solicitante_n = "CNPJ - Só por Pessoa Jurídica"; }

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
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('VISUALIZAR DADOS DE TIPO DE SOLICITAÇÃO #<?=$id_a?>');

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosger".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Informações";// titulo
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
										<?php $cont_exib++; $d["content"] = "Nome[,]".$nome_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nome</label>
											<div class="controls display">
											  <?=$nome_a?>
											</div>
										</div>
										<?php if($assunto_padrao_a != ""){ $cont_exib++; $d["content"] = "Assunto padrão[,]".$assunto_padrao_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Assunto padrão</label>
											<div class="controls display">
											  <?=$assunto_padrao_a?>
											</div>
										</div>
                                        <?php }?>
										<?php if($informacoes_n != ""){ $cont_exib++; $d["content"] = "Campo adicional inf. complementar[,]".$informacoes_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Campo adicional inf. complementar</label>
											<div class="controls display">
											  <?=$informacoes_n?>
											</div>
										</div>
                                        <?php }?>
										<?php $cont_exib++; $d["content"] = "Status[,]".$status_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Status</label>
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
                        $boxUI_id = "dadosdiascriua".$array_temp;//id de controle
						$boxUI_titulo = "A partir da Criação - Alertas e Prazos - Sinal";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <?=icoSinalAV("M","0","1","2")?> <?=icoSinalAV("M","1","1","2")?> <?=icoSinalAV("M","2","1","2")?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        										
                                        
										<div class="control-group">
											<label class="control-label">CRIADO</label>
											<div class="controls display-plus">
											  Sinalização de processos apartir da criação, "dias corridos" contados da abertura do processo até o dia atual.
											</div>
										</div>
                                        <div class="control-group">            
										<?php if($criado_amarelo_a != ""){ $cont_exib++; $d["content"] = "Quatidade de dias para sinal amarelo[,]".$criado_amarelo_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($criado_vermelho_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal amarelo</label>
                                                <div class="controls display">
                                                  <?=icoSinalAV("M","1","1","2")?> <?=$criado_amarelo_a?> dias
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($criado_vermelho_a != ""){ $cont_exib++; $d["content"] = "Quatidade de dias para sinal vermelho[,]".$criado_vermelho_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($criado_amarelo_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal vermelho</label>
                                                <div class="controls display">
                                                  <?=icoSinalAV("M","2","1","2")?> <?=$criado_vermelho_a?> dias
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
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
                        $boxUI_id = "dadosdiasparado".$array_temp;//id de controle
						$boxUI_titulo = "Quando Parado - Alertas e Prazos - Sinal";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <?=icoSinalAV("M","0","1","2")?> <?=icoSinalAV("M","1","1","2")?> <?=icoSinalAV("M","2","1","2")?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										
										<div class="control-group">
											<label class="control-label">PARADO</label>
											<div class="controls display-plus">
											  Sinalização de processos, com a contagem de dias "parados", sem interações realizadas no processo. Aqui conta da ultima interação (operação realizada) até o dia atual.
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Zerar o contador</label>
											<div class="controls display">
											  <?=legProtocoloTipoParado($parado_tipo_a)?>
											</div>
										</div>
                                        <div class="control-group">            
										<?php if($parado_amarelo_a != ""){ $cont_exib++; $d["content"] = "Quatidade de dias para sinal amarelo[,]".$parado_amarelo_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($parado_vermelho_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal amarelo</label>
                                                <div class="controls display">
                                                  <?=icoSinalAV("M","1","1","2")?> <?=$parado_amarelo_a?> dias
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($parado_vermelho_a != ""){ $cont_exib++; $d["content"] = "Quatidade de dias para sinal vermelho[,]".$parado_vermelho_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($parado_amarelo_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal vermelho</label>
                                                <div class="controls display">
                                                  <?=icoSinalAV("M","2","1","2")?> <?=$parado_vermelho_a?> dias
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div> 
										<?php if($dias_encubar_a != ""){ $cont_exib++; $d["content"] = "Incubação de processo[,]".$dias_encubar_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Incubação de processo</label>
											<div class="controls display">
											  <?=icoSinalAV("M","INC")?> <?=$dias_encubar_a?> dias *Dias de inatividade/sem interação com o processo.
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
                        $boxUI_id = "dadoslistserv".$array_temp;//id de controle
						$boxUI_titulo = "Lista de Serviços a Adicionar no Processo";// titulo
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
                                        
										
										<div class="row-fluid">

	<table id="tabela_itens_servicos<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Lista de Serviço(s)</th>
			</tr>
		</thead>
        <tbody>
<?php
$i_cont = "0";

if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,ordem,servico_id", "adm_protocolo_tipo_servico", "tipo_id = '$id_a'", "ORDER BY ordem ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$ordem_i = $linha1["ordem"];
		$servico_id_i = $linha1["servico_id"];
		$i_cont++;
		
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM2 = fSQL::SQL_SELECT_SIMPLES("code,nome,candidato,propriedade", "fin_servico", "id = '$servico_id_i'");
		while($linha2 = fSQL::FETCH_ASSOC($resuM2)){
			$codeS = $linha2["code"];
			$legendaS = $linha2["nome"];
			$candidatoS = $linha2["candidato"];
			$propriedadeS = $linha2["propriedade"];
			$leg = "";
			if($candidatoS >= "1"){ if($leg != ""){ $leg .= ", "; } $leg .= "Vincular apenas ao CANDIDATO";  }
			if($propriedadeS >= "1"){ if($leg != ""){ $leg .= ", "; } $leg .= "Solicitar PROPRIEDADE"; }
			if($leg != ""){ $leg = "<br><i>(".$leg.")</i>"; }
		}		
		$servico_id_n = $cVLogin->popDetalhes("V",$servico_id_i,"5_srv_servicos","DETALHES DO SERVIÇO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($servico_id_i,$codeS).' - <b>'.$legendaS.'</b>'.$leg;
		
		//monta ORDEM
		if($ordem_i == "0"){
			$ordem_n = "IMEDIATO/ABERTURA (Executar com abertura do Processo)";
		}else{//if($ordem_i == "0"){
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$linha3 = fSQL::SQL_SELECT_ONE("nome", "fin_servico", "id = '$ordem_i'");
			$legendaO = $linha3["nome"];
			$ordem_n = "EXECUTAR APÓS <b>".$legendaO."</b>";
		}//else{//if($ordem_i == "0"){
			
		
		$cont_exib++; $d["content"] = "Serviço: ".$legendaS."[,]Ordem: ".$ordem_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr id="tr<?=$i_cont?>">                
                <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width:100px; border:0; padding:2px;">Serviço</td>
                    <td style="border:0; padding:2px;" class="display">
						<?=$servico_id_n?>
                    </td>
                  </tr>
                  <tr>
                    <td style="border:0; padding:2px;">Quando excutar</td>
                    <td style="border:0; padding:2px;" class="display">
						<?=$ordem_n?>
                    </td>
                  </tr>
                </table>
                </td>
            </tr>
<?php

	}//while
}//if($id_a >= "1"){
?>    
        </tbody>
	</table>
                                            <span class="help-block"><i class="icon-info-sign"></i> Lista de serviço para execução no tipo de processo. QUANDO EXECUTAR, define quando o serviço será aberto e DUAM/Procedimentos serão iniciados.</span>


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
                        $boxUI_id = "dadoslismptra".$array_temp;//id de controle
						$boxUI_titulo = "Mapa de Tramitação do Processo";// titulo
						$boxUI_status = "1";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <i class="glyphicon-riflescope"></i>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										<?php if($mapa_depto_id_n != ""){ $cont_exib++; $d["content"] = "Departamento de tramitação inicial AUTÓMÁTICA[,]".$mapa_depto_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Departamento de tramitação inicial <b>AUTÓMÁTICA</b></label>
											<div class="controls">
											  <div class="display"><?=$mapa_depto_id_n?></div>
                                              <span class="help-block"><i class="icon-info-sign"></i> DEPARTAMENTO DE TRAMITAÇÃO AUTOMÁTICA JÁ NA ABERTURA DO PROCESSO!</span>
											</div>
										</div>
                                        <?php }?>
										      
										<div class="control-group">
											<label class="control-label">Deptos do mapa de tramitação</label>
											<div class="controls">
				<div class="row-fluid" style="margin-bottom:20px;">
<?php
	$cont_ = "0";
	//monta array
	$array = explode(",",$mapa_tramitacao_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$arrSub = explode("-", $valor);//[.ORDEM-PERFIL_ID-DEPTO_ID.]
				$linha2["nome"] = "";
				$linha2 = fSQL::SQL_SELECT_ONE("D.code,D.nome,P.nome AS perfil_nome,P.apelido AS perfil_apelido", "sys_perfil_deptos D, sys_perfil P", "D.id = '".$arrSub["2"]."' AND D.perfil_id = P.id", "GROUP BY D.perfil_id");
				if($linha2["nome"] != ""){
					$sort_titu = "Depto: <b>".SYS_CONFIG_RM_SIGLA.fGERAL::legCode($arrSub["2"],$linha2["code"])." ".$linha2["nome"]."</b>";
					if($arrSub["1"] != $cVLogin->getVarLogin("SYS_USER_PERFIL_ID")){ $sort_titu .= ' <span class="badge badge-warning"><i class="icon-info-sign"></i> PERFIL/SECRETARIA EXTERNA</span>'; }
					$sort_html = "<b>".maiusculo($linha2["perfil_apelido"])."</b> (".$arrSub["1"].". ".$linha2["perfil_nome"].")";
					$cont_exib++; $d["content"] = "Depto:[,]".$sort_titu; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
					$cont_++;
					
					//verifica se existe instrução para o mapa
					$instrucoes = "";
					if($id_a >= "1"){
						$resu1 = fSQL::SQL_SELECT_SIMPLES("instrucao", "adm_protocolo_tipo_mapa_instru", "tipo_id = '$id_a' AND mapa = '$valor'", "", "1");
						while($linha1 = fSQL::FETCH_ASSOC($resu1)){
							$instrucoes = $linha1["instrucao"];
						}
					}//if($id_a >= "1"){
?>
                        <?php if($cont_ > "1"){?><div style="clear:both; padding:5px 0 0 5px; font-size:18px;"><i class="icon-arrow-down"></i></div><?php }?>
						<div class="box box-color box-small box-bordered lightgrey">
							<div class="box-title">
								<h3>
									<i class="glyphicon-riflescope"></i> <?=$sort_titu?>
								</h3>
							</div>
							<div class="box-content"><?=$sort_html?>
                            <?php if($instrucoes != ""){?><div style="padding:5px; margin:5px; border:#CCC 1px dashed;"><i>INTRUÇÕES AO EXECUTOR</i><br><b><?=$instrucoes?></b></div><?php }?></div>
						</div>
<?php
				}//if($linha2["nome"] != ""){

			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
?>               
                </div>
                                              <span class="help-block"><i class="icon-info-sign"></i> Aqui é listado o mapa de tramitação, onde é definido uma regra de tramitação na ordem de cima para baixo da listagem aqui apresentada.<br><b>*SÓ SERÁ PERMITIDO TRAMITAR FORA DESSA ORDEM POR INTERMÉDIO DE UM GESTOR COM PERMISSÕES!</b></span>
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


<?php







if($restricoes_deptos_n != ""){
?>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoslisdept".$array_temp;//id de controle
						$boxUI_titulo = "Vincular a Departamentos (restringir solicitação)";// titulo
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
										
										<?php $cont_exib++; $d["content"] = "Restringir nos depto(s)[,]".$servicos_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Restringir nos depto(s)</label>
											<div class="controls display">
											  <?=$restricoes_deptos_n?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Informação</label>
											<div class="controls display">
											  <span class="help-block"><i class="icon-info-sign"></i> *Só será possível solicitar esse tipo, processos iniciados dos departamentos aqui listado(s).</span>
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

}//if($restricoes_deptos_n != ""){




?> 


<?php







if($servico_categoria_id_a >= "1"){
?>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoslisservc".$array_temp;//id de controle
						$boxUI_titulo = "Liberar no Aplicativo AXL / Portal (serviços disponíveis)";// titulo
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
										
										<?php $cont_exib++; $d["content"] = "Categoria de serviços[,]".$servico_categoria_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Categoria de serviços</label>
											<div class="controls display">
											  <?=$servico_categoria_id_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Exibir aviso de cobrança[,]".$servico_cobranca_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Exibir aviso de cobrança</label>
											<div class="controls display">
											  <?=$servico_cobranca_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Descrever ao solicitante[,]".$servico_obs_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Descrever ao solicitante</label>
											<div class="controls display">
											  <?=imprime_enter($servico_obs_a)?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Departamento de início[,]".$servico_depto_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Departamento de início</label>
											<div class="controls display">
											  <?=$servico_depto_id_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = "Quem pode solicitar[,]".$servico_solicitante_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Quem pode solicitar</label>
											<div class="controls display">
											  <?=$servico_solicitante_n?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Informação</label>
											<div class="controls display">
											  <span class="help-block"><i class="icon-info-sign"></i> *O tipo de processo está sendo exibido no Aplicativo AXL.</span>
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

}//if($servico_categoria_id_a >= "1"){




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
  <input name="nome" id="nome" type="hidden" value="cadastro_tiposolicitacaoprocesso_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Processo - Tipo de Solicitação" />
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
	$tabela_lerLog = "adm_protocolo_tipo";

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
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "adm_protocolo_tipo", "id = '$id_a' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_a = $linha1["nome"];
	$assunto_padrao_a = $linha1["assunto_padrao"];
	$criado_amarelo_a = $linha1["criado_amarelo"];
	$criado_vermelho_a = $linha1["criado_vermelho"];
	$parado_tipo_a = $linha1["parado_tipo"];
	$parado_amarelo_a = $linha1["parado_amarelo"];
	$parado_vermelho_a = $linha1["parado_vermelho"];
	$dias_encubar_a = $linha1["dias_encubar"];
	$informacoes_a = arrayDB($linha1["informacoes"]);
	$mapa_tramitacao_a = arrayDB($linha1["mapa_tramitacao"]);
	$mapa_depto_id_a = $linha1["mapa_depto_id"];
	$restricoes_deptos_a = arrayDB($linha1["restricoes_deptos"]);
	$servico_categoria_id_a = $linha1["servico_categoria_id"];
	$servico_depto_id_a = $linha1["servico_depto_id"];
	$servico_obs_a = $linha1["servico_obs"];
	$servico_cobranca_a = $linha1["servico_cobranca"];
	$servico_solicitante_a = $linha1["servico_solicitante"];
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
	




	//monta array
	$informacoes_data = "[";
	$array = explode(".",$informacoes_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$linha2 = fSQL::SQL_SELECT_ONE("nome,tipo_campo,obrigatorio", "adm_protocolo_tipo_inf", "id = '".$valor."'", "");
				$legenda = $linha2["nome"];
				$tipo_campo = $linha2["tipo_campo"];
				$obrigatorio = $linha2["obrigatorio"];
				if($obrigatorio == "0"){ $obrigatorio_leg = ""; }else{ $obrigatorio_leg = " <[OBRIGATÓRIO]"; }
				if($tipo_campo == "1"){ $tipo_campo_n = "CAMPO DE OPÇÕES"; }
				if($tipo_campo == "2"){ $tipo_campo_n = "CAMPO NUMÉRICO"; }
				if($tipo_campo == "3"){ $tipo_campo_n = "CAMPO DE TEXTO"; }
				if($tipo_campo == "9"){ $tipo_campo_n = "CAMPO DE ARQUIVO"; }
				if($informacoes_data != "["){ $informacoes_data .= ","; }
				$informacoes_data .= '{id: "'.$valor.'", text: "'.$cVLogin->popDetalhes("N",$valor,"7_pro_protocolotipoinf","DETALHES DA INFORMAÇÃO COMPLEMENTAR").$valor.'.<b>'.$legenda.'</b><br><i>'.$tipo_campo_n.'</i>"}';
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	if($informacoes_data != "["){ $informacoes_data .= "]"; }else{ $informacoes_data = ""; }


	//busca informações do departamento de inicio para auto tramitação
	if($mapa_depto_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$mapa_depto_id_a."'", "");
		$code = $linha2["code"];
		$legenda = $linha2["nome"];
		$obs = $linha2["obs"];
		$mapa_depto_id_data = '[{id: "'.$mapa_depto_id_a.'", text: "<b>'.$legenda.'</b> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($mapa_depto_id_a,$code).')<br>'.$obs.'"}]';
	}//if($mapa_depto_id_a >= "1"){


	//verifica dados de restrições de deptos
	//monta array
	$restricoes_deptos_data = "[";
	$array = explode(".",$restricoes_deptos_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$valor."'", "");
				$code = $linha2["code"];
				$legenda = $linha2["nome"];
				$obs = $linha2["obs"];
				if($restricoes_deptos_data != "["){ $restricoes_deptos_data .= ","; }
				$restricoes_deptos_data .= '{id: "'.$valor.'", text: "<b>'.$legenda.'</b> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($valor,$code).')<br>'.$obs.'"}';
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	if($restricoes_deptos_data != "["){ $restricoes_deptos_data .= "]"; }else{ $restricoes_deptos_data = ""; }



	//informações de categoria de serviços para aplicativo axl
	if($servico_categoria_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("icon,legenda", "com_appservicoscategoria", "id = '".$servico_categoria_id_a."'", "");
		$icon = $linha2["icon"];
		$legenda = $linha2["legenda"];
		$servico_categoria_id_data = '[{id: "'.$servico_categoria_id_a.'", text: "'.$servico_categoria_id_a.'. <i class=\''.$icon.'\'></i> <b>'.$legenda.'</b>"}]';
	}//if($servico_categoria_id_a >= "1"){	
	//busca informações do departamento de inicio para 
	if($servico_depto_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$servico_depto_id_a."'", "");
		$code = $linha2["code"];
		$legenda = $linha2["nome"];
		$obs = $linha2["obs"];
		$servico_depto_id_data = '[{id: "'.$servico_depto_id_a.'", text: "<b>'.$legenda.'</b> ('.SYS_CONFIG_RM_SIGLA.' '.fGERAL::legCode($servico_depto_id_a,$code).')<br>'.$obs.'"}]';
	}//if($servico_depto_id_a >= "1"){



}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$nome_a = "";
	$assunto_padrao_a = "";
	$criado_amarelo_a = "10";
	$criado_vermelho_a = "20";
	$parado_tipo_a = "0";
	$parado_amarelo_a = "5";
	$parado_vermelho_a = "10";
	$dias_encubar_a = "30";
	$mapa_tramitacao_a = "";
	$servico_cobranca_a = "1";
	$servico_solicitante_a = "FJ";
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('CADASTRAR NOVO TIPO DE SOLICITAÇÃO');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('EDITAR CADASTRO DE TIPO DE SOLICITAÇÃO #<?=$id_a?>');
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
						$boxUI_titulo = "Dados de Informações";// titulo
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
											<label class="control-label">Nome/tipo de processo</label>
											<div class="controls">
											  <input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="span12 cssFonteMai" maxlength="120" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Assunto padrão do processo</label>
											<div class="controls">
											  <input type="text" name="assunto_padrao" id="assunto_padrao" value="<?=$assunto_padrao_a?>" class="span12 cssFonteMai" maxlength="120">
                                            <span class="help-block"><i class="icon-info-sign"></i> Ao selecionar o tipo de solicitação, preenche o campo assunto com essa informação automaticamente (permitido editar na abertura do processo).</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Campo adicional inf. complementar</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #informacoes').select2({
		maximumSelectionSize: 100,//*/
   		multiple: true,
		placeholder: 'Selecione um campo >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=protocoloTipoInf&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					perfil_id: <?=$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")?>
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
	<?php if($informacoes_data != ""){ ?>$("#<?=$formCadastroPincipal?> #informacoes").select2("data", <?=$informacoes_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='informacoes' id='informacoes' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Adicionar campos complementares criados em "informação complementar", serão aplicados na abertura do processo.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Status da utilização</label>
											<div class="controls">
												<div class="span4">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status1" value="1" data-skin="square" data-color="green" <?php if($status_a == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status1">Ativo (disponível)</label>
												  </div>
												</div>
												<div class="span4">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status2" value="0" data-skin="square" data-color="red" <?php if($status_a != "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status2">Bloqueado (indisponível<?php if(($status_a != "1") and ($time_a >= "10")){ echo " ".date("d/m/Y H:i",$time_a)."h"; }?>)</label>
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
                        $boxUI_id = "daddosalertamar".$array_temp;//id de controle
						$boxUI_titulo = "A partir da Criação - Alertas e Prazos - Sinal ";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <?=icoSinalAV("M","0","1","2")?> <?=icoSinalAV("M","1","1","2")?> <?=icoSinalAV("M","2","1","2")?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        
										<div class="control-group">
											<label class="control-label">CRIADO</label>
											<div class="controls display-plus">
											  Sinalização de processos apartir da criação, "dias corridos" contados da abertura do processo até o dia atual.
											</div>
										</div>
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal amarelo </label>
                                                <div class="controls">
                                                  <input type="text" name="criado_amarelo" id="criado_amarelo" value="<?=$criado_amarelo_a?>" class="input-mini so_numero spinner">
                                                  <?=icoSinalAV("M","1","1","2")?>
                                            	<span class="help-block"><i class="icon-info-sign"></i> A sinalização, informa e alerta AMARELO aos executores do processo de seus prazos.</span>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal vermelho</label>
                                                <div class="controls">
                                                  <input type="text" name="criado_vermelho" id="criado_vermelho" value="<?=$criado_vermelho_a?>" class="input-mini so_numero spinner">
                                                  <?=icoSinalAV("M","2","1","2")?>
                                            	<span class="help-block"><i class="icon-info-sign"></i> A sinalização, informa e alerta VERMELHO aos executores do processo de seus prazos.</span>
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
                        $boxUI_id = "daddosalertparad".$array_temp;//id de controle
						$boxUI_titulo = "Quando Parado - Alertas e Prazos - Sinal ";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <?=icoSinalAV("M","0","1","2")?> <?=icoSinalAV("M","1","1","2")?> <?=icoSinalAV("M","2","1","2")?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        
										<div class="control-group">
											<label class="control-label">PARADO</label>
											<div class="controls display-plus">
											  Sinalização de processos, com a contagem de dias "parados", sem interações realizadas no processo. Aqui conta da ultima interação (operação realizada) até o dia atual.
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Zerar o contador</label>
											<div class="controls">
                                                <select name="parado_tipo" id="parado_tipo" class="select2-me span12">
                                                	<option value="0" <?php if($parado_tipo_a == "0"){ echo'selected="selected"'; }?>><?=legProtocoloTipoParado("0")?></option>
                                                	<option value="1" <?php if($parado_tipo_a == "1"){ echo'selected="selected"'; }?>><?=legProtocoloTipoParado("1")?></option>
                                               		<option value="2" <?php if($parado_tipo_a == "2"){ echo'selected="selected"'; }?>><?=legProtocoloTipoParado("2")?></option>
                                                </select>
                                            	<span class="help-block"><i class="icon-info-sign"></i> Aqui é possível definir/alterar a forma que o sistema ZERA o contador de parado. *No geral é aconselhável utilizar o (1.)PADRÃO, em todas as ações do processo o contador é zerado.</span>
											</div>
										</div> 
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal amarelo </label>
                                                <div class="controls">
                                                  <input type="text" name="parado_amarelo" id="parado_amarelo" value="<?=$parado_amarelo_a?>" class="input-mini so_numero spinner">
                                                  <?=icoSinalAV("M","1","1","2")?>
                                            	<span class="help-block"><i class="icon-info-sign"></i> A sinalização, informa e alerta AMARELO aos executores do processo de seus prazos.</span>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Quatidade de dias para sinal vermelho</label>
                                                <div class="controls">
                                                  <input type="text" name="parado_vermelho" id="parado_vermelho" value="<?=$parado_vermelho_a?>" class="input-mini so_numero spinner">
                                                  <?=icoSinalAV("M","2","1","2")?>
                                            	<span class="help-block"><i class="icon-info-sign"></i> A sinalização, informa e alerta VERMELHO aos executores do processo de seus prazos.</span>
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group">
											<label class="control-label">Incubação de processo (dias)</label>
											<div class="controls">
											  <input type="text" name="dias_encubar" id="dias_encubar" value="<?=$dias_encubar_a?>" class="input-mini so_numero spinner" data-rule-required="true"> 
                                              <?=icoSinalAV("M","INC")?>
                                            	<span class="help-block"><i class="icon-info-sign"></i> <b>IMPORTANTE:</b> São considerados aqui, dias de inatividade ou seja, dias que o processo ficou sem receber qualquer interação.</span>
                                            	<span class="help-block"><i class="icon-info-sign"></i> <b>ATENÇÃO:</b> Caso o processo fique essa quantidade de dias, sem interação (PARADO), o sistema envia o processo automaticamente para incubação, removendo ele das atividades principais, <b>considere aqui o tempo de intervalos de execução dos serviços adicionados</b>.</span>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosservicos".$array_temp;//id de controle
						$boxUI_titulo = "Lista de Serviços a Adicionar no Processo";// titulo
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
                                        
                                                                       

										<div class="row-fluid">

	<table id="tabela_itens_servicos<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Lista de Serviço(s)</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody id="tbody_itens_servicos">
<?php
$i_java = "";
$i_servicos_list = "";
$i_cont = "0";

if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,ordem,servico_id", "adm_protocolo_tipo_servico", "tipo_id = '$id_a'", "ORDER BY ordem ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$ordem_i = $linha1["ordem"];
		$servico_id_i = $linha1["servico_id"];
		$i_cont++;
		
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM2 = fSQL::SQL_SELECT_SIMPLES("code,nome,candidato,propriedade", "fin_servico", "id = '$servico_id_i'");
		while($linha2 = fSQL::FETCH_ASSOC($resuM2)){
			$codeS = $linha2["code"];
			$legendaS = $linha2["nome"];
			$candidatoS = $linha2["candidato"];
			$propriedadeS = $linha2["propriedade"];
			$leg = "";
			if($candidatoS >= "1"){ if($leg != ""){ $leg .= ", "; } $leg .= "Vincular apenas ao CANDIDATO";  }
			if($propriedadeS >= "1"){ if($leg != ""){ $leg .= ", "; } $leg .= "Solicitar PROPRIEDADE"; }
			if($leg != ""){ $leg = "<br><i>(".$leg.")</i>"; }
		}		
		$i_java .= '$("#'.$formCadastroPincipal.' #servico_id'.$i_cont.'").select2("data", {id: "'.$servico_id_i.'", text: "'.$cVLogin->popDetalhes("N",$servico_id_i,"5_srv_servicos","DETALHES DO SERVIÇO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($servico_id_i,$codeS).' - <b>'.$legendaS.'</b>'.$leg.'"});'."\n";
		if($i_servicos_list != ""){ $i_servicos_list .= ","; } $i_servicos_list .= $servico_id_i;
		
		//monta ORDEM
		if($ordem_i == "0"){
			$i_java .= '$("#'.$formCadastroPincipal.' #ordem'.$i_cont.'").select2("data", {id: "0", text: "IMEDIATO/ABERTURA (Executar com abertura do Processo)"});'."\n";
		}else{//if($ordem_i == "0"){
				//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
				$linha3 = fSQL::SQL_SELECT_ONE("nome", "fin_servico", "id = '$ordem_i'");
				$legendaO = $linha3["nome"];
			$i_java .= '$("#'.$formCadastroPincipal.' #ordem'.$i_cont.'").select2("data", {id: "'.$ordem_i.'", text: "EXECUTAR APÓS <b>'.$legendaO.'</b>"});'."\n";
		}//else{//if($ordem_i == "0"){
?>
            <tr id="tr<?=$i_cont?>">                
                <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width:100px; border:0; padding:2px;">Serviço</td>
                    <td style="border:0; padding:2px;">
						<div class="select2-full"><input type='hidden' value="" name='servico_id<?=$i_cont?>' id='servico_id<?=$i_cont?>' data-id="<?=$i_cont?>" class="css-servico_id" style="width:100%;"/></div>
                        <input type='hidden' value="<?=$servico_id_i?>" name='c_servico_id<?=$i_cont?>' id='c_servico_id<?=$i_cont?>' />
                    </td>
                  </tr>
                  <tr>
                    <td style="border:0; padding:2px;">Quando excutar</td>
                    <td style="border:0; padding:2px;">
						<div class="select2-full"><input type='hidden' value="" name='ordem<?=$i_cont?>' id='ordem<?=$i_cont?>' data-id="<?=$i_cont?>" class="css-ordem" style=" width:100%;"/></div>
                    </td>
                  </tr>
                </table>
                </td>
                <td><button type="button" class="btn" onclick="delLinhaServ<?=$INC_FAISHER["div"]?>('<?=$id_i?>','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="list_id<?=$i_cont?>" name="list_id<?=$i_cont?>" type="hidden" value="<?=$id_i?>" />
                    <input id="list_del<?=$i_cont?>" name="list_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
<?php

	}//while
	if($i_servicos_list != ""){ $i_servicos_list = ",".$i_servicos_list.","; }
}//if($id_a >= "1"){
?>

    
<?php $i_cont++; ?>
            <tr id="tr<?=$i_cont?>">
                <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width:100px; border:0; padding:2px;">Serviço</td>
                    <td style="border:0; padding:2px;">
						<div class="select2-full"><input type='hidden' value="" name='servico_id<?=$i_cont?>' id='servico_id<?=$i_cont?>' data-id="<?=$i_cont?>" class="css-servico_id" style="width:100%;"/></div>
                        <input type='hidden' value="" name='c_servico_id<?=$i_cont?>' id='c_servico_id<?=$i_cont?>' />
                    </td>
                  </tr>
                  <tr>
                    <td style="border:0; padding:2px;">Quando excutar</td>
                    <td style="border:0; padding:2px;">
						<div class="select2-full"><input type='hidden' value="" name='ordem<?=$i_cont?>' id='ordem<?=$i_cont?>' data-id="<?=$i_cont?>" class="css-ordem" style=" width:100%;"/></div>
                    </td>
                  </tr>
                </table>
                </td>
                <td><button type="button" class="btn" onclick="delLinhaServ<?=$INC_FAISHER["div"]?>('0','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="list_id<?=$i_cont?>" name="list_id<?=$i_cont?>" type="hidden" value="0" />
                    <input id="list_del<?=$i_cont?>" name="list_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
    
        </tbody>
	</table>
<input id="list_cont" name="list_cont" type="hidden" value="<?=$i_cont?>" />
<input id="servicos_list" name="servicos_list" type="hidden" value="<?=$i_servicos_list?>" />

<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> .css-servico_id').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um serviço >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=finServico&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					servicos: $("#<?=$formCadastroPincipal?> #servicos_list").val()
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
	$("#<?=$formCadastroPincipal?> .css-servico_id").on("change", function(e){
		var cont = $(this).attr('data-id');
		selServicosList<?=$INC_FAISHER["div"]?>($(this).val(),cont);
	});
	
	$('#<?=$formCadastroPincipal?> .css-ordem').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar momento de abertura do serviço',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=selOrdem&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					servico: $("#<?=$formCadastroPincipal?> #c_servico_id"+$(this).attr('data-id')).val(),
					servicos: $("#<?=$formCadastroPincipal?> #servicos_list").val()
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
	$("#<?=$formCadastroPincipal?> .css-ordem").on("change", function(e){ if($(this).val() == "OFF"){ $(this).select2("data", ''); } });
	
	
	<?=$i_java?>
});

function selServicosList<?=$INC_FAISHER["div"]?>(id,cont){
	var list = $("#<?=$formCadastroPincipal?> #servicos_list").val();
	var c_id = $("#<?=$formCadastroPincipal?> #c_servico_id"+cont).val();
	if(c_id != ""){
		var list = list.replace(','+c_id+',', ',');
		if(list == ","){ list = ""; }
		if(list == ",,"){ list = ""; }
	}	
	if(id != ""){
		var list = list.replace(','+id+',', ',');
		if(list == ","){ list = ""; }
		if(list != ""){ list = list+id+','; }else{ list = ','+id+','; }
	}
	$("#<?=$formCadastroPincipal?> #c_servico_id"+cont).val(id);
	$("#<?=$formCadastroPincipal?> #servicos_list").val(list);
}//selServicosList

</script>
<script>
function addLinhaServico<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #list_cont').val());
	cont = cont+1;
    $("#tabela_itens_servicos<?=$INC_FAISHER["div"]?> #tbody_itens_servicos").append('<tr id="tr'+cont+'"><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td style="width:100px; border:0; padding:2px;">Serviço</td><td style="border:0; padding:2px;"><div class="select2-full"><input type="hidden" value="" name="servico_id'+cont+'" id="servico_id'+cont+'" data-id="'+cont+'" style="width:100%;"/></div><input type="hidden" value="" name="c_servico_id'+cont+'" id="c_servico_id'+cont+'" /></td></tr><tr><td style="border:0; padding:2px;">Quando excutar</td><td style="border:0; padding:2px;"><div class="select2-full"><input type="hidden" value="" name="ordem'+cont+'" id="ordem'+cont+'" data-id="'+cont+'" style="width:100%;"/></div></td></tr></table></td><td><button type="button" class="btn" onclick="delLinhaServ<?=$INC_FAISHER["div"]?>(\'0\',\''+cont+'\');"><i class="icon-trash"></i></button><input id="list_id'+cont+'" name="list_id'+cont+'" type="hidden" value="0" /><input id="list_del'+cont+'" name="list_del'+cont+'" type="hidden" value="0" /></td></tr>');

	//dados de combobox
	$("#<?=$formCadastroPincipal?> #servico_id"+cont).select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um serviço >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=finServico&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					servicos: $("#<?=$formCadastroPincipal?> #servicos_list").val()
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
	$("#<?=$formCadastroPincipal?> #servico_id"+cont).on("change", function(e){
		var cont = $(this).attr('data-id');
		selServicosList<?=$INC_FAISHER["div"]?>($(this).val(),cont);
	});
	
	$("#<?=$formCadastroPincipal?> #ordem"+cont).select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar momento de abertura do serviço',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=selOrdem&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					servico: $("#<?=$formCadastroPincipal?> #c_servico_id"+cont).val(),
					servicos: $("#<?=$formCadastroPincipal?> #servicos_list").val()
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
	$("#<?=$formCadastroPincipal?> #ordem"+cont).on("change", function(e){ if($(this).val() == "OFF"){ $(this).select2("data", ''); } });
	
	$('#<?=$formCadastroPincipal?> #servico_id'+cont).select2('open');
	$('#<?=$formCadastroPincipal?> #list_cont').val(cont);
}//addLinhaServico


function delLinhaServ<?=$INC_FAISHER["div"]?>(v_id,v_tr){
	var list = $("#<?=$formCadastroPincipal?> #servicos_list").val();
	var servico_id = $("#<?=$formCadastroPincipal?> #servico_id"+v_tr).val();
	var list = list.replace(','+servico_id+',', ',');
	if(list == ","){ list = ""; }
	if(list == ",,"){ list = ""; }
	$("#<?=$formCadastroPincipal?> #c_servico_id"+v_tr).val('');
	$("#<?=$formCadastroPincipal?> #servicos_list").val(list);
	if(v_id == "0"){
		$('#<?=$formCadastroPincipal?> #tabela_itens_servicos<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
	}else{
		$('#<?=$formCadastroPincipal?> #tabela_itens_servicos<?=$INC_FAISHER["div"]?> #list_del'+v_tr).val('1');
		$('#<?=$formCadastroPincipal?> #tabela_itens_servicos<?=$INC_FAISHER["div"]?> #tr'+v_tr).fadeOut();
	}
}//delLinhaCel
</script>

											<div style="padding:10px;">
												<button type="button" class="btn" onclick="addLinhaServico<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar nova linha de serviço para execução</button>
                                            </div>
                                            <span class="help-block"><i class="icon-info-sign"></i> Lista de serviço para execução no tipo de processo. QUANDO EXECUTAR, define quando o serviço será aberto e DUAM/Procedimentos serão iniciados.</span>


										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            






                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosmptram".$array_temp;//id de controle
						$boxUI_titulo = "Mapa de Tramitação do Processo";// titulo
						$boxUI_status = "1";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						if(($mapa_tramitacao_a == "NULL") and ($id_a >= "1")){ $boxUI_status = "0"; }
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <i class="glyphicon-riflescope"></i>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
										<div class="control-group">
											<label class="control-label"> Departamento de tramitação inicial <strong>AUTÓMÁTICA</strong></label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #mapa_depto_id').select2({
		maximumSelectionSize: 30,//*/
   		multiple: true,
		placeholder: 'Tramitaçãi automática ao departamento >> (opcional)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilDepto&status=1&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					perfil_id: <?=$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")?>
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
	<?php if($mapa_depto_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #mapa_depto_id").select2("data", <?=$mapa_depto_id_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='mapa_depto_id' id='mapa_depto_id' style=" width:100%;"/>
                                              <span class="help-block" style="font-weight:bold;"><i class="icon-info-sign"></i> AO SELECIONAR UM DEPARTAMENTO AQUI, AUTOMATICAMENTE AO SER CRIADO VAI SER TRAMITADO JÁ NA ABERTURA!</span>
                                              <span class="help-block"><i class="icon-info-sign"></i> Deixar em branco/sem preencher, permite solicitação continuar com o usuário para que o mesmo decida o momento da tramitação.</span>
											</div>
										</div>
										<div class="row-fluid" style="padding:20px 10px 10px 10px;">
                                              <span class="help-block display" style="font-weight:bold;"><i class="icon-info-sign"></i> O MAPA DE TRAMITAÇÃO ABAIXO DEFINE UMA REGRA NA QUAL O PROCESSO DEVE SEGUIR EM TODO SEU FLUXO DE VIDA.</span>
										</div>
                                        
          
<?php
//LISTA SORT DE DADOS
$sort_id = "mapa_tramitacao";
?>
                                        <div class="control-group">
                                            <div class="span6" style="padding:20px;">
                                                <button class="btn btn-info btn-large" onclick="addDepto<?=$sort_id?>();return false;"><i class="icon-plus-sign"></i> Adicionar novo depto ao mapa de tramitações</button>
                                              <span class="help-block"><i class="icon-info-sign"></i> Aqui é possível criar uma lista do "caminho" entre quais deptos o processo deverá seguir.<br><b>*CASO NÃO UTILIZE ESSA FUNCIONALIDADE, BASTA DEIXAR EM BRANCO A LISTAGEM!</b></span>
                                            </div>
                                        </div>             

										<div class="control-group">
											<label class="control-label">Deptos do mapa de tramitação</label>
											<div class="controls">
				<div class="row-fluid sortable-box" style="margin-bottom:20px;" id="sort-<?=$sort_id?>">
<?php
$cont_ID = "0";//cont ID para controle do sort
$mapa_tramitacao_list = ""; $cont_list = "0";
	//monta array
	$array = explode(",",$mapa_tramitacao_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$arrSub = explode("-", $valor);//[,ORDEM-PERFIL_ID-DEPTO_ID,]
				$linha2["nome"] = "";
				$linha2 = fSQL::SQL_SELECT_ONE("D.code,D.nome,P.nome AS perfil_nome,P.apelido AS perfil_apelido", "sys_perfil_deptos D, sys_perfil P", "D.id = '".$arrSub["2"]."' AND D.perfil_id = P.id", "GROUP BY D.perfil_id");
				if($linha2["nome"] != ""){
					$sort_titu = "Depto: <b>".SYS_CONFIG_RM_SIGLA.fGERAL::legCode($arrSub["2"],$linha2["code"])." ".$linha2["nome"]."</b>";
					if($arrSub["1"] != $cVLogin->getVarLogin("SYS_USER_PERFIL_ID")){ $sort_titu .= ' <span class="badge badge-warning"><i class="icon-info-sign"></i> PERFIL/SECRETARIA EXTERNA</span>'; }
					$sort_valor = $arrSub["2"];
					$cont_list++; if($mapa_tramitacao_list != ""){ $mapa_tramitacao_list .= ","; } $mapa_tramitacao_list .= $cont_list."-".$sort_valor;
					$sort_html = "<b>".maiusculo($linha2["perfil_apelido"])."</b> (".$arrSub["1"].". ".$linha2["perfil_nome"].")";
					
					//verifica se existe instrução para o mapa
					$instrucoes = "";
					if($id_a >= "1"){
						$resu1 = fSQL::SQL_SELECT_SIMPLES("instrucao", "adm_protocolo_tipo_mapa_instru", "tipo_id = '$id_a' AND mapa = '$valor'", "", "1");
						while($linha1 = fSQL::FETCH_ASSOC($resu1)){
							$instrucoes = $linha1["instrucao"];
						}
					}//if($id_a >= "1"){
						
					$cont_ID++;//incrementa controle de ids do sort
?>
						<div class="box box-color box-small box-bordered lightgrey" id="sort-<?=$sort_id?>-<?=$cont_ID?>">
							<div class="box-title" rel="tooltip" data-placement="bottom" data-original-title="Clique e arraste para ordenar">
								<h3>
									<i class="icon-resize-vertical"></i> <?=$sort_titu?>
                                    <input type='hidden' value="<?=$sort_valor?>" data-id="<?=$cont_ID?>" class="sortItem"/>
								</h3>
                                <div class="actions">
									<a href="#" class="btn btn-mini content-remove" onclick="sortRemoveO('<?=$formCadastroPincipal?>','<?=$sort_id?>','<?=$cont_ID?>');return false;" rel="tooltip" data-placement="left" data-original-title="Remover"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content"><?=$sort_html?> 
                            	<div <?php if($instrucoes != ""){ echo 'style="display:none;"'; }?> id="comm-<?=$sort_id?>-<?=$cont_ID?>-off"><a href="#" class="btn btn-mini btn-lime" onclick="addInstrucao<?=$sort_id?>('<?=$cont_ID?>');return false;" rel="tooltip" data-placement="left" data-original-title="Descrever ajuda ao executor"><i class="icon-magic"></i> ADICIONAR INSTRUÇÕES DE EXECUÇÃO</a>
                                </div>
                            	<div <?php if($instrucoes == ""){ echo 'style="display:none;"'; }?> id="comm-<?=$sort_id?>-<?=$cont_ID?>-on"><a href="#" class="btn btn-mini btn-danger" onclick="delInstrucao<?=$sort_id?>('<?=$cont_ID?>');return false;" rel="tooltip" data-placement="left" data-original-title="Remover instruções"><i class="icon-remove"></i> REMOVER INSTRUÇÕES DE EXECUÇÃO</a>
                                <textarea name="comm-<?=$sort_id?>-<?=$cont_ID?>" id="comm-<?=$sort_id?>-<?=$cont_ID?>" rows="3" class="input-block-level" style="margin-top:5px;" placeholder="Informações de como proceder com o processo ao executor do processo"><?=$instrucoes?></textarea>
                                <span class="help-block"><i class="icon-info-sign"></i> <b>AJUDA: </b>Adicione aqui instruções objetivas e focadas para o executor do processo quando o mapa estiver nesse ponto.</span>
                                </div>
                            </div>
						</div>
<?php
				}//if($linha2["nome"] != ""){

			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
?>               
                </div><!-- .sortable-box -->
<script type="text/javascript">
$(document).ready(function(){
	//itens sort
	$('#<?=$formCadastroPincipal?> #sort-<?=$sort_id?>').sortable({
		connectWith: ".box",
		items: ".box",
		opacity: 0.7,
		placeholder: 'widget-placeholder',
		forcePlaceholderSize: true,
		tolerance: "pointer",
		dropOnEmpty:true,
		update: function (event) { sortListO("<?=$formCadastroPincipal?>","<?=$sort_id?>"); }
	});
	sortListO("<?=$formCadastroPincipal?>","<?=$sort_id?>");	
});


function addDepto<?=$sort_id?>(){
	pmodalHtml('<i class="icon-pencil"></i> ADICIONAR ITEM DEPTO AO MAPA','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=addDepto&form=<?=$formCadastroPincipal?>&sort_id=<?=$sort_id?>&cont='+$('#<?=$formCadastroPincipal?> #<?=$sort_id?>_cont').val()+'&dados='+$('#<?=$formCadastroPincipal?> #<?=$sort_id?>').val());
}//addDepto

function addInstrucao<?=$sort_id?>(v_cont_id){
	$("#<?=$formCadastroPincipal?> #comm-<?=$sort_id?>-"+v_cont_id+"-off").hide();
	$("#<?=$formCadastroPincipal?> #comm-<?=$sort_id?>-"+v_cont_id+"-on").fadeIn();
}//addInstrucao
function delInstrucao<?=$sort_id?>(v_cont_id){
	$("#<?=$formCadastroPincipal?> #comm-<?=$sort_id?>-"+v_cont_id+"-on").hide();
	$("#<?=$formCadastroPincipal?> #comm-<?=$sort_id?>-"+v_cont_id+"-off").fadeIn();
	$("#<?=$formCadastroPincipal?> #comm-<?=$sort_id?>-"+v_cont_id).val('');
}//delInstrucao
</script>
<input type='hidden' value="<?=$cont_ID?>" name='<?=$sort_id?>_cont' id='<?=$sort_id?>_cont'/>
<input type='hidden' value="<?=$mapa_tramitacao_list?>" name='<?=$sort_id?>' id='<?=$sort_id?>'/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Aqui é listado o mapa de tramitação, onde é definido uma regra de tramitação na ordem de cima para baixo da listagem aqui apresentada.<br><b>*SÓ SERÁ PERMITIDO TRAMITAR FORA DESSA ORDEM POR INTERMÉDIO DE UM GESTOR COM PERMISSÕES!</b></span>
											</div>
										</div>

                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            



           
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosdeptos".$array_temp;//id de controle
						$boxUI_titulo = "Vincular a Departamentos (restringir solicitação)";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						
						if($restricoes_deptos_data != ""){ $boxUI_status = "1"; }
						?>
							<div class="accordion accordion-widget emissao_processo" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        
										<div class="control-group">
											<label class="control-label"> Restringir nos depto(s)</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #restricoes_deptos').select2({
		maximumSelectionSize: 30,//*/
   		multiple: true,
		placeholder: 'Selecione depto(s) >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilDepto&status=1&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					perfil_id: <?=$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")?>
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
	<?php if($restricoes_deptos_data != ""){ ?>$("#<?=$formCadastroPincipal?> #restricoes_deptos").select2("data", <?=$restricoes_deptos_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='restricoes_deptos' id='restricoes_deptos' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> É possível restringir a solicitação desse tipo de processo em departamentos selecionados aqui.</span>
                                              <span class="help-block"><i class="icon-info-sign"></i> Deixar em branco/sem preencher, permite solicitação em qualquer(todos) os departamentos do perfil. *APARECE EM TODOS!</span>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            



           
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosservc".$array_temp;//id de controle
						$boxUI_titulo = "Liberar no Aplicativo AXL / Portal (serviços disponíveis)";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						
						if($servico_categoria_id_a >= "1"){ $boxUI_status = "1"; }
						?>
							<div class="accordion accordion-widget emissao_processo" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        
										<div class="control-group">
											<label class="control-label"> Categoria de serviços</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #servico_categoria_id').select2({
		maximumSelectionSize: 30,//*/
   		multiple: true,
		placeholder: 'Selecione uma categoria >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=categoriaServicos&status=1&scriptoff",
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
	<?php if($servico_categoria_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #servico_categoria_id").select2("data", <?=$servico_categoria_id_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #servico_categoria_id").on("change", function(e){
		if($(this).val() == ""){ $("#<?=$formCadastroPincipal?> .css_servico").hide(); }else{ $("#<?=$formCadastroPincipal?> .css_servico").fadeIn(); }
	});
	
});
</script>
<input type='hidden' value="" name='servico_categoria_id' id='servico_categoria_id' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> É possível liberar esse tipo de processo como um serviço no Aplicativo AXL.</span>
                                              <span class="help-block"><i class="icon-info-sign"></i> Deixar em branco/sem preencher, significa não exibir no Aplicativo AXL!</span>
											</div>
										</div>
										<div class="control-group css_servico" <?php if($servico_categoria_id_a >= "1"){}else{ echo 'style="display:none;"'; }?>>
											<label class="control-label">Exibir aviso de cobrança</label>
											<div class="controls">
												<div class="span4">
													<div class="check-line">
														<input name="servico_cobranca" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="servico_cobranca1" value="1" data-skin="square" data-color="green" <?php if($servico_cobranca_a == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="servico_cobranca1">EXIBIR AVISO (vai haver taxas/cobrança)</label>
												  </div>
												</div>
												<div class="span4">
													<div class="check-line">
														<input name="servico_cobranca" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="servico_cobranca2" value="0" data-skin="square" data-color="red" <?php if($servico_cobranca_a != "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="servico_cobranca2">NÃO EXIBIR AVISO (é grátis/sem cobrança)</label>
												  </div>
												</div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> <strong>IMPORTANTE!</strong> <br>Aqui define ou não se vai existir cobrança para solicitação do serviço, mesmo que não exista taxa para abertura, exibe aviso ao solicitante: <br><strong>(!)Existem cobranças/valores ainda não calculados que serão efetuados até o fim do processo. *Os valores são definidos durante o processo.</strong></span>
											</div>
										</div>
										<div class="control-group css_servico" <?php if($servico_categoria_id_a >= "1"){}else{ echo 'style="display:none;"'; }?>>
											<label class="control-label">Descrever ao solicitante</label>
											<div class="controls">
												<textarea name="servico_obs" id="servico_obs" rows="3" class="input-block-level" placeholder="Descreva aqui (obrigatório)" data-rule-required="true"><?=$servico_obs_a?></textarea>
                                                <span class="help-block">Você tem <b><span id="charsLeft"></span></b> caracteres disponíveis.</span>
                                                <script type="text/javascript">
                                                    $('#<?=$formCadastroPincipal?> #servico_obs').limit('150','#<?=$formCadastroPincipal?> #charsLeft');
                                                </script>
                                              <span class="help-block"><i class="icon-info-sign"></i> <b>IMPORTANTE!</b> Descreva de forma simples o serviço para o solicitante.</span>
											</div>
										</div>
										<div class="control-group css_servico" <?php if($servico_categoria_id_a >= "1"){}else{ echo 'style="display:none;"'; }?>>
											<label class="control-label"> Departamento de início</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #servico_depto_id').select2({
		maximumSelectionSize: 30,//*/
   		multiple: true,
		placeholder: 'Selecione o departamento >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilDepto&status=1&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					perfil_id: <?=$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")?>
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
	<?php if($servico_depto_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #servico_depto_id").select2("data", <?=$servico_depto_id_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='servico_depto_id' id='servico_depto_id' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> É possível restringir a solicitação desse tipo de processo em departamentos selecionados aqui.</span>
                                              <span class="help-block"><i class="icon-info-sign"></i> Deixar em branco/sem preencher, permite solicitação em qualquer(todos) os departamentos do perfil. *APARECE EM TODOS!</span>
											</div>
										</div>
										<div class="control-group css_servico" <?php if($servico_categoria_id_a >= "1"){}else{ echo 'style="display:none;"'; }?>>
											<label class="control-label">Quem pode solicitar</label>
											<div class="controls">
                                                <select data-placeholder="Selecione " class="select2-me" style="width:100%;" name="servico_solicitante" id="servico_solicitante">
                                                    <option value="NULL" <?php if($servico_solicitante_a == "NULL"){ echo "selected"; } ?>>TODOS - Físico/Jurídico</option>
                                                    <option value="F" <?php if($servico_solicitante_a == "F"){ echo "selected"; } ?>>CPF - Só por Pessoa Física</option>
                                                    <option value="J" <?php if($servico_solicitante_a == "J"){ echo "selected"; } ?>>CNPJ - Só por Pessoa Jurídica</option>
                                                    <option value="FJ" <?php if($servico_solicitante_a == "FJ"){ echo "selected"; } ?>>TODOS - Físico/Jurídico</option>
                                                </select>
												<span class="help-block"><i class="icon-info-sign"></i> Informe que tipo de pessoa <b>Físico</b> ou <b>Jurídoco</b> pode solicitar esse serviço.</span>
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
	if(isset($_GET["tab_id"])){			$tab_id = getpost_sql($_GET["tab_id"]);		}else{ $tab_id = "0";		}





//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){
		//atualiza dados da tabela no DB
		$campos = "status,user_a,sync";
		$tabela = "adm_protocolo_tipo";
		$valores = array("0",$cVLogin->userReg(),time());
		$condicao = "id='$id_excluir' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		//defina para tab de bloqueados		
		$tab_id = "1";
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("adm_protocolo_tipo", "bloquear", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO","Registro bloqueado com sucesso!");
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
	$nome_a = getpost_sql($_POST["nome"],"MAIUSCULO");
	$assunto_padrao_a = getpost_sql($_POST["assunto_padrao"],"MAIUSCULO");
	$informacoes_a = getpost_sql($_POST["informacoes"],"ARRAY-P");
	$mapa_tramitacao_a = getpost_sql($_POST["mapa_tramitacao"]);
	$mapa_depto_id_a = getpost_sql($_POST["mapa_depto_id"]);
	$status_a = getpost_sql($_POST["status"]);
	$criado_amarelo_a = getpost_sql($_POST["criado_amarelo"]);
	$criado_vermelho_a = getpost_sql($_POST["criado_vermelho"]);
	$parado_tipo_a = getpost_sql($_POST["parado_tipo"]);
	$parado_amarelo_a = getpost_sql($_POST["parado_amarelo"]);
	$parado_vermelho_a = getpost_sql($_POST["parado_vermelho"]);
	$dias_encubar_a = getpost_sql($_POST["dias_encubar"]);
	$list_cont_a = getpost_sql($_POST["list_cont"]);
	$restricoes_deptos_a = getpost_sql($_POST["restricoes_deptos"],"ARRAY-P");
	$servico_categoria_id_a = getpost_sql($_POST["servico_categoria_id"]);
	$servico_obs_a = sentenca(getpost_sql($_POST["servico_obs"]));
	$servico_depto_id_a = getpost_sql($_POST["servico_depto_id"]);
	$servico_cobranca_a = getpost_sql($_POST["servico_cobranca"]);
	$servico_solicitante_a = getpost_sql($_POST["servico_solicitante"]);
	
		
		
	 


//VALIDAÇÔES ------------------------------**********
	//valida campo nome_a -- XXX
	if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo Nome não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	
	//verifica se já existe no sistem
	$sql_complemto = " AND id != '$id_a'";	
	if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
	$cont_ = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "adm_protocolo_tipo", "nome = '$nome_a' $sql_complemto", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$cont_++;
	}//fim while
	if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- O nome ($nome_a) está em uso, não pode ser utilizados nomes iguais! Isso pode confundir o candidato, tente outro nome.";//msg
	}//fim if valida campo
	
	
	
	
	//valida campo dias_amarelo_a -- XXX
	if(($criado_amarelo_a == "") or ($criado_amarelo_a <= "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de CRIADO amarelo deve ser maior que 1, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo dias_vermelho_a -- XXX
	if(($criado_vermelho_a == "") or ($criado_vermelho_a <= "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de CRIADO vermelho deve ser maior que 1, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo dias_vermelho_a -- XXX
	if(($criado_vermelho_a <= $criado_amarelo_a) and ($criado_vermelho_a > "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de CRIADO vermelho não pode menor ou igual dias de CRIADO amarelo, preencha corretamente!";//msg
	}//fim if valida campo	
	
	//valida campo dias_amarelo_a -- XXX
	if(($parado_amarelo_a == "") or ($parado_amarelo_a <= "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de PARADO amarelo deve ser maior que 1, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo dias_vermelho_a -- XXX
	if(($parado_vermelho_a == "") or ($parado_vermelho_a <= "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de PARADO vermelho deve ser maior que 1, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo dias_vermelho_a -- XXX
	if(($parado_vermelho_a <= $parado_amarelo_a) and ($parado_vermelho_a > "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de PARADO vermelho não pode menor ou igual dias de PARADO amarelo, preencha corretamente!";//msg
	}//fim if valida campo	
	
	//valida campo dias_encubar_a -- XXX
	if(($dias_encubar_a == "") or ($dias_encubar_a <= "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Incubação de processo deve ser maior que 1, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo dias_encubar_a -- XXX
	if(($dias_encubar_a <= $parado_vermelho_a) and ($dias_encubar_a > "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Incubação de processo não pode menor ou igual dias de PARADO vermelho, preencha corretamente!";//msg
	}//fim if valida campo
	
	//valida campo criado_amarelo_a parado_vermelho_a -- XXX
	if(($criado_amarelo_a < $parado_amarelo_a) and ($criado_amarelo_a > "0") and ($parado_amarelo_a > "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de CRIADO vermelho não pode menor que dias de PARADO vermelho, preencha corretamente!";//msg
	}//fim if valida camp
		//valida campo criado_vermelho_a parado_amarelo_a -- XXX
	if(($criado_vermelho_a < $parado_vermelho_a) and ($criado_vermelho_a > "0") and ($parado_vermelho_a > "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Quatidade de dias para sinal de CRIADO amarelo não pode menor que dias de PARADO amarelo, preencha corretamente!";//msg
	}//fim if valida camp
	
	
	
	
	

	//verifica lista de serviços informados
	$cont = "0"; $valida_ini = "0"; $valida_vaz = "0";
	while($cont <= $list_cont_a){
		$cont++;
		if((isset($_POST["servico_id".$cont])) and ($_POST["servico_id".$cont] != "")){
			$ordem = getpost_sql($_POST["ordem".$cont]);
			$list_del = getpost_sql($_POST["list_del".$cont]);
			if($list_del == "0"){
				if($ordem == "0"){ $valida_ini++; }
				if($ordem == ""){ $valida_vaz = "1"; }
			}//if($list_del == "0"){
		}//isset
	}//fim while
	/*
	//valida campo valida_ini -- XXX
	if($valida_ini == "0"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Nos serviços informados, não foi definido um serviço inicial em QUANDO EXECUTAR, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo valida_ini -- XXX
	if($valida_ini >= "2"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Nos serviços informados, foi definido $valida_ini serviços como IMEDIATO em QUANDO EXECUTAR, só é possível executar com a abertura UM, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo valida_vaz -- XXX
	if($valida_vaz == "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe QUANDO EXECUTAR nos serviços informados, preencha corretamente!";//msg
	}//fim if valida campo
	*/
	//valida campo servico_categoria_id_a -- XXX
	if(($servico_categoria_id_a >= "1") and ($servico_depto_id_a == "")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Selecione um departamento para início de serviço em aplicativo AXL, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo servico_categoria_id_a -- XXX
	if(($servico_categoria_id_a >= "1") and ($servico_obs_a == "")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe uma descrição para o solicitante do serviço, preencha corretamente!";//msg
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
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso

}//fim isset if(isset($_POST["id_a"])){
	
//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){

	//alinha tab com status
	if($status_a != "1"){ $tab_id = "1"; }else{ $tab_id = "0"; }
	
	
	
	//verifica se existe mapa de tramitação
	$mapa_tramitacao_ = $mapa_tramitacao_a;	
	if($mapa_tramitacao_a != ""){		
		//monta array de dados
		$mapa_tramitacao_a = ""; $cont_or = "0";
		$array = explode(",", $mapa_tramitacao_);
		$cont_ARRAY = ceil(count($array));
		if($cont_ARRAY >= "1"){
			foreach($array as $pos => $valor){//[.ORDEM-PERFIL_ID-DEPTO_ID.]
				if($valor != ""){
					$arrSub = explode("-", $valor);
					//pega dados do depto e perfil
					$linha2 = fSQL::SQL_SELECT_ONE("perfil_id", "sys_perfil_deptos", "id = '".$arrSub["1"]."'", "");
					if($linha2["perfil_id"] >= "1"){
						$cont_or++;
						if($mapa_tramitacao_a != ""){ $mapa_tramitacao_a .= ","; }
						$mapa_tramitacao_a .= $cont_or."-".$linha2["perfil_id"]."-".$arrSub["1"];
					}//if($linha2["perfil_id"] >= "1"){
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
		//fim for exibe array
		if($cont_or == "0"){ $mapa_tramitacao_a = ""; }
		if($mapa_tramitacao_a != ""){ $mapa_tramitacao_a = "[,".$mapa_tramitacao_a.",]"; }
	}//if($mapa_tramitacao_a != ""){
	if($mapa_tramitacao_a == ""){ $mapa_tramitacao_a = 'NULL'; }
	
	
	
	
	
	
	
	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO


	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "adm_protocolo_tipo";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,perfil_id,nome,assunto_padrao,criado_amarelo,criado_vermelho,parado_tipo,parado_amarelo,parado_vermelho,dias_encubar,informacoes,mapa_tramitacao,mapa_depto_id,restricoes_deptos,servico_categoria_id,servico_depto_id,servico_obs,servico_cobranca,servico_solicitante,status,user,time,user_a,sync";
	$valores = array($id_a,$cVLogin->getVarLogin("SYS_USER_PERFIL_ID"),$nome_a,$assunto_padrao_a,$criado_amarelo_a,$criado_vermelho_a,$parado_tipo_a,$parado_amarelo_a,$parado_vermelho_a,$dias_encubar_a,$informacoes_a,$mapa_tramitacao_a,$mapa_depto_id_a,$restricoes_deptos_a,$servico_categoria_id_a,$servico_depto_id_a,$servico_obs_a,$servico_cobranca_a,$servico_solicitante_a,$status_a,$cVLogin->userReg(),time(),"0",time());
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
	
	
	//verifica lista
	$cont = "0"; $itens_log = "";
	while($cont <= $list_cont_a){
		$cont++;
		if((isset($_POST["servico_id".$cont])) and ($_POST["servico_id".$cont] != "")){
			$list_id = $_POST["list_id".$cont];
			$servico_id = $_POST["servico_id".$cont];
			$ordem = $_POST["ordem".$cont];
			//VARS insert simples SQL
			$tabela = "adm_protocolo_tipo_servico";
			//busca ultimo id para insert
			$list_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,tipo_id,ordem,servico_id";
			$valores = array($list_id,$id_a,$ordem,$servico_id);
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			//gera log
			$linha = fSQL::SQL_SELECT_ONE("nome", "fin_servico", "id = '$servico_id'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["nome"]." (Ord.".$ordem.")";
		}//isset
	}//fim while
	//gera log de retorn tabela principal
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "adm_protocolo_tipo_servico";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
		
		

	//verifica se existe intrução no mapa de tramitação
	if(($mapa_tramitacao_ != "") and ($mapa_tramitacao_ != "NULL")){
		//monta array de dados
		$cont_or = "0";
		$array = explode(",", $mapa_tramitacao_);
		$cont_ARRAY = ceil(count($array));
		if($cont_ARRAY >= "1"){
			foreach($array as $pos => $valor){//[.ORDEM-PERFIL_ID-DEPTO_ID.]
				if($valor != ""){
					$arrSub = explode("-", $valor);
					$cont_or++;
					if(isset($_POST["comm-mapa_tramitacao-".$arrSub["2"]])){ $comm = trim($_POST["comm-mapa_tramitacao-".$arrSub["2"]]); }else{ $comm = ""; }
					if($comm != ""){
						//pega dados do depto e perfil
						$linha2 = fSQL::SQL_SELECT_ONE("perfil_id", "sys_perfil_deptos", "id = '".$arrSub["1"]."'", "");
						if($linha2["perfil_id"] >= "1"){
							$id_tramitacao = $cont_or."-".$linha2["perfil_id"]."-".$arrSub["1"];
							//VARS insert simples SQL
							$tabela = "adm_protocolo_tipo_mapa_instru";
							$campos = "tipo_id,mapa,instrucao";
							$valores = array($id_a,$id_tramitacao,$comm);
							$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
						}//if($linha2["perfil_id"] >= "1"){
					}//if($comm != ""){
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
	}//if(($mapa_tramitacao_ != "") and ($mapa_tramitacao_ != "NULL")){
		



	//monta informaçoes de categoria de serviços
	if($servico_categoria_id_a >= "1"){
		$resu1 = fSQL::SQL_SELECT_SIMPLES("processos_tipo", "com_appservicoscategoria", "id = '$servico_categoria_id_a'", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$processos_tipo = $linha1["processos_tipo"];
			if(($processos_tipo != "") and ($processos_tipo != "NULL")){
				if(!preg_match("/\.".$id_a."\./i", $processos_tipo)){ $processos_tipo = str_replace(".]",".".$id_a.".]",$processos_tipo); }
			}else{
				$processos_tipo = "[.".$id_a.".]";
			}
			//atualiza dados da tabela no DB
			$campos = "processos_tipo";
			$valores = array($processos_tipo);
			fSQL::SQL_UPDATE_SIMPLES($campos, "com_appservicoscategoria", $valores, "id = '$servico_categoria_id_a'");
		}//fim while		
	}//if($servico_categoria_id_a >= "1"){
	
	

	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("adm_protocolo_tipo", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("adm_protocolo_tipo",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Novo tipo de solicitação cadastrada com sucesso!$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");



}else{  //############# ELSE - ALTERA REGISTRO |-

	//pega dados atuais antes do update
	$linha0 = fSQL::SQL_SELECT_ONE("nome", "adm_protocolo_tipo", "id = '$id_a'", "");
	$servico_categoria_id_aa = $linha0["servico_categoria_id"];

		
	//atualiza dados da tabela no DB
	$campos = "nome,assunto_padrao,criado_amarelo,criado_vermelho,parado_tipo,parado_amarelo,parado_vermelho,dias_encubar,informacoes,mapa_tramitacao,mapa_depto_id,restricoes_deptos,servico_categoria_id,servico_depto_id,servico_obs,servico_cobranca,servico_solicitante,status,user_a,sync";
	$tabela = "adm_protocolo_tipo";
	$valores = array($nome_a,$assunto_padrao_a,$criado_amarelo_a,$criado_vermelho_a,$parado_tipo_a,$parado_amarelo_a,$parado_vermelho_a,$dias_encubar_a,$informacoes_a,$mapa_tramitacao_a,$mapa_depto_id_a,$restricoes_deptos_a,$servico_categoria_id_a,$servico_depto_id_a,$servico_obs_a,$servico_cobranca_a,$servico_solicitante_a,$status_a,$cVLogin->userReg(),time());
	$condicao = "id='$id_a' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
	
	
	
	//verifica lista 
	$cont = "0"; $itens_log = "";
	while($cont <= $list_cont_a){
		$cont++;
		if((isset($_POST["servico_id".$cont])) and ($_POST["servico_id".$cont] != "")){
			$list_id = $_POST["list_id".$cont];
			$servico_id = $_POST["servico_id".$cont];
			$ordem = $_POST["ordem".$cont];
			if($list_id >= "1"){
				$list_del = $_POST["list_del".$cont];
				if($list_del == "0"){
					//atualiza dados da tabela no DB
					$campos = "ordem,servico_id";
					$tabela = "adm_protocolo_tipo_servico";
					$valores = array($ordem,$servico_id);
					$condicao = "id='$list_id' AND tipo_id = '$id_a'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				}else{//if($list_del == "0"){
					//exclue o registro
					$tabela = "adm_protocolo_tipo_servico";
					$condicao = "id = '$list_id' AND tipo_id = '$id_a'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//if($list_del == "0"){		
			}else{//if($list_id >= "1"){
				//VARS insert simples SQL
				$tabela = "adm_protocolo_tipo_servico";
				//busca ultimo id para insert
				$list_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
				$campos = "id,tipo_id,ordem,servico_id";
				$valores = array($list_id,$id_a,$ordem,$servico_id);
				$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			}//if($list_id >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("nome", "fin_servico", "id = '$servico_id'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["nome"]." (Ord.".$ordem.")";
		}//isset
	}//fim while
	//gera log de retorn tabela principal
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "adm_protocolo_tipo_servico";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
		

		
		

	//verifica se existe intrução no mapa de tramitação
	$sql_remover = "tipo_id = '".$id_a."'";
	if(($mapa_tramitacao_ != "") and ($mapa_tramitacao_ != "NULL")){
		//monta array de dados
		$cont_or = "0";
		$array = explode(",", $mapa_tramitacao_);
		$cont_ARRAY = ceil(count($array));
		if($cont_ARRAY >= "1"){
			foreach($array as $pos => $valor){//[.ORDEM-PERFIL_ID-DEPTO_ID.]
				if($valor != ""){
					$arrSub = explode("-", $valor);
					$cont_or++;
					if(isset($_POST["comm-mapa_tramitacao-".$arrSub["2"]])){ $comm = trim($_POST["comm-mapa_tramitacao-".$arrSub["2"]]); }else{ $comm = ""; }
					if($comm != ""){
						//pega dados do depto e perfil
						$linha2 = fSQL::SQL_SELECT_ONE("perfil_id", "sys_perfil_deptos", "id = '".$arrSub["1"]."'", "");
						if($linha2["perfil_id"] >= "1"){
							$id_tramitacao = $cont_or."-".$linha2["perfil_id"]."-".$arrSub["1"];
							$sql_remover .= " AND mapa != '".$id_tramitacao."'";							
							$id_it = "0";
							$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "adm_protocolo_tipo_mapa_instru", "tipo_id = '".$id_a."' AND mapa = '".$id_tramitacao."'", "");
							while($linha1 = fSQL::FETCH_ASSOC($resu1)){
								$id_it = $linha1["id"];
								$cont_stats++;
							}//fim while
							if($id_it >= "1"){
								$qtd_executando_ct++;
								//atualiza dados da tabela no DB
								$campos = "instrucao";
								$tabela = "adm_protocolo_tipo_mapa_instru";
								$valores = array($comm);
								$condicao = "id='$id_it'";
								fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);				
							}else{//if($id_it >= "1"){
								//VARS insert simples SQL
								$tabela = "adm_protocolo_tipo_mapa_instru";
								$campos = "tipo_id,mapa,instrucao";
								$valores = array($id_a,$id_tramitacao,$comm);
								$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
							}//else{//if($id_it >= "1"){
						}//if($linha2["perfil_id"] >= "1"){
					}//if($comm != ""){
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
	}//if(($mapa_tramitacao_ != "") and ($mapa_tramitacao_ != "NULL")){
	//exclue o registros sem uso
	$tabela = "adm_protocolo_tipo_mapa_instru";
	fSQL::SQL_DELETE_SIMPLES($tabela, $sql_remover);
	
	
		



	//monta informaçoes de categoria de serviços
	if($servico_categoria_id_a != $servico_categoria_id_aa){
		//adiciona novo item
		if($servico_categoria_id_a >= "1"){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("processos_tipo", "com_appservicoscategoria", "id = '$servico_categoria_id_a'", "");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$processos_tipo = $linha1["processos_tipo"];
				if(($processos_tipo != "") and ($processos_tipo != "NULL")){
					if(!preg_match("/\.".$id_a."\./i", $processos_tipo)){ $processos_tipo = str_replace(".]",".".$id_a.".]",$processos_tipo); }
				}else{
					$processos_tipo = "[.".$id_a.".]";
				}
				//atualiza dados da tabela no DB
				$campos = "processos_tipo";
				$valores = array($processos_tipo);
				fSQL::SQL_UPDATE_SIMPLES($campos, "com_appservicoscategoria", $valores, "id = '$servico_categoria_id_a'");
			}//fim while
		}//if($servico_categoria_id_a >= "1"){
		//remove item antigo
		if($servico_categoria_id_aa >= "1"){
			$resu1 = fSQL::SQL_SELECT_SIMPLES("processos_tipo", "com_appservicoscategoria", "id = '$servico_categoria_id_aa'", "");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$processos_tipo = $linha1["processos_tipo"];
				if(($processos_tipo != "") and ($processos_tipo != "NULL")){
					$processos_tipo = str_replace(".".$id_a.".",".",$processos_tipo);
					if($processos_tipo == "[.]"){ $processos_tipo = "NULL"; }
				}
				//atualiza dados da tabela no DB
				$campos = "processos_tipo";
				$valores = array($processos_tipo);
				fSQL::SQL_UPDATE_SIMPLES($campos, "com_appservicoscategoria", $valores, "id = '$servico_categoria_id_aa'");
			}//fim while
		}//if($servico_categoria_id_aa >= "1"){		
	}//if($servico_categoria_id_a != $servico_categoria_id_aa){




	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("adm_protocolo_tipo", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("adm_protocolo_tipo",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso.$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
	
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{
		$id = $id_a;
		$texto = $id." - <b>".$nome_a."</b>";
		
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
	$SQL_campos = "id,nome,criado_amarelo,criado_vermelho,parado_tipo,parado_amarelo,parado_vermelho,dias_encubar,mapa_tramitacao,mapa_depto_id,servico_categoria_id,status,time"; //campos da tabela
	$SQL_tabela = "adm_protocolo_tipo"; //tabela
	$SQL_where = "perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "id";//campo de ordenar
	$ORDEM = "DESC";// ASC ou DESC
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




//verifica tab_id
	if($tab_id == "0"){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " `status` = '1' "; //condição 
	}elseif($tab_id == "1"){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " restricoes_deptos != '' AND restricoes_deptos IS NOT NULL "; //condição 
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("INFO","<b>EXIBINDO: </b> Todos os tipos que estão com restrição de departamentos (só pode iniciar em um determinado(s) depto(s)). Tipos ativos e bloqueados.");	
	}elseif($tab_id == "2"){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " servico_categoria_id >= '1'"; //condição 
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("INFO","<b>EXIBINDO: </b> Todos os tipos que estão disponíveis como SERVIÇOS no Aplicativo AXL. Tipos ativos e bloqueados.");
	}else{
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " `status` != '1' "; //condição 
	}
//fim verifica tab_id




//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){  $filtro_marca[] = $rapida_b;
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( `id` = '$rapida_b' OR `nome` LIKE '%$rapida_b%' OR `assunto_padrao` LIKE '%$rapida_b%' ) "; //condição 
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
	
	//atualiza dados de tabs
	$('.tabs-<?=$INC_FAISHER["div"]?>').removeClass('active');
	$('#<?=$tab_id?>-<?=$INC_FAISHER["div"]?>').addClass('active');
	$('#tab_id<?=$INC_FAISHER["div"]?>').val('<?=$tab_id?>');
	//conta registros aba
	$('#cont-0<?=$INC_FAISHER["div"]?>').html('(<?=fSQL::SQL_CONTAGEM("adm_protocolo_tipo", "`status` = '1' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'")?>)');
	$('#cont-1<?=$INC_FAISHER["div"]?>').html('(<?=fSQL::SQL_CONTAGEM("adm_protocolo_tipo", "restricoes_deptos != '' AND restricoes_deptos IS NOT NULL AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'")?>)');
	$('#cont-2<?=$INC_FAISHER["div"]?>').html('(<?=fSQL::SQL_CONTAGEM("adm_protocolo_tipo", "servico_categoria_id >= '1' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'")?>)');
	$('#cont-3<?=$INC_FAISHER["div"]?>').html('(<?=fSQL::SQL_CONTAGEM("adm_protocolo_tipo", "`status` != '1' AND perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'")?>)');
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
				<?php $c_or = "nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Nome da Solicitação</th>
				<th><?=icoSinalAV("M","1","1","2")?> Dias</th>
				<th><?=icoSinalAV("M","2","1","2")?> Dias</th>
				<?php $c_or = "dias_encubar"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=icoSinalAV("M","INC")?> Dias</th>
				<th>NºServiços</th>
				<th>Ação</th>
			</tr>
		</thead>
	<tbody>
<?php




///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pEdit = "1"; }else{ $pEdit = "0"; }//loginAcesso
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pExc = "1"; }else{ $pExc = "0"; }//loginAcesso


	

//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
	if($n_paginas >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$id_a = $linha1["id"];
	$nome = $linha1["nome"];
	$criado_amarelo = $linha1["criado_amarelo"];
	$criado_vermelho = $linha1["criado_vermelho"];
	$parado_tipo = $linha1["parado_tipo"];
	$parado_amarelo = $linha1["parado_amarelo"];
	$parado_vermelho = $linha1["parado_vermelho"];
	$dias_encubar = $linha1["dias_encubar"];
	$mapa_tramitacao = $linha1["mapa_tramitacao"];
	$mapa_depto_id = $linha1["mapa_depto_id"];
	$servico_categoria_id = $linha1["servico_categoria_id"];
	$status = $linha1["status"];
	$time = $linha1["time"];
//busca dados
	$contTotal = fSQL::SQL_CONTAGEM("adm_protocolo_tipo_servico", "tipo_id = '".$id_a."'");	
	$cont_mapa = substr_count(arrayDB($mapa_tramitacao), ",")+1;
	
	if($parado_tipo == "0"){
		$parado_tipo = "PADRÃO";
	}else{ $parado_tipo++; }
?>
										<tr>
											<td class="sVisu"><b>#<?=$id_a?></b></td>
											<td class="sVisu"><b><?=maiusculo($nome)?></b> <?php if(($mapa_tramitacao != "") and ($mapa_tramitacao != "NULL")){?><br><i class="glyphicon-riflescope"></i> MAPA TRAMITAÇÃO (<?=$cont_mapa?> DEPTOS)<?php }?> <?php if($mapa_depto_id >= "1"){?><br><i style="font-size:11px;">AUTO TRAMITAÇÃO ATIVADA</i><?php }?></td>
											<td class='sVisu'>Criado <b><?=$criado_amarelo?></b><br>Parado <b><?=$parado_amarelo?></b></td>
											<td class='sVisu'>Criado <b><?=$criado_vermelho?></b><br>Parado tipo <b><?=$parado_tipo?></b><br>Parado <b><?=$parado_vermelho?></b></td>
											<td class='sVisu'>Encub. <b><?=$dias_encubar?></b></td>
											<td class='sVisu'><?=$contTotal?> serviço(s) <?php if($servico_categoria_id >= "1"){?><br><i class="glyphicon-iphone"></i> Disp. No App<?php }?></td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
												<?php if(($pExc == "1") and ($status == "1")){?><a href="#" onclick="if(confirm('Gostaria realmete de bloquear o uso de \'<?=$nome?>\'?')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&id_excluir=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="Remover"><i class="icon-remove"></i></a><?php }?>
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
	if(isset($_GET["tab_id"])){ $tab_id = $_GET["tab_id"]; }else{ $tab_id = "0"; }
	
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pCadastro = "OFF"; }//loginAcesso
	
	//include de padrao
	$INC_VAR["tabSel"] = $tab_id;//adicionar array de guias [tab]
	$INC_VAR["tabs"][] = '0[,]<i class="icon-ok-sign"></i> Ativos/tds <span id="cont-0'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '1[,]<i class="icon-group"></i> Em Deptos/tds <span id="cont-1'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '2[,]<i class="glyphicon-iphone"></i> No APP/Portal <span id="cont-2'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '3[,]<i class="icon-minus-sign"></i> Bloqueados <span id="cont-3'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["buscaAvancada"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>