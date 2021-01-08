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
<input type='hidden' value="" name='perfil_f<?=$INC_FAISHER["div"]?>' id='perfil_f<?=$INC_FAISHER["div"]?>' class="limpaInput" />

	<div class="span6">
		<div class="control-group">
			<label for="textfield" class="control-label">Nome</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="nome_b" id="nome_b" placeholder="Informe nome ou parte do nome" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
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







































































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	$tabela_lerLog = "sys_permissao_expediente";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_permissao_expediente", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_a = $linha1["nome"];
	$hora_ativo_a = $linha1["hora_ativo"];
	$arrH["segunda"] = $linha1["hora_segunda"];
	$arrH["terca"] = $linha1["hora_terca"];
	$arrH["quarta"] = $linha1["hora_quarta"];
	$arrH["quinta"] = $linha1["hora_quinta"];
	$arrH["sexta"] = $linha1["hora_sexta"];
	$arrH["sabado"] = $linha1["hora_sabado"];
	$arrH["domingo"] = $linha1["hora_domingo"];
	$ip_a = $linha1["ip"];
	$geo_ativo_a = $linha1["geo_ativo"];
	$token_ativo_a = $linha1["token_ativo"];
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
	
	
	



	//monta array de dados
	$grupos_acesso_n = "";
	$campos = "G.id,G.nome,D.nome AS depto,P.nome AS perfil,P.apelido";
	$tabela = "sys_permissao_grupos G, sys_perfil_deptos D, sys_perfil P";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, "G.perfil_id = P.id AND G.expediente_id = '$id_a' AND G.perfil_depto_id = D.id", "GROUP BY G.id ORDER BY P.nome,D.nome ASC,G.nome ASC");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$depto = $linha["depto"];
		$perfil = $linha["perfil"];
		$apelido = $linha["apelido"];
		$grupos_acesso_n .= "Perfil: ".$apelido." (".$perfil.")<br>Grupo: <b>".$legenda." (Dep.: ".$depto.")".'<div style="clear:both; border-bottom:#CCC 2px solid; height:10px;"></div>';
	}//fim while

	
	



	//verifica se pega as vars de horas
	$arrHN["segunda"] = "";
	$arrHN["terca"] = "";
	$arrHN["quarta"] = "";
	$arrHN["quinta"] = "";
	$arrHN["sexta"] = "";
	$arrHN["sabado"] = "";
	$arrHN["domingo"] = "";
	if($hora_ativo_a >= "1"){
		$var_dia = "segunda";//-------------------------- segunda -----------------------------------------------------------------------------
		$var_ = "00"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "01"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "02"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "03"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "04"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "05"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "06"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "07"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "08"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "09"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "10"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "11"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "12"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "13"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "14"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "15"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "16"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "17"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "18"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "19"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "20"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "21"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "22"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "23"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_dia = "terca";//-------------------------- terça -----------------------------------------------------------------------------
		$var_ = "00"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "01"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "02"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "03"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "04"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "05"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "06"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "07"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "08"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "09"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "10"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "11"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "12"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "13"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "14"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "15"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "16"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "17"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "18"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "19"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "20"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "21"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "22"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "23"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_dia = "quarta";//-------------------------- quarta -----------------------------------------------------------------------------
		$var_ = "00"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "01"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "02"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "03"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "04"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "05"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "06"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "07"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "08"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "09"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "10"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "11"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "12"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "13"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "14"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "15"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "16"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "17"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "18"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "19"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "20"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "21"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "22"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "23"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_dia = "quinta";//-------------------------- quinta -----------------------------------------------------------------------------
		$var_ = "00"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "01"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "02"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "03"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "04"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "05"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "06"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "07"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "08"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "09"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "10"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "11"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "12"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "13"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "14"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "15"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "16"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "17"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "18"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "19"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "20"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "21"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "22"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "23"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_dia = "sexta";//-------------------------- sexta -----------------------------------------------------------------------------
		$var_ = "00"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "01"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "02"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "03"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "04"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "05"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "06"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "07"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "08"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "09"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "10"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "11"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "12"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "13"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "14"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "15"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "16"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "17"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "18"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "19"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "20"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "21"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "22"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "23"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_dia = "sabado";//-------------------------- sábado -----------------------------------------------------------------------------
		$var_ = "00"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "01"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "02"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "03"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "04"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "05"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "06"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "07"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "08"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "09"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "10"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "11"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "12"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "13"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "14"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "15"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "16"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "17"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "18"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "19"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "20"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "21"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "22"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "23"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_dia = "domingo";//-------------------------- domingo -----------------------------------------------------------------------------
		$var_ = "00"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "01"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "02"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "03"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "04"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "05"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "06"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "07"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "08"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "09"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "10"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "11"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "12"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "13"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "14"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "15"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "16"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "17"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "18"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "19"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "20"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "21"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "22"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
		$var_ = "23"; if(preg_match("/\.".$var_."\./i", $arrH["$var_dia"])){ $arrHN["$var_dia"] .= " - ".$var_."h"; }
				
	}//if($hora_ativo_a >= "1"){


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
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('VISUALIZAR DADOS DO CONTROLE DE EXPEDIENTE #<?=$id_a?>');

});
<?php if(!isset($_GET["POP"])){ ?>$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER<?php }else{ $anterior="0";$proximo="0";}?>
</script>

<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscad".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Controle do Expediente";// titulo
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
											<label class="control-label">Nome do expediente</label>
											<div class="controls display">
											  <?=$nome_a?>
											</div>
										</div>
										<?php if($grupos_acesso_n != ""){ $cont_exib++; $d["content"] = "Grupos de acesso em uso[,]".$grupos_acesso_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Grupos de acesso em uso</label>
											<div class="controls display">
											  <?=$grupos_acesso_n?>
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

      

<?php




if($hora_ativo_a >= "1"){
	
	
?>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoshora".$array_temp;//id de controle
						$boxUI_titulo = "Restrição de Acesso Por Dia/Hora";// titulo
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
            
										<?php if($arrHN["segunda"] != ""){ $cont_exib++; $d["content"] = "Segunda (horas)[,]".$arrHN["segunda"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Segunda (horas)</label>
											<div class="controls display">
											  <?=$arrHN["segunda"]?>
											</div>
										</div>
                                        <?php }?>
										<?php if($arrHN["terca"] != ""){ $cont_exib++; $d["content"] = "Terça (horas)[,]".$arrHN["terca"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Terça (horas)</label>
											<div class="controls display">
											  <?=$arrHN["terca"]?>
											</div>
										</div>
                                        <?php }?>
										<?php if($arrHN["quarta"] != ""){ $cont_exib++; $d["content"] = "Quarta (horas)[,]".$arrHN["quarta"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Quarta (horas)</label>
											<div class="controls display">
											  <?=$arrHN["quarta"]?>
											</div>
										</div>
                                        <?php }?>
										<?php if($arrHN["quinta"] != ""){ $cont_exib++; $d["content"] = "Quinta (horas)[,]".$arrHN["quinta"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Quinta (horas)</label>
											<div class="controls display">
											  <?=$arrHN["quinta"]?>
											</div>
										</div>
                                        <?php }?>
										<?php if($arrHN["sexta"] != ""){ $cont_exib++; $d["content"] = "Sexta (horas)[,]".$arrHN["sexta"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Sexta (horas)</label>
											<div class="controls display">
											  <?=$arrHN["sexta"]?>
											</div>
										</div>
                                        <?php }?>
										<?php if($arrHN["sabado"] != ""){ $cont_exib++; $d["content"] = "Sábado (horas)[,]".$arrHN["sabado"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Sábado (horas)</label>
											<div class="controls display">
											  <?=$arrHN["sabado"]?>
											</div>
										</div>
                                        <?php }?>
										<?php if($arrHN["domingo"] != ""){ $cont_exib++; $d["content"] = "Domingo (horas)[,]".$arrHN["domingo"]; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Domingo (horas)</label>
											<div class="controls display">
											  <?=$arrHN["domingo"]?>
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




}//if($hora_ativo_a >= "1"){
	
	
?>

                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosipfaixa".$array_temp;//id de controle
						$boxUI_titulo = "Restrição de Acesso Por IP/Faixa";// titulo
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
            
										<?php if($ip_a != ""){ $cont_exib++; $d["content"] = "IP/faixa de restrição[,]".$ip_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">IP/faixa de restrição</label>
											<div class="controls display">
											  <?=$ip_a?>
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
                        $boxUI_id = "dadosgeoo".$array_temp;//id de controle
						$boxUI_titulo = "Geolocalização Forçar Compartilhamento";// titulo
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
            
										<?php if($geo_ativo_a >= "1"){ $cont_exib++; $d["content"] = "Ativo[,]O usuário será forçado a compartilhar sua localização, caso ele bloqueie de alguma forma o sistema não permite acesso. Recurso disponível em seu navegador. "; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Ativo</label>
											<div class="controls display">
											  O usuário será forçado a compartilhar sua localização, caso ele bloqueie de alguma forma o sistema não permite acesso. Recurso disponível em seu navegador. 
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
                        $boxUI_id = "dadostsmss".$array_temp;//id de controle
						$boxUI_titulo = "Liberação com Token SMS";// titulo
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
            
										<?php if($token_ativo_a >= "1"){ $cont_exib++; $d["content"] = "Ativo[,]Será enviado ao usuário logo após o login, um Token SMS para liberação do acesso ao sistema. "; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Ativo</label>
											<div class="controls display">
											  Será enviado ao usuário logo após o login, um Token SMS para liberação do acesso ao sistema. 
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
  <input name="nome" id="nome" type="hidden" value="cadastro_expediente_acesso_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Controle de Expediente" />
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
	$tabela_lerLog = "sys_permissao_expediente";

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
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "sys_permissao_expediente", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$nome_a = $linha1["nome"];
	$hora_ativo_a = $linha1["hora_ativo"];
	$hora_segunda_a = $linha1["hora_segunda"];
	$hora_terca_a = $linha1["hora_terca"];
	$hora_quarta_a = $linha1["hora_quarta"];
	$hora_quinta_a = $linha1["hora_quinta"];
	$hora_sexta_a = $linha1["hora_sexta"];
	$hora_sabado_a = $linha1["hora_sabado"];
	$hora_domingo_a = $linha1["hora_domingo"];
	$ip_a = $linha1["ip"];
	$geo_ativo_a = $linha1["geo_ativo"];
	$token_ativo_a = $linha1["token_ativo"];
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
	

	
	//monta array de dados
	$grupos_acesso_data = "[";
	$campos = "G.id,G.nome,D.nome AS depto,P.nome AS perfil,P.apelido";
	$tabela = "sys_permissao_grupos G, sys_perfil_deptos D, sys_perfil P";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, "G.perfil_id = P.id AND G.expediente_id = '$id_a' AND G.perfil_depto_id = D.id", "GROUP BY G.id ORDER BY P.nome,D.nome ASC,G.nome ASC");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		$depto = $linha["depto"];
		$perfil = $linha["perfil"];
		$apelido = $linha["apelido"];
		if($grupos_acesso_data != "["){ $grupos_acesso_data .= ","; }
		$html = "Perfil: ".$apelido." (".$perfil.")<br>Grupo: <b>".$legenda."</b><br>Depto: ".$depto;
		$grupos_acesso_data .= '{id: "'.$id.'", text: "'.$html.'"}';

	}//fim while
	if($grupos_acesso_data != "["){ $grupos_acesso_data .= "]"; }else{ $grupos_acesso_data = ""; }
	
	
			
		
		
		

}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$nome_a = "";
	$hora_segunda_a = ".07.08.09.10.11.12.13.14.15.16.17.18.";
	$hora_terca_a = ".07.08.09.10.11.12.13.14.15.16.17.18.";
	$hora_quarta_a = ".07.08.09.10.11.12.13.14.15.16.17.18.";
	$hora_quinta_a = ".07.08.09.10.11.12.13.14.15.16.17.18.";
	$hora_sexta_a = ".07.08.09.10.11.12.13.14.15.16.17.18.";
	$hora_sabado_a = "";
	$hora_domingo_a = "";
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('CADASTRAR NOVO CONTROLE DE EXPEDIENTE DO SISTEMA');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('EDITAR CADASTRO CONTROLE DE EXPEDIENTE DO SISTEMA #<?=$id_a?>');
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
                        $boxUI_id = "dadoscontrole".$array_temp;//id de controle
						$boxUI_titulo = "Dados de Controle do Expediente";// titulo
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
											<label class="control-label">Nome do expediente</label>
											<div class="controls">
											  <input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="input-xlarge span9 cssFonteMai" data-rule-required="true">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"> Grupos de acesso em uso</label>
											<div class="controls select2-full">
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #grupos_acesso').select2({
		maximumSelectionSize: 50,//*/
   		multiple: true,
		placeholder: 'Grupos de acesso >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=grupoAcessoPerfil&full&scriptoff",
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
	<?php if($grupos_acesso_data != ""){ ?>$("#<?=$formCadastroPincipal?> #grupos_acesso").select2("data", <?=$grupos_acesso_data?>);<?php }?>
	
});
</script>
<input type='hidden' value="" name='grupos_acesso' id='grupos_acesso' style=" width:100%;"/>
                                              <span class="help-block"><i class="icon-info-sign"></i> Grupos de acesso que o expediente está aplicado.</span>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            
  
  
            
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosdiashor".$array_temp;//id de controle
						$boxUI_titulo = "Restrição de Acesso Por Dia/Hora";// titulo
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
											<label class="control-label">Utilizar</label>
											<div class="controls">
												<div class="check-line"><input name="hora_ativo" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_ativo" value="1" data-skin="square" data-color="blue" <?php if($hora_ativo_a == "1"){ echo 'checked'; }?>> <label class='inline' for="hora_ativo">Ativar restrição de acesso por dia e hora</label></div>
											</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#<?=$formCadastroPincipal?> #hora_ativo").on("change", function(e){
		if(valHtml('hora_ativo','#<?=$formCadastroPincipal?>') == "1"){
			$('#<?=$formCadastroPincipal?> .css_hora_ativo').fadeIn();
		}else{ $('#<?=$formCadastroPincipal?> .css_hora_ativo').hide(); }
	});
});
</script>
										</div>
										<div class="control-group css_hora_ativo" <?php if($hora_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">Segunda (horas)</label>
											<div class="controls">
		<div style="margin-left:20px;"><?php $var_h = "00";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "01";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "02";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "03";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "04";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "05";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "06";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "07";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "08";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "09";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "10";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "11";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "12";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "13";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "14";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "15";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "16";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "17";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "18";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "19";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "20";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "21";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "22";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "23";?>
			<div class="span3 check-line"><input name="hora_segunda_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_segunda_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_segunda_a)){ echo 'checked'; }?>> <label class='inline' for="hora_segunda_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> Liberar acesso ao sistema apenas dentro da hora marcada.</span>
											</div>
										</div>
										<div class="control-group css_hora_ativo" <?php if($hora_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">Terça (horas)</label>
											<div class="controls">
		<div style="margin-left:20px;"><?php $var_h = "00";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "01";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "02";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "03";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "04";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "05";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "06";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "07";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "08";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "09";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "10";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "11";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "12";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "13";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "14";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "15";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "16";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "17";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "18";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "19";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "20";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "21";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "22";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "23";?>
			<div class="span3 check-line"><input name="hora_terca_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_terca_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_terca_a)){ echo 'checked'; }?>> <label class='inline' for="hora_terca_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> Liberar acesso ao sistema apenas dentro da hora marcada.</span>
											</div>
										</div>
										<div class="control-group css_hora_ativo" <?php if($hora_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">Quarta (horas)</label>
											<div class="controls">
		<div style="margin-left:20px;"><?php $var_h = "00";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "01";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "02";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "03";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "04";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "05";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "06";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "07";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "08";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "09";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "10";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "11";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "12";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "13";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "14";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "15";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "16";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "17";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "18";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "19";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "20";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "21";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "22";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "23";?>
			<div class="span3 check-line"><input name="hora_quarta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quarta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quarta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quarta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> Liberar acesso ao sistema apenas dentro da hora marcada.</span>
											</div>
										</div>
										<div class="control-group css_hora_ativo" <?php if($hora_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">Quinta (horas)</label>
											<div class="controls">
		<div style="margin-left:20px;"><?php $var_h = "00";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "01";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "02";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "03";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "04";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "05";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "06";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "07";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "08";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "09";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "10";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "11";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "12";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "13";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "14";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "15";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "16";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "17";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "18";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "19";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "20";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "21";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "22";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "23";?>
			<div class="span3 check-line"><input name="hora_quinta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_quinta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_quinta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_quinta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> Liberar acesso ao sistema apenas dentro da hora marcada.</span>
											</div>
										</div>
										<div class="control-group css_hora_ativo" <?php if($hora_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">Sexta (horas)</label>
											<div class="controls">
		<div style="margin-left:20px;"><?php $var_h = "00";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "01";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "02";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "03";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "04";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "05";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "06";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "07";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "08";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "09";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "10";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "11";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "12";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "13";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "14";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "15";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "16";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "17";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "18";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "19";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "20";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "21";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "22";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "23";?>
			<div class="span3 check-line"><input name="hora_sexta_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sexta_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sexta_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sexta_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> Liberar acesso ao sistema apenas dentro da hora marcada.</span>
											</div>
										</div>
										<div class="control-group css_hora_ativo" <?php if($hora_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">Sábado (horas)</label>
											<div class="controls">
		<div style="margin-left:20px;"><?php $var_h = "00";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "01";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "02";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "03";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "04";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "05";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "06";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "07";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "08";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "09";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "10";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "11";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "12";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "13";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "14";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "15";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "16";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "17";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "18";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "19";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "20";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "21";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "22";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "23";?>
			<div class="span3 check-line"><input name="hora_sabado_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_sabado_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_sabado_a)){ echo 'checked'; }?>> <label class='inline' for="hora_sabado_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> Liberar acesso ao sistema apenas dentro da hora marcada.</span>
											</div>
										</div>
										<div class="control-group css_hora_ativo" <?php if($hora_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">Domingo (horas)</label>
											<div class="controls">
		<div style="margin-left:20px;"><?php $var_h = "00";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "01";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "02";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "03";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "04";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "05";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "06";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "07";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "08";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "09";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "10";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "11";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "12";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "13";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "14";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "15";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "16";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "17";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "18";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "19";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "20";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "21";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "22";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
		<div style="margin-left:20px;"><?php $var_h = "23";?>
			<div class="span3 check-line"><input name="hora_domingo_<?=$var_h?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="hora_domingo_<?=$var_h?>" value="<?=$var_h?>" data-skin="square" data-color="blue" <?php if(preg_match("/\.".$var_h."\./i", $hora_domingo_a)){ echo 'checked'; }?>> <label class='inline' for="hora_domingo_<?=$var_h?>"><b><?=$var_h?></b> HORAS</label></div>
        </div>
                                              <span class="help-block span12"><i class="icon-info-sign"></i> Liberar acesso ao sistema apenas dentro da hora marcada.</span>
											</div>
										</div>
                                        
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->
  
  


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosrestipfaixa".$array_temp;//id de controle
						$boxUI_titulo = "Restrição de Acesso Por IP/Faixa";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						if($ip_a != ""){ $boxUI_status = "1"; }
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
											<label class="control-label">IP/faixa de restrição</label>
											<div class="controls">
											  <input type="text" name="ip" id="ip" value="<?=$ip_a?>" class="input-medium ipfaixa_numero">
                                              <span class="help-block"><i class="icon-info-sign"></i> *Caso deixe vazio, não haverá restrição por IP/Faixa. <b>Seu IP atual é: <?=$_SERVER['REMOTE_ADDR']?></b></span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">ATENÇÃO</label>
											<div class="controls display">
											  A restrição por IP, só libera o acesso caso o usuário esteja utilizando o IP ou Faixa de IP informado. Exemplo IP: 200.10.10.2 ou 10.12.15.2, Faixa de IP: 200.10.10.* ou 10.12.*.*
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
  
  


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgeoat".$array_temp;//id de controle
						$boxUI_titulo = "Geolocalização Forçar Compartilhamento";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						if($geo_ativo_a == "1"){ $boxUI_status = "1"; }
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
											<label class="control-label">Utilizar</label>
											<div class="controls">
												<div class="check-line"><input name="geo_ativo" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="geo_ativo" value="1" data-skin="square" data-color="blue" <?php if($geo_ativo_a == "1"){ echo 'checked'; }?>> <label class='inline' for="geo_ativo">Ativar geolocalização (só permite o uso do sistema se permitir o compartilhamento da localização)</label></div>
											</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#<?=$formCadastroPincipal?> #geo_ativo").on("change", function(e){
		if(valHtml('geo_ativo','#<?=$formCadastroPincipal?>') == "1"){
			$('#<?=$formCadastroPincipal?> .css_geo_naopermite').hide(); $('#<?=$formCadastroPincipal?> .css_geo_permite').fadeIn();
		}else{ $('#<?=$formCadastroPincipal?> .css_geo_permite').hide(); $('#<?=$formCadastroPincipal?> .css_geo_naopermite').fadeIn(); }
	});
});
</script>
										</div>
										<div class="control-group css_geo_naopermite" <?php if($geo_ativo_a == "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">NÃO ATIVO</label>
											<div class="controls display">
											  O usuário <b>não é forçado</b> a compartilhar sua localização. Recurso disponível em seu navegador.
											</div>
										</div>
										<div class="control-group css_geo_permite" <?php if($geo_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">ESTÁ ATIVO</label>
											<div class="controls display">
											  O usuário <b>será forçado</b> a compartilhar sua localização, caso ele bloqueie de alguma forma o sistema não permite acesso. Recurso disponível em seu navegador.
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
  
  


                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadostoken".$array_temp;//id de controle
						$boxUI_titulo = "Liberação com Token SMS";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						if($token_ativo_a == "1"){ $boxUI_status = "1"; }
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
											<label class="control-label">Utilizar</label>
											<div class="controls">
												<div class="check-line"><input name="token_ativo" type="checkbox" class='<?=$INC_FAISHER["div"]?>-icheck' id="token_ativo" value="1" data-skin="square" data-color="blue" <?php if($token_ativo_a == "1"){ echo 'checked'; }?>> <label class='inline' for="token_ativo">Ativar Token SMS (só permite o acesso ao sistema após o recebimento de Token por SMS e confirmação junto ao login)</label></div>
											</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#<?=$formCadastroPincipal?> #token_ativo").on("change", function(e){
		if(valHtml('token_ativo','#<?=$formCadastroPincipal?>') == "1"){
			$('#<?=$formCadastroPincipal?> .css_token_naopermite').hide(); $('#<?=$formCadastroPincipal?> .css_token_permite').fadeIn();
		}else{ $('#<?=$formCadastroPincipal?> .css_token_permite').hide(); $('#<?=$formCadastroPincipal?> .css_token_naopermite').fadeIn(); }
	});
});
</script>
										</div>
										<div class="control-group css_token_naopermite" <?php if($token_ativo_a == "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">NÃO ATIVO</label>
											<div class="controls display">
											  Usuário não utiliza o Token SMS para liberação de acesso.
											</div>
										</div>
										<div class="control-group css_token_permite" <?php if($token_ativo_a != "1"){ echo 'style="display:none;"'; }?>>
											<label class="control-label">ESTÁ ATIVO</label>
											<div class="controls display">
											  Será enviado ao usuário logo após o login, um Token SMS para liberação do acesso ao sistema.
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





//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc")){
		//verifica se já existem usuários utilizando o grupo de permissões
		$conta_grupos = fSQL::SQL_CONTAGEM("sys_permissao_grupos", "expediente_id = '$id_excluir'");
		//verifica se é proprio usuario
		if($conta_usuarios == "0"){//verifica permissão
	
			//exclue o registro
			$tabela = "sys_permissao_expediente";
			$condicao = "id = '$id_excluir'";
			$resu2 =  fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			fGERAL::delRegistroLog("sys_permissao_expediente",$id_excluir,$cVLogin->userReg());//salvar/gerar log de exclusao
				
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("sys_permissao_expediente", "excluir", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Registro excluido com sucesso!");
		}else{ $cMSG->addMSG("ERRO","Existem $conta_grupos grupos(s) cadastrados no expediente! Não é possível remover."); }//fim else //excluir proprio usuario
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
	$grupos_acesso_a = getpost_sql($_POST["grupos_acesso"]);
	$ip_a = getpost_sql($_POST["ip"]);
	if(isset($_POST["hora_ativo"])){ $hora_ativo_a = getpost_sql($_POST["hora_ativo"]); }else{ $hora_ativo_a = "0"; }
	if(isset($_POST["geo_ativo"])){ $geo_ativo_a = getpost_sql($_POST["geo_ativo"]); }else{ $geo_ativo_a = "0"; }
	if(isset($_POST["token_ativo"])){ $token_ativo_a = getpost_sql($_POST["token_ativo"]); }else{ $token_ativo_a = "0"; }
	
	//verifica se pega as vars de horas
	$arrH["segunda"] = "";
	$arrH["terca"] = "";
	$arrH["quarta"] = "";
	$arrH["quinta"] = "";
	$arrH["sexta"] = "";
	$arrH["sabado"] = "";
	$arrH["domingo"] = "";
	if($hora_ativo_a >= "1"){
		$var_dia = "segunda";//-------------------------- segunda -----------------------------------------------------------------------------
		$var_ = "00"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "01"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "02"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "03"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "04"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "05"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "06"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "07"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "08"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "09"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "10"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "11"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "12"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "13"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "14"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "15"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "16"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "17"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "18"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "19"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "20"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "21"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "22"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "23"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		if($arrH["$var_dia"] != ""){ $arrH["$var_dia"] = "[".$arrH["$var_dia"].".]"; }//-------------------------------------------------------
		$var_dia = "terca";//-------------------------- terça -----------------------------------------------------------------------------
		$var_ = "00"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "01"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "02"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "03"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "04"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "05"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "06"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "07"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "08"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "09"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "10"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "11"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "12"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "13"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "14"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "15"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "16"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "17"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "18"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "19"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "20"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "21"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "22"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "23"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		if($arrH["$var_dia"] != ""){ $arrH["$var_dia"] = "[".$arrH["$var_dia"].".]"; }//-------------------------------------------------------
		$var_dia = "quarta";//-------------------------- quarta -----------------------------------------------------------------------------
		$var_ = "00"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "01"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "02"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "03"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "04"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "05"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "06"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "07"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "08"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "09"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "10"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "11"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "12"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "13"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "14"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "15"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "16"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "17"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "18"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "19"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "20"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "21"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "22"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "23"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		if($arrH["$var_dia"] != ""){ $arrH["$var_dia"] = "[".$arrH["$var_dia"].".]"; }//-------------------------------------------------------
		$var_dia = "quinta";//-------------------------- quinta -----------------------------------------------------------------------------
		$var_ = "00"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "01"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "02"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "03"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "04"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "05"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "06"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "07"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "08"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "09"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "10"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "11"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "12"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "13"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "14"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "15"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "16"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "17"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "18"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "19"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "20"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "21"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "22"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "23"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		if($arrH["$var_dia"] != ""){ $arrH["$var_dia"] = "[".$arrH["$var_dia"].".]"; }//-------------------------------------------------------
		$var_dia = "sexta";//-------------------------- sexta -----------------------------------------------------------------------------
		$var_ = "00"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "01"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "02"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "03"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "04"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "05"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "06"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "07"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "08"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "09"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "10"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "11"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "12"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "13"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "14"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "15"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "16"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "17"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "18"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "19"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "20"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "21"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "22"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "23"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		if($arrH["$var_dia"] != ""){ $arrH["$var_dia"] = "[".$arrH["$var_dia"].".]"; }//-------------------------------------------------------
		$var_dia = "sabado";//-------------------------- sábado -----------------------------------------------------------------------------
		$var_ = "00"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "01"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "02"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "03"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "04"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "05"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "06"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "07"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "08"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "09"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "10"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "11"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "12"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "13"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "14"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "15"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "16"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "17"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "18"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "19"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "20"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "21"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "22"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "23"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		if($arrH["$var_dia"] != ""){ $arrH["$var_dia"] = "[".$arrH["$var_dia"].".]"; }//-------------------------------------------------------
		$var_dia = "domingo";//-------------------------- domingo -----------------------------------------------------------------------------
		$var_ = "00"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "01"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "02"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "03"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "04"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "05"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "06"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "07"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "08"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "09"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "10"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "11"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "12"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "13"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "14"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "15"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "16"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "17"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "18"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "19"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "20"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "21"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "22"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		$var_ = "23"; if(isset($_POST["hora_".$var_dia."_".$var_])){ $arrH["$var_dia"] .= ".".getpost_sql($_POST["hora_".$var_dia."_".$var_]); }
		if($arrH["$var_dia"] != ""){ $arrH["$var_dia"] = "[".$arrH["$var_dia"].".]"; }//-------------------------------------------------------
	}//if($hora_ativo_a >= "1"){
		



//VALIDAÇÔES ------------------------------**********
	//valida campo nome -- XXX
	if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo nome não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo nome -- XXX
	if(($hora_ativo_a >= "1") and ($arrH["segunda"] == "") and ($arrH["terca"] == "") and ($arrH["quarta"] == "") and ($arrH["quinta"] == "") and ($arrH["sexta"] == "") and ($arrH["sabado"] == "") and ($arrH["domingo"])){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Foi marcado o bloqueio por horários e não existe horas selecionadas, preencha corretamente!";//msg
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


		
	

	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO


	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "sys_permissao_expediente";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,nome,hora_ativo,hora_segunda,hora_terca,hora_quarta,hora_quinta,hora_sexta,hora_sabado,hora_domingo,ip,geo_ativo,token_ativo,user,time,user_a,sync";
	$valores = array($id_a,$nome_a,$hora_ativo_a,$arrH["segunda"],$arrH["terca"],$arrH["quarta"],$arrH["quinta"],$arrH["sexta"],$arrH["sabado"],$arrH["domingo"],$ip_a,$geo_ativo_a,$token_ativo_a,$cVLogin->userReg(),time(),"0",time());
	$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	
		
	//atualiza dados da tabela no DB
	$tabela = "sys_permissao_grupos";
	$campos = "expediente_id";
	$valores = array("0");
	$condicao = "expediente_id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	//monta array de dados
	$array = explode(",", $grupos_acesso_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		foreach($array as $pos => $valor){
			if($valor >= "1"){
				//atualiza dados da tabela no DB
				$tabela = "sys_permissao_grupos";
				$campos = "expediente_id";
				$valores = array($id_a);
				$condicao = "id='$valor'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			}//if($valor >= "1"){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	
	
	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_permissao_expediente", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_permissao_expediente",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Controle de expediente de acesso cadastrado com sucesso! <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");



}else{  //############# ELSE - ALTERA REGISTRO |-


		
	//atualiza dados da tabela no DB
	$tabela = "sys_permissao_expediente";
	$campos = "nome,hora_ativo,hora_segunda,hora_terca,hora_quarta,hora_quinta,hora_sexta,hora_sabado,hora_domingo,ip,geo_ativo,token_ativo,user_a,sync";
	$valores = array($nome_a,$hora_ativo_a,$arrH["segunda"],$arrH["terca"],$arrH["quarta"],$arrH["quinta"],$arrH["sexta"],$arrH["sabado"],$arrH["domingo"],$ip_a,$geo_ativo_a,$token_ativo_a,$cVLogin->userReg(),time());
	$condicao = "id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	

		
	//atualiza dados da tabela no DB
	$tabela = "sys_permissao_grupos";
	$campos = "expediente_id";
	$valores = array("0");
	$condicao = "expediente_id='$id_a'";
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	//monta array de dados
	$array = explode(",", $grupos_acesso_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		foreach($array as $pos => $valor){
			if($valor >= "1"){
				//atualiza dados da tabela no DB
				$tabela = "sys_permissao_grupos";
				$campos = "expediente_id";
				$valores = array($id_a);
				$condicao = "id='$valor'";
				fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			}//if($valor >= "1"){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){



	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("sys_permissao_expediente", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("sys_permissao_expediente",$id_a,$ARRAY_LOG,$cVLogin->userReg());
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
	$SQL_campos = "id,nome,hora_ativo,ip,geo_ativo,token_ativo,user,time,user_a,user_a,sync"; //campos da tabela
	$SQL_tabela = "sys_permissao_expediente"; //tabela
	$SQL_where = ""; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&"; //variaveis para a paginacao
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






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){  $filtro_marca[] = $rapida_b;
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( `id` = '$rapida_b' OR `nome` LIKE '%$rapida_b%' ) "; //condição 
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
				<th>Bloqueios</th>
				<th class='hidden-480'>Nº Grupos</th>
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
	$nome = $linha1["nome"];
	$hora_ativo = $linha1["hora_ativo"];
	$ip = $linha1["ip"];
	$geo_ativo = $linha1["geo_ativo"];
	$token_ativo = $linha1["token_ativo"];
	$user = $linha1["user"];
	$time = $linha1["time"];
	$user_a = $linha1["user_a"];
	$sync = $linha1["sync"];
	
	//verifica bloqueios
	$bloqueios_leg = "";
	if($hora_ativo >= "1"){ if($bloqueios_leg != ""){ $bloqueios_leg .= "<br>"; } $bloqueios_leg .= "- BLOQUEIO POR HORÁRIOS"; }
	if($ip != ""){ if($bloqueios_leg != ""){ $bloqueios_leg .= "<br>"; } $bloqueios_leg .= "- BLOQUEIO POR IP/FAIXA"; }
	if($geo_ativo >= "1"){ if($bloqueios_leg != ""){ $bloqueios_leg .= "<br>"; } $bloqueios_leg .= "- FORÇAR GEOLOCALIZAÇÃO"; }
	if($token_ativo >= "1"){ if($bloqueios_leg != ""){ $bloqueios_leg .= "<br>"; } $bloqueios_leg .= "- TOKEN SMS DE ACESSO"; }
	if($bloqueios_leg == ""){ $bloqueios_leg = "[SEM BLOQUEIOS]"; }

	if($user_a != ""){
		$registro = "Alterado por ".sentenca(primeiro_nome($user_a,"2")).", ".date('d/m/Y H:i', $sync)."h";
	}else{//if($user_a != ""){
		$registro = "Cadastrado por ".sentenca(primeiro_nome($user,"2")).", ".date('d/m/Y H:i', $time)."h";
	}//if($user_a != ""){
		
	$conta_grupos = fSQL::SQL_CONTAGEM("sys_permissao_grupos", "expediente_id = '$id_a'");
?>
										<tr>
											<td class="sVisu"><b><?=maiusculo($nome)?></b><br><?=$registro?></td>
											<td class="sVisu"><?=$bloqueios_leg?></td>
											<td class='sVisu hidden-480'><b><?=$conta_grupos?></b> grupo(s)</td>
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