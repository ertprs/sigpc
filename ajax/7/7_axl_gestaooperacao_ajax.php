<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";



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
	<?php $idCJ = "rnt_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "rnc_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Filtrando dados...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "doc_numero_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datan_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }	
	<?php $idCJ = "rnt_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "rnc_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }	

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
            </div>
        </div> 
        <div class="form-actions">
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_RM_SIGLA?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="rnt_b" id="rnt_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_RM_SIGLA))?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
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
                <div style="height:5px;"></div>
            </div>
        </div>  
        <div class="form-actions">
        </div>     
        <div class="control-group" id="div_rnc_b">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_PROCESSO_SIGLA?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="rnc_b" id="rnc_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_PROCESSO_SIGLA))?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
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




























if($ajax == "imprimirCapaProcesso"){
	$code = getpost_sql($_GET["code"]);

	$qrcode_img = time().".jpeg";
	$html = capaProcesso($code, $qrcode_img); 
	

?>	

<form id="FormReciboii" name="FormReciboii" method="post" class="hide" action="export.php" target="_blank">
  <input name="acao" id="acao" type="hidden" value="pdfhtml" />
  <input name="cabecalho" id="cabecalho" type="hidden" value="1" /> 
  <input name="pg" id="pg" type="hidden" value="0" />  
  <input name="img_apagar" id="img_apagar" type="hidden" value="<?=$qrcode_img?>" />  
  <input name="nome" id="nome" type="hidden" value="capa-processo-<?=$code?>" />
  <input name="titulo" id="titulo" type="hidden" value="PROCESSUS" />
  <input name="html" id="html" type="hidden" value="<?=$html?>" />
</form>	
<script>
//prepara o envio do CSV
function exportarPDF(){
	$("#FormReciboii #html").val("<?=stripslashes($html)?>");
	$('#FormReciboii').submit();
}
$(document).ready(function(e) {
    exportarPDF();
	
});
</script>
<?php
}//imprimirCapaProcesso






































if($ajax == "imprimirProcessoFull"){
	$code = getpost_sql($_GET["code"]);

?>	

<form id="FormReciboii" name="FormReciboii" method="post" class="hide" action="export.php" target="_blank">
  <input name="acao" id="acao" type="hidden" value="processoFull" />
  <input name="cabecalho" id="cabecalho" type="hidden" value="1" /> 
  <input name="titulo" id="titulo" type="hidden" value="PROCESSUS" />
  <input name="code" id="code" type="hidden" value="<?=$code?>" />
</form>	
<script>
//prepara o envio do CSV
function exportarPDF(){
	$('#FormReciboii').submit();
}
$(document).ready(function(e) {
    exportarPDF();
});
</script>
<?php
}//imprimirProcessoFull




























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
	



	//verificação de cancelamento/suspensão
	if(isset($_GET["acao"])){
		$array_temp = getpost_sql($_GET["array_temp"]);
		$acao = getpost_sql($_GET["acao"]);
		$motivo = getpost_sql($_GET["motivo"]);
		$motivo_descricao = getpost_sql($_GET["motivo_descricao"]);		
		$data_p = getpost_sql($_GET["data_p"]);		
		$data_c = getpost_sql($_GET["data_c"], "DATA");

		if($acao == "1"){//suspensão
			if($data_p != ""){ $data_p = data_mysql($data_p); $data_p = strtotime($data_p." 23:59"); }else{ $data_p = "99999999"; } 
		}//if($acao == "1"){//suspensão
		if($data_c != ""){ $data_c = strtotime($data_c." 23:59"); }else{ $data_c = "99999999"; }
		//echo "<pre>"; print_r($_GET); echo "</pre>";
		
		$cancelamento_suspensao_id_a = fSQL::SQL_SELECT_INSERT("axl_cancelamento_suspensao");
		$campos = "id,processo_id,acao,candidato_id,status,motivo,motivo_descricao,data_p,data_c,user,time,user_a,sync";
		$valores = array($cancelamento_suspensao_id_a,$id_a,$acao,$candidato_fisico_id_a,"0",$motivo,$motivo_descricao,$data_p,$data_c,$cVLogin->userReg(),time(),"0",time());
		fSQL::SQL_INSERT_SIMPLES($campos,"axl_cancelamento_suspensao",$valores);
		
		fSQL::SQL_UPDATE_SIMPLES("cancelamento_suspensao_id","axl_processo",array($cancelamento_suspensao_id_a),"id = '".$id_a."'");
		
		$upload_dir_temp = VAR_DIR_FILES."files/temp/";
		$campos = "id,titulo,nome,arquivo";
		$tabela = "sys_arquivos_temp";
		$where = "acao = '".$array_temp."' AND form = 'oficio".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_e = $linha["id"];
			$titulo_e = $linha["titulo"];
			$nome_e = $linha["nome"];
			$arquivo_e = $linha["arquivo"];
			if(file_exists($upload_dir_temp.$arquivo_e)){
				
				$upload_dir = $processo_dir."cancelamento_suspensao/"; $cria = fGERAL::criaPasta($upload_dir, "0775"); //confere a criação e retona 1			
				fSQL::SQL_UPDATE_SIMPLES("oficio","axl_cancelamento_suspensao",array($arquivo_e),"id = '".$cancelamento_suspensao_id_a."'");
				//move o arquivo para o novo local e exclue o temp
				rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_e);
				//exclue o registro
				$tabela = "sys_arquivos_temp";
				fSQL::SQL_DELETE_SIMPLES($tabela, "id = '$id_e'");
			}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
		}//fim while		
		
		fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Solicitação de !!tipo!!',array("tipo"=>acaoProcessoLeg($acao))),$class_fLNG->txt(__FILE__,__LINE__,'Solicitação de !!tipo!!',array("tipo"=>acaoProcessoLeg($acao))),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$id_a,$processo_dir);
		
		$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Solicitação de !!tipo!! realizado com sucesso',array("tipo"=>acaoProcessoLeg($acao))));	
	}//if(isset($_GET["acao"])){


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
											<th>Data/Hora</th>
											<th>Evento</th>
											<th>Descrição</th>
											<th>Usuário</th>                                            
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
	<?php if($cancelamento_suspensao_id_a <= "0"){?>
            	<a href="#" class="btn btn-warning btn-large" onclick="modalMotivo<?=$INC_FAISHER["div"]?>('1','<?=$id_a?>','<?=$code?>');return false;"><i class="glyphicon-ban"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitar Suspensão do Processo')?></a>
                <a href="#" class="btn btn-red btn-large" onclick="modalMotivo<?=$INC_FAISHER["div"]?>('2','<?=$id_a?>','<?=$code?>');return false;"><i class="glyphicon-ban"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitar Cancelamento do Processo')?></a>
       			<button type="button" class="btn btn-large btn-primary" onclick="imprimirCapaProcesso<?=$INC_FAISHER["div"]?>('<?=$code?>');return false;"><i class="icon-print"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Capa do Processo')?></button>
                <button type="button" class="btn btn-large btn-primary" onclick="imprimirProcessoFull<?=$INC_FAISHER["div"]?>('<?=$code?>');return false;"><i class="icon-print"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Processo Completo')?></button>
	<?php }//if($cancelamento_suspensao_id_a <= "0"){?>                
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
                                                    	<td><a href="#" onclick="detalhesProcesso<?=$INC_FAISHER["div"]?>('<?=$linha["id"]?>','<?=$linha["code"]?>','');return false;" class="btn btn-default btn-block" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a></td>
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
            	<?=$button?>
            </div>                              
                            
</form>
<?php	
}//detalhesCandidato




































if($ajax == "detalhesAcao"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	$id_a = getpost_sql($_GET["id"]);
	$arrCP = fSQL::SQL_SELECT_ONE("*","axl_cancelamento_suspensao","id = '".$id_a."'");
	
	$arrCandidato = fSQL::SQL_SELECT_ONE("nome,sobrenome,code","cad_candidato_fisico","id = '".$arrCP["candidato_id"]."'");
	
	$arrPro = fSQL::SQL_SELECT_ONE("ano,mes,dia,code,servico_id","axl_processo","id = '".$arrCP["processo_id"]."'");
	$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$arrPro["servico_id"]."'");
	$servico_id_n = $linhaxxx["nome"];
	
	$status_leg = $class_fLNG->txt(__FILE__,__LINE__,'Aguardando Análise');
	if($status == "1"){ $status_leg = $class_fLNG->txt(__FILE__,__LINE__,'Solicitação Aceita'); }
	if($status == "2"){ $status_leg = $class_fLNG->txt(__FILE__,__LINE__,'Solicitação Negada'); }	
	
	$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$arrPro["ano"]."/".completa_zero($arrPro["mes"],"2")."/".completa_zero($arrPro["dia"],"2")."/".$arrPro["code"]."/";
	$caminho_file = $processo_dir."cancelamento_suspensao/".$arrCP["oficio"];
	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;	
?>
<form class="form-horizontal form-bordered form-validate" onSubmit="return false;">
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitação tipo')?></label>
                <div class="controls display-plus">
                    <?=sentenca(acaoProcessoLeg($arrCP["acao"]))?> (<?=$status_leg?>)
                </div>
            </div>             
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></label>
                <div class="controls display">
                  <?=SYS_CONFIG_RM_SIGLA?> <?=$arrCandidato["code"]?> - <?=$arrCandidato["nome"]?> <?=$arrCandidato["sobrenome"]?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo')?></label>
                <div class="controls display">
                  <?=SYS_CONFIG_PROCESSO_SIGLA?> <?=$arrPro["code"]?> - <?=$servico_id_n?>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo')?></label>
                <div class="controls ">
                  <?=motivoCancelamento($arrCP["motivo"])?>
                  <?php if($arrCP["motivo_descricao"] != ""){?> <br><i><?=$arrCP["motivo_descricao"]?></i> <?php } ?>
                </div>
            </div>    
            <?php if($arrCP["data_p"] >= "1"){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Suspensão do processo')?></label>
                <div class="controls">
                	<?php if($arrCP["data_p"] == "99999999"){?> <?=$class_fLNG->txt(__FILE__,__LINE__,'Indeterminado')?> <?php }else{?> <?=date("d/m/Y",$arrCP["data_p"])?> <?php } ?>
                </div>
            </div>    
            <?php }//if($arrCP["data_p"] >= "1"){?>                  
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Bloqueio do candidato')?></label>
                <div class="controls">
                	<?php if($arrCP["data_c"] == "99999999"){?> <?=$class_fLNG->txt(__FILE__,__LINE__,'Indeterminado')?> <?php }else{?> <?=date("d/m/Y",$arrCP["data_c"])?> <?php } ?>
                </div>
            </div>    
            <?php if(file_exists($caminho_file)){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ofício enviado')?></label>
                <div class="controls">
                    <a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery1]" id="iimg_1"><?=$cVLogin->icoFile($caminho_file, "")?></a>
                    <a href="#" onclick="$('#iimg_1').click();return false;" class="btn" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i></a>                	
                </div>
            </div>                          
            <?php }//if(file_exists($caminho_file)){?>            
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitado por')?></label>
                <div class="controls">
                	<?=$arrCP["user"]?>, <?=date("d/m/Y H:i",$arrCP["time"])?>h
                </div>
            </div> 
            <?php if($arrCP["user_a"] != "0"){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Analisado por')?></label>
                <div class="controls">
                	<?=$arrCP["user_a"]?>, <?=date("d/m/Y H:i",$arrCP["sync"])?>h
                </div>
            </div>    
            <?php }//if($arrCP["user_a"] != ""){?>                     
                      

                            
                            
                   
            <div class="form-actions">
            	<button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
            </div>                              
                            
</form>
<?php	
}//detalhesAcao
































if($ajax == "cancelarAcao"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	$acao = getpost_sql($_GET["acao"]);
	$processo_id = getpost_sql($_GET["processo_id"]);
	$processo_code = getpost_sql($_GET["processo_code"]);

	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$form = "formBusc".$array_temp;	
?>
<form action="#" id="<?=$form?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">

        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo')?></label>
            <div class="controls">
                <select name="motivo" id="motivo" class="select2-me span12">
<?php
$array = motivoCancelamento("array");
foreach($array as $pos => $legenda){
?>                
                	<option value="<?=$pos?>"><?=$legenda?></option>
<?php
}//foreach
?>                    
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Observação de !!tipo!!',array("tipo"=>acaoProcessoLeg($acao)))?></label>
            <div class="controls">
                <textarea name="motivo_descricao" id="motivo_descricao" rows="3" class="input-block-level cssFonteMai" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Observação')?>"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ofício')?></label>
            <div class="controls">
                <input name="cont_f" id="cont_f" type="hidden" value="0"/>
                <?php
                //montar IFRAME
                $idTemp = $array_temp;//id do retorno
                $idIframe = "oficio".$array_temp;//id do iframe
                $arqTipo = "pdf";//tipos de arquivos
                $n_arqQtd = "1";//quantidade de arquivos maximo
                $desc = "0";//ativar descicao, 1 ligado, 0 desligado
                $funcao = "confUp".$INC_FAISHER["div"];//ativar funcao java con retorno de QTD enviados
                ?>
              	<iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<script>                                
function confUp<?=$INC_FAISHER["div"]?>(v_retorno){
	if(v_retorno >= "1"){ $('#<?=$form?> #cont_f').val(v_retorno); }else{ $('#<?=$form?> #cont_f').val("0"); }
}//confUp
</script>
            </div>
        </div> 
        <?php if($acao == "1"){//suspender ?>
        <div class="control-group">
            <label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo suspenso até')?></label>
            <div class="controls">
                <div class="input-append">
                    <input type="text" name="data_p" id="data_p" value="" class='input-small mask_date'>
                    <span class="add-on icon-calendar"></span>
                </div>
                <p class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Deixando em branco, o <b>processo</b> será suspenso por tempo indeterminado.')?></p>
            </div>
        </div>    
        <?php }//if($acao == "suspender"){?>            
        <div class="control-group">
            <label for="textfield" class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato suspenso até')?></label>
            <div class="controls">
                <div class="input-append">
                    <input type="text" name="data_c" id="data_c" value="" class='input-small mask_date'>
                    <span class="add-on icon-calendar"></span>
                </div>
                <p class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Deixando em branco, o <b>candidato</b> será suspenso por tempo indeterminado.')?></p>
            </div>
        </div>            
        <div class="control-group" id="divdiv_senha">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Confirme sua senha de acesso para prosseguir')?></label>
            <div class="controls" id="div_senha">
                <input type="password" name="senha" id="senha" class="form-control"/>
                <button type="button" class="btn btn-info" onclick="validarSenha<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Validar Senha')?></button>
            </div>
        </div>  

        
 	 	<div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="cancelar<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Salvar')?></button>
            <button type="button" class="btn btn-large" onclick="detalhesProcesso<?=$INC_FAISHER["div"]?>('<?=$processo_id?>','<?=$processo_code?>','');return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>        

</form>
<script>
function validarSenha<?=$INC_FAISHER["div"]?>(){
	v_get = $("#senha").val();
	loaderFoco('divdiv_senha','divdiv_senha_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Verificando...')?>');//cria um loader dinamico
	faisher_ajax('div_senha', 'divdiv_senha_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=validarSenha&senha='+v_get, 'get', 'ADD');
}//validarSenha
function cancelar<?=$INC_FAISHER["div"]?>(){
	v_motivo = $("#motivo").val();
	v_motivo_descricao = $("#motivo_descricao").val();
	v_valida_senha = $("#valida_senha").val();
	v_data_p = $("#data_p").val();
	v_data_c = $("#data_c").val();
	v_cont_f = $("#cont_f").val();	
	if(v_data_p == null){ v_data_p = ""; }
	
	valida = "";
	if(v_data_p != "" && "<?=$acao?>" == "1"){//somente suspensão
		var arr = v_data_p.split("/");
		var data = new Date(arr[2],arr[1]-1,arr[0]);
		if(new Date() >= data){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Data de suspensão do processo deve ser maior do que a data de hoje!')?>"; }
	}//if(v_data_p != ""){
	if(v_data_c != "" && valida == ""){	
		var arr = v_data_c.split("/");
		var data = new Date(arr[2],arr[1]-1,arr[0]);
		if(new Date() >= data){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Data de suspensão do candidato deve ser maior do que a data de hoje!')?>"; }	
	}//if(v_data_c != ""){	
	
	if(v_motivo == "" && valida == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o motivo, verifique!')?>"; }
	if(v_cont_f == "" && valida == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário enviar o ofício de solicitação!')?>"; }
	if(v_valida_senha == null && valida == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Senha não foi validada, verifique!')?>"; }

	if(valida != ""){ alert(valida); }else{//if(v_motivo_cancelamento){
		v_get = "&array_temp=<?=$array_temp?>&acao=<?=$acao?>&motivo="+v_motivo+"&motivo_descricao="+v_motivo_descricao+"&data_p="+v_data_p+"&data_c="+v_data_c;
		detalhesProcesso<?=$INC_FAISHER["div"]?>('<?=$processo_id?>','<?=$processo_code?>',v_get);
		//atualizarLista<?=$INC_FAISHER["div"]?>('<?=$acao?>','<?=$processo_id?>',v_motivo_cancelamento);
	}//}else{//if(v_motivo_cancelamento){
}//cancelar
</script>
<?php	
}//if($ajax == "cancelarAcao"){








if($ajax == "validarSenha"){
	$senha_informada = getpost_sql($_GET["senha"]);
	$senha_informada = fGERAL::cryptoSenhaDB($senha_informada);//codifica senha
	
	$linha = fSQL::SQL_SELECT_ONE("senha","sys_login","usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'");
	$senha = $linha["senha"];
	
	if($senha != $senha_informada){
		$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Senha informada não confere com senha de acesso, verifique!'));
		$cMSG->imprimirMSG();		
?>		
		<input type="password" name="senha" id="senha" class="form-control"/>
        <button type="button" class="btn btn-info" onclick="validarSenha<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Validar Senha')?></button>		
<?php        
	}else{//if($senha != $senha_informada){
?>
		<input type="hidden" id="valida_senha" name="valida_senha" value="1" />
		<span style="color:green;"><b><i class="icon-check"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Senha confirmada!')?></b></span>
<?php		
	}//}else{//if($senha != $senha_informada){
}//validarSenha











































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//








if($ajax == "compararImagens"){
	$tipo = $_GET["tipo"];
	$coleta_id = $_GET["coleta_id"];
	$duplicado_coleta_id = $_GET["duplicado_coleta_id"];	
	
	$linha = fSQL::SQL_SELECT_ONE("ano,mes,dia,nfiq1,nfiq2,nfiq3,nfiq4,nfiq5,nfiq6,nfiq7,nfiq8,nfiq9,nfiq10","axl_coleta_biometrica","id = '$coleta_id'");
	$caminho_file = VAR_DIR_FILES."files/tabelas/coleta/".$linha["ano"]."/".completa_zero($linha["mes"],"2")."/".completa_zero($linha["dia"],"2")."/".$coleta_id."/";
	$assinatura_file = $caminho_file."assinatura.jpg";
	$foto_file = $caminho_file."foto.jpg";		
	
	$linha_duplicado = fSQL::SQL_SELECT_ONE("ano,mes,dia,nfiq1,nfiq2,nfiq3,nfiq4,nfiq5,nfiq6,nfiq7,nfiq8,nfiq9,nfiq10","axl_coleta_biometrica","id = '$duplicado_coleta_id'");
	$duplicado_caminho_file = VAR_DIR_FILES."files/tabelas/coleta/".$linha_duplicado["ano"]."/".completa_zero($linha_duplicado["mes"],"2")."/".completa_zero($linha_duplicado["dia"],"2")."/".$duplicado_coleta_id."/";
	$duplicado_assinatura_file = $duplicado_caminho_file."assinatura.jpg";
	$duplicado_foto_file = $duplicado_caminho_file."foto.jpg";		
	
	$base64 = ""; $base64_duplicado = ""; $leg = ""; $leg_duplicado = "";
	if($tipo == "foto"){ 
		$leg = "Foto";
		$leg_duplicado = "Foto";		
		$base64 = base64_encode(file_get_contents($foto_file)); 
		$base64_duplicado = base64_encode(file_get_contents($duplicado_foto_file));
	}//if($tipo == "foto"){
		
	if($tipo == "assinatura"){ 
		$leg = "Assinatura";
		$leg_duplicado = "Assinatura";		
		$base64 = base64_encode(file_get_contents($assinatura_file)); 
		$base64_duplicado = base64_encode(file_get_contents($duplicado_assinatura_file));
	}//if($tipo == "assinatura"){
		
	if($tipo == "dedo"){ 
		$lado = $_GET["lado"];
		$posicao = $_GET["posicao"];
		
		if($lado == "D"){ $lado = $class_fLNG->txt(__FILE__,__LINE__,'direito'); }else{ $lado = $class_fLNG->txt(__FILE__,__LINE__,'esquerdo'); }
		$lado = legDedo($posicao)." ".$lado;
		$leg = $lado." (NFIQ ".$linha["nfiq".$posicao].")";
		$leg_duplicado = $lado." (NFIQ ".$linha_duplicado["nfiq".$posicao].")";
		$base64 = base64_encode(file_get_contents($caminho_file."dedo".$posicao.".jpg")); 
		$base64_duplicado = base64_encode(file_get_contents($duplicado_caminho_file."dedo".$posicao.".jpg"));
	}//if($tipo == "assinatura"){				 
	
?>
<div class="row" style="text-align:center;">
	<table class="table" style="text-align:center;width:100%; ">
    	<thead>
        	<tr>
            	<th style="text-align:center;"><?=$class_fLNG->txt(__FILE__,__LINE__,'COLETADOS')?></th>
            	<th style="text-align:center;"><?=$class_fLNG->txt(__FILE__,__LINE__,'ENCONTRADOS')?></th>                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;"><img src="data:image/jpeg;base64, <?=$base64?>"/><br><?=$leg?></td>
                <td style="text-align:center;"><img src="data:image/jpeg;base64, <?=$base64_duplicado?>"/><br><?=$leg_duplicado?></td>            
            </tr>
        </tbody>
    </table>
</div>
<?php	
	
}//compararImagens






































//AJAX QUE EXIBE REGISTRO ------------------------------------------------------------------>>>
if($ajax == "registro"){
	$id_a = $_GET["id_a"];

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;



if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "axl_processo", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$ano_a = $linha1["ano"];
	$mes_a = $linha1["mes"];	
	$dia_a = $linha1["dia"];	
	$code_a = $linha1["code"];
	$origem_id_a = $linha1["origem_id"];	
	$tipo_servico_a = $linha1["tipo_servico"];	
	$triagem_id_a = $linha1["triagem_id"];	
	$servico_id_a = $linha1["servico_id"];	
	$candidato_fisico_id_a = $linha1["candidato_fisico_id"];
	$candidato_juridico_id_a = $linha1["candidato_juridico_id"];	
	$status_a = $linha1["status"];		
	$validade_anos_a = $linha1["validade_anos"];		
	$validade_time_a = $linha1["validade_time"];			
	$coleta_id_a = $linha1["coleta_id"];				
	$coleta_time_a = $linha1["coleta_time"];				
	$motivo_id_a = $linha1["motivo_id"];				
	$obs_geral_a = $linha1["obs_geral"];					
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
}

}//fim ajax  -------------------------------------------- <<<
?>
<?php




























//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	if(isset($_GET["tab_id"])){			$tab_id = getpost_sql($_GET["tab_id"]);		}else{ $tab_id = "0";		}




//################################### AÇÕES NO PROCESSO ||||||||||||||||>
if(isset($_GET["acao"])){
	$acao = getpost_sql($_GET["acao"]);
	$processo_id = getpost_sql($_GET["processo_id"]);
	if(isset($_GET["motivo_cancelamento"])){ $motivo_cancelamento = getpost_sql($_GET["motivo_cancelamento"]); }else{ $motivo_cancelamento = ""; }
	


	/////////////////////// ENVIAR PARA COLETA IMPRESSÃO ----------->>>
	if($acao == "impressao"){
		$result = thomasWScoletaBiometricaEnviar($processo_id,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"));
		if($result["codigo_retorno"] == "1"){ 
			$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Processo enviado para coleta biométrica!'));	
			
			//criar evento
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização de Coleta Biométrica'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para coleta biométrica'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,"");			
		}else{//if($result["codigo_retorno"] == "1"){
			$cMSG->addMSG("ERRO","<b>".$class_fLNG->txt(__FILE__,__LINE__,'Erro ao enviar para coleta biométrica, verifique os dados e tente novamente mais tarde!')."</b><br>".thomasCodRetorno($result["codigo_retorno"]));				
		}//}else{//if($result["codigo_retorno"] == "1"){
	}//if($acao == "coletabiometrica"){
	/////////////////////// ENVIAR PARA COLETA BIOMETRICA -----------<<<






	/////////////////////// ENVIAR PARA COLETA BIOMETRICA ----------->>>
	if($acao == "coletabiometrica"){
		$result = thomasWScoletaBiometricaEnviar($processo_id,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"));
		if($result["codigo_retorno"] == "1"){ 
			$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Processo enviado para coleta biométrica!'));	
		}else{//if($result["codigo_retorno"] == "1"){
			$cMSG->addMSG("ERRO","<b>".$class_fLNG->txt(__FILE__,__LINE__,'Erro ao enviar para coleta biométrica, verifique os dados e tente novamente mais tarde!')."</b><br>".thomasCodRetorno($result["codigo_retorno"]));				
		}//}else{//if($result["codigo_retorno"] == "1"){
	}//if($acao == "coletabiometrica"){
	/////////////////////// ENVIAR PARA COLETA BIOMETRICA -----------<<<
	
	
	
	
	/////////////////////// SUSPENDER ----------->>>
	if($acao == "suspender"){
		fSQL::SQL_UPDATE_SIMPLES("status,sync,obs_geral","axl_processo",array("10",time(),$motivo_cancelamento),"id = '".$processo_id."'");		
		$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Processo suspenso com sucesso!'));	
	}//if($acao == "suspender"){
	/////////////////////// SUSPENDER -----------<<<	
	
	
	
	
	/////////////////////// ATIVAR ----------->>>
	if($acao == "ativar"){
		fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array("5",time()),"id = '".$processo_id."'");		
		$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Processo reativado com sucesso!'));	
	}//if($acao == "ativar"){
	/////////////////////// ATIVAR -----------<<<	
	
	
	
	
	/////////////////////// CANCELAR ATIVO ----------->>>
	if($acao == "cancelarativo"){
		fSQL::SQL_UPDATE_SIMPLES("status,sync,obs_geral","axl_processo",array("6",time(),$motivo_cancelamento),"id = '".$processo_id."'");		
		$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Processo cancelado com sucesso!'));	
	}//if($acao == "cancelarativo"){
	/////////////////////// CANCELAR ATIVO -----------<<<
	
	
	
	/////////////////////// CANCELAR COLETA ----------->>>
	if($acao == "cancelarcoleta"){
		$result = thomasWScoletaBiometricaCancelar($processo_id,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$motivo_cancelamento);
		if($result["codigo_retorno"] == "1"){ 
			$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Coleta biométrica cancelada com sucesso!'));	
		}else{//if($result["codigo_retorno"] == "1"){
			$cMSG->addMSG("ERRO","<b>".$class_fLNG->txt(__FILE__,__LINE__,'Erro ao cancelar coleta biométrica, verifique os dados e tente novamente mais tarde!')."</b><br>".thomasCodRetorno($result["codigo_retorno"]));				
		}//}else{//if($result["codigo_retorno"] == "1"){		
	}//if($acao == "cancelarcoleta"){
	/////////////////////// CANCELAR COLETA -----------<<<
	
	
	
	
	/////////////////////// CANCELAR IMPRESSÃO ----------->>>
	if($acao == "cancelarimpressao"){
		$result = thomasWSimpressaoCancelar($processo_id,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$motivo_cancelamento);
		echo "<pre>"; print_r($result); echo "</pre>";
		if($result["codigo_retorno"] == "1"){ 
			$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Impressão foi cancelada com sucesso!'));	
		}else{//if($result["codigo_retorno"] == "1"){
			$cMSG->addMSG("ERRO","<b>".$class_fLNG->txt(__FILE__,__LINE__,'Erro ao cancelar impressão, verifique os dados e tente novamente mais tarde!')."</b><br>".thomasCodRetorno($result["codigo_retorno"]));				
		}//}else{//if($result["codigo_retorno"] == "1"){		
	}//if($acao == "cancelarimpressao"){
	/////////////////////// CANCELAR IMPRESSÃO -----------<<<							



}//fim if(isset($_GET["id_excluir"])){
//################################### AÇÕES NO PROCESSO ||||||||||||||||<





























//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo

if($tab_id == "1"){

	$SQL_campos = "C.id,C.nome,C.code,C.sobrenome"; //campos da tabela
	$SQL_tabela = "cad_candidato_fisico C"; //tabela
	$SQL_join = "";
	$SQL_where = "";//"origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'"; //condição
	$ORDEM_C = "C.nome";//campo de ordenar
	$ORDEM = "ASC";
	$SQL_group = ""; // agrupar o resultado GROUP BY	

}elseif($tab_id == "3"){//if($tab_id == "1"){
	$SQL_campos = "id,processo_id,acao,motivo,candidato_id,status,data_p,data_c,user,time,sync"; //campos da tabela
	$SQL_tabela = "axl_cancelamento_suspensao"; //tabela
	$SQL_join = "";
	$SQL_where = "";//"origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "sync";//campo de ordenar
	$ORDEM = "DESC";
	$SQL_group = ""; // agrupar o resultado GROUP BY	
}else{////}elseif($tab_id == "3"){//if($tab_id == "1"){
	
	$SQL_campos = "P.id,P.origem_id,P.code,P.tipo_servico,P.servico_id,P.triagem_id,P.coleta_id,P.candidato_fisico_id,P.candidato_juridico_id,P.validade_time,P.status,P.motivo_id,P.time,P.sync,C.nome,C.code as candidato_code,C.sobrenome"; //campos da tabela
	$SQL_tabela = "axl_processo P, cad_candidato_fisico C"; //tabela
	$SQL_join = "";
	$SQL_where = "P.candidato_fisico_id = C.id";//"origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "P.time";//campo de ordenar
	$ORDEM = "ASC";
	if($tab_id >= "1"){	$ORDEM = "DESC"; }
	$SQL_group = ""; // agrupar o resultado GROUP BY

}//}else//if($tab_id == "1"){
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao


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
	if(isset($_GET["doc_tipo_b"])){   					 $doc_tipo_b = getpost_sql($_GET["doc_tipo_b"]);   						  }else{ $doc_tipo_b = "";    	    }
	if(isset($_GET["datan_b"])){       					 $datan_b = getpost_sql($_GET["datan_b"]);       		     			  }else{ $datan_b = "";    		    }
	if(isset($_GET["doc_numero_b"])){       			 $doc_numero_b = getpost_sql($_GET["doc_numero_b"]);       		   		  }else{ $doc_numero_b = "";    		    }
	if(isset($_GET["rnt_b"])){       					 $rnt_b = getpost_sql($_GET["rnt_b"]);       		   			          }else{ $rnt_b = "";    		    }
	if(isset($_GET["rnc_b"])){       				 	 $rnc_b = getpost_sql($_GET["rnc_b"]);       		                      }else{ $rnc_b = "";    		}	




//verifica tab_id
	if($tab_id == "0"){//aguardando ação - com motivo de cancelamento
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " P.`motivo_id` >= '1' AND P.`status` <= 5"; //condição 
	}elseif($tab_id == "1"){//em coleta
		//if($SQL_where != ""){ $SQL_where .= " AND "; }
		//$SQL_where .= " "; //condição 
	}else{
		//if($SQL_where != ""){ $SQL_where .= " AND "; }
		//$SQL_where .= " `status` = '9' AND motivo_id <= '0' "; //condição 		
	}
//fim verifica tab_id



//verifica se recebeu uma solicitação de busca por rapida_b
if($doc_numero_b != ""){ $filtro_marca[] = $doc_numero_b; $filtro_marca[] = $datan_b;
		$filtro_b["doc_numero_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca por !!doc!! !!num!!',array("doc"=>'<b>'.$doc_tipo_b.'</b>',"num"=>'<b>'.$doc_numero_b.'</b>'));
		$filtro_b["datan_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento !!busca!!',array("busca"=>'<b>'.$datan_b.'</b>'));
		$campo = "rg";
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')){ $campo = "rg"; }
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')){ $campo = "passaporte"; }		
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')){ $campo = "id_estrangeiro"; }		
		
		if($tab_id == "3"){
			$linha = fSQL::SQL_SELECT_ONE("id","cad_candidato_fisico",$campo." = '".$doc_numero_b."' AND datan = '".data_mysql($datan_b)."'");
			if($linha["id"] >= "1"){
				if($SQL_where != ""){ $SQL_where .= " AND "; }
				$SQL_where .= " ( candidato_id = '".$linha["id"]."' ) "; //condição 		
			}//if($linha["id"] >= "1"){
		}else{//if($tab_id == "0"){
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( C.`".$campo."` = '$doc_numero_b' ) AND ( C.`datan` = '".data_mysql($datan_b)."' )"; //condição 		
		}//}else{//if($tab_id == "0"){		
		
		$AJAX_GET .= "doc_numero_b=$doc_numero_b&"; //incrementa variaveis para a paginacao AJAX
		$AJAX_GET .= "datan_b=$datan_b&"; //incrementa variaveis para a paginacao AJAX		
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por rapida_b
if($rnt_b != ""){ $filtro_marca[] = $rnt_b;
		$filtro_b["rnt_b"] = SYS_CONFIG_RM_SIGLA." <b>".$rnt_b."</b>";
		
		if($tab_id == "3"){
			$linha = fSQL::SQL_SELECT_ONE("id","cad_candidato_fisico","code = '".$rnt_b."'");
			if($linha["id"] >= "1"){
				if($SQL_where != ""){ $SQL_where .= " AND "; }
				$SQL_where .= " ( candidato_id = '".$linha["id"]."' ) "; //condição 			
			}//if($linha["id"] >= "1"){		
		}else{//if($tab_id == "0"){
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( C.`code` = '".$rnt_b."' ) "; //condição 
		}//}else{//if($tab_id == "0"){

		$AJAX_GET .= "rnt_b=$rnt_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b






//verifica se recebeu uma solicitação de busca por rapida_b
if($rnc_b != "" and $tab_id != "1"){ $filtro_marca[] = $rnc_b;
		$filtro_b["rnc_b"] = SYS_CONFIG_PROCESSO_SIGLA." <b>".$rnc_b."</b>";
		
		if($tab_id == "3"){
			$linha = fSQL::SQL_SELECT_ONE("id","axl_processo","code = '".$rnc_b."'");
			if($linha["id"] >= "1"){
				if($SQL_where != ""){ $SQL_where .= " AND "; }
				$SQL_where .= " ( processo_id = '".$linha["id"]."' ) "; //condição 			
			}//if($linha["id"] >= "1"){		
		}else{//if($tab_id == "0"){
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( P.`code` = '".$rnc_b."' ) "; //condição 
		}//}else{//if($tab_id == "0"){
			
		$AJAX_GET .= "rnc_b=$rnc_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b

?>
<script>
$(document).ready(function(e) {
	<?php if($tab_id == "1"){?>	$("#div_rnc_b").fadeOut(); <?php }else{?> $("#div_rnc_b").fadeIn(); <?php }//else{?>
});
</script> 
<?php


if($tab_id >= "1"){
	$valida = "0";
	
	if($filtro_b["doc_numero_b"] != "" and $filtro_b["datan_b"] != ""){ $valida = "1"; }
	if($filtro_b["rnc_b"] != ""){ $valida = "1"; }
	if($filtro_b["rnt_b"] != ""){ $valida = "1"; }
	
	//se não tiver filtro, adicionar só status 0
	if($tab_id == "3" and ceil(count($filtro_b)) <= "0"){ $SQL_where = "status = '0'"; $valida = "1"; }	
	
	if($valida == "0"){
		
		$msg = $class_fLNG->txt(__FILE__,__LINE__,'Para buscar é necessário utilizar algum filtro: <br>- Nº documento + data de nascimento <br>- !!rnt!!<br>- !!rnc!!',array("rnt"=>SYS_CONFIG_RM_SIGLA,"rnc"=>SYS_CONFIG_PROCESSO_SIGLA));
		
		if($tab_id == "1"){ 
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Para buscar é necessário utilizar algum filtro: <br>- Nº documento + data de nascimento <br>- !!rnt!!',array("rnt"=>SYS_CONFIG_RM_SIGLA));
			$SQL_where .= " AND C.id = '0'"; 
		}else{ $SQL_where .= " AND P.id = '0'"; }
		
?>
        <div class="alert alert-warning">
            <b><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></b><br><?=$msg?></b>
        </div>
<?php
		exit(0);	
	}//if(ceil(count($filtro_b)) <= "0"){
}//if($tab_id == "2"){





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
			$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", "$comeco,$max",$SQL_join);
			$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group",$SQL_join);
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
	//$('#contTitu<?=$INC_FAISHER["div"]?>').html(' (<?=$n_paginas?>)');
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
			<?php if($tab_id == "1"){?>


				<?php $c_or = "C.code"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=SYS_CONFIG_RM_SIGLA?></th>
				<?php $c_or = "C.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Info')?></th>            


			<?php }elseif($tab_id == "3"){//if($tab_id == "1"){?>   
           		<th><?=SYS_CONFIG_PROCESSO_SIGLA?></th>
                <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></th>
                <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo/Info')?></th> 
            
            
			<?php }else{//}elseif($tab_id == "3"){//if($tab_id == "1"){?>            


				<?php $c_or = "P.code"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=SYS_CONFIG_PROCESSO_SIGLA?></th>
				<?php $c_or = "P.tipo_servico"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo Serviço')?></th>
				<?php $c_or = "C.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitante')?></th>
				<?php $c_or = "P.status"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></th>


			<?php }//}else{//}elseif($tab_id == "3"){//if($tab_id == "1"){?>
            
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>
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
	if($tab_id == "1"){
		
		$id_a = $linha1["id"];
		$nome = $linha1["nome"];	
		$sobrenome = $linha1["sobrenome"];
		$code = $linha1["code"];
		
		$arrDoc = docPessoaFisica($id_a);
		
		$cont = fSQL::SQL_CONTAGEM("axl_processo","candidato_fisico_id = '".$id_a."'");
?>

										<tr>
											<td><b><?=$code?></b></td>
											<td><?=$nome?> <?=$sobrenome?><br><?=$arrDoc["nome"]?> <?=$arrDoc["numero"]?></td>
											<td><?=$cont?> <?=$class_fLNG->txt(__FILE__,__LINE__,'processo(s)')?></td>
											<td>
                                            	<a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO')?> #<?=$code?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesCandidato&id=<?=$id_a?>');return false;" class="btn btn-default btn-block" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a>
                                               
                                          </td>
										</tr>

<?php		

	}elseif($tab_id == "3"){//if($tab_id == "1"){
		$id_a = $linha1["id"];
		$motivo = $linha1["motivo"];	
		$processo_id = $linha1["processo_id"];		
		$acao = $linha1["acao"];		
		$candidato_id = $linha1["candidato_id"];		
		$status = $linha1["status"];		
		$sync = $linha1["sync"];	
		
		$linhaxxx = fSQL::SQL_SELECT_ONE("code","axl_processo","id = '".$processo_id."'");	
		$code = $linhaxxx["code"];
		
		$linhaxxx = fSQL::SQL_SELECT_ONE("nome,sobrenome,code","cad_candidato_fisico","id = '".$candidato_id."'");
		$nome = $linhaxxx["nome"];
		$sobrenome = $linhaxxx["sobrenome"];		
		$candidato_code = $linhaxxx["code"];	
		
		$arrDoc = docPessoaFisica($candidato_id);
		$status_leg = $class_fLNG->txt(__FILE__,__LINE__,'Aguardando análise');
		if($status == "1"){ $status_leg = $class_fLNG->txt(__FILE__,__LINE__,'Solicitação Aceita'); }
		if($status == "2"){ $status_leg = $class_fLNG->txt(__FILE__,__LINE__,'Solicitação Negada'); }		
?>
										<tr>
											<td><b><?=$code?></b></td>
											<td><?=$nome?> <?=$sobrenome?><br><?=$arrDoc["nome"]?> <?=$arrDoc["numero"]?></td>
											<td><?=sentenca(acaoProcessoLeg($acao))?><br><i><?=motivoCancelamento($motivo)?> (<?=$status_leg?>)</i></td>
											<td>
                                            	<a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DA SOLICITAÇÃO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesAcao&id=<?=$id_a?>');return false;" class="btn btn-default btn-block" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a>
                                               
                                            </td>
										</tr>
<?php		
	}else{//}elseif($tab_id == "3"){//if($tab_id == "1"){
		
		$id_a = $linha1["id"];
		$origem_id = $linha1["origem_id"];	
		$code = $linha1["code"];
		$tipo_servico = $linha1["tipo_servico"];
		$servico_id = $linha1["servico_id"];
		$triagem_id = $linha1["triagem_id"];
		$coleta_id = $linha1["coleta_id"];	
		$candidato_fisico_id = $linha1["candidato_fisico_id"];
		$candidato_juridico_id = $linha1["candidato_juridico_id"];
		$status = $linha1["status"];
		$validade_time = $linha1["validade_time"];
		$time = $linha1["time"];
		$motivo_id = $linha1["motivo_id"];	
		
		$solicitante_n = '<b>'.$linha1["nome"].' '.$linha1["sobrenome"].'</b> <a class="btn btn-default" onclick="pmodalHtml(\'<i class=icon-search></i> '.$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO').' #'.$linha1["candidato_code"].'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=detalhesCandidato&id='.$candidato_fisico_id.'\');return false;"><i class="icon-external-link"></i></a><br>'.SYS_CONFIG_RM_SIGLA.' '.$linha1["candidato_code"];				
		
		$linha = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id."'");
		$origem_id_n = $linha["nome"];
		//ações possíveis
		$button = "";
		
		//busca dados
		$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo", "id = '".$servico_id."'");	
		$servico_id_n = $linha2["nome"];
		
		$linha2 = fSQL::SQL_SELECT_ONE("senha","axl_triagem", "id = '".$triagem_id."'");	
		$senha_n = $linha2["senha"];	
	
		$tipo_servico_n = "<b>".$servico_id_n."</b>";
		$tipo_servico_n .= "<br><small><i class='".categoriaServicoIco($tipo_servico)."'> ".maiusculo(categoriaServicoLeg($tipo_servico))."</i></small>";
		
		$status_n = processoStatusLeg($status);
		
	

		
		//ver se tem problemas
		if($motivo_id >= "1"){
			$linha2 = fSQL::SQL_SELECT_ONE("etapa,descricao,time","axl_motivo_cancelamento","id = '$motivo_id'");
			if($linha2["etapa"] != ""){ 
				$status_n .= "<br><small style='color:red;'><i>".$class_fLNG->txt(__FILE__,__LINE__,'PROBLEMA').": ".legEtapaCancelamento($linha2["etapa"]);
				if($linha2["descricao"] != ""){ $status_n .= "<br>".$linha2["descricao"]; }
				$status_n .= "</i></small>";
				//$button = '<a href="#" class="btn btn-red btn-block" onclick="editarCandidato'.$INC_FAISHER["div"].'(\''.$candidato_fisico_id.'\');return false;"><i class="glyphicon-warning_sign"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Resolver').'</a>';
			}//if($linha2["descricao"] != ""){ 
		}//if($motivo_id >= "1"){
	
	
	

	
	
?>
										<tr>
											<td><b><?=$code?></b><br><i><?=$origem_id_n?></i></td>
											<td><?=$tipo_servico_n?></td>
											<td><?=$solicitante_n?></td>
											<td><?=$status_n?></td>
											<td>
                                            	<a href="#" onclick="detalhesProcesso<?=$INC_FAISHER["div"]?>('<?=$id_a?>','<?=$code?>','');return false;" class="btn btn-default btn-block" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a>
												<?=$button?>
                            
                                           
                                          </td>
										</tr>
<?php 

		}//if($tab_id == "0"){



}//fim do while de padinação SQL
	}//fim do if($n_paginas >= "1"){ de paginacao SQL

?>
									</tbody>
								</table>
<script>
function editarCandidato<?=$INC_FAISHER["div"]?>(v_id){
	pmodalHtml('<i class=icon-user></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'RESOLVER ATENDIMENTO')?> <?=maiusculo($tipo_pessoa_a_n)?>','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=registro&id_a='+v_id+'&POP=<?=fGERAL::cptoFaisher("atualizarLista".$INC_FAISHER["div"]."();", "enc")?>');	
}
function atualizarLista<?=$INC_FAISHER["div"]?>(v_acao,v_processo_id,v_motivo_cancelamento){
	v_get = "";
	if(v_acao != null){ v_get = "acao="+v_acao+"&processo_id="+v_processo_id; }
	if(v_motivo_cancelamento != null){ v_get = v_get+"&motivo_cancelamento="+v_motivo_cancelamento; }

	carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&tab_id=<?=$tab_id?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val()+'&'+v_get);
}//atualizarLista

function detalhesProcesso<?=$INC_FAISHER["div"]?>(v_id,v_code,v_get){
	if(v_get == null){ v_get = ""; }
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO')?> #'+v_code,'<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesProcesso&id='+v_id+'&'+v_get);return false;
}

function modalMotivo<?=$INC_FAISHER["div"]?>(v_acao,v_id,v_code){
	titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR AÇÃO/PROCESSO')?>";
	if(v_acao == "cancelarcoleta"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR COLETA')?>"; }
	if(v_acao == "cancelarimpressao"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR IMPRESSÃO')?>"; }	
	if(v_acao == "cancelarativo"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR PROCESSO ATIVO')?>"; }	
	if(v_acao == "1"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'SOLICITAR SUSPENSÃO DO PROCESSO')?>"; }	
	if(v_acao == "2"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'SOLICITAR CANCELAMENTO DO PROCESSO')?>"; }		
	//v_get = '&acao='+v_acao+'&processo_id='+v_id;
	//carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&tab_id=<?=$tab_id?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val()+'&'+v_get);
	pmodalHtml('<i class=glyphicon-ban></i> '+titulo+' #'+v_code,'<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=cancelarAcao&tab_id=<?=$tab_id?>&acao='+v_acao+'&processo_id='+v_id+'&processo_code='+v_code);	

}//modalMotivo

function imprimirCapaProcesso<?=$INC_FAISHER["div"]?>(v_code){
	faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=imprimirCapaProcesso&code='+v_code, 'get', 'ADD');
}//imprimirRecibo

function imprimirProcessoFull<?=$INC_FAISHER["div"]?>(v_code){
	faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=imprimirProcessoFull&code='+v_code, 'get', 'ADD');
}//imprimirRecibo

</script>                                
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
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad","0",$cVLogin->getVarLogin("SYS_USER_PERFIL_STATUS"))){ $pCadastro = "OFF"; }//loginAcesso
	
	//include de padrao
	$INC_VAR["tabSel"] = $tab_id;//adicionar array de guias [tab]
	$INC_VAR["tabs"][] = '0[,]<i class="icon-bolt"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Aguardando Ação').' <span id="cont-0'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '1[,]<i class="icon-user"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Prontuário Candidato').' <span id="cont-1'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '2[,]<i class="icon-search"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Consulta Processos').' <span id="cont-2'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO	
	$INC_VAR["tabs"][] = '3[,]<i class="glyphicon-ban"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Acompanhamento de Suspensão/Cancelamento').' <span id="cont-3'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO	
	$INC_VAR["buscaAvancada"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaRapida"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]	
	$INC_VAR["buscaDireta"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]	
	$INC_VAR["tituloListaFixo"] = "";
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>


