<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";

if($cVLogin->getVarLogin("SYS_USER_ID") == "1"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
}


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<























if($ajax == "consultarCandidato"){
	$array_temp = getpost_sql($_GET["array_temp"]);
	if(isset($_GET["doc_tipo"])){ $doc_tipo = getpost_sql($_GET["doc_tipo"]); }else{ $doc_tipo = ""; }
	if(isset($_GET["doc_numero"])){ $doc_numero = getpost_sql($_GET["doc_numero"]); }else{ $doc_numero = ""; }	
	if(isset($_GET["datan"])){ $datan = getpost_sql($_GET["datan"]); }else{ $datan = ""; }	

	$formCadastroPincipal = "formCadastroPincipal".$array_temp;	
	
if($doc_numero != ""){

?>
<form class='form-horizontal form-column form-bordered' onsubmit="return false;">
    <div class="col-md-12">
        <table class="table table-hover table-bordered" style="margin-top:0;">
            <thead>
                <tr>
                    <th><?=SYS_CONFIG_RM_SIGLA?></th>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></th>                
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>                
                </tr>
            </thead>
            <tbody>
<?php	
	$cont = "0";
	$condicao = "rg = '".$doc_numero."'";
	if($doc_tipo == "PASSAPORTE"){ $condicao = "passaporte = '".$doc_numero."'"; }
	if($doc_tipo == "ID ESTRANGEIRO"){ $condicao = "id_estrangeiro = '".$doc_numero."'"; }
	$condicao .= " AND datan = '".data_mysql($datan)."'";
	$resu = fSQL::SQL_SELECT_SIMPLES("id,code,nome,sobrenome","cad_candidato_fisico",$condicao);
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$id = $linha["id"];
		$code = $linha["code"];		
		$nome = $linha["nome"];
		$sobrenome = $linha["sobrenome"];
?>
                <tr>
                    <td><?=$code?></td>
                    <td><?=$nome?> <?=$sobrenome?><br><small><?=$doc_tipo?> <?=$doc_numero?></small></td>
                    <td><button type="button" class="btn btn-primary" onclick="$('#<?=$formCadastroPincipal?> #candidato_fisico_code_novo').val('<?=$code?>');pmodalDisplay('hide');return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar')?> <i class="icon-chevron-right"></i></button></td>
                </tr>
<?php		
	}//fim while
	if($cont == "0"){
?>
				<tr><td><div style="padding:20px;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Nenhum candidato localizado com este nº documento e data de nascimento.')?></div></td></tr>
<?php		
	}
?>
            </tbody>
        </table>
    </div>
 	 	<div class="form-actions">
        	<button type="button" class="btn btn-large btn-info" onclick="consultarCandidato<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tentar novamente')?></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>     
</form>    
<?php
	
}//if($doc_numero != ""){
?>




<?php 
if($doc_numero == ""){

    //id temp para registro de array
	$formSec = "formSec".time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");;	
		
/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";		
?>
<form id="<?=$formSec?>" class='form-horizontal form-column form-bordered' onsubmit="return false;">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo do documento')?></label>
            <div class="controls">
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo1" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')?>" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="doc_tipo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Identidade')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo2" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Passaporte')?></label>
                </div>
                <div class="check-line">
                    <input name="doc_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="doc_tipo3" value="<?=$class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')?>" data-skin="square" data-color="blue"> <label class='inline' for="doc_tipo3"><?=$class_fLNG->txt(__FILE__,__LINE__,'ID Estrangeiro')?></label>
                </div>                
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº do documento')?></label>
            <div class="controls">
            	<input type="text" class="input-medium cssFonteMai" id="doc_numero" name="doc_numero"/>
            </div>
        </div>        
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento')?></label>
            <div class="controls">
            	<input type="text" class="input-small mask_date" id="datan" name="datan"/>
            </div>
        </div>        
 	 	<div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="buscarCandidato<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Consultar Candidato')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadCandidato<?=$INC_FAISHER["div"]?>" /></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div> 

</form>
<?php }//if($doc_numero == ""){?>



<script>
function consultarCandidato<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTAR CANDIDATO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultarCandidato&array_temp=<?=$array_temp?>');	    
}
function buscarCandidato<?=$INC_FAISHER["div"]?>(){
	v_doc_tipo = $("#<?=$formSec?> input[name='doc_tipo']:checked").val();
	v_doc_numero = $("#<?=$formSec?> #doc_numero").val();
	v_datan = $("#<?=$formSec?> #datan").val();
	
	var valida = "";
	if(v_doc_numero == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar o nº do documento do candidato!')?>"; }
	if(v_datan == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar a data de nascimento do candidato!')?>"; }	
	
	if(valida != ""){ alert(valida); }else{
		faisher_ajax('pModalConteudoOn', 'loadCandidato<?=$INC_FAISHER["div"]?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=consultarCandidato&array_temp=<?=$array_temp?>&doc_tipo='+v_doc_tipo+'&doc_numero='+v_doc_numero+'&datan='+v_datan, 'get', 'ADD');		
	}
}//buscarCandidato
</script>    
<?php		
}//consultarCandidato


























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








































if($ajax == "imprimirRecibo"){
	$code = getpost_sql($_GET["code"]);

	$linha = fSQL::SQL_SELECT_ONE("id,candidato_fisico_id,tipo_servico,servico_id,status,pgto_id,time","axl_processo","code = '".$code."'");
	$processo_id = $linha["id"];
	$candidato_fisico_id = $linha["candidato_fisico_id"];
	$tipo_servico = $linha["tipo_servico"];	
	$status = $linha["status"];	
	$servico_id = $linha["servico_id"];
	$pgto_id = $linha["pgto_id"];
	$time = $linha["time"];	
	
	$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id."'");
	$servico_id_n = '<i class="'.categoriaServicoIco($tipo_servico).'"></i> '.$linha2["nome"];
	
	$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome","cad_candidato_fisico","id = '$candidato_fisico_id'");
	$arrDoc = docPessoaFisica($candidato_fisico_id);
	$pessoa_n = SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($candidato_fisico_id,$linha2["code"])." - <b>".$linha2["nome"]."</b>";

	$html_recibo .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" style="padding:5px;"><tr><td style="padding:5px; font-size:16px; border-bottom:#CCC 2px solid; font-weight:bold;">'.$class_fLNG->txt(__FILE__,__LINE__,'PROCESSO').' '.SYS_CONFIG_PROCESSO_SIGLA.' '.$code.'</td></tr></table>';
	$html_recibo .= '<table width="100%" border="0" cellspacing="0" cellpadding="1">';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Tipo de Processo').'</td><td width="65%" style="padding:5px;">'.$servico_id_n.'</td></tr>';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Data de criação').'</td><td width="65%" style="padding:5px;">'.date('d/m/Y H:i', $time).'h</td></tr>';
	$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Candidato').'</td><td width="65%" style="padding:5px;">'.$pessoa_n.'</td></tr>';

	
	$categorias = "";
	$resu = fSQL::SQL_SELECT_SIMPLES("nome,valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_campo = '99'");
	while($linha = fSQL::FETCH_ASSOC($resu)){
		if($categorias != ""){ $categorias .= ", "; }
		$categorias .= $linha["nome"];
	}//fim while
	if($categorias != ""){
		$html_recibo .= '<tr><td width="20%" style="color:#666; padding:5px;">'.$class_fLNG->txt(__FILE__,__LINE__,'Categorias').'</td><td width="65%" style="padding:5px;">'.$categorias.'</td></tr>';
	}//if($categorias != ""){
	
	$html_recibo .= '</table>';


?>	

<form id="FormReciboii" name="FormReciboii" method="post" class="hide" action="export.php" target="_blank">
  <input name="acao" id="acao" type="hidden" value="pdfhtml" />
  <input name="cabecalho" id="cabecalho" type="hidden" value="1" />  
  <input name="nome" id="nome" type="hidden" value="<?=SYS_CONFIG_PROCESSO_SIGLA?>-<?=$code?>" />
  <input name="titulo" id="titulo" type="hidden" value="<?=SYS_CONFIG_PROCESSO_SIGLA?> <?=$code?>" />
  <input name="html" id="html" type="hidden" value="<?=$html_recibo?>" />
</form>	
<script>
//prepara o envio do CSV
function exportarPDF(){
	$("#FormReciboii #html").val('<?=stripslashes($html_recibo)?>');
	$('#FormReciboii').submit();
}
$(document).ready(function(e) {
    exportarPDF();
});
</script>
<?php
}//imprimirRecibo
































































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

	if($coleta_id_a >= "1"){
		$linha = fSQL::SQL_SELECT_ONE("abis_status,abis_status_acao","axl_coleta_biometrica","id = '".$coleta_id_a."' AND origem_id = '".$origem_id_a."'");
		$coleta_abis_status = $linha["abis_status"];	
		$coleta_abis_status_acao = $linha["abis_status_acao"];		
	}//if($coleta_id_a >= "1"){
	
	$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome,datan,nacionalidade,grupo_sanguineo,sync","cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	$pessoa_n = "<span class='display-plus'>".$cVLogin->popDetalhes("C",$candidato_fisico_id_a,"3_con_candidatofisico","".$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO')).SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($candidato_fisico_id_a,$linha2["code"])." - <b>".$linha2["nome"]."</b><br>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>'."</span>";
	$pessoa_n .= $class_fLNG->txt(__FILE__,__LINE__,'Sobrenome').": <b>".$linha2["sobrenome"]."</b>";			
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento').": <b>".data_mysql($linha2["datan"]).", ".calcular_idade($linha2["datan"])." anos</b>";			
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nacionalidade').": <b>".maiusculo($linha2["nacionalidade"])."</b>";
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Grupo Sanguineo').": <b>".$linha2["grupo_sanguineo"]."</b>";						
	
	
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

	$log_n = "Processo iniciado em ".date("d/m/Y H:i",$time_a).", por ".$user_a;

	$coleta_n = "";	if($coleta_time_a >= "1"){ $coleta_n = date("d/m/Y H:i",$coleta_time_a); }
	$emissao_n = ""; if($emissao_time_a >= "1"){ $emissao_n = date("d/m/Y H:i",$emissao_time_a); }	
	$validade_n = ""; if($validade_time_a >= "1"){ $validade_n = $class_fLNG->txt(__FILE__,__LINE__,'Válido por !!anos!! anos, vence em:',array("anos"=>$validade_anos_a))." ".date("d/m/Y",$validade_time_a); }	
	$entrega_data_n = ""; if($entrega_data_a != "0000-00-00"){ $entrega_data_n = date("d/m/Y",strtotime($entrega_data_a)); }	
	
	//busca dados
	$motivo_id_n = "";
	if($motivo_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("descricao","axl_motivo_cancelamento", "id = '".$motivo_id_a."'");	
		$motivo_id_n = $linha2["descricao"];
	}//if($motivo_id_a >= "1"){

	$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$ano."/".completa_zero($mes,"2")."/".completa_zero($dia,"2")."/".$code."/files/";
	
	$arrColeta = array(); $coleta_dir = "";
	if($coleta_id_a >= "1"){
		$arrColeta = fSQL::SQL_SELECT_ONE("*","axl_coleta_biometrica","id = '".$coleta_id_a."'");
		$coleta_dir = VAR_DIR_FILES."files/tabelas/coleta/".$arrColeta["ano"]."/".completa_zero($arrColeta["mes"],"2")."/".completa_zero($arrColeta["dia"],"2")."/".$coleta_id_a."/";	
	}
	//echo $coleta_dir;
	
	$button = "";
	if($status_a == "1"){//COLETA BIOMETRICA++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
		//adicionar modal de motivo de cancelamento
		$button = '<a href="#" class="btn btn-red btn-large" onclick="modalMotivo'.$INC_FAISHER["div"].'(\'cancelarcoleta\',\''.$id_a.'\',\''.$code.'\');return false;"><i class="glyphicon-ban"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Cancelar Coleta').'</a>';
	}//COLETA BIOMETRICA++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
	
	if($status_a == "2" and $coleta_abis_status >= "2" and $coleta_abis_status_acao == "0"){//VERIFICAR STATUS ABIS
		$status_n .= "<br><small style='color:red;'><i>".$class_fLNG->txt(__FILE__,__LINE__,'PROBLEMA: ABIS')." - ".legABIS($coleta_abis_status)."</i><small>";	
		$button = '<a href="#" class="btn btn-warning btn-large" onclick="janelaAcao'.$INC_FAISHER["div"].'(\'registro\',\'id_a='.$id_a.'\');return false;"><i class="glyphicon-search"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Analisar ABIS').'</a>';
	}//if($status == "2"){

	if($status_a == "3"){//IMPRESSÃO ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
		//adicionar modal de motivo de cancelamento
		$button = '<a href="#" class="btn btn-red btn-large" onclick="modalMotivo'.$INC_FAISHER["div"].'(\'cancelarimpressao\',\''.$id_a.'\',\''.$code.'\');return false;"><i class="glyphicon-ban"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Cancelar Impressão').'</a>';
	}//COLETA BIOMETRICA++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>	
	
	
	if($status_a == "10"){//SUSPENSO +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
		//adicionar modal de motivo de cancelamento
		$button = '<a href="#" class="btn btn-blue btn-large" onclick="atualizarLista'.$INC_FAISHER["div"].'(\'ativar\',\''.$id_a.'\');return false;"><i class="glyphicon-ok_2"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Reativar Processo').'</a><a href="#" class="btn btn-red btn-large" onclick="modalMotivo'.$INC_FAISHER["div"].'(\'cancelarativo\',\''.$id_a.'\',\''.$code.'\');return false;"><i class="glyphicon-ban"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Cancelar Processo').'</a>';
	}////SUSPENSO +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>                         	
    
    
    
	if($status_a == "5"){//ATIVOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>
		//adicionar modal de motivo de cancelamento
		$button = '<a href="#" class="btn btn-warning btn-large" onclick="modalMotivo'.$INC_FAISHER["div"].'(\'suspender\',\''.$id_a.'\',\''.$code.'\');return false;"><i class="glyphicon-ban"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Suspender Processo').'</a><a href="#" class="btn btn-red btn-large" onclick="modalMotivo'.$INC_FAISHER["div"].'(\'cancelarativo\',\''.$id_a.'\',\''.$code.'\');return false;"><i class="glyphicon-ban"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Cancelar Processo').'</a>';
	}////ATIVOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ >>>                      	    
	
		
	
	
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
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Log')?></label>
                <div class="controls">
                  <?=$log_n?>
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
							$caminho_file = $processo_dir.$linha["valor"];
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
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
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
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->                                          
                            
<?php }//if($coleta_id_a >= "1"){?>                            
            <div class="form-actions">
            	<?=$button?>
            </div>                              
                            
</form>
<?php	
}//detalhesProcesso





//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//






if($ajax == "selServicos"){
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	
	//remove da lista
	$array = array();
	if((isset($_GET["del"])) and ($_GET["del"] != "")){
		$del = getpost_sql($_GET["del"]);
		$array = explode(",",$del);
	}//fim isset remove

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	$arr = categoriaServicoArr();
	foreach($arr as $servico){
		if(ceil(count($array)) >= "1"){ if(in_array($servico, $array)){ continue; } }
		//alimenta array de retorno
		$row_array['id'] = categoriaServicoIDSENHA($servico);
		$row_array['text'] = '<i class="'.categoriaServicoIco($servico).'"></i> <b>'.categoriaServicoLeg($servico)."</b>";		
		array_push($return_arr,$row_array);
	}

	
	
	
	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);

}//fim ajax lista ------------------------------------------------------------------------------------------ <<<	











































if($ajax == "selScanner"){
	$iframes = $_GET["iframes"];
	$iframes = explode(",",$iframes);
?>
	<table id="tabela_itens_opcoes<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Legenda')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'PC')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>                
			</tr>
		</thead>
        <tbody>
<?php	
	$cont = "0"; $pc = "";
	$resu = fSQL::SQL_SELECT_SIMPLES("pc,legenda","axl_dispositivo","origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."' AND tipo = '1' AND status = '1'");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$pc = $linha["pc"];
?>
			<tr>
            	<td><?=$linha["legenda"]?></td>
            	<td><?=$linha["pc"]?></td>                
                <td><button type="button" class="btn btn-primary" onclick="selecionarScanner('<?=$linha["pc"]?>');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar')?> <i class="icon-chevron-right"></i></button></td>
            </tr>
<?php		
	}//fim while

?>
        </tbody>
	</table>
<script>
$(document).ready(function(e) {
<?php if($cont == "1"){?>
	//selecionarScanner('<?=$pc?>');
	//pmodalDisplay('hide');
<?php }//if($cont == "1"){?>	
});

function selecionarScanner(v_pc){
	faisher_ajax('div_oculta', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=sessionScanner&pc='+v_pc, 'get', 'ADD');
<?php foreach($iframes as $iframe){?>	
	$('#<?=$iframe?>').attr('src', $('#<?=$iframe?>').attr('src'));
<?php }//foreach($iframes as $iframe){?>		
	pmodalDisplay('hide');
}//selecionarImp
</script>    
<?php	
}//if($ajax == "selScanner"){



if($ajax == "sessionScanner"){
	$pc = $_GET["pc"];
	$_SESSION["scanner_pc"] = $pc;
}//if($ajax == "selScanner"){

























if($ajax == "listaServicos"){
	$array_temp = $_GET["array_temp"];
	$id_a = $_GET["id_a"];
	$servico_id_a = $_GET["servico_id"];	
	$tipo_servico_a = $_GET["tipo_servico"];		
	$tipo_pessoa_a = $_GET["tipo_pessoa"];		
	if(isset($_GET["novo"])){ $novo = $_GET["novo"]; }else{ $novo = "0"; }
	if(isset($_GET["candidato_fisico_id"])){ $candidato_fisico_id_a = $_GET["candidato_fisico_id"]; }else{ $candidato_fisico_id_a = "0"; }	
	if(isset($_GET["candidato_juridico_id"])){ $candidato_juridico_id_a = $_GET["candidato_juridico_id"]; }else{ $candidato_juridico_id_a = "0"; }		
	if(isset($_GET["code"])){ $code_a = $_GET["code"]; }else{ $code_a = "0"; }		
	
	if($tipo_pessoa_a == "fisico"){ $tipo_pessoa_a = "F"; }else{ $tipo_pessoa_a = "J"; }
	$tipo_servico_a_n = categoriaServicoLeg($tipo_servico_a);
	
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;

	//visualização de processo ja existente
	$processo_id = ""; $processo_motivo_id = "0"; $candidato_fisico_id = "0"; $coleta_id = "0";
	if($code_a >= "1"){
		$linha = fSQL::SQL_SELECT_ONE("id,ano,mes,dia,servico_id,tipo_servico,candidato_fisico_id,motivo_id,coleta_id,status,suspensao_i,suspensao_f","axl_processo","code = '$code_a'");
		$processo_id = $linha["id"];
		$processo_ano = $linha["ano"];
		$processo_mes = $linha["mes"];
		$processo_dia = $linha["dia"];
		$servico_id_a = $linha["servico_id"];
		$tipo_servico_a = $linha["tipo_servico"];
		$coleta_id = $linha["coleta_id"];
		$novo = $linha["servico_id"];
		$processo_motivo_id = $linha["motivo_id"];
		$candidato_fisico_id = $linha["candidato_fisico_id"];
		$status = $linha["status"];
		$suspensao_i = $linha["suspensao_i"];
		$suspensao_f = $linha["suspensao_f"];
		$processo_caminho = VAR_DIR_FILES."files/tabelas/axl_processo/".$processo_ano."/".completa_zero($processo_mes,"2")."/".completa_zero($processo_dia,"2")."/".$code_a."/";
	}//if($code_a >= "1"){
	
	if(isset($_GET["msg"])){
		$cMSG->addMSG("ERRO",getpost_sql($_GET["msg"]));
		$cMSG->imprimirMSG();
	}//if(isset($_GET["msg"])){


/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";	
	
	
	//LISTAR SERVIÇOS ++++++++++++++++++++++++++++++++++++++++++++++++++++++
	if(($servico_id_a <= "0") and ($novo <= "0")){
?>		
        <ul class="tiles">
<?php 
$resu = fSQL::SQL_SELECT_SIMPLES("id,nome,desabilitar","adm_protocolo_tipo","tipo_servico = '$tipo_servico_a' AND servico_solicitante LIKE '%$tipo_pessoa_a%' AND status = '1'");
while($linha = fSQL::FETCH_ASSOC($resu)){
	$servico = $linha["id"];
	$nome = $linha["nome"];
	$desabilitar = $linha["desabilitar"];
?>
        	<li class="<?php if($desabilitar <= "0"){ echo 'blue'; }else{ echo 'lightgrey'; }?> long">
            	<a href="#" onclick='<?php if($desabilitar <= "0"){?>listaServicos<?=$INC_FAISHER["div"]?>("&novo=<?=$servico?>&candidato_fisico");return false;<?php }?>'><span><i class="icon-plus-sign"></i></span><span class="name"><b><?=$nome?></b></span></a>
            </li>
<?php
}//while($linha = fSQL::FETCH_ASSOC($resu)){

?>
        </ul> 		
<?php        
	}//if($servico_id_a <= "0" and $novo <= "0"){
		
		
		
		
		
		
		
		
	

	if($novo >= "1"){

		if($candidato_fisico_id_a >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("suspensao_i,suspensao_f","cad_candidato_fisico","id = '".$candidato_fisico_id_a."'");
			if($linha["suspensao_f"] > time()){
				$msg = $class_fLNG->txt(__FILE__,__LINE__,'Este candidato está suspenso até !!data!!',array("data"=>date("d/m/Y",$linha["suspensao_f"])));
				echo '<script>$(document).ready(function(){ listaServicos'.$INC_FAISHER["div"].'("&msg='.$msg.'"); return false;});</script>';
				exit(0);				
			}//if($linha["suspensao_f"] > time()){
		}//if($candidato_fisico_id_a >= "1"){
		
		//validar se usuário pode abrir processo
		if($candidato_fisico_id_a >= "1"){ $condicao = "candidato_fisico_id = '".$candidato_fisico_id_a."'"; }
		if($candidato_juridico_id_a >= "1"){ $condicao = "candidato_juridico_id = '".$candidato_juridico_id_a."'"; }
		if($processo_id >= "1"){ $condicao .= " AND id <> '".$processo_id."'"; }
		
		//ver tombamentos
		if($novo == "13"){
			$qtd = fSQL::SQL_CONTAGEM("axl_processo",$condicao." AND servico_id = '".$novo."'");
			if($qtd >= "1"){
				$msg = $class_fLNG->txt(__FILE__,__LINE__,'Este candidato já possui tombamento em processo/ativo. Verifique o histórico!');
				echo '<script>$(document).ready(function(){ listaServicos'.$INC_FAISHER["div"].'("&msg='.$msg.'"); return false;});</script>';
				exit(0);
			}//if($qtd_tombamento >= "1"){
			$qtd = fSQL::SQL_CONTAGEM("axl_processo",$condicao." AND (servico_id = '14' OR servico_id = '15')");
			if($qtd >= "1"){
				$msg = $class_fLNG->txt(__FILE__,__LINE__,'O candidato já possui habilitação ou está em processo. Verifique o histórico!');
				echo '<script>$(document).ready(function(){ listaServicos'.$INC_FAISHER["div"].'("&msg='.$msg.'"); return false;});</script>';
				exit(0);
			}//if($qtd_tombamento >= "1"){				
		}//if($novo == "13"){
			
		//ver nova habilitação
		if($novo == "14"){
			//se tiver habilitações ativas
			$qtd = fSQL::SQL_CONTAGEM("axl_processo",$condicao." AND servico_id = '13' AND status >= '0' AND status <= '5'");
			if($qtd >= "1"){
				$msg = $class_fLNG->txt(__FILE__,__LINE__,'O candidato já possui um tombamento em atendimento/ativo.<br>Verifique o histórico!');
				echo '<script>$(document).ready(function(){ listaServicos'.$INC_FAISHER["div"].'("&msg='.$msg.'"); return false;});</script>';
				exit(0);
			}//if($qtd_tombamento >= "1"){
			//se tiver habilitações ativas
			$qtd = fSQL::SQL_CONTAGEM("axl_processo",$condicao." AND (servico_id = '".$novo."' OR servico_id = '15') AND status >= '0' AND status <= '5'");
			if($qtd >= "1"){
				$msg = $class_fLNG->txt(__FILE__,__LINE__,'O candidato já possui uma habilitação em processo/ativa.<br>Verifique se é mudança/adição de categoria!');
				echo '<script>$(document).ready(function(){ listaServicos'.$INC_FAISHER["div"].'("&msg='.$msg.'"); return false;});</script>';
				exit(0);
			}//if($qtd_tombamento >= "1"){
			//se tiver processos suspensos
			$qtd = fSQL::SQL_CONTAGEM("axl_processo",$condicao." AND (servico_id = '".$novo."' OR servico_id = '13') AND status = '10'");
			if($qtd >= "1"){
				$msg = $class_fLNG->txt(__FILE__,__LINE__,'As permissões do candidato estão suspenas.<br>Verifique com auditores!');
				echo '<script>$(document).ready(function(){ listaServicos'.$INC_FAISHER["div"].'("&msg='.$msg.'"); return false;});</script>';
				exit(0);
			}//if($qtd_tombamento >= "1"){				
		}//if($novo == "13"){
			
			
		//ver 2º via - PID
		if($novo == "15" || $novo == "19"){
			//se tiver habilitações ativas
			$qtd = fSQL::SQL_CONTAGEM("axl_processo",$condicao." AND (servico_id = '14' OR servico_id = '13') AND status = '5'");
			if($qtd <= "0"){
				if($novo == "15"){ $msg = $class_fLNG->txt(__FILE__,__LINE__,'Para solicitar 2º via, o candidato deve possuir tombamento ou habilitação ativa!<br>No momento, o candidato não possui nenhuma das permissões citadas acima!'); }else{
					$msg = $class_fLNG->txt(__FILE__,__LINE__,'Para solicitar PID, deve possuir tombamento ou habilitação ativa!<br>No momento, o candidato não possui nenhuma das permissões citadas acima!');
				}
				echo '<script>$(document).ready(function(){ listaServicos'.$INC_FAISHER["div"].'("&msg='.$msg.'"); return false;});</script>';
				exit(0);
			}//if($qtd_tombamento >= "1"){
		}//if($novo == "15" || $novo == "19"){						
			

		if($processo_motivo_id >= "1"){
			$linhaxxx = fSQL::SQL_SELECT_ONE("etapa,motivo_codigo,descricao","axl_motivo_cancelamento","id = '".$processo_motivo_id."'");
?>
			<input type="hidden" id="motivo_id" name="motivo_id" value="<?=$processo_motivo_id?>"/>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Problema')?></label>
                <div class="controls">
                	<span style="color:red;"><?=legEtapaCancelamento($linhaxxx["etapa"])?></span>
                    <p><?=$linhaxxx["descricao"]?> <span id="span_resolverproblema<?=$INC_FAISHER["div"]?>"><?=$cVLogin->popDetalhes("V",$candidato_fisico_id,"3_con_candidatofisico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO'),"edit","Resolver",fGERAL::cptoFaisher("resolverProblema".$INC_FAISHER["div"]."('{ID}');", "enc"))?></span></p>
                </div>
            </div>
<script>
function resolverProblema<?=$INC_FAISHER["div"]?>(v_id){
	$("#<?=$formCadastroPincipal?> #motivo_id").val('0');
	$("#<?=$formCadastroPincipal?> #span_resolverproblema<?=$INC_FAISHER["div"]?>").fadeOut();
}//resolverProblema
</script>            
<?php			
		}//if($processo_motivo_id >= "1"){
		
		

		$linha = fSQL::SQL_SELECT_ONE("nome,informacoes","adm_protocolo_tipo","id = '$novo'");
		$nome_a = $linha["nome"];
		$informacoes_a = $linha["informacoes"];
?>
<script>
$(document).ready(function(e) {
	$("#<?=$formCadastroPincipal?> #servico_id").val('<?=$novo?>');
	$("#<?=$formCadastroPincipal?> #span_servico_n").html('<?=$nome_a?>');	
	$("#<?=$formCadastroPincipal?> #divspan_servico_n").fadeIn();	
    $("#<?=$formCadastroPincipal?> #btnSalvarProcesso<?=$INC_FAISHER["div"]?>").fadeIn();
});
</script>
<?php		

		//monta array
		$iframes = "";
		$array = explode(".",$informacoes_a);
		$cont_ARRAY = ceil(count($array));
		//listar item ja cadastrados
		if($cont_ARRAY >= "1"){
			foreach ($array as $pos => $valor){
				if($valor != ""){		
					$campos = "C.id,C.nome,C.tipo_campo,C.obrigatorio,C.opcoes,C.mascara";
					$arrInf = fSQL::SQL_SELECT_ONE($campos, "adm_protocolo_tipo_inf C", "C.id = '".$valor."'");
					$campo_id = $arrInf["id"];
					$nome = $arrInf["nome"];
					$tipo_campo = $arrInf["tipo_campo"];
					$obrigatorio = $arrInf["obrigatorio"];
					$opcoes = $arrInf["opcoes"];
					$mascara = $arrInf["mascara"];
					
					if($tipo_campo == "3"){//CAMPO DE TEXTO			
						$val = "";
						if($processo_id >= "1"){
							$linha1 = fSQL::SQL_SELECT_ONE("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$campo_id."' AND tipo_campo = '".$tipo_campo."'");
							$val = $linha1["valor"];
						}//if($processo_id >= "1"){
						//verifica se existe máscara de entrada
						if($mascara != ""){
?>
<script> $(document).ready(function(){ $("#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>").mask("<?=$mascara?>"); }); </script>
<?php
						}//if($mascara != ""){
						
?>
                        <div class="control-group">
                            <label class="control-label"><?=$nome?></label>
                            <div class="controls">
                                <input type="text" name="campo_tipo<?=$valor?>" id="campo_tipo<?=$valor?>" value="<?=$val?>" class="span9 cssFonteMai" <? if($obrigatorio != "0"){ echo 'data-rule-required="true"'; }?>>
                            </div>
                        </div>
<?php
					}//if($tipo_campo == "3"){//CAMPO DE TEXTO					
					
					if($tipo_campo == "99"){//CAMPO DE CATEGORIA
?>
					<div class="control-group">
						<label class="control-label"><?=$nome?></label>
						<div class="controls">
                        	<table class="table table-hover table-bordered">
                            	<thead>
                                    <tr>
                                    	<th></th>
                                    	<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Categoria')?></th>                                        
                                    	<?php if($novo == "13"){?><th><?=$class_fLNG->txt(__FILE__,__LINE__,'Data de Obtenção')?></th><?php }?>
                                    </tr>
                                </thead>
                                <tbody>
<?php
					//monta array de dados
					$arrayS = unserialize($opcoes);
					$cont_ARRAYS = ceil(count($arrayS));
					if($cont_ARRAYS >= "1"){
						foreach ($arrayS as $posS => $valorS){
							if($valorS != ""){
								if($novo == "14" and $i_cont >= "3"){ continue; }//nova habilitação
								$i_cont++;
								
								if($processo_id <= "0"){
?>

						<tr>
                        	<td><input name="campo_tipochk<?=$valor?>_<?=$valorS?>" type="checkbox" class='<?=$INC_FAISHER["div"]?>bp-icheck it_check_css<?=$valor?><?=$INC_FAISHER["div"]?>' id="campo_tipochk<?=$valor?>_<?=$valorS?>" value="<?=$valorS?>" data-skin="square" data-color="blue" <?php if($val != ""){ echo 'checked=checked'; }?>></td>
                            <td><b><?=$valorS?></b></td>
                            <?php if($novo == "13"){?><td>
                            	<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input type="text" id="campo_tipo<?=$valor?>_<?=$valorS?>" name="campo_tipo<?=$valor?>_<?=$valorS?>" class="mask_date" <?php if($val != ""){ echo 'value="'.$val.'"'; }else{ echo 'disabled'; }?>/></div>
                            </td><?php }?>
                        </tr>
<?php
								}else{//if($processo_id <= "0"){
									$val = "";
									$linha1 = fSQL::SQL_SELECT_ONE("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$campo_id."' AND tipo_campo = '".$tipo_campo."' AND nome = '".$valorS."'");
									$val = $linha1["valor"];
									if($processo_id >= "1" and $val == ""){ continue; }
									
?>
                        <tr>
                        	<td><i class="glyphicon-check"></i></td>
                        	<td><b><?=$valorS?></b></td>
                        </tr>
<?php									
								}//}else{//if($processo_id <= "0"){		
							}//if($valorS != ""){
						}//fim foreach
					}//fim if($cont_ARRAYS >= "1"){
	if($processo_id <= "0"){
?>		
<script>
$(document).ready(function(){
    $(".it_check_css<?=$valor?><?=$INC_FAISHER["div"]?>").on('change', function(e) {
		if($(this).prop("checked")){
			$("#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>_"+$(this).val()).prop("disabled",false);		
		}else{
			$("#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>_"+$(this).val()).val("");					
			$("#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>_"+$(this).val()).prop("disabled",true);					
		}
    });	
});
</script>
<?php
	}//if($processo_id <= "0"){
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
<?php            			
					}//if($tipo_campo == "99"){//CAMPO DE CATEGORIA					
					
					
					
					
					if($tipo_campo == "80"){ $i_cont = "0";//CAMPO DE RESTRIÇÕES
?>
                    <div class="control-group">
                        <label class="control-label"><?=$nome?></label>
                        <div class="controls">
							<input type="hidden" name="campo_tipo<?=$valor?>" id="campo_tipo<?=$valor?>" value="" class="cssFonteMai" style="width:98%"/>            

<script>
$(document).ready(function(e) {
	//dados de combobox
	$("#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>").select2({
		maximumSelectionSize: 10,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar restrições >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=selRestricao&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100,//, // page size
					del: $("#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>").val()
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
});	
</script>
                        </div>
                    </div>
<?php
					$val = "";
					if($processo_id >= "1"){
						$linha1 = fSQL::SQL_SELECT_ONE("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$campo_id."' AND tipo_campo = '".$tipo_campo."'");
						$str = arrayDB($linha1["valor"]);
						$array = explode(",",$str);
						foreach($array as $restricao){
							if($restricao != ""){
								if($val != ""){ $val .= ","; }
								$linha = fSQL::SQL_SELECT_ONE("legenda","axl_restricoes_medicas","id = '$restricao'");
								$val .= '{id: "'.$restricao.'", text: "'.$linha["legenda"].'"}';
							}//if($restricao != ""){
						}//fim foreach
						if($val != ""){ 
							$val = "[".$val."]";
?>
<script>
$(document).ready(function(e) {
	$("#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>").select2("data",<?=$val?>);
});
</script>
<?php
						}//if($val != ""){
					}//if($processo_id >= "1"){
						
						
					}//if($tipo_campo == "80"){//CAMPO DE RESTRIÇÕES						
					
					
					
					
					if($tipo_campo == "1"){//CAMPO DE OPÇÕES
?>
                    <div class="control-group">
                        <label class="control-label"><?=$nome?></label>
                        <div class="controls">

<?php

					$val = "";
					if($processo_id >= "1"){
						$linha1 = fSQL::SQL_SELECT_ONE("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$campo_id."' AND tipo_campo = '".$tipo_campo."'");
						$val = $linha1["valor"];
					}//if($processo_id >= "1"){	
					//monta array de dados
					//echo $opcoes;
					$arrayS = unserialize($opcoes);
					//echo "<pre>"; print_r($arrayS); echo "</pre>";
					$cont_ARRAYS = ceil(count($arrayS));
					if($cont_ARRAYS >= "1"){
						foreach ($arrayS as $posS => $valorS){
							if($valorS != ""){
								$i_cont++
?>
                        <div class="check-line">
                            <input type="radio" id="campo_tipo<?=$valor?>_<?=$i_cont?>" class='<?=$INC_FAISHER["div"]?>bp-icheck' name="campo_tipo<?=$valor?>" data-skin="square" data-color="blue" data-rule-required="true" value="<?=$valorS?>" <?php if($val == $valorS){ echo 'checked=checked'; }?>> <label class='inline' for="campo_tipo<?=$valor?>_<?=$i_cont?>"><?=$valorS?></label>
                        </div>  
<?php

							}//if($valorS != ""){
						}//fim foreach
					}//fim if($cont_ARRAYS >= "1"){

?>

                        </div>
                    </div>
<?php
					}//if($tipo_campo == "1"){//CAMPO DE OPÇÕES					
					
					if($tipo_campo == "9"){//CAMPO DE ARQUIVO



						$val = "";
						if($processo_id >= "1"){
							$linha1 = fSQL::SQL_SELECT_ONE("valor","axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$campo_id."' AND tipo_campo = '".$tipo_campo."'");
							$val = $linha1["valor"];
						}//if($processo_id >= "1"){						
						
						if($val != "" and file_exists($processo_caminho."files/".$val)){
?>
					<div class="control-group">
						<label class="control-label"><?=$nome?></label>
						<div class="controls">
                        	<input id="campo_tipo<?=$valor?>_1" name="campo_tipo<?=$valor?>_1" type="hidden" value="1" />
							<input id="tab_files_<?=$valor?>" name="tab_files_<?=$valor?>" type="hidden" value="1" />                                                
                        	<table class="table table-hover table-bordered">
                            	<thead>
                                    <tr>
                                    	<th><?=$class_fLNG->txt(__FILE__,__LINE__,'ICO')?></th>
                                    	<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Arquivo')?></th>                                        
                                    	<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ações')?></th>                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr>
                                    	<td><?=$cVLogin->icoFile($processo_caminho."files/".$val,"../");?></td>
                                        <td><?=$val?></td>
                                        <td><a href="export.php?a=viewPdf&caminho_file=<?=fGERAL::cptoFaisher($processo_caminho."files/".$val,"enc")?>" class="btn" target="_blank" style="margin-top:5px;"><i class="icon-search"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
<?php                   }else{//if($val !=""){?>
                    <div class="control-group">
                        <label class="control-label"><?=$nome?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadFScanner<?=$INC_FAISHER["div"]?>" /></label>
                        <div class="controls">
                        	<input id="campo_tipo<?=$valor?>_1" name="campo_tipo<?=$valor?>_1" type="hidden" value="0" />
                        	<input id="campo_tipo<?=$valor?>_2" name="campo_tipo<?=$valor?>_2" type="hidden" value="0" />                            
							<input id="tab_files_<?=$valor?>" name="tab_files_<?=$valor?>" type="hidden" value="1" />                        
                            <div class="tabs-container">
                                <ul class="tabs tabs-inline tabs-top">
                                    <li class='active'>
                                        <a href="#tb_file_fs<?=$INC_FAISHER["div"]?>_<?=$valor?>" data-toggle='tab' style="text-align:center;" onclick="$('#<?=$formCadastroPincipal?> #tab_files_<?=$valor?>').val('1');loadfScan<?=$INC_FAISHER["div"]?>_<?=$valor?>();"><div style="font-size:36px;"><i class="icon-print"></i></div> <?=$class_fLNG->txt(__FILE__,__LINE__,'Scanner')?></a>
                                    </li>
                                    <li>
                                        <a href="#tb_file_pc<?=$INC_FAISHER["div"]?>_<?=$valor?>" data-toggle='tab' style="text-align:center;" onclick="$('#<?=$formCadastroPincipal?> #tab_files_<?=$valor?>').val('2');loadfUpl<?=$INC_FAISHER["div"]?>_<?=$valor?>();"><div style="font-size:36px;"><i class="icon-laptop"></i></div> <?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar no Computador (pastas)')?></a>
                                    </li>
                                </ul>
                            </div>                            
                            <div class="tab-content padding tab-content-inline tab-content-bottom" >
                                <div class="tab-pane active" id="tb_file_fs<?=$INC_FAISHER["div"]?>_<?=$valor?>">                            
                                                        <span class="help-block"><i class="icon-info-sign"></i> <? if($obrigatorio != "0"){ echo '<b>*'.$class_fLNG->txt(__FILE__,__LINE__,'Obrigatório').'.</b> '; }?></span>
                                                        <?php
                                                        //montar IFRAME
                                                        $idTempSC = $array_temp;//id do retorno
                                                        $idIframeSC = "campo_tiposc".$valor.$array_temp;//id do iframe
                                                        $arqTipoSC = "todos";//tipos de arquivos
                                                        $n_arqQtdSC = "2";//quantidade de arquivos maximo
                                                        $descSC = "0";//ativar descicao, 1 ligado, 0 desligado
														$mostraSC = "1";
                                                        $funcaoSC = "contfUpl".$INC_FAISHER["div"]."campo_tipo".$valor;//executar funcao
                                                        $cVerificador = "campo_tipo".$valor."_2";													
														if($iframes != ""){ $iframes .= ","; } $iframes .= $idIframeSC; 														
                                                        ?>
                                                      <iframe name="<?=$idIframeSC?>" style="border:0; overflow:hidden;" src="geral/scanner_iframe.php?idTemp=<?=$idTempSC?>&idIframe=<?=$idIframeSC?>&arq=<?=$arqTipoSC?>&n_arq=<?=$n_arqQtdSC?>&desc=<?=$descSC?>&tm_w=<?=$tmWSC?>&tm_h=<?=$tmHSC?>&funcao=<?=$funcaoSC?>&cVerificador=<?=$cVerificador?>&X" frameborder="0"  scrolling="no"  id="<?=$idIframeSC?>" width="100%" height="100%"> </iframe>
<script>
function loadfScan<?=$INC_FAISHER["div"]?>_<?=$valor?>(){
	if($('#<?=$formCadastroPincipal?> #<?=$idIframeSC?>').attr('src') == "geral/scanner_iframe.php?idTemp=<?=$idTempSC?>&idIframe=<?=$idIframeSC?>&arq=<?=$arqTipoSC?>&n_arq=<?=$n_arqQtdSC?>&desc=<?=$descSC?>&tm_w=<?=$tmWSC?>&tm_h=<?=$tmHSC?>&funcao=<?=$funcaoSC?>&cVerificador=<?=$cVerificador?>&X"){
		$('#<?=$idIframeSC?>').attr('src', "");
		$('#<?=$idIframeSC?>').attr('src','geral/scanner_iframe.php?idTemp=<?=$idTempSC?>&idIframe=<?=$idIframeSC?>&arq=<?=$arqTipoSC?>&n_arq=<?=$n_arqQtdSC?>&desc=<?=$descSC?>&tm_w=<?=$tmWSC?>&tm_h=<?=$tmHSC?>&funcao=<?=$funcaoSC?>&cVerificador=<?=$cVerificador?>&X');
	}
}//loadfUpl
</script>
         
         
										</div>
										<div class="tab-pane" id="tb_file_pc<?=$INC_FAISHER["div"]?>_<?=$valor?>">                        
                                                        <span class="help-block"><i class="icon-info-sign"></i> <? if($obrigatorio != "0"){ echo '<b>*'.$class_fLNG->txt(__FILE__,__LINE__,'Obrigatório').'.</b> '; }?><?=$class_fLNG->txt(__FILE__,__LINE__,'Indicado o envio de arquivo no formato PDF, podendo conter páginas.')?></span>
                                                        <?php
                                                        //montar IFRAME
                                                        $idTemp = $array_temp;//id do retorno
                                                        $idIframe = "campo_tipo".$valor.$array_temp;//id do iframe
                                                        $arqTipo = "pdf";//tipos de arquivos
                                                        $n_arqQtd = "2";//quantidade de arquivos maximo
                                                        $desc = "0";//ativar descicao, 1 ligado, 0 desligado
                                                        $funcao = "contfUpl".$INC_FAISHER["div"]."campo_tipo".$valor;//executar funcao
														$cVerificador = "campo_tipo".$valor."_1";	
                                                        ?>
                                                      <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&tm_w=<?=$tmW?>&tm_h=<?=$tmH?>&funcao=<?=$funcao?>&cVerificador=<?=$cVerificador?>&X" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
<? if($obrigatorio != "0"){ $conta_campo_arquivo++; ?><input id="cont_upload_campo_tipo<?=$conta_campo_arquivo?>" name="cont_upload_campo_tipo<?=$conta_campo_arquivo?>" type="hidden" value="0" /><?php }?>
<script>
function contfUpl<?=$INC_FAISHER["div"]?>campo_tipo<?=$valor?>(cont){
	tab = $('#<?=$formCadastroPincipal?> #tab_files_<?=$valor?>').val();
	$('#<?=$formCadastroPincipal?> #campo_tipo<?=$valor?>_'+tab).val(cont);
	<? if($obrigatorio != "0"){ ?>$('#<?=$formCadastroPincipal?> #cont_upload_campo_tipo<?=$conta_campo_arquivo?>').val(cont);<?php }?>
	//verFiles<?=$INC_FAISHER["div"]?>_<?=$valor?>();
}//contfUpl
<? if($obrigatorio != "0"){ ?>$.doTimeout('vTimerFls<?=$INC_FAISHER["div"]?><?=$valor?>', 0, function(){ $("#<?=$formCadastroPincipal?> #arquivos_total").val(Number($("#<?=$formCadastroPincipal?> #arquivos_total").val())+1); });//TIMER<?php }?>

function loadfUpl<?=$INC_FAISHER["div"]?>_<?=$valor?>(){
	if($('#<?=$formCadastroPincipal?> #<?=$idIframe?>').attr('src') == "geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&tm_w=<?=$tmW?>&tm_h=<?=$tmH?>&funcao=<?=$funcao?>&cVerificador=<?=$cVerificador?>&X"){
		$('#<?=$idIframe?>').attr('src', "");
		$('#<?=$idIframe?>').attr('src', "geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&tm_w=<?=$tmW?>&tm_h=<?=$tmH?>&funcao=<?=$funcao?>&cVerificador=<?=$cVerificador?>&X");
	}
}//loadfUpl

</script>
										</div>
									</div>
                        </div>
                    </div>
<?php                    }//else{//if($val !=""){?>                                                        
<?php
					}//if($tipo_campo == "9"){//CAMPO DE ARQUIVO		
					
					
					
								

				}//if($valor != ""){
			}//foreach ($array as $pos => $valor){
?>
<script>
$(document).ready(function(e) {
<?php if((!isset($_SESSION["scanner_pc"])) and ($iframes != "")){?>
    pmodalHtml('<i class=glyphicon-print></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'SELECIONAR SCANNER')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=selScanner&iframes=<?=$iframes?>');	
<?php }//if(!isset($_SESSION["scanner_pc"])){?>	
});
</script>
<?php				
		}//if($cont_ARRAY >= "1"){
		
		//enviar para coleta automaticamente
		// somente tombamento e nova habilitação que possuem coleta
		if(($coleta_id <= "0") and (($novo == "13") || ($novo == "14"))){	
?>
					<div class="control-group">
						<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Coleta biométrica')?></label>
						<div class="controls">
                        	<div class="check-line">
                        		<input name="coleta_biometrica" type="checkbox" class='<?=$INC_FAISHER["div"]?>bp-icheck' id="coleta_biometrica" value="1" data-skin="square" data-color="blue">
                                <label class="inline" for="coleta_biometrica"><?=$class_fLNG->txt(__FILE__,__LINE__,'Enviar para coleta biométrica')?></label>
                            </div>
                            
                        </div>
                    </div>
<?php		
		}//if(($coleta_id <= "0") and (($novo == "13") || ($novo == "14")) ){
		
		
	}//if($novo >= "1"){
	
		
	
}//listServicos











if($ajax == "selGuiche"){
	$guiche = ""; if(isset($_SESSION["guiche"])){ $guiche = $_SESSION["guiche"]; }
	$servicos = ""; if(isset($_SESSION["servicos"])){ $servicos = $_SESSION["servicos"]; }	

	//alimenta combobox
	$sevicos_data = "";
	if($servicos != ""){
		$arrServ = categoriaServicoArrCompleto();
		$array = explode(",",$servicos);
		foreach($array as $servico){
			$arr = $arrServ[$servico];
			if($servicos_data != ""){ $servicos_data .= ","; }
			$servicos_data .= '{id: "'.$servico.'", text: "<i class='.$arr["ico"].'></i> '.$arr["leg"].'"}';
		}//fim foreach
	}//if($servicos_a != ""){	
	if($servicos_data != ""){ $servicos_data = "[".$servicos_data."]"; }

?>
<form class='form-horizontal form-column form-bordered' onsubmit="return false;">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Guichê/Mesa de atendimento')?></label>
            <div class="controls">
            	<input type="number" class="" id="guiche" value="<?=$guiche?>"/>
            </div>
        </div>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Serviços senha')?></label>
											<div class="controls select2-full">
                                            	<input type='hidden' value="" name='servicos' id='servicos' style="width:100%;"/>
<script type="text/javascript">
$(document).ready(function(){
	$('#servicos').select2({
		maximumSelectionSize: 5,multiple: true,
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar serviços')?>',
		ajax: {
			url: "<?=$AJAX_PAG?>?faisher=<?=$faisher?>&ajax=selServicos&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					del: $("#servicos").val()
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
	<?php if($servicos_data != ""){ ?>$("#servicos").select2("data", <?=$servicos_data?>);<?php }?>
});
</script>
											</div>
										</div>            
 	 	<div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="selecionarGuiche<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Informar guichê/mesa')?></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div> 

</form>
<script>
$(document).ready(function(e) {
<?php if($cont == "1"){?>
	selecionarImp<?=$INC_FAISHER["div"]?>('<?=$pc?>');
	pmodalDisplay('hide');
<?php }//if($cont == "1"){?>	
});

function selecionarGuiche<?=$INC_FAISHER["div"]?>(){
	v_guiche = $("#guiche").val();
	v_servicos = $("#servicos").val();
	
	valida = "";
	if(v_guiche == "0" || v_guiche == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Obrigatório informar o guichê.')?>"; }
	if(v_servicos == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar pelo menos um atendimento.')?>"; }

	if(valida != ""){ alert(valida); }else{
		loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
		faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&selguiche='+v_guiche+'&servicos='+v_servicos, 'get', 'ADD');		
		pmodalDisplay('hide');
		menuSenha<?=$INC_FAISHER["div"]?>();
	}
}//selecionarImp
</script>    
<?php	
		
}//if($ajax == "selImp"){














































if($ajax == "menuSenha"){
	$array_temp = getpost_sql($_GET["array_temp"]);
	
	$servicos = $_SESSION["servicos"];
	$num_guiche = $_SESSION["guiche"];

	if(isset($_GET["acao"])){ $acao = $_GET["acao"]; }else{ $acao = ""; }
	if(isset($_GET["acao_senha"])){ $acao_senha = $_GET["acao_senha"]; }else{ $acao_senha = ""; }	
	if(isset($_GET["acao_servico_id"])){ $acao_servico_id = $_GET["acao_servico_id"]; }else{ $acao_servico_id = ""; }		
	if(isset($_GET["acao_redirecionar_servico_id"])){ $acao_redirecionar_servico_id = $_GET["acao_redirecionar_servico_id"]; }else{ $acao_redirecionar_servico_id = ""; }		

	if($acao == "naocompareceu"){ fSENHA::acao($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$acao_servico_id,$acao_senha,"5"); }
	if($acao == "proximo"){ fSENHA::proximo($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$servicos,$num_guiche); }
	if($acao == "chamarnovamente"){ fSENHA::chamarNovamente($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$acao_servico_id,$acao_senha,$num_guiche); }
	if($acao == "redirecionar"){ fSENHA::acao($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$acao_servico_id,$acao_senha,"7",$acao_redirecionar_servico_id); }
	
	if($acao == "iniciar"){ fSENHA::iniciar($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$acao_servico_id,$acao_senha); }
	if($acao == "encerrar"){ fSENHA::encerrar($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$acao_servico_id,$acao_senha); }	
	
	$result = fSENHA::status($cVLogin->getVarLogin("SYS_USER_ID"),$servicos,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"));
	
	//echo "<pre>"; print_r($result); echo "</pre>";
	
	$senha = ""; $status = ""; $mostra_opcao = "0";
	//verificar se tem atendimento aberto
	if(isset($result["aberto"])){  $mostra_opcao = "1";
		$senha = $result["aberto_senha"]; 
		$status = $result["aberto_status"];
		if($result["aberto_prioridade"] != "1"){
			$senha = "P".soNumero($senha);
		}//if($result["aberto_prioridade"] != "1"){
	}//if(isset($result["aberto"])){ 
	

?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fila serviços')?></label>
                                            <div class="controls">
                                            	<ul class="stats">

<?php	
	$array = explode(",",$servicos);
	foreach($array as $servico_id){
		$fila = "0";
		if(isset($result["fila_".$servico_id])){ $fila = $result["fila_".$servico_id]; }else{  }
		if($fila >= "1"){ $mostra_opcao = "1"; }
?>
											
                                                    <li class="blue">
                                                        <i class="icon-reorder"></i>
                                                        <div class="details">
                                                            <span class="big"><?=$fila?></span>
                                                            <span><?=fSENHA::servicoTipoLeg($servico_id)?></span>
                                                        </div>
                                                    </li>

<?php		
	}
?>	
												</ul>
											</div>
										</div>
<?php 
	if($mostra_opcao >= "1"){

		if($senha == ""){
?>
                                        <div class="row-fluid">
                                        	<ul class="tiles"  style="display:flex; justify-content:center;">
                                                <li class="green long">
                                                    <a href="#" onclick="executarAcao<?=$INC_FAISHER["div"]?>('proximo');return false;"><span><i class="icon-bullhorn"></i></span><span class="name"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Chamar Próximo')?></b></span></a>
                                                </li>             
                                            </ul>                           
                                        </div>

<?php 	}else{//if($senha == ""){?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Atendimento atual')?></label>
                                            <div class="controls display-plus">
                                           		<?=$result["aberto_nome"]?>, <?=$senha?> - <?=fSENHA::servicoTipoLeg($result["aberto_servico_id"])?> (<?=legPrioridade($result["aberto_prioridade"])?>)
                                            </div>
                                        </div>
										<div class="row-fluid">                                                
                                        	<ul class="tiles" style="display:flex; justify-content:center;">
                                                <li class="red long">
                                                    <a href="#" onclick="executarAcao<?=$INC_FAISHER["div"]?>('erro');return false;"><span><i class="icon-warning-sign"></i></span><span class="name"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erro Triagem')?></b></span></a>
                                                </li>  
                                                <li class="orange long">
                                                    <a href="#" onclick="executarAcao<?=$INC_FAISHER["div"]?>('naocompareceu');return false;"><span><i class="icon-thumbs-down"></i></span><span class="name"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Não Compareceu')?></b></span></a>
                                                </li>                                                                                              
                                            
                                            
                                            
                                                                            
			<?php if($status == "2"){?>
                                                <li class="darkblue long">
                                                    <a href="#" onclick="executarAcao<?=$INC_FAISHER["div"]?>('chamarnovamente');return false;"><span><i class="icon-retweet"></i></span><span class="name"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Chamar Novamente')?></b></span></a>
                                                </li>  
                                                <li class="green long">
                                                    <a href="#" onclick="executarAcao<?=$INC_FAISHER["div"]?>('iniciar');return false;"><span><i class="icon-check"></i></span><span class="name"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Iniciar Atendimento')?></b></span></a>
                                                </li>      
			<?php }//if($status == "2"){?>    
    
    
    
    
    
    
			<?php if($status == "3"){?>
    			<?php if($result["aberto_servico_id"] != "5" and $result["aberto_servico_id"] != "4"){?>
                                                <li class="green long">
                                                    <a href="#" onclick="executarAcao<?=$INC_FAISHER["div"]?>('iniciar');return false;"><span><i class="icon-circle-arrow-right"></i></span><span class="name"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Continuar Atendimento')?></b></span></a>
                                                </li>  
    			<?php }//if($result["aberto_servico_id"] != "5"){?>                                                
                                                <li class="brown long">
                                                    <a href="#" onclick="executarAcao<?=$INC_FAISHER["div"]?>('encerrar');return false;"><span><i class="icon-check"></i></span><span class="name"><b><?=$class_fLNG->txt(__FILE__,__LINE__,'Encerrar Atendimento')?></b></span></a>
                                                </li>     
			<?php }//if($status == "3"){?>        
											</ul>
										 </div>

<?php 
		}//else{//if($senha == ""){

	}//if($mostra_opcao >= "1"){
?>
                                       
<script>
$(document).ready(function(e) {
<?php if(!isset($_SESSION["guiche"]) || (!isset($_SESSION["servicos"]))){?>
	selGuiche<?=$INC_FAISHER["div"]?>();
<?php }//if(!isset($_SESSION["guiche"])){?>	
	
	
<?php if($acao == "iniciar" and $result["aberto_servico_id"] != "5" and $result["aberto_servico_id"] != "4" and $result["aberto_servico_id"] != "6"){?>
	janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$acao_senha?>'); 
<?php }//if($acao == "iniciar" and $result["aberto_servico_id"] != "5" and $result["aberto_servico_id"] != "4"){?>


<?php if($acao == "iniciar" and ($result["aberto_servico_id"] == "5" or $result["aberto_servico_id"] != "4")){?>
	//abrir popup thomas
<?php }//if($acao == "iniciar" and ($result["aberto_servico_id"] == "5" or $result["aberto_servico_id"] != "4")){?>
});
function executarAcao<?=$INC_FAISHER["div"]?>(v_acao){
<?php if(!isset($_SESSION["guiche"])){?>
	selGuiche<?=$INC_FAISHER["div"]?>();
	return;
<?php }//if(!isset($_SESSION["guiche"])){?>		
	
	if(v_acao == "erro"){
		pmodalHtml("<i class=icon-exchange></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'ERRO TRIAGEM')?>",'<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=redirecionarSenha&acao_senha=<?=$senha?>&acao_servico_id=<?=$result["aberto_servico_id"]?>');	
	}else{//if(v_acao == "erro"){
		valida = 1;
		if (v_acao == 'encerrar' && !confirm("<?=$class_fLNG->txt(__FILE__,__LINE__,'Deseja realmente encerrar o atendimento?')?>")){ valida = 0; }
		if(valida >= 1){
			menuSenha<?=$INC_FAISHER["div"]?>('&acao='+v_acao+'&acao_senha=<?=$senha?>&acao_servico_id=<?=$result["aberto_servico_id"]?>');
		}
	}//}else{//if(v_acao == "erro"){
		
	/*
	if(v_acao == "iniciar"){ 
		if('<?=$result["aberto_servico_id"]?>' != "5" && '<?=$result["aberto_servico_id"]?>' != "4"){//diferente de coleta
			janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$senha?>'); 
		}else{
			//popup thomas
			menuSenha<?=$INC_FAISHER["div"]?>('&acao=popupThomas&acao_senha=<?=$senha?>&acao_servico_id=<?=$result["aberto_servico_id"]?>');
		}
	}else if(v_acao == "erro"){
		pmodalHtml('<i class=icon-exchange></i> ERRO TRIAGEM','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=erroTriagem&acao_senha=<?=$senha?>&acao_servico_id=<?=$result["aberto_servico_id"]?>');	
	}else{
		menuSenha<?=$INC_FAISHER["div"]?>('&acao='+v_acao+'&acao_senha=<?=$senha?>&acao_servico_id=<?=$result["aberto_servico_id"]?>');
	}
	*/
}//execuarAcao

function selGuiche<?=$INC_FAISHER["div"]?>(){
	pmodalHtml("<i class=glyphicon-print></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'SELECIONAR GUICHÊ/MESA')?>",'<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=selGuiche&');	    
}	

</script>
<?php                                        
	
}//if($ajax == "menuSenha"){





















if($ajax == "redirecionarSenha"){
	$acao_senha = $_GET["acao_senha"];
	$acao_servico_id = $_GET["acao_servico_id"];	
?>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Redirecionar para')?></label>
            <div class="controls">
                <select class="select2-me input-block-level" id="redirecionar_servico_id" name="redirecionar_servico_id" multiple="multiple">
<?php 
$array = categoriaServicoArr();
foreach($array as $servico){
	$servico_id = categoriaServicoIDSENHA($servico);
	if($acao_servico_id == $servico_id){ continue; }
?>
					<option value="<?=$servico_id?>"><?=categoriaServicoLeg($servico)?></option> 
<?php }//fim foreach ?>
                </select>
            </div>
        </div>
        
 	 	<div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="erroTriagem<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Redirecionar')?></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div> 
        
<script>
function erroTriagem<?=$INC_FAISHER["div"]?>(){
	v_redirecionar_servico_id = $("#redirecionar_servico_id").val();
	if(redirecionar_servico_id == ""){ alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar algum serviço para redirecionar!')?>'); }else{
		menuSenha<?=$INC_FAISHER["div"]?>('&acao=redirecionar&acao_senha=<?=$acao_senha?>&acao_servico_id=<?=$acao_servico_id?>&acao_redirecionar_servico_id='+v_redirecionar_servico_id);
	}
}//execuarAcao
</script>	
<?php
}//if($ajax == "erroTriagem"){











































//AJAX QUE EXIBE REGISTRO ------------------------------------------------------------------>>>
if($ajax == "registro"){
	$id_a = $_GET["id_a"];
	if($id_a == ""){ $id_a = "0"; }
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;
	//echo "<br>".$id_a;
	$condicao = "senha = '$id_a' AND status = '0'";
	if(strlen($id_a) == "13"){ $condicao = "origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."' AND backoffice = '".$id_a."'"; }

if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, "axl_triagem", $condicao);
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$pgto_num_a = $linha1["pgto_num"];
	$pgto_id_a = $linha1["pgto_id"];
	$code_a = $linha1["code"];
	$tipo_pessoa_a = $linha1["tipo_pessoa"];
	$tipo_servico_a = $linha1["tipo_servico"];
	$candidato_fisico_id_a = $linha1["candidato_fisico_id"];
	$candidato_juridico_id_a = $linha1["candidato_juridico_id"];	
	$nome_a = $linha1["nome"];		
	$senha_a = $linha1["senha"];		
	$senha_prioridade_a = $linha1["senha_prioridade"];			
	$backoffice_a = $linha1["backoffice"];				
	$status_a = $linha1["status"];			
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont++;
	}//fim while
	
	if($cont == "0"){
		echo "<script>$(document).ready(function(){ displayAcao".$INC_FAISHER["div"]."('fecha'); janelaAcao".$INC_FAISHER["div"]."('lista','msg=".$class_fLNG->txt(__FILE__,__LINE__,'Senha triagem não encontrada')."'); });</script>";
	}//if($cont == "0"){
	
	//fSENHA::iniciar($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),categoriaServicoIDSENHA($tipo_servico_a),$senha_a);

	if(isset($_GET["novoCandidato"])){
		$candidato_code = getpost_sql($_GET["novoCandidato"]);
		$linhaxxx = fSQL::SQL_SELECT_ONE("id","cad_candidato_fisico","code = '".$candidato_code."'");
		if($linhaxxx["id"] >= "1"){
			$candidato_fisico_id_a = $linhaxxx["id"];
					
			$linhaxxx = fSQL::SQL_SELECT_ONE("code","axl_processo","candidato_fisico_id = '".$candidato_fisico_id_a."' AND status <= '2' AND externo = '0'");
			if($linhaxxx["code"] != ""){
				$code_a = $linhaxxx["code"];
				
				$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'O candidato possui processo em aberto (!!sigla!! !!code!!)',array("sigla"=>SYS_CONFIG_RM_SIGLA,"code"=>$code_a)));
				$cMSG->imprimirMSG();//imprimir mensagens criadas
			}
			
			fSQL::SQL_UPDATE_SIMPLES("candidato_fisico_id,code","axl_triagem",array($candidato_fisico_id_a,$code_a),"id = '$id_a'");
		}else{//if($linhaxxx["id"] >= "1"){
			$cMSG->addMSG("ERRO",$class_fLNG->txt(__FILE__,__LINE__,'Nenhum candidato encontrado com este !!sigla!! !!code!!',array("sigla"=>SYS_CONFIG_RM_SIGLA,"code"=>$candidato_code)));
			$cMSG->imprimirMSG();//imprimir mensagens criadas
		}//}else{//if($linhaxxx["id"] >= "1"){
	}//if(isset($_GET["novoCandidato"])){
	
	
	$servico_id_a = "0";
	if(isset($_GET["servico_id"])){
		$servico_id_a = getpost_sql($_GET["servico_id"]);
	}
	

	$pessoa_n = ""; $pessoa_sync = "0";
	if($candidato_fisico_id_a <= "0"){ 
		$pessoa_n = str_replace("NOVO:","",$nome_a); 
		$pessoa_n = '<div class="alert alert-info"><i class="glyphicon-circle_info"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Atenção! Verfique se o(a) !!pessoa!! já possui cadastro ou cadastre agora!',array("pessoa"=>'<b>'.$pessoa_n.'</b>')).'</div>';
		$pessoa_n .= '<label class="control-label">'.$class_fLNG->txt(__FILE__,__LINE__,'Cadastro já existente').' ('.SYS_CONFIG_RM_SIGLA.')</label>';
		$pessoa_n .= '<div class="controls"><input type="text" name="candidato_fisico_code_novo" id="candidato_fisico_code_novo" value="" class="span6 cssFonteMai" /><button type="button" class="btn btn-blue" onclick="utilizarCadastro'.$INC_FAISHER["div"].'();return false;"><i class="glyphicon-ok_2"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Utilizar Cadastro').'</button>';
		$pessoa_n .= '<button type="button" class="btn btn-info" onclick="consultarCandidato'.$INC_FAISHER["div"].'();return false;"><i class="icon-search"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Consultar Candidato').'</button></div>';
		$pessoa_n .= '<label class="control-label">'.$class_fLNG->txt(__FILE__,__LINE__,'Novo').'</label><div class="controls"><span class="display-plus"> ('.$class_fLNG->txt(__FILE__,__LINE__,'sem cadastro').')<p class="help-block"><button type="button" class="btn btn-blue btn-large" onclick="popupCandidato'.$tipo_pessoa_a.$INC_FAISHER["div"].'();return false;"><i class="icon-plus-sign"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'CADASTRAR CANDIDATO').'</button></p></span></div>';
	}else{//if($nome_a != ""){ 
		if($tipo_pessoa_a == "fisico"){ 
			$arrDoc = docPessoaFisica($candidato_fisico_id_a);
			
			$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome,datan,nacionalidade,sync","cad_candidato_fisico","id = '$candidato_fisico_id_a'");
			
			$pessoa_n = "<span class='display-plus'>".$cVLogin->popDetalhes("N",$candidato_fisico_id_a,"3_con_candidatofisico","".$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO'), "edit").SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($candidato_fisico_id_a,$linha2["code"]).'<br><div style="clear:both; border-top:#E0E0E0 1px solid;"></div></span>';
			//$pessoa_n .= "<br>Nome: <b>".$linha2["nome"]."</b>";
			$pessoa_n .= $class_fLNG->txt(__FILE__,__LINE__,'Candidato').": <b>".$linha2["nome"]." ".$linha2["sobrenome"]."</b> (".$arrDoc["nome"]." ".$arrDoc["numero"].")";			
			$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento').": <b>".data_mysql($linha2["datan"]).", ".calcular_idade($linha2["datan"])." anos</b>";			
			$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nacionalidade').": <b>".maiusculo($linha2["nacionalidade"])."</b>";

			$pessoa_sync = $linha2["sync"];
		}else{ //if($tipo_pessoa_a == "fisico"){ 
		 	
		}//}else{ //if($tipo_pessoa_a == "fisico"){ 
	}//}else{//if($nome_a != ""){ 
		
	
	$pgto_id_n = "";
	if($pgto_id_a >= "1"){
		$linha2 = fSQL::SQL_SELECT_ONE("cod_banco,numero,valor,time_deposito","axl_pgto_banco","id = '$pgto_id_a'");
		$pgto_id_n = $class_fLNG->txt(__FILE__,__LINE__,'Banco').": ".legBanco($linha2["cod_banco"]);
		$pgto_id_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nº pagamento')." ".$linha2["numero"]." - GNF $ ".formataValor($linha2["valor"]);		
		$pgto_id_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'depósito realizado em !!data!!',array("data"=>date("d/m/Y H:i", $linha2["time_deposito"])));
	}//if($pgto_id_a >= "1"){


	if($tipo_pessoa_a == "fisico"){ $tipo_pessoa_a_n = $class_fLNG->txt(__FILE__,__LINE__,'Físico'); }
	if($tipo_pessoa_a == "juridico"){ $tipo_pessoa_a_n = $class_fLNG->txt(__FILE__,__LINE__,'Jurídico'); }	
	
	$triagem_n = "<div style='float:left;'><i style='font-size: 40px;' class='".categoriaServicoIco($tipo_servico_a)."'></i></div> ".maiusculo(categoriaServicoLeg($tipo_servico_a));
	if($code_a != ""){ $triagem_n .= " - ".SYS_CONFIG_PROCESSO_SIGLA." ".$code_a; }//if($code_a != ""){
	
	
	
	//HISTORICO DE PROCESSOS DA PESSOA
	$historico_n = ""; $processo_ativo_id = ""; $motivo_id = "";
	if($candidato_fisico_id_a >= "1"){
		$condicao = "candidato_fisico_id = '".$candidato_fisico_id_a."'";
		if($code_a != ""){ $condicao .= " AND code <> '".$code_a."'"; }//não buscar processo atual
		$resu = fSQL::SQL_SELECT_SIMPLES("id,code,tipo_servico,servico_id,status,validade_time,motivo_id,time","axl_processo",$condicao,"ORDER BY time DESC");
		while($linha = fSQL::FETCH_ASSOC($resu)){
			$code = $linha["code"];
			$motivo_id = $linha["motivo_id"];
			//se tiver processo de habilitação ativo
			if($processo_ativo_id == "" and (($linha["servico_id"] == "13") or ($linha["servico_id"] == "14") or $linha["servico_id"] == "15") and $linha["status"] == "5"){
				$processo_ativo_id = $linha["id"];
			}//if($processo_ativo_id == "" and (($linha["servico_id"] == "13") or ($linha["servico_id"] == "14") or $linha["servico_id"] == "15") and $linha["status"] == "5"){
	
			if($historico_n != ""){ $historico_n .= '<br><div style="clear:both; border-top:#E0E0E0 1px solid;"></div><Br>'; }		
			$historico_n .= processoDetalhesLeg($linha["id"], $INC_FAISHER["div"],$faisher).' <button type="button" class="btn" onclick="pmodalHtml(\'<i class=icon-search></i> '.$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO').' #'.$linha["code"].'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=detalhesProcesso&id='.$linha["id"].'\');return false;"><i class="icon-search"></i></button>';
		}//fim while	
	}
	
}//fim do if if($id_a != "0"){




?>

<script type="text/javascript">
<?php if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){ $('#<?=$formCadastroPincipal?> #div_idred<?=$INC_FAISHER["div"]?>').html('<b><?php if($id_a != ""){ echo $id_a; }else{ echo $class_fLNG->txt(__FILE__,__LINE__,'NOVO ATENDIMENTO');}?></b>'); });
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'NOVO ATENDIMENTO')?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'ATENDIMENTO')?> #<?=$senha_a?> - <?=legPrioridade($senha_prioridade_a)?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }?>
	
	});
<?php }//else{ //if(isset($_GET["POP"])){ ?>

function popupCandidato<?=$tipo_pessoa_a?><?=$INC_FAISHER["div"]?>(v_id){
	if(v_id == null){ 
		pmodalHtml('<i class=icon-user></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CADASTRAR NOVO CANDIDATO')?> <?=maiusculo($tipo_pessoa_a_n)?>','<?=$AJAX_PAG?>','get','faisher=3_con_candidato<?=$tipo_pessoa_a?>&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoCandidato".$INC_FAISHER["div"]."('{ID}','{CODE}');", "enc")?>');	
	}else{
		pmodalHtml('<i class=icon-user></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'EDITAR CANDIDATO')?> <?=maiusculo($tipo_pessoa_a_n)?>','<?=$AJAX_PAG?>','get','faisher=3_con_candidato<?=$tipo_pessoa_a?>&ajax=registro&id_a='+v_id+'&POP=<?=fGERAL::cptoFaisher("editarCandidato".$INC_FAISHER["div"]."('{ID}','{CODE}');", "enc")?>');	
	}
}
function addNovoCandidato<?=$INC_FAISHER["div"]?>(vid,v_code){
	$("#<?=$formCadastroPincipal?> #candidato_fisico_code_novo").val(v_code);
	$.doTimeout('vTimerUtilizarCadastro', 500, function(){ utilizarCadastro<?=$INC_FAISHER["div"]?>(); });//TIMER
	//janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$senha_a?>&novoCandidato='+vid);
}//addNovoContibuinte

function editarCandidato<?=$INC_FAISHER["div"]?>(vid,v_code){
	//janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$senha_a?>');
	$("#<?=$formCadastroPincipal?> #candidato_fisico_code_novo").val(v_code);
}//editarContibuinte

function enviarColeta<?=$INC_FAISHER["div"]?>(){
	if(confirm('<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma enviar processo nº !!num!! para coleta biométrica?',array("num"=>$code_a))?>')) { $("#<?=$formCadastroPincipal?>").submit(); }
}//editarContibuinte

function utilizarCadastro<?=$INC_FAISHER["div"]?>(){
	v_code = $("#<?=$formCadastroPincipal?> #candidato_fisico_code_novo").val();
	if(v_code == ""){ alert('<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o RNT de algum candidato!')?>'); }else{//if(v_id == ""){
		if(confirm('<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma utilização deste cadastro?')?>')) { janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$senha_a?>&novoCandidato='+v_code); }
	}//}else{//if(v_id == ""){
}//utilizarCadastro

function consultarCandidato<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTAR CANDIDATO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultarCandidato&array_temp=<?=$array_temp?>');	    
}

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
             <input name="code" type="hidden" id="code" value="<?=$code_a?>" />             
             <input name="senha" type="hidden" id="senha" value="<?=$senha_a?>" />             
             <!--<input name="processo_id" type="hidden" id="processo_id" value="<?=$processo_id?>" />-->
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <input name="tipo_servico" id="tipo_servico" type="hidden" value="<?=$tipo_servico_a?>" />               
             <input name="tipo_pessoa" id="tipo_pessoa" type="hidden" value="<?=$tipo_pessoa_a?>" />               
             <input name="pgto_id" id="pgto_id" type="hidden" value="<?=$pgto_id_a?>" />               
             <input name="candidato_fisico_id" id="candidato_fisico_id" type="hidden" value="<?=$candidato_fisico_id_a?>" />  
             <input name="candidato_juridico_id" id="candidato_juridico_id" type="hidden" value="<?=$candidato_juridico_id_a?>" />                            
             <input name="status" id="status" type="hidden" value="<?=$status_a?>" />                                         
             <input name="processo_ativo_id" id="processo_ativo_id" type="hidden" value="<?=$processo_ativo_id?>" />                                         
             <input name="backoffice" id="backoffice" type="hidden" value="<?=$backoffice_a?>" />                                         
             <input name="servico_id" id="servico_id" type="hidden" value="0" /> 
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgerais".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'INFORMAÇÕES DO ATENDIMENTO');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Atendimento')?></label>
											<div class="controls display-plus">
											  <?=$triagem_n?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label"><?=$tipo_pessoa_a_n?></label>
											<div class="controls">
											  <?=$pessoa_n?>
											</div>
										</div>
                                    <?php if($historico_n != ""){?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Histórico')?></label>
											<div class="controls">
											  <?=$historico_n?>
											</div>
										</div>                                    
                                    <?php }//if($pgto_id_n != ""){?>  

                                    <div class="control-group" style="display:none;padding:20px;" id="divspan_servico_n">
                                        <label class="control-label"></label>
                                        <div class="display-plus"><i class="icon-arrow-right"></i> <span id="span_servico_n"></span></div> 
                                    </div>                                     
									                                   
                                    
                                    <?php if($pgto_id_n != ""){?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Pagamento')?></label>
											<div class="controls">
											  <?=$pgto_id_n?>
											</div>
										</div>                                    
                                    <?php }//if($pgto_id_n != ""){?> 
                                    
                                                                      
                                    




<?php if($candidato_fisico_id_a >= "1" and $motivo_id <= "0"){?>
<script>
$.doTimeout('vTimerLoadServicos<?=$INC_FAISHER["div"]?>', 100, function(){ listaServicos<?=$INC_FAISHER["div"]?>("<?php if($code_a != ""){ echo '&code='.$code_a; }?>"); });//TIMER

function listaServicos<?=$INC_FAISHER["div"]?>(v_get){
<?php if($tipo_pessoa_a == "fisico"){ $get = "candidato_fisico_id=".$candidato_fisico_id_a; }else{ $get = "candidato_juridico_id=".$candidato_juridico_id_a; }?>
	loaderFoco('divlista_servicos<?=$INC_FAISHER["div"]?>','divlista_servicos<?=$INC_FAISHER["div"]?>load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Buscando dados...')?>');//cria um loader dinamico
	faisher_ajax('<?=$formCadastroPincipal?> #listaServicos<?=$INC_FAISHER["div"]?>', 'divlista_servicos<?=$INC_FAISHER["div"]?>load', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&formVisualizaPincipal=<?=$formCadastroPincipal?>&ajax=listaServicos&array_temp=<?=$array_temp?>&<?=$get?>&tipo_servico=<?=$tipo_servico_a?>&id_a=<?=$id_a?>&servico_id=<?=$servico_id_a?>&'+v_get, 'get', 'ADD');
}//listaServicos

<?php if($candidato_fisico_id_a <= "0" and $candidato_juridico_id_a <= "0"){?>
$(document).ready(function(e) {
    $("#<?=$formCadastroPincipal?> #divlista_servicos<?=$INC_FAISHER["div"]?>").hide();
});
<?php }//if($candidato_fisico_id_a <= "0" || $candidato_juridico_id_a <= "0"){?>

</script>



										<div class="control-group" id="divlista_servicos<?=$INC_FAISHER["div"]?>">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados')?></label>
											<div class="controls" id="listaServicos<?=$INC_FAISHER["div"]?>">
											</div>
										</div> 

<?php }//if($nome_a == ""){?>







                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            





  <div class="form-actions">
<?php if($candidato_fisico_id_a >= "1"){?>  
                                            <button type="submit" class="btn btn-large btn-primary" id="btnSalvarProcesso<?=$INC_FAISHER["div"]?>" style="display:none;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Salvar processo')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" /></button>
<?php }//if($candidato_fisico_id_a >= "1"){?>                                                                                
											<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="<?php if(isset($_GET["POP"])){ echo "pmodalDisplay('hide');"; }else{?>displayAcao<?=$INC_FAISHER["div"]?>('fecha');<?php }?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
										</div>
									</form>

                                    
</div>
<div id="divContent_oculto<?=$array_temp?>" style="display:none;"></div>                                   
<?php
if(isset($_GET["POP"])){ $loaderFoco = "1"; }else{ $loaderFoco = "0"; }
//VALIDA FORM AJAX
$AJAX_COD_INC = '
	if($("#'.$formCadastroPincipal.' #motivo_id").val() >= 1){  pmodalHtmlAlerta(" '.$class_fLNG->txt(__FILE__,__LINE__,'O problema do processo não foi resolvido, verifique!').'"); valedaform = "0"; }
	if($("#'.$formCadastroPincipal.'").validate().form() == false){ valedaform = "0"; }
	if(valedaform == "1"){
		loaderFoco("divContent_loader'.$array_temp.'","divContent_loader_load'.$array_temp.'"," '.$class_fLNG->txt(__FILE__,__LINE__,'já estamos salvando o registro...').'","'.$loaderFoco.'");//cria um loader dinamico
	}';

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
	
	if(isset($_GET["selguiche"])){
		$guiche = getpost_sql($_GET["selguiche"]);
		$servicos = getpost_sql($_GET["servicos"]);
		$_SESSION["guiche"] = $guiche;
		$_SESSION["servicos"] = $servicos;
		$resu = fSQL::SQL_SELECT_SIMPLES("pc,tipo","axl_dispositivo","guiche = '".$guiche."'");//selecionar impreessora
		while($linha = fSQL::FETCH_ASSOC($resu)){
			if($linha["tipo"] == "1"){ $_SESSION["impressora_pc"] = $linha["pc"]; }
			if($linha["tipo"] == "0"){ $_SESSION["scanner_pc"] = $linha["pc"]; }			
		}//fim while
	}//if($ajax == "selImpSESSION"){	
	
	if(isset($_GET["senha_b"])){      					 $senha_b = getpost_sql($_GET["senha_b"]);      		   			  }else{ $senha_b = "";   		    }	
	
	
	
	
	
	
	
	
	
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);	
	$senha_a = getpost_sql($_POST["senha"]);	
		
	
	//enviar processo para coleta
	$processo_id_a = "";
	/*
	if(isset($_POST["processo_id"])){ 
		$processo_id_a = $_POST["processo_id"];
		if($processo_id_a >= "1"){ 
			$result = thomasWSenviarColetaBiometrica($processo_id_a, $cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"), $cVLogin->getVarLogin("SYS_USER_ID"));
			if($result["codigo_retorno"] == "001"){ 
				$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Enviado para coleta biométrica'));	
				//criar evento
				fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização Coleta Biométrica'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para coleta biométrica'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_a,"");				
			}else{//if($result["codigo_retorno"] == "001"){
					$msg = thomasFiltrarErro($result["descricao_retorno"]);
					$valida = thomasCodRetorno($result["codigo_retorno"]).$msg;
				?>
				<script>
					//TIMER
					$.doTimeout('vTimerOPENList', 500, function(){
						exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erro ao enviar para a coleta biométrica!')?></b><br><?=$valida?>',60000);
						<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
						<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml'); ancoraHtml('#formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>');<?php }//fim else if(isset($_GET["POP"])){ ?>
					});//TIMER
				</script>
				<?php
				if(isset($_GET["POP"])){ exit(0); }			
			}//}else{//if($result["codigo_retorno"] == "001"){
		}
	}//if(isset($_GET["processo_id"])){	
	
	*/
	
	
	
	
	$validade_anos_a = "0";
	$validade_time_a = "0";
	if($processo_id_a == ""){ 
		
	
		$verifica_erro = "0"; //zera variavel de verificacao de erros
		//recebe vars - geral
		$code_a = getpost_sql($_POST["code"]);	
		$servico_id_a = getpost_sql($_POST["servico_id"]);		
		$tipo_servico_a = getpost_sql($_POST["tipo_servico"]);		
		$tipo_pessoa_a = getpost_sql($_POST["tipo_pessoa"]);		
		$pgto_num_a = getpost_sql($_POST["pgto_num"]);		
		$pgto_id_a = getpost_sql($_POST["pgto_id"]);				
		$candidato_fisico_id_a = getpost_sql($_POST["candidato_fisico_id"]);		
		$candidato_juridico_id_a = getpost_sql($_POST["candidato_juridico_id"]);		
		$status = getpost_sql($_POST["status"]);		
		$processo_ativo_id_a = getpost_sql($_POST["processo_ativo_id"]);				
		$backoffice_a = getpost_sql($_POST["backoffice"]);				
		
		if($code_a != ""){
			$linha = fSQL::SQL_SELECT_ONE("id","axl_processo","code = '".$code_a."'");
			$processo_id_a = $linha["id"];
		}
		//echo "<pre>"; print_r($_POST); echo "</pre>";
		
		$informacoes_i = "";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("informacoes", "adm_protocolo_tipo", "id = '$servico_id_a'", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$informacoes_i = arrayDB($linha1["informacoes"]);
		}//fim while
		if($informacoes_i != ""){
			//monta array
			unset($array); $array = explode(".",$informacoes_i);
			$cont_ARRAY = ceil(count($array));
			//listar item ja cadastrados
			if($cont_ARRAY >= "1"){
				foreach ($array as $pos => $valor){
					if($valor != ""){
						$campos = "C.id,C.tipo_campo,C.nome,C.obrigatorio,C.opcoes";
						$linha2 = fSQL::SQL_SELECT_ONE($campos, "adm_protocolo_tipo_inf C", "C.id = '".$valor."'");
						$tipo_id = $linha2["id"];
						$tipo_campo_numero = $linha2["tipo_campo"];
						$nome = $linha2["nome"];
						$obrigatorio = $linha2["obrigatorio"];
						$opcoes = $linha2["opcoes"];
						//verifica se já foi preenchido no processo - edição de processo
						$qtd = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id_a."' AND tipo_id = '".$tipo_id."'");
						if($qtd >= "1"){ continue; }
						
						//pega dados recebidos/monta array de dados
						$campo_tipo = getpost_sql($_POST["campo_tipo".$valor]);
						//se o tipo = 99 fazer loop nas opões e pegar os dados para alimentar o ARRAY_
						//monta array de dados
						if($tipo_campo_numero == "99"){
							$arrayS = unserialize($opcoes);
							$cont_ARRAYS = ceil(count($arrayS));
							if($cont_ARRAYS >= "1"){
								foreach ($arrayS as $posS => $valorS){
									if($valorS != ""){
										$i_cont++;
										if(isset($_POST["campo_tipochk".$valor."_".$valorS])){
											$val = getpost_sql($_POST["campo_tipo".$valor."_".$valorS]);
											//valida campo campo_tipo -- XXX
											if($val == "" and $servico_id_a == "13"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
												$verifica_erro .= $class_fLNG->txt(__FILE__,__LINE__,'- Categoria !!cat!!: data de obtenção não pode estar vazio, preencha corretamente!',array("cat"=>$valorS));//msg
											}else{//fim if valida campo										
												if($campo_tipo != ""){ $campo_tipo .= "[,]"; }
												$campo_tipo .= $valorS."[-]".$val;//categoria[-]data obtenção
												
												//ver data de validade do processo
												$linhaxxx = fSQL::SQL_SELECT_ONE("validade_anos","axl_habilitacao_categorias","categoria = '".$valorS."'");
												$anos = $linhaxxx["validade_anos"];							
												if($validade_anos_a > $anos || $validade_anos_a == "0"){ $validade_anos_a = $anos; }//pogar menor ano																	
											}//}else{//fim if valida campo	
										}//if(isset($_POST["campo_tipochk".$valor."_".$valorS])){
									}//if($valorS != ""){
								}//foreach ($arrayS as $posS => $valorS){
							}//if($cont_ARRAYS >= "1"){
						}//if($tipo_campo_numero == "99"){
						
						if($tipo_campo_numero == "9"){
								$tab = getpost_sql($_POST["tab_files_".$valor]);
								$campo_tipo = getpost_sql($_POST["campo_tipo".$valor."_".$tab]);
								//$verifica_erro .= "campo_tipo".$valor."_".$tab.":".$campo_tipo;
							if($campo_tipo >= "1"){
								unset($ARRAY_); $ARRAY_["array_temp"] = $array_temp; $ARRAY_["id"] = $valor; $ARRAY_["tipo_campo"] = $tipo_campo_numero; $ARRAY_["nome"] = $nome; $ARRAY_["tipo"] = $nome; $ARRAY_["tab"] = $tab;
								$ARRAY_COMPLEMENTAR_ARQUIVOS[] = $ARRAY_;							
							}//if($campo_tipo >= "1"){
						}else{//if($tipo_campo_numero == "9"){
							if($valor == "3"){ $tipo_coleta_a = $campo_tipo; }//coleta biométrica
							unset($ARRAY_); $ARRAY_["id"] = $valor; $ARRAY_["tipo_campo"] = $tipo_campo_numero; $ARRAY_["nome"] = $nome; $ARRAY_["valor"] = $campo_tipo;
							if($campo_tipo != ""){ $ARRAY_COMPLEMENTAR[] = $ARRAY_; }
						}//else{//if($tipo_campo_numero == "9"){
						if($obrigatorio != "0"){	
							if(($tipo_campo_numero == "9" || $tipo_campo_numero == "91") and ($campo_tipo == "0")){ $campo_tipo = ""; }
							//valida campo campo_tipo -- XXX
							if($campo_tipo == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
								$verifica_erro .= $class_fLNG->txt(__FILE__,__LINE__,'- Campo !!campo!! não pode estar vazio, preencha corretamente!',array("campo"=>$nome));//msg
							}//fim if valida campo
						}//if($obrigatorio != "0"){
					}//if($valor != ""){
				}//fim foreach
			}//fim if($cont_ARRAY >= "1"){
		}//if($informacoes_a != ""){	
		
		//echo "<pre>"; print_r($ARRAY_COMPLEMENTAR); echo "</pre>";
		//echo "<pre>"; print_r($ARRAY_COMPLEMENTAR_ARQUIVOS); echo "</pre>";	
		//echo "validade_anos_a:".$validade_anos_a;
		
		//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
		if($verifica_erro != "0"){//verifica se existe erro
			$verificaRegistro = "0";//reabre form
			?>
			<script>
				//TIMER
				$.doTimeout('vTimerOPENList', 500, function(){
					exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro',"<i class='icon-ban-circle'></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erros encontrados!')?></b><br><?=$verifica_erro?>",60000);
					<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
					<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml'); ancoraHtml('#formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>');<?php }//fim else if(isset($_GET["POP"])){ ?>
				});//TIMER
			</script>
			<?php
			if(isset($_GET["POP"])){ exit(0); }
		}else{//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
			$verificaRegistro = "1";
		}	
	}//if(!isset($_POST["processo_id"])){ 	
	
	

}//if(isset($_POST["id_a"])){
	
	

if($verificaRegistro >= "1"){
	
	
	
if($code_a == ""){
	$ano = date("Y");
	$mes = date("m");	
	$dia = date("d");	
	if($servico_id_a == "15"){ $code_a = fGERAL::codeRand(11, "15"); }else{ $code_a = fGERAL::codeRand(11); }
	
	$emissao_time_a = "0";
	$coleta_id_a = "0"; $coleta_time_a = "0";
	$emissao_time_a = "0";	
	$msg_ws = "";
	$arrEventos = array();
	//WS GRÁFICA ++++++++++++++++++++++++++++++++++++++++++++
	$status_a = "0"; $valida = "";
	$tipo_processo = processoTipoProcesso($servico_id_a);
	//echo "<br>tipo_processo:".$tipo_processo;
	if($tipo_processo != ""){
		//tipo de coleta 
		if($tipo_coleta_a == "PAPELETA"){ $tipo_coleta_a = "1"; }
		if($tipo_coleta_a == "DIGITAL"){ $tipo_coleta_a = "2"; }
		$tipo_coleta_a = "2";

		$campos = "code,nome,sobrenome,sexo,mae,pai,datan,nacionalidade,localn,grupo_sanguineo,codigo_energia,referencia";
		$linha2 = fSQL::SQL_SELECT_ONE($campos,"cad_candidato_fisico","id = '$candidato_fisico_id_a'");
		
		$arrDoc = docPessoaFisica($candidato_fisico_id_a);

		//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
		
		if((isset($_POST["coleta_biometrica"])) and ($servico_id_a == "13" || $servico_id_a == "14")){//tombamento - nova habilitação
			unset($arrDados); $arrDados = array();
			$arrDados["numero_rnt"] = $linha2["code"];
			$arrDados["numero_processo"] = $code_a;
			$arrDados["id_origem"] = (int)$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID");
			$arrDados["tipo_processo"] = (int)$tipo_processo;
			$arrDados["tipo_coleta"] = (int)$tipo_coleta_a;
			$arrDados["nome"] = $linha2["nome"];		
			$arrDados["sobrenome"] = $linha2["sobrenome"];		
			$arrDados["sexo"] = ($linha2["sexo"] == 2) ? 1 : 0;
			$arrDados["nome_mae"] = $linha2["mae"];				
			$arrDados["nome_pai"] = $linha2["pai"];				
			$arrDados["nacionalidade"] = $linha2["nacionalidade"];				
			$arrDados["local_nascimento"] = $linha2["localn"];						
			$arrDados["data_nascimento"] = $linha2["datan"];
			$arrDados["doc_tipo"] = (int)$arrDoc["doc"];				
			$arrDados["doc_numero"] = $arrDoc["numero"];						
			$arrDados["doc_data_emissao"] = $arrDoc["data_emissao"];						
			$arrDados["doc_pais"] = $arrDoc["pais"];			
			//echo "arrDados: <pre>"; print_r($arrDados); echo "</pre>";
			$result = thomasWS("gravarAutorizacaoColeta",WS_URL_BIOMETRIA,$arrDados);
			//echo "result: <pre>"; print_r($result); echo "</pre>";
			if(isset($result["codigo_retorno"])){
				if($result["codigo_retorno"] == "001"){ 
					$status_a = "1";
					$msg_ws = $class_fLNG->txt(__FILE__,__LINE__,'Enviado para coleta biométrica');
					//gerar senha para chamar
					$senha = fSENHA::gerarSenha($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$servico_id,$prioridade,$nome);
					//criar evento
					$array["evento"] = $class_fLNG->txt(__FILE__,__LINE__,'Autorização Coleta Biométrica');
					$array["descricao"] = $class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para coleta biométrica');
					$arrEventos[] = $array;
					
					$linhaxxx = fSQL::SQL_SELECT_ONE("email","cad_candidato_fisico_email","candidato_fisico_id = '".$candidato_fisico_id_a."'");
					//enviar email
					if($linhaxxx["email"] != ""){
						$email_a = $linhaxxx["email"];
			
						$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id_a."'");			
						
						$notificacao = "<span style='font-size:14px;'><b>";
						$notificacao .= $class_fLNG->txt(__FILE__,__LINE__,'Seu processo !!tipo!! #!!rnc!! foi autorizado para coleta biométrica!',array("tipo"=>$linhaxxx["nome"],"rnc"=>$code_a));
						$notificacao .= "</b></span>";
						
						$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
						//monta mensagem template
						$html_template = str_replace("!nome_fisico!",$linha2["nome"]." ".$linha2["sobrenome"],$html_template);
						$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);		
						$html_template = str_replace("!notificacao!",$notificacao,$html_template);
										
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
								'SEND_NOME' => primeiro_nome($linha2["nome"]),
								'SEND_EMAIL' => $email_a,
								'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, Processo Autorizado para Coleta Biométrica',array("nome"=>primeiro_nome($linha2["nome"]))),
								'SEND_BODY' => $html_template
								))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
						); $context = stream_context_create($opts);
						//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
						$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
						//file_put_contents(time()."_email.txt",$email_a."|".$contentResp);
					}//if($linhaxxx["email"] != ""){						
					
				}else{//if($result["codigo_retorno"] == "001"){

					$msg = thomasFiltrarErro($result["descricao_retorno"]);
					$valida = thomasCodRetorno($result["codigo_retorno"]).$msg;
				}//}else{//if($result["codigo_retorno"] == "001"){
			}else{//}//}else{//if($result["codigo_retorno"] == "001"){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível comunicar com o sistema biométrico.');
			}
		}//if($servico_id_a == "13" || $servico_id_a == "14"){//tombamente - nova habilitação
		
		
		if($servico_id_a == "15" || $servico_id_a == "19"){//2º via - PID
			$emissao_time_a = time();
			//dados processo
			$linha = fSQL::SQL_SELECT_ONE("code,coleta_id,coleta_time","axl_processo","id = '".$processo_ativo_id_a."'");//COLETA BIOMÉTRICA
			$processo_ativo_code_a = $linha["code"];
			$coleta_id_a = $linha["coleta_id"];	
			$coleta_time_a = $linha["coleta_time"];				

			
			$linha = fSQL::SQL_SELECT_ONE("grafica_id","axl_coleta_biometrica","id = '".$coleta_id_a."'");//COLETA BIOMÉTRICA
			$id_coleta = $linha["grafica_id"];	

			$categorias = ""; $restricoes = ""; $arrCategorias = array();
			$resu = fSQL::SQL_SELECT_SIMPLES("tipo_id,tipo_campo,nome,valor","axl_processo_campos","processo_id = '".$processo_ativo_id_a."'");
			while($linha = fSQL::FETCH_ASSOC($resu)){
				if($linha["tipo_campo"] == "99"){//CATEGORIAS
					$linhaxxx = fSQL::SQL_SELECT_ONE("data_obtencao","cad_candidato_fisico_habilitacao","candidato_fisico_id = '".$candidato_fisico_id_a."' AND categoria = '".$linha["nome"]."'");
					$data_obtencao = $linhaxxx["data_obtencao"];
					if(($data_obtencao == NULL) || ($data_obtencao == "") || ($data_obtencao == "0000-00-00")){ $data_obtencao = date("Y-m-d"); }
					$arrCategorias[] = array("categoria"=>$linha["nome"],"data_aquisicao"=>$data_obtencao);
				}//if($linha["tipo_campo"] == "99"){//CATEGORIAS
				
				if($linha["tipo_campo"] == "80"){//RESTRIÇÕES MÉDICAS
					if($restricoes != ""){ $restricoes .= ","; }
					$restricoes = $linha["valor"];
				}//if($linha["tipo_campo"] == "80"){//RESTRIÇÕES MÉDICAS
			}//fim while
			if($categorias != ""){ $categorias = "[".$categorias."]"; }			
			
			if($servico_id_a == "19"){//pid - validade de 1 ano
				$validade_anos_a = "1";
			}
			$validade_time_a = strtotime('+'.$validade_anos_a.' years', time());

			$linhaxxx = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id."'");
			$origem_descricao = $linhaxxx["nome"];
			
			$linhaxxx = fSQL::SQL_SELECT_ONE("pais,uf,cidade_id,bairro,quadra","cad_candidato_fisico_endereco","candidato_fisico_id = '".$candidato_fisico_id_a."'");
			$pais = $linhaxxx["pais"];
			$uf = $linhaxxx["uf"];			
			$cidade_id = $linhaxxx["cidade_id"];			
			$bairro = $linhaxxx["bairro"];			
			$quadra = $linhaxxx["quadra"];	
			
			$linhaxxx = fSQL::SQL_SELECT_ONE("cidade_nome","combo_cidades","id = '".$cidade_id."'");		
			$cidade_id_n = $linhaxxx["cidade_nome"];
			
			unset($arrDados); $arrDados = array();
			$arrDados["numero_rnt"] = $linha2["code"];
			$arrDados["numero_processo"] = $code_a;
			$arrDados["id_coleta"] = (int)$id_coleta;
			$arrDados["id_origem"] = (int)$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID");
			$arrDados["descricao_origem"] = $cVLogin->getVarLogin("SYS_USER_PERFIL_NOME");			
			$arrDados["tipo_processo"] = (int)$tipo_processo;
			$arrDados["nome"] = $linha2["nome"];		
			$arrDados["sobrenome"] = $linha2["sobrenome"];		
			$arrDados["sexo"] = ($linha2["sexo"] == 2) ? 1 : 0;;				
			$arrDados["nome_mae"] = $linha2["mae"];				
			$arrDados["nome_pai"] = $linha2["pai"];				
			$arrDados["nacionalidade"] = $linha2["nacionalidade"];				
			$arrDados["local_nascimento"] = $linha2["localn"];						
			$arrDados["data_nascimento"] = $linha2["datan"];
			$arrDados["doc_tipo"] = (int)$arrDoc["doc"];				
			$arrDados["doc_numero"] = $arrDoc["numero"];						
			$arrDados["doc_data_emissao"] = $arrDoc["data_emissao"];						
			$arrDados["doc_pais"] = $arrDoc["pais"];			
			$arrDados["tipo_sanguineo"] = $linha2["grupo_sanguineo"];
			$arrDados["data_emissao_habilitacao"] = date("Y-m-d",$emissao_time_a);
			$arrDados["data_validade_habilitacao"] = date("Y-m-d",$validade_time_a);
			$arrDados["uf_habilitacao"] = "GN";	
			$arrDados["pais"] = $pais;				
			$arrDados["estado"] = $uf;				
			$arrDados["cidade"] = $cidade_id_n;				
			$arrDados["setor"] = $bairro;				
			$arrDados["ponto_referencia"] = $linha2["referencia"];							
			$arrDados["codigo_energia"] = $linha2["codigo_energia"];							
			$arrDados["tipo_domicilio"] = $quadra;							
			$arrDados["categorias"] = $arrCategorias;
			$arrDados["restricoes"] = $restricoes;			
			//echo "arrDados: <pre>"; print_r($arrDados); echo "</pre>";
			$result = thomasWS("gravarAutorizacaoEmissaoDocumento",WS_URL_BIOMETRIA,$arrDados);
			//echo "result: <pre>"; print_r($result); echo "</pre>";
			if(isset($result["codigo_retorno"])){
				if($result["codigo_retorno"] == "001"){ 
					
					//atualizar data de aquisição das categorias
					foreach($arrCategorias as $array){
						$data_obtencao = $array["data_aquisicao"];
						if(($data_obtencao == date("Y-m-d"))){ 
							fSQL::SQL_UPDATE_SIMPLES("data_obtencao","cad_candidato_fisico_habilitacao",array(date("Y-m-d")),"candidato_fisico_id = '".$candidato_fisico_id_a."' AND categoria = '".$array["categoria"]."'");
						}
					}//foreach($arrCategorias as $array){					
					
					$msg_ws = $class_fLNG->txt(__FILE__,__LINE__,'Enviado para impressão!');
					$status_a = "3";
					//criar evento
					$array["evento"] = $class_fLNG->txt(__FILE__,__LINE__,'Autorização de Impressão');
					$array["descricao"] = $class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão');
					$arrEventos[] = $array;			
					
					$linhaxxx = fSQL::SQL_SELECT_ONE("email","cad_candidato_fisico_email","candidato_fisico_id = '".$candidato_fisico_id_a."'");
					//enviar email
					if($linhaxxx["email"] != ""){
						$email_a = $linhaxxx["email"];
			
						$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id_a."'");			
						
						$notificacao = "<span style='font-size:14px;'><b>";
						$notificacao .= $class_fLNG->txt(__FILE__,__LINE__,'Seu processo !!tipo!! #!!rnc!! foi autorizado para impressão!',array("tipo"=>$linhaxxx["nome"],"rnc"=>$code_a));
						$notificacao .= "</b></span>";
						
						$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
						//monta mensagem template
						$html_template = str_replace("!nome_fisico!",$linha2["nome"]." ".$linha2["sobrenome"],$html_template);
						$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);		
						$html_template = str_replace("!notificacao!",$notificacao,$html_template);
										
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
								'SEND_NOME' => primeiro_nome($linha2["nome"]),
								'SEND_EMAIL' => $email_a,
								'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, Processo Autorizado para Impressão',array("nome"=>primeiro_nome($linha2["nome"]))),
								'SEND_BODY' => $html_template
								))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
						); $context = stream_context_create($opts);
						//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
						$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
						//file_put_contents(time()."_email.txt",$email_a."|".$contentResp);
					}//if($linhaxxx["email"] != ""){						
							
				}else{//if($result["codigo_retorno"] == "001"){
					$msg = thomasFiltrarErro($result["descricao_retorno"]);
					$valida = thomasCodRetorno($result["codigo_retorno"]).$msg;
				}//}else{//if($result["codigo_retorno"] == "001"){
			}else{//}//}else{//if($result["codigo_retorno"] == "001"){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível comunicar com a gráfica.');
			}
		}//if($servico_id_a == "13" || $servico_id_a == "14"){//tombamente - nova habilitação		
	}//if($tipo_processo != ""){



	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($valida != ""){//verifica se existe erro
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erro ao se comunicar com o sistema integrado!')?> </b><br><?=$valida?>',60000);
				<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
				<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml'); ancoraHtml('#formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>');<?php }//fim else if(isset($_GET["POP"])){ ?>
			});//TIMER
		</script>
		<?php
		if(isset($_GET["POP"])){ exit(0); }
	}//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !



	if($valida == ""){ 
		
		//insere o registro na tabela do sistema
		//VARS insert simples SQL
		$tabela = "axl_processo";
		$campos = "origem_id,ano,mes,dia,code,tipo_servico,triagem_id,servico_id,candidato_fisico_id,candidato_juridico_id,coleta_id,coleta_time,emissao_time,status,validade_anos,validade_time,user,time,user_a,sync";
		$valores = array($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$ano,$mes,$dia,$code_a,$tipo_servico_a,$id_a,$servico_id_a,$candidato_fisico_id_a,$candidato_juridico_id_a,$coleta_id_a,$coleta_time_a,$emissao_time_a,$status_a,$validade_anos_a,$validade_time_a,$cVLogin->userReg(),time(),"0",time());
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		$processo_id_a = fSQL::SQL_INSERT_ID(); $campos .= ",id"; $valores[] = $processo_id_a;
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria	
		
		$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1			
		$processo_dir .= $ano."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1			
		$processo_dir .= $mes."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1						
		$processo_dir .= $dia."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1						
		$processo_dir .= $code_a."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1									
		
		$fileCaminho = $processo_dir."files/"; $cria = fGERAL::criaPasta($fileCaminho, "0775"); //confere a criação e retona 1		
				
		//campos
		$cont_ARRAY = ceil(count($ARRAY_COMPLEMENTAR));
		if($cont_ARRAY >= "1"){	
			foreach($ARRAY_COMPLEMENTAR as $array){
				if($array["tipo_campo"] == "99"){
					$arr = explode("[,]",$array["valor"]);
					foreach($arr as $valor){
						$val = explode("[-]",$valor);//categoria[-]data obtenção
						$linha = fSQL::SQL_SELECT_ONE("validade_anos","axl_habilitacao_categorias","categoria = '".$val["0"]."'");
						$anos = $linha["validade_anos"];			
						
						$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
						$valores = array($processo_id_a,$array["id"],$array["tipo_campo"],$val["0"],$anos,$cVLogin->userReg(),time());
						fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
						
						//adicionar data de obtenção da categoria do candidato
						$cont_ = fSQL::SQL_CONTAGEM("cad_candidato_fisico_habilitacao","candidato_fisico_id = '".$candidato_fisico_id_a."' AND categoria = '".$val["0"]."'");
						if($cont_ <= "0"){
							//echo "<br>categoria:".$val["0"]."|".data_mysql($val["1"]);
							$data_obtencao = data_mysql($val["1"]);
							if($val["1"] == ""){ $data_obtencao = date("Y-m-d"); }
							$campos = "candidato_fisico_id,categoria,data_obtencao,processo_id,time";
							$valores = array($candidato_fisico_id_a,$val["0"],$data_obtencao,$processo_id_a,time());
							fSQL::SQL_INSERT_SIMPLES($campos,"cad_candidato_fisico_habilitacao",$valores);
						}//if($cont_ <= "0"){
						
					}//fim foreach
				}else{//if($array["tipo_campo"] == "99"){
					$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
					$valores = array($processo_id_a,$array["id"],$array["tipo_campo"],$array["nome"],$array["valor"],$cVLogin->userReg(),time());
					fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
				}
			}//fim foerach	
		}//if($cont_ARRAY >= "1"){	
		//arquivos
		$cont_ARRAY = ceil(count($ARRAY_COMPLEMENTAR_ARQUIVOS));
		if($cont_ARRAY >= "1"){	
			foreach($ARRAY_COMPLEMENTAR_ARQUIVOS as $array){
				//$ARRAY_["array_temp"] = $array_temp; $ARRAY_["id"] = $valor; $ARRAY_["tipo_campo"] = $tipo_campo_numero; $ARRAY_["nome"] = $nome; $ARRAY_["tipo"] = $nome;
				
							
				
				//verifica se é enviar arquivo ------------------------------------------------------>
				//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
				
				$form = "campo_tipo".$array["id"].$array["array_temp"];
				//scanner
				if($array["tab"] == "1"){	$form = "campo_tiposc".$array["id"].$array["array_temp"]; }
				
				$cont_arquivo = "0";
				//verifica se existem arquivos temp no sistema
				$upload_dir_temp = VAR_DIR_FILES."files/temp/";
				$campos = "id,titulo,nome,arquivo";
				$tabela = "sys_arquivos_temp";
				$where = "acao = '".$array["array_temp"]."' AND form = '".$form."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
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
						
						$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
						$valores = array($processo_id_a,$array["id"],$array["tipo_campo"],$array["nome"],$arquivo_e,$cVLogin->userReg(),time());
						fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);					
						
						//move o arquivo para o novo local e exclue o temp
						rename($upload_dir_temp.$arquivo_e, $fileCaminho.$arquivo_e);
						fBKP::bkpFile($fileCaminho.$arquivo_e);//adiciona arquivo em lista de arquivo BACKUP
						//exclue o registro
						$tabela = "sys_arquivos_temp";
						fSQL::SQL_DELETE_SIMPLES($tabela, "id = '$id_e'");
					}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
				}//fim while
				//########################################### iFRAME TEMP ####################################<<<<<<<<<<<					
			}//fim foreach
		}//if($cont_ARRAY >= "1"){	
	

		if($servico_id_a == "15"){//2º via
			//cancelar processo ativo
			fSQL::SQL_UPDATE_SIMPLES("status,sync,obs_geral","axl_processo",array("6",time(),"Gerado 2º Via"),"id = '".$processo_ativo_id_a."'");		
			
			//pegar campos do processo ativo e replicar para o novo
			$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
			$resu = fSQL::SQL_SELECT_SIMPLES($campos,"axl_processo_campos","processo_id = '".$processo_ativo_id_a."'");
			while($linha = fSQL::FETCH_ASSOC($resu)){
				$valores = $linha;
				$valores["processo_id"] = $processo_id_a;
				$valores["time"] = time();
				$valores["user"] = $cVLogin->userReg();
				fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
			}//fim while

		}//if($servico_id_a == "15"){//2º via
	
	
		//ENCERRAR ATENDIMENTO SENHA
		$acao_redirecionar_servico_id = "";
		$acao_servico_id = categoriaServicoIDSENHA($tipo_servico_a);
		$msg = $class_fLNG->txt(__FILE__,__LINE__,'Atendimento encerrado.')."<br><br>".$msg_ws;	
		//redirecionar senha
		if($tipo_coleta_a == "2"){
			if((isset($_POST["coleta_biometrica"])) and ($servico_id_a == "13" || $servico_id_a == "14")){
				$acao_redirecionar_servico_id = categoriaServicoIDSENHA("coleta");				
				$msg .= " ".$class_fLNG->txt(__FILE__,__LINE__,'Redirecionado para coleta biométrica!');
				if($processo_ativo_code_a >= 1){
					$msg .= "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'Processo anterior (#!!num!!) cancelado com sucesso!',array("num"=>$processo_ativo_code_a))."<br><br>".$msg_ws;
				}//if($servico_id_a == "15"){
			}//if($servico_id_a != "15"){
		}//if($tipo_coleta_a == "2"){				
		
		
		fSENHA::encerrar($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$acao_servico_id,$senha_a,$acao_redirecionar_servico_id);

	
		//ATUALIZAR TRIAGEM PARA ATENDIDO
		fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_triagem",array("1",time()),"id = '$id_a'");
		if($pgto_id_a >= "1"){ fSQL::SQL_UPDATE_SIMPLES("processo_id,processo_code,sync","axl_pgto_banco",array($processo_id_a,$code_a,time()),"id = '$pgto_id_a'"); }
		
		//criar eventos do processo
		fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo Criado'),$class_fLNG->txt(__FILE__,__LINE__,'Processo criado na unidade'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_a,$processo_dir);														
		foreach($arrEventos as $array){
			if($array["evento"] != ""){
				fPROCESSO::criarEvento($array["evento"],$array["descricao"],$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_a,$processo_dir);
			}//if($array["evento"] != ""){
		}//foreach($arrEventos as $array){
		
		//GERA AÇÃO DO USUÁRIO NA TABELA
		$cVLogin->addAcaoUser("axl_processo", "adicionar", $processo_id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
		//GERA LOGS DE TABELAS
		if(isset($ARRAY_LOG)){//gerar log de auditoria	
			fGERAL::gravaLog("axl_processo",$processo_id_a,$ARRAY_LOG,$cVLogin->userReg());
		}//if(isset($ARRAY_LOG)){
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Processo cadastrado com sucesso!')." ".SYS_CONFIG_PROCESSO_SIGLA." ".$code_a."<br><br>".$msg);	
		$senha_b = "";
		
?>
<script>
$(document).ready(function(e) {
	$.doTimeout('vTimerSalvarPro<?=$INC_FAISHER["div"]?>', 1000, function(){
		if(confirm('<?=$class_fLNG->txt(__FILE__,__LINE__,'Gostaria imprimir recibo do processo')?> \'<?=$code_a?>\'?')) {
			imprimirRecibo<?=$INC_FAISHER["div"]?>("<?=$code_a?>");
		}
		
		imprimirProcessoFull<?=$INC_FAISHER["div"]?>("<?=$code_a?>");
	});
});
</script>
<?php			
	}//if($valida == ""){
	
}else{

	$status_a = "0"; $valida = ""; $emissao_time_a = "0";
	$tipo_coleta_a = "2"; $validade_time_a = "0";
	$arrEventos = array();
	
	//visualização de processo ja existente
	$processo_id_a = "";
	$linha = fSQL::SQL_SELECT_ONE("*","axl_processo","code = '$code_a'");
	$processo_id_a = $linha["id"];
	$ano = $linha["ano"];
	$mes = $linha["mes"];
	$dia = $linha["dia"];
	$origem_id_a = $linha["origem_id"];
	$servico_id_a = $linha["servico_id"];
	$tipo_servico_a = $linha["tipo_servico"];
	$tipo_pessoa_a = $linha["tipo_pessoa"];
	$pgto_id_a = $linha["pgto_id"];
	$motivo_id_a = $linha["motivo_id"];
	$coleta_id_a = $linha["coleta_id"];
	$coleta_time_a = $linha["coleta_time"];
	$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$ano."/".completa_zero($mes,"2")."/".completa_zero($dia,"2")."/".$code_a."/";
	$tipo_processo = processoTipoProcesso($servico_id_a);	
	//ver se é correção de problema
	$linhaxxx = fSQL::SQL_SELECT_ONE("etapa,motivo_codigo","axl_motivo_cancelamento","id = '".$motivo_id_a."'");
	$motivo_codigo = $linhaxxx["motivo_codigo"];
	$etapa = $linhaxxx["etapa"];

	$ws = "biometria";
	if($motivo_codigo == "2"){ $ws = "impressao"; }//autorizar impressão
	if($ws == "biometria" and !isset($_POST["coleta_biometrica"])){ $ws = ""; }
	//se já tiver autorizado emissão deve gerar novo code
	if($etapa >= "2"){
		if($servico_id_a == "15"){ $code_new = fGERAL::codeRand(11, "15"); }else{ $code_new = fGERAL::codeRand(11); }
	}//if($etapa >= "2"){

	//dados do candidato
	$campos = "code,nome,sobrenome,sexo,mae,pai,datan,nacionalidade,localn,grupo_sanguineo,referencia,codigo_energia";
	$arrCandidato = fSQL::SQL_SELECT_ONE($campos,"cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	$arrDoc = docPessoaFisica($candidato_fisico_id_a);

	
	if($ws == "biometria"){
		$coleta_id_a = "0"; $coleta_time_a = "0";
		
		unset($arrDados); $arrDados = array();
		$arrDados["numero_rnt"] = $arrCandidato["code"];
		$arrDados["numero_processo"] = ($etapa >= "2" ? $code_new : $code_a);
		$arrDados["id_origem"] = (int)$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID");
		$arrDados["tipo_processo"] = (int)$tipo_processo;
		$arrDados["tipo_coleta"] = (int)$tipo_coleta_a;
		$arrDados["nome"] = $arrCandidato["nome"];		
		$arrDados["sobrenome"] = $arrCandidato["sobrenome"];		
		$arrDados["sexo"] = ($arrCandidato["sexo"] == 2) ? 1 : 0;			
		$arrDados["nome_mae"] = $arrCandidato["mae"];				
		$arrDados["nome_pai"] = $arrCandidato["pai"];				
		$arrDados["nacionalidade"] = $arrCandidato["nacionalidade"];				
		$arrDados["local_nascimento"] = $arrCandidato["localn"];						
		$arrDados["data_nascimento"] = $arrCandidato["datan"];
		$arrDados["doc_tipo"] = (int)$arrDoc["doc"];				
		$arrDados["doc_numero"] = $arrDoc["numero"];						
		$arrDados["doc_data_emissao"] = $arrDoc["data_emissao"];						
		$arrDados["doc_pais"] = $arrDoc["pais"];			
		//echo "arrDados: <pre>"; print_r($arrDados); echo "</pre>";
		$result = thomasWS("gravarAutorizacaoColeta",WS_URL_BIOMETRIA,$arrDados);
		//echo "result: <pre>"; print_r($result); echo "</pre>";
		if(isset($result["codigo_retorno"])){
			if($result["codigo_retorno"] == "001"){ 
				$msg_ws = $class_fLNG->txt(__FILE__,__LINE__,'Enviado para coleta biométrica');
				$status_a = "1";
				//criar evento
				$array["evento"] = $class_fLNG->txt(__FILE__,__LINE__,'Enviado para coleta biométrica');
				$array["descricao"] = $class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para coleta biométrica');
				$arrEventos[] = $array;						
				
				
				$linhaxxx = fSQL::SQL_SELECT_ONE("email","cad_candidato_fisico_email","candidato_fisico_id = '".$candidato_fisico_id_a."'");
				//enviar email
				if($linhaxxx["email"] != ""){
					$email_a = $linhaxxx["email"];
		
					$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id_a."'");			
					
					$notificacao = "<span style='font-size:14px;'><b>";
					$notificacao .= $class_fLNG->txt(__FILE__,__LINE__,'Seu processo !!tipo!! #!!rnc!! foi autorizado para impressão!',array("tipo"=>$linhaxxx["nome"],"rnc"=>($etapa >= "2" ? $code_new : $code_a)));
					$notificacao .= "</b></span>";
					
					$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
					//monta mensagem template
					$html_template = str_replace("!nome_fisico!",$arrCandidato["nome"]." ".$arrCandidato["sobrenome"],$html_template);
					$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);		
					$html_template = str_replace("!notificacao!",$notificacao,$html_template);
									
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
							'SEND_NOME' => primeiro_nome($arrCandidato["nome"]),
							'SEND_EMAIL' => $email_a,
							'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, Processo Autorizado para Coleta Biométrica',array("nome"=>primeiro_nome($arrCandidato["nome"]))),
							'SEND_BODY' => $html_template
							))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
					); $context = stream_context_create($opts);
					//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
					$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
					//file_put_contents(time()."_email.txt",$email_a."|".$contentResp);
				}//if($linhaxxx["email"] != ""){				
				
			}else{//if($result["codigo_retorno"] == "001"){
				$msg = thomasFiltrarErro($result["descricao_retorno"]);
				$valida = thomasCodRetorno($result["codigo_retorno"]).$msg;
			}//}else{//if($result["codigo_retorno"] == "001"){
		}else{//}//}else{//if($result["codigo_retorno"] == "001"){
			$valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível comunicar com o sistema biométrico.');
		}
	}//if($ws == "biometria"){


	if($ws == "impressao"){//2º via - PID
		$emissao_time_a = time();
		
		$linha = fSQL::SQL_SELECT_ONE("grafica_id","axl_coleta_biometrica","id = '".$coleta_id_a."'");//COLETA BIOMÉTRICA
		$id_coleta = $linha["grafica_id"];	

		$categorias = ""; $restricoes = ""; $arrCategorias = array();
		$resu = fSQL::SQL_SELECT_SIMPLES("tipo_id,tipo_campo,nome,valor","axl_processo_campos","processo_id = '".$processo_id_a."'");
		while($linha = fSQL::FETCH_ASSOC($resu)){
			if($linha["tipo_campo"] == "99"){//CATEGORIAS
				$linhaxxx = fSQL::SQL_SELECT_ONE("data_obtencao","cad_candidato_fisico_habilitacao","candidato_fisico_id = '".$candidato_fisico_id_a."' AND categoria = '".$linha["nome"]."'");
				$data_obtencao = $linhaxxx["data_obtencao"];
				if(($data_obtencao == NULL) || ($data_obtencao == "") || ($data_obtencao == "0000-00-00")){ $data_obtencao = date("Y-m-d"); }
				$arrCategorias[] = array("categoria"=>$linha["nome"],"data_aquisicao"=>$data_obtencao);
			}//if($linha["tipo_campo"] == "99"){//CATEGORIAS
			
			if($linha["tipo_campo"] == "80"){//RESTRIÇÕES MÉDICAS
				if($restricoes != ""){ $restricoes .= ","; }
				$restricoes = $linha["valor"];
			}//if($linha["tipo_campo"] == "80"){//RESTRIÇÕES MÉDICAS
		}//fim while
		
		if($servico_id_a == "19"){//pid - validade de 1 ano
			$validade_anos_a = "1";
		}
		$validade_time_a = strtotime('+'.$validade_anos_a.' years', time());
		
		$linhaxxx = fSQL::SQL_SELECT_ONE("pais,uf,cidade_id,bairro,quadra","cad_candidato_fisico_endereco","candidato_fisico_id = '".$candidato_fisico_id_a."'");
		$pais = $linhaxxx["pais"];
		$uf = $linhaxxx["uf"];			
		$cidade_id = $linhaxxx["cidade_id"];			
		$bairro = $linhaxxx["bairro"];			
		$quadra = $linhaxxx["quadra"];	
		
		$linhaxxx = fSQL::SQL_SELECT_ONE("cidade_nome","combo_cidades","id = '".$cidade_id."'");		
		$cidade_id_n = $linhaxxx["cidade_nome"];		
		
		unset($arrDados); $arrDados = array();
		$arrDados["numero_rnt"] = $arrCandidato["code"];
		$arrDados["numero_processo"] = ($etapa >= "2" ? $code_new : $code_a);
		$arrDados["id_coleta"] = (int)$id_coleta;
		$arrDados["id_origem"] = (int)$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID");
		$arrDados["descricao_origem"] = $cVLogin->getVarLogin("SYS_USER_PERFIL_NOME");			
		$arrDados["tipo_processo"] = (int)$tipo_processo;
		$arrDados["nome"] = $arrCandidato["nome"];		
		$arrDados["sobrenome"] = $arrCandidato["sobrenome"];		
		$arrDados["sexo"] = ($arrCandidato["sexo"] == 2) ? 1 : 0;			
		$arrDados["nome_mae"] = $arrCandidato["mae"];				
		$arrDados["nome_pai"] = $arrCandidato["pai"];				
		$arrDados["nacionalidade"] = $arrCandidato["nacionalidade"];				
		$arrDados["local_nascimento"] = $arrCandidato["localn"];						
		$arrDados["data_nascimento"] = $arrCandidato["datan"];
		$arrDados["doc_tipo"] = (int)$arrDoc["doc"];				
		$arrDados["doc_numero"] = $arrDoc["numero"];						
		$arrDados["doc_data_emissao"] = $arrDoc["data_emissao"];						
		$arrDados["doc_pais"] = $arrDoc["pais"];			
		$arrDados["tipo_sanguineo"] = $linha2["grupo_sanguineo"];
		$arrDados["data_emissao_habilitacao"] = date("Y-m-d",$emissao_time_a);
		$arrDados["data_validade_habilitacao"] = date("Y-m-d",$validade_time_a);
		$arrDados["uf_habilitacao"] = "GN";	
		$arrDados["pais"] = $pais;				
		$arrDados["estado"] = $uf;				
		$arrDados["cidade"] = $cidade_id_n;				
		$arrDados["setor"] = $bairro;				
		$arrDados["ponto_referencia"] = $arrCandidato["referencia"];							
		$arrDados["codigo_energia"] = $arrCandidato["codigo_energia"];							
		$arrDados["tipo_domicilio"] = $quadra;	
		$arrDados["categorias"] = $arrCategorias;
		$arrDados["restricoes"] = $restricoes;			
		//echo "arrDados: <pre>"; print_r($arrDados); echo "</pre>";
		$result = thomasWS("gravarAutorizacaoEmissaoDocumento",WS_URL_BIOMETRIA,$arrDados);
		//echo "result: <pre>"; print_r($result); echo "</pre>";
		if(isset($result["codigo_retorno"])){
			if($result["codigo_retorno"] == "001"){ 
				
				//atualizar data de aquisição das categorias
				foreach($arrCategorias as $array){
					$data_obtencao = $array["data_aquisicao"];
					if(($data_obtencao == date("Y-m-d"))){ 
						fSQL::SQL_UPDATE_SIMPLES("data_obtencao","cad_candidato_fisico_habilitacao",array(date("Y-m-d")),"candidato_fisico_id = '".$candidato_fisico_id_a."' AND categoria = '".$array["categoria"]."'");
					}
				}//foreach($arrCategorias as $array){				
				
				
				$msg_ws = $class_fLNG->txt(__FILE__,__LINE__,'Enviado para impressão!');
				$status_a = "3";//em impressão
				
				//criar evento
				$array["evento"] = $class_fLNG->txt(__FILE__,__LINE__,'Autorização para Impressão');
				$array["descricao"] = $class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão');
				$arrEventos[] = $array;						
				
				$linhaxxx = fSQL::SQL_SELECT_ONE("email","cad_candidato_fisico_email","candidato_fisico_id = '".$candidato_fisico_id_a."'");
				//enviar email
				if($linhaxxx["email"] != ""){
					$email_a = $linhaxxx["email"];
		
					$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id_a."'");			
					
					$notificacao = "<span style='font-size:14px;'><b>";
					$notificacao .= $class_fLNG->txt(__FILE__,__LINE__,'Seu processo !!tipo!! #!!rnc!! foi autorizado para impressão!',array("tipo"=>$linhaxxx["nome"],"rnc"=>$code_a));
					$notificacao .= "</b></span>";
					
					$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
					//monta mensagem template
					$html_template = str_replace("!nome_fisico!",$arrCandidato["nome"]." ".$arrCandidato["sobrenome"],$html_template);
					$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);		
					$html_template = str_replace("!notificacao!",$notificacao,$html_template);
									
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
							'SEND_NOME' => primeiro_nome($arrCandidato["nome"]),
							'SEND_EMAIL' => $email_a,
							'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'!!nome!!, Processo Autorizado para Impressão',array("nome"=>primeiro_nome($arrCandidato["nome"]))),
							'SEND_BODY' => $html_template
							))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
					); $context = stream_context_create($opts);
					//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
					$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);
					//file_put_contents(time()."_email.txt",$email_a."|".$contentResp);
				}//if($linhaxxx["email"] != ""){				
				
			}else{//if($result["codigo_retorno"] == "001"){
				$msg = thomasFiltrarErro($result["descricao_retorno"]);
				$valida = thomasCodRetorno($result["codigo_retorno"]).$msg;
			}//}else{//if($result["codigo_retorno"] == "001"){
		}else{//}//}else{//if($result["codigo_retorno"] == "001"){
			$valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível comunicar com a gráfica.');
		}
	}//if($ws == "impressao"){	


	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($valida != ""){//verifica se existe erro
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erro ao se comunicar com o sistema integrado!')?></b><br><?=$valida?>',60000);
				<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
				<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml'); ancoraHtml('#formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>');<?php }//fim else if(isset($_GET["POP"])){ ?>
			});//TIMER
		</script>
		<?php
		if(isset($_GET["POP"])){ exit(0); }
	}//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !

	$cMSG->imprimirMSG();//imprimir mensagens criadas		
	
	if($valida == ""){
		
		if($etapa >= "2"){//criar novo processos
			//cancelar processo atual
			fSQL::SQL_UPDATE_SIMPLES("status,user_a,sync","axl_processo",array("8",$cVLogin->userReg(),time()),"id = '".$processo_id_a."'");
			
			//criar novo
			$ano_new = date("Y"); $mes_new = date("m"); $dia_new = date("d");
			//insere o registro na tabela do sistema
			//VARS insert simples SQL
			$tabela = "axl_processo";
			$campos = "origem_id,ano,mes,dia,code,tipo_servico,servico_id,pgto_id,candidato_fisico_id,candidato_juridico_id,coleta_id,coleta_time,emissao_time,status,validade_anos,validade_time,user,time,user_a,sync";
			$valores = array($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$ano_new,$mes_new,$dia_new,$code_new,$tipo_servico_a,$servico_id_a,$pgto_id_a,$candidato_fisico_id_a,"0",$coleta_id_a,$coleta_time_a,$emissao_time_a,$status_a,$validade_anos_a,$validade_time_a,$cVLogin->userReg(),time(),"0",time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			$processo_id_novo = fSQL::SQL_INSERT_ID(); $campos .= ",id"; $valores[] = $processo_id_novo;
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria	

			$processo_dir_novo = VAR_DIR_FILES."files/tabelas/axl_processo/"; $cria = fGERAL::criaPasta($processo_dir_novo, "0775"); //confere a criação e retona 1			
			$processo_dir_novo .= $ano_new."/"; $cria = fGERAL::criaPasta($processo_dir_novo, "0775"); //confere a criação e retona 1			
			$processo_dir_novo .= completa_zero($mes_new,2)."/"; $cria = fGERAL::criaPasta($processo_dir_novo, "0775"); //confere a criação e retona 1						
			$processo_dir_novo .= completa_zero($dia_new,2)."/"; $cria = fGERAL::criaPasta($processo_dir_novo, "0775"); //confere a criação e retona 1						
			$processo_dir_novo .= $code_new."/"; $cria = fGERAL::criaPasta($processo_dir_novo, "0775"); //confere a criação e retona 1									
			$fileCaminho = $processo_dir_novo."files/"; $cria = fGERAL::criaPasta($fileCaminho, "0775"); //confere a criação e retona 1					
			
			$resu = fSQL::SQL_SELECT_SIMPLES("tipo_id,tipo_campo,nome,valor,user,time","axl_processo_campos","processo_id = '".$processo_id_a."'");
			while($linhaxxx = fSQL::FETCH_ASSOC($resu)){
				$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
				$valores = array($processo_id_novo,$linhaxxx["tipo_id"],$linhaxxx["tipo_campo"],$linhaxxx["nome"],$linhaxxx["valor"],$linhaxxx["user"],$linhaxxx["time"]);
				fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
				
				if($linhaxxx["tipo_campo"] == "9"){
					copy($processo_dir."files/".$linhaxxx["valor"],$fileCaminho.$linhaxxx["valor"]);
				}//if($linhaxxx["tipo_campo"] == "9"){				
			}//fim while
			
			//atualizar pagamento para novo processo
			fSQL::SQL_UPDATE_SIMPLES("processo_id,processo_code","axl_pgto_banco",array($processo_id_novo,$code_new),"id = '".$pgto_id_a."'");
			
			//criar eventos do processo
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo Criado'),$class_fLNG->txt(__FILE__,__LINE__,'Processo criado a partir da correção da !!etapa!! no antedimento do processo #!!code!!',array("code"=>$code_new,"etapa"=>legEtapaCancelamento($etapa))),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_novo,$processo_dir_novo);														
			foreach($arrEventos as $array){
				if($array["evento"] != ""){
					fPROCESSO::criarEvento($array["evento"],$array["descricao"],$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_novo,$processo_dir_novo);
				}//if($array["evento"] != ""){
			}//foreach($arrEventos as $array){			
			
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("axl_processo", "adicionar", $processo_id_novo);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//GERA LOGS DE TABELAS
			if(isset($ARRAY_LOG)){//gerar log de auditoria	
				fGERAL::gravaLog("axl_processo",$processo_id_novo,$ARRAY_LOG,$cVLogin->userReg());
			}//if(isset($ARRAY_LOG)){			
			
			$code_a = $code_new;

		}else{//if($etapa >= "2"){
			//insere o registro na tabela do sistema
			//VARS insert simples SQL
			$tabela = "axl_processo";
			$campos = "origem_id,status,user_a,sync";
			$valores = array($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$status_a,$cVLogin->userReg(),time());
			$result = fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores,"id = '".$processo_id_a."'");
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria	
			//campos
			$cont_ARRAY = ceil(count($ARRAY_COMPLEMENTAR));
			if($cont_ARRAY >= "1"){	
				foreach($ARRAY_COMPLEMENTAR as $array){
					if($array["tipo_campo"] == "99"){
						$arr = explode("[,]",$array["valor"]);
						foreach($arr as $valor){
							$val = explode("[-]",$valor);
							$linha = fSQL::SQL_SELECT_ONE("id,valor","axl_processo_campos","processo_id = '".$processo_id_a."' AND tipo_id = '".$array["id"]."' AND nome = '".$val["0"]."'");
							if($linha["id"] >= "1" and $linha["valor"] != $val["1"]){
								fSQL::SQL_DELETE_SIMPLES("axl_processo_campos", "id = '".$linha["id"]."'");
								
								$linha = fSQL::SQL_SELECT_ONE("validade_anos","axl_habilitacao_categorias","categoria = '".$val["0"]."'");
								$validade_anos_a = $linha["validade_anos"];			
								
								$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
								$valores = array($processo_id_a,$array["id"],$array["tipo_campo"],$val["0"],$validade_anos_a,$cVLogin->userReg(),time());
								fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);					
							}//if($linha["id"] >= "1" and $linha["valor"] != $val["1"]){
								
							//adicionar data de obtenção da categoria do candidato
							$cont_ = fSQL::SQL_CONTAGEM("cad_candidato_fisico_habilitacao","candidato_fisico_id = '".$candidato_fisico_id_a."'");
							if($cont_ <= "0"){
								if($val["1"] == ""){ $val["1"] = date("Y-m-d"); }//nova habilitação
								$campos = "candidato_fisico_id,categoria,data_obtencao,processo_id,time";
								$valores = array($candidato_fisico_id_a,$val["0"],$val["1"],$processo_id_a,time());
								fSQL::SQL_INSERT_SIMPLES($campos,"cad_candidato_fisico_habilitacao",$valores);
							}//if($cont_ <= "0"){							
								
						}//fim foreach
					}else{//if($array["tipo_campo"] == "99"){
						$linha = fSQL::SQL_SELECT_ONE("id,valor","axl_processo_campos","processo_id = '".$processo_id_a."' AND tipo_id = '".$array["id"]."'");
						if($linha["id"] >= "1" and $linha["valor"] != $array["valor"]){
							fSQL::SQL_DELETE_SIMPLES("axl_processo_campos", "id = '".$linha["id"]."'");
							
							$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
							$valores = array($processo_id_a,$array["id"],$array["tipo_campo"],$array["nome"],$array["valor"],$cVLogin->userReg(),time());
							fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
						}//if($linha["id"] >= "1" and $linha["valor"] != $val["1"]){
					}
				}//fim foerach	
			}//if($cont_ARRAY >= "1"){	
			//arquivos
			$cont_ARRAY = ceil(count($ARRAY_COMPLEMENTAR_ARQUIVOS));
			if($cont_ARRAY >= "1"){	
				foreach($ARRAY_COMPLEMENTAR_ARQUIVOS as $array){
					//$ARRAY_["array_temp"] = $array_temp; $ARRAY_["id"] = $valor; $ARRAY_["tipo_campo"] = $tipo_campo_numero; $ARRAY_["nome"] = $nome; $ARRAY_["tipo"] = $nome;
					//verifica se é enviar arquivo ------------------------------------------------------>
					//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
					
					$form = "campo_tipo".$array["id"].$array["array_temp"];
					//scanner
					if($array["tab"] == "1"){	$form = "campo_tiposc".$array["id"].$array["array_temp"]; }
					
					$cont_arquivo = "0";
					//verifica se existem arquivos temp no sistema
					$upload_dir_temp = VAR_DIR_FILES."files/temp/";
					$campos = "id,titulo,nome,arquivo";
					$tabela = "sys_arquivos_temp";
					$where = "acao = '".$array["array_temp"]."' AND form = '".$form."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
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
							
							$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
							$valores = array($processo_id_a,$array["id"],$array["tipo_campo"],$array["nome"],$arquivo_e,$cVLogin->userReg(),time());
							fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);					
							
							//move o arquivo para o novo local e exclue o temp
							rename($upload_dir_temp.$arquivo_e, $processo_dir.$arquivo_e);
							//exclue o registro
							$tabela = "sys_arquivos_temp";
							fSQL::SQL_DELETE_SIMPLES($tabela, "id = '$id_e'");
						}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
					}//fim while
					//########################################### iFRAME TEMP ####################################<<<<<<<<<<<					
				}//fim foreach
			}//if($cont_ARRAY >= "1"){		

			//criar eventos do processo
			fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo Alterado'),$class_fLNG->txt(__FILE__,__LINE__,'Processo alterado na unidade'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_a,$processo_dir);														
			foreach($arrEventos as $array){
				if($array["evento"] != ""){
					fPROCESSO::criarEvento($array["evento"],$array["descricao"],$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_a,$processo_dir);
				}//if($array["evento"] != ""){
			}//foreach($arrEventos as $array){	
			
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("axl_processo", "editar", $processo_id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//GERA LOGS DE TABELAS
			if(isset($ARRAY_LOG)){//gerar log de auditoria	
				fGERAL::gravaLog("axl_processo",$processo_id_a,$ARRAY_LOG,$cVLogin->userReg());
			}//if(isset($ARRAY_LOG)){			
		}//}else{//if($etapa >= "2"){
			
		//ENCERRAR ATENDIMENTO SENHA
		$acao_redirecionar_servico_id = "";
		$acao_servico_id = categoriaServicoIDSENHA($tipo_servico_a);
		$msg = $class_fLNG->txt(__FILE__,__LINE__,'Atendimento encerrado.')."<br><br>".$msg_ws;
		//redirecionar senha
		if($status_a == "1"){
			$acao_redirecionar_servico_id = categoriaServicoIDSENHA("coleta");				
			$msg .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Redirecionado para coleta biométrica!');
		}//if($tipo_coleta_a == "2"){				
		fSENHA::encerrar($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$acao_servico_id,$senha_a,$acao_redirecionar_servico_id);

		//ATUALIZAR TRIAGEM PARA ATENDIDO
		fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_triagem",array("1",time()),"id = '$id_a'");
	
		
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Processo alterado com sucesso! Nº')." ".SYS_CONFIG_PROCESSO_SIGLA." ".$code_a."<br><br>".$msg);	
		$senha_b = "";		
		
?>
<script>
$(document).ready(function(e) {
	$.doTimeout('vTimerSalvarPro<?=$INC_FAISHER["div"]?>', 1000, function(){
		if(confirm('<?=$class_fLNG->txt(__FILE__,__LINE__,'Gostaria imprimir recibo do processo')?> \'<?=$code_a?>\'?')) {
			imprimirRecibo<?=$INC_FAISHER["div"]?>("<?=$code_a?>");
		}
		
		imprimirProcessoCompleto("<?=$code_a?>");
	});
});
</script>
<?php			
		
	}//if($valida == ""){
	
	
}
	
	
	
}//if($verificaRegistro >= "1"){
	


	//id temp para registro de array
	$array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroSec = "formCadastroSec".$array_temp;		
	
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas			

	
	if(isset($_GET["msg"])){
		$cMSG->addMSG("INFO",getpost_sql($_GET["msg"]));
		$cMSG->imprimirMSG();//imprimir mensagens criadas	
	}//if(isset($_GET["msg"])){

if($code_a != ""){
?>
<script>
function imprimirRecibo<?=$INC_FAISHER["div"]?>(v_code){
	faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=imprimirRecibo&code='+v_code, 'get', 'ADD');
}//imprimirRecibo

function imprimirProcessoFull<?=$INC_FAISHER["div"]?>(v_code){
	faisher_ajax('div_oculta', '', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=imprimirProcessoFull&code='+v_code, 'get', 'ADD');
}//imprimirProcessoFull
</script>
<?php	
}//if($code_a != ""){

	$SQL_varEnvio = "ajax=lista&faisher=$faisher&senha_b=$senha_b&"; //variaveis para a paginacao
	$AJAX_GET = $SQL_varEnvio;//vars get para reenvio no paginaçao AJAX




?>
<script>
$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val('<?=$AJAX_GET.$AJAX_GET_OR?>&pagina=<?=$pagina?>');//salva vars get
</script>
<input id="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" name="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" type="hidden" value="<?=$AJAX_GET?>&pagina=1" />
<form id="<?=$formCadastroSec?>" name="<?=$formCadastroSec?>" action="#" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgerais".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'SENHA DE ATENDIMENTO');// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<h6 style="float:right;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Guichê/Mesa')?>: <?=$_SESSION["guiche"]?> <button type="button" class="btn btn-icon-only btn-mini btn-default" onclick="selGuiche<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-retweet"></i></button></h6>
											<?=$boxUI_titulo?> 
										</a>
                                       	                                        
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
<script>
$.doTimeout('vTimerLoadServicos<?=$INC_FAISHER["div"]?>', 100, function(){ menuSenha<?=$INC_FAISHER["div"]?>(''); menuSenhaTime<?=$INC_FAISHER["div"]?>(''); });//TIMER

function menuSenha<?=$INC_FAISHER["div"]?>(v_get){
	//alert(v_get);
	pmodalDisplay('hide');
	loaderFoco('divMenu_Senha<?=$INC_FAISHER["div"]?>','dMenu_Senha<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
	faisher_ajax('menuSenha<?=$INC_FAISHER["div"]?>', 'dMenu_Senha<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=menuSenha&array_temp=<?=$array_temp?>&'+v_get, 'get', 'ADD');
}//menuSenha

function menuSenhaTime<?=$INC_FAISHER["div"]?>(v_get){
	faisher_ajax('menuSenha<?=$INC_FAISHER["div"]?>', '', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=menuSenha&array_temp=<?=$array_temp?>&'+v_get, 'get', 'ADD');

		$.doTimeout('vTimerListWSGest<?=$INC_FAISHER["div"]?>', 10000, function(){ 
			if($('#pModal').is(':visible') == false){		
				menuSenhaTime<?=$INC_FAISHER["div"]?>(''); 
				return true; 
			}//if($('#pModal').is(':visible') == false){
		});//TIMER
}//menuSenha


</script>



										<div class="row-fluid" id="divMenu_Senha<?=$INC_FAISHER["div"]?>">
											<div class="" id="menuSenha<?=$INC_FAISHER["div"]?>">
											</div>
										</div> 
                                        
                                                                                
<!--
										<div class="control-group">
											<label class="control-label">Senha chamada</label>
											<div class="controls">
											  <input type="text" name="senha" id="senha" value="<?=$senha_b?>" class="input-xlarge span9 cssFonteMai" maxlength="120" data-rule-required="true">
											</div>
										</div>

  										<div class="form-actions">
											<button type="button" class="btn btn-large btn-primary" onclick="abrir<?=$INC_FAISHER["div"]?>();return false;">Localizar dados</button>
                                            <button type="button" class="btn btn-large btn-primary" onclick="popupSenha('atendimento','#<?=$formCadastroSec?> #senha');return false;"><i class="glyphicon-tag"></i> Senha</button>
										</div>
-->                                        

<script>
/*
function abrir<?=$INC_FAISHER["div"]?>(){
	var senha = $("#<?=$formCadastroSec?> #senha").val();
	if(senha == ""){ exibNotificacao('INFO',"Necessário informar senha!","3000"); }else{//if(senha == ""){
		$('#senha_b<?=$INC_FAISHER["div"]?>').val($("#<?=$formCadastroSec?> #senha").val()); 
		$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val($('#AJAX_GET<?=$INC_FAISHER["div"]?>').val()+'&senha_b='+$("#<?=$formCadastroSec?> #senha").val())
		janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a='+$('#senha').val());
	}//}else{//if(senha == ""){
}//abrir
<?php if($senha_b == ""){?>
$(document).ready(function(e) {
    //$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ popupSenha('atendimento','#<?=$formCadastroSec?> #senha'); });
});
<?php }//if($senha_b = ""){?>
*/
</script>

                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->


</form>

<?php

}//fim ajax  -------------------------------------------- <<<
?>
<?php











































//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>
if($ajax == "home"){
	//include de padrao
	$INC_VAR["buscaAvancada"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaRapida"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]	
	$INC_VAR["tituloListaFixo"] = "";
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>