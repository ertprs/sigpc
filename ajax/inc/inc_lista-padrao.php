<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";

//INICIAR ARQUIVO DE LINGUAGEM --->>>
$class_fLNG->loadFile(__FILE__);//incluir o arquivo de linguagem
//INICIAR ARQUIVO DE LINGUAGEM ---<<<




//echo "<pre>"; print_r($INC_FAISHER); echo "</pre>";



//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>

	$AJAX_GETi = "ajax=lista&";//varget inicial/padrão
	$AJAX_GET = $AJAX_GETi;//adiciona as varget padrão
	if(isset($INC_VAR["varget"])){ $AJAX_GET = $AJAX_GET.$INC_VAR["varget"]; }
	$TITULO_PAG = $INC_FAISHER["titulo"]." ";//titulo da pagina
?>
<script>
//TIMER
$.doTimeout('vTimerOnLoad', 0, function(){
	classMenuTop('<?=$INC_FAISHER["menu"]?>');//seleciona o menu ativo
	$('#titulo_principal').html(+$('#html_titulo-<?=$INC_FAISHER["aba"]?>').html());//titulo principal
	$('#sys_mapa').html($('#html_mapa-<?=$INC_FAISHER["aba"]?>').html());//mapa principal
});//TIMER
</script>
<div style="display:none;" id="html_titulo-<?=$INC_FAISHER["aba"]?>"><?php if(isset($INC_VAR["tituloFixo"])){ echo $INC_VAR["tituloFixo"]; }else{ echo $class_fLNG->txt(__FILE__,__LINE__,'Gestão de').' '; }?><?=$TITULO_PAG?></div>
<div style="display:none;" id="html_mapa-<?=$INC_FAISHER["aba"]?>"><?=$INC_FAISHER["mapa"]?></div>
                


<?php /* ---------------------- ########## LISTA DE ACAO ########## ---------------------------------*/ ?>
<script type="text/javascript">          
function displayAcao<?=$INC_FAISHER["div"]?>(v_acao){
	if(v_acao == "abre" || v_acao == "abreHtml"){
		$('#dCentro_acao<?=$INC_FAISHER["div"]?>, .esconder-sendload<?=$INC_FAISHER["div"]?>').show();
		if(v_acao == "abre"){ $('#divAjax_acao<?=$INC_FAISHER["div"]?>').html("<div style='padding:100px 0 300px 0; text-align:center; font-size:24px;'><?=$class_fLNG->txt(__FILE__,__LINE__,'Já estamos carregando aqui atrás, tá quase')?> :)</div>"); }
		if(v_acao == "abreHtml"){ $('#bt_edit<?=$INC_FAISHER["div"]?>').hide(); }
		$('#dCentro_lista<?=$INC_FAISHER["div"]?>').hide();
	}else{
		$('#dCentro_acao<?=$INC_FAISHER["div"]?>').hide();
		if(v_acao == "fecha"){ $('#divAjax_acao<?=$INC_FAISHER["div"]?>').html("<div style='padding:200px 0; text-align:center;'><?=$class_fLNG->txt(__FILE__,__LINE__,'Aguardando conteúdo')?> :)</div>"); }
		$('#dCentro_lista<?=$INC_FAISHER["div"]?>').fadeIn();
		ancoraHtml('#ancLista<?=$INC_FAISHER["div"]?>');//ancora
		$("#acao<?=$INC_FAISHER["div"]?>").click();
	}
}//displayAcao  

function janelaAcao<?=$INC_FAISHER["div"]?>(v_acao,v_get){
	$('.icoOff<?=$INC_FAISHER["div"]?>').hide();
	if(v_acao == "visualizar"){ $('#icoVisualiza<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').show(); }
	if(v_acao == "registro"){ $('#icoRegistro<?=$INC_FAISHER["div"]?>, #bt_edit<?=$INC_FAISHER["div"]?>').show(); }
	displayAcao<?=$INC_FAISHER["div"]?>('abre');
	faisher_ajax('divAjax_acao<?=$INC_FAISHER["div"]?>', 'div_principalContent_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax='+v_acao+'&tab_id='+$('#tab_id<?=$INC_FAISHER["div"]?>').val()+'&'+v_get,'get','ADD');
}//janelaAcao

function regAnt<?=$INC_FAISHER["div"]?>(v_id){
	janelaAcao<?=$INC_FAISHER["div"]?>('registro','anterior='+v_id);
}//regAnt
function regPro<?=$INC_FAISHER["div"]?>(v_id){
	janelaAcao<?=$INC_FAISHER["div"]?>('registro','proximo='+v_id);
}//regPro
</script>
<div style="width:1px; height:1px;" id="acao<?=$INC_FAISHER["div"]?>"></div>
        <a name="ancAcao<?=$INC_FAISHER["div"]?>" id="ancAcao<?=$INC_FAISHER["div"]?>"></a>
				<div class="row-fluid" style="display:none;" id="dCentro_acao<?=$INC_FAISHER["div"]?>">
					<div class="span12">

						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-eye-open icoOff<?=$INC_FAISHER["div"]?>" id="icoVisualiza<?=$INC_FAISHER["div"]?>"></i>
									<i class="icon-edit icoOff<?=$INC_FAISHER["div"]?>" id="icoRegistro<?=$INC_FAISHER["div"]?>"></i>
									<i class="icon-exclamation-sign icoOff<?=$INC_FAISHER["div"]?>" id="icoOutro"></i>
									<span id="div_displayTitulo<?=$INC_FAISHER["div"]?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'REGISTRO')?></span>
								</h3>
					  			<input id="c_id<?=$INC_FAISHER["div"]?>" name="c_id<?=$INC_FAISHER["div"]?>" type="hidden" value="0" />
									<div class="actions">
										<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a='+$('#c_id<?=$INC_FAISHER["div"]?>').val());return false;" class="btn btn-mini icoOff<?=$INC_FAISHER["div"]?> esconder-sendload<?=$INC_FAISHER["div"]?>" style="display:none;" rel="tooltip" data-placement="left" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Visualizar')?>" id="bt_visual<?=$INC_FAISHER["div"]?>"><i class="icon-search"></i></a>
										<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a='+$('#c_id<?=$INC_FAISHER["div"]?>').val());return false;" class="btn btn-mini icoOff<?=$INC_FAISHER["div"]?> esconder-sendload<?=$INC_FAISHER["div"]?>" style="display:none;" rel="tooltip" data-placement="left" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Editar dados')?>" id="bt_edit<?=$INC_FAISHER["div"]?>"><i class="icon-pencil"></i></a>
										<a href="#" onclick="displayAcao<?=$INC_FAISHER["div"]?>('fecha');return false;" class="btn btn-mini esconder-sendload<?=$INC_FAISHER["div"]?>" rel="tooltip" data-placement="left" data-original-title="<?=$class_fLNG->txt(__FILE__,__LINE__,'Fechar/Sair [ESC]')?>" id="bt_fech<?=$INC_FAISHER["div"]?>"><i class="icon-remove"></i></a>
									</div>
							</div>
							<div class="box-content nopadding">

                            
                            <div style="width:100%; min-height:300px;" id="dAjax_acao<?=$INC_FAISHER["div"]?>">
                                <div id="divAjax_acao<?=$INC_FAISHER["div"]?>">
                                    <!-- conteudo --> 
                                </div>
                            </div>
                          <!-- End #dAjax_acao -->

							</div>
						</div>
                        
					</div>
				</div><!-- end .row-fluid -->
                
                
                

                                                            

<?php /* ---------------------- ########## LISTA DE REGISTROS ########## ---------------------------------*/ ?>
        <a name="ancLista<?=$INC_FAISHER["div"]?>" id="ancLista<?=$INC_FAISHER["div"]?>"></a>
				<div class="row-fluid" id="dCentro_lista<?=$INC_FAISHER["div"]?>">
					<div class="span12">

						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3 onclick="reloadLista<?=$INC_FAISHER["div"]?>();">
									<i class="<?php if(isset($INC_VAR["icoListaFixo"])){ echo $INC_VAR["icoListaFixo"]; }else{ echo 'icon-reorder'; }?>"></i>
									<?php if(isset($INC_VAR["tituloListaFixo"])){ echo maiusculo($INC_VAR["tituloListaFixo"]); }else{ echo $class_fLNG->txt(__FILE__,__LINE__,'LISTAGEM DE').' '; }?> <?=maiusculo($TITULO_PAG)?> <span class="hidden-1024" id="contTitu<?=$INC_FAISHER["div"]?>"></span>
								</h3>
                                <?php if(isset($INC_VAR["reloadListaOff"])){ }else{?>
									<div class="actions">
										<a href="#" onclick="reloadLista<?=$INC_FAISHER["div"]?>();return false;" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									</div>
                                <?php }?>
							</div>
							<div class="box-content nopadding">
<?php
//########################################################### GUIA DE ABAS	 ##########################################
$tab_id = "";
if(isset($INC_VAR["tabs"])){
	$tab_id = $INC_VAR["tabSel"];
	//monta array
	$array = $INC_VAR["tabs"];
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if($cont_ARRAY >= "1"){

?>
	<ul class="tabs tabs-inline tabs-top">
<?php
		$listaIDS_a = $array; //nome do cookie
		foreach ($listaIDS_a as $pos => $valor){
			if($valor != ""){
				$arraySUB = explode("[,]",$valor);
		
				//verifica se recebeu função adicional
				if((isset($INC_VAR["tabFuncao"])) and ($INC_VAR["tabFuncao"] != "")){ $onCK = $INC_VAR["tabFuncao"]."();"; }else{
					$onCK = "carregaLista".$INC_FAISHER["div"]."('".$AJAX_GET."&tab_id=".$arraySUB["0"]."');";
				}
			
?>
		<li class="tabs-<?=$INC_FAISHER["div"]?>" id="<?=$arraySUB["0"]?>-<?=$INC_FAISHER["div"]?>"><a href="#" onclick="$('#tab_id<?=$INC_FAISHER["div"]?>').val('<?=$arraySUB["0"]?>');<?=$onCK?>return false;" data-toggle='tab'><?=$arraySUB["1"]?></a></li>
<?php
			}//if($valor != ""){
		}//fim foreach
?>
	</ul>
    <div style="clear:both; height:30px;"></div>
<?php
	}//fim if($cont_ARRAY >= "1"){
}//if(isset($INC_VAR["tabs"])){
//########################################################### GUIA DE ABAS	 ##########################################
	
	
	
	
	
?>
<input name="tab_id<?=$INC_FAISHER["div"]?>" type="hidden" id="tab_id<?=$INC_FAISHER["div"]?>" value="<?=$tab_id?>" />
<?php if($INC_VAR["var_extra"] != ""){?><input name="var_extra<?=$INC_FAISHER["div"]?>" type="hidden" id="var_extra<?=$INC_FAISHER["div"]?>" value="<?=$INC_VAR["var_extra"]?>" /><?php }?>
<input id="AJAX_GET<?=$INC_FAISHER["div"]?>" name="AJAX_GET<?=$INC_FAISHER["div"]?>" type="hidden" value="" />
<script type="text/javascript">
//TIMER
$.doTimeout('vTimerDefalt', 100, function(){
	<?php if(isset($_GET["VARS"])){ $d = explode("VARS=DIV&",$_SERVER["QUERY_STRING"]); $AJAX_GET .= "&".$d["1"]; }?>
	carregaLista<?=$INC_FAISHER["div"]?>('<?=$AJAX_GET?>');
	<?php if(isset($_GET["id_v"])){?>janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$_GET["id_v"]?><?php if(isset($_GET["extra"])){ echo "&extra=".$_GET["extra"]; }?>');<?php }?>
	<?php if(isset($_GET["id_a"])){?>janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$_GET["id_a"]?><?php if(isset($_GET["extra"])){ echo "&extra=".$_GET["extra"]; }?>');<?php }?>
	<?php if($INC_VAR["buscaAvancada"] == "ON"){?>faisher_ajax('divAbusca<?=$INC_FAISHER["div"]?>', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=buscaAvancada');<?php }?>
	<?php if($INC_VAR["buscaDireta"] == "ON"){?>faisher_ajax('divDbusca<?=$INC_FAISHER["div"]?>', '0', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&ajax=buscaDireta');<?php }?>
});//TIMER
	
function reloadLista<?=$INC_FAISHER["div"]?>(){
	var v_get = '<?=$AJAX_GET?>';
	if($('#AJAX_GET<?=$INC_FAISHER["div"]?>').length > 0){
		v_get = $('#AJAX_GET<?=$INC_FAISHER["div"]?>').val();	
	}	
	carregaLista<?=$INC_FAISHER["div"]?>(v_get);
}
function carregaLista<?=$INC_FAISHER["div"]?>(v_get){
	<?php if($INC_VAR["var_extra"] != ""){?>v_get = v_get+'&var_extra='+$('#var_extra<?=$INC_FAISHER["div"]?>').val(); <?php }?>
	<?php if((isset($INC_VAR["tabs"])) and ($tab_id != "")){?>v_get = v_get+'&tab_id='+$('#tab_id<?=$INC_FAISHER["div"]?>').val(); <?php }?>
	<?php if(isset($_GET["POP"])){?>v_get = v_get+'&POP=1'; <?php }?>
	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Carregando listagem...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&'+v_get, 'get', 'ADD');	
}
</script>
            <div style="width:100%;" id="divConteiner_lista<?=$INC_FAISHER["div"]?>">
   
<?php
//#################################################### busca rápida ############################################>>>
if($INC_VAR["buscaRapida"] != "OFF"){
?>
<script type="text/javascript">
$(document).ready(function(){
//JQUERY executa com ENTER
	/* ao pressionar uma tecla em um campo*/
	$("#rapida_b<?=$INC_FAISHER["div"]?>").keypress(function(e){
		var tecla = (e.keyCode?e.keyCode:e.which);
		/* verifica se a tecla pressionada foi o ENTER */
		if(tecla == 13){//codigo a executar	
			if($("#rapida_b<?=$INC_FAISHER["div"]?>").val() == ""){
				$("#rapida_b<?=$INC_FAISHER["div"]?>").attr('placeholder', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Busca rápida... (DIGITE ALGO!)')?>');
				//TIMER
				$.doTimeout( 'vTimerCBusca', 5000, function(){$("#rapida_b<?=$INC_FAISHER["div"]?>").attr('placeholder', '<?=$class_fLNG->txt(__FILE__,__LINE__,'Busca rápida...')?>'); return false;});//TIMER
			}else{
				bRapida<?=$INC_FAISHER["div"]?>();
			}
			return false;/* impede o sumbit caso esteja dentro de um form */
		}
	})
//FIM JQUERY executa com ENTER
	
});

function bRapida<?=$INC_FAISHER["div"]?>(){
	var v_get = '&tab_id='+$('#tab_id<?=$INC_FAISHER["div"]?>').val();//pega dados do tabs
	<?php if($INC_VAR["var_extra"] != ""){?>v_get = v_get+'&var_extra='+$('#var_extra<?=$INC_FAISHER["div"]?>').val(); <?php }?>
	if($('#GET_BUSCARAPIDA<?=$INC_FAISHER["div"]?>').length > 0){ v_get = v_get+'&'+$('#GET_BUSCARAPIDA<?=$INC_FAISHER["div"]?>').val(); }
	if($("#rapida_b<?=$INC_FAISHER["div"]?>").val() != ""){
		v_get = v_get+'&rapida_b='+$("#rapida_b<?=$INC_FAISHER["div"]?>").val(); expandeElemento('<?="idContrAbusca".$INC_FAISHER["div"]?>','ocultar');
	}

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','<?=$class_fLNG->txt(__FILE__,__LINE__,'Filtrando dados...')?>');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', 'faisher=<?=$faisher?>&<?=$AJAX_GETi?>'+v_get, 'get', 'ADD');
}//bRapida

function bRapida<?=$INC_FAISHER["div"]?>Remove(v_remove){
	if($("#rapida_b<?=$INC_FAISHER["div"]?>").val() == ""){
		bAvancada<?=$INC_FAISHER["div"]?>Remove('all');//remove busca principal
	}else{
		if(v_remove == "rapida_b" || v_remove == "all"){ $("#rapida_b<?=$INC_FAISHER["div"]?>").val(''); }
		bRapida<?=$INC_FAISHER["div"]?>();
	}
}//bRapida Remove
</script> 
							<div class="row-fluid" id="dAbuscaRapida<?=$INC_FAISHER["div"]?>">
                                <div class="controls span6" style="padding:20px;">
                                    <div class="input-append input-prepend" style="float:left;">
                                        <span class="add-on"><i class="icon-search"></i></span>
                                        <input name="rapida_b<?=$INC_FAISHER["div"]?>" type="text" class='input-medium' id="rapida_b<?=$INC_FAISHER["div"]?>" placeholder="<?=$class_fLNG->txt(__FILE__,__LINE__,'Busca rápida...')?>">
                                        <button class="btn" type="button" onclick="bRapida<?=$INC_FAISHER["div"]?>();"><?=$class_fLNG->txt(__FILE__,__LINE__,'Buscar')?></button>
                                  </div>
                                </div>
                                <div class="controls span6" style="text-align:right; padding:20px;">
                                    <?php if($pCadastro != "OFF"){?><button class="btn btn-primary btn-large" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=0');"><i class="icon-plus-sign"></i> <?php if($INC_VAR["btNovo"] != ""){ echo $INC_VAR["btNovo"]; }else{?> <?=$class_fLNG->txt(__FILE__,__LINE__,'Adicionar novo')?><?php }?></button><?php }?>
                                </div>
                            </div>
<?php
}//if($INC_VAR["buscaRapida"] != "OFF"){
//#################################################### busca rápida ############################################<<<
?>
                            
<?php
//#################################################### busca avançada ############################################>>>
if($INC_VAR["buscaAvancada"] == "ON"){
?>
							<div class="row-fluid" style="margin-bottom:20px;" id="dAbusca<?=$INC_FAISHER["div"]?>">
                            <?php $idControleGuia = "idContrAbusca".$INC_FAISHER["div"]; ?>
							<div class="box box-color box-small">
								<div class="box-title" style="margin:0;">
									<h3 style="cursor:pointer;" onclick="expandeElemento('<?=$idControleGuia?>');">
										<i class="icon-search"></i><?=$class_fLNG->txt(__FILE__,__LINE__,'Busca avançada na lista')?> <span class="cssFonteMin"><?=$TITULO_PAG?></span> - <span class="status-leg"><?=$class_fLNG->txt(__FILE__,__LINE__,'Expandir')?></span>
									</h3>
									<div class="actions">
										<a href="#" class="btn btn-mini bt_expandebusca" onclick="expandeElemento('<?=$idControleGuia?>');return false;" id="<?=$idControleGuia?>"><i class="icon-angle-up"></i></a>
									</div>
								</div>
								<div class="box-content-ax" style="display:none;"><div id="divAbusca<?=$INC_FAISHER["div"]?>"></div></div>
							</div>
                            </div>
<?php
}//if($INC_VAR["buscaAvancada"] == "ON"){
//#################################################### busca avançada ############################################<<<
?>
                            
<?php
//#################################################### busca direta ############################################>>>
if($INC_VAR["buscaDireta"] == "ON"){
?>
							<div class="row-fluid" style="margin-bottom:20px;" id="dDbusca<?=$INC_FAISHER["div"]?>">
                            <?php $idControleGuia = time().rand().rand(); ?>
							<div class="box box-color box-small">
								<div class="box-title" style="margin:0;">
									<h3><i class="icon-search"></i><span id="tituDbusca<?=$INC_FAISHER["div"]?>"><?=$class_fLNG->txt(__FILE__,__LINE__,'Aplicar filtros')?></span></h3>
								</div>
								<div class="box-content-ax"><div id="divDbusca<?=$INC_FAISHER["div"]?>"></div></div>
							</div>
                            </div>
<?php
}//if($INC_VAR["buscaDireta"] == "ON"){
//#################################################### busca direta ############################################<<<
?>
                            
                            <div id="dAjax_listaMSG<?=$INC_FAISHER["div"]?>"></div>
                            <div style="width:100%; min-height:300px;" id="dAjax_lista<?=$INC_FAISHER["div"]?>">
                                <div id="divAjax_lista<?=$INC_FAISHER["div"]?>">
                                    <!-- conteudo --> 
                                </div>
                            </div>
                          <!-- End #dAjax_lista<?=$INC_FAISHER["div"]?> -->

							</div>
						</div>
                        
					</div>
				</div><!-- end .row-fluid -->