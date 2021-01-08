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

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','Filtrando dados...');//cria um loader dinamico
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
	</div><!-- End .span6 -->
	<div class="span12">
    	<div class="form-actions"></div>
    	<div class="span6">
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_RM_SIGLA?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="rnt_b" id="rnt_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_RM_SIGLA))?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
            </div>
        </div>        
        </div>
        <div class="span6">
        <div class="control-group" id="div_rnc_b">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Nº ')?> <?=SYS_CONFIG_PROCESSO_SIGLA?></label>
            <div class="controls">
                <div class="input-append"><input type="text" name="rnc_b" id="rnc_b" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Informe o !!sigla!!',array("sigla"=>SYS_CONFIG_PROCESSO_SIGLA))?>" class="input-xlarge"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Limpar')?>"><i class="icon-trash"></i></button></div>
            </div>
        </div>            
        </div>
    </div>

    
	<div class="span12">
		<div class="form-actions">
			<button type="button" class="btn btn-primary enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar agora')?></button>
			<button type="button" class="btn" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');$('#dAbusca<?=$INC_FAISHER["div"]?> .bt_expandebusca').click();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar/Ocultar')?></button>
		</div>
	</div>
</form>
<?php	
	

}//fim ajax  -------------------------------------------- <<<


































if($ajax == "salvarOrientacao"){
	$coleta_id = getpost_sql($_GET["coleta_id"]);
	$abis_id = getpost_sql($_GET["abis_id"]);
	$orientacao = str_replace('[br]','<br>',getpost_sql($_GET["orientacao"]));
	
	$valores = array($orientacao,time());
	fSQL::SQL_UPDATE_SIMPLES("governo_obs,sync","axl_abis_problemas",$valores,"id = '".$abis_id."'");
	$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Orientação governamental salva com sucesso!'));
	
	fSQL::SQL_UPDATE_SIMPLES("governo_status","axl_coleta_biometrica",array("1"),"id = '".$coleta_id."'");
?>
<script>
$(document).ready(function(e) {
	displayAcao<?=$INC_FAISHER["div"]?>('fecha');    
	exibNotificacao("<?=$class_fLNG->txt(__FILE__,__LINE__,'SUCESSO')?>","<?=$class_fLNG->txt(__FILE__,__LINE__,'Orientação governamental salva com sucesso!')?>");
	carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&tab_id=0');	
});
</script>	
<?php	
}//if($ajax == "salvarOrientacao"){



































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
            	<?=$button?>
            </div>                              
                            
</form>
<?php	
}//detalhesCandidato





































if($ajax == "detalhesProcesso"){
	$id_a = $_GET["id"];
	

	if(isset($_GET["cancelamento_suspensao_id"])){
		$acao = getpost_sql($_GET["acao"]);
		$cancelamento_suspensao_id = getpost_sql($_GET["cancelamento_suspensao_id"]);
		$status = getpost_sql($_GET["status"]);
		$obs_geral = getpost_sql($_GET["obs_geral"]);				

		$campos = "status,obs_geral,user_a,sync";
		$valores = array($status,$obs_geral,$cVLogin->userReg(),time());
		fSQL::SQL_UPDATE_SIMPLES($campos,"axl_cancelamento_suspensao",$valores,"id = '".$cancelamento_suspensao_id."'");

		$campos = "user_a,sync";
		$valores = array($cVLogin->userReg(),time());
		if($acao == 2){//cancelamento
			$campos .= ",status";
			$valores[] = 6;
		}		
		$linha = fSQL::SQL_SELECT_ONE("candidato_id,data_c,data_p","axl_cancelamento_suspensao","id = '".$cancelamento_suspensao_id."'");				
		if($linha["data_p"] >= "1" and $acao == "1"){//suspender processo
			$campos .= ",suspensao_i,suspensao_f";
			$valores[] = time();
			$valores[] = $linha["data_p"];
		}

		fSQL::SQL_UPDATE_SIMPLES($campos,"axl_processo",$valores,"id = '".$id_a."'");

		//suspender candidato
		fSQL::SQL_UPDATE_SIMPLES("suspensao_i,suspensao_f","cad_candidato_fisico",array(time(),$linha["data_c"]),"id = '".$linha["candidato_id"]."'");
		
		$status_leg = $class_fLNG->txt(__FILE__,__LINE__,'APROVADO');
		if($status == "2"){ 
			$status_leg = $class_fLNG->txt(__FILE__,__LINE__,'NEGADO'); 
			$linha = fSQL::SQL_SELECT_ONE("coleta_id,servico_id","axl_processo","id = '".$id_a."'");
			$servico_id = $linha["servico_id"];
			$coleta_id = $linha["coleta_id"];
			//verificar se processo completo - autorizar impressão
			$linha = fSQL::SQL_SELECT_ONE("informacoes","adm_protocolo_tipo","id = '".$servico_id."'");
			$informacoes = arrayDB($linha["informacoes"]);

			$valida = 1;
			//monta array
			unset($array); $array = explode(".",$informacoes);
			$cont_ARRAY = ceil(count($array));
			//listar item ja cadastrados
			if($cont_ARRAY >= "1"){
				foreach ($array as $pos => $tipo_id){
					$linhaxxx = fSQL::SQL_SELECT_ONE("id,obrigatorio","adm_protocolo_tipo_inf","id = '".$tipo_id."'");							
					if($linhaxxx["obrigatorio"] == "1"){
						$cont = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$id_a."' AND tipo_id = '".$tipo_id."'");
						if($cont <= "0"){ $valida = "0"; break; }
					}//if($linhaxxx["obrigatorio"] == "1"){
				}//foreach ($array as $pos => $tipo_id){
			}//if($cont_ARRAY >= "1"){
			if($valida == "1"){
				if($coleta_id <= "0"){ $valida = "0"; }else{//if($coleta_id <= "0"){
					$linha = fSQL::SQL_SELECT_ONE("abis_status","axl_coleta_biometrica","id = '".$coleta_id."'");
					if($linha["abis_status"] != "1"){ $valida = "0"; }
				}//}else{//if($coleta_id <= "0"){
			}//if($valida == "1"){
		
			//autorizar impressão
			$msg_ws = "";
			if($valida == "1"){
				$result = thomasWSimpressaoEnviar($id_a);
				if($result["codigo_retorno"] == "1"){ 
					fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização para Impressão'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$id_a,"");	
				}
			}			
			
		}
		
		

		fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Análise de Solicitação de !!tipo!!',array("tipo"=>acaoProcessoLeg($acao))),$status_leg,$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$id_a);


		
		$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Solicitação de !!tipo!! analisada. Resultado: !!result!!',array("acao"=>acaoProcessoLeg($acao),"result"=>"<b>".$status_leg."</b>")));	
	}//if(isset($_GET["cancelamento_suspensao_id"])){
	
	
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
	if($status_a == "10" and $cancelamento_suspensao_id_a >= "1"){
		$linha = fSQL::SQL_SELECT_ONE("data_p","axl_cancelamento_suspensao","id = '".$cancelamento_suspensao_id_a."'");
		$status_n = "<br>".$class_fLNG->txt(__FILE__,__LINE__,'SUSPENSO ATÉ:')." ".date("d/m/Y",$linha["data_p"]);
	}//if($status_a == "10" and $cancelamento_suspensao_id_a >= "1"){

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
			$motivo_id_n .= " - ".$linha["descricao"];
		}
	}//if($motivo_id_a >= "1"){

	$processo_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$ano."/".completa_zero($mes,"2")."/".completa_zero($dia,"2")."/".$code."/";
	
	$eventosArray = fPROCESSO::getEventos($id_a,$processo_dir,"0","","30");//getEventos() - CARREGA ARRAY DE EVENTOS	
	$processo_dir .= "files/";
	
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
	
	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){
		if($coleta_abis_status >= "2" and $coleta_abis_status_acao == "0"){//VERIFICAR STATUS ABIS
			$status_n .= "<br><small style='color:red;'><i>".$class_fLNG->txt(__FILE__,__LINE__,'PROBLEMA: ABIS')." - ".legABIS($coleta_abis_status)."</i></small>";	
			$button = '<a href="#" class="btn btn-warning btn-large" onclick="janelaAcao'.$INC_FAISHER["div"].'(\'registro\',\'id_a='.$id_a.'\');$(\'#pModal\').modal(\'hide\');return false;"><i class="glyphicon-search"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Analisar ABIS').'</a>';
		}//if($status == "2"){
	}


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
							$button = "";
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
                    <?php if($linhaxxx["status"] == "0"){?>
						<a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DA SOLICITAÇÃO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesAcao&id=<?=$cancelamento_suspensao_id_a?>');return false;" class="btn btn-default"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Analisar')?></a>                  
                  <?php }//if($linhaxxx["status"] == "0"){?>                  
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
            	<?=$button?>
            </div>                              
                            
</form>
<?php	
}//detalhesProcesso
































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
                  <?=SYS_CONFIG_PROCESSO_SIGLA?> <?=$arrPro["code"]?> - <?=$servico_id_n?> <a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO')?> #<?=$arrPro["code"]?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesProcesso&id=<?=$arrCP["processo_id"]?>');return false;" class="btn btn-default"><i class="icon-search"></i></a>
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo')?></label>
                <div class="controls ">
                  <?=motivoCancelamento($arrCP["motivo"])?>
                  <?php if($arrCP["motivo_descricao"] != ""){?> <br><i><?=$arrCP["motivo_descricao"]?></i> <?php } ?>
                </div>
            </div>    
            <?php if($arrCP["data_p"] != ""){?>
            <div class="control-group">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Suspensão do processo')?></label>
                <div class="controls">
                	<?php if($arrCP["data_p"] == "99999999"){?> <?=$class_fLNG->txt(__FILE__,__LINE__,'Indeterminado')?> <?php }else{?> <?=date("d/m/Y",$arrCP["data_p"])?> <?php } ?>
                </div>
            </div>    
            <?php }//if($arrCP["data_p"] != ""){?>                  
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
                      
		<?php if($arrCP["status"] == "0"){?>
        <div class="control-group">
            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Observação')?></label>
            <div class="controls">
                <textarea name="obs_geral" id="obs_geral" rows="3" class="input-block-level cssFonteMai" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Observação')?>"></textarea>
                <p class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Campo <b>obrigatório</b> caso resultado da análise seja <b>NEGAR</b>.')?></p>
            </div>
        </div>        
            <div class="control-group" id="divdiv_senha">
                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Confirme sua senha de acesso para prosseguir')?></label>
                <div class="controls" id="div_senha">
                    <input type="password" name="senha" id="senha" class="form-control"/>
                    <button type="button" class="btn btn-info" onclick="validarSenha<?=$INC_FAISHER["div"]?>();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Validar Senha')?></button>
                </div>
            </div>                              
		<?php }//if($arrCP["status"] == "0"){?>                            
                   
            <div class="form-actions">
            <?php if($arrCP["status"] == "0"){?>
            	<button type="button" class="btn btn-large btn-success" onclick="resultadoSolicitacao<?=$INC_FAISHER["div"]?>('1');return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Aprovar')?></button>
            	<button type="button" class="btn btn-large btn-danger" onclick="resultadoSolicitacao<?=$INC_FAISHER["div"]?>('2');return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Negar')?></button>                
            <?php }//if($arrCP["status"] == "0"){?>            
            	<button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
            </div>                              
                            
</form>
<script>
function validarSenha<?=$INC_FAISHER["div"]?>(){
	v_get = $("#senha").val();
	
	loaderFoco('divdiv_senha','divdiv_senha_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Verificando...')?>');//cria um loader dinamico
	faisher_ajax('div_senha', 'divdiv_senha_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=validarSenha&senha='+v_get, 'get', 'ADD');
}//validarSenha

function resultadoSolicitacao<?=$INC_FAISHER["div"]?>(v_status){
	v_valida_senha = $("#valida_senha").val();
	v_obs_geral = $("#obs_geral").val();
	
	valida = "";
	if(v_valida_senha == null){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Senha não foi validada, verifique!')?>"; }
	if(v_status == "2" && v_obs_geral == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Observação é obrigatória em caso de negar a solicitação, preencha corretamente!')?>"; }
	
	if(valida != ""){ alert(valida); }else{//if(v_motivo_cancelamento){
		v_leg = "<?=$class_fLNG->txt(__FILE__,__LINE__,'APROVAR SOLICITAÇÃO')?>";
		if(v_status == "2"){ v_leg = "<?=$class_fLNG->txt(__FILE__,__LINE__,'NEGAR SOLICITAÇÃO')?>"; }
		
		if(confirm('<?=$class_fLNG->txt(__FILE__,__LINE__,'Deseja realmente confirmar análise? Resultado:')?> '+v_leg)) {
			v_get = "&acao=<?=$arrCP["acao"]?>&cancelamento_suspensao_id=<?=$id_a?>&id=<?=$arrCP["processo_id"]?>&status="+v_status+"&obs_geral="+v_obs_geral;
			pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO')?> #<?=$arrPro["code"]?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesProcesso&id=<?=$arrCP["processo_id"]?>&'+v_get);
			//pmodal detalhesProcesso
			//atualizarLista<?=$INC_FAISHER["div"]?>('<?=$acao?>','<?=$processo_id?>',v_motivo_cancelamento);
			carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&tab_id=3&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val()+'&');
		}		

	}//}else{//if(v_motivo_cancelamento){	
}//resultadoSolicitacao
</script>
<?php	
}//detalhesAcao















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




























if($ajax == "cancelarAcao"){
	//ini_set('display_errors',1);ini_set('display_startup_erros',1);error_reporting(E_ALL);
	$acao = getpost_sql($_GET["acao"]);
	$processo_id = getpost_sql($_GET["processo_id"]);

	
	$titulo = $class_fLNG->txt(__FILE__,__LINE__,'Motivo de cancelamento'); $leg = $class_fLNG->txt(__FILE__,__LINE__,'Cancelar processo');
	if($acao == "suspender"){ 
		$class_fLNG->txt(__FILE__,__LINE__,'Motivo de suspensão'); 
		$bt_leg = $class_fLNG->txt(__FILE__,__LINE__,'Suspender processo');
	}//if($acao == "suspender"){ 
	
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$form = "formBusc".$array_temp;	
?>
<form action="#" id="<?=$form?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">

        <div class="control-group">
            <label class="control-label"><?=$titulo?></label>
            <div class="controls">
                <textarea name="motivo_cancelamento" id="motivo_cancelamento" rows="3" class="input-block-level cssFonteMai" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Motivo')?>"></textarea>
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
            <button type="button" class="btn btn-large btn-primary" onclick="cancelar<?=$INC_FAISHER["div"]?>();return false;"><?=$leg?></button>
            <button type="button" class="btn btn-large" onclick="pmodalDisplay('hide')"><?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar')?></button>
		</div>        

</form>
<script>
function validarSenha<?=$INC_FAISHER["div"]?>(){
	v_get = $("#senha").val();
	loaderFoco('divdiv_senha','divdiv_senha_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Validando...')?>');//cria um loader dinamico
	faisher_ajax('div_senha', 'divdiv_senha_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=validarSenha&senha='+v_get, 'get', 'ADD');
}//validarSenha
function cancelar<?=$INC_FAISHER["div"]?>(){
	v_motivo_cancelamento = $("#motivo_cancelamento").val();
	v_valida_senha = $("#valida_senha").val();
	
	valida = "";
	if(v_motivo_cancelamento == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Necessário informar o motivo, verifique!')?>"; }
	if(v_valida_senha == null && valida == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Senha não foi validada, verifique!')?>"; }
	
	if(valida != ""){ alert(valida); }else{//if(v_motivo_cancelamento){
		return;
		pmodalDisplay('hide'); 
		atualizarLista<?=$INC_FAISHER["div"]?>('<?=$acao?>','<?=$processo_id?>',v_motivo_cancelamento);
	}//}else{//if(v_motivo_cancelamento){
}//cancelar
</script>
<?php	
}//if($ajax == "cancelarAcao"){






























if($ajax == "listaABIS"){
	$array_temp = getpost_sql($_GET["array_temp"]);
	$processo_id = getpost_sql($_GET["processo_id"]);	
	$coleta_id = getpost_sql($_GET["coleta_id"]);





	if(isset($_GET["solicitar"])){
		$email = "breno.cruvinel09@gmail.com";
		$linha = fSQL::SQL_SELECT_ONE("code","axl_processo","id = '".$processo_id."'");
		$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-orientacao-governamental.html");
		//monta mensagem template
		$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);
		$html_template = str_replace("!rnc_processo!",$linha["code"],$html_template);
						
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
				'SEND_NOME' => $class_fLNG->txt(__FILE__,__LINE__,'Governo'),
				'SEND_EMAIL' => $email,
				'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'Nova Solicitação de Orientação Governamental').' - '.SYS_CLIENTE_NOME_RESUMIDO,
				'SEND_BODY' => $html_template
				))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
		); $context = stream_context_create($opts);
		//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
		$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);		
		if($contentResp != "1"){
			$msg = $class_fLNG->txt(__FILE__,__LINE__,'Opss... Ouve um problema ao enviar a notificação de solicitação governamental, tente novamente mais tarde!');
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
		}else{
			fSQL::SQL_UPDATE_SIMPLES("governo_status","axl_coleta_biometrica",array("0"),"id = '".$coleta_id."'");
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Solicitação governamental realizada!'));
		}
	}//if(isset($_GET["solicitar"])){
		
		
		
		
		
		

	if(isset($_GET["acao"])){
		$abis_id = getpost_sql($_GET["abis_id"]);
		$acao = getpost_sql($_GET["acao"]);
		
		$arrABIS = fSQL::SQL_SELECT_ONE("duplicado_coleta_id,id_problema","axl_abis_problemas","id = '".$abis_id."'");
		
		$valida = "0"; $valida_msg = "";
		$result = thomasWSabisProblemaResolver($arrABIS["id_problema"],$acao);
		//echo "result: <pre>"; print_r($result); echo "</pre>";
		//echo "arrABIS: <pre>"; print_r($abis_id); echo "</pre>";
		if(isset($result["codigo_retorno"])){
			//atualizar processo
			if($result["codigo_retorno"] == "1"){ 
				//salvar acao abis
				fSQL::SQL_UPDATE_SIMPLES("acao","axl_abis_problemas",array($acao),"id = '".$abis_id."'");				
				$valida = "1";
				$valida_msg = $class_fLNG->txt(__FILE__,__LINE__,'Análise ABIS problema #!!id!! concluída! Ação: !!acao!!',array("id"=>$arrABIS["id_problema"],"acao"=>legABISacao($acao)));	
				//criar evento
				fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Análise ABIS'),$class_fLNG->txt(__FILE__,__LINE__,'Resultado: !!acao!!',array("acao"=>legABISacao($acao))),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,"");
				//atualizar ação problema
				fSQL::SQL_UPDATE_SIMPLES("acao,user_a,sync","axl_abis_problemas",array($acao,$cVLogin->userReg(),time()),"id = '".$abis_id."'");
				//fSQL::SQL_UPDATE_SIMPLES("abis_status_acao,sync","axl_coleta_biometrica",array($acao_a,time()),"id = '".$coleta_id_a."'");

				//acao == 3 - trocar código de coleta
				if($acao == "3"){
					fSQL::SQL_UPDATE_SIMPLES("coleta_id","axl_processo",array($arrABIS["duplicado_coleta_id"]),"id = '".$processo_id."'");

					$linha = fSQL::SQL_SELECT_ONE("P.code,C.nome,C.sobrenome","axl_processo P,cad_candidato_fisico C","P.id = '".$processo_id."' AND P.candidato_fisico_id = C.id");
				
					$notificacao = "<span style='font-size:14px;'>".$class_fLNG->txt(__FILE__,__LINE__,'Existe um processo de Deduplicação ABIS aguardando análise.')."</span>";
					$notificacao .= "<br><br><span style='font-size:12px;'><b>".$class_fLNG->txt(__FILE__,__LINE__,'Nº RNT')." ".$linha["code"]."</b>";
					$notificacao .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'SOBRENOME').": ".$linha["sobrenome"];
					$notificacao .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'NOME').": ".$linha["nome"]."</span>";
					
					$html_template = file_get_contents(VAR_DIR_FILES."files/templates/email/email-notificacao.html");
					//monta mensagem template
					$html_template = str_replace("!nome_fisico!","",$html_template);
					$html_template = str_replace("!notificacao!",$notificacao,$html_template);
					$html_template = str_replace("!url_raiz!",SYS_URLRAIZ,$html_template);
									
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
							'SEND_NOME' => "TGA",
							'SEND_EMAIL' => "breno.cruvinel09@gmail.com",
							'SEND_ASSUNTO' => $class_fLNG->txt(__FILE__,__LINE__,'Análise MINISTÉRIO TRANSPORTE - RNC ').$linha["code"].' - '.SYS_CLIENTE_NOME_RESUMIDO,
							'SEND_BODY' => $html_template
							))),"ssl"=>array("verify_peer"=>false,"verify_peer_name"=>false)
					); $context = stream_context_create($opts);
					//informações do retorno: 0 - bloqueado acesso, 1 - sucesso, 2 - erros de configuração, 3 - erro de classe
					$contentResp = file_get_contents(SYS_URLRAIZ.'sys/http_send_email.php?JesusTeAma=1', false, $context);				
					//echo "<br><br>RESULT:".$contentResp;
					
				}//if($acao_a == "3"){
				
				/*
				//suspender processo
				if($acao == "3"){
					/////////////////////// SUSPENDER ----------->>>
					fSQL::SQL_UPDATE_SIMPLES("status,sync,obs_geral","axl_processo",array("10",time(),$class_fLNG->txt(__FILE__,__LINE__,'Processo suspenso por ABIS')." - ".legABIS($arrABIS["tipo_problema"])),"id = '".$processo_id."'");		
					$cMSG->addMSG("INFO",$class_fLNG->txt(__FILE__,__LINE__,'Processo (!!code!!) suspenso com sucesso!',array("code"=>$code_a)));	
					/////////////////////// SUSPENDER -----------<<<				
				}//if($acao_a == "3"){			
				*/

				//verificar se resolveu tudo
				$problemas_restantes = fSQL::SQL_CONTAGEM("axl_abis_problemas","coleta_id = '".$coleta_id."' AND acao = '0'");
				//echo "<br>problemas_restantes:".$problemas_restantes;
				if($problemas_restantes <= "0"){
					//atualizar coleta
					fSQL::SQL_UPDATE_SIMPLES("abis_status_acao,sync","axl_coleta_biometrica",array($acao,time()),"id = '".$coleta_id."'");					
					$linha = fSQL::SQL_SELECT_ONE("servico_id,origem_id,ano,mes,dia,code","axl_processo","id = '".$processo_id."'");
					//echo "<pre>"; print_r($linha); echo "</pre>";
					$servico_id = $linha["servico_id"];
					$origem_id = $linha["origem_id"];
					$upload_dir = VAR_DIR_FILES."files/tabelas/axl_processo/".$linha["ano"]."/".completa_zero($linha["mes"],"2")."/".completa_zero($linha["dia"],"2")."/".$linha["code"]."/";
					//verificar se processo completo - autorizar impressão
					$linha = fSQL::SQL_SELECT_ONE("informacoes","adm_protocolo_tipo","id = '".$servico_id."'");
					$informacoes = arrayDB($linha["informacoes"]);
		
					$autorizar = "1";
					//monta array
					unset($array); $array = explode(".",$informacoes);
					//echo "<br>informacoes:".$informacoes;
					$cont_ARRAY = ceil(count($array));
					//listar item ja cadastrados
					if($cont_ARRAY >= "1"){
						foreach ($array as $pos => $tipo_id){
							//echo "<br>tipo_id:".$tipo_id;
							$linhaxxx = fSQL::SQL_SELECT_ONE("id,obrigatorio","adm_protocolo_tipo_inf","id = '".$tipo_id."'");							
							if($linhaxxx["obrigatorio"] == "1"){
								$cont = fSQL::SQL_CONTAGEM("axl_processo_campos","processo_id = '".$processo_id."' AND tipo_id = '".$tipo_id."'");
								if($cont <= "0"){ $autorizar = "0"; break; }
							}//if($linhaxxx["obrigatorio"] == "1"){
						}//foreach ($array as $pos => $tipo_id){
					}//if($cont_ARRAY >= "1"){
					//echo "<br>autorizar:".$autorizar;
					//autorizar impressão
					if($autorizar == "1"){
						fSQL::SQL_UPDATE_SIMPLES("status,sync","axl_processo",array("999",time()),"id = '".$processo_id."'");
						fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Processo completo!'),$class_fLNG->txt(__FILE__,__LINE__,'Processo completo, aguardando liberação (CADAC).'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,$upload_dir);
						$valida_msg = "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'PROCESSO COMPLETO, AGUARDANDO LIBERAÇÃO (CADAC)!');
						/*
						$result = thomasWSimpressaoEnviar($processo_id,$origem_id);
						if($result["codigo_retorno"] == "1"){ 
							$valida_msg = "<br><br>".$class_fLNG->txt(__FILE__,__LINE__,'PROCESSO FOI AUTORIZADO PARA IMPRESSÃO!');
							//criar evento
							fPROCESSO::criarEvento($class_fLNG->txt(__FILE__,__LINE__,'Autorização de Impressão'),$class_fLNG->txt(__FILE__,__LINE__,'Processo autorizado para impressão'),$cVLogin->userReg(),$cVLogin->getVarLogin("SYS_USER_CARGO"),$processo_id,"");
						}
						*/
					}//if($valida == "1"){					
				}//if($problemas_restantes <= "0"){	
				
			
			}else{//if($result["codigo_retorno"] == "1"){ 
				$valida = "0";
				$msg = thomasFiltrarErro($result["descricao_retorno"]);
				$valida_msg = thomasCodRetorno($result["codigo_retorno"]).$msg;			
			}//}else{//if($result["codigo_retorno"] == "1"){ 
		}else{//if(isset($result["codigo_retorno"])){
			$valida = "0";
			$valida_msg = $class_fLNG->txt(__FILE__,__LINE__,'Não foi possível comunicar com o sistema integrado.');
		}//}else{//if(isset($result["codigo_retorno"])){		
		
		if($valida == "0"){	$cMSG->addMSG("ERRO",$valida_msg); }else{ $cMSG->addMSG("INFO",$valida_msg); }
	}//if(isset($_GET["acao"])){

	$cMSG->imprimirMSG();//imprimir mensagens criadas		
		
	$problemas_resolvidos = fSQL::SQL_CONTAGEM("axl_abis_problemas","coleta_id = '".$coleta_id."' AND acao >= '1'");
	$problemas_total = fSQL::SQL_CONTAGEM("axl_abis_problemas","coleta_id = '".$coleta_id."'");	
	
	$abis_id = "0"; $tipo_problema = "-"; $score_foto_a = "-"; $score_digital_a = "-"; $score_a = "-"; $duplicado_processo_n = "-";
	
	if($problemas_resolvidos == $problemas_total){
?>
		<div class="row-fluid" style="text-align:center;">
        	<h2 style="color:green;"><b><i class="icon-check"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Todos os problemas foram resolvidos!')?></b></h2>
            <button type="button" class="btn btn-success btn-large" onclick="$('#formCadastroPincipal<?=$array_temp?>').submit();return false;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Finalizar Análise')?></button>
        </div>
<?php		
	}else{//if($problemas_resolvidos == $problemas_total){
		
		$linha2 = fSQL::SQL_SELECT_ONE("governo_status","axl_coleta_biometrica","id = '".$coleta_id."'");
		$governo_status = $linha2["governo_status"];
		$governo_obs = "";
		if($governo_status == 0){
			$governo_obs = '<span style="color:#ff0000"><i class="icon-time"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'AGUARDANDO ORIENTAÇÃO GOVERNAMENTAL').'</span>';
		}
		//DADOS DO PROCESSO ENCONTROADO -----------------------------------------------------------------------
		$linha2 = fSQL::SQL_SELECT_ONE("id,id_problema,origem_id,processo_id,processo_code,candidato_fisico_id,duplicado_coleta_id,tipo_problema,score_foto,score_digital,score,governo_obs,time","axl_abis_problemas","coleta_id = '".$coleta_id."' AND acao = '0' ORDER BY id_problema ASC");
		$abis_id = $linha2["id"];
		$id_problema_a = $linha2["id_problema"];	
		$duplicado_origem_id_a = $linha2["origem_id"];
		$duplicado_processo_id_a = $linha2["processo_id"];	
		$duplicado_processo_code_a = $linha2["processo_code"];	
		$duplicado_candidato_fisico_id_a = $linha2["candidato_fisico_id"];	
		$duplicado_coleta_id_a = $linha2["duplicado_coleta_id"];	
		$duplicado_tipo_problema_a = $linha2["tipo_problema"];	
		$score_foto_a = $linha2["score_foto"];	
		$score_digital_a = $linha2["score_digital"];	
		$score_a = $linha2["score"];	
		$duplicado_time_a = $linha2["time"];	
		if($linha2["governo_obs"] != "") { $governo_obs = $linha2["governo_obs"]; }
			
		//dados pessoa
		$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome,datan,nacionalidade,mae,localn","cad_candidato_fisico","id = '$duplicado_candidato_fisico_id_a'");
		$arrDoc = docPessoaFisica($duplicado_candidato_fisico_id_a);
		$duplicado_pessoa_n = $cVLogin->popDetalhes("C",$duplicado_candidato_fisico_id_a,"3_con_candidatofisico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO')).SYS_CONFIG_RM_SIGLA." ".$linha2["code"]." - <b>".$linha2["nome"]."</b><br>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	
		$duplicado_pessoa_n .= $class_fLNG->txt(__FILE__,__LINE__,'Sobrenome').": <b>".$linha2["sobrenome"]."</b>";			
		$duplicado_pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento').": <b>".data_mysql($linha2["datan"]).", ".calcular_idade($linha2["datan"])." anos</b>";			
		$duplicado_pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nacionalidade').": <b>".maiusculo($linha2["nacionalidade"])." - ".maiusculo($linha2["localn"])."</b>";
		$duplicado_pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Documento').": <b>".$arrDoc["nome"]." ".$arrDoc["numero"]." (".$class_fLNG->txt(__FILE__,__LINE__,'emitido em !!data!!',array("data"=>data_mysql($arrDoc["data_emissao"]))).")</b>";								
			
		//dados processo
		$linha2 = fSQL::SQL_SELECT_ONE("servico_id,tipo_servico","axl_processo","id = '$duplicado_processo_id_a'");
		$duplicado_servico_id_a = $linha2["servico_id"];
		$duplicado_tipo_servico_a = $linha2["tipo_servico"];	
		$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '".$duplicado_servico_id_a."'");
		$duplicado_processo_n = '<ul class="stats"><li class="white"><i class="'.categoriaServicoIco($duplicado_tipo_servico_a).'" style="color:black;"></i><div class="details"><span class="big" style="color:black;">'.SYS_CONFIG_PROCESSO_SIGLA.' '.$duplicado_processo_code_a.' - '.$linha2["nome"].'</span><span style="color:black;">'.$class_fLNG->txt(__FILE__,__LINE__,'solicitado em').' '.date("d/m/Y", $duplicado_time_a);
		//origem
		$linha2 = fSQL::SQL_SELECT_ONE("apelido","sys_perfil","origem_id = '$duplicado_origem_id_a'");
		$duplicado_processo_n .= " (".$linha2["apelido"].")</span></div></li></ul>";
		//dados coleta
		$linha2 = fSQL::SQL_SELECT_ONE("ano,mes,dia,nfiq1,nfiq2,nfiq3,nfiq4,nfiq5,nfiq6,nfiq7,nfiq8,nfiq9,nfiq10","axl_coleta_biometrica","id = '$duplicado_coleta_id_a'");
		$duplicado_caminho_file = VAR_DIR_FILES."files/tabelas/coleta/".$linha2["ano"]."/".completa_zero($linha2["mes"],"2")."/".completa_zero($linha2["dia"],"2")."/".$duplicado_coleta_id_a."/";
		$duplicado_assinatura_file = $duplicado_caminho_file."assinatura.jpg";
		$duplicado_foto_file = $duplicado_caminho_file."foto.jpg";	
	
		//array de nfiq de posicões
		$arrDUPLICADO_NFIQ = $linha2;
		unset($arrDUPLICADO_NFIQ["ano"]); unset($arrDUPLICADO_NFIQ["mes"]); unset($arrDUPLICADO_NFIQ["dia"]);	
	
		$tipo_problema = legABIS($duplicado_tipo_problema_a)."<br>".$class_fLNG->txt(__FILE__,__LINE__,'em')." ".date("d/m/Y H:i",$duplicado_time_a);
?>

                                            <div class="row-fluid">
                                                    <table class="table table-hover table-nomargin table-bordered" style="border:1px black solid; border-bottom:0px;">
                                                    	<thead>
                                                        	<tr>
                                                            	<th colspan="2" style="text-align:center; background-color:black; color:white;"><?=$class_fLNG->txt(__FILE__,__LINE__,'DADOS ENCONTRADOS')?> <small><i>(<?=$class_fLNG->txt(__FILE__,__LINE__,'PROBLEMA')?> #<?=$id_problema_a?>)</i></small></th>
                                                            </tr>                                                        
                                                        	<tr>
                                                            	<th style="width:100px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto')?></th>
                                                            	<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados')?></th>                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        	<tr>
                                                            	<td style="text-align:center;">
                                                                	<a href="#" onclick="compararImagens('foto');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($duplicado_foto_file, "")?></a><br>
                                                                	<a href="#" onclick="compararImagens('foto');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($duplicado_assinatura_file, "")?></a>
                                                                </td>
																<td><?=$duplicado_pessoa_n?></td>                                                               	                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-hover table-nomargin table-bordered" style="border:1px black solid; border-top:0px;">
															<tr>
                                                            	<td style="width:100px; border-right:red solid 1px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Direito')?></td>
												<?php 
												for($posicao=1; $posicao <= 5; $posicao++){
													$dedo_file = $duplicado_caminho_file."dedo".$posicao.".jpg";
												?>
																	<td style="text-align:center; padding:0px; margin:0px; border:red solid 1px; border-left:0px; cursor:pointer;" onclick="compararImagens('dedo','<?=$posicao?>','E');return false;"><span style="float:left; font-size:9px; padding-left:1px;"><?=$posicao?></span><span style="float:right; font-size:9px;padding-right:1px;"><?=$arrDUPLICADO_NFIQ["nfiq".$posicao]?></span><a rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($dedo_file, "")?></a><br><?=legDedo($posicao)?></td>
												<?php }//for($posicao=1; $posicao <= 5; $posicao++){?>                                                
                                                            </tr>
															<tr>
                                                            	<td style="width:100px; border-right:red solid 1px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Esquerdo')?></td>
                                                            	
												<?php 
												for($posicao=6; $posicao <= 10; $posicao++){
													$dedo_file = $duplicado_caminho_file."dedo".$posicao.".jpg";
												?>
																	<td style="text-align:center; padding:0px; margin:0px; border:red solid 1px; border-left:0px; cursor:pointer;" onclick="compararImagens('dedo','<?=$posicao?>','E');return false;"><span style="float:left; font-size:9px; padding-left:1px;"><?=$posicao?></span><span style="float:right; font-size:9px;padding-right:1px;"><?=$arrDUPLICADO_NFIQ["nfiq".$posicao]?></span><a rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($dedo_file, "")?></a><br><?=legDedo($posicao)?></td>
												<?php }//for($posicao=6; $posicao <= 10; $posicao++){?>                                                
                                                            </tr>                                                            
                                                        </tbody>
                                                    </table>
                                        </div>
<?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){?>                                        
									<?php if(1==2){?>
										<div class="control-group">
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Orientação Governamental')?></label>
											<div class="controls display">
												<div class="display">
                                                <?php if($governo_obs != ""){?>
													<?=$governo_obs?>
                                                <?php }else{//if($governo_obs != ""){?>                                                    
                                                	<button type="button" class="btn btn-large btn-info" onclick="solicitarOrientacao<?=$INC_FAISHER["div"]?>();"><i class="icon-envelope"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitar')?></button>
                                                <?php }//}else{//if($governo_obs != ""){?>                                                
                                                </div>
											</div>
										</div> 
									<?php }//if(1==2){?>                                        
									
									  	<div class="form-actions">
											<img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" />
                                            
                                        <?php if($governo_status == "1"){?>
											<button type="button" onclick="setAcao<?=$INC_FAISHER["div"]?>('1');" class="btn btn-large btn-primary" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'São pessoas diferentes - Manter ambos')?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'NoMatch')?> </button>
											<button type="button" onclick="setAcao<?=$INC_FAISHER["div"]?>('2');" class="btn btn-large btn-primary" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'É a mesma pessoa')?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Atualizar')?> </button>
											<button type="button" onclick="setAcao<?=$INC_FAISHER["div"]?>('3');" class="btn btn-large btn-red" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Rejeitar coleta atual e suspender processo')?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Rejeitar')?> </button>                                        
										<?php }//if($governo_status == "1"){?>                                                                                        

											<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="<?php if(isset($_GET["POP"])){ echo "pmodalDisplay('hide');"; }else{?>displayAcao<?=$INC_FAISHER["div"]?>('fecha');<?php }?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
										</div>
<?php }//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){?>     

                                   
<script>
function compararImagens(v_tipo,v_posicao,v_lado){
	v_get = "";
	if(v_posicao != null){ v_get = "&posicao="+v_posicao; }
	if(v_lado != null){ v_get = v_get + "&lado="+v_lado; }
	
	pmodalHtml('<i class=icon-search-plus></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'COMPARAÇÃO DE IMAGENS')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=compararImagens&coleta_id=<?=$coleta_id?>&duplicado_coleta_id=<?=$duplicado_coleta_id_a?>&tipo='+v_tipo+v_get);
}
function setAcao<?=$INC_FAISHER["div"]?>(v_acao){
	var leg = "";
	if(v_acao == '1'){ leg = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma executar ação NoMatch?\n\n*Não afetará os processos.')?>"; }
	if(v_acao == '2'){ leg = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma executar ação de atualizar?\n\n*Não afetará os processos.')?>"; }
	if(v_acao == '3'){ leg = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Confirma executar ação de rejeitar?\n\n*A coleta atual será rejeitada e utilizada coleta anterior.')?>"; }
	if(confirm(leg)) { 
		$("#formCadastroPincipal<?=$array_temp?> #abis_id").val('<?=$abis_id?>');
		$("#formCadastroPincipal<?=$array_temp?> #abis_acao").val(v_acao);
		listaABIS<?=$INC_FAISHER["div"]?>('&abis_id=<?=$abis_id?>&acao='+v_acao);
	}//if(confirm(leg)) { 
}//setAcao

function solicitarOrientacao<?=$INC_FAISHER["div"]?>(){
	if(confirm("<?=$class_fLNG->txt(__FILE__,__LINE__,'Deseja realmente solicitar orientação governamental?')?>")) {	
		listaABIS<?=$INC_FAISHER["div"]?>('&solicitar=1');
	}	
}
</script>                                        
<?php
	}//}else{//if($problemas_resolvidos == $problemas_total){
?>

<script>
$(document).ready(function(e) {
	<?php if($abis_id >= "1"){?> $("#formCadastroPincipal<?=$array_temp?> #abis_id").val('<?=$abis_id?>'); <?php } ?>
    $("#formCadastroPincipal<?=$array_temp?> #span_processo_problemas").html('<?=$class_fLNG->txt(__FILE__,__LINE__,'!!cont_resolvido!! resolvido(s) do total de !!cont_total!! problema(s) ABIS',array("cont_resolvido"=>$problemas_resolvidos,"cont_total"=>$problemas_total))?>');	
	$("#formCadastroPincipal<?=$array_temp?> #span_tipo_problema").html('<?=$tipo_problema?>');
    $("#formCadastroPincipal<?=$array_temp?> #span_processo_duplicado").html('<?=$duplicado_processo_n?>');	
    $("#formCadastroPincipal<?=$array_temp?> #score_geral").html('<?=$score_a?>');	
    $("#formCadastroPincipal<?=$array_temp?> #score_digitais").html('<?=$score_digital_a?>');
    $("#formCadastroPincipal<?=$array_temp?> #score_foto").html('<?=$score_foto_a?>');		
});
</script>

<?php
}//ajax == listaABIS




































































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//












































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
	
	//DADOS DO PROCESSO ATUAL ----------------------------------------------------------------------------------------- >>>>
	//dados pessoa
	$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome,datan,nacionalidade,mae,localn","cad_candidato_fisico","id = '$candidato_fisico_id_a'");
	$arrDoc = docPessoaFisica($candidato_fisico_id_a);
	$pessoa_n = $cVLogin->popDetalhes("C",$candidato_fisico_id_a,"3_con_candidatofisico",$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO')).SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($candidato_fisico_id_a,$linha2["code"])." - <b>".$linha2["nome"]."</b><br>".'<div style="clear:both; border-top:#E0E0E0 1px solid;"></div>';
	//$pessoa_n .= "<br>Nome: <b>".$linha2["nome"]."</b>";
	$pessoa_n .= $class_fLNG->txt(__FILE__,__LINE__,'Sobrenome').": <b>".$linha2["sobrenome"]."</b>";			
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento').": <b>".data_mysql($linha2["datan"]).", ".calcular_idade($linha2["datan"])." anos</b>";			
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Nacionalidade').": <b>".maiusculo($linha2["nacionalidade"])." - ".maiusculo($linha2["localn"])."</b>";
	$pessoa_n .= "<br>".$class_fLNG->txt(__FILE__,__LINE__,'Documento').": <b>".$arrDoc["nome"]." ".$arrDoc["numero"]." (".$class_fLNG->txt(__FILE__,__LINE__,'emitido em !!data!!',array("data"=>data_mysql($arrDoc["data_emissao"]))).")</b>";						

	//dados processo
	$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo","id = '$servico_id_a'");
	$processo_n = '<ul class="stats"><li class="white"><i class="'.categoriaServicoIco($tipo_servico_a).'" style="color:black;"></i><div class="details"><span class="big" style="color:black;">'.SYS_CONFIG_PROCESSO_SIGLA." ".$code_a.' - '.$linha2["nome"].'</span><span style="color:black;">'.$class_fLNG->txt(__FILE__,__LINE__,'solicitado em').' '.date("d/m/Y", $time_a);
	//origem
	$linha2 = fSQL::SQL_SELECT_ONE("apelido","sys_perfil","origem_id = '$origem_id_a'");
	$processo_n .= " (".$linha2["apelido"].")</span></div></li></ul>";
	//dados coleta
	$linha2 = fSQL::SQL_SELECT_ONE("ano,mes,dia,nfiq1,nfiq2,nfiq3,nfiq4,nfiq5,nfiq6,nfiq7,nfiq8,nfiq9,nfiq10,governo_status,sync","axl_coleta_biometrica","id = '$coleta_id_a'");
	$caminho_file = VAR_DIR_FILES."files/tabelas/coleta/".$linha2["ano"]."/".completa_zero($linha2["mes"],"2")."/".completa_zero($linha2["dia"],"2")."/".$coleta_id_a."/";
	$assinatura_file = $caminho_file."assinatura.jpg";
	$foto_file = $caminho_file."foto.jpg";	
	$coleta_sync = $linha2["sync"];
	$governo_status = $linha2["governo_status"];
	
	//array de nfiq de posicões
	$arrNFIQ = $linha2;
	unset($arrNFIQ["ano"]); unset($arrNFIQ["mes"]); unset($arrNFIQ["dia"]);
	//DADOS DO PROCESSO ATUAL ----------------------------------------------------------------------------------------- <<<<<
	
	
	
}//fim do if if($id_a != "0"){




?>

<script type="text/javascript">
<?php if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){ $('#<?=$formCadastroPincipal?> #div_idred<?=$INC_FAISHER["div"]?>').html('<b><?=$class_fLNG->txt(__FILE__,__LINE__,'AUDITORIA')?> <?=$code_a?></b>'); });
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
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'AUDITORIA')?> #<?=$code_a?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('<?=$class_fLNG->txt(__FILE__,__LINE__,'AUDITORIA')?> #<?=$code_a?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }?>
	
	});
	<?php if($id_a == "0"){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); $('#<?=$formCadastroPincipal?> #senha').focus(); });//TIMER
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
             <input name="code" id="code" type="hidden" value="<?=$code_a?>" />               
             <input name="coleta_id" id="coleta_id" type="hidden" value="<?=$coleta_id_a?>" />               
             <input name="abis_id" id="abis_id" type="hidden" value="0" />               
             <input name="abis_acao" id="abis_acao" type="hidden" value="0" />                            
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosgerais".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Informações do Processo');// titulo
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
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Quantidade de problemas encontrados')?></label>
                                            <div class="controls display-plus">
                                              <span id="span_processo_problemas">0/0</span>
                                            </div>
                                        </div>
										<div class="row-fluid">
										<div class="span6">                                        
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo Atual')?></label>
                                                <div class="controls display-plus">
                                                  <?=$processo_n?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6"> 
                                            <div class="control-group">
                                                <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Processo Encontrado')?></label>
                                                <div class="controls display-plus">
                                                  <span id="span_processo_duplicado">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>  

                                        <div class="control-group">
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo do Problema')?></label>
                                            <div class="controls display-plus">
                                                <span id="span_tipo_problema">-</span>
                                            </div>
                                        </div> 
                                        <div class="control-group">
                                            <label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Scores de comparação')?></label>
                                            <div class="controls">
                                                <ul class="stats">
                                                    <li class="red">
                                                        <i class="icon-screenshot"></i>
                                                        <div class="details">
                                                            <span class="big" id="score_geral">0</span>
                                                            <span><?=$class_fLNG->txt(__FILE__,__LINE__,'Geral')?></span>
                                                        </div>
                                                    </li>
                                                    <li class="red">
                                                        <i class="icon-screenshot"></i>
                                                        <div class="details">
                                                            <span class="big" id="score_digitais">0</span>
                                                            <span><?=$class_fLNG->txt(__FILE__,__LINE__,'Digitais')?></span>
                                                        </div>
                                                    </li>
                                                    <li class="red">
                                                        <i class="icon-screenshot"></i>
                                                        <div class="details">
                                                            <span class="big" id="score_foto">0</span>
                                                            <span><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto')?></span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>                                                                              
                                    


										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->




                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosabis".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Análise Problemas ABIS');// titulo
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
$.doTimeout('vTimerListaABIS<?=$INC_FAISHER["div"]?>', 100, function(){ listaABIS<?=$INC_FAISHER["div"]?>(''); });//TIMER

function listaABIS<?=$INC_FAISHER["div"]?>(v_get){

	loaderFoco('ac_<?=$boxUI_id?>','ac_<?=$boxUI_id?>load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando dados...')?>');//cria um loader dinamico
	faisher_ajax('<?=$formCadastroPincipal?> #listaABIS<?=$INC_FAISHER["div"]?>', 'ac_<?=$boxUI_id?>load', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=listaABIS&array_temp=<?=$array_temp?>&<?=$get?>&coleta_id=<?=$coleta_id_a?>&processo_id=<?=$id_a?>&'+v_get, 'get', 'ADD');
}//listaServicos
</script>
                                                                 
                                        <div class="control-group row-fluid">
                                        <div class="span6">                                    
                                            <div class="row-fluid">
                                                    <table class="table table-hover table-nomargin table-bordered" style="border:1px black solid; border-bottom:0px;">
                                                    	<thead>
                                                        	<tr>
                                                            	<th colspan="2" style="text-align:center; background-color:black; color:white;"><?=$class_fLNG->txt(__FILE__,__LINE__,'DADOS COLETADOS')?></th>
                                                            </tr>
                                                        	<tr>
                                                            	<th style="width:100px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Foto')?></th>
                                                            	<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Dados')?></th>                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        	<tr>
                                                            	<td style="text-align:center;">
                                                                	<a href="#" onclick="compararImagens('foto');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($foto_file, "")?></a><br>
                                                                	<a href="#" onclick="compararImagens('assinatura');return false;" rel="tooltip" title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($assinatura_file, "")?></a>
                                                                </td>
																<td><?=$pessoa_n?></td>                                                               	                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-hover table-nomargin table-bordered" style="border:1px black solid; border-top:0px;">
															<tr>
                                                            	<td style="width:100px; border-right:red solid 1px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Direito')?></td>
												<?php 
												for($posicao=1; $posicao <= 5; $posicao++){
													$dedo_file = $caminho_file."dedo".$posicao.".jpg";
												?>
																	<td style="text-align:center; padding:0px; margin:0px; border:red solid 1px; border-left:0px; cursor:pointer;" onclick="compararImagens('dedo','<?=$posicao?>','D');return false;"><span style="float:left; font-size:9px; padding-left:1px;"><?=$posicao?></span><span style="float:right; font-size:9px;padding-right:1px;"><?=$arrNFIQ["nfiq".$posicao]?></span><a rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($dedo_file, "")?></a><br><?=legDedo($posicao)?></td>
												<?php }//for($posicao=1; $posicao <= 5; $posicao++){?>                                                
                                                            </tr>
															<tr>
                                                            	<td style="width:100px; border-right:red solid 1px;"><?=$class_fLNG->txt(__FILE__,__LINE__,'Esquerdo')?></td>
                                                            	
												<?php 
												for($posicao=6; $posicao <= 10; $posicao++){
													$dedo_file = $caminho_file."dedo".$posicao.".jpg";
												?>
																	<td style="text-align:center; padding:0px; margin:0px; border:red solid 1px; border-left:0px; cursor:pointer;" onclick="compararImagens('dedo','<?=$posicao?>','E');return false;"><span style="float:left; font-size:9px; padding-left:1px;"><?=$posicao?></span><span style="float:right; font-size:9px;padding-right:1px;"><?=$arrNFIQ["nfiq".$posicao]?></span><a rel="tooltip" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Clique para comparar')?>"><?=$cVLogin->icoFile($dedo_file, "")?></a><br><?=legDedo($posicao)?></td>
												<?php }//for($posicao=6; $posicao <= 10; $posicao++){?>                                                
                                                            </tr>                                                            
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                        <div class="span6" id="listaABIS<?=$INC_FAISHER["div"]?>">
                                        </div>
                                        </div>                                        








                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            

<?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"obs") and $governo_status == '0' and 1==2){?>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "obsgoverno".$array_temp;//id de controle
						$boxUI_titulo = $class_fLNG->txt(__FILE__,__LINE__,'Orientação Governamental');// titulo
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
											<label class="control-label"><?=$class_fLNG->txt(__FILE__,__LINE__,'Orientação')?></label>
											<div class="controls">
												<textarea name="governo_obs" id="governo_obs" rows="3" class="input-block-level" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Orientações')?>"><?=$obs_geral_a?></textarea>
											</div>
										</div>          
	<div class="span12" id="div_salvar<?=$INC_FAISHER["div"]?>">
		<div class="form-actions">
			<button type="button" class="btn btn-primary btn-large enviaBt" onclick="salvarOrientacao<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Salvar')?></button>
            <button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="displayAcao<?=$INC_FAISHER["div"]?>('fecha');"><?=$class_fLNG->txt(__FILE__,__LINE__,'Cancelar')?></button>
			<span class="help-block"><i class="icon-info-sign"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'A orientação será disponibilizada para técnico tomar as providencias necessárias.')?></span>
		</div>
	</div>                                                                      
<script>
function salvarOrientacao<?=$INC_FAISHER["div"]?>(v_get){
	orientacao = $("#<?=$formCadastroPincipal?> #governo_obs").val();
	abis_id = $("#formCadastroPincipal<?=$array_temp?> #abis_id").val();

	valida = "";
	if(orientacao == ""){ valida = "<?=$class_fLNG->txt(__FILE__,__LINE__,'Para salvar é necessário informar a orientação!')?>"; }
	
	if (valida != ""){ alert(valida); }else{	
		orientacao = replaceAll(orientacao,'\n','[br]');
		loaderFoco('div_salvar<?=$INC_FAISHER["div"]?>','div_salvar<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Salvando...')?>');//cria um loader dinamico
		faisher_ajax('div_salvar<?=$INC_FAISHER["div"]?>', 'div_salvar<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', "faisher=<?=$faisher?>&ajax=salvarOrientacao&coleta_id=<?=$coleta_id_a?>&abis_id="+abis_id+"&orientacao="+orientacao+"&"+v_get, 'get', 'ADD');
	}
}
</script>                                                                     
                                    


										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir/ocultar')?> <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php }//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"obs")){?>





									</form>
</div>
<div id="divContent_oculto<?=$array_temp?>" style="display:none;"></div>                                   
<?php
if(isset($_GET["POP"])){ $loaderFoco = "1"; }else{ $loaderFoco = "0"; }
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#".$formCadastroPincipal."').validate().form() == false){ valedaform = \"0\"; }
	if(valedaform == \"1\"){
		loaderFoco('divContent_loader".$array_temp."','divContent_loader_load".$array_temp."',' ".$class_fLNG->txt(__FILE__,__LINE__,'Atualizando lista...')."','".$loaderFoco."');//cria um loader dinamico	
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




if(isset($_POST["id_a"])){
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);	
	$code_a = getpost_sql($_POST["code"]);	
	$coleta_id_a = getpost_sql($_POST["coleta_id"]);	
	$abis_id = getpost_sql($_POST["abis_id"]);		
	$abis_acao_a = getpost_sql($_POST["abis_acao"]);
	
	$valida = "";
	$cMSG->addMSG("SUCESSO",$class_fLNG->txt(__FILE__,__LINE__,'Análise ABIS do processo !!sigla!! !!code!! concluída! Decisão: !!decisao!!.',array("sigla"=>SYS_CONFIG_PROCESSO_SIGLA,"code"=>$code_a,"decisao"=>legABISacao($abis_acao_a))));	
	
	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($valida != ""){//verifica se existe erro
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b><?=$class_fLNG->txt(__FILE__,__LINE__,'Erros encontrados!')?></b><br><?=$valida?>',60000);
				<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
				<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml');<?php }//fim else if(isset($_GET["POP"])){ ?>
			});//TIMER
		</script>
		<?php
		if(isset($_GET["POP"])){ exit(0); }
	}

	
	
}//if(isset($_POST["id_a"]){





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
if($tab_id == "0"){
	$SQL_campos = "P.id,P.origem_id,P.code,P.tipo_servico,P.servico_id,P.triagem_id,P.coleta_id,P.candidato_fisico_id,P.validade_time,P.status,P.motivo_id,P.time,P.sync,B.abis_status,B.abis_status_acao,B.governo_status"; //campos da tabela
	$SQL_tabela = "axl_coleta_biometrica B, axl_processo P"; //tabela
	$SQL_join = "";
	$SQL_where = "P.coleta_id = B.id"; //condição
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){
		$SQL_where .= " AND B.governo_status = '0'";
	}
	$ORDEM_C = "B.sync";//campo de ordenar
	$ORDEM = "ASC";
	$SQL_group = ""; // agrupar o resultado GROUP BY
	
	
}elseif($tab_id == "1"){//if($tab_id == "0"){
	$SQL_campos = "C.id,C.nome,C.code,C.sobrenome"; //campos da tabela
	$SQL_tabela = "cad_candidato_fisico C"; //tabela
	$SQL_join = "";
	$SQL_where = "";//"origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'"; //condição
	$ORDEM_C = "C.nome";//campo de ordenar
	$ORDEM = "ASC";
	$SQL_group = ""; // agrupar o resultado GROUP BY	
	
	
}elseif($tab_id == "2"){//}elseif($tab_id == "1"){//if($tab_id == "0"){
	$SQL_campos = "P.id,P.origem_id,P.code,P.tipo_servico,P.servico_id,P.triagem_id,P.coleta_id,P.candidato_fisico_id,P.candidato_juridico_id,P.validade_time,P.status,P.motivo_id,P.time,P.sync,C.nome,C.code,C.sobrenome"; //campos da tabela
	$SQL_tabela = "axl_processo P, cad_candidato_fisico C"; //tabela
	$SQL_join = "";
	$SQL_where = "P.candidato_fisico_id = C.id";//"origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "P.time";//campo de ordenar
	$ORDEM = "ASC";
	$SQL_group = ""; // agrupar o resultado GROUP BY	
}else{//}elseif($tab_id == "2"){//}elseif($tab_id == "1"){//if($tab_id == "0"){

	$SQL_campos = "P.id,P.origem_id,P.code,P.tipo_servico,P.servico_id,P.triagem_id,P.coleta_id,P.candidato_fisico_id,P.candidato_juridico_id,P.validade_time,P.status,P.motivo_id,P.time,P.sync,P.cancelamento_suspensao_id,S.status"; //campos da tabela
	$SQL_tabela = "axl_processo P, axl_cancelamento_suspensao S"; //tabela
	$SQL_join = "";
	$SQL_where = "P.cancelamento_suspensao_id = S.id AND P.cancelamento_suspensao_id >= '1'";//"origem_id = '".$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID")."'"; //condição
	$SQL_varEnvio = "ajax=lista&faisher=$faisher&tab_id=$tab_id&"; //variaveis para a paginacao
	$ORDEM_C = "S.sync";//campo de ordenar
	$ORDEM = "ASC";
	$SQL_group = ""; // agrupar o resultado GROUP BY	
	
}//else{//}elseif($tab_id == "2"){//}elseif($tab_id == "1"){//if($tab_id == "0"){	

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
	if($tab_id == "0"){//deduplicação
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= "B.abis_status >= '2' AND abis_status_acao = '0'"; //condição 
	}
//fim verifica tab_id


//verifica se recebeu uma solicitação de busca por rapida_b
if($doc_numero_b != "" and $datan_b != ""){ $filtro_marca[] = $doc_numero_b; $filtro_marca[] = $datan_b;
		$filtro_b["doc_numero_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Busca por !!doc!! !!num!!',array("doc"=>'<b>'.$doc_tipo_b.'</b>',"num"=>'<b>'.$doc_numero_b.'</b>'));
		$filtro_b["datan_b"] = $class_fLNG->txt(__FILE__,__LINE__,'Data de nascimento !!busca!!',array("busca"=>'<b>'.$datan_b.'</b>'));
		$campo = "rg";
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'IDENTIDADE')){ $campo = "rg"; }
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'PASSAPORTE')){ $campo = "passaporte"; }		
		if($doc_tipo_b == $class_fLNG->txt(__FILE__,__LINE__,'ID ESTRANGEIRO')){ $campo = "id_estrangeiro"; }		

		if($tab_id == "0" || $tab_id == "3"){
			$linha = fSQL::SQL_SELECT_ONE("id","cad_candidato_fisico",$campo." = '".$doc_numero_b."' AND datan = '".data_mysql($datan_b)."'");
			if($linha["id"] >= "1"){
				if($SQL_where != ""){ $SQL_where .= " AND "; }
				$SQL_where .= " ( P.`candidato_fisico_id` = '".$linha["id"]."' ) "; //condição 		
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
		
		if($tab_id == "0" || $tab_id == "3"){
			$linha = fSQL::SQL_SELECT_ONE("id","cad_candidato_fisico","code = '".$rnt_b."'");
			if($linha["id"] >= "1"){
				if($SQL_where != ""){ $SQL_where .= " AND "; }
				$SQL_where .= " ( P.`candidato_fisico_id` = '".$linha["id"]."' ) "; //condição 			
			}//if($linha["id"] >= "1"){		
		}else{//if($tab_id == "0"){
			if($SQL_where != ""){ $SQL_where .= " AND "; }
			$SQL_where .= " ( C.`code` = '".$rnt_b."' ) "; //condição 
		}//}else{//if($tab_id == "0"){
		
		$AJAX_GET .= "rnt_b=$rnt_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b






//verifica se recebeu uma solicitação de busca por rapida_b
if($rnc_b != ""){ $filtro_marca[] = $rnc_b;
		$filtro_b["rnc_b"] = SYS_CONFIG_PROCESSO_SIGLA." <b>".$rnc_b."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		if($tab_id == "1"){
			$SQL_where .= " ( C.`code` = '".$rnc_b."' ) "; //condição 
		}else{
			$SQL_where .= " ( P.`code` = '".$rnc_b."' ) "; //condição 
		}
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
	if($tab_id == "3" and ceil(count($filtro_b)) <= "0"){ $SQL_where .= " AND S.status = '0'"; $valida = "1"; }		
	
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
			<?php }else{//if($tab_id == "1"){?>                
				<?php $c_or = "P.code"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=SYS_CONFIG_PROCESSO_SIGLA?></th>
				<?php $c_or = "P.servico_id"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Tipo Serviço')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Solicitante')?></th>
				<th><?=$class_fLNG->txt(__FILE__,__LINE__,'Status')?></th>
			<?php }//}else{//if($tab_id == "1"){?>                    
				
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
												<?=$button?>
                                               
                                          </td>
										</tr>

<?php		

	}elseif($tab_id == "0"){//if($tab_id == "1"){	
		$id_a = $linha1["id"];
		$origem_id = $linha1["origem_id"];	
		$code = $linha1["code"];
		$tipo_servico = $linha1["tipo_servico"];
		$servico_id = $linha1["servico_id"];
		$triagem_id = $linha1["triagem_id"];
		$coleta_id = $linha1["coleta_id"];	
		$candidato_fisico_id = $linha1["candidato_fisico_id"];
		$status = $linha1["status"];
		$validade_time = $linha1["validade_time"];
		$time = $linha1["time"];
		$sync = $linha1["sync"];
		$coleta_abis_status = $linha1["abis_status"];	
		$coleta_abis_status_acao = $linha1["abis_status_acao"];	
		$governo_status = $linha1["governo_status"];		
		
		$linha = fSQL::SQL_SELECT_ONE("nome","sys_perfil","origem_id = '".$origem_id."'");
		$origem_id_n = $linha["nome"];
		//ações possíveis
		$button = "";
		
		//busca dados
		$linha2 = fSQL::SQL_SELECT_ONE("nome","adm_protocolo_tipo", "id = '".$servico_id."'");	
		$servico_id_n = $linha2["nome"];
		
		$tipo_servico_n = "<b>".$servico_id_n."</b>";
		$tipo_servico_n .= "<br><small><i class='".categoriaServicoIco($tipo_servico)."'> ".maiusculo(categoriaServicoLeg($tipo_servico))."</i></small>";
	
		$status_n = $class_fLNG->txt(__FILE__,__LINE__,'PROBLEMA: ABIS')." - ".legABIS($coleta_abis_status)."<br><small><i>".$class_fLNG->txt(__FILE__,__LINE__,'em')." ".date("d/m/Y H:i",$sync)."</i></small>";
		if($governo_status == "0"){
			$status_n .= "<br><b>".$class_fLNG->txt(__FILE__,__LINE__,'AGUARDANDO ORIENTAÇÃO GOVERNAMENTAL')."</b>";
		}
		$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome","cad_candidato_fisico","id = '".$candidato_fisico_id."'");
		$solicitante_n = '<b>'.$linha2["nome"].' '.$linha2["sobrenome"].'</b> <a class="btn btn-default" onclick="pmodalHtml(\'<i class=icon-search></i> '.$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO').' #'.$linha2["code"].'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=detalhesCandidato&id='.$candidato_fisico_id.'\');return false;"><i class="icon-external-link"></i></a><br>'.SYS_CONFIG_RM_SIGLA.' '.$linha2["code"];			


	
	
?>
										<tr>
											<td><b><?=$code?></b><br><i><?=$origem_id_n?></i></td>
											<td><?=$tipo_servico_n?></td>
											<td><?=$solicitante_n?></td>
											<td><?=$status_n?></td>
											<td>
                                            	<a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO')?> #<?=$code?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesProcesso&id=<?=$id_a?>');return false;" class="btn btn-default btn-block"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a>
                                                <?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){?>
													<a href="#" class="btn btn-warning btn-block" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;"><i class="glyphicon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Analisar ABIS')?></a>
                                                <?php }//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){?>
                                                
                                                <?php if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"obs") and $governo_status == '0'){?>
													<a href="#" class="btn btn-warning btn-block" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;"><i class="glyphicon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Observação ABIS')?></a>
                                                <?php }//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){?>                                                
                            
                            

                            
                            
                            
                            
                            
                            
                            <?php if($tab_id == "10"){?>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
												<?php if(($pExc == "1") and ($status == "1")){?><a href="#" onclick="if(confirm('Gostaria realmete de bloquear o uso de \'<?=$nome?>\'?')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&id_excluir=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="Remover"><i class="icon-remove"></i></a><?php }?>
                            <?php }//if($tab_id == "10"){?>                                                
                                          </td>
										</tr>
<?php 
	}else{//}elseif($tab_id == "0"){//if($tab_id == "1"){	
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
		$cancelamento_suspensao_id = $linha1["cancelamento_suspensao_id"];
		
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
		
		$solicitante_n = ""; $pessoa_sync = "0";
		$linha2 = fSQL::SQL_SELECT_ONE("code,nome,sobrenome,sync","cad_candidato_fisico","id = '$candidato_fisico_id'");
		$pessoa_sync = $linha2["sync"];
		$solicitante_n = '<b>'.$linha2["nome"].' '.$linha2["sobrenome"].'</b> <a class="btn btn-default" onclick="pmodalHtml(\'<i class=icon-search></i> '.$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO CANDIDATO').' #'.$code.'\',\''.$AJAX_PAG.'\',\'get\',\'faisher='.$faisher.'&ajax=detalhesCandidato&id='.$candidato_fisico_id.'\');return false;"><i class="icon-external-link"></i></a><br>'.SYS_CONFIG_RM_SIGLA.' '.$linha2["code"];

		
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
	
	
		if($cancelamento_suspensao_id >= "1"){
			$linhaxxx = fSQL::SQL_SELECT_ONE("acao","axl_cancelamento_suspensao","id = '".$cancelamento_suspensao_id."'");
			$status_n .= "<br><span style='color:red;'>".$class_fLNG->txt(__FILE__,__LINE__,'Solicitação de !!tipo!!',array("tipo"=>acaoProcessoLeg($linhaxxx["acao"])))."</span>";
		}//if($cancelamento_suspensao_id >= "1"){

	
	
?>
										<tr>
											<td><b><?=$code?></b><br><i><?=$origem_id_n?></i></td>
											<td><?=$tipo_servico_n?></td>
											<td><?=$solicitante_n?></td>
											<td><?=$status_n?></td>
											<td>
                                            <?php if($cancelamento_suspensao_id >= "1"){?>
                                            	<a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DA SOLICITAÇÃO')?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesAcao&id=<?=$cancelamento_suspensao_id?>');return false;" class="btn btn-default btn-block"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Analisar')?></a>
                                            <?php }else{//if($cancelamento_suspensao_id >= "1"){?>                                            
                                            	<a href="#" onclick="pmodalHtml('<i class=icon-search></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'DETALHES DO PROCESSO')?> #<?=$code?>','<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=detalhesProcesso&id=<?=$id_a?>');return false;" class="btn btn-default btn-block"><i class="icon-search"></i> <?=$class_fLNG->txt(__FILE__,__LINE__,'Detalhes')?></a>
												<?=$button?>
                                            <?php }//else{//if($cancelamento_suspensao_id >= "1"){?>                                                                        
                                           
                                          </td>
										</tr>
<?php 
	
	}//}else{//}elseif($tab_id == "0"){//if($tab_id == "1"){	

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

function modalMotivo<?=$INC_FAISHER["div"]?>(v_acao,v_id,v_code){
	titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR AÇÃO/PROCESSO')?>";
	if(v_acao == "cancelarcoleta"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR COLETA')?>"; }
	if(v_acao == "cancelarimpressao"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR IMPRESSÃO')?>"; }	
	if(v_acao == "cancelarativo"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'CANCELAR PROCESSO ATIVO')?>"; }	
	if(v_acao == "suspender"){ titulo = "<?=$class_fLNG->txt(__FILE__,__LINE__,'SUSPENDER PROCESSO')?>"; }	
	//v_get = '&acao='+v_acao+'&processo_id='+v_id;
	//carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&tab_id=<?=$tab_id?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val()+'&'+v_get);
	pmodalHtml('<i class=glyphicon-ban></i> '+titulo+' #'+v_code,'<?=$AJAX_PAG?>','get','faisher=<?=$faisher?>&ajax=cancelarAcao&tab_id=<?=$tab_id?>&acao='+v_acao+'&processo_id='+v_id);	

}//modalMotivo

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
	$INC_VAR["tabs"][] = '0[,]<i class="icon-bolt"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Deduplicação ABIS').' <span id="cont-0'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){	
	$INC_VAR["tabs"][] = '1[,]<i class="icon-user"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Prontuário Candidato').' <span id="cont-1'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO
	$INC_VAR["tabs"][] = '2[,]<i class="icon-search"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Consulta Processos').' <span id="cont-2'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO		
	$INC_VAR["tabs"][] = '3[,]<i class="glyphicon-ban"></i> '.$class_fLNG->txt(__FILE__,__LINE__,'Análise de Suspensão/Cancelamento').' <span id="cont-3'.$INC_FAISHER["div"].'"></span>';//adicionar array de guias [tab], onde ID[,]TEXTO	
}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"aud")){	
	$INC_VAR["buscaDireta"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaAvancada"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	$INC_VAR["buscaRapida"] = "OFF";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]	
	$INC_VAR["tituloListaFixo"] = "";
	include "inc/inc_lista-padrao.php";
	
	

}//fim ajax  -------------------------------------------- <<<














?>


