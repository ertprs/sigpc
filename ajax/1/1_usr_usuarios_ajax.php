<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";



 
//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<








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
	<?php $idCJ = "grupo_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	<?php $idCJ = "perfil_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	<?php $idCJ = "perfil_f";?>if($("#<?=$formBusca?> #<?=$idCJ.$INC_FAISHER["div"]?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ.$INC_FAISHER["div"]?>").val(); }

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Filtrando dados...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "nome_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('datai_b'); lCbusca<?=$INC_FAISHER["div"]?>('dataf_b'); }
	<?php $idCJ = "grupo_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }
	<?php $idCJ = "perfil_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
<input type='hidden' value="" name='perfil_f<?=$INC_FAISHER["div"]?>' id='perfil_f<?=$INC_FAISHER["div"]?>' class="limpaInput" />

	<div class="span6">
		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome')?></label>
			<div class="controls">
				<div class="input-append"><input type="text" name="nome_b" id="nome_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe nome ou parte do nome')?>" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Unidade')?></label>
			<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #perfil_b').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Unidade >> (comece a digitar para buscar)')?>',
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
	$("#<?=$formBusca?> #perfil_b").on("change", function(e){ bAvancada<?=$INC_FAISHER["div"]?>(); });	
});
</script>
<input type='hidden' value="" name='perfil_b' id='perfil_b' style=" width:100%;"/>
			</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span6">
		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de cadastro')?></label>
			<div class="controls">
				<div class="input-append"><input type="text" name="datai_b" id="datai_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Data inicial')?>" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div> <?=$class_fLNG->txt(__FILE__,__LINE__,'até')?> 
				<div class="input-append"><input type="text" name="dataf_b" id="dataf_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Data final')?>" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Grupo de acesso')?></label>
			<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #grupo_b').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Grupo de acesso >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=grupoAcesso&full&scriptoff",
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
	$("#<?=$formBusca?> #grupo_b").on("change", function(e){ bAvancada<?=$INC_FAISHER["div"]?>(); });	
});
</script>
<input type='hidden' value="" name='grupo_b' id='grupo_b' style=" width:100%;"/>
			</div>
		</div>
	</div><!-- End .span6 -->

    
	<div class="span12">
		<div class="form-actions">
			<button type="button" class="btn btn-primary enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar agora')?></button>
			<button type="button" class="btn" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');$('#dAbusca<?=$INC_FAISHER["div"]?> .bt_expandebusca').click();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar/Ocultar')?></button>
		</div>
	</div>
</form>
<?php	
	

}//fim ajax  -------------------------------------------- <<<





















//AJAX (lista/preenche combox cargo/função) ------------------------------------------------------------------>>>
if($ajax == "selSistema"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }

	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();

	$row_array['id'] = "1"; $row_array['text'] = legSistema($row_array['id']); array_push($return_arr,$row_array);
	$row_array['id'] = "90130"; $row_array['text'] = legSistema($row_array['id']); array_push($return_arr,$row_array);
	$row_array['id'] = "90131"; $row_array['text'] = legSistema($row_array['id']); array_push($return_arr,$row_array);
	$row_array['id'] = "90132"; $row_array['text'] = legSistema($row_array['id']); array_push($return_arr,$row_array);
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);
}//fim ajax -------------------<<<<







































//AJAX (lista/preenche combox cargo/função) ------------------------------------------------------------------>>>
if($ajax == "addCargo"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "cargo != ''";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca .= " AND ( `cargo` LIKE '%$term%' )"; //condição
	}//fim da busca por nome
	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	//lista ALERTAS
	$tabela = "sys_usuarios";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("cargo", $tabela, $where, "GROUP BY cargo ORDER BY cargo ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["cargo"];
		$legenda = $linha["cargo"];		
		if($legenda == "TI"){ continue; }
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = $legenda;
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);
	}//fim while
		

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);
}//fim ajax -------------------<<<<






































//AJAX (açoes dsconectar usuario sessao) ------------------------------------------------------------------>>>
if($ajax == "selDesconectar"){
	$array_temp = getpost_sql($_GET["array_temp"]);
	$id = getpost_sql($_GET["id"]);
	$desconectar = getpost_sql($_GET["desconectar"]);	
	//exclue o registro
	$tabela = "sys_login_session";
	$condicao = "id = '$desconectar' AND usuarios_id = '".$id."'";
	$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_login_session", "desconectar", $id);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
?>
<script> $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 0, function(){	$("#desconecta_tr<?=$array_temp?>").fadeOut(); }); </script>
<?php
}//fim ajax -------------------<<<<





































//AJAX (abre de pacotes add) ------------------------------------------------------------------>>>
if($ajax == "abrePacotes"){
	$formCadastroPincipal = $_GET["form"];
	$dados = $_GET["dados"];

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroSecundario = "formCadastroSec".$array_temp;
	
	//monta array de dados
	$lista_perfils = "";
	$array = explode("[,]", $dados);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		foreach($array as $pos => $valor){
			if($valor != ""){
				$arraySub = explode(",", $valor);
				//cria lista de ids de perfil
				if($lista_perfils != ""){ $lista_perfils .= ","; } $lista_perfils .= $arraySub["1"];
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	//fim for exibe array
?>


<form id="<?=$formCadastroSecundario?>" name="<?=$formCadastroSecundario?>" action="#" method="POST" class='form-horizontal form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroSec<?=$array_temp?>();return false;">

<div id="divContentLoad<?=$array_temp?>">
             <input name="id_i" type="hidden" id="id_i" value="<?=$id_i?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <div style="padding-top:1px;" id="formSecMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosidentific".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Selecione o tipo de acesso');// titulo
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
											<label class="control-label"> <?=$class_fLNG->txt(__FILE__,__LINE__,'Unidade')?></label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroSecundario?> #iperfil').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione um perfil de acesso >> (comece a digitar para buscar')?>)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilAcesso&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					del: "<?=$lista_perfils?>"
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
	$("#<?=$formCadastroSecundario?> #iperfil").on("change", function(e){ if(($(this).val() == "0") || ($(this).val() == "")){ $('#<?=$formCadastroSecundario?> #igrupo').select2("data", ''); } });
	
});


$.doTimeout('vTimerDefalt', 500, function(){ 
	$('#<?=$formCadastroSecundario?> #iperfil').select2("data", '');
	$('#<?=$formCadastroSecundario?> #igrupo').select2("data", '');
	$('#<?=$formCadastroSecundario?> #iperfil').select2("open");

});
</script>
<input type='hidden' value="" name='iperfil' id='iperfil' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'unidade do grupo de permissões a adicionar.')?></span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Grupo de acesso')?> </label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroSecundario?> #igrupo').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione um grupo de permissões >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=grupoAcesso&scriptoff",
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
	$("#<?=$formCadastroSecundario?> #igrupo").on("change", function(e){
		if($(this).val() != ""){
			faisher_ajax('infGrupo<?=$INC_FAISHER["div"]?>', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=abrePacotesDeptos&grupo='+$(this).val(),'get','ADD');			
		}else{ $('#infGrupo<?=$INC_FAISHER["div"]?>').html('<i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione um grupo!')?>'); }
	});
});
</script>
<input type='hidden' value="" name='igrupo' id='igrupo' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Grupo de permissões a adicionar.')?></span>
											</div>
										</div> 
										<div class="control-group" style="display:none;">
											<label class="control-label">Departamento(s) do grupo</label>
											<div class="controls display" id="infGrupo<?=$INC_FAISHER["div"]?>">
											  <i class="icon-info-sign"></i> Primeiro selecione um grupo de permissões!
											</div>
										</div>  
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            


  <div class="form-actions">
											<button type="submit" class="btn btn-large btn-primary"><?php if($id_i >= "1"){ echo "Salvar alterações"; }else{?><?=$class_fLNG->txt(__FILE__,__LINE__,'Adicionar Novo')?><?php }?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" /></button>
											<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="pmodalDisplay('hide');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
										</div>
</div>
									</form>
<?php
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#".$formCadastroSecundario."').validate().form() == false){ valedaform = \"0\"; }
	if(valedaform == \"1\"){
		loaderFoco('divContentLoad".$array_temp."','divContent_loader_load".$array_temp."',' ".$class_fLNG->txt(__FILE__,__LINE__,'já estamos salvando o registro...')."');//cria um loader dinamico	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=listaPacotes&faisher=$faisher&dados=$dados&form=$formCadastroPincipal";//vars GET de envio URL
$AJAX_FORM_INC = $formCadastroSecundario;//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormCadastroSec".$array_temp;//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = $AJAX_PAG; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "btSalvar".$array_temp.", #divContent_loader_load".$array_temp; //div de carregando
$AJAX_HIDE_INC = ".esconder-sendload".$INC_FAISHER["div"];//esconder ao carregar
$AJAX_SHOW_INC = ".esconder-sendload".$INC_FAISHER["div"];//mostrar ao carregar
$AJAX_PAG_DIV_INC = "divlistaSec".$INC_FAISHER["div"]; //div de dados
$AJAX_COD_SUCESS_INC = ""; //cod java on sucess
$AJAX_SCROLL_INC = "#divlistaSec".$INC_FAISHER["div"];//informe TOP para subir rolagem ao enviar - STOP para a funcionalizade
include "../sys/inc_sendForms.php";
?>
<?php



}//fim ajax -------------------<<<<


//AJAX (abre lista de departamentos de pacotes add) ------------------------------------------------------------------>>>
if($ajax == "abrePacotesDeptos"){
	$grupo = $_GET["grupo"];

	//busca nome grupo
	$linha1 = fSQL::SQL_SELECT_ONE("perfil_depto_id,perfil_deptos", "sys_permissao_grupos", "id = '".$grupo."'");
	$perfil_depto_id = $linha1["perfil_depto_id"];
	$perfil_deptos = arrayDB($linha1["perfil_deptos"]);
	//busca nome depto
	$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil_deptos", "id = '$perfil_depto_id'");
	$depto = $perfil_depto_id.".".$linha1["nome"];
	//busca lista departamentos auxiliares
	$perfil_deptos_n = "";
	if($perfil_deptos != ""){
		//monta array de dados
		$arrayD = explode(".", $perfil_deptos);
		$cont_ARRAYD = ceil(count($arrayD));
		if($cont_ARRAYD >= "1"){
			foreach ($arrayD as $posD => $valorD){
				if($valorD != ""){
					$linha2 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil_deptos", "id = '".$valorD."'", "");
					$perfil_deptos_n .= "<br>".$valorD.".".$linha2["nome"];
				}//if($valorD != ""){
			}//fim foreach
		}//fim if($cont_ARRAYD >= "1"){
	}//if($perfil_deptos != ""){
	echo "<b>$depto</b>$perfil_deptos_n";


}//fim ajax -------------------<<<<



















































//AJAX (lista de permissoes disponiveis para o usuario) ------------------------------------------------------------------>>>
if($ajax == "listaPacotes"){
	$formCadastroPincipal = $_GET["form"];
	$dados = $_GET["dados"];




//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);
	if($id_excluir != ""){
		$array = explode("[,]", $dados);
		$arr = array_diff($array, array($id_excluir));//remove item do array
		$dados = implode("[,]",$arr);
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Registro removido com sucesso!'));
	}else{//and ($id_excluir >= "1")){//verifica permissão
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Não é possível excluir, feche a janela e tente novamente!'));
	}//else ($id_excluir >= "1")){//verifica permissão
//	}//fim else //excluir proprio usuario
}//fim if(isset($_GET["id_excluir"])){
//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||<














//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_i"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$perfil_i = getpost_sql($_POST["iperfil"]);
	$grupo_i = getpost_sql($_POST["igrupo"]);
	$user_i = $cVLogin->getVarLogin("SYS_USER_ID");
	$time_i = time();
		

//VALIDAÇÔES ------------------------------**********
	//valida campo perfil_i -- XXX
	if(($perfil_i == "") or ($perfil_i == "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo perfil de acesso não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo grupo_i -- XXX
	if(($grupo_i == "") or ($grupo_i == "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo grupo de acesso não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo

	//monta array de dados
	$array = explode("[,]", $dados);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		$listaIDS_a = $array; //nome do cookie
		foreach($listaIDS_a as $pos => $valor){
			if($valor != ""){
				$arraySub = explode(",", $valor);
				if($arraySub["1"] == $perfil_i){
					//busca nome perfil
					$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "id = '".$arraySub["1"]."'"); 
					$perfil = $linha1["nome"];
					if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
					$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'A unidade (!!$perfil!!) já está adicionado ao usuário! Pra adicionar grupo diferente, primeiro remova o atual grupo da unidade !!perfil!!.',array("perfil"=>$perfil));//msg
				}//if($arraySub["1"] == $perfil_i){
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	//fim for exibe array


	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($verifica_erro != "0"){//verifica se existe erro
		$verificaRegistro = "0";//reabre form
		?>
		<script>
			//TIMER 
			$.doTimeout('vTimerOPENList', 500, function(){ exibMensagem('formSecMSG<?=$INC_FAISHER["div"]?>','erro','<i class="icon-ban-circle"></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erros encontrados!')?></b><br><?=$verifica_erro?>',60000); });//TIMER
		</script>
		<?php
	}else{//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
		$verificaRegistro = "1";
		?>
		<script>
			//TIMER 
			$.doTimeout('vTimerOPENList', 500, function(){ pmodalDisplay('hide'); });//TIMER
		</script>
		<?php
	}
}//fim isset if(isset($_POST["id_i"])){



//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){

	//adiciona dados
	if($dados != ""){ $dados .= "[,]"; }
	$dados .= "0,".$perfil_i.",".$grupo_i.",".$user_i.",".$time_i;
		
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Grupo de acessos adicionado!'));


}//fim if($verificaRegistro == "1"){//############################################################### FIM VERIFICACOES||<













?>
							<div class="control-group">
                                <div class="span6" style="padding:20px;">
                                    <button class="btn btn-info btn-large" onclick="abrePacotes<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-plus-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Adicionar novo pacote de permissões')?></button>
                                </div>
                            </div>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
								<table class="table table-hover table-nomargin table-bordered" id="table_leitos<?=$INC_FAISHER["div"]?>">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Unidade')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Grupo de Acessos')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Informação')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
										</tr>
									</thead>
									<tbody>
<?php

$cont = "0";

//monta array de dados
$array = explode("[,]", $dados);
$cont_ARRAY = ceil(count($array));
if($cont_ARRAY >= "1"){
	foreach($array as $pos => $valor){
		if($valor != ""){
			$arraySub = explode(",", $valor);
			//busca nome perfil
			$linha1 = fSQL::SQL_SELECT_ONE("nome,apelido", "sys_perfil", "id = '".$arraySub["1"]."'");
			$perfil = $linha1["nome"];
			$perfil_apelido = $linha1["apelido"];
			//busca nome grupo
			$linha1 = fSQL::SQL_SELECT_ONE("nome,perfil_depto_id,perfil_deptos", "sys_permissao_grupos", "id = '".$arraySub["2"]."'");
			$grupo = $linha1["nome"];
			$perfil_depto_id = $linha1["perfil_depto_id"];
			$perfil_deptos = arrayDB($linha1["perfil_deptos"]);
			//busca nome depto
			$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil_deptos", "id = '$perfil_depto_id'");
			$depto = $perfil_depto_id.".".$linha1["nome"];
			//busca lista departamentos auxiliares
			$perfil_deptos_n = "";
			if($perfil_deptos != ""){
				//monta array de dados
				$arrayD = explode(".", $perfil_deptos);
				$cont_ARRAYD = ceil(count($arrayD));
				if($cont_ARRAYD >= "1"){
					foreach ($arrayD as $posD => $valorD){
						if($valorD != ""){
							$linha2 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil_deptos", "id = '".$valorD."'", "");
							$perfil_deptos_n .= "<br>".$valorD.".".$linha2["nome"];
						}//if($valorD != ""){
					}//fim foreach
				}//fim if($cont_ARRAYD >= "1"){
			}//if($perfil_deptos != ""){
			//busca nome user
			$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_usuarios", "id = '".$arraySub["3"]."'");
			$user = $linha1["nome"];
			$cont++;
?>
										<tr>
											<td><b><?=$arraySub["1"].". ".$perfil?></b><br><?=$perfil_apelido?></td>
											<td><?=$grupo?></td>
											<td><?=date("d/m/Y H:i",$arraySub["4"])?>h<br><i><?=$user?></i></td>
											<td>
												<a href="#" onclick="if(confirm('<?=$class_fLNG->txt(__FILE__,__LINE__,'Gostaria realmente de remover')?> \'<?=$perfil?>\'?')) { listaPacotes<?=$INC_FAISHER["div"]?>('id_excluir=<?=$valor?>&dados='+$('#<?=$formCadastroPincipal?> #grupos').val());ancoraHtml('#ancAcaoSec'); }return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover')?>"><i class="icon-remove"></i></a>
                                          </td>
										</tr>
<?php 
		}//if($valor != ""){
	}//fim foreach
}//fim if($cont_ARRAY >= "1"){
//fim for exibe array

?>
									</tbody>
								</table>
<?php if($cont == "0"){?> 
<table class="table table-hover table-nomargin table-bordered">
    <tbody>
        <tr>
      	  <td height="139"><i class="icon-lightbulb"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum resultado correspondente à sua pesquisa.')?></td>
      </tr>
    </tbody>
</table>                                       
<?php }?>  
<script>
$.doTimeout('vTimerDefalt', 50, function(){ $('#<?=$formCadastroPincipal?> #grupos').val('<?=$dados?>'); });
</script>         
<?php

}//fim ajax -------------------<<<<




































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = getpost_sql($_GET["id_a"]);
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	$tabela_lerLog = "sys_usuarios";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "U.id,U.code,U.file,U.nome,U.cargo,U.cpf,U.datan,U.sexo,U.fone,U.celular,U.segundos_session,U.user,U.time,U.user_a,U.sync,U.doc_nome,U.doc_numero,L.email,L.senha_expira,L.senha_erro,L.time_atividade,L.time_s,L.status,L.sistemas";
	$resu1 = fSQL::SQL_SELECT_DUPLO($campos, "sys_usuarios U, sys_login L", "U.id = '$id_a' AND U.id = L.usuarios_id", "GROUP BY U.id");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$code_a = $linha1["code"];
	$file_a = $linha1["file"];
	$nome_a = $linha1["nome"];
	$cargo_a = $linha1["cargo"];
	$doc_nome_a = $linha1["doc_nome"];
	$doc_numero_a = $linha1["doc_numero"];
	$datan_a = data_mysql($linha1["datan"]);
	$sexo_a = $linha1["sexo"];
	$fone_a = $linha1["fone"];
	$celular_a = $linha1["celular"];
	$email_a = $linha1["email"];
	$senha_expira_a = $linha1["senha_expira"];
	$senha_erro_a = $linha1["senha_erro"];
	$segundos_session_a = $linha1["segundos_session"];
	$time_atividade_a = $linha1["time_atividade"];
	$time_s_a = $linha1["time_s"];
	$status_a = $linha1["status"];
	$sistemas_a = arrayDB($linha1["sistemas"]);
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
	$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!'));
	//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
	$cMSG->imprimirMSG();//imprimir mensagens criadas
	exit(0);
}//verifica se nao encontrou nada
	
	
	

	
	$status_a_n = $class_fLNG->txt(__FILE__,__LINE__,'ATIVO');
	if($status_a != "1"){
		$status_a_n = "<b>".$class_fLNG->txt(__FILE__,__LINE__,'BLOQUEADO')."</b><br><i>".$class_fLNG->txt(__FILE__,__LINE__,'Em !!data!!h',array("data"=>date('d/m/Y H:i',$time_a)))."</i>";
	}
	
	
	//monta fim do tempo de atividade
	if($time_atividade_a <= time()){
		$time_atividade_n = "#".$class_fLNG->txt(__FILE__,__LINE__,'FINALIZOU EM')." ".date('d/m/Y H:i', $time_atividade_a)."h (".$class_fLNG->txt(__FILE__,__LINE__,'sem acesso').")";
	}else{
		$time_atividade_n = $class_fLNG->txt(__FILE__,__LINE__,'FINALIZA EM')." ".difHoraTime(time(), $time_atividade_a,0,"");
	}
	

	$sistemas_n = "";
	$array = explode(".",$sistemas_a);
	$cont_ARRAY = count($array);
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				if($sistemas_n != ""){ $sistemas_n .= "<br>"; }	
				$sistemas_n .= legSistema($valor);
			}
		}
	}



	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,time_i,time,ip,origem,faisher", "sys_login_session", "usuarios_id = '".$id_a."'", "ORDER BY time ASC");




//verifica se é pra desconectar sessão
if(isset($_GET["desconectar"])){
	$desconectar = getpost_sql($_GET["desconectar"]);
	//exclue o registro
	$tabela = "sys_login_session";
	$condicao = "id = '$desconectar' AND usuarios_id = '".$id_a."'";
	$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'USUÁRIO DESCONECTADO COM SUCESSO!<br>Será nescessário novo login.'));
}//verifica se nao encontrou nada

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
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'VISUALIZAR DADOS DO USUÁRIO')?> #<?=$id_a?>');

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscad".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados Pessoais do Usuário');// titulo
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
                                        
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'ID')."[,]".$id_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="control-group">
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID')?></label>
                                            <div class="pagination pagination-large">
                                                <ul>
                                                    <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" rel="tooltip" data-placement="bottom" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Registro atual (clique para selecionar)')?>"><?=$id_a?></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        
<?php

$caminho_file = VAR_DIR_FILES."files/usuarios/".$id_a."/fotoperfil.".fGERAL::mostraExtensao($file_a);
if(file_exists($caminho_file)){
	$file_del = "fotoperfil.".fGERAL::mostraExtensao($file_a);
	
	//adiciona no array print
	$d["content"] = '<br><img src="'.$cVLogin->icoFile($caminho_file, "RETORNAURL").'" width="58" />, '.$file_a.', '.fGERAL::tmFile($caminho_file); $d["type"] = "html"; $PRINT_ARRAY[] = $d;
?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto perfil')?></label>
											<div class="controls">
<script>$(document).ready(function(){ $("#<?=$idIframe?>").hide(); });</script>
								<table class="table table-hover table-nomargin table-bordered" id="table_files">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados/Arquivo')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
										</tr>
									</thead>
									<tbody>
										<tr id="tr_<?=$id_a?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="img_<?=$id_a?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$file_a?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#img_<?=$id_a?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
												<a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file_a)?>" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Download')?>"><i class="icon-download-alt"></i></a>
                                          </td>
										</tr>
									</tbody>
								</table>
											</div>
										</div>
<?php 
}//fim do file 

?>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Nome')."[,]".$nome_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome')?></label>
											<div class="controls display">
											  <?=$nome_a?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Cargo/função')."[,]".$cargo_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cargo/função')?></label>
											<div class="controls display">
											  <?=$cargo_a?>
											</div>
										</div>
                                        <?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Documento')."[,]".$doc_nome_a." ".$doc_numero_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento')?></label>
											<div class="controls display">
											  <?=$doc_nome_a?> <?=$doc_numero_a?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')."[,]".$datan_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
											<div class="controls display">
											  <?=$datan_a?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Gênero')."[,]".$sexo_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Gênero')?></label>
											<div class="controls display">
											  <?=$sexo_a?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Celular')."[,]".$celular_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Celular')?></label>
											<div class="controls display">
											  <?=$celular_a?>
											</div>
										</div>

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


<?php


//verifica se está com a senha bloqueada
if($senha_erro_a >= "4"){

?> 
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadossenhabloq".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'SENHA BLOQUEADA - (usuário errou a senha muitas vezes)');// titulo
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
                                        
		
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Email')."[,]".$email_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueio de senha')?></label>
											<div class="controls display">
											  <?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO! Senha do usuário está bloqueada por excesso de tentativas! Para liberar, edite o cadastro do usuário.')?>
											</div>
										</div>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
}//fim if $senha_erro_a




?>    


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscad".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados de Acesso ao Sistema');// titulo
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
                                        
		
										<?php $cont_exib++; $d["content"] = "Email[,]".$email_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Email')?></label>
											<div class="controls display">
											  <?=$email_a?>
											</div>
										</div>
                                        <?php if($time_s_a >= "10"){ $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Última alteração de senha')."[,]".$class_fLNG->txt(__FILE__,__LINE__,'Alterado em !!data!!h',array("data"=>date("d/m/Y H:i",$time_s_a))); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Última alteração de senha')?></label>
											<div class="controls display">
											  <?=$class_fLNG->txt(__FILE__,__LINE__,'Alterado em !!data!!h',array("data"=>date("d/m/Y H:i",$time_s_a)))?>
											</div>
										</div>
                                        <?php }//if($time_s_a >= "10"){ ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Senha expira')?></label>
											<div class="controls display">
											  <?=$class_fLNG->txt(__FILE__,__LINE__,'Em !!data!!h',array("data"=>date("d/m/Y H:i",$senha_expira_a)))?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Sistemas de acesso')."[,]".$sistemas_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sistemas de acesso')?></label>
											<div class="controls display">
											  <?=$sistemas_n?>
											</div>
										</div>                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueio automático')?></label>
											<div class="controls display">
											  <?=$class_fLNG->txt(__FILE__,__LINE__,'Em !!tempo!! minutos',array("tempo"=>$segundos_session_a/60))?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Período de atividade')?></label>
											<div class="controls display-plus">
											  <?=$time_atividade_n?>
											</div>
										</div>
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Status')."[,]".$status_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></label>
											<div class="controls display">
											  <?=$status_a_n?>
											</div>
										</div>

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



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadossess".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Usuário Online - Sessões de Acesso');// titulo
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
                                        

	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'SESSÃO/IP')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'TEMPO ONLINE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ULTIMA ATIVIDADE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ATIVIDADE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'DECONECTAR')?></th>
			</tr>
		</thead>
        <tbody>
<?php
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,time_i,time,ip,origem,faisher", "sys_login_session", "usuarios_id = '".$id_a."'", "ORDER BY time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$time_i_i = $linha1["time_i"];
		$time_i = $linha1["time"];
		$ip_i = $linha1["ip"];
		$origem_i = $linha1["origem"];
		$faisher_i = $linha1["faisher"];
		
		$cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'SESSÃO ATIVA')."[,]".date('d/m/Y H:i',$time_i_i).", ".$class_fLNG->txt(__FILE__,__LINE__,'Acesso').": ".$origem_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr>
                <td><?=$origem_i?><BR><?=$ip_i?></td>
                <td><?=difHoraTime($time_i_i)?></td>
                <td><?=difHoraTime($time_i)?></td>
                <td><?=legFaisher($faisher_i)?></td>
                <td><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>&desconectar=<?=$id_i?>');return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Desconectar usuário do sistema')?>"><i class="icon-off"></i></a></td>
            </tr>
<?php
	}//fim while
?>
        </tbody>
	</table>

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
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadospermissao".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Permissões de Acesso do Usuário');// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						if($id_a >= "1"){ $boxUI_status = "1"; }
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
								<table class="table table-hover table-nomargin table-bordered" id="table_files">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Perfil')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Grupo de Acesso')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Informação')?></th>
										</tr>
									</thead>
									<tbody>     
<?php

	
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,perfil_id,permissao_grupo_id,permissao_grupo_id,user,time", "sys_login_pacote", "usuarios_id = '$id_a'");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$perfil_id_i = $linha1["perfil_id"];
		$permissao_grupo_id_i = $linha1["permissao_grupo_id"];
		$user_i = $linha1["user"];
		$time_i = $linha1["time"];		

		//busca nome perfil
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil", "id = '".$perfil_id_i."'");
		$perfil = $linha1["nome"];
		//busca nome grupo
		$linha1 = fSQL::SQL_SELECT_ONE("nome,perfil_depto_id,perfil_deptos", "sys_permissao_grupos", "id = '".$permissao_grupo_id_i."'");
		$grupo = $linha1["nome"];
		$perfil_depto_id = $linha1["perfil_depto_id"];
		$perfil_deptos = arrayDB($linha1["perfil_deptos"]);
		//busca nome depto
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil_deptos", "id = '$perfil_depto_id'");
		$depto = $permissao_grupo_id_i.".".$linha1["nome"];
		//busca lista departamentos auxiliares
		$perfil_deptos_n = "";
		if($perfil_deptos != ""){
			//monta array de dados
			$arrayD = explode(".", $perfil_deptos);
			$cont_ARRAYD = ceil(count($arrayD));
			if($cont_ARRAYD >= "1"){
				foreach ($arrayD as $posD => $valorD){
					if($valorD != ""){
						$linha2 = fSQL::SQL_SELECT_ONE("nome", "sys_perfil_deptos", "id = '".$valorD."'", "");
						$perfil_deptos_n .= "<br>".$valorD.".".$linha2["nome"];
					}//if($valorD != ""){
				}//fim foreach
			}//fim if($cont_ARRAYD >= "1"){
		}//if($perfil_deptos != ""){
		//busca nome user
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_usuarios", "id = '".$user_i."'");
		$user = date('d/m/Y H:i',$time_i)."h - ".$linha1["nome"];

	//adiciona no array print
	$cont_exib++; $d["content"] = '<br>'.$class_fLNG->txt(__FILE__,__LINE__,'Perfil').':'.$perfil.', '.$class_fLNG->txt(__FILE__,__LINE__,'Departamento').':'.$depto.', '.$class_fLNG->txt(__FILE__,__LINE__,'Grupo').':'.$grupo.', '.$class_fLNG->txt(__FILE__,__LINE__,'Inf.').':'.$user; $d["type"] = "html"; $PRINT_ARRAY[] = $d;
?>
										<tr>
											<td><b><?=$perfil?></b></td>
											<td><?=$grupo?></td>
											<td><?=$user?></td>
										</tr>
<?php 
}//fim do file 

?>
									</tbody>
								</table>
										</div>


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
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infregistro".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Informações do Registro');// titulo
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
                                        
										
										<?php $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Data de cadastro')."[,]".$user_a.", ".date("d/m/Y H:i",$time_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de cadastro')?></label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ $cont_exib++; $d["content"] = $class_fLNG->txt(__FILE__,__LINE__,'Data de alteração')."[,]".$user_a_a.", ".date("d/m/Y H:i",$sync_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de alteração')?></label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($time_a_a != ""){?>
                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Log')?></label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Carregar histórico de alterações do registro')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-eye-close"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Ocultar')?></a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>


									  </div><!-- End .accordion-inner -->
									</div>
                            </div>
                                                    <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
                          </div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);





?>  



  									<div class="form-actions">
											<?php if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Ocultar Janela')?>" onclick="pmodalDisplay('hide');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar Detalhes')?></button>
                                            <script> $.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 1000, function(){ $("#pModalConteudo").scrollTop(0); }); </script>
											<?php }else{//if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar PDF')?>" onclick="enviaPDF<?=$INC_FAISHER["div"]?>();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar PDF(imprimir)')?></button>&nbsp;<button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Exportar CSV')?>" onclick="enviaCSV<?=$INC_FAISHER["div"]?>();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar CSV')?></button>&nbsp;<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="displayAcao<?=$INC_FAISHER["div"]?>('fecha');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
											<?php }//if(isset($_GET["POP"])){ ?>
										</div>

  <input name="acao" id="acao" type="hidden" value="print" />
  <input name="nome" id="nome" type="hidden" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'cadastro_usuarios')?>_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'Usuários')?>" />
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
	$tabela_lerLog = "sys_usuarios";

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
	if(isset($_GET["code"])){ $id_a = "0";
		$aCode = fGERAL::codeRandRetorno(getpost_sql($_GET["code"]));
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id = '".$aCode["id"]."'", "ORDER BY id ASC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//code


if($id_a != "0"){
	$cont = "0";
	$campos = "U.id,U.code,U.fisico_id,U.file,U.nome,U.cargo,U.cpf,U.datan,U.sexo,U.fone,U.celular,U.segundos_session,U.user,U.time,U.user_a,U.sync,U.doc_nome,U.doc_numero,L.email,L.senha_expira,L.senha_erro,L.time_s,L.time_atividade,L.status,L.sistemas";
	$resu1 = fSQL::SQL_SELECT_DUPLO($campos, "sys_usuarios U, sys_login L", "U.id = '$id_a' AND U.id = L.usuarios_id", "GROUP BY U.id");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$code_a = $linha1["code"];
	$fisico_id_a = $linha1["fisico_id"];
	$file_a = $linha1["file"];
	$nome_a = $linha1["nome"];
	$cargo_a = $linha1["cargo"];
	$doc_nome_a = $linha1["doc_nome"];
	$doc_numero_a = $linha1["doc_numero"];
	$datan_a = data_mysql($linha1["datan"]);
	$sexo_a = $linha1["sexo"];
	$fone_a = $linha1["fone"];
	$celular_a = $linha1["celular"];
	$email_a = $linha1["email"];
	$senha_expira_a = $linha1["senha_expira"];
	$senha_erro_a = $linha1["senha_erro"];
	$segundos_session_a = $linha1["segundos_session"];
	$time_s_a = $linha1["time_s"];
	$time_atividade_a = $linha1["time_atividade"];
	$status_a = $linha1["status"];
	$servicos_a = $linha1["servicos"];	
	$sistemas_a = arrayDB($linha1["sistemas"]);
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
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
	

	//alimenta combobox
	if($cargo_a != ""){ $cargo_data = '{id: "'.$cargo_a.'", text: "'.$cargo_a.'"}'; }


	$grupos_dados_a = "";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,perfil_id,permissao_grupo_id,permissao_grupo_id,user,time", "sys_login_pacote", "usuarios_id = '$id_a'");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$perfil_id_i = $linha1["perfil_id"];
		$permissao_grupo_id_i = $linha1["permissao_grupo_id"];
		$user_i = $linha1["user"];
		$time_i = $linha1["time"];
		if($grupos_dados_a != ""){ $grupos_dados_a .= "[,]"; }
		$grupos_dados_a .= $id_i.",".$perfil_id_i.",".$permissao_grupo_id_i.",".$user_i.",".$time_i;
	}
	
	
	//monta fim do tempo de atividade
	if($time_atividade_a <= time()){
		$time_atividade_n = "#".$class_fLNG->txt(__FILE__,__LINE__,'FINALIZOU EM')." ".date('d/m/Y H:i', $time_atividade_a)."h (".$class_fLNG->txt(__FILE__,__LINE__,'sem acesso').")";
	}else{
		$time_atividade_n = $class_fLNG->txt(__FILE__,__LINE__,'FINALIZA EM')." ".difHoraTime(time(), $time_atividade_a,0,"");
	}
	
	$sistemas_data = "";
	$array = explode(".",$sistemas_a);
	$cont_ARRAY = count($array);
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){	
				if($sistemas_data != ""){ $sistemas_data .= ","; }	
				$sistemas_data .= '{id: "'.$valor.'", text: "'.legSistema($valor).'"}';
			}
		}
	}
	if($sistemas_data != ""){ $sistemas_data = "[".$sistemas_data."]"; }


}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$fisico_id_a = "0";
	$nome_a = "";
	$doc_nome_a = "IDENTIDADE";
	$datan_a = "";
	$sexo_a = "M";
	$fone_a = "";
	$celular_a = "";
	$email_a = "";
	$senha_expira_a = date('d/m/Y');
	$segundos_session_a = "600";
	$time_s_a = "0";
	$status_a = "1";
	$grupos_dados_a = "";
	$servicos_a = "";
	$sistemas_a = "";
	
	
//zera as vars de data
	$user_a = $cVLogin->getVarLogin("SYS_USER_NOME");//quem realizou o cadastro
	$time_a = time(); //quando foi realizado o cadastro
	$user_a_a = "";//quel alterou o cadastro
	$sync_a = time(); //quando foi alterado o cadastro


}//limpa os campos se o registro e novo

?>

<script type="text/javascript">
<?php if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){ $('#<?=$formCadastroPincipal?> #div_idred<?=$INC_FAISHER["div"]?>').html("<b><?php if($id_a >= "1"){ echo $id_a; }else{ echo $class_fLNG->txt(__FILE__,__LINE__,'NOVO REGISTRO');}?></b>"); });
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'CADASTRAR NOVO USUÁRIO DO SISTEMA')?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html("<?=$class_fLNG->txt(__FILE__,__LINE__,'EDITAR CADASTRO USUÁRIO DO SISTEMA')?> #<?=$id_a?>");
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
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
<div id="divContent_loader<?=$array_temp?>">
<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroPincipal<?=$array_temp?>();return false;">

             <input name="id_a" type="hidden" id="id_a" value="<?=$id_a?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosusuario".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados Pessoais do Usuário');// titulo
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
											<div class="controls" id="div_idred<?=$INC_FAISHER["div"]?>">
												<div class="input-append input-prepend">
													<input type="text" class='input-medium' id="id_inc<?=$INC_FAISHER["div"]?>" placeholder="<?php if($id_a >= "1"){ echo $id_a; }else{ echo $class_fLNG->txt(__FILE__,__LINE__,'NOVO REGISTRO'); }?>" style="text-align:center;" value="<?php if($id_a >= "1"){ echo $id_a; }?>" rel="tooltip" data-placement="bottom" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe para buscar [Enter]')?>">
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto perfil')?></label>
											<div class="controls">
                                            <?php
                                            //montar IFRAME
											$idTemp = $array_temp;//id do retorno
											$idIframe = "fotoPerfil".$array_temp;//id do iframe
											$arqTipo = "imagens";//tipos de arquivos
											$n_arqQtd = "1";//quantidade de arquivos maximo
											$desc = "0";//ativar descicao, 1 ligado, 0 desligado
											?>
											  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
                                      
<?php

$caminho_file = VAR_DIR_FILES."files/usuarios/".$id_a."/fotoperfil.".fGERAL::mostraExtensao($file_a);
if(file_exists($caminho_file)){
	$file_del = "fotoperfil.".fGERAL::mostraExtensao($file_a);
?>        
<script>$(document).ready(function(){ $("#<?=$idIframe?>").hide(); });</script>
								<table class="table table-hover table-nomargin table-bordered" id="tb_files<?=$INC_FAISHER["div"]?>">
									<thead>
										<tr>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados/Arquivo')?></th>
											<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
										</tr>
									</thead>
									<tbody>
										<tr id="tr_<?=$id_a?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="img_<?=$id_a?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$file_a?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#img_<?=$id_a?>').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
												<a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file_a)?>" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Download')?>"><i class="icon-download-alt"></i></a>
												<a href="#" onClick="delLinhaFile<?=$INC_FAISHER["div"]?>();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover')?>"><i class="icon-remove"></i></a>
                    							<input id="file_del" name="file_del" type="hidden" value="0" />
                                          </td>
										</tr>
									</tbody>
								</table>
<script>
function delLinhaFile<?=$INC_FAISHER["div"]?>(){
	$('#<?=$formCadastroPincipal?> #file_del').val('1');
	$('#<?=$formCadastroPincipal?> #tb_files<?=$INC_FAISHER["div"]?>').fadeOut();
	$("#<?=$formCadastroPincipal?> #<?=$idIframe?>").fadeIn();
}//delLinhaFile
</script>
<?php 
}//fim do file 

?>
											</div>
										</div>
                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome')?></label>
											<div class="controls">
											  <input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="input-xlarge span9 cssFonteMai" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cargo/função')?></label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #cargoFuncao').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione um cargo/função >> (comece a digitar para buscar ou adicionar novo)')?>',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=addCargo&scriptoff",
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
	<?php if($cargo_data != ""){ ?>$("#<?=$formCadastroPincipal?> #cargoFuncao").select2("data", <?=$cargo_data?>);<?php }?>
});
</script>
<input type='hidden' value="" name='cargoFuncao' id='cargoFuncao' style=" width:100%;"/>
                                            <span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Cargo/função administrativa principal do usuário.')?></span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo Documento')?></label>
											<div class="controls">
												<div class="check-demo-col">
													<div class="check-line">
														<input name="doc_nome" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="doc_nome1" value="IDENTIDADE" data-skin="square" data-color="blue" <?php if($doc_nome_a == "IDENTIDADE"){ echo 'checked="checked"'; }?>> <label class='inline' for="doc_nome1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
												  </div>
												</div>
												<div class="check-demo-col">
													<div class="check-line">
														<input name="doc_nome" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="doc_nome2" value="PASSAPORTE" data-skin="square" data-color="blue" <?php if($doc_nome_a == "PASSAPORTE"){ echo 'checked="checked"'; }?>> <label class='inline' for="doc_nome2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
												  </div>
												</div>
											</div>
										</div>                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Documento')?></label>
											<div class="controls">
											  <input type="text" name="doc_numero" id="doc_numero" value="<?=$doc_numero_a?>" class="input-xlarge span9" onkeyup="this.value=this.value.replace(/[^\d]/,'')" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
											<div class="controls">
											  <input type="text" name="datan" id="datan" value="<?=$datan_a?>" class="input-xlarge span3 mask_date" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Gênero')?></label>
											<div class="controls">
												<div class="check-demo-col">
													<div class="check-line">
														<input name="sexo" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="sexo1" value="M" data-skin="square" data-color="blue" <?php if($sexo_a == "M"){ echo 'checked="checked"'; }?>> <label class='inline' for="sexo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Masculino')?></label>
												  </div>
												</div>
												<div class="check-demo-col">
													<div class="check-line">
														<input name="sexo" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="sexo2" value="F" data-skin="square" data-color="blue" <?php if($sexo_a == "F"){ echo 'checked="checked"'; }?>> <label class='inline' for="sexo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Feminino')?></label>
												  </div>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Celular')?></label>
											<div class="controls">
											  <input type="text" name="celular" id="celular" value="<?=$celular_a?>" class="input-xlarge span4 mask_phone" data-rule-required="true">
                                            </div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->




                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosacesso".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Dados de Acesso ao Sistema');// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						if($id_a >= "1"){ $boxUI_status = "1"; }
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Email')?></label>
											<div class="controls">
											  <input type="text" name="email" id="email" value="<?=$email_a?>" class="input-xlarge span9 cssFonteMin" data-rule-email="true" data-rule-required="true">
											</div>
										</div>
                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Senha')?></label>
											<div class="controls">
											  <input type="password" name="senha" id="senha" value="" autocomplete="off" class="input-xlarge span3"<?php if($id_a == "0"){?> data-rule-required="true"<?php }?>>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Última alteração de senha')?></label>
											<div class="controls display">
											  <?php if($time_s_a >= "10"){ echo $class_fLNG->txt(__FILE__,__LINE__,'Alterado em !!data!!h',array("data"=>date("d/m/Y H:i",$time_s_a))); }else{ echo $class_fLNG->txt(__FILE__,__LINE__,'Nunca'); }?>
											</div>
										</div>

<?php


//verifica se está com a senha bloqueada
if($senha_erro_a >= "4"){

?> 
										<div class="control-group">
											<label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Senha bloqueada')?></label>
											<div class="controls">
												<div class="check-line">
													<input type="checkbox" id="senha_erro" name="senha_erro" class='<?=$INC_FAISHER["div"]?>-icheck' data-skin="square" data-color="red"> <label class='inline' for="senha_erro"><?=$class_fLNG->txt(__FILE__,__LINE__,'Desbloquear senha de usuário')?></label>
												</div>
												<span class="help-block" style="color:#F00;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO! Senha do usuário está bloqueada por excesso de tentativas! Para liberar, marque esse campo.')?></span>
											</div>
										</div>
<?php


}//if($senha_erro_a >= "5"){
//verifica se está com a senha bloqueada

?> 
                                        
										<div class="control-group">
											<label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Expirar a senha')?></label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="senha_expira" id="senha_expira" value="<?=date('d/m/Y',$senha_expira_a)?>" class='input-small mask_date datepick' data-rule-required="true">
													<span class="add-on icon-calendar"></span>
												</div>
												<span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Após esse data assim que efetuar o login, o usuário é solicitado a alterar a senha atual.')?></span>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueio automático')?></label>
											<div class="controls">
                                                <select data-placeholder="Selecione " class="select2-me" style="width:200px;" name="segundos_session" id="segundos_session">
                                                    <option value="300" <?php if($segundos_session_a == "300"){ echo "selected"; } ?>><?=$class_fLNG->txt(__FILE__,__LINE__,'!!mins!! minutos',array("mins"=>"05"))?></option>
                                                    <option value="600" <?php if($segundos_session_a == "600"){ echo "selected"; } ?>><?=$class_fLNG->txt(__FILE__,__LINE__,'!!mins!! minutos',array("mins"=>"10"))?> (<?=$class_fLNG->txt(__FILE__,__LINE__,'padrão')?>)</option>
                                                    <option value="900" <?php if($segundos_session_a == "900"){ echo "selected"; } ?>><?=$class_fLNG->txt(__FILE__,__LINE__,'!!mins!! minutos',array("mins"=>"15"))?></option>
                                                    <option value="1500" <?php if($segundos_session_a == "1500"){ echo "selected"; } ?>><?=$class_fLNG->txt(__FILE__,__LINE__,'!!mins!! minutos',array("mins"=>"25"))?></option>
                                                </select>
												<span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Tempo para bloqueio automático de sessão do usuário, solicitando senha novamente. *O bloqueio ocorre se houver inatividade.')?></span>
											</div>
										</div>
                                        
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Sistemas de acesso')?></label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #sistemas').select2({
		maximumSelectionSize: 100,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione o(s) sistema(s)')?>',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=selSistema&scriptoff",
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
	<?php if($sistemas_data != ""){ ?>$("#<?=$formCadastroPincipal?> #sistemas").select2("data", <?=$sistemas_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='sistemas' id='sistemas' style=" width:100%;"/>
											</div>
										</div>                                        
                                        
										<div class="control-group">
											<label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Período de atividade')?></label>
											<div class="controls">
                                                <select data-placeholder="Selecione " class="select2-me span6" name="time_atividade" id="time_atividade">
                                                    <?php if($time_atividade_n != ""){?><option value="<?=$time_atividade_a?>" selected><?=$time_atividade_n?></option><?php }?>
                                                    <option value="M6"><?=$class_fLNG->txt(__FILE__,__LINE__,'!!meses!! meses',array("meses"=>"6"))?></option>
                                                    <option value="M12" <?php if($time_atividade_n == ""){ echo "selected"; } ?>><?=$class_fLNG->txt(__FILE__,__LINE__,'!!meses!! meses',array("meses"=>"12"))?> (<?=$class_fLNG->txt(__FILE__,__LINE__,'padrão')?>)</option>
                                                    <option value="M24"><?=$class_fLNG->txt(__FILE__,__LINE__,'!!meses!! meses',array("meses"=>"24"))?></option>
                                                </select>
												<span class="help-block" style="clear:both;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Esse é o tempo de atividade que o usuário poder utilizar o acesso ao sistema.<br><b>*APÓS O PERÍODO O USUÁRIO PERDE O ACESSO, SENDO NECESSÁRIO SER RENOVADO PELA TI</b>')?></span>
											</div>
										</div>
                                        
										
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status do acesso ao sistema')?></label>
											<div class="controls">
												<div class="check-demo-col">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status1" value="1" data-skin="square" data-color="green" <?php if($status_a == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ativo (com acesso)')?></label>
												  </div>
												</div>
												<div class="check-demo-col">
													<div class="check-line">
														<input name="status" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="status2" value="0" data-skin="square" data-color="red" <?php if($status_a != "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="status2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueado')?> (<?=$class_fLNG->txt(__FILE__,__LINE__,'sem acesso')?><?php if(($status_a != "1") and ($time_a >= "10")){ echo date("d/m/Y H:i",$time_a)."h"; }?>)</label>
												  </div>
												</div>
											</div>
										</div>
                                        
                                        
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->    



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadossess".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Usuário Online - Sessões de Acesso');// titulo
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
                                        

	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'SESSÃO/IP')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'TEMPO ONLINE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ULTIMA ATIVIDADE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ATIVIDADE')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'DESCONECTAR')?></th>
			</tr>
		</thead>
        <tbody>
<?php
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,time_i,time,ip,origem,faisher", "sys_login_session", "usuarios_id = '".$id_a."'", "ORDER BY time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$time_i_i = $linha1["time_i"];
		$time_i = $linha1["time"];
		$ip_i = $linha1["ip"];
		$origem_i = $linha1["origem"];
		$faisher_i = $linha1["faisher"];
		
		$cont_exib++; $d["content"] = "SESSÃO ATIVA[,]".date('d/m/Y H:i',$time_i_i).", Acesso: ".$origem_i; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr id="desconecta_tr<?=$array_temp?>">
                <td><?=$origem_i?><BR><?=$ip_i?></td>
                <td><?=difHoraTime($time_i_i)?></td>
                <td><?=difHoraTime($time_i)?></td>
                <td><?=legFaisher($faisher_i)?></td>
                <td><a href="#" onclick="faisher_ajax('div_oculta', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=selDesconectar&array_temp=<?=$array_temp?>&desconectar=<?=$id_i?>&id=<?=$id_a?>');$('#trSess<?=$id_i?>').fadeOut();return false;" class="btn btn-warning" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Desconectar sessão de usuário')?>"><i class="icon-off"></i></a></td>
            </tr>
<?php
	}//fim while
?>
        </tbody>
	</table>
	<span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Para desconectar o usuário, acesse visualizar o registro do mesmo.')?></span>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }






?>  
  
  
            
            

        <a name="ancAcaoSec" id="ancAcaoSec"></a>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "ddadosvagass".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Permissões de Acesso do Usuário');// titulo
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
                                        	
                                            <div id="divlistaSecMSG<?=$INC_FAISHER["div"]?>"></div>
											<div style="min-height:100px;" id="divlistaSec<?=$INC_FAISHER["div"]?>"></div>
<script>
//TIMER
$.doTimeout('vTimerOnLoadSec<?=$INC_FAISHER["div"]?>', 0, function(){
	listaPacotes<?=$INC_FAISHER["div"]?>('');
});//TIMER
function listaPacotes<?=$INC_FAISHER["div"]?>(v_get){
	loaderFoco('ac_<?=$boxUI_id?>','divlistaSec<?=$INC_FAISHER["div"]?>_load',' <?=$class_fLNG->txt(__FILE__,__LINE__,'já estamos carregando a listagem...')?>');//cria um loader dinamico
	faisher_ajax('divlistaSec<?=$INC_FAISHER["div"]?>', 'divlistaSec<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=listaPacotes&dados='+$('#<?=$formCadastroPincipal?> #grupos').val()+'&form=<?=$formCadastroPincipal?>&'+v_get);
}//listaLeitos

function abrePacotes<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class="icon-pencil"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'ADICIONAR NOVO PACOTE DE PERMISSÕES')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=abrePacotes&form=<?=$formCadastroPincipal?>&dados='+$('#<?=$formCadastroPincipal?> #grupos').val());
}//abrePacotes

</script>
                                        
                                        <div style="display:block; height:50px;"></div>
										<input id="grupos" name="grupos" type="hidden" value="<?=$grupos_dados_a?>" />
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
  




            
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infcadastrais".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Informações do Registro');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de cadastro')?></label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de alteração')?></label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($user_a_a != ""){?>

                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Log')?></label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Carregar histórico de alterações do registro')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-eye-close"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Ocultar')?></a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>
                                        
                                        
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->                            





										<div class="form-actions">
											<button type="submit" class="btn btn-large btn-primary"><?php if($id_a >= "1"){ echo $class_fLNG->txt(__FILE__,__LINE__,'Salvar alterações'); }else{?><?=$class_fLNG->txt(__FILE__,__LINE__,'Salvar')?><?php }?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" /></button>
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
	if(isset($_GET["tab_id"])){			$tab_id = getpost_sql($_GET["tab_id"]);			}else{ $tab_id = "0";		}




//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){
		//verifica se é proprio usuario
		if($cVLogin->getVarLogin("SYS_USER_ID") != $id_excluir){//verifica permissão
	
			//atualiza dados da tabela no DB
			$campos = "time,status";
			$tabela = "sys_login";
			$valores = array(time(),"0");
			$condicao = "usuarios_id='$id_excluir'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("sys_usuarios", "bloquear", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Registro bloqueado com sucesso!'));
		}else{ $cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Erro na verificação do ID, não é possível bloquear seu próprio usuário!')); }//fim else //excluir proprio usuario
	}else{
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Erro nas permissões de seu usuário!'));
	}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){//verifica permissão

}//fim if(isset($_GET["id_excluir"])){
//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||<










//################################### ADICIONAR PERÍODO - SQL ||||||||||||||||>
if(isset($_GET["id_add"])){
	$id_add = getpost_sql($_GET["id_add"]);
	$time_at = getpost_sql($_GET["time_at"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){			
		$campos = "U.code,U.nome,L.id AS login_id";
		$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_usuarios U, sys_login L", "U.id = '$id_add' AND U.id = L.usuarios_id", "GROUP BY U.id");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$login_id = $linha1["login_id"];
			//monta período de atividade
			$time_atividade_val = "";
			if($time_at == "M6"){ $time_atividade_val = strtotime("+6 months"); $pacote = "6"; }
			if($time_at == "M12"){ $time_atividade_val = strtotime("+12 months"); $pacote = "12"; }
			if($time_at == "M24"){ $time_atividade_val = strtotime("+24 months"); $pacote = "24"; }
			//aplica pacote
			if($time_atividade_val != ""){
				//atualiza dados da tabela no DB
				$campos = "time_atividade";
				$tabela = "sys_login";
				$valores = array($time_atividade_val);
				$condicao = "id='$login_id'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria			
				//GERA AÇÃO DO USUÁRIO NA TABELA
				$cVLogin->addAcaoUser("sys_usuarios", "editar", $id_add);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
				fGERAL::gravaLog("sys_login",$login_id,$ARRAY_LOG,$cVLogin->userReg());
				//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
				$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Foi adicionado !!pacote!! meses de atividade ao usuário',array("pacote"=>"<b>".$pacote."</b>")).": ".$id_add.$linha1["nome"]);
				$tab_id = "0";



//atualiza informação de PONTUAÇÂO TELA HOJE ---- =+++++ ----------------------------------------------->>>
?>
<script type="text/javascript">
$.doTimeout('vTimerPont<?=$INC_FAISHER["div"]?>', 500, function(){atualizaPainelHojeBackground(); });//TIMER
</script>
<?php
//atualiza informação de PONTUAÇÂO TELA HOJE ---- =+++++ -----------------------------------------------<<<
			}//if($time_atividade_val != ""){		
		}//fim while
		
		
	}else{
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Erro nas permissões de seu usuário!'));
	}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){//verifica permissão

}//fim if(isset($_GET["id_excluir"])){
//################################### ADICIONAR PERÍODO - SQL ||||||||||||||||<









 






//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$nome_a = getpost_sql($_POST["nome"],"MAIUSCULO");
	$cargo_a = getpost_sql($_POST["cargoFuncao"],"MAIUSCULO");
	$doc_nome_a = getpost_sql($_POST["doc_nome"]);
	$doc_numero_a = getpost_sql($_POST["doc_numero"]);	
	$datan_a = data_mysql(getpost_sql($_POST["datan"]));
	$sexo_a = getpost_sql($_POST["sexo"]);
	$fone_a = getpost_sql($_POST["fone"]);
	$celular_a = getpost_sql($_POST["celular"]);
	$email_a = getpost_sql($_POST["email"]);
	$senha_a = getpost_sql($_POST["senha"]);
	$senha_expira_a = getpost_sql($_POST["senha_expira"]);
	$segundos_session_a = getpost_sql($_POST["segundos_session"]);
	$time_atividade_a = getpost_sql($_POST["time_atividade"]);
	$status_a = getpost_sql($_POST["status"]);
	$grupos_a = getpost_sql($_POST["grupos"]);
	$sistemas_a = getpost_sql($_POST["sistemas"],"ARRAY-P");
	if(isset($_POST["senha_erro"])){ $senha_erro_a = "1"; }else{ $senha_erro_a = "0"; }
		
		

 
//VALIDAÇÔES ------------------------------**********
	//valida campo nome -- XXX
	if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo nome não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo cargo -- XXX
	if($cargo_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo cargo/função não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo doc_numero_a -- XXX
	if($doc_numero_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo nº documento não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo doc_numero_a -- XXX
	if($doc_numero_a != ""){
		//verifica se já existe documento na base
		$sql_complemto = " AND id != '$id_a'";	
		if($id_a == "0"){ $sql_complemto = "";	}//if($id_a == "0"){
		//verifica se já existe no sistem
		$cont_ = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_usuarios", "doc_nome = '$doc_nome_a' AND doc_numero = '$doc_numero_a' $sql_complemto", "", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$cont_++;
		}//fim while
		if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'O Documento (!!doc!!) está em uso por um usuário! Verifique ou utilize outro documento.',array("doc"=>$doc_nome_a." ".$doc_numero_a));//msg
		}//fim if valida campo
		
	}//if($cpf_a != ""){
	
	//valida campo datan_a -- XXX
	if($datan_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo data de nascimento não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo celular_a -- XXX
	if($celular_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo celular não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo email -- XXX
	if($email_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo email não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo qtd permissoes -- XXX
	if($cont_p == "0"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Selecione no mínimo uma permissão disponível!');//msg
	}//fim if valida campo
	
	$sql_complemto = " AND usuarios_id != '$id_a'";	
	if($id_a == "0"){
		$sql_complemto = "";
		//valida campo senha -- XXX
		if($senha_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo senha não pode estar vazio, preencha corretamente!');//msg
		}//fim if valida campo
	}//if($id_a == "0"){
	//verifica se já existe no sistem
	$cont_ = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_login", "email = '$email_a' $sql_complemto", "", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$cont_++;
	}//fim while
	if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'O email (!!email!!) está em uso por um usuário, não pode ser um administrador! Utilize outro email.',array("email"=>$email_a));//msg
	}//fim if valida campo
	//valida campo senha_a -- XXX
	if(($id_a == "0") and ($senha_a == "")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Campo senha não pode estar vazio, preencha corretamente!');//msg
	}//fim if valida campo
	//valida campo grupos_a -- XXX
	//if($grupos_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		//$verifica_erro .= "- ".$class_fLNG->txt(__FILE__,__LINE__,'Adicione no mínimo um pacote de permissões, preencha corretamente!');//msg
	//}//fim if valida campo
	




	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($verifica_erro != "0"){//verifica se existe erro
		$verificaRegistro = "0";//reabre form
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro',"<i class='icon-ban-circle'></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erros encontrados!')?></b><br><?=$verifica_erro?>",60000);
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
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Usuário sem permissão de acesso! Verifique com administrador.'));
	}//loginAcesso
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Usuário sem permissão de acesso! Verifique com administrador.'));
	}//loginAcesso

}//fim isset if(isset($_POST["id_a"])){
	
//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){

	//converte data de senha em time UNIX
	$senha_expira_a = time_data_hora($senha_expira_a." 00:00");
	
	
	//monta período de atividade
	$time_atividade_val = "";
	if($time_atividade_a == "M6"){ $time_atividade_val = strtotime("+6 months"); }
	if($time_atividade_a == "M12"){ $time_atividade_val = strtotime("+12 months"); }
	if($time_atividade_a == "M24"){ $time_atividade_val = strtotime("+24 months"); }
	
	
	$tab_id = "0";
	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO

	$code_a = fGERAL::codeRand(4).fTBL::idTabela("sys_usuarios");
	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "sys_usuarios";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,code,fisico_id,nome,cargo,doc_nome,doc_numero,datan,sexo,fone,celular,segundos_session,user,time,user_a,sync";
	$valores = array($id_a,$code_a,$fisico_id,$nome_a,$cargo_a,$doc_nome_a,$doc_numero_a,$datan_a,$sexo_a,$fone_a,$celular_a,$segundos_session_a,$cVLogin->userReg(),time(),"0",time());
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
	//cria a pasta de arquivos do usuario
	$file_c = VAR_DIR_FILES."files/usuarios/".$id_a; //caminho/nome da pasta
	$cria = cria_pasta($file_c, "0777"); //confere a criação e retona 1
		
	

	//verifica as permissoes adicionadas
	$cont_permissao = "0"; $itens_log = "";
	//monta array de dados
	$array = explode("[,]", $grupos_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		$listaIDS_a = $array; //nome do cookie
		foreach($listaIDS_a as $pos => $valor){
			if($valor != ""){
				$arraySub = explode(",", $valor);
				if($arraySub["0"] == "0"){
					//verifica se já existe no sistem
					$cont_ = fSQL::SQL_CONTAGEM("sys_login_pacote", "usuarios_id = '".$id_a."' AND perfil_id = '".$arraySub["1"]."'", "2");
					if($cont_ >= "1"){ }else{
						//VARS insert simples SQL
						$tabela = "sys_login_pacote";
						//busca ultimo id para insert
						$id_p = fSQL::SQL_SELECT_INSERT($tabela, "id");
						$campos = "id,usuarios_id,perfil_id,permissao_grupo_id,user,time";
						$valores = array($id_p,$id_a,$arraySub["1"],$arraySub["2"],$cVLogin->userReg(),time());
						fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
					}//fim if valida campo
					$linha = fSQL::SQL_SELECT_ONE("P.nome AS perfil, G.nome AS grupo", "sys_perfil P, sys_permissao_grupos G", "P.id = '".$arraySub["1"]."' AND G.id = '".$arraySub["2"]."'", "");
					if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["perfil"]."(".$linha["grupo"].")";
					
				}//if($arraySub["0"] == "0"){
				$cont_permissao++;	
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	//fim for exibe array
	if($cont_permissao == "0"){ $status_a = "0"; }
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "sys_login_pacote";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
		
	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "sys_login";
	//busca ultimo id para insert
	$id_l = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,usuarios_id,email,senha,senha_expira,time_s,time_u,time_atividade,time,sistemas,status";
	$valores = array($id_l,$id_a,$email_a,fGERAL::cryptoSenhaDB($senha_a),$senha_expira_a,"0","0",$time_atividade_val,time(),$sistemas_a,$status_a);
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria





//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	$msg_cont = "";	$cont_arquivo = "0";
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'fotoPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$nome_e = $linha["nome"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//preparando o envio do arquivo temp para o definitivo
			$upload_dir = $file_c."/";
			$arquivo_n = "fotoperfil.".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
			fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//atualiza dados da tabela no DB
			$campos = "file";
			$tabela = "sys_usuarios";
			$valores = array($nome_e);
			$condicao = "id='$id_a'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
	if($cont_arquivo >= "1"){ $msg_cont = " $cont_arquivo ".$class_fLNG->txt(__FILE__,__LINE__,'arquivo(s) recebido(s).');	}
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<







	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_usuarios", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_usuarios",$id_a,$ARRAY_LOG,$cVLogin->userReg());
		fGERAL::gravaLog("sys_login",$id_l,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Usuário cadastrado com sucesso!')."$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"".$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')."\"><i class=\"icon-search\"></i></a>");



}else{  //############# ELSE - ALTERA REGISTRO |-



	$linha1 = fSQL::SQL_SELECT_ONE("file", "sys_usuarios", "id = '$id_a'");
	$file_aa = $linha1["file"];
		
	//atualiza dados da tabela no DB
	$campos = "nome,cargo,datan,sexo,fone,celular,segundos_session,user_a,sync";
	$tabela = "sys_usuarios";
	$valores = array($nome_a,$cargo_a,$datan_a,$sexo_a,$fone_a,$celular_a,$segundos_session_a,$cVLogin->userReg(),time());
	$condicao = "id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
	//cria a pasta de arquivos do usuario
	$file_c = VAR_DIR_FILES."files/usuarios/".$id_a; //caminho/nome da pasta
	$cria = cria_pasta($file_c, "0777"); //confere a criação e retona 1



	
	//verifica as permissoes adicionadas
	$cont_permissao = "0"; $itens_log = "";
	$array_permissoes_antigo = array();
	$array_permissoes_a = array();
	//monta array de dados
	$array = explode("[,]", $grupos_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		$listaIDS_a = $array; //nome do cookie
		foreach($listaIDS_a as $pos => $valor){
			if($valor != ""){
				$arraySub = explode(",", $valor);
				if($arraySub["0"] == "0"){
					//verifica se já existe no sistem
					$cont_ = fSQL::SQL_CONTAGEM("sys_login_pacote", "usuarios_id = '".$id_a."' AND perfil_id = '".$arraySub["1"]."'", "2");
					if($cont_ >= "1"){					
						//exclue o registro caso exista
						$tabela = "sys_login_pacote";
						$condicao = "usuarios_id = '".$id_a."' AND perfil_id = '".$arraySub["1"]."'";
						fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);	
					}
					//adicionar nova permissão a lista
					//VARS insert simples SQL
					$tabela = "sys_login_pacote";
					//busca ultimo id para insert
					$id_p = fSQL::SQL_SELECT_INSERT($tabela, "id");
					$campos = "id,usuarios_id,perfil_id,permissao_grupo_id,user,time";
					$valores = array($id_p,$id_a,$arraySub["1"],$arraySub["2"],$cVLogin->userReg(),time());
					fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
					$array_permissoes_a[] = $id_p;
									
				}else{ $array_permissoes_a[] = $arraySub["0"]; }//if($arraySub["0"] == "0"){
				$cont_permissao++;
				
				//cria log
				$linha = fSQL::SQL_SELECT_ONE("P.nome AS perfil, G.nome AS grupo", "sys_perfil P, sys_permissao_grupos G", "P.id = '".$arraySub["1"]."' AND G.id = '".$arraySub["2"]."'", "");
				if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["perfil"]."(".$linha["grupo"].")";
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "sys_login_pacote";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
	//fim for exibe array
	if($cont_permissao == "0"){
		$status_a = "0";
		//exclue o registro
		$tabela = "sys_login_pacote";
		$condicao = "usuarios_id = '$id_a'";
		$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	}else{//if($cont_permissao == "0"){
		//busca permissoes atuais
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_login_pacote", "usuarios_id = '$id_a'");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$array_permissoes_antigo[] = $linha1["id"];
		}
		$array_excluir = array_diff($array_permissoes_antigo, $array_permissoes_a);//remove item do array
		//echo "<pre>"; print_r($array_excluir); print_r($array_permissoes_antigo); print_r($array_permissoes_a); echo "</pre>";
		//monta array de dados
		$cont_ARRAY = ceil(count($array_excluir));
		if($cont_ARRAY >= "1"){
			$listaIDS_a = $array_excluir; //nome do cookie
			foreach($listaIDS_a as $pos => $valor){
				if(($valor != "") and ($valor >= "1")){	
					//exclue o registro
					$tabela = "sys_login_pacote";
					$condicao = "id = '$valor'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
		//fim for exibe array
	}//}else{//if($cont_permissao == "0"){
		
		
		
	//atualiza dados da tabela no DB
	$campos = "senha_expira,email,status,sistemas";
	$tabela = "sys_login";
	$valores = array($senha_expira_a,$email_a,$status_a,$sistemas_a);
	if($senha_a != ""){ $campos .= ",senha"; $valores[] = fGERAL::cryptoSenhaDB($senha_a); $campos .= ",time_s"; $valores[] = time(); }
	if($senha_erro_a == "1"){ $campos .= ",senha_erro"; $valores[] = "0"; }
	if($time_atividade_val != ""){ $campos .= ",time_atividade"; $valores[] = $time_atividade_val; }
	$condicao = "usuarios_id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$id_l = fSQL::SQL_SELECT_UNICO("id",$tabela, $condicao);//select pega id da tabela em questao
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
		
	

	
//########################################### EXCLUIR FOTOS ####################################>>>>>>>>>>>
	if((isset($_POST["file_del"])) and ($_POST["file_del"] >= "1")){
		if($file_aa != ""){
			delete(VAR_DIR_FILES."files/usuarios/".$id_a."/fotoperfil.".fGERAL::mostraExtensao($file_aa));
			fBKP::bkpDelFile(VAR_DIR_FILES."files/usuarios/".$id_a."/fotoperfil.".fGERAL::mostraExtensao($file_aa));//adiciona arquivo em lista de excluídos BACKUP
		}
	}//isset
//########################################### EXCLUIR FOTOS ####################################<<<<<<<<<<< 

//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	$msg_cont = "";	$cont_arquivo = "0";
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'fotoPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
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
			if($file_aa != ""){
				delete($file_c."/fotoperfil.".fGERAL::mostraExtensao($file_aa));
				fBKP::bkpDelFile($file_c."/fotoperfil.".fGERAL::mostraExtensao($file_aa));//adiciona arquivo em lista de excluídos BACKUP
			}
			//preparando o envio do arquivo temp para o definitivo
			$upload_dir = $file_c."/";
			$arquivo_n = "fotoperfil.".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
			fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//atualiza dados da tabela no DB
			$campos = "file";
			$tabela = "sys_usuarios";
			$valores = array($nome_e);
			$condicao = "id='$id_a'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
	if($cont_arquivo >= "1"){ $msg_cont = " $cont_arquivo ".$class_fLNG->txt(__FILE__,__LINE__,'arquivo(s) recebido(s).');	}
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<









	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_usuarios", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_usuarios",$id_a,$ARRAY_LOG,$cVLogin->userReg());
		fGERAL::gravaLog("sys_login",$id_l,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Registro atualizado com sucesso.')."$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"".$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')."\"><i class=\"icon-search\"></i></a>");
	if($senha_erro_a == "1"){
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Senha foi desbloqueada com sucesso! Usuário liberado para login.'));
	}



//atualiza informação de PONTUAÇÂO TELA HOJE ---- =+++++ ----------------------------------------------->>>
?>
<script type="text/javascript">
$.doTimeout('vTimerPont<?=$INC_FAISHER["div"]?>', 500, function(){atualizaPainelHojeBackground(); });//TIMER
</script>
<?php
//atualiza informação de PONTUAÇÂO TELA HOJE ---- =+++++ -----------------------------------------------<<<
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{		
		$id = $id_a;
		$texto = "<b>".$nome_a."</b><br>".$class_fLNG->txt(__FILE__,__LINE__,'Doc.')." ".$doc_nome_a." ".$doc_numero_a;
		
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
	$SQL_campos = "U.id,U.code,U.file,U.nome,U.cargo,U.doc_nome,U.doc_numero,U.sexo,U.sync,L.email,L.time_atividade,L.status,L.senha_erro,L.time_u"; //campos da tabela
	$SQL_tabela = "sys_usuarios U"; //tabela
	$SQL_join = "INNER JOIN sys_login L LEFT JOIN sys_login_pacote P ON P.usuarios_id = U.id"; //join
	$SQL_where = "U.id = L.usuarios_id AND U.status <> '2'"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "U.nome";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
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




//pega vars de busca
	unset($filtro_b);
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["nome_b"])){       					 $nome_b = getpost_sql($_GET["nome_b"]);       		     			  }else{ $nome_b = "";    		    }
	if(isset($_GET["datai_b"])){       					 $datai_b = getpost_sql($_GET["datai_b"]);       		   			  }else{ $datai_b = "";    		    }
	if(isset($_GET["dataf_b"])){       					 $dataf_b = getpost_sql($_GET["dataf_b"]);       		   			  }else{ $dataf_b = "";    		    }
	if(isset($_GET["grupo_b"])){      					 $grupo_b = getpost_sql($_GET["grupo_b"]);      		   			  }else{ $grupo_b = "";   		    }
	if(isset($_GET["perfil_b"])){      					 $perfil_b = getpost_sql($_GET["perfil_b"]);      		   			  }else{ $perfil_b = "";   		    }
	if(isset($_GET["depto_b"])){      					 $depto_b = getpost_sql($_GET["depto_b"]);      		   			  }else{ $depto_b = "";   		    }
	
	if(isset($_GET["perfil_f"])){      					 $perfil_f = getpost_sql($_GET["perfil_f"]);      		   			  }else{ $perfil_f = "";   		    }



	//desliga filtro de tabs
	if($grupo_b != ""){ $tab_id = ""; }
	if($perfil_b != ""){ $tab_id = ""; }
	if($depto_b != ""){ $tab_id = ""; }






	
	//verifica tab_id ///////////////////////////////////////////////////////////
	$time_15dias = "L.status = '1'";
	if($tab_id == "1"){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "L.status = '0'"; //condição 
	}//if($tab_id == "1"){
	
	/*/monta informações de QTD TABS
	$tab_qtd0 = fSQL::SQL_CONTAGEM("sys_usuarios U, sys_login L", "U.id = L.usuarios_id AND L.time_atividade > '".$time_15dias."' AND L.status = '1'", "", "U.id");
	$tab_qtd1 = fSQL::SQL_CONTAGEM("sys_usuarios U, sys_login L", "U.id = L.usuarios_id AND L.time_atividade <= '".$time_15dias."' AND L.time_atividade > '".time()."' AND L.status = '1'", "", "U.id");
	$tab_qtd2 = fSQL::SQL_CONTAGEM("sys_usuarios U, sys_login L", "U.id = L.usuarios_id AND L.time_atividade <= '".time()."' AND L.status = '1'", "", "U.id");
	$tab_qtd3 = fSQL::SQL_CONTAGEM("sys_usuarios U, sys_login L", "U.id = L.usuarios_id AND L.status != '1'", "", "U.id");
	//fim verifica tab_id ///////////////////////////////////////////////////////*/






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){  $filtro_marca[] = $rapida_b;
		$aCode = fGERAL::codeRandRetorno($rapida_b);
		$filtro_b["rapida_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca rápida por')." <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`id` = '".$aCode["id"]."' OR U.`nome` LIKE '%$rapida_b%' OR U.`cargo` LIKE '%$rapida_b%' OR U.`doc_numero` LIKE '%$rapida_b%' OR L.`email` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){  $filtro_marca[] = $datai_b;  $filtro_marca[] = $dataf_b;
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!!',array("datai"=>"<b>".$datai_b."</b>","dataf"=>"<b>".$dataf_b."</b>"));
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_b"] = $class_fLNG->txt(__FILE__,__LINE__,'De !!datai!! até !!dataf!! (data foi ajustada)',array("datai"=>"<b>".$datai_b."</b>","dataf"=>"<b>".$datai_b."</b>")); }		
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " U.time >= '$timei_a' AND U.time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){  $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca por')." <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( U.`nome` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome



//verifica se recebeu uma solicitação de busca por grupo
if($grupo_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome", "sys_permissao_grupos", "id = '$grupo_b'");
		$grupo_bb = $linha1["nome"];
		$filtro_b["grupo_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca grupo')." <b>$grupo_bb</b>";  $filtro_marca[] = $grupo_bb;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.permissao_grupo_id = '$grupo_b'"; //condição 
		$AJAX_GET .= "grupo_b=$grupo_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por grupo_b



//verifica se recebeu uma solicitação de busca por perfil
if($perfil_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome,apelido", "sys_perfil", "id = '$perfil_b'");
		$perfil_bb = $linha1["nome"]."(".$linha1["apelido"].")";
		$filtro_b["perfil_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca unidade')." <b>$perfil_bb</b>";  $filtro_marca[] = $linha1["apelido"];
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.perfil_id = '$perfil_b'"; //condição 
		$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil








//verifica se recebeu uma solicitação de busca por perfil
if($perfil_f != ""){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "P.perfil_id = '$perfil_f'"; //condição 
		$AJAX_GET .= "perfil_f=$perfil_f&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil


	//monta informações de QTD TABS ($tabela, $where='', $limit='', $group='', $join='', $debug='')
	if($SQL_where != ""){ $SQL_qtd = $SQL_where." AND "; }else{ $SQL_qtd = $SQL_where; }
	//fim verifica tab_id ///////////////////////////////////////////////////////






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
				<button type="button" style="float:right; margin:3px 3px;" class="btn btn-mini" onclick="bRapida<?=$INC_FAISHER["div"]?>Remove('all');" rel="tooltip" data-placement="left" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remove Busca')?>"><i class="icon-remove"></i></button>
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
<div style="clear:both; margin:5px 0 40px 75px;">
</div>
<?php
}//fim if($cont_ARRAY >= "1"){
?>
<?php




//filtrar ------------------------------
if($perfil_f != ""){
	$linha1 = fSQL::SQL_SELECT_ONE("id,nome,apelido", "sys_perfil", "id = '$perfil_f'");
	$perfil_b_data = '{id: "'.$perfil_f.'", text: \'<i class="'.fGERAL::icoPerfil($perfil_f).'"></i> <b>'.$linha1["nome"].'</b> ('.$linha1["apelido"].')\'}';
	$filtro_marca[] = $linha1["nome"];
}else{ $perfil_b_data = ""; }//if($perfil_f != ""){
?>
<div style="background:#<?php if($perfil_b_data != ""){ echo '666'; }else{ echo 'CCC'; }?>; color:#FFF; padding:5px; margin:15px 0 25px 0;">
	<label class="control-label"> <?=$class_fLNG->txt(__FILE__,__LINE__,'UNIDADE (filtro da listagem)')?></label>
	<div class="controls select2-full">
		<input type='hidden' value="" name='perfil_b<?=$INC_FAISHER["div"]?>' id='perfil_b<?=$INC_FAISHER["div"]?>' style=" width:100%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#perfil_b<?=$INC_FAISHER["div"]?>').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecione uma unidade >> (comece a digitar para buscar)')?>',
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
	<?php if($perfil_b_data != ""){ ?>$("#perfil_b<?=$INC_FAISHER["div"]?>").select2("data", <?=$perfil_b_data?>);<?php }?>
	$("#perfil_b<?=$INC_FAISHER["div"]?>").on("change", function(e){
		$('#perfil_f<?=$INC_FAISHER["div"]?>').val($(this).val());
		bAvancada<?=$INC_FAISHER["div"]?>();
	});
	
});
</script>
	</div>
</div>
    
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
	<?php /*filtrar perfil*/ if($perfil_f != ""){ ?>$('#perfil_f<?=$INC_FAISHER["div"]?>').val('<?=$perfil_f?>');<?php } ?>
	//atualiza dados de tabs
	$('.tabs-<?=$INC_FAISHER["div"]?>').removeClass('active');
	$('#<?=$tab_id?>-<?=$INC_FAISHER["div"]?>').addClass('active');
	$('#tab_id<?=$INC_FAISHER["div"]?>').val('<?=$tab_id?>');
});


function addPeriodo<?=$INC_FAISHER["div"]?>(v_id,v_tm){
	if(v_tm == "M6"){ tm_leg = "6"; }
	if(v_tm == "M12"){ tm_leg = "12"; }
	if(v_tm == "M24"){ tm_leg = "24"; }
	pmodalHtml('<i class="icon-warning-sign" style="color:#F90;"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONFIRMA ADICIONAR PERÍODO?')?>','<b><?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma adicionar o pedíodo de atividade de !!meses!! meses ao usuário?',array("meses"=>"'+tm_leg+'"))?></b> <br><br><span style="color:#FF0000;"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></b><br><?=$class_fLNG->txt(__FILE__,__LINE__,'O período de atividade é a duração do acesso do usuário caso esse período chegue ao fim sem que haja uma renovação, o acesso do usuário ao sistema é paralizado.')?><br><br></span>','html');
	$('#pModalRodape').html('<button class="btn btn-primary btn-large" onclick="carregaLista<?=$INC_FAISHER["div"]?>(\'ajax=lista&id_add='+v_id+'&time_at='+v_tm+'\');pmodalDisplay(\'hide\');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Adicionar Período de Atividade')?></button> <button class="btn btn-large" data-dismiss="modal"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>');
}

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
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
				<?php $c_or = "U.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nome/Cargo')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Permissões/Unidade-Grupo')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Período de Atividade/Statu')?>s</th>
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
	$code = $linha1["code"];
	$file = $linha1["file"];
	$nome = $linha1["nome"];
	$cargo = $linha1["cargo"];
	$doc_nome = $linha1["doc_nome"];
	$doc_numero = $linha1["doc_numero"];
	$sexo = $linha1["sexo"];
	$email = $linha1["email"];
	$time_atividade = $linha1["time_atividade"];
	$status = $linha1["status"];
	$time = $linha1["time"];
	$sync = $linha1["sync"];
	$senha_erro = $linha1["senha_erro"];
	$time_u = $linha1["time_u"];
	


	$permissoes_leg = "";
	$resu2 = fSQL::SQL_SELECT_DUPLO("P.id,P.nome AS perfil, G.nome AS grupo", "sys_login_pacote L, sys_perfil P, sys_permissao_grupos G", "L.usuarios_id = '$id_a' AND L.perfil_id = P.id AND L.permissao_grupo_id = G.id", "GROUP BY L.id");
	while($linha2 = fSQL::FETCH_ASSOC($resu2)){
		if($permissoes_leg != ""){ $permissoes_leg .= "<br>"; }
		$permissoes_leg .= '<i class="'.fGERAL::icoPerfil($linha2["id"]).'"></i> '.$linha2["perfil"]." >[".$linha2["grupo"]."]";
	}//fim while
	
	//verifica sessao do usuario
	$conta_sess = fSQL::SQL_CONTAGEM("sys_login_session", "usuarios_id = '$id_a' AND origem = 'WEB'");
	if($conta_sess >= "1"){
		$sess_leg = icoCicle("20","0C0",$class_fLNG->txt(__FILE__,__LINE__,'Usuário Online')." ".$conta_sess."&nbsp;".$class_fLNG->txt(__FILE__,__LINE__,'sessões'));
	}else{
		$sess_leg = icoCicle("20","CCC",$class_fLNG->txt(__FILE__,__LINE__,'Usuário Offline')."  ".$class_fLNG->txt(__FILE__,__LINE__,'Último acesso').":".date('d/m/Y H:i',$time_u));
	}
	if($senha_erro >= "4"){
		if($conta_sess >= "1"){
			$sess_leg .= icoCicle("20","F00",$class_fLNG->txt(__FILE__,__LINE__,'Usuário Com Senha Bloqueada'));
		}else{
			$sess_leg = icoCicle("20","F00",$class_fLNG->txt(__FILE__,__LINE__,'Usuário Com Senha Bloqueada'));		
		}
	}
	
	$status_leg = $class_fLNG->txt(__FILE__,__LINE__,'ATIVO (com acesso)');
	if($status == "1"){
		//monta fim do tempo de atividade
		if($time_atividade <= time()){
			$time_atividade_n = "<b>#".$class_fLNG->txt(__FILE__,__LINE__,'FINALIZOU EM')." ".date('d/m/Y H:i', $time_atividade)."h</b><br>";
		}else{
			$status_leg = "<b>".$class_fLNG->txt(__FILE__,__LINE__,'ATIVO')."</b> (".$class_fLNG->txt(__FILE__,__LINE__,'com acesso').")";
			$time_atividade_n = $class_fLNG->txt(__FILE__,__LINE__,'FINALIZA EM')." ".difHoraTime(time(), $time_atividade,0,"")."<br>";
		}
	}else{
		$status_leg = "<b>".$class_fLNG->txt(__FILE__,__LINE__,'BLOQUEADO')."</b> (".$class_fLNG->txt(__FILE__,__LINE__,'sem acesso').")<br><i>".$class_fLNG->txt(__FILE__,__LINE__,'Em !!data!!h',array("data"=>date('d/m/Y H:i',$time)))."</i>";
	}
	

	$caminho_file = VAR_DIR_FILES."files/usuarios/".$id_a."/fotoperfil.".fGERAL::mostraExtensao($file);
	if(!file_exists($caminho_file)){
		$caminho_file = "img/sem_foto.jpg";
	}

?>
										<tr>
											<td class="sVisu"><?=$cVLogin->icoFile($caminho_file, "")?> &nbsp; <?=$sess_leg?></td>
											<td class="sVisu"><b><?=maiusculo($nome)?></b><br><?=$cargo?><br><i><?=legSexo($sexo)?><br><i><?=$doc_nome?> <?=$doc_numero?></i></i></td>
											<td class="sVisu"><?=$permissoes_leg?></td>
											<td class='sVisu'><?=$time_atividade_n?><?=$status_leg."<br>".date('d/m/Y H:i',$sync)?>h</td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Editar')?>"><i class="icon-edit"></i></a>
												<?php if($status == "1"){?><a href="#" onclick="if(confirm('<?=$class_fLNG->txt(__FILE__,__LINE__,'Gostaria realmente de cancelar acesso de !!nome!!?',array("nome"=>$nome))?>')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&id_excluir=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Remover acesso')?>"><i class="icon-remove"></i></a><?php }?><?php }?>
                                                <?php if($tab_id == "1"){?>
                                                <div style="margin-top:10px; padding-top:2px; border-top:#CCC 1px solid;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Add período de atividade')?>:<br>
												<a href="#" onclick="addPeriodo<?=$INC_FAISHER["div"]?>('<?=$id_a?>','M6');return false;" class="btn btn-warning" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Adicionar !!meses!! meses no período de atividade!',array("meses"=>"06"))?>"><i class="icon-plus-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'!!meses!! meses',array("meses"=>"06"))?></a><br>
												<a href="#" onclick="addPeriodo<?=$INC_FAISHER["div"]?>('<?=$id_a?>','M12');return false;" class="btn btn-warning" style="margin-top:3px;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Adicionar !!meses!! meses no período de atividade!',array("meses"=>"12"))?>"><i class="icon-plus-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'!!meses!! meses',array("meses"=>"12"))?></a></div>
                                                <?php }?>
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
	if(isset($_GET["tab_id"])){ $tab_id = $_GET["tab_id"]; }else{ $tab_id = "0"; }	
	
	
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad")){ $pCadastro = "OFF"; }//loginAcesso	
	
	//include de padrao
	$INC_VAR["tabSel"] = $tab_id;//adicionar array de guias [tab]
	$INC_VAR["tabs"][] = '0[,]<i class="icon-group"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'ATIVOS').' <span id="cont-0'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '1[,]<i class="icon-lock"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Bloqueados').' <span id="cont-1'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["buscaAvancada"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>