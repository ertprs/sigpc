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
	<?php $idCJ = "perfil_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	<?php $idCJ = "depto_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	
	<?php $idCJ = "perfil_f";?>if($("#<?=$formBusca?> #<?=$idCJ.$INC_FAISHER["div"]?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ.$INC_FAISHER["div"]?>").val(); }

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','Filtrando dados...');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "nome_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('datai_b'); lCbusca<?=$INC_FAISHER["div"]?>('dataf_b'); }
	<?php $idCJ = "perfil_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }
	<?php $idCJ = "depto_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
<input type='hidden' value="" name='perfil_f<?=$INC_FAISHER["div"]?>' id='perfil_f<?=$INC_FAISHER["div"]?>' class="limpaInput" />

	<div class="span6">
		<div class="control-group">
			<label for="textfield" class="control-label">Nome</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="nome_b" id="nome_b" placeholder="Informe nome ou parte do nome" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Perfil de acesso</label>
			<div class="controls">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #perfil_b').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Perfil de acesso >> (comece a digitar para buscar)',
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
			<label for="textfield" class="control-label">Data de cadastro</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="datai_b" id="datai_b" placeholder="Data inicial" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div> até 
				<div class="input-append"><input type="text" name="dataf_b" id="dataf_b" placeholder="Data final" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Depto</label>
			<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #depto_b').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um departamento >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilDepto&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					perfil_id: $('#<?=$formBusca?> #perfil_b').val()
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
	$("#<?=$formBusca?> #depto_b").on("change", function(e){ bAvancada<?=$INC_FAISHER["div"]?>(); });	
});
</script>
<input type='hidden' value="" name='depto_b' id='depto_b' style=" width:100%;"/>
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
































//AJAX (lista/preenche combox perfil) ------------------------------------------------------------------>>>
if($ajax == "selPerfil"){	
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca .= "(`nome` LIKE '%$term%' OR `apelido` LIKE '%$term%') "; //condição
	}//fim da busca por nome
		
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();		
			
	//lista ALERTAS
	$campos = "id,nome,apelido";
	$tabela = "sys_perfil";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "ORDER BY id ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$apelido = $linha["apelido"];
		$cont_ = fSQL::SQL_CONTAGEM("sys_permissao_grupos", "perfil_id = '".$id."'");
		
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = '<i class="'.fGERAL::icoPerfil($id).'"></i> <b>'.$id.". ".$legenda."</b> (".$apelido.")<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantidade de grupos criados: $cont_";
		$row_array['text'] .= '<div style="clear:both; border-bottom:#CCC 2px solid; height:10px;"></div>';
		//formata amarelo
		if(!isset($java)){ $idRAND = rand().time(); $java = '<script>$(".select2-marca'.$idRAND.'").highlight("'.$term.'");</script>'; }else{ $java = ""; }
		$row_array['text'] = '<div class="select2-marca'.$idRAND.'">'.$row_array['text'].'</div>'.$java;
		array_push($return_arr,$row_array);
	}//fim while
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);
}//fim ajax -------------------<<<<








	






































//AJAX (lista de permissoes disponiveis para o usuario) ------------------------------------------------------------------>>>
if($ajax == "listaPermissoes"){
	$formCadastroPincipal = $_GET["form"];
	$id_a = $_GET["id_a"];
	$perfil_id = $_GET["perfil_id"];



if($perfil_id >= "1"){}else{
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("INFO","Primeiro selecione o perfil!");	
}

if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("permissao_tags", "sys_permissao_grupos", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$permissao_tags_a = $linha1["permissao_tags"];
		$permissoes_array = unserialize($permissao_tags_a);
		if($permissoes_array == ""){ $permissoes_array["tags"][] = ""; $permissoes_array["tagsextra"][] = ""; }
		$arrayTAG = $permissoes_array["tags"];
		$arrayTAGEXTRA = $permissoes_array["tagsextra"];
	}//fim while
}//if($id_a >= "1"){



?>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG("","30000");//imprimir mensagens criadas
?>
<style>
.corPer:hover{	background:#EFEFEF; }
.corPer .divsor{ clear:both; border-bottom:#CCC 1px dotted; }
</style>
<?php

/////////// INCLUDE JS EXCLUSIVO ---------------------
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";



?>
<script>
function checkALL<?=$INC_FAISHER["div"]?>(v_id,v_acao){
	if(v_acao == true){
		$("."+v_id).iCheck('check'); 
		$(".css_"+v_id).iCheck('check'); $(".css_"+v_id).iCheck('enable');
	}else{
		$("."+v_id).iCheck('uncheck');
		$(".css_"+v_id).iCheck('uncheck'); $(".css_"+v_id).iCheck('disable');		
	}
}
function checkDP<?=$INC_FAISHER["div"]?>(v_id){
	if($("#"+v_id).prop("checked") == true){
		$(".css_"+v_id).iCheck('enable');
		$(".css_"+v_id).iCheck('check');
	}else{
		$(".css_"+v_id).iCheck('uncheck');
		$(".css_"+v_id).iCheck('disable');		
	}
}
</script>
<?php


$cont = "0";
if($perfil_id >= "1"){
	$resu0 = fSQL::SQL_SELECT_SIMPLES("M.id,M.legenda", "sys_permissao_modulo M, sys_perfil_modulos P", "M.id = P.modulo_id AND P.perfil_id = '$perfil_id'", "GROUP BY M.id ORDER BY id ASC");
	while($linha0 = fSQL::FETCH_ASSOC($resu0)){
		$id_m = $linha0["id"];
		$legenda_m = $linha0["legenda"];
		if(preg_match("/\.".$id_m."\./i", SYS_PACOTE_MODULOS)){//verifica ser está no pacote axl

?>
										<div class="control-group">
											<label class="control-label"><?=$id_m?>. <?=maiusculo($legenda_m)?></label>
											<div class="controls">
<?php
			$funcao_i = "";
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id,funcao_id,tag,tagextra,legenda,obs", "sys_permissao", "modulo_id = '$id_m'", "ORDER BY funcao_id ASC, tag ASC");
			while($linha1 = fSQL::FETCH_ASSOC($resu1)){
				$id_i = $linha1["id"];
				$funcao_i = $linha1["funcao_id"];
				$legenda_i = $linha1["legenda"];
				$tag_i = $linha1["tag"];
				$tagextra_i = $linha1["tagextra"];
				$obs_i = $linha1["obs"];
				$cont++;
				if($funcao_ii != $linha1["funcao_id"]){
					$funcao_ii = $linha1["funcao_id"];
					$resu2 = fSQL::SQL_SELECT_SIMPLES("legenda", "sys_permissao_funcao", "id = '$funcao_i'", "");
					while($linha2 = fSQL::FETCH_ASSOC($resu2)){
						$legenda_if = $linha2["legenda"];
					}
?>
<div style="height:20px;"></div>
<span class="label label-info" style="width:100%;">
	<span style="padding-top:5px;"><i class="icon-circle-arrow-right"></i> <?=$legenda_if?></span>
    <span class="btn btn-mini btn-info" style="float:right;" onclick="checkALL<?=$INC_FAISHER["div"]?>('ickall<?=$funcao_i?>',false);"><i class="icon-check-empty"></i> desmarcar todos</span>
	<span class="btn btn-mini btn-info" style="float:right; margin-right:5px;" onclick="checkALL<?=$INC_FAISHER["div"]?>('ickall<?=$funcao_i?>',true);"><i class="icon-check"></i> marcar todos</span>
</span>
<div style="height:15px;"></div>
<?php }?>
   <div style="clear:both;" class="corPer">
	<div style="height:10px;"></div>
		<div class="check-line">
        <?php $check_it = "0"; if(in_array($tag_i, $arrayTAG)){ $check_it = "1"; }?>
			<input name="per_<?=$id_i?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck ickall<?=$funcao_i?>' id="per_<?=$id_i?>" value="<?=$id_i?>" onchange="checkDP<?=$INC_FAISHER["div"]?>('per_<?=$id_i?>');" data-skin="square" data-color="blue" <?php if($check_it == "1"){ echo 'checked="checked"'; }?>> <label class='inline' for="per_<?=$id_i?>" style="font-weight:bold; font-size:16px;"><?=maiusculo($legenda_i)?> <i class="icon-info-sign" rel="tooltip" data-placement="right" title="<?=$obs_i?>"></i></label>
		</div>
		<div style="margin-left:20px;">
<?php
	//monta array de dados
	$array = explode(",", $tagextra_i);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		$listaIDS_a = $array; //nome do cookie
		foreach($listaIDS_a as $pos => $valor){
			if($valor != ""){
				//if($arrayTAGEXTRA["$tag_i"] == ""){ $arrayTAGEXTRA["$tag_i"][] = "fghgfhgfhfg"; }
				$aTX = explode(",",$arrayTAGEXTRA["$tag_i"]);
?>
			<div class="span3 check-line"><input name="perex_<?=$valor?><?=$id_i?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck  css_ickall<?=$funcao_i?> css_per_<?=$id_i?>' id="perex_<?=$valor?><?=$id_i?>" value="<?=$valor?>" data-skin="square" data-color="blue" <?php if(in_array($valor, $aTX)){ echo 'checked="checked"'; }else{ if($check_it == "0"){ echo 'disabled="disabled"'; }}?>> <label class='inline' for="perex_<?=$valor?><?=$id_i?>"><?=legPermissoesExtras($valor)?></label></div>
<?php
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
?>
		</div>
        <div class="divsor"></div>
   </div>
<?php
			}//fim while 1
?>
												<div style="height:30px;"></div>
											</div>
										</div>

<?php
		}//if(preg_match("/\.".$id_m."\./i", SYS_PACOTE_MODULOS)){//verifica ser está no pacote axl
	}//while($linha0

}//if($perfil_id >= "1"){
	
	
if($cont == "0"){
?>
										<div class="control-group">
											<label class="control-label">Permissões disponíveis</label>
											<div class="controls">
												<div class="display" style="padding:20px;"><br><br>SEM PREMISSÕES LOCALIZADAS ::..</div>
												<div style="height:30px;"></div>
											</div>
										</div>
<?php
}//if($cont == "0"){

}//fim ajax -------------------<<<<




































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	$tabela_lerLog = "sys_permissao_grupos";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_permissao_grupos", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$perfil_id_a = $linha1["perfil_id"];
	$expediente_id_a = $linha1["expediente_id"];
	$perfil_depto_id_a = $linha1["perfil_depto_id"];
	$perfil_deptos_a = arrayDB($linha1["perfil_deptos"]);
	$nome_a = $linha1["nome"];
	$permissao_tags_a = $linha1["permissao_tags"];
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
	
	
	

	

	//verifica se já existem usuários utilizando o grupo de permissões
	$conta_usuarios = fSQL::SQL_CONTAGEM("sys_login_pacote", "permissao_grupo_id = '$id_a'");
	$conta_usuarios_n = "Em uso por $conta_usuarios usuário(s)";

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome,apelido", "sys_perfil", "id = '$perfil_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$apelido = $linha["apelido"];
		$perfil_id_n = '<b>'.$apelido.'</b> <br>'.$legenda;
	}//fim while
	
	

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome", "sys_permissao_expediente", "id = '$expediente_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$expediente_id_n = '<b>'.$id.' - '.$legenda.'</b>';
	}//fim while


	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome,obs", "sys_perfil_deptos", "id = '$perfil_depto_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$obs = sentenca($linha["obs"]);
		$perfil_depto_id_n = $cVLogin->popDetalhes("V",$id,"1_est_departamentos","DETALHES DO DEPARTAMENTO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).' <b>'.$legenda.'</b> <br>'.$obs;
	}//fim while
	
    $perfil_deptos_a_n = "";
	if($perfil_deptos_a != ""){
		//monta array de dados
		$array = explode(".", $perfil_deptos_a);
		$cont_ARRAY = ceil(count($array));
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $valor){
				if($valor != ""){
					$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$valor."'", "");
					if($perfil_deptos_a_n != ""){ $perfil_deptos_a_n .= "<br>"; }
					$perfil_deptos_a_n .= $cVLogin->popDetalhes("V",$valor,"1_est_departamentos","DETALHES DO DEPARTAMENTO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($valor,$linha2["code"]).".".$linha2["nome"]."<br>".sentenca($linha2["obs"])."<div style='clear:both; border-top:#E0E0E0 1px solid;'></div>";
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
	}//if($perfil_deptos_a != ""){


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
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('VISUALIZAR DADOS DO GRUPO DE ACESSOS #<?=$id_a?>');

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscad".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Controle do Grupo de Acessos";// titulo
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
										<?php $cont_exib++; $d["content"] = "Nome do grupo[,]".$nome_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Nome do grupo</label>
											<div class="controls display">
											  <?=$nome_a?>
											</div>
										</div>
                                        <?php $cont_exib++; $d["content"] = "Perfil de acesso[,]".$perfil_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Perfil de acesso</label>
											<div class="controls display">
											  <?=$perfil_id_n?>
											</div>
										</div>
										<?php if($expediente_id_n != ""){ $cont_exib++; $d["content"] = "Controle de expediente[,]".$expediente_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Controle de expediente</label>
											<div class="controls display">
											  <?=$expediente_id_n?>
											</div>
										</div>
                                        <?php }?>
										<?php $cont_exib++; $d["content"] = "Departamento principal de funções[,]".$perfil_depto_id_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Departamento principal de funções</label>
											<div class="controls display">
											  <?=$perfil_depto_id_n?>
											</div>
										</div>
										<?php if($perfil_deptos_a_n != ""){ $cont_exib++; $d["content"] = "Departamento(s) de apoio[,]".$perfil_deptos_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Departamento(s) de apoio</label>
											<div class="controls display">
											  <?=$perfil_deptos_a_n?>
											</div>
										</div>
                                        <?php }?>
										<?php $cont_exib++; $d["content"] = "Utilização[,]".$conta_usuarios_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Utilização</label>
											<div class="controls display">
											  <?=$conta_usuarios_n?>
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
                        $boxUI_id = "dadospermissao".$array_temp;//id de controle
						$boxUI_titulo = "Permissões de Acesso do Grupo";// titulo
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




<style>
.corPer:hover{	background:#EFEFEF; }
.corPer .divsor{ clear:both; border-bottom:#EFEFEF 1px dotted; }
</style>
<?php


$permissoes_array = unserialize($permissao_tags_a);
if($permissoes_array == ""){ $permissoes_array["tags"][] = ""; $permissoes_array["tagsextra"][] = ""; }
$arrayTAG = $permissoes_array["tags"];
$arrayTAGEXTRA = $permissoes_array["tagsextra"];

$cont = "0";
$resu0 = fSQL::SQL_SELECT_SIMPLES("M.id,M.legenda", "sys_permissao_modulo M, sys_perfil_modulos P", "M.id = P.modulo_id AND P.perfil_id = '$perfil_id_a'", "GROUP BY M.id ORDER BY id ASC");
while($linha0 = fSQL::FETCH_ASSOC($resu0)){
	$id_m = $linha0["id"];
	$legenda_m = $linha0["legenda"];

?>
										<div class="control-group">
											<label class="control-label"><?=$id_m?>. <?=maiusculo($legenda_m)?></label>
											<div class="controls">
<?php
	$funcao_i = "";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,funcao_id,tag,tagextra,legenda,obs", "sys_permissao", "modulo_id = '$id_m'", "ORDER BY tag ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$legenda_i = $linha1["legenda"];
		$tag_i = $linha1["tag"];
		$tagextra_i = $linha1["tagextra"];
		$obs_i = $linha1["obs"];
		$vars_print = "<br>";

		if($funcao_i != $linha1["funcao_id"]){
			$funcao_i = $linha1["funcao_id"];
			$resu2 = fSQL::SQL_SELECT_SIMPLES("legenda", "sys_permissao_funcao", "id = '$funcao_i'", "");
			while($linha2 = fSQL::FETCH_ASSOC($resu2)){
				$legenda_if = $linha2["legenda"];
			}
?>
<div style="height:20px;"></div>
<span class="label label-info" style="width:100%;"><i class="icon-circle-arrow-right"></i> <?=$legenda_if?></span>
<div style="height:15px;"></div>
<?php
			}
			
			//adiciona permissao a lista
			if(in_array($tag_i, $arrayTAG)){
				$vars_print .= $linha1["funcao"]." - ".$legenda_i;
			}//in_array
			//adiciona permissao extra a lista
			$tag_extras_ = "";
			//monta array de dados
			$array = explode(",", $tagextra_i);
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				$listaIDS_a = $array; //nome do cookie
				foreach($listaIDS_a as $pos => $valor){
					if($valor != ""){
						//if($arrayTAGEXTRA["$tag_i"] == ""){ $arrayTAGEXTRA["$tag_i"][] = "fghgfhgfhfg"; }
						$aTX = explode(",",$arrayTAGEXTRA["$tag_i"]);
						if(in_array($valor, $aTX)){
							if($tag_extras_ != ""){ $tag_extras_ .= ", "; } $tag_extras_ .= legPermissoesExtras($valor);
						}//in_array
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){
			
		
			
			if($vars_print != "<br>"){
?>
<div style="height:10px;"></div>
  <div class="corPer">
		<div class="display">
			<?=$legenda_i?> <i class="icon-info-sign" rel="tooltip" data-placement="right" title="<?=$obs_i?>"></i>
            <?php if($tag_extras_ != ""){
				$vars_print .= " (".$tag_extras_.")";
				echo "<br><i> EXTRAS <i class='icon-angle-right'></i> (".$tag_extras_.")</i>";
			}?>
		</div>
        <div class="divsor"></div>
  </div>
<?php
			//adiciona no array print
			$cont_exib++; $d["content"] = $vars_print; $d["type"] = "html"; $PRINT_ARRAY[] = $d;
		}//if($vars_print != ""){
	

	}//fim while
?>
												<div style="height:30px;"></div>
											</div>
										</div>

<?php
}//while($linha0


	
?>


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
                                        <?php }//if($time_a_a >= "1"){?>
  
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
  <input name="nome" id="nome" type="hidden" value="cadastro_grupos_acesso_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Grupo de Acessos" />
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
	$tabela_lerLog = "sys_permissao_grupos";

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
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_permissao_grupos", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$perfil_id_a = $linha1["perfil_id"];
	$expediente_id_a = $linha1["expediente_id"];
	$perfil_depto_id_a = $linha1["perfil_depto_id"];
	$perfil_deptos_a = arrayDB($linha1["perfil_deptos"]);
	$nome_a = $linha1["nome"];
	$permissao_tags_a = $linha1["permissao_tags"];
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
	
	//verifica se já existem usuários utilizando o grupo de permissões
	$conta_usuarios = fSQL::SQL_CONTAGEM("sys_login_pacote", "permissao_grupo_id = '$id_a'");

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome,apelido", "sys_perfil", "id = '$perfil_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$apelido = $linha["apelido"];
		$perfil_id_data = '{id: "'.$id.'", text: "<b>'.$apelido.'</b><br>'.$legenda.'"}';
	}//fim while

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome", "sys_permissao_expediente", "id = '$expediente_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$expediente_id_data = '{id: "'.$id.'", text: "<b>'.$id.' - '.$legenda.'</b>"}';
	}//fim while


	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("code,nome,obs", "sys_perfil_deptos", "id = '$perfil_depto_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$html = $cVLogin->popDetalhes("N",$perfil_depto_id_a,"1_est_departamentos","DETALHES DO DEPARTAMENTO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($perfil_depto_id_a,$linha["code"])." - <b> ".$linha["nome"]."</b><br>".sentenca($linha["obs"]);
		$perfil_depto_id_data = '{id: "'.$perfil_depto_id_a.'", text: "'.$html.'"}';
	}//fim while
	
	//monta array de dados
	$perfil_deptos_data = "[";
	if($perfil_deptos_a != ""){
		//monta array de dados
		$array = explode(".", $perfil_deptos_a);
		$cont_ARRAY = ceil(count($array));
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $valor){
				if($valor != ""){
					$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$valor."'", "");
					if($perfil_deptos_data != "["){ $perfil_deptos_data .= ","; }
					$html = $cVLogin->popDetalhes("N",$valor,"1_est_departamentos","DETALHES DO DEPARTAMENTO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($valor,$linha2["code"])." - <b> ".$linha2["nome"]."</b><br>".sentenca($linha2["obs"]);
					$perfil_deptos_data .= '{id: "'.$valor.'", text: "'.$html.'"}';
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
	}//if($perfil_deptos_a != ""){
	if($perfil_deptos_data != "["){ $perfil_deptos_data .= "]"; }else{ $perfil_deptos_data = ""; }
		

		
		
		
		
		
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome,obs", "sys_perfil_deptos", "id = '$perfil_depto_id_a'", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$obs = sentenca($linha["obs"]);
		$perfil_depto_id_n = $cVLogin->popDetalhes("V",$id,"1_est_departamentos","DETALHES DO DEPARTAMENTO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code).' <b>'.$legenda.'</b> <br>'.$obs;
	}//fim while
	
    $perfil_deptos_a_n = "";
	if($perfil_deptos_a != ""){
		//monta array de dados
		$array = explode(".", $perfil_deptos_a);
		$cont_ARRAY = ceil(count($array));
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $valor){
				if($valor != ""){
					$linha2 = fSQL::SQL_SELECT_ONE("code,nome,obs", "sys_perfil_deptos", "id = '".$valor."'", "");
					if($perfil_deptos_a_n != ""){ $perfil_deptos_a_n .= "<br>"; }
					$perfil_deptos_a_n .= $cVLogin->popDetalhes("V",$valor,"1_est_departamentos","DETALHES DO DEPARTAMENTO").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($valor,$linha2["code"]).".".$linha2["nome"]."<br>".sentenca($linha2["obs"])."<div style='clear:both; border-top:#E0E0E0 1px solid;'></div>";
				}//if($valor != ""){
			}//fim foreach
		}//fim if($cont_ARRAY >= "1"){
	}//if($perfil_deptos_a != ""){
		

}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$nome_a = "";
	$permissao_tags_a = "";
	$conta_usuarios = "0";
	
//zera as vars de data
	$user_a = $cVLogin->userReg();//quem realizou o cadastro
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('CADASTRAR NOVO GRUPO DE ACESSOS DO SISTEMA');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('EDITAR CADASTRO GRUPO DE ACESSOS DO SISTEMA #<?=$id_a?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
		<?php }?>
	
	});
	<?php if($id_a == "0"){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); $('#<?=$formCadastroPincipal?> #nome').focus(); });//TIMER
	<?php }?>
<?php }//else{ //if(isset($_GET["POP"])){ ?>
</script>

<div id="divContent_loader<?=$array_temp?>">
<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroPincipal<?=$array_temp?>();return false;">

             <input name="id_a" type="hidden" id="id_a" value="<?=$id_a?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscontrole".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Controle do Grupo de Acessos";// titulo
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
											<label class="control-label">Nome do grupo</label>
											<div class="controls">
											  <input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="input-xlarge span9 cssFonteMai" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"> Perfil de acesso</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #perfil_id').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um perfil de acesso >> (comece a digitar para buscar)',
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
	<?php if($perfil_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #perfil_id").select2("data", <?=$perfil_id_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #perfil_id").on("change", function(e){
		if(($(this).val() == "0") || ($(this).val() == "")){ $('#<?=$formCadastroPincipal?> #perfil_depto_id').select2("data", ''); }
		listaPermissoes<?=$INC_FAISHER["div"]?>();
	});
	<?php if($conta_usuarios >= "1"){?>$("#<?=$formCadastroPincipal?> #perfil_id").select2("readonly", true);<?php }?>
	
	
	
});
</script>
<input type='hidden' value="" name='perfil_id' id='perfil_id' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Orgão/secretária de acesso.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Controle de expediente</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #expediente_id').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Aplicar controle de expediente >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=controleExpediente&scriptoff",
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
	<?php if($expediente_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #expediente_id").select2("data", <?=$expediente_id_data?>);<?php }?>
	
	
	
});
</script>
<input type='hidden' value="" name='expediente_id' id='expediente_id' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Opcional a utilização de controle, sem o controle o acesso é comum.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"> Departamento principal de funções</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #perfil_depto_id').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um departamento de funções >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilDepto&status=1&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					perfil_id: $('#<?=$formCadastroPincipal?> #perfil_id').val()
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
	<?php if($perfil_depto_id_data != ""){ ?>$("#<?=$formCadastroPincipal?> #perfil_depto_id").select2("data", <?=$perfil_depto_id_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='perfil_depto_id' id='perfil_depto_id' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Departamento principal de funções, para permitir/registrar ações do usuário.</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"> Departamento(s) de apoio</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #perfil_deptos').select2({
		maximumSelectionSize: 20,//*/
   		multiple: true,
		placeholder: 'Selecione departamento(s) apoio >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=perfilDepto&status=1&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					delDepto: $('#<?=$formCadastroPincipal?> #perfil_depto_id').val(),
					perfil_id: $('#<?=$formCadastroPincipal?> #perfil_id').val()
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
	<?php if($perfil_deptos_data != ""){ ?>$("#<?=$formCadastroPincipal?> #perfil_deptos").select2("data", <?=$perfil_deptos_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='perfil_deptos' id='perfil_deptos' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Departamento(s) de apoio, para permitir/registrar ações do usuário.</span>
											</div>
										</div>
                                        <?php if($conta_usuarios >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Utilização</label>
											<div class="controls display">
											  Já em uso por <?=$conta_usuarios?> usuário(s)
											</div>
										</div>
                                        <?php }//if($conta_usuarios >= "1"){ ?>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            
  
  
            
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadospermissao".$array_temp;//id de controle
						$boxUI_titulo = "Permissões de Acesso do Grupo";// titulo
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
<script>
//TIMER
$.doTimeout('vTimerLoadSec<?=$INC_FAISHER["div"]?>', 0, function(){
	listaPermissoes<?=$INC_FAISHER["div"]?>();
});//TIMER
function listaPermissoes<?=$INC_FAISHER["div"]?>(){
	loaderFoco('divListaPer<?=$INC_FAISHER["div"]?>','divListaPer<?=$INC_FAISHER["div"]?>_load',' já estamos carregando a listagem...');//cria um loader dinamico
	faisher_ajax('divListaPer<?=$INC_FAISHER["div"]?>', 'divListaPer<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=listaPermissoes&id_a=<?=$id_a?>&perfil_id='+$('#<?=$formCadastroPincipal?> #perfil_id').val()+'&form=<?=$formCadastroPincipal?>&');
}//listaPermissoes
</script>
                                        <div style="min-height:200px;" id="divListaPer<?=$INC_FAISHER["div"]?>"></div>
                                        
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
                                        <?php }//if($user_a_a >= "1"){?>

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
	if(isset($_GET["perfil_f"])){      					 $perfil_f = getpost_sql($_GET["perfil_f"]);      		   			  }else{ $perfil_f = "";   		    }





//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc")){
		//verifica se já existem usuários utilizando o grupo de permissões
		$conta_usuarios = fSQL::SQL_CONTAGEM("sys_login_pacote", "permissao_grupo_id = '$id_excluir'");
		//verifica se é proprio usuario
		if($conta_usuarios == "0"){//verifica permissão
	
			//exclue o registro
			$tabela = "sys_permissao_grupos";
			$condicao = "id = '$id_excluir'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			fGERAL::delRegistroLog("sys_permissao_grupos",$id_excluir,$cVLogin->userReg());//salvar/gerar log de exclusao
				
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("sys_permissao_grupos", "excluir", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Registro excluido com sucesso!");
		}else{ $cMSG->addMSG("ERRO","Existem $conta_usuarios usuário(s) cadastrados no grupo! Não é possível remover."); }//fim else //excluir proprio usuario
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
	$perfil_id_a = getpost_sql($_POST["perfil_id"]);
	$expediente_id_a = getpost_sql($_POST["expediente_id"]);
	$perfil_depto_id_a = getpost_sql($_POST["perfil_depto_id"]);
	$perfil_deptos_a = getpost_sql($_POST["perfil_deptos"], "ARRAY-P");
		
		



//VALIDAÇÔES ------------------------------**********
	//valida campo nome -- XXX
	if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo nome não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	
	$sql_complemto = " AND id != '$id_a'";	
	if($id_a == "0"){
		$sql_complemto = "";
	}//if($id_a == "0"){
	//verifica se já existe no sistem
	$cont_ = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", "sys_permissao_grupos", "perfil_id = '$perfil_id_a' AND nome = '$nome_a' $sql_complemto", "", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$cont_++;
	}//fim while
	if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- O nome ($nome_a) está em uso, utilize outro nome!";//msg
	}//fim if valida campo
	
	//valida campo perfil_id_a -- XXX
	if($perfil_id_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo perfil de acesso não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo perfil_depto_id_a -- XXX
	if($perfil_depto_id_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo departamento não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	

	
	if($id_a >= "1"){
		//verifica se já existem usuários utilizando o grupo de permissões
		$conta_usuarios = fSQL::SQL_CONTAGEM("sys_login_pacote", "permissao_grupo_id = '$id_a'");
		//busca perfil atual
		$linha1 = fSQL::SQL_SELECT_ONE("perfil_id", "sys_permissao_grupos", "id = '$id_a'");
		$perfil_id_aa = $linha1["perfil_id"];
		
		//valida campo conta_usuarios -- XXX
		if(($conta_usuarios >= "1") and ($perfil_id_aa != $perfil_id_a)){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Já existem usuários utilizando, não é possível alterar o perfil, preencha corretamente!";//msg
		}//fim if valida campo
	}//if($id_a >= "1"){
	




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


	//verifica lista de permissoes recebidas	
	$permissao_tags_a = ""; $funcao_ids = "."; unset($aFunc);
	//$resu1 = fSQL::SQL_SELECT_SIMPLES("id,funcao_id,tag,tagextra,legenda,obs", "sys_permissao", "perfil_id = '$perfil_id_a'", "ORDER BY tag ASC");
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,funcao_id,tag,tagextra,legenda,obs", "sys_permissao", "", "ORDER BY tag ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$legenda_i = $linha1["legenda"];
		$funcao_id_i = $linha1["funcao_id"];
		$tag_i = $linha1["tag"];
		$tagextra_i = $linha1["tagextra"];
		//limpa variaveis
		$TAG = "";	$TAGEXTRA = "";
		
		if(isset($_POST["per_".$id_i])){
			$TAG = $tag_i;
			//echo "<bR>".$TAG;
			//cria e funções
			if(!isset($aFunc["$funcao_id_i"])){ $aFunc["$funcao_id_i"] = $funcao_id_i; $funcao_ids .= $funcao_id_i."."; }

			//monta array de dados
			$array = explode(",", $tagextra_i);
			$cont_ARRAY = ceil(count($array));
			if($cont_ARRAY >= "1"){
				$listaIDS_a = $array; //nome do cookie
				foreach($listaIDS_a as $pos => $valor){
					if($valor != ""){
						if(isset($_POST["perex_".$valor.$id_i])){
							if($TAGEXTRA != ""){ $TAGEXTRA .= ","; }
							$TAGEXTRA .= $valor;
						}//if(isset($_POST["perex_".$valor.$id_i])){
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){
			
			//permissao do array
			if($TAG != ""){ $TAGS_ARRAY[] = $TAG; if($TAGEXTRA != ""){ $TAGSEXTRA_ARRAY["$TAG"] = $TAGEXTRA; } }
		}//if(isset($_POST["per_".$id_i])){
	}//fim while
	if(isset($TAGS_ARRAY)){
		
		if($funcao_ids != "."){ $SESSAO_ARRAY["funcao_ids"] = "[".$funcao_ids."]"; }
		$SESSAO_ARRAY["tags"] = $TAGS_ARRAY;
		$SESSAO_ARRAY["tagsextra"] = $TAGSEXTRA_ARRAY;
		$permissao_tags_a = serialize($SESSAO_ARRAY);
	}else{ $permissao_tags_a = ""; }
	

	//atualiza filtro
	$perfil_f = $perfil_id_a;
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO


	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "sys_permissao_grupos";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,perfil_id,perfil_depto_id,perfil_deptos,expediente_id,nome,permissao_tags,user,time,user_a,sync";
	$valores = array($id_a,$perfil_id_a,$perfil_depto_id_a,$perfil_deptos_a,$expediente_id_a,$nome_a,$permissao_tags_a,$cVLogin->userReg(),time(),"0",time());
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
		
	
	
	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_permissao_grupos", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_permissao_grupos",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Grupo de acesso cadastrado com sucesso! <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");



}else{  //############# ELSE - ALTERA REGISTRO |-


		
	//atualiza dados da tabela no DB
	$tabela = "sys_permissao_grupos";
	$campos = "perfil_id,perfil_depto_id,perfil_deptos,expediente_id,nome,permissao_tags,user_a,sync";
	$valores = array($perfil_id_a,$perfil_depto_id_a,$perfil_deptos_a,$expediente_id_a,$nome_a,$permissao_tags_a,$cVLogin->userReg(),time());
	$condicao = "id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	




	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_permissao_grupos", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_permissao_grupos",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso. <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
	
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{	
		$id = $id_a;
		$texto = "<b>".$nome_a."</b>";
		
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
	$SQL_campos = "G.id,G.perfil_id,G.expediente_id,G.nome,G.permissao_tags,G.user,G.time,G.user_a,G.user_a,G.sync,P.apelido AS perfil,D.nome AS depto"; //campos da tabela
	$SQL_tabela = "sys_permissao_grupos G, sys_perfil P, sys_perfil_deptos D"; //tabela
	$SQL_where = "G.perfil_id = P.id AND G.perfil_depto_id = D.id"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&"; //variaveis para a paginacao
	$ORDEM_C = "G.perfil_id";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY G.id"; // agrupar o resultado GROUP BY

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
	if(isset($_GET["perfil_b"])){      					 $perfil_b = getpost_sql($_GET["perfil_b"]);      		   			  }else{ $perfil_b = "";   		    }
	if(isset($_GET["depto_b"])){      					 $depto_b = getpost_sql($_GET["depto_b"]);      		   			  }else{ $depto_b = "";   		    }
	






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){  $filtro_marca[] = $rapida_b;
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( G.`id` = '$rapida_b' OR G.`nome` LIKE '%$rapida_b%' OR P.`apelido` LIKE '%$rapida_b%' ) "; //condição 
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
		$SQL_where .= " G.time >= '$timei_a' AND G.time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){  $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( G.`nome` LIKE '%$nome_b%' OR P.`apelido` LIKE '%$nome_b%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome



//verifica se recebeu uma solicitação de busca por perfil
if($perfil_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("nome,apelido", "sys_perfil", "id = '$perfil_b'");
		$perfil_bb = $linha1["nome"]."(".$linha1["apelido"].")";
		$filtro_b["perfil_b"] = "Busca perfil <b>$perfil_bb</b>";   $filtro_marca[] = $linha1["apelido"];
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "G.perfil_id = '$perfil_b'"; //condição 
		$AJAX_GET .= "perfil_b=$perfil_b&"; //incrementa variaveis para a paginacao AJAX
		$perfil_f = $perfil_b;
}//fim da busca por perfil




//verifica se recebeu uma solicitação de busca por depto_b
if($depto_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("perfil_id,nome", "sys_perfil_deptos", "id = '$depto_b'");
		$perfil_f = $linha1["perfil_id"];
		$depto_bb = $linha1["nome"];
		$filtro_b["depto_b"] = "Busca depto <b>$depto_bb</b>";  $filtro_marca[] = $depto_bb;
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "( G.perfil_depto_id = '$depto_b' OR G.perfil_deptos LIKE '%.".$depto_b.".%' )"; //condição 
		$AJAX_GET .= "depto_b=$depto_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por depto_b







//verifica se recebeu uma solicitação de busca por perfil
if($perfil_f != ""){
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "G.perfil_id = '$perfil_f'"; //condição 
		$AJAX_GET .= "perfil_f=$perfil_f&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por perfil








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




//filtrar ------------------------------
if($perfil_f != ""){
	$linha1 = fSQL::SQL_SELECT_ONE("id,nome,apelido", "sys_perfil", "id = '$perfil_f'");
	$cont_ = fSQL::SQL_CONTAGEM("sys_permissao_grupos", "perfil_id = '".$perfil_f."'");
	$perfil_b_data = '{id: "'.$perfil_f.'", text: \'<i class="'.fGERAL::icoPerfil($perfil_f).'"></i> <b>'.$perfil_f.'. '.$linha1["nome"].'</b> ('.$linha1["apelido"].')<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantidade de grupos criados: '.$cont_.'\'}';
}//if($perfil_f != ""){
?>
<div style="background:#666; color:#FFF; padding:5px; margin:15px 0 25px 0;">
	<label class="control-label"> PERFIL/SECRETARIA (filtro da listagem)</label>
	<div class="controls select2-full">
		<input type='hidden' value="" name='perfil_b<?=$INC_FAISHER["div"]?>' id='perfil_b<?=$INC_FAISHER["div"]?>' style=" width:100%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#perfil_b<?=$INC_FAISHER["div"]?>').select2({
		maximumSelectionSize: 1,//*/
   		multiple: true,
		placeholder: 'Selecione um perfil/secretaria >> (comece a digitar para buscar)',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=selPerfil&scriptoff",
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
	<?php if($perfil_b_data != ""){ ?> $("#perfil_b<?=$INC_FAISHER["div"]?>").select2("data", <?=$perfil_b_data?>);<?php }?>
	$("#perfil_b<?=$INC_FAISHER["div"]?>").on("change", function(e){
		if($(this).val() == ""){
			$.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#perfil_b<?=$INC_FAISHER["div"]?>").select2("open"); });
		}else{
			$('#perfil_f<?=$INC_FAISHER["div"]?>').val($(this).val());
			bAvancada<?=$INC_FAISHER["div"]?>();
		}
	});
	<?php if($perfil_b_data != ""){ ?>$("#perfil_b<?=$INC_FAISHER["div"]?>").on("select2-close", function() {
		if($(this).val() == ""){
			$("#perfil_b<?=$INC_FAISHER["div"]?>").select2("data", <?=$perfil_b_data?>);
		}
	});<?php }?>
	
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
				<?php $c_or = "G.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Nome Grupo</th>
				<?php $c_or = "P.apelido"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Perfil/Departamento</th>
				<th class='hidden-480'>Funções de Permissões</th>
				<th class='hidden-480'>Permissões/Expediente</th>
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
	$perfil_id = $linha1["perfil_id"];
	$expediente_id = $linha1["expediente_id"];
	$nome = $linha1["nome"];
	$permissao_tags = $linha1["permissao_tags"];
	$user = $linha1["user"];
	$time = $linha1["time"];
	$user_a = $linha1["user_a"];
	$sync = $linha1["sync"];
	$perfil = $linha1["perfil"];
	$depto = $linha1["depto"];
	
	//verifica se tem expediente
	$expediente_leg = "";
	if($expediente_id >= "1"){
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome", "sys_permissao_expediente", "id = '$expediente_id_a'", "");
		while($linhaM = fSQL::FETCH_ASSOC($resuM)){
			$expediente_leg = "<br>Exp.: ".$linhaM["id"]."-".$linhaM["nome"];
		}
	}//if($expediente_id >= "1"){

	//conta permissoes
	$permissoes_array = unserialize($permissao_tags);
	$cont_PER = ceil(count($permissoes_array["tags"]));
	$permissoes_leg = $cont_PER." permissõ(es)";
	//echo "<br>------------------------------var_dump:<pre>"; var_dump($permissoes_array); echo "</pre>"; echo "<br>arr:<pre>"; print_r($permissoes_array); echo "</pre>";
	//monta lista de funções de permissões
	$permissoes_funcoes = arrayDB($permissoes_array["funcao_ids"]);
	$permissoes_funcoes_leg = "";
	if($permissoes_funcoes != ""){
		$sql_ = "( id = '".str_replace(".", "' OR id = '", $permissoes_funcoes)."' )";
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("legenda", "sys_permissao_funcao", $sql_, "");
		while($linhaM = fSQL::FETCH_ASSOC($resuM)){
			if($permissoes_funcoes_leg != ""){ $permissoes_funcoes_leg .= "<br>"; }
			$permissoes_funcoes_leg .= "- ".$linhaM["legenda"];
		}
	}//if($permissoes_funcoes != ""){

	if($user_a != ""){
		$registro = "Alterado por ".sentenca(primeiro_nome($user_a,"2")).", ".date('d/m/Y H:i', $sync)."h";
	}else{//if($user_a != ""){
		$registro = "Cadastrado por ".sentenca(primeiro_nome($user,"2")).", ".date('d/m/Y H:i', $time)."h";
	}//if($user_a != ""){
?>
										<tr>
											<td class="sVisu"><b><?=$id_a?>. <?=maiusculo($nome)?></b><br><?=$registro?></td>
											<td class="sVisu"><i class="<?=fGERAL::icoPerfil($perfil_id)?>"></i> <?=$perfil?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?=$depto?></i></td>
											<td class='sVisu hidden-480'><?=$permissoes_funcoes_leg?></td>
											<td class='sVisu hidden-480'><?=$permissoes_leg?><?=$expediente_leg?></td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
												<?php if($pExc == "1"){?><a href="#" onclick="if(confirm('Gostaria realmete de remover \'<?=$nome?>\'?')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&id_excluir=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="Remover"><i class="icon-remove"></i></a><?php }?>
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