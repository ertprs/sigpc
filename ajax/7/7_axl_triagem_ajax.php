<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";


//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<


























if($ajax == "docHelp"){
?>
<div class="col-lg-12">
	<table class="table table-hover table-bordered">
    	<thead>
        	<tr>
            	<td>#</td>
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Nova')?></td>
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Tombamento')?></td>                
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Segunda Via')?></td>                
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Renovação')?></td>                
                <td><?=$class_fLNG->txt(__FILE__,__LINE__,'Mudança / Inclusão de Categoria')?></td>                
            </tr>
        </thead>
        <tbody>
        	<tr>
            	<td><?=$class_fLNG->txt(__FILE__,__LINE__,'Documento Pessoal com foto (obrigatório)')?></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
            </tr>
        	<tr>
            	<td><?=$class_fLNG->txt(__FILE__,__LINE__,'Comprovante Residência (obrigatório)')?></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
            </tr>
        	<tr>
            	<td><?=$class_fLNG->txt(__FILE__,__LINE__,'Habilitação Atual (obrigatório)')?></td>
                <td class="pull-center"></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"></td>
                <td class="pull-center"></td>
                <td class="pull-center"></td>
            </tr>                        
        	<tr>
            	<td><?=$class_fLNG->txt(__FILE__,__LINE__,'Laudo Médico (opcional)')?></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"></td>
                <td class="pull-center"></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
            </tr>            
        	<tr>
            	<td><?=$class_fLNG->txt(__FILE__,__LINE__,'Certificado Auto Escola (opcional)')?></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
                <td class="pull-center"></td>
                <td class="pull-center"></td>
                <td class="pull-center"></td>
                <td class="pull-center"><i class="icon-circle"></i></td>
            </tr>            
        </tbody>
    </table>
</div>
<div class="col-lg-12">
	<button type="button" class="btn btn-default pull-right" onclick="pmodalDisplay('hide');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
</div>
<?php
}//if($ajax = "docHelp"){



































if($ajax == "verNaoCompareceu"){
	$result = fSENHA::listaNaoCompareceu($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"));
	if(ceil(count($result)) <= "0"){
		echo $class_fLNG->txt(__FILE__,__LINE__,'Não ocorreu nenhum caso de não comparecimento em atendimento.');
	}else{//if(ceil(count($result)) <= "0"){
?>
	<table id="tabela_itens<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Serviço')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Prioridade')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Senha')?></th>                
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Pessoa')?></th>                                
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Info')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>                
			</tr>
		</thead>
        <tbody>
<?php	
	$cont = "0";
	foreach($result as $array){ $cont++;
		$arr = categoriaServicoArr();
		$servico_id = $arr[$array["servico_id"]-1];
		$senha = $array["num_senha"];
		if($array["prioridade"] != "1"){ $senha = "P".soNumero($senha); }
		$dt_cheg = explode(" ",$array["dt_cheg"]);
		$dt_cha = explode(" ",$array["dt_cha"]);		
		$info = $class_fLNG->txt(__FILE__,__LINE__,'Chegada').": ".data_mysql($dt_cheg["0"])." ".$dt_cheg["1"];
		$info .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Chamou').": ".data_mysql($dt_cha["0"])." ".$dt_cha["1"];
?>
			<tr>
            	<td><?=categoriaServicoLeg($servico_id)?></td>
            	<td><?=legPrioridade($array["prioridade"])?></td>                
            	<td><?=$senha?></td>                                
            	<td><?=$array["nome"]?></td>                                
            	<td><?=$info?></td>                                                
                <td><button type="button" class="btn btn-primary" onclick="novaSenha<?=$INC_FAISHER["div"]?>('<?=$senha?>');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Gerar nova senha')?> <i class="icon-chevron-right"></i></button></td>
            </tr>
<?php		
	}//fim foreach

?>        
        </tbody>
	</table>  
<script>
function novaSenha<?=$INC_FAISHER["div"]?>(v_senha){
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&naocompareceu='+v_senha, 'get', 'ADD');		
}//novaSenha<?=$INC_FAISHER["div"]?>
</script>
<?php	
	}//if(ceil(count($result)){
}//verNaoCompareceu






























if($ajax == "consultarProcessos"){
	$triagem_tipo_servico = getpost_sql($_GET["triagem_tipo_servico"]);
	$array_temp = getpost_sql($_GET["array_temp"]);
	if(isset($_GET["doc_tipo"])){ $doc_tipo = getpost_sql($_GET["doc_tipo"]); }else{ $doc_tipo = ""; }
	if(isset($_GET["doc_numero"])){ $doc_numero = getpost_sql($_GET["doc_numero"]); }else{ $doc_numero = ""; }	
	if(isset($_GET["datan"])){ $datan = getpost_sql($_GET["datan"]); }else{ $datan = ""; }	
	if(isset($_GET["code"])){ $code = getpost_sql($_GET["code"]); }else{ $code = ""; }	
	if(isset($_GET["processo_data"])){ $processo_data = getpost_sql($_GET["processo_data"]); }else{ $processo_data = ""; }	
	
	if($processo_data != ""){
		$processo_data = fGERAL::cptoFaisher($processo_data, "des");//descodifica
?>
<script>
$(document).ready(function(e) {
    $("#formCadastroPincipal<?=$array_temp?> #code").select2('data',<?=$processo_data?>);
});
</script>
<?php		
	}//if($processo_data != ""){



if($doc_numero != "" || $code != ""){
	$condicao = "";
	if($doc_numero != ""){
		$condicao = "rg = '".$doc_numero."'";
		if($doc_tipo == "PASSAPORTE"){ $condicao = "passaporte = '".$doc_numero."'"; }
		$condicao .= " AND datan = '".data_mysql($datan)."'";
	}
	if($code != ""){ 
		if($condicao != "") { $condicao .= " AND "; }
		$condicao .= " code = '".$code."'"; 
	}

	$candidato = ""; $candidato_id = "0";
	$linha = fSQL::SQL_SELECT_ONE("id,code,nome,sobrenome","cad_candidato_fisico",$condicao);
	if($linha["nome"] != ""){
		$candidato_id = $linha["id"];
		$candidato_code = $linha["code"];
		$candidato_nome = $linha["nome"]." ".$linha["sobrenome"];
	}//if($linha["nome"] != ""){
		
	if($candidato_id <= "0"){
?>
 	 	<div class="control-group">
        	<div class="controls display-plus"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado candidato com este documento (!!doc!!) e nome (!!nome!!)',array("doc"=>$doc_numero,"nome"=>$datan));?></div>
        </div>
        <div class="form-actions">
        	<button type="button" class="btn btn-large btn-info" onclick="consultarProcessos<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tentar novamente')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadProcessos<?=$INC_FAISHER["div"]?>" /></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>  
<?php		
	}else{//if($candidato_id <= "0"){
		
		$arStatus = array(0,1);
		if($triagem_tipo_servico == "reclamacao"){ $arStatus = array(5); }		
?>
<form class='form-horizontal form-column form-bordered' onsubmit="return false;">
    <div class="control-group">
		<div class="controls display-plus"><b><?=SYS_CONFIG_RM_SIGLA." ".$candidato_code." - ".$candidato_nome?></b></div>
    </div> 
    <div class="col-md-12">
        <table class="table table-hover table-bordered" style="margin-top:0;">
            <thead>
                <tr>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo')?></th>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></th>
                    <th><?=$class_fLNG->txt(__FILE__,__LINE__,'Ação')?></th>                
                </tr>
            </thead>
            <tbody>
<?php	
	$cont = "0"; $pc = "";
	$resu = fSQL::SQL_SELECT_SIMPLES("code,tipo_servico,servico_id,status","axl_processo","candidato_fisico_id = '".$candidato_id."'");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$code = $linha["code"];
		$tipo_servico = $linha["tipo_servico"];		
		$servico_id = $linha["servico_id"];
		$status = $linha["status"];
		$linhaxxx = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$servico_id."'");
		$servico_id_n = '<i class="'.categoriaServicoIco($tipo_servico).'"></i> '.$linhaxxx["nome"]."<br>".SYS_CONFIG_PROCESSO_SIGLA." ".$code;		
		
		$processo_data = '{id: "'.$code.'", text: "<b>'.SYS_CONFIG_PROCESSO_SIGLA.' '.$code.' - '.categoriaServicoLeg($tipo_servico).'</b><br>'.$linhaxxx["nome"].'<br><small><i>'.$candidato_nome.'</i></small>"}';
		$processo_data = fGERAL::cptoFaisher($processo_data,"enc");
		
		
?>
                <tr>
                    <td><?=$servico_id_n?></td>
                    <td><?=processoStatusLeg($status)?></td>
                    <td>
                    	<button type="button" class="btn btn-primary" <?php if(in_array($status,$arStatus)){?> onclick="selecionarProcesso<?=$INC_FAISHER["div"]?>('<?=$processo_data?>');return false;" <?php  }else{ echo 'disabled'; }?>><?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar')?> <i class="icon-chevron-right"></i> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadCode<?=$INC_FAISHER["div"]?>" /></button>
                        
						<?php if(!in_array($status,$arStatus)){?>							                    	                      
                        	<span>*<?=$class_fLNG->txt(__FILE__,__LINE__,'Processo não está em:')?> <?=sentenca(processoStatusLeg($status))?></span>
                    	<?php }//if(in_array($status,[0,1])){?>                            
                    </td>
                </tr>
<?php		
	}//fim while
	if($cont == "0"){
?>
				<tr><td><div style="padding:20px;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Nenhum processo encontrado deste candidato')?></div></td></tr>
<?php		
	}
?>
            </tbody>
        </table>
    </div>
 	 	<div class="form-actions">
        	<button type="button" class="btn btn-large btn-info" onclick="consultarProcessos<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tentar novamente')?></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>     
</form>    
<?php
	}//}else{//if($candidato_id <= "0"){
}//if($doc_numero != ""){
?>




<?php 
if($doc_numero == "" and $code == ""){

    //id temp para registro de array
	$formSec = "formSec".time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");;	
		
/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";		
?>
<form id="<?=$formSec?>" class='form-horizontal form-column form-bordered' onsubmit="return false;">
    <div class="span12">
        <div class="alert alert-warning">
            <b><?=$class_fLNG->txt(__FILE__,__LINE__,'ATENÇÃO!')?></b><br><?=$class_fLNG->txt(__FILE__,__LINE__,'Para buscar é necessário utilizar algum filtro: <br>- Nº documento + data de nascimento <br>- !!rnt!!',array("rnt"=>SYS_CONFIG_RM_SIGLA))?>
        </div>     
    </div>
    <div class="span12">
        <div class="span6">
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
            </div>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_RM_SIGLA?></label>
                <div class="controls">
                    <input type="text" name="rnt" id="rnt" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_RM_SIGLA))?>" class="input-xlarge">
                </div>
            </div>          
        </div>
        <div class="span5">
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
        </div> 
    </div>
    <div class="form-actions">
            <button type="button" class="btn btn-large btn-primary" onclick="buscarProcessos<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar processos')?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadProcessos<?=$INC_FAISHER["div"]?>" /></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div> 

</form>
<?php }//if($doc_numero == ""){?>



<script>
function buscarProcessos<?=$INC_FAISHER["div"]?>(){
	v_doc_tipo = $("#<?=$formSec?> input[name='doc_tipo']:checked").val();
	v_doc_numero = $("#<?=$formSec?> #doc_numero").val();
	v_datan = $("#<?=$formSec?> #datan").val();
	v_rnt = $("#<?=$formSec?> #rnt").val();
	
	var valida = "";
	if(v_rnt == ""){
		if(v_doc_numero == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar o nº do documento do candidato!')?>"; }
		if(v_datan == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'É obrigatório informar a data de nascimento do candidato!')?>"; }	
	}//if(v_rnt == ""){

	if((v_doc_numero == "") && (v_datan == "") && (v_rnt == "")){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Deve ser informado o nº do documento + data de nascimento ou !!sigla!! do candidato.',array("sigla"=>SYS_CONFIG_RM_PROCESSO))?>"; }
	
	if(valida != ""){ alert(valida); }else{
		faisher_ajax('pModalConteudoOn', 'loadProcessos<?=$INC_FAISHER["div"]?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=consultarProcessos&triagem_tipo_servico=<?=$triagem_tipo_servico?>&array_temp=<?=$array_temp?>&doc_tipo='+v_doc_tipo+'&doc_numero='+v_doc_numero+'&datan='+v_datan+'&code='+v_rnt, 'get', 'ADD');		
	}
}//buscarProcessos

function selecionarProcesso<?=$INC_FAISHER["div"]?>(v_data){
	faisher_ajax('pModalConteudoOn', 'loadCode<?=$INC_FAISHER["div"]?>', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=consultarProcessos&triagem_tipo_servico=<?=$triagem_tipo_servico?>&array_temp=<?=$array_temp?>&processo_data='+v_data, 'get', 'ADD','pModal');		
}//selecionarImp
</script>    
<?php	
		
}//if($ajax == "consultarProcessos"){




















































if($ajax == "selImp"){

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
	$resu = fSQL::SQL_SELECT_SIMPLES("pc,legenda","axl_dispositivo","origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."' AND tipo = '0' AND status = '1'");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont++;
		$pc = $linha["pc"];
?>
			<tr>
            	<td><?=$linha["legenda"]?></td>
            	<td><?=$linha["pc"]?></td>                
                <td><button type="button" class="btn btn-primary" onclick="selecionarImp<?=$INC_FAISHER["div"]?>('<?=$linha["pc"]?>');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar')?> <i class="icon-chevron-right"></i></button></td>
            </tr>
<?php		
	}//fim while

?>
        </tbody>
	</table>
<script>
$(document).ready(function(e) {
<?php if($cont == "1"){?>
	selecionarImp<?=$INC_FAISHER["div"]?>('<?=$pc?>');
	pmodalDisplay('hide');
<?php }//if($cont == "1"){?>	
});

function selecionarImp<?=$INC_FAISHER["div"]?>(v_pc){
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&selImpSESSION='+v_pc, 'get', 'ADD');		
}//selecionarImp
</script>    
<?php	
		
}//if($ajax == "selImp"){
























if($ajax == "selGuiche"){

?>
<form class='form-horizontal form-column form-bordered' onsubmit="return false;">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Guichê/Mesa de atendimento')?></label>
            <div class="controls">
            	<input type="number" class="" id="guiche"/>
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
	if(v_guiche == "0" || v_guiche == ""){ alert("<?=$class_fLNG->txt(__FILE__,__LINE__,'Obrigatório informar o guichê')?>"); }else{
		loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
		faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&selguiche='+v_guiche, 'get', 'ADD');		
		pmodalDisplay('hide');
	}
}//selecionarImp
</script>    
<?php	
		
}//if($ajax == "selImp"){





























//AJAX (lista/preenche combox lista de grupos) ------------------------------------------------------------------>>>
if($ajax == "selGrupo"){
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = getpost_sql($_GET["term"]);
		$sql_busca = " ( `id` = '$term' OR `legenda` LIKE '%$term%' ) "; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();	

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,nome", "adm_protocolo_tipo_inf_grupo", "perfil_id = '".$cVLogin->getVarLogin("SYS_USER_PERFIL_ID")."'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$legenda = $linha["nome"];
		//alimenta array de retorno
		$row_array['id'] = $id;
		$row_array['text'] = "<b>".$legenda."</b>";
		array_push($return_arr,$row_array);
	}//while				

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);


}//fim ajax -------------------<<<<








































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//









if($ajax == "consultarDados"){
	$form = getpost_sql($_GET["form"]);
	if(isset($_GET["tipo_pessoa"])){ $tipo_pessoa = getpost_sql($_GET["tipo_pessoa"]); }else{ $tipo_pessoa = ""; }
	if(isset($_GET["tipo_servico"])){ $tipo_servico = getpost_sql($_GET["tipo_servico"]); }else{ $tipo_servico = ""; }
	if(isset($_GET["pgto_num"])){ $pgto_num = getpost_sql($_GET["pgto_num"]); }else{ $pgto_num = ""; }
	if(isset($_GET["code"])){ $code = getpost_sql($_GET["code"]); }else{ $code = ""; }	
	if(isset($_GET["candidato"])){ $candidato = getpost_sql($_GET["candidato"]); }else{ $candidato = ""; }	
	//if(isset($_GET["candidato_fisico_id"])){ $candidato_fisico_id = getpost_sql($_GET["candidato_fisico_id"]); }else{ $candidato_fisico_id = ""; }	
	if(isset($_GET["candidato_juridico_id"])){ $candidato_juridico_id = getpost_sql($_GET["candidato_juridico_id"]); }else{ $candidato_juridico_id = ""; }	
	if(isset($_GET["prioridade"])){ $prioridade = getpost_sql($_GET["prioridade"]); }else{ $prioridade = ""; }		
	if(isset($_GET["reclamacao_tipo"])){ $reclamacao_tipo = getpost_sql($_GET["reclamacao_tipo"]); }else{ $reclamacao_tipo = ""; }		
	
	//verificar se ja tem algum processo em atendimento deste tipo
	/*
	if((preg_match("/NOVO:/",$candidato_fisico_id)) or (preg_match("/NOVO:/", $candidato_juridico_id)) and $code == ""){
		$condicao = "status = '0' AND tipo_servico = '$tipo_servico'";
		if($candidato_fisico_id >= "1"){
			$condicao .= " AND candidato_fisico_id = '$candidato_fisico_id'";
		}else{
			$condicao .= " AND candidato_juridico_id = '$candidato_juridico_id'";				
		}
		$qtd = fSQL::SQL_CONTAGEM("axl_processo",$condicao);
		if($qtd >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("id,code,tipo_servico,servico_id,status","axl_processo",$condicao);				
			$code = $linha["code"];
		}//if($qtd >= "1"){
	}//if((!preg_match("/NOVO:/",$candidato_fisico_id)) and (!preg_match("/NOVO:/", $candidato_juridico_id))){
	*/
	
	
	if($code != ""){
		$linha = fSQL::SQL_SELECT_ONE("S.nome","axl_processo P, adm_protocolo_tipo S","P.servico_id = S.id AND code = '$code'");
		$servico_nome = $linha["nome"];
?>
		<div class="span12">
            <ul class="stats">
                <li class="blue">
                    <i class="icon-edit"></i>
                    <div class="details">
                        <span class="big"><?=sentenca(minusculo($tipo_servico))?> - <?=sentenca(minusculo($servico_nome))?></span>
                        <span><?=SYS_CONFIG_PROCESSO_SIGLA?> <?=$code?></span>
                    </div>
                </li>
            </ul>
        </div>
        
      
<?php
		$pgto_num = "";
	}//if($code != ""){
		
?>
<script>
function validar<?=$INC_FAISHER["div"]?>(){
	valida = "1";
	<?php if($pgto_num >= "1"){?>
	var pgto = $("input[name=pgto_id]:checked").val();
	if(pgto <= "0" || pgto == null){ valida = "0"; }
	<?php }//if($pgto_num >= "1"){?>	
	
	<?php if($tipo_servico == "info"){?>
		//valida = "1";
	<?php }//if($tipo_servico == "info"){?>		
	
	if(valida == "1"){
		$("#divBtn_senhasim").fadeIn();
		$("#divBtn_senhanao").fadeOut();
	}else{
		$("#divBtn_senhasim").fadeOut();
		$("#divBtn_senhanao").fadeIn();
	}
}//validar
</script>
<?php	
	if($pgto_num >= "1"){
		
		
/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."bp";
include "inc/inc_js-exclusivo.php";
?>
<script type="text/javascript">
<?php
//ID de controle ---  ########### rolagem faisher ################# ++++
$id_Content = "divPesquisa_ajax".$INC_FAISHER["div"];
$id_Rolagem = "Ajax".$INC_FAISHER["div"];
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
<div class="bg-shadowb05" style="margin:3px 5px 10px 5px;" id="div_setaPgto">
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 0 3px;">
  <tr>
    <td style="width:56px; height:53px; background:url(img/ico_seta_tl.png) no-repeat center; transform:rotateX(180deg); background-size:100%;">&nbsp;</td>
    <td valign="bottom" style="padding-left:5px;">
        <div style="font-size:17px; font-weight:bold; color:#2a4d82; margin:3px 0 20px 0;"><?=$class_fLNG->txt(__FILE__,__LINE__,'ESCOLHA O PAGAMENTO CORRETO')?></div>
    	<div style="font-size:10px;">*<?=$class_fLNG->txt(__FILE__,__LINE__,'Atenção! Verifique corretamente o pagamento')?> :)</div>      </td>  
  </tr>
</table>
</div>
<div id="divRol<?=$id_Rolagem?>" style="width:100%; overflow:auto;">
<div id="divRol<?=$id_Rolagem?>Cont" style="width:100%; min-width:900px; padding-top:20px;">
	<table id="datatable_pgto<?=$INC_FAISHER["div"]?>" class="table table-hover table-nomargin table-bordered dataTable">
		<thead>
			<tr>
				<th></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Identificação')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Info')?></th>
			</tr>
		</thead>
		<tbody>
<?php	

	//consultar pagamento
	$cont_pgto = "0";
	$resu = fSQL::SQL_SELECT_SIMPLES("id,cod_banco,nome,sobrenome,valor,time_deposito","axl_pgto_banco","status = '0' AND numero = '$pgto_num'");
	while($linha = fSQL::FETCH_ASSOC($resu)){ $cont_pgto++;

		$pgto_id = $linha["id"];
		$cod_banco = $linha["cod_banco"];
		$nome = $linha["nome"];		
		$sobrenome = $linha["sobrenome"];		
		$valor = $linha["valor"];		
		$time_deposito = $linha["time_deposito"];		
		
		$nome_n = $nome;
		if($sobrenome != ""){ $nome_n .= " ".$sobrenome; }
		
		$info = "GNF $ ".formataValor($valor);
		$info .= "<br>".date("d/m/Y H:i", $time_deposito);
		$info .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Banco').": ".legBanco($cod_banco);		
			
?>
			<tr>
            	<td><input name="pgto_id" type="radio" class='<?=$INC_FAISHER["div"]?>bp-icheck it_check_css<?=$INC_FAISHER["div"]?>' id="it<?=$pgto_id?>" value="<?=$pgto_id?>" data-skin="square" data-color="blue"></td>
                <td>#<?=$pgto_id?> <?=$class_fLNG->txt(__FILE__,__LINE__,'Número')?>: <?=$pgto_num?><br><?=$nome_n?></td>
                <td><?=$info?></td>                
            </tr>
<?php		
	}//fim while
?>
        </tbody>
    </table>
<?php if($cont_pgto <= "0"){?>
	<div style="height:150px; padding:20px 0 0 10px; clear:both;"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Não foi encontrado nenhum pagamento com este número')?> (<?=$pgto_num?>).</div>
<?php }?>
    
</div>
</div>    

<script type="text/javascript">
$(document).ready(function(){
    $(".it_check_css<?=$INC_FAISHER["div"]?>").on('change', function(e) {
		$("#div_btSenha").html("(#"+$(this).val()+")");
		validar<?=$INC_FAISHER["div"]?>();
    });	
<?php if($cont_pgto <= "0"){?>
	$("#div_setaPgto").fadeOut();
<?php }?>
});
</script>



<?php
	}//if($pgto_num >= "1"){	
	
?>


<script>
$(document).ready(function(e) {
    validar<?=$INC_FAISHER["div"]?>();
});

function gerarSenha<?=$INC_FAISHER["div"]?>(){
	var tipo_pessoa = '<?=$tipo_pessoa?>';	
	var tipo_servico = '<?=$tipo_servico?>';
	var code = '<?=$code?>';	

	var valida = "";
	var v_pgto_id = "";
<?php if($pgto_num >= "1"){?>
	v_pgto_id = $("input[name=pgto_id]:checked").val();
	if(v_pgto_id <= "0" || v_pgto_id == null){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário selecionar o pagamento, verifique!')?>"; }
<?php }//if($pgto_num >= "1"){?>

	if(valida != ""){ alert(valida); }else{//if(valida != ""){
		v_get = "&tipo_pessoa=<?=$tipo_pessoa?>&tipo_servico=<?=$tipo_servico?>&pgto_num=<?=$pgto_num?>&pgto_id="+v_pgto_id+"&code=<?=$code?>&candidato=<?=$candidato?>&candidato_juridico_id=<?=$candidato_juridico_id?>&prioridade=<?=$prioridade?>&reclamacao_tipo=<?=$reclamacao_tipo?>";
		//v_get = "&tipo_pessoa=<?=$tipo_pessoa?>&tipo_servico=<?=$tipo_servico?>&pgto_num=<?=$pgto_num?>&pgto_id="+v_pgto_id+"&code=<?=$code?>&candidato_fisico_id=<?=$candidato_fisico_id?>&candidato_juridico_id=<?=$candidato_juridico_id?>&prioridade=<?=$prioridade?>";
		loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
		faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&salvar=1&'+v_get, 'get', 'ADD');		
	}//}else{//if(valida != ""){
}//gerarSenha
</script>
<div class="bg-shadowb05" style="margin:3px 5px 10px 5px;" id="divBtn_senha">
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 0 3px;">
  <tr id="divBtn_senhasim">
    <td valign="bottom" style="padding-left:5px;">

    <div style="padding:20px 20px 3px 20px;"><button type="button" class="btn btn-darkblue btn-large btn-block" onclick="gerarSenha<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-tag"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'GERAR SENHA')?> <span style="font-weight:bold;" id="div_btSenha"></span></button></div>
	<div style="padding:10px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Ao clicar no botão Gerar Senha Eu confirmo ter <b>verificado os dados corretamente</b>!')?></div>
    <div style="clear:both;"></div>

    </td>
  </tr>
  <tr id="divBtn_senhanao">
    <td valign="bottom" style="padding-left:5px;">

    <div style="padding:20px 20px 3px 20px;"><button type="button" class="btn btn-red btn-large btn-block" data-placement="top" rel="tooltip" disabled><i class="icon-tag"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'GERAR SENHA')?></button></div>
    <div style="clear:both;"></div>

    </td>
  </tr>  
</table>
</div>	
	
	
<?php	
}//consultarDados
























































//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){

	if(isset($_GET["selguiche"])){
		$guiche = getpost_sql($_GET["selguiche"]);
		$_SESSION["guiche"] = $guiche;
		$linha = fSQL::SQL_SELECT_ONE("pc","axl_dispositivo","guiche = '".$guiche."' AND tipo = '1'");//selecionar impreessora
		$_SESSION["impressora_pc"] = $linha["pc"];
		
	}//if($ajax == "selImpSESSION"){




	if(isset($_GET["tipo_pessoa"])){ $tipo_pessoa = getpost_sql($_GET["tipo_pessoa"]); }else{ $tipo_pessoa = ""; }
	if(isset($_GET["tipo_servico"])){ $tipo_servico = getpost_sql($_GET["tipo_servico"]); }else{ $tipo_servico = ""; }
	if(isset($_GET["pgto_num"])){ $pgto_num = getpost_sql($_GET["pgto_num"]); }else{ $pgto_num = ""; }
	if(isset($_GET["code"])){ $code = getpost_sql($_GET["code"]); }else{ $code = ""; }	
	if(isset($_GET["candidato"])){ $candidato = getpost_sql($_GET["candidato"]); }else{ $candidato = ""; }	
	//if(isset($_GET["candidato_fisico_id"])){ $candidato_fisico_id = getpost_sql($_GET["candidato_fisico_id"]); }else{ $candidato_fisico_id = ""; }	
	if(isset($_GET["candidato_juridico_id"])){ $candidato_juridico_id = getpost_sql($_GET["candidato_juridico_id"]); }else{ $candidato_juridico_id = ""; }			
	if(isset($_GET["prioridade"])){ $prioridade = getpost_sql($_GET["prioridade"]); }else{ $prioridade = ""; }				
	if(isset($_GET["reclamacao_tipo"])){ $reclamacao_tipo = getpost_sql($_GET["reclamacao_tipo"]); }else{ $reclamacao_tipo = ""; }				

	if(isset($_GET["salvar"])){
		if(isset($_GET["pgto_id"])){ $pgto_id = getpost_sql($_GET["pgto_id"]); }else{ $pgto_id = ""; }		
		//GET SENHA - GET SENHA - GET SENHA - GET SENHA - GET SENHA - GET SENHA
		
		//if(preg_match("/NOVO:/",$candidato_fisico_id)){ $nome = $candidato_fisico_id; $candidato_fisico_id = ""; }
		$nome = maiusculo($candidato);
		if(preg_match("/NOVO:/",$candidato_juridico_id)){ $nome = $candidato_juridico_id; $candidato_juridico_id = ""; }		
		
		$servico_id = categoriaServicoIDSENHA($tipo_servico);
		
		$candidato_fisico_id = "0"; $valida = ""; $msg_ws = "";
		//buscar candidato no processo
		if($nome == "" and $code != ""){
			$arrPro = fSQL::SQL_SELECT_ONE("P.id,P.candidato_fisico_id,P.status,P.externo,P.motivo_id,P.ano,P.mes,P.dia,P.tipo_servico,P.servico_id,P.pgto_id,P.validade_anos,P.coleta_id,P.coleta_time,P.ano,P.mes,P.dia,P.suspensao_i,P.suspensao_f,C.nome","axl_processo P, cad_candidato_fisico C","P.code = '".$code."'  AND P.candidato_fisico_id = C.id");
			$processo_id = $arrPro["id"];
			$candidato_fisico_id = $arrPro["candidato_fisico_id"];
			$nome = $arrPro["nome"];
			$motivo_id = $arrPro["motivo_id"];
			$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$arrPro["ano"]."/".completa_zero($arrPro["mes"],"2")."/".completa_zero($arrPro["dia"],"2")."/".$code."/";
			//$servico_id = $linha["servico_id"];
			
			if($arrPro["suspensao_f"] >= time()){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo está suspenso até !!data!!. Não é possível realizar atendimento de processo suspenso.',array("data"=>$arrPro["suspensao_f"]));					
				$cMSG->addMSG("ERRO",$valida);
				$cMSG->imprimirMSG();//imprimir mensagens criadas	
			}//if($arrPro["suspensao_f"] >= time()){
			
			if($arrPro["status"] >= "6"){
				$valida = $class_fLNG->txt(__FILE__,__LINE__,'Este processo foi cancelado! Não é possível realizar atendimento de processo cancelado.');					
				$cMSG->addMSG("ERRO",$valida);
				$cMSG->imprimirMSG();//imprimir mensagens criadas					
			}
			
			if($valida == ""){
				$linha = fSQL::SQL_SELECT_ONE("id,numero","axl_pgto_banco","id = '".$arrPro["pgto_id"]."'");
				$pgto_id = $arrPro["pgto_id"]; 
				$pgto_num = $linha["numero"];			
	
				//cancelar etapa do processo
				if($reclamacao_tipo != ""){
					$reclamacao_leg = $class_fLNG->txt(__FILE__,__LINE__,'RECLAMAÇÃO DADOS BIOMÉTRICOS (foto)');
					if($reclamacao_tipo == "2"){ $reclamacao_leg = $class_fLNG->txt(__FILE__,__LINE__,'RECLAMAÇÃO DADOS BIOGRÁFICOS (dados)'); }
					if($reclamacao_tipo == "3"){ $reclamacao_leg = $class_fLNG->txt(__FILE__,__LINE__,'RECLAMAÇÃO DADOS BIOMÉTRICOS E BIOGRÁFICOS'); }				
					$motivo_id = fSQL::SQL_SELECT_INSERT("axl_motivo_cancelamento");
					$campos = "id,processo_id,processo_code,etapa,motivo_codigo,descricao,resolvido,time,user_a,sync";
					$valores = array($motivo_id,$processo_id,$code,"3",$reclamacao_tipo,$reclamacao_leg,"0",time(),"0",time());
					fSQL::SQL_INSERT_SIMPLES($campos,"axl_motivo_cancelamento",$valores);
	
					fSQL::SQL_UPDATE_SIMPLES("status,motivo_id,sync","axl_processo",array("0",$motivo_id,time()),"id = '".$processo_id."'");
				}//if($reclamacao_tipo != ""){
				
				//tem problema
				$etapa = "0"; $processo_id_novo = "0";
				if($motivo_id >= "1"){
					$linhaxxx = fSQL::SQL_SELECT_ONE("etapa,motivo_codigo","axl_motivo_cancelamento","id = '".$motivo_id."'");
					$etapa = $linhaxxx["etapa"];
					$motivo_codigo = $linhaxxx["motivo_codigo"];			
					if($etapa >= "2" and $motivo_codigo == "1"){//criar novo processo
						if($processo_servico_id == "15"){ $code_novo = fGERAL::codeRand(11, "15"); }else{ $code_novo = fGERAL::codeRand(11); }
						$status = "8";
						if($etapa == "3"){ $status = "6"; }					
						//cancelar processo atual
						fSQL::SQL_UPDATE_SIMPLES("status,motivo_id,user_a,sync","axl_processo",array($status,"0",$cVLogin->userReg(),time()),"id = '".$processo_id."'");
	
						$coleta_id = $arrPro["coleta_id"]; $coleta_time = $arrPro["coleta_time"];
						if($motivo_codigo != "2"){ $coleta_id = "0"; $coleta_time = "0"; }
						
						$status = "0";
						//criar novo
						$ano = date("Y"); $mes = date("m"); $dia = date("d");
						//insere o registro na tabela do sistema
						//VARS insert simples SQL
						$tabela = "axl_processo";
						$campos = "origem_id,ano,mes,dia,code,tipo_servico,servico_id,pgto_id,candidato_fisico_id,candidato_juridico_id,coleta_id,coleta_time,emissao_time,status,validade_anos,validade_time,user,time,user_a,sync";
						$valores = array($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$ano,$mes,$dia,$code_novo,$arrPro["tipo_servico"],$arrPro["servico_id"],$arrPro["pgto_id"],$candidato_fisico_id,"0",$coleta_id,$coleta_time,"0",$status,$arrPro["validade_anos"],"0",$cVLogin->userReg(),time(),"0",time());
						$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
						$processo_id_novo = fSQL::SQL_INSERT_ID(); $campos .= ",id"; $valores[] = $processo_id_novo;
						$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria	
		
						$processo_dirOLD = $processo_dir;
						
						$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1			
						$processo_dir .= $ano."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1			
						$processo_dir .= completa_zero($mes,2)."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1						
						$processo_dir .= completa_zero($dia,2)."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1						
						$processo_dir .= $code_novo."/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1									
						
						fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo Criado'),$class_fLNG->txt(__FILE__,__LINE__,'Processo criado a partir da reclamação na triagem da referente a !!etapa!! do processo #!!code!!',array("code"=>$code_novo,"etapa"=>legEtapaCancelamento($etapa))),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id_novo,$processo_dir);	
		
						$processo_dir .= "files/"; $cria = fGERAL::criaPasta($processo_dir, "0775"); //confere a criação e retona 1															
		
						//atualizar pagamento para novo processo
						fSQL::SQL_UPDATE_SIMPLES("processo_id,processo_code","axl_pgto_banco",array($processo_id_novo,$code_novo),"id = '".$arrPro["pgto_id"]."'");
						
						$resu = fSQL::SQL_SELECT_SIMPLES("tipo_id,tipo_campo,nome,valor,user,time","axl_processo_campos","processo_id = '".$processo_id."'");
						while($linhaxxx = fSQL::FETCH_ASSOC($resu)){
							$campos = "processo_id,tipo_id,tipo_campo,nome,valor,user,time";
							$valores = array($processo_id_novo,$linhaxxx["tipo_id"],$linhaxxx["tipo_campo"],$linhaxxx["nome"],$linhaxxx["valor"],$linhaxxx["user"],$linhaxxx["time"]);
							fSQL::SQL_INSERT_SIMPLES($campos,"axl_processo_campos",$valores);
							
							if($linhaxxx["tipo_campo"] == "9"){
								
								
								copy($processo_dirOLD.$linhaxxx["valor"],$processo_dir.$linhaxxx["valor"]);
							}//if($linhaxxx["tipo_campo"] == "9"){
						}//fim while
	
						$code = $code_novo; $processo_id = $processo_id_novo;
						//GERA AÇÃO DO USUÁRIO NA TABELA
						$cVLogin->addAcaoUser("axl_processo", "adicionar", $processo_id_novo);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
						//GERA LOGS DE TABELAS
						if(isset($ARRAY_LOG)){//gerar log de auditoria	
							fGERAL::gravaLog("axl_processo",$processo_id_novo,$ARRAY_LOG,$cVLogin->userReg());
						}//if(isset($ARRAY_LOG)){							
	
					}//if($linhaxxx["etapa"] >= "2" and $linhaxxx["motivo_codigo"] == "1"){//criar novo processo
					
					
					if($motivo_codigo == "1"){//enviar para coleta
						$tipo_servico = "coleta";
					}//if($motivo_codigo == "1"){
					
					
				}//if($motivo_id >= "1"){					
				
				if($tipo_servico == "coleta"){
					$result = thomasWScoletaBiometricaEnviar($processo_id,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"));
					//echo "result: <pre>"; print_r($result); echo "</pre>";
					
					if(isset($result["codigo_retorno"])){
						if($result["codigo_retorno"] == "1"){ 
							$msg_ws = "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'Enviado para coleta biométrica');	
							
							//criar evento
							fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização Coleta Biométrica'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para coleta biométrica'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$processo_dir);				
							//fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array("1",time()),"id = '".$processo_id."'");
						}else{//if($result["codigo_retorno"] == "001"){
							$msg = thomasFiltrarErro($result["descricao_retorno"]);
							$valida = thomasCodRetorno($result["codigo_retorno"]).$msg;		
						}//}else{//if($result["codigo_retorno"] == "001"){
					}else{//}//}else{//if($result["codigo_retorno"] == "001"){
						$valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível comunicar com o sistema biométrico.');
					}	
					
					if($valida != ""){					
						$cMSG->addMSG("ERRO",$valida);
						$cMSG->imprimirMSG();//imprimir mensagens criadas	
						if($etapa >= "2" and $processo_id_novo >= "1"){
							fSQL::SQL_DELETE_SIMPLES("axl_processo","id = '".$processo_id_novo."'");
							fSQL::SQL_DELETE_SIMPLES("axl_processo_campos","processo_id = '".$processo_id_novo."'");					
							delete($processo_dir);
						}//if($etapa >= "2"){
					}//if($valida != ""){	
				}//if($tipo_servico == "coleta"){			
			}//if($valida == ""){			
			//enviar para coleta caso ja esteja completo o atendimento externo
			/*
			if($linha["servico_id"] == "14" and $linha["status"] == "0" and $linha["externo"] == "1"){
				$completo = "1";
				//exame médico
				$qtd = fSQL::SQL_CONTAGEM("axl_processo_campos","tipo_id = '4' AND tipo_campo = '9' AND processo_id = '".$linha["id"]."'");
				if($qtd <= "0"){ $completo = "0"; }
				//certificado auto escola
				$qtd = fSQL::SQL_CONTAGEM("axl_processo_campos","tipo_id = '6' AND tipo_campo = '9' AND processo_id = '".$linha["id"]."'");
				if($qtd <= "0"){ $completo = "0"; }				
				//echo "<br>completo:".$completo;
				$completo = "0";
				if($completo >= "1"){ 
					$status_a = "0";
					$tipo_servico = "coleta";
					fSQL::SQL_UPDATE_SIMPLES("origem_id","axl_processo",array($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")),"id = '".$linha["id"]."'");
					$result = thomasWScoletaBiometricaEnviar($linha["id"],$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"));
					//echo "result: <pre>"; print_r($result); echo "</pre>";
					if(isset($result["codigo_retorno"])){
						if($result["codigo_retorno"] == "001"){ 
							$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Enviado para coleta biométrica'));	
							$status_a = "1";
						}else{//if($result["codigo_retorno"] == "001"){
							$valida = thomasCodRetorno($result["codigo_retorno"])." - ".$result["descricao_retorno"];
						}//}else{//if($result["codigo_retorno"] == "001"){
					}else{//}//}else{//if($result["codigo_retorno"] == "001"){
						$valida = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível comunicar com o sistema biométrico.');
					}
					
					if($valida != ""){					
						$cMSG->addMSG("ERRO",$valida);
					}
					
					fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array($status_a,time()),"id = '".$linha["id"]."'");
				}//if($completo >= "1"){
			}
			*/

		}//if($nome == "" and $code != ""){
		
		//buscar nome do candidato
		/*
		if($nome == "" and $candidato_fisico_id >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("nome","cad_candidato_fisico","id = '$candidato_fisico_id'");
			$nome = $linha["nome"];
		}//if($nome == "" and $candidato_fisico_id >= "1"){
		*/
			
		if($valida == ""){
			$servico_id = categoriaServicoIDSENHA($tipo_servico);
			$senha = fSENHA::gerarSenha($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$servico_id,$prioridade,$nome);
			
			//prioridade
			if($prioridade != "1"){ $senha = "P".soNumero($senha); }
			//GET SENHA - GET SENHA - GET SENHA - GET SENHA - GET SENHA - GET SENHA		
			
			//if($candidato_fisico_id >= "1"){ $nome = ""; }
			
			$id_a = fSQL::SQL_SELECT_INSERT("axl_triagem");
			$campos = "id,origem_id,pgto_num,pgto_id,code,tipo_pessoa,tipo_servico,candidato_fisico_id,candidato_juridico_id,nome,senha,senha_prioridade,senha_imp,status,user,time,user_a,sync";
			$valores = array($id_a,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$pgto_num,$pgto_id,$code,$tipo_pessoa,$tipo_servico,$candidato_fisico_id,$candidato_juridico_id,$nome,$senha,$prioridade,$_SESSION["impressora_pc"],"0",$cVLogin->userReg(),time(),"0",time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_triagem",$valores);
			
			//usar o pagamento
			if($pgto_id >= "1"){ 
				fSQL::SQL_UPDATE_SIMPLES("status,triagem_id,sync","axl_pgto_banco",array("1",$id_a,time()),"id = '$pgto_id'");	
			}
			
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Senha gerada').": ".$senha." (".legPrioridade($prioridade).")".$msg_ws);
			//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
			$cMSG->imprimirMSG();//imprimir mensagens criadas			
		}
		$tipo_pessoa = ""; $tipo_servico = ""; $pgto_num = ""; $code = ""; $candidato_fisico_id = ""; $candidato_juridico_id = ""; $prioridade = ""; $candidato = "";			
	}//if(isset($_GET["salvar"]){
	
	
	
	
	if(isset($_GET["naocompareceu"])){
		$senha = getpost_sql($_GET["naocompareceu"]);
		//echo "<br>SENHA:".$senha;
		$linha = fSQL::SQL_SELECT_ONE("*","axl_triagem","senha = '".$senha."' AND origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'");
		if($linha["id"] >= "1"){
			
			//buscar candidato no processo
			$nome = $linha["nome"];
			$candidato_fisico_id = $linha["candidato_fisico_id"];
			
			$servico_id = categoriaServicoIDSENHA($linha["tipo_servico"]);
			$senha_nova = fSENHA::gerarSenha($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$servico_id,"2",$nome,$senha);
			
			$senha_nova = "P".soNumero($senha_nova);
		
			$id_a = fSQL::SQL_SELECT_INSERT("axl_triagem");
			$campos = "id,origem_id,pgto_num,pgto_id,code,tipo_pessoa,tipo_servico,candidato_fisico_id,candidato_juridico_id,nome,senha,senha_prioridade,senha_imp,status,user,time,user_a,sync";
			$valores = array($id_a,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$linha["pgto_num"],$linha["pgto_id"],$linha["code"],$linha["tipo_pessoa"],$linha["tipo_servico"],$candidato_fisico_id,$linha["candidato_juridico_id"],$nome,$senha_nova,"2",$_SESSION["impressora_pc"],"0",$cVLogin->userReg(),time(),"0",time());
			fSQL::SQL_INSERT_SIMPLES($campos,"axl_triagem",$valores);

			//cancelar senha anterior
			fSENHA::acao($cVLogin->getVarLogin("SYS_USER_ID"),$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$servico_id,$senha,"6");
			
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Nova senha prioritaria gerada').": ".$senha_nova." (".legPrioridade("2").")");
			//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
			$cMSG->imprimirMSG();//imprimir mensagens criadas			
			$tipo_pessoa = ""; $tipo_servico = ""; $pgto_num = ""; $code = ""; $candidato_fisico_id = ""; $candidato_juridico_id = ""; $prioridade = "";								
			echo "<script>$(document).ready(function(e) { pmodalDisplay('fecha'); });</script>";
		}///if($linha["id"] >= "1"){
	}//if(isset($_GET["naocompareceu"])){
	
	
	
	
		
	$passo = "1";
	if($tipo_pessoa != "" and $tipo_servico == ""){ $passo = "2"; }
	if($tipo_servico != ""){ $passo = "3"; }		
	
	if($tipo_pessoa == "fisico"){ $tipo_pessoa_n = "<i class='icon-user'></i> ".$class_fLNG->txt(__FILE__,__LINE__,'Atendimento Condutor'); }
	if($tipo_pessoa == "juridico"){ $tipo_pessoa_n = "<i class='icon-building'></i> ".$class_fLNG->txt(__FILE__,__LINE__,'Jurídico'); }		
		
	
	//id temp para registro de array
	$array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;	
	
	$mostra_opcao_senha = "0";
	$result = fSENHA::listaNaoCompareceu($cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"));
	if(ceil(count($result)) >= "1"){ $mostra_opcao_senha = "1"; }
	
	/////////// INCLUDE JS EXCLUSIVO --------------------- 
	$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
	$INC_JSCSS = $INC_FAISHER["div"];
	include "inc/inc_js-exclusivo.php";	
	
?>

<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-column form-bordered form-validate' enctype='multipart/form-data'>
<input type="hidden" id="tipo_pessoa" name="tipo_pessoa" value="<?=$tipo_pessoa?>" />
<input type="hidden" id="tipo_servico" name="tipo_servico" value="<?=$tipo_servico?>" />
<div class="control-group">


<?php if($passo == "3"){?>
    <ul class="tabs tabs-inline tabs-top" style="float:left;">
    	<li class="active" id="tab_pagamento<?=$INC_FAISHER["div"]?>"><a id="li_tab_pagamento" href="#tab_pagamento" <?php if($tipo_servico != "reclamacao" && $tipo_servico != "retirada"){ echo "data-toggle='tab'"; }?>><?=$class_fLNG->txt(__FILE__,__LINE__,'Triagem por PAGAMENTO/CANDIDATO')?></a></li>
        <li class="" id="tab_processo<?=$INC_FAISHER["div"]?>"><a id="li_tab_processo" href="#tab_processo" <?php if($tipo_servico != "info"){ echo "data-toggle='tab'"; }?>><?=$class_fLNG->txt(__FILE__,__LINE__,'Triagem por PROCESSO')?></a></li>
    </ul>
<?php }//if($passo == "3"){?>

<?php if($mostra_opcao_senha == "1"){?> <span style="float:right;"><button type="button" class="btn btn-primary" onclick="pmodalHtml('<i class=icon-reorder></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'NÃO COMPARECEU')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=verNaoCompareceu');"><i class="icon-reorder"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Ver Senhas "Não Compareceu"')?></button></span><?php }?>
	<h6 style="float:right;"><button type="button" class="btn btn-default" onclick="docHelp<?=$INC_FAISHER["div"]?>();"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Requisitos de Atendimento')?></button> <?=$class_fLNG->txt(__FILE__,__LINE__,'Guichê/Mesa')?>: <?=$_SESSION["guiche"]?> <button type="button" class="btn btn-icon-only btn-mini btn-default" onclick="selGuiche<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-retweet"></i></button></h6>
    
</div>
<?php if($passo == "1"){?>
	<div class="form-actions">
    	<h3><?=$class_fLNG->txt(__FILE__,__LINE__,'Qual tipo de serviço?')?></h3>
        <ul class="tiles">
        	<li class="blue long">
            	<a href="#" onclick="tipoPessoa<?=$INC_FAISHER["div"]?>('fisico');return false;"><span><i class="icon-user"></i></span><span class="name"><?=$class_fLNG->txt(__FILE__,__LINE__,'Atendimento Condutor')?></span></a>
            </li>
        	<li class="lightgrey long" style="display:none;">
            	<a href="#" onclick=""><span><i class="icon-building"></i></span><span class="name"><?=$class_fLNG->txt(__FILE__,__LINE__,'Jurídico')?></span></a>
            </li>            
        </ul>
    </div>
<?php }//if($passo == ""){?>





<?php if($passo == "2"){?>
	<div class="form-actions">
    	<h6><i class="icon-ok"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Qual tipo de serviço?')?> <?=$tipo_pessoa_n?></h6>
    	<h3><?=$class_fLNG->txt(__FILE__,__LINE__,'Qual o serviço solicitado?')?> </h3>
        <button type="button" class="btn btn-small" onclick="voltar<?=$INC_FAISHER["div"]?>('pessoa');return false;"><i class="icon-arrow-left"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'voltar')?></button>
        <ul class="tiles">
<?php 
$array = categoriaServicoArr($tipo_pessoa);
foreach($array as $tipo){
	if($tipo == "veiculo" || $tipo == "coleta"){ continue; }	//removido temporariamente
	$leg = categoriaServicoLeg($tipo);
	$icon = categoriaServicoIco($tipo);
?>
        	<li class="<?php if($tipo != "veiculo"){ echo 'blue'; }else{ echo 'lightgrey'; }?> long">
            	<a href="#" onclick="<?php if($tipo != "veiculo"){?>tipoServico<?=$INC_FAISHER["div"]?>('<?=$tipo?>');return false;<?php }?>"><span><i class="<?=$icon?>"></i></span><span class="name"><?=$leg?></span></a>
            </li>
<?php
}
?>
        </ul>        
    </div>
<script>
$(document).ready(function(e) {
    docHelp<?=$INC_FAISHER["div"]?>();
});
</script>    
<?php }//if($passo == ""){?>






<?php if($passo == "3"){?>


	<div class="tab-content tab-content-inline tab-content-bottom">
    	
        
        
        
        <div class="tab-pane active" id="tab_pagamento">


            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo de Serviço')?></label>
                <div class="controls display-plus">
                  <p class="help-block"><?=$tipo_pessoa_n?> <button type="button" class="btn btn-small" onclick="voltar<?=$INC_FAISHER["div"]?>('pessoa');return false;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'alterar')?></button></p>
                  <p class="help-block"></p>
                </div>
            </div>   
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Serviço')?></label>
                <div class="controls display-plus">
                  <p class="help-block"><i class="<?=categoriaServicoIco($tipo_servico)?>"></i> <?=maiusculo(categoriaServicoLeg($tipo_servico))?> <button type="button" class="btn btn-small" onclick="voltar<?=$INC_FAISHER["div"]?>('servico');return false;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'alterar')?></button></p>
                </div>
            </div>       
    

    
    
    		
            <div class="control-group row-fluid">
            <div class="span6">
                <div class="control-group">
<?php if($tipo_pessoa == "fisico"){?>
                    <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato')?></label>
                    <div class="controls">
                        <input type="text" name="candidato" id="candidato" value="<?=$candidato?>" class="span12 cssFonteMai">
<script>
$(document).ready(function(e) {
	//só texto
	$("#candidato").keypress(function(e){
		var key = (e.keyCode?e.keyCode:e.which);
	    key = String.fromCharCode( key );
	    //var regex = /^[0-9.,]+$/;
	    var regex = /^[0-9.]+$/;
	    if(regex.test(key)){
		    e.returnValue = false;
		    if(e.preventDefault) e.preventDefault();
	    }		
	});
});
</script>                        
        <!--              <input type="hidden" name="candidato_fisico_id" id="candidato_fisico_id" value="" class="span12 cssFonteMai" />            
<script>
$(document).ready(function(e) {
	//dados de combobox
	$("#<?=$formCadastroPincipal?> #candidato_fisico_id").select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar um candidato >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatofisicoTriagem<?php if(!isset($_GET["POP"])){ echo "&add"; }?>&scriptoff",
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
});	
</script>        
-->    
            		</div>
<?php }else{//if($tipo_pessoa == "fisico"){?>            
                    <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Candidato jurídico')?></label>
                    <div class="controls">
                      <input type="hidden" name="candidato_juridico_id" id="candidato_juridico_id" value="" class="span12 cssFonteMai" />            
<script>
$(document).ready(function(e) {
	//dados de combobox
	$("#<?=$formCadastroPincipal?> #candidato_juridico_id").select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar um candidato jurídico >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatojuridicoTriagem<?php if(!isset($_GET["POP"])){ echo "&add"; }?>&scriptoff",
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
});	
</script>            
            		</div>
<?php }//else{//if($tipo_pessoa == "fisico"){?>            
                </div>  
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Prioridade')?></label>
                    <div class="controls">
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input name="prioridade" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="prioridade1" value="1" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="prioridade1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Normal')?></label>
                          </div>
                        </div>
                        <div class="check-demo-col">
                            <div class="check-line">
                                <input name="prioridade" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="prioridade5" value="5" data-skin="square" data-color="blue"> <label class='inline' for="prioridade5"><?=$class_fLNG->txt(__FILE__,__LINE__,'Prioritário')?></label>
                          </div>
                        </div>
                    </div>
                </div>
            </div>    
            </div>

<?php if($tipo_servico == "habilitacao" || $tipo_servico == "veiculo"){?>
			<div class="control-group row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº Pagamento')?></label>
                    <div class="controls">
                      <input type="text" name="pgto_num" id="pgto_num" value="<?=$pgto_num_a?>" class="span11 cssFonteMai">
                    </div>
                </div>
            </div>
            </div> 
<?php }//if($servico == "habilitacao" || $servico == "veiculo"){?>                
            
        </div>
        <!-- fim .tab_pagamento -->
        
        
    	<div class="tab-pane" id="tab_processo">

            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo de Serviço')?></label>
                <div class="controls display-plus">
                  <p class="help-block"><?=$tipo_pessoa_n?> <button type="button" class="btn btn-small" onclick="voltar<?=$INC_FAISHER["div"]?>('pessoa');return false;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'alterar')?></button></p>
                  <p class="help-block"></p>
                </div>
            </div>   
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Serviço')?></label>
                <div class="controls display-plus">
                  <p class="help-block"><i class="<?=categoriaServicoIco($tipo_servico)?>"></i> <?=maiusculo(categoriaServicoLeg($tipo_servico))?> <button type="button" class="btn btn-small" onclick="voltar<?=$INC_FAISHER["div"]?>('servico');return false;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'alterar')?></button></p>
                </div>
            </div> 

			<div class="control-group row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº')?> <?=SYS_CONFIG_PROCESSO_SIGLA?></label>
                    <div class="controls">
                      <input type="hidden" name="code" id="code" value="" class="span12 cssFonteMai" />            
<script>
$(document).ready(function(e) {
	//dados de combobox
	$("#<?=$formCadastroPincipal?> #code").select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: '<?=$class_fLNG->txt(__FILE__,__LINE__,'Selecionar um processo >> (comece a digitar para buscar)')?>',
		ajax: {
			url: "geral/combo_ajax.php?ajax=comboProcesso&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					tipo: '<?=$tipo_pessoa?>',
					status: '<?php if($tipo_servico == 'reclamacao') { echo '5'; }else if($tipo_servico == "retirada"){ echo '4'; }else{ echo '0';} ?>'
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
						 <p class="help-block"><?=$class_fLNG->txt(__FILE__,__LINE__,'Para localizar o processo é necessário possui o nº RNC correto!')?></p>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Não possui o nº RNC do processo?')?></label>
                    <div class="controls">
						<button type="button" class="btn btn-info" onClick="consultarProcessos<?=$INC_FAISHER["div"]?>();return false;"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Consulte aqui!')?></button>             
                    </div>
                </div>
            </div>            
            </div> 
            <?php if ($tipo_servico == "reclamacao"){?>
            <div class="control-group" id="div_reclamacao<?=$INC_FAISHER["div"]?>">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo de reclamação')?></label>
                <div class="controls">
                    <div class="check-line">
                        <input name="reclamacao_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="reclamacao_tipo1" value="1" data-skin="square" data-color="blue"> <label class='inline' for="reclamacao_tipo1"><?=$class_fLNG->txt(__FILE__,__LINE__,'Biométrico (foto)')?></label>
                    </div>
                    <!--
                    <div class="check-line">
                        <input name="reclamacao_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="reclamacao_tipo2" value="2" data-skin="square" data-color="blue"> <label class='inline' for="reclamacao_tipo2"><?=$class_fLNG->txt(__FILE__,__LINE__,'Biográfico (dados)')?></label>
                    </div>
                    <div class="check-line">
                        <input name="reclamacao_tipo" type="radio" class='<?=$INC_FAISHER["div"]?>-icheck' id="reclamacao_tipo3" value="3" data-skin="square" data-color="blue"> <label class='inline' for="reclamacao_tipo3"><?=$class_fLNG->txt(__FILE__,__LINE__,'Biométrico (foto) + Biográfico (dados)')?></label>
                    </div>                    
                    -->
                    <div style="clear:both; height:5px;"></div>
                </div>
            </div>            
            <?php }//if ($tipo_servico == "reclamacao"){?>            

        
        </div>        
        <!-- fim .tab_processo -->
        
            <div class="form-actions">
                <button type="button" class="btn btn-large btn-primary" onclick="pesquisar<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Pesquisar')?></button>
            </div>          
    
    </div>
    <!-- fim .tab_content -->

<script>
$(document).ready(function(e) {
<?php if($tipo_servico == "reclamacao" || $tipo_servico == "coleta" || $tipo_servico == "retirada"){?>	
	$("#li_tab_processo").click();
<?php }else{//if($tipo_servico == "reclamacao"){?>		
	$("#li_tab_pagamento").click();
<?php }//else{//if($tipo_servico == "reclamacao"){?>		
});
</script>                                    


    
<?php }//if($passo == "3"){?>


                                      

	<div class="form-actions" id="divPesquisa_lista<?=$INC_FAISHER["div"]?>">
    </div>

</form>
<script>
$(document).ready(function(e) {
<?php if(!isset($_SESSION["guiche"])){?>
	selGuiche<?=$INC_FAISHER["div"]?>();
<?php }//if(!isset($_SESSION["guiche"])){?>	
});

function docHelp<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-info-sign></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'REQUISITOS DE ATENDIMENTO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=docHelp&');	
}

function selGuiche<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=glyphicon-print></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'SELECIONAR GUICHÊ/MESA')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=selGuiche&');	    
}

function consultarProcessos<?=$INC_FAISHER["div"]?>(){
	pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'CONSULTAR PROCESSO DO CANDIDATO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=consultarProcessos&array_temp=<?=$array_temp?>&triagem_tipo_servico=<?=$tipo_servico?>');	    
}

function tipoPessoa<?=$INC_FAISHER["div"]?>(v_tipo){

<?php if(!isset($_SESSION["guiche"])){?>
	selGuiche<?=$INC_FAISHER["div"]?>();
	return;
<?php }//if(!isset($_SESSION["guiche"])){?>		
	
	v_get = "&tipo_pessoa="+v_tipo;
	
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//tipoServico

function tipoServico<?=$INC_FAISHER["div"]?>(v_tipo){
	v_get = "&tipo_pessoa="+$("#<?=$formCadastroPincipal?> #tipo_pessoa").val()+"&tipo_servico="+v_tipo;
	
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');
}//tipoServico

function voltar<?=$INC_FAISHER["div"]?>(v_tipo){

	if(v_tipo == 'pessoa'){
		$("#<?=$formCadastroPincipal?> #tipo_pessoa").val("");
		$("#<?=$formCadastroPincipal?> #tipo_servico").val("");		
	}
	if(v_tipo == 'servico'){
		$("#<?=$formCadastroPincipal?> #tipo_servico").val("");		
	}	
	
	$("#<?=$formCadastroPincipal?> #pgto_num").val("");		
	$("#<?=$formCadastroPincipal?> #code").select2("data", "");			
	$("#<?=$formCadastroPincipal?> #candidato").val("");
	//$("#<?=$formCadastroPincipal?> #candidato_fisico_id").select2("data", "");			
	$("#<?=$formCadastroPincipal?> #candidato_juridico_id").select2("data", "");		
	
	$("#divPesquisa_lista<?=$INC_FAISHER["div"]?>").html("");
	
	v_get = "&tipo_pessoa="+$("#<?=$formCadastroPincipal?> #tipo_pessoa").val()+"&tipo_servico="+$("#<?=$formCadastroPincipal?> #tipo_servico").val();
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=lista&'+v_get, 'get', 'ADD');	
}//voltar

function pesquisar<?=$INC_FAISHER["div"]?>(){

	var tipo_pessoa = $("#<?=$formCadastroPincipal?> #tipo_pessoa").val();
	var tipo_servico = $("#<?=$formCadastroPincipal?> #tipo_servico").val();	
	var pgto_num = $("#<?=$formCadastroPincipal?> #pgto_num").val();	
	var code = $("#<?=$formCadastroPincipal?> #code").val();
	var candidato = $("#<?=$formCadastroPincipal?> #candidato").val();		
	var prioridade = $("#<?=$formCadastroPincipal?> input[name='prioridade']:checked").val();				
	var reclamacao_tipo = $("#<?=$formCadastroPincipal?> input[name='reclamacao_tipo']:checked").val();				

	if(pgto_num == null){ pgto_num = ""; }
	if(candidato == null){ candidato = ""; }
	if(reclamacao_tipo == null){ reclamacao_tipo = ""; }
	//if(candidato_fisico_id == null){ candidato_fisico_id = ""; }
	//verificar campos obrigatorios	
	var valida = "";
	//verificar pagamento
	if(tipo_servico == "habilitacao" || tipo_servico == "veiculo"){
		if(pgto_num == ""){ valida = "- <?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o nº do pagamento, verifique!')?>"; }
	}else if(tipo_servico == "coleta" || tipo_servico == 'reclamacao' || tipo_servico == 'retirada'){
		if(code == "" && code.length != "11"){ valida = "- <?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o nº do processo, verifique!')?>"; }
	}

	if(tipo_servico != 'reclamacao' && tipo_servico != 'retirada'){
		if(tipo_pessoa == "fisico"){
			if(candidato == ""){ if(valida != ""){ valida += "\n"; } valida += "- <?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o candidato, verifique!')?>"; }
			//if(candidato_fisico_id == ""){ if(valida != ""){ valida += "\n"; } valida += "- <?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o candidato, verifique!')?>"; }
		}else{
			//if(candidato_juridico_id == ""){ if(valida != ""){ valida += "\n"; } valida += "- <?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o candidato, verifique!')?>"; }
		}
	}

	if(code != ""){ valida = ""; }//processo ja tem candidato e pagamento

	if(tipo_servico == "reclamacao"){
		if(reclamacao_tipo == ""){ valida = "- <?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o tipo de reclamação!')?>"; }
	}else{//if(tipo_servico == "reclamacao"){
		reclamacao_tipo = "";
	}

	
	

	if(valida != ""){ alert(valida); }else{
		v_get = "&tipo_pessoa="+tipo_pessoa+"&tipo_servico="+tipo_servico+"&pgto_num="+pgto_num+"&code="+code+"&candidato="+candidato+"&prioridade="+prioridade+"&reclamacao_tipo="+reclamacao_tipo;
		//v_get = "&tipo_pessoa="+tipo_pessoa+"&tipo_servico="+tipo_servico+"&pgto_num="+pgto_num+"&code="+code+"&candidato_fisico_id="+candidato_fisico_id+"&candidato_juridico_id="+candidato_juridico_id+"&prioridade="+prioridade;
		
		loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando...')?>');//cria um loader dinamico
		faisher_ajax('divPesquisa_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=consultarDados&form=<?=$formCadastroPincipal?>&'+v_get, 'get', 'ADD');		
	}
}//pesquisar
</script>



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